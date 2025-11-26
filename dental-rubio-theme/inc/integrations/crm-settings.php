<?php
/**
 * CRM Settings Page
 *
 * Admin interface for configuring CRM integrations (HubSpot, Zapier, Email).
 * Provides settings management and connection testing.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * CRM Settings Handler
 */
class Dental_Rubio_CRM_Settings {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('admin_menu', array($this, 'add_settings_page'));
        add_action('admin_init', array($this, 'register_settings'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_admin_scripts'));
    }

    /**
     * Add settings page to WordPress admin
     */
    public function add_settings_page() {
        add_menu_page(
            __('CRM Settings', 'dental-rubio'),
            __('CRM Settings', 'dental-rubio'),
            'manage_options',
            'dental-rubio-crm',
            array($this, 'render_settings_page'),
            'dashicons-email-alt',
            30
        );
    }

    /**
     * Register settings
     */
    public function register_settings() {
        // HubSpot Settings
        register_setting('dental_rubio_crm_settings', 'dental_rubio_hubspot_api_key');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_hubspot_portal_id');

        // Zapier Webhook URLs
        register_setting('dental_rubio_crm_settings', 'dental_rubio_zapier_webhook_contact');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_zapier_webhook_calculator');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_zapier_webhook_appointment');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_zapier_webhook_newsletter');

        // Email Settings
        register_setting('dental_rubio_crm_settings', 'dental_rubio_email_from');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_email_from_name');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_notification_email');

