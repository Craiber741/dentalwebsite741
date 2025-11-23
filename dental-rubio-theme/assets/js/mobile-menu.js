/**
 * Mobile Menu JavaScript
 *
 * Handle mobile menu toggle and interactions.
 * Optimized for senior users with clear feedback.
 *
 * @package DentalRubio
 */

(function() {
    'use strict';

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initMobileMenu();
    });

    /**
     * Initialize Mobile Menu
     */
    function initMobileMenu() {
        const toggleButton = document.getElementById('mobileMenuToggle');
        const mobileMenu = document.getElementById('mobileMenu');

        if (!toggleButton || !mobileMenu) return;

        // Toggle menu on button click
        toggleButton.addEventListener('click', function() {
            toggleMenu();
        });

        // Close menu on escape key
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape' && isMenuOpen()) {
                closeMenu();
                toggleButton.focus();
            }
        });

        // Close menu when clicking outside
        document.addEventListener('click', function(e) {
            if (isMenuOpen() && !mobileMenu.contains(e.target) && !toggleButton.contains(e.target)) {
                closeMenu();
            }
        });

        // Handle submenu toggles
        const menuItemsWithChildren = mobileMenu.querySelectorAll('.menu-item-has-children > a');
        menuItemsWithChildren.forEach(function(link) {
            // Create toggle button for submenu
            const toggleBtn = document.createElement('button');
            toggleBtn.className = 'submenu-toggle';
            toggleBtn.setAttribute('aria-expanded', 'false');
            toggleBtn.setAttribute('aria-label', 'Toggle submenu');
            toggleBtn.innerHTML = '<span class="toggle-icon">&#9660;</span>';

            // Insert toggle button
            link.parentNode.insertBefore(toggleBtn, link.nextSibling);

            // Toggle submenu on button click
            toggleBtn.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                const isExpanded = this.getAttribute('aria-expanded') === 'true';
                const submenu = this.parentNode.querySelector('.sub-menu');

                if (submenu) {
                    if (isExpanded) {
                        submenu.style.display = 'none';
                        this.setAttribute('aria-expanded', 'false');
                        this.querySelector('.toggle-icon').style.transform = 'rotate(0deg)';
                    } else {
                        submenu.style.display = 'block';
                        this.setAttribute('aria-expanded', 'true');
                        this.querySelector('.toggle-icon').style.transform = 'rotate(180deg)';
                    }
                }
            });
        });

        // Close menu when clicking a link (for same-page navigation)
        const menuLinks = mobileMenu.querySelectorAll('a[href^="#"]');
        menuLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                closeMenu();
            });
        });

        /**
         * Toggle menu state
         */
        function toggleMenu() {
            if (isMenuOpen()) {
                closeMenu();
            } else {
                openMenu();
            }
        }

        /**
         * Open menu
         */
        function openMenu() {
            mobileMenu.classList.remove('hidden');
            mobileMenu.setAttribute('aria-hidden', 'false');
            toggleButton.classList.add('active');
            toggleButton.setAttribute('aria-expanded', 'true');
            document.body.classList.add('mobile-menu-open');

            // Focus first menu item for accessibility
            const firstLink = mobileMenu.querySelector('a');
            if (firstLink) {
                setTimeout(function() {
                    firstLink.focus();
                }, 100);
            }

            // Trap focus within menu
            trapFocus(mobileMenu);
        }

        /**
         * Close menu
         */
        function closeMenu() {
            mobileMenu.classList.add('hidden');
            mobileMenu.setAttribute('aria-hidden', 'true');
            toggleButton.classList.remove('active');
            toggleButton.setAttribute('aria-expanded', 'false');
            document.body.classList.remove('mobile-menu-open');

            // Release focus trap
            releaseFocus();
        }

        /**
         * Check if menu is open
         */
        function isMenuOpen() {
            return !mobileMenu.classList.contains('hidden');
        }
    }

    /**
     * Focus Trap for Accessibility
     */
    let focusTrap = null;

    function trapFocus(element) {
        const focusableElements = element.querySelectorAll(
            'a[href], button, textarea, input[type="text"], input[type="radio"], input[type="checkbox"], select'
        );
        const firstFocusable = focusableElements[0];
        const lastFocusable = focusableElements[focusableElements.length - 1];

        focusTrap = function(e) {
            if (e.key !== 'Tab') return;

            if (e.shiftKey) {
                // Shift + Tab
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else {
                // Tab
                if (document.activeElement === lastFocusable) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        };

        document.addEventListener('keydown', focusTrap);
    }

    function releaseFocus() {
        if (focusTrap) {
            document.removeEventListener('keydown', focusTrap);
            focusTrap = null;
        }
    }

    /**
     * Add mobile menu styles
     */
    const style = document.createElement('style');
    style.textContent = `
        /* Mobile menu open state */
        body.mobile-menu-open {
            overflow: hidden;
        }

        /* Submenu toggle button */
        .submenu-toggle {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            background: transparent;
            border: none;
            cursor: pointer;
            position: absolute;
            right: 0;
            top: 50%;
            transform: translateY(-50%);
        }

        .submenu-toggle .toggle-icon {
            font-size: 12px;
            transition: transform 0.3s ease;
            color: var(--navy, #1e3c72);
        }

        /* Parent menu item positioning */
        .mobile-menu-list .menu-item-has-children {
            position: relative;
        }

        .mobile-menu-list .menu-item-has-children > a {
            padding-right: 60px;
        }

        /* Submenu styles */
        .mobile-menu-list .sub-menu {
            display: none;
            padding: 8px 0;
            margin: 0;
            background-color: #f8f9fa;
            border-radius: 4px;
        }

        .mobile-menu-list .sub-menu .menu-item > a {
            padding: 12px 20px;
            font-size: 16px;
            min-height: 44px;
        }

        /* Menu slide animation */
        .mobile-menu {
            transition: all 0.3s ease;
            max-height: 0;
            overflow: hidden;
        }

        .mobile-menu:not(.hidden) {
            max-height: calc(100vh - 80px);
            overflow-y: auto;
        }
    `;
    document.head.appendChild(style);

})();
