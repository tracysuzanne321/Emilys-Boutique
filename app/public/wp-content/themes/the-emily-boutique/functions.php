<?php
/**
 * The Emily Boutique Theme Functions
 *
 * @package The_Emily_Boutique
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Theme Setup
 */
function the_emily_boutique_setup() {
	// Add theme support for title tag
	add_theme_support( 'title-tag' );
	
	// Add theme support for post thumbnails
	add_theme_support( 'post-thumbnails' );
	
	// Add theme support for custom logo
	add_theme_support( 'custom-logo', array(
		'height'      => 60,
		'width'       => 200,
		'flex-height' => true,
		'flex-width'  => true,
	) );
	
	// Add theme support for HTML5
	add_theme_support( 'html5', array(
		'search-form',
		'comment-form',
		'comment-list',
		'gallery',
		'caption',
		'script',
		'style',
	) );
	
	// Add theme support for WooCommerce
	add_theme_support( 'woocommerce' );
	add_theme_support( 'wc-product-gallery-zoom' );
	add_theme_support( 'wc-product-gallery-lightbox' );
	add_theme_support( 'wc-product-gallery-slider' );
	
	// Register navigation menu
	register_nav_menus( array(
		'primary' => esc_html__( 'Primary Menu', 'the-emily-boutique' ),
	) );
	
	// Set content width
	$GLOBALS['content_width'] = 1200;
}
add_action( 'after_setup_theme', 'the_emily_boutique_setup' );

/**
 * Enqueue scripts and styles
 */
function the_emily_boutique_scripts() {
	// Enqueue Google Fonts
	wp_enqueue_style(
		'the-emily-boutique-fonts',
		'https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;600;700&family=Montserrat:wght@400;500;600;700&family=Allura&display=swap',
		array(),
		null
	);
	
	// Enqueue main stylesheet
	wp_enqueue_style(
		'the-emily-boutique-style',
		get_stylesheet_uri(),
		array(),
		wp_get_theme()->get( 'Version' )
	);
	
	// Enqueue main JavaScript
	wp_enqueue_script(
		'the-emily-boutique-main',
		get_template_directory_uri() . '/main.js',
		array(),
		wp_get_theme()->get( 'Version' ),
		true
	);
	
	// Enqueue snow animation only on front page
	if ( is_front_page() ) {
		// Enqueue snow CSS
		wp_enqueue_style(
			'the-emily-boutique-snow',
			get_template_directory_uri() . '/css/snow.css',
			array(),
			wp_get_theme()->get( 'Version' )
		);
		
		// Enqueue snow JavaScript
		wp_enqueue_script(
			'the-emily-boutique-snow',
			get_template_directory_uri() . '/snow.js',
			array(),
			wp_get_theme()->get( 'Version' ),
			true
		);
	}
}
add_action( 'wp_enqueue_scripts', 'the_emily_boutique_scripts' );

/**
 * Register widget areas
 */
function the_emily_boutique_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Connect Area', 'the-emily-boutique' ),
		'id'            => 'footer-1',
		'description'   => esc_html__( 'Add widgets here for social media links or newsletter signup. Appears in the footer Connect column.', 'the-emily-boutique' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h4 class="widget-title">',
		'after_title'   => '</h4>',
	) );
}
add_action( 'widgets_init', 'the_emily_boutique_widgets_init' );

/**
 * Custom excerpt length
 */
function the_emily_boutique_excerpt_length( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'the_emily_boutique_excerpt_length', 999 );

/**
 * Custom excerpt more
 */
function the_emily_boutique_excerpt_more( $more ) {
	return '...';
}
add_filter( 'excerpt_more', 'the_emily_boutique_excerpt_more' );

/**
 * Header Cart Icon and Count
 */
