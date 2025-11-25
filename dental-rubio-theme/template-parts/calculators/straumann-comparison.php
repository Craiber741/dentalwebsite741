<?php
/**
 * Straumann vs Chinese Implant Comparison
 *
 * Educational calculator comparing premium Straumann implants with budget/Chinese implants.
 * Helps patients understand quality differences and long-term value.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="straumann-comparison py-16 bg-white" id="straumann-comparison">
    <div class="container max-w-6xl">

        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                <?php esc_html_e('Straumann vs Budget Implants: The Real Cost', 'dental-rubio'); ?>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                <?php esc_html_e('Not all implants are created equal. See the true difference between premium German quality and budget alternatives.', 'dental-rubio'); ?>
            </p>
        </div>

        <!-- Quick Stats -->
        <div class="grid md:grid-cols-4 gap-6 mb-12">
            <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-lg text-center border-2 border-green-200">
                <p class="text-3xl font-bold text-green-700 mb-2">98.8%</p>
                <p class="text-sm text-gray-700"><?php esc_html_e('Straumann Success Rate', 'dental-rubio'); ?></p>
            </div>
            <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-lg text-center border-2 border-red-200">
                <p class="text-3xl font-bold text-red-700 mb-2">85-90%</p>
                <p class="text-sm text-gray-700"><?php esc_html_e('Budget Implant Success Rate', 'dental-rubio'); ?></p>
            </div>
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-lg text-center border-2 border-blue-200">
                <p class="text-3xl font-bold text-blue-700 mb-2">25+</p>
                <p class="text-sm text-gray-700"><?php esc_html_e('Years Straumann Lasts', 'dental-rubio'); ?></p>
            </div>
            <div class="bg-gradient-to-br from-orange-50 to-orange-100 p-6 rounded-lg text-center border-2 border-orange-200">
                <p class="text-3xl font-bold text-orange-700 mb-2">8-12</p>
                <p class="text-sm text-gray-700"><?php esc_html_e('Years Budget Implants Last', 'dental-rubio'); ?></p>
            </div>
        </div>

        <!-- Comparison Calculator -->
        <div class="bg-gray-50 rounded-lg p-8 md:p-10 mb-12">
            <h3 class="text-2xl font-bold text-navy mb-6 text-center">
                <?php esc_html_e('Calculate Your True Cost', 'dental-rubio'); ?>
            </h3>

            <form id="straumannComparisonForm" class="max-w-2xl mx-auto space-y-6">

                <!-- Number of Implants -->
                <div class="form-group">
                    <label for="straumannImplantCount" class="block text-lg font-bold text-navy mb-3">
                        <?php esc_html_e('How many implants do you need?', 'dental-rubio'); ?>
                    </label>
                    <input type="number"
                           id="straumannImplantCount"
                           name="straumannImplantCount"
                           min="1"
                           max="10"
                           value="1"
                           class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                </div>

                <!-- Time Horizon -->
                <div class="form-group">
                    <label for="straumannTimeHorizon" class="block text-lg font-bold text-navy mb-3">
                        <?php esc_html_e('How many years do you want to calculate?', 'dental-rubio'); ?>
                    </label>
                    <select id="straumannTimeHorizon" name="straumannTimeHorizon" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                        <option value="10">10 <?php esc_html_e('years', 'dental-rubio'); ?></option>
                        <option value="15" selected>15 <?php esc_html_e('years', 'dental-rubio'); ?></option>
                        <option value="20">20 <?php esc_html_e('years', 'dental-rubio'); ?></option>
                        <option value="25">25 <?php esc_html_e('years', 'dental-rubio'); ?></option>
                    </select>
                </div>

                <!-- Calculate Button -->
                <div class="text-center">
                    <button type="button"
                            id="calculateStraumann"
                            class="btn btn-primary text-xl px-10 py-4">
                        <?php esc_html_e('Compare Quality & Cost', 'dental-rubio'); ?>
                    </button>
                </div>

            </form>

            <!-- Results -->
            <div id="straumannResults" class="hidden mt-10 pt-10 border-t-2 border-gray-300">

                <!-- Cost Comparison -->
                <div class="grid md:grid-cols-2 gap-8 mb-10">

                    <!-- Straumann -->
                    <div class="bg-gradient-to-br from-navy to-navy-dark text-white p-8 rounded-lg">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-3xl">🇩🇪</span>
                            <div>
                                <h4 class="text-xl font-bold"><?php esc_html_e('Straumann Implants', 'dental-rubio'); ?></h4>
                                <p class="text-sm text-gray-300"><?php esc_html_e('Premium German Quality', 'dental-rubio'); ?></p>
                            </div>
                        </div>

                        <div class="space-y-3">
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Initial Cost:', 'dental-rubio'); ?></span>
                                <strong>$<span id="straumannInitial">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Replacements:', 'dental-rubio'); ?></span>
                                <strong><span id="straumannReplacements">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Maintenance:', 'dental-rubio'); ?></span>
                                <strong>$<span id="straumannMaintenance">0</span></strong>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-400">
                                <span class="text-lg font-bold"><?php esc_html_e('Total Cost:', 'dental-rubio'); ?></span>
                                <strong class="text-2xl text-gold">$<span id="straumannTotal">0</span></strong>
                            </div>
                        </div>
                    </div>

                    <!-- Budget Implants -->
                    <div class="bg-gray-100 border-2 border-gray-300 p-8 rounded-lg">
                        <div class="flex items-center gap-3 mb-4">
                            <span class="text-3xl">⚠️</span>
                            <div>
                                <h4 class="text-xl font-bold text-gray-700"><?php esc_html_e('Budget Implants', 'dental-rubio'); ?></h4>
                                <p class="text-sm text-gray-500"><?php esc_html_e('Chinese/Generic Quality', 'dental-rubio'); ?></p>
                            </div>
                        </div>

                        <div class="space-y-3 text-gray-700">
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Initial Cost:', 'dental-rubio'); ?></span>
                                <strong>$<span id="budgetInitial">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Replacements:', 'dental-rubio'); ?></span>
                                <strong class="text-red-600"><span id="budgetReplacements">0</span></strong>
                            </div>
                            <div class="flex justify-between">
                                <span><?php esc_html_e('Maintenance:', 'dental-rubio'); ?></span>
                                <strong>$<span id="budgetMaintenance">0</span></strong>
                            </div>
                            <div class="flex justify-between pt-3 border-t border-gray-400">
                                <span class="text-lg font-bold"><?php esc_html_e('Total Cost:', 'dental-rubio'); ?></span>
                                <strong class="text-2xl text-gray-700">$<span id="budgetTotal">0</span></strong>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Key Difference -->
                <div class="bg-green-50 border-2 border-green-200 p-6 rounded-lg text-center mb-8">
                    <p class="text-2xl font-bold text-green-700 mb-2">
                        <?php esc_html_e('You Save:', 'dental-rubio'); ?> $<span id="straumannSavings">0</span>
                    </p>
                    <p class="text-gray-600">
                        <?php esc_html_e('By choosing Straumann over budget implants for the same period', 'dental-rubio'); ?>
                    </p>
                </div>

            </div>

        </div>

        <!-- Quality Comparison Table -->
        <div class="bg-white rounded-lg shadow-lg overflow-hidden mb-12">
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead class="bg-navy text-white">
                        <tr>
                            <th class="p-4 text-left font-bold"><?php esc_html_e('Feature', 'dental-rubio'); ?></th>
                            <th class="p-4 text-center font-bold">🇩🇪 <?php esc_html_e('Straumann', 'dental-rubio'); ?></th>
                            <th class="p-4 text-center font-bold">⚠️ <?php esc_html_e('Budget/Chinese', 'dental-rubio'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-semibold"><?php esc_html_e('Success Rate', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600 font-bold">98.8%</td>
                            <td class="p-4 text-center text-red-600">85-90%</td>
                        </tr>
                        <tr class="border-b bg-gray-50 hover:bg-gray-100">
                            <td class="p-4 font-semibold"><?php esc_html_e('Average Lifespan', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600 font-bold">25+ years</td>
                            <td class="p-4 text-center text-red-600">8-12 years</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-semibold"><?php esc_html_e('Material Quality', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600">Grade 4 Titanium</td>
                            <td class="p-4 text-center text-red-600">Mixed Quality</td>
                        </tr>
                        <tr class="border-b bg-gray-50 hover:bg-gray-100">
                            <td class="p-4 font-semibold"><?php esc_html_e('Manufacturing', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600">Switzerland/Germany</td>
                            <td class="p-4 text-center text-red-600">China/Generic</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-semibold"><?php esc_html_e('Bone Integration', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600">Excellent (SLA Surface)</td>
                            <td class="p-4 text-center text-red-600">Variable</td>
                        </tr>
                        <tr class="border-b bg-gray-50 hover:bg-gray-100">
                            <td class="p-4 font-semibold"><?php esc_html_e('Warranty', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600">Lifetime Limited</td>
                            <td class="p-4 text-center text-red-600">Limited/None</td>
                        </tr>
                        <tr class="border-b hover:bg-gray-50">
                            <td class="p-4 font-semibold"><?php esc_html_e('Research & Testing', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600">65+ years</td>
                            <td class="p-4 text-center text-red-600">Minimal</td>
                        </tr>
                        <tr class="bg-gray-50">
                            <td class="p-4 font-semibold"><?php esc_html_e('Replacement Parts Available', 'dental-rubio'); ?></td>
                            <td class="p-4 text-center text-green-600">Worldwide</td>
                            <td class="p-4 text-center text-red-600">Often Discontinued</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Why We Only Use Straumann -->
        <div class="bg-navy text-white p-8 md:p-10 rounded-lg">
            <h3 class="text-2xl md:text-3xl font-bold mb-6 text-center">
                <?php esc_html_e('Why Rubio Dental ONLY Uses Straumann', 'dental-rubio'); ?>
            </h3>

            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <div class="flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">✓</span>
                    <div>
                        <p class="font-bold mb-1"><?php esc_html_e('Best Success Rate', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('98.8% success rate proven over 65 years', 'dental-rubio'); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">✓</span>
                    <div>
                        <p class="font-bold mb-1"><?php esc_html_e('Lasts Longer', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('25+ years vs 8-12 for budget implants', 'dental-rubio'); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">✓</span>
                    <div>
                        <p class="font-bold mb-1"><?php esc_html_e('Lower Total Cost', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('No replacements needed saves thousands', 'dental-rubio'); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">✓</span>
                    <div>
                        <p class="font-bold mb-1"><?php esc_html_e('Worldwide Support', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('Parts available globally, never discontinued', 'dental-rubio'); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">✓</span>
                    <div>
                        <p class="font-bold mb-1"><?php esc_html_e('Better Osseointegration', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('SLA surface technology for faster healing', 'dental-rubio'); ?></p>
                    </div>
                </div>
                <div class="flex items-start gap-3">
                    <span class="text-2xl flex-shrink-0">✓</span>
                    <div>
                        <p class="font-bold mb-1"><?php esc_html_e('Peace of Mind', 'dental-rubio'); ?></p>
                        <p class="text-sm text-gray-300"><?php esc_html_e('Lifetime warranty on implants', 'dental-rubio'); ?></p>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                   class="btn bg-gold text-navy hover:bg-gold-light text-xl px-10 py-4">
                    <?php esc_html_e('Get Your Straumann Implant Quote', 'dental-rubio'); ?>
                </a>
            </div>
        </div>

    </div>
</section>

<script>
(function() {
    'use strict';

    const calculateBtn = document.getElementById('calculateStraumann');
    const resultsDiv = document.getElementById('straumannResults');

    calculateBtn.addEventListener('click', function() {
        const count = parseInt(document.getElementById('straumannImplantCount').value);
        const years = parseInt(document.getElementById('straumannTimeHorizon').value);

        // Pricing
        const straumannPerImplant = 1350; // At Rubio Dental
        const budgetPerImplant = 900; // Initial cost lower

        // Calculate Straumann costs
        const straumannInitial = straumannPerImplant * count;
        const straumannReplacements = 0; // Lasts 25+ years
        const straumannMaintenance = 50 * years * count; // $50/year per implant
        const straumannTotal = straumannInitial + straumannMaintenance;

        // Calculate Budget costs
        const budgetInitial = budgetPerImplant * count;
        const budgetLifespan = 10; // Average 10 years
        const budgetReplacementsNeeded = Math.floor(years / budgetLifespan);
        const budgetReplacementCost = budgetReplacementsNeeded * (budgetPerImplant * 0.9) * count; // 90% of initial
        const budgetMaintenance = 100 * years * count; // $100/year (more issues)
        const budgetTotal = budgetInitial + budgetReplacementCost + budgetMaintenance;

        // Calculate savings
        const savings = budgetTotal - straumannTotal;

        // Update UI
        document.getElementById('straumannInitial').textContent = straumannInitial.toLocaleString();
        document.getElementById('straumannReplacements').textContent = straumannReplacements;
        document.getElementById('straumannMaintenance').textContent = straumannMaintenance.toLocaleString();
        document.getElementById('straumannTotal').textContent = straumannTotal.toLocaleString();

        document.getElementById('budgetInitial').textContent = budgetInitial.toLocaleString();
        document.getElementById('budgetReplacements').textContent = budgetReplacementsNeeded;
        document.getElementById('budgetMaintenance').textContent = (budgetReplacementCost + budgetMaintenance).toLocaleString();
        document.getElementById('budgetTotal').textContent = budgetTotal.toLocaleString();

        document.getElementById('straumannSavings').textContent = Math.abs(savings).toLocaleString();

        // Show results
        resultsDiv.classList.remove('hidden');
        resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
})();
</script>
