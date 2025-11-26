<?php
/**
 * Zapier Webhook Integration
 *
 * Sends form submissions and events to Zapier webhooks for automation.
 * Supports multiple webhook triggers and custom data formatting.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Zapier Webhook Handler
 */
class Dental_Rubio_Zapier {

    /**
     * Webhook URLs (store in wp-config.php or options)
     */
    private $webhooks = array();

    /**
     * Constructor
     */
    public function __construct() {
        // Load webhook URLs from options or wp-config.php
        $this->webhooks = array(
            'contact_form' => defined('ZAPIER_WEBHOOK_CONTACT') ? ZAPIER_WEBHOOK_CONTACT : get_option('dental_rubio_zapier_webhook_contact', ''),
            'calculator' => defined('ZAPIER_WEBHOOK_CALCULATOR') ? ZAPIER_WEBHOOK_CALCULATOR : get_option('dental_rubio_zapier_webhook_calculator', ''),
            'appointment' => defined('ZAPIER_WEBHOOK_APPOINTMENT') ? ZAPIER_WEBHOOK_APPOINTMENT : get_option('dental_rubio_zapier_webhook_appointment', ''),
            'newsletter' => defined('ZAPIER_WEBHOOK_NEWSLETTER') ? ZAPIER_WEBHOOK_NEWSLETTER : get_option('dental_rubio_zapier_webhook_newsletter', ''),
        );

        // Hook into form submissions
        add_action('dental_rubio_contact_form_submit', array($this, 'send_contact_webhook'), 10, 1);
        add_action('dental_rubio_calculator_submit', array($this, 'send_calculator_webhook'), 10, 1);
        add_action('dental_rubio_appointment_request', array($this, 'send_appointment_webhook'), 10, 1);
        add_action('dental_rubio_newsletter_signup', array($this, 'send_newsletter_webhook'), 10, 1);
    }

    /**
     * Check if webhook is configured
     *
     * @param string $type Webhook type
     * @return bool True if configured
     */
    public function is_configured($type = 'contact_form') {
        return !empty($this->webhooks[$type]);
    }

    /**
     * Send contact form to Zapier
     *
     * @param array $form_data Form data
     * @return bool|WP_Error Success or error
     */
    public function send_contact_webhook($form_data) {
        if (!$this->is_configured('contact_form')) {
            return false;
        }

        // Prepare webhook payload
        $payload = array(
            'type' => 'contact_form',
            'timestamp' => current_time('mysql'),
            'source_url' => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : home_url(),
            'contact' => array(
                'first_name' => isset($form_data['first_name']) ? sanitize_text_field($form_data['first_name']) : '',
                'last_name' => isset($form_data['last_name']) ? sanitize_text_field($form_data['last_name']) : '',
                'email' => isset($form_data['email']) ? sanitize_email($form_data['email']) : '',
                'phone' => isset($form_data['phone']) ? sanitize_text_field($form_data['phone']) : '',
                'message' => isset($form_data['message']) ? sanitize_textarea_field($form_data['message']) : '',
            ),
            'metadata' => array(
                'treatment_interest' => isset($form_data['treatment_interest']) ? sanitize_text_field($form_data['treatment_interest']) : '',
                'preferred_date' => isset($form_data['preferred_date']) ? sanitize_text_field($form_data['preferred_date']) : '',
                'preferred_time' => isset($form_data['preferred_time']) ? sanitize_text_field($form_data['preferred_time']) : '',
                'hear_about_us' => isset($form_data['hear_about_us']) ? sanitize_text_field($form_data['hear_about_us']) : '',
            ),
        );

        // Add UTM parameters
        $payload['utm'] = $this->get_utm_parameters();

        // Add user agent and IP
        $payload['user_info'] = array(
            'ip_address' => $this->get_client_ip(),
            'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : '',
            'language' => isset($_SERVER['HTTP_ACCEPT_LANGUAGE']) ? sanitize_text_field(substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2)) : 'en',
        );

