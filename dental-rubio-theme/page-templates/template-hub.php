<?php
/**
 * Template Name: Hub Page
 * Template Post Type: page
 *
 * Content hub template for resource centers and guides.
 * Optimized for SEO, internal linking, and senior-friendly design.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="hub-page">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero/Intro Section -->
        <?php get_template_part('template-parts/hub/intro'); ?>

        <!-- Main Content Area -->
        <div class="hub-content py-16 bg-gray-50">
            <div class="container max-w-7xl">
                <div class="grid lg:grid-cols-3 gap-12">

                    <!-- Main Content Column -->
                    <div class="lg:col-span-2">

                        <!-- Articles/Resources Grid -->
                        <?php get_template_part('template-parts/hub/articles-grid'); ?>

                        <!-- The Content (if any) -->
                        <?php if (get_the_content()) : ?>
                            <div class="hub-text-content prose prose-lg max-w-none mb-12 bg-white p-8 rounded-lg shadow-sm">
                                <?php the_content(); ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <!-- Sidebar -->
                    <aside class="lg:col-span-1">
                        <?php get_template_part('template-parts/hub/sidebar'); ?>
                    </aside>

                </div>
            </div>
        </div>

        <!-- CTA Section -->
        <?php get_template_part('template-parts/hub/cta-section'); ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
