<?php
/**
 * Payment Plan Calculator
 * Calculate monthly payments for dental treatments
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section id="payment-plan-calculator" class="payment-calculator py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                Payment Plan Calculator
            </h2>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                See your flexible payment options - make your dental care affordable
            </p>
        </div>

        <!-- Calculator Form -->
        <div class="bg-gradient-to-br from-gray-50 to-white rounded-2xl shadow-xl p-6 md:p-8 border-2 border-gray-200">
            <form id="paymentPlanForm" class="space-y-6">

                <!-- Treatment Cost -->
                <div class="form-group">
                    <label for="paymentTreatmentCost" class="block text-lg font-bold text-gray-800 mb-3">
                        Total Treatment Cost
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-xl">$</span>
                        <input type="number" id="paymentTreatmentCost" name="cost"
                               min="100" max="50000" value="9500" step="100"
                               class="w-full pl-10 pr-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200"
                               required>
                    </div>
                    <div class="mt-3 flex flex-wrap gap-2">
                        <button type="button" onclick="document.getElementById('paymentTreatmentCost').value = 1350; document.getElementById('paymentPlanForm').dispatchEvent(new Event('change'));"
                                class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-900 rounded-lg text-sm font-semibold transition-colors">
                            Implant ($1,350)
                        </button>
                        <button type="button" onclick="document.getElementById('paymentTreatmentCost').value = 9500; document.getElementById('paymentPlanForm').dispatchEvent(new Event('change'));"
                                class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-900 rounded-lg text-sm font-semibold transition-colors">
                            All-on-4 ($9,500)
                        </button>
                        <button type="button" onclick="document.getElementById('paymentTreatmentCost').value = 420; document.getElementById('paymentPlanForm').dispatchEvent(new Event('change'));"
                                class="px-4 py-2 bg-blue-100 hover:bg-blue-200 text-blue-900 rounded-lg text-sm font-semibold transition-colors">
                            Veneer ($420)
                        </button>
                    </div>
                </div>

                <!-- Down Payment -->
                <div class="form-group">
                    <label for="paymentDownPayment" class="block text-lg font-bold text-gray-800 mb-3">
                        Down Payment (Optional)
                    </label>
                    <div class="relative">
                        <span class="absolute left-4 top-1/2 transform -translate-y-1/2 text-gray-500 text-xl">$</span>
                        <input type="number" id="paymentDownPayment" name="down"
                               min="0" max="50000" value="0" step="100"
                               class="w-full pl-10 pr-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    </div>
                    <p class="text-sm text-gray-600 mt-2">How much can you pay upfront?</p>
                </div>

                <!-- Payment Period -->
                <div class="form-group">
                    <label for="paymentMonths" class="block text-lg font-bold text-gray-800 mb-3">
                        Payment Period (Months)
                    </label>
                    <select id="paymentMonths" name="months"
                            class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200 transition-all cursor-pointer"
                            required>
                        <option value="3">3 Months</option>
                        <option value="6" selected>6 Months</option>
                        <option value="12">12 Months (1 Year)</option>
                        <option value="18">18 Months</option>
                        <option value="24">24 Months (2 Years)</option>
                        <option value="36">36 Months (3 Years)</option>
                    </select>
                </div>

                <!-- Interest Rate -->
                <div class="form-group">
                    <label for="paymentInterest" class="block text-lg font-bold text-gray-800 mb-3">
                        Interest Rate (Annual %)
                    </label>
                    <input type="number" id="paymentInterest" name="interest"
                           min="0" max="30" value="0" step="0.5"
                           class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-blue-500 focus:ring-2 focus:ring-blue-200">
                    <p class="text-sm text-green-600 mt-2 font-semibold">✓ We offer 0% interest for 6-12 month plans!</p>
                </div>

                <!-- Results Panel (populated by JavaScript) -->
                <div id="paymentPlanResults" class="hidden mt-8"></div>

            </form>
        </div>

        <!-- Trust Elements -->
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>✓ Flexible Terms • ✓ No Hidden Fees • ✓ 0% Interest Available</p>
        </div>

    </div>
</section>

<script>
(function() {
    'use strict';

    const form = document.getElementById('paymentPlanForm');
    if (!form) return;

    const costInput = document.getElementById('paymentTreatmentCost');
    const downInput = document.getElementById('paymentDownPayment');
    const monthsSelect = document.getElementById('paymentMonths');
    const interestInput = document.getElementById('paymentInterest');
    const resultsDiv = document.getElementById('paymentPlanResults');

    function calculatePaymentPlan() {
        const totalCost = parseFloat(costInput.value) || 0;
        const downPayment = parseFloat(downInput.value) || 0;
        const months = parseInt(monthsSelect.value) || 6;
        const annualRate = parseFloat(interestInput.value) || 0;

        if (!totalCost || totalCost <= 0) {
            resultsDiv.classList.add('hidden');
            return;
        }

        const principal = totalCost - downPayment;
        const monthlyRate = annualRate / 100 / 12;

        let monthlyPayment;
        let totalInterest;

        if (annualRate === 0 || monthlyRate === 0) {
            // No interest
            monthlyPayment = principal / months;
            totalInterest = 0;
        } else {
            // Calculate with interest using amortization formula
            monthlyPayment = principal * (monthlyRate * Math.pow(1 + monthlyRate, months)) /
                            (Math.pow(1 + monthlyRate, months) - 1);
            totalInterest = (monthlyPayment * months) - principal;
        }

        const totalPaid = downPayment + (monthlyPayment * months);
        const savingsVsUSA = (totalCost * 3.3) - totalCost; // Average 70% savings

        // Display results
        resultsDiv.innerHTML = `
            <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 md:p-8 rounded-xl border-2 border-blue-300 shadow-lg">

                <!-- Monthly Payment (Big Display) -->
                <div class="text-center mb-8 bg-white rounded-xl p-8 shadow-md">
                    <p class="text-sm text-gray-600 mb-2 uppercase tracking-wide font-semibold">Your Monthly Payment</p>
                    <p class="text-5xl md:text-6xl font-bold text-blue-900 mb-2">
                        $${monthlyPayment.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}
                    </p>
                    <p class="text-gray-600">for ${months} months</p>
                </div>

                <!-- Payment Breakdown -->
                <div class="space-y-3 mb-6">
                    ${downPayment > 0 ? `
                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                        <span class="text-gray-700 font-semibold">Down Payment (Today):</span>
                        <span class="text-xl font-bold text-gray-900">$${downPayment.toLocaleString()}</span>
                    </div>
                    ` : ''}
                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                        <span class="text-gray-700 font-semibold">Amount to Finance:</span>
                        <span class="text-lg font-semibold text-gray-800">$${principal.toLocaleString()}</span>
                    </div>
                    ${totalInterest > 0 ? `
                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                        <span class="text-gray-700">Total Interest (${annualRate}% APR):</span>
                        <span class="text-lg font-semibold text-orange-600">$${totalInterest.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</span>
                    </div>
                    ` : `
                    <div class="flex justify-between items-center py-2 border-b border-blue-200">
                        <span class="text-gray-700">Interest:</span>
                        <span class="text-lg font-bold text-green-600">$0 (0% APR) 🎉</span>
                    </div>
                    `}
                    <div class="flex justify-between items-center py-3 bg-white rounded-lg px-4 mt-4">
                        <span class="text-lg font-bold text-gray-900">Total Amount Paid:</span>
                        <span class="text-2xl font-bold text-blue-900">$${totalPaid.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')}</span>
                    </div>
                </div>

                <!-- Savings Info -->
                <div class="bg-green-600 text-white rounded-lg p-6 mb-6">
                    <div class="flex items-start gap-3 mb-3">
                        <svg class="w-8 h-8 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <div>
                            <p class="font-bold text-lg mb-1">You're Still Saving Big!</p>
                            <p class="text-green-100">
                                Even with financing, you save approximately <strong class="text-yellow-300">$${savingsVsUSA.toLocaleString()}</strong>
                                compared to having this done in the USA.
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Payment Schedule Preview -->
                <div class="bg-white rounded-lg p-4 mb-6">
                    <p class="font-semibold text-gray-900 mb-3">Your Payment Schedule:</p>
                    <div class="space-y-2 text-sm">
                        ${downPayment > 0 ? `<p class="text-gray-700">• Today: $${downPayment.toLocaleString()} down payment</p>` : ''}
                        <p class="text-gray-700">• Months 1-${months}: $${monthlyPayment.toFixed(2).replace(/\B(?=(\d{3})+(?!\d))/g, ',')} per month</p>
                        <p class="text-gray-700">• Total payments: ${downPayment > 0 ? (months + 1) : months}</p>
                        ${annualRate === 0 ? '<p class="text-green-600 font-semibold">• 0% interest - No extra charges!</p>' : ''}
                    </div>
                </div>

                <!-- CTA -->
                <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
                   class="block w-full bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg md:text-xl py-5 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105 text-center">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call to Apply for Financing
                </a>

                <p class="text-center text-sm text-gray-600 mt-4">
                    Approval usually takes 24-48 hours
                </p>

            </div>
        `;

        resultsDiv.classList.remove('hidden');

        // Scroll to results
        resultsDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    // Calculate on change
    form.addEventListener('change', calculatePaymentPlan);
    form.addEventListener('input', calculatePaymentPlan);

    // Initial calculation
    calculatePaymentPlan();

})();
</script>
