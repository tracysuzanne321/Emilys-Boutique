<?php
/**
 * The front page template
 *
 * @package The_Emily_Boutique
 */

get_header();
?>

<!-- Hero Section -->
<section class="hero-section">
	<div class="hero-inner">
		<div class="hero-content">
			<h1><?php esc_html_e( 'Handmade Prints and Beads by Emily', 'the-emily-boutique' ); ?></h1>
			<p><?php esc_html_e( 'Discover our beautiful collection of handcrafted prints and carefully selected beads. Each piece is thoughtfully created with love and attention to detail.', 'the-emily-boutique' ); ?></p>
			<div class="hero-buttons">
				<?php
				$shop_url = '';
				if ( class_exists( 'WooCommerce' ) ) {
					$shop_url = wc_get_page_permalink( 'shop' );
				} else {
					$shop_url = home_url( '/shop/' );
				}
				?>
				<a href="<?php echo esc_url( $shop_url ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'Shop All Products', 'the-emily-boutique' ); ?>
				</a>
				<?php
				$about_page = get_page_by_path( 'about' );
				if ( $about_page ) {
					?>
					<a href="<?php echo esc_url( get_permalink( $about_page->ID ) ); ?>" class="btn btn-secondary">
						<?php esc_html_e( 'About Emily', 'the-emily-boutique' ); ?>
					</a>
					<?php
				}
				?>
			</div>
		</div>
		<div class="hero-image">
			<img src="<?php echo esc_url( get_template_directory_uri() . '/images/Emily logo.png' ); ?>" alt="<?php esc_attr_e( 'Emily Logo', 'the-emily-boutique' ); ?>" class="hero-logo-image" />
		</div>
	</div>
</section>

<div class="site-container">
	<!-- Featured Categories -->
	<section class="featured-categories">
		<h2 class="section-title"><?php esc_html_e( 'Shop by Category', 'the-emily-boutique' ); ?></h2>
		<div class="categories-grid">
			<?php
			$beads_url = '';
			$prints_url = '';
			
			if ( class_exists( 'WooCommerce' ) ) {
				$shop_url = wc_get_page_permalink( 'shop' );
				$beads_term = get_term_by( 'slug', 'beads', 'product_cat' );
				$prints_term = get_term_by( 'slug', 'prints', 'product_cat' );
				
				if ( $beads_term ) {
					$beads_url = get_term_link( $beads_term->term_id, 'product_cat' );
				} else {
					$beads_url = add_query_arg( 'product_cat', 'beads', $shop_url );
				}
				
				if ( $prints_term ) {
					$prints_url = get_term_link( $prints_term->term_id, 'product_cat' );
				} else {
					$prints_url = add_query_arg( 'product_cat', 'prints', $shop_url );
				}
			} else {
				$beads_url = home_url( '/shop/?product_cat=beads' );
				$prints_url = home_url( '/shop/?product_cat=prints' );
			}
			?>
			
			<div class="category-card">
				<h3><?php esc_html_e( 'Beads', 'the-emily-boutique' ); ?></h3>
				<p><?php esc_html_e( 'Handmade earrings, bracelets and accessories, created with beautiful beads and thoughtful details. Treat yourself or find a sweet little gift for someone special' ); ?></p>
				<a href="<?php echo esc_url( $beads_url ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'Shop Beads', 'the-emily-boutique' ); ?>
				</a>
			</div>
			
			<div class="category-card">
				<h3><?php esc_html_e( 'Prints', 'the-emily-boutique' ); ?></h3>
				<p><?php esc_html_e( 'Elegant personalised art prints featuring floral details and feminine design elements. Perfect for adding a beautiful, delicate touch to any space.', 'the-emily-boutique' ); ?></p>
				<a href="<?php echo esc_url( $prints_url ); ?>" class="btn btn-primary">
					<?php esc_html_e( 'Shop Prints', 'the-emily-boutique' ); ?></a>
			</div>
		</div>
	</section>

	<!-- About Teaser -->
	<section class="about-teaser">
		<div class="about-teaser-content">
			<h2><?php esc_html_e( 'About Emily', 'the-emily-boutique' ); ?></h2>
			<p><?php esc_html_e( 'Welcome to The Emily Boutique! I\'m passionate about creating beautiful, handcrafted pieces that bring joy and elegance to your life. Each product is carefully selected and created with love, ensuring you receive something truly special.', 'the-emily-boutique' ); ?></p>
			<?php
			$about_page = get_page_by_path( 'about' );
			if ( $about_page ) {
				?>
				<a href="<?php echo esc_url( get_permalink( $about_page->ID ) ); ?>" class="btn btn-secondary">
					<?php esc_html_e( 'Read More', 'the-emily-boutique' ); ?>
				</a>
				<?php
			}
			?>
		</div>
	</section>

	<!-- Featured Products (WooCommerce) -->
	<?php if ( class_exists( 'WooCommerce' ) ) : ?>
		<section class="featured-products">
			<h2 class="section-title"><?php esc_html_e( 'Featured Products', 'the-emily-boutique' ); ?></h2>
			<?php
			$args = array(
				'post_type'      => 'product',
				'posts_per_page' => 4,
				'meta_key'       => '_featured',
				'meta_value'     => 'yes',
				'orderby'        => 'date',
				'order'          => 'DESC',
			);
			
			$featured_products = new WP_Query( $args );
			
			if ( $featured_products->have_posts() ) {
				?>
				<div class="products">
					<?php
					while ( $featured_products->have_posts() ) {
						$featured_products->the_post();
						wc_get_template_part( 'content', 'product' );
					}
					wp_reset_postdata();
					?>
				</div>
				<?php
			} else {
				// Fallback: show recent products if no featured products
				$args = array(
					'post_type'      => 'product',
					'posts_per_page' => 4,
					'orderby'        => 'date',
					'order'          => 'DESC',
				);
				
				$recent_products = new WP_Query( $args );
				
				if ( $recent_products->have_posts() ) {
					?>
					<div class="products">
						<?php
						while ( $recent_products->have_posts() ) {
							$recent_products->the_post();
							wc_get_template_part( 'content', 'product' );
						}
						wp_reset_postdata();
						?>
					</div>
					<?php
				}
			}
			?>
		</section>
	<?php endif; ?>
</div>

<?php
get_footer();

