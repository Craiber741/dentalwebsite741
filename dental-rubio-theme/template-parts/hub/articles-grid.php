<?php
/**
 * Hub Articles Grid
 *
 * Displays a grid of related articles, resources, or child pages.
 * Can show custom post types or child pages based on hub configuration.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get hub configuration
$hub_type = get_post_meta(get_the_ID(), '_hub_type', true);
$articles_source = get_post_meta(get_the_ID(), '_hub_articles_source', true);

// Default to child pages if not specified
if (!$articles_source) {
    $articles_source = 'child_pages';
}

// Query based on source type
if ($articles_source === 'child_pages') {
    // Get child pages
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => get_the_ID(),
        'posts_per_page' => 12,
        'orderby'        => 'menu_order',
        'order'          => 'ASC',
    );
} elseif ($articles_source === 'recent_posts') {
    // Get recent blog posts
    $args = array(
        'post_type'      => 'post',
        'posts_per_page' => 9,
        'post_status'    => 'publish',
    );
} elseif ($articles_source === 'custom') {
    // Custom query from meta field
    $custom_post_ids = get_post_meta(get_the_ID(), '_hub_custom_posts', true);
    $args = array(
        'post_type'      => 'any',
        'post__in'       => $custom_post_ids ? explode(',', $custom_post_ids) : array(),
        'posts_per_page' => -1,
        'orderby'        => 'post__in',
    );
} else {
    $args = array(
        'post_type'      => 'page',
        'post_parent'    => get_the_ID(),
        'posts_per_page' => 12,
    );
}

$hub_query = new WP_Query($args);

if ($hub_query->have_posts()) :
?>

<section class="hub-articles-grid mb-12">

    <!-- Section Header -->
    <div class="mb-8">
        <h2 class="text-2xl md:text-3xl font-bold text-navy mb-3">
            <?php
            $grid_title = get_post_meta(get_the_ID(), '_hub_grid_title', true);
            echo $grid_title ? esc_html($grid_title) : esc_html__('Featured Resources', 'dental-rubio');
            ?>
        </h2>
        <p class="text-gray-600 text-lg">
            <?php
            $grid_description = get_post_meta(get_the_ID(), '_hub_grid_description', true);
            echo $grid_description ? esc_html($grid_description) : '';
            ?>
        </p>
    </div>

    <!-- Articles Grid -->
    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">

        <?php while ($hub_query->have_posts()) : $hub_query->the_post(); ?>

            <article class="hub-card bg-white rounded-lg shadow-sm hover:shadow-lg transition-shadow overflow-hidden">

                <!-- Featured Image -->
                <?php if (has_post_thumbnail()) : ?>
                    <div class="hub-card-image aspect-video overflow-hidden">
                        <a href="<?php the_permalink(); ?>">
                            <?php
                            the_post_thumbnail('medium', array(
                                'class' => 'w-full h-full object-cover hover:scale-105 transition-transform duration-300',
                                'loading' => 'lazy',
                            ));
                            ?>
                        </a>
                    </div>
                <?php endif; ?>

                <!-- Card Content -->
                <div class="hub-card-content p-6">

                    <!-- Category/Type Badge -->
                    <?php
                    $categories = get_the_category();
                    if (!empty($categories)) :
                    ?>
                        <span class="inline-block text-xs font-semibold text-gold bg-gold/10 px-3 py-1 rounded-full mb-3">
                            <?php echo esc_html($categories[0]->name); ?>
                        </span>
                    <?php endif; ?>

                    <!-- Title -->
                    <h3 class="text-xl font-bold mb-3">
                        <a href="<?php the_permalink(); ?>" class="text-navy hover:text-gold transition">
                            <?php the_title(); ?>
                        </a>
                    </h3>

                    <!-- Excerpt -->
                    <p class="text-gray-600 mb-4 line-clamp-3">
                        <?php echo wp_trim_words(get_the_excerpt(), 20); ?>
                    </p>

                    <!-- Read More Link -->
                    <a href="<?php the_permalink(); ?>"
                       class="inline-flex items-center gap-2 text-gold font-semibold hover:gap-3 transition-all">
                        <?php esc_html_e('Learn More', 'dental-rubio'); ?>
                        <span aria-hidden="true">→</span>
                    </a>

                    <!-- Meta Info (optional) -->
                    <?php
                    $show_date = get_post_meta(get_the_ID(), '_hub_show_dates', true);
                    if ($show_date && get_post_type() === 'post') :
                    ?>
                        <div class="mt-4 pt-4 border-t border-gray-200 text-sm text-gray-500">
                            <?php echo get_the_date(); ?>
                        </div>
                    <?php endif; ?>

                </div>

            </article>

        <?php endwhile; ?>

    </div>

    <!-- View All Link (if applicable) -->
    <?php
    $view_all_link = get_post_meta(get_the_ID(), '_hub_view_all_link', true);
    $view_all_text = get_post_meta(get_the_ID(), '_hub_view_all_text', true);
    if ($view_all_link) :
    ?>
        <div class="text-center mt-10">
            <a href="<?php echo esc_url($view_all_link); ?>"
               class="btn btn-primary">
                <?php echo $view_all_text ? esc_html($view_all_text) : esc_html__('View All Resources', 'dental-rubio'); ?>
            </a>
        </div>
    <?php endif; ?>

</section>

<?php
    wp_reset_postdata();
else :
?>

<section class="hub-articles-grid mb-12">
    <div class="bg-white p-8 rounded-lg shadow-sm text-center">
        <p class="text-gray-600 text-lg">
            <?php esc_html_e('No resources available at this time. Check back soon!', 'dental-rubio'); ?>
        </p>
    </div>
</section>

<?php endif; ?>
