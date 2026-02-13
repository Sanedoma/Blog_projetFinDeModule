// Dark Mode Toggle for macOS-style Dark Glass
(function() {
    'use strict';

    const DARK_MODE_KEY = 'blog-dark-mode';
    
    // Initialize dark mode from localStorage or system preference
    function initDarkMode() {
        const savedMode = localStorage.getItem(DARK_MODE_KEY);
        const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
        
        const shouldBeDark = savedMode !== null ? savedMode === 'true' : prefersDark;
        
        if (shouldBeDark) {
            enableDarkMode();
        } else {
            disableDarkMode();
        }
    }

    function enableDarkMode() {
        document.documentElement.classList.add('dark-mode');
        document.documentElement.classList.remove('light-mode');
        localStorage.setItem(DARK_MODE_KEY, 'true');
        updateToggleButton();
    }

    function disableDarkMode() {
        document.documentElement.classList.remove('dark-mode');
        document.documentElement.classList.add('light-mode');
        localStorage.setItem(DARK_MODE_KEY, 'false');
        updateToggleButton();
    }

    function toggleDarkMode() {
        if (document.documentElement.classList.contains('dark-mode')) {
            disableDarkMode();
        } else {
            enableDarkMode();
        }
    }

    function updateToggleButton() {
        const btn = document.querySelector('.dark-mode-toggle');
        if (btn) {
            const isDark = document.documentElement.classList.contains('dark-mode');
            btn.innerHTML = isDark ? '<i class="fas fa-sun"></i>' : '<i class="fas fa-moon"></i>';
            btn.setAttribute('title', isDark ? 'Mode clair' : 'Mode sombre');
        }
    }

    // Create and inject toggle button
    function createToggleButton() {
        if (document.querySelector('.dark-mode-toggle')) return; // Already exists
        
        const btn = document.createElement('button');
        btn.className = 'dark-mode-toggle';
        btn.setAttribute('type', 'button');
        btn.setAttribute('aria-label', 'Basculer le mode sombre');
        btn.innerHTML = '<i class="fas fa-moon"></i>';
        btn.addEventListener('click', toggleDarkMode);
        
        document.body.appendChild(btn);
        updateToggleButton();
    }

    // Listen for system theme changes
    function setupSystemThemeListener() {
        window.matchMedia('(prefers-color-scheme: dark)').addEventListener('change', (e) => {
            if (localStorage.getItem(DARK_MODE_KEY) === null) {
                if (e.matches) {
                    enableDarkMode();
                } else {
                    disableDarkMode();
                }
            }
        });
    }

    // Initialize when DOM is ready
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', function() {
            initDarkMode();
            createToggleButton();
            setupSystemThemeListener();
        });
    } else {
        initDarkMode();
        createToggleButton();
        setupSystemThemeListener();
    }

    // Expose methods globally for manual control if needed
    window.darkMode = {
        enable: enableDarkMode,
        disable: disableDarkMode,
        toggle: toggleDarkMode
    };
})();
