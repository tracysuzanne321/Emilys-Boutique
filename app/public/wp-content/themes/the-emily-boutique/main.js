/**
 * The Emily Boutique Theme JavaScript
 *
 * @package The_Emily_Boutique
 */

(function() {
	'use strict';

	/**
	 * Mobile Menu Toggle
	 */
	function initMobileMenu() {
		const menuToggle = document.querySelector('.menu-toggle');
		const primaryNav = document.querySelector('.primary-navigation');
		
		if (!menuToggle || !primaryNav) {
			return;
		}
		
		menuToggle.addEventListener('click', function(e) {
			e.preventDefault();
			const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
			
			// Toggle aria-expanded
			menuToggle.setAttribute('aria-expanded', !isExpanded);
			
			// Toggle active class on navigation
			primaryNav.classList.toggle('active');
		});
		
		// Close menu when clicking outside
		document.addEventListener('click', function(e) {
			if (!primaryNav.contains(e.target) && !menuToggle.contains(e.target)) {
				primaryNav.classList.remove('active');
				menuToggle.setAttribute('aria-expanded', 'false');
			}
		});
		
		// Close menu on window resize if it's open
		let resizeTimer;
		window.addEventListener('resize', function() {
			clearTimeout(resizeTimer);
			resizeTimer = setTimeout(function() {
				if (window.innerWidth > 767) {
					primaryNav.classList.remove('active');
					menuToggle.setAttribute('aria-expanded', 'false');
				}
			}, 250);
		});
	}

	/**
	 * Mobile Dropdown Menu Toggle
	 */
	function initMobileDropdowns() {
		const menuItemsWithChildren = document.querySelectorAll('.primary-navigation .menu-item-has-children > a');
		
		menuItemsWithChildren.forEach(function(menuLink) {
			menuLink.addEventListener('click', function(e) {
				// Only prevent default on mobile
				if (window.innerWidth <= 767) {
					e.preventDefault();
					const menuItem = this.parentElement;
					menuItem.classList.toggle('menu-item-open');
				}
			});
		});
	}

	/**
	 * Scroll Fade-In Animation
	 */
	function initScrollFadeIn() {
		// Sections to animate
		const sections = document.querySelectorAll('.hero-section, .featured-categories, .about-teaser, .featured-products');
		
		// Gutenberg blocks to animate
		const gutenbergBlocks = document.querySelectorAll(
			'.wp-block-post-content > *, ' +
			'.entry-content > .wp-block-group, ' +
			'.entry-content > .wp-block-columns, ' +
			'.entry-content > .wp-block-cover, ' +
			'.entry-content > .wp-block-image, ' +
			'.entry-content > .wp-block-gallery, ' +
			'.entry-content > .wp-block-media-text, ' +
			'.entry-content > .wp-block-column, ' +
			'.site-main .wp-block-group, ' +
			'.site-main .wp-block-columns, ' +
			'.site-main .wp-block-cover'
		);
		
		// Combine all elements to animate
		const allElements = [...sections, ...gutenbergBlocks];
		
		if (allElements.length === 0) {
			return;
		}
		
		// Create Intersection Observer
		const observerOptions = {
			root: null,
			rootMargin: '0px 0px -100px 0px',
			threshold: 0.1
		};
		
		const observer = new IntersectionObserver(function(entries) {
			entries.forEach(function(entry) {
				if (entry.isIntersecting) {
					entry.target.classList.add('fade-in');
					// Unobserve after animation to improve performance
					observer.unobserve(entry.target);
				}
			});
		}, observerOptions);
		
		// Observe each element
		allElements.forEach(function(element) {
			observer.observe(element);
		});
		
		// Trigger hero section immediately on load (since it's above the fold)
		const heroSection = document.querySelector('.hero-section');
		if (heroSection && window.innerHeight > heroSection.getBoundingClientRect().top) {
			heroSection.classList.add('fade-in');
		}
		
		// Trigger first Gutenberg block immediately if it's above the fold
		if (gutenbergBlocks.length > 0) {
			const firstBlock = gutenbergBlocks[0];
			if (firstBlock && window.innerHeight > firstBlock.getBoundingClientRect().top) {
				firstBlock.classList.add('fade-in');
			}
		}
	}

	/**
	 * Remove checkmark from add to cart buttons
	 */
	function removeCheckmarkFromButtons() {
		// Remove any checkmark icons that WooCommerce might add
		document.addEventListener('added_to_cart', function() {
			const buttons = document.querySelectorAll('.product .button, .woocommerce ul.products li.product .button');
			buttons.forEach(function(button) {
				// Remove any SVG icons
				const svgs = button.querySelectorAll('svg');
				svgs.forEach(function(svg) {
					svg.remove();
				});
				// Remove any icon elements
				const icons = button.querySelectorAll('.icon, [class*="icon"], [class*="check"]');
				icons.forEach(function(icon) {
					icon.remove();
				});
			});
		});
		
		// Also check periodically for any checkmarks that might be added
		setInterval(function() {
			const buttons = document.querySelectorAll('.product .button, .woocommerce ul.products li.product .button');
			buttons.forEach(function(button) {
				const svgs = button.querySelectorAll('svg');
				svgs.forEach(function(svg) {
					svg.remove();
				});
				const icons = button.querySelectorAll('.icon, [class*="icon"], [class*="check"]');
				icons.forEach(function(icon) {
					icon.remove();
				});
			});
		}, 100);
	}

	/**
	 * Header Scroll Effect - Shrink Logo on Scroll
	 */
	function initHeaderScroll() {
		const siteHeader = document.querySelector('.site-header');
		
		if (!siteHeader) {
			return;
		}
		
		function handleScroll() {
			if (window.scrollY > 50) {
				siteHeader.classList.add('scrolled');
			} else {
				siteHeader.classList.remove('scrolled');
			}
		}
		
		// Throttle scroll events for better performance
		let ticking = false;
		window.addEventListener('scroll', function() {
			if (!ticking) {
				window.requestAnimationFrame(function() {
					handleScroll();
					ticking = false;
				});
				ticking = true;
			}
		});
		
		// Check initial scroll position
		handleScroll();
	}

	/**
	 * Initialize when DOM is ready
	 */
	function init() {
		initMobileMenu();
		initMobileDropdowns();
		initScrollFadeIn();
		removeCheckmarkFromButtons();
		initHeaderScroll();
	}

	// Run when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}

})();

