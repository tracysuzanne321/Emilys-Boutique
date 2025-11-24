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
		
		if (sections.length === 0) {
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
		
		// Observe each section
		sections.forEach(function(section) {
			observer.observe(section);
		});
		
		// Trigger hero section immediately on load (since it's above the fold)
		const heroSection = document.querySelector('.hero-section');
		if (heroSection && window.innerHeight > heroSection.getBoundingClientRect().top) {
			heroSection.classList.add('fade-in');
		}
	}

	/**
	 * Initialize when DOM is ready
	 */
	function init() {
		initMobileMenu();
		initMobileDropdowns();
		initScrollFadeIn();
	}

	// Run when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', init);
	} else {
		init();
	}

})();

