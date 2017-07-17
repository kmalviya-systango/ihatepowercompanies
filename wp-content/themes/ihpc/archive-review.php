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
				<a href="javascript:void(0)" id="_advanceSearch" class="pull-right as">Advanced Search</a>
				<div class="parameters">
					<ul class="filter-parameters">
					  <li><a data-toggle="modal" data-target="#choose-company"> <span class="icon icon-review-company"></span> <span class="icon-text">Company</span> </a></li>
					  <li><a data-toggle="modal" data-target="#choose-location"> <span class="icon icon-review-location"></span> <span class="icon-text">Location</span></a></li>
					  <li><a data-toggle="modal" data-target="#choose-category"> <span class="icon icon-review-Category"></span> <span class="icon-text">Category</span></a></li>
					  <li><a data-toggle="modal" data-target="#choose-tag"> <span class="icon icon-review-tag"></span> <span class="icon-text">Tag</span></a></li>
					  <li><a href="<?php echo get_current_url() ?>?recently=1"> <span class="icon icon-review-comment"></span> <span class="icon-text">Discussed</span> </a></li>
					  <li><a href="<?php echo get_current_url() ?>?media=1"> <span class="icon icon-review-media"></span> <span class="icon-text">With media</span> </a></li>
					</ul>               
                </div>
			</form>
		</div>
		<?php //echo $count = $GLOBALS['wp_query']->post_count; ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) :
				$countblocks = 0;
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					$countblocks++;
					get_template_part( 'template-parts/post/content', 'review' );
					if( ($countblocks%2) == 0){
						if (function_exists ('adinserter')){
							echo adinserter (5);	
						} 
					}
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
<script type="text/javascript">
$( "#_advanceSearch" ).click(function() {
  $('.filter-parameters').slideToggle( "fast" );
});
</script>