function the_emily_boutique_header_cart() {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return;
	}
	
	$cart_count = WC()->cart->get_cart_contents_count();
	$cart_url = wc_get_cart_url();
	
	?>
	<a class="teb-cart-link" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php esc_attr_e( 'View basket', 'the-emily-boutique' ); ?>">
		<span class="teb-cart-icon">
			<svg width="24" height="24" viewBox="0 0 640 640" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M320 64C326.6 64 332.9 66.7 337.4 71.5L481.4 223.5L481.9 224L560 224C577.7 224 592 238.3 592 256C592 270.5 582.4 282.7 569.2 286.7L523.1 493.9C516.6 523.2 490.6 544 460.6 544L179.3 544C149.3 544 123.3 523.2 116.8 493.9L70.8 286.7C57.6 282.8 48 270.5 48 256C48 238.3 62.3 224 80 224L158.1 224L158.6 223.5L302.6 71.5C307.1 66.7 313.4 64 320 64zM320 122.9L224.2 224L415.8 224L320 122.9zM240 328C240 314.7 229.3 304 216 304C202.7 304 192 314.7 192 328L192 440C192 453.3 202.7 464 216 464C229.3 464 240 453.3 240 440L240 328zM320 304C306.7 304 296 314.7 296 328L296 440C296 453.3 306.7 464 320 464C333.3 464 344 453.3 344 440L344 328C344 314.7 333.3 304 320 304zM448 328C448 314.7 437.3 304 424 304C410.7 304 400 314.7 400 328L400 440C400 453.3 410.7 464 424 464C437.3 464 448 453.3 448 440L448 328z" fill="currentColor"/>
			</svg>
		</span>
		<?php if ( $cart_count > 0 ) : ?>
			<span class="teb-cart-count"><?php echo esc_html( $cart_count ); ?></span>
		<?php endif; ?>
	</a>
	<?php
}

/**
 * Add cart fragment for AJAX updates
 */
function the_emily_boutique_cart_fragment( $fragments ) {
	if ( ! function_exists( 'WC' ) || ! WC()->cart ) {
		return $fragments;
	}
	
	ob_start();
	the_emily_boutique_header_cart();
	$fragments['.teb-cart-link'] = ob_get_clean();
	
	// Also update just the count
	$cart_count = WC()->cart->get_cart_contents_count();
	ob_start();
	if ( $cart_count > 0 ) {
		?>
		<span class="teb-cart-count"><?php echo esc_html( $cart_count ); ?></span>
		<?php
	}
	$fragments['.teb-cart-count'] = ob_get_clean();
	
	return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'the_emily_boutique_cart_fragment' );

/**
 * Change "Add to Cart" button text to "Add to Basket"
 */
function the_emily_boutique_add_to_cart_text( $text ) {
	return __( 'Add to Basket', 'the-emily-boutique' );
}
add_filter( 'woocommerce_product_add_to_cart_text', 'the_emily_boutique_add_to_cart_text' );
add_filter( 'woocommerce_product_single_add_to_cart_text', 'the_emily_boutique_add_to_cart_text' );

/**
 * Change "View cart" text to "View basket" across the site
 */
function the_emily_boutique_change_view_cart_text( $translated_text, $text, $domain ) {
	// Only change WooCommerce domain strings
	if ( $domain === 'woocommerce' ) {
		// Change "View cart" to "View basket"
		if ( $text === 'View cart' || $text === 'View Cart' ) {
			return __( 'View basket', 'the-emily-boutique' );
		}
		// Change "View my cart" to "View my basket"
		if ( $text === 'View my cart' || $text === 'View My Cart' ) {
			return __( 'View my basket', 'the-emily-boutique' );
		}
		// Change standalone "in cart" strings (e.g. mini cart counters)
		if ( $text === 'in cart' || $text === 'In cart' || $text === 'In Cart' ) {
			return __( 'in basket', 'the-emily-boutique' );
		}
		// Change "%s in cart" to "%s in basket" for Product Blocks
		if ( $text === '%s in cart' ) {
			return __( '%s in basket', 'the-emily-boutique' );
		}
		// Change "Added to cart" to "Added to basket"
		if ( $text === 'Added to cart' ) {
			return __( 'Added to basket', 'the-emily-boutique' );
		}
	}
	
	return $translated_text;
}
add_filter( 'gettext', 'the_emily_boutique_change_view_cart_text', 20, 3 );

/**
 * Replace cart item count text with basket wording.
 */
