<?php
/**
 * Template Name: Contact Page
 * Template Post Type: page
 *
 * Dedicated contact page template with prominent contact form,
 * contact information, map, and multiple contact methods.
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
$whatsapp = dental_rubio_get_whatsapp();
$email = get_theme_mod('dental_rubio_email', 'info@dentalrubio.com');
?>

<main id="main" class="contact-page">

    <?php while (have_posts()) : the_post(); ?>

        <!-- Hero Section -->
        <section class="contact-hero bg-gradient-to-br from-navy to-navy-dark text-white py-16">
            <div class="container max-w-4xl text-center">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-4">
                    <?php the_title(); ?>
                </h1>
                <?php if (get_the_excerpt()) : ?>
                    <p class="text-xl md:text-2xl text-gray-200">
                        <?php echo esc_html(get_the_excerpt()); ?>
                    </p>
                <?php else : ?>
                    <p class="text-xl md:text-2xl text-gray-200">
                        <?php esc_html_e('We\'re here to answer your questions and help you get started with your dental care.', 'dental-rubio'); ?>
                    </p>
                <?php endif; ?>
            </div>
        </section>

        <!-- Quick Contact Methods -->
        <section class="quick-contact py-12 bg-gray-50 border-b-2 border-gray-200">
            <div class="container max-w-6xl">
                <div class="grid md:grid-cols-3 gap-6">

                    <!-- Phone -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="text-5xl mb-4">📞</div>
                        <h3 class="text-xl font-bold text-navy mb-3">
                            <?php esc_html_e('Call Us Now', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?php esc_html_e('Speak with our team', 'dental-rubio'); ?>
                        </p>
                        <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                           class="block text-2xl font-bold text-gold hover:text-gold-dark mb-2">
                            <?php echo esc_html($phone); ?>
                        </a>
                        <p class="text-sm text-gray-500">
                            <?php esc_html_e('Mon-Fri: 9am-5pm MST', 'dental-rubio'); ?>
                        </p>
                    </div>

                    <!-- WhatsApp -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="text-5xl mb-4">💬</div>
                        <h3 class="text-xl font-bold text-navy mb-3">
                            <?php esc_html_e('WhatsApp Chat', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?php esc_html_e('Instant messaging', 'dental-rubio'); ?>
                        </p>
                        <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=<?php echo urlencode('Hi, I need information about dental services'); ?>"
                           target="_blank"
                           rel="noopener noreferrer"
                           class="btn bg-green-500 hover:bg-green-600 text-white w-full">
                            <?php esc_html_e('Chat Now', 'dental-rubio'); ?>
                        </a>
                        <p class="text-sm text-gray-500 mt-2">
                            <?php esc_html_e('24/7 availability', 'dental-rubio'); ?>
                        </p>
                    </div>

                    <!-- Email -->
                    <div class="bg-white p-6 rounded-lg shadow-sm hover:shadow-md transition text-center">
                        <div class="text-5xl mb-4">✉️</div>
                        <h3 class="text-xl font-bold text-navy mb-3">
                            <?php esc_html_e('Email Us', 'dental-rubio'); ?>
                        </h3>
                        <p class="text-gray-600 mb-4">
                            <?php esc_html_e('Send us a message', 'dental-rubio'); ?>
                        </p>
                        <a href="mailto:<?php echo esc_attr($email); ?>"
                           class="block text-lg text-gold hover:text-gold-dark mb-2">
                            <?php echo esc_html($email); ?>
                        </a>
                        <p class="text-sm text-gray-500">
                            <?php esc_html_e('Response within 2 hours', 'dental-rubio'); ?>
                        </p>
                    </div>

                </div>
            </div>
        </section>

        <!-- Main Contact Section -->
        <section class="main-contact py-16 bg-white">
            <div class="container max-w-7xl">
                <div class="grid lg:grid-cols-2 gap-12">

                    <!-- Contact Form -->
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-navy mb-6">
                            <?php esc_html_e('Send Us a Message', 'dental-rubio'); ?>
                        </h2>
                        <p class="text-gray-600 mb-8 text-lg">
                            <?php esc_html_e('Fill out the form below and we\'ll get back to you within 2 hours during business hours.', 'dental-rubio'); ?>
                        </p>

                        <?php get_template_part('template-parts/forms/contact-form'); ?>
                    </div>

                    <!-- Contact Information & Map -->
                    <div>
                        <h2 class="text-2xl md:text-3xl font-bold text-navy mb-6">
                            <?php esc_html_e('Visit Our Clinic', 'dental-rubio'); ?>
                        </h2>

                        <!-- Address & Info -->
                        <div class="bg-gray-50 p-6 rounded-lg mb-8">
                            <div class="space-y-4">
                                <div class="flex items-start gap-3">
                                    <span class="text-2xl flex-shrink-0">📍</span>
                                    <div>
                                        <p class="font-bold text-navy mb-1">
                                            <?php esc_html_e('Address', 'dental-rubio'); ?>
                                        </p>
                                        <p class="text-gray-700">
                                            <?php echo esc_html(get_theme_mod('dental_rubio_address', 'Avenida A 139, Los Algodones, Baja California, Mexico')); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <span class="text-2xl flex-shrink-0">🕒</span>
                                    <div>
                                        <p class="font-bold text-navy mb-1">
                                            <?php esc_html_e('Hours', 'dental-rubio'); ?>
                                        </p>
                                        <p class="text-gray-700">
                                            <?php echo esc_html(get_theme_mod('dental_rubio_weekday_hours', 'Mon-Fri: 9am-5pm MST')); ?><br>
                                            <?php echo esc_html(get_theme_mod('dental_rubio_weekend_hours', 'Sat: 9am-2pm MST')); ?>
                                        </p>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <span class="text-2xl flex-shrink-0">📞</span>
                                    <div>
                                        <p class="font-bold text-navy mb-1">
                                            <?php esc_html_e('Phone', 'dental-rubio'); ?>
                                        </p>
                                        <a href="tel:+1<?php echo esc_attr($phone_clean); ?>" class="text-gold font-bold text-xl">
                                            <?php echo esc_html($phone); ?>
                                        </a>
                                    </div>
                                </div>

                                <div class="flex items-start gap-3">
                                    <span class="text-2xl flex-shrink-0">🌐</span>
                                    <div>
                                        <p class="font-bold text-navy mb-1">
                                            <?php esc_html_e('Languages', 'dental-rubio'); ?>
                                        </p>
                                        <p class="text-gray-700">
                                            <?php esc_html_e('English • Español • Français', 'dental-rubio'); ?>
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Map -->
                        <div class="bg-gray-200 rounded-lg overflow-hidden mb-8" style="height: 400px;">
                            <iframe
                                src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3354.9776289!2d-114.7241!3d32.7088!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMzLCsDQyJzMxLjciTiAxMTTCsDQzJzI2LjgiVw!5e0!3m2!1sen!2sus!4v1234567890"
                                width="100%"
                                height="400"
                                style="border:0;"
                                allowfullscreen=""
                                loading="lazy"
                                referrerpolicy="no-referrer-when-downgrade"
                                title="<?php esc_attr_e('Dental Rubio Group Location Map', 'dental-rubio'); ?>">
                            </iframe>
                        </div>

                        <!-- Directions -->
                        <div class="bg-blue-50 border-2 border-blue-200 p-6 rounded-lg">
                            <h3 class="font-bold text-navy mb-3">
                                🚗 <?php esc_html_e('How to Get Here', 'dental-rubio'); ?>
                            </h3>
                            <ol class="space-y-2 text-gray-700">
                                <li class="flex items-start gap-2">
                                    <span class="font-bold flex-shrink-0">1.</span>
                                    <span><?php esc_html_e('Park at Andrade Port of Entry (Yuma, AZ side)', 'dental-rubio'); ?></span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="font-bold flex-shrink-0">2.</span>
                                    <span><?php esc_html_e('Walk across the border (5 minutes)', 'dental-rubio'); ?></span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="font-bold flex-shrink-0">3.</span>
                                    <span><?php esc_html_e('We\'re on Avenida A, 2 blocks from the border', 'dental-rubio'); ?></span>
                                </li>
                                <li class="flex items-start gap-2">
                                    <span class="font-bold flex-shrink-0">4.</span>
                                    <span><?php esc_html_e('Free shuttle service available - call ahead!', 'dental-rubio'); ?></span>
                                </li>
                            </ol>
                        </div>

                    </div>

                </div>
            </div>
        </section>

        <!-- FAQ Section -->
        <section class="contact-faq py-16 bg-gray-50">
            <div class="container max-w-4xl">
                <h2 class="text-2xl md:text-3xl font-bold text-navy mb-8 text-center">
                    <?php esc_html_e('Frequently Asked Questions', 'dental-rubio'); ?>
                </h2>

                <div class="space-y-4">

                    <!-- FAQ 1 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <button class="w-full text-left p-6 font-bold text-lg text-navy hover:bg-gray-50 transition"
                                onclick="this.nextElementSibling.classList.toggle('hidden')">
                            <span><?php esc_html_e('What should I bring to my first appointment?', 'dental-rubio'); ?></span>
                            <span class="float-right">+</span>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-700">
                            <p><?php esc_html_e('Bring your ID/passport, any recent X-rays or dental records, and a list of medications you\'re taking. Payment can be made via cash, credit card, or bank transfer.', 'dental-rubio'); ?></p>
                        </div>
                    </div>

                    <!-- FAQ 2 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <button class="w-full text-left p-6 font-bold text-lg text-navy hover:bg-gray-50 transition"
                                onclick="this.nextElementSibling.classList.toggle('hidden')">
                            <span><?php esc_html_e('Do you offer same-day appointments?', 'dental-rubio'); ?></span>
                            <span class="float-right">+</span>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-700">
                            <p><?php esc_html_e('Yes! We often have same-day availability. Call us in the morning and we can usually see you that same afternoon. For complex procedures, we recommend booking ahead.', 'dental-rubio'); ?></p>
                        </div>
                    </div>

                    <!-- FAQ 3 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <button class="w-full text-left p-6 font-bold text-lg text-navy hover:bg-gray-50 transition"
                                onclick="this.nextElementSibling.classList.toggle('hidden')">
                            <span><?php esc_html_e('Is parking available?', 'dental-rubio'); ?></span>
                            <span class="float-right">+</span>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-700">
                            <p><?php esc_html_e('Yes, free parking is available on the US side at the Andrade Port of Entry. The border crossing is pedestrian-only (5 minute walk). We also offer free shuttle service from the border.', 'dental-rubio'); ?></p>
                        </div>
                    </div>

                    <!-- FAQ 4 -->
                    <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                        <button class="w-full text-left p-6 font-bold text-lg text-navy hover:bg-gray-50 transition"
                                onclick="this.nextElementSibling.classList.toggle('hidden')">
                            <span><?php esc_html_e('What payment methods do you accept?', 'dental-rubio'); ?></span>
                            <span class="float-right">+</span>
                        </button>
                        <div class="hidden p-6 pt-0 text-gray-700">
                            <p><?php esc_html_e('We accept cash (USD or MXN), all major credit cards (Visa, Mastercard, Amex), bank transfers, and offer 0% interest payment plans for qualified patients.', 'dental-rubio'); ?></p>
                        </div>
                    </div>

                </div>
            </div>
        </section>

        <!-- Final CTA -->
        <section class="contact-cta py-16 bg-gradient-to-br from-navy to-navy-dark text-white">
            <div class="container max-w-4xl text-center">
                <h2 class="text-3xl md:text-4xl font-bold mb-6">
                    <?php esc_html_e('Ready to Get Started?', 'dental-rubio'); ?>
                </h2>
                <p class="text-xl text-gray-200 mb-8">
                    <?php esc_html_e('Call us now for a free consultation and exact pricing.', 'dental-rubio'); ?>
                </p>
                <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                   class="btn bg-gold text-navy hover:bg-gold-light text-2xl px-12 py-5">
                    📞 <?php echo esc_html($phone); ?>
                </a>
            </div>
        </section>

        <!-- Additional Content (if any) -->
        <?php if (get_the_content()) : ?>
            <section class="additional-content py-16 bg-white">
                <div class="container max-w-4xl">
                    <div class="prose prose-lg max-w-none">
                        <?php the_content(); ?>
                    </div>
                </div>
            </section>
        <?php endif; ?>

    <?php endwhile; ?>

</main>

<?php get_footer(); ?>
