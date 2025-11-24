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
	<a class="teb-cart-link" href="<?php echo esc_url( $cart_url ); ?>" aria-label="<?php esc_attr_e( 'View cart', 'the-emily-boutique' ); ?>">
		<span class="teb-cart-icon">
			<svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
				<path d="M7 18C5.9 18 5.01 18.9 5.01 20C5.01 21.1 5.9 22 7 22C8.1 22 9 21.1 9 20C9 18.9 8.1 18 7 18ZM1 2V4H3L6.6 11.59L5.25 14.04C5.09 14.32 5 14.65 5 15C5 16.1 5.9 17 7 17H19V15H7.42C7.28 15 7.17 14.89 7.17 14.75L7.2 14.63L8.1 13H16.55C17.3 13 17.96 12.59 18.3 11.97L21.88 5.48C22.25 4.82 21.78 4 21.01 4H5.21L4.27 2H1V2ZM17 18C15.9 18 15.01 18.9 15.01 20C15.01 21.1 15.9 22 17 22C18.1 22 19 21.1 19 20C19 18.9 18.1 18 17 18Z" fill="currentColor"/>
			</svg>
		</span>
		<span class="teb-cart-count"><?php echo esc_html( $cart_count ); ?></span>
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
	?>
	<span class="teb-cart-count"><?php echo esc_html( $cart_count ); ?></span>
	<?php
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

