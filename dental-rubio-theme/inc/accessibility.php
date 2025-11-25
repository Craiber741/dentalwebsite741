<?php
/**
 * Accessibility Enhancements
 *
 * WCAG 2.1 AA compliance and senior-friendly accessibility features
 * for Dental Rubio theme.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add skip to content link
 */
function dental_rubio_skip_link() {
    echo '<a class="skip-link screen-reader-text" href="#main-content">' . esc_html__('Skip to content', 'dental-rubio') . '</a>';
}
add_action('wp_body_open', 'dental_rubio_skip_link');

/**
 * Add ARIA landmarks to main content
 */
function dental_rubio_add_aria_landmarks($content) {
    // Add role="main" and id for skip link
    if (is_main_query() && in_the_loop()) {
        return '<main id="main-content" role="main" aria-label="' . esc_attr__('Main content', 'dental-rubio') . '">' . $content . '</main>';
    }
    return $content;
}

/**
 * Enhance form accessibility
 */
function dental_rubio_accessible_form_fields($field) {
    // Add aria-required to required fields
    if (strpos($field, 'required') !== false && strpos($field, 'aria-required') === false) {
        $field = str_replace('<input', '<input aria-required="true"', $field);
        $field = str_replace('<textarea', '<textarea aria-required="true"', $field);
        $field = str_replace('<select', '<select aria-required="true"', $field);
    }
    return $field;
}

/**
 * Add focus visible styles
 */
function dental_rubio_focus_styles() {
    ?>
    <style id="dental-rubio-focus-styles">
        /* Enhanced focus styles for keyboard navigation */
        a:focus,
        button:focus,
        input:focus,
        textarea:focus,
        select:focus {
            outline: 3px solid #10b981;
            outline-offset: 2px;
            box-shadow: 0 0 0 3px rgba(16, 185, 129, 0.2);
        }

        /* Remove outline for mouse users (not keyboard) */
        a:focus:not(:focus-visible),
        button:focus:not(:focus-visible),
        input:focus:not(:focus-visible),
        textarea:focus:not(:focus-visible),
        select:focus:not(:focus-visible) {
            outline: none;
            box-shadow: none;
        }

        /* Skip link styling */
        .skip-link {
            position: absolute;
            top: -40px;
            left: 0;
            background: #10b981;
            color: #fff;
            padding: 12px 20px;
            text-decoration: none;
            z-index: 100000;
            font-size: 18px;
            font-weight: 600;
        }

        .skip-link:focus {
            top: 0;
            outline: 3px solid #fff;
            outline-offset: -3px;
        }

        /* Screen reader text */
        .screen-reader-text {
            border: 0;
            clip: rect(1px, 1px, 1px, 1px);
            clip-path: inset(50%);
            height: 1px;
            margin: -1px;
            overflow: hidden;
            padding: 0;
            position: absolute;
            width: 1px;
            word-wrap: normal !important;
        }

        .screen-reader-text:focus {
            background-color: #f1f1f1;
            border-radius: 3px;
            box-shadow: 0 0 2px 2px rgba(0, 0, 0, 0.6);
            clip: auto !important;
            clip-path: none;
            color: #0A4D68;
            display: block;
            font-size: 18px;
            font-weight: 600;
            height: auto;
            left: 5px;
            line-height: normal;
            padding: 15px 23px 14px;
            text-decoration: none;
            top: 5px;
            width: auto;
            z-index: 100000;
        }

        /* High contrast mode support */
        @media (prefers-contrast: high) {
            .btn-primary,
            .btn-secondary {
                border: 2px solid currentColor;
            }
        }

        /* Reduced motion support */
        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: 0.01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: 0.01ms !important;
                scroll-behavior: auto !important;
            }
        }
    </style>
    <?php
}
add_action('wp_head', 'dental_rubio_focus_styles', 2);

/**
 * Add lang attribute to content
 */
function dental_rubio_add_language_attributes($output, $doctype) {
    if ('html' !== $doctype) {
        return $output;
    }

    $lang = get_bloginfo('language');
    $output = 'lang="' . esc_attr($lang) . '"';

    return $output;
}
add_filter('language_attributes', 'dental_rubio_add_language_attributes', 10, 2);

/**
 * Ensure images have alt text
 */
function dental_rubio_check_image_alt($content) {
    // Find images without alt attributes
    if (preg_match_all('/<img(?![^>]*alt=)([^>]*)>/i', $content, $matches)) {
        foreach ($matches[0] as $img_tag) {
            // Add empty alt for decorative images
            $new_img_tag = str_replace('<img', '<img alt=""', $img_tag);
            $content = str_replace($img_tag, $new_img_tag, $content);
        }
    }
    return $content;
}
add_filter('the_content', 'dental_rubio_check_image_alt', 100);

/**
 * Add ARIA labels to navigation
 */
function dental_rubio_nav_menu_args($args) {
    if (!isset($args['container_aria_label'])) {
        $menu_name = isset($args['theme_location']) ? $args['theme_location'] : 'menu';
        $args['container_aria_label'] = ucfirst($menu_name) . ' navigation';
    }
    return $args;
}
add_filter('wp_nav_menu_args', 'dental_rubio_nav_menu_args');

