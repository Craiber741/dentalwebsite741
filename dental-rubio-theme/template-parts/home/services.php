<?php
/**
 * Featured Services Section
 * Displays core dental services with prices and savings
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Define featured services
$services = array(
    array(
        'title' => 'Dental Implants',
        'price' => '$1,350',
        'save' => 'Save 70%',
        'description' => '100% Straumann German quality with lifetime warranty',
        'url' => '/dental-implants/',
        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
    ),
    array(
        'title' => 'Crowns & Bridges',
        'price' => '$350',
        'save' => 'Save 75%',
        'description' => 'Porcelain and zirconia options available',
        'url' => '/crowns/',
        'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'
    ),
    array(
        'title' => 'All-on-4 Implants',
        'price' => '$9,500',
        'save' => 'Save $40,000+',
        'description' => 'Complete smile restoration in one visit',
        'url' => '/all-on-4/',
        'icon' => 'M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z'
    ),
    array(
        'title' => 'Full Dentures',
        'price' => '$800',
        'save' => 'Save 68%',
        'description' => 'Custom-fitted for maximum comfort',
        'url' => '/dentures/',
        'icon' => 'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'
    ),
    array(
        'title' => 'Veneers',
        'price' => '$420',
        'save' => 'Save 65%',
        'description' => 'Transform your smile with porcelain veneers',
        'url' => '/veneers/',
        'icon' => 'M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z'
    ),
    array(
        'title' => 'Root Canals',
        'price' => '$180',
        'save' => 'Save 82%',
        'description' => 'Pain-free treatment with modern techniques',
        'url' => '/root-canal/',
        'icon' => 'M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z'
    ),
);
?>

<section class="featured-services py-16 md:py-20 bg-gray-50">
    <div class="container mx-auto px-4 max-w-7xl">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                Our Featured Services
            </h2>
            <p class="text-lg md:text-xl text-gray-600 max-w-2xl mx-auto">
                Premium dental care with German quality materials at up to 70% savings
            </p>
        </div>

        <!-- Services Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 md:gap-8">

            <?php foreach ($services as $service): ?>
                <div class="service-card bg-white rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 overflow-hidden border border-gray-100">

                    <!-- Card Header with Icon -->
                    <div class="bg-gradient-to-br from-blue-600 to-blue-700 p-6 text-white">
                        <svg class="w-12 h-12 md:w-14 md:h-14 mb-3 mx-auto" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="<?php echo esc_attr($service['icon']); ?>"></path>
                        </svg>
                        <h3 class="text-xl md:text-2xl font-bold text-center">
                            <?php echo esc_html($service['title']); ?>
                        </h3>
                    </div>

                    <!-- Card Body -->
                    <div class="p-6">
                        <!-- Price -->
                        <div class="text-center mb-4">
                            <p class="text-xs text-gray-500 mb-1">Starting at</p>
                            <p class="text-3xl md:text-4xl font-bold text-blue-900 mb-2">
                                <?php echo esc_html($service['price']); ?>
                            </p>
                            <span class="inline-block bg-green-100 text-green-800 text-sm font-bold px-4 py-1 rounded-full">
                                <?php echo esc_html($service['save']); ?>
                            </span>
                        </div>

                        <!-- Description -->
                        <p class="text-gray-600 text-center mb-6 text-sm md:text-base">
                            <?php echo esc_html($service['description']); ?>
                        </p>

                        <!-- CTA Button -->
                        <a href="<?php echo esc_url($service['url']); ?>"
                           class="block w-full bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold text-center py-3 px-6 rounded-lg shadow hover:shadow-lg transition-all duration-200 transform hover:scale-105">
                            Learn More →
                        </a>
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- View All Services Link -->
        <div class="text-center mt-12">
            <a href="/services/"
               class="inline-flex items-center justify-center px-8 py-4 bg-blue-900 hover:bg-blue-800 text-white font-bold text-lg rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                View All Services
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

    </div>
</section>
