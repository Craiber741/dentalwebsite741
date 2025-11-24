<?php
/**
 * Service Price Comparison Table
 * Displays USA vs Rubio Dental pricing comparison
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get pricing data from custom fields
$pricing_table = get_post_meta(get_the_ID(), '_service_pricing_table', true);

// Default pricing if not set
if (empty($pricing_table)) {
    $service_price = get_post_meta(get_the_ID(), '_service_price', true);
    $usa_price = get_post_meta(get_the_ID(), '_service_usa_price', true);

    if ($service_price && $usa_price) {
        $pricing_table = array(
            array(
                'procedure' => get_the_title(),
                'usa' => intval(str_replace(['$', ','], '', $usa_price)),
                'rubio' => intval(str_replace(['$', ','], '', $service_price))
            )
        );
    }
}

// Skip if no pricing data
if (empty($pricing_table)) {
    return;
}
?>

<section class="price-comparison py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 max-w-5xl">

        <!-- Section Header -->
        <div class="text-center mb-8 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                Price Comparison
            </h2>
            <p class="text-base md:text-lg text-gray-600">
                See how much you can save with premium quality care
            </p>
        </div>

        <!-- Responsive Table Wrapper -->
        <div class="overflow-x-auto shadow-xl rounded-xl">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gradient-to-r from-blue-900 to-blue-800 text-white">
                        <th class="p-4 md:p-6 text-base md:text-lg font-bold">Procedure</th>
                        <th class="p-4 md:p-6 text-base md:text-lg font-bold text-right">USA Price</th>
                        <th class="p-4 md:p-6 text-base md:text-lg font-bold text-right">Our Price</th>
                        <th class="p-4 md:p-6 text-base md:text-lg font-bold text-right">You Save</th>
                    </tr>
                </thead>
                <tbody class="bg-white">
                    <?php foreach ($pricing_table as $index => $row):
                        $usa_price = intval($row['usa']);
                        $rubio_price = intval($row['rubio']);
                        $savings = $usa_price - $rubio_price;
                        $savings_percent = $usa_price > 0 ? round(($savings / $usa_price) * 100) : 0;
                        $row_class = $index % 2 === 0 ? 'bg-gray-50' : 'bg-white';
                    ?>
                        <tr class="<?php echo esc_attr($row_class); ?> border-b border-gray-200 hover:bg-blue-50 transition-colors">
                            <td class="p-4 md:p-6 font-semibold text-gray-800 text-sm md:text-base">
                                <?php echo esc_html($row['procedure']); ?>
                            </td>
                            <td class="p-4 md:p-6 text-right text-gray-700 text-sm md:text-base">
                                <span class="line-through">$<?php echo number_format($usa_price); ?></span>
                            </td>
                            <td class="p-4 md:p-6 text-right font-bold text-yellow-600 text-base md:text-lg">
                                $<?php echo number_format($rubio_price); ?>
                            </td>
                            <td class="p-4 md:p-6 text-right">
                                <div class="text-green-700 font-bold text-base md:text-lg">
                                    $<?php echo number_format($savings); ?>
                                </div>
                                <div class="text-green-600 text-xs md:text-sm">
                                    (<?php echo $savings_percent; ?>% off)
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>

        <!-- Disclaimer -->
        <div class="mt-6 bg-blue-50 border-l-4 border-blue-600 p-4 md:p-6 rounded-r-lg">
            <div class="flex items-start gap-3">
                <svg class="w-6 h-6 text-blue-600 flex-shrink-0 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                <div class="text-sm md:text-base text-gray-700">
                    <p class="font-semibold mb-1">Premium Quality Included:</p>
                    <ul class="list-disc list-inside space-y-1 text-gray-600">
                        <li>100% Straumann implants (German quality) where applicable</li>
                        <li>No hidden fees - exact quote guaranteed</li>
                        <li>Lifetime warranty available on implants</li>
                        <li>All materials meet or exceed US/Canadian standards</li>
                        <li>Free shuttle from Yuma border crossing</li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- CTA Button -->
        <div class="text-center mt-8 md:mt-10">
            <a href="#contact"
               class="inline-flex items-center justify-center px-8 py-4 bg-green-600 hover:bg-green-700 text-white font-bold text-lg rounded-lg shadow-lg hover:shadow-xl transition-all duration-200 transform hover:scale-105">
                <svg class="w-6 h-6 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                </svg>
                Get Your Free Personalized Quote
            </a>
            <p class="text-sm text-gray-600 mt-3">
                Response in under 5 minutes • No obligation
            </p>
        </div>

    </div>
</section>