function the_emily_boutique_cart_item_count_text( $text, $count ) {
	$basket_text = _n( '%d in basket', '%d in basket', $count, 'the-emily-boutique' );
	return sprintf( $basket_text, $count );
}
add_filter( 'woocommerce_cart_item_count_text', 'the_emily_boutique_cart_item_count_text', 10, 2 );

/**
 * Remove checkmark icon from add to cart button
 */
function the_emily_boutique_remove_checkmark_from_button( $args, $product ) {
	if ( isset( $args['attributes']['data-success_message'] ) ) {
		// Remove any icon markup from success message
		$args['attributes']['data-success_message'] = strip_tags( $args['attributes']['data-success_message'] );
	}
	return $args;
}
add_filter( 'woocommerce_loop_add_to_cart_args', 'the_emily_boutique_remove_checkmark_from_button', 10, 2 );

/**
 * Remove product categories and tags from single product page
 */
function the_emily_boutique_remove_product_meta() {
	// Only run on single product pages
	if ( ! is_product() ) {
		return;
	}
	
	// Remove the product meta section (which includes categories and tags)
	// This removes the entire product_meta section that displays categories and tags
	remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
}
add_action( 'wp', 'the_emily_boutique_remove_product_meta' );

/**
 * Remove Description and Reviews tabs from single product page
 */
function the_emily_boutique_remove_product_tabs( $tabs ) {
	// Remove Description tab (long description)
	unset( $tabs['description'] );
	
	// Remove Reviews tab
	unset( $tabs['reviews'] );
	
	return $tabs;
}
add_filter( 'woocommerce_product_tabs', 'the_emily_boutique_remove_product_tabs', 98 );

/**
 * Inject snow container into sections on front page
 */
function the_emily_boutique_add_snow_to_sections( $block_content, $block ) {
	// Only on front page
	if ( ! is_front_page() ) {
		return $block_content;
	}
	
	// Skip if it already has a snow container
	if ( strpos( $block_content, 'snow-container' ) !== false ) {
		return $block_content;
	}
	
	// Track how many sections have snow (limit to avoid performance issues)
	static $snow_count = 0;
	$max_snow_sections = 8; // Increased limit for more sections
	
	if ( $snow_count >= $max_snow_sections ) {
		return $block_content;
	}
	
	// Check if this is a Group, Cover, or WooCommerce block
	$is_relevant_block = false;
	if ( isset( $block['blockName'] ) ) {
		$is_relevant_block = in_array( $block['blockName'], array(
			'core/group',
			'core/cover',
			'woocommerce/product-category',
			'woocommerce/all-products',
			'woocommerce/handpicked-products'
		) ) || strpos( $block['blockName'], 'woocommerce' ) !== false;
	}
	
	if ( $is_relevant_block ) {
		
		// Check for spacing attributes that indicate a major section
		$is_major_section = false;
		if ( isset( $block['attrs']['spacing'] ) ) {
			$is_major_section = true;
		}
		
		// Check for className that indicates a section
		$has_section_indicator = false;
		if ( isset( $block['attrs']['className'] ) ) {
			$class_name = $block['attrs']['className'];
			$has_section_indicator = strpos( $class_name, 'hero' ) !== false ||
			                        strpos( $class_name, 'section' ) !== false ||
			                        strpos( $class_name, 'featured' ) !== false ||
			                        strpos( $class_name, 'about' ) !== false ||
			                        strpos( $class_name, 'category' ) !== false ||
			                        strpos( $class_name, 'shop' ) !== false ||
			                        strpos( $class_name, 'product' ) !== false;
		}
		
		// Check if content contains "category" or "shop" text (for shop by category sections)
		$has_category_text = false;
		if ( ! empty( $block_content ) ) {
			$has_category_text = stripos( $block_content, 'category' ) !== false ||
			                     stripos( $block_content, 'shop' ) !== false;
		}
		
		// Add snow to:
		// 1. All Cover blocks (usually hero sections)
		// 2. WooCommerce category/product blocks
		// 3. Group blocks with section-related classes
		// 4. Group blocks with spacing (major sections)
		// 5. Blocks containing "category" or "shop" text
		// 6. First several Group blocks (to catch other sections)
		if ( $block['blockName'] === 'core/cover' || 
		     strpos( $block['blockName'], 'woocommerce' ) !== false ||
		     $has_section_indicator || 
		     $is_major_section ||
		     $has_category_text ||
		     ( $block['blockName'] === 'core/group' && $snow_count < 6 ) ) {
			
			$snow_count++;
			// Inject snow container at the beginning of the block
			$snow_container = '<div class="snow-container"></div>';
			return $snow_container . $block_content;
		}
	}
	
	return $block_content;
}
add_filter( 'render_block', 'the_emily_boutique_add_snow_to_sections', 10, 2 );

