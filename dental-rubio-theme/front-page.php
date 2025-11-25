<?php
/**
 * Front Page Template
 *
 * Homepage template that displays automatically for the site's front page.
 * Senior-friendly design with prominent CTAs and conversion optimization.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="front-page">

    <!-- Hero Section -->
    <?php get_template_part('template-parts/home/hero'); ?>

    <!-- Trust Bar -->
    <?php get_template_part('template-parts/home/trust-bar'); ?>

    <!-- Why Seniors Trust Us Section -->
    <section class="why-trust-us py-16 bg-white">
        <div class="container max-w-7xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center text-navy mb-4">
                <?php esc_html_e('Why Seniors Trust Us', 'dental-rubio'); ?>
            </h2>
            <p class="text-center text-gray-600 text-lg mb-12 max-w-3xl mx-auto">
                <?php esc_html_e('America\'s longest-serving dentist in Los Algodones, dedicated to quality and affordability since 1986.', 'dental-rubio'); ?>
            </p>

            <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-8">

                <!-- Trust Point 1 -->
                <div class="text-center">
                    <div class="text-5xl mb-4" aria-hidden="true">🏥</div>
                    <h3 class="text-xl font-bold mb-3 text-navy">
                        <?php esc_html_e('40+ Years Serving Snowbirds', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('We\'ve been welcoming winter visitors from USA & Canada since 1986. Three generations of expertise.', 'dental-rubio'); ?>
                    </p>
                </div>

                <!-- Trust Point 2 -->
                <div class="text-center">
                    <div class="text-5xl mb-4" aria-hidden="true">💰</div>
                    <h3 class="text-xl font-bold mb-3 text-navy">
                        <?php esc_html_e('Transparent Pricing', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('No hidden fees. Get exact quote before you visit. What we quote is what you pay. Guaranteed.', 'dental-rubio'); ?>
                    </p>
                </div>

                <!-- Trust Point 3 -->
                <div class="text-center">
                    <div class="text-5xl mb-4" aria-hidden="true">🗣️</div>
                    <h3 class="text-xl font-bold mb-3 text-navy">
                        <?php esc_html_e('English-Speaking Staff', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('Our entire team speaks fluent English. Feel at home and communicate easily throughout your visit.', 'dental-rubio'); ?>
                    </p>
                </div>

                <!-- Trust Point 4 -->
                <div class="text-center">
                    <div class="text-5xl mb-4" aria-hidden="true">🛡️</div>
                    <h3 class="text-xl font-bold mb-3 text-navy">
                        <?php esc_html_e('German Quality Standards', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('We use only Straumann implants from Germany - the world\'s best. Premium quality, affordable prices.', 'dental-rubio'); ?>
                    </p>
                </div>

            </div>
        </div>
    </section>

    <!-- Savings Calculator -->
    <?php get_template_part('template-parts/home/calculator'); ?>

    <!-- Featured Services -->
    <?php get_template_part('template-parts/home/services'); ?>

    <!-- Patient Testimonials -->
    <?php get_template_part('template-parts/home/testimonials'); ?>

    <!-- How It Works -->
    <?php get_template_part('template-parts/home/how-it-works'); ?>

    <!-- Safety Information -->
    <section class="safety-info py-16 bg-navy text-white">
        <div class="container max-w-5xl">
            <h2 class="text-3xl md:text-4xl font-bold text-center mb-6">
                <?php esc_html_e('Is Los Algodones Safe?', 'dental-rubio'); ?>
            </h2>

            <div class="bg-navy-light/50 backdrop-blur-sm p-8 rounded-lg mb-8">
                <p class="text-xl mb-6 text-center">
                    <?php esc_html_e('YES. Los Algodones is one of Mexico\'s safest border towns. Over 3,000 Americans visit daily for dental work. Here\'s why it\'s safe:', 'dental-rubio'); ?>
                </p>

                <div class="grid md:grid-cols-2 gap-6">
                    <div class="flex items-start gap-3">
                        <span class="text-2xl text-green-400 flex-shrink-0" aria-hidden="true">✓</span>
                        <span><?php esc_html_e('Walk across from Yuma in 5 minutes', 'dental-rubio'); ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-2xl text-green-400 flex-shrink-0" aria-hidden="true">✓</span>
                        <span><?php esc_html_e('U.S. Border Patrol on-site', 'dental-rubio'); ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-2xl text-green-400 flex-shrink-0" aria-hidden="true">✓</span>
                        <span><?php esc_html_e('Well-lit streets & friendly locals', 'dental-rubio'); ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-2xl text-green-400 flex-shrink-0" aria-hidden="true">✓</span>
                        <span><?php esc_html_e('Free parking on USA side', 'dental-rubio'); ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-2xl text-green-400 flex-shrink-0" aria-hidden="true">✓</span>
                        <span><?php esc_html_e('Most vendors speak English', 'dental-rubio'); ?></span>
                    </div>
                    <div class="flex items-start gap-3">
                        <span class="text-2xl text-green-400 flex-shrink-0" aria-hidden="true">✓</span>
                        <span><?php esc_html_e('Established tourist infrastructure', 'dental-rubio'); ?></span>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="<?php echo esc_url(home_url('/travel-guide/')); ?>"
                   class="btn bg-gold text-navy hover:bg-gold-light text-lg">
                    <?php esc_html_e('Read Our Complete Safety & Travel Guide', 'dental-rubio'); ?>
                </a>
            </div>
        </div>
    </section>

    <!-- Final CTA -->
    <?php get_template_part('template-parts/home/final-cta'); ?>

    <!-- Additional Content Section (optional) -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <?php if (get_the_content()) : ?>
            <section class="page-content py-16 bg-white">
                <div class="container max-w-4xl">
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>
    <?php endwhile; endif; ?>

</main>

<?php get_footer(); ?>
