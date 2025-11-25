<?php
/**
 * Hub Intro Section
 *
 * Hero-style introduction for hub pages with title, description, and breadcrumbs.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get custom fields
$subtitle = get_post_meta(get_the_ID(), '_hub_subtitle', true);
$featured_stat_1 = get_post_meta(get_the_ID(), '_hub_stat_1', true);
$featured_stat_2 = get_post_meta(get_the_ID(), '_hub_stat_2', true);
$featured_stat_3 = get_post_meta(get_the_ID(), '_hub_stat_3', true);
?>

<section class="hub-intro bg-gradient-to-br from-navy to-navy-dark text-white py-16 md:py-20">
    <div class="container max-w-5xl">

        <!-- Breadcrumbs -->
        <nav class="breadcrumbs mb-6 text-sm" aria-label="<?php esc_attr_e('Breadcrumb', 'dental-rubio'); ?>">
            <ol class="flex items-center gap-2 text-gray-300">
                <li>
                    <a href="<?php echo esc_url(home_url('/')); ?>" class="hover:text-gold transition">
                        <?php esc_html_e('Home', 'dental-rubio'); ?>
                    </a>
                </li>
                <li aria-hidden="true">/</li>
                <li class="text-white font-semibold" aria-current="page">
                    <?php the_title(); ?>
                </li>
            </ol>
        </nav>

        <!-- Title & Subtitle -->
        <div class="mb-10">
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4 leading-tight">
                <?php the_title(); ?>
            </h1>

            <?php if ($subtitle) : ?>
                <p class="text-xl md:text-2xl text-gray-200 leading-relaxed">
                    <?php echo esc_html($subtitle); ?>
                </p>
            <?php else : ?>
                <p class="text-xl md:text-2xl text-gray-200 leading-relaxed">
                    <?php echo esc_html(get_the_excerpt()); ?>
                </p>
            <?php endif; ?>
        </div>

        <!-- Featured Stats (if available) -->
        <?php if ($featured_stat_1 || $featured_stat_2 || $featured_stat_3) : ?>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <?php if ($featured_stat_1) : ?>
                    <div class="text-center p-6 bg-navy-light/50 rounded-lg backdrop-blur-sm">
                        <p class="text-3xl md:text-4xl font-bold text-gold mb-2">
                            <?php echo esc_html($featured_stat_1['number']); ?>
                        </p>
                        <p class="text-sm text-gray-300">
                            <?php echo esc_html($featured_stat_1['label']); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if ($featured_stat_2) : ?>
                    <div class="text-center p-6 bg-navy-light/50 rounded-lg backdrop-blur-sm">
                        <p class="text-3xl md:text-4xl font-bold text-gold mb-2">
                            <?php echo esc_html($featured_stat_2['number']); ?>
                        </p>
                        <p class="text-sm text-gray-300">
                            <?php echo esc_html($featured_stat_2['label']); ?>
                        </p>
                    </div>
                <?php endif; ?>

                <?php if ($featured_stat_3) : ?>
                    <div class="text-center p-6 bg-navy-light/50 rounded-lg backdrop-blur-sm">
                        <p class="text-3xl md:text-4xl font-bold text-gold mb-2">
                            <?php echo esc_html($featured_stat_3['number']); ?>
                        </p>
                        <p class="text-sm text-gray-300">
                            <?php echo esc_html($featured_stat_3['label']); ?>
                        </p>
                    </div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <!-- Quick Jump Links (Table of Contents) -->
        <?php
        $toc_items = get_post_meta(get_the_ID(), '_hub_toc_items', true);
        if ($toc_items && is_array($toc_items)) :
        ?>
            <div class="mt-10 p-6 bg-white/10 backdrop-blur-sm rounded-lg">
                <h2 class="text-xl font-bold mb-4"><?php esc_html_e('Quick Navigation:', 'dental-rubio'); ?></h2>
                <ul class="grid md:grid-cols-2 gap-3">
                    <?php foreach ($toc_items as $item) : ?>
                        <li>
                            <a href="#<?php echo esc_attr(sanitize_title($item)); ?>"
                               class="flex items-center gap-2 text-gray-200 hover:text-gold transition">
                                <span aria-hidden="true">→</span>
                                <span><?php echo esc_html($item); ?></span>
                            </a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </div>
</section>
