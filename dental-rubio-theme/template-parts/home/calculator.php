<?php
/**
 * Savings Calculator Section
 * Interactive tool to calculate savings vs USA/Canada prices
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section id="calculator" class="savings-calculator py-16 md:py-20 bg-white scroll-mt-20">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                Calculate Your Savings
            </h2>
            <p class="text-lg md:text-xl text-gray-600">
                See exactly how much you'll save on quality dental care
            </p>
        </div>

        <!-- Calculator Form -->
        <div class="bg-gradient-to-br from-blue-50 to-white rounded-2xl shadow-xl p-6 md:p-8 border-2 border-blue-100">
            <form id="savingsCalculator" class="space-y-6">

                <!-- Service Selector -->
                <div class="form-group">
                    <label for="service" class="block text-lg md:text-xl font-bold text-gray-800 mb-3">
                        What dental service do you need?
                    </label>
                    <select id="service" name="service"
                            class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all cursor-pointer"
                            required>
                        <option value="">Select a service...</option>
                        <option value="implant">Single Dental Implant</option>
                        <option value="crown">Crown (Porcelain)</option>
                        <option value="all-on-4">All-on-4 (Full Arch)</option>
                        <option value="dentures">Full Dentures (Set)</option>
                        <option value="veneers">Veneers (Per Tooth)</option>
                        <option value="bridge">Bridge (3 Units)</option>
                    </select>
                </div>

                <!-- Location Selector -->
                <div class="form-group">
                    <label for="location" class="block text-lg md:text-xl font-bold text-gray-800 mb-3">
                        Where do you currently live?
                    </label>
                    <select id="location" name="location"
                            class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all cursor-pointer"
                            required>
                        <option value="">Select your location...</option>
                        <option value="arizona">Arizona</option>
                        <option value="california">California</option>
                        <option value="texas">Texas</option>
                        <option value="canada">Canada</option>
                        <option value="other-us">Other US State</option>
                    </select>
                </div>

                <!-- Results Panel (populated by JavaScript) -->
                <div id="results" class="hidden mt-8"></div>

            </form>
        </div>

        <!-- Trust Elements Below Calculator -->
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>✓ No Hidden Fees • ✓ Transparent Pricing • ✓ Free Quote in 5 Minutes</p>
        </div>

    </div>
</section>
