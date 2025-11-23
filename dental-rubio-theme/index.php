<?php
/**
 * Main Index Template
 *
 * The main template file. This is the most generic template file in a
 * WordPress theme and one of the two required files for a theme.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="content-area py-12 md:py-16">
    <div class="container max-w-7xl">

        <?php if (is_home() && !is_front_page()) : ?>
            <header class="page-header mb-12">
                <h1 class="text-3xl md:text-4xl font-bold"><?php single_post_title(); ?></h1>
            </header>
        <?php endif; ?>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-12">

            <!-- Main Content -->
            <div class="lg:col-span-2">

                <?php if (have_posts()) : ?>

                    <div class="posts-grid grid gap-8">
                        <?php
                        while (have_posts()) :
                            the_post();
                        ?>
                            <article id="post-<?php the_ID(); ?>" <?php post_class('card card-white'); ?>>

                                <?php if (has_post_thumbnail()) : ?>
                                    <div class="post-thumbnail mb-4">
                                        <a href="<?php the_permalink(); ?>">
                                            <?php the_post_thumbnail('large', array('class' => 'rounded-lg w-full h-auto')); ?>
                                        </a>
                                    </div>
                                <?php endif; ?>

                                <header class="entry-header mb-4">
                                    <?php
                                    if (is_singular()) :
                                        the_title('<h1 class="entry-title text-3xl font-bold">', '</h1>');
                                    else :
                                        the_title('<h2 class="entry-title text-2xl font-bold"><a href="' . esc_url(get_permalink()) . '" rel="bookmark">', '</a></h2>');
                                    endif;
                                    ?>

                                    <?php if ('post' === get_post_type()) : ?>
                                        <div class="entry-meta text-sm text-secondary mt-2">
                                            <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                <?php echo esc_html(get_the_date()); ?>
                                            </time>
                                            <span class="mx-2">|</span>
                                            <span><?php the_author(); ?></span>
                                        </div>
                                    <?php endif; ?>
                                </header>

                                <div class="entry-summary">
                                    <?php the_excerpt(); ?>
                                </div>

                                <footer class="entry-footer mt-4">
                                    <a href="<?php the_permalink(); ?>" class="btn btn-primary btn-sm">
                                        <?php esc_html_e('Read More', 'dental-rubio'); ?>
                                        <?php echo dental_rubio_icon('arrow-right', 16); ?>
                                    </a>
                                </footer>

                            </article>
                        <?php endwhile; ?>
                    </div>

                    <!-- Pagination -->
                    <nav class="pagination mt-12">
                        <?php
                        the_posts_pagination(array(
                            'mid_size'  => 2,
                            'prev_text' => '&laquo; ' . __('Previous', 'dental-rubio'),
                            'next_text' => __('Next', 'dental-rubio') . ' &raquo;',
                        ));
                        ?>
                    </nav>

                <?php else : ?>

                    <div class="no-results text-center py-12">
                        <h2 class="text-2xl font-bold mb-4"><?php esc_html_e('Nothing Found', 'dental-rubio'); ?></h2>
                        <p class="text-secondary mb-6">
                            <?php esc_html_e('It seems we can\'t find what you\'re looking for. Perhaps searching can help.', 'dental-rubio'); ?>
                        </p>
                        <?php get_search_form(); ?>
                    </div>

                <?php endif; ?>

            </div>

            <!-- Sidebar -->
            <aside class="sidebar lg:col-span-1">
                <?php if (is_active_sidebar('blog-sidebar')) : ?>
                    <?php dynamic_sidebar('blog-sidebar'); ?>
                <?php else : ?>
                    <!-- Default Sidebar Content -->
                    <div class="widget mb-8 p-6 bg-light rounded-lg">
                        <h4 class="widget-title text-xl font-bold mb-4"><?php esc_html_e('Contact Us', 'dental-rubio'); ?></h4>
                        <p class="mb-4"><?php esc_html_e('Ready for your new smile? Contact us today!', 'dental-rubio'); ?></p>
                        <a href="tel:+1<?php echo preg_replace('/[^0-9]/', '', dental_rubio_get_phone()); ?>" class="btn btn-primary btn-block">
                            <?php echo esc_html(dental_rubio_get_phone()); ?>
                        </a>
                    </div>

                    <div class="widget mb-8 p-6 bg-navy text-white rounded-lg">
                        <h4 class="widget-title text-xl font-bold mb-4 text-white"><?php esc_html_e('Why Choose Us?', 'dental-rubio'); ?></h4>
                        <ul class="space-y-3 text-sm">
                            <li class="flex items-start gap-2">
                                <span class="text-gold">&#10003;</span>
                                <span><?php esc_html_e('40+ Years Experience', 'dental-rubio'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-gold">&#10003;</span>
                                <span><?php esc_html_e('51,237+ Happy Patients', 'dental-rubio'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-gold">&#10003;</span>
                                <span><?php esc_html_e('100% Straumann Implants', 'dental-rubio'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-gold">&#10003;</span>
                                <span><?php esc_html_e('Save up to 70%', 'dental-rubio'); ?></span>
                            </li>
                        </ul>
                    </div>
                <?php endif; ?>
            </aside>

        </div>

    </div>
</div>

<?php
get_footer();