/**
 * Add Delivery & Return Policies fields to WooCommerce Product Shipping tab
 */
function the_emily_boutique_add_delivery_fields() {
	global $woocommerce, $post;
	
	$product = wc_get_product( $post->ID );
	
	// Delivery - Minimum Days
	woocommerce_wp_text_input(
		array(
			'id'          => '_teb_delivery_min_days',
			'label'       => __( 'Delivery – earliest days from today', 'the-emily-boutique' ),
			'placeholder' => '4',
			'type'        => 'number',
			'custom_attributes' => array(
				'step' => '1',
				'min'  => '0',
			),
			'desc_tip'    => true,
			'description' => __( 'Enter the minimum number of days from today for delivery.', 'the-emily-boutique' ),
		)
	);
	
	// Delivery - Maximum Days
	woocommerce_wp_text_input(
		array(
			'id'          => '_teb_delivery_max_days',
			'label'       => __( 'Delivery – latest days from today', 'the-emily-boutique' ),
			'placeholder' => '8',
			'type'        => 'number',
			'custom_attributes' => array(
				'step' => '1',
				'min'  => '0',
			),
			'desc_tip'    => true,
			'description' => __( 'Enter the maximum number of days from today for delivery.', 'the-emily-boutique' ),
		)
	);
	
	// Delivery Cost
	woocommerce_wp_text_input(
		array(
			'id'          => '_teb_delivery_cost',
			'label'       => __( 'Delivery Cost', 'the-emily-boutique' ),
			'placeholder' => __( 'e.g., £5.99', 'the-emily-boutique' ),
			'desc_tip'    => true,
			'description' => __( 'Enter the delivery cost for this product.', 'the-emily-boutique' ),
		)
	);
	
	// Returns Policy
	woocommerce_wp_text_input(
		array(
			'id'          => '_teb_returns_policy',
			'label'       => __( 'Returns Policy', 'the-emily-boutique' ),
			'placeholder' => __( 'e.g., 30 days return policy', 'the-emily-boutique' ),
			'desc_tip'    => true,
			'description' => __( 'Enter the returns policy for this product.', 'the-emily-boutique' ),
		)
	);
	
	// Dispatched From
	woocommerce_wp_text_input(
		array(
			'id'          => '_teb_dispatched_from',
			'label'       => __( 'Dispatched From', 'the-emily-boutique' ),
			'placeholder' => __( 'e.g., London, UK', 'the-emily-boutique' ),
			'desc_tip'    => true,
			'description' => __( 'Enter the location this product is dispatched from.', 'the-emily-boutique' ),
		)
	);
}
add_action( 'woocommerce_product_options_shipping', 'the_emily_boutique_add_delivery_fields' );

/**
 * Save Delivery & Return Policies fields
 */
