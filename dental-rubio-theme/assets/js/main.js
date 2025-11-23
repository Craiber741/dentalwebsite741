/**
 * Main JavaScript
 *
 * Core functionality for Dental Rubio theme.
 *
 * @package DentalRubio
 */

(function() {
    'use strict';

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initSmoothScroll();
        initStickyHeader();
        initPhoneTracking();
        initAccessibility();
    });

    /**
     * Smooth scroll for anchor links
     */
    function initSmoothScroll() {
        const links = document.querySelectorAll('a[href^="#"]');

        links.forEach(function(link) {
            link.addEventListener('click', function(e) {
                const href = this.getAttribute('href');

                // Skip if it's just "#"
                if (href === '#') return;

                const target = document.querySelector(href);

                if (target) {
                    e.preventDefault();

                    // Get header height for offset
                    const header = document.querySelector('.site-header');
                    const headerHeight = header ? header.offsetHeight : 0;

                    // Calculate position
                    const targetPosition = target.getBoundingClientRect().top + window.pageYOffset - headerHeight - 20;

                    // Smooth scroll
                    window.scrollTo({
                        top: targetPosition,
                        behavior: 'smooth'
                    });

                    // Update URL without scrolling
                    history.pushState(null, null, href);

                    // Focus management for accessibility
                    target.setAttribute('tabindex', '-1');
                    target.focus();
                }
            });
        });
    }

    /**
     * Sticky header behavior
     */
    function initStickyHeader() {
        const header = document.querySelector('.site-header');

        if (!header) return;

        let lastScrollTop = 0;
        const scrollThreshold = 100;

        window.addEventListener('scroll', function() {
            const scrollTop = window.pageYOffset || document.documentElement.scrollTop;

            // Add shadow on scroll
            if (scrollTop > 10) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }

            // Hide/show header on scroll (optional - disabled by default for seniors)
            // Uncomment to enable hide on scroll down
            /*
            if (scrollTop > lastScrollTop && scrollTop > scrollThreshold) {
                // Scroll down
                header.classList.add('header-hidden');
            } else {
                // Scroll up
                header.classList.remove('header-hidden');
            }
            */

            lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
        }, { passive: true });
    }

    /**
     * Phone click tracking
     */
    function initPhoneTracking() {
        const phoneLinks = document.querySelectorAll('a[href^="tel:"]');

        phoneLinks.forEach(function(link) {
            link.addEventListener('click', function() {
                // Track phone click event
                if (typeof gtag === 'function') {
                    gtag('event', 'phone_call', {
                        'event_category': 'Contact',
                        'event_label': this.getAttribute('href'),
                        'value': 1
                    });
                }

                // Facebook Pixel tracking
                if (typeof fbq === 'function') {
                    fbq('track', 'Contact', {
                        content_name: 'Phone Call',
                        content_category: 'Contact'
                    });
                }

                // Custom event for other tracking
                window.dispatchEvent(new CustomEvent('dentalRubio:phoneClick', {
                    detail: { phone: this.getAttribute('href') }
                }));
            });
        });
    }

    /**
     * Accessibility enhancements
     */
    function initAccessibility() {
        // Add aria-current to current page link
        const currentPath = window.location.pathname;
        const menuLinks = document.querySelectorAll('.nav-menu a, .mobile-menu-list a');

        menuLinks.forEach(function(link) {
            const linkPath = new URL(link.href).pathname;
            if (linkPath === currentPath) {
                link.setAttribute('aria-current', 'page');
                link.closest('.menu-item')?.classList.add('current-menu-item');
            }
        });

        // Ensure all interactive elements are focusable
        const interactiveElements = document.querySelectorAll('button, [role="button"]');
        interactiveElements.forEach(function(el) {
            if (!el.hasAttribute('tabindex')) {
                el.setAttribute('tabindex', '0');
            }
        });

        // Handle Enter key on role="button" elements
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Enter' && e.target.getAttribute('role') === 'button') {
                e.target.click();
            }
        });
    }

    /**
     * Utility: Format phone number
     */
    window.dentalRubioFormatPhone = function(phone) {
        const cleaned = phone.replace(/\D/g, '');
        if (cleaned.length === 10) {
            return '(' + cleaned.slice(0, 3) + ') ' + cleaned.slice(3, 6) + '-' + cleaned.slice(6);
        }
        return phone;
    };

    /**
     * Utility: Scroll to element
     */
    window.dentalRubioScrollTo = function(selector, offset) {
        const element = document.querySelector(selector);
        if (!element) return;

        offset = offset || 0;
        const header = document.querySelector('.site-header');
        const headerHeight = header ? header.offsetHeight : 0;

        const targetPosition = element.getBoundingClientRect().top + window.pageYOffset - headerHeight - offset;

        window.scrollTo({
            top: targetPosition,
            behavior: 'smooth'
        });
    };

    /**
     * Utility: Show notification/toast
     */
    window.dentalRubioNotify = function(message, type) {
        type = type || 'info';

        // Create notification element
        const notification = document.createElement('div');
        notification.className = 'dr-notification dr-notification-' + type;
        notification.setAttribute('role', 'alert');
        notification.innerHTML = '<p>' + message + '</p>';

        // Add styles
        notification.style.cssText = `
            position: fixed;
            bottom: 100px;
            left: 50%;
            transform: translateX(-50%);
            padding: 16px 24px;
            background-color: ${type === 'success' ? '#27ae60' : type === 'error' ? '#e74c3c' : '#1e3c72'};
            color: white;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            z-index: 9999;
            font-size: 18px;
            max-width: 90%;
            text-align: center;
            animation: slideUp 0.3s ease-out;
        `;

        document.body.appendChild(notification);

        // Auto remove after 5 seconds
        setTimeout(function() {
            notification.style.animation = 'fadeOut 0.3s ease-out';
            setTimeout(function() {
                notification.remove();
            }, 300);
        }, 5000);
    };

    /**
     * Add animation keyframes
     */
    const style = document.createElement('style');
    style.textContent = `
        @keyframes slideUp {
            from { transform: translateX(-50%) translateY(20px); opacity: 0; }
            to { transform: translateX(-50%) translateY(0); opacity: 1; }
        }
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; }
        }
        .site-header.scrolled {
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .site-header.header-hidden {
            transform: translateY(-100%);
            transition: transform 0.3s ease;
        }
    `;
    document.head.appendChild(style);

})();
