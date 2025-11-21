<?php
/**
 * Footer Template
 *
 * Complete footer with contact info, quick links, and trust signals.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$phone = dental_rubio_get_phone();
$phone_clean = preg_replace('/[^0-9]/', '', $phone);
$email = get_theme_mod('dental_rubio_email', 'info@dentalrubio.com');
$address = get_theme_mod('dental_rubio_address', 'Avenida A 139, Los Algodones, Baja California, Mexico');
$facebook = get_theme_mod('dental_rubio_facebook', '');
$instagram = get_theme_mod('dental_rubio_instagram', '');
$youtube = get_theme_mod('dental_rubio_youtube', '');
?>

</main><!-- #main -->

<!-- Site Footer -->
<footer class="site-footer bg-navy text-white" role="contentinfo">

    <!-- Main Footer Content -->
    <div class="footer-main py-16">
        <div class="container max-w-7xl">
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-10">

                <!-- Column 1: About -->
                <div class="footer-about">
                    <h3 class="text-xl font-bold mb-6">
                        <?php bloginfo('name'); ?>
                    </h3>
                    <p class="text-sm text-gray-300 mb-4">
                        <?php esc_html_e('40+ years serving snowbirds and seniors. 51,237+ satisfied patients since 1986.', 'dental-rubio'); ?>
                    </p>
                    <div class="trust-highlight mt-6 p-4 bg-navy-light rounded-lg">
                        <p class="text-gold font-bold mb-1"><?php esc_html_e('100% Straumann Implants', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('German Quality Standards', 'dental-rubio'); ?></p>
                    </div>
                </div>

                <!-- Column 2: Quick Links -->
                <div class="footer-links">
                    <h4 class="font-bold mb-6"><?php esc_html_e('Quick Links', 'dental-rubio'); ?></h4>
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'footer',
                        'container'      => false,
                        'menu_class'     => 'footer-menu space-y-3',
                        'fallback_cb'    => 'dental_rubio_fallback_footer_menu',
                        'depth'          => 1,
                    ));
                    ?>
                </div>

                <!-- Column 3: Services -->
                <div class="footer-services">
                    <h4 class="font-bold mb-6"><?php esc_html_e('Our Services', 'dental-rubio'); ?></h4>
                    <ul class="space-y-3 text-sm">
                        <li>
                            <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>" class="text-gray-300 hover:text-gold transition">
                                <?php esc_html_e('Dental Implants', 'dental-rubio'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>" class="text-gray-300 hover:text-gold transition">
                                <?php esc_html_e('All-on-4 Implants', 'dental-rubio'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/crowns/')); ?>" class="text-gray-300 hover:text-gold transition">
                                <?php esc_html_e('Crowns & Bridges', 'dental-rubio'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/dentures/')); ?>" class="text-gray-300 hover:text-gold transition">
                                <?php esc_html_e('Dentures', 'dental-rubio'); ?>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo esc_url(home_url('/cosmetic-dentistry/')); ?>" class="text-gray-300 hover:text-gold transition">
                                <?php esc_html_e('Cosmetic Dentistry', 'dental-rubio'); ?>
                            </a>
                        </li>
                    </ul>
                </div>

                <!-- Column 4: Contact Info -->
                <div class="footer-contact">
                    <h4 class="font-bold mb-6"><?php esc_html_e('Contact Us', 'dental-rubio'); ?></h4>
                    <ul class="space-y-4 text-sm">
                        <li>
                            <a href="tel:+1<?php echo esc_attr($phone_clean); ?>" class="flex items-start gap-3 text-gray-300 hover:text-gold transition">
                                <?php echo dental_rubio_icon('phone', 20); ?>
                                <span class="font-bold text-lg text-white"><?php echo esc_html($phone); ?></span>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:<?php echo esc_attr($email); ?>" class="flex items-start gap-3 text-gray-300 hover:text-gold transition">
                                <span>&#9993;</span>
                                <span><?php echo esc_html($email); ?></span>
                            </a>
                        </li>
                        <li class="flex items-start gap-3 text-gray-300">
                            <span>&#128205;</span>
                            <span><?php echo esc_html($address); ?></span>
                        </li>
                        <li class="text-gray-300">
                            <p class="font-semibold text-white mb-1"><?php esc_html_e('Hours:', 'dental-rubio'); ?></p>
                            <p><?php echo esc_html(get_theme_mod('dental_rubio_weekday_hours', 'Mon-Fri: 9am-5pm MST')); ?></p>
                            <p><?php echo esc_html(get_theme_mod('dental_rubio_weekend_hours', 'Sat: 9am-2pm MST')); ?></p>
                        </li>
                    </ul>

                    <!-- Social Links -->
                    <?php if ($facebook || $instagram || $youtube) : ?>
                        <div class="social-links flex gap-4 mt-6">
                            <?php if ($facebook) : ?>
                                <a href="<?php echo esc_url($facebook); ?>" target="_blank" rel="noopener noreferrer" class="text-gold hover:text-gold-light transition" aria-label="Facebook">
                                    <?php echo dental_rubio_icon('facebook', 24); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($instagram) : ?>
                                <a href="<?php echo esc_url($instagram); ?>" target="_blank" rel="noopener noreferrer" class="text-gold hover:text-gold-light transition" aria-label="Instagram">
                                    <?php echo dental_rubio_icon('instagram', 24); ?>
                                </a>
                            <?php endif; ?>
                            <?php if ($youtube) : ?>
                                <a href="<?php echo esc_url($youtube); ?>" target="_blank" rel="noopener noreferrer" class="text-gold hover:text-gold-light transition" aria-label="YouTube">
                                    <?php echo dental_rubio_icon('youtube', 24); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                </div>

            </div>
        </div>
    </div>

    <!-- Trust Bar -->
    <div class="footer-trust bg-navy-dark py-6">
        <div class="container max-w-7xl">
            <div class="grid grid-cols-2 md:grid-cols-4 gap-6 text-center">
                <div>
                    <p class="text-2xl font-bold text-gold">40+</p>
                    <p class="text-sm text-gray-400"><?php esc_html_e('Years Experience', 'dental-rubio'); ?></p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gold">51,237+</p>
                    <p class="text-sm text-gray-400"><?php esc_html_e('Happy Patients', 'dental-rubio'); ?></p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gold">4.9/5</p>
                    <p class="text-sm text-gray-400"><?php esc_html_e('Patient Rating', 'dental-rubio'); ?></p>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gold">70%</p>
                    <p class="text-sm text-gray-400"><?php esc_html_e('Average Savings', 'dental-rubio'); ?></p>
                </div>
            </div>
        </div>
    </div>

    <!-- Bottom Footer -->
    <div class="footer-bottom border-t border-navy-light py-6">
        <div class="container max-w-7xl">
            <div class="flex flex-col md:flex-row justify-between items-center gap-4 text-sm text-gray-400">
                <p>
                    &copy; <?php echo date('Y'); ?> <?php bloginfo('name'); ?>. <?php esc_html_e('All rights reserved.', 'dental-rubio'); ?>
                </p>
                <div class="flex gap-6">
                    <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="hover:text-gold transition">
                        <?php esc_html_e('Privacy Policy', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/terms-conditions/')); ?>" class="hover:text-gold transition">
                        <?php esc_html_e('Terms & Conditions', 'dental-rubio'); ?>
                    </a>
                    <a href="<?php echo esc_url(home_url('/sitemap/')); ?>" class="hover:text-gold transition">
                        <?php esc_html_e('Sitemap', 'dental-rubio'); ?>
                    </a>
                </div>
            </div>
            <div class="text-center mt-4 text-xs text-gray-500">
                <p><?php esc_html_e('Habla Espanol - English Spoken - Parlons Francais', 'dental-rubio'); ?></p>
            </div>
        </div>
    </div>

</footer>

<?php wp_footer(); ?>
</body>
</html>
