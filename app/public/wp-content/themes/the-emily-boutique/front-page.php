<?php
/**
 * The front page template
 *
 * @package The_Emily_Boutique
 */

get_header();

// Get the front page content
if ( have_posts() ) {
	while ( have_posts() ) {
		the_post();
		?>
		<div class="site-container">
			<?php the_content(); ?>
		</div>
		<?php
	}
} else {
	// Fallback: Display a message if no front page is set
	?>
	<div class="site-container">
		<div class="no-front-page-content">
			<h1><?php esc_html_e( 'Welcome to The Emily Boutique', 'the-emily-boutique' ); ?></h1>
			<p><?php esc_html_e( 'Please set a static page as your front page in Settings > Reading, or create content using the Gutenberg block editor.', 'the-emily-boutique' ); ?></p>
		</div>
	</div>
	<?php
}

get_footer();

