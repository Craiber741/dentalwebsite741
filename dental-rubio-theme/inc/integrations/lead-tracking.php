<?php
/**
 * Lead Tracking System
 *
 * Tracks visitor behavior, UTM parameters, and lead sources.
 * Stores lead data and interactions for reporting and analysis.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Lead Tracking Handler
 */
class Dental_Rubio_Lead_Tracking {

    /**
     * Cookie expiration (30 days)
     */
    const COOKIE_EXPIRATION = 2592000;

    /**
     * Constructor
     */
    public function __construct() {
        // Track UTM parameters
        add_action('init', array($this, 'track_utm_parameters'));

        // Track page views
        add_action('wp_footer', array($this, 'track_page_view'), 10);

        // Track form submissions
        add_action('dental_rubio_contact_form_submit', array($this, 'create_lead'), 10, 1);
        add_action('dental_rubio_calculator_submit', array($this, 'track_calculator_interaction'), 10, 1);

        // Register custom post type for leads
        add_action('init', array($this, 'register_lead_post_type'));

        // Add meta boxes
        add_action('add_meta_boxes', array($this, 'add_lead_meta_boxes'));
    }

    /**
     * Track UTM parameters from query string
     */
    public function track_utm_parameters() {
        $utm_params = array('utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content');

        foreach ($utm_params as $param) {
            if (isset($_GET[$param]) && !empty($_GET[$param])) {
                $value = sanitize_text_field($_GET[$param]);
                setcookie(
                    'dental_rubio_' . $param,
                    $value,
                    time() + self::COOKIE_EXPIRATION,
                    '/',
                    '',
                    is_ssl(),
                    true
                );
            }
        }

        // Track referrer
        if (!empty($_SERVER['HTTP_REFERER']) && empty($_COOKIE['dental_rubio_referrer'])) {
            $referrer = esc_url_raw($_SERVER['HTTP_REFERER']);
            setcookie(
                'dental_rubio_referrer',
                $referrer,
                time() + self::COOKIE_EXPIRATION,
                '/',
                '',
                is_ssl(),
                true
            );
        }

        // Track landing page
        if (empty($_COOKIE['dental_rubio_landing_page'])) {
            $landing_page = esc_url_raw($_SERVER['REQUEST_URI']);
            setcookie(
                'dental_rubio_landing_page',
                $landing_page,
                time() + self::COOKIE_EXPIRATION,
                '/',
                '',
                is_ssl(),
                true
            );
        }

        // Generate or retrieve visitor ID
        if (empty($_COOKIE['dental_rubio_visitor_id'])) {
            $visitor_id = uniqid('visitor_', true);
            setcookie(
                'dental_rubio_visitor_id',
                $visitor_id,
                time() + self::COOKIE_EXPIRATION,
                '/',
                '',
                is_ssl(),
                true
            );
        }
    }

    /**
     * Track page view
     */
    public function track_page_view() {
        if (is_admin() || is_robots() || is_feed()) {
            return;
        }

        // Only track if visitor ID exists
        if (empty($_COOKIE['dental_rubio_visitor_id'])) {
            return;
        }

        $visitor_id = sanitize_text_field($_COOKIE['dental_rubio_visitor_id']);

        // Get or create visitor tracking record
        $visitor_data = get_transient('dental_rubio_visitor_' . $visitor_id);

        if (!$visitor_data) {
            $visitor_data = array(
                'first_visit' => current_time('mysql'),
                'page_views' => 0,
                'pages_visited' => array(),
            );
        }

        $visitor_data['page_views']++;
        $visitor_data['last_visit'] = current_time('mysql');
        $visitor_data['pages_visited'][] = array(
            'url' => esc_url_raw($_SERVER['REQUEST_URI']),
            'title' => wp_get_document_title(),
            'timestamp' => current_time('mysql'),
        );

        // Store for 30 days
        set_transient('dental_rubio_visitor_' . $visitor_id, $visitor_data, self::COOKIE_EXPIRATION);
    }

