<?php
/**
 * Mobile Menu Template Part
 *
 * Senior-friendly mobile navigation with large touch targets.
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

<div class="mobile-menu-inner py-4">
    <div class="container">

        <!-- Mobile Contact CTAs (Prominent at top) -->
        <div class="mobile-ctas grid grid-cols-2 gap-3 mb-6 pb-6 border-b border-gray-200">
            <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
               class="btn btn-primary flex items-center justify-center gap-2"
               aria-label="<?php esc_attr_e('Call us', 'dental-rubio'); ?>">
                <?php echo dental_rubio_icon('phone', 20); ?>
                <span><?php esc_html_e('Call', 'dental-rubio'); ?></span>
            </a>
            <a href="https://wa.me/<?php echo esc_attr($whatsapp); ?>?text=<?php echo urlencode(__('Hi, I\'m interested in dental services', 'dental-rubio')); ?>"
               class="btn btn-success flex items-center justify-center gap-2"
               target="_blank"
               rel="noopener noreferrer"
               aria-label="<?php esc_attr_e('Message us on WhatsApp', 'dental-rubio'); ?>">
                <?php echo dental_rubio_icon('whatsapp', 20); ?>
                <span><?php esc_html_e('WhatsApp', 'dental-rubio'); ?></span>
            </a>
        </div>

        <!-- Mobile Navigation -->
        <nav class="mobile-nav" role="navigation" aria-label="<?php esc_attr_e('Mobile Navigation', 'dental-rubio'); ?>">
            <?php
            wp_nav_menu(array(
                'theme_location'  => 'mobile',
                'container'       => false,
                'menu_class'      => 'mobile-menu-list',
                'menu_id'         => 'mobile-menu-nav',
                'fallback_cb'     => 'dental_rubio_fallback_mobile_menu',
                'depth'           => 2,
            ));
            ?>
        </nav>

        <!-- Phone Number Display -->
        <div class="mobile-phone-display text-center py-6 border-t border-gray-200 mt-6">
            <p class="text-sm text-gray-600 mb-2"><?php esc_html_e('Call us directly:', 'dental-rubio'); ?></p>
            <a href="tel:+1<?php echo esc_attr($phone_clean); ?>" class="text-2xl font-bold text-navy">
                <?php echo esc_html($phone); ?>
            </a>
            <p class="text-sm text-gray-500 mt-2">
                <?php echo esc_html(get_theme_mod('dental_rubio_weekday_hours', 'Mon-Fri: 9am-5pm MST')); ?>
            </p>
        </div>

    </div>
</div>

<style>
/* Mobile Menu Styles */
.mobile-menu-list {
    list-style: none;
    padding: 0;
    margin: 0;
}

.mobile-menu-list .menu-item {
    border-bottom: 1px solid #f0f0f0;
}

.mobile-menu-list .menu-item:last-child {
    border-bottom: none;
}

.mobile-menu-list .menu-item > a {
    display: flex;
    align-items: center;
    justify-content: space-between;
    padding: 16px 0;
    font-size: 18px;
    font-weight: 500;
    color: var(--navy, #1e3c72);
    text-decoration: none;
    min-height: 56px; /* Touch target */
    transition: color 0.2s ease;
}

.mobile-menu-list .menu-item > a:hover,
.mobile-menu-list .menu-item > a:focus {
    color: var(--gold, #c9a961);
}

.mobile-menu-list .menu-item.current-menu-item > a {
    color: var(--gold, #c9a961);
    font-weight: 600;
}

/* Submenu */
.mobile-menu-list .sub-menu {
    list-style: none;
    padding: 0 0 0 20px;
    margin: 0;
    background-color: #f8f9fa;
    border-radius: 4px;
}

.mobile-menu-list .sub-menu .menu-item > a {
    font-size: 16px;
    padding: 12px 16px;
    min-height: 48px;
}

/* Hamburger Animation */
.hamburger-icon {
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    width: 24px;
    height: 18px;
}

.hamburger-icon span {
    display: block;
    width: 100%;
    height: 2px;
    background-color: var(--navy, #1e3c72);
    border-radius: 2px;
    transition: all 0.3s ease;
}

.mobile-menu-toggle.active .hamburger-icon span:nth-child(1) {
    transform: rotate(45deg) translate(5px, 5px);
}

.mobile-menu-toggle.active .hamburger-icon span:nth-child(2) {
    opacity: 0;
}

.mobile-menu-toggle.active .hamburger-icon span:nth-child(3) {
    transform: rotate(-45deg) translate(5px, -5px);
}
</style>

<?php
/**
 * Fallback mobile menu
 */
function dental_rubio_fallback_mobile_menu() {
    ?>
    <ul class="mobile-menu-list">
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/')); ?>">
                <?php esc_html_e('Home', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/dental-implants/')); ?>">
                <?php esc_html_e('Dental Implants', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/all-on-4/')); ?>">
                <?php esc_html_e('All-on-4', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/crowns/')); ?>">
                <?php esc_html_e('Crowns & Bridges', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/pricing/')); ?>">
                <?php esc_html_e('Pricing', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/about/')); ?>">
                <?php esc_html_e('About Us', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>">
                <?php esc_html_e('Contact', 'dental-rubio'); ?>
            </a>
        </li>
    </ul>
    <?php
}
?>