        return $this->send_webhook($this->webhooks['contact_form'], $payload);
    }

    /**
     * Send calculator interaction to Zapier
     *
     * @param array $calculator_data Calculator data
     * @return bool|WP_Error Success or error
     */
    public function send_calculator_webhook($calculator_data) {
        if (!$this->is_configured('calculator')) {
            return false;
        }

        // Prepare webhook payload
        $payload = array(
            'type' => 'calculator_submission',
            'timestamp' => current_time('mysql'),
            'source_url' => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : home_url(),
            'calculator' => array(
                'calculator_type' => isset($calculator_data['calculator_type']) ? sanitize_text_field($calculator_data['calculator_type']) : '',
                'treatment_type' => isset($calculator_data['treatment_type']) ? sanitize_text_field($calculator_data['treatment_type']) : '',
                'estimated_cost' => isset($calculator_data['estimated_cost']) ? floatval($calculator_data['estimated_cost']) : 0,
                'savings_amount' => isset($calculator_data['savings_amount']) ? floatval($calculator_data['savings_amount']) : 0,
                'savings_percent' => isset($calculator_data['savings_percent']) ? floatval($calculator_data['savings_percent']) : 0,
            ),
            'contact' => array(
                'email' => isset($calculator_data['email']) ? sanitize_email($calculator_data['email']) : '',
                'name' => isset($calculator_data['name']) ? sanitize_text_field($calculator_data['name']) : '',
            ),
            'utm' => $this->get_utm_parameters(),
            'user_info' => array(
                'ip_address' => $this->get_client_ip(),
                'user_agent' => isset($_SERVER['HTTP_USER_AGENT']) ? sanitize_text_field($_SERVER['HTTP_USER_AGENT']) : '',
            ),
        );

        return $this->send_webhook($this->webhooks['calculator'], $payload);
    }

    /**
     * Send appointment request to Zapier
     *
     * @param array $appointment_data Appointment data
     * @return bool|WP_Error Success or error
     */
    public function send_appointment_webhook($appointment_data) {
        if (!$this->is_configured('appointment')) {
            return false;
        }

        // Prepare webhook payload
        $payload = array(
            'type' => 'appointment_request',
            'timestamp' => current_time('mysql'),
            'source_url' => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : home_url(),
            'appointment' => array(
                'preferred_date' => isset($appointment_data['preferred_date']) ? sanitize_text_field($appointment_data['preferred_date']) : '',
                'preferred_time' => isset($appointment_data['preferred_time']) ? sanitize_text_field($appointment_data['preferred_time']) : '',
                'treatment' => isset($appointment_data['treatment']) ? sanitize_text_field($appointment_data['treatment']) : '',
                'urgency' => isset($appointment_data['urgency']) ? sanitize_text_field($appointment_data['urgency']) : 'normal',
            ),
            'contact' => array(
                'first_name' => isset($appointment_data['first_name']) ? sanitize_text_field($appointment_data['first_name']) : '',
                'last_name' => isset($appointment_data['last_name']) ? sanitize_text_field($appointment_data['last_name']) : '',
                'email' => isset($appointment_data['email']) ? sanitize_email($appointment_data['email']) : '',
                'phone' => isset($appointment_data['phone']) ? sanitize_text_field($appointment_data['phone']) : '',
            ),
            'utm' => $this->get_utm_parameters(),
        );

        return $this->send_webhook($this->webhooks['appointment'], $payload);
    }

    /**
     * Send newsletter signup to Zapier
     *
     * @param array $newsletter_data Newsletter data
     * @return bool|WP_Error Success or error
     */
    public function send_newsletter_webhook($newsletter_data) {
        if (!$this->is_configured('newsletter')) {
            return false;
        }

        // Prepare webhook payload
        $payload = array(
            'type' => 'newsletter_signup',
            'timestamp' => current_time('mysql'),
            'source_url' => isset($_SERVER['HTTP_REFERER']) ? esc_url_raw($_SERVER['HTTP_REFERER']) : home_url(),
            'contact' => array(
                'email' => isset($newsletter_data['email']) ? sanitize_email($newsletter_data['email']) : '',
                'name' => isset($newsletter_data['name']) ? sanitize_text_field($newsletter_data['name']) : '',
            ),
            'interests' => isset($newsletter_data['interests']) ? array_map('sanitize_text_field', (array) $newsletter_data['interests']) : array(),
            'utm' => $this->get_utm_parameters(),
        );

        return $this->send_webhook($this->webhooks['newsletter'], $payload);
    }

    /**
     * Send webhook to Zapier
     *
     * @param string $webhook_url Webhook URL
     * @param array $payload Data to send
     * @return bool|WP_Error Success or error
     */
    private function send_webhook($webhook_url, $payload) {
        if (empty($webhook_url)) {
            return new WP_Error('no_webhook', 'Webhook URL not configured');
        }

        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => wp_json_encode($payload),
            'timeout' => 15,
            'blocking' => false, // Don't wait for response (async)
        );

        $response = wp_remote_post($webhook_url, $args);

        if (is_wp_error($response)) {
            error_log('Zapier webhook failed: ' . $response->get_error_message());
            return $response;
        }

        return true;
    }

    /**
     * Get UTM parameters from cookies or query string
     *
     * @return array UTM parameters
     */
    private function get_utm_parameters() {
        $utm_params = array();

        $utm_fields = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content');

        foreach ($utm_fields as $field) {
            // Check cookie first, then query string
            if (!empty($_COOKIE['dental_rubio_' . $field])) {
                $utm_params[$field] = sanitize_text_field($_COOKIE['dental_rubio_' . $field]);
            } elseif (!empty($_GET[$field])) {
                $utm_params[$field] = sanitize_text_field($_GET[$field]);
            }
        }

        return $utm_params;
    }

    /**
     * Get client IP address
     *
     * @return string IP address
     */
    private function get_client_ip() {
        $ip_keys = array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR');

        foreach ($ip_keys as $key) {
            if (array_key_exists($key, $_SERVER) === true) {
                foreach (explode(',', $_SERVER[$key]) as $ip) {
                    $ip = trim($ip);

                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false) {
                        return $ip;
                    }
                }
            }
        }

        return isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '0.0.0.0';
    }

    /**
     * Test webhook connection
     *
     * @param string $type Webhook type
     * @return bool|WP_Error Success or error
     */
    public function test_webhook($type = 'contact_form') {
        if (!$this->is_configured($type)) {
            return new WP_Error('not_configured', 'Webhook not configured');
        }

        $test_payload = array(
            'test' => true,
            'type' => $type,
            'timestamp' => current_time('mysql'),
            'message' => 'This is a test webhook from Dental Rubio Theme',
        );

        $args = array(
            'method' => 'POST',
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'body' => wp_json_encode($test_payload),
            'timeout' => 15,
        );

        $response = wp_remote_post($this->webhooks[$type], $args);

        if (is_wp_error($response)) {
            return $response;
        }

        $response_code = wp_remote_retrieve_response_code($response);

        if ($response_code >= 200 && $response_code < 300) {
            return true;
        }

        return new WP_Error('webhook_failed', 'Webhook returned status code: ' . $response_code);
    }
}