    /**
     * Create lead from form submission
     *
     * @param array $form_data Form submission data
     * @return int|WP_Error Lead post ID or error
     */
    public function create_lead($form_data) {
        // Prepare lead data
        $lead_title = sprintf(
            '%s %s - %s',
            isset($form_data['first_name']) ? $form_data['first_name'] : '',
            isset($form_data['last_name']) ? $form_data['last_name'] : '',
            isset($form_data['email']) ? $form_data['email'] : 'No Email'
        );

        // Create lead post
        $lead_id = wp_insert_post(array(
            'post_type' => 'dental_lead',
            'post_title' => sanitize_text_field($lead_title),
            'post_status' => 'publish',
            'post_content' => isset($form_data['message']) ? sanitize_textarea_field($form_data['message']) : '',
        ));

        if (is_wp_error($lead_id)) {
            return $lead_id;
        }

        // Store form data as meta
        $meta_fields = array(
            'first_name' => isset($form_data['first_name']) ? sanitize_text_field($form_data['first_name']) : '',
            'last_name' => isset($form_data['last_name']) ? sanitize_text_field($form_data['last_name']) : '',
            'email' => isset($form_data['email']) ? sanitize_email($form_data['email']) : '',
            'phone' => isset($form_data['phone']) ? sanitize_text_field($form_data['phone']) : '',
            'treatment_interest' => isset($form_data['treatment_interest']) ? sanitize_text_field($form_data['treatment_interest']) : '',
            'preferred_date' => isset($form_data['preferred_date']) ? sanitize_text_field($form_data['preferred_date']) : '',
            'preferred_time' => isset($form_data['preferred_time']) ? sanitize_text_field($form_data['preferred_time']) : '',
            'hear_about_us' => isset($form_data['hear_about_us']) ? sanitize_text_field($form_data['hear_about_us']) : '',
        );

        foreach ($meta_fields as $key => $value) {
            if (!empty($value)) {
                update_post_meta($lead_id, '_lead_' . $key, $value);
            }
        }

        // Store UTM parameters
        $this->store_lead_source($lead_id);

        // Store visitor tracking data
        if (!empty($_COOKIE['dental_rubio_visitor_id'])) {
            $visitor_id = sanitize_text_field($_COOKIE['dental_rubio_visitor_id']);
            $visitor_data = get_transient('dental_rubio_visitor_' . $visitor_id);

            if ($visitor_data) {
                update_post_meta($lead_id, '_lead_visitor_data', $visitor_data);
            }
        }

        // Set lead status
        update_post_meta($lead_id, '_lead_status', 'new');
        update_post_meta($lead_id, '_lead_score', $this->calculate_lead_score($form_data));

        return $lead_id;
    }

    /**
     * Store lead source and UTM parameters
     *
     * @param int $lead_id Lead post ID
     */
    private function store_lead_source($lead_id) {
        $source_data = array(
            'utm_source' => isset($_COOKIE['dental_rubio_utm_source']) ? sanitize_text_field($_COOKIE['dental_rubio_utm_source']) : '',
            'utm_medium' => isset($_COOKIE['dental_rubio_utm_medium']) ? sanitize_text_field($_COOKIE['dental_rubio_utm_medium']) : '',
            'utm_campaign' => isset($_COOKIE['dental_rubio_utm_campaign']) ? sanitize_text_field($_COOKIE['dental_rubio_utm_campaign']) : '',
            'utm_term' => isset($_COOKIE['dental_rubio_utm_term']) ? sanitize_text_field($_COOKIE['dental_rubio_utm_term']) : '',
            'utm_content' => isset($_COOKIE['dental_rubio_utm_content']) ? sanitize_text_field($_COOKIE['dental_rubio_utm_content']) : '',
            'referrer' => isset($_COOKIE['dental_rubio_referrer']) ? esc_url_raw($_COOKIE['dental_rubio_referrer']) : '',
            'landing_page' => isset($_COOKIE['dental_rubio_landing_page']) ? esc_url_raw($_COOKIE['dental_rubio_landing_page']) : '',
        );

        foreach ($source_data as $key => $value) {
            if (!empty($value)) {
                update_post_meta($lead_id, '_lead_' . $key, $value);
            }
        }
    }

