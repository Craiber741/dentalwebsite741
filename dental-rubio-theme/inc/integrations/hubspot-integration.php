<?php
/**
 * HubSpot Integration
 *
 * Integrates contact forms and lead tracking with HubSpot CRM.
 * Sends form submissions, calculator interactions, and page views to HubSpot.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * HubSpot API Configuration
 */
class Dental_Rubio_HubSpot {

    /**
     * HubSpot API endpoint
     */
    private $api_endpoint = 'https://api.hubapi.com';

    /**
     * HubSpot API key (stored in wp-config.php for security)
     */
    private $api_key;

    /**
     * Portal ID
     */
    private $portal_id;

    /**
     * Constructor
     */
    public function __construct() {
        // Get credentials from wp-config.php (recommended) or options
        $this->api_key = defined('HUBSPOT_API_KEY') ? HUBSPOT_API_KEY : get_option('dental_rubio_hubspot_api_key', '');
        $this->portal_id = defined('HUBSPOT_PORTAL_ID') ? HUBSPOT_PORTAL_ID : get_option('dental_rubio_hubspot_portal_id', '');

        // Hook into form submissions
        add_action('dental_rubio_contact_form_submit', array($this, 'send_contact_to_hubspot'), 10, 1);
        add_action('dental_rubio_calculator_submit', array($this, 'send_calculator_to_hubspot'), 10, 1);

        // Track page views for logged contacts
        add_action('wp_footer', array($this, 'track_page_view'), 100);
    }

    /**
     * Check if HubSpot is configured
     *
     * @return bool True if configured
     */
    public function is_configured() {
        return !empty($this->api_key) && !empty($this->portal_id);
    }

