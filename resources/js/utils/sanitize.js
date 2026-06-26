/**
 * sanitize.js
 * Client-side sanitization utilities.
 * Strips HTML tags and trims whitespace from user input
 * before it is sent to the API.
 */

/**
 * Strip all HTML tags from a string and trim whitespace.
 * Prevents XSS payloads reaching the API via form fields.
 * @param {string} value
 * @returns {string}
 */
export function stripHtml(value) {
    const div = document.createElement('div');
    div.textContent = String(value);
    return div.innerHTML.trim();
}

/**
 * Sanitize a plain text field — strip HTML and collapse
 * internal whitespace runs to a single space.
 * @param {string} value
 * @returns {string}
 */
export function sanitizeText(value) {
    return stripHtml(value).replace(/\s+/g, ' ');
}

/**
 * Sanitize all string fields in a FormData object in place.
 * Non-file fields have HTML stripped; file fields are left alone.
 * @param {FormData} formData
 * @returns {FormData}
 */
export function sanitizeFormData(formData) {
    const cleaned = new FormData();
    for (const [key, value] of formData.entries()) {
        if (value instanceof File) {
            cleaned.append(key, value);
        } else {
            cleaned.append(key, sanitizeText(value));
        }
    }
    return cleaned;
}
