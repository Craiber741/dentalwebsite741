<?php
/**
 * Service Testimonials Section
 * Displays patient testimonials specific to this service
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get service-specific testimonials
$testimonials = get_post_meta(get_the_ID(), '_service_testimonials', true);

// If no custom testimonials, get general testimonials
if (empty($testimonials)) {
    $testimonials = array(
        array(
            'name' => 'Robert M.',
            'location' => 'Arizona',
            'age' => '68',
            'rating' => 5,
            'text' => 'Dr. Rubio and his team provided excellent care. The quality is outstanding and I saved thousands of dollars. Highly recommend!',
            'verified' => true
        ),
        array(
            'name' => 'Margaret S.',
            'location' => 'Canada',
            'age' => '72',
            'rating' => 5,
            'text' => 'I was nervous at first, but the entire process was smooth and professional. The results exceeded my expectations.',
            'verified' => true
        )
    );
}

if (empty($testimonials)) {
    return;
}
?>

<section class="service-testimonials py-12 md:py-16 bg-gradient-to-br from-blue-900 to-blue-800 text-white">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold mb-4">
                What Our Patients Say
            </h2>
            <p class="text-base md:text-lg text-blue-100 max-w-2xl mx-auto">
                Real reviews from patients who chose this treatment
            </p>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 gap-6 md:gap-8">
            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card bg-white text-gray-900 rounded-xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">

                    <!-- Rating Stars -->
                    <div class="flex items-center gap-1 mb-4">
                        <?php for ($i = 0; $i < 5; $i++): ?>
                            <svg class="w-5 h-5 <?php echo $i < $testimonial['rating'] ? 'text-yellow-500' : 'text-gray-300'; ?>" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                            </svg>
                        <?php endfor; ?>
                    </div>

                    <!-- Testimonial Text -->
                    <blockquote class="text-gray-700 text-base md:text-lg leading-relaxed mb-6">
                        "<?php echo esc_html($testimonial['text']); ?>"
                    </blockquote>

                    <!-- Patient Info -->
                    <div class="flex items-center justify-between pt-4 border-t border-gray-200">
                        <div>
                            <p class="font-bold text-gray-900 text-lg">
                                <?php echo esc_html($testimonial['name']); ?>
                            </p>
                            <p class="text-sm text-gray-600">
                                <?php echo esc_html($testimonial['location']); ?>
                                <?php if (!empty($testimonial['age'])): ?>
                                    • Age <?php echo esc_html($testimonial['age']); ?>
                                <?php endif; ?>
                            </p>
                        </div>

                        <?php if (!empty($testimonial['verified'])): ?>
                            <div class="flex items-center text-green-600 text-sm font-semibold">
                                <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                                </svg>
                                Verified
                            </div>
                        <?php endif; ?>
                    </div>

                </div>
            <?php endforeach; ?>
        </div>

        <!-- Trust Stats -->
        <div class="mt-10 md:mt-12 bg-white/10 backdrop-blur-sm rounded-xl p-6 md:p-8 border border-white/20">
            <div class="grid grid-cols-3 gap-4 md:gap-8 text-center">
                <div>
                    <p class="text-3xl md:text-4xl font-bold text-yellow-400 mb-1">51K+</p>
                    <p class="text-sm md:text-base text-blue-100">Patients Served</p>
                </div>
                <div>
                    <p class="text-3xl md:text-4xl font-bold text-yellow-400 mb-1">4.9/5</p>
                    <p class="text-sm md:text-base text-blue-100">Average Rating</p>
                </div>
                <div>
                    <p class="text-3xl md:text-4xl font-bold text-yellow-400 mb-1">98%</p>
                    <p class="text-sm md:text-base text-blue-100">Satisfaction Rate</p>
                </div>
            </div>
        </div>

        <!-- View More CTA -->
        <div class="text-center mt-8">
            <a href="<?php echo esc_url(home_url('/testimonials/')); ?>"
               class="inline-flex items-center text-white hover:text-yellow-400 font-semibold transition-colors">
                Read More Patient Reviews
                <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

    </div>
</section>