        // Feature Toggles
        register_setting('dental_rubio_crm_settings', 'dental_rubio_enable_hubspot');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_enable_zapier');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_enable_email_automation');
        register_setting('dental_rubio_crm_settings', 'dental_rubio_enable_lead_tracking');
    }

    /**
     * Enqueue admin scripts
     *
     * @param string $hook Current admin page hook
     */
    public function enqueue_admin_scripts($hook) {
        if ($hook !== 'toplevel_page_dental-rubio-crm') {
            return;
        }

        wp_enqueue_style(
            'dental-rubio-crm-admin',
            get_template_directory_uri() . '/assets/css/admin-crm.css',
            array(),
            '1.0.0'
        );
    }

    /**
     * Render settings page
     */
    public function render_settings_page() {
        if (!current_user_can('manage_options')) {
            return;
        }

        // Handle form submission
        if (isset($_POST['dental_rubio_crm_settings_submit'])) {
            check_admin_referer('dental_rubio_crm_settings');

            // Save settings
            update_option('dental_rubio_hubspot_api_key', sanitize_text_field($_POST['hubspot_api_key']));
            update_option('dental_rubio_hubspot_portal_id', sanitize_text_field($_POST['hubspot_portal_id']));
            update_option('dental_rubio_zapier_webhook_contact', esc_url_raw($_POST['zapier_webhook_contact']));
            update_option('dental_rubio_zapier_webhook_calculator', esc_url_raw($_POST['zapier_webhook_calculator']));
            update_option('dental_rubio_zapier_webhook_appointment', esc_url_raw($_POST['zapier_webhook_appointment']));
            update_option('dental_rubio_zapier_webhook_newsletter', esc_url_raw($_POST['zapier_webhook_newsletter']));
            update_option('dental_rubio_email_from', sanitize_email($_POST['email_from']));
            update_option('dental_rubio_email_from_name', sanitize_text_field($_POST['email_from_name']));
            update_option('dental_rubio_notification_email', sanitize_email($_POST['notification_email']));
            update_option('dental_rubio_enable_hubspot', isset($_POST['enable_hubspot']) ? '1' : '0');
            update_option('dental_rubio_enable_zapier', isset($_POST['enable_zapier']) ? '1' : '0');
            update_option('dental_rubio_enable_email_automation', isset($_POST['enable_email_automation']) ? '1' : '0');
            update_option('dental_rubio_enable_lead_tracking', isset($_POST['enable_lead_tracking']) ? '1' : '0');

            echo '<div class="notice notice-success"><p>' . __('Settings saved successfully!', 'dental-rubio') . '</p></div>';
        }

        // Get current settings
        $hubspot_api_key = get_option('dental_rubio_hubspot_api_key', '');
        $hubspot_portal_id = get_option('dental_rubio_hubspot_portal_id', '');
        $zapier_webhook_contact = get_option('dental_rubio_zapier_webhook_contact', '');
        $zapier_webhook_calculator = get_option('dental_rubio_zapier_webhook_calculator', '');
        $zapier_webhook_appointment = get_option('dental_rubio_zapier_webhook_appointment', '');
        $zapier_webhook_newsletter = get_option('dental_rubio_zapier_webhook_newsletter', '');
        $email_from = get_option('dental_rubio_email_from', 'info@dentalrubiogroup.com');
        $email_from_name = get_option('dental_rubio_email_from_name', 'Dental Rubio Group');
        $notification_email = get_option('dental_rubio_notification_email', get_option('admin_email'));
        $enable_hubspot = get_option('dental_rubio_enable_hubspot', '0');
        $enable_zapier = get_option('dental_rubio_enable_zapier', '0');
        $enable_email_automation = get_option('dental_rubio_enable_email_automation', '1');
        $enable_lead_tracking = get_option('dental_rubio_enable_lead_tracking', '1');

        ?>
        <div class="wrap">
            <h1><?php echo esc_html(get_admin_page_title()); ?></h1>

            <p class="description">
                <?php _e('Configure CRM integrations, email automation, and lead tracking for Dental Rubio Group.', 'dental-rubio'); ?>
            </p>

            <form method="post" action="">
                <?php wp_nonce_field('dental_rubio_crm_settings'); ?>

                <!-- Feature Toggles -->
                <div class="card" style="max-width: none; margin-top: 20px;">
                    <h2><?php _e('Enable Integrations', 'dental-rubio'); ?></h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row"><?php _e('HubSpot Integration', 'dental-rubio'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="enable_hubspot" value="1" <?php checked($enable_hubspot, '1'); ?>>
                                    <?php _e('Enable HubSpot CRM integration', 'dental-rubio'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Zapier Webhooks', 'dental-rubio'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="enable_zapier" value="1" <?php checked($enable_zapier, '1'); ?>>
                                    <?php _e('Enable Zapier webhook integrations', 'dental-rubio'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Email Automation', 'dental-rubio'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="enable_email_automation" value="1" <?php checked($enable_email_automation, '1'); ?>>
                                    <?php _e('Enable automated email sequences', 'dental-rubio'); ?>
                                </label>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php _e('Lead Tracking', 'dental-rubio'); ?></th>
                            <td>
                                <label>
                                    <input type="checkbox" name="enable_lead_tracking" value="1" <?php checked($enable_lead_tracking, '1'); ?>>
                                    <?php _e('Enable visitor and lead tracking', 'dental-rubio'); ?>
                                </label>
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- HubSpot Settings -->
                <div class="card" style="max-width: none; margin-top: 20px;">
                    <h2><?php _e('HubSpot Settings', 'dental-rubio'); ?></h2>
                    <p class="description">
                        <?php _e('Get your API key from HubSpot Settings → Integrations → API Key. For security, you can also define HUBSPOT_API_KEY in wp-config.php.', 'dental-rubio'); ?>
                    </p>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="hubspot_api_key"><?php _e('API Key', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="text"
                                       id="hubspot_api_key"
                                       name="hubspot_api_key"
                                       value="<?php echo esc_attr($hubspot_api_key); ?>"
                                       class="regular-text"
                                       placeholder="xxxxxxxx-xxxx-xxxx-xxxx-xxxxxxxxxxxx">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="hubspot_portal_id"><?php _e('Portal ID', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="text"
                                       id="hubspot_portal_id"
                                       name="hubspot_portal_id"
                                       value="<?php echo esc_attr($hubspot_portal_id); ?>"
                                       class="regular-text"
                                       placeholder="12345678">
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Zapier Settings -->
                <div class="card" style="max-width: none; margin-top: 20px;">
                    <h2><?php _e('Zapier Webhook URLs', 'dental-rubio'); ?></h2>
                    <p class="description">
                        <?php _e('Create Zaps in Zapier and paste the webhook URLs here. Each webhook can trigger different automations.', 'dental-rubio'); ?>
                    </p>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="zapier_webhook_contact"><?php _e('Contact Form Webhook', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="url"
                                       id="zapier_webhook_contact"
                                       name="zapier_webhook_contact"
                                       value="<?php echo esc_attr($zapier_webhook_contact); ?>"
                                       class="large-text"
                                       placeholder="https://hooks.zapier.com/hooks/catch/...">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="zapier_webhook_calculator"><?php _e('Calculator Webhook', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="url"
                                       id="zapier_webhook_calculator"
                                       name="zapier_webhook_calculator"
                                       value="<?php echo esc_attr($zapier_webhook_calculator); ?>"
                                       class="large-text"
                                       placeholder="https://hooks.zapier.com/hooks/catch/...">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="zapier_webhook_appointment"><?php _e('Appointment Webhook', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="url"
                                       id="zapier_webhook_appointment"
                                       name="zapier_webhook_appointment"
                                       value="<?php echo esc_attr($zapier_webhook_appointment); ?>"
                                       class="large-text"
                                       placeholder="https://hooks.zapier.com/hooks/catch/...">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="zapier_webhook_newsletter"><?php _e('Newsletter Webhook', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="url"
                                       id="zapier_webhook_newsletter"
                                       name="zapier_webhook_newsletter"
                                       value="<?php echo esc_attr($zapier_webhook_newsletter); ?>"
                                       class="large-text"
                                       placeholder="https://hooks.zapier.com/hooks/catch/...">
                            </td>
                        </tr>
                    </table>
                </div>

                <!-- Email Settings -->
                <div class="card" style="max-width: none; margin-top: 20px;">
                    <h2><?php _e('Email Settings', 'dental-rubio'); ?></h2>
                    <table class="form-table">
                        <tr>
                            <th scope="row">
                                <label for="email_from"><?php _e('From Email Address', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="email"
                                       id="email_from"
                                       name="email_from"
                                       value="<?php echo esc_attr($email_from); ?>"
                                       class="regular-text"
                                       placeholder="info@dentalrubiogroup.com">
                                <p class="description">
                                    <?php _e('Email address to send automated emails from', 'dental-rubio'); ?>
                                </p>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="email_from_name"><?php _e('From Name', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="text"
                                       id="email_from_name"
                                       name="email_from_name"
                                       value="<?php echo esc_attr($email_from_name); ?>"
                                       class="regular-text"
                                       placeholder="Dental Rubio Group">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">
                                <label for="notification_email"><?php _e('Notification Email', 'dental-rubio'); ?></label>
                            </th>
                            <td>
                                <input type="email"
                                       id="notification_email"
                                       name="notification_email"
                                       value="<?php echo esc_attr($notification_email); ?>"
                                       class="regular-text"
                                       placeholder="admin@dentalrubiogroup.com">
                                <p class="description">
                                    <?php _e('Email address to receive lead notifications', 'dental-rubio'); ?>
                                </p>
                            </td>
                        </tr>
                    </table>
                </div>

                <?php submit_button(__('Save Settings', 'dental-rubio'), 'primary', 'dental_rubio_crm_settings_submit'); ?>
            </form>

            <!-- Integration Status -->
            <div class="card" style="max-width: none; margin-top: 20px;">
                <h2><?php _e('Integration Status', 'dental-rubio'); ?></h2>
                <table class="widefat">
                    <thead>
                        <tr>
                            <th><?php _e('Integration', 'dental-rubio'); ?></th>
                            <th><?php _e('Status', 'dental-rubio'); ?></th>
                            <th><?php _e('Details', 'dental-rubio'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><strong><?php _e('HubSpot', 'dental-rubio'); ?></strong></td>
                            <td>
                                <?php if ($enable_hubspot === '1' && !empty($hubspot_api_key)): ?>
                                    <span style="color: #10b981;">● <?php _e('Active', 'dental-rubio'); ?></span>
                                <?php else: ?>
                                    <span style="color: #6b7280;">○ <?php _e('Inactive', 'dental-rubio'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php if (!empty($hubspot_api_key)): ?>
                                    <?php _e('API Key configured', 'dental-rubio'); ?>
                                <?php else: ?>
                                    <?php _e('API Key not set', 'dental-rubio'); ?>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Zapier', 'dental-rubio'); ?></strong></td>
                            <td>
                                <?php if ($enable_zapier === '1'): ?>
                                    <span style="color: #10b981;">● <?php _e('Active', 'dental-rubio'); ?></span>
                                <?php else: ?>
                                    <span style="color: #6b7280;">○ <?php _e('Inactive', 'dental-rubio'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td>
                                <?php
                                $webhook_count = 0;
                                if (!empty($zapier_webhook_contact)) $webhook_count++;
                                if (!empty($zapier_webhook_calculator)) $webhook_count++;
                                if (!empty($zapier_webhook_appointment)) $webhook_count++;
                                if (!empty($zapier_webhook_newsletter)) $webhook_count++;
                                printf(__('%d webhooks configured', 'dental-rubio'), $webhook_count);
                                ?>
                            </td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Email Automation', 'dental-rubio'); ?></strong></td>
                            <td>
                                <?php if ($enable_email_automation === '1'): ?>
                                    <span style="color: #10b981;">● <?php _e('Active', 'dental-rubio'); ?></span>
                                <?php else: ?>
                                    <span style="color: #6b7280;">○ <?php _e('Inactive', 'dental-rubio'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php _e('Automated email sequences enabled', 'dental-rubio'); ?></td>
                        </tr>
                        <tr>
                            <td><strong><?php _e('Lead Tracking', 'dental-rubio'); ?></strong></td>
                            <td>
                                <?php if ($enable_lead_tracking === '1'): ?>
                                    <span style="color: #10b981;">● <?php _e('Active', 'dental-rubio'); ?></span>
                                <?php else: ?>
                                    <span style="color: #6b7280;">○ <?php _e('Inactive', 'dental-rubio'); ?></span>
                                <?php endif; ?>
                            </td>
                            <td><?php _e('Tracking visitors and lead behavior', 'dental-rubio'); ?></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        <?php
    }
}

/**
 * Initialize CRM settings
 */
function dental_rubio_init_crm_settings() {
    return new Dental_Rubio_CRM_Settings();
}

// Initialize on admin_init
add_action('admin_init', 'dental_rubio_init_crm_settings');
