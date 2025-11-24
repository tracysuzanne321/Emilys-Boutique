<?php
/**
 * The main template file
 *
 * @package The_Emily_Boutique
 */

get_header();
?>

<div class="site-container">
	<?php if ( have_posts() ) : ?>
		<header class="page-header">
			<h1 class="page-title"><?php esc_html_e( 'Blog', 'the-emily-boutique' ); ?></h1>
		</header>

		<div class="posts-grid">
			<?php
			while ( have_posts() ) :
				the_post();
				?>
				<article id="post-<?php the_ID(); ?>" <?php post_class( 'post-card' ); ?>>
					<?php if ( has_post_thumbnail() ) : ?>
						<a href="<?php the_permalink(); ?>" class="post-card-image-link">
							<?php the_post_thumbnail( 'medium_large', array( 'class' => 'post-card-image' ) ); ?>
						</a>
					<?php endif; ?>
					
					<div class="post-card-content">
						<h2 class="post-card-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>
						
						<div class="post-card-meta">
							<span class="post-date"><?php echo esc_html( get_the_date() ); ?></span>
							<?php
							$categories = get_the_category();
							if ( ! empty( $categories ) ) {
								echo ' <span class="sep">|</span> ';
								echo '<span class="post-categories">' . esc_html( $categories[0]->name ) . '</span>';
							}
							?>
						</div>
						
						<div class="post-card-excerpt">
							<?php the_excerpt(); ?>
						</div>
						
						<a href="<?php the_permalink(); ?>" class="btn btn-primary">
							<?php esc_html_e( 'Read More', 'the-emily-boutique' ); ?>
						</a>
					</div>
				</article>
				<?php
			endwhile;
			?>
		</div>

		<?php
		the_posts_pagination(
			array(
				'mid_size'  => 2,
				'prev_text' => esc_html__( '&laquo; Previous', 'the-emily-boutique' ),
				'next_text' => esc_html__( 'Next &raquo;', 'the-emily-boutique' ),
			)
		);
		?>

	<?php else : ?>
		<div class="no-posts">
			<h1><?php esc_html_e( 'Nothing Found', 'the-emily-boutique' ); ?></h1>
			<p><?php esc_html_e( 'It seems we can\'t find what you\'re looking for. Perhaps try searching?', 'the-emily-boutique' ); ?></p>
			<?php get_search_form(); ?>
		</div>
	<?php endif; ?>
</div>

<?php
get_footer();

