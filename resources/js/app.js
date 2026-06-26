import './bootstrap';

/**
 * Conditionally load page-specific JS modules based on a
 * data attribute on the body tag, keeping bundles lean.
 */
const page = document.body.dataset.page;

if (page === 'catalogue') {
    import('./catalogue.js');
}

if (page === 'dashboard') {
    import('./dashboard.js');
}
