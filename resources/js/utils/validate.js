/**
 * validate.js
 * Client-side validation for book forms.
 * Returns an object of field-level error messages.
 * An empty object means the form is valid.
 */

import { Book } from '../api/books.js';

/**
 * Validate book form fields.
 * @param {Object} fields - { title, author, genre, description }
 * @returns {Object} errors - keyed by field name
 */
export function validateBook({ title, author, genre, description }) {
    const errors = {};

    if (!title || title.trim().length === 0) {
        errors.title = 'Title is required.';
    } else if (title.trim().length > 255) {
        errors.title = 'Title must be under 255 characters.';
    }

    if (!author || author.trim().length === 0) {
        errors.author = 'Author is required.';
    } else if (author.trim().length > 255) {
        errors.author = 'Author name must be under 255 characters.';
    }

    if (!genre || genre.trim().length === 0) {
        errors.genre = 'Please select a genre.';
    } else if (!Book.GENRES.includes(genre)) {
        errors.genre = 'Invalid genre selected.';
    }

    if (!description || description.trim().length === 0) {
        errors.description = 'Description is required.';
    }

    return errors;
}
