/**
 * validate.test.js
 * Unit tests for the client-side book validation functions.
 * These test pure logic with no DOM or network dependencies.
 */

import { describe, it, expect } from 'vitest';
import { validateBook } from '../../resources/js/utils/validate.js';

// ── Valid base fixture ───────────────────────────────────────────────────────
const valid = {
    title:       'The Great Gatsby',
    author:      'F. Scott Fitzgerald',
    genre:       'Fantasy',
    description: 'A novel about the American Dream.',
};

// ── Title validation ─────────────────────────────────────────────────────────
describe('validateBook — title', () => {
    it('passes when title is present', () => {
        const errors = validateBook(valid);
        expect(errors.title).toBeUndefined();
    });

    it('fails when title is empty', () => {
        const errors = validateBook({ ...valid, title: '' });
        expect(errors.title).toBeDefined();
    });

    it('fails when title is only whitespace', () => {
        const errors = validateBook({ ...valid, title: '   ' });
        expect(errors.title).toBeDefined();
    });

    it('fails when title exceeds 255 characters', () => {
        const errors = validateBook({ ...valid, title: 'a'.repeat(256) });
        expect(errors.title).toBeDefined();
    });

    it('passes when title is exactly 255 characters', () => {
        const errors = validateBook({ ...valid, title: 'a'.repeat(255) });
        expect(errors.title).toBeUndefined();
    });
});

// ── Author validation ────────────────────────────────────────────────────────
describe('validateBook — author', () => {
    it('passes when author is present', () => {
        const errors = validateBook(valid);
        expect(errors.author).toBeUndefined();
    });

    it('fails when author is empty', () => {
        const errors = validateBook({ ...valid, author: '' });
        expect(errors.author).toBeDefined();
    });

    it('fails when author exceeds 255 characters', () => {
        const errors = validateBook({ ...valid, author: 'a'.repeat(256) });
        expect(errors.author).toBeDefined();
    });
});

// ── Genre validation ─────────────────────────────────────────────────────────
describe('validateBook — genre', () => {
    it('passes for each valid genre', () => {
        const genres = [
            'Fantasy', 'Science Fiction', 'Mystery', 'Romance',
            'Horror', 'Non-Fiction', 'Biography', 'Poetry',
        ];
        genres.forEach(genre => {
            const errors = validateBook({ ...valid, genre });
            expect(errors.genre).toBeUndefined();
        });
    });

    it('fails when genre is empty', () => {
        const errors = validateBook({ ...valid, genre: '' });
        expect(errors.genre).toBeDefined();
    });

    it('fails when genre is not in the allowed list', () => {
        const errors = validateBook({ ...valid, genre: 'Manga' });
        expect(errors.genre).toBeDefined();
    });
});

// ── Description validation ───────────────────────────────────────────────────
describe('validateBook — description', () => {
    it('passes when description is present', () => {
        const errors = validateBook(valid);
        expect(errors.description).toBeUndefined();
    });

    it('fails when description is empty', () => {
        const errors = validateBook({ ...valid, description: '' });
        expect(errors.description).toBeDefined();
    });

    it('fails when description is only whitespace', () => {
        const errors = validateBook({ ...valid, description: '   ' });
        expect(errors.description).toBeDefined();
    });
});

// ── Full form ────────────────────────────────────────────────────────────────
describe('validateBook — full form', () => {
    it('returns empty errors object when all fields are valid', () => {
        const errors = validateBook(valid);
        expect(Object.keys(errors)).toHaveLength(0);
    });

    it('returns multiple errors when multiple fields are invalid', () => {
        const errors = validateBook({ title: '', author: '', genre: '', description: '' });
        expect(Object.keys(errors).length).toBeGreaterThan(1);
    });
});
