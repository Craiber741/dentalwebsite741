<?php
/**
 * Trip Cost Calculator
 * Calculate total trip cost including dental, hotel, meals, and transport
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section id="trip-cost-calculator" class="trip-calculator py-12 md:py-16 bg-gradient-to-br from-blue-50 to-white">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                Total Trip Cost Calculator
            </h2>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                Plan your complete dental vacation - dental work + accommodation + meals
            </p>
        </div>

        <!-- Calculator Form -->
        <div class="bg-white rounded-2xl shadow-xl p-6 md:p-8 border-2 border-blue-100">
            <form id="tripCostForm" class="space-y-6">

                <!-- Dental Service Selection -->
                <div class="form-group">
                    <label for="tripDentalService" class="block text-lg font-bold text-gray-800 mb-3">
                        What dental service do you need?
                    </label>
                    <select id="tripDentalService" name="service"
                            class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all cursor-pointer"
                            required>
                        <option value="">Select a service...</option>
                        <option value="1350">Single Dental Implant - $1,350</option>
                        <option value="350">Crown (Porcelain) - $350</option>
                        <option value="9500">All-on-4 (Single Arch) - $9,500</option>
                        <option value="18500">All-on-4 (Both Arches) - $18,500</option>
                        <option value="800">Full Dentures - $800</option>
                        <option value="420">Veneers (per tooth) - $420</option>
                        <option value="350">Root Canal - $350</option>
                    </select>
                </div>

                <!-- Number of Nights -->
                <div class="form-group">
                    <label for="tripNights" class="block text-lg font-bold text-gray-800 mb-3">
                        How many nights will you stay?
                    </label>
                    <input type="number" id="tripNights" name="nights"
                           min="1" max="30" value="3"
                           class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                           required>
                    <p class="text-sm text-gray-600 mt-2">Most procedures take 1-3 days</p>
                </div>

                <!-- Hotel Type -->
                <div class="form-group">
                    <label for="tripHotelType" class="block text-lg font-bold text-gray-800 mb-3">
                        What type of accommodation?
                    </label>
                    <select id="tripHotelType" name="hotel"
                            class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all cursor-pointer"
                            required>
                        <option value="50">Budget Hotel ($50/night)</option>
                        <option value="80" selected>Mid-Range Hotel ($80/night)</option>
                        <option value="150">Premium Hotel ($150/night)</option>
                        <option value="200">Luxury Resort ($200/night)</option>
                    </select>
                </div>

                <!-- Number of Travelers -->
                <div class="form-group">
                    <label for="tripTravelers" class="block text-lg font-bold text-gray-800 mb-3">
                        How many people traveling?
                    </label>
                    <input type="number" id="tripTravelers" name="travelers"
                           min="1" max="4" value="1"
                           class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                           required>
                    <p class="text-sm text-gray-600 mt-2">Including patient and companions</p>
                </div>

                <!-- Results Panel (populated by JavaScript) -->
                <div id="tripCostResults" class="hidden mt-8"></div>

            </form>
        </div>

        <!-- Trust Elements -->
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>✓ Free Shuttle from Yuma Border • ✓ Hotel Recommendations • ✓ Safe & Easy</p>
        </div>

    </div>
</section>

<script>
(function() {
    'use strict';

    const form = document.getElementById('tripCostForm');
    if (!form) return;

    const serviceSelect = document.getElementById('tripDentalService');
    const nightsInput = document.getElementById('tripNights');
    const hotelSelect = document.getElementById('tripHotelType');
    const travelersInput = document.getElementById('tripTravelers');
    const resultsDiv = document.getElementById('tripCostResults');

    function calculateTripCost() {
        const dentalCost = parseInt(serviceSelect.value) || 0;
        const nights = parseInt(nightsInput.value) || 3;
        const hotelCostPerNight = parseInt(hotelSelect.value) || 80;
        const travelers = parseInt(travelersInput.value) || 1;

        if (!dentalCost) {
            resultsDiv.classList.add('hidden');
            return;
        }

        // Calculate costs
        const hotelTotal = hotelCostPerNight * nights;
        const mealsEstimate = 30 * nights * travelers; // $30 per person per day
        const transportCost = 0; // Free shuttle!
        const miscellaneous = 100; // Shopping, tips, etc.

        const totalCost = dentalCost + hotelTotal + mealsEstimate + transportCost + miscellaneous;

        // Estimate USA dental cost (3x average)
        const usaDentalCost = dentalCost * 3.3;
        const usaTripCost = usaDentalCost + 200 + (50 * nights * travelers); // USA hotel & meals more expensive
        const totalSavings = usaTripCost - totalCost;

        // Display results
        resultsDiv.innerHTML = `
            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 md:p-8 rounded-xl border-2 border-green-300 shadow-lg">

                <!-- Header -->
                <div class="text-center mb-6">
                    <h3 class="text-2xl md:text-3xl font-bold text-gray-800 mb-2">
                        Your Complete Trip Breakdown
                    </h3>
                    <p class="text-gray-600">${nights} ${nights === 1 ? 'night' : 'nights'} • ${travelers} ${travelers === 1 ? 'traveler' : 'travelers'}</p>
                </div>

                <!-- Cost Breakdown -->
                <div class="space-y-3 mb-6">
                    <div class="flex justify-between items-center py-2 border-b border-green-200">
                        <span class="text-gray-700 font-semibold">Dental Treatment:</span>
                        <span class="text-xl font-bold text-gray-900">$${dentalCost.toLocaleString()}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-green-200">
                        <span class="text-gray-700">Hotel (${nights} nights):</span>
                        <span class="text-lg font-semibold text-gray-800">$${hotelTotal.toLocaleString()}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-green-200">
                        <span class="text-gray-700">Meals (estimated):</span>
                        <span class="text-lg font-semibold text-gray-800">$${mealsEstimate.toLocaleString()}</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b border-green-200">
                        <span class="text-gray-700">Shuttle from Border:</span>
                        <span class="text-lg font-semibold text-green-600">FREE!</span>
                    </div>
                    <div class="flex justify-between items-center py-2 border-b-2 border-green-300">
                        <span class="text-gray-700">Miscellaneous:</span>
                        <span class="text-lg font-semibold text-gray-800">$${miscellaneous.toLocaleString()}</span>
                    </div>

                    <!-- Total -->
                    <div class="flex justify-between items-center py-4 bg-white rounded-lg px-4 mt-4">
                        <span class="text-xl font-bold text-gray-900">TOTAL TRIP COST:</span>
                        <span class="text-3xl font-bold text-blue-900">$${totalCost.toLocaleString()}</span>
                    </div>
                </div>

                <!-- Savings Comparison -->
                <div class="bg-blue-600 text-white rounded-lg p-6 mb-6">
                    <p class="text-sm font-semibold mb-2 uppercase tracking-wide">vs. Having it Done in USA</p>
                    <div class="flex items-baseline justify-between">
                        <div>
                            <p class="text-gray-200 text-sm">USA Total Cost:</p>
                            <p class="text-2xl font-bold line-through">$${usaTripCost.toLocaleString()}</p>
                        </div>
                        <div class="text-right">
                            <p class="text-yellow-400 text-sm font-semibold">YOU SAVE:</p>
                            <p class="text-4xl font-bold text-yellow-400">$${totalSavings.toLocaleString()}</p>
                        </div>
                    </div>
                </div>

                <!-- What's Included -->
                <div class="bg-white rounded-lg p-4 mb-6 border-l-4 border-blue-600">
                    <p class="font-semibold text-gray-900 mb-2">✓ Your trip includes:</p>
                    <ul class="text-sm text-gray-700 space-y-1">
                        <li>• Premium dental treatment with German quality materials</li>
                        <li>• Free shuttle service from Yuma border crossing</li>
                        <li>• Hotel recommendations near clinic</li>
                        <li>• English-speaking staff throughout</li>
                        <li>• Safe, tourist-friendly environment</li>
                    </ul>
                </div>

                <!-- CTA -->
                <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
                   class="block w-full bg-green-600 hover:bg-green-700 text-white font-bold text-lg md:text-xl py-5 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 text-center">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call to Plan Your Trip
                </a>

            </div>
        `;

        resultsDiv.classList.remove('hidden');

        // Scroll to results
        resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Calculate on change
    serviceSelect.addEventListener('change', calculateTripCost);
    nightsInput.addEventListener('input', calculateTripCost);
    hotelSelect.addEventListener('change', calculateTripCost);
    travelersInput.addEventListener('input', calculateTripCost);

})();
</script>
