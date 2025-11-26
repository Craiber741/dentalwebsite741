# Launch Checklist - Dental Rubio Theme

## Pre-Launch Checklist for Going Live

Complete checklist for deploying the Dental Rubio WordPress theme to production.

---

## Table of Contents

1. [Pre-Deployment Setup](#pre-deployment-setup)
2. [Content Preparation](#content-preparation)
3. [Technical Configuration](#technical-configuration)
4. [SEO & Analytics](#seo--analytics)
5. [Performance Optimization](#performance-optimization)
6. [Security Hardening](#security-hardening)
7. [CRM & Integration Testing](#crm--integration-testing)
8. [Final Testing](#final-testing)
9. [Launch Day](#launch-day)
10. [Post-Launch](#post-launch)

---

## Pre-Deployment Setup

### Server Requirements

- [ ] PHP 8.0+ installed and configured
- [ ] MySQL 5.7+ or MariaDB 10.3+
- [ ] SSL certificate installed (HTTPS)
- [ ] Domain pointing to correct IP
- [ ] Email sending configured (SMTP recommended)
- [ ] Server timezone set correctly
- [ ] Cron jobs enabled
- [ ] PHP memory limit: 256MB+
- [ ] Max execution time: 300s
- [ ] Upload max filesize: 64MB+

### WordPress Installation

- [ ] WordPress 6.0+ installed
- [ ] WordPress core files up to date
- [ ] Admin account created with strong password
- [ ] Timezone set (Settings → General)
- [ ] Permalink structure set to "Post name"
- [ ] Site title and tagline configured
- [ ] Search engine visibility: **OFF** (until launch)

### Theme Installation

- [ ] Dental Rubio theme uploaded and activated
- [ ] Tailwind CSS production build generated
  ```bash
  cd wp-content/themes/dental-rubio-theme
  npm install
  npm run build
  ```
- [ ] Child theme created (if customizations planned)
- [ ] All theme files have correct permissions (755 for folders, 644 for files)

---

## Content Preparation

### Pages Created

- [ ] Homepage (set as static front page)
- [ ] Contact page (template: Contact)
- [ ] About Us / Our Team
- [ ] Dental Implants service page
- [ ] All-on-4 service page
- [ ] Crowns & Bridges service page
- [ ] Dentures service page
- [ ] Cosmetic Dentistry service page
- [ ] Pricing page
- [ ] Travel Guide
- [ ] Snowbirds Guide
- [ ] FAQs page
- [ ] Privacy Policy
- [ ] Terms of Service
- [ ] Blog (if using)
- [ ] 404 page (automatically uses theme 404.php)

### Content Quality Check

- [ ] All content proofread for spelling/grammar
- [ ] Medical accuracy verified
- [ ] Contact information correct everywhere
- [ ] Phone number formatted correctly: (619) 254-8214
- [ ] WhatsApp number configured
- [ ] Email addresses verified and working
- [ ] Clinic address correct
- [ ] Hours of operation listed
- [ ] All links working (no broken links)
- [ ] Calls-to-action clear and compelling

### Media Assets

- [ ] Logo uploaded (Settings → Site Identity)
- [ ] Favicon uploaded (Settings → Site Identity)
- [ ] All images optimized (< 200KB each)
- [ ] Images have alt text (accessibility + SEO)
- [ ] Hero images are high quality (1920x800px)
- [ ] Team photos professional quality
- [ ] Before/after photos (if applicable)
- [ ] Video content uploaded (YouTube embeds recommended)

---

## Technical Configuration

### Theme Customizer

Go to **Appearance → Customize** and configure:

- [ ] Site Title & Tagline
- [ ] Logo & Favicon
- [ ] Colors (if customizable)
- [ ] Navigation Menu (Primary, Footer, Mobile)
- [ ] Footer Widget Areas configured
- [ ] Contact Information:
  - [ ] Phone: (619) 254-8214
  - [ ] WhatsApp: +52 XXX XXX XXXX
  - [ ] Email: info@dentalrubiogroup.com
  - [ ] Address: Calle 2, Los Algodones, BC, Mexico

### Navigation Menus

Go to **Appearance → Menus**:

**Primary Menu:**
- [ ] Home
- [ ] Services (dropdown)
  - [ ] Dental Implants
  - [ ] All-on-4
  - [ ] Crowns & Bridges
  - [ ] Dentures
  - [ ] Cosmetic Dentistry
- [ ] Pricing
- [ ] For Snowbirds
- [ ] Travel Guide
- [ ] Contact
- [ ] Call Now button (custom link: tel:+16192548214)

**Footer Menu:**
- [ ] About Us
- [ ] Services
- [ ] FAQs
- [ ] Privacy Policy
- [ ] Terms of Service

### Widget Areas

Configure **Appearance → Widgets**:

**Footer Widget 1:**
- [ ] Text widget with clinic description
- [ ] Contact information

**Footer Widget 2:**
- [ ] Navigation menu or custom links
- [ ] Social media links

**Blog Sidebar** (if using blog):
- [ ] Search widget
- [ ] Recent posts
- [ ] Categories
- [ ] CTA widget (schedule appointment)

---

## SEO & Analytics

### SEO Plugin Configuration

Install **Yoast SEO** or **Rank Math**:

- [ ] SEO plugin installed and activated
- [ ] Homepage title optimized
- [ ] Homepage meta description (< 160 characters)
- [ ] Social media profiles added
- [ ] XML sitemap enabled
- [ ] Breadcrumbs enabled
- [ ] OpenGraph tags configured
- [ ] Twitter card tags configured
- [ ] Schema markup verified (theme has built-in)

### Google Services

**Google Search Console:**
- [ ] Property added and verified
- [ ] Sitemap submitted (yourdomain.com/sitemap.xml)
- [ ] Coverage errors checked and fixed
- [ ] Mobile usability verified

**Google Tag Manager:**
- [ ] GTM account created
- [ ] Container ID added to theme settings
- [ ] Tags configured:
  - [ ] Google Analytics 4
  - [ ] Google Ads (if running ads)
  - [ ] Conversion tracking
- [ ] All tags tested and firing correctly

**Google Analytics 4:**
- [ ] GA4 property created
- [ ] Connected to GTM
- [ ] Goals/Conversions configured:
  - [ ] Contact form submission
  - [ ] Phone click
  - [ ] Calculator usage
  - [ ] Appointment request
- [ ] Real-time tracking verified

**Google My Business:**
- [ ] Profile claimed and verified
- [ ] All information accurate
- [ ] Photos uploaded
- [ ] Reviews responded to
- [ ] Website link correct

### Facebook Pixel

- [ ] Facebook Business Manager setup
- [ ] Pixel created
- [ ] Pixel ID added to theme (inc/tracking/facebook-pixel.php)
- [ ] Test event sent successfully
- [ ] Custom conversions configured:
  - [ ] Contact Form Submission
  - [ ] Calculator Usage
  - [ ] Appointment Request
- [ ] Pixel Helper verified

---

## Performance Optimization

### Caching

- [ ] Caching plugin installed (WP Rocket recommended)
- [ ] Page cache enabled
- [ ] Browser cache configured
- [ ] GZIP compression enabled
- [ ] Object cache enabled (Redis/Memcached)
- [ ] Cache cleared before launch

### CDN

- [ ] CDN provider chosen (Cloudflare recommended)
- [ ] Domain added to CDN
- [ ] DNS configured
- [ ] SSL configured on CDN
- [ ] Page rules created for static assets
- [ ] CDN cache purged before launch

### Image Optimization

- [ ] Image optimization plugin installed (ShortPixel/Imagify)
- [ ] All existing images optimized
- [ ] WebP format enabled
- [ ] Lazy loading enabled (theme has built-in)
- [ ] Image sizes configured correctly

### Speed Test

Run tests and verify targets met:

- [ ] **Google PageSpeed Insights**: 90+ score
  - Desktop: 90+
  - Mobile: 85+
- [ ] **GTmetrix**: Grade A, < 2s load time
- [ ] **WebPageTest**: First Byte < 600ms
- [ ] Core Web Vitals passing:
  - LCP < 2.5s
  - FID < 100ms
  - CLS < 0.1

### Database

- [ ] Database optimized (remove revisions, spam, transients)
- [ ] Post revisions limited (wp-config.php)
- [ ] Auto-optimization scheduled (WP-Optimize plugin)

---

## Security Hardening

### Security Plugin

Install **Wordfence** or **Sucuri Security**:

- [ ] Security plugin installed
- [ ] Firewall enabled
- [ ] Malware scan completed (clean)
- [ ] Login security configured
- [ ] Two-factor authentication enabled (admin)
- [ ] File integrity monitoring enabled

### WordPress Security

- [ ] All default usernames changed (no "admin")
- [ ] Strong passwords enforced
- [ ] WordPress auto-updates enabled
- [ ] Plugins auto-update enabled (minor versions)
- [ ] Unused plugins deleted
- [ ] Unused themes deleted
- [ ] File permissions correct (755/644)
- [ ] wp-config.php moved outside web root (optional)
- [ ] Database prefix changed from wp_
- [ ] XML-RPC disabled (if not needed)
- [ ] File editing disabled in dashboard

**Add to wp-config.php:**
```php
// Disable file editing
define('DISALLOW_FILE_EDIT', true);

// Security keys (use https://api.wordpress.org/secret-key/1.1/salt/)
define('AUTH_KEY',         'put your unique phrase here');
define('SECURE_AUTH_KEY',  'put your unique phrase here');
// ... etc

// Limit post revisions
define('WP_POST_REVISIONS', 5);

// SSL enforcement
define('FORCE_SSL_ADMIN', true);
```

### SSL/HTTPS

- [ ] SSL certificate installed
- [ ] HTTPS forced (redirect HTTP to HTTPS)
- [ ] Mixed content errors fixed
- [ ] SSL Labs test: A+ rating (https://www.ssllabs.com/ssltest/)

### Backups

- [ ] Backup plugin installed (UpdraftPlus/BackupBuddy)
- [ ] Automated backups configured
- [ ] Backup schedule: Daily (keep 7 days)
- [ ] Remote storage configured (Dropbox/Google Drive)
- [ ] Test restoration process verified

---

## CRM & Integration Testing

### HubSpot Integration

Go to **CRM Settings** in WordPress admin:

- [ ] HubSpot API key configured
- [ ] HubSpot Portal ID configured
- [ ] Test contact form submission → Creates contact in HubSpot
- [ ] Verify deal creation for high-value treatments
- [ ] Check UTM parameters captured correctly
- [ ] Confirm page view tracking working

### Zapier Webhooks

- [ ] Zapier account created
- [ ] Zaps created for each trigger:
  - [ ] Contact form → Send to email/Slack/CRM
  - [ ] Calculator → Log to Google Sheets
  - [ ] Appointment → Urgent notification
  - [ ] Newsletter → Add to email list
- [ ] Webhook URLs added to CRM Settings
- [ ] Test each webhook fires correctly
- [ ] Verify data payload complete and accurate

### Email Automation

- [ ] SMTP configured (SendGrid/Mailgun/Amazon SES)
- [ ] From email configured: info@dentalrubiogroup.com
- [ ] From name: "Dental Rubio Group"
- [ ] Notification email set for admin alerts
- [ ] Test emails:
  - [ ] Contact form confirmation → Receives email
  - [ ] Calculator follow-up → Receives email
  - [ ] Appointment confirmation → Receives email
  - [ ] Admin notifications working
- [ ] Email templates display correctly (test in Gmail, Outlook)
- [ ] Unsubscribe links working (if applicable)
- [ ] SPF and DKIM records configured (check with mail-tester.com)

### Lead Tracking

- [ ] Lead tracking enabled in CRM Settings
- [ ] Visit website with UTM parameters → Cookies set
- [ ] Submit form → Lead created in WordPress admin
- [ ] Verify lead information complete:
  - [ ] Contact details
  - [ ] UTM source/campaign
  - [ ] Landing page
  - [ ] Pages visited
  - [ ] Lead score calculated
- [ ] Lead meta boxes display correctly

### WhatsApp Widget

- [ ] WhatsApp number configured correctly (+52 XXX XXX XXXX)
- [ ] Widget appears on all pages
- [ ] Click widget → Opens WhatsApp with pre-filled message
- [ ] Mobile: Opens WhatsApp app
- [ ] Desktop: Opens WhatsApp Web

---

## Final Testing

### Browser Testing

Test in all major browsers:

- [ ] **Chrome** (latest)
  - Desktop: ✓
  - Mobile: ✓
- [ ] **Safari** (latest)
  - Desktop: ✓
  - Mobile (iOS): ✓
- [ ] **Firefox** (latest)
  - Desktop: ✓
  - Mobile: ✓
- [ ] **Edge** (latest)
  - Desktop: ✓

### Device Testing

- [ ] Desktop (1920x1080, 1366x768)
- [ ] Laptop (1440x900, 1280x800)
- [ ] Tablet (iPad - 1024x768)
- [ ] Mobile (iPhone 12 - 390x844)
- [ ] Mobile (Samsung Galaxy - 360x640)

### Functionality Testing

**Forms:**
- [ ] Contact form submits successfully
- [ ] Calculator generates correct results
- [ ] Appointment request form works
- [ ] All form validations working
- [ ] Spam protection active (Akismet/reCAPTCHA)

**Navigation:**
- [ ] All menu items work
- [ ] Dropdown menus function on mobile
- [ ] Mobile menu toggle works
- [ ] Footer links work
- [ ] Breadcrumbs display correctly

**Content:**
- [ ] All service pages load
- [ ] Calculator pages interactive
- [ ] Hub pages display articles correctly
- [ ] Search functionality works
- [ ] Blog/archive pages display (if applicable)
- [ ] 404 page shows for non-existent pages

**Interactive Elements:**
- [ ] All buttons clickable
- [ ] Hover effects work
- [ ] Image lightboxes work (if applicable)
- [ ] Video embeds play
- [ ] Google Maps displays on contact page
- [ ] FAQ accordions expand/collapse
- [ ] Testimonial sliders work (if applicable)

### Accessibility Testing

- [ ] Screen reader test (NVDA/JAWS)
- [ ] Keyboard navigation (Tab through all elements)
- [ ] Color contrast ratios pass (WebAIM Contrast Checker)
- [ ] Images have alt text
- [ ] Form labels associated correctly
- [ ] ARIA labels present where needed
- [ ] Skip links work
- [ ] Focus indicators visible

**Tools:**
- [ ] WAVE browser extension (no errors)
- [ ] Lighthouse accessibility score: 90+
- [ ] axe DevTools (no critical issues)

### SEO Check

- [ ] All pages have unique titles
- [ ] All pages have meta descriptions
- [ ] H1 tags unique on each page
- [ ] Heading hierarchy correct (H1 → H2 → H3)
- [ ] Images have alt text
- [ ] Schema markup present (test with Schema Markup Validator)
- [ ] XML sitemap accessible
- [ ] Robots.txt configured correctly
- [ ] Canonical URLs set correctly
- [ ] 301 redirects for old URLs (if migrating)

---

## Launch Day

### Pre-Launch (1 hour before)

- [ ] Final backup completed
- [ ] All caches cleared (WordPress, CDN, browser)
- [ ] Test all forms one final time
- [ ] Verify email sending works
- [ ] Check tracking pixels firing (Facebook Pixel Helper, GTM Preview)
- [ ] Verify Google Analytics tracking

### Go Live

- [ ] Update wp-config.php for production:
  ```php
  define('WP_ENV', 'production');
  define('WP_DEBUG', false);
  define('WP_DEBUG_LOG', false);
  define('WP_DEBUG_DISPLAY', false);
  ```
- [ ] Enable search engine visibility (Settings → Reading)
- [ ] Verify robots.txt allows crawling
- [ ] Submit sitemap to Google Search Console
- [ ] Test homepage loads correctly
- [ ] Test a few random deep pages
- [ ] Verify contact form submission works
- [ ] Check Google Analytics real-time (visit homepage)

### Announcement

- [ ] Update Google My Business with new website
- [ ] Share on social media (Facebook, Instagram)
- [ ] Email existing patients about new website
- [ ] Press release (if applicable)
- [ ] Update business listings (Yelp, health directories)

---

## Post-Launch

### Week 1

- [ ] Monitor Google Analytics daily
- [ ] Check Google Search Console for errors
- [ ] Review form submissions (are they arriving?)
- [ ] Check server error logs
- [ ] Monitor uptime (UptimeRobot)
- [ ] Test speed daily (any regressions?)
- [ ] Check lead tracking working
- [ ] Review CRM integrations functioning

### Month 1

- [ ] Review analytics data
  - Traffic sources
  - Top pages
  - Conversion rates
  - Bounce rates
- [ ] Check rankings in Google Search Console
- [ ] Review backlink profile (if tracking)
- [ ] Update any outdated content
- [ ] Add new blog posts (if applicable)
- [ ] Optimize underperforming pages
- [ ] A/B test CTAs (if possible)

### Ongoing

**Weekly:**
- [ ] Check form submissions
- [ ] Review new leads in CRM
- [ ] Monitor uptime/performance
- [ ] Check backups completed

**Monthly:**
- [ ] WordPress updates (core, plugins, theme)
- [ ] Security scan
- [ ] Database optimization
- [ ] Review analytics
- [ ] Update content as needed

**Quarterly:**
- [ ] Full SEO audit
- [ ] Performance audit (speed test)
- [ ] Content audit (update old posts)
- [ ] Review and refresh images
- [ ] Competitive analysis

---

## Emergency Contacts

**Technical Support:**
- Hosting Provider: _______________
- Domain Registrar: _______________
- Developer: _______________

**Critical Credentials:**
Store securely in password manager:
- WordPress Admin
- Hosting Control Panel
- Domain Registrar
- Google Account (Analytics, Search Console)
- Facebook Business Manager
- HubSpot Account
- Email Account (SMTP)

---

## Launch Sign-Off

**Site Owner:** _______________ Date: ___________

**Developer:** _______________ Date: ___________

**SEO Specialist:** _______________ Date: ___________

---

## Rollback Plan

If critical issues occur post-launch:

1. **Restore from backup** (UpdraftPlus → Restore)
2. **Revert to previous theme** (Appearance → Themes)
3. **Disable problematic plugin** (Plugins → Deactivate)
4. **Contact hosting support** (check server logs)
5. **Enable WordPress debug mode** (temporarily):
   ```php
   define('WP_DEBUG', true);
   define('WP_DEBUG_LOG', true);
   ```

**Backup contact:** Have a developer on standby for first 48 hours

---

**Theme Version:** 1.0.0
**Checklist Version:** 1.0
**Last Updated:** 2025-11-25
