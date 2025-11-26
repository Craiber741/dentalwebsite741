<?php
/**
 * Template Name: Full Width
 * Template Post Type: page
 *
 * Full-width page template without sidebars.
 * Perfect for landing pages, sales pages, and content-focused pages.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="full-width-page">

    <?php while (have_posts()) : the_post(); ?>

        <article id="post-<?php the_ID(); ?>" <?php post_class('full-width-content'); ?>>

            <!-- Featured Image (if exists) -->
            <?php if (has_post_thumbnail()) : ?>
                <div class="featured-image-hero relative">
                    <?php the_post_thumbnail('full', array('class' => 'w-full h-auto')); ?>

                    <!-- Title Overlay (optional) -->
                    <?php if (get_post_meta(get_the_ID(), '_show_title_overlay', true)) : ?>
                        <div class="absolute inset-0 bg-gradient-to-t from-black/70 to-transparent flex items-end">
                            <div class="container max-w-7xl pb-12">
                                <h1 class="text-4xl md:text-5xl lg:text-6xl font-bold text-white">
                                    <?php the_title(); ?>
                                </h1>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <!-- Title Section (if not overlay) -->
            <?php if (!has_post_thumbnail() || !get_post_meta(get_the_ID(), '_show_title_overlay', true)) : ?>
                <header class="entry-header py-12 bg-gray-50">
                    <div class="container max-w-7xl">
                        <h1 class="text-4xl md:text-5xl font-bold text-navy mb-4">
                            <?php the_title(); ?>
                        </h1>
                        <?php if (get_the_excerpt()) : ?>
                            <p class="text-xl text-gray-600">
                                <?php echo esc_html(get_the_excerpt()); ?>
                            </p>
                        <?php endif; ?>
                    </div>
                </header>
            <?php endif; ?>

            <!-- Page Content -->
            <div class="entry-content py-16">
                <div class="container max-w-7xl">
                    <?php
                    the_content();

                    wp_link_pages(array(
                        'before' => '<div class="page-links mt-8 pt-8 border-t border-gray-200"><span class="font-bold">' . esc_html__('Pages:', 'dental-rubio') . '</span>',
                        'after'  => '</div>',
                        'class'  => 'inline-block mx-1 px-4 py-2 bg-navy text-white rounded hover:bg-navy-dark',
                    ));
                    ?>
                </div>
            </div>

            <!-- Custom Sections (via meta fields or blocks) -->
            <?php
            // Check for custom sections
            $show_cta = get_post_meta(get_the_ID(), '_show_bottom_cta', true);
            $cta_headline = get_post_meta(get_the_ID(), '_cta_headline', true);
            $cta_text = get_post_meta(get_the_ID(), '_cta_text', true);
            $cta_button_text = get_post_meta(get_the_ID(), '_cta_button_text', true);
            $cta_button_url = get_post_meta(get_the_ID(), '_cta_button_url', true);

            if ($show_cta && $cta_headline) :
            ?>
                <section class="bottom-cta py-16 bg-gradient-to-br from-navy to-navy-dark text-white">
                    <div class="container max-w-4xl text-center">
                        <h2 class="text-3xl md:text-4xl font-bold mb-4">
                            <?php echo esc_html($cta_headline); ?>
                        </h2>
                        <?php if ($cta_text) : ?>
                            <p class="text-xl text-gray-200 mb-8">
                                <?php echo esc_html($cta_text); ?>
                            </p>
                        <?php endif; ?>
                        <?php if ($cta_button_text && $cta_button_url) : ?>
                            <a href="<?php echo esc_url($cta_button_url); ?>"
                               class="btn bg-gold text-navy hover:bg-gold-light text-xl px-10 py-4">
                                <?php echo esc_html($cta_button_text); ?>
                            </a>
                        <?php else : ?>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                               class="btn bg-gold text-navy hover:bg-gold-light text-xl px-10 py-4">
                                <?php esc_html_e('Call Now', 'dental-rubio'); ?>
                            </a>
                        <?php endif; ?>
                    </div>
                </section>
            <?php endif; ?>

        </article>

        <?php
        // If comments are open or there's at least one comment, load the comment template
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
