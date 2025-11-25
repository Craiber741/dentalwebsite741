<?php
/**
 * Hub Sidebar
 *
 * Sidebar for hub pages with quick contact, featured resources, and navigation.
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
?>

<div class="hub-sidebar space-y-8">

    <!-- Quick Contact Card -->
    <div class="sidebar-card bg-gradient-to-br from-navy to-navy-dark text-white p-6 rounded-lg shadow-lg">
        <h3 class="text-xl font-bold mb-4"><?php esc_html_e('Need Help?', 'dental-rubio'); ?></h3>
        <p class="text-gray-200 mb-6 text-sm">
            <?php esc_html_e('Our team is ready to answer your questions and provide a free quote.', 'dental-rubio'); ?>
        </p>

        <div class="space-y-3">
            <!-- Call Button -->
            <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
               class="btn bg-gold text-navy hover:bg-gold-light w-full justify-center text-center">
                <span class="mr-2">📞</span>
                <?php esc_html_e('Call Now', 'dental-rubio'); ?>
            </a>

            <!-- WhatsApp Button -->
            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=<?php echo urlencode('Hi, I have a question about '); ?><?php echo urlencode(get_the_title()); ?>"
               target="_blank"
               rel="noopener noreferrer"
               class="btn bg-green-500 hover:bg-green-600 text-white w-full justify-center text-center">
                <span class="mr-2">💬</span>
                <?php esc_html_e('WhatsApp', 'dental-rubio'); ?>
            </a>

            <!-- Email Button -->
            <a href="#contact"
               class="btn bg-white text-navy hover:bg-gray-100 w-full justify-center text-center">
                <span class="mr-2">✉️</span>
                <?php esc_html_e('Get Quote', 'dental-rubio'); ?>
            </a>
        </div>

        <p class="text-xs text-gray-300 mt-4 text-center">
            <?php esc_html_e('Available Mon-Fri 9am-5pm MST', 'dental-rubio'); ?>
        </p>
    </div>

    <!-- Quick Links / Related Pages -->
    <div class="sidebar-card bg-white p-6 rounded-lg shadow-sm">
        <h3 class="text-lg font-bold text-navy mb-4">
            <?php esc_html_e('Popular Resources', 'dental-rubio'); ?>
        </h3>
        <ul class="space-y-3">
            <li>
                <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>"
                   class="flex items-start gap-2 text-gray-700 hover:text-gold transition">
                    <span aria-hidden="true" class="text-gold">→</span>
                    <span><?php esc_html_e('Dental Implants Guide', 'dental-rubio'); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>"
                   class="flex items-start gap-2 text-gray-700 hover:text-gold transition">
                    <span aria-hidden="true" class="text-gold">→</span>
                    <span><?php esc_html_e('All-on-4 Information', 'dental-rubio'); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/pricing/')); ?>"
                   class="flex items-start gap-2 text-gray-700 hover:text-gold transition">
                    <span aria-hidden="true" class="text-gold">→</span>
                    <span><?php esc_html_e('Pricing & Costs', 'dental-rubio'); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/travel-guide/')); ?>"
                   class="flex items-start gap-2 text-gray-700 hover:text-gold transition">
                    <span aria-hidden="true" class="text-gold">→</span>
                    <span><?php esc_html_e('Travel Guide', 'dental-rubio'); ?></span>
                </a>
            </li>
            <li>
                <a href="<?php echo esc_url(home_url('/faqs/')); ?>"
                   class="flex items-start gap-2 text-gray-700 hover:text-gold transition">
                    <span aria-hidden="true" class="text-gold">→</span>
                    <span><?php esc_html_e('FAQs', 'dental-rubio'); ?></span>
                </a>
            </li>
        </ul>
    </div>

    <!-- Trust Signals -->
    <div class="sidebar-card bg-gold/10 p-6 rounded-lg border-2 border-gold/20">
        <h3 class="text-lg font-bold text-navy mb-4">
            <?php esc_html_e('Why Choose Us', 'dental-rubio'); ?>
        </h3>
        <ul class="space-y-3 text-sm">
            <li class="flex items-start gap-2">
                <span class="text-green-600 flex-shrink-0">✓</span>
                <span><?php esc_html_e('40+ Years Experience', 'dental-rubio'); ?></span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-green-600 flex-shrink-0">✓</span>
                <span><?php esc_html_e('51,237+ Happy Patients', 'dental-rubio'); ?></span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-green-600 flex-shrink-0">✓</span>
                <span><?php esc_html_e('100% Straumann Implants', 'dental-rubio'); ?></span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-green-600 flex-shrink-0">✓</span>
                <span><?php esc_html_e('Save 70% vs USA/Canada', 'dental-rubio'); ?></span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-green-600 flex-shrink-0">✓</span>
                <span><?php esc_html_e('Free Transportation', 'dental-rubio'); ?></span>
            </li>
            <li class="flex items-start gap-2">
                <span class="text-green-600 flex-shrink-0">✓</span>
                <span><?php esc_html_e('English-Speaking Staff', 'dental-rubio'); ?></span>
            </li>
        </ul>
    </div>

    <!-- Featured Calculator (optional) -->
    <?php if (get_post_meta(get_the_ID(), '_hub_show_calculator', true)) : ?>
        <div class="sidebar-card bg-white p-6 rounded-lg shadow-sm border-l-4 border-gold">
            <h3 class="text-lg font-bold text-navy mb-4">
                <?php esc_html_e('Calculate Your Savings', 'dental-rubio'); ?>
            </h3>
            <p class="text-sm text-gray-600 mb-4">
                <?php esc_html_e('See how much you can save on dental work in Los Algodones.', 'dental-rubio'); ?>
            </p>
            <a href="<?php echo esc_url(home_url('/#calculator')); ?>"
               class="btn btn-primary w-full justify-center text-center">
                <?php esc_html_e('Try Calculator', 'dental-rubio'); ?>
            </a>
        </div>
    <?php endif; ?>

    <!-- Testimonial Highlight (optional) -->
    <?php
    $featured_testimonial = get_post_meta(get_the_ID(), '_hub_featured_testimonial', true);
    if ($featured_testimonial) :
    ?>
        <div class="sidebar-card bg-white p-6 rounded-lg shadow-sm">
            <div class="flex items-center gap-1 text-gold mb-3">
                <span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span><span>⭐</span>
            </div>
            <blockquote class="text-gray-700 italic mb-4 text-sm">
                "<?php echo esc_html($featured_testimonial['quote']); ?>"
            </blockquote>
            <p class="text-sm font-semibold text-navy">
                - <?php echo esc_html($featured_testimonial['name']); ?>
            </p>
            <?php if (!empty($featured_testimonial['location'])) : ?>
                <p class="text-xs text-gray-500">
                    <?php echo esc_html($featured_testimonial['location']); ?>
                </p>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <!-- Download Resources (if applicable) -->
    <?php
    $download_title = get_post_meta(get_the_ID(), '_hub_download_title', true);
    $download_url = get_post_meta(get_the_ID(), '_hub_download_url', true);
    if ($download_title && $download_url) :
    ?>
        <div class="sidebar-card bg-navy text-white p-6 rounded-lg shadow-sm">
            <h3 class="text-lg font-bold mb-3">
                📄 <?php esc_html_e('Free Download', 'dental-rubio'); ?>
            </h3>
            <p class="text-sm text-gray-200 mb-4">
                <?php echo esc_html($download_title); ?>
            </p>
            <a href="<?php echo esc_url($download_url); ?>"
               class="btn bg-gold text-navy hover:bg-gold-light w-full justify-center text-center"
               download>
                <?php esc_html_e('Download Now', 'dental-rubio'); ?>
            </a>
        </div>
    <?php endif; ?>

</div>
