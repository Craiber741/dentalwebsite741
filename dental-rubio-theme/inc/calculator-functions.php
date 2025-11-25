<?php
/**
 * Calculator Functions
 *
 * Helper functions for dental cost calculators including pricing data,
 * formatting utilities, and calculator-specific features.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Get base pricing for dental procedures
 *
 * @param string $procedure Procedure type
 * @param string $location Location (usa, mexico, rubio)
 * @return int|array Price or pricing array
 */
function dental_rubio_get_procedure_pricing($procedure, $location = 'rubio') {
    $pricing = array(
        'rubio' => array(
            'single-implant'     => 1350,
            'crown'              => 350,
            'all-on-4'           => 9500,
            'all-on-4-both'      => 19000,
            'dentures'           => 800,
            'veneers'            => 420,
            'bridge-3-unit'      => 900,
            'root-canal'         => 180,
            'extraction'         => 45,
            'bone-graft'         => 250,
        ),
        'usa' => array(
            'arizona' => array(
                'single-implant' => 4500,
                'crown'          => 1200,
                'all-on-4'       => 50000,
                'dentures'       => 2500,
                'veneers'        => 1200,
            ),
            'california' => array(
                'single-implant' => 5000,
                'crown'          => 1400,
                'all-on-4'       => 55000,
                'dentures'       => 3000,
                'veneers'        => 1400,
            ),
            'texas' => array(
                'single-implant' => 4500,
                'crown'          => 1200,
                'all-on-4'       => 50000,
                'dentures'       => 2500,
                'veneers'        => 1200,
            ),
            'canada' => array(
                'single-implant' => 6000,
                'crown'          => 1600,
                'all-on-4'       => 65000,
                'dentures'       => 3500,
                'veneers'        => 1600,
            ),
        ),
    );

    if ($location === 'rubio') {
        return isset($pricing['rubio'][$procedure]) ? $pricing['rubio'][$procedure] : 0;
    } elseif ($location === 'usa') {
        return isset($pricing['usa']) ? $pricing['usa'] : array();
    }

    return 0;
}

/**
 * Calculate savings percentage
 *
 * @param int $usa_price USA price
 * @param int $mexico_price Mexico/Rubio price
 * @return int Savings percentage
 */
function dental_rubio_calculate_savings_percent($usa_price, $mexico_price) {
    if ($usa_price <= 0) {
        return 0;
    }

    $savings = $usa_price - $mexico_price;
    $percent = ($savings / $usa_price) * 100;

    return round($percent);
}

/**
 * Get trip cost estimates
 *
 * @param string $origin Origin location
 * @param int $nights Number of nights
 * @param int $travelers Number of travelers
 * @param string $hotel_type Hotel type (budget, standard, premium)
 * @return array Trip cost breakdown
 */
function dental_rubio_calculate_trip_cost($origin, $nights = 3, $travelers = 1, $hotel_type = 'standard') {
    $hotel_rates = array(
        'budget'   => 50,
        'standard' => 80,
        'premium'  => 120,
    );

    $transport_costs = array(
        'arizona'      => 50,
        'california'   => 150,
        'texas'        => 200,
        'nevada'       => 100,
        'canada-west'  => 300,
        'canada-east'  => 400,
        'other-us'     => 200,
    );

    $hotel_cost = $nights * $hotel_rates[$hotel_type];
    $meals_cost = $nights * 30 * $travelers; // $30/day per person
    $transport = isset($transport_costs[$origin]) ? $transport_costs[$origin] : 200;

    return array(
        'hotel'     => $hotel_cost,
        'meals'     => $meals_cost,
        'transport' => $transport,
        'total'     => $hotel_cost + $meals_cost + $transport,
    );
}

/**
 * Calculate monthly payment
 *
 * @param int $principal Loan amount
 * @param int $months Number of months
 * @param float $interest_rate Annual interest rate (default 0 for 0% financing)
 * @return int Monthly payment
 */
function dental_rubio_calculate_monthly_payment($principal, $months, $interest_rate = 0) {
    if ($months <= 0) {
        return $principal;
    }

    if ($interest_rate == 0) {
        return ceil($principal / $months);
    }

    $monthly_rate = $interest_rate / 12 / 100;
    $payment = $principal * ($monthly_rate * pow(1 + $monthly_rate, $months)) /
               (pow(1 + $monthly_rate, $months) - 1);

    return ceil($payment);
}

/**
 * Format currency for display
 *
 * @param int|float $amount Amount to format
 * @param bool $show_cents Show cents (default false)
 * @return string Formatted currency
 */
function dental_rubio_format_currency($amount, $show_cents = false) {
    if ($show_cents) {
        return '$' . number_format($amount, 2);
    }
    return '$' . number_format($amount, 0);
}

/**
 * Get calculator recommendations based on page/service
 *
 * @param int $post_id Post ID
 * @return array Recommended calculators
 */
