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

get_header(); 

/***
* If filter by address
***/
if( !empty($_REQUEST['location']['address']) ){
	$search_args = array( 'post_type' => 'review' );
	$ids = get_post_by_location( $_REQUEST['location']['address'], '_review_location' );
	if( $ids == 'No result found' ){
		$search_args['author_name'] = $ids;
	}
	else{
		$search_args['post__in'] = $ids;
	}
	$GLOBALS['wp_query'] = new WP_Query( $search_args );
}

/***
* If filter by tag
***/
if( !empty($_REQUEST['tag']) ){
	$tag = esc_attr($_REQUEST['tag']);
	$search_args = array( 'post_type' => 'review', 'tag' => $tag );
	$GLOBALS['wp_query'] = new WP_Query( $search_args );
}

/***
* If filter by comment count
***/
if( !empty($_REQUEST['recently']) ){
	$search_args = array( 'post_type' => 'review', 'orderby' => 'comment_count', 'order'   => 'DESC' );
	$GLOBALS['wp_query'] = new WP_Query( $search_args );
}

/***
* If filter by comment count
***/
if( !empty($_REQUEST['media']) ){
	$postsWithImages = get_post_by_location('','uploaded_photos');
	$search_args = 	array('post_type' => 'review');
	if( $postsWithImages == 'No result found' ){
		$search_args['author_name'] = $postsWithImages;
	}
	else{
		$search_args['post__in'] = $postsWithImages;
	}
	$GLOBALS['wp_query'] = new WP_Query( $search_args );	
}

?>

<div class="col-lg-9">
	<div class="wrap" id="review_page">
		<header class="page-header">
			<h1>Browse Complaints and Reviews</h1>
		</header><!-- .page-header -->
		<div class="search-box ">
			<form action="" method="post" class="clearfix">
				<?php echo get_company_search_box() ?>
				<div class="parameters">
                    <ul class="list-inline" style="display: block;">
						<li><a data-toggle="modal" data-target="#choose-company"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">Company</a></li>
						<li><a data-toggle="modal" data-target="#choose-location"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">Location</a></li>
						<li><a data-toggle="modal" data-target="#choose-category"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/categories.png">Category</a></li>
						<li><a data-toggle="modal" data-target="#choose-tag"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">Tag</a></li>
						<li><a href="<?php echo get_current_url() ?>?recently=1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">Recently discussed</a></li>
						<li><a href="<?php echo get_current_url() ?>?media=1"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">With media</a></li>
					</ul>
                </div>
			</form>
		</div>
		<?php //echo $count = $GLOBALS['wp_query']->post_count; ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) :
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
			else :
				get_template_part( 'template-parts/post/content', 'none' );
			endif;
			if ( function_exists('wp_bootstrap_pagination') )
				wp_bootstrap_pagination();
			?>
			</main><!-- #main -->
		</div><!-- #primary -->		
	</div>
</div><!-- .wrap -->
<div class="col-lg-3">
	<?php get_sidebar('sidebar-1'); ?>
</div>

<?php 
//Including the category modal
include_once "inc/modals/company_categories.php";
//Including the location modal
include_once "inc/modals/location.php";
//Including the location modal
include_once "inc/modals/companies.php";
//Including the location modal
include_once "inc/modals/tags.php";

get_footer(); ?>
