<?php
/**
 * Service Custom Fields and Meta
 * Helper functions for service page custom fields
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get service price
 */
function dental_rubio_get_service_price($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    return get_post_meta($post_id, '_service_price', true) ?: 'Contact for pricing';
}

/**
 * Get service USA price for comparison
 */
function dental_rubio_get_service_usa_price($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    return get_post_meta($post_id, '_service_usa_price', true);
}

/**
 * Get service savings percentage
 */
function dental_rubio_get_service_savings_percent($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    return get_post_meta($post_id, '_service_save_percent', true) ?: '70';
}

/**
 * Calculate savings amount
 */
function dental_rubio_calculate_savings($post_id = null) {
    $post_id = $post_id ?: get_the_ID();

    $rubio_price = intval(str_replace(['$', ','], '', dental_rubio_get_service_price($post_id)));
    $usa_price = intval(str_replace(['$', ','], '', dental_rubio_get_service_usa_price($post_id)));

    if ($usa_price > 0 && $rubio_price > 0) {
        return array(
            'rubio' => $rubio_price,
            'usa' => $usa_price,
            'savings' => $usa_price - $rubio_price,
            'percent' => round((($usa_price - $rubio_price) / $usa_price) * 100)
        );
    }

    return null;
}

/**
 * Get default pricing table for a service
 */
function dental_rubio_get_default_pricing_table($service_type) {
    $pricing_tables = array(
        'implant' => array(
            array(
                'procedure' => 'Single Dental Implant',
                'usa' => 4500,
                'rubio' => 1350
            ),
            array(
                'procedure' => 'Implant + Crown',
                'usa' => 5700,
                'rubio' => 1700
            )
        ),
        'all-on-4' => array(
            array(
                'procedure' => 'All-on-4 (Single Arch)',
                'usa' => 50000,
                'rubio' => 9500
            ),
            array(
                'procedure' => 'All-on-4 (Both Arches)',
                'usa' => 100000,
                'rubio' => 18500
            )
        ),
        'crown' => array(
            array(
                'procedure' => 'Porcelain Crown',
                'usa' => 1200,
                'rubio' => 350
            ),
            array(
                'procedure' => 'Zirconia Crown',
                'usa' => 1400,
                'rubio' => 400
            )
        ),
        'dentures' => array(
            array(
                'procedure' => 'Full Dentures (Upper)',
                'usa' => 2500,
                'rubio' => 800
            ),
            array(
                'procedure' => 'Full Dentures (Both)',
                'usa' => 5000,
                'rubio' => 1500
            )
        ),
        'veneers' => array(
            array(
                'procedure' => 'Veneer (per tooth)',
                'usa' => 1200,
                'rubio' => 420
            ),
            array(
                'procedure' => '8 Veneers (Full Smile)',
                'usa' => 9600,
                'rubio' => 3200
            )
        )
    );

    return $pricing_tables[$service_type] ?? array();
}

/**
 * Get default "What's Included" items
 */
function dental_rubio_get_default_whats_included($service_type = 'general') {
    $defaults = array(
        'implant' => array(
            array(
                'title' => 'Premium Straumann Implant',
                'description' => '100% German-made titanium implant with lifetime warranty'
            ),
            array(
                'title' => 'Complete Consultation',
                'description' => 'Full examination, X-rays, and personalized treatment plan'
            ),
            array(
                'title' => '3D CT Scan',
                'description' => 'Advanced 3D imaging for precise implant placement'
            ),
            array(
                'title' => 'Surgical Procedure',
                'description' => 'Professional implant surgery with modern techniques'
            ),
            array(
                'title' => 'Follow-up Care',
                'description' => 'Post-operative checkups and healing support included'
            ),
            array(
                'title' => 'Lifetime Warranty',
                'description' => 'Lifetime warranty from Straumann on implant fixture'
            )
        ),
        'general' => array(
            array(
                'title' => 'Initial Consultation',
                'description' => 'Complete examination and treatment plan'
            ),
            array(
                'title' => 'X-Rays & Diagnostics',
                'description' => 'Digital imaging and necessary diagnostics'
            ),
            array(
                'title' => 'Premium Materials',
                'description' => 'High-quality materials meeting US standards'
            ),
            array(
                'title' => 'Follow-up Care',
                'description' => 'Post-treatment check-ups included'
            )
        )
    );

    return $defaults[$service_type] ?? $defaults['general'];
}

/**
 * Register service meta boxes (for future use with Advanced Custom Fields or custom meta boxes)
 */
function dental_rubio_register_service_meta() {
    // This function can be extended to register custom meta boxes
    // For now, we're using direct get_post_meta() calls
    // Future enhancement: integrate with ACF or create custom meta boxes

    // Example meta fields for services:
    // - _service_subtitle
    // - _service_price
    // - _service_usa_price
    // - _service_save_percent
    // - _service_visits
    // - _service_duration
    // - _service_pricing_table (serialized array)
    // - _service_whats_included (serialized array)
    // - _service_process_steps (serialized array)
    // - _service_faqs (serialized array)
    // - _service_testimonials (serialized array)
    // - _service_gallery (array of image IDs)
}
add_action('init', 'dental_rubio_register_service_meta');

/**
 * Helper to format price for display
 */
function dental_rubio_format_price($price) {
    if (is_numeric($price)) {
        return '$' . number_format($price);
    }
    return $price;
}

/**
 * Get service icon based on title or slug
 */
function dental_rubio_get_service_icon($post_id = null) {
    $post_id = $post_id ?: get_the_ID();
    $slug = get_post_field('post_name', $post_id);

    $icons = array(
        'dental-implants' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z',
        'all-on-4' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z',
        'crowns' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z',
        'dentures' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z',
        'veneers' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'
    );

    return $icons[$slug] ?? 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z';
}
