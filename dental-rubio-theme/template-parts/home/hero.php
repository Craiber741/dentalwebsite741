<?php
/**
 * Homepage Hero Section
 * Senior-friendly design with large text and clear CTAs
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="hero bg-gradient-to-br from-blue-900 to-blue-800 text-white py-16 md:py-24" role="banner">
    <div class="container mx-auto px-4 max-w-7xl">
        <div class="grid md:grid-cols-2 gap-8 md:gap-12 items-center">

            <!-- Text Content -->
            <div class="text-content">
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                    America's Longest-Serving Dentist in Los Algodones
                </h1>

                <p class="text-xl md:text-2xl mb-6 text-blue-100 leading-relaxed">
                    Trusted by 51,237+ Patients Since 1986
                </p>

                <!-- USPs - Key Benefits -->
                <ul class="space-y-3 mb-8 text-base md:text-lg">
                    <li class="flex gap-3 items-start">
                        <svg class="w-6 h-6 flex-shrink-0 mt-1 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">40 Years of Excellence</span>
                    </li>
                    <li class="flex gap-3 items-start">
                        <svg class="w-6 h-6 flex-shrink-0 mt-1 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">100% Straumann Implants (German Quality)</span>
                    </li>
                    <li class="flex gap-3 items-start">
                        <svg class="w-6 h-6 flex-shrink-0 mt-1 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">#1 Choice for Snowbirds & Seniors</span>
                    </li>
                    <li class="flex gap-3 items-start">
                        <svg class="w-6 h-6 flex-shrink-0 mt-1 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7"></path>
                        </svg>
                        <span class="font-medium">Save 70% vs USA/Canada Prices</span>
                    </li>
                </ul>

                <!-- CTAs -->
                <div class="flex flex-col sm:flex-row gap-4">
                    <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
                       class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold bg-green-600 hover:bg-green-700 text-white rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                        </svg>
                        Call Now: <?php echo esc_html(dental_rubio_get_phone()); ?>
                    </a>
                    <a href="#calculator"
                       class="inline-flex items-center justify-center px-8 py-4 text-lg font-bold bg-yellow-500 hover:bg-yellow-600 text-blue-900 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                        <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 7h6m0 10v-3m-3 3h.01M9 17h.01M9 14h.01M12 14h.01M15 11h.01M12 11h.01M9 11h.01M7 21h10a2 2 0 002-2V5a2 2 0 00-2-2H7a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                        </svg>
                        Calculate Your Savings
                    </a>
                </div>
            </div>

            <!-- Image/Visual -->
            <div class="hero-image hidden md:block">
                <?php
                // Featured image or placeholder
                if (has_post_thumbnail()) {
                    the_post_thumbnail('hero-image', [
                        'class' => 'rounded-lg shadow-2xl w-full h-auto',
                        'alt' => 'Dental Rubio Group - Professional Dental Care in Los Algodones'
                    ]);
                } else {
                    // Placeholder for hero image
                    ?>
                    <div class="bg-blue-700 rounded-lg shadow-2xl p-8 h-96 flex items-center justify-center">
                        <div class="text-center">
                            <svg class="w-32 h-32 mx-auto mb-4 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <p class="text-blue-200 text-lg">Add Featured Image</p>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>

        </div>
    </div>
</section>
