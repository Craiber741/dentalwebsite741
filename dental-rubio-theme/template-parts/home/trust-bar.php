<?php
/**
 * Trust Bar - Social Proof Section
 * Displays key statistics and trust signals
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="trust-bar bg-yellow-50 border-b-2 border-yellow-200">
    <div class="container mx-auto px-4 max-w-7xl py-6 md:py-8">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 md:gap-8">

            <!-- Stat 1: Experience -->
            <div class="text-center">
                <div class="mb-2">
                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z"></path>
                    </svg>
                </div>
                <p class="text-2xl md:text-3xl font-bold text-blue-900 mb-1">40+ Years</p>
                <p class="text-xs md:text-sm text-gray-700 font-semibold">Top 5 of 400 Clinics</p>
            </div>

            <!-- Stat 2: Patients -->
            <div class="text-center">
                <div class="mb-2">
                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z"></path>
                    </svg>
                </div>
                <p class="text-2xl md:text-3xl font-bold text-blue-900 mb-1">51,237+</p>
                <p class="text-xs md:text-sm text-gray-700 font-semibold">Happy Patients</p>
            </div>

            <!-- Stat 3: Quality -->
            <div class="text-center">
                <div class="mb-2">
                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                </div>
                <p class="text-2xl md:text-3xl font-bold text-blue-900 mb-1">100%</p>
                <p class="text-xs md:text-sm text-gray-700 font-semibold">Straumann German Quality</p>
            </div>

            <!-- Stat 4: Free Service -->
            <div class="text-center">
                <div class="mb-2">
                    <svg class="w-12 h-12 md:w-16 md:h-16 mx-auto text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4"></path>
                    </svg>
                </div>
                <p class="text-2xl md:text-3xl font-bold text-blue-900 mb-1">Free Shuttle</p>
                <p class="text-xs md:text-sm text-gray-700 font-semibold">From Yuma Border</p>
            </div>

        </div>
    </div>
</div>