function the_emily_boutique_save_delivery_fields( $product ) {
	// Delivery - Minimum Days
	if ( isset( $_POST['_teb_delivery_min_days'] ) ) {
		$min_days = absint( $_POST['_teb_delivery_min_days'] );
		$product->update_meta_data( '_teb_delivery_min_days', $min_days );
	} else {
		$product->delete_meta_data( '_teb_delivery_min_days' );
	}
	
	// Delivery - Maximum Days
	if ( isset( $_POST['_teb_delivery_max_days'] ) ) {
		$max_days = absint( $_POST['_teb_delivery_max_days'] );
		$product->update_meta_data( '_teb_delivery_max_days', $max_days );
	} else {
		$product->delete_meta_data( '_teb_delivery_max_days' );
	}
	
	// Delivery Cost
	if ( isset( $_POST['_teb_delivery_cost'] ) ) {
		$product->update_meta_data( '_teb_delivery_cost', sanitize_text_field( $_POST['_teb_delivery_cost'] ) );
	}
	
	// Returns Policy
	if ( isset( $_POST['_teb_returns_policy'] ) ) {
		$product->update_meta_data( '_teb_returns_policy', sanitize_text_field( $_POST['_teb_returns_policy'] ) );
	}
	
	// Dispatched From
	if ( isset( $_POST['_teb_dispatched_from'] ) ) {
		$product->update_meta_data( '_teb_dispatched_from', sanitize_text_field( $_POST['_teb_dispatched_from'] ) );
	}
}
add_action( 'woocommerce_admin_process_product_object', 'the_emily_boutique_save_delivery_fields' );

/**
 * Display Delivery & Return Policies box on single product page
 */
