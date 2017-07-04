<?php
ob_start();
/**
 * Template Name: Submit review
 */
?>
<?php get_header('fullwidth'); ?>

<div class="sub-header">	
	<main id="main" class="container" role="main">
		<div id="primary" class="row">
			<?php while ( have_posts() ) : the_post(); ?>
				<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
				<header class="text-center entry-header">
					<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
					<?php ihpc_edit_link( get_the_ID() ); ?>
				</header><!-- .entry-header -->
				<div class="entry-content text-center">
					<?php
						the_content();
						wp_link_pages( array(
							'before' => '<div class="page-links">' . __( 'Pages:', 'ihpc' ),
							'after'  => '</div>',
						) );
					?>
				</div><!-- .entry-content -->
			</article><!-- #post-## -->
			<?php endwhile; // End of the loop. ?>
		</div><!-- #primary -->
	</main><!-- #main -->	
</div><!-- .wrap -->
<?php ihpc_errors_display() ?>
<?php
/***
* These variables will available in all these templates
****/
$reviewId 	 = $_GET['reviewId'];
$screen_no 	 = $_GET['screen_no'];
$companyId 	 = get_post_meta($reviewId,'REVIEW_COMPANYID',true);
$companyName = get_the_title($companyId);
switch ($screen_no) {
	case '2':
		include_once "review_forms/step2.php";
	break;
	case '3':
		include_once "review_forms/step3.php";
	break;
	case '4':
		include_once "review_forms/step4.php";
	break;
	default:
		include_once "review_forms/default_form.php";
	break;
}
?>

<?php get_footer('fullwidth'); ?>