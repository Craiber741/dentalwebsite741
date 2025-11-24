<?php
/**
 * How It Works Section
 * 3-step process for seniors to understand the journey
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section class="how-it-works py-16 md:py-20 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Section Header -->
        <div class="text-center mb-16">
            <h2 class="text-3xl md:text-4xl font-bold text-blue-900 mb-4">
                How It Works
            </h2>
            <p class="text-lg md:text-xl text-gray-600">
                Getting your new smile is simple and stress-free
            </p>
        </div>

        <!-- Steps -->
        <div class="relative">

            <!-- Connecting Line (hidden on mobile) -->
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 top-0 bottom-0 w-1 bg-blue-200"></div>

            <div class="space-y-12 md:space-y-16">

                <!-- Step 1 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-center">
                    <!-- Number Badge -->
                    <div class="flex-shrink-0 relative z-10">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-gradient-to-br from-blue-600 to-blue-700 text-white flex items-center justify-center shadow-xl border-4 border-white">
                            <span class="text-3xl md:text-4xl font-bold">1</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 bg-blue-50 rounded-xl p-6 md:p-8 shadow-lg border border-blue-100">
                        <h3 class="text-2xl md:text-3xl font-bold text-blue-900 mb-3">
                            Get Your Free Quote
                        </h3>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-4">
                            Call or chat with us on WhatsApp. We'll give you exact pricing in 5 minutes.
                            No hidden fees, no surprises, no pressure.
                        </p>
                        <div class="flex flex-wrap gap-3">
                            <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
                               class="inline-flex items-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-semibold rounded-lg shadow hover:shadow-lg transition-all">
                                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                                </svg>
                                Call Now
                            </a>
                            <a href="https://wa.me/<?php echo esc_attr(dental_rubio_get_whatsapp()); ?>"
                               target="_blank"
                               rel="noopener noreferrer"
                               class="inline-flex items-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-semibold rounded-lg shadow hover:shadow-lg transition-all">
                                <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                                    <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                                </svg>
                                WhatsApp
                            </a>
                        </div>
                    </div>
                </div>

                <!-- Arrow Down (hidden on mobile) -->
                <div class="hidden md:flex justify-center">
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>

                <!-- Step 2 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-center">
                    <!-- Number Badge -->
                    <div class="flex-shrink-0 relative z-10">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-gradient-to-br from-green-600 to-green-700 text-white flex items-center justify-center shadow-xl border-4 border-white">
                            <span class="text-3xl md:text-4xl font-bold">2</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 bg-green-50 rounded-xl p-6 md:p-8 shadow-lg border border-green-100">
                        <h3 class="text-2xl md:text-3xl font-bold text-blue-900 mb-3">
                            Schedule Your Visit
                        </h3>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-4">
                            Choose your preferred date and time. We'll arrange everything including free shuttle
                            transportation from the Yuma border crossing and hotel recommendations.
                        </p>
                        <ul class="space-y-2 text-gray-700">
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Free shuttle from Yuma border</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Flexible scheduling - mornings & afternoons</span>
                            </li>
                            <li class="flex items-start gap-2">
                                <svg class="w-5 h-5 text-green-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                </svg>
                                <span>Hotel recommendations nearby</span>
                            </li>
                        </ul>
                    </div>
                </div>

                <!-- Arrow Down (hidden on mobile) -->
                <div class="hidden md:flex justify-center">
                    <svg class="w-12 h-12 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                    </svg>
                </div>

                <!-- Step 3 -->
                <div class="flex flex-col md:flex-row gap-6 md:gap-8 items-center">
                    <!-- Number Badge -->
                    <div class="flex-shrink-0 relative z-10">
                        <div class="w-20 h-20 md:w-24 md:h-24 rounded-full bg-gradient-to-br from-yellow-500 to-yellow-600 text-white flex items-center justify-center shadow-xl border-4 border-white">
                            <span class="text-3xl md:text-4xl font-bold">3</span>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="flex-1 bg-yellow-50 rounded-xl p-6 md:p-8 shadow-lg border border-yellow-100">
                        <h3 class="text-2xl md:text-3xl font-bold text-blue-900 mb-3">
                            Get Your New Smile
                        </h3>
                        <p class="text-base md:text-lg text-gray-700 leading-relaxed mb-4">
                            Arrive, relax in our comfortable clinic, and walk out with a beautiful smile.
                            Many procedures can be completed in just one visit!
                        </p>
                        <div class="bg-white rounded-lg p-4 border-l-4 border-yellow-500">
                            <p class="text-sm font-semibold text-gray-800">
                                🎉 Most patients complete their treatment in 1-3 visits and save thousands of dollars!
                            </p>
                        </div>
                    </div>
                </div>

            </div>
        </div>

        <!-- Bottom CTA -->
        <div class="text-center mt-16">
            <p class="text-xl font-semibold text-gray-700 mb-6">
                Ready to get started?
            </p>
            <a href="#contact"
               class="inline-flex items-center justify-center px-10 py-5 bg-blue-600 hover:bg-blue-700 text-white font-bold text-xl rounded-lg shadow-xl hover:shadow-2xl transition-all duration-200 transform hover:scale-105">
                Schedule Your Free Consultation
                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

    </div>
</section>
