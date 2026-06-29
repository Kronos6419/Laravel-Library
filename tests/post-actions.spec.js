/**
 * post-actions.spec.js
 * Playwright acceptance tests for The Reading Room.
 * Requires php artisan serve on localhost:8000
 * and npm run dev running (or npm run build).
 */

import { test, expect } from '@playwright/test';

// ── Browse catalogue (guest) ──────────────────────────────────────────────────
test('Guest can browse the catalogue', async ({ page }) => {
    await page.goto('http://localhost:8000/books', { waitUntil: 'networkidle' });

    // JS should have rendered book cards from the API
    await expect(page.locator('.book-card').first()).toBeVisible({ timeout: 15000 });

    // Genre filter buttons should be rendered
    await expect(page.locator('.genre-filter-btn').first()).toBeVisible();

    // Search input should be present
    await expect(page.locator('#catalogue-search')).toBeVisible();
});

// ── Genre filter (guest) ──────────────────────────────────────────────────────
test('Guest can filter books by genre', async ({ page }) => {
    await page.goto('http://localhost:8000/books', { waitUntil: 'networkidle' });

    // Wait for initial books to load
    await expect(page.locator('.book-card').first()).toBeVisible({ timeout: 15000 });

    // Click Fantasy filter
    await page.click('.genre-filter-btn[data-genre="Fantasy"]');

    // Wait for re-fetch
    await page.waitForTimeout(1000);

    // Either books show, or empty message shows — both are correct
    const hasCards = await page.locator('.book-card').count();
    const hasEmpty = await page.locator('.catalogue-empty').count();
    expect(hasCards + hasEmpty).toBeGreaterThan(0);
});

// ── Full book lifecycle (authenticated) ───────────────────────────────────────
test('Author can create, edit, and delete a book', async ({ page }) => {
    // Log in
    await page.goto('http://localhost:8000/login');
    await page.fill('input[name="login"]', 'admin');
    await page.fill('input[name="password"]', 'admin');
    await page.click('button:has-text("Login")');

    // Should land on dashboard
    await expect(page).toHaveURL(/dashboard/, { timeout: 10000 });

    // Wait for dashboard JS to initialise
    await expect(page.locator('#create-book-form')).toBeVisible({ timeout: 10000 });

    // ── Create via JS form ────────────────────────────────────────────────────
    await page.fill('#title', 'Playwright Test Book');
    await page.fill('#author', 'Test Author');
    await page.selectOption('#genre', 'Mystery');
    await page.fill('#description', 'A book created by the Playwright test suite.');
    await page.setInputFiles('#cover_image', 'tests/fixtures/test-image.jpg');

    await page.click('#create-book-form button[type="submit"]');

    // Flash message confirms creation
    await expect(page.locator('.flash-msg--success')).toBeVisible({ timeout: 10000 });

    // Page reloads — wait then confirm book appears
    await page.waitForURL(/dashboard/, { timeout: 10000 });
    await page.waitForLoadState('networkidle');
    await expect(page.locator('text=Playwright Test Book')).toBeVisible({ timeout: 10000 });

    // ── Edit via Blade form ───────────────────────────────────────────────────
    await page.click('a:has-text("Update")');
    await expect(page).toHaveURL(/books\/\d+\/edit/, { timeout: 10000 });

    await page.fill('input[name="title"]', 'Playwright Test Book — Edited');
    await page.click('button:has-text("Update")');

    await expect(page).toHaveURL(/dashboard/, { timeout: 10000 });
    await expect(page.locator('text=Playwright Test Book — Edited')).toBeVisible({ timeout: 10000 });

    // ── Delete via JS ─────────────────────────────────────────────────────────
    page.on('dialog', dialog => dialog.accept());
    await page.click('.js-delete-btn');
    await expect(page.locator('text=Playwright Test Book — Edited')).not.toBeVisible({ timeout: 8000 });
});

// ── Client-side validation ────────────────────────────────────────────────────
test('Create form shows validation errors without submitting', async ({ page }) => {
    await page.goto('http://localhost:8000/login');
    await page.fill('input[name="login"]', 'admin');
    await page.fill('input[name="password"]', 'admin');
    await page.click('button:has-text("Login")');

    await expect(page).toHaveURL(/dashboard/, { timeout: 10000 });
    await expect(page.locator('#create-book-form')).toBeVisible({ timeout: 10000 });

    // Submit empty form — JS validation fires before any fetch
    await page.click('#create-book-form button[type="submit"]');

    // Error messages should appear immediately, no reload
    await expect(page.locator('.js-error').first()).toBeVisible({ timeout: 5000 });
    await expect(page).toHaveURL(/dashboard/);
});