    /**
     * Calculate lead score based on engagement
     *
     * @param array $form_data Form data
     * @return int Lead score (0-100)
     */
    private function calculate_lead_score($form_data) {
        $score = 0;

        // Has phone number (+20)
        if (!empty($form_data['phone'])) {
            $score += 20;
        }

        // Has treatment interest (+30)
        if (!empty($form_data['treatment_interest'])) {
            $score += 30;
        }

        // Has preferred date (+25)
        if (!empty($form_data['preferred_date'])) {
            $score += 25;
        }

        // Has detailed message (+15)
        if (!empty($form_data['message']) && strlen($form_data['message']) > 50) {
            $score += 15;
        }

        // High-value treatments (+10)
        if (!empty($form_data['treatment_interest'])) {
            $high_value = array('All-on-4', 'Dental Implants', 'All-on-6');
            if (in_array($form_data['treatment_interest'], $high_value)) {
                $score += 10;
            }
        }

        return min($score, 100);
    }

    /**
     * Track calculator interaction
     *
     * @param array $calculator_data Calculator data
     */
    public function track_calculator_interaction($calculator_data) {
        // Create interaction log
        $log_data = array(
            'type' => 'calculator',
            'calculator_type' => isset($calculator_data['calculator_type']) ? $calculator_data['calculator_type'] : '',
            'data' => $calculator_data,
            'timestamp' => current_time('mysql'),
        );

        // If email provided, try to link to existing lead or create new one
        if (!empty($calculator_data['email'])) {
            $existing_lead = $this->find_lead_by_email($calculator_data['email']);

            if ($existing_lead) {
                // Add to existing lead
                $interactions = get_post_meta($existing_lead, '_lead_interactions', true);
                if (!is_array($interactions)) {
                    $interactions = array();
                }
                $interactions[] = $log_data;
                update_post_meta($existing_lead, '_lead_interactions', $interactions);

                // Increase lead score
                $current_score = get_post_meta($existing_lead, '_lead_score', true);
                update_post_meta($existing_lead, '_lead_score', intval($current_score) + 15);
            }
        }
    }

    /**
     * Find lead by email
     *
     * @param string $email Email address
     * @return int|false Lead ID or false
     */
    private function find_lead_by_email($email) {
        $args = array(
            'post_type' => 'dental_lead',
            'meta_query' => array(
                array(
                    'key' => '_lead_email',
                    'value' => sanitize_email($email),
                    'compare' => '='
                )
            ),
            'posts_per_page' => 1,
        );

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            return $query->posts[0]->ID;
        }

