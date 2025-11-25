<?php
/**
 * Schema.org Structured Data
 * Adds JSON-LD markup for better SEO
 *
 * @package DentalRubio
 * @version 1.0.0
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Add MedicalBusiness schema to all pages
 */
function dental_rubio_medical_business_schema() {
    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'Dentist',
        '@id' => home_url() . '#organization',
        'name' => 'Dental Rubio Group',
        'alternateName' => 'Rubio Dental',
        'url' => home_url(),
        'logo' => array(
            '@type' => 'ImageObject',
            'url' => get_theme_mod('custom_logo') ? wp_get_attachment_url(get_theme_mod('custom_logo')) : '',
        ),
        'telephone' => dental_rubio_get_phone(),
        'priceRange' => '$$',
        'address' => array(
            '@type' => 'PostalAddress',
            'streetAddress' => 'Avenida A 139',
            'addressLocality' => 'Los Algodones',
            'addressRegion' => 'Baja California',
            'postalCode' => '21970',
            'addressCountry' => 'MX',
        ),
        'geo' => array(
            '@type' => 'GeoCoordinates',
            'latitude' => '32.7088',
            'longitude' => '-114.7241',
        ),
        'openingHoursSpecification' => array(
            array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => array('Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday'),
                'opens' => '08:00',
                'closes' => '17:00',
            ),
            array(
                '@type' => 'OpeningHoursSpecification',
                'dayOfWeek' => 'Saturday',
                'opens' => '09:00',
                'closes' => '13:00',
            ),
        ),
        'aggregateRating' => array(
            '@type' => 'AggregateRating',
            'ratingValue' => '4.9',
            'reviewCount' => '2847',
            'bestRating' => '5',
            'worstRating' => '1',
        ),
        'foundingDate' => '1986',
        'slogan' => '40+ Years Serving Snowbirds & Seniors',
        'description' => 'Premium dental care in Los Algodones, Mexico. 40+ years experience, 51,237+ patients served. 100% Straumann implants with lifetime warranty. Save up to 70% vs USA/Canada prices.',
        'sameAs' => array(
            // Add social media URLs here
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'dental_rubio_medical_business_schema');

/**
 * Add WebSite schema with search action
 */
function dental_rubio_website_schema() {
    if (!is_front_page()) {
        return;
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'WebSite',
        '@id' => home_url() . '#website',
        'url' => home_url(),
        'name' => get_bloginfo('name'),
        'description' => get_bloginfo('description'),
        'publisher' => array(
            '@id' => home_url() . '#organization',
        ),
        'potentialAction' => array(
            '@type' => 'SearchAction',
            'target' => array(
                '@type' => 'EntryPoint',
                'urlTemplate' => home_url('/?s={search_term_string}'),
            ),
            'query-input' => 'required name=search_term_string',
        ),
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'dental_rubio_website_schema');

/**
 * Add Service schema for service pages
 */
function dental_rubio_service_schema() {
    if (!is_page_template('page-templates/template-service.php')) {
        return;
    }

    $price = get_post_meta(get_the_ID(), '_service_price', true);
    $subtitle = get_post_meta(get_the_ID(), '_service_subtitle', true);

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'MedicalProcedure',
        'name' => get_the_title(),
        'description' => $subtitle ?: get_the_excerpt(),
        'provider' => array(
            '@id' => home_url() . '#organization',
        ),
    );

    if ($price) {
        $schema['offers'] = array(
            '@type' => 'Offer',
            'price' => str_replace(['$', ','], '', $price),
            'priceCurrency' => 'USD',
            'availability' => 'https://schema.org/InStock',
        );
    }

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'dental_rubio_service_schema');

/**
 * Add Breadcrumb schema
 */
function dental_rubio_breadcrumb_schema() {
    if (is_front_page()) {
        return;
    }

    $items = array();
    $position = 1;

    // Home
    $items[] = array(
        '@type' => 'ListItem',
        'position' => $position++,
        'name' => 'Home',
        'item' => home_url(),
    );

    // Add current page
    if (is_singular()) {
        $items[] = array(
            '@type' => 'ListItem',
            'position' => $position++,
            'name' => get_the_title(),
            'item' => get_permalink(),
        );
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => $items,
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'dental_rubio_breadcrumb_schema');

/**
 * Add FAQ schema for pages with FAQs
 */
function dental_rubio_faq_schema() {
    // Get FAQs from custom field
    $faqs = get_post_meta(get_the_ID(), '_service_faqs', true);

    if (empty($faqs)) {
        return;
    }

    $faq_items = array();

    foreach ($faqs as $faq) {
        $faq_items[] = array(
            '@type' => 'Question',
            'name' => $faq['question'],
            'acceptedAnswer' => array(
                '@type' => 'Answer',
                'text' => $faq['answer'],
            ),
        );
    }

    $schema = array(
        '@context' => 'https://schema.org',
        '@type' => 'FAQPage',
        'mainEntity' => $faq_items,
    );

    echo '<script type="application/ld+json">' . wp_json_encode($schema, JSON_UNESCAPED_SLASHES) . '</script>' . "\n";
}
add_action('wp_head', 'dental_rubio_faq_schema');
