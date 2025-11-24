<?php
/**
 * Service FAQ Section
 * Displays frequently asked questions with accordion functionality
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get FAQs from custom fields
$faqs = get_post_meta(get_the_ID(), '_service_faqs', true);

// Default FAQs if not set
if (empty($faqs)) {
    $faqs = array(
        array(
            'question' => 'How much does this procedure cost?',
            'answer' => 'Our prices are up to 70% lower than USA/Canada while maintaining the same high quality standards. See our price comparison table above for exact pricing. We provide a guaranteed exact quote before you visit - no surprises.'
        ),
        array(
            'question' => 'Is the quality the same as in the United States?',
            'answer' => 'Yes, absolutely. We use the same premium materials (100% Straumann implants from Germany), follow the same sterilization protocols, and Dr. Rubio has been practicing for over 40 years. All materials meet or exceed US/Canadian standards.'
        ),
        array(
            'question' => 'How many visits will I need?',
            'answer' => 'Most procedures can be completed in 1-3 visits depending on complexity. During your free consultation, we\'ll provide an exact timeline based on your specific needs. Many patients complete everything during their winter stay in Yuma.'
        ),
        array(
            'question' => 'Do you offer a warranty?',
            'answer' => 'Yes! We offer comprehensive warranties on our work. Implants come with a lifetime warranty from Straumann. Other procedures include warranties ranging from 1-5 years. Details will be provided during your consultation.'
        ),
        array(
            'question' => 'Is Los Algodones safe for seniors?',
            'answer' => 'Absolutely. Los Algodones is one of Mexico\'s safest border towns with over 3,000 Americans visiting daily for dental care. You can walk across from Yuma in 5 minutes, there\'s US Border Patrol on-site, and we provide free shuttle service. Most staff speak English.'
        ),
        array(
            'question' => 'Do you speak English?',
            'answer' => 'Yes! Dr. Rubio and our entire staff speak fluent English. We\'ve been serving American and Canadian patients for over 40 years, so communication is never an issue.'
        )
    );
}

if (empty($faqs)) {
    return;
}

// Generate unique IDs for accordion
$faq_id_prefix = 'faq-' . get_the_ID() . '-';
?>

<section class="service-faq py-12 md:py-16 bg-gray-50">
    <div class="container mx-auto px-4 max-w-4xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                Frequently Asked Questions
            </h2>
            <p class="text-base md:text-lg text-gray-600">
                Get answers to common questions about this procedure
            </p>
        </div>

        <!-- FAQ Accordion -->
        <div class="space-y-4">
            <?php foreach ($faqs as $index => $faq):
                $faq_id = $faq_id_prefix . $index;
            ?>
                <div class="faq-item bg-white rounded-lg shadow-md hover:shadow-lg transition-all duration-300 border border-gray-200">
                    <button type="button"
                            class="faq-question w-full px-6 py-5 text-left flex items-start justify-between gap-4 hover:bg-gray-50 transition-colors rounded-lg"
                            aria-expanded="false"
                            aria-controls="<?php echo esc_attr($faq_id); ?>"
                            onclick="this.setAttribute('aria-expanded', this.getAttribute('aria-expanded') === 'false' ? 'true' : 'false'); document.getElementById('<?php echo esc_attr($faq_id); ?>').classList.toggle('hidden'); this.querySelector('.faq-icon').classList.toggle('rotate-180');">
                        <span class="flex-1">
                            <h3 class="text-base md:text-lg font-bold text-gray-900 leading-snug">
                                <?php echo esc_html($faq['question']); ?>
                            </h3>
                        </span>
                        <span class="faq-icon flex-shrink-0 transform transition-transform duration-300">
                            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                            </svg>
                        </span>
                    </button>
                    <div id="<?php echo esc_attr($faq_id); ?>" class="faq-answer hidden px-6 pb-5" role="region">
                        <div class="pt-2 border-t border-gray-100">
                            <p class="text-sm md:text-base text-gray-700 leading-relaxed">
                                <?php echo nl2br(esc_html($faq['answer'])); ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Still Have Questions CTA -->
        <div class="mt-10 md:mt-12 text-center bg-white rounded-xl p-6 md:p-8 shadow-lg border border-gray-200">
            <div class="mb-6">
                <svg class="w-16 h-16 mx-auto text-blue-600 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z"></path>
                </svg>
                <h3 class="text-xl md:text-2xl font-bold text-gray-900 mb-2">
                    Still Have Questions?
                </h3>
                <p class="text-gray-600 mb-6">
                    We're here to help! Contact us for personalized answers.
                </p>
            </div>

            <div class="flex flex-col sm:flex-row gap-4 justify-center">
                <a href="tel:<?php echo esc_attr(str_replace(['(', ')', ' ', '-'], '', dental_rubio_get_phone())); ?>"
                   class="inline-flex items-center justify-center px-6 py-3 bg-green-600 hover:bg-green-700 text-white font-bold rounded-lg shadow hover:shadow-lg transition-all">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"></path>
                    </svg>
                    Call <?php echo esc_html(dental_rubio_get_phone()); ?>
                </a>
                <a href="https://wa.me/<?php echo esc_attr(dental_rubio_get_whatsapp()); ?>?text=I%20have%20questions%20about%20<?php echo urlencode(get_the_title()); ?>"
                   target="_blank"
                   rel="noopener noreferrer"
                   class="inline-flex items-center justify-center px-6 py-3 bg-green-500 hover:bg-green-600 text-white font-bold rounded-lg shadow hover:shadow-lg transition-all">
                    <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"></path>
                    </svg>
                    WhatsApp Chat
                </a>
            </div>

            <p class="text-sm text-gray-600 mt-4">
                Average response time: Under 5 minutes during business hours
            </p>
        </div>

    </div>
</section>

<style>
.faq-icon {
    transition: transform 0.3s ease;
}
.rotate-180 {
    transform: rotate(180deg);
}
</style>
