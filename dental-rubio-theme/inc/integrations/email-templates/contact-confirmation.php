<?php
/**
 * Email Template: Contact Form Confirmation
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$first_name = isset($data['first_name']) ? $data['first_name'] : 'there';
$treatment_interest = isset($data['treatment_interest']) ? $data['treatment_interest'] : '';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thank You - Dental Rubio Group</title>
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
        .header h1 {
            margin: 0;
            font-size: 28px;
            font-weight: bold;
        }
        .logo {
            font-size: 40px;
            margin-bottom: 10px;
        }
        .content {
            padding: 40px 30px;
            color: #374151;
        }
        .content h2 {
            color: #1e3a8a;
            font-size: 24px;
            margin-top: 0;
        }
        .content p {
            font-size: 16px;
            margin: 15px 0;
        }
        .highlight-box {
            background-color: #fef3c7;
            border-left: 4px solid #f59e0b;
            padding: 20px;
            margin: 25px 0;
        }
        .highlight-box p {
            margin: 0;
            color: #92400e;
            font-size: 15px;
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
        .info-grid {
            display: table;
            width: 100%;
            margin: 30px 0;
        }
        .info-item {
            display: table-row;
        }
        .info-icon {
            display: table-cell;
            font-size: 24px;
            padding: 10px 15px 10px 0;
            vertical-align: top;
        }
        .info-content {
            display: table-cell;
            vertical-align: top;
            padding: 10px 0;
        }
        .info-label {
            font-weight: bold;
            color: #1e3a8a;
            font-size: 14px;
            margin-bottom: 5px;
        }
        .info-value {
            color: #6b7280;
            font-size: 14px;
        }
        .footer {
            background-color: #1f2937;
            color: #d1d5db;
            padding: 30px 20px;
            text-align: center;
            font-size: 14px;
        }
        .footer a {
            color: #f59e0b;
            text-decoration: none;
        }
        .social-links {
            margin: 20px 0;
        }
        .social-links a {
            display: inline-block;
            margin: 0 10px;
            font-size: 24px;
        }
        @media only screen and (max-width: 600px) {
            .content {
                padding: 30px 20px;
            }
            .header h1 {
                font-size: 24px;
            }
        }
    </style>
</head>
<body>
    <div class="email-container">
        <!-- Header -->
        <div class="header">
            <div class="logo">🦷</div>
            <h1>Dental Rubio Group</h1>
            <p style="margin: 10px 0 0 0; font-size: 16px;">Premium Dental Care in Los Algodones, Mexico</p>
        </div>

        <!-- Content -->
        <div class="content">
            <h2>Thank You, <?php echo esc_html($first_name); ?>!</h2>

            <p>
                We've received your message and we're excited to help you achieve the smile you deserve!
            </p>

            <?php if (!empty($treatment_interest)): ?>
                <div class="highlight-box">
                    <p>
                        <strong>Treatment Interest:</strong> <?php echo esc_html($treatment_interest); ?>
                    </p>
                </div>
            <?php endif; ?>

            <p>
                Our friendly patient coordinators will review your inquiry and get back to you within 24 hours (usually much sooner!).
                They'll answer all your questions and help you plan your visit to our state-of-the-art facility in Los Algodones.
            </p>

            <h3 style="color: #1e3a8a; margin-top: 30px;">What Happens Next?</h3>

            <div class="info-grid">
                <div class="info-item">
                    <div class="info-icon">1️⃣</div>
                    <div class="info-content">
                        <div class="info-label">Personal Review</div>
                        <div class="info-value">Our team reviews your inquiry and treatment interests</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">2️⃣</div>
                    <div class="info-content">
                        <div class="info-label">Direct Contact</div>
                        <div class="info-value">We'll call or email you to discuss your needs in detail</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">3️⃣</div>
                    <div class="info-content">
                        <div class="info-label">Free Consultation</div>
                        <div class="info-value">Schedule your complimentary consultation and X-rays</div>
                    </div>
                </div>
                <div class="info-item">
                    <div class="info-icon">4️⃣</div>
                    <div class="info-content">
                        <div class="info-label">Treatment Plan</div>
                        <div class="info-value">Receive a personalized plan with transparent pricing</div>
                    </div>
                </div>
            </div>

            <p>
                <strong>Need to speak with us right away?</strong>
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="tel:+16192548214" class="cta-button">📞 Call Now: (619) 254-8214</a>
            </div>

            <p style="text-align: center; margin: 20px 0;">
                <strong>Or text/call us on WhatsApp:</strong><br>
                <a href="https://wa.me/526531234567" style="color: #25D366; text-decoration: none; font-weight: bold;">💬 WhatsApp: +52 653 123 4567</a>
            </p>

            <div class="highlight-box">
                <p>
                    <strong>💰 Save 50-70% on dental care</strong> compared to US/Canadian prices while receiving world-class treatment from Dr. Rubio's experienced team.
                </p>
            </div>

            <h3 style="color: #1e3a8a; margin-top: 30px;">Why Patients Choose Us</h3>

            <ul style="color: #6b7280; line-height: 1.8;">
                <li><strong>Premium Straumann® Implants</strong> - Swiss-made, 98.8% success rate</li>
                <li><strong>30+ Years Experience</strong> - Dr. Rubio is a trusted name in dental tourism</li>
                <li><strong>All-Inclusive Packages</strong> - No hidden fees, transparent pricing</li>
                <li><strong>English-Speaking Staff</strong> - Clear communication every step</li>
                <li><strong>5-Star Patient Care</strong> - Concierge service from border to clinic</li>
            </ul>

            <p>
                We look forward to welcoming you to Dental Rubio Group!
            </p>

            <p style="margin-top: 30px;">
                <strong>Warm regards,</strong><br>
                The Dental Rubio Group Team<br>
                <em>"Your Smile is Our Mission"</em>
            </p>
        </div>

        <!-- Footer -->
        <div class="footer">
            <p><strong>Dental Rubio Group</strong></p>
            <p>
                Calle 2, Los Algodones, Baja California, Mexico<br>
                Phone: <a href="tel:+16192548214">(619) 254-8214</a><br>
                Website: <a href="<?php echo esc_url(home_url('/')); ?>"><?php echo esc_html(parse_url(home_url('/'), PHP_URL_HOST)); ?></a>
            </p>

            <div class="social-links">
                <a href="#" style="color: #1877f2;">📘</a>
                <a href="#" style="color: #E4405F;">📷</a>
                <a href="#" style="color: #25D366;">💬</a>
            </div>

            <p style="font-size: 12px; color: #9ca3af; margin-top: 20px;">
                You're receiving this email because you contacted Dental Rubio Group.<br>
                If you have questions, please reply to this email or call us directly.
            </p>
        </div>
    </div>
</body>
</html>
