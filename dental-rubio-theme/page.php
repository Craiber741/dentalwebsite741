<?php
/**
 * Page Template
 *
 * The template for displaying all pages.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

    <article id="page-<?php the_ID(); ?>" <?php post_class(); ?>>

        <!-- Page Header -->
        <header class="page-header bg-navy text-white py-16">
            <div class="container max-w-4xl text-center">
                <h1 class="page-title text-3xl md:text-4xl lg:text-5xl font-bold">
                    <?php the_title(); ?>
                </h1>
                <?php if (has_excerpt()) : ?>
                    <p class="page-excerpt text-xl text-gray-300 mt-4">
                        <?php echo esc_html(get_the_excerpt()); ?>
                    </p>
                <?php endif; ?>
            </div>
        </header>

        <!-- Page Content -->
        <div class="page-content py-12 md:py-16">
            <div class="container max-w-4xl">
                <div class="prose prose-lg">
                    <?php the_content(); ?>
                </div>

                <?php
                wp_link_pages(array(
                    'before' => '<div class="page-links mt-8">' . esc_html__('Pages:', 'dental-rubio'),
                    'after'  => '</div>',
                ));
                ?>
            </div>
        </div>

        <!-- Page CTA -->
        <section class="page-cta py-12 bg-gold/10">
            <div class="container max-w-4xl text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">
                    <?php esc_html_e('Have Questions?', 'dental-rubio'); ?>
                </h2>
                <p class="text-lg text-secondary mb-6">
                    <?php esc_html_e('Our team is ready to help. Contact us for a free consultation.', 'dental-rubio'); ?>
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:+1<?php echo preg_replace('/[^0-9]/', '', dental_rubio_get_phone()); ?>" class="btn btn-primary">
                        <?php echo dental_rubio_icon('phone', 20); ?>
                        <span><?php echo esc_html(dental_rubio_get_phone()); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-gold">
                        <?php esc_html_e('Contact Us', 'dental-rubio'); ?>
                    </a>
                </div>
            </div>
        </section>

    </article>

<?php endwhile; endif; ?>

<?php
get_footer();
