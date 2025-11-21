<?php
/**
 * Single Post Template
 *
 * The template for displaying single posts.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>

        <!-- Article Header -->
        <header class="entry-header bg-navy text-white py-16">
            <div class="container max-w-4xl">
                <h1 class="entry-title text-3xl md:text-4xl lg:text-5xl font-bold mb-6">
                    <?php the_title(); ?>
                </h1>

                <div class="entry-meta flex flex-wrap items-center gap-4 text-gray-300">
                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>" class="flex items-center gap-2">
                        <span>&#128197;</span>
                        <?php echo esc_html(get_the_date()); ?>
                    </time>

                    <span class="flex items-center gap-2">
                        <span>&#128100;</span>
                        <?php the_author(); ?>
                    </span>

                    <?php if (has_category()) : ?>
                        <span class="flex items-center gap-2">
                            <span>&#128193;</span>
                            <?php the_category(', '); ?>
                        </span>
                    <?php endif; ?>

                    <?php
                    $reading_time = dental_rubio_reading_time();
                    if ($reading_time) :
                    ?>
                        <span class="flex items-center gap-2">
                            <span>&#128338;</span>
                            <?php echo esc_html($reading_time); ?> <?php esc_html_e('min read', 'dental-rubio'); ?>
                        </span>
                    <?php endif; ?>
                </div>
            </div>
        </header>

        <!-- Featured Image -->
        <?php if (has_post_thumbnail()) : ?>
            <div class="post-thumbnail -mt-8">
                <div class="container max-w-4xl">
                    <?php the_post_thumbnail('large', array('class' => 'rounded-lg w-full h-auto shadow-lg')); ?>
                </div>
            </div>
        <?php endif; ?>

        <!-- Article Content -->
        <div class="entry-content py-12">
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

        <!-- Tags -->
        <?php if (has_tag()) : ?>
            <div class="entry-tags py-6 border-t border-b border-gray-200">
                <div class="container max-w-4xl">
                    <div class="flex flex-wrap items-center gap-2">
                        <span class="font-semibold"><?php esc_html_e('Tags:', 'dental-rubio'); ?></span>
                        <?php the_tags('', '', ''); ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- CTA Section -->
        <section class="post-cta py-12 bg-gold/10">
            <div class="container max-w-4xl text-center">
                <h2 class="text-2xl md:text-3xl font-bold mb-4">
                    <?php esc_html_e('Ready for Your New Smile?', 'dental-rubio'); ?>
                </h2>
                <p class="text-lg text-secondary mb-6">
                    <?php esc_html_e('Contact us today for a free consultation and price quote.', 'dental-rubio'); ?>
                </p>
                <div class="flex flex-wrap justify-center gap-4">
                    <a href="tel:+1<?php echo preg_replace('/[^0-9]/', '', dental_rubio_get_phone()); ?>" class="btn btn-primary">
                        <?php echo dental_rubio_icon('phone', 20); ?>
                        <span><?php esc_html_e('Call Now', 'dental-rubio'); ?></span>
                    </a>
                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="btn btn-gold">
                        <?php esc_html_e('Get Free Quote', 'dental-rubio'); ?>
                    </a>
                </div>
            </div>
        </section>

        <!-- Post Navigation -->
        <nav class="post-navigation py-8 border-t border-gray-200">
            <div class="container max-w-4xl">
                <div class="grid md:grid-cols-2 gap-6">
                    <?php
                    $prev_post = get_previous_post();
                    $next_post = get_next_post();
                    ?>

                    <?php if ($prev_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($prev_post)); ?>" class="flex items-center gap-4 p-4 bg-light rounded-lg hover:bg-gray-100 transition">
                            <span class="text-2xl">&larr;</span>
                            <div>
                                <span class="text-sm text-secondary"><?php esc_html_e('Previous', 'dental-rubio'); ?></span>
                                <p class="font-semibold"><?php echo esc_html(get_the_title($prev_post)); ?></p>
                            </div>
                        </a>
                    <?php else : ?>
                        <div></div>
                    <?php endif; ?>

                    <?php if ($next_post) : ?>
                        <a href="<?php echo esc_url(get_permalink($next_post)); ?>" class="flex items-center justify-end gap-4 p-4 bg-light rounded-lg hover:bg-gray-100 transition text-right">
                            <div>
                                <span class="text-sm text-secondary"><?php esc_html_e('Next', 'dental-rubio'); ?></span>
                                <p class="font-semibold"><?php echo esc_html(get_the_title($next_post)); ?></p>
                            </div>
                            <span class="text-2xl">&rarr;</span>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </nav>

        <!-- Comments -->
        <?php
        if (comments_open() || get_comments_number()) :
            comments_template();
        endif;
        ?>

    <?php endwhile; endif; ?>

</article>

<?php
/**
 * Calculate reading time
 */
function dental_rubio_reading_time() {
    $content = get_post_field('post_content', get_the_ID());
    $word_count = str_word_count(strip_tags($content));
    $reading_time = ceil($word_count / 200); // Average reading speed

    return $reading_time;
}

get_footer();
