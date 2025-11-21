<?php
/**
 * Search Form Template
 *
 * Custom search form for Dental Rubio theme.
 * Senior-friendly with large inputs and clear labels.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$unique_id = wp_unique_id('search-form-');
?>

<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
    <label for="<?php echo esc_attr($unique_id); ?>" class="sr-only">
        <?php esc_html_e('Search for:', 'dental-rubio'); ?>
    </label>
    <div class="flex gap-2">
        <input
            type="search"
            id="<?php echo esc_attr($unique_id); ?>"
            class="search-field form-input flex-1"
            placeholder="<?php esc_attr_e('Search...', 'dental-rubio'); ?>"
            value="<?php echo get_search_query(); ?>"
            name="s"
            required
        >
        <button type="submit" class="search-submit btn btn-primary">
            <span class="sr-only"><?php esc_html_e('Search', 'dental-rubio'); ?></span>
            <span aria-hidden="true">&#128269;</span>
        </button>
    </div>
</form>
