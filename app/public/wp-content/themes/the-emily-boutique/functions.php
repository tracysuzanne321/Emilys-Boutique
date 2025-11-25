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

