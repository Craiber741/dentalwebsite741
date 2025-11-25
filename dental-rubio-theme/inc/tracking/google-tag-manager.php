<?php
/**
 * Google Tag Manager Integration
 * Adds GTM container to head and body
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add GTM to head
 */
function dental_rubio_gtm_head() {
    $gtm_id = get_theme_mod('dental_rubio_gtm_id', '');

    if (empty($gtm_id)) {
        return;
    }
    ?>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','<?php echo esc_js($gtm_id); ?>');</script>
    <!-- End Google Tag Manager -->
    <?php
}
add_action('wp_head', 'dental_rubio_gtm_head', 1);

/**
 * Add GTM noscript to body
 */
function dental_rubio_gtm_body() {
    $gtm_id = get_theme_mod('dental_rubio_gtm_id', '');

    if (empty($gtm_id)) {
        return;
    }
    ?>
    <!-- Google Tag Manager (noscript) -->
    <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=<?php echo esc_attr($gtm_id); ?>"
    height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
    <!-- End Google Tag Manager (noscript) -->
    <?php
}
add_action('wp_body_open', 'dental_rubio_gtm_body');

/**
 * Track events with dataLayer
 */
function dental_rubio_track_event($event_name, $event_data = array()) {
    ?>
    <script>
    if (typeof dataLayer !== 'undefined') {
        dataLayer.push({
            'event': '<?php echo esc_js($event_name); ?>',
            <?php
            foreach ($event_data as $key => $value) {
                echo "'" . esc_js($key) . "': '" . esc_js($value) . "',";
            }
            ?>
        });
    }
    </script>
    <?php
}

/**
 * Track calculator usage
 */
function dental_rubio_track_calculator_usage() {
    if (!is_page()) {
        return;
    }
    ?>
    <script>
    // Track calculator interactions
    document.addEventListener('DOMContentLoaded', function() {
        // Savings calculator
        const savingsCalc = document.getElementById('savingsCalculator');
        if (savingsCalc) {
            savingsCalc.addEventListener('change', function() {
                if (typeof dataLayer !== 'undefined') {
                    dataLayer.push({
                        'event': 'calculator_interaction',
                        'calculator_type': 'savings',
                        'page': '<?php echo esc_js(get_the_title()); ?>'
                    });
                }
            });
        }

        // Trip cost calculator
        const tripCalc = document.getElementById('tripCostForm');
        if (tripCalc) {
            tripCalc.addEventListener('change', function() {
                if (typeof dataLayer !== 'undefined') {
                    dataLayer.push({
                        'event': 'calculator_interaction',
                        'calculator_type': 'trip_cost',
                        'page': '<?php echo esc_js(get_the_title()); ?>'
                    });
                }
            });
        }

        // Payment plan calculator
        const paymentCalc = document.getElementById('paymentPlanForm');
        if (paymentCalc) {
            paymentCalc.addEventListener('change', function() {
                if (typeof dataLayer !== 'undefined') {
                    dataLayer.push({
                        'event': 'calculator_interaction',
                        'calculator_type': 'payment_plan',
                        'page': '<?php echo esc_js(get_the_title()); ?>'
                    });
                }
            });
        }
    });

    // Track phone clicks
    document.addEventListener('click', function(e) {
        if (e.target.closest('a[href^="tel:"]')) {
            if (typeof dataLayer !== 'undefined') {
                dataLayer.push({
                    'event': 'phone_click',
                    'phone_number': e.target.href.replace('tel:', ''),
                    'page': '<?php echo esc_js(get_the_title()); ?>'
                });
            }
        }
    });

    // Track WhatsApp clicks
    document.addEventListener('click', function(e) {
        if (e.target.closest('a[href*="wa.me"]')) {
            if (typeof dataLayer !== 'undefined') {
                dataLayer.push({
                    'event': 'whatsapp_click',
                    'page': '<?php echo esc_js(get_the_title()); ?>'
                });
            }
        }
    });
    </script>
    <?php
}
add_action('wp_footer', 'dental_rubio_track_calculator_usage');

/**
 * Add GTM settings to customizer
 */
function dental_rubio_gtm_customizer($wp_customize) {
    // Add section
    $wp_customize->add_section('dental_rubio_tracking', array(
        'title'    => __('Tracking & Analytics', 'dental-rubio'),
        'priority' => 40,
    ));

    // GTM ID
    $wp_customize->add_setting('dental_rubio_gtm_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dental_rubio_gtm_id', array(
        'label'       => __('Google Tag Manager ID', 'dental-rubio'),
        'description' => __('Enter your GTM container ID (e.g., GTM-XXXXXX)', 'dental-rubio'),
        'section'     => 'dental_rubio_tracking',
        'type'        => 'text',
    ));
}
add_action('customize_register', 'dental_rubio_gtm_customizer');
