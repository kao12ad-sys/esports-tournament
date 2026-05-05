/**
 * Theme switcher for SmartUniversity template layouts.
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
    window.SmartConfig = window.SmartConfig || {};
    window.SmartConfig.theme = saved;
    window.SmartConfig.direction = window.SmartConfig.direction || 'ltr';
    window.SmartConfig.headerColor = saved === 'dark' ? 'header-dark' : 'header-white';
    window.SmartConfig.logoColor = saved === 'dark' ? 'logo-dark' : 'logo-white';
    window.SmartConfig.sidebarColor = saved === 'dark' ? 'dark-sidebar-color' : 'white-sidebar-color';
})();

document.addEventListener('DOMContentLoaded', function () {
    var btn = document.getElementById('theme-switch');
    var icon = document.getElementById('theme-icon');
    var currentTheme = document.documentElement.getAttribute('data-theme') || 'dark';

    applyTheme(currentTheme);
    syncIcon(currentTheme);

    if (!btn || !icon) return;

    btn.addEventListener('click', function (e) {
        e.preventDefault();
        var current = document.documentElement.getAttribute('data-theme');
        var next = current === 'dark' ? 'light' : 'dark';

        applyTheme(next);

        try {
            localStorage.setItem('esTheme', next);
        } catch (error) {
            // Theme still changes for this page even if storage is unavailable.
        }

        syncIcon(next);
    });

    function applyTheme(theme) {
        var body = document.body;
        var dark = theme === 'dark';

        document.documentElement.setAttribute('data-theme', theme);

        if (body) {
            body.classList.toggle('dark-theme', dark);
            body.classList.toggle('header-dark', dark);
            body.classList.toggle('logo-dark', dark);
            body.classList.toggle('dark-sidebar-color', dark);
            body.classList.toggle('header-white', !dark);
            body.classList.toggle('logo-white', !dark);
            body.classList.toggle('white-sidebar-color', !dark);
            body.classList.remove('header-blue', 'header-indigo', 'header-red', 'header-cyan', 'header-green');
            body.classList.remove('logo-blue', 'logo-indigo', 'logo-red', 'logo-cyan', 'logo-green');
            body.classList.remove('blue-sidebar-color', 'indigo-sidebar-color', 'red-sidebar-color', 'cyan-sidebar-color', 'green-sidebar-color');
        }

        window.SmartConfig = window.SmartConfig || {};
        window.SmartConfig.theme = theme;
        window.SmartConfig.direction = window.SmartConfig.direction || 'ltr';
        window.SmartConfig.headerColor = dark ? 'header-dark' : 'header-white';
        window.SmartConfig.logoColor = dark ? 'logo-dark' : 'logo-white';
        window.SmartConfig.sidebarColor = dark ? 'dark-sidebar-color' : 'white-sidebar-color';

        if (window.ThemeStorage && typeof window.ThemeStorage.saveConfig === 'function') {
            window.ThemeStorage.saveConfig();
        }
    }

    function syncIcon(theme) {
        if (!btn || !icon) return;

        btn.setAttribute('aria-pressed', theme === 'light' ? 'true' : 'false');
        btn.setAttribute('title', theme === 'dark' ? 'Switch to light theme' : 'Switch to dark theme');

        if (theme === 'dark') {
            icon.className = 'fas fa-sun';
        } else {
            icon.className = 'fas fa-moon';
        }
    }
});
