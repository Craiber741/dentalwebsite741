<?php
/**
 * Theme Setup Wizard
 *
 * Initial setup wizard that appears after theme activation.
 * Guides users through essential configuration steps.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Setup Wizard Class
 */
class Dental_Rubio_Setup_Wizard {

    /**
     * Constructor
     */
    public function __construct() {
        add_action('after_switch_theme', array($this, 'redirect_to_wizard'));
        add_action('admin_menu', array($this, 'add_wizard_page'));
        add_action('admin_init', array($this, 'save_wizard_step'));
        add_action('admin_enqueue_scripts', array($this, 'enqueue_wizard_assets'));
    }

    /**
     * Redirect to wizard after theme activation
     */
    public function redirect_to_wizard() {
        // Check if wizard has been completed
        if (!get_option('dental_rubio_setup_complete', false)) {
            wp_safe_redirect(admin_url('themes.php?page=dental-rubio-setup-wizard'));
            exit;
        }
    }

    /**
     * Add wizard page to admin menu
     */
    public function add_wizard_page() {
        add_theme_page(
            __('Setup Wizard', 'dental-rubio'),
            __('Setup Wizard', 'dental-rubio'),
            'manage_options',
            'dental-rubio-setup-wizard',
            array($this, 'render_wizard_page')
        );
    }

    /**
     * Enqueue wizard assets
     */
    public function enqueue_wizard_assets($hook) {
        if ($hook !== 'appearance_page_dental-rubio-setup-wizard') {
            return;
        }

        wp_enqueue_style('dental-rubio-wizard', get_template_directory_uri() . '/assets/css/wizard.css', array(), '1.0.0');
    }

    /**
     * Save wizard step
     */
    public function save_wizard_step() {
        if (!isset($_POST['dental_rubio_wizard_step'])) {
            return;
        }

        check_admin_referer('dental_rubio_wizard_' . $_POST['dental_rubio_wizard_step']);

        $step = sanitize_text_field($_POST['dental_rubio_wizard_step']);

        switch ($step) {
            case 'welcome':
                // Just proceed to next step
                break;

            case 'contact':
                update_option('dental_rubio_phone', sanitize_text_field($_POST['phone']));
                update_option('dental_rubio_whatsapp', sanitize_text_field($_POST['whatsapp']));
                update_option('dental_rubio_email', sanitize_email($_POST['email']));
                update_option('dental_rubio_address', sanitize_textarea_field($_POST['address']));
                break;

            case 'integrations':
                update_option('dental_rubio_enable_hubspot', isset($_POST['enable_hubspot']) ? '1' : '0');
                update_option('dental_rubio_enable_zapier', isset($_POST['enable_zapier']) ? '1' : '0');
                update_option('dental_rubio_enable_email_automation', isset($_POST['enable_email_automation']) ? '1' : '0');
                update_option('dental_rubio_enable_lead_tracking', isset($_POST['enable_lead_tracking']) ? '1' : '0');
                break;

            case 'complete':
                update_option('dental_rubio_setup_complete', true);
                wp_safe_redirect(admin_url('customize.php'));
                exit;
        }
    }

