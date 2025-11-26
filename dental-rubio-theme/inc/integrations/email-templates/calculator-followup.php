<?php
/**
 * Email Template: Calculator Follow-up
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

$name = isset($data['name']) ? $data['name'] : 'there';
$estimated_cost = isset($data['estimated_cost']) ? number_format($data['estimated_cost'], 0) : '0';
$savings_amount = isset($data['savings_amount']) ? number_format($data['savings_amount'], 0) : '0';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Dental Cost Estimate - Dental Rubio Group</title>
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
        .savings-highlight {
            background-color: #f59e0b;
            color: #ffffff;
            padding: 30px;
            text-align: center;
            font-size: 18px;
        }
        .savings-amount {
            font-size: 48px;
            font-weight: bold;
            margin: 10px 0;
        }
        .content {
            padding: 40px 30px;
            color: #374151;
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
            <h1>🦷 Your Dental Savings Estimate</h1>
        </div>

        <div class="savings-highlight">
            <p style="margin: 0 0 10px 0;">You Could Save</p>
            <div class="savings-amount">$<?php echo esc_html($savings_amount); ?></div>
            <p style="margin: 10px 0 0 0;">on Your Dental Treatment</p>
        </div>

        <div class="content">
            <h2>Hi <?php echo esc_html($name); ?>!</h2>

            <p>
                Thank you for using our cost calculator. Based on your selections, we can help you save significantly on high-quality dental care.
            </p>

            <p>
                <strong>Your Estimated Cost at Dental Rubio Group: $<?php echo esc_html($estimated_cost); ?></strong>
            </p>

            <p>
                This includes premium Straumann® implants, the same quality you'd receive in the US or Canada, but at a fraction of the cost.
            </p>

            <div style="text-align: center; margin: 30px 0;">
                <a href="<?php echo esc_url(home_url('/contact/')); ?>" class="cta-button">Schedule Free Consultation</a>
            </div>

            <p>
                <strong>Questions? Call us now:</strong><br>
                📞 <a href="tel:+16192548214" style="color: #1e3a8a; text-decoration: none; font-weight: bold;">(619) 254-8214</a>
            </p>
        </div>

        <div class="footer">
            <p><strong>Dental Rubio Group</strong></p>
            <p>Phone: <a href="tel:+16192548214" style="color: #f59e0b;">(619) 254-8214</a></p>
        </div>
    </div>
</body>
</html>
