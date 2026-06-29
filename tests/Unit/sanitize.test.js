/**
 * sanitize.test.js
 * Unit tests for the client-side sanitization utilities.
 * Runs in jsdom so DOM APIs (document.createElement) are available.
 *
 * @vitest-environment jsdom
 */

import { describe, it, expect } from 'vitest';
import { stripHtml, sanitizeText, sanitizeFormData } from '../../resources/js/utils/sanitize.js';

// ── stripHtml ────────────────────────────────────────────────────────────────
describe('stripHtml', () => {
    it('returns plain text unchanged', () => {
        expect(stripHtml('Hello world')).toBe('Hello world');
    });

    it('strips a simple HTML tag', () => {
        expect(stripHtml('<b>bold</b>')).toBe('bold');
    });

    it('strips a script tag payload', () => {
        expect(stripHtml('<script>alert("xss")</script>')).not.toContain('<script>');
    });

    it('strips nested HTML tags', () => {
        expect(stripHtml('<div><p>text</p></div>')).toBe('text');
    });

    it('trims leading and trailing whitespace', () => {
        expect(stripHtml('  hello  ')).toBe('hello');
    });

    it('handles an empty string', () => {
        expect(stripHtml('')).toBe('');
    });

    it('handles non-string input without throwing', () => {
        expect(() => stripHtml(null)).not.toThrow();
        expect(() => stripHtml(42)).not.toThrow();
    });
});

// ── sanitizeText ─────────────────────────────────────────────────────────────
describe('sanitizeText', () => {
    it('collapses multiple spaces into one', () => {
        expect(sanitizeText('too   many   spaces')).toBe('too many spaces');
    });

    it('collapses newlines and tabs', () => {
        expect(sanitizeText('line1\n\nline2')).toBe('line1 line2');
    });

    it('strips HTML and collapses whitespace', () => {
        expect(sanitizeText('<b>  hello   world  </b>')).toBe('hello world');
    });
});

// ── sanitizeFormData ─────────────────────────────────────────────────────────
describe('sanitizeFormData', () => {
    it('strips HTML from text fields', () => {
        const fd = new FormData();
        fd.append('title', '<script>evil</script>Clean Title');

        const cleaned = sanitizeFormData(fd);
        expect(cleaned.get('title')).not.toContain('<script>');
        expect(cleaned.get('title')).toContain('Clean Title');
    });

    it('preserves File objects without modification', () => {
        const fd = new FormData();
        const file = new File(['data'], 'cover.jpg', { type: 'image/jpeg' });
        fd.append('cover_image', file);

        const cleaned = sanitizeFormData(fd);
        expect(cleaned.get('cover_image')).toBeInstanceOf(File);
    });

    it('handles multiple fields correctly', () => {
        const fd = new FormData();
        fd.append('title', '<b>Title</b>');
        fd.append('author', '<i>Author</i>');

        const cleaned = sanitizeFormData(fd);
        expect(cleaned.get('title')).toBe('Title');
        expect(cleaned.get('author')).toBe('Author');
    });
});
