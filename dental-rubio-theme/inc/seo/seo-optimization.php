<?php
/**
 * SEO Optimization Functions
 * Additional SEO enhancements
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Open Graph meta tags
 */
function dental_rubio_og_tags() {
    if (is_singular()) {
        global $post;

        $title = get_the_title();
        $description = get_the_excerpt() ?: get_bloginfo('description');
        $url = get_permalink();
        $image = get_the_post_thumbnail_url($post->ID, 'large') ?: '';

        echo '<meta property="og:type" content="website" />' . "\n";
        echo '<meta property="og:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta property="og:description" content="' . esc_attr($description) . '" />' . "\n";
        echo '<meta property="og:url" content="' . esc_url($url) . '" />' . "\n";
        echo '<meta property="og:site_name" content="' . esc_attr(get_bloginfo('name')) . '" />' . "\n";

        if ($image) {
            echo '<meta property="og:image" content="' . esc_url($image) . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'dental_rubio_og_tags');

/**
 * Add Twitter Card meta tags
 */
function dental_rubio_twitter_cards() {
    if (is_singular()) {
        global $post;

        $title = get_the_title();
        $description = get_the_excerpt() ?: get_bloginfo('description');
        $image = get_the_post_thumbnail_url($post->ID, 'large') ?: '';

        echo '<meta name="twitter:card" content="summary_large_image" />' . "\n";
        echo '<meta name="twitter:title" content="' . esc_attr($title) . '" />' . "\n";
        echo '<meta name="twitter:description" content="' . esc_attr($description) . '" />' . "\n";

        if ($image) {
            echo '<meta name="twitter:image" content="' . esc_url($image) . '" />' . "\n";
        }
    }
}
add_action('wp_head', 'dental_rubio_twitter_cards');

/**
 * Add canonical URL
 */
function dental_rubio_canonical_url() {
    if (is_singular()) {
        echo '<link rel="canonical" href="' . esc_url(get_permalink()) . '" />' . "\n";
    }
}
add_action('wp_head', 'dental_rubio_canonical_url');

/**
 * Optimize meta descriptions
 */
function dental_rubio_meta_description() {
    if (is_singular()) {
        $description = get_the_excerpt();

        if (empty($description)) {
            $content = get_the_content();
            $description = wp_trim_words(strip_tags($content), 25, '...');
        }

        if (!empty($description)) {
            echo '<meta name="description" content="' . esc_attr($description) . '" />' . "\n";
        }
    } elseif (is_front_page()) {
        echo '<meta name="description" content="' . esc_attr(get_bloginfo('description')) . '" />' . "\n";
    }
}
add_action('wp_head', 'dental_rubio_meta_description', 1);

/**
 * Add hreflang for multi-language support
 */
function dental_rubio_hreflang() {
    if (!is_singular()) {
        return;
    }

    $url = get_permalink();

    // Add English version
    echo '<link rel="alternate" hreflang="en" href="' . esc_url($url) . '" />' . "\n";
    echo '<link rel="alternate" hreflang="en-us" href="' . esc_url($url) . '" />' . "\n";
    echo '<link rel="alternate" hreflang="en-ca" href="' . esc_url($url) . '" />' . "\n";

    // Spanish version placeholder (if you add Spanish pages later)
    // echo '<link rel="alternate" hreflang="es" href="' . esc_url($url_es) . '" />' . "\n";
}
add_action('wp_head', 'dental_rubio_hreflang');

/**
 * Optimize robots meta tag
 */
function dental_rubio_robots_meta() {
    if (is_search() || is_404()) {
        echo '<meta name="robots" content="noindex,nofollow" />' . "\n";
    } else {
        echo '<meta name="robots" content="index,follow,max-image-preview:large,max-snippet:-1,max-video-preview:-1" />' . "\n";
    }
}
add_action('wp_head', 'dental_rubio_robots_meta', 1);

/**
 * Add preconnect for external resources
 */
function dental_rubio_preconnect() {
    echo '<link rel="preconnect" href="https://fonts.googleapis.com">' . "\n";
    echo '<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>' . "\n";
    echo '<link rel="dns-prefetch" href="//www.google-analytics.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//www.googletagmanager.com">' . "\n";
    echo '<link rel="dns-prefetch" href="//connect.facebook.net">' . "\n";
}
add_action('wp_head', 'dental_rubio_preconnect', 1);

/**
 * Clean up WordPress head
 */
function dental_rubio_cleanup_head() {
    // Remove unnecessary links
    remove_action('wp_head', 'rsd_link');
    remove_action('wp_head', 'wlwmanifest_link');
    remove_action('wp_head', 'wp_shortlink_wp_head');
    remove_action('wp_head', 'wp_generator');
    remove_action('wp_head', 'feed_links_extra', 3);
    remove_action('wp_head', 'start_post_rel_link', 10);
    remove_action('wp_head', 'parent_post_rel_link', 10);
    remove_action('wp_head', 'adjacent_posts_rel_link', 10);
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);
}
add_action('init', 'dental_rubio_cleanup_head');

/**
 * Optimize title tag
 */
function dental_rubio_document_title_parts($title) {
    if (is_singular('page')) {
        // For service pages, add keyword-rich suffix
        if (is_page_template('page-templates/template-service.php')) {
            $title['title'] = $title['title'] . ' | Los Algodones, Mexico';
        }
    }

    return $title;
}
add_filter('document_title_parts', 'dental_rubio_document_title_parts');
