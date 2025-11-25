<?php
/**
 * All-on-4 Complete Calculator
 *
 * Comprehensive calculator for All-on-4 dental implants including trip cost,
 * financing options, and USA vs Mexico comparison.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="all-on-4-calculator py-16 bg-gradient-to-br from-navy to-navy-dark text-white" id="all-on-4-calculator">
    <div class="container max-w-6xl">

        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                <?php esc_html_e('All-on-4 Complete Cost Calculator', 'dental-rubio'); ?>
            </h2>
            <p class="text-xl text-gray-200 max-w-3xl mx-auto">
                <?php esc_html_e('Get your complete All-on-4 cost including treatment, trip expenses, and financing options. 100% Straumann implants included.', 'dental-rubio'); ?>
            </p>
        </div>

        <!-- Calculator Form -->
        <div class="bg-white text-gray-900 rounded-lg shadow-2xl p-8 md:p-10">

            <form id="allOn4CalculatorForm" class="space-y-8">

                <!-- Treatment Selection -->
                <div class="grid md:grid-cols-2 gap-6">

                    <div class="form-group">
                        <label for="allOn4Arches" class="block text-lg font-bold text-navy mb-3">
                            <?php esc_html_e('How many arches?', 'dental-rubio'); ?>
                        </label>
                        <select id="allOn4Arches" name="allOn4Arches" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20" required>
                            <option value="1"><?php esc_html_e('1 Arch (Upper OR Lower)', 'dental-rubio'); ?> - $9,500</option>
                            <option value="2"><?php esc_html_e('2 Arches (Full Mouth)', 'dental-rubio'); ?> - $19,000</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="allOn4Location" class="block text-lg font-bold text-navy mb-3">
                            <?php esc_html_e('Where are you traveling from?', 'dental-rubio'); ?>
                        </label>
                        <select id="allOn4Location" name="allOn4Location" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20" required>
                            <option value=""><?php esc_html_e('Select your location...', 'dental-rubio'); ?></option>
                            <option value="arizona"><?php esc_html_e('Arizona', 'dental-rubio'); ?></option>
                            <option value="california"><?php esc_html_e('California', 'dental-rubio'); ?></option>
                            <option value="texas"><?php esc_html_e('Texas', 'dental-rubio'); ?></option>
                            <option value="nevada"><?php esc_html_e('Nevada/New Mexico', 'dental-rubio'); ?></option>
                            <option value="canada-west"><?php esc_html_e('Western Canada', 'dental-rubio'); ?></option>
                            <option value="other-us"><?php esc_html_e('Other US/Canada', 'dental-rubio'); ?></option>
                        </select>
                    </div>

                </div>

                <!-- Trip Details -->
                <div class="grid md:grid-cols-3 gap-6">

                    <div class="form-group">
                        <label for="allOn4Nights" class="block text-lg font-bold text-navy mb-3">
                            <?php esc_html_e('Nights in Mexico', 'dental-rubio'); ?>
                        </label>
                        <input type="number"
                               id="allOn4Nights"
                               name="allOn4Nights"
                               min="3"
                               max="14"
                               value="5"
                               class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                        <p class="text-sm text-gray-600 mt-1"><?php esc_html_e('Typical: 3-7 days', 'dental-rubio'); ?></p>
                    </div>

                    <div class="form-group">
                        <label for="allOn4Travelers" class="block text-lg font-bold text-navy mb-3">
                            <?php esc_html_e('Travelers', 'dental-rubio'); ?>
                        </label>
                        <input type="number"
                               id="allOn4Travelers"
                               name="allOn4Travelers"
                               min="1"
                               max="4"
                               value="1"
                               class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                        <p class="text-sm text-gray-600 mt-1"><?php esc_html_e('Including companion', 'dental-rubio'); ?></p>
                    </div>

                    <div class="form-group">
                        <label for="allOn4HotelType" class="block text-lg font-bold text-navy mb-3">
                            <?php esc_html_e('Hotel Type', 'dental-rubio'); ?>
                        </label>
                        <select id="allOn4HotelType" name="allOn4HotelType" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                            <option value="budget"><?php esc_html_e('Budget ($50/night)', 'dental-rubio'); ?></option>
                            <option value="standard" selected><?php esc_html_e('Standard ($80/night)', 'dental-rubio'); ?></option>
                            <option value="premium"><?php esc_html_e('Premium ($120/night)', 'dental-rubio'); ?></option>
                        </select>
                    </div>

                </div>

                <!-- Financing Options -->
                <div class="bg-gold/10 p-6 rounded-lg border-2 border-gold/30">
                    <h3 class="text-xl font-bold text-navy mb-4">
                        <?php esc_html_e('💳 Financing Options (Optional)', 'dental-rubio'); ?>
                    </h3>

                    <div class="grid md:grid-cols-2 gap-6">
                        <div class="form-group">
                            <label for="allOn4DownPayment" class="block font-bold text-navy mb-2">
                                <?php esc_html_e('Down Payment', 'dental-rubio'); ?>
                            </label>
                            <input type="number"
                                   id="allOn4DownPayment"
                                   name="allOn4DownPayment"
                                   min="0"
                                   step="100"
                                   placeholder="0"
                                   class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                        </div>

                        <div class="form-group">
                            <label for="allOn4Months" class="block font-bold text-navy mb-2">
                                <?php esc_html_e('Payment Plan (Months)', 'dental-rubio'); ?>
                            </label>
                            <select id="allOn4Months" name="allOn4Months" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                                <option value="0"><?php esc_html_e('Pay in Full (0% interest)', 'dental-rubio'); ?></option>
                                <option value="6">6 <?php esc_html_e('months', 'dental-rubio'); ?></option>
                                <option value="12">12 <?php esc_html_e('months', 'dental-rubio'); ?></option>
                                <option value="18">18 <?php esc_html_e('months', 'dental-rubio'); ?></option>
                                <option value="24">24 <?php esc_html_e('months', 'dental-rubio'); ?></option>
                            </select>
                        </div>
                    </div>
                </div>

                <!-- Calculate Button -->
                <div class="text-center">
                    <button type="button"
                            id="calculateAllOn4"
                            class="btn btn-primary text-xl px-12 py-5 shadow-lg hover:shadow-xl transition-shadow">
                        <?php esc_html_e('Calculate Your Complete Cost', 'dental-rubio'); ?>
                    </button>
                </div>

            </form>

            <!-- Results -->
            <div id="allOn4Results" class="hidden mt-12 pt-12 border-t-4 border-gold">

                <!-- Main Cost Breakdown -->
                <div class="grid md:grid-cols-2 gap-8 mb-10">

                    <!-- Mexico Total -->
                    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-8 rounded-lg shadow-lg">
                        <h3 class="text-2xl font-bold mb-6"><?php esc_html_e('🇲🇽 At Rubio Dental (Mexico)', 'dental-rubio'); ?></h3>

                        <div class="space-y-3 mb-6">
                            <div class="flex justify-between text-lg">
                                <span><?php esc_html_e('Treatment Cost:', 'dental-rubio'); ?></span>
                                <strong>$<span id="allOn4MexicoDental">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Hotel:', 'dental-rubio'); ?></span>
                                <strong>$<span id="allOn4MexicoHotel">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Meals:', 'dental-rubio'); ?></span>
                                <strong>$<span id="allOn4MexicoMeals">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Transportation:', 'dental-rubio'); ?></span>
                                <strong>$<span id="allOn4MexicoTransport">0</span></strong>
                            </div>
                        </div>

                        <div class="pt-4 border-t-2 border-white/30">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold"><?php esc_html_e('TOTAL COST:', 'dental-rubio'); ?></span>
                                <span class="text-3xl font-bold">$<span id="allOn4MexicoTotal">0</span></span>
                            </div>
                        </div>
                    </div>

                    <!-- USA Total -->
                    <div class="bg-gray-100 border-2 border-gray-300 p-8 rounded-lg">
                        <h3 class="text-2xl font-bold text-gray-700 mb-6"><?php esc_html_e('🇺🇸 In USA/Canada', 'dental-rubio'); ?></h3>

                        <div class="space-y-3 mb-6 text-gray-700">
                            <div class="flex justify-between text-lg">
                                <span><?php esc_html_e('Treatment Cost:', 'dental-rubio'); ?></span>
                                <strong>$<span id="allOn4USADental">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Additional Fees:', 'dental-rubio'); ?></span>
                                <strong>$<span id="allOn4USAFees">0</span></strong>
                            </div>
                        </div>

                        <div class="pt-4 border-t-2 border-gray-400">
                            <div class="flex justify-between items-center">
                                <span class="text-xl font-bold text-gray-700"><?php esc_html_e('TOTAL COST:', 'dental-rubio'); ?></span>
                                <span class="text-3xl font-bold text-gray-700">$<span id="allOn4USATotal">0</span></span>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Savings Highlight -->
                <div class="bg-gradient-to-r from-gold to-gold-dark p-8 rounded-lg text-center mb-10">
                    <p class="text-navy text-xl font-bold mb-2"><?php esc_html_e('💰 YOU SAVE', 'dental-rubio'); ?></p>
                    <p class="text-navy text-5xl font-bold mb-2">$<span id="allOn4Savings">0</span></p>
                    <p class="text-navy/80"><?php esc_html_e('Including all travel expenses', 'dental-rubio'); ?></p>
                </div>

                <!-- Financing Details (if applicable) -->
                <div id="allOn4FinancingDetails" class="hidden bg-blue-50 p-6 rounded-lg mb-8 border-2 border-blue-200">
                    <h3 class="text-xl font-bold text-navy mb-4">
                        <?php esc_html_e('💳 Monthly Payment Plan', 'dental-rubio'); ?>
                    </h3>
                    <div class="grid md:grid-cols-3 gap-6 text-center">
                        <div>
                            <p class="text-gray-600 mb-1"><?php esc_html_e('Down Payment', 'dental-rubio'); ?></p>
                            <p class="text-2xl font-bold text-navy">$<span id="allOn4DownPaymentDisplay">0</span></p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1"><?php esc_html_e('Monthly Payment', 'dental-rubio'); ?></p>
                            <p class="text-2xl font-bold text-navy">$<span id="allOn4MonthlyPayment">0</span></p>
                        </div>
                        <div>
                            <p class="text-gray-600 mb-1"><?php esc_html_e('For', 'dental-rubio'); ?></p>
                            <p class="text-2xl font-bold text-navy"><span id="allOn4MonthsDisplay">0</span> <?php esc_html_e('months', 'dental-rubio'); ?></p>
                        </div>
                    </div>
                    <p class="text-sm text-gray-600 mt-4 text-center">
                        <?php esc_html_e('0% interest financing available. Subject to approval.', 'dental-rubio'); ?>
                    </p>
                </div>

                <!-- CTA -->
                <div class="text-center">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                       class="btn bg-navy text-white hover:bg-navy-dark text-xl px-10 py-5 mb-4">
                        <?php esc_html_e('Schedule Your Free Consultation', 'dental-rubio'); ?>
                    </a>
                    <p class="text-gray-600">
                        <?php esc_html_e('Get exact pricing and personalized treatment plan', 'dental-rubio'); ?>
                    </p>
                </div>

            </div>

        </div>

    </div>
</section>

<script>
(function() {
    'use strict';

    const calculateBtn = document.getElementById('calculateAllOn4');
    const resultsDiv = document.getElementById('allOn4Results');
    const financingDetails = document.getElementById('allOn4FinancingDetails');

    // Pricing data
    const pricing = {
        mexico: {
            1: 9500,
            2: 19000
        },
        usa: {
            arizona: { 1: 50000, 2: 100000 },
            california: { 1: 55000, 2: 110000 },
            texas: { 1: 50000, 2: 100000 },
            nevada: { 1: 52000, 2: 104000 },
            'canada-west': { 1: 65000, 2: 130000 },
            'other-us': { 1: 51000, 2: 102000 }
        },
        hotel: {
            budget: 50,
            standard: 80,
            premium: 120
        },
        meals: 30, // per person per day
        transport: {
            arizona: 50,
            california: 150,
            texas: 200,
            nevada: 100,
            'canada-west': 300,
            'other-us': 200
        }
    };

    calculateBtn.addEventListener('click', function() {
        const arches = parseInt(document.getElementById('allOn4Arches').value);
        const location = document.getElementById('allOn4Location').value;
        const nights = parseInt(document.getElementById('allOn4Nights').value);
        const travelers = parseInt(document.getElementById('allOn4Travelers').value);
        const hotelType = document.getElementById('allOn4HotelType').value;
        const downPayment = parseInt(document.getElementById('allOn4DownPayment').value) || 0;
        const months = parseInt(document.getElementById('allOn4Months').value);

        if (!location) {
            alert('<?php esc_html_e('Please select your location', 'dental-rubio'); ?>');
            return;
        }

        // Calculate Mexico costs
        const mexicoDental = pricing.mexico[arches];
        const mexicoHotel = nights * pricing.hotel[hotelType];
        const mexicoMeals = nights * pricing.meals * travelers;
        const mexicoTransport = pricing.transport[location];
        const mexicoTotal = mexicoDental + mexicoHotel + mexicoMeals + mexicoTransport;

        // Calculate USA costs
        const usaDental = pricing.usa[location][arches];
        const usaFees = usaDental * 0.1; // 10% additional fees
        const usaTotal = usaDental + usaFees;

        // Calculate savings
        const savings = usaTotal - mexicoTotal;

        // Update UI
        document.getElementById('allOn4MexicoDental').textContent = mexicoDental.toLocaleString();
        document.getElementById('allOn4MexicoHotel').textContent = mexicoHotel.toLocaleString();
        document.getElementById('allOn4MexicoMeals').textContent = mexicoMeals.toLocaleString();
        document.getElementById('allOn4MexicoTransport').textContent = mexicoTransport.toLocaleString();
        document.getElementById('allOn4MexicoTotal').textContent = mexicoTotal.toLocaleString();

        document.getElementById('allOn4USADental').textContent = usaDental.toLocaleString();
        document.getElementById('allOn4USAFees').textContent = usaFees.toLocaleString();
        document.getElementById('allOn4USATotal').textContent = usaTotal.toLocaleString();

        document.getElementById('allOn4Savings').textContent = savings.toLocaleString();

        // Calculate financing if applicable
        if (months > 0) {
            const financeAmount = mexicoTotal - downPayment;
            const monthlyPayment = Math.ceil(financeAmount / months);

            document.getElementById('allOn4DownPaymentDisplay').textContent = downPayment.toLocaleString();
            document.getElementById('allOn4MonthlyPayment').textContent = monthlyPayment.toLocaleString();
            document.getElementById('allOn4MonthsDisplay').textContent = months;

            financingDetails.classList.remove('hidden');
        } else {
            financingDetails.classList.add('hidden');
        }

        // Show results
        resultsDiv.classList.remove('hidden');
        resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
})();
</script>
