<?php
/**
 * Archive Template
 *
 * Template for displaying post archives, categories, tags, and date archives.
 * Senior-friendly design with large text and clear navigation.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="archive-page">

    <!-- Archive Header -->
    <header class="archive-header bg-gradient-to-br from-navy to-navy-dark text-white py-12 md:py-16">
        <div class="container max-w-7xl">
            <?php the_archive_title('<h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">', '</h1>'); ?>
            <?php
            $description = get_the_archive_description();
            if ($description) :
            ?>
                <div class="archive-description text-xl text-gray-200 max-w-3xl">
                    <?php echo wp_kses_post($description); ?>
                </div>
            <?php endif; ?>
        </div>
    </header>

    <!-- Archive Content -->
    <div class="archive-content py-16 bg-gray-50">
        <div class="container max-w-7xl">
            <div class="grid lg:grid-cols-3 gap-12">

                <!-- Main Posts Area -->
                <div class="lg:col-span-2">

                    <?php if (have_posts()) : ?>

                        <!-- Posts Grid -->
                        <div class="posts-grid space-y-8">

                            <?php while (have_posts()) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm hover:shadow-md transition overflow-hidden'); ?>>

                                    <div class="grid md:grid-cols-3 gap-0">

                                        <!-- Featured Image -->
                                        <?php if (has_post_thumbnail()) : ?>
                                            <div class="md:col-span-1">
                                                <a href="<?php the_permalink(); ?>" class="block h-full">
                                                    <?php
                                                    the_post_thumbnail('medium', array(
                                                        'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300',
                                                        'loading' => 'lazy',
                                                    ));
                                                    ?>
                                                </a>
                                            </div>
                                        <?php endif; ?>

                                        <!-- Post Content -->
                                        <div class="<?php echo has_post_thumbnail() ? 'md:col-span-2' : 'md:col-span-3'; ?> p-6 md:p-8">

                                            <!-- Categories -->
                                            <div class="post-meta mb-3">
                                                <?php
                                                $categories = get_the_category();
                                                if (!empty($categories)) :
                                                    foreach ($categories as $category) :
                                                ?>
                                                    <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                                                       class="inline-block text-xs font-semibold text-gold bg-gold/10 px-3 py-1 rounded-full mr-2 mb-2 hover:bg-gold/20">
                                                        <?php echo esc_html($category->name); ?>
                                                    </a>
                                                <?php
                                                    endforeach;
                                                endif;
                                                ?>
                                            </div>

                                            <!-- Title -->
                                            <h2 class="text-2xl md:text-3xl font-bold mb-3">
                                                <a href="<?php the_permalink(); ?>" class="text-navy hover:text-gold transition">
                                                    <?php the_title(); ?>
                                                </a>
                                            </h2>

                                            <!-- Meta Info -->
                                            <div class="post-meta flex flex-wrap items-center gap-4 text-sm text-gray-600 mb-4">
                                                <span class="flex items-center gap-1">
                                                    <span aria-hidden="true">📅</span>
                                                    <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                        <?php echo get_the_date(); ?>
                                                    </time>
                                                </span>
                                                <?php if (get_the_author()) : ?>
                                                    <span class="flex items-center gap-1">
                                                        <span aria-hidden="true">✍️</span>
                                                        <span><?php the_author(); ?></span>
                                                    </span>
                                                <?php endif; ?>
                                            </div>

                                            <!-- Excerpt -->
                                            <div class="post-excerpt text-gray-700 mb-4">
                                                <?php the_excerpt(); ?>
                                            </div>

                                            <!-- Read More -->
                                            <a href="<?php the_permalink(); ?>"
                                               class="inline-flex items-center gap-2 text-gold font-semibold hover:gap-3 transition-all">
                                                <?php esc_html_e('Read More', 'dental-rubio'); ?>
                                                <span aria-hidden="true">→</span>
                                            </a>

                                        </div>

                                    </div>

                                </article>

                            <?php endwhile; ?>

                        </div>

                        <!-- Pagination -->
                        <div class="pagination mt-12">
                            <?php
                            the_posts_pagination(array(
                                'mid_size'           => 2,
                                'prev_text'          => __('← Previous', 'dental-rubio'),
                                'next_text'          => __('Next →', 'dental-rubio'),
                                'class'              => 'flex justify-center gap-2',
                                'screen_reader_text' => __('Posts navigation', 'dental-rubio'),
                            ));
                            ?>
                        </div>

                    <?php else : ?>

                        <!-- No Posts Found -->
                        <div class="bg-white rounded-lg shadow-sm p-8 md:p-12 text-center">
                            <h2 class="text-2xl font-bold text-navy mb-4">
                                <?php esc_html_e('No posts found', 'dental-rubio'); ?>
                            </h2>
                            <p class="text-gray-600 mb-6">
                                <?php esc_html_e('Sorry, no posts match your criteria. Try searching or browse our categories.', 'dental-rubio'); ?>
                            </p>
                            <a href="<?php echo esc_url(home_url('/')); ?>" class="btn btn-primary">
                                <?php esc_html_e('Go to Homepage', 'dental-rubio'); ?>
                            </a>
                        </div>

                    <?php endif; ?>

                </div>

                <!-- Sidebar -->
                <aside class="lg:col-span-1">

                    <!-- Search -->
                    <div class="widget bg-white p-6 rounded-lg shadow-sm mb-8">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            <?php esc_html_e('Search', 'dental-rubio'); ?>
                        </h3>
                        <?php get_search_form(); ?>
                    </div>

                    <!-- Categories -->
                    <div class="widget bg-white p-6 rounded-lg shadow-sm mb-8">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            <?php esc_html_e('Categories', 'dental-rubio'); ?>
                        </h3>
                        <ul class="space-y-2">
                            <?php
                            wp_list_categories(array(
                                'title_li'     => '',
                                'show_count'   => true,
                                'hierarchical' => true,
                                'depth'        => 2,
                            ));
                            ?>
                        </ul>
                    </div>

                    <!-- Recent Posts -->
                    <div class="widget bg-white p-6 rounded-lg shadow-sm mb-8">
                        <h3 class="text-xl font-bold text-navy mb-4">
                            <?php esc_html_e('Recent Posts', 'dental-rubio'); ?>
                        </h3>
                        <ul class="space-y-3">
                            <?php
                            $recent_posts = new WP_Query(array(
                                'posts_per_page' => 5,
                                'post_status'    => 'publish',
                            ));

                            if ($recent_posts->have_posts()) :
                                while ($recent_posts->have_posts()) : $recent_posts->the_post();
                            ?>
                                    <li>
                                        <a href="<?php the_permalink(); ?>" class="text-gray-700 hover:text-gold transition">
                                            <?php the_title(); ?>
                                        </a>
                                        <p class="text-xs text-gray-500 mt-1"><?php echo get_the_date(); ?></p>
                                    </li>
                            <?php
                                endwhile;
                                wp_reset_postdata();
                            endif;
                            ?>
                        </ul>
                    </div>

                    <!-- CTA Widget -->
                    <div class="widget bg-gradient-to-br from-navy to-navy-dark text-white p-6 rounded-lg shadow-lg">
                        <h3 class="text-xl font-bold mb-4">
                            <?php esc_html_e('Need Help?', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-gray-200 mb-4">
                            <?php esc_html_e('Call us for a free consultation', 'dental-rubio'); ?>
                        </p>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                           class="btn bg-gold text-navy hover:bg-gold-light w-full text-center">
                            <?php esc_html_e('Call Now', 'dental-rubio'); ?>
                        </a>
                    </div>

                    <!-- Sidebar Widget Area -->
                    <?php if (is_active_sidebar('blog-sidebar')) : ?>
                        <div class="widget-area">
                            <?php dynamic_sidebar('blog-sidebar'); ?>
                        </div>
                    <?php endif; ?>

                </aside>

            </div>
        </div>
    </div>

</main>

<?php get_footer(); ?>
