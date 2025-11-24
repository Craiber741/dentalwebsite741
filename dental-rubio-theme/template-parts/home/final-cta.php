<?php
/**
 * Final CTA Section
 * Strong call-to-action before footer
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}
?>

<section id="contact" class="final-cta py-16 md:py-24 bg-gradient-to-br from-green-600 to-green-700 text-white relative overflow-hidden">

    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-10">
        <svg class="w-full h-full" xmlns="http://www.w3.org/2000/svg">
            <pattern id="grid" width="40" height="40" patternUnits="userSpaceOnUse">
                <path d="M 40 0 L 0 0 0 40" fill="none" stroke="white" stroke-width="1"/>
            </pattern>
            <rect width="100%" height="100%" fill="url(#grid)"/>
        </svg>
    </div>

    <div class="container mx-auto px-4 max-w-5xl relative z-10">

        <div class="text-center">

            <!-- Heading -->
            <h2 class="text-3xl md:text-4xl lg:text-5xl font-bold mb-6 leading-tight">
                Ready to Save 70% on Quality Dental Care?
            </h2>

            <p class="text-xl md:text-2xl mb-8 md:mb-10 text-green-50 max-w-3xl mx-auto leading-relaxed">
                Join 51,237+ patients who trusted Dr. Rubio with their smile.
                Get your free quote in 5 minutes!
            </p>

            <!-- Key Benefits -->
            <div class="grid md:grid-cols-3 gap-6 mb-10 max-w-4xl mx-auto">
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                    <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="font-bold text-lg">Save $10K-$40K</p>
                    <p class="text-sm text-green-100">On major procedures</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                    <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                    </svg>
                    <p class="font-bold text-lg">German Quality</p>
                    <p class="text-sm text-green-100">100% Straumann</p>
                </div>
                <div class="bg-white/10 backdrop-blur-sm rounded-lg p-4 border border-white/20">
                    <svg class="w-10 h-10 mx-auto mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                    <p class="font-bold text-lg">40+ Years</p>
                    <p class="text-sm text-green-100">Experience & Trust</p>
                </div>
            </div>

            <!-- CTA Buttons -->
            <div class="flex flex-col sm:flex-row gap-4 justify-center items-center mb-8">
                <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
                   class="inline-flex items-center justify-center px-10 py-5 bg-white hover:bg-gray-100 text-green-700 font-bold text-xl rounded-lg shadow-2xl hover:shadow-3xl transition-all duration-200 transform hover:scale-105 w-full sm:w-auto">
                    <svg class="w-7 h-7 mr-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call <?php echo esc_html(dental_rubio_get_phone()); ?>
                </a>

                <a href="https://wa.me/<?php echo esc_attr(dental_rubio_get_whatsapp()); ?>?text=Hello!%20I%27d%20like%20to%20get%20a%20free%20quote%20for%20dental%20services."
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center px-10 py-5 bg-green-500 hover:bg-green-600 text-white font-bold text-xl rounded-lg shadow-2xl hover:shadow-3xl transition-all duration-200 transform hover:scale-105 w-full sm:w-auto">
                    <svg class="w-7 h-7 mr-3" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                    </svg>
                    WhatsApp Us
                </a>
            </div>

            <!-- Trust Line -->
            <div class="flex items-center justify-center gap-2 text-green-100">
                <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                    <path fill-rule="evenodd" d="M2.166 4.999A11.954 11.954 0 0010 1.944 11.954 11.954 0 0017.834 5c.11.65.166 1.32.166 2.001 0 5.225-3.34 9.67-8 11.317C5.34 16.67 2 12.225 2 7c0-.682.057-1.35.166-2.001zm11.541 3.708a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                </svg>
                <p class="text-sm font-semibold">
                    Safe, secure, and trusted by thousands • No obligation • Free quote
                </p>
            </div>

            <!-- Office Hours -->
            <div class="mt-8 pt-8 border-t border-white/20">
                <p class="text-sm text-green-100 mb-2 font-semibold">Office Hours</p>
                <p class="text-base">
                    Monday - Friday: 8:00 AM - 5:00 PM (MST)<br>
                    Saturday: 9:00 AM - 1:00 PM
                </p>
                <p class="text-sm text-green-100 mt-3">
                    Walk-ins welcome • Same-day appointments available
                </p>
            </div>

        </div>

    </div>
</section>
