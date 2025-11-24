<?php
/**
 * Service What's Included Section
 * Displays what's included in the service package
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get included items from custom fields
$included_items = get_post_meta(get_the_ID(), '_service_whats_included', true);

// Default items if not set
if (empty($included_items)) {
    $included_items = array(
        array(
            'title' => 'Initial Consultation',
            'description' => 'Complete examination and treatment plan'
        ),
        array(
            'title' => 'X-Rays & Diagnostics',
            'description' => 'Digital imaging and 3D scans if needed'
        ),
        array(
            'title' => 'Premium Materials',
            'description' => 'High-quality materials meeting US standards'
        ),
        array(
            'title' => 'Follow-up Care',
            'description' => 'Post-treatment check-ups included'
        )
    );
}

if (empty($included_items)) {
    return;
}
?>

<section class="whats-included py-12 md:py-16 bg-gradient-to-br from-gray-50 to-white">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                What's Included in Your Package
            </h2>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                Everything you need for successful treatment, with no hidden costs
            </p>
        </div>

        <!-- Items Grid -->
        <div class="grid md:grid-cols-2 gap-6 md:gap-8 mb-10">
            <?php foreach ($included_items as $item): ?>
                <div class="flex gap-4 bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                    <!-- Checkmark Icon -->
                    <div class="flex-shrink-0">
                        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center">
                            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                            </svg>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1">
                        <h3 class="text-lg md:text-xl font-bold text-gray-900 mb-2">
                            <?php echo esc_html($item['title']); ?>
                        </h3>
                        <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                            <?php echo esc_html($item['description']); ?>
                        </p>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Additional Benefits -->
        <div class="bg-blue-900 text-white rounded-xl p-6 md:p-8 shadow-xl">
            <h3 class="text-xl md:text-2xl font-bold mb-6 text-center">
                Plus These Exclusive Benefits
            </h3>
            <div class="grid md:grid-cols-3 gap-6">
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                    <p class="font-bold text-lg mb-1">Free Shuttle</p>
                    <p class="text-sm text-blue-100">From Yuma border crossing</p>
                </div>
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <p class="font-bold text-lg mb-1">Warranty Available</p>
                    <p class="text-sm text-blue-100">Lifetime warranty on implants</p>
                </div>
                <div class="text-center">
                    <svg class="w-12 h-12 mx-auto mb-3 text-yellow-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    <p class="font-bold text-lg mb-1">24/7 Support</p>
                    <p class="text-sm text-blue-100">Always available to help you</p>
                </div>
            </div>
        </div>

        <!-- Trust Badges -->
        <div class="mt-10 flex flex-wrap justify-center items-center gap-6 md:gap-8 text-center text-gray-600">
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-semibold text-sm md:text-base">No Hidden Fees</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-semibold text-sm md:text-base">Exact Quote Guaranteed</span>
            </div>
            <div class="flex items-center gap-2">
                <svg class="w-6 h-6 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <span class="font-semibold text-sm md:text-base">US Quality Standards</span>
            </div>
        </div>

    </div>
</section>
