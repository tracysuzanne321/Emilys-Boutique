/**
 * Product Gallery Slick Slider Initialization
 *
 * @package The_Emily_Boutique
 */

(function($) {
	'use strict';

	$(document).ready(function() {
		// Check if Slick is available
		if (typeof $.fn.slick === 'undefined') {
			console.warn('Slick slider is not loaded. Please ensure Slick slider library is enqueued.');
			return;
		}
		
		var $gallery = $('.woocommerce-product-gallery');
		
		if ($gallery.length === 0) {
			return;
		}

		var $mainSlider = $gallery.find('.woocommerce-product-gallery__main');
		var $thumbSlider = $gallery.find('.woocommerce-product-gallery__thumbnails');
		
		// Count total images in main slider
		var mainImageCount = $mainSlider.find('.woocommerce-product-gallery__image').length;
		var thumbImageCount = $thumbSlider.length > 0 ? $thumbSlider.find('.woocommerce-product-gallery__image').length : 0;

		// Only initialize if there are multiple images
		if (mainImageCount <= 1) {
			// Single image - no slider needed
			$gallery.css('opacity', '1');
			if ($thumbSlider.length > 0) {
				$thumbSlider.hide();
			}
			return;
		}

		// Initialize thumbnail slider first if it exists and has multiple images
		var thumbSliderInitialized = false;
		if ($thumbSlider.length > 0 && thumbImageCount > 1) {
			$thumbSlider.slick({
				slidesToShow: 4,
				slidesToScroll: 1,
				asNavFor: $mainSlider,
				dots: false,
				arrows: true,
				centerMode: false,
				focusOnSelect: true,
				prevArrow: '<button type="button" class="slick-prev" aria-label="Previous"><span class="slick-arrow-icon">‹</span></button>',
				nextArrow: '<button type="button" class="slick-next" aria-label="Next"><span class="slick-arrow-icon">›</span></button>',
				responsive: [
					{
						breakpoint: 768,
						settings: {
							slidesToShow: 3,
							slidesToScroll: 1
						}
					},
					{
						breakpoint: 480,
						settings: {
							slidesToShow: 2,
							slidesToScroll: 1
						}
					}
				]
			});
			thumbSliderInitialized = true;
		} else if ($thumbSlider.length > 0) {
			// If only one thumbnail, don't initialize slider but keep structure
			$thumbSlider.hide();
		}

		// Initialize main slider
		if ($mainSlider.length > 0) {
			var mainSliderOptions = {
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				fade: true,
				appendDots: $mainSlider,
				responsive: [
					{
						breakpoint: 768,
						settings: {
							arrows: false,
							dots: true
						}
					}
				]
			};
			
			// Only add asNavFor if thumbnail slider was initialized
			if (thumbSliderInitialized) {
				mainSliderOptions.asNavFor = $thumbSlider;
			}
			
			$mainSlider.slick(mainSliderOptions);
		}

		// Show gallery after initialization
		$gallery.css('opacity', '1');
	});

})(jQuery);

