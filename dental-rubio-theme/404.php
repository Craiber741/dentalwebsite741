<?php
/**
 * 404 Page Template
 *
 * The template for displaying 404 pages (not found).
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<div class="error-404 not-found">

    <!-- 404 Header -->
    <header class="page-header bg-navy text-white py-20">
        <div class="container max-w-4xl text-center">
            <p class="text-8xl md:text-9xl font-bold text-gold mb-4">404</p>
            <h1 class="page-title text-3xl md:text-4xl font-bold mb-4">
                <?php esc_html_e('Page Not Found', 'dental-rubio'); ?>
            </h1>
            <p class="text-xl text-gray-300">
                <?php esc_html_e('Oops! The page you\'re looking for doesn\'t exist or has been moved.', 'dental-rubio'); ?>
            </p>
        </div>
    </header>

    <!-- 404 Content -->
    <div class="page-content py-16">
        <div class="container max-w-4xl">

            <div class="text-center mb-12">
                <h2 class="text-2xl font-bold mb-4">
                    <?php esc_html_e('Let\'s Get You Back on Track', 'dental-rubio'); ?>
                </h2>
                <p class="text-lg text-secondary mb-8">
                    <?php esc_html_e('Here are some helpful links to get you where you need to go:', 'dental-rubio'); ?>
                </p>
            </div>

            <!-- Quick Links -->
            <div class="grid md:grid-cols-3 gap-6 mb-12">
                <a href="<?php echo esc_url(home_url('/')); ?>" class="card text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">&#127968;</div>
                    <h3 class="text-xl font-bold mb-2"><?php esc_html_e('Homepage', 'dental-rubio'); ?></h3>
                    <p class="text-secondary text-sm"><?php esc_html_e('Start fresh from our homepage', 'dental-rubio'); ?></p>
                </a>

                <a href="<?php echo esc_url(home_url('/services/')); ?>" class="card text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">&#129463;</div>
                    <h3 class="text-xl font-bold mb-2"><?php esc_html_e('Our Services', 'dental-rubio'); ?></h3>
                    <p class="text-secondary text-sm"><?php esc_html_e('View our dental services', 'dental-rubio'); ?></p>
                </a>

                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="card text-center hover:shadow-lg transition">
                    <div class="text-4xl mb-3">&#128222;</div>
                    <h3 class="text-xl font-bold mb-2"><?php esc_html_e('Contact Us', 'dental-rubio'); ?></h3>
                    <p class="text-secondary text-sm"><?php esc_html_e('Get in touch with our team', 'dental-rubio'); ?></p>
                </a>
            </div>

            <!-- Search -->
            <div class="search-section text-center p-8 bg-light rounded-lg mb-12">
                <h3 class="text-xl font-bold mb-4">
                    <?php esc_html_e('Or Try Searching', 'dental-rubio'); ?>
                </h3>
                <?php get_search_form(); ?>
            </div>

            <!-- Popular Services -->
            <div class="popular-services">
                <h3 class="text-xl font-bold mb-6 text-center">
                    <?php esc_html_e('Popular Services', 'dental-rubio'); ?>
                </h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>" class="btn btn-secondary btn-block">
                        <?php esc_html_e('Dental Implants', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>" class="btn btn-secondary btn-block">
                        <?php esc_html_e('All-on-4', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/crowns/')); ?>" class="btn btn-secondary btn-block">
                        <?php esc_html_e('Crowns & Bridges', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/dentures/')); ?>" class="btn btn-secondary btn-block">
                        <?php esc_html_e('Dentures', 'dental-rubio'); ?>
                    </a>
                </div>
            </div>

        </div>
    </div>

    <!-- CTA Section -->
    <section class="cta-section py-12 bg-navy text-white">
        <div class="container max-w-4xl text-center">
            <h2 class="text-2xl md:text-3xl font-bold mb-4">
                <?php esc_html_e('Need Help?', 'dental-rubio'); ?>
            </h2>
            <p class="text-lg text-gray-300 mb-6">
                <?php esc_html_e('Call us directly and we\'ll help you find what you\'re looking for.', 'dental-rubio'); ?>
            </p>
            <a href="tel:+1<?php echo preg_replace('/[^0-9]/', '', dental_rubio_get_phone()); ?>" class="btn btn-gold btn-lg">
                <?php echo dental_rubio_icon('phone', 24); ?>
                <span><?php echo esc_html(dental_rubio_get_phone()); ?></span>
            </a>
        </div>
    </section>

</div>

<?php
get_footer();
