<?php
/**
 * The template for displaying archive pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>
<div class="col-lg-9">
	<div class="wrap" id="review_page">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<?php
					the_archive_title( '<h1 class="page-title">', '</h1>' );
					the_archive_description( '<div class="taxonomy-description">', '</div>' );
				?>
			</header><!-- .page-header -->
		<?php endif; ?>
		<?php echo $count = $GLOBALS['wp_query']->post_count; ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					/*
					 * Include the Post-Format-specific template for the content.
					 * If you want to override this in a child theme, then include a file
					 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
					 */
					//get_template_part( 'template-parts/post/content', get_post_format() );
					get_template_part( 'template-parts/post/content', 'review' );
				endwhile;
				the_posts_pagination( array(
					'prev_text' => 'Prev',
					'next_text' => 'Next'
				) );
			else :
				get_template_part( 'template-parts/post/content', 'none' );
			endif; 
			?>
			</main><!-- #main -->
		</div><!-- #primary -->		
	</div>
</div><!-- .wrap -->
<div class="col-lg-3">
	<?php get_sidebar('sidebar-1'); ?>
</div>

<?php get_footer(); ?>