    /**
     * Send contact form submission to HubSpot
     *
     * @param array $form_data Form submission data
     * @return bool|WP_Error Success or error
     */
    public function send_contact_to_hubspot($form_data) {
        if (!$this->is_configured()) {
            return new WP_Error('not_configured', 'HubSpot is not configured');
        }

        // Prepare contact data
        $contact_data = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => sanitize_email($form_data['email'])
                ),
                array(
                    'property' => 'firstname',
                    'value' => sanitize_text_field($form_data['first_name'])
                ),
                array(
                    'property' => 'lastname',
                    'value' => sanitize_text_field($form_data['last_name'])
                ),
                array(
                    'property' => 'phone',
                    'value' => sanitize_text_field($form_data['phone'])
                ),
                array(
                    'property' => 'message',
                    'value' => sanitize_textarea_field($form_data['message'])
                ),
                array(
                    'property' => 'hs_lead_status',
                    'value' => 'NEW'
                ),
                array(
                    'property' => 'lead_source',
                    'value' => 'Website Contact Form'
                ),
            )
        );

        // Add optional fields
        if (!empty($form_data['treatment_interest'])) {
            $contact_data['properties'][] = array(
                'property' => 'treatment_interest',
                'value' => sanitize_text_field($form_data['treatment_interest'])
            );
        }

        if (!empty($form_data['preferred_date'])) {
            $contact_data['properties'][] = array(
                'property' => 'preferred_appointment_date',
                'value' => sanitize_text_field($form_data['preferred_date'])
            );
        }

        // Add UTM parameters if available
        if (!empty($_COOKIE['dental_rubio_utm_source'])) {
            $contact_data['properties'][] = array(
                'property' => 'utm_source',
                'value' => sanitize_text_field($_COOKIE['dental_rubio_utm_source'])
            );
        }

        if (!empty($_COOKIE['dental_rubio_utm_campaign'])) {
            $contact_data['properties'][] = array(
                'property' => 'utm_campaign',
                'value' => sanitize_text_field($_COOKIE['dental_rubio_utm_campaign'])
            );
        }

        // Create or update contact
        $response = $this->api_request(
            '/contacts/v1/contact/createOrUpdate/email/' . urlencode($form_data['email']),
            'POST',
            $contact_data
        );

        if (is_wp_error($response)) {
            error_log('HubSpot contact submission failed: ' . $response->get_error_message());
            return $response;
        }

        // Get contact ID from response
        $contact_id = isset($response['vid']) ? $response['vid'] : null;

        // Create deal/opportunity if treatment interest is specified
        if (!empty($form_data['treatment_interest']) && $contact_id) {
            $this->create_deal($contact_id, $form_data);
        }

        return true;
    }

    /**
     * Send calculator interaction to HubSpot
     *
     * @param array $calculator_data Calculator submission data
     * @return bool|WP_Error Success or error
     */
    public function send_calculator_to_hubspot($calculator_data) {
        if (!$this->is_configured()) {
            return new WP_Error('not_configured', 'HubSpot is not configured');
        }

        // Only send if email was provided
        if (empty($calculator_data['email'])) {
            return false;
        }

        // Prepare contact data
        $contact_data = array(
            'properties' => array(
                array(
                    'property' => 'email',
                    'value' => sanitize_email($calculator_data['email'])
                ),
                array(
                    'property' => 'hs_lead_status',
                    'value' => 'NEW'
                ),
                array(
                    'property' => 'lead_source',
                    'value' => 'Calculator - ' . sanitize_text_field($calculator_data['calculator_type'])
                ),
            )
        );

        // Add calculator-specific data
        if (!empty($calculator_data['estimated_cost'])) {
            $contact_data['properties'][] = array(
                'property' => 'estimated_treatment_cost',
                'value' => floatval($calculator_data['estimated_cost'])
            );
        }

        if (!empty($calculator_data['savings_amount'])) {
            $contact_data['properties'][] = array(
                'property' => 'potential_savings',
                'value' => floatval($calculator_data['savings_amount'])
            );
        }

        if (!empty($calculator_data['treatment_type'])) {
            $contact_data['properties'][] = array(
                'property' => 'calculator_treatment_type',
                'value' => sanitize_text_field($calculator_data['treatment_type'])
            );
        }

        // Optional name fields
        if (!empty($calculator_data['name'])) {
            $name_parts = explode(' ', $calculator_data['name'], 2);
            $contact_data['properties'][] = array(
                'property' => 'firstname',
                'value' => sanitize_text_field($name_parts[0])
            );
            if (isset($name_parts[1])) {
                $contact_data['properties'][] = array(
                    'property' => 'lastname',
                    'value' => sanitize_text_field($name_parts[1])
                );
            }
        }

        // Create or update contact
        $response = $this->api_request(
            '/contacts/v1/contact/createOrUpdate/email/' . urlencode($calculator_data['email']),
            'POST',
            $contact_data
        );

        if (is_wp_error($response)) {
            error_log('HubSpot calculator submission failed: ' . $response->get_error_message());
            return $response;
        }

        return true;
    }

    /**
     * Create a deal in HubSpot
     *
     * @param int $contact_id HubSpot contact ID
     * @param array $form_data Form data
     * @return bool|WP_Error Success or error
     */
    private function create_deal($contact_id, $form_data) {
        // Get estimated deal amount based on treatment type
        $deal_amount = $this->estimate_deal_amount($form_data['treatment_interest']);

        $deal_data = array(
            'associations' => array(
                'associatedVids' => array($contact_id)
            ),
            'properties' => array(
                array(
                    'name' => 'dealname',
                    'value' => sanitize_text_field($form_data['first_name'] . ' ' . $form_data['last_name'] . ' - ' . $form_data['treatment_interest'])
                ),
                array(
                    'name' => 'dealstage',
                    'value' => 'appointmentscheduled' // Update with your pipeline stage ID
                ),
                array(
                    'name' => 'amount',
                    'value' => $deal_amount
                ),
                array(
                    'name' => 'pipeline',
                    'value' => 'default' // Update with your pipeline ID
                ),
                array(
                    'name' => 'closedate',
                    'value' => strtotime('+30 days') * 1000 // 30 days from now
                ),
            )
        );

        $response = $this->api_request(
            '/deals/v1/deal',
            'POST',
            $deal_data
        );

        return !is_wp_error($response);
    }

    /**
     * Estimate deal amount based on treatment type
     *
     * @param string $treatment_type Treatment type
     * @return int Estimated amount in USD
     */
    private function estimate_deal_amount($treatment_type) {
        $amounts = array(
            'All-on-4' => 9500,
            'All-on-4 (2 arches)' => 19000,
            'Single Implant' => 1200,
            'Dental Implants' => 2400,
            'Crowns & Bridges' => 800,
            'Dentures' => 1500,
            'Cosmetic Dentistry' => 3000,
            'Veneers' => 4000,
        );

        return isset($amounts[$treatment_type]) ? $amounts[$treatment_type] : 2000;
    }

    /**
     * Track page view in HubSpot
     * Only tracks if user has a tracking cookie
     */
    public function track_page_view() {
        if (!$this->is_configured()) {
            return;
        }

        // Check if HubSpot tracking cookie exists
        if (empty($_COOKIE['hubspotutk'])) {
            return;
        }

        // Add HubSpot tracking code
        ?>
        <!-- HubSpot Page View Tracking -->
        <script type="text/javascript">
        var _hsq = window._hsq = window._hsq || [];
        _hsq.push(['setPath', '<?php echo esc_js($_SERVER['REQUEST_URI']); ?>']);
        _hsq.push(['trackPageView']);
        </script>
        <?php
    }

    /**
     * Make API request to HubSpot
     *
     * @param string $endpoint API endpoint
     * @param string $method HTTP method
     * @param array $data Request data
     * @return array|WP_Error Response or error
     */
    private function api_request($endpoint, $method = 'GET', $data = array()) {
        $url = $this->api_endpoint . $endpoint;

        // Add API key to URL
        $url = add_query_arg('hapikey', $this->api_key, $url);

        $args = array(
            'method' => $method,
            'headers' => array(
                'Content-Type' => 'application/json',
            ),
            'timeout' => 15,
        );

        if (!empty($data)) {
            $args['body'] = wp_json_encode($data);
        }

        $response = wp_remote_request($url, $args);

        if (is_wp_error($response)) {
            return $response;
        }

        $response_code = wp_remote_retrieve_response_code($response);
        $response_body = wp_remote_retrieve_body($response);

        // Check for errors
        if ($response_code >= 400) {
            return new WP_Error(
                'hubspot_api_error',
                'HubSpot API error: ' . $response_code,
                array('response' => $response_body)
            );
        }

        return json_decode($response_body, true);
    }

    /**
     * Get contact by email
     *
     * @param string $email Email address
     * @return array|WP_Error Contact data or error
     */
    public function get_contact_by_email($email) {
        return $this->api_request(
            '/contacts/v1/contact/email/' . urlencode($email) . '/profile'
        );
    }

    /**
     * Add contact to list
     *
     * @param int $contact_id Contact ID
     * @param int $list_id List ID
     * @return bool|WP_Error Success or error
     */
    public function add_contact_to_list($contact_id, $list_id) {
        $response = $this->api_request(
            '/contacts/v1/lists/' . $list_id . '/add',
            'POST',
            array('vids' => array($contact_id))
        );

        return !is_wp_error($response);
    }
}

