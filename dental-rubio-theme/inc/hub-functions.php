<?php
/**
 * Hub Functions
 *
 * Helper functions and utilities for content hub pages.
 * Includes meta field helpers, content organization, and hub-specific features.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get hub subtitle
 *
 * @param int $post_id Post ID (optional)
 * @return string Hub subtitle
 */
function dental_rubio_get_hub_subtitle($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $subtitle = get_post_meta($post_id, '_hub_subtitle', true);
    return $subtitle ? $subtitle : '';
}

/**
 * Get hub featured stats
 *
 * @param int $post_id Post ID (optional)
 * @return array Array of stats with 'number' and 'label' keys
 */
function dental_rubio_get_hub_stats($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $stats = array();

    for ($i = 1; $i <= 3; $i++) {
        $stat = get_post_meta($post_id, "_hub_stat_$i", true);
        if ($stat && is_array($stat)) {
            $stats[] = $stat;
        }
    }

    return $stats;
}

/**
 * Get hub table of contents items
 *
 * @param int $post_id Post ID (optional)
 * @return array Array of TOC items
 */
function dental_rubio_get_hub_toc($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $toc = get_post_meta($post_id, '_hub_toc_items', true);
    return is_array($toc) ? $toc : array();
}

/**
 * Get hub articles/resources
 *
 * @param int $post_id Post ID (optional)
 * @param int $limit Number of articles to retrieve
 * @return WP_Query Query object with articles
 */
function dental_rubio_get_hub_articles($post_id = null, $limit = 12) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $source = get_post_meta($post_id, '_hub_articles_source', true);

    if ($source === 'recent_posts') {
        $args = array(
            'post_type'      => 'post',
            'posts_per_page' => $limit,
            'post_status'    => 'publish',
        );
    } elseif ($source === 'custom') {
        $custom_ids = get_post_meta($post_id, '_hub_custom_posts', true);
        $args = array(
            'post_type'      => 'any',
            'post__in'       => $custom_ids ? explode(',', $custom_ids) : array(),
            'posts_per_page' => -1,
            'orderby'        => 'post__in',
        );
    } else {
        // Default to child pages
        $args = array(
            'post_type'      => 'page',
            'post_parent'    => $post_id,
            'posts_per_page' => $limit,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        );
    }

    return new WP_Query($args);
}

/**
 * Check if page is a hub page
 *
 * @param int $post_id Post ID (optional)
 * @return bool True if hub page
 */
function dental_rubio_is_hub_page($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $template = get_page_template_slug($post_id);
    return $template === 'page-templates/template-hub.php';
}

/**
 * Get hub CTA settings
 *
 * @param int $post_id Post ID (optional)
 * @return array CTA settings
 */
function dental_rubio_get_hub_cta($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    return array(
        'headline'    => get_post_meta($post_id, '_hub_cta_headline', true),
        'subheadline' => get_post_meta($post_id, '_hub_cta_subheadline', true),
        'type'        => get_post_meta($post_id, '_hub_cta_type', true),
    );
}

/**
 * Get hub sidebar settings
 *
 * @param int $post_id Post ID (optional)
 * @return array Sidebar settings
 */
function dental_rubio_get_hub_sidebar_settings($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    return array(
        'show_calculator'       => get_post_meta($post_id, '_hub_show_calculator', true),
        'show_emergency_notice' => get_post_meta($post_id, '_hub_show_emergency_notice', true),
        'featured_testimonial'  => get_post_meta($post_id, '_hub_featured_testimonial', true),
        'download_title'        => get_post_meta($post_id, '_hub_download_title', true),
        'download_url'          => get_post_meta($post_id, '_hub_download_url', true),
    );
}

/**
 * Register hub meta boxes for WordPress admin
 */
function dental_rubio_register_hub_meta_boxes() {
    add_meta_box(
        'dental_rubio_hub_settings',
        __('Hub Page Settings', 'dental-rubio'),
        'dental_rubio_hub_settings_callback',
        'page',
        'normal',
        'high'
    );
}
add_action('add_meta_boxes', 'dental_rubio_register_hub_meta_boxes');

/**
 * Hub settings meta box callback
 *
 * @param WP_Post $post Current post object
 */
