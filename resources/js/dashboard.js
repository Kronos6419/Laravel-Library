/**
 * dashboard.js
 * JS application for the author dashboard (users/dashboard).
 * Handles create, update, and delete via the REST API.
 * All forms are client-side validated and sanitized before sending.
 */

import { createBook, updateBook, deleteBook } from './api/books.js';
import { validateBook } from './utils/validate.js';
import { sanitizeFormData } from './utils/sanitize.js';

// ─── Helpers ──────────────────────────────────────────────────────────────────

/**
 * Display validation errors next to their fields.
 * Clears existing errors first.
 * @param {HTMLFormElement} form
 * @param {Object} errors - { fieldName: 'message' }
 */
function showErrors(form, errors) {
    // Clear previous errors
    form.querySelectorAll('.js-error').forEach(el => el.remove());

    Object.entries(errors).forEach(([field, message]) => {
        const input = form.querySelector(`[name="${field}"]`);
        if (!input) return;
        const p = document.createElement('p');
        p.className = 'error js-error';
        p.textContent = message;
        input.insertAdjacentElement('afterend', p);
    });
}

/**
 * Clear all JS-injected error messages from a form.
 * @param {HTMLFormElement} form
 */
function clearErrors(form) {
    form.querySelectorAll('.js-error').forEach(el => el.remove());
}

/**
 * Show a flash message in the dashboard flash area.
 * @param {string} message
 * @param {'success'|'error'} type
 */
function showFlash(message, type = 'success') {
    const area = document.getElementById('dashboard-flash');
    if (!area) return;
    area.innerHTML = '';
    const p = document.createElement('p');
    p.className = `flash-msg flash-msg--${type}`;
    p.textContent = message;
    area.appendChild(p);
    // Auto-dismiss after 4 seconds
    setTimeout(() => p.remove(), 4000);
}

/**
 * Read field values from a form into a plain object.
 * @param {HTMLFormElement} form
 * @returns {Object}
 */
function getFields(form) {
    return {
        title:       form.querySelector('[name="title"]')?.value ?? '',
        author:      form.querySelector('[name="author"]')?.value ?? '',
        genre:       form.querySelector('[name="genre"]')?.value ?? '',
        description: form.querySelector('[name="description"]')?.value ?? '',
    };
}

// ─── Create book ──────────────────────────────────────────────────────────────

const createForm = document.getElementById('create-book-form');

if (createForm) {
    createForm.addEventListener('submit', async e => {
        e.preventDefault();
        clearErrors(createForm);

        // 1. Client-side validation
        const fields = getFields(createForm);
        const errors = validateBook(fields);

        if (Object.keys(errors).length > 0) {
            showErrors(createForm, errors);
            return;
        }

        // 2. Sanitize then build FormData
        const raw = new FormData(createForm);
        const formData = sanitizeFormData(raw);

        // 3. Submit to API
        const btn = createForm.querySelector('button[type="submit"]');
        btn.disabled = true;

        try {
            await createBook(formData);
            showFlash('Book added successfully!');
            createForm.reset();
            // Reload the page to show the new book in the list
            setTimeout(() => window.location.reload(), 800);
        } catch (err) {
            // Server-side validation errors come back as { errors: { field: [...] } }
            if (err.errors) {
                const serverErrors = {};
                Object.entries(err.errors).forEach(([key, msgs]) => {
                    serverErrors[key] = msgs[0];
                });
                showErrors(createForm, serverErrors);
            } else {
                showFlash('Something went wrong. Please try again.', 'error');
            }
        } finally {
            btn.disabled = false;
        }
    });
}

// ─── Delete book ──────────────────────────────────────────────────────────────

/**
 * Wire up all delete buttons on the page.
 * Uses event delegation on the book list container.
 */
const bookList = document.getElementById('dashboard-books');

if (bookList) {
    bookList.addEventListener('click', async e => {
        const btn = e.target.closest('.js-delete-btn');
        if (!btn) return;

        const bookId = btn.dataset.bookId;
        if (!bookId) return;

        if (!confirm('Delete this book? This cannot be undone.')) return;

        btn.disabled = true;

        try {
            await deleteBook(bookId);
            // Remove the card from the DOM immediately
            const card = btn.closest('.book-dashboard-card');
            if (card) card.remove();
            showFlash('Book deleted.');
        } catch (err) {
            showFlash('Could not delete book. Please try again.', 'error');
            btn.disabled = false;
        }
    });
}
