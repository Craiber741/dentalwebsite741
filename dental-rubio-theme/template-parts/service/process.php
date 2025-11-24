<?php
/**
 * Service Process Timeline
 * Displays step-by-step treatment process
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get process steps from custom fields
$process_steps = get_post_meta(get_the_ID(), '_service_process_steps', true);

// Default process if not set
if (empty($process_steps)) {
    $process_steps = array(
        array(
            'title' => 'Initial Consultation',
            'description' => 'We examine your teeth, take X-rays, and create a personalized treatment plan. You'll receive an exact quote with no surprises.',
            'duration' => '30-45 min'
        ),
        array(
            'title' => 'Preparation',
            'description' => 'We prepare the treatment area using modern techniques and ensure you're comfortable throughout the procedure.',
            'duration' => '45-60 min'
        ),
        array(
            'title' => 'Treatment',
            'description' => 'Your procedure is performed with precision using the latest technology and premium materials.',
            'duration' => 'Varies'
        ),
        array(
            'title' => 'Follow-up',
            'description' => 'We schedule any necessary follow-up visits and provide detailed aftercare instructions.',
            'duration' => '15-30 min'
        )
    );
}

if (empty($process_steps)) {
    return;
}
?>

<section class="process-timeline py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-14">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                Your Treatment Process
            </h2>
            <p class="text-base md:text-lg text-gray-600 max-w-2xl mx-auto">
                A simple, stress-free journey to your new smile
            </p>
        </div>

        <!-- Timeline -->
        <div class="relative">

            <!-- Vertical Line (hidden on mobile) -->
            <div class="hidden md:block absolute left-1/2 transform -translate-x-1/2 top-0 bottom-0 w-1 bg-gradient-to-b from-blue-200 via-blue-300 to-blue-200"></div>

            <!-- Steps -->
            <div class="space-y-8 md:space-y-12">
                <?php foreach ($process_steps as $index => $step):
                    $step_number = $index + 1;
                    $is_even = $step_number % 2 === 0;
                    $color_classes = array(
                        1 => 'from-blue-600 to-blue-700',
                        2 => 'from-green-600 to-green-700',
                        3 => 'from-yellow-500 to-yellow-600',
                        4 => 'from-purple-600 to-purple-700'
                    );
                    $bg_gradient = $color_classes[$step_number] ?? 'from-blue-600 to-blue-700';
                ?>

                    <div class="flex flex-col md:flex-row gap-4 md:gap-8 items-center">

                        <?php if ($is_even): ?>
                            <!-- Content Left (for even numbers on desktop) -->
                            <div class="md:w-5/12 md:text-right order-2 md:order-1">
                                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                    <div class="flex md:flex-row-reverse items-start gap-3 md:justify-end mb-2">
                                        <h3 class="text-xl md:text-2xl font-bold text-gray-900">
                                            <?php echo esc_html($step['title']); ?>
                                        </h3>
                                        <?php if (!empty($step['duration'])): ?>
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full whitespace-nowrap">
                                                <?php echo esc_html($step['duration']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                                        <?php echo esc_html($step['description']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <!-- Number Badge -->
                        <div class="flex-shrink-0 relative z-10 order-1 md:order-2">
                            <div class="w-16 h-16 md:w-20 md:h-20 rounded-full bg-gradient-to-br <?php echo esc_attr($bg_gradient); ?> text-white flex items-center justify-center shadow-xl border-4 border-white">
                                <span class="text-2xl md:text-3xl font-bold"><?php echo $step_number; ?></span>
                            </div>
                        </div>

                        <?php if (!$is_even): ?>
                            <!-- Content Right (for odd numbers) -->
                            <div class="md:w-5/12 order-3">
                                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-gray-100">
                                    <div class="flex items-start gap-3 mb-2">
                                        <h3 class="text-xl md:text-2xl font-bold text-gray-900">
                                            <?php echo esc_html($step['title']); ?>
                                        </h3>
                                        <?php if (!empty($step['duration'])): ?>
                                            <span class="inline-block px-3 py-1 bg-blue-100 text-blue-800 text-xs font-semibold rounded-full whitespace-nowrap">
                                                <?php echo esc_html($step['duration']); ?>
                                            </span>
                                        <?php endif; ?>
                                    </div>
                                    <p class="text-sm md:text-base text-gray-600 leading-relaxed">
                                        <?php echo esc_html($step['description']); ?>
                                    </p>
                                </div>
                            </div>
                        <?php endif; ?>

                        <?php if ($is_even): ?>
                            <!-- Spacer for even items -->
                            <div class="hidden md:block md:w-5/12 order-3"></div>
                        <?php endif; ?>

                    </div>

                    <!-- Arrow Down (not for last step, hidden on mobile) -->
                    <?php if ($step_number < count($process_steps)): ?>
                        <div class="hidden md:flex justify-center">
                            <svg class="w-10 h-10 text-blue-300" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M19 14l-7 7m0 0l-7-7m7 7V3"></path>
                            </svg>
                        </div>
                    <?php endif; ?>

                <?php endforeach; ?>
            </div>

        </div>

        <!-- Additional Info -->
        <div class="mt-12 bg-gradient-to-r from-blue-50 to-green-50 rounded-xl p-6 md:p-8 border border-blue-100">
            <div class="flex flex-col md:flex-row items-start md:items-center gap-4">
                <div class="flex-shrink-0">
                    <svg class="w-12 h-12 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
                <div class="flex-1">
                    <h3 class="text-xl font-bold text-gray-900 mb-2">
                        Every Case Is Unique
                    </h3>
                    <p class="text-gray-700 leading-relaxed">
                        Your exact treatment process may vary based on your individual needs. During your free
                        consultation, we'll create a personalized treatment plan and timeline just for you. Most
                        patients complete their treatment in 1-3 visits.
                    </p>
                </div>
            </div>
        </div>

        <!-- CTA -->
        <div class="text-center mt-10">
            <p class="text-lg font-semibold text-gray-700 mb-4">
                Ready to get started?
            </p>
            <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
               class="inline-flex items-center justify-center px-8 py-4 bg-blue-600 hover:bg-blue-700 text-white font-bold text-lg rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                </svg>
                Schedule Your Free Consultation
            </a>
        </div>

    </div>
</section>