function dental_rubio_hub_settings_callback($post) {
    // Add nonce for security
    wp_nonce_field('dental_rubio_hub_meta', 'dental_rubio_hub_nonce');

    // Get current values
    $subtitle = get_post_meta($post->ID, '_hub_subtitle', true);
    $articles_source = get_post_meta($post->ID, '_hub_articles_source', true);
    $grid_title = get_post_meta($post->ID, '_hub_grid_title', true);
    $cta_headline = get_post_meta($post->ID, '_hub_cta_headline', true);
    $cta_type = get_post_meta($post->ID, '_hub_cta_type', true);

    ?>
    <div class="dental-rubio-meta-box">
        <p class="description">
            <?php esc_html_e('These settings only apply when using the "Hub Page" template.', 'dental-rubio'); ?>
        </p>

        <table class="form-table">
            <tr>
                <th scope="row">
                    <label for="hub_subtitle"><?php esc_html_e('Hub Subtitle', 'dental-rubio'); ?></label>
                </th>
                <td>
                    <input type="text"
                           id="hub_subtitle"
                           name="hub_subtitle"
                           value="<?php echo esc_attr($subtitle); ?>"
                           class="large-text"
                           placeholder="<?php esc_attr_e('Descriptive subtitle for the hub page', 'dental-rubio'); ?>">
                    <p class="description">
                        <?php esc_html_e('Appears below the main title in the hero section.', 'dental-rubio'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="hub_articles_source"><?php esc_html_e('Articles Source', 'dental-rubio'); ?></label>
                </th>
                <td>
                    <select id="hub_articles_source" name="hub_articles_source">
                        <option value="child_pages" <?php selected($articles_source, 'child_pages'); ?>>
                            <?php esc_html_e('Child Pages', 'dental-rubio'); ?>
                        </option>
                        <option value="recent_posts" <?php selected($articles_source, 'recent_posts'); ?>>
                            <?php esc_html_e('Recent Blog Posts', 'dental-rubio'); ?>
                        </option>
                        <option value="custom" <?php selected($articles_source, 'custom'); ?>>
                            <?php esc_html_e('Custom Selection', 'dental-rubio'); ?>
                        </option>
                    </select>
                    <p class="description">
                        <?php esc_html_e('Choose where to pull articles from for the grid.', 'dental-rubio'); ?>
                    </p>
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="hub_grid_title"><?php esc_html_e('Grid Section Title', 'dental-rubio'); ?></label>
                </th>
                <td>
                    <input type="text"
                           id="hub_grid_title"
                           name="hub_grid_title"
                           value="<?php echo esc_attr($grid_title); ?>"
                           class="large-text"
                           placeholder="<?php esc_attr_e('Featured Resources', 'dental-rubio'); ?>">
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="hub_cta_headline"><?php esc_html_e('CTA Headline', 'dental-rubio'); ?></label>
                </th>
                <td>
                    <input type="text"
                           id="hub_cta_headline"
                           name="hub_cta_headline"
                           value="<?php echo esc_attr($cta_headline); ?>"
                           class="large-text"
                           placeholder="<?php esc_attr_e('Ready to Get Started?', 'dental-rubio'); ?>">
                </td>
            </tr>

            <tr>
                <th scope="row">
                    <label for="hub_cta_type"><?php esc_html_e('CTA Type', 'dental-rubio'); ?></label>
                </th>
                <td>
                    <select id="hub_cta_type" name="hub_cta_type">
                        <option value="default" <?php selected($cta_type, 'default'); ?>>
                            <?php esc_html_e('Default (Multi-option)', 'dental-rubio'); ?>
                        </option>
                        <option value="calculator" <?php selected($cta_type, 'calculator'); ?>>
                            <?php esc_html_e('Calculator Focus', 'dental-rubio'); ?>
                        </option>
                        <option value="appointment" <?php selected($cta_type, 'appointment'); ?>>
                            <?php esc_html_e('Appointment Focus', 'dental-rubio'); ?>
                        </option>
                    </select>
                </td>
            </tr>
        </table>
    </div>
    <?php
}

/**
 * Save hub meta box data
 *
 * @param int $post_id Post ID
 */
function dental_rubio_save_hub_meta($post_id) {
    // Check nonce
    if (!isset($_POST['dental_rubio_hub_nonce']) ||
        !wp_verify_nonce($_POST['dental_rubio_hub_nonce'], 'dental_rubio_hub_meta')) {
        return;
    }

    // Check autosave
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }

    // Check permissions
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }

    // Save fields
    $fields = array(
        'hub_subtitle',
        'hub_articles_source',
        'hub_grid_title',
        'hub_grid_description',
        'hub_cta_headline',
        'hub_cta_subheadline',
        'hub_cta_type',
    );

    foreach ($fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta(
                $post_id,
                '_' . $field,
                sanitize_text_field($_POST[$field])
            );
        }
    }
}
add_action('save_post', 'dental_rubio_save_hub_meta');

/**
 * Add body class for hub pages
 *
 * @param array $classes Body classes
 * @return array Modified classes
 */
function dental_rubio_hub_body_class($classes) {
    if (dental_rubio_is_hub_page()) {
        $classes[] = 'hub-page';
        $classes[] = 'content-hub';
    }
    return $classes;
}
add_filter('body_class', 'dental_rubio_hub_body_class');
