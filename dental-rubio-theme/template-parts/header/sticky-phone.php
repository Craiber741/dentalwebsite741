<?php
/**
 * Sticky Phone Button Template Part
 *
 * Fixed phone button at bottom of screen for mobile users.
 * Senior-friendly with large touch target.
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

<!-- Sticky Phone Button (Mobile Only) -->
<div class="sticky-phone-bar fixed bottom-0 left-0 right-0 lg:hidden z-40 bg-navy safe-area-bottom print-hidden">
    <a href="tel:+1<?php echo esc_attr($phone_clean); ?>"
       class="sticky-phone-link flex items-center justify-center gap-3 text-white py-4 px-6 w-full"
       aria-label="<?php esc_attr_e('Call us now', 'dental-rubio'); ?>">
        <span class="phone-icon animate-pulse">
            <?php echo dental_rubio_icon('phone', 24); ?>
        </span>
        <span class="phone-text">
            <span class="block text-sm opacity-90"><?php esc_html_e('Call Now - 24/7', 'dental-rubio'); ?></span>
            <span class="block text-lg font-bold"><?php echo esc_html($phone); ?></span>
        </span>
    </a>
</div>

<style>
/* Sticky Phone Bar */
.sticky-phone-bar {
    box-shadow: 0 -4px 12px rgba(0, 0, 0, 0.15);
}

.sticky-phone-link {
    text-decoration: none;
    transition: background-color 0.3s ease;
    min-height: 70px;
}

.sticky-phone-link:hover,
.sticky-phone-link:focus {
    background-color: var(--navy-dark, #0f1f3d);
}

.sticky-phone-link:active {
    background-color: var(--navy-dark, #0f1f3d);
    transform: scale(0.98);
}

/* Phone icon pulse animation */
.phone-icon {
    display: flex;
    align-items: center;
    justify-content: center;
    width: 48px;
    height: 48px;
    background-color: var(--gold, #c9a961);
    border-radius: 50%;
    color: var(--navy, #1e3c72);
    flex-shrink: 0;
}

/* Safe area for devices with home indicator */
.safe-area-bottom {
    padding-bottom: env(safe-area-inset-bottom, 0);
}

/* Compensate for sticky phone bar in body */
@media (max-width: 1023px) {
    body {
        padding-bottom: 70px;
    }

    body.admin-bar {
        padding-bottom: 70px;
    }
}

/* Hide on print */
@media print {
    .sticky-phone-bar {
        display: none !important;
    }
}
</style>
