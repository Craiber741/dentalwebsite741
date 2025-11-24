<?php
/**
 * Template Name: Service Page
 * Description: Template for individual dental service pages with pricing, process, and FAQs
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

<main id="service-page" class="service-template">

    <?php
    while (have_posts()) : the_post();

        // Service Hero Section
        get_template_part('template-parts/service/hero');

        // Price Comparison Table
        get_template_part('template-parts/service/price-table');

        // What's Included in Package
        get_template_part('template-parts/service/whats-included');

        // Process Timeline
        get_template_part('template-parts/service/process');

        // Service Content (main description)
        ?>
        <section class="service-content py-16 bg-white">
            <div class="container mx-auto px-4 max-w-4xl">
                <div class="prose prose-lg max-w-none">
                    <?php the_content(); ?>
                </div>
            </div>
        </section>
        <?php

        // FAQ Section
        get_template_part('template-parts/service/faq');

        // Service Testimonials
        get_template_part('template-parts/service/testimonials');

        // Gallery (if has images)
        if (get_post_meta(get_the_ID(), '_service_gallery', true)) {
            get_template_part('template-parts/service/gallery');
        }

        // Final CTA
        get_template_part('template-parts/service/cta');

    endwhile;
    ?>

</main>

<?php
get_footer();
