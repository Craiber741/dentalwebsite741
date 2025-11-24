<?php
/**
 * Template Name: Homepage
 * Description: Senior-friendly homepage with hero, trust signals, calculator, and services
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="homepage" class="homepage-template">

    <?php
    // Hero Section - Above the fold
    get_template_part('template-parts/home/hero');

    // Trust Bar - Social proof
    get_template_part('template-parts/home/trust-bar');

    // Savings Calculator - Main conversion tool
    get_template_part('template-parts/home/calculator');

    // Featured Services - Core offerings
    get_template_part('template-parts/home/services');

    // How It Works - Process explanation
    get_template_part('template-parts/home/how-it-works');

    // Testimonials - Social proof
    get_template_part('template-parts/home/testimonials');

    // Final CTA
    get_template_part('template-parts/home/final-cta');
    ?>

</main>

<?php
get_footer();
