	</main><!-- #main -->

	<footer id="colophon" class="site-footer">
		<div class="site-container">
			<div class="footer-content">
				<div class="footer-column footer-about">
					<?php
					if ( has_custom_logo() ) {
						the_custom_logo();
					} else {
						?>
						<h3 class="footer-logo"><?php bloginfo( 'name' ); ?></h3>
						<?php
					}
					?>
					<p class="footer-tagline"><?php esc_html_e( 'Handmade prints and beads with love and attention to detail.', 'the-emily-boutique' ); ?></p>
				</div>

				<div class="footer-column footer-shop">
					<h4 class="footer-title"><?php esc_html_e( 'Shop', 'the-emily-boutique' ); ?></h4>
					<?php
					if ( has_nav_menu( 'footer-menu-one' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer-menu-one',
							'menu_class'     => 'footer-menu',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
						) );
					} else {
						// Fallback to default menu if no menu is assigned
						?>
						<ul class="footer-menu">
							<?php
							$shop_url = '';
							if ( class_exists( 'WooCommerce' ) ) {
								$shop_url = wc_get_page_permalink( 'shop' );
							} else {
								$shop_url = home_url( '/shop/' );
							}
							?>
							<li><a href="<?php echo esc_url( $shop_url ); ?>"><?php esc_html_e( 'All Products', 'the-emily-boutique' ); ?></a></li>
							<?php
							if ( class_exists( 'WooCommerce' ) ) {
								$beads_term = get_term_by( 'slug', 'beads', 'product_cat' );
								$prints_term = get_term_by( 'slug', 'prints', 'product_cat' );
								
								if ( $beads_term ) {
									$beads_url = get_term_link( $beads_term->term_id, 'product_cat' );
									?>
									<li><a href="<?php echo esc_url( $beads_url ); ?>"><?php esc_html_e( 'Beads', 'the-emily-boutique' ); ?></a></li>
									<?php
								}
								
								if ( $prints_term ) {
									$prints_url = get_term_link( $prints_term->term_id, 'product_cat' );
									?>
									<li><a href="<?php echo esc_url( $prints_url ); ?>"><?php esc_html_e( 'Prints', 'the-emily-boutique' ); ?></a></li>
									<?php
								}
							}
							?>
						</ul>
						<?php
					}
					?>
				</div>

				<div class="footer-column footer-info">
					<h4 class="footer-title"><?php esc_html_e( 'Information', 'the-emily-boutique' ); ?></h4>
					<?php
					if ( has_nav_menu( 'footer-menu-two' ) ) {
						wp_nav_menu( array(
							'theme_location' => 'footer-menu-two',
							'menu_class'     => 'footer-menu',
							'container'      => false,
							'depth'          => 1,
							'fallback_cb'    => false,
						) );
					}
					?>
				</div>

				<div class="footer-column footer-connect">
					<h4 class="footer-title"><?php esc_html_e( 'Connect', 'the-emily-boutique' ); ?></h4>
					<p class="footer-social-text"><?php esc_html_e( 'Follow us for updates and inspiration', 'the-emily-boutique' ); ?></p>
					<ul class="footer-social-links">
						<?php
						// Update these URLs with your actual social media links
						$facebook_url = 'https://facebook.com/yourpage'; // Update this
						$instagram_url = 'https://instagram.com/yourpage'; // Update this
						$tiktok_url = 'https://tiktok.com/@yourpage'; // Update this
						?>
						<li>
							<a href="<?php echo esc_url( $facebook_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Facebook', 'the-emily-boutique' ); ?>">
								<svg class="social-icon" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M24 12.073c0-6.627-5.373-12-12-12s-12 5.373-12 12c0 5.99 4.388 10.954 10.125 11.854v-8.385H7.078v-3.47h3.047V9.43c0-3.007 1.792-4.669 4.533-4.669 1.312 0 2.686.235 2.686.235v2.953H15.83c-1.491 0-1.956.925-1.956 1.874v2.25h3.328l-.532 3.47h-2.796v8.385C19.612 23.027 24 18.062 24 12.073z"/>
								</svg>
								<span class="screen-reader-text">Facebook</span>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url( $instagram_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'Instagram', 'the-emily-boutique' ); ?>">
								<svg class="social-icon" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M12 2.163c3.204 0 3.584.012 4.85.07 3.252.148 4.771 1.691 4.919 4.919.058 1.265.069 1.645.069 4.849 0 3.205-.012 3.584-.069 4.849-.149 3.225-1.664 4.771-4.919 4.919-1.266.058-1.644.07-4.85.07-3.204 0-3.584-.012-4.849-.07-3.26-.149-4.771-1.699-4.919-4.92-.058-1.265-.07-1.644-.07-4.849 0-3.204.013-3.583.07-4.849.149-3.227 1.664-4.771 4.919-4.919 1.266-.057 1.645-.069 4.849-.069zm0-2.163c-3.259 0-3.667.014-4.947.072-4.358.2-6.78 2.618-6.98 6.98-.059 1.281-.073 1.689-.073 4.948 0 3.259.014 3.668.072 4.948.2 4.358 2.618 6.78 6.98 6.98 1.281.058 1.689.072 4.948.072 3.259 0 3.668-.014 4.948-.072 4.354-.2 6.782-2.618 6.979-6.98.059-1.28.073-1.689.073-4.948 0-3.259-.014-3.667-.072-4.947-.196-4.354-2.617-6.78-6.979-6.98-1.281-.059-1.69-.073-4.949-.073zm0 5.838c-3.403 0-6.162 2.759-6.162 6.162s2.759 6.163 6.162 6.163 6.162-2.759 6.162-6.163c0-3.403-2.759-6.162-6.162-6.162zm0 10.162c-2.209 0-4-1.79-4-4 0-2.209 1.791-4 4-4s4 1.791 4 4c0 2.21-1.791 4-4 4zm6.406-11.845c-.796 0-1.441.645-1.441 1.44s.645 1.44 1.441 1.44c.795 0 1.439-.645 1.439-1.44s-.644-1.44-1.439-1.44z"/>
								</svg>
								<span class="screen-reader-text">Instagram</span>
							</a>
						</li>
						<li>
							<a href="<?php echo esc_url( $tiktok_url ); ?>" target="_blank" rel="noopener noreferrer" aria-label="<?php esc_attr_e( 'TikTok', 'the-emily-boutique' ); ?>">
								<svg class="social-icon" width="32" height="32" viewBox="0 0 24 24" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
									<path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z"/>
								</svg>
								<span class="screen-reader-text">TikTok</span>
							</a>
						</li>
					</ul>
				</div>
			</div>

			<div class="footer-bottom">
				<p class="footer-copyright">&copy; <?php echo esc_html( date( 'Y' ) ); ?> <?php bloginfo( 'name' ); ?>. <?php esc_html_e( 'All rights reserved.', 'the-emily-boutique' ); ?></p>
				<p class="footer-credit"><?php esc_html_e( 'Website made by', 'the-emily-boutique' ); ?> <a href="https://jts-digital.co.uk" target="_blank" rel="noopener noreferrer">JTS Digital</a></p>
			</div>
		</div>
	</footer>
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>

