<?php
/**
 * Email Automation
 *
 * Automated email sequences and templates for patient communication.
 * Includes welcome emails, follow-ups, reminders, and nurture campaigns.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Email Automation Handler
 */
class Dental_Rubio_Email_Automation {

    /**
     * From email address
     */
    private $from_email;

    /**
     * From name
     */
    private $from_name;

    /**
     * Constructor
     */
    public function __construct() {
        $this->from_email = get_option('dental_rubio_email_from', 'info@dentalrubiogroup.com');
        $this->from_name = get_option('dental_rubio_email_from_name', 'Dental Rubio Group');

        // Hook into form submissions
        add_action('dental_rubio_contact_form_submit', array($this, 'send_contact_confirmation'), 10, 1);
        add_action('dental_rubio_calculator_submit', array($this, 'send_calculator_followup'), 10, 1);
        add_action('dental_rubio_appointment_request', array($this, 'send_appointment_confirmation'), 10, 1);

        // Schedule follow-up emails
        add_action('dental_rubio_send_followup_email', array($this, 'send_scheduled_followup'), 10, 2);

        // Filter email headers
        add_filter('wp_mail_from', array($this, 'set_from_email'));
        add_filter('wp_mail_from_name', array($this, 'set_from_name'));
    }

    /**
     * Set from email
     *
     * @param string $email Original email
     * @return string Modified email
     */
    public function set_from_email($email) {
        return $this->from_email;
    }

    /**
     * Set from name
     *
     * @param string $name Original name
     * @return string Modified name
     */
    public function set_from_name($name) {
        return $this->from_name;
    }

    /**
     * Send contact form confirmation email
     *
     * @param array $form_data Form data
     */
    public function send_contact_confirmation($form_data) {
        if (empty($form_data['email'])) {
            return;
        }

        $to = sanitize_email($form_data['email']);
        $subject = __('Thank You for Contacting Dental Rubio Group', 'dental-rubio');

        $message = $this->get_email_template('contact-confirmation', array(
            'first_name' => isset($form_data['first_name']) ? $form_data['first_name'] : '',
            'treatment_interest' => isset($form_data['treatment_interest']) ? $form_data['treatment_interest'] : '',
        ));

        wp_mail($to, $subject, $message, $this->get_email_headers());

        // Send internal notification
        $this->send_internal_notification('contact_form', $form_data);

        // Schedule follow-up email for 2 days later
        wp_schedule_single_event(
            time() + (2 * DAY_IN_SECONDS),
            'dental_rubio_send_followup_email',
            array($to, 'contact_followup')
        );
    }

    /**
     * Send calculator follow-up email
     *
     * @param array $calculator_data Calculator data
     */
    public function send_calculator_followup($calculator_data) {
        if (empty($calculator_data['email'])) {
            return;
        }

        $to = sanitize_email($calculator_data['email']);
        $subject = __('Your Dental Cost Estimate from Dental Rubio Group', 'dental-rubio');

        $message = $this->get_email_template('calculator-followup', array(
            'name' => isset($calculator_data['name']) ? $calculator_data['name'] : '',
            'calculator_type' => isset($calculator_data['calculator_type']) ? $calculator_data['calculator_type'] : '',
            'estimated_cost' => isset($calculator_data['estimated_cost']) ? $calculator_data['estimated_cost'] : 0,
            'savings_amount' => isset($calculator_data['savings_amount']) ? $calculator_data['savings_amount'] : 0,
        ));

        wp_mail($to, $subject, $message, $this->get_email_headers());

        // Schedule follow-up email for 3 days later
        wp_schedule_single_event(
            time() + (3 * DAY_IN_SECONDS),
            'dental_rubio_send_followup_email',
            array($to, 'calculator_followup_2')
        );
    }

    /**
     * Send appointment confirmation email
     *
     * @param array $appointment_data Appointment data
     */
    public function send_appointment_confirmation($appointment_data) {
        if (empty($appointment_data['email'])) {
            return;
        }

        $to = sanitize_email($appointment_data['email']);
        $subject = __('Appointment Request Received - Dental Rubio Group', 'dental-rubio');

        $message = $this->get_email_template('appointment-confirmation', array(
            'first_name' => isset($appointment_data['first_name']) ? $appointment_data['first_name'] : '',
            'preferred_date' => isset($appointment_data['preferred_date']) ? $appointment_data['preferred_date'] : '',
            'preferred_time' => isset($appointment_data['preferred_time']) ? $appointment_data['preferred_time'] : '',
            'treatment' => isset($appointment_data['treatment']) ? $appointment_data['treatment'] : '',
        ));

        wp_mail($to, $subject, $message, $this->get_email_headers());

        // Send internal notification
        $this->send_internal_notification('appointment', $appointment_data);
    }

    /**
     * Send scheduled follow-up email
     *
     * @param string $to Recipient email
     * @param string $template Template name
     */
    public function send_scheduled_followup($to, $template) {
        $subject = $this->get_followup_subject($template);
        $message = $this->get_email_template($template);

        wp_mail($to, $subject, $message, $this->get_email_headers());
    }

