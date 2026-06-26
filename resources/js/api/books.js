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
 * Read the CSRF token Laravel sets in the XSRF-TOKEN cookie.
 * Laravel's session middleware validates this on all non-GET requests.
 * @returns {string}
 */
function getCsrfToken() {
    const match = document.cookie.match(/XSRF-TOKEN=([^;]+)/);
    return match ? decodeURIComponent(match[1]) : '';
}

/**
 * GET /api/books
 * Supports ?page=N, ?genre=X, ?search=Q
 * @param {URLSearchParams} params
 * @returns {Promise<Object>} { data, links, meta }
 */
export async function fetchBooks(params = new URLSearchParams()) {
    const response = await fetch(`/api/books?${params.toString()}`);
    if (!response.ok) throw new Error('Failed to fetch books.');
    return response.json();
}

/**
 * GET /api/books/{id}
 * @param {number} id
 * @returns {Promise<Object>} { data }
 */
export async function fetchBook(id) {
    const response = await fetch(`/api/books/${id}`);
    if (!response.ok) throw new Error('Book not found.');
    return response.json();
}

/**
 * POST /api/books
 * Sends multipart/form-data so cover images are supported.
 * @param {FormData} formData
 * @returns {Promise<Object>} { data }
 */
export async function createBook(formData) {
    const response = await fetch('/api/books', {
        method: 'POST',
        headers: { 'X-XSRF-TOKEN': getCsrfToken() },
        body: formData,
    });
    if (!response.ok) {
        const err = await response.json();
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
        headers: { 'X-XSRF-TOKEN': getCsrfToken() },
        body: formData,
    });
    if (!response.ok) {
        const err = await response.json();
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
        headers: {
            'X-XSRF-TOKEN': getCsrfToken(),
            'Content-Type': 'application/json',
        },
    });
    if (!response.ok) throw new Error('Failed to delete book.');
    return response.json();
}
