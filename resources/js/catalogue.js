/**
 * catalogue.js
 * JS application for the public book catalogue (books/index).
 * Fetches from GET /api/books, renders cards, handles
 * genre filtering, search, and pagination.
 */

import { fetchBooks, Book } from './api/books.js';

// ─── State ────────────────────────────────────────────────────────────────────
let currentPage   = 1;
let currentGenre  = '';
let currentSearch = '';

// ─── Render helpers ───────────────────────────────────────────────────────────

/**
 * Build a single book card element from API data.
 * @param {Object} book - BookResource fields
 * @returns {HTMLElement}
 */
function buildCard(book) {
    const article = document.createElement('article');
    article.className = 'card book-card';
    article.innerHTML = `
        <h2 class="book-card__title">${escapeHtml(book.title)}</h2>
        <div class="book-cover">
            <img src="${book.cover_url}" alt="Cover of ${escapeHtml(book.title)}">
        </div>
        <div class="book-card__meta">
            <span class="book-author">By ${escapeHtml(book.author)}</span>
            <span class="genre-badge">${escapeHtml(book.genre)}</span>
        </div>
        <div class="book-card__owner text-xs">
            Added ${escapeHtml(book.created_at)} by
            <a href="/${book.owner_id}/books">${escapeHtml(book.owner)}</a>
        </div>
        <div class="book-card__description text-sm">
            <p>${escapeHtml(truncate(book.description, 120))}</p>
            <a href="/books/${book.id}" class="read-more">Read more &rarr;</a>
        </div>
    `;
    return article;
}

/**
 * Escape a string for safe innerHTML insertion.
 * @param {string} str
 * @returns {string}
 */
function escapeHtml(str) {
    const div = document.createElement('div');
    div.textContent = String(str ?? '');
    return div.innerHTML;
}

/**
 * Truncate a string to maxLen characters, appending ellipsis.
 * @param {string} str
 * @param {number} maxLen
 * @returns {string}
 */
function truncate(str, maxLen) {
    if (!str) return '';
    return str.length <= maxLen ? str : str.slice(0, maxLen) + '...';
}

/**
 * Build genre filter buttons from Book.GENRES.
 * @param {HTMLElement} genreNav
 */
function buildGenreNav(genreNav) {
    const all = document.createElement('button');
    all.className = 'genre-filter-btn active';
    all.textContent = 'All';
    all.dataset.genre = '';
    genreNav.appendChild(all);

    Book.GENRES.forEach(genre => {
        const btn = document.createElement('button');
        btn.className = 'genre-filter-btn';
        btn.textContent = genre;
        btn.dataset.genre = genre;
        genreNav.appendChild(btn);
    });

    genreNav.addEventListener('click', e => {
        const btn = e.target.closest('.genre-filter-btn');
        if (!btn) return;

        genreNav.querySelectorAll('.genre-filter-btn')
                .forEach(b => b.classList.remove('active'));
        btn.classList.add('active');

        currentGenre = btn.dataset.genre;
        currentPage  = 1;
        loadBooks(grid, pagination, countLabel);
    });
}

/**
 * Render pagination prev/next controls.
 * @param {HTMLElement} pagination
 * @param {Object} meta - API meta object
 * @param {Object} links - API links object
 * @param {HTMLElement} grid
 * @param {HTMLElement} countLabel
 */
function renderPagination(pagination, meta, links, grid, countLabel) {
    pagination.innerHTML = '';

    const info = document.createElement('p');
    info.className = 'pagination-info';
    info.textContent = `Showing ${meta.from ?? 0}–${meta.to ?? 0} of ${meta.total} books`;
    pagination.appendChild(info);

    const controls = document.createElement('div');
    controls.className = 'pagination-controls';

    const prev = document.createElement('button');
    prev.textContent = '← Previous';
    prev.className = 'pagination-btn';
    prev.disabled = !links.prev;
    prev.addEventListener('click', () => {
        currentPage--;
        loadBooks(grid, pagination, countLabel);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const next = document.createElement('button');
    next.textContent = 'Next →';
    next.className = 'pagination-btn';
    next.disabled = !links.next;
    next.addEventListener('click', () => {
        currentPage++;
        loadBooks(grid, pagination, countLabel);
        window.scrollTo({ top: 0, behavior: 'smooth' });
    });

    const pageNum = document.createElement('span');
    pageNum.className = 'pagination-page';
    pageNum.textContent = `Page ${meta.current_page} of ${meta.last_page}`;

    controls.append(prev, pageNum, next);
    pagination.appendChild(controls);
}

// ─── Main load function ───────────────────────────────────────────────────────

/**
 * Fetch books from the API using current state and re-render the grid.
 * @param {HTMLElement} grid
 * @param {HTMLElement} pagination
 * @param {HTMLElement} countLabel
 */
async function loadBooks(grid, pagination, countLabel) {
    grid.innerHTML = '<p class="catalogue-loading">Loading books...</p>';

    try {
        const params = new URLSearchParams({ page: currentPage });
        if (currentGenre)  params.set('genre', currentGenre);
        if (currentSearch) params.set('search', currentSearch);

        const { data, meta, links } = await fetchBooks(params);

        grid.innerHTML = '';

        if (data.length === 0) {
            grid.innerHTML = '<p class="catalogue-empty">No books found.</p>';
        } else {
            data.forEach(book => grid.appendChild(buildCard(book)));
        }

        if (countLabel) {
            countLabel.textContent = `${meta.total} book${meta.total !== 1 ? 's' : ''}`;
        }

        renderPagination(pagination, meta, links, grid, countLabel);

    } catch (error) {
        grid.innerHTML = `<p class="catalogue-error">Could not load books. Please try again.</p>`;
        console.error('Catalogue load error:', error);
    }
}

// ─── Debounce ─────────────────────────────────────────────────────────────────

/**
 * Debounce a function — waits delay ms after last call before firing.
 * @param {Function} fn
 * @param {number} delay
 * @returns {Function}
 */
function debounce(fn, delay) {
    let timer;
    return (...args) => {
        clearTimeout(timer);
        timer = setTimeout(() => fn(...args), delay);
    };
}

// ─── Boot — wait for DOM to be ready ─────────────────────────────────────────
document.addEventListener('DOMContentLoaded', () => {
    const grid       = document.getElementById('catalogue-grid');
    const pagination = document.getElementById('catalogue-pagination');
    const searchInput= document.getElementById('catalogue-search');
    const genreNav   = document.getElementById('catalogue-genres');
    const countLabel = document.getElementById('catalogue-count');

    // Guard: only run on pages that have the catalogue grid
    if (!grid) return;

    if (genreNav) buildGenreNav(genreNav);

    if (searchInput) {
        searchInput.addEventListener('input', debounce(e => {
            currentSearch = e.target.value.trim();
            currentPage   = 1;
            loadBooks(grid, pagination, countLabel);
        }, 350));
    }

    loadBooks(grid, pagination, countLabel);
});
