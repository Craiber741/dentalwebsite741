<?php
/**
 * WhatsApp Floating Widget
 * Sticky WhatsApp button for easy contact
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Display WhatsApp floating widget
 */
function dental_rubio_whatsapp_widget() {
    // Get WhatsApp number from theme settings
    $whatsapp_number = dental_rubio_get_whatsapp();

    // Skip if no WhatsApp number is set
    if (empty($whatsapp_number) || $whatsapp_number === '52XXXXXXXXXX') {
        return;
    }

    // Get current page title for context
    $page_title = is_singular() ? get_the_title() : 'your dental needs';
    $default_message = sprintf('Hi! I\'m interested in learning more about %s at Dental Rubio.', $page_title);
    ?>

    <!-- WhatsApp Floating Widget -->
    <div id="whatsapp-widget" class="whatsapp-floating-widget fixed bottom-6 right-6 z-50 md:bottom-8 md:right-8">

        <!-- Main Button -->
        <a href="https://wa.me/<?php echo esc_attr($whatsapp_number); ?>?text=<?php echo urlencode($default_message); ?>"
           target="_blank"
           rel="noopener noreferrer"
           class="whatsapp-button flex items-center justify-center w-14 h-14 md:w-16 md:h-16 bg-green-500 hover:bg-green-600 text-white rounded-full shadow-2xl hover:shadow-3xl transition-all duration-300 transform hover:scale-110"
           aria-label="Chat on WhatsApp"
           id="whatsappBtn">
            <!-- WhatsApp Icon SVG -->
            <svg class="w-8 h-8 md:w-10 md:h-10" fill="currentColor" viewBox="0 0 24 24">
                <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
            </svg>
        </a>

        <!-- Tooltip -->
        <div id="whatsapp-tooltip"
             class="absolute bottom-20 right-0 bg-white text-gray-800 px-4 py-3 rounded-lg shadow-xl hidden md:block opacity-0 transform translate-y-2 transition-all duration-300 pointer-events-none max-w-xs">
            <div class="flex items-center gap-2 mb-2">
                <div class="w-2 h-2 bg-green-500 rounded-full animate-pulse"></div>
                <span class="font-bold text-sm">We're Online!</span>
            </div>
            <p class="text-sm leading-snug">
                💬 Chat with us on WhatsApp for instant answers!
            </p>
            <!-- Arrow -->
            <div class="absolute bottom-0 right-6 transform translate-y-1/2 rotate-45 w-3 h-3 bg-white"></div>
        </div>

        <!-- Pulse Animation Ring -->
        <div class="absolute inset-0 rounded-full bg-green-500 animate-ping opacity-20 pointer-events-none"></div>

    </div>

    <style>
    /* WhatsApp Widget Custom Styles */
    .whatsapp-floating-widget:hover #whatsapp-tooltip {
        opacity: 1;
        transform: translate-y-0);
        pointer-events: auto;
    }

    @keyframes ping {
        75%, 100% {
            transform: scale(1.5);
            opacity: 0;
        }
    }

    .animate-ping {
        animation: ping 2s cubic-bezier(0, 0, 0.2, 1) infinite;
    }

    .animate-pulse {
        animation: pulse 2s cubic-bezier(0.4, 0, 0.6, 1) infinite;
    }

    @keyframes pulse {
        0%, 100% {
            opacity: 1;
        }
        50% {
            opacity: 0.5;
        }
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .whatsapp-floating-widget {
            bottom: 1.5rem;
            right: 1.5rem;
        }
    }
    </style>

    <?php
}
add_action('wp_footer', 'dental_rubio_whatsapp_widget');

/**
 * Add WhatsApp widget enable/disable option to customizer
 */
function dental_rubio_whatsapp_customizer($wp_customize) {
    // Add section for WhatsApp settings
    $wp_customize->add_section('dental_rubio_whatsapp', array(
        'title'    => __('WhatsApp Widget', 'dental-rubio'),
        'priority' => 35,
    ));

    // Enable/Disable WhatsApp Widget
    $wp_customize->add_setting('dental_rubio_whatsapp_enabled', array(
        'default'           => true,
        'sanitize_callback' => 'wp_validate_boolean',
    ));

    $wp_customize->add_control('dental_rubio_whatsapp_enabled', array(
        'label'    => __('Enable WhatsApp Widget', 'dental-rubio'),
        'section'  => 'dental_rubio_whatsapp',
        'type'     => 'checkbox',
    ));
}
add_action('customize_register', 'dental_rubio_whatsapp_customizer');
