/**
 * Snowfall Animation
 * Lightweight JavaScript for generating falling snowflakes
 *
 * @package The_Emily_Boutique
 */

(function() {
	'use strict';

	/**
	 * Add snow containers to sections that don't have them
	 */
	function addSnowContainersToSections() {
		// Only on front page
		if (!document.body.classList.contains('home') && !document.body.classList.contains('page-template-front-page')) {
			return;
		}
		
		// Find major sections (Group and Cover blocks) that don't have snow
		const sections = document.querySelectorAll('.wp-block-group, .wp-block-cover, .featured-categories, [class*="category"]');
		let addedCount = 0;
		const maxAdditions = 10; // Increased limit
		
		sections.forEach(function(section) {
			// Skip if already has snow container
			if (section.querySelector('.snow-container')) {
				return;
			}
			
			// Skip if section is too small (less than 150px height) - reduced threshold
			if (section.offsetHeight < 150) {
				return;
			}
			
			// Check if this is a shop/category section by looking for keywords in text or classes
			const isShopCategory = section.textContent.toLowerCase().includes('category') ||
			                      section.textContent.toLowerCase().includes('shop') ||
			                      section.className.toLowerCase().includes('category') ||
			                      section.className.toLowerCase().includes('shop') ||
			                      section.querySelector('[class*="category"]') ||
			                      section.querySelector('[class*="shop"]');
			
			// Skip nested groups (only add to top-level sections)
			// But make exception for shop/category sections
			const parentGroup = section.closest('.wp-block-group');
			if (parentGroup && parentGroup !== section && !isShopCategory) {
				return;
			}
			
			// Add snow container - prioritize shop/category sections
			if (addedCount < maxAdditions || isShopCategory) {
				const snowContainer = document.createElement('div');
				snowContainer.className = 'snow-container';
				section.style.position = 'relative'; // Ensure positioning context
				section.insertBefore(snowContainer, section.firstChild);
				addedCount++;
			}
		});
	}

	/**
	 * Initialize snowfall animation
	 */
	function initSnowfall() {
		// First, try to add snow containers to sections that don't have them
		addSnowContainersToSections();
		
		const snowContainers = document.querySelectorAll('.snow-container');
		
		if (snowContainers.length === 0) {
			return;
		}

		// Adjust snowflake count based on number of containers (for performance)
		const totalContainers = snowContainers.length;
		const snowflakesPerContainer = totalContainers > 1 ? Math.max(25, Math.floor(60 / totalContainers)) : 40;
		
		snowContainers.forEach(function(container) {
			// Get container height for proper animation
			const containerHeight = container.offsetHeight || window.innerHeight;
			
			// Create snowflakes with staggered delays
			for (let i = 0; i < snowflakesPerContainer; i++) {
				createSnowflake(container, containerHeight, i);
			}
		});
	}

	/**
	 * Create a single snowflake
	 */
	function createSnowflake(container, containerHeight, index) {
		const snowflake = document.createElement('div');
		snowflake.className = 'snowflake';
		
		// Random size between 4px and 12px
		const size = Math.random() * 8 + 4;
		snowflake.style.width = size + 'px';
		snowflake.style.height = size + 'px';
		
		// Random starting position
		snowflake.style.left = Math.random() * 100 + '%';
		
		// Random fall duration (between 4 and 10 seconds for smoother animation)
		const duration = Math.random() * 6 + 4;
		snowflake.style.animationDuration = duration + 's';
		
		// Staggered delay based on index to spread out snowflakes
		const delay = (index * 0.1) + (Math.random() * 0.5);
		snowflake.style.animationDelay = delay + 's';
		
		// Random horizontal drift (between -30px and 30px)
		const drift = (Math.random() * 60 - 30) + 'px';
		snowflake.style.setProperty('--drift', drift);
		snowflake.style.setProperty('--container-height', containerHeight + 'px');
		
		// Add to container
		container.appendChild(snowflake);
	}

	// Initialize when DOM is ready
	if (document.readyState === 'loading') {
		document.addEventListener('DOMContentLoaded', initSnowfall);
	} else {
		initSnowfall();
	}

})();

