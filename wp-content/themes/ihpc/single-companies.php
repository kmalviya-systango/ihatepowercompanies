<?php
/**
 * The template for displaying all Single Review posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage IHPC
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>

					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>	
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						</header>
						<?php if ( '' !== get_the_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'ihpc-featured-image' ); ?>
								</a>
							</div><!-- .post-thumbnail -->
						<?php endif; ?>
						<div class="entry-content">
							<?php
								/* translators: %s: Name of current post */
								the_content( sprintf(
									__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ihpc' ),
									get_the_title()
								) );			
							?>
						</div><!-- .entry-content -->
						<div>
							<a href="<?php echo site_url('for-business') ?>">Contact author</a>
						</div>
					</article><!-- #post-## -->
					<div>
						Had an Experience with <?php echo get_the_title() ?>? <a href="<?php echo site_url('submit-review') ?>">Write a review</a>
					</div>
					<?php					
				endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->	
</div><!-- .wrap -->

<?php get_footer();
