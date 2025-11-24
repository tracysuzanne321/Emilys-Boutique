<?php
/**
 * The template for displaying single posts
 *
 * @package The_Emily_Boutique
 */

get_header();
?>

<div class="site-container">
	<?php
	while ( have_posts() ) :
		the_post();
		?>
		<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
			<header class="single-post-header">
				<?php if ( has_post_thumbnail() ) : ?>
					<div class="post-thumbnail">
						<?php the_post_thumbnail( 'large' ); ?>
					</div>
				<?php endif; ?>
				
				<h1 class="post-title"><?php the_title(); ?></h1>
				
				<div class="post-meta">
					<span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
					<?php
					$categories = get_the_category_list( ', ' );
					if ( $categories ) {
						echo ' <span class="sep">|</span> ';
						echo '<span class="post-categories">' . $categories . '</span>';
					}
					?>
				</div>
			</header>

			<div class="post-content">
				<?php
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'the-emily-boutique' ),
						'after'  => '</div>',
					)
				);
				?>
			</div>

			<nav class="post-navigation">
				<div class="nav-links">
					<?php
					$prev_post = get_previous_post();
					if ( $prev_post ) {
						?>
						<div class="nav-previous">
							<a href="<?php echo esc_url( get_permalink( $prev_post->ID ) ); ?>" rel="prev">
								&laquo; <?php echo esc_html( $prev_post->post_title ); ?>
							</a>
						</div>
						<?php
					}
					
					$next_post = get_next_post();
					if ( $next_post ) {
						?>
						<div class="nav-next">
							<a href="<?php echo esc_url( get_permalink( $next_post->ID ) ); ?>" rel="next">
								<?php echo esc_html( $next_post->post_title ); ?> &raquo;
							</a>
						</div>
						<?php
					}
					?>
				</div>
			</nav>
		</article>
		<?php
	endwhile;
	?>
</div>

<?php
get_footer();

