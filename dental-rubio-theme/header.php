<?php
/**
 * Header Template
 *
 * Senior-friendly header with prominent phone number and sticky navigation.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$phone = dental_rubio_get_phone();
$phone_clean = preg_replace('/[^0-9]/', '', $phone);
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Preconnect to external resources -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<!-- Skip to main content (Accessibility) -->
<a class="skip-link sr-only" href="#main"><?php esc_html_e('Skip to main content', 'dental-rubio'); ?></a>

<!-- Site Header -->
<header class="site-header sticky top-0 z-50 bg-white shadow-sm" role="banner">

    <!-- Top Bar (Desktop only) -->
    <div class="header-top-bar hidden md:block bg-navy text-white py-2">
        <div class="container max-w-7xl">
            <div class="flex justify-between items-center text-sm">
                <div class="flex items-center gap-6">
                    <span><?php echo esc_html(get_theme_mod('dental_rubio_weekday_hours', 'Mon-Fri: 9am-5pm MST')); ?></span>
                    <span><?php echo esc_html(get_theme_mod('dental_rubio_weekend_hours', 'Sat: 9am-2pm MST')); ?></span>
                </div>
                <div class="flex items-center gap-4">
                    <span class="text-gold font-semibold"><?php esc_html_e('Call 24/7:', 'dental-rubio'); ?></span>
                    <a href="tel:+1<?php echo esc_attr($phone_clean); ?>" class="font-bold hover:text-gold transition">
                        <?php echo esc_html($phone); ?>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Main Header -->
    <div class="header-main py-4">
        <div class="container max-w-7xl">
            <div class="flex justify-between items-center">

                <!-- Logo -->
                <div class="site-logo flex-shrink-0">
                    <?php if (has_custom_logo()) : ?>
                        <?php the_custom_logo(); ?>
                    <?php else : ?>
                        <a href="<?php echo esc_url(home_url('/')); ?>" class="flex items-center" rel="home">
                            <span class="text-2xl md:text-3xl font-bold text-navy">
                                <?php bloginfo('name'); ?>
                            </span>
                        </a>
                    <?php endif; ?>
                </div>

                <!-- Main Navigation (Desktop) -->
                <nav class="main-nav hidden lg:flex items-center" role="navigation" aria-label="<?php esc_attr_e('Primary Navigation', 'dental-rubio'); ?>">
                    <?php
                    wp_nav_menu(array(
                        'theme_location' => 'primary',
                        'container'      => false,
                        'menu_class'     => 'nav-menu flex items-center gap-6',
                        'fallback_cb'    => 'dental_rubio_fallback_menu',
                        'depth'          => 2,
                        'walker'         => class_exists('Dental_Rubio_Nav_Walker') ? new Dental_Rubio_Nav_Walker() : '',
                    ));
                    ?>
                </nav>

                <!-- Header CTAs (Desktop) -->
                <div class="header-ctas hidden lg:flex items-center gap-3">
                    <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
                       class="btn btn-primary btn-sm"
                       aria-label="<?php esc_attr_e('Call us now', 'dental-rubio'); ?>">
                        <?php echo dental_rubio_icon('phone', 18); ?>
                        <span><?php esc_html_e('Call Now', 'dental-rubio'); ?></span>
                    </a>
                    <a href="#contact"
                       class="btn btn-gold btn-sm"
                       aria-label="<?php esc_attr_e('Start live chat', 'dental-rubio'); ?>">
                        <?php echo dental_rubio_icon('chat', 18); ?>
                        <span><?php esc_html_e('Chat Now', 'dental-rubio'); ?></span>
                    </a>
                </div>

                <!-- Mobile Menu Toggle -->
                <button
                    class="mobile-menu-toggle lg:hidden flex items-center justify-center w-12 h-12 rounded"
                    id="mobileMenuToggle"
                    aria-label="<?php esc_attr_e('Toggle menu', 'dental-rubio'); ?>"
                    aria-expanded="false"
                    aria-controls="mobileMenu"
                >
                    <span class="hamburger-icon">
                        <span></span>
                        <span></span>
                        <span></span>
                    </span>
                </button>

            </div>
        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu hidden lg:hidden bg-white border-t border-gray-100" role="navigation" aria-label="<?php esc_attr_e('Mobile Navigation', 'dental-rubio'); ?>">
        <?php get_template_part('template-parts/header/mobile-menu'); ?>
    </div>

</header>

<!-- Sticky Phone Button (Mobile Only) -->
<?php get_template_part('template-parts/header/sticky-phone'); ?>

<!-- Main Content Wrapper -->
<main id="main" class="site-main" role="main">
