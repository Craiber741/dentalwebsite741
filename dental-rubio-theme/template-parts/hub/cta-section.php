<?php
/**
 * Hub CTA Section
 *
 * Final call-to-action section for hub pages with multiple contact options.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$phone = dental_rubio_get_phone();
$phone_clean = preg_replace('/[^0-9]/', '', $phone);
$whatsapp = dental_rubio_get_whatsapp();

// Get custom CTA settings
$cta_headline = get_post_meta(get_the_ID(), '_hub_cta_headline', true);
$cta_subheadline = get_post_meta(get_the_ID(), '_hub_cta_subheadline', true);
$cta_type = get_post_meta(get_the_ID(), '_hub_cta_type', true);

// Default headlines if not set
if (!$cta_headline) {
    $cta_headline = __('Ready to Get Started?', 'dental-rubio');
}
if (!$cta_subheadline) {
    $cta_subheadline = __('Join 51,237+ happy patients. Get your free consultation today.', 'dental-rubio');
}
if (!$cta_type) {
    $cta_type = 'default';
}
?>

<section class="hub-cta py-16 md:py-20 bg-gradient-to-br from-gold to-gold-dark">
    <div class="container max-w-5xl">

        <?php if ($cta_type === 'calculator') : ?>

            <!-- Calculator-focused CTA -->
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                    <?php echo esc_html($cta_headline); ?>
                </h2>
                <p class="text-xl text-navy/80 mb-8">
                    <?php echo esc_html($cta_subheadline); ?>
                </p>
                <div class="flex flex-col md:flex-row gap-4 justify-center">
                    <a href="<?php echo esc_url(home_url('/#calculator')); ?>"
                       class="btn bg-navy text-white hover:bg-navy-dark text-lg px-8 py-4">
                        <?php esc_html_e('Calculate Your Savings', 'dental-rubio'); ?>
                    </a>
                    <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                       class="btn bg-white text-navy hover:bg-gray-100 text-lg px-8 py-4">
                        <?php esc_html_e('Call for Quote', 'dental-rubio'); ?>
                    </a>
                </div>
            </div>

        <?php elseif ($cta_type === 'appointment') : ?>

            <!-- Appointment-focused CTA -->
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                    <?php echo esc_html($cta_headline); ?>
                </h2>
                <p class="text-xl text-navy/80 mb-8">
                    <?php echo esc_html($cta_subheadline); ?>
                </p>
                <div class="bg-white/90 backdrop-blur-sm rounded-lg p-8 max-w-2xl mx-auto">
                    <p class="text-lg font-semibold text-navy mb-4">
                        <?php esc_html_e('Schedule Your Visit Today', 'dental-rubio'); ?>
                    </p>
                    <div class="grid md:grid-cols-2 gap-4">
                        <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                           class="btn btn-primary text-lg py-4">
                            📞 <?php esc_html_e('Call Now', 'dental-rubio'); ?>
                        </a>
                        <a href="#contact"
                           class="btn bg-navy text-white hover:bg-navy-dark text-lg py-4">
                            ✉️ <?php esc_html_e('Email Us', 'dental-rubio'); ?>
                        </a>
                    </div>
                </div>
            </div>

        <?php else : ?>

            <!-- Default Multi-option CTA -->
            <div class="text-center">
                <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                    <?php echo esc_html($cta_headline); ?>
                </h2>
                <p class="text-xl md:text-2xl text-navy/80 mb-10">
                    <?php echo esc_html($cta_subheadline); ?>
                </p>

                <!-- Contact Options Grid -->
                <div class="grid md:grid-cols-3 gap-6 max-w-4xl mx-auto">

                    <!-- Phone -->
                    <div class="bg-white/95 backdrop-blur-sm p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <div class="text-4xl mb-3">📞</div>
                        <h3 class="text-lg font-bold text-navy mb-2">
                            <?php esc_html_e('Call Us', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            <?php esc_html_e('Speak with our team', 'dental-rubio'); ?>
                        </p>
                        <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                           class="btn btn-primary w-full text-base py-3">
                            <?php echo esc_html($phone); ?>
                        </a>
                        <p class="text-xs text-gray-500 mt-2">
                            <?php esc_html_e('Mon-Fri 9am-5pm MST', 'dental-rubio'); ?>
                        </p>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-white/95 backdrop-blur-sm p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <div class="text-4xl mb-3">💬</div>
                        <h3 class="text-lg font-bold text-navy mb-2">
                            <?php esc_html_e('WhatsApp', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            <?php esc_html_e('Instant messaging', 'dental-rubio'); ?>
                        </p>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=<?php echo urlencode('Hi, I need information about dental services'); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn bg-green-500 hover:bg-green-600 text-white w-full text-base py-3">
                            <?php esc_html_e('Chat Now', 'dental-rubio'); ?>
                        </a>
                        <p class="text-xs text-gray-500 mt-2">
                            <?php esc_html_e('24/7 availability', 'dental-rubio'); ?>
                        </p>
                    </div>

                    <!-- Email/Form -->
                    <div class="bg-white/95 backdrop-blur-sm p-6 rounded-lg shadow-lg hover:shadow-xl transition">
                        <div class="text-4xl mb-3">✉️</div>
                        <h3 class="text-lg font-bold text-navy mb-2">
                            <?php esc_html_e('Get Quote', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-sm text-gray-600 mb-4">
                            <?php esc_html_e('Free consultation', 'dental-rubio'); ?>
                        </p>
                        <a href="#contact"
                           class="btn bg-navy text-white hover:bg-navy-dark w-full text-base py-3">
                            <?php esc_html_e('Contact Form', 'dental-rubio'); ?>
                        </a>
                        <p class="text-xs text-gray-500 mt-2">
                            <?php esc_html_e('Response within 2 hours', 'dental-rubio'); ?>
                        </p>
                    </div>

                </div>

                <!-- Additional Trust Signal -->
                <div class="mt-10 text-navy/70">
                    <p class="text-sm font-semibold">
                        <?php esc_html_e('🌍 Habla Español • English Spoken • Parlons Français', 'dental-rubio'); ?>
                    </p>
                </div>

            </div>

        <?php endif; ?>

        <!-- Emergency Notice (optional) -->
        <?php if (get_post_meta(get_the_ID(), '_hub_show_emergency_notice', true)) : ?>
            <div class="mt-8 p-4 bg-navy text-white rounded-lg text-center">
                <p class="font-semibold">
                    ⚡ <?php esc_html_e('Same-Day Emergency Appointments Available', 'dental-rubio'); ?>
                </p>
            </div>
        <?php endif; ?>

    </div>
</section>

<!-- Contact Form Section (anchor for "Get Quote" buttons) -->
<section id="contact" class="py-16 bg-white">
    <div class="container max-w-3xl">
        <?php
        // Include contact form if it exists
        if (file_exists(get_template_directory() . '/template-parts/forms/contact-form.php')) {
            get_template_part('template-parts/forms/contact-form');
        }
        ?>
    </div>
</section>