/**
 * Initialize Zapier integration
 */
function dental_rubio_init_zapier() {
    return new Dental_Rubio_Zapier();
}

// Initialize on plugins_loaded
add_action('plugins_loaded', 'dental_rubio_init_zapier');

/**
 * REST API endpoint for webhook testing
 */
function dental_rubio_register_webhook_test_endpoint() {
    register_rest_route('dental-rubio/v1', '/test-webhook/(?P<type>[a-z_]+)', array(
        'methods' => 'POST',
        'callback' => 'dental_rubio_test_webhook_callback',
        'permission_callback' => function() {
            return current_user_can('manage_options');
        },
    ));
}
add_action('rest_api_init', 'dental_rubio_register_webhook_test_endpoint');

/**
 * Webhook test callback
 *
 * @param WP_REST_Request $request Request object
 * @return WP_REST_Response Response
 */
function dental_rubio_test_webhook_callback($request) {
    $type = $request->get_param('type');
    $zapier = dental_rubio_init_zapier();

    $result = $zapier->test_webhook($type);

    if (is_wp_error($result)) {
        return new WP_REST_Response(array(
            'success' => false,
            'message' => $result->get_error_message(),
        ), 400);
    }

    return new WP_REST_Response(array(
        'success' => true,
        'message' => 'Webhook test successful',
    ), 200);
}