        return false;
    }

    /**
     * Register lead custom post type
     */
    public function register_lead_post_type() {
        register_post_type('dental_lead', array(
            'labels' => array(
                'name' => __('Leads', 'dental-rubio'),
                'singular_name' => __('Lead', 'dental-rubio'),
                'add_new' => __('Add New Lead', 'dental-rubio'),
                'add_new_item' => __('Add New Lead', 'dental-rubio'),
                'edit_item' => __('Edit Lead', 'dental-rubio'),
                'view_item' => __('View Lead', 'dental-rubio'),
                'search_items' => __('Search Leads', 'dental-rubio'),
            ),
            'public' => false,
            'show_ui' => true,
            'show_in_menu' => true,
            'menu_icon' => 'dashicons-groups',
            'capability_type' => 'post',
            'supports' => array('title', 'editor'),
            'has_archive' => false,
            'rewrite' => false,
        ));
    }

    /**
     * Add lead meta boxes
     */
    public function add_lead_meta_boxes() {
        add_meta_box(
            'dental_lead_info',
            __('Lead Information', 'dental-rubio'),
            array($this, 'render_lead_info_meta_box'),
            'dental_lead',
            'normal',
            'high'
        );

        add_meta_box(
            'dental_lead_source',
            __('Lead Source', 'dental-rubio'),
            array($this, 'render_lead_source_meta_box'),
            'dental_lead',
            'side',
            'default'
        );
    }

    /**
     * Render lead info meta box
     *
     * @param WP_Post $post Current post
     */
    public function render_lead_info_meta_box($post) {
        $first_name = get_post_meta($post->ID, '_lead_first_name', true);
        $last_name = get_post_meta($post->ID, '_lead_last_name', true);
        $email = get_post_meta($post->ID, '_lead_email', true);
        $phone = get_post_meta($post->ID, '_lead_phone', true);
        $treatment_interest = get_post_meta($post->ID, '_lead_treatment_interest', true);
        $lead_score = get_post_meta($post->ID, '_lead_score', true);
        $lead_status = get_post_meta($post->ID, '_lead_status', true);

        ?>
        <table class="form-table">
            <tr>
                <th><strong><?php _e('Name:', 'dental-rubio'); ?></strong></th>
                <td><?php echo esc_html($first_name . ' ' . $last_name); ?></td>
            </tr>
            <tr>
                <th><strong><?php _e('Email:', 'dental-rubio'); ?></strong></th>
                <td><a href="mailto:<?php echo esc_attr($email); ?>"><?php echo esc_html($email); ?></a></td>
            </tr>
            <tr>
                <th><strong><?php _e('Phone:', 'dental-rubio'); ?></strong></th>
                <td><a href="tel:<?php echo esc_attr($phone); ?>"><?php echo esc_html($phone); ?></a></td>
            </tr>
            <tr>
                <th><strong><?php _e('Treatment Interest:', 'dental-rubio'); ?></strong></th>
                <td><?php echo esc_html($treatment_interest); ?></td>
            </tr>
            <tr>
                <th><strong><?php _e('Lead Score:', 'dental-rubio'); ?></strong></th>
                <td><strong style="font-size: 18px; color: <?php echo $lead_score >= 70 ? '#10b981' : ($lead_score >= 40 ? '#f59e0b' : '#ef4444'); ?>"><?php echo esc_html($lead_score); ?>/100</strong></td>
            </tr>
            <tr>
                <th><strong><?php _e('Status:', 'dental-rubio'); ?></strong></th>
                <td><?php echo esc_html(ucfirst($lead_status)); ?></td>
            </tr>
        </table>
        <?php
    }

    /**
     * Render lead source meta box
     *
     * @param WP_Post $post Current post
     */
    public function render_lead_source_meta_box($post) {
        $utm_source = get_post_meta($post->ID, '_lead_utm_source', true);
        $utm_campaign = get_post_meta($post->ID, '_lead_utm_campaign', true);
        $landing_page = get_post_meta($post->ID, '_lead_landing_page', true);

        ?>
        <p>
            <strong><?php _e('Source:', 'dental-rubio'); ?></strong><br>
            <?php echo $utm_source ? esc_html($utm_source) : __('Direct/Unknown', 'dental-rubio'); ?>
        </p>
        <?php if ($utm_campaign): ?>
            <p>
                <strong><?php _e('Campaign:', 'dental-rubio'); ?></strong><br>
                <?php echo esc_html($utm_campaign); ?>
            </p>
        <?php endif; ?>
        <?php if ($landing_page): ?>
            <p>
                <strong><?php _e('Landing Page:', 'dental-rubio'); ?></strong><br>
                <a href="<?php echo esc_url($landing_page); ?>" target="_blank"><?php echo esc_html($landing_page); ?></a>
            </p>
        <?php endif; ?>
        <?php
    }
}

/**
 * Initialize lead tracking
 */
function dental_rubio_init_lead_tracking() {
    return new Dental_Rubio_Lead_Tracking();
}

// Initialize on plugins_loaded
add_action('plugins_loaded', 'dental_rubio_init_lead_tracking');
