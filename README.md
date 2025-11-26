# Dental Rubio Group - WordPress Theme

![Version](https://img.shields.io/badge/version-1.0.0-blue.svg)
![WordPress](https://img.shields.io/badge/WordPress-6.0%2B-blue.svg)
![PHP](https://img.shields.io/badge/PHP-8.0%2B-purple.svg)
![License](https://img.shields.io/badge/license-Proprietary-red.svg)

Senior-friendly WordPress theme designed for dental tourism clinics targeting snowbirds aged 55-80 from USA and Canada. Built for Dental Rubio Group in Los Algodones, Mexico.

---

## 📋 Table of Contents

- [Features](#features)
- [Requirements](#requirements)
- [Installation](#installation)
- [Theme Structure](#theme-structure)
- [Configuration](#configuration)
- [Templates](#templates)
- [Calculators](#calculators)
- [CRM Integrations](#crm-integrations)
- [Customization](#customization)
- [Performance](#performance)
- [SEO & Accessibility](#seo--accessibility)
- [Troubleshooting](#troubleshooting)
- [Support](#support)

---

## ✨ Features

### Senior-Friendly Design
- **18px+** base font size for readability
- **44px+** touch targets for easy clicking
- **High contrast** colors (WCAG 2.1 AA compliant)
- **Clear, simple navigation** with minimal clutter
- **Large, prominent CTAs** (Call, WhatsApp, Contact)

### Page Templates
- **Homepage** - Full-featured landing page
- **Service Pages** - Individual treatment pages
- **Hub Pages** - Content organization centers
- **Contact Page** - With form, map, and FAQs
- **Full-Width** - Landing pages without sidebar
- **Calculator Pages** - Interactive cost calculators

### Advanced Calculators
- **All-on-4 Calculator** - Complete cost with travel expenses
- **ROI Calculator** - 15-year cost comparison analysis
- **Straumann Comparison** - Quality vs. budget implants

### CRM & Marketing Automation
- **HubSpot Integration** - Contact/deal creation, tracking
- **Zapier Webhooks** - 4+ automation triggers
- **Email Automation** - Welcome series, follow-ups
- **Lead Tracking** - UTM parameters, scoring, analytics

### Performance Optimized
- **Tailwind CSS** - Utility-first, purged for production
- **Vanilla JavaScript** - No jQuery dependency
- **Lazy Loading** - Images and iframes
- **Critical CSS** - Inline above-the-fold styles
- **Deferred Scripts** - Non-blocking JavaScript

### SEO & Tracking
- **Schema Markup** - LocalBusiness, MedicalBusiness
- **Google Tag Manager** - Event tracking
- **Facebook Pixel** - Conversion tracking
- **Structured Data** - Rich snippets ready
- **XML Sitemap** - SEO plugin compatible

---

## 💻 Requirements

### Server Requirements
- **PHP**: 8.0+ (7.4 minimum)
- **WordPress**: 6.0+
- **MySQL**: 5.7+ or MariaDB 10.3+
- **Memory**: 256MB+ recommended
- **HTTPS**: SSL certificate required

### Recommended Hosting
- **WP Engine** (Premium)
- **SiteGround** (Good balance)
- **Cloudways** (Managed cloud)
- **Kinsta** (High performance)

### Required Plugins
- **SEO**: Yoast SEO or Rank Math
- **Cache**: WP Rocket (premium) or W3 Total Cache
- **Security**: Wordfence or Sucuri
- **Backups**: UpdraftPlus
- **Forms**: Contact Form 7 or WPForms

### Optional Plugins
- **Image Optimization**: ShortPixel or Imagify
- **Object Cache**: Redis Object Cache
- **Database**: WP-Optimize
- **Analytics**: MonsterInsights (if not using GTM)

---

## 🚀 Installation

### 1. Upload Theme

**Via WordPress Admin:**
```
Appearance → Themes → Add New → Upload Theme
Choose dental-rubio-theme.zip → Install Now → Activate
```

**Via FTP:**
```bash
# Upload to wp-content/themes/
cd wp-content/themes/
unzip dental-rubio-theme.zip
```

**Via WP-CLI:**
```bash
wp theme install dental-rubio-theme.zip --activate
```

### 2. Install Dependencies

The theme uses Tailwind CSS which requires Node.js for development:

```bash
cd wp-content/themes/dental-rubio-theme
npm install
```

### 3. Build Assets

**Development:**
```bash
npm run dev
# Watches for file changes, builds unminified CSS
```

**Production:**
```bash
npm run build
# Builds optimized, purged, minified CSS
```

### 4. Configure Theme

Go to **Appearance → Customize**:
- Upload logo
- Set colors (if customizable)
- Configure contact information
- Set up navigation menus

### 5. Install Required Plugins

```bash
# Via WP-CLI
wp plugin install yoast-seo wp-rocket wordfence updraftplus --activate
```

Or manually through **Plugins → Add New**

---

## 📁 Theme Structure

```
dental-rubio-theme/
├── assets/
│   ├── css/
│   │   └── main.css               # Compiled Tailwind CSS
│   ├── js/
│   │   └── navigation.js          # Menu toggle, smooth scroll
│   └── images/                    # Theme images
├── inc/
│   ├── integrations/
│   │   ├── hubspot-integration.php
│   │   ├── zapier-webhooks.php
│   │   ├── email-automation.php
│   │   ├── lead-tracking.php
│   │   ├── crm-settings.php
│   │   ├── whatsapp-widget.php
│   │   ├── contact-handler.php
│   │   └── email-templates/       # Email HTML templates
│   ├── tracking/
│   │   ├── google-tag-manager.php
│   │   └── facebook-pixel.php
│   ├── seo/
│   │   ├── schema-markup.php
│   │   └── seo-optimization.php
│   ├── theme-setup.php            # Theme configuration
│   ├── enqueue-scripts.php        # CSS/JS loading
│   ├── performance-optimizations.php
│   ├── design-system.php          # Helper functions
│   ├── service-meta.php           # Service page fields
│   ├── hub-functions.php          # Hub page helpers
│   ├── calculator-functions.php   # Pricing database
│   └── accessibility.php          # WCAG compliance
├── page-templates/
│   ├── template-service.php       # Service page layout
│   ├── template-hub.php           # Content hub layout
│   ├── template-contact.php       # Contact page
│   └── template-full-width.php    # Landing pages
├── template-parts/
│   ├── home/                      # Homepage sections
│   ├── service/                   # Service page components
│   ├── hub/                       # Hub page sections
│   └── calculators/               # Calculator components
├── 404.php                        # 404 error page
├── archive.php                    # Blog/category archives
├── footer.php                     # Site footer
├── front-page.php                 # Homepage template
├── functions.php                  # Main functions file
├── header.php                     # Site header
├── index.php                      # Blog index
├── page.php                       # Default page template
├── search.php                     # Search results
├── single.php                     # Single post template
├── style.css                      # Theme info (not used for styling)
├── tailwind.config.js             # Tailwind configuration
├── package.json                   # Node dependencies
└── screenshot.png                 # Theme screenshot
```

---

## ⚙️ Configuration

### Theme Customizer

**Appearance → Customize**

1. **Site Identity**
   - Upload logo (recommended: SVG or PNG, max 300px wide)
   - Add favicon (32x32px)
   - Set site title and tagline

2. **Colors** (if enabled)
   - Primary color: Navy (#1e3a8a)
   - Secondary color: Gold (#f59e0b)
   - Accent colors

3. **Menus**
   - Primary Menu: Top navigation
   - Footer Menu: Footer links
   - Mobile Menu: Mobile navigation

4. **Widgets**
   - Footer Widget Area 1
   - Footer Widget Area 2
   - Blog Sidebar

### Contact Information

**Edit these in Customizer or use a plugin like WP Contact Info Manager:**

```php
// Or add to functions.php
function dental_rubio_get_phone() {
    return '(619) 254-8214';
}

function dental_rubio_get_whatsapp() {
    return '526531234567'; // Format: country code + number (no spaces)
}
```

### wp-config.php Settings

**Security Keys:**
```php
// Generate at: https://api.wordpress.org/secret-key/1.1/salt/
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
// ... etc
```

**CRM API Keys (Recommended - more secure than storing in database):**
```php
define('HUBSPOT_API_KEY', 'your-api-key-here');
define('HUBSPOT_PORTAL_ID', 'your-portal-id');
define('ZAPIER_WEBHOOK_CONTACT', 'https://hooks.zapier.com/...');
define('ZAPIER_WEBHOOK_CALCULATOR', 'https://hooks.zapier.com/...');
define('ZAPIER_WEBHOOK_APPOINTMENT', 'https://hooks.zapier.com/...');
```

**Performance:**
```php
define('WP_POST_REVISIONS', 5);
define('AUTOSAVE_INTERVAL', 300);
define('WP_MEMORY_LIMIT', '256M');
define('WP_MAX_MEMORY_LIMIT', '512M');
```

**Production:**
```php
define('WP_ENV', 'production');
define('WP_DEBUG', false);
define('WP_DEBUG_LOG', false);
define('WP_DEBUG_DISPLAY', false);
define('DISALLOW_FILE_EDIT', true);
```

---

## 📄 Templates

### Page Templates

**Service Template** (`template-service.php`)
- Use for: Individual service pages (All-on-4, Dental Implants, etc.)
- Features: Hero, benefits, process, FAQ, pricing, before/after, testimonials
- Meta fields: Procedure price, duration, recovery time, success rate

**Hub Template** (`template-hub.php`)
- Use for: Resource centers, topic hubs
- Features: Articles grid, sidebar, TOC, CTA sections
- Meta fields: Subtitle, articles source, grid title, CTA settings

**Contact Template** (`template-contact.php`)
- Use for: Contact page
- Features: Contact form, Google Maps, quick contact cards, FAQs
- Includes: Directions, hours, multiple contact methods

**Full-Width Template** (`template-full-width.php`)
- Use for: Landing pages, promotional pages
- Features: No sidebar, full-width content, custom CTA section
- Meta fields: CTA headline, button text, button URL

### Homepage

**Front Page** (`front-page.php`)

Automatically used when you set a static homepage. Includes sections:
- Hero with large CTA
- Trust signals bar
- Calculator preview
- Services grid
- Why Seniors Trust Us
- Testimonials
- Safety information
- Final CTA

### Blog Templates

- `index.php` - Main blog page
- `single.php` - Individual blog post
- `archive.php` - Category/tag archives
- `search.php` - Search results

---

## 🧮 Calculators

### All-on-4 Calculator

**File:** `template-parts/calculators/all-on-4-calculator.php`

**Features:**
- 1 or 2 arches selection
- US/Canada region comparison
- Trip cost calculator (hotel, meals, transportation)
- Financing calculator (6, 12, 18, 24 months)
- PDF download option
- Email results

**Usage:**
```php
// In page content or template
get_template_part('template-parts/calculators/all-on-4-calculator');

// Or use shortcode
[dental_calculator type="all-on-4"]
```

### ROI Calculator

**File:** `template-parts/calculators/roi-calculator.php`

**Features:**
- 15-year cost analysis
- Multiple treatment options
- Replacement cycle calculation
- Maintenance cost estimation
- Total cost of ownership
- Savings breakdown

**Treatments Supported:**
- Dental Implants vs. Bridge
- Dental Implants vs. Dentures
- All-on-4 vs. Traditional Dentures

### Straumann Comparison

**File:** `template-parts/calculators/straumann-comparison.php`

**Features:**
- Straumann (premium) vs. Budget implants
- Success rate comparison (98.8% vs. 85-90%)
- Lifespan analysis (25+ years vs. 8-12 years)
- Long-term cost calculation
- Quality comparison table
- Why we only use Straumann

### Calculator Functions

**File:** `inc/calculator-functions.php`

**Key Functions:**
```php
// Get procedure pricing
dental_rubio_get_procedure_pricing($procedure, $location);

// Calculate savings
dental_rubio_calculate_savings_percent($usa_price, $mexico_price);

// Trip cost estimation
dental_rubio_calculate_trip_cost($origin, $nights, $travelers, $hotel_type);

// Monthly payment
dental_rubio_calculate_monthly_payment($principal, $months, $interest_rate);

// Format currency
dental_rubio_format_currency($amount, $show_cents = true);

// Treatment lifespan
dental_rubio_get_treatment_lifespan($treatment);

// Total cost of ownership
dental_rubio_calculate_total_cost_of_ownership($treatment, $years, $initial_cost);
```

---

## 🔗 CRM Integrations

### HubSpot

**Setup:**
1. Get API key from HubSpot Settings → Integrations → API Key
2. Get Portal ID from HubSpot URL: app.hubspot.com/contacts/[PORTAL_ID]
3. Add to wp-config.php or CRM Settings page
4. Enable in **CRM Settings → Enable Integrations**

**Features:**
- Creates/updates contacts automatically
- Creates deals for high-value treatments
- Tracks page views
- Captures UTM parameters
- Updates contact properties
- Assigns to pipeline stages

**Triggered By:**
- Contact form submissions
- Calculator interactions (if email provided)
- Appointment requests

**Test:**
```php
// Submit a contact form and check HubSpot Contacts
// Look for new contact with form data
```

### Zapier Webhooks

**Setup:**
1. Create Zap in Zapier with "Webhooks by Zapier" trigger
2. Choose "Catch Hook"
3. Copy webhook URL
4. Add to **CRM Settings → Zapier Webhook URLs**
5. Enable in **CRM Settings**

**Available Webhooks:**
- Contact Form (`dental_rubio_contact_form_submit`)
- Calculator (`dental_rubio_calculator_submit`)
- Appointment (`dental_rubio_appointment_request`)
- Newsletter (`dental_rubio_newsletter_signup`)

**Payload Includes:**
- All form data
- UTM parameters
- Visitor info (IP, user agent, language)
- Source URL
- Timestamp

**Test Webhook:**
```bash
# Via REST API
curl -X POST https://yoursite.com/wp-json/dental-rubio/v1/test-webhook/contact_form \
  -H "Authorization: Bearer YOUR_TOKEN"
```

### Email Automation

**Setup:**
1. Configure SMTP (recommended: SendGrid, Mailgun, Amazon SES)
2. Set **From Email** in CRM Settings
3. Set **From Name** in CRM Settings
4. Set **Notification Email** for staff alerts
5. Enable in **CRM Settings**

**Automated Emails:**
- Contact form confirmation (immediate)
- Follow-up (2 days later)
- Calculator results (immediate)
- Calculator follow-up (3 days later)
- Appointment confirmation (immediate)

**Email Templates:**
- `inc/integrations/email-templates/contact-confirmation.php`
- `inc/integrations/email-templates/calculator-followup.php`
- `inc/integrations/email-templates/appointment-confirmation.php`

**Customize Templates:**
```php
// Edit template files directly
// They use PHP variables: $data['first_name'], etc.
// Full HTML with inline CSS for email compatibility
```

### Lead Tracking

**Setup:**
Automatically enabled when Lead Tracking is turned on in CRM Settings.

**Features:**
- Visitor ID generation (30-day cookie)
- UTM parameter capture
- Landing page tracking
- Page view tracking
- Lead scoring (0-100)
- Custom post type: `dental_lead`

**Lead Score Calculation:**
- Has phone number: +20 points
- Has treatment interest: +30 points
- Has preferred date: +25 points
- Detailed message (50+ chars): +15 points
- High-value treatment (All-on-4, Implants): +10 points

**View Leads:**
WordPress Admin → Leads

**Lead Meta:**
- Contact information
- Treatment interest
- UTM source/campaign/medium
- Referrer
- Landing page
- Visitor history
- Lead score

---

## 🎨 Customization

### Colors

**Tailwind Config** (`tailwind.config.js`):
```javascript
module.exports = {
  theme: {
    extend: {
      colors: {
        navy: {
          DEFAULT: '#1e3a8a',
          dark: '#1e40af',
          light: '#3b82f6',
        },
        gold: {
          DEFAULT: '#f59e0b',
          dark: '#d97706',
          light: '#fbbf24',
        },
      },
    },
  },
}
```

After changing, rebuild CSS:
```bash
npm run build
```

### Fonts

**Current:** System font stack for performance

**To Change to Google Fonts:**

1. Add to `inc/enqueue-scripts.php`:
```php
wp_enqueue_style('google-fonts', 'https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');
```

2. Update Tailwind config:
```javascript
fontFamily: {
  sans: ['Inter', 'system-ui', 'sans-serif'],
}
```

3. Rebuild CSS

### Logo

**Upload in Customizer:**
Appearance → Customize → Site Identity → Logo

**Recommended:**
- Format: SVG (scalable) or PNG (transparent)
- Dimensions: 300px × 100px maximum
- File size: < 50KB

### Adding Custom Page Templates

1. Create file in `page-templates/` folder:
```php
<?php
/**
 * Template Name: My Custom Template
 */

get_header();
// Your custom content
get_footer();
```

2. Assign to page:
   - Edit page
   - Page Attributes → Template → My Custom Template

### Custom CSS

**Method 1: Customizer**
```
Appearance → Customize → Additional CSS
```

**Method 2: Child Theme**
Create `style.css` in child theme and enqueue it.

**Method 3: Tailwind Config**
Add to `tailwind.config.js` and rebuild.

---

## ⚡ Performance

### Speed Targets

- **PageSpeed Insights:** 90+ (mobile & desktop)
- **First Contentful Paint:** < 1.5s
- **Largest Contentful Paint:** < 2.5s
- **Time to Interactive:** < 3.5s
- **Total Page Size:** < 1MB
- **HTTP Requests:** < 30

### Built-in Optimizations

✅ Deferred JavaScript loading
✅ Critical CSS inlined
✅ Lazy loading (images, iframes)
✅ Minified CSS (production build)
✅ No jQuery dependency
✅ Conditional script loading
✅ Transient caching for queries
✅ Optimized database queries

### Required Optimizations

**1. Caching Plugin**
- Install WP Rocket or W3 Total Cache
- Enable page caching
- Enable GZIP compression
- Browser caching
- Minify HTML (optional)

**2. Object Caching**
- Install Redis or Memcached
- Install Redis Object Cache plugin
- Enable object caching

**3. CDN**
- Use Cloudflare (free tier OK)
- Configure page rules
- Enable Brotli compression
- Auto Minify assets

**4. Image Optimization**
- Install ShortPixel or Imagify
- Convert to WebP
- Lazy load (theme already does, but plugin enhances)
- Resize large images

**5. Database**
- Install WP-Optimize
- Schedule weekly optimization
- Remove post revisions (keep 5)
- Clean transients

See **[PERFORMANCE.md](PERFORMANCE.md)** for detailed guide.

---

## 🔍 SEO & Accessibility

### SEO Features

✅ **Schema Markup** - LocalBusiness, MedicalBusiness, DentalClinic
✅ **Semantic HTML** - Proper heading hierarchy
✅ **XML Sitemap** - Compatible with Yoast/Rank Math
✅ **Open Graph** - Social media previews
✅ **Meta Tags** - Title, description optimization
✅ **Breadcrumbs** - Supports Yoast/Rank Math
✅ **Canonical URLs** - Duplicate content prevention
✅ **Alt Text** - All images (must be added by user)

### Accessibility (WCAG 2.1 AA)

✅ **Color Contrast** - 4.5:1 minimum
✅ **Keyboard Navigation** - Full tab support
✅ **Screen Reader** - ARIA labels, landmarks
✅ **Focus Indicators** - Visible focus states
✅ **Skip Links** - Skip to main content
✅ **Form Labels** - All inputs labeled
✅ **Large Text** - 18px+ base font
✅ **Touch Targets** - 44px+ clickable areas

**Accessibility Testing:**
- WAVE browser extension
- axe DevTools
- Lighthouse accessibility audit
- Screen reader test (NVDA/JAWS)

---

## 🔧 Troubleshooting

### Common Issues

**1. Calculators Not Working**

**Symptoms:** JavaScript errors, calculator doesn't calculate

**Fixes:**
- Check browser console for JavaScript errors
- Ensure jQuery is NOT conflicting (theme doesn't use it)
- Clear all caches (WordPress, browser, CDN)
- Deactivate plugins one by one to find conflict

**2. Forms Not Submitting**

**Symptoms:** Form submission fails, no email received

**Fixes:**
- Check SMTP configuration
- Test with WP Mail SMTP plugin
- Check spam folder
- Verify notification email address correct
- Check PHP error log

**3. Images Not Showing**

**Symptoms:** Broken image icons

**Fixes:**
- Verify images uploaded correctly
- Check file permissions (644)
- Clear CDN cache
- Regenerate thumbnails (plugin: Regenerate Thumbnails)

**4. Slow Page Load**

**Symptoms:** PageSpeed score low, slow load times

**Fixes:**
- Run production Tailwind build: `npm run build`
- Install caching plugin
- Optimize images
- Enable CDN
- Check for slow database queries (Query Monitor plugin)

**5. HubSpot Integration Not Working**

**Symptoms:** Contacts not appearing in HubSpot

**Fixes:**
- Verify API key correct
- Verify Portal ID correct
- Check integration enabled in CRM Settings
- Check WordPress error log
- Test with simple form submission

**6. Mobile Menu Not Working**

**Symptoms:** Menu doesn't toggle on mobile

**Fixes:**
- Clear all caches
- Check JavaScript console for errors
- Ensure navigation.js is loading
- Check theme script dependencies

### Debug Mode

**Enable debugging:**
```php
// In wp-config.php
define('WP_DEBUG', true);
define('WP_DEBUG_LOG', true);
define('WP_DEBUG_DISPLAY', false);
```

**Check logs:**
```
wp-content/debug.log
```

### Reset Theme Settings

**Via WP-CLI:**
```bash
# Remove all theme mods
wp theme mod remove --all

# Remove CRM settings
wp option delete dental_rubio_hubspot_api_key
wp option delete dental_rubio_zapier_webhook_contact
# ... etc
```

**Via Database:**
```sql
DELETE FROM wp_options WHERE option_name LIKE 'dental_rubio_%';
```

---

## 📞 Support

### Documentation

- **Performance Guide:** [PERFORMANCE.md](PERFORMANCE.md)
- **Launch Checklist:** [LAUNCH-CHECKLIST.md](LAUNCH-CHECKLIST.md)
- **Theme Repository:** [GitHub](https://github.com/Craiber741/dentalwebsite741)

### Getting Help

1. **Check documentation** (README, PERFORMANCE, LAUNCH-CHECKLIST)
2. **Search GitHub issues** for similar problems
3. **Open new GitHub issue** with:
   - WordPress version
   - PHP version
   - Active plugins list
   - Error messages
   - Steps to reproduce

### Professional Support

For custom development or priority support:
- **Email:** support@dentalrubiogroup.com
- **Phone:** (619) 254-8214

---

## 📜 Changelog

### Version 1.0.0 (2025-11-25)

**Initial Release - Full Theme Complete**

**Phases Completed:**
- ✅ Phase 1: Foundation & Core Setup
- ✅ Phase 2: Homepage & Landing Experience
- ✅ Phase 3: Service Pages & Templates
- ✅ Phase 4: Advanced Calculators & Forms
- ✅ Phase 5: Tracking & Analytics Integration
- ✅ Phase 6: SEO & Accessibility
- ✅ Phase 7: Hub Pages & Content Organization
- ✅ Phase 8: Advanced Calculator Suite
- ✅ Phase 9: Additional Templates
- ✅ Phase 10: CRM Integration & Automation
- ✅ Phase 11: Final Optimization & Documentation

**Features:**
- Senior-friendly design (WCAG 2.1 AA compliant)
- 10+ page templates
- 3 advanced calculators
- HubSpot CRM integration
- Zapier webhook automation
- Email automation system
- Lead tracking & scoring
- Google Tag Manager integration
- Facebook Pixel tracking
- Schema.org structured data
- Performance optimized (Tailwind CSS, lazy loading)
- Mobile-first responsive design

---

## 📄 License

**Proprietary License**

This theme is proprietary software developed for Dental Rubio Group. All rights reserved.

© 2025 Dental Rubio Group. Unauthorized copying, distribution, or modification is prohibited.

---

## 🙏 Credits

**Developed for:** Dental Rubio Group, Los Algodones, Mexico

**Technologies Used:**
- WordPress 6.x
- Tailwind CSS 3.x
- Vanilla JavaScript (ES6+)
- PHP 8.x

**Third-Party Services:**
- Google Tag Manager
- Facebook Pixel
- HubSpot CRM
- Zapier
- Google Maps

---

**Theme Version:** 1.0.0
**Last Updated:** 2025-11-25
**Minimum WordPress:** 6.0
**Tested Up To:** 6.4
**PHP Version:** 8.0+