    /**
     * Render wizard page
     */
    public function render_wizard_page() {
        $step = isset($_GET['step']) ? sanitize_text_field($_GET['step']) : 'welcome';

        ?>
        <div class="wrap dental-rubio-wizard">
            <h1><?php _e('Dental Rubio Theme Setup Wizard', 'dental-rubio'); ?></h1>

            <!-- Progress Bar -->
            <div class="wizard-progress">
                <div class="wizard-steps">
                    <div class="wizard-step <?php echo $step === 'welcome' ? 'active' : ''; ?> <?php echo in_array($step, array('contact', 'integrations', 'complete')) ? 'completed' : ''; ?>">
                        <span class="step-number">1</span>
                        <span class="step-label"><?php _e('Welcome', 'dental-rubio'); ?></span>
                    </div>
                    <div class="wizard-step <?php echo $step === 'contact' ? 'active' : ''; ?> <?php echo in_array($step, array('integrations', 'complete')) ? 'completed' : ''; ?>">
                        <span class="step-number">2</span>
                        <span class="step-label"><?php _e('Contact Info', 'dental-rubio'); ?></span>
                    </div>
                    <div class="wizard-step <?php echo $step === 'integrations' ? 'active' : ''; ?> <?php echo $step === 'complete' ? 'completed' : ''; ?>">
                        <span class="step-number">3</span>
                        <span class="step-label"><?php _e('Integrations', 'dental-rubio'); ?></span>
                    </div>
                    <div class="wizard-step <?php echo $step === 'complete' ? 'active' : ''; ?>">
                        <span class="step-number">4</span>
                        <span class="step-label"><?php _e('Complete', 'dental-rubio'); ?></span>
                    </div>
                </div>
            </div>

            <!-- Step Content -->
            <div class="wizard-content">
                <?php
                switch ($step) {
                    case 'welcome':
                        $this->render_welcome_step();
                        break;
                    case 'contact':
                        $this->render_contact_step();
                        break;
                    case 'integrations':
                        $this->render_integrations_step();
                        break;
                    case 'complete':
                        $this->render_complete_step();
                        break;
                }
                ?>
            </div>
        </div>

        <style>
            .dental-rubio-wizard {
                max-width: 800px;
                margin: 40px auto;
            }
            .wizard-progress {
                background: #fff;
                padding: 30px;
                margin-bottom: 30px;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
            }
            .wizard-steps {
                display: flex;
                justify-content: space-between;
                align-items: center;
            }
            .wizard-step {
                flex: 1;
                text-align: center;
                position: relative;
            }
            .wizard-step:not(:last-child)::after {
                content: '';
                position: absolute;
                top: 20px;
                left: 50%;
                width: 100%;
                height: 2px;
                background: #e5e7eb;
                z-index: 0;
            }
            .wizard-step.completed:not(:last-child)::after {
                background: #10b981;
            }
            .step-number {
                display: inline-block;
                width: 40px;
                height: 40px;
                line-height: 40px;
                border-radius: 50%;
                background: #e5e7eb;
                color: #6b7280;
                font-weight: bold;
                position: relative;
                z-index: 1;
            }
            .wizard-step.active .step-number {
                background: #1e3a8a;
                color: #fff;
            }
            .wizard-step.completed .step-number {
                background: #10b981;
                color: #fff;
            }
            .step-label {
                display: block;
                margin-top: 10px;
                font-size: 14px;
                color: #6b7280;
            }
            .wizard-step.active .step-label {
                color: #1e3a8a;
                font-weight: bold;
            }
            .wizard-content {
                background: #fff;
                padding: 40px;
                border: 1px solid #e5e7eb;
                border-radius: 8px;
            }
            .wizard-content h2 {
                margin-top: 0;
                color: #1e3a8a;
            }
            .wizard-content .description {
                font-size: 16px;
                line-height: 1.6;
                color: #6b7280;
                margin-bottom: 30px;
            }
            .wizard-actions {
                margin-top: 30px;
                padding-top: 30px;
                border-top: 1px solid #e5e7eb;
                text-align: right;
            }
            .wizard-actions .button {
                margin-left: 10px;
            }
            .feature-list {
                list-style: none;
                padding: 0;
                margin: 20px 0;
            }
            .feature-list li {
                padding: 15px 0;
                border-bottom: 1px solid #f3f4f6;
            }
            .feature-list li:last-child {
                border-bottom: none;
            }
            .feature-list li::before {
                content: '✓';
                display: inline-block;
                width: 24px;
                height: 24px;
                line-height: 24px;
                text-align: center;
                background: #10b981;
                color: #fff;
                border-radius: 50%;
                margin-right: 15px;
                font-weight: bold;
            }
        </style>
        <?php
    }

