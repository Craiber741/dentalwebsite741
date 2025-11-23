<?php
/**
 * Navigation Template Part
 *
 * Desktop navigation menu component.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<nav class="main-navigation" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'dental-rubio'); ?>">
    <?php
    wp_nav_menu(array(
        'theme_location'  => 'primary',
        'container'       => false,
        'menu_class'      => 'nav-menu flex items-center gap-6',
        'menu_id'         => 'primary-menu',
        'fallback_cb'     => 'dental_rubio_fallback_menu',
        'depth'           => 2,
        'link_before'     => '<span>',
        'link_after'      => '</span>',
    ));
    ?>
</nav>

<?php
/**
 * Fallback menu if no menu is set
 */
function dental_rubio_fallback_menu() {
    ?>
    <ul class="nav-menu flex items-center gap-6">
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/')); ?>" class="nav-link">
                <?php esc_html_e('Home', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="nav-link">
                <?php esc_html_e('Services', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/pricing/')); ?>" class="nav-link">
                <?php esc_html_e('Pricing', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="nav-link">
                <?php esc_html_e('About', 'dental-rubio'); ?>
            </a>
        </li>
        <li class="menu-item">
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="nav-link">
                <?php esc_html_e('Contact', 'dental-rubio'); ?>
            </a>
        </li>
    </ul>
    <?php
}

/**
 * Fallback footer menu
 */
function dental_rubio_fallback_footer_menu() {
    ?>
    <ul class="footer-menu space-y-3">
        <li>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="text-gray-300 hover:text-gold transition">
                <?php esc_html_e('Home', 'dental-rubio'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/about/')); ?>" class="text-gray-300 hover:text-gold transition">
                <?php esc_html_e('About Us', 'dental-rubio'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/services/')); ?>" class="text-gray-300 hover:text-gold transition">
                <?php esc_html_e('Services', 'dental-rubio'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/pricing/')); ?>" class="text-gray-300 hover:text-gold transition">
                <?php esc_html_e('Pricing', 'dental-rubio'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/testimonials/')); ?>" class="text-gray-300 hover:text-gold transition">
                <?php esc_html_e('Testimonials', 'dental-rubio'); ?>
            </a>
        </li>
        <li>
            <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="text-gray-300 hover:text-gold transition">
                <?php esc_html_e('Contact', 'dental-rubio'); ?>
            </a>
        </li>
    </ul>
    <?php
}
