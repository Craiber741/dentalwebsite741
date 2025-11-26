<?php
/**
 * Search Results Template
 *
 * Template for displaying search results with senior-friendly design.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$search_query = get_search_query();
$total_results = $GLOBALS['wp_query']->found_posts;
?>

<main id="main" class="search-results-page">

    <!-- Search Header -->
    <header class="search-header bg-gradient-to-br from-navy to-navy-dark text-white py-12 md:py-16">
        <div class="container max-w-7xl">
            <?php if ($total_results > 0) : ?>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <?php
                    /* translators: %s: search query */
                    printf(esc_html__('Search Results for: %s', 'dental-rubio'), '<span class="text-gold">"' . esc_html($search_query) . '"</span>');
                    ?>
                </h1>
                <p class="text-xl text-gray-200">
                    <?php
                    /* translators: %d: number of results */
                    printf(esc_html(_n('%d result found', '%d results found', $total_results, 'dental-rubio')), number_format_i18n($total_results));
                    ?>
                </p>
            <?php else : ?>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <?php esc_html_e('No Results Found', 'dental-rubio'); ?>
                </h1>
                <p class="text-xl text-gray-200">
                    <?php
                    /* translators: %s: search query */
                    printf(esc_html__('Sorry, no results found for: %s', 'dental-rubio'), '<span class="text-gold">"' . esc_html($search_query) . '"</span>');
                    ?>
                </p>
            <?php endif; ?>

            <!-- Search Form -->
            <div class="mt-8 max-w-2xl">
                <?php get_search_form(); ?>
            </div>
        </div>
    </header>

    <!-- Search Results -->
    <div class="search-content py-16 bg-gray-50">
        <div class="container max-w-7xl">

            <?php if (have_posts()) : ?>

                <div class="grid lg:grid-cols-3 gap-12">

                    <!-- Results Area -->
                    <div class="lg:col-span-2">

                        <!-- Results Grid -->
                        <div class="results-grid space-y-6">

                            <?php while (have_posts()) : the_post(); ?>

                                <article id="post-<?php the_ID(); ?>" <?php post_class('bg-white rounded-lg shadow-sm hover:shadow-md transition p-6'); ?>>

                                    <!-- Post Type Badge -->
                                    <div class="mb-3">
                                        <span class="inline-block text-xs font-semibold px-3 py-1 rounded-full
                                            <?php echo get_post_type() === 'page' ? 'bg-blue-100 text-blue-700' : 'bg-green-100 text-green-700'; ?>">
                                            <?php echo ucfirst(get_post_type()); ?>
                                        </span>
                                    </div>

                                    <!-- Title -->
                                    <h2 class="text-2xl md:text-3xl font-bold mb-3">
                                        <a href="<?php the_permalink(); ?>" class="text-navy hover:text-gold transition">
                                            <?php the_title(); ?>
                                        </a>
                                    </h2>

                                    <!-- URL -->
                                    <p class="text-sm text-gray-500 mb-3">
                                        <?php the_permalink(); ?>
                                    </p>

                                    <!-- Excerpt with highlighted search terms -->
                                    <div class="text-gray-700 mb-4">
                                        <?php
                                        $excerpt = get_the_excerpt();
                                        // Highlight search terms
                                        if ($search_query) {
                                            $excerpt = preg_replace('/(' . preg_quote($search_query, '/') . ')/i', '<mark class="bg-yellow-200 font-semibold">$1</mark>', $excerpt);
                                        }
                                        echo wp_kses_post($excerpt);
                                        ?>
                                    </div>

                                    <!-- Meta Info -->
                                    <div class="flex flex-wrap items-center gap-4 text-sm text-gray-600">
                                        <?php if (get_post_type() === 'post') : ?>
                                            <span class="flex items-center gap-1">
                                                <span aria-hidden="true">📅</span>
                                                <time datetime="<?php echo esc_attr(get_the_date('c')); ?>">
                                                    <?php echo get_the_date(); ?>
                                                </time>
                                            </span>
                                        <?php endif; ?>

                                        <!-- Categories/Tags -->
                                        <?php
                                        $categories = get_the_category();
                                        if (!empty($categories)) :
                                            foreach (array_slice($categories, 0, 2) as $category) :
                                        ?>
                                            <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"
                                               class="text-gold hover:underline">
                                                <?php echo esc_html($category->name); ?>
                                            </a>
                                        <?php
                                            endforeach;
                                        endif;
                                        ?>
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
                                'screen_reader_text' => __('Search results navigation', 'dental-rubio'),
                            ));
                            ?>
                        </div>

                    </div>

                    <!-- Sidebar -->
                    <aside class="lg:col-span-1">

                        <!-- Popular Pages -->
                        <div class="widget bg-white p-6 rounded-lg shadow-sm mb-8">
                            <h3 class="text-xl font-bold text-navy mb-4">
                                <?php esc_html_e('Popular Pages', 'dental-rubio'); ?>
                            </h3>
                            <ul class="space-y-3">
                                <li>
                                    <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>" class="text-gray-700 hover:text-gold transition">
                                        <?php esc_html_e('Dental Implants', 'dental-rubio'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>" class="text-gray-700 hover:text-gold transition">
                                        <?php esc_html_e('All-on-4 Implants', 'dental-rubio'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/pricing/')); ?>" class="text-gray-700 hover:text-gold transition">
                                        <?php esc_html_e('Pricing', 'dental-rubio'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/travel-guide/')); ?>" class="text-gray-700 hover:text-gold transition">
                                        <?php esc_html_e('Travel Guide', 'dental-rubio'); ?>
                                    </a>
                                </li>
                                <li>
                                    <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="text-gray-700 hover:text-gold transition">
                                        <?php esc_html_e('Contact Us', 'dental-rubio'); ?>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <!-- CTA Widget -->
                        <div class="widget bg-gradient-to-br from-navy to-navy-dark text-white p-6 rounded-lg shadow-lg">
                            <h3 class="text-xl font-bold mb-4">
                                <?php esc_html_e('Need Help Finding Something?', 'dental-rubio'); ?>
                            </h3>
                            <p class="text-gray-200 mb-4">
                                <?php esc_html_e('Call us and we\'ll help you find what you need', 'dental-rubio'); ?>
                            </p>
                            <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                               class="btn bg-gold text-navy hover:bg-gold-light w-full text-center">
                                <?php esc_html_e('Call Now', 'dental-rubio'); ?>
                            </a>
                        </div>

                    </aside>

                </div>

            <?php else : ?>

                <!-- No Results Content -->
                <div class="max-w-4xl mx-auto">

                    <div class="bg-white rounded-lg shadow-sm p-8 md:p-12 mb-8">
                        <h2 class="text-2xl font-bold text-navy mb-4">
                            <?php esc_html_e('Search Tips', 'dental-rubio'); ?>
                        </h2>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <span class="text-gold flex-shrink-0">•</span>
                                <span><?php esc_html_e('Try using different keywords', 'dental-rubio'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-gold flex-shrink-0">•</span>
                                <span><?php esc_html_e('Use fewer words in your search', 'dental-rubio'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-gold flex-shrink-0">•</span>
                                <span><?php esc_html_e('Check spelling of your search terms', 'dental-rubio'); ?></span>
                            </li>
                            <li class="flex items-start gap-2">
                                <span class="text-gold flex-shrink-0">•</span>
                                <span><?php esc_html_e('Browse our categories or popular pages below', 'dental-rubio'); ?></span>
                            </li>
                        </ul>
                    </div>

                    <!-- Popular Pages Grid -->
                    <div class="grid md:grid-cols-2 gap-6 mb-8">
                        <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>"
                           class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                            <h3 class="text-xl font-bold text-navy mb-2">
                                <?php esc_html_e('Dental Implants', 'dental-rubio'); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php esc_html_e('Learn about premium Straumann implants', 'dental-rubio'); ?>
                            </p>
                        </a>
                        <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>"
                           class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                            <h3 class="text-xl font-bold text-navy mb-2">
                                <?php esc_html_e('All-on-4 Implants', 'dental-rubio'); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php esc_html_e('Complete smile restoration', 'dental-rubio'); ?>
                            </p>
                        </a>
                        <a href="<?php echo esc_url(home_url('/pricing/')); ?>"
                           class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                            <h3 class="text-xl font-bold text-navy mb-2">
                                <?php esc_html_e('Pricing', 'dental-rubio'); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php esc_html_e('Transparent pricing and cost calculators', 'dental-rubio'); ?>
                            </p>
                        </a>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                           class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition">
                            <h3 class="text-xl font-bold text-navy mb-2">
                                <?php esc_html_e('Contact Us', 'dental-rubio'); ?>
                            </h3>
                            <p class="text-gray-600">
                                <?php esc_html_e('Get in touch with our team', 'dental-rubio'); ?>
                            </p>
                        </a>
                    </div>

                    <!-- Final CTA -->
                    <div class="bg-gradient-to-br from-gold to-gold-dark p-8 rounded-lg text-center">
                        <h3 class="text-2xl font-bold text-navy mb-4">
                            <?php esc_html_e('Still can\'t find what you\'re looking for?', 'dental-rubio'); ?>
                        </h3>
                        <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                           class="btn bg-navy text-white hover:bg-navy-dark text-xl px-10 py-4">
                            <?php esc_html_e('Call Us for Help', 'dental-rubio'); ?>
                        </a>
                    </div>

                </div>

            <?php endif; ?>

        </div>
    </div>

</main>

<?php get_footer(); ?>
