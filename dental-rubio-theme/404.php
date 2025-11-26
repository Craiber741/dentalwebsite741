<?php
/**
 * 404 Page Template
 *
 * Senior-friendly 404 error page with helpful navigation and clear CTAs.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

get_header();

$phone = dental_rubio_get_phone();
$phone_clean = preg_replace('/[^0-9]/', '', $phone);
?>

<main id="main" class="error-404 not-found">

    <!-- 404 Header -->
    <header class="error-header bg-gradient-to-br from-navy to-navy-dark text-white py-16 md:py-20">
        <div class="container max-w-4xl text-center">
            <p class="text-8xl md:text-9xl font-bold text-gold mb-6" aria-hidden="true">404</p>
            <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                <?php esc_html_e('Page Not Found', 'dental-rubio'); ?>
            </h1>
            <p class="text-xl md:text-2xl text-gray-200">
                <?php esc_html_e('Oops! The page you\'re looking for doesn\'t exist or has been moved.', 'dental-rubio'); ?>
            </p>
        </div>
    </header>

    <!-- 404 Content -->
    <div class="error-content py-16 bg-white">
        <div class="container max-w-6xl">

            <!-- Intro -->
            <div class="text-center mb-12">
                <h2 class="text-2xl md:text-3xl font-bold text-navy mb-4">
                    <?php esc_html_e('Let\'s Get You Back on Track', 'dental-rubio'); ?>
                </h2>
                <p class="text-lg md:text-xl text-gray-600">
                    <?php esc_html_e('Here are some helpful links to get you where you need to go:', 'dental-rubio'); ?>
                </p>
            </div>

            <!-- Quick Links Grid -->
            <div class="grid md:grid-cols-3 gap-8 mb-12">

                <!-- Homepage -->
                <a href="<?php echo esc_url(home_url('/')); ?>"
                   class="bg-white border-2 border-gray-200 rounded-lg p-8 text-center hover:border-gold hover:shadow-lg transition">
                    <div class="text-6xl mb-4" aria-hidden="true">🏠</div>
                    <h3 class="text-xl font-bold text-navy mb-2">
                        <?php esc_html_e('Homepage', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('Start fresh from our homepage', 'dental-rubio'); ?>
                    </p>
                </a>

                <!-- Services -->
                <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>"
                   class="bg-white border-2 border-gray-200 rounded-lg p-8 text-center hover:border-gold hover:shadow-lg transition">
                    <div class="text-6xl mb-4" aria-hidden="true">🦷</div>
                    <h3 class="text-xl font-bold text-navy mb-2">
                        <?php esc_html_e('Our Services', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('View our dental services', 'dental-rubio'); ?>
                    </p>
                </a>

                <!-- Contact -->
                <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                   class="bg-white border-2 border-gray-200 rounded-lg p-8 text-center hover:border-gold hover:shadow-lg transition">
                    <div class="text-6xl mb-4" aria-hidden="true">📞</div>
                    <h3 class="text-xl font-bold text-navy mb-2">
                        <?php esc_html_e('Contact Us', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600">
                        <?php esc_html_e('Get in touch with our team', 'dental-rubio'); ?>
                    </p>
                </a>

            </div>

            <!-- Search Section -->
            <div class="bg-gray-50 rounded-lg p-8 md:p-10 mb-12 border-2 border-gray-200">
                <div class="max-w-2xl mx-auto text-center">
                    <h3 class="text-xl md:text-2xl font-bold text-navy mb-4">
                        <?php esc_html_e('Or Try Searching', 'dental-rubio'); ?>
                    </h3>
                    <p class="text-gray-600 mb-6">
                        <?php esc_html_e('Type what you\'re looking for and we\'ll help you find it', 'dental-rubio'); ?>
                    </p>
                    <?php get_search_form(); ?>
                </div>
            </div>

            <!-- Popular Pages -->
            <div class="mb-12">
                <h3 class="text-2xl font-bold text-navy mb-6 text-center">
                    <?php esc_html_e('Popular Pages', 'dental-rubio'); ?>
                </h3>
                <div class="grid md:grid-cols-2 lg:grid-cols-4 gap-4">
                    <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>"
                       class="btn bg-gray-100 hover:bg-navy hover:text-white border-2 border-gray-300 text-navy text-lg py-4 transition">
                        <?php esc_html_e('Dental Implants', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>"
                       class="btn bg-gray-100 hover:bg-navy hover:text-white border-2 border-gray-300 text-navy text-lg py-4 transition">
                        <?php esc_html_e('All-on-4', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/pricing/')); ?>"
                       class="btn bg-gray-100 hover:bg-navy hover:text-white border-2 border-gray-300 text-navy text-lg py-4 transition">
                        <?php esc_html_e('Pricing', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/travel-guide/')); ?>"
                       class="btn bg-gray-100 hover:bg-navy hover:text-white border-2 border-gray-300 text-navy text-lg py-4 transition">
                        <?php esc_html_e('Travel Guide', 'dental-rubio'); ?>
                    </a>
                </div>
            </div>

            <!-- Additional Resources -->
            <div class="bg-blue-50 border-2 border-blue-200 rounded-lg p-8">
                <h3 class="text-xl font-bold text-navy mb-4 text-center">
                    <?php esc_html_e('Looking for Something Specific?', 'dental-rubio'); ?>
                </h3>
                <div class="grid md:grid-cols-2 gap-6">
                    <div>
                        <h4 class="font-bold text-navy mb-2">
                            <?php esc_html_e('Dental Services', 'dental-rubio'); ?>
                        </h4>
                        <ul class="space-y-2 text-gray-700">
                            <li><a href="<?php echo esc_url(home_url('/crowns/')); ?>" class="hover:text-gold transition"><?php esc_html_e('Crowns & Bridges', 'dental-rubio'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/dentures/')); ?>" class="hover:text-gold transition"><?php esc_html_e('Dentures', 'dental-rubio'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/cosmetic-dentistry/')); ?>" class="hover:text-gold transition"><?php esc_html_e('Cosmetic Dentistry', 'dental-rubio'); ?></a></li>
                        </ul>
                    </div>
                    <div>
                        <h4 class="font-bold text-navy mb-2">
                            <?php esc_html_e('Resources', 'dental-rubio'); ?>
                        </h4>
                        <ul class="space-y-2 text-gray-700">
                            <li><a href="<?php echo esc_url(home_url('/faqs/')); ?>" class="hover:text-gold transition"><?php esc_html_e('FAQs', 'dental-rubio'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/snowbirds/')); ?>" class="hover:text-gold transition"><?php esc_html_e('Snowbird Guide', 'dental-rubio'); ?></a></li>
                            <li><a href="<?php echo esc_url(home_url('/blog/')); ?>" class="hover:text-gold transition"><?php esc_html_e('Blog', 'dental-rubio'); ?></a></li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>

    <!-- Emergency CTA Section -->
    <section class="error-cta py-16 bg-gradient-to-br from-gold to-gold-dark">
        <div class="container max-w-5xl">
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                    <?php esc_html_e('Still Can\'t Find What You Need?', 'dental-rubio'); ?>
                </h2>
                <p class="text-xl text-navy/80 mb-8">
                    <?php esc_html_e('Call us directly and we\'ll help you find what you\'re looking for', 'dental-rubio'); ?>
                </p>

                <!-- Contact Options -->
                <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">

                    <!-- Phone -->
                    <div class="bg-white/95 backdrop-blur-sm p-6 rounded-lg">
                        <div class="text-4xl mb-3">📞</div>
                        <h3 class="font-bold text-navy mb-2"><?php esc_html_e('Call Us', 'dental-rubio'); ?></h3>
                        <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                           class="btn btn-primary w-full text-lg py-3">
                            <?php echo esc_html($phone); ?>
                        </a>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-white/95 backdrop-blur-sm p-6 rounded-lg">
                        <div class="text-4xl mb-3">💬</div>
                        <h3 class="font-bold text-navy mb-2"><?php esc_html_e('WhatsApp', 'dental-rubio'); ?></h3>
                        <a href="https://wa.me/<?php echo esc_attr(dental_rubio_get_whatsapp()); ?>?text=<?php echo urlencode('Hi, I need help finding information'); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn bg-green-500 hover:bg-green-600 text-white w-full text-lg py-3">
                            <?php esc_html_e('Chat Now', 'dental-rubio'); ?>
                        </a>
                    </div>

                    <!-- Email -->
                    <div class="bg-white/95 backdrop-blur-sm p-6 rounded-lg">
                        <div class="text-4xl mb-3">✉️</div>
                        <h3 class="font-bold text-navy mb-2"><?php esc_html_e('Email', 'dental-rubio'); ?></h3>
                        <a href="<?php echo esc_url(home_url('/contact/')); ?>"
                           class="btn bg-navy hover:bg-navy-dark text-white w-full text-lg py-3">
                            <?php esc_html_e('Contact Form', 'dental-rubio'); ?>
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
