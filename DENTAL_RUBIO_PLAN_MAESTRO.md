# DENTAL RUBIO GROUP - PLAN MAESTRO DE IMPLEMENTACION
## Theme WordPress Completo + Sitio Web Senior-Friendly

**Fecha:** Noviembre 2025
**Duracion Estimada:** 15 conversaciones (21-29 horas)
**Resultado Final:** Theme WordPress completamente funcional, optimizado para seniors, listo para produccion
**Presupuesto:** $11,100 USD (inversion inicial)

---

## TABLA DE CONTENIDOS

1. [Arquitectura General del Proyecto](#arquitectura-general)
2. [Prerequisitos y Setup](#prerequisitos)
3. [Estructura de Carpetas Completa](#estructura-carpetas)
4. [15 Conversaciones Detalladas](#conversaciones-detalladas)
5. [Especificaciones Tecnicas](#especificaciones)
6. [Codigo Base](#codigo-base)
7. [Checklist de Implementacion](#checklist)

---

## ARQUITECTURA GENERAL

### Stack Tecnologico Recomendado

```
Frontend:
├── WordPress Core (Actual)
├── Tema Custom Ligero (NO Divi/Elementor)
├── Tailwind CSS via CDN (compilado)
├── JavaScript Vanilla (minimo)
└── Bootstrap Grid System (fallback)

Backend:
├── WordPress Database
├── PHP 7.4+ (minimo)
├── MySQL 5.7+
└── Banahosting Shared Hosting

Optimizacion:
├── WP Rocket ($49/ano)
├── ShortPixel ($10/mes)
├── Cloudflare Free (cache + CDN)
├── BunnyCDN ($5-10/mes)
└── Yoast SEO Premium ($99/ano)

CRM y Conversion:
├── Chawoora (WhatsApp integration)
├── HubSpot Free CRM (lead management)
├── Google Tag Manager (tracking)
└── Facebook Pixel (remarketing)

Herramientas Auxiliares:
├── Hotjar ($39/mes - heatmaps)
├── CallRail ($45/mes - call tracking)
└── Google Data Studio (reporting)
```

### Performance Targets

```
PageSpeed Score: 85+ (Mobile: 80+)
Core Web Vitals: PASS
  - LCP: <2.5s
  - FID: <100ms
  - CLS: <0.1
Bounce Rate: <35%
Pages/Session: 3+
Tasa Conversion: 1.5% → 3.5%
```

---

## PREREQUISITOS Y SETUP

### Antes de Comenzar - Verificar

- [ ] Acceso WordPress admin (dentalrubio.com)
- [ ] FTP/SFTP access a Banahosting
- [ ] Backup completo del sitio actual (CRITICO)
- [ ] Acceso Google Ads y Facebook Ads
- [ ] Google Analytics 4 configurado
- [ ] SSL certificate activo (HTTPS)
- [ ] Dominio apuntando correctamente
- [ ] Emails de la clinica funcionales

### Instalaciones Necesarias

```bash
# En servidor (via SSH/Command Line)
composer install # Si necesario
npm install -g tailwindcss # Para compilar CSS

# Plugins WordPress a instalar PRIMERO
1. WP Rocket - Cache y optimizacion
2. ShortPixel - Compresion de imagenes
3. Yoast SEO Premium - SEO on-page
4. Really Simple SSL - HTTPS management
5. WPForms Lite - Formularios
6. Wordfence - Seguridad basica
7. Google Site Kit - Analytics integration
```

---

## ESTRUCTURA DE CARPETAS COMPLETA

```
dental-rubio-theme/
│
├── style.css (Theme Header)
├── functions.php (Core Setup)
├── index.php (Fallback)
├── README.md (Documentation)
│
├── inc/ (Funcionalidad PHP)
│   ├── theme-setup.php
│   ├── enqueue-scripts.php
│   ├── performance-optimizations.php
│   ├── design-system.php
│   ├── custom-post-types.php
│   │
│   ├── forms/
│   │   ├── contact-form.php
│   │   ├── lead-form.php
│   │   └── calculator-handler.php
│   │
│   ├── integrations/
│   │   ├── whatsapp-widget.php
│   │   ├── crm-webhook.php
│   │   ├── email-autoresponder.php
│   │   └── gtm-setup.php
│   │
│   ├── seo/
│   │   ├── schema-markup.php
│   │   ├── meta-tags.php
│   │   ├── sitemap-generator.php
│   │   └── open-graph.php
│   │
│   ├── calculators/
│   │   ├── savings-calculator.php
│   │   ├── all-on-4-calculator.php
│   │   ├── straumann-comparison.php
│   │   ├── trip-cost-calculator.php
│   │   ├── payment-plan-calculator.php
│   │   └── roi-calculator.php
│   │
│   └── tracking/
│       ├── facebook-pixel.php
│       ├── gtag-analytics.php
│       └── custom-events.php
│
├── assets/
│   ├── css/
│   │   ├── base.css (Resets + Variables)
│   │   ├── components.css (UI Components)
│   │   ├── utilities.css (Helpers)
│   │   ├── tailwind.css (Tailwind imports)
│   │   └── critical.css (Inline in <head>)
│   │
│   ├── js/
│   │   ├── main.js (Core functionality)
│   │   ├── mobile-menu.js
│   │   ├── sticky-elements.js
│   │   ├── form-handler.js
│   │   ├── calculator-engine.js
│   │   ├── analytics.js
│   │   └── integrations.js
│   │
│   ├── images/
│   │   ├── logo.svg
│   │   ├── icons/
│   │   ├── svg-sprites/
│   │   └── placeholder/
│   │
│   └── fonts/
│       ├── inter/ (main font)
│       └── fallback/
│
├── template-parts/
│   ├── header/
│   │   ├── header.php
│   │   ├── navigation.php
│   │   ├── mobile-menu.php
│   │   └── sticky-phone.php
│   │
│   ├── home/
│   │   ├── hero.php
│   │   ├── trust-bar.php
│   │   ├── calculator.php
│   │   ├── services.php
│   │   ├── testimonials.php
│   │   ├── how-it-works.php
│   │   ├── safety.php
│   │   └── final-cta.php
│   │
│   ├── service/
│   │   ├── hero.php
│   │   ├── price-table.php
│   │   ├── whats-included.php
│   │   ├── process.php
│   │   ├── testimonials.php
│   │   ├── gallery.php
│   │   ├── faq.php
│   │   └── cta.php
│   │
│   ├── components/
│   │   ├── button.php
│   │   ├── card.php
│   │   ├── testimonial.php
│   │   ├── stat-box.php
│   │   ├── feature-list.php
│   │   └── trust-badge.php
│   │
│   ├── footer/
│   │   ├── footer.php
│   │   ├── footer-menu.php
│   │   ├── footer-trust.php
│   │   └── footer-contact.php
│   │
│   └── hub/
│       ├── intro.php
│       ├── articles-grid.php
│       ├── sidebar.php
│       └── cta-section.php
│
├── page-templates/
│   ├── template-homepage.php
│   ├── template-service.php
│   ├── template-hub.php
│   ├── template-contact.php
│   ├── template-full-width.php
│   └── template-no-sidebar.php
│
├── content/
│   ├── pages/ (Markdown drafts)
│   ├── services/ (Service descriptions)
│   ├── blog/ (Article outlines)
│   └── calculators/ (Calculator specs)
│
├── config/
│   ├── settings.php (Theme options)
│   ├── constants.php (Global variables)
│   └── customizer.php (WordPress Customizer)
│
└── tailwind.config.js (Tailwind Configuration)
```

---

## 15 CONVERSACIONES DETALLADAS

### FASE 1: FUNDACION TECNICA (Conversaciones 1-3)

#### CONVERSACION 1: Setup Base del Theme + Arquitectura

**Objetivo:** Crear estructura base del theme con optimizaciones de performance

**Inputs Necesarios:**
- Plan del Sitio web (Arquitectura Tecnica)
- Quick Wins document

**Entregables:**

1. `style.css` - Theme header completo
2. `functions.php` - Setup principal
3. `inc/theme-setup.php` - Hooks de WordPress
4. `inc/enqueue-scripts.php` - Carga de assets optimizada
5. `inc/performance-optimizations.php` - Optimizaciones

**Especificaciones Clave:**

```
Theme Name: Dental Rubio Group
Theme URI: https://dentalrubio.com
Description: Senior-friendly theme for dental tourism
Version: 1.0.0
Author: Digital Team
License: GPL v2 or later
Text Domain: dental-rubio
Domain Path: /languages
Requires WordPress: 5.0+
Requires PHP: 7.4+
```

**Configuracion Principal:**

```php
// functions.php - Core setup
add_theme_support('post-thumbnails');
add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
add_theme_support('title-tag');
add_theme_support('custom-logo');
add_theme_support('menus');

// Registrar menus
register_nav_menus([
    'primary' => __('Primary Menu', 'dental-rubio'),
    'footer' => __('Footer Menu', 'dental-rubio'),
    'mobile' => __('Mobile Menu', 'dental-rubio'),
]);

// Remover assets innecesarios
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wlwmanifest_link');
```

**Performance Hooks:**

```php
// Deshabilitar XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Deshabilitar heartbeat para no-admins
function disable_heartbeat() {
    wp_deregister_script('heartbeat');
}
add_action('wp_enqueue_scripts', 'disable_heartbeat');

// Lazy load nativo
add_filter('wp_img_tag_add_loading_attr', '__return_true');
```

**Testing:**
- [ ] Activar theme sin errors
- [ ] Verificar hook ejecutandose
- [ ] Test en staging
- [ ] Backup antes de activar en produccion

---

#### CONVERSACION 2: Sistema de Diseno Senior-Friendly + Tailwind

**Objetivo:** Implementar design system completo optimizado para 55-80 anos

**Inputs Necesarios:**
- Plan del Sitio (Diseno Senior-Friendly)
- Brand colors y especificaciones

**Entregables:**

1. `tailwind.config.js` - Configuracion personalizada
2. `assets/css/base.css` - Variables y resets
3. `assets/css/components.css` - UI components
4. `assets/css/utilities.css` - Helpers
5. `inc/design-system.php` - PHP helpers

**Configuracion Tailwind:**

```javascript
// tailwind.config.js
module.exports = {
  content: [
    './**/*.php',
    './template-parts/**/*.php',
    './page-templates/**/*.php',
  ],
  theme: {
    extend: {
      colors: {
        'navy': '#1e3c72',
        'navy-dark': '#0f1f3d',
        'navy-light': '#3d5a99',
        'gold': '#c9a961',
        'gold-dark': '#8b7a4f',
        'success': '#27ae60',
        'warning': '#f39c12',
        'danger': '#e74c3c',
      },
      fontSize: {
        'xs': ['16px', { lineHeight: '1.6' }],
        'sm': ['18px', { lineHeight: '1.6' }],
        'base': ['20px', { lineHeight: '1.6' }],
        'lg': ['24px', { lineHeight: '1.6' }],
        'xl': ['32px', { lineHeight: '1.4' }],
        '2xl': ['40px', { lineHeight: '1.3' }],
        '3xl': ['48px', { lineHeight: '1.2' }],
      },
      spacing: {
        'gutter': 'clamp(20px, 5vw, 40px)',
      },
      container: {
        center: true,
        padding: 'var(--gutter)',
      },
    },
  },
  plugins: [],
}
```

**Variables CSS:**

```css
/* assets/css/base.css */
:root {
  /* Colors */
  --navy: #1e3c72;
  --navy-dark: #0f1f3d;
  --gold: #c9a961;
  --text: #2c3e50;
  --border: #ecf0f1;

  /* Typography */
  --font-base: 20px;
  --line-height: 1.6;
  --letter-spacing: 0.5px;

  /* Spacing */
  --gutter: clamp(20px, 5vw, 40px);
  --section-gap: clamp(40px, 10vw, 80px);

  /* Breakpoints */
  --bp-sm: 640px;
  --bp-md: 768px;
  --bp-lg: 1024px;
  --bp-xl: 1280px;

  /* Transitions */
  --transition: all 0.3s ease;
}

/* Reset */
* {
  margin: 0;
  padding: 0;
  box-sizing: border-box;
}

html {
  font-size: var(--font-base);
  line-height: var(--line-height);
  scroll-behavior: smooth;
}

body {
  font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif;
  color: var(--text);
  background: #fff;
}

/* Accesibilidad */
@media (prefers-reduced-motion: reduce) {
  * {
    animation-duration: 0.01ms !important;
    transition-duration: 0.01ms !important;
  }
}
```

**Components Base:**

```css
/* assets/css/components.css */

/* Button */
.btn {
  display: inline-block;
  padding: 15px 40px;
  font-size: 18px;
  font-weight: 600;
  text-decoration: none;
  border-radius: 4px;
  transition: var(--transition);
  cursor: pointer;
  border: none;
  min-height: 60px;
  display: flex;
  align-items: center;
  justify-content: center;
}

.btn-primary {
  background: var(--navy);
  color: white;
}

.btn-primary:hover {
  background: var(--navy-dark);
  transform: translateY(-2px);
}

.btn-gold {
  background: var(--gold);
  color: var(--navy);
}

/* Card */
.card {
  background: #f8f9fa;
  padding: 25px;
  border-radius: 8px;
  border-left: 4px solid var(--navy);
  transition: var(--transition);
}

.card:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.15);
}

/* Forms */
input, textarea, select {
  width: 100%;
  padding: 15px;
  font-size: 18px;
  border: 1px solid var(--border);
  border-radius: 4px;
  font-family: inherit;
  margin-bottom: 15px;
}

input:focus, textarea:focus, select:focus {
  outline: none;
  border-color: var(--gold);
  box-shadow: 0 0 0 3px rgba(201, 169, 97, 0.1);
}
```

**Testing:**
- [ ] Tailwind CSS compilando correctamente
- [ ] Colors visibles en sitio
- [ ] Typography sizes correctas
- [ ] Mobile responsive
- [ ] Dark mode accesibilidad (prefers-color-scheme)

---

#### CONVERSACION 3: Header, Navigation & Footer

**Objetivo:** Crear sistema de navegacion simplificado para seniors

**Inputs Necesarios:**
- Estructura Completa del Sitio
- Menu principal (6 items maximo)

**Entregables:**

1. `header.php` - Header principal sticky
2. `template-parts/header/navigation.php` - Menu desktop
3. `template-parts/header/mobile-menu.php` - Menu movil
4. `footer.php` - Footer completo
5. `template-parts/footer/` - Componentes footer

**Header Senior-Friendly:**

```php
<?php // header.php ?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<header class="site-header sticky top-0 z-50 bg-white shadow-sm">
    <div class="container max-w-7xl">
        <div class="flex justify-between items-center py-4">

            <!-- Logo -->
            <div class="logo">
                <?php
                if (has_custom_logo()) {
                    the_custom_logo();
                } else {
                    echo '<h1><a href="' . esc_url(home_url()) . '">' . get_bloginfo('name') . '</a></h1>';
                }
                ?>
            </div>

            <!-- Telefono Prominente (Desktop) -->
            <div class="phone-desktop hidden md:flex items-center gap-3">
                <span class="text-sm text-gray-600">Call 24/7</span>
                <a href="tel:+1928XXX-XXXX" class="text-2xl font-bold text-navy">
                    (928) XXX-XXXX
                </a>
            </div>

            <!-- Menu Principal -->
            <nav class="main-nav hidden md:flex" role="navigation">
                <?php
                wp_nav_menu([
                    'theme_location' => 'primary',
                    'container' => false,
                    'fallback_cb' => 'wp_page_menu',
                    'depth' => 2,
                ]);
                ?>
            </nav>

            <!-- CTAs Desktop -->
            <div class="header-ctas hidden md:flex gap-2">
                <a href="<?php echo esc_url(get_page_link()); ?>#contact"
                   class="btn btn-primary text-sm">
                    Chat Now
                </a>
                <a href="tel:+1928XXX-XXXX" class="btn btn-gold text-sm">
                    Call Now
                </a>
            </div>

            <!-- Hamburger Mobile -->
            <button class="hamburger md:hidden" id="mobileMenuToggle" aria-label="Toggle menu">
                <span></span>
                <span></span>
                <span></span>
            </button>

        </div>
    </div>

    <!-- Mobile Menu -->
    <div id="mobileMenu" class="mobile-menu hidden md:hidden bg-white border-t">
        <?php get_template_part('template-parts/header/mobile-menu'); ?>
    </div>

</header>

<!-- Sticky Phone Button (Mobile Only) -->
<div class="fixed bottom-0 left-0 right-0 md:hidden z-40 bg-navy text-white p-3">
    <a href="tel:+1928XXX-XXXX" class="btn btn-primary w-full">
        Call Now: (928) XXX-XXXX
    </a>
</div>
```

**Footer Completo:**

```php
<?php // footer.php ?>

<footer class="site-footer bg-navy text-white">
    <div class="container max-w-7xl">

        <!-- Footer Content -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-8 py-12">

            <!-- About -->
            <div>
                <h3 class="text-xl font-bold mb-4">Dental Rubio</h3>
                <p class="text-sm">40+ years serving snowbirds and seniors. 51,237+ satisfied patients since 1986.</p>
                <div class="mt-4">
                    <p class="text-gold font-bold">100% Straumann Implants</p>
                </div>
            </div>

            <!-- Quick Links -->
            <div>
                <h4 class="font-bold mb-4">Quick Links</h4>
                <?php
                wp_nav_menu([
                    'theme_location' => 'footer',
                    'container' => false,
                    'depth' => 1,
                    'fallback_cb' => false,
                ]);
                ?>
            </div>

            <!-- Services -->
            <div>
                <h4 class="font-bold mb-4">Services</h4>
                <ul class="space-y-2 text-sm">
                    <li><a href="/dental-implants/">Dental Implants</a></li>
                    <li><a href="/all-on-4/">All-on-4</a></li>
                    <li><a href="/crowns/">Crowns & Bridges</a></li>
                    <li><a href="/dentures/">Dentures</a></li>
                </ul>
            </div>

            <!-- Contact -->
            <div>
                <h4 class="font-bold mb-4">Contact Info</h4>
                <p class="text-sm mb-2"><a href="tel:+1928XXX-XXXX">(928) XXX-XXXX</a></p>
                <p class="text-sm mb-2"><a href="mailto:info@dentalrubio.com">info@dentalrubio.com</a></p>
                <p class="text-sm mb-4">Avenida A 139, Los Algodones</p>
                <p class="text-sm">Mon-Fri 9am-5pm, Sat 9am-2pm MST</p>

                <!-- Social -->
                <div class="flex gap-3 mt-4">
                    <a href="#" class="text-gold">Facebook</a>
                    <a href="#" class="text-gold">Instagram</a>
                    <a href="#" class="text-gold">YouTube</a>
                </div>
            </div>

        </div>

        <!-- Bottom Footer -->
        <div class="border-t border-navy-light py-6">
            <div class="flex justify-between items-center text-sm">
                <p>&copy; 2025 Rubio Dental Group. All rights reserved.</p>
                <div class="space-x-4">
                    <a href="/privacy/">Privacy Policy</a>
                    <a href="/terms/">Terms & Conditions</a>
                </div>
            </div>
        </div>

    </div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
```

**Testing:**
- [ ] Header sticky en scroll
- [ ] Telefono clickeable
- [ ] Menu responsive
- [ ] Mobile menu toggle funciona
- [ ] Footer links funcionales

---

### FASE 2: PAGINAS CORE (Conversaciones 4-6)

#### CONVERSACION 4: Homepage - Parte 1 (Hero + Trust + Calculator)

**Objetivo:** Implementar secciones criticas arriba del fold

**Entregables:**

1. `page-templates/template-homepage.php` - Template principal
2. `template-parts/home/hero.php` - Hero section
3. `template-parts/home/trust-bar.php` - Trust signals
4. `inc/calculators/savings-calculator.php` - Calculadora

**Hero Section:**

```php
<?php // template-parts/home/hero.php ?>
<section class="hero bg-gradient-to-br from-navy to-navy-dark text-white py-20">
    <div class="container max-w-7xl">
        <div class="grid md:grid-cols-2 gap-12 items-center">

            <!-- Text -->
            <div>
                <h1 class="text-4xl md:text-5xl font-bold mb-6 leading-tight">
                    America's Longest-Serving Dentist in Los Algodones
                </h1>
                <p class="text-xl md:text-2xl mb-6 text-gray-100">
                    Trusted by 51,237+ Patients Since 1986
                </p>

                <!-- USPs -->
                <ul class="space-y-3 mb-8">
                    <li class="flex gap-3">
                        <span>✓</span>
                        <span>40 Years of Excellence</span>
                    </li>
                    <li class="flex gap-3">
                        <span>✓</span>
                        <span>100% Straumann Implants (German Quality)</span>
                    </li>
                    <li class="flex gap-3">
                        <span>✓</span>
                        <span>#1 Choice for Snowbirds & Seniors</span>
                    </li>
                    <li class="flex gap-3">
                        <span>✓</span>
                        <span>Save 70% vs USA/Canada Prices</span>
                    </li>
                </ul>

                <!-- CTAs -->
                <div class="flex gap-3 flex-wrap">
                    <a href="tel:+1928XXX-XXXX" class="btn btn-primary">
                        Call Now: (928) XXX-XXXX
                    </a>
                    <a href="#calculator" class="btn bg-gold text-navy">
                        Calculate Your Savings
                    </a>
                </div>
            </div>

            <!-- Image -->
            <div class="hidden md:block">
                <?php
                // Featured image o placeholder
                if (has_post_thumbnail()) {
                    the_post_thumbnail('large', ['class' => 'rounded-lg shadow-xl']);
                }
                ?>
            </div>

        </div>
    </div>
</section>
```

**Trust Bar:**

```php
<?php // template-parts/home/trust-bar.php ?>
<div class="bg-gold/10 border-b border-gold/20">
    <div class="container max-w-7xl py-6">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 text-center">

            <div>
                <p class="text-3xl font-bold text-navy">Trophy</p>
                <p class="font-bold">40+ Years</p>
                <p class="text-sm text-gray-600">Top 5 of 400 Clinics</p>
            </div>

            <div>
                <p class="text-3xl font-bold text-navy">Star</p>
                <p class="font-bold">51,237+ Patients</p>
                <p class="text-sm text-gray-600">4.9/5 Stars</p>
            </div>

            <div>
                <p class="text-3xl font-bold text-navy">Germany</p>
                <p class="font-bold">100% Straumann</p>
                <p class="text-sm text-gray-600">German Quality Only</p>
            </div>

            <div>
                <p class="text-3xl font-bold text-navy">Shuttle</p>
                <p class="font-bold">Free Shuttle</p>
                <p class="text-sm text-gray-600">From Yuma Border</p>
            </div>

        </div>
    </div>
</div>
```

**Calculadora Simple:**

```php
<?php // template-parts/home/calculator.php ?>
<section id="calculator" class="py-16 bg-white">
    <div class="container max-w-3xl">
        <h2 class="text-3xl font-bold text-center mb-12">Calculate Your Savings</h2>

        <form id="savingsCalculator" class="space-y-6">

            <!-- Service Selector -->
            <div>
                <label class="block text-lg font-semibold mb-3">What do you need?</label>
                <select id="service" name="service" class="w-full" required>
                    <option value="">Select a service...</option>
                    <option value="implant">Single Implant</option>
                    <option value="crown">Crown</option>
                    <option value="all-on-4">All-on-4 (per arch)</option>
                    <option value="dentures">Full Dentures</option>
                    <option value="veneers">Veneers (per tooth)</option>
                </select>
            </div>

            <!-- Location Selector -->
            <div>
                <label class="block text-lg font-semibold mb-3">Where do you live?</label>
                <select id="location" name="location" class="w-full" required>
                    <option value="">Select location...</option>
                    <option value="arizona">Arizona</option>
                    <option value="california">California</option>
                    <option value="texas">Texas</option>
                    <option value="canada">Canada</option>
                </select>
            </div>

            <!-- Results -->
            <div id="results" class="hidden bg-green-50 p-6 rounded-lg border-2 border-green-200">
                <h3 class="font-bold text-lg mb-4">Your Results:</h3>
                <div class="space-y-2">
                    <p>In <span id="locationName"></span>: $<span id="usaPrice"></span></p>
                    <p class="font-bold">At Rubio Dental: $<span id="rubioPrice"></span></p>
                    <hr class="my-4">
                    <p class="text-2xl font-bold text-green-600">
                        YOU SAVE: $<span id="savings"></span>
                        (<span id="percentage"></span>%)
                    </p>
                </div>
                <p class="text-sm text-gray-600 mt-4">
                    *Premium Straumann implant included. Lifetime warranty available.
                </p>
                <a href="#contact" class="btn btn-primary w-full mt-4">
                    Get Your Free Quote
                </a>
            </div>

        </form>
    </div>
</section>

<script>
document.getElementById('savingsCalculator').addEventListener('change', function() {
    const service = document.getElementById('service').value;
    const location = document.getElementById('location').value;

    const prices = {
        implant: { arizona: 4500, california: 5000, texas: 4500, canada: 6000 },
        crown: { arizona: 1200, california: 1400, texas: 1200, canada: 1600 },
        'all-on-4': { arizona: 50000, california: 55000, texas: 50000, canada: 65000 },
        dentures: { arizona: 2500, california: 3000, texas: 2500, canada: 3500 },
        veneers: { arizona: 1200, california: 1400, texas: 1200, canada: 1600 },
    };

    const rubioPrice = {
        implant: 1350,
        crown: 350,
        'all-on-4': 9500,
        dentures: 800,
        veneers: 420,
    };

    if (service && location && prices[service] && prices[service][location]) {
        const usaPrice = prices[service][location];
        const rPrice = rubioPrice[service];
        const save = usaPrice - rPrice;
        const percent = Math.round((save / usaPrice) * 100);

        document.getElementById('locationName').textContent = location.charAt(0).toUpperCase() + location.slice(1);
        document.getElementById('usaPrice').textContent = usaPrice.toLocaleString();
        document.getElementById('rubioPrice').textContent = rPrice.toLocaleString();
        document.getElementById('savings').textContent = save.toLocaleString();
        document.getElementById('percentage').textContent = percent;

        document.getElementById('results').classList.remove('hidden');
    }
});
</script>
```

**Testing:**
- [ ] Hero texto visible y legible en movil
- [ ] Calculadora funciona en todos los servicios
- [ ] Valores correctos
- [ ] Links funcionales

---

#### CONVERSACION 5: Homepage - Parte 2 (Services + Testimonials + How It Works)

**Objetivo:** Completar homepage con conversion

**Entregables:**

1. `template-parts/home/services.php` - Featured services
2. `template-parts/home/testimonials.php` - Video carousel
3. `template-parts/home/how-it-works.php` - 3 pasos

**Services Section:**

```php
<?php // template-parts/home/services.php ?>
<section class="py-16 bg-gray-50">
    <div class="container max-w-7xl">
        <h2 class="text-3xl font-bold text-center mb-4">Featured Services</h2>
        <p class="text-center text-gray-600 mb-12">Save up to 70% on premium dental care</p>

        <div class="grid md:grid-cols-4 gap-6">

            <?php
            $services = [
                [
                    'icon' => 'Tooth',
                    'title' => 'Dental Implants',
                    'price' => '$1,350',
                    'save' => 'Save 70%',
                    'url' => '/dental-implants/',
                ],
                [
                    'icon' => 'Crown',
                    'title' => 'Crowns & Bridges',
                    'price' => '$350',
                    'save' => 'Save 75%',
                    'url' => '/crowns/',
                ],
                [
                    'icon' => 'Implant',
                    'title' => 'All-on-4 Implants',
                    'price' => '$9,500',
                    'save' => 'Save $40K',
                    'url' => '/all-on-4/',
                ],
                [
                    'icon' => 'Smile',
                    'title' => 'Dentures',
                    'price' => '$800',
                    'save' => 'Save 68%',
                    'url' => '/dentures/',
                ],
            ];

            foreach ($services as $service):
            ?>
                <div class="card hover:shadow-lg">
                    <p class="text-5xl mb-3"><?php echo $service['icon']; ?></p>
                    <h3 class="text-xl font-bold mb-2"><?php echo $service['title']; ?></h3>
                    <p class="text-2xl font-bold text-gold mb-1"><?php echo $service['price']; ?></p>
                    <p class="text-sm text-green-600 font-semibold mb-4"><?php echo $service['save']; ?></p>
                    <a href="<?php echo esc_url($service['url']); ?>" class="btn btn-primary text-sm w-full">
                        Learn More
                    </a>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>
```

**How It Works:**

```php
<?php // template-parts/home/how-it-works.php ?>
<section class="py-16">
    <div class="container max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-12">How It Works</h2>

        <div class="space-y-6">

            <!-- Step 1 -->
            <div class="flex gap-6">
                <div class="flex-shrink-0">
                    <div class="h-16 w-16 rounded-full bg-navy text-white flex items-center justify-center text-2xl font-bold">
                        1
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2">Get Your Free Quote</h3>
                    <p class="text-gray-600">
                        Call or chat with us. We'll give you exact pricing in 5 minutes.
                        No hidden fees, no surprises.
                    </p>
                </div>
            </div>

            <div class="text-center text-3xl text-gray-400">Down Arrow</div>

            <!-- Step 2 -->
            <div class="flex gap-6">
                <div class="flex-shrink-0">
                    <div class="h-16 w-16 rounded-full bg-navy text-white flex items-center justify-center text-2xl font-bold">
                        2
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2">Schedule Your Visit</h3>
                    <p class="text-gray-600">
                        Choose your date. We'll arrange everything including free transportation
                        from the Yuma border and hotel recommendations.
                    </p>
                </div>
            </div>

            <div class="text-center text-3xl text-gray-400">Down Arrow</div>

            <!-- Step 3 -->
            <div class="flex gap-6">
                <div class="flex-shrink-0">
                    <div class="h-16 w-16 rounded-full bg-navy text-white flex items-center justify-center text-2xl font-bold">
                        3
                    </div>
                </div>
                <div>
                    <h3 class="text-xl font-bold mb-2">Get Your New Smile</h3>
                    <p class="text-gray-600">
                        Arrive, relax, and walk out with a beautiful smile. Many procedures
                        can be completed in one visit.
                    </p>
                </div>
            </div>

        </div>

        <div class="text-center mt-12">
            <a href="#contact" class="btn btn-primary">
                Schedule Now - Next Available: January 15
            </a>
        </div>
    </div>
</section>
```

**Testing:**
- [ ] Services grilla responsive
- [ ] How It Works visual hierarchy
- [ ] CTAs prominentes

---

#### CONVERSACION 6: Homepage - Parte 3 (Safety + Final CTA)

**Objetivo:** Cerrar homepage con trust signals y CTAs fuertes

**Entregables:**

1. `template-parts/home/safety.php` - Safety info
2. `template-parts/home/final-cta.php` - Final CTA section
3. `front-page.php` - Complete homepage template

**Safety Section:**

```php
<?php // template-parts/home/safety.php ?>
<section class="py-16 bg-navy text-white">
    <div class="container max-w-4xl">
        <h2 class="text-3xl font-bold text-center mb-6">Is Los Algodones Safe?</h2>

        <div class="bg-navy-light p-8 rounded-lg mb-8">
            <p class="text-lg mb-6">
                YES. Los Algodones is one of Mexico's safest border towns. Over 3,000 Americans
                visit daily for dental work. Here's why it's safe:
            </p>

            <ul class="grid md:grid-cols-2 gap-4">
                <li class="flex gap-3">
                    <span class="text-2xl">Check</span>
                    <span>Walk across from Yuma in 5 minutes</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-2xl">Check</span>
                    <span>U.S. Border Patrol on-site</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-2xl">Check</span>
                    <span>Well-lit streets & friendly locals</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-2xl">Check</span>
                    <span>Free parking on USA side</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-2xl">Check</span>
                    <span>Most speak English</span>
                </li>
                <li class="flex gap-3">
                    <span class="text-2xl">Check</span>
                    <span>Established tourist infrastructure</span>
                </li>
            </ul>
        </div>

        <div class="text-center">
            <a href="/los-algodones-safety/" class="btn bg-gold text-navy">
                Read Our Complete Safety Guide
            </a>
        </div>
    </div>
</section>
```

**Final CTA:**

```php
<?php // template-parts/home/final-cta.php ?>
<section class="py-20 bg-gradient-to-br from-gold to-gold-dark">
    <div class="container max-w-4xl text-center">
        <h2 class="text-4xl font-bold text-navy mb-6">Ready for Your New Smile?</h2>
        <p class="text-xl text-navy/80 mb-12">
            Join 51,237+ happy patients. Get your free consultation today.
        </p>

        <div class="grid md:grid-cols-3 gap-4">
            <a href="tel:+1928XXX-XXXX" class="btn btn-primary text-lg h-auto py-4">
                Call Now<br><strong>(928) XXX-XXXX</strong>
            </a>
            <a href="#contact" class="btn bg-navy text-white text-lg h-auto py-4">
                Live Chat<br><strong>9am-5pm MST</strong>
            </a>
            <a href="https://wa.me/52XXXXX" class="btn bg-white text-navy text-lg h-auto py-4">
                WhatsApp<br><strong>Message Us</strong>
            </a>
        </div>

        <p class="text-sm text-navy/70 mt-8">
            Habla espanol - English spoken - Parlons francais
        </p>
    </div>
</section>
```

**Complete Homepage Template:**

```php
<?php // front-page.php
get_header();
?>

<main id="main">

    <!-- Hero -->
    <?php get_template_part('template-parts/home/hero'); ?>

    <!-- Trust Bar -->
    <?php get_template_part('template-parts/home/trust-bar'); ?>

    <!-- Why Seniors Trust Us -->
    <section class="py-16">
        <div class="container max-w-7xl">
            <h2 class="text-3xl font-bold text-center mb-12">Why Seniors Trust Us</h2>
            <div class="grid md:grid-cols-4 gap-6">

                <div class="text-center">
                    <p class="text-5xl mb-4">Hospital</p>
                    <h3 class="text-xl font-bold mb-3">40+ Years Serving Snowbirds</h3>
                    <p class="text-gray-600">We've been welcoming winter visitors from USA & Canada since 1986</p>
                </div>

                <div class="text-center">
                    <p class="text-5xl mb-4">Money</p>
                    <h3 class="text-xl font-bold mb-3">Transparent Pricing</h3>
                    <p class="text-gray-600">No hidden fees. Get exact quote before you visit. Guaranteed.</p>
                </div>

                <div class="text-center">
                    <p class="text-5xl mb-4">Speech</p>
                    <h3 class="text-xl font-bold mb-3">English-Speaking Staff</h3>
                    <p class="text-gray-600">Our entire team speaks fluent English. Feel at home here.</p>
                </div>

                <div class="text-center">
                    <p class="text-5xl mb-4">Shield</p>
                    <h3 class="text-xl font-bold mb-3">German Quality Standards</h3>
                    <p class="text-gray-600">We use only Straumann implants from Germany - the world's best</p>
                </div>

            </div>
        </div>
    </section>

    <!-- Calculator -->
    <?php get_template_part('template-parts/home/calculator'); ?>

    <!-- Featured Services -->
    <?php get_template_part('template-parts/home/services'); ?>

    <!-- Patient Stories / Testimonials -->
    <?php get_template_part('template-parts/home/testimonials'); ?>

    <!-- How It Works -->
    <?php get_template_part('template-parts/home/how-it-works'); ?>

    <!-- Safety Info -->
    <?php get_template_part('template-parts/home/safety'); ?>

    <!-- Final CTA -->
    <?php get_template_part('template-parts/home/final-cta'); ?>

</main>

<?php get_footer(); ?>
```

**Testing:**
- [ ] Homepage completa visible
- [ ] Todos los CTAs funcionales
- [ ] Responsive en mobile
- [ ] Velocidad aceptable

---

### FASE 3: PAGINAS DE SERVICIOS (Conversaciones 7-8)

#### CONVERSACION 7: Template de Servicio + Dental Implants Page

**Objetivo:** Crear template reutilizable para servicios con SEO

**Entregables:**

1. `page-templates/template-service.php` - Template reutilizable
2. `template-parts/service/` - Componentes del servicio
3. SQL para crear paginas de servicios

**Service Template:**

```php
<?php // page-templates/template-service.php
/*
 * Template Name: Service Page
 */

get_header();
?>

<main id="main">

    <!-- Hero del Servicio -->
    <?php get_template_part('template-parts/service/hero'); ?>

    <!-- Price Comparison Table -->
    <?php get_template_part('template-parts/service/price-table'); ?>

    <!-- What's Included -->
    <?php get_template_part('template-parts/service/whats-included'); ?>

    <!-- Why Straumann (si aplica) -->
    <?php
    if (get_post_meta(get_the_ID(), '_show_straumann', true)) {
        get_template_part('template-parts/service/why-straumann');
    }
    ?>

    <!-- Process Timeline -->
    <?php get_template_part('template-parts/service/process'); ?>

    <!-- Testimonials -->
    <?php get_template_part('template-parts/service/testimonials'); ?>

    <!-- Gallery -->
    <?php get_template_part('template-parts/service/gallery'); ?>

    <!-- FAQ -->
    <?php get_template_part('template-parts/service/faq'); ?>

    <!-- Final CTA -->
    <section class="py-16 bg-gold/10">
        <div class="container max-w-4xl text-center">
            <h2 class="text-3xl font-bold mb-6">Ready to Get Started?</h2>
            <div class="flex gap-4 justify-center flex-wrap">
                <a href="tel:+1928XXX-XXXX" class="btn btn-primary">
                    Call Now
                </a>
                <a href="#contact" class="btn bg-gold text-navy">
                    Get Free Quote
                </a>
            </div>
        </div>
    </section>

</main>

<?php get_footer(); ?>
```

**Service Hero:**

```php
<?php // template-parts/service/hero.php ?>
<section class="bg-gradient-to-br from-navy to-navy-dark text-white py-16">
    <div class="container max-w-4xl">
        <h1 class="text-4xl md:text-5xl font-bold mb-6">
            <?php the_title(); ?>
        </h1>

        <p class="text-xl md:text-2xl mb-6 opacity-90">
            <?php echo get_post_meta(get_the_ID(), '_subtitle', true); ?>
        </p>

        <!-- Key Metrics -->
        <div class="grid md:grid-cols-3 gap-6 mb-12">
            <div>
                <p class="text-3xl font-bold text-gold mb-2">
                    <?php echo get_post_meta(get_the_ID(), '_price', true); ?>
                </p>
                <p class="text-sm">Starting Price</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-gold mb-2">
                    <?php echo get_post_meta(get_the_ID(), '_save_percent', true); ?>%
                </p>
                <p class="text-sm">Save vs USA</p>
            </div>
            <div>
                <p class="text-3xl font-bold text-gold mb-2">
                    1-7
                </p>
                <p class="text-sm">Visits Required</p>
            </div>
        </div>

        <!-- CTA -->
        <div class="flex gap-4 flex-wrap">
            <a href="tel:+1928XXX-XXXX" class="btn btn-primary">
                Call for Quote
            </a>
            <a href="#contact" class="btn bg-white text-navy">
                Chat with Us
            </a>
        </div>
    </div>
</section>
```

**Price Table:**

```php
<?php // template-parts/service/price-table.php ?>
<section class="py-16">
    <div class="container max-w-4xl">
        <h2 class="text-3xl font-bold mb-8">Price Comparison</h2>

        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-navy text-white">
                    <tr>
                        <th class="p-4 text-left">Procedure</th>
                        <th class="p-4 text-right">USA Price</th>
                        <th class="p-4 text-right">Rubio Price</th>
                        <th class="p-4 text-right">You Save</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $pricing = get_post_meta(get_the_ID(), '_pricing_table', true);
                    if ($pricing):
                        foreach ($pricing as $row):
                    ?>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-semibold"><?php echo $row['procedure']; ?></td>
                            <td class="p-4 text-right">$<?php echo number_format($row['usa']); ?></td>
                            <td class="p-4 text-right font-bold text-gold">$<?php echo number_format($row['rubio']); ?></td>
                            <td class="p-4 text-right text-green-600 font-bold">
                                $<?php echo number_format($row['usa'] - $row['rubio']); ?>
                            </td>
                        </tr>
                    <?php
                        endforeach;
                    endif;
                    ?>
                </tbody>
            </table>
        </div>

        <p class="text-sm text-gray-600 mt-4">
            *Straumann implants included. No hidden fees. Exact quote guaranteed.
        </p>
    </div>
</section>
```

**What's Included:**

```php
<?php // template-parts/service/whats-included.php ?>
<section class="py-16 bg-gray-50">
    <div class="container max-w-4xl">
        <h2 class="text-3xl font-bold mb-8">What's Included in Your Package</h2>

        <div class="grid md:grid-cols-2 gap-8">
            <?php
            $included = get_post_meta(get_the_ID(), '_what_included', true);
            if ($included):
                foreach ($included as $item):
            ?>
                <div class="flex gap-3">
                    <span class="text-2xl text-green-600 flex-shrink-0">Check</span>
                    <div>
                        <p class="font-semibold"><?php echo $item['title']; ?></p>
                        <p class="text-sm text-gray-600"><?php echo $item['description']; ?></p>
                    </div>
                </div>
            <?php
                endforeach;
            endif;
            ?>
        </div>
    </div>
</section>
```

**Testing:**
- [ ] Template carga correctamente
- [ ] Meta fields guardandose
- [ ] Tablas responsive
- [ ] SEO friendly

---

#### CONVERSACION 8: All-on-4 Page + Servicios Adicionales

**Objetivo:** Implementar pagina prioritaria All-on-4 + setup para demas servicios

**Entregables:**

1. Page para All-on-4 con calculadora integrada
2. Pages para Crowns, Dentures, Cosmetic
3. SQL para insertar todos los servicios
4. Schema markup medico

**All-on-4 Custom Fields:**

```php
<?php
// Ejemplo de data para All-on-4
$all_on_4_data = [
    'title' => 'All-on-4 Dental Implants',
    'subtitle' => 'Complete Smile Restoration | Premium Straumann | Save $40,000+',
    'price' => '$9,500 per arch',
    'save_percent' => '81',
    'what_included' => [
        [
            'title' => '4 Straumann Implants',
            'description' => 'Premium German implants with lifetime warranty'
        ],
        [
            'title' => 'Temporary Teeth (Same Day)',
            'description' => 'Walk out smiling on day one'
        ],
        [
            'title' => 'Final Prosthesis',
            'description' => 'Custom-crafted dental prosthesis'
        ],
        [
            'title' => 'All X-rays & 3D Scans',
            'description' => 'Advanced imaging for precision placement'
        ],
        [
            'title' => '1-Year Follow-ups',
            'description' => 'Complete post-treatment support'
        ],
        [
            'title' => 'Lifetime Warranty',
            'description' => 'Straumann implant warranty coverage'
        ],
    ],
    'process' => [
        [
            'step' => 1,
            'title' => 'Consultation & Planning',
            'duration' => '2-3 hours',
            'description' => 'Initial consultation, X-rays, 3D scan, treatment planning'
        ],
        [
            'step' => 2,
            'title' => 'Implant Placement',
            'duration' => '4-5 hours',
            'description' => 'Surgical placement of 4 implants, temporary teeth same day'
        ],
        [
            'step' => 3,
            'title' => 'Healing & Integration',
            'duration' => '3-6 months',
            'description' => 'Bone integration period with periodic check-ups'
        ],
        [
            'step' => 4,
            'title' => 'Final Prosthesis',
            'duration' => '1-2 hours',
            'description' => 'Custom final teeth placement and adjustment'
        ],
    ],
];
?>
```

**Service Creation SQL:**

```sql
-- Insert All-on-4 Service Page
INSERT INTO wp_posts (post_title, post_content, post_type, post_status, post_author, page_template)
VALUES ('All-on-4 Dental Implants', '[description here]', 'page', 'publish', 1, 'page-templates/template-service.php');

-- Insert Additional Services
INSERT INTO wp_posts (post_title, post_content, post_type, post_status, post_author, page_template) VALUES
('Dental Crowns & Bridges', '[content]', 'page', 'publish', 1, 'page-templates/template-service.php'),
('Dentures', '[content]', 'page', 'publish', 1, 'page-templates/template-service.php'),
('Cosmetic Dentistry', '[content]', 'page', 'publish', 1, 'page-templates/template-service.php'),
('Same-Day Implants', '[content]', 'page', 'publish', 1, 'page-templates/template-service.php');

-- Add meta for All-on-4
INSERT INTO wp_postmeta (post_id, meta_key, meta_value) VALUES
(POST_ID, '_price', '$9,500'),
(POST_ID, '_save_percent', '81'),
(POST_ID, '_show_straumann', '1');
```

**Medical Schema Markup:**

```php
<?php // inc/seo/schema-markup.php - Agrega al <head> ?>

function dental_rubio_medical_schema() {
    $schema = [
        '@context' => 'https://schema.org',
        '@type' => 'MedicalBusiness',
        'name' => 'Rubio Dental Group',
        'url' => home_url(),
        'telephone' => get_theme_mod('phone_number'),
        'address' => [
            '@type' => 'PostalAddress',
            'streetAddress' => 'Avenida A 139',
            'addressLocality' => 'Los Algodones',
            'addressRegion' => 'Baja California',
            'postalCode' => '21970',
            'addressCountry' => 'MX',
        ],
        'geo' => [
            '@type' => 'GeoCoordinates',
            'latitude' => '32.7088',
            'longitude' => '-114.7241',
        ],
        'aggregateRating' => [
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '1200',
            'bestRating' => '5',
            'worstRating' => '1',
        ],
        'foundingDate' => '1986',
        'description' => '40+ years serving snowbirds and seniors. 51,237+ patients. 100% Straumann implants.',
        'openingHoursSpecification' => [
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'],
                'opens' => '09:00',
                'closes' => '17:00',
            ],
            [
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens' => '09:00',
                'closes' => '14:00',
            ],
        ],
    ];

    echo '<script type="application/ld+json">' . wp_json_encode($schema) . '</script>';
}
add_action('wp_head', 'dental_rubio_medical_schema');
```

**Testing:**
- [ ] Todas las paginas de servicios creadas
- [ ] Schema markup visible en codigo fuente
- [ ] Calculadora All-on-4 funciona
- [ ] SEO on-page optimizado

---

### FASE 4: CONTENT HUBS & CALCULADORAS (Conversaciones 9-10)

*(Condensado por espacio)*

#### CONVERSACION 9: Suite de Calculadoras Interactivas

**6 Calculadoras a Implementar:**

1. Savings Calculator (USA vs Mexico) - Basic
2. All-on-4 Cost Calculator - Interactive
3. Straumann vs Chinese Comparison - Educational
4. Total Trip Cost (Dental + Hotel + Transport) - Vacation
5. Payment Plan Calculator - Financing
6. 15-Year ROI Calculator - Long-term analysis

**Estructura base para cada calculadora:**

```javascript
// assets/js/calculators.js
class DentalCalculator {
    constructor(formId, resultsId) {
        this.form = document.getElementById(formId);
        this.results = document.getElementById(resultsId);
        this.init();
    }

    init() {
        if (this.form) {
            this.form.addEventListener('change', () => this.calculate());
        }
    }

    calculate() {
        // Override en cada calculadora
    }

    displayResults(data) {
        this.results.innerHTML = `
            <div class="results-card">
                <h3>Your Results</h3>
                ${this.buildResultsHTML(data)}
            </div>
        `;
        this.results.classList.remove('hidden');
        this.emailResults(data);
    }

    emailResults(data) {
        // Optional email capture
    }
}

// Instancia para cada calculadora
new DentalCalculator('savingsCalculator', 'savingsResults');
new DentalCalculator('allOn4Calculator', 'allOn4Results');
// etc...
```

---

#### CONVERSACION 10: Hub Pages (Snowbirds + Travel Guide)

**5 Hub Pages Crear:**

1. `/snowbirds/` - Snowbird Resource Center
2. `/travel-guide/` - Los Algodones Travel Guide
3. `/pricing/` - Pricing & Cost Information
4. `/dental-implants-guide/` - Implant Education Center
5. `/los-algodones-dentists/` - Dentist Reviews Directory

**Template para hubs:**

```php
<?php // page-templates/template-hub.php
/*
 * Template Name: Hub Page
 */

get_header();
?>

<main id="main">

    <!-- Intro Section -->
    <?php get_template_part('template-parts/hub/intro'); ?>

    <!-- Articles Grid -->
    <section class="py-16">
        <div class="container max-w-7xl">
            <?php get_template_part('template-parts/hub/articles-grid'); ?>
        </div>
    </section>

    <!-- Sidebar CTA -->
    <aside class="py-16 bg-gold/10">
        <?php get_template_part('template-parts/hub/cta-section'); ?>
    </aside>

</main>

<?php get_footer(); ?>
```

**Testing:**
- [ ] Todas las calculadoras funcionales
- [ ] Hub pages con grid de articulos
- [ ] Internal linking estructura
- [ ] SEO optimizado

---

### FASE 5: INTEGRACIONES & CONVERSION (Conversaciones 11-12)

#### CONVERSACION 11: Formularios + CRM + WhatsApp

**Entregables:**

1. `inc/forms/contact-form.php` - Formulario optimizado
2. `inc/integrations/whatsapp-widget.php` - Widget WhatsApp
3. `inc/integrations/crm-webhook.php` - Webhook a CRM
4. `inc/integrations/email-autoresponder.php` - Emails automaticos

**Contact Form Optimized:**

```php
<?php // inc/forms/contact-form.php ?>

function dental_rubio_contact_form() {
    if ($_POST && wp_verify_nonce($_POST['nonce'], 'contact_form')) {
        $name = sanitize_text_field($_POST['name']);
        $email = sanitize_email($_POST['email']);
        $phone = sanitize_text_field($_POST['phone']);
        $service = sanitize_text_field($_POST['service']);

        // Save to CRM
        do_action('dental_rubio_lead_created', [
            'name' => $name,
            'email' => $email,
            'phone' => $phone,
            'service' => $service,
            'source' => 'contact_form',
            'date' => current_time('mysql'),
        ]);

        // Send email
        wp_mail(
            get_option('admin_email'),
            "New Dental Lead: $name",
            "Name: $name\nEmail: $email\nPhone: $phone\nService: $service"
        );

        // Send auto-response
        wp_mail(
            $email,
            'We Received Your Request - Dental Rubio',
            $this->get_autoresponse_email($name)
        );

        wp_send_json_success(['message' => 'Thank you! We\'ll call you within 2 hours.']);
    }
}

function get_autoresponse_email($name) {
    return "Hi $name,\n\nThank you for contacting Dental Rubio. We received your request and will call you within 2 hours.\n\nHere's your free price list: [link]\n\nBest regards,\nDental Rubio Team";
}

add_action('wp_ajax_contact_form', 'dental_rubio_contact_form');
add_action('wp_ajax_nopriv_contact_form', 'dental_rubio_contact_form');
?>
```

**WhatsApp Widget:**

```php
<?php // inc/integrations/whatsapp-widget.php ?>

function dental_rubio_whatsapp_widget() {
    $phone = get_theme_mod('whatsapp_number', '52XXXXXXXXX');
    ?>
    <div id="whatsappWidget" class="fixed bottom-24 right-4 z-40 md:bottom-4">
        <a href="https://wa.me/<?php echo $phone; ?>?text=Hi%20I%27m%20interested%20in%20dental%20implants"
           target="_blank"
           class="flex items-center justify-center w-16 h-16 bg-green-500 text-white rounded-full shadow-lg hover:shadow-xl transition">
            <span class="text-2xl">Chat</span>
        </a>
        <div class="absolute bottom-20 right-0 bg-white text-sm text-gray-800 p-3 rounded shadow-lg max-w-xs hidden" id="whatsappTooltip">
            Message us on WhatsApp for instant response!
        </div>
    </div>
    <script>
        document.getElementById('whatsappWidget').addEventListener('mouseenter', () => {
            document.getElementById('whatsappTooltip').classList.remove('hidden');
        });
        document.getElementById('whatsappWidget').addEventListener('mouseleave', () => {
            document.getElementById('whatsappTooltip').classList.add('hidden');
        });
    </script>
    <?php
}
add_action('wp_footer', 'dental_rubio_whatsapp_widget');
```

---

#### CONVERSACION 12: Tracking, Analytics & SEO

**Entregables:**

1. `inc/tracking/gtm-setup.php` - Google Tag Manager
2. `inc/tracking/facebook-pixel.php` - FB Pixel
3. `inc/seo/schema-markup.php` - Structured data
4. `inc/seo/sitemap-generator.php` - XML sitemap

---

### FASE 6: OPTIMIZACIONES & PULIDO (Conversaciones 13-15)

#### CONVERSACION 13-15: Performance, Mobile, Testing

**Objetivos:**
- PageSpeed 85+ score
- Mobile optimization completa
- Cross-browser testing
- Accesibilidad WCAG AAA
- Final documentation

---

## ESPECIFICACIONES TECNICAS

### Performance Checklist

```
[ ] PageSpeed Score Target: 85+
   - LCP: <2.5s
   - FID: <100ms
   - CLS: <0.1

[ ] Mobile Optimization
   - Responsive design
   - Touch targets 48px+
   - Viewport configured

[ ] Accesibilidad
   - WCAG AAA contrast
   - Keyboard navigation
   - Screen reader compatible

[ ] SEO
   - Meta tags optimizados
   - Schema markup completo
   - XML sitemap
   - Robots.txt

[ ] Seguridad
   - SSL/HTTPS activo
   - Inputs sanitizados
   - CSRF tokens
   - SQL injection prevention
```

### Browser Support

```
Chrome 90+
Firefox 88+
Safari 14+
Edge 90+
Mobile browsers (iOS Safari, Chrome Mobile)
```

---

## CODIGO BASE

### style.css - Theme Header

```css
/*
Theme Name: Dental Rubio Group
Theme URI: https://dentalrubio.com
Description: Senior-friendly dental theme for WordPress
Version: 1.0.0
Author: Digital Team
Author URI: https://dentalrubio.com
License: GPL v2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: dental-rubio
Domain Path: /languages
Requires PHP: 7.4
Requires WordPress: 5.0
*/

/*
 * Dental Rubio Group - Theme Stylesheet
 * Optimized for seniors, performance, and conversions
 *
 * Structure:
 * 1. Variables & Base
 * 2. Typography
 * 3. Layout & Spacing
 * 4. Components
 * 5. Pages
 * 6. Media Queries
 */

@import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap');
@tailwind base;
@tailwind components;
@tailwind utilities;
```

### functions.php - Core Setup

```php
<?php
/**
 * Dental Rubio Group - Theme Functions
 */

// Define constants
define('DENTAL_RUBIO_VERSION', '1.0.0');
define('DENTAL_RUBIO_DIR', get_template_directory());
define('DENTAL_RUBIO_URI', get_template_directory_uri());

// Setup theme
function dental_rubio_setup() {
    // Add language support
    load_theme_textdomain('dental-rubio', DENTAL_RUBIO_DIR . '/languages');

    // Add theme support
    add_theme_support('post-thumbnails');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption']);
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('responsive-embeds');

    // Register menus
    register_nav_menus([
        'primary' => __('Primary Menu', 'dental-rubio'),
        'footer' => __('Footer Menu', 'dental-rubio'),
    ]);
}
add_action('after_setup_theme', 'dental_rubio_setup');

// Enqueue scripts and styles
function dental_rubio_scripts() {
    // CSS
    wp_enqueue_style('dental-rubio-styles', DENTAL_RUBIO_URI . '/assets/css/main.css', [], DENTAL_RUBIO_VERSION);

    // JS
    wp_enqueue_script('dental-rubio-main', DENTAL_RUBIO_URI . '/assets/js/main.js', ['jquery'], DENTAL_RUBIO_VERSION, true);

    // Localize script for AJAX
    wp_localize_script('dental-rubio-main', 'dentalRubio', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
        'nonce' => wp_create_nonce('dental-rubio'),
    ]);
}
add_action('wp_enqueue_scripts', 'dental_rubio_scripts');

// Remove unnecessary scripts
function dental_rubio_remove_scripts() {
    wp_deregister_script('jquery-migrate');
    remove_action('wp_head', 'print_emoji_detection_script', 7);
    remove_action('wp_print_styles', 'print_emoji_styles');
}
add_action('init', 'dental_rubio_remove_scripts');

// Disable XML-RPC
add_filter('xmlrpc_enabled', '__return_false');

// Disable heartbeat for front-end
if (!is_admin()) {
    wp_deregister_script('heartbeat');
}

// Load includes
require_once DENTAL_RUBIO_DIR . '/inc/theme-setup.php';
require_once DENTAL_RUBIO_DIR . '/inc/enqueue-scripts.php';
require_once DENTAL_RUBIO_DIR . '/inc/performance-optimizations.php';
require_once DENTAL_RUBIO_DIR . '/inc/seo/schema-markup.php';
```

---

## CHECKLIST DE IMPLEMENTACION

### Pre-Launch (Antes de activar)

- [ ] WordPress actualizado a ultima version
- [ ] Todos los plugins instalados
- [ ] Backup completo realizado
- [ ] Staging site creado
- [ ] Theme activado en staging
- [ ] Pruebas en todos los browsers
- [ ] Mobile responsive verificado
- [ ] Forms funcionando
- [ ] Email autoresponder configurado
- [ ] Analytics conectado
- [ ] Google Search Console configurado
- [ ] SEO on-page completado
- [ ] Performance testing (PageSpeed 75+)

### Post-Launch (Primeras 48 horas)

- [ ] Monitoreo 24/7
- [ ] Llamadas a primeros 10 leads (QA)
- [ ] Velocidad en diferentes conexiones
- [ ] Forms submitiendo correctamente
- [ ] Emails entregandose
- [ ] Analytics tracking funcional
- [ ] Phone clicks registrandose
- [ ] WhatsApp widget funcionando
- [ ] Sitemap en Search Console
- [ ] Mobile testing en dispositivos reales

### Optimizacion (Semana 1-2)

- [ ] A/B testing de CTAs
- [ ] Heatmaps analysis (Hotjar)
- [ ] CRO improvements
- [ ] SEO quick wins
- [ ] Content optimization
- [ ] Calculator fine-tuning

---

## PROXIMOS PASOS INMEDIATOS

### ESTA SEMANA

```
DIA 1:
[ ] Aprobar este plan
[ ] Setup staging environment
[ ] Backup completo del sitio actual

DIA 2-3:
[ ] CONVERSACION 1: Setup base theme
[ ] Instalar WP Rocket + ShortPixel
[ ] Cloudflare Free setup

DIA 4-5:
[ ] CONVERSACION 2: Design system
[ ] Tailwind CSS configuration
[ ] Color palette implementation

DIA 6-7:
[ ] CONVERSACION 3: Header + Footer
[ ] Navigation system
[ ] Mobile menu
```

### PROXIMAS 2 SEMANAS

- Conversaciones 4-6: Homepage completa
- Quick wins: Messaging, phone prominence, speed
- Test en staging
- Feedback y ajustes

### PROXIMO MES

- Conversaciones 7-12: Todas las paginas
- Calculadoras funcionando
- Integraciones completas
- SEO on-page

### LANZAMIENTO (Semana 4)

- Conversaciones 13-15: Final polish
- Performance optimization
- Testing completo
- Launch a produccion
- Monitoring 24/7

---

## SOPORTE Y MANTENIMIENTO POST-LAUNCH

### Mensual
- Actualizaciones de WordPress
- Plugin updates
- Security patches
- Performance monitoring
- Content updates

### Trimestral
- SEO audit
- Conversion rate analysis
- A/B testing review
- Calculadora accuracy check
- Testimonial generation

### Anual
- Full site audit
- Design refresh evaluation
- Technology stack review
- ROI analysis

---

## PREGUNTAS FRECUENTES

**P: Por que no usar un theme builder como Elementor?**
R: Elementor es pesado (100KB+ CSS/JS). Un tema custom ligero te da 3-4x mas velocidad con mismo resultado.

**P: Que pasa si WP Rocket no es suficiente para PageSpeed 85?**
R: Usamos BunnyCDN + Cloudflare como backup. Ese combo garantiza 85+ en 99% de casos.

**P: Como manejar updates de WordPress sin romper el theme?**
R: Versionamos todo, hacemos backups antes de updates, y tenemos staging para testing.

**P: Los formularios guardan en WordPress o en CRM externo?**
R: Opcion dual: WordPress (como backup) + CRM webhook (Chawoora/HubSpot) en tiempo real.

---

## CONTACTO Y ESCALATION

Para problemas durante implementacion:

1. Revisar checklist de la conversacion actual
2. Ejecutar testing nuevamente
3. Consultar seccion de troubleshooting
4. Escanear con herramientas (GTmetrix, WAVE, SEMrush)
5. Documentar issue y screenshot
6. Reportar al equipo

---

**Documento Completo Preparado para Claude Code**
**Inicio: Conversacion 1 - Setup Base del Theme**
**Duracion Total: 21-29 horas**
**Resultado Final: Theme WordPress Production-Ready**

---

*Plan maestro consolidado para Dental Rubio Group - Digital Transformation 2025*
