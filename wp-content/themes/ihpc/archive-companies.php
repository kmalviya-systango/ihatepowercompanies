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

/*****
* Start: Creating a query argument based on request parameters
****/
$search_args = array('post_type' => 'companies');
$searchedId  = array();

if( !empty($_REQUEST['orderBy']) ){
	$search_args['orderby'] = 'title';
	$search_args['order'] 	= 'ASC';
}

if( !empty($_REQUEST['category_filter']) ){
	$search_args['tax_query'] = array( array('taxonomy'=>'companiestax',
											'field'=>'id',
											'terms'=> $_REQUEST['category_filter'],
											'operator'=>'IN')
									);
}
if( !empty($_REQUEST['location']['address']) ){	
	global $wpdb;
	$address = $_REQUEST['location']['address'];
	$tableName = $wpdb->prefix."postmeta";
	$sql 	 = "SELECT * FROM $tableName WHERE meta_value like '%$address%' AND meta_key = 'company_location' ";
	$postIds = $wpdb->get_results($sql,ARRAY_A);
	if( !empty($postIds) ){
		foreach ($postIds as $key => $id) {
			if( $id['meta_value'] != '' ){
				$searchedId[] = $id['post_id'];
			}			
		}		
	}	
	/*$search_args['meta_query'] = array( 
										array(	'key' => 'company_location',
												'value' => maybe_serialize($_REQUEST['location']),
												'Compare' => '=' 
												)
									);*/
	//$search_args['meta_key'] 	= 'company_location';
	//$search_args['meta_value'] = serialize($_REQUEST['location']);	
}
if( !empty($_REQUEST['company_name']) ){
	global $wpdb;
	$companyNameSql = "select ID from $wpdb->posts where post_title LIKE '%".$_REQUEST['company_name']."%' ";
	$mypostids = $wpdb->get_col($companyNameSql);
	//$search_args['title'] 	= $_REQUEST['company_name'];
	if( !empty($mypostids) ){
		foreach ($mypostids as $key => $ids) {
			$searchedId[] = $ids;
		}
	}	
	//$search_args['post__in'] = $mypostids;
}
if( !empty($_REQUEST['category_filter']) || !empty($_REQUEST['location']) || !empty($_REQUEST['company_name']) ){
	if( !empty($searchedId) ){
		$search_args['post__in'] = $searchedId;
	}
	$GLOBALS['wp_query'] = new WP_Query( $search_args );
}
/*echo "<pre>";
print_r($search_args);
echo "</pre>";*/
/*
* End;
*/
?>
	<?php if ( have_posts() ) : ?>
		<h1>Browse Companies</h1>
	<?php endif; ?>

	<div class="row">
		<div class="col-lg-12">
			<div class="search-box ">
				<?php $companycount = $GLOBALS['wp_query']->post_count; ?>
				<label>All companies <?php echo $companycount; ?> </label>
				<form action="" method="post" class="clearfix">
					<div class="search-for-car clearfix">
						<div class="inner-search">
							<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
								<input required="required" name="company_name" id="company_name" class="form-control search-input width-100" placeholder="Company Name" type="text" />
							</div>
						</div>
						<input value="" class="btn-style inner-search-button " type="submit" data-toggle="modal" data-target="#reviews-by-location" />
					</div>
				</form>
			</div>
			<div class="clearfix"></div>
			<strong class="red_bold">Most complained about</strong>
			<div class="sorting">
				<div class="col-sm-3 col-md-2"><a href="<?php echo site_url('companies?orderBy=alpha') ?>"><span>A-Z</span></a></div>
				<div class="col-sm-3 col-md-2"><a data-toggle="modal" data-target="#choose-location"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">Location</a></div>
				<div class="col-sm-3 col-md-2"><a data-toggle="modal" data-target="#choose-category"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/categories.png"> Category</a></div>
				<div class="clearfix"></div>
			</div>
		</div>
	</div>

	<div id="primary" class="content-area">		
		<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : ?>
				<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post();
					get_template_part( 'template-parts/post/content', 'company' );
				endwhile;
			else :
			get_template_part( 'template-parts/post/content', 'none' );
			endif; ?>
				<?php
				if ( function_exists('wp_bootstrap_pagination') )
					wp_bootstrap_pagination();
				?>
		</main><!-- #main -->
	</div><!-- #primary -->


<div class="modal fade ihpc-modal" id="choose-a-plan" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        	<form method="post" action="<?php echo admin_url('admin-post.php') ?>" >
	            <!-- Modal Header -->
	            <div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title" id="myModalLabel">Do not know what plan to choose?</h4>
	              <span class="modal-small-title">Fill out the form and we will contact you.</span>
	            </div>            
	            <!-- Modal Body -->
	            <div class="modal-body">                
	                  <div class="form-group col-sm-6">
	                    <label for="input1">Email <span class="required">*</span></label>
	                      <input class="form-control" name="reg_company_email" id="input1" placeholder="" type="email">
	                  </div>
	                  <div class="form-group col-sm-6">
	                    <label for="input2">Phone</label>
	                      <input class="form-control" name="reg_company_phone" id="input2" placeholder="" type="text">
	                  </div>
	                  <div class="form-group col-sm-6">
	                    <label for="input3">Your Full Name <span class="required">*</span></label>
	                      <input class="form-control" name="reg_company_fullname" id="input3" placeholder="" type="text">
	                  </div>
	                  <div class="form-group col-sm-6">
	                    <label for="input4">Corporate Title</label>
	                      <input class="form-control" name="reg_company_title" id="input4" placeholder="" type="text">
	                  </div>
	                  <div class="form-group col-sm-6">
	                    <label for="input5">Company Name <span class="required">*</span></label>
	                      <input class="form-control" name="reg_company_name" id="input5" placeholder="" type="text">
	                  </div>
	                  <div class="clearfix"></div> 
	            </div>            
	            <!-- Modal Footer -->
	            <div class="modal-footer">
	            	<?php wp_nonce_field('register_company','security-code'); ?>
	            	<input type="hidden" name="action" value="register_company" />
	                <button type="button" class="btn" data-dismiss="modal">CANCEL</button>
	                <input type="submit" class="btn modal-footer-btn" value="SUBMIT">
	            </div>
            </form>
        </div>
    </div>
</div>

<?php
//Including the category modal
include_once "inc/modals/company_categories.php";
//Including the location modal
include_once "inc/modals/location.php";

get_footer(); 
?>
