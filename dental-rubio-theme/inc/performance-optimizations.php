<?php
/**
 * Performance Optimizations
 *
 * Speed and performance optimizations for Dental Rubio theme.
 * Target: PageSpeed 85+, Core Web Vitals PASS
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Disable WordPress heartbeat on frontend
 * Reduces server load and improves performance for non-admin pages
 */
function dental_rubio_disable_heartbeat() {
    if (!is_admin()) {
        wp_deregister_script('heartbeat');
    }
}
add_action('init', 'dental_rubio_disable_heartbeat', 1);

/**
 * Limit post revisions
 * Reduces database bloat
 */
if (!defined('WP_POST_REVISIONS')) {
    define('WP_POST_REVISIONS', 5);
}

/**
 * Disable self-pingbacks
 */
function dental_rubio_disable_self_pingback(&$links) {
    $home = get_option('home');
    foreach ($links as $l => $link) {
        if (strpos($link, $home) === 0) {
            unset($links[$l]);
        }
    }
}
add_action('pre_ping', 'dental_rubio_disable_self_pingback');

/**
 * Remove query strings from static resources
 * Improves caching
 */
function dental_rubio_remove_query_strings($src) {
    if (strpos($src, '?ver=')) {
        $src = remove_query_arg('ver', $src);
    }
    return $src;
}
add_filter('style_loader_src', 'dental_rubio_remove_query_strings', 10, 2);
add_filter('script_loader_src', 'dental_rubio_remove_query_strings', 10, 2);

/**
 * Add lazy loading to images
 */
function dental_rubio_add_lazy_loading($content) {
    // Don't process if already has loading attribute
    if (strpos($content, 'loading=') !== false) {
        return $content;
    }

    // Add loading="lazy" to images
    $content = preg_replace(
        '/<img(?![^>]*loading=)([^>]*)>/i',
        '<img loading="lazy"$1>',
        $content
    );

    return $content;
}
add_filter('the_content', 'dental_rubio_add_lazy_loading', 99);

/**
 * Add decoding="async" to images
 */
function dental_rubio_async_image_decode($attr, $attachment, $size) {
    $attr['decoding'] = 'async';
    return $attr;
}
add_filter('wp_get_attachment_image_attributes', 'dental_rubio_async_image_decode', 10, 3);

/**
 * Preload LCP (Largest Contentful Paint) image
 */
function dental_rubio_preload_lcp_image() {
    if (is_front_page()) {
        // Preload hero image if exists
        $hero_image_id = get_theme_mod('dental_rubio_hero_image');
        if ($hero_image_id) {
            $hero_image = wp_get_attachment_image_src($hero_image_id, 'hero-image');
            if ($hero_image) {
                echo '<link rel="preload" as="image" href="' . esc_url($hero_image[0]) . '">' . "\n";
            }
        }
    }
}
add_action('wp_head', 'dental_rubio_preload_lcp_image', 1);

/**
 * Optimize database queries on homepage
 */
function dental_rubio_optimize_homepage_query($query) {
    if ($query->is_home() && $query->is_main_query()) {
        // Reduce posts per page on homepage if using blog
        $query->set('posts_per_page', 6);

        // Don't fetch post content initially
        $query->set('no_found_rows', true);
    }
    return $query;
}
add_action('pre_get_posts', 'dental_rubio_optimize_homepage_query');

/**
 * Disable feeds (if not using blog features)
 */
// function dental_rubio_disable_feeds() {
//     wp_redirect(home_url());
//     exit;
// }
// add_action('do_feed', 'dental_rubio_disable_feeds', 1);
// add_action('do_feed_rdf', 'dental_rubio_disable_feeds', 1);
// add_action('do_feed_rss', 'dental_rubio_disable_feeds', 1);
// add_action('do_feed_rss2', 'dental_rubio_disable_feeds', 1);
// add_action('do_feed_atom', 'dental_rubio_disable_feeds', 1);

/**
 * Add fetchpriority to images
 */
function dental_rubio_add_fetchpriority($content) {
    // Add fetchpriority="high" to first image (likely LCP)
    $content = preg_replace(
        '/<img([^>]*)>/i',
        '<img fetchpriority="high"$1>',
        $content,
        1 // Only first image
    );

    return $content;
}
add_filter('the_content', 'dental_rubio_add_fetchpriority', 98);

/**
 * Optimize WP_Query for performance
 */
