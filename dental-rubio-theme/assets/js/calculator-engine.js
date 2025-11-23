/**
 * Calculator Engine
 *
 * Dental savings calculator functionality.
 *
 * @package DentalRubio
 */

(function() {
    'use strict';

    /**
     * Pricing Data
     */
    const PRICING = {
        // USA prices by location
        usa: {
            arizona: {
                implant: 4500,
                crown: 1200,
                'all-on-4': 50000,
                dentures: 2500,
                veneers: 1200,
                bridge: 3600,
                'root-canal': 1500,
                extraction: 400,
                cleaning: 200,
                whitening: 500
            },
            california: {
                implant: 5000,
                crown: 1400,
                'all-on-4': 55000,
                dentures: 3000,
                veneers: 1400,
                bridge: 4200,
                'root-canal': 1800,
                extraction: 500,
                cleaning: 250,
                whitening: 600
            },
            texas: {
                implant: 4500,
                crown: 1200,
                'all-on-4': 50000,
                dentures: 2500,
                veneers: 1200,
                bridge: 3600,
                'root-canal': 1500,
                extraction: 400,
                cleaning: 200,
                whitening: 500
            },
            canada: {
                implant: 6000,
                crown: 1600,
                'all-on-4': 65000,
                dentures: 3500,
                veneers: 1600,
                bridge: 4800,
                'root-canal': 2000,
                extraction: 600,
                cleaning: 300,
                whitening: 700
            },
            'other-us': {
                implant: 4500,
                crown: 1200,
                'all-on-4': 50000,
                dentures: 2500,
                veneers: 1200,
                bridge: 3600,
                'root-canal': 1500,
                extraction: 400,
                cleaning: 200,
                whitening: 500
            }
        },
        // Rubio Dental prices
        rubio: {
            implant: 1350,
            crown: 350,
            'all-on-4': 9500,
            dentures: 800,
            veneers: 420,
            bridge: 1050,
            'root-canal': 350,
            extraction: 80,
            cleaning: 60,
            whitening: 150
        }
    };

    /**
     * Service Labels
     */
    const SERVICE_LABELS = {
        implant: 'Single Dental Implant',
        crown: 'Dental Crown',
        'all-on-4': 'All-on-4 (per arch)',
        dentures: 'Full Dentures',
        veneers: 'Veneer (per tooth)',
        bridge: '3-Unit Bridge',
        'root-canal': 'Root Canal',
        extraction: 'Tooth Extraction',
        cleaning: 'Dental Cleaning',
        whitening: 'Teeth Whitening'
    };

    /**
     * Location Labels
     */
    const LOCATION_LABELS = {
        arizona: 'Arizona',
        california: 'California',
        texas: 'Texas',
        canada: 'Canada',
        'other-us': 'Other US States'
    };

    /**
     * DOM Ready
     */
    document.addEventListener('DOMContentLoaded', function() {
        initSavingsCalculator();
        initAllOn4Calculator();
        initTripCostCalculator();
    });

    /**
     * Initialize Savings Calculator
     */
    function initSavingsCalculator() {
        const form = document.getElementById('savingsCalculator');
        if (!form) return;

        const serviceSelect = form.querySelector('#service, [name="service"]');
        const locationSelect = form.querySelector('#location, [name="location"]');
        const quantityInput = form.querySelector('#quantity, [name="quantity"]');
        const resultsDiv = document.getElementById('savingsResults') || document.getElementById('results');

        if (!serviceSelect || !locationSelect || !resultsDiv) return;

        // Calculate on change
        const calculate = function() {
            const service = serviceSelect.value;
            const location = locationSelect.value;
            const quantity = quantityInput ? parseInt(quantityInput.value) || 1 : 1;

            if (!service || !location) {
                resultsDiv.classList.add('hidden');
                return;
            }

            const usaPrice = PRICING.usa[location]?.[service];
            const rubioPrice = PRICING.rubio[service];

            if (!usaPrice || !rubioPrice) return;

            const totalUsaPrice = usaPrice * quantity;
            const totalRubioPrice = rubioPrice * quantity;
            const savings = totalUsaPrice - totalRubioPrice;
            const percentage = Math.round((savings / totalUsaPrice) * 100);

            // Update results
            const locationName = LOCATION_LABELS[location] || location;
            const serviceName = SERVICE_LABELS[service] || service;

            resultsDiv.innerHTML = `
                <div class="results-card bg-green-50 p-6 rounded-lg border-2 border-green-200">
                    <h3 class="font-bold text-xl mb-4 text-navy">Your Savings Estimate</h3>

                    <div class="result-service mb-4">
                        <span class="text-secondary">${quantity > 1 ? quantity + 'x ' : ''}${serviceName}</span>
                    </div>

                    <div class="space-y-3 mb-6">
                        <div class="flex justify-between items-center">
                            <span>In ${locationName}:</span>
                            <span class="font-semibold">$${totalUsaPrice.toLocaleString()}</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span>At Rubio Dental:</span>
                            <span class="font-bold text-gold text-xl">$${totalRubioPrice.toLocaleString()}</span>
                        </div>
                        <hr class="border-green-300">
                        <div class="flex justify-between items-center">
                            <span class="font-bold">YOU SAVE:</span>
                            <span class="font-bold text-2xl text-green-600">
                                $${savings.toLocaleString()} (${percentage}%)
                            </span>
                        </div>
                    </div>

                    <p class="text-sm text-gray-600 mb-4">
                        *Premium Straumann implants included. Lifetime warranty available.
                        Prices are estimates and may vary based on individual treatment plans.
                    </p>

                    <div class="flex flex-col sm:flex-row gap-3">
                        <a href="tel:+1${(window.dentalRubio?.phone || '').replace(/\D/g, '')}"
                           class="btn btn-primary flex-1">
                            Get Your Free Quote
                        </a>
                        <a href="#contact" class="btn btn-gold flex-1">
                            Chat With Us
                        </a>
                    </div>
                </div>
            `;

            resultsDiv.classList.remove('hidden');

            // Track calculation event
            trackCalculatorEvent('savings_calculated', {
                service: service,
                location: location,
                quantity: quantity,
                savings: savings
            });
        };

        serviceSelect.addEventListener('change', calculate);
        locationSelect.addEventListener('change', calculate);
        if (quantityInput) {
            quantityInput.addEventListener('change', calculate);
            quantityInput.addEventListener('input', calculate);
        }
    }

    /**
     * Initialize All-on-4 Calculator
     */
    function initAllOn4Calculator() {
        const form = document.getElementById('allOn4Calculator');
        if (!form) return;

        const archesSelect = form.querySelector('#arches, [name="arches"]');
        const locationSelect = form.querySelector('#location, [name="location"]');
        const resultsDiv = document.getElementById('allOn4Results');

        if (!archesSelect || !locationSelect || !resultsDiv) return;

        const calculate = function() {
            const arches = parseInt(archesSelect.value) || 1;
            const location = locationSelect.value;

            if (!location) {
                resultsDiv.classList.add('hidden');
                return;
            }

            const usaPricePerArch = PRICING.usa[location]?.['all-on-4'] || 50000;
            const rubioPricePerArch = PRICING.rubio['all-on-4'];

            const totalUsaPrice = usaPricePerArch * arches;
            const totalRubioPrice = rubioPricePerArch * arches;
            const savings = totalUsaPrice - totalRubioPrice;

            resultsDiv.innerHTML = `
                <div class="results-card bg-navy text-white p-8 rounded-lg">
                    <h3 class="font-bold text-2xl mb-2 text-gold">All-on-4 Savings</h3>
                    <p class="text-gray-300 mb-6">${arches} ${arches === 1 ? 'Arch' : 'Arches'} (${arches * 4} Implants)</p>

                    <div class="grid grid-cols-2 gap-6 mb-6">
                        <div>
                            <p class="text-sm text-gray-400">In ${LOCATION_LABELS[location]}</p>
                            <p class="text-2xl font-bold line-through text-gray-400">
                                $${totalUsaPrice.toLocaleString()}
                            </p>
                        </div>
                        <div>
                            <p class="text-sm text-gold">At Rubio Dental</p>
                            <p class="text-3xl font-bold text-gold">
                                $${totalRubioPrice.toLocaleString()}
                            </p>
                        </div>
                    </div>

                    <div class="bg-green-600 p-4 rounded-lg text-center mb-6">
                        <p class="text-sm">YOUR TOTAL SAVINGS</p>
                        <p class="text-4xl font-bold">$${savings.toLocaleString()}</p>
                    </div>

                    <div class="text-sm text-gray-300 mb-6">
                        <p class="font-semibold mb-2">Package Includes:</p>
                        <ul class="space-y-1">
                            <li>&#10003; ${arches * 4} Straumann Implants (German Quality)</li>
                            <li>&#10003; Temporary Teeth (Same Day)</li>
                            <li>&#10003; Final Prosthesis</li>
                            <li>&#10003; All X-rays & 3D Scans</li>
                            <li>&#10003; Lifetime Warranty on Implants</li>
                        </ul>
                    </div>

                    <a href="tel:+1${(window.dentalRubio?.phone || '').replace(/\D/g, '')}"
                       class="btn btn-gold btn-block">
                        Schedule Free Consultation
                    </a>
                </div>
            `;

            resultsDiv.classList.remove('hidden');

            // Track event
            trackCalculatorEvent('allOn4_calculated', {
                arches: arches,
                location: location,
                savings: savings
            });
        };

        archesSelect.addEventListener('change', calculate);
        locationSelect.addEventListener('change', calculate);
    }

    /**
     * Initialize Trip Cost Calculator
     */
    function initTripCostCalculator() {
        const form = document.getElementById('tripCostCalculator');
        if (!form) return;

        const calculate = function() {
            const nights = parseInt(form.querySelector('[name="nights"]')?.value) || 3;
            const hotelType = form.querySelector('[name="hotel"]')?.value || 'mid';
            const travelers = parseInt(form.querySelector('[name="travelers"]')?.value) || 1;
            const dentalCost = parseFloat(form.querySelector('[name="dental"]')?.value) || 1350;

            const hotelPrices = {
                budget: 50,
                mid: 80,
                premium: 150
            };

            const hotelCost = hotelPrices[hotelType] * nights;
            const transportCost = 0; // Free shuttle
            const mealsCost = 30 * nights * travelers; // Estimate
            const totalTripCost = hotelCost + mealsCost + dentalCost;

            const resultsDiv = document.getElementById('tripCostResults');
            if (resultsDiv) {
                resultsDiv.innerHTML = `
                    <div class="results-card p-6 bg-light rounded-lg">
                        <h3 class="font-bold text-xl mb-4">Estimated Trip Cost</h3>
                        <div class="space-y-2 mb-4">
                            <div class="flex justify-between">
                                <span>Dental Treatment:</span>
                                <span class="font-semibold">$${dentalCost.toLocaleString()}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Hotel (${nights} nights):</span>
                                <span class="font-semibold">$${hotelCost.toLocaleString()}</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Transportation:</span>
                                <span class="font-semibold text-green-600">FREE</span>
                            </div>
                            <div class="flex justify-between">
                                <span>Estimated Meals:</span>
                                <span class="font-semibold">$${mealsCost.toLocaleString()}</span>
                            </div>
                            <hr>
                            <div class="flex justify-between text-xl">
                                <span class="font-bold">Total Trip Cost:</span>
                                <span class="font-bold text-gold">$${totalTripCost.toLocaleString()}</span>
                            </div>
                        </div>
                    </div>
                `;
                resultsDiv.classList.remove('hidden');
            }
        };

        form.querySelectorAll('input, select').forEach(function(el) {
            el.addEventListener('change', calculate);
            el.addEventListener('input', calculate);
        });
    }

    /**
     * Track Calculator Events
     */
    function trackCalculatorEvent(eventName, data) {
        // Google Analytics
        if (typeof gtag === 'function') {
            gtag('event', eventName, {
                'event_category': 'Calculator',
                'event_label': data.service || data.arches || 'trip',
                'value': data.savings || 0
            });
        }

        // Facebook Pixel
        if (typeof fbq === 'function') {
            fbq('trackCustom', eventName, data);
        }

        // Custom event
        window.dispatchEvent(new CustomEvent('dentalRubio:calculatorUsed', {
            detail: { event: eventName, data: data }
        }));
    }

    /**
     * Public API
     */
    window.DentalCalculator = {
        PRICING: PRICING,
        SERVICE_LABELS: SERVICE_LABELS,
        LOCATION_LABELS: LOCATION_LABELS,
        calculateSavings: function(service, location, quantity) {
            quantity = quantity || 1;
            const usaPrice = PRICING.usa[location]?.[service];
            const rubioPrice = PRICING.rubio[service];
            if (!usaPrice || !rubioPrice) return null;
            return {
                usaPrice: usaPrice * quantity,
                rubioPrice: rubioPrice * quantity,
                savings: (usaPrice - rubioPrice) * quantity,
                percentage: Math.round(((usaPrice - rubioPrice) / usaPrice) * 100)
            };
        }
    };

})();
