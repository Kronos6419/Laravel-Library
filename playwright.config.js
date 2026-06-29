import { defineConfig } from '@playwright/test';

export default defineConfig({
    testDir: './tests',
    timeout: 30000,
    retries: 0,
    use: {
        baseURL: 'http://localhost:8000',
        headless: true,
        screenshot: 'only-on-failure',
        video: 'retain-on-failure',
    },
    // Run unit tests and e2e tests separately
    projects: [
        {
            name: 'e2e',
            testMatch: '**/*.spec.js',
        },
    ],
});
