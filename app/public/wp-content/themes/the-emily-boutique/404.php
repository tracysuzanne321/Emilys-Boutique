<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package The_Emily_Boutique
 */

get_header();
?>

<div class="site-container">
	<section class="error-404">
		<div class="error-404-content">
			<h1>404</h1>
			<h2><?php esc_html_e( 'Oops! That page can&rsquo;t be found.', 'the-emily-boutique' ); ?></h2>
			<p><?php esc_html_e( 'It looks like nothing was found at this location. Maybe try one of the links below or a search?', 'the-emily-boutique' ); ?></p>
			<a href="<?php echo esc_url( home_url( '/' ) ); ?>" class="btn btn-primary">
				<?php esc_html_e( 'Return Home', 'the-emily-boutique' ); ?>
			</a>
		</div>
	</section>
</div>

<?php
get_footer();

