import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';
import tailwindcss from '@tailwindcss/vite';

export default defineConfig({
    plugins: [
        laravel({
            input: ['resources/css/app.css', 'resources/scss/main.scss', 'resources/js/app.js'],
            refresh: true,
        }),
        tailwindcss(),
    ],
    server: {
        watch: {
            ignored: ['**/storage/framework/views/**'],
        },
    },
    // Vitest configuration — runs unit tests without a browser
    test: {
        environment: 'jsdom',        // jsdom for all tests, needed by sanitize.js DOM usage
        include: ['tests/unit/**/*.test.js'],
        coverage: {
            reporter: ['text'],
        },
    },
});
