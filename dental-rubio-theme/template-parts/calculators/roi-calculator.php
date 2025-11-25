<?php
/**
 * ROI Calculator - 15 Year Analysis
 *
 * Long-term cost analysis comparing dental implants vs alternatives (dentures, bridges).
 * Shows total cost of ownership over 15 years including replacements and maintenance.
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="roi-calculator py-16 bg-gray-50" id="roi-calculator">
    <div class="container max-w-5xl">

        <!-- Header -->
        <div class="text-center mb-12">
            <h2 class="text-3xl md:text-4xl font-bold text-navy mb-4">
                <?php esc_html_e('15-Year Cost Comparison Calculator', 'dental-rubio'); ?>
            </h2>
            <p class="text-xl text-gray-600 max-w-3xl mx-auto">
                <?php esc_html_e('See the true long-term value of dental implants vs dentures or bridges. Most people are surprised by the results!', 'dental-rubio'); ?>
            </p>
        </div>

        <!-- Calculator Form -->
        <div class="bg-white rounded-lg shadow-lg p-8 md:p-10">

            <form id="roiCalculatorForm" class="space-y-8">

                <!-- Treatment Selection -->
                <div class="form-group">
                    <label for="roiTreatment" class="block text-lg font-bold text-navy mb-3">
                        <?php esc_html_e('What treatment are you comparing?', 'dental-rubio'); ?>
                    </label>
                    <select id="roiTreatment" name="roiTreatment" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20" required>
                        <option value=""><?php esc_html_e('Select treatment type...', 'dental-rubio'); ?></option>
                        <option value="single-implant"><?php esc_html_e('Single Dental Implant', 'dental-rubio'); ?></option>
                        <option value="multiple-implants"><?php esc_html_e('Multiple Implants (2-6 teeth)', 'dental-rubio'); ?></option>
                        <option value="all-on-4"><?php esc_html_e('All-on-4 (Full Arch)', 'dental-rubio'); ?></option>
                        <option value="full-mouth"><?php esc_html_e('Full Mouth Restoration', 'dental-rubio'); ?></option>
                    </select>
                </div>

                <!-- Number of Teeth (for multiple implants) -->
                <div id="teethCountGroup" class="form-group hidden">
                    <label for="roiTeethCount" class="block text-lg font-bold text-navy mb-3">
                        <?php esc_html_e('How many teeth?', 'dental-rubio'); ?>
                    </label>
                    <input type="number"
                           id="roiTeethCount"
                           name="roiTeethCount"
                           min="2"
                           max="6"
                           value="4"
                           class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20">
                </div>

                <!-- Location -->
                <div class="form-group">
                    <label for="roiLocation" class="block text-lg font-bold text-navy mb-3">
                        <?php esc_html_e('Where would you get treatment in the USA/Canada?', 'dental-rubio'); ?>
                    </label>
                    <select id="roiLocation" name="roiLocation" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20" required>
                        <option value=""><?php esc_html_e('Select location...', 'dental-rubio'); ?></option>
                        <option value="arizona"><?php esc_html_e('Arizona', 'dental-rubio'); ?></option>
                        <option value="california"><?php esc_html_e('California', 'dental-rubio'); ?></option>
                        <option value="texas"><?php esc_html_e('Texas', 'dental-rubio'); ?></option>
                        <option value="nevada"><?php esc_html_e('Nevada', 'dental-rubio'); ?></option>
                        <option value="canada"><?php esc_html_e('Canada', 'dental-rubio'); ?></option>
                        <option value="other-us"><?php esc_html_e('Other US State', 'dental-rubio'); ?></option>
                    </select>
                </div>

                <!-- Alternative Treatment -->
                <div class="form-group">
                    <label for="roiAlternative" class="block text-lg font-bold text-navy mb-3">
                        <?php esc_html_e('What is your alternative to implants?', 'dental-rubio'); ?>
                    </label>
                    <select id="roiAlternative" name="roiAlternative" class="w-full text-lg p-4 border-2 border-gray-300 rounded-lg focus:border-gold focus:ring-2 focus:ring-gold/20" required>
                        <option value=""><?php esc_html_e('Select alternative...', 'dental-rubio'); ?></option>
                        <option value="dentures"><?php esc_html_e('Dentures (Removable)', 'dental-rubio'); ?></option>
                        <option value="bridge"><?php esc_html_e('Fixed Bridge', 'dental-rubio'); ?></option>
                        <option value="partial"><?php esc_html_e('Partial Denture', 'dental-rubio'); ?></option>
                        <option value="do-nothing"><?php esc_html_e('Do Nothing (No Treatment)', 'dental-rubio'); ?></option>
                    </select>
                </div>

                <!-- Calculate Button -->
                <div class="text-center">
                    <button type="button"
                            id="calculateROI"
                            class="btn btn-primary text-xl px-12 py-4 shadow-lg hover:shadow-xl transition-shadow">
                        <?php esc_html_e('Calculate 15-Year Cost', 'dental-rubio'); ?>
                    </button>
                </div>

            </form>

            <!-- Results -->
            <div id="roiResults" class="hidden mt-10 pt-10 border-t-2 border-gray-200">

                <!-- Summary Cards -->
                <div class="grid md:grid-cols-3 gap-6 mb-10">

                    <!-- Implant Cost -->
                    <div class="bg-gradient-to-br from-navy to-navy-dark text-white p-6 rounded-lg text-center">
                        <p class="text-sm uppercase tracking-wide mb-2"><?php esc_html_e('Implants at Rubio Dental', 'dental-rubio'); ?></p>
                        <p class="text-4xl font-bold mb-1">$<span id="roiImplantTotal">0</span></p>
                        <p class="text-xs text-gray-300"><?php esc_html_e('Total 15-Year Cost', 'dental-rubio'); ?></p>
                    </div>

                    <!-- Alternative Cost -->
                    <div class="bg-gray-100 p-6 rounded-lg text-center border-2 border-gray-300">
                        <p class="text-sm uppercase tracking-wide mb-2 text-gray-600" id="roiAlternativeLabel"><?php esc_html_e('Alternative Treatment', 'dental-rubio'); ?></p>
                        <p class="text-4xl font-bold mb-1 text-gray-700">$<span id="roiAlternativeTotal">0</span></p>
                        <p class="text-xs text-gray-500"><?php esc_html_e('Total 15-Year Cost', 'dental-rubio'); ?></p>
                    </div>

                    <!-- Savings -->
                    <div class="bg-gradient-to-br from-green-500 to-green-600 text-white p-6 rounded-lg text-center">
                        <p class="text-sm uppercase tracking-wide mb-2"><?php esc_html_e('Your Total Savings', 'dental-rubio'); ?></p>
                        <p class="text-4xl font-bold mb-1">$<span id="roiSavings">0</span></p>
                        <p class="text-xs text-green-100"><?php esc_html_e('Over 15 Years', 'dental-rubio'); ?></p>
                    </div>

                </div>

                <!-- Detailed Breakdown -->
                <div class="bg-blue-50 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-bold text-navy mb-4">
                        <?php esc_html_e('Cost Breakdown Over 15 Years', 'dental-rubio'); ?>
                    </h3>

                    <div class="grid md:grid-cols-2 gap-6">

                        <!-- Implant Breakdown -->
                        <div>
                            <h4 class="font-bold text-navy mb-3">
                                <?php esc_html_e('💎 Dental Implants', 'dental-rubio'); ?>
                            </h4>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex justify-between">
                                    <span><?php esc_html_e('Initial Cost:', 'dental-rubio'); ?></span>
                                    <strong>$<span id="roiImplantInitial">0</span></strong>
                                </li>
                                <li class="flex justify-between">
                                    <span><?php esc_html_e('Maintenance (15 years):', 'dental-rubio'); ?></span>
                                    <strong>$<span id="roiImplantMaintenance">0</span></strong>
                                </li>
                                <li class="flex justify-between">
                                    <span><?php esc_html_e('Replacements Needed:', 'dental-rubio'); ?></span>
                                    <strong><span id="roiImplantReplacements">0</span></strong>
                                </li>
                                <li class="flex justify-between pt-2 border-t border-gray-300">
                                    <span class="font-bold"><?php esc_html_e('15-Year Total:', 'dental-rubio'); ?></span>
                                    <strong class="text-lg">$<span id="roiImplantTotalDetail">0</span></strong>
                                </li>
                            </ul>
                        </div>

                        <!-- Alternative Breakdown -->
                        <div>
                            <h4 class="font-bold text-navy mb-3" id="roiAlternativeBreakdownTitle">
                                <?php esc_html_e('Alternative Treatment', 'dental-rubio'); ?>
                            </h4>
                            <ul class="space-y-2 text-gray-700">
                                <li class="flex justify-between">
                                    <span><?php esc_html_e('Initial Cost:', 'dental-rubio'); ?></span>
                                    <strong>$<span id="roiAltInitial">0</span></strong>
                                </li>
                                <li class="flex justify-between">
                                    <span><?php esc_html_e('Maintenance (15 years):', 'dental-rubio'); ?></span>
                                    <strong>$<span id="roiAltMaintenance">0</span></strong>
                                </li>
                                <li class="flex justify-between">
                                    <span><?php esc_html_e('Replacements Needed:', 'dental-rubio'); ?></span>
                                    <strong><span id="roiAltReplacements">0</span></strong>
                                </li>
                                <li class="flex justify-between pt-2 border-t border-gray-300">
                                    <span class="font-bold"><?php esc_html_e('15-Year Total:', 'dental-rubio'); ?></span>
                                    <strong class="text-lg">$<span id="roiAltTotalDetail">0</span></strong>
                                </li>
                            </ul>
                        </div>

                    </div>
                </div>

                <!-- Key Insights -->
                <div class="bg-gold/10 border-2 border-gold/30 p-6 rounded-lg mb-8">
                    <h3 class="text-xl font-bold text-navy mb-4">
                        <?php esc_html_e('💡 Key Insights', 'dental-rubio'); ?>
                    </h3>
                    <ul class="space-y-2 text-gray-700" id="roiInsights">
                        <!-- Dynamically filled by JavaScript -->
                    </ul>
                </div>

                <!-- CTA -->
                <div class="text-center">
                    <a href="tel:<?php echo esc_attr(preg_replace('/[^0-9]/', '', dental_rubio_get_phone())); ?>"
                       class="btn btn-primary text-xl px-10 py-4 mb-3">
                        <?php esc_html_e('Get Your Free Consultation', 'dental-rubio'); ?>
                    </a>
                    <p class="text-sm text-gray-600">
                        <?php esc_html_e('Speak with our team to verify these savings for your specific case.', 'dental-rubio'); ?>
                    </p>
                </div>

            </div>

        </div>

        <!-- Disclaimer -->
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>
                <?php esc_html_e('* Estimates based on average costs and typical replacement schedules. Your actual costs may vary. Implant prices at Rubio Dental use premium Straumann implants from Germany.', 'dental-rubio'); ?>
            </p>
        </div>

    </div>
</section>

<script>
(function() {
    'use strict';

    // ROI Calculator Logic
    const roiForm = document.getElementById('roiCalculatorForm');
    const calculateBtn = document.getElementById('calculateROI');
    const resultsDiv = document.getElementById('roiResults');
    const treatmentSelect = document.getElementById('roiTreatment');
    const teethCountGroup = document.getElementById('teethCountGroup');

    // Show/hide teeth count based on treatment
    treatmentSelect.addEventListener('change', function() {
        if (this.value === 'multiple-implants') {
            teethCountGroup.classList.remove('hidden');
        } else {
            teethCountGroup.classList.add('hidden');
        }
    });

    // Pricing data
    const pricingData = {
        implants: {
            rubio: {
                'single-implant': 1350,
                'multiple-implants': 1350, // per tooth
                'all-on-4': 9500,
                'full-mouth': 19000
            },
            usa: {
                arizona: { single: 4500, perTooth: 4500, allOn4: 50000, fullMouth: 100000 },
                california: { single: 5000, perTooth: 5000, allOn4: 55000, fullMouth: 110000 },
                texas: { single: 4500, perTooth: 4500, allOn4: 50000, fullMouth: 100000 },
                nevada: { single: 4800, perTooth: 4800, allOn4: 52000, fullMouth: 104000 },
                canada: { single: 6000, perTooth: 6000, allOn4: 65000, fullMouth: 130000 },
                'other-us': { single: 4800, perTooth: 4800, allOn4: 51000, fullMouth: 102000 }
            }
        },
        alternatives: {
            dentures: {
                initial: 2500,
                replacement: 2000,
                yearsBetweenReplacement: 5,
                annualMaintenance: 200
            },
            bridge: {
                initial: 4000,
                replacement: 3500,
                yearsBetweenReplacement: 10,
                annualMaintenance: 150
            },
            partial: {
                initial: 1800,
                replacement: 1500,
                yearsBetweenReplacement: 6,
                annualMaintenance: 180
            },
            'do-nothing': {
                initial: 0,
                boneLoss: 500, // annual cost of bone loss consequences
                annualMaintenance: 0
            }
        }
    };

    calculateBtn.addEventListener('click', function() {
        const treatment = document.getElementById('roiTreatment').value;
        const location = document.getElementById('roiLocation').value;
        const alternative = document.getElementById('roiAlternative').value;
        const teethCount = parseInt(document.getElementById('roiTeethCount').value) || 4;

        if (!treatment || !location || !alternative) {
            alert('<?php esc_html_e('Please fill in all fields', 'dental-rubio'); ?>');
            return;
        }

        // Calculate implant cost
        let implantInitial = pricingData.implants.rubio[treatment];
        if (treatment === 'multiple-implants') {
            implantInitial *= teethCount;
        }

        const implantMaintenance = 50 * 15; // $50/year for 15 years
        const implantReplacements = 0; // Straumann implants last 25+ years
        const implantTotal = implantInitial + implantMaintenance;

        // Calculate alternative cost
        const altData = pricingData.alternatives[alternative];
        let altInitial = altData.initial;
        let altMaintenance = altData.annualMaintenance * 15;
        let altReplacements = 0;
        let altReplacementCost = 0;

        if (alternative !== 'do-nothing') {
            altReplacements = Math.floor(15 / altData.yearsBetweenReplacement);
            altReplacementCost = altReplacements * altData.replacement;
        } else {
            altMaintenance = altData.boneLoss * 15;
        }

        const altTotal = altInitial + altMaintenance + altReplacementCost;

        // Calculate savings
        const savings = altTotal - implantTotal;

        // Update UI
        document.getElementById('roiImplantTotal').textContent = implantTotal.toLocaleString();
        document.getElementById('roiAlternativeTotal').textContent = altTotal.toLocaleString();
        document.getElementById('roiSavings').textContent = Math.abs(savings).toLocaleString();

        document.getElementById('roiImplantInitial').textContent = implantInitial.toLocaleString();
        document.getElementById('roiImplantMaintenance').textContent = implantMaintenance.toLocaleString();
        document.getElementById('roiImplantReplacements').textContent = implantReplacements;
        document.getElementById('roiImplantTotalDetail').textContent = implantTotal.toLocaleString();

        document.getElementById('roiAltInitial').textContent = altInitial.toLocaleString();
        document.getElementById('roiAltMaintenance').textContent = (altMaintenance + altReplacementCost).toLocaleString();
        document.getElementById('roiAltReplacements').textContent = altReplacements;
        document.getElementById('roiAltTotalDetail').textContent = altTotal.toLocaleString();

        // Update labels
        const altNames = {
            'dentures': '🦷 Dentures',
            'bridge': '🌉 Fixed Bridge',
            'partial': '🦷 Partial Denture',
            'do-nothing': '❌ No Treatment'
        };
        document.getElementById('roiAlternativeLabel').textContent = altNames[alternative];
        document.getElementById('roiAlternativeBreakdownTitle').textContent = altNames[alternative];

        // Generate insights
        const insights = [];

        if (savings > 0) {
            insights.push(`Implants save you $${Math.abs(savings).toLocaleString()} over 15 years compared to ${altNames[alternative].replace(/[^\w\s]/g, '')}.`);
        } else {
            insights.push(`While implants cost more initially, they provide superior quality of life and longevity.`);
        }

        insights.push(`Implants require ${implantReplacements} replacements vs ${altReplacements} for ${altNames[alternative].replace(/[^\w\s]/g, '')}.`);
        insights.push(`Average annual cost: $${Math.round(implantTotal/15).toLocaleString()} for implants vs $${Math.round(altTotal/15).toLocaleString()} for alternative.`);
        insights.push(`Straumann implants have a 98.8% success rate and can last 25+ years with proper care.`);

        if (alternative === 'dentures' || alternative === 'partial') {
            insights.push(`Implants prevent bone loss, which costs an estimated $500/year in oral health complications.`);
        }

        const insightsList = document.getElementById('roiInsights');
        insightsList.innerHTML = insights.map(insight =>
            `<li class="flex items-start gap-2"><span class="text-green-600 flex-shrink-0">✓</span><span>${insight}</span></li>`
        ).join('');

        // Show results with animation
        resultsDiv.classList.remove('hidden');
        resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    });
})();
</script>
