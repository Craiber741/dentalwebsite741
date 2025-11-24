<?php
/**
 * Testimonials Section
 * Real patient reviews and social proof
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Sample testimonials - these should be managed via WordPress in production
$testimonials = array(
    array(
        'name' => 'Robert M.',
        'location' => 'Arizona',
        'age' => '68',
        'rating' => 5,
        'text' => 'After 40 years of visiting dentists, I can honestly say Dr. Rubio is the best I\'ve ever had. Got my All-on-4 implants done for $9,500 - would have cost me $50,000 in Arizona! The quality is exceptional.',
        'service' => 'All-on-4 Implants',
        'image' => '' // Placeholder for avatar
    ),
    array(
        'name' => 'Margaret S.',
        'location' => 'Canada',
        'age' => '72',
        'rating' => 5,
        'text' => 'I was nervous about going to Mexico, but Dr. Rubio and his team made me feel so comfortable. The free shuttle service was convenient, and the clinic is spotless. Saved over $15,000 on my dental work!',
        'service' => 'Crowns & Bridges',
        'image' => ''
    ),
    array(
        'name' => 'James T.',
        'location' => 'California',
        'age' => '65',
        'rating' => 5,
        'text' => 'Best decision I ever made! The Straumann implants are top quality, and Dr. Rubio explained everything in detail. I can eat steak again! My wife is going next month.',
        'service' => 'Dental Implants',
        'image' => ''
    ),
    array(
        'name' => 'Linda K.',
        'location' => 'Texas',
        'age' => '70',
        'rating' => 5,
        'text' => 'Professional, caring, and incredibly affordable. I\'ve been coming here for 5 years now and always recommend Dr. Rubio to my snowbird friends. The quality is just as good as my US dentist but at a fraction of the cost.',
        'service' => 'Regular Checkups',
        'image' => ''
    ),
);
?>

<section class="testimonials py-16 md:py-20 bg-gradient-to-br from-blue-900 to-blue-800 text-white">
    <div class="container mx-auto px-4 max-w-7xl">

        <!-- Section Header -->
        <div class="text-center mb-12 md:mb-16">
            <h2 class="text-3xl md:text-4xl font-bold mb-4">
                What Our Patients Say
            </h2>
            <p class="text-lg md:text-xl text-blue-100 max-w-2xl mx-auto">
                Real reviews from seniors just like you who chose quality dental care at affordable prices
            </p>
            <div class="flex items-center justify-center gap-2 mt-6">
                <div class="flex gap-1">
                    <?php for ($i = 0; $i < 5; $i++): ?>
                        <svg class="w-6 h-6 text-yellow-400" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                        </svg>
                    <?php endfor; ?>
                </div>
                <span class="text-xl font-semibold ml-2">4.9/5 • 2,847 Reviews</span>
            </div>
        </div>

        <!-- Testimonials Grid -->
        <div class="grid md:grid-cols-2 gap-6 md:gap-8">

            <?php foreach ($testimonials as $testimonial): ?>
                <div class="testimonial-card bg-white rounded-xl p-6 md:p-8 shadow-xl hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1">

                    <!-- Header with Stars -->
                    <div class="flex items-start justify-between mb-4">
                        <div class="flex-1">
                            <div class="flex gap-1 mb-2">
                                <?php for ($i = 0; $i < $testimonial['rating']; $i++): ?>
                                    <svg class="w-5 h-5 text-yellow-500" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
                                    </svg>
                                <?php endfor; ?>
                            </div>
                            <h3 class="text-xl font-bold text-gray-900"><?php echo esc_html($testimonial['name']); ?></h3>
                            <p class="text-sm text-gray-600">
                                <?php echo esc_html($testimonial['location']); ?> • Age <?php echo esc_html($testimonial['age']); ?>
                            </p>
                        </div>

                        <!-- Avatar Placeholder -->
                        <div class="flex-shrink-0 ml-4">
                            <div class="w-16 h-16 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-2xl font-bold shadow-lg">
                                <?php echo esc_html(substr($testimonial['name'], 0, 1)); ?>
                            </div>
                        </div>
                    </div>

                    <!-- Testimonial Text -->
                    <blockquote class="text-gray-700 text-base md:text-lg leading-relaxed mb-4">
                        "<?php echo esc_html($testimonial['text']); ?>"
                    </blockquote>

                    <!-- Service Badge -->
                    <div class="inline-block bg-blue-100 text-blue-900 text-sm font-semibold px-4 py-2 rounded-full">
                        Service: <?php echo esc_html($testimonial['service']); ?>
                    </div>

                    <!-- Verified Badge -->
                    <div class="mt-4 flex items-center text-green-600 text-sm font-semibold">
                        <svg class="w-5 h-5 mr-1" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M6.267 3.455a3.066 3.066 0 001.745-.723 3.066 3.066 0 013.976 0 3.066 3.066 0 001.745.723 3.066 3.066 0 012.812 2.812c.051.643.304 1.254.723 1.745a3.066 3.066 0 010 3.976 3.066 3.066 0 00-.723 1.745 3.066 3.066 0 01-2.812 2.812 3.066 3.066 0 00-1.745.723 3.066 3.066 0 01-3.976 0 3.066 3.066 0 00-1.745-.723 3.066 3.066 0 01-2.812-2.812 3.066 3.066 0 00-.723-1.745 3.066 3.066 0 010-3.976 3.066 3.066 0 00.723-1.745 3.066 3.066 0 012.812-2.812zm7.44 5.252a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        Verified Patient
                    </div>

                </div>
            <?php endforeach; ?>

        </div>

        <!-- Bottom Stats -->
        <div class="mt-12 md:mt-16 text-center">
            <div class="bg-white/10 backdrop-blur-sm rounded-xl p-6 md:p-8 max-w-3xl mx-auto border border-white/20">
                <div class="grid grid-cols-3 gap-4 md:gap-8">
                    <div>
                        <p class="text-3xl md:text-4xl font-bold text-yellow-400 mb-1">98%</p>
                        <p class="text-sm md:text-base text-blue-100">Satisfaction Rate</p>
                    </div>
                    <div>
                        <p class="text-3xl md:text-4xl font-bold text-yellow-400 mb-1">51K+</p>
                        <p class="text-sm md:text-base text-blue-100">Happy Patients</p>
                    </div>
                    <div>
                        <p class="text-3xl md:text-4xl font-bold text-yellow-400 mb-1">40+</p>
                        <p class="text-sm md:text-base text-blue-100">Years Serving</p>
                    </div>
                </div>
            </div>

            <!-- CTA -->
            <a href="#contact"
               class="inline-flex items-center justify-center mt-8 px-10 py-5 bg-yellow-500 hover:bg-yellow-600 text-blue-900 font-bold text-xl rounded-lg shadow-xl hover:shadow-2xl transition-all duration-200 transform hover:scale-105">
                Join Thousands of Happy Patients
                <svg class="w-6 h-6 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 7l5 5m0 0l-5 5m5-5H6"></path>
                </svg>
            </a>
        </div>

    </div>
</section>