/**
 * Initialize HubSpot integration
 */
function dental_rubio_init_hubspot() {
    return new Dental_Rubio_HubSpot();
}

// Initialize on plugins_loaded
add_action('plugins_loaded', 'dental_rubio_init_hubspot');

/**
 * AJAX handler for calculator submissions with HubSpot tracking
 */
function dental_rubio_calculator_submit_handler() {
    check_ajax_referer('dental_calculator_nonce', 'nonce');

    $calculator_data = array(
        'email' => isset($_POST['email']) ? sanitize_email($_POST['email']) : '',
        'name' => isset($_POST['name']) ? sanitize_text_field($_POST['name']) : '',
        'calculator_type' => isset($_POST['calculator_type']) ? sanitize_text_field($_POST['calculator_type']) : '',
        'treatment_type' => isset($_POST['treatment_type']) ? sanitize_text_field($_POST['treatment_type']) : '',
        'estimated_cost' => isset($_POST['estimated_cost']) ? floatval($_POST['estimated_cost']) : 0,
        'savings_amount' => isset($_POST['savings_amount']) ? floatval($_POST['savings_amount']) : 0,
    );

    // Trigger HubSpot action
    do_action('dental_rubio_calculator_submit', $calculator_data);

    wp_send_json_success(array(
        'message' => __('Thank you! We\'ll be in touch soon.', 'dental-rubio')
    ));
}
add_action('wp_ajax_dental_calculator_submit', 'dental_rubio_calculator_submit_handler');
add_action('wp_ajax_nopriv_dental_calculator_submit', 'dental_rubio_calculator_submit_handler');