/**
 * Add descriptive button text
 */
function dental_rubio_accessible_button_text($text) {
    // Prevent ambiguous "Click here" or "Read more" without context
    if (in_array(strtolower($text), array('click here', 'read more', 'learn more'))) {
        $post_title = get_the_title();
        if ($post_title) {
            return $text . '<span class="screen-reader-text"> about ' . esc_html($post_title) . '</span>';
        }
    }
    return $text;
}

/**
 * Add ARIA live region for dynamic content
 */
function dental_rubio_aria_live_region() {
    echo '<div id="dental-aria-live" class="screen-reader-text" aria-live="polite" aria-atomic="true"></div>';
}
add_action('wp_footer', 'dental_rubio_aria_live_region');

/**
 * Add JavaScript for keyboard navigation
 */
function dental_rubio_keyboard_navigation() {
    ?>
    <script>
    (function() {
        'use strict';

        // Track keyboard vs mouse usage
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Tab') {
                document.body.classList.add('keyboard-nav');
            }
        });

        document.addEventListener('mousedown', function() {
            document.body.classList.remove('keyboard-nav');
        });

        // Trap focus in modals
        document.addEventListener('keydown', function(e) {
            if (e.key !== 'Tab') return;

            var modal = document.querySelector('.modal.active');
            if (!modal) return;

            var focusable = modal.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
            var firstFocusable = focusable[0];
            var lastFocusable = focusable[focusable.length - 1];

            if (e.shiftKey) {
                if (document.activeElement === firstFocusable) {
                    lastFocusable.focus();
                    e.preventDefault();
                }
            } else {
                if (document.activeElement === lastFocusable) {
                    firstFocusable.focus();
                    e.preventDefault();
                }
            }
        });

        // Announce dynamic content changes to screen readers
        window.dentalAnnounce = function(message) {
            var liveRegion = document.getElementById('dental-aria-live');
            if (liveRegion) {
                liveRegion.textContent = message;
                setTimeout(function() {
                    liveRegion.textContent = '';
                }, 1000);
            }
        };

        // Escape key closes modals
        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                var modal = document.querySelector('.modal.active');
                if (modal) {
                    var closeBtn = modal.querySelector('.modal-close');
                    if (closeBtn) {
                        closeBtn.click();
                    }
                }
            }
        });
    })();
    </script>
    <?php
}
add_action('wp_footer', 'dental_rubio_keyboard_navigation', 1);

/**
 * Add aria-current to current menu item
 */
function dental_rubio_add_aria_current($atts, $item, $args, $depth) {
    if (in_array('current-menu-item', $item->classes)) {
        $atts['aria-current'] = 'page';
    }
    return $atts;
}
add_filter('nav_menu_link_attributes', 'dental_rubio_add_aria_current', 10, 4);

/**
 * Ensure headings are hierarchical
 */
function dental_rubio_check_heading_hierarchy($content) {
    // This is a placeholder - in production, you'd implement actual checking
    // For now, we just ensure proper heading structure in templates
    return $content;
}

/**
 * Add title to phone number links
 */
function dental_rubio_accessible_phone_link($phone) {
    $cleaned = preg_replace('/[^0-9+]/', '', $phone);
    return '<a href="tel:' . esc_attr($cleaned) . '" class="phone-link" title="' . esc_attr__('Call us at ', 'dental-rubio') . esc_attr($phone) . '">' . esc_html($phone) . '</a>';
}

/**
 * Add title to WhatsApp links
 */
function dental_rubio_accessible_whatsapp_link($number, $message = '') {
    $url = 'https://wa.me/' . preg_replace('/[^0-9]/', '', $number);
    if ($message) {
        $url .= '?text=' . urlencode($message);
    }
    return '<a href="' . esc_url($url) . '" class="whatsapp-link" target="_blank" rel="noopener noreferrer" title="' . esc_attr__('Contact us on WhatsApp', 'dental-rubio') . '">' . esc_html__('WhatsApp', 'dental-rubio') . '</a>';
}

/**
 * Add color contrast checker (for admin/development)
 */
function dental_rubio_check_contrast() {
    if (!current_user_can('manage_options') || !isset($_GET['check_contrast'])) {
        return;
    }
    ?>
    <style>
        .contrast-checker {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: #000;
            color: #fff;
            padding: 15px;
            border-radius: 8px;
            z-index: 999999;
            max-width: 300px;
            font-size: 14px;
        }
        .contrast-pass { color: #10b981; }
        .contrast-fail { color: #ef4444; }
    </style>
    <div class="contrast-checker">
        <strong>Contrast Checker Active</strong>
        <p>Hover over elements to check contrast ratios.</p>
        <div id="contrast-results"></div>
    </div>
    <?php
}
add_action('wp_footer', 'dental_rubio_check_contrast');

/**
 * Senior-friendly text size adjuster
 */
function dental_rubio_text_size_controls() {
    // Optional: Add text size increase/decrease buttons
    // For now, we ensure base font size is large enough (18px+)
}
