/**
 * api/books.js
 * Thin wrapper around the /api/books endpoints.
 * Handles CSRF token injection for write requests.
 */

/** Genres must match App\Models\Book::GENRES on the server. */
export const Book = {
    GENRES: [
        'Fantasy',
        'Science Fiction',
        'Mystery',
        'Romance',
        'Horror',
        'Non-Fiction',
        'Biography',
        'Poetry',
    ],
};

/**
 * Read the CSRF token from the meta tag Laravel outputs in the layout.
 * @returns {string}
 */
function getCsrfToken() {
    const meta = document.querySelector('meta[name="csrf-token"]');
    if (meta) return meta.getAttribute('content');
    const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
    return match ? decodeURIComponent(match[1]) : '';
}

/**
 * GET /api/books
 * @param {URLSearchParams} params
 * @returns {Promise<Object>} { data, links, meta }
 */
export async function fetchBooks(params = new URLSearchParams()) {
    const response = await fetch(`/api/books?${params.toString()}`, {
        credentials: 'same-origin',
    });
    if (!response.ok) throw new Error('Failed to fetch books.');
    return response.json();
}

/**
 * GET /api/books/{id}
 * @param {number} id
 * @returns {Promise<Object>} { data }
 */
export async function fetchBook(id) {
    const response = await fetch(`/api/books/${id}`, {
        credentials: 'same-origin',
    });
    if (!response.ok) throw new Error('Book not found.');
    return response.json();
}

/**
 * POST /api/books
 * @param {FormData} formData
 * @returns {Promise<Object>} { data }
 */
export async function createBook(formData) {
    const response = await fetch('/api/books', {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'X-CSRF-TOKEN': getCsrfToken() },
        body: formData,
    });
    if (!response.ok) {
        const err = await response.json().catch(() => ({ message: `HTTP ${response.status}` }));
        throw err;
    }
    return response.json();
}

/**
 * POST /api/books/{id} with _method=PUT (multipart workaround).
 * @param {number} id
 * @param {FormData} formData
 * @returns {Promise<Object>} { data }
 */
export async function updateBook(id, formData) {
    formData.append('_method', 'PUT');
    const response = await fetch(`/api/books/${id}`, {
        method: 'POST',
        credentials: 'same-origin',
        headers: { 'X-CSRF-TOKEN': getCsrfToken() },
        body: formData,
    });
    if (!response.ok) {
        const err = await response.json().catch(() => ({ message: `HTTP ${response.status}` }));
        throw err;
    }
    return response.json();
}

/**
 * DELETE /api/books/{id}
 * @param {number} id
 * @returns {Promise<Object>}
 */
export async function deleteBook(id) {
    const response = await fetch(`/api/books/${id}`, {
        method: 'DELETE',
        credentials: 'same-origin',
        headers: {
            'X-CSRF-TOKEN': getCsrfToken(),
            'Content-Type': 'application/json',
        },
    });
    if (!response.ok) throw new Error(`Failed to delete book. HTTP ${response.status}`);
    return response.json();
}