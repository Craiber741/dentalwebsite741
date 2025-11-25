<?php
/**
 * Dental Rubio Group - Theme Functions
 *
 * Senior-friendly dental theme optimized for conversions and performance.
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define constants
define('DENTAL_RUBIO_VERSION', '1.0.0');
define('DENTAL_RUBIO_DIR', get_template_directory());
define('DENTAL_RUBIO_URI', get_template_directory_uri());

/**
 * Theme Setup
 */
function dental_rubio_setup() {
    // Add language support
    load_theme_textdomain('dental-rubio', DENTAL_RUBIO_DIR . '/languages');

    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('html5', array(
        'search-form',
        'comment-form',
        'comment-list',
        'gallery',
        'caption',
        'style',
        'script'
    ));
    add_theme_support('title-tag');
    add_theme_support('custom-logo', array(
        'height'      => 100,
        'width'       => 300,
        'flex-height' => true,
        'flex-width'  => true,
    ));
    add_theme_support('responsive-embeds');
    add_theme_support('align-wide');
    add_theme_support('editor-styles');
    add_theme_support('wp-block-styles');

    // Custom image sizes for dental services
    add_image_size('service-thumbnail', 400, 300, true);
    add_image_size('testimonial-avatar', 100, 100, true);
    add_image_size('hero-image', 1200, 600, true);

    // Register navigation menus
    register_nav_menus(array(
        'primary' => __('Primary Menu', 'dental-rubio'),
        'footer'  => __('Footer Menu', 'dental-rubio'),
        'mobile'  => __('Mobile Menu', 'dental-rubio'),
    ));

    // Set content width
    if (!isset($content_width)) {
        $content_width = 1200;
    }
}
add_action('after_setup_theme', 'dental_rubio_setup');

/**
 * Load Theme Includes
 */
$dental_rubio_includes = array(
    '/inc/theme-setup.php',              // Additional theme setup
    '/inc/enqueue-scripts.php',          // Scripts and styles
    '/inc/performance-optimizations.php', // Performance optimizations
    '/inc/design-system.php',            // Design system helpers
    '/inc/service-meta.php',             // Service custom fields and helpers
    '/inc/hub-functions.php',            // Hub page functions and meta boxes
    '/inc/integrations/whatsapp-widget.php', // WhatsApp floating widget
    '/inc/integrations/contact-handler.php', // Contact form handler
    '/inc/tracking/google-tag-manager.php',  // Google Tag Manager integration
    '/inc/tracking/facebook-pixel.php',      // Facebook Pixel tracking
    '/inc/seo/schema-markup.php',            // Schema.org structured data
    '/inc/seo/seo-optimization.php',         // SEO meta tags and optimization
    '/inc/accessibility.php',                // WCAG 2.1 AA accessibility features
);

foreach ($dental_rubio_includes as $file) {
    $filepath = DENTAL_RUBIO_DIR . $file;
    if (file_exists($filepath)) {
        require_once $filepath;
    }
}

/**
 * Register Sidebars/Widget Areas
 */
function dental_rubio_widgets_init() {
    register_sidebar(array(
        'name'          => __('Footer Widget Area 1', 'dental-rubio'),
        'id'            => 'footer-1',
        'description'   => __('Add widgets here to appear in footer column 1.', 'dental-rubio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title font-bold mb-4">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Footer Widget Area 2', 'dental-rubio'),
        'id'            => 'footer-2',
        'description'   => __('Add widgets here to appear in footer column 2.', 'dental-rubio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title font-bold mb-4">',
        'after_title'   => '</h4>',
    ));

    register_sidebar(array(
        'name'          => __('Blog Sidebar', 'dental-rubio'),
        'id'            => 'blog-sidebar',
        'description'   => __('Add widgets here to appear in blog sidebar.', 'dental-rubio'),
        'before_widget' => '<div id="%1$s" class="widget %2$s mb-8">',
        'after_widget'  => '</div>',
        'before_title'  => '<h4 class="widget-title text-xl font-bold mb-4">',
        'after_title'   => '</h4>',
    ));
}
add_action('widgets_init', 'dental_rubio_widgets_init');

/**
 * Custom excerpt length for seniors (shorter, clearer)
 */
function dental_rubio_excerpt_length($length) {
    return 30;
}
add_filter('excerpt_length', 'dental_rubio_excerpt_length');

/**
 * Custom excerpt more text
 */
function dental_rubio_excerpt_more($more) {
    return '...';
}
add_filter('excerpt_more', 'dental_rubio_excerpt_more');

/**
 * Add custom body classes
 */
function dental_rubio_body_classes($classes) {
    // Add class for sticky header support
    $classes[] = 'has-sticky-header';

    // Add class for senior-friendly mode
    $classes[] = 'senior-friendly';

    // Add page-specific classes
    if (is_front_page()) {
        $classes[] = 'front-page';
    }

    if (is_page_template('page-templates/template-service.php')) {
        $classes[] = 'service-page';
    }

    return $classes;
}
add_filter('body_class', 'dental_rubio_body_classes');

/**
 * Phone number formatter helper
 */
function dental_rubio_format_phone($phone) {
    // Remove non-numeric characters
    $phone = preg_replace('/[^0-9]/', '', $phone);

    // Format as (XXX) XXX-XXXX
    if (strlen($phone) === 10) {
        return '(' . substr($phone, 0, 3) . ') ' . substr($phone, 3, 3) . '-' . substr($phone, 6);
    } elseif (strlen($phone) === 11 && $phone[0] === '1') {
        return '(' . substr($phone, 1, 3) . ') ' . substr($phone, 4, 3) . '-' . substr($phone, 7);
    }

    return $phone;
}

/**
 * Get theme phone number
 */
function dental_rubio_get_phone() {
    return get_theme_mod('dental_rubio_phone', '(928) XXX-XXXX');
}

/**
 * Get theme WhatsApp number
 */
function dental_rubio_get_whatsapp() {
    return get_theme_mod('dental_rubio_whatsapp', '52XXXXXXXXXX');
}
