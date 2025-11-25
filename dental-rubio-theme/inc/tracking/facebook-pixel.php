<?php
/**
 * Facebook Pixel Integration
 * Adds Facebook Pixel for tracking and remarketing
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add Facebook Pixel to head
 */
function dental_rubio_facebook_pixel() {
    $pixel_id = get_theme_mod('dental_rubio_fb_pixel_id', '');

    if (empty($pixel_id)) {
        return;
    }
    ?>
    <!-- Facebook Pixel Code -->
    <script>
    !function(f,b,e,v,n,t,s)
    {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};
    if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
    n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];
    s.parentNode.insertBefore(t,s)}(window, document,'script',
    'https://connect.facebook.net/en_US/fbevents.js');
    fbq('init', '<?php echo esc_js($pixel_id); ?>');
    fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
    src="https://www.facebook.com/tr?id=<?php echo esc_attr($pixel_id); ?>&ev=PageView&noscript=1"
    /></noscript>
    <!-- End Facebook Pixel Code -->
    <?php
}
add_action('wp_head', 'dental_rubio_facebook_pixel', 10);

/**
 * Track specific events
 */
function dental_rubio_fb_track_events() {
    $pixel_id = get_theme_mod('dental_rubio_fb_pixel_id', '');

    if (empty($pixel_id)) {
        return;
    }
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Track form submissions
        const contactForm = document.getElementById('dentalContactForm');
        if (contactForm) {
            contactForm.addEventListener('submit', function() {
                if (typeof fbq !== 'undefined') {
                    fbq('track', 'Lead', {
                        content_name: '<?php echo esc_js(get_the_title()); ?>',
                        content_category: 'Contact Form'
                    });
                }
            });
        }

        // Track calculator usage
        ['savingsCalculator', 'tripCostForm', 'paymentPlanForm'].forEach(function(formId) {
            const calc = document.getElementById(formId);
            if (calc) {
                calc.addEventListener('change', function() {
                    if (typeof fbq !== 'undefined') {
                        fbq('trackCustom', 'CalculatorUsed', {
                            calculator_type: formId,
                            page: '<?php echo esc_js(get_the_title()); ?>'
                        });
                    }
                });
            }
        });

        // Track phone clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('a[href^="tel:"]')) {
                if (typeof fbq !== 'undefined') {
                    fbq('track', 'Contact', {
                        contact_method: 'phone',
                        page: '<?php echo esc_js(get_the_title()); ?>'
                    });
                }
            }
        });

        // Track WhatsApp clicks
        document.addEventListener('click', function(e) {
            if (e.target.closest('a[href*="wa.me"]')) {
                if (typeof fbq !== 'undefined') {
                    fbq('track', 'Contact', {
                        contact_method: 'whatsapp',
                        page: '<?php echo esc_js(get_the_title()); ?>'
                    });
                }
            }
        });

        // Track service page views
        <?php if (is_page_template('page-templates/template-service.php')): ?>
        if (typeof fbq !== 'undefined') {
            fbq('track', 'ViewContent', {
                content_name: '<?php echo esc_js(get_the_title()); ?>',
                content_category: 'Service',
                content_type: 'product'
            });
        }
        <?php endif; ?>
    });
    </script>
    <?php
}
add_action('wp_footer', 'dental_rubio_fb_track_events');

/**
 * Add Facebook Pixel settings to customizer
 */
function dental_rubio_fb_pixel_customizer($wp_customize) {
    // Facebook Pixel ID
    $wp_customize->add_setting('dental_rubio_fb_pixel_id', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('dental_rubio_fb_pixel_id', array(
        'label'       => __('Facebook Pixel ID', 'dental-rubio'),
        'description' => __('Enter your Facebook Pixel ID (numbers only)', 'dental-rubio'),
        'section'     => 'dental_rubio_tracking',
        'type'        => 'text',
    ));
}
add_action('customize_register', 'dental_rubio_fb_pixel_customizer');
