/**
 * Theme Switcher - External Script (CSP-safe)
 * Handles Light/Dark mode toggle and persistence via localStorage
 */
(function () {
    var saved = 'dark';

    try {
        saved = localStorage.getItem('esTheme') || 'dark';
    } catch (error) {
        saved = 'dark';
    }

    if (saved !== 'light' && saved !== 'dark') {
        saved = 'dark';
    }

    document.documentElement.setAttribute('data-theme', saved);
})();

document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('theme-switch');
    var icon = document.getElementById('theme-icon');
    if (!btn || !icon) return;

    syncIcon(document.documentElement.getAttribute('data-theme') || 'dark');

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var current = document.documentElement.getAttribute('data-theme');
        var next = current === 'dark' ? 'light' : 'dark';

        document.documentElement.setAttribute('data-theme', next);

        try {
            localStorage.setItem('esTheme', next);
        } catch (error) {
            // Theme still changes for this page even if storage is unavailable.
        }

        syncIcon(next);
    });

    function syncIcon(theme) {
        btn.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        btn.setAttribute('title', theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme');

        if (theme === 'dark') {
            icon.className = 'fas fa-sun';
        } else {
            icon.className = 'fas fa-moon';
        }
    }
});
