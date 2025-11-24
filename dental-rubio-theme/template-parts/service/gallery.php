<?php
/**
 * Service Gallery Section
 * Displays before/after photos and treatment gallery
 *
 * @package DentalRubio
 */

// Prevent direct access
if (!defined('ABSPATH')) {
    exit;
}

// Get gallery images
$gallery_images = get_post_meta(get_the_ID(), '_service_gallery', true);

if (empty($gallery_images)) {
    return;
}
?>

<section class="service-gallery py-12 md:py-16 bg-white">
    <div class="container mx-auto px-4 max-w-6xl">

        <!-- Section Header -->
        <div class="text-center mb-10 md:mb-12">
            <h2 class="text-2xl md:text-3xl lg:text-4xl font-bold text-blue-900 mb-4">
                Real Results Gallery
            </h2>
            <p class="text-base md:text-lg text-gray-600">
                See the quality of our work and results we achieve
            </p>
        </div>

        <!-- Gallery Grid -->
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($gallery_images as $index => $image_id): ?>
                <?php
                $image = wp_get_attachment_image_src($image_id, 'large');
                $image_alt = get_post_meta($image_id, '_wp_attachment_image_alt', true);
                if (!$image) continue;
                ?>

                <div class="gallery-item group relative overflow-hidden rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-1 cursor-pointer"
                     onclick="openGalleryModal(<?php echo esc_js($index); ?>)">

                    <div class="aspect-w-4 aspect-h-3 bg-gray-200">
                        <img src="<?php echo esc_url($image[0]); ?>"
                             alt="<?php echo esc_attr($image_alt ?: 'Treatment result ' . ($index + 1)); ?>"
                             class="w-full h-full object-cover transition-transform duration-300 group-hover:scale-110"
                             loading="lazy">
                    </div>

                    <!-- Overlay -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300 flex items-end p-4">
                        <div class="text-white">
                            <p class="font-semibold">View Image</p>
                            <svg class="w-6 h-6 mt-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0zM10 7v3m0 0v3m0-3h3m-3 0H7"></path>
                            </svg>
                        </div>
                    </div>
                </div>

            <?php endforeach; ?>
        </div>

        <!-- Disclaimer -->
        <div class="mt-8 text-center text-sm text-gray-600">
            <p>*Results may vary. Individual results depend on various factors including oral health, age, and adherence to post-treatment care.</p>
        </div>

    </div>
</section>

<!-- Simple Gallery Modal (basic implementation) -->
<div id="galleryModal" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center p-4" onclick="closeGalleryModal()">
    <button class="absolute top-4 right-4 text-white text-4xl font-bold hover:text-gray-300" onclick="closeGalleryModal()">&times;</button>
    <img id="galleryModalImage" src="" alt="" class="max-w-full max-h-full object-contain">
</div>

<script>
const galleryImages = <?php echo json_encode(array_map(function($img_id) {
    $img = wp_get_attachment_image_src($img_id, 'full');
    return $img ? $img[0] : '';
}, $gallery_images)); ?>;

function openGalleryModal(index) {
    const modal = document.getElementById('galleryModal');
    const img = document.getElementById('galleryModalImage');
    img.src = galleryImages[index];
    modal.classList.remove('hidden');
    document.body.style.overflow = 'hidden';
}

function closeGalleryModal() {
    const modal = document.getElementById('galleryModal');
    modal.classList.add('hidden');
    document.body.style.overflow = '';
    event.stopPropagation();
}

// Close on Escape key
document.addEventListener('keydown', function(e) {
    if (e.key === 'Escape') {
        closeGalleryModal();
    }
});
</script>
