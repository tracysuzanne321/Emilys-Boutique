<?php
/**
 * The Template for displaying product archives, including the main shop page
 *
 * @package The_Emily_Boutique
 */

defined( 'ABSPATH' ) || exit;

get_header();
?>

<?php if ( is_shop() || is_product_category() || is_product_tag() ) : ?>
	<div class="shop-banner">
		<div class="shop-banner-content">
			<nav class="shop-banner-breadcrumb" aria-label="Breadcrumb">
				<?php woocommerce_breadcrumb(); ?>
			</nav>
			<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
				<h1 class="shop-banner-title">
					<?php woocommerce_page_title(); ?>
				</h1>
			<?php endif; ?>
			<?php if ( is_shop() ) : ?>
				<p class="shop-banner-subheading">
					<?php echo apply_filters( 'the_emily_boutique_shop_banner_subheading', 'Discover our beautiful collection of handcrafted pieces' ); ?>
				</p>
			<?php elseif ( is_product_category() ) : ?>
				<?php
				$category = get_queried_object();
				$category_description = term_description( $category->term_id, 'product_cat' );
				if ( ! empty( $category_description ) ) : ?>
					<div class="shop-banner-subheading">
						<?php echo wp_kses_post( $category_description ); ?>
					</div>
				<?php else : ?>
					<p class="shop-banner-subheading">
						<?php echo apply_filters( 'the_emily_boutique_category_banner_subheading', 'Browse our curated selection' ); ?>
					</p>
				<?php endif; ?>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>

<div class="woocommerce">
	<?php
	/**
	 * Hook: woocommerce_before_main_content
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 */
	do_action( 'woocommerce_before_main_content' );
	?>

	<header class="woocommerce-products-header">
		<?php if ( apply_filters( 'woocommerce_show_page_title', true ) ) : ?>
			<h1 class="woocommerce-products-header__title page-title">
				<?php woocommerce_page_title(); ?>
			</h1>
		<?php endif; ?>

		<?php
		/**
		 * Hook: woocommerce_archive_description
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */
		do_action( 'woocommerce_archive_description' );
		?>
	</header>

	<?php
	if ( woocommerce_product_loop() ) {
		/**
		 * Hook: woocommerce_before_shop_loop
		 *
		 * @hooked woocommerce_output_all_notices - 10
		 * @hooked woocommerce_result_count - 20
		 * @hooked woocommerce_catalog_ordering - 30
		 */
		do_action( 'woocommerce_before_shop_loop' );

		woocommerce_product_loop_start();

		if ( wc_get_loop_prop( 'is_shortcode' ) ) {
			$columns = absint( wc_get_loop_prop( 'columns' ) );
			$GLOBALS['woocommerce_loop']['columns'] = $columns;
		}

		while ( have_posts() ) {
			the_post();

			/**
			 * Hook: woocommerce_shop_loop
			 */
			do_action( 'woocommerce_shop_loop' );

			wc_get_template_part( 'content', 'product' );
		}

		woocommerce_product_loop_end();

		/**
		 * Hook: woocommerce_after_shop_loop
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );
	} else {
		/**
		 * Hook: woocommerce_no_products_found
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}

	/**
	 * Hook: woocommerce_after_main_content
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );
	?>
</div>

<?php
get_footer();

