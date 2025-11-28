/**
 * Product Gallery Slick Slider Initialization
 *
 * @package The_Emily_Boutique
 */

(function($) {
	'use strict';

	$(document).ready(function() {
		var $gallery = $('.woocommerce-product-gallery');
		
		if ($gallery.length === 0) {
			return;
		}

		var $mainSlider = $gallery.find('.woocommerce-product-gallery__main');
		var $thumbSlider = $gallery.find('.woocommerce-product-gallery__thumbnails');

		// Initialize main slider
		if ($mainSlider.length > 0) {
			$mainSlider.slick({
				slidesToShow: 1,
				slidesToScroll: 1,
				arrows: false,
				dots: true,
				fade: true,
				asNavFor: $thumbSlider,
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
			});
		}

		// Initialize thumbnail slider
		if ($thumbSlider.length > 0 && $thumbSlider.find('.woocommerce-product-gallery__image').length > 1) {
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
		} else if ($thumbSlider.length > 0) {
			// If only one image, don't initialize slider but keep structure
			$thumbSlider.hide();
		}

		// Show gallery after initialization
		$gallery.css('opacity', '1');
	});

})(jQuery);

