<?php
/**
 * Contact Form Handler
 * Processes contact form submissions and sends emails
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Handle contact form submission
 */
function dental_rubio_handle_contact_form() {
    // Verify nonce
    if (!isset($_POST['contact_nonce']) || !wp_verify_nonce($_POST['contact_nonce'], 'dental_contact_form')) {
        wp_send_json_error(array('message' => 'Security check failed. Please refresh and try again.'));
        return;
    }

    // Sanitize and validate inputs
    $name = sanitize_text_field($_POST['name'] ?? '');
    $phone = sanitize_text_field($_POST['phone'] ?? '');
    $email = sanitize_email($_POST['email'] ?? '');
    $service = sanitize_text_field($_POST['service'] ?? 'Not specified');
    $message = sanitize_textarea_field($_POST['message'] ?? '');
    $page_source = sanitize_text_field($_POST['page_source'] ?? 'Unknown');

    // Validate required fields
    if (empty($name) || empty($phone) || empty($email)) {
        wp_send_json_error(array('message' => 'Please fill in all required fields.'));
        return;
    }

    // Validate email
    if (!is_email($email)) {
        wp_send_json_error(array('message' => 'Please enter a valid email address.'));
        return;
    }

    // Prepare email to admin
    $admin_email = get_option('admin_email');
    $site_name = get_bloginfo('name');

    $admin_subject = sprintf('[%s] New Contact Form Submission from %s', $site_name, $name);

    $admin_message = sprintf(
        "New contact form submission received:\n\n" .
        "Name: %s\n" .
        "Phone: %s\n" .
        "Email: %s\n" .
        "Service Interest: %s\n" .
        "Page Source: %s\n\n" .
        "Message:\n%s\n\n" .
        "---\n" .
        "Submitted on: %s\n" .
        "IP Address: %s",
        $name,
        $phone,
        $email,
        $service,
        $page_source,
        $message ?: '(No additional message)',
        current_time('mysql'),
        $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
    );

    $admin_headers = array(
        'From: ' . $name . ' <' . $email . '>',
        'Reply-To: ' . $email,
        'Content-Type: text/plain; charset=UTF-8'
    );

    // Send email to admin
    $admin_sent = wp_mail($admin_email, $admin_subject, $admin_message, $admin_headers);

    // Prepare auto-response email to user
    $user_subject = sprintf('Thank You for Contacting %s', $site_name);

    $user_message = sprintf(
        "Hi %s,\n\n" .
        "Thank you for reaching out to Dental Rubio Group!\n\n" .
        "We've received your inquiry about %s and will contact you at %s within the next 2 hours during our business hours:\n" .
        "Monday - Friday: 8:00 AM - 5:00 PM (MST)\n" .
        "Saturday: 9:00 AM - 1:00 PM\n\n" .
        "In the meantime, feel free to:\n" .
        "• Browse our price list: %s/pricing/\n" .
        "• Read patient reviews: %s/testimonials/\n" .
        "• Learn about our clinic: %s/about/\n\n" .
        "If you need immediate assistance, please call us at %s or message us on WhatsApp.\n\n" .
        "Best regards,\n" .
        "The Dental Rubio Team\n\n" .
        "---\n" .
        "Dental Rubio Group\n" .
        "40+ Years Serving Snowbirds & Seniors\n" .
        "Los Algodones, Mexico\n" .
        "%s",
        $name,
        $service ?: 'dental services',
        $phone,
        home_url(),
        home_url(),
        home_url(),
        dental_rubio_get_phone(),
        home_url()
    );

    $user_headers = array(
        'From: ' . $site_name . ' <' . $admin_email . '>',
        'Reply-To: ' . $admin_email,
        'Content-Type: text/plain; charset=UTF-8'
    );

    // Send auto-response to user
    $user_sent = wp_mail($email, $user_subject, $user_message, $user_headers);

    // Save to database (optional - for future CRM integration)
    do_action('dental_rubio_contact_form_submitted', array(
        'name' => $name,
        'phone' => $phone,
        'email' => $email,
        'service' => $service,
        'message' => $message,
        'page_source' => $page_source,
        'submitted_at' => current_time('mysql'),
        'ip_address' => $_SERVER['REMOTE_ADDR'] ?? 'Unknown'
    ));

    // Send success response
    if ($admin_sent) {
        wp_send_json_success(array(
            'message' => 'Thank you! We received your request and will call you within 2 hours during business hours.'
        ));
    } else {
        wp_send_json_error(array(
            'message' => 'There was a problem sending your message. Please call us directly at ' . dental_rubio_get_phone()
        ));
    }
}

// Register AJAX handlers (for logged in and non-logged in users)
add_action('wp_ajax_dental_rubio_contact_form', 'dental_rubio_handle_contact_form');
add_action('wp_ajax_nopriv_dental_rubio_contact_form', 'dental_rubio_handle_contact_form');

/**
 * Save contact form submissions to database (optional)
 * This can be used for CRM integration or reporting
 */
function dental_rubio_save_contact_submission($data) {
    global $wpdb;

    // Create table if it doesn't exist
    $table_name = $wpdb->prefix . 'dental_contacts';

    $wpdb->insert(
        $table_name,
        array(
            'name' => $data['name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'service' => $data['service'],
            'message' => $data['message'],
            'page_source' => $data['page_source'],
            'submitted_at' => $data['submitted_at'],
            'ip_address' => $data['ip_address']
        ),
        array('%s', '%s', '%s', '%s', '%s', '%s', '%s', '%s')
    );
}
// Uncomment to enable database storage:
// add_action('dental_rubio_contact_form_submitted', 'dental_rubio_save_contact_submission');

/**
 * Create contacts table on theme activation
 */
function dental_rubio_create_contacts_table() {
    global $wpdb;

    $table_name = $wpdb->prefix . 'dental_contacts';
    $charset_collate = $wpdb->get_charset_collate();

    $sql = "CREATE TABLE IF NOT EXISTS $table_name (
        id bigint(20) NOT NULL AUTO_INCREMENT,
        name varchar(255) NOT NULL,
        phone varchar(50) NOT NULL,
        email varchar(255) NOT NULL,
        service varchar(255) DEFAULT NULL,
        message text DEFAULT NULL,
        page_source varchar(255) DEFAULT NULL,
        submitted_at datetime NOT NULL,
        ip_address varchar(100) DEFAULT NULL,
        PRIMARY KEY  (id),
        KEY email (email),
        KEY submitted_at (submitted_at)
    ) $charset_collate;";

    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}
// Uncomment to create table on theme activation:
// add_action('after_switch_theme', 'dental_rubio_create_contacts_table');
