<?php
/**
 * Enqueue Scripts and Styles
 *
 * Optimized loading of CSS and JavaScript for Dental Rubio theme.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Enqueue frontend scripts and styles
 */
function dental_rubio_enqueue_scripts() {
    // Google Fonts - Inter (optimized loading)
    wp_enqueue_style(
        'dental-rubio-google-fonts',
        'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap',
        array(),
        null
    );

    // Main stylesheet
    wp_enqueue_style(
        'dental-rubio-style',
        get_stylesheet_uri(),
        array('dental-rubio-google-fonts'),
        DENTAL_RUBIO_VERSION
    );

    // Base CSS (variables and resets)
    wp_enqueue_style(
        'dental-rubio-base',
        DENTAL_RUBIO_URI . '/assets/css/base.css',
        array('dental-rubio-style'),
        DENTAL_RUBIO_VERSION
    );

    // Components CSS
    wp_enqueue_style(
        'dental-rubio-components',
        DENTAL_RUBIO_URI . '/assets/css/components.css',
        array('dental-rubio-base'),
        DENTAL_RUBIO_VERSION
    );

    // Utilities CSS
    wp_enqueue_style(
        'dental-rubio-utilities',
        DENTAL_RUBIO_URI . '/assets/css/utilities.css',
        array('dental-rubio-components'),
        DENTAL_RUBIO_VERSION
    );

    // Tailwind CDN (for development - replace with compiled CSS in production)
    wp_enqueue_script(
        'tailwindcss',
        'https://cdn.tailwindcss.com',
        array(),
        null,
        false
    );

    // Add Tailwind config inline
    wp_add_inline_script('tailwindcss', '
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        "navy": "#1e3c72",
                        "navy-dark": "#0f1f3d",
                        "navy-light": "#3d5a99",
                        "gold": "#c9a961",
                        "gold-dark": "#8b7a4f",
                    },
                    fontFamily: {
                        "sans": ["Inter", "-apple-system", "BlinkMacSystemFont", "Segoe UI", "Roboto", "sans-serif"],
                    },
                    fontSize: {
                        "xs": ["16px", { lineHeight: "1.6" }],
                        "sm": ["18px", { lineHeight: "1.6" }],
                        "base": ["20px", { lineHeight: "1.6" }],
                        "lg": ["24px", { lineHeight: "1.5" }],
                        "xl": ["28px", { lineHeight: "1.4" }],
                        "2xl": ["32px", { lineHeight: "1.3" }],
                        "3xl": ["40px", { lineHeight: "1.2" }],
                        "4xl": ["48px", { lineHeight: "1.2" }],
                        "5xl": ["56px", { lineHeight: "1.1" }],
                    },
                }
            }
        }
    ');

    // Main JavaScript (deferred for performance)
    wp_enqueue_script(
        'dental-rubio-main',
        DENTAL_RUBIO_URI . '/assets/js/main.js',
        array(),
        DENTAL_RUBIO_VERSION,
        true
    );

    // Mobile Menu JavaScript
    wp_enqueue_script(
        'dental-rubio-mobile-menu',
        DENTAL_RUBIO_URI . '/assets/js/mobile-menu.js',
        array('dental-rubio-main'),
        DENTAL_RUBIO_VERSION,
        true
    );

    // Calculator JavaScript (only on pages that need it)
    if (is_front_page() || is_page_template('page-templates/template-service.php')) {
        wp_enqueue_script(
            'dental-rubio-calculator',
            DENTAL_RUBIO_URI . '/assets/js/calculator-engine.js',
            array('dental-rubio-main'),
            DENTAL_RUBIO_VERSION,
            true
        );
    }

    // Localize script for AJAX and translations
    wp_localize_script('dental-rubio-main', 'dentalRubio', array(
        'ajaxUrl'   => admin_url('admin-ajax.php'),
        'nonce'     => wp_create_nonce('dental-rubio-nonce'),
        'homeUrl'   => home_url(),
        'themeUrl'  => DENTAL_RUBIO_URI,
        'phone'     => dental_rubio_get_phone(),
        'whatsapp'  => dental_rubio_get_whatsapp(),
        'i18n'      => array(
            'loading'    => __('Loading...', 'dental-rubio'),
            'error'      => __('An error occurred. Please try again.', 'dental-rubio'),
            'success'    => __('Success!', 'dental-rubio'),
            'callNow'    => __('Call Now', 'dental-rubio'),
            'chatNow'    => __('Chat Now', 'dental-rubio'),
        ),
    ));

    // Comment reply script (only when needed)
    if (is_singular() && comments_open() && get_option('thread_comments')) {
        wp_enqueue_script('comment-reply');
    }
}
add_action('wp_enqueue_scripts', 'dental_rubio_enqueue_scripts');