function dental_rubio_get_recommended_calculators($post_id = null) {
    if (!$post_id) {
        $post_id = get_the_ID();
    }

    $template = get_page_template_slug($post_id);
    $title = get_the_title($post_id);

    $recommendations = array();

    // All-on-4 pages
    if (stripos($title, 'all-on-4') !== false || stripos($title, 'all on 4') !== false) {
        $recommendations[] = array(
            'id'    => 'all-on-4-calculator',
            'title' => __('All-on-4 Complete Calculator', 'dental-rubio'),
            'file'  => 'calculators/all-on-4-calculator',
        );
        $recommendations[] = array(
            'id'    => 'roi-calculator',
            'title' => __('15-Year ROI Calculator', 'dental-rubio'),
            'file'  => 'calculators/roi-calculator',
        );
    }

    // Implant pages
    if (stripos($title, 'implant') !== false) {
        $recommendations[] = array(
            'id'    => 'straumann-comparison',
            'title' => __('Straumann vs Budget Implants', 'dental-rubio'),
            'file'  => 'calculators/straumann-comparison',
        );
        $recommendations[] = array(
            'id'    => 'roi-calculator',
            'title' => __('15-Year ROI Calculator', 'dental-rubio'),
            'file'  => 'calculators/roi-calculator',
        );
    }

    // Pricing pages
    if (stripos($title, 'pricing') !== false || stripos($title, 'cost') !== false) {
        $recommendations[] = array(
            'id'    => 'trip-cost',
            'title' => __('Trip Cost Calculator', 'dental-rubio'),
            'file'  => 'calculators/trip-cost',
        );
        $recommendations[] = array(
            'id'    => 'payment-plan',
            'title' => __('Payment Plan Calculator', 'dental-rubio'),
            'file'  => 'calculators/payment-plan',
        );
    }

    // Homepage - show savings calculator
    if (is_front_page()) {
        $recommendations[] = array(
            'id'    => 'savings-calculator',
            'title' => __('Savings Calculator', 'dental-rubio'),
            'file'  => 'home/calculator',
        );
    }

    return $recommendations;
}

/**
 * Render a calculator by ID
 *
 * @param string $calculator_id Calculator identifier
 * @return void
 */
function dental_rubio_render_calculator($calculator_id) {
    $calculators = array(
        'savings'              => 'home/calculator',
        'trip-cost'            => 'calculators/trip-cost',
        'payment-plan'         => 'calculators/payment-plan',
        'roi-calculator'       => 'calculators/roi-calculator',
        'straumann-comparison' => 'calculators/straumann-comparison',
        'all-on-4-calculator'  => 'calculators/all-on-4-calculator',
    );

    if (isset($calculators[$calculator_id])) {
        get_template_part('template-parts/' . $calculators[$calculator_id]);
    }
}

/**
 * Get success rates for different implant types
 *
 * @param string $implant_type Implant type (straumann, budget, other)
 * @return float Success rate percentage
 */
function dental_rubio_get_implant_success_rate($implant_type = 'straumann') {
    $success_rates = array(
        'straumann' => 98.8,
        'budget'    => 87.5,
        'generic'   => 85.0,
        'nobel'     => 98.2,
        'zimmer'    => 97.5,
    );

    return isset($success_rates[$implant_type]) ? $success_rates[$implant_type] : 85.0;
}

/**
 * Get average lifespan for different treatments
 *
 * @param string $treatment Treatment type
 * @return int Years of lifespan
 */
function dental_rubio_get_treatment_lifespan($treatment) {
    $lifespans = array(
        'straumann-implant' => 25,
        'budget-implant'    => 10,
        'dentures'          => 5,
        'bridge'            => 10,
        'crown'             => 15,
        'veneers'           => 12,
    );

    return isset($lifespans[$treatment]) ? $lifespans[$treatment] : 10;
}

/**
 * Calculate total cost of ownership over time
 *
 * @param string $treatment Treatment type
 * @param int $years Number of years
 * @param int $initial_cost Initial cost
 * @return array Cost breakdown
 */
function dental_rubio_calculate_total_cost_of_ownership($treatment, $years, $initial_cost) {
    $lifespan = dental_rubio_get_treatment_lifespan($treatment);
    $replacements_needed = floor($years / $lifespan);

    // Replacement costs (typically 80-90% of initial)
    $replacement_multiplier = ($treatment === 'straumann-implant') ? 0 : 0.85;
    $replacement_cost = $replacements_needed * ($initial_cost * $replacement_multiplier);

    // Annual maintenance
    $maintenance_costs = array(
        'straumann-implant' => 50,
        'budget-implant'    => 100,
        'dentures'          => 200,
        'bridge'            => 150,
        'crown'             => 75,
    );

    $annual_maintenance = isset($maintenance_costs[$treatment]) ? $maintenance_costs[$treatment] : 100;
    $total_maintenance = $annual_maintenance * $years;

    return array(
        'initial'           => $initial_cost,
        'replacements'      => $replacements_needed,
        'replacement_cost'  => $replacement_cost,
        'maintenance'       => $total_maintenance,
        'total'             => $initial_cost + $replacement_cost + $total_maintenance,
    );
}

/**
 * Add calculator shortcode
 *
 * Usage: [dental_calculator type="all-on-4"]
 */
function dental_rubio_calculator_shortcode($atts) {
    $atts = shortcode_atts(array(
        'type' => 'savings',
    ), $atts);

    ob_start();
    dental_rubio_render_calculator($atts['type']);
    return ob_get_clean();
}
add_shortcode('dental_calculator', 'dental_rubio_calculator_shortcode');

/**
 * Add body class for pages with calculators
 */
function dental_rubio_calculator_body_class($classes) {
    if (dental_rubio_page_has_calculator()) {
        $classes[] = 'has-calculator';
    }
    return $classes;
}
add_filter('body_class', 'dental_rubio_calculator_body_class');

/**
 * Check if current page has a calculator
 *
 * @return bool True if page has calculator
 */
function dental_rubio_page_has_calculator() {
    global $post;

    if (!$post) {
        return false;
    }

    // Check for calculator shortcode in content
    if (has_shortcode($post->post_content, 'dental_calculator')) {
        return true;
    }

    // Check if it's a calculator-specific page
    $calculator_pages = array('pricing', 'cost', 'calculator', 'savings');
    $post_slug = $post->post_name;

    foreach ($calculator_pages as $keyword) {
        if (stripos($post_slug, $keyword) !== false) {
            return true;
        }
    }

    return false;
}