    /**
     * Render welcome step
     */
    private function render_welcome_step() {
        ?>
        <h2><?php _e('Welcome to Dental Rubio Theme!', 'dental-rubio'); ?></h2>

        <p class="description">
            <?php _e('Thank you for choosing the Dental Rubio theme. This wizard will help you set up your website in just a few minutes.', 'dental-rubio'); ?>
        </p>

        <h3><?php _e('What This Theme Includes:', 'dental-rubio'); ?></h3>

        <ul class="feature-list">
            <li><?php _e('Senior-friendly design optimized for ages 55-80', 'dental-rubio'); ?></li>
            <li><?php _e('Advanced cost calculators for dental procedures', 'dental-rubio'); ?></li>
            <li><?php _e('HubSpot CRM and Zapier integrations', 'dental-rubio'); ?></li>
            <li><?php _e('Email automation for lead nurturing', 'dental-rubio'); ?></li>
            <li><?php _e('Lead tracking and scoring system', 'dental-rubio'); ?></li>
            <li><?php _e('Google Tag Manager and Facebook Pixel', 'dental-rubio'); ?></li>
            <li><?php _e('WCAG 2.1 AA accessibility compliant', 'dental-rubio'); ?></li>
            <li><?php _e('Performance optimized (Tailwind CSS, lazy loading)', 'dental-rubio'); ?></li>
        </ul>

        <div class="wizard-actions">
            <a href="<?php echo esc_url(admin_url('themes.php?page=dental-rubio-setup-wizard&step=contact')); ?>" class="button button-primary button-large">
                <?php _e('Get Started', 'dental-rubio'); ?> →
            </a>
        </div>
        <?php
    }