/**
 * Add defer attribute to specific scripts
 */
function dental_rubio_defer_scripts($tag, $handle, $src) {
    $defer_scripts = array(
        'dental-rubio-main',
        'dental-rubio-mobile-menu',
        'dental-rubio-calculator',
    );

    if (in_array($handle, $defer_scripts)) {
        return '<script src="' . esc_url($src) . '" defer></script>' . "\n";
    }

    return $tag;
}
add_filter('script_loader_tag', 'dental_rubio_defer_scripts', 10, 3);

/**
 * Add preload for critical assets
 */
function dental_rubio_preload_assets() {
    ?>
    <!-- Preload critical fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Preload critical CSS -->
    <link rel="preload" href="<?php echo esc_url(DENTAL_RUBIO_URI . '/assets/css/base.css'); ?>" as="style">

    <!-- DNS prefetch for external resources -->
    <link rel="dns-prefetch" href="//www.googletagmanager.com">
    <link rel="dns-prefetch" href="//www.google-analytics.com">
    <link rel="dns-prefetch" href="//connect.facebook.net">
    <?php
}
add_action('wp_head', 'dental_rubio_preload_assets', 1);

/**
 * Dequeue unnecessary WordPress default scripts
 */
function dental_rubio_dequeue_scripts() {
    // Remove jQuery Migrate (not needed for modern jQuery usage)
    if (!is_admin()) {
        wp_deregister_script('jquery-migrate');
    }

    // Remove wp-embed script
    wp_deregister_script('wp-embed');
}
add_action('wp_enqueue_scripts', 'dental_rubio_dequeue_scripts', 100);

/**
 * Remove Gutenberg block library CSS (if not using blocks on frontend)
 */
function dental_rubio_remove_block_library() {
    // Uncomment if you're not using Gutenberg blocks on the frontend
    // wp_dequeue_style('wp-block-library');
    // wp_dequeue_style('wp-block-library-theme');
    // wp_dequeue_style('wc-blocks-style'); // WooCommerce blocks
}
add_action('wp_enqueue_scripts', 'dental_rubio_remove_block_library', 100);

/**
 * Add critical CSS inline in head
 */
function dental_rubio_critical_css() {
    ?>
    <style id="dental-rubio-critical-css">
        /* Critical CSS for above-the-fold content */
        *{margin:0;padding:0;box-sizing:border-box}
        html{font-size:20px;line-height:1.6;scroll-behavior:smooth}
        body{font-family:'Inter',-apple-system,BlinkMacSystemFont,'Segoe UI',sans-serif;color:#2c3e50;background:#fff}
        .site-header{position:sticky;top:0;z-index:50;background:#fff;box-shadow:0 1px 3px rgba(0,0,0,0.1)}
        .container{width:100%;max-width:1280px;margin:0 auto;padding:0 20px}
        .btn{display:inline-flex;align-items:center;justify-content:center;padding:15px 40px;font-size:18px;font-weight:600;text-decoration:none;border-radius:4px;transition:all 0.3s ease;cursor:pointer;border:none;min-height:60px}
        .btn-primary{background:#1e3c72;color:#fff}
        .btn-primary:hover{background:#0f1f3d;transform:translateY(-2px)}
        .btn-gold{background:#c9a961;color:#1e3c72}
        @media(max-width:768px){html{font-size:18px}.btn{padding:12px 24px;min-height:50px}}
    </style>
    <?php
}
add_action('wp_head', 'dental_rubio_critical_css', 2);

/**
 * Admin enqueue scripts
 */
function dental_rubio_admin_scripts($hook) {
    // Only load on theme-specific admin pages
    if (strpos($hook, 'dental-rubio') === false) {
        return;
    }

    wp_enqueue_style(
        'dental-rubio-admin',
        DENTAL_RUBIO_URI . '/assets/css/admin.css',
        array(),
        DENTAL_RUBIO_VERSION
    );
}
add_action('admin_enqueue_scripts', 'dental_rubio_admin_scripts');