function the_emily_boutique_display_delivery_box() {
	global $product;
	
	if ( ! $product ) {
		return;
	}
	
	$min_days = $product->get_meta( '_teb_delivery_min_days' );
	$max_days = $product->get_meta( '_teb_delivery_max_days' );
	$delivery_cost = $product->get_meta( '_teb_delivery_cost' );
	$returns_policy = $product->get_meta( '_teb_returns_policy' );
	$dispatched_from = $product->get_meta( '_teb_dispatched_from' );
	
	// Calculate delivery date(s) if min/max days are set
	$delivery_text = '';
	if ( ! empty( $min_days ) || ! empty( $max_days ) ) {
		$now = current_time( 'timestamp' );
		
		if ( ! empty( $min_days ) && ! empty( $max_days ) ) {
			// Both min and max are set
			$start = date_i18n( 'd M', strtotime( "+{$min_days} days", $now ) );
			$end = date_i18n( 'd M', strtotime( "+{$max_days} days", $now ) );
			$delivery_text = sprintf(
				/* translators: %1$s: start date, %2$s: end date */
				__( 'Order today to get by <strong>%1$s-%2$s</strong>', 'the-emily-boutique' ),
				esc_html( $start ),
				esc_html( $end )
			);
		} elseif ( ! empty( $min_days ) ) {
			// Only min is set
			$start = date_i18n( 'd M', strtotime( "+{$min_days} days", $now ) );
			$delivery_text = sprintf(
				/* translators: %s: delivery date */
				__( 'Order today to get by <strong>%s</strong>', 'the-emily-boutique' ),
				esc_html( $start )
			);
		}
	}
	
	// Only display if at least one field is filled
	if ( empty( $delivery_text ) && empty( $delivery_cost ) && empty( $returns_policy ) && empty( $dispatched_from ) ) {
		return;
	}
	
	?>
	<section class="product-delivery-box">
		<h3 class="product-delivery-title"><?php esc_html_e( 'Delivery and return policies', 'the-emily-boutique' ); ?></h3>
		<ul class="product-delivery-list">
			<?php if ( ! empty( $delivery_text ) ) : ?>
				<li>
					<span class="product-delivery-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="20" height="20" fill="currentColor">
							<path d="M224 64C206.3 64 192 78.3 192 96L192 128L160 128C124.7 128 96 156.7 96 192L96 240L544 240L544 192C544 156.7 515.3 128 480 128L448 128L448 96C448 78.3 433.7 64 416 64C398.3 64 384 78.3 384 96L384 128L256 128L256 96C256 78.3 241.7 64 224 64zM96 288L96 480C96 515.3 124.7 544 160 544L480 544C515.3 544 544 515.3 544 480L544 288L96 288z"/>
						</svg>
					</span>
					<span><?php echo wp_kses_post( $delivery_text ); ?></span>
				</li>
			<?php endif; ?>
			
			<?php if ( ! empty( $returns_policy ) ) : ?>
				<li>
					<span class="product-delivery-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="20" height="20" fill="currentColor">
							<path d="M560.3 301.2C570.7 313 588.6 315.6 602.1 306.7C616.8 296.9 620.8 277 611 262.3L563 190.3C560.2 186.1 556.4 182.6 551.9 180.1L351.4 68.7C332.1 58 308.6 58 289.2 68.7L88.8 180C83.4 183 79.1 187.4 76.2 192.8L27.7 282.7C15.1 306.1 23.9 335.2 47.3 347.8L80.3 365.5L80.3 418.8C80.3 441.8 92.7 463.1 112.7 474.5L288.7 574.2C308.3 585.3 332.2 585.3 351.8 574.2L527.8 474.5C547.9 463.1 560.2 441.9 560.2 418.8L560.2 301.3zM320.3 291.4L170.2 208L320.3 124.6L470.4 208L320.3 291.4zM278.8 341.6L257.5 387.8L91.7 299L117.1 251.8L278.8 341.6z"/>
						</svg>
					</span>
					<span><?php echo esc_html( $returns_policy ); ?></span>
				</li>
			<?php endif; ?>
			
			<?php if ( ! empty( $delivery_cost ) ) : ?>
				<li>
					<span class="product-delivery-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="20" height="20" fill="currentColor">
							<path d="M32 160C32 124.7 60.7 96 96 96L384 96C419.3 96 448 124.7 448 160L448 192L498.7 192C515.7 192 532 198.7 544 210.7L589.3 256C601.3 268 608 284.3 608 301.3L608 448C608 483.3 579.3 512 544 512L540.7 512C530.3 548.9 496.3 576 456 576C415.7 576 381.8 548.9 371.3 512L268.7 512C258.3 548.9 224.3 576 184 576C143.7 576 109.8 548.9 99.3 512L96 512C60.7 512 32 483.3 32 448L32 160zM544 352L544 301.3L498.7 256L448 256L448 352L544 352zM224 488C224 465.9 206.1 448 184 448C161.9 448 144 465.9 144 488C144 510.1 161.9 528 184 528C206.1 528 224 510.1 224 488zM456 528C478.1 528 496 510.1 496 488C496 465.9 478.1 448 456 448C433.9 448 416 465.9 416 488C416 510.1 433.9 528 456 528z"/>
						</svg>
					</span>
					<span><?php esc_html_e( 'Delivery cost:', 'the-emily-boutique' ); ?> <?php echo esc_html( $delivery_cost ); ?></span>
				</li>
			<?php endif; ?>
			
			<?php if ( ! empty( $dispatched_from ) ) : ?>
				<li>
					<span class="product-delivery-icon">
						<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" width="20" height="20" fill="currentColor">
							<path d="M128 252.6C128 148.4 214 64 320 64C426 64 512 148.4 512 252.6C512 371.9 391.8 514.9 341.6 569.4C329.8 582.2 310.1 582.2 298.3 569.4C248.1 514.9 127.9 371.9 127.9 252.6zM320 320C355.3 320 384 291.3 384 256C384 220.7 355.3 192 320 192C284.7 192 256 220.7 256 256C256 291.3 284.7 320 320 320z"/>
						</svg>
					</span>
					<span><?php esc_html_e( 'Dispatched from:', 'the-emily-boutique' ); ?> <?php echo esc_html( $dispatched_from ); ?></span>
				</li>
			<?php endif; ?>
		</ul>
	</section>
	<?php
}
add_action( 'woocommerce_single_product_summary', 'the_emily_boutique_display_delivery_box', 25 );

/**
 * Add introductory text to contact page before the form
 */
function the_emily_boutique_add_contact_intro( $content ) {
	// Only on contact page (post ID 254)
	if ( is_page( 254 ) || is_page( 'contact' ) ) {
		$intro_text = '<div class="contact-intro">';
		$intro_text .= '<p class="contact-intro-title"><strong>We\'d love to hear from you!</strong></p>';
		$intro_text .= '<p>If you have a question about your order, need help with personalisation, or just want to say hello, please get in touch using the form below.</p>';
		$intro_text .= '<p>We do our best to reply within 24–48 hours.</p>';
		$intro_text .= '</div>';
		
		// Add the intro text before the content
		$content = $intro_text . $content;
	}
	
	return $content;
}
add_filter( 'the_content', 'the_emily_boutique_add_contact_intro', 5 );