    /**
     * Render contact step
     */
    private function render_contact_step() {
        $phone = get_option('dental_rubio_phone', '');
        $whatsapp = get_option('dental_rubio_whatsapp', '');
        $email = get_option('dental_rubio_email', '');
        $address = get_option('dental_rubio_address', '');

        ?>
        <h2><?php _e('Contact Information', 'dental-rubio'); ?></h2>

        <p class="description">
            <?php _e('Enter your clinic\'s contact information. This will be displayed throughout your website.', 'dental-rubio'); ?>
        </p>

        <form method="post">
            <?php wp_nonce_field('dental_rubio_wizard_contact'); ?>
            <input type="hidden" name="dental_rubio_wizard_step" value="contact">

            <table class="form-table">
                <tr>
                    <th scope="row">
                        <label for="phone"><?php _e('Phone Number', 'dental-rubio'); ?></label>
                    </th>
                    <td>
                        <input type="tel" id="phone" name="phone" value="<?php echo esc_attr($phone); ?>" class="regular-text" placeholder="(619) 254-8214">
                        <p class="description"><?php _e('Your main contact phone number', 'dental-rubio'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="whatsapp"><?php _e('WhatsApp Number', 'dental-rubio'); ?></label>
                    </th>
                    <td>
                        <input type="text" id="whatsapp" name="whatsapp" value="<?php echo esc_attr($whatsapp); ?>" class="regular-text" placeholder="526531234567">
                        <p class="description"><?php _e('Format: Country code + number (no spaces or symbols). Example: 526531234567', 'dental-rubio'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="email"><?php _e('Email Address', 'dental-rubio'); ?></label>
                    </th>
                    <td>
                        <input type="email" id="email" name="email" value="<?php echo esc_attr($email); ?>" class="regular-text" placeholder="info@dentalrubiogroup.com">
                        <p class="description"><?php _e('Your clinic\'s email address', 'dental-rubio'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row">
                        <label for="address"><?php _e('Clinic Address', 'dental-rubio'); ?></label>
                    </th>
                    <td>
                        <textarea id="address" name="address" rows="3" class="large-text"><?php echo esc_textarea($address); ?></textarea>
                        <p class="description"><?php _e('Your clinic\'s full address', 'dental-rubio'); ?></p>
                    </td>
                </tr>
            </table>

            <div class="wizard-actions">
                <a href="<?php echo esc_url(admin_url('themes.php?page=dental-rubio-setup-wizard&step=welcome')); ?>" class="button button-large">
                    ← <?php _e('Back', 'dental-rubio'); ?>
                </a>
                <button type="submit" class="button button-primary button-large" onclick="window.location.href='<?php echo esc_url(admin_url('themes.php?page=dental-rubio-setup-wizard&step=integrations')); ?>'">
                    <?php _e('Continue', 'dental-rubio'); ?> →
                </button>
            </div>
        </form>
        <?php
    }

    /**
     * Render integrations step
     */
    private function render_integrations_step() {
        ?>
        <h2><?php _e('Enable Integrations', 'dental-rubio'); ?></h2>

        <p class="description">
            <?php _e('Choose which integrations you want to enable. You can configure them later in CRM Settings.', 'dental-rubio'); ?>
        </p>

        <form method="post">
            <?php wp_nonce_field('dental_rubio_wizard_integrations'); ?>
            <input type="hidden" name="dental_rubio_wizard_step" value="integrations">

            <table class="form-table">
                <tr>
                    <th scope="row"><?php _e('HubSpot CRM', 'dental-rubio'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_hubspot" value="1">
                            <?php _e('Enable HubSpot integration (requires API key)', 'dental-rubio'); ?>
                        </label>
                        <p class="description"><?php _e('Automatically create contacts and deals in HubSpot from form submissions.', 'dental-rubio'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Zapier Webhooks', 'dental-rubio'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_zapier" value="1">
                            <?php _e('Enable Zapier webhooks (requires webhook URLs)', 'dental-rubio'); ?>
                        </label>
                        <p class="description"><?php _e('Send form data to Zapier for custom automation workflows.', 'dental-rubio'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Email Automation', 'dental-rubio'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_email_automation" value="1" checked>
                            <?php _e('Enable automated email sequences', 'dental-rubio'); ?>
                        </label>
                        <p class="description"><?php _e('Send confirmation emails and follow-ups automatically.', 'dental-rubio'); ?></p>
                    </td>
                </tr>
                <tr>
                    <th scope="row"><?php _e('Lead Tracking', 'dental-rubio'); ?></th>
                    <td>
                        <label>
                            <input type="checkbox" name="enable_lead_tracking" value="1" checked>
                            <?php _e('Enable visitor and lead tracking', 'dental-rubio'); ?>
                        </label>
                        <p class="description"><?php _e('Track visitor behavior, UTM parameters, and calculate lead scores.', 'dental-rubio'); ?></p>
                    </td>
                </tr>
            </table>

            <div class="wizard-actions">
                <a href="<?php echo esc_url(admin_url('themes.php?page=dental-rubio-setup-wizard&step=contact')); ?>" class="button button-large">
                    ← <?php _e('Back', 'dental-rubio'); ?>
                </a>
                <button type="submit" class="button button-primary button-large" onclick="window.location.href='<?php echo esc_url(admin_url('themes.php?page=dental-rubio-setup-wizard&step=complete')); ?>'">
                    <?php _e('Complete Setup', 'dental-rubio'); ?> →
                </button>
            </div>
        </form>
        <?php
    }

    /**
     * Render complete step
     */
    private function render_complete_step() {
        ?>
        <h2><?php _e('Setup Complete!', 'dental-rubio'); ?> 🎉</h2>

        <p class="description">
            <?php _e('Your theme is now ready to use! Here are your next steps:', 'dental-rubio'); ?>
        </p>

        <h3><?php _e('Recommended Next Steps:', 'dental-rubio'); ?></h3>

        <ul class="feature-list">
            <li><strong><?php _e('Customize Your Site:', 'dental-rubio'); ?></strong> <?php _e('Upload your logo and customize colors', 'dental-rubio'); ?></li>
            <li><strong><?php _e('Create Pages:', 'dental-rubio'); ?></strong> <?php _e('Add service pages, pricing, contact page', 'dental-rubio'); ?></li>
            <li><strong><?php _e('Set Up Menus:', 'dental-rubio'); ?></strong> <?php _e('Configure your navigation menus', 'dental-rubio'); ?></li>
            <li><strong><?php _e('Configure CRM:', 'dental-rubio'); ?></strong> <?php _e('Add HubSpot and Zapier credentials', 'dental-rubio'); ?></li>
            <li><strong><?php _e('Install Plugins:', 'dental-rubio'); ?></strong> <?php _e('SEO, caching, security plugins', 'dental-rubio'); ?></li>
            <li><strong><?php _e('Review Documentation:', 'dental-rubio'); ?></strong> <?php _e('Read README.md and LAUNCH-CHECKLIST.md', 'dental-rubio'); ?></li>
        </ul>

        <form method="post">
            <?php wp_nonce_field('dental_rubio_wizard_complete'); ?>
            <input type="hidden" name="dental_rubio_wizard_step" value="complete">

            <div class="wizard-actions">
                <a href="<?php echo esc_url(admin_url()); ?>" class="button button-large">
                    <?php _e('Go to Dashboard', 'dental-rubio'); ?>
                </a>
                <button type="submit" class="button button-primary button-large">
                    <?php _e('Start Customizing', 'dental-rubio'); ?> →
                </button>
            </div>
        </form>
        <?php
    }
}

// Initialize setup wizard
new Dental_Rubio_Setup_Wizard();