    /**
     * Get follow-up subject line
     *
     * @param string $template Template name
     * @return string Subject line
     */
    private function get_followup_subject($template) {
        $subjects = array(
            'contact_followup' => __('Have Questions About Your Dental Treatment?', 'dental-rubio'),
            'calculator_followup_2' => __('Ready to Save on Your Dental Treatment?', 'dental-rubio'),
            'welcome_series_1' => __('Welcome to Dental Rubio Group', 'dental-rubio'),
            'welcome_series_2' => __('What to Expect at Dental Rubio Group', 'dental-rubio'),
            'welcome_series_3' => __('Patient Success Stories', 'dental-rubio'),
        );

        return isset($subjects[$template]) ? $subjects[$template] : __('Update from Dental Rubio Group', 'dental-rubio');
    }

    /**
     * Get email template
     *
     * @param string $template Template name
     * @param array $data Template data
     * @return string Email HTML
     */
    private function get_email_template($template, $data = array()) {
        ob_start();
        include dirname(__FILE__) . '/email-templates/' . $template . '.php';
        return ob_get_clean();
    }

    /**
     * Get email headers
     *
     * @return array Email headers
     */
    private function get_email_headers() {
        return array(
            'Content-Type: text/html; charset=UTF-8',
            'From: ' . $this->from_name . ' <' . $this->from_email . '>',
            'Reply-To: ' . $this->from_email,
        );
    }

    /**
     * Send internal notification to staff
     *
     * @param string $type Notification type
     * @param array $data Form data
     */
    private function send_internal_notification($type, $data) {
        $admin_email = get_option('dental_rubio_notification_email', get_option('admin_email'));

        if (empty($admin_email)) {
            return;
        }

        $subject = $this->get_internal_subject($type);
        $message = $this->get_internal_template($type, $data);

        wp_mail($admin_email, $subject, $message, $this->get_email_headers());
    }

    /**
     * Get internal notification subject
     *
     * @param string $type Notification type
     * @return string Subject line
     */
    private function get_internal_subject($type) {
        $subjects = array(
            'contact_form' => '[New Lead] Contact Form Submission',
            'appointment' => '[Urgent] Appointment Request',
            'calculator' => '[Lead] Calculator Submission',
        );

        return isset($subjects[$type]) ? $subjects[$type] : 'New Website Activity';
    }

    /**
     * Get internal notification template
     *
     * @param string $type Notification type
     * @param array $data Form data
     * @return string Email HTML
     */
    private function get_internal_template($type, $data) {
        ob_start();
        ?>
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                .header { background: #1e3a8a; color: white; padding: 20px; text-align: center; }
                .content { background: #f9fafb; padding: 20px; }
                .field { margin-bottom: 15px; }
                .label { font-weight: bold; color: #1e3a8a; }
                .value { margin-top: 5px; }
                .urgent { background: #fef3c7; border-left: 4px solid #f59e0b; padding: 15px; margin: 20px 0; }
            </style>
        </head>
        <body>
            <div class="container">
                <div class="header">
                    <h2>🦷 New <?php echo esc_html(ucwords(str_replace('_', ' ', $type))); ?></h2>
                </div>
                <div class="content">
                    <?php if ($type === 'appointment'): ?>
                        <div class="urgent">
                            <strong>⚠️ Appointment Request - Requires Response</strong>
                        </div>
                    <?php endif; ?>

                    <div class="field">
                        <div class="label">Timestamp:</div>
                        <div class="value"><?php echo current_time('F j, Y g:i a'); ?></div>
                    </div>

                    <?php if (!empty($data['first_name']) && !empty($data['last_name'])): ?>
                        <div class="field">
                            <div class="label">Name:</div>
                            <div class="value"><?php echo esc_html($data['first_name'] . ' ' . $data['last_name']); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['email'])): ?>
                        <div class="field">
                            <div class="label">Email:</div>
                            <div class="value"><a href="mailto:<?php echo esc_attr($data['email']); ?>"><?php echo esc_html($data['email']); ?></a></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['phone'])): ?>
                        <div class="field">
                            <div class="label">Phone:</div>
                            <div class="value"><a href="tel:<?php echo esc_attr($data['phone']); ?>"><?php echo esc_html($data['phone']); ?></a></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['message'])): ?>
                        <div class="field">
                            <div class="label">Message:</div>
                            <div class="value"><?php echo nl2br(esc_html($data['message'])); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['treatment_interest'])): ?>
                        <div class="field">
                            <div class="label">Treatment Interest:</div>
                            <div class="value"><?php echo esc_html($data['treatment_interest']); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['preferred_date'])): ?>
                        <div class="field">
                            <div class="label">Preferred Date:</div>
                            <div class="value"><?php echo esc_html($data['preferred_date']); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['preferred_time'])): ?>
                        <div class="field">
                            <div class="label">Preferred Time:</div>
                            <div class="value"><?php echo esc_html($data['preferred_time']); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['estimated_cost'])): ?>
                        <div class="field">
                            <div class="label">Estimated Cost:</div>
                            <div class="value">$<?php echo number_format($data['estimated_cost'], 2); ?></div>
                        </div>
                    <?php endif; ?>

                    <?php if (!empty($data['savings_amount'])): ?>
                        <div class="field">
                            <div class="label">Potential Savings:</div>
                            <div class="value">$<?php echo number_format($data['savings_amount'], 2); ?></div>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        </body>
        </html>
        <?php
        return ob_get_clean();
    }
}

/**
 * Initialize email automation
 */
function dental_rubio_init_email_automation() {
    return new Dental_Rubio_Email_Automation();
}

// Initialize on plugins_loaded
add_action('plugins_loaded', 'dental_rubio_init_email_automation');
