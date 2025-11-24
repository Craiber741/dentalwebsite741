<?php
/**
 * Contact Form Component
 * Senior-friendly contact form for lead generation
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get form title from args (optional)
$form_title = isset($args['title']) ? $args['title'] : 'Get Your Free Quote';
$form_subtitle = isset($args['subtitle']) ? $args['subtitle'] : 'Fill out this form and we\'ll call you within 2 hours';
?>

<section class="contact-form-section py-12 md:py-16 bg-gradient-to-br from-green-50 to-white">
    <div class="container mx-auto px-4 max-w-3xl">

        <!-- Section Header -->
        <div class="text-center mb-8 md:mb-10">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                <?php echo esc_html($form_title); ?>
            </h2>
            <p class="text-base md:text-lg text-gray-600">
                <?php echo esc_html($form_subtitle); ?>
            </p>
        </div>

        <!-- Contact Form -->
        <div class="bg-white rounded-2xl shadow-2xl p-6 md:p-10 border-2 border-green-200">

            <form id="dentalContactForm" class="space-y-6" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">

                <input type="hidden" name="action" value="dental_rubio_contact_form">
                <input type="hidden" name="page_source" value="<?php echo esc_attr(get_the_title()); ?>">
                <?php wp_nonce_field('dental_contact_form', 'contact_nonce'); ?>

                <!-- Name -->
                <div class="form-group">
                    <label for="contactName" class="block text-lg font-bold text-gray-800 mb-2">
                        Your Name <span class="text-red-600">*</span>
                    </label>
                    <input type="text" id="contactName" name="name"
                           class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                           placeholder="John Smith"
                           required>
                </div>

                <!-- Phone -->
                <div class="form-group">
                    <label for="contactPhone" class="block text-lg font-bold text-gray-800 mb-2">
                        Phone Number <span class="text-red-600">*</span>
                    </label>
                    <input type="tel" id="contactPhone" name="phone"
                           class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                           placeholder="(555) 123-4567"
                           required>
                    <p class="text-sm text-gray-600 mt-2">We'll call you at this number</p>
                </div>

                <!-- Email -->
                <div class="form-group">
                    <label for="contactEmail" class="block text-lg font-bold text-gray-800 mb-2">
                        Email Address <span class="text-red-600">*</span>
                    </label>
                    <input type="email" id="contactEmail" name="email"
                           class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                           placeholder="john@example.com"
                           required>
                </div>

                <!-- Service Interest -->
                <div class="form-group">
                    <label for="contactService" class="block text-lg font-bold text-gray-800 mb-2">
                        What are you interested in?
                    </label>
                    <select id="contactService" name="service"
                            class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all cursor-pointer">
                        <option value="">Select a service...</option>
                        <option value="dental-implants">Dental Implants</option>
                        <option value="all-on-4">All-on-4 Implants</option>
                        <option value="crowns">Crowns & Bridges</option>
                        <option value="dentures">Dentures</option>
                        <option value="veneers">Veneers</option>
                        <option value="cosmetic">Cosmetic Dentistry</option>
                        <option value="general">General Dentistry</option>
                        <option value="not-sure">Not Sure / Multiple</option>
                    </select>
                </div>

                <!-- Message (Optional) -->
                <div class="form-group">
                    <label for="contactMessage" class="block text-lg font-bold text-gray-800 mb-2">
                        Additional Information <span class="text-gray-500">(Optional)</span>
                    </label>
                    <textarea id="contactMessage" name="message" rows="4"
                              class="w-full px-4 py-4 text-lg border-2 border-gray-300 rounded-lg focus:border-green-500 focus:ring-2 focus:ring-green-200 transition-all"
                              placeholder="Tell us more about your dental needs..."></textarea>
                </div>

                <!-- Submit Button -->
                <button type="submit" id="contactSubmitBtn"
                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold text-xl py-5 px-8 rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                    <svg class="inline-block w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <span id="contactBtnText">Get Your Free Quote</span>
                </button>

                <!-- Response Message -->
                <div id="contactFormResponse" class="hidden mt-6"></div>

            </form>

            <!-- Trust Badges -->
            <div class="mt-8 pt-6 border-t border-gray-200 flex flex-wrap justify-center items-center gap-4 md:gap-8 text-sm text-gray-600">
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">No Obligation</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">Fast Response</span>
                </div>
                <div class="flex items-center gap-2">
                    <svg class="w-5 h-5 text-green-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                    </svg>
                    <span class="font-semibold">Privacy Protected</span>
                </div>
            </div>

        </div>

    </div>
</section>

<script>
(function() {
    'use strict';

    const form = document.getElementById('dentalContactForm');
    if (!form) return;

    const submitBtn = document.getElementById('contactSubmitBtn');
    const btnText = document.getElementById('contactBtnText');
    const responseDiv = document.getElementById('contactFormResponse');

    form.addEventListener('submit', function(e) {
        e.preventDefault();

        // Disable button
        submitBtn.disabled = true;
        btnText.textContent = 'Sending...';

        // Get form data
        const formData = new FormData(form);

        // Send via AJAX
        fetch(form.action, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Success message
                responseDiv.innerHTML = `
                    <div class="bg-green-100 border-2 border-green-400 text-green-900 px-6 py-5 rounded-lg">
                        <div class="flex items-start gap-3">
                            <svg class="w-6 h-6 text-green-600 flex-shrink-0 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <div>
                                <p class="font-bold text-lg mb-1">Thank You!</p>
                                <p>${data.data.message || 'We received your request and will call you within 2 hours during business hours.'}</p>
                            </div>
                        </div>
                    </div>
                `;
                responseDiv.classList.remove('hidden');

                // Reset form
                form.reset();

                // Scroll to response
                responseDiv.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
            } else {
                // Error message
                responseDiv.innerHTML = `
                    <div class="bg-red-100 border-2 border-red-400 text-red-900 px-6 py-5 rounded-lg">
                        <p class="font-bold">Oops! Something went wrong.</p>
                        <p>Please call us directly at <?php echo esc_html(dental_rubio_get_phone()); ?></p>
                    </div>
                `;
                responseDiv.classList.remove('hidden');
            }

            // Re-enable button
            submitBtn.disabled = false;
            btnText.textContent = 'Get Your Free Quote';
        })
        .catch(error => {
            console.error('Error:', error);
            responseDiv.innerHTML = `
                <div class="bg-red-100 border-2 border-red-400 text-red-900 px-6 py-5 rounded-lg">
                    <p class="font-bold">Connection Error</p>
                    <p>Please call us directly at <?php echo esc_html(dental_rubio_get_phone()); ?></p>
                </div>
            `;
            responseDiv.classList.remove('hidden');

            // Re-enable button
            submitBtn.disabled = false;
            btnText.textContent = 'Get Your Free Quote';
        });
    });

})();
</script>