function dental_rubio_optimize_queries($query) {
    if (!is_admin() && !$query->is_main_query()) {
        // Disable SQL_CALC_FOUND_ROWS for better performance when pagination not needed
        $query->set('no_found_rows', true);

        // Disable sticky posts
        $query->set('ignore_sticky_posts', true);
    }
}
add_action('pre_get_posts', 'dental_rubio_optimize_queries');

/**
 * Add resource hints for third-party domains
 */
function dental_rubio_resource_hints($hints, $relation_type) {
    if ('dns-prefetch' === $relation_type) {
        $hints[] = '//www.google-analytics.com';
        $hints[] = '//www.googletagmanager.com';
        $hints[] = '//connect.facebook.net';
        $hints[] = '//fonts.googleapis.com';
        $hints[] = '//fonts.gstatic.com';
    }

    if ('preconnect' === $relation_type) {
        $hints[] = array(
            'href'        => 'https://fonts.googleapis.com',
        );
        $hints[] = array(
            'href'        => 'https://fonts.gstatic.com',
            'crossorigin' => 'anonymous',
        );
    }

    return $hints;
}
add_filter('wp_resource_hints', 'dental_rubio_resource_hints', 10, 2);

/**
 * Disable Gutenberg on frontend (optional)
 */
function dental_rubio_dequeue_gutenberg() {
    // wp_dequeue_style('wp-block-library');
    // wp_dequeue_style('wp-block-library-theme');
    // wp_dequeue_style('global-styles');
}
add_action('wp_enqueue_scripts', 'dental_rubio_dequeue_gutenberg', 100);

/**
 * Optimize srcset generation
 */
function dental_rubio_limit_srcset($sources, $size_array, $image_src, $image_meta, $attachment_id) {
    // Limit srcset to most useful sizes to reduce HTML size
    $allowed_widths = array(320, 640, 768, 1024, 1280, 1536);

    foreach ($sources as $width => $source) {
        if (!in_array($width, $allowed_widths)) {
            unset($sources[$width]);
        }
    }

    return $sources;
}
add_filter('wp_calculate_image_srcset', 'dental_rubio_limit_srcset', 10, 5);

/**
 * Cache menu output
 */
function dental_rubio_cached_menu($args) {
    $cache_key = 'dental_rubio_menu_' . md5(serialize($args));
    $menu = get_transient($cache_key);

    if (false === $menu) {
        ob_start();
        wp_nav_menu($args);
        $menu = ob_get_clean();
        set_transient($cache_key, $menu, HOUR_IN_SECONDS);
    }

    echo $menu;
}

/**
 * Clear menu cache when menu is updated
 */
function dental_rubio_clear_menu_cache($menu_id) {
    global $wpdb;

    // Delete all menu transients
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_dental_rubio_menu_%'");
    $wpdb->query("DELETE FROM {$wpdb->options} WHERE option_name LIKE '_transient_timeout_dental_rubio_menu_%'");
}
add_action('wp_update_nav_menu', 'dental_rubio_clear_menu_cache');

/**
 * Add WebP support detection
 */
function dental_rubio_webp_support() {
    ?>
    <script>
    // Check WebP support and add class to html element
    (function() {
        var img = new Image();
        img.onload = function() {
            document.documentElement.classList.add('webp');
        };
        img.onerror = function() {
            document.documentElement.classList.add('no-webp');
        };
        img.src = 'data:image/webp;base64,UklGRhoAAABXRUJQVlA4TA0AAAAvAAAAEAcQERGIiP4HAA==';
    })();
    </script>
    <?php
}
add_action('wp_head', 'dental_rubio_webp_support', 1);

/**
 * Add performance meta tags
 */
function dental_rubio_performance_meta() {
    ?>
    <!-- Performance optimizations -->
    <meta http-equiv="x-dns-prefetch-control" content="on">
    <?php
}
add_action('wp_head', 'dental_rubio_performance_meta', 1);

/**
 * Optimize comment queries (if comments are enabled)
 */
function dental_rubio_optimize_comments($args) {
    // Only fetch needed comment fields
    $args['update_comment_meta_cache'] = false;
    $args['update_comment_post_cache'] = false;

    return $args;
}
add_filter('comments_template_query_args', 'dental_rubio_optimize_comments');

/**
 * Disable author archives (security + performance)
 */
function dental_rubio_disable_author_archives() {
    if (is_author()) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
add_action('template_redirect', 'dental_rubio_disable_author_archives');

/**
 * Prevent username enumeration
 */
function dental_rubio_prevent_user_enumeration() {
    if (!is_admin() && isset($_GET['author'])) {
        wp_redirect(home_url(), 301);
        exit;
    }
}
add_action('init', 'dental_rubio_prevent_user_enumeration');
