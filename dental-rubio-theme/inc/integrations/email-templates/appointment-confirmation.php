<?php
/**
 * Email Template: Appointment Confirmation
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$first_name = isset($data['first_name']) ? $data['first_name'] : 'there';
$preferred_date = isset($data['preferred_date']) ? $data['preferred_date'] : 'your preferred date';
$preferred_time = isset($data['preferred_time']) ? $data['preferred_time'] : '';
$treatment = isset($data['treatment']) ? $data['treatment'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Appointment Request Received - Dental Rubio Group</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            background-color: #f3f4f6;
            line-height: 1.6;
        }
        .email-container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
        }
        .header {
            background: linear-gradient(135deg, #1e3a8a 0%, #1e3a8a 100%);
            color: #ffffff;
            padding: 40px 20px;
            text-align: center;
        }
        .urgent-notice {
            background-color: #10b981;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            font-size: 18px;
            font-weight: bold;
        }
        .content {
            padding: 40px 30px;
            color: #374151;
        }
        .appointment-details {
            background-color: #eff6ff;
            border: 2px solid #3b82f6;
            border-radius: 8px;
            padding: 20px;
            margin: 25px 0;
        }
        .cta-button {
            display: inline-block;
            background-color: #f59e0b;
            color: #ffffff;
            text-decoration: none;
            padding: 15px 30px;
            border-radius: 8px;
            font-weight: bold;
            font-size: 16px;
            margin: 20px 0;
        }
        .footer {
            background-color: #1f2937;
            color: #d1d5db;
            padding: 30px 20px;
            text-align: center;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="email-container">
        <div class="header">
            <h1>✅ Appointment Request Received</h1>
        </div>

        <div class="urgent-notice">
            📅 We're reviewing your request now!
        </div>

        <div class="content">
            <h2>Hi <?php echo esc_html($first_name); ?>!</h2>

            <p>
                Great news! We've received your appointment request and our patient coordinators are reviewing it right now.
            </p>

            <div class="appointment-details">
                <h3 style="color: #1e3a8a; margin-top: 0;">Your Request Details</h3>
                <p><strong>Preferred Date:</strong> <?php echo esc_html($preferred_date); ?></p>
                <?php if (!empty($preferred_time)): ?>
                    <p><strong>Preferred Time:</strong> <?php echo esc_html($preferred_time); ?></p>
                <?php endif; ?>
                <?php if (!empty($treatment)): ?>
                    <p><strong>Treatment:</strong> <?php echo esc_html($treatment); ?></p>
                <?php endif; ?>
            </div>

            <p>
                <strong>⏱️ What happens next?</strong>
            </p>

            <ul>
                <li>We'll confirm availability within the next few hours</li>
                <li>You'll receive a confirmation call or email</li>
                <li>We'll send you pre-appointment information and directions</li>
            </ul>

            <p>
                <strong>Need to make changes or have questions?</strong>
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="tel:+16192548214" class="cta-button">📞 Call Us: (619) 254-8214</a>
            </div>

            <p style="text-align: center;">
                <strong>WhatsApp:</strong> <a href="https://wa.me/526531234567" style="color: #25D366;">💬 Message Us</a>
            </p>

            <p>
                We're excited to meet you and help you achieve your best smile!
            </p>

            <p style="margin-top: 30px;">
                <strong>Best regards,</strong><br>
                The Dental Rubio Group Team
            </p>
        </div>

        <div class="footer">
            <p><strong>Dental Rubio Group</strong></p>
            <p>
                Calle 2, Los Algodones, Baja California, Mexico<br>
                Phone: <a href="tel:+16192548214" style="color: #f59e0b;">(619) 254-8214</a>
            </p>
        </div>
    </div>
</body>
</html>
