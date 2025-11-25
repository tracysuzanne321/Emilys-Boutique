<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<div class="header-inner">
			<div class="site-branding">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					?>
					<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="site-logo" rel="home">
						<?php bloginfo( 'name' ); ?>
					</a>
					<?php
				}
				?>
			</div>

			<nav id="site-navigation" class="primary-navigation" aria-label="<?php esc_attr_e( 'Primary Menu', 'the-emily-boutique' ); ?>">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false">
					<span class="screen-reader-text"><?php esc_html_e( 'Menu', 'the-emily-boutique' ); ?></span>
					<span aria-hidden="true">☰</span>
				</button>
				<?php
				wp_nav_menu(
					array(
						'theme_location' => 'primary',
						'menu_id'        => 'primary-menu',
						'container'      => false,
						'menu_class'     => 'nav-menu',
					)
				);
				?>
			</nav>

			<?php if ( function_exists( 'the_emily_boutique_header_cart' ) ) : ?>
				<div class="teb-header-cart">
					<?php the_emily_boutique_header_cart(); ?>
				</div>
			<?php endif; ?>
		</div>
	</header>

	<main id="main" class="site-main">

