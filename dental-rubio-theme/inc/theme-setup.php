<?php
/**
 * Additional Theme Setup
 *
 * WordPress hooks and configurations for Dental Rubio theme.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Remove unnecessary WordPress head elements
 */
function dental_rubio_cleanup_head() {
    // Remove WordPress version number
    remove_action('wp_head', 'wp_generator');

    // Remove RSD link
    remove_action('wp_head', 'rsd_link');

    // Remove Windows Live Writer manifest link
    remove_action('wp_head', 'wlwmanifest_link');

    // Remove shortlink
    remove_action('wp_head', 'wp_shortlink_wp_head');

    // Remove adjacent posts links
    remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10);

    // Remove emoji detection script
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
    remove_action('admin_print_scripts', 'print_emoji_detection_script');
    remove_action('admin_print_styles', 'print_emoji_styles');

    // Remove REST API link
    remove_action('wp_head', 'rest_output_link_wp_head', 10);

    // Remove oEmbed discovery links
    remove_action('wp_head', 'wp_oembed_add_discovery_links', 10);
}
add_action('init', 'dental_rubio_cleanup_head');

/**
 * Disable XML-RPC for security
 */
add_filter('xmlrpc_enabled', '__return_false');

/**
 * Remove XML-RPC methods
 */
function dental_rubio_remove_xmlrpc_methods($methods) {
    return array();
}
add_filter('xmlrpc_methods', 'dental_rubio_remove_xmlrpc_methods');

/**
 * Disable REST API for non-logged users (optional - comment out if needed)
 */
// function dental_rubio_restrict_rest_api($access) {
//     if (!is_user_logged_in()) {
//         return new WP_Error('rest_cannot_access', __('REST API restricted to authenticated users.', 'dental-rubio'), array('status' => 401));
//     }
//     return $access;
// }
// add_filter('rest_authentication_errors', 'dental_rubio_restrict_rest_api');

/**
 * Add custom Customizer settings
 */
function dental_rubio_customize_register($wp_customize) {
    // Contact Information Section
    $wp_customize->add_section('dental_rubio_contact', array(
        'title'    => __('Contact Information', 'dental-rubio'),
        'priority' => 30,
    ));

    // Phone Number
    $wp_customize->add_setting('dental_rubio_phone', array(
        'default'           => '(928) XXX-XXXX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_phone', array(
        'label'    => __('Phone Number', 'dental-rubio'),
        'section'  => 'dental_rubio_contact',
        'type'     => 'text',
    ));

    // WhatsApp Number
    $wp_customize->add_setting('dental_rubio_whatsapp', array(
        'default'           => '52XXXXXXXXXX',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_whatsapp', array(
        'label'       => __('WhatsApp Number', 'dental-rubio'),
        'description' => __('Enter without + sign (e.g., 521234567890)', 'dental-rubio'),
        'section'     => 'dental_rubio_contact',
        'type'        => 'text',
    ));

    // Email
    $wp_customize->add_setting('dental_rubio_email', array(
        'default'           => 'info@dentalrubio.com',
        'sanitize_callback' => 'sanitize_email',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_email', array(
        'label'   => __('Email Address', 'dental-rubio'),
        'section' => 'dental_rubio_contact',
        'type'    => 'email',
    ));

    // Address
    $wp_customize->add_setting('dental_rubio_address', array(
        'default'           => 'Avenida A 139, Los Algodones, Baja California, Mexico',
        'sanitize_callback' => 'sanitize_textarea_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_address', array(
        'label'   => __('Clinic Address', 'dental-rubio'),
        'section' => 'dental_rubio_contact',
        'type'    => 'textarea',
    ));

    // Business Hours Section
    $wp_customize->add_section('dental_rubio_hours', array(
        'title'    => __('Business Hours', 'dental-rubio'),
        'priority' => 31,
    ));

    // Weekday Hours
    $wp_customize->add_setting('dental_rubio_weekday_hours', array(
        'default'           => 'Mon-Fri: 9am-5pm MST',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_weekday_hours', array(
        'label'   => __('Weekday Hours', 'dental-rubio'),
        'section' => 'dental_rubio_hours',
        'type'    => 'text',
    ));

    // Weekend Hours
    $wp_customize->add_setting('dental_rubio_weekend_hours', array(
        'default'           => 'Sat: 9am-2pm MST',
        'sanitize_callback' => 'sanitize_text_field',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_weekend_hours', array(
        'label'   => __('Weekend Hours', 'dental-rubio'),
        'section' => 'dental_rubio_hours',
        'type'    => 'text',
    ));

    // Social Media Section
    $wp_customize->add_section('dental_rubio_social', array(
        'title'    => __('Social Media', 'dental-rubio'),
        'priority' => 32,
    ));

    // Facebook
    $wp_customize->add_setting('dental_rubio_facebook', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_facebook', array(
        'label'   => __('Facebook URL', 'dental-rubio'),
        'section' => 'dental_rubio_social',
        'type'    => 'url',
    ));

    // Instagram
    $wp_customize->add_setting('dental_rubio_instagram', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_instagram', array(
        'label'   => __('Instagram URL', 'dental-rubio'),
        'section' => 'dental_rubio_social',
        'type'    => 'url',
    ));

    // YouTube
    $wp_customize->add_setting('dental_rubio_youtube', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
        'transport'         => 'refresh',
    ));

    $wp_customize->add_control('dental_rubio_youtube', array(
        'label'   => __('YouTube URL', 'dental-rubio'),
        'section' => 'dental_rubio_social',
        'type'    => 'url',
    ));
}
add_action('customize_register', 'dental_rubio_customize_register');

/**
 * Add preconnect for Google Fonts
 */
function dental_rubio_preconnect_google_fonts($urls, $relation_type) {
    if (wp_style_is('dental-rubio-google-fonts', 'queue') && 'preconnect' === $relation_type) {
        $urls[] = array(
            'href' => 'https://fonts.googleapis.com',
        );
        $urls[] = array(
            'href' => 'https://fonts.gstatic.com',
            'crossorigin',
        );
    }
    return $urls;
}
add_filter('wp_resource_hints', 'dental_rubio_preconnect_google_fonts', 10, 2);

/**
 * Add security headers
 */
function dental_rubio_security_headers() {
    if (!is_admin()) {
        header('X-Content-Type-Options: nosniff');
        header('X-Frame-Options: SAMEORIGIN');
        header('X-XSS-Protection: 1; mode=block');
        header('Referrer-Policy: strict-origin-when-cross-origin');
    }
}
add_action('send_headers', 'dental_rubio_security_headers');

/**
 * Custom login logo
 */
function dental_rubio_login_logo() {
    $custom_logo_id = get_theme_mod('custom_logo');
    if ($custom_logo_id) {
        $image = wp_get_attachment_image_src($custom_logo_id, 'full');
        ?>
        <style type="text/css">
            #login h1 a, .login h1 a {
                background-image: url(<?php echo esc_url($image[0]); ?>);
                background-size: contain;
                background-repeat: no-repeat;
                width: 100%;
                height: 80px;
            }
        </style>
        <?php
    }
}
add_action('login_enqueue_scripts', 'dental_rubio_login_logo');

/**
 * Change login logo URL
 */
function dental_rubio_login_url() {
    return home_url();
}
add_filter('login_headerurl', 'dental_rubio_login_url');

/**
 * Change login logo title
 */
function dental_rubio_login_title() {
    return get_bloginfo('name');
}
add_filter('login_headertext', 'dental_rubio_login_title');
