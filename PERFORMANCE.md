# Performance Optimization Guide

## Dental Rubio Theme - Performance Best Practices

This guide covers performance optimization strategies implemented in the Dental Rubio WordPress theme and recommendations for maintaining optimal performance.

---

## Table of Contents

1. [Performance Features](#performance-features)
2. [Server Requirements](#server-requirements)
3. [Caching Strategy](#caching-strategy)
4. [Image Optimization](#image-optimization)
5. [Code Optimization](#code-optimization)
6. [Database Optimization](#database-optimization)
7. [Monitoring & Testing](#monitoring--testing)
8. [Troubleshooting](#troubleshooting)

---

## Performance Features

The theme includes built-in performance optimizations:

### JavaScript & CSS Optimization
- ✅ Deferred JavaScript loading (non-critical scripts)
- ✅ Inline critical CSS for above-the-fold content
- ✅ Minified Tailwind CSS (production build)
- ✅ Conditional script loading (only load what's needed)
- ✅ No jQuery dependency (vanilla JavaScript only)

### Image Handling
- ✅ Lazy loading for all images below the fold
- ✅ Responsive image sizes (srcset)
- ✅ WebP format support
- ✅ Custom image sizes for different contexts
- ✅ Blur-up placeholder technique

### Database Queries
- ✅ Optimized WP_Query usage
- ✅ Transient caching for expensive queries
- ✅ Meta query optimization
- ✅ Pagination to limit results

### Third-Party Scripts
- ✅ Async loading for tracking scripts (GTM, Facebook Pixel)
- ✅ Non-blocking webhook calls (Zapier)
- ✅ Deferred HubSpot tracking
- ✅ Lazy-loaded WhatsApp widget

---

## Server Requirements

### Minimum Requirements
- PHP 7.4 or higher (8.0+ recommended)
- MySQL 5.7 or MariaDB 10.3
- WordPress 6.0+
- 128MB PHP memory (256MB recommended)
- mod_rewrite enabled

### Recommended Server Configuration

**PHP Settings (php.ini):**
```ini
memory_limit = 256M
max_execution_time = 300
post_max_size = 64M
upload_max_filesize = 64M
max_input_vars = 3000
opcache.enable = 1
opcache.memory_consumption = 128
opcache.interned_strings_buffer = 8
opcache.max_accelerated_files = 4000
opcache.revalidate_freq = 60
```

**Apache (.htaccess) - Already included in theme:**
```apache
# Gzip Compression
<IfModule mod_deflate.c>
  AddOutputFilterByType DEFLATE text/html text/plain text/xml text/css text/javascript application/javascript application/json
</IfModule>

# Browser Caching
<IfModule mod_expires.c>
  ExpiresActive On
  ExpiresByType image/jpg "access plus 1 year"
  ExpiresByType image/jpeg "access plus 1 year"
  ExpiresByType image/gif "access plus 1 year"
  ExpiresByType image/png "access plus 1 year"
  ExpiresByType image/webp "access plus 1 year"
  ExpiresByType text/css "access plus 1 month"
  ExpiresByType application/javascript "access plus 1 month"
  ExpiresByType application/pdf "access plus 1 month"
  ExpiresByType image/x-icon "access plus 1 year"
</IfModule>
```

**Nginx Configuration:**
```nginx
# Gzip
gzip on;
gzip_vary on;
gzip_min_length 1024;
gzip_types text/plain text/css text/xml text/javascript application/javascript application/json;

# Browser Caching
location ~* \.(jpg|jpeg|png|gif|ico|css|js|webp)$ {
    expires 1y;
    add_header Cache-Control "public, immutable";
}
```

---

## Caching Strategy

### Page Caching (Required)

**Recommended Plugins:**
1. **WP Rocket** (Premium - Best)
   - Page caching
   - GZIP compression
   - Browser caching
   - Lazy loading
   - Database optimization
   - CDN integration

2. **W3 Total Cache** (Free)
   - Page caching
   - Object caching
   - Database caching
   - Minification

3. **LiteSpeed Cache** (Free - if using LiteSpeed server)
   - Server-level caching
   - Image optimization
   - CSS/JS minification

**Configuration for WP Rocket:**
```
Cache Lifespan: 24 hours
Minify CSS: Yes
Minify JavaScript: Yes
Combine CSS: No (Tailwind already optimized)
Combine JavaScript: No (break functionality)
Lazy Load Images: Yes (theme has built-in but WP Rocket enhances)
Lazy Load Iframes: Yes
Database Optimization: Run weekly
```

### Object Caching

Install **Redis** or **Memcached** for object caching:

**Redis (Recommended):**
```bash
# Install Redis
sudo apt-get install redis-server

# Install Redis Object Cache plugin
wp plugin install redis-cache --activate
wp redis enable
```

**Configuration (wp-config.php):**
```php
define('WP_REDIS_HOST', '127.0.0.1');
define('WP_REDIS_PORT', 6379);
define('WP_CACHE_KEY_SALT', 'dentalrubio_');
define('WP_REDIS_MAXTTL', 86400); // 24 hours
```

### CDN Integration

**Recommended CDN Providers:**
- **Cloudflare** (Free tier available)
- **BunnyCDN** (Affordable, fast)
- **StackPath**
- **Amazon CloudFront**

**Cloudflare Setup:**
1. Add your domain to Cloudflare
2. Update nameservers
3. Enable:
   - Auto Minify (HTML, CSS, JS)
   - Brotli compression
   - HTTP/2
   - Rocket Loader (optional - test first)
4. Set caching level to "Standard"
5. Create page rules:
   ```
   *.jpg -> Cache Level: Cache Everything, Edge TTL: 1 month
   *.png -> Cache Level: Cache Everything, Edge TTL: 1 month
   *.css -> Cache Level: Cache Everything, Edge TTL: 1 week
   *.js -> Cache Level: Cache Everything, Edge TTL: 1 week
   ```

---

## Image Optimization

### Automatic Optimization

**Recommended Plugin: ShortPixel Image Optimizer**

```
Settings:
- Compression: Lossy (recommended for web)
- Resize large images: 1920px max width
- Convert to WebP: Yes
- Lazy load: No (theme handles this)
- Backup images: Yes (first month, then disable)
```

**Alternative: Imagify**
```
Settings:
- Optimization level: Aggressive
- Resize larger images: 1920px
- Create WebP versions: Yes
- Display WebP images: Yes
```

### Manual Optimization

Before uploading images:
1. **Resize**: Maximum 1920px wide for full-width images
2. **Compress**: Use TinyPNG or Squoosh.app
3. **Format**:
   - Photos: JPG (75-85% quality)
   - Graphics/logos: PNG or SVG
   - Modern browsers: WebP

### Image Best Practices

```php
// Theme already uses these image sizes:
add_image_size('service-thumbnail', 400, 300, true);      // Service cards
add_image_size('testimonial-avatar', 100, 100, true);     // Avatars
add_image_size('hero-image', 1200, 600, true);           // Hero sections
```

**Upload Guidelines:**
- Hero images: 1920x800px, < 200KB
- Service thumbnails: 800x600px, < 100KB
- Testimonial photos: 400x400px, < 50KB
- Icons/logos: SVG preferred

---

## Code Optimization

### Tailwind CSS Production Build

The theme uses Tailwind CSS. For production:

```bash
# Navigate to theme directory
cd wp-content/themes/dental-rubio-theme

# Install dependencies (if not already installed)
npm install

# Build optimized CSS (minified, purged)
npm run build

# This creates optimized assets/css/main.css
```

**Tailwind Production Config** (tailwind.config.js):
```javascript
module.exports = {
  content: [
    './**/*.php',
    './assets/js/**/*.js',
  ],
  theme: {
    extend: { /* ... */ }
  },
  plugins: [],
}
```

### JavaScript Optimization

**Theme JavaScript is already optimized:**
- No jQuery dependency
- Modular loading (calculators only load on calculator pages)
- Event delegation for dynamic content
- Debouncing for scroll/resize events

**If adding custom JavaScript:**
```javascript
// Good: Event delegation
document.addEventListener('click', (e) => {
  if (e.target.matches('.calculator-button')) {
    // Handle click
  }
});

// Bad: Multiple listeners
document.querySelectorAll('.calculator-button').forEach(btn => {
  btn.addEventListener('click', handleClick);
});
```

### Database Query Optimization

**Avoid:**
```php
// Bad: Loads all posts
$query = new WP_Query(['post_type' => 'post', 'posts_per_page' => -1]);

// Bad: Multiple meta queries
get_posts([
  'meta_key' => 'price',
  'meta_value' => '100'
]);
get_posts([
  'meta_key' => 'featured',
  'meta_value' => '1'
]);
```

**Best Practice:**
```php
// Good: Limit results, use transients
$cached_posts = get_transient('featured_posts');
if (false === $cached_posts) {
  $cached_posts = new WP_Query([
    'post_type' => 'post',
    'posts_per_page' => 10,
    'meta_query' => [
      'relation' => 'AND',
      ['key' => 'price', 'value' => '100'],
      ['key' => 'featured', 'value' => '1']
    ]
  ]);
  set_transient('featured_posts', $cached_posts, HOUR_IN_SECONDS);
}
```

---

## Database Optimization

### Regular Maintenance

**WP-CLI Commands:**
```bash
# Optimize database tables
wp db optimize

# Repair database
wp db repair

# Clean up revisions (keep last 5)
wp post delete $(wp post list --post_type='revision' --format=ids --posts_per_page=-1)

# Clean up transients
wp transient delete --all

# Clean up spam comments
wp comment delete $(wp comment list --status=spam --format=ids)
```

**Recommended Plugin: WP-Optimize**
```
Schedule:
- Weekly: Remove post revisions (keep 5)
- Weekly: Clean spam/trash comments
- Weekly: Optimize database tables
- Monthly: Remove orphaned data
```

### Limit Post Revisions

**Add to wp-config.php:**
```php
// Limit post revisions to 5
define('WP_POST_REVISIONS', 5);

// Autosave every 5 minutes (default: 1 minute)
define('AUTOSAVE_INTERVAL', 300);
```

### Transient Cleanup

Theme uses transients for caching. Cleanup happens automatically, but for manual cleanup:

```php
// Delete specific transient
delete_transient('dental_rubio_visitor_12345');

// Delete all theme transients (if needed)
global $wpdb;
$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_dental_rubio_%'");
$wpdb->query("DELETE FROM $wpdb->options WHERE option_name LIKE '_transient_timeout_dental_rubio_%'");
```

---

## Monitoring & Testing

### Performance Testing Tools

**Speed Tests:**
1. **Google PageSpeed Insights** - https://pagespeed.web.dev/
   - Target: 90+ score on mobile and desktop

2. **GTmetrix** - https://gtmetrix.com/
   - Target: Grade A, < 2s load time

3. **WebPageTest** - https://www.webpagetest.org/
   - Test from multiple locations
   - Target: First Byte < 600ms

**Core Web Vitals Targets:**
- **LCP (Largest Contentful Paint)**: < 2.5s
- **FID (First Input Delay)**: < 100ms
- **CLS (Cumulative Layout Shift)**: < 0.1

### Monitoring Tools

**Server Monitoring:**
- **New Relic** (Application Performance Monitoring)
- **Datadog**
- **Query Monitor** (WordPress plugin for development)

**Uptime Monitoring:**
- **UptimeRobot** (Free tier: 50 monitors)
- **Pingdom**
- **StatusCake**

### WordPress-Specific Monitoring

**Install Query Monitor Plugin** (development only):
```bash
wp plugin install query-monitor --activate
```

Check for:
- Slow database queries (> 0.05s)
- Duplicate queries
- HTTP API calls
- PHP errors

---

## Troubleshooting

### Common Issues

**1. Slow Homepage**
- Check for large unoptimized images
- Verify caching is working (check HTTP headers)
- Disable plugins one by one to find culprit
- Check for external HTTP requests (calculators, maps, fonts)

**2. Slow Admin Dashboard**
- Disable Heartbeat API:
  ```php
  // In wp-config.php
  define('WP_POST_REVISIONS', 5);

  // Disable heartbeat on frontend
  add_action('init', function() {
    if (!is_admin()) {
      wp_deregister_script('heartbeat');
    }
  });
  ```

**3. High Server Load**
- Check for bot traffic (Google Search Console)
- Verify caching is active
- Check for DDOS attempts
- Review slow queries with Query Monitor

**4. Calculator Pages Slow**
- Calculators use JavaScript - ensure scripts are minified
- Check for console errors (browser DevTools)
- Verify AJAX endpoints are responding quickly

### Performance Checklist

✅ **Hosting:**
- [ ] PHP 8.0+
- [ ] OPcache enabled
- [ ] Adequate memory (256MB+)
- [ ] SSD storage
- [ ] CDN configured

✅ **Caching:**
- [ ] Page cache active (WP Rocket/W3TC)
- [ ] Object cache active (Redis/Memcached)
- [ ] Browser caching configured
- [ ] CDN purge on content updates

✅ **Images:**
- [ ] All images optimized (< 200KB each)
- [ ] WebP format enabled
- [ ] Lazy loading active
- [ ] Responsive sizes generated

✅ **Code:**
- [ ] Tailwind CSS production build
- [ ] Unused plugins removed
- [ ] Database optimized
- [ ] Transients cleaned up

✅ **Monitoring:**
- [ ] Google PageSpeed score 90+
- [ ] Core Web Vitals passing
- [ ] Uptime monitoring configured
- [ ] Error logging enabled

---

## Performance Targets

### Development Environment
- Time to First Byte (TTFB): < 800ms
- First Contentful Paint (FCP): < 2s
- Largest Contentful Paint (LCP): < 3s

### Production Environment (with optimizations)
- Time to First Byte (TTFB): < 400ms
- First Contentful Paint (FCP): < 1s
- Largest Contentful Paint (LCP): < 2s
- Total Page Size: < 1MB
- HTTP Requests: < 30
- PageSpeed Score: 90+

---

## Support

For performance issues:
1. Check WordPress debug log (`wp-content/debug.log`)
2. Review server error logs
3. Test with all plugins disabled
4. Use Query Monitor to identify slow queries
5. Test on different devices/locations

**Documentation:** https://github.com/Craiber741/dentalwebsite741
**Support:** Open an issue on GitHub

---

**Last Updated:** 2025-11-25
**Theme Version:** 1.0.0
