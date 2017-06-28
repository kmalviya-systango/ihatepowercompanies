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
	$sql 	 = "SELECT * FROM wpihpc_postmeta WHERE meta_value like '%$address%' AND meta_key = 'company_location' ";
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
	$mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '%".$_REQUEST['company_name']."%' ");
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
/****
* Getting all the categories of company
*****/
$categories = get_ihpc_categories('companiestax',0); ?>
<!-- Bootstrap modal to filter by category: Start -->
<div class="modal fade ihpc-modal in" id="choose-category" role="dialog">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title">Filter Companies by Category</h4>
	        </div>
	        <div class="modal-body row">
	        	<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#brief_categories">Brief</a></li>
						<li><a data-toggle="tab" href="#details_categories">Details</a></li>
					</ul>
					<div class="tab-content">
						<div id="brief_categories" class="tab-pane fade in active">
							<?php 
							foreach ($categories as $key => $category) :?>			
								<li class="list-group-item col-sm-4">
									<a class="discript-text" href="<?php echo site_url('companies?category_filter=').$category['term_id'] ?>"><?php echo $category['name'] ?></a>						
									<?php 
										$childCategories = get_ihpc_categories('companiestax',0,$category['term_id']); 
										if( !empty($childCategories) ): 
											echo '<a class="badge-list show-toggle pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
												<span class="badge badge-list">'.$category['count'].'</span>
												<ul class="list-group-horizontal chield row hidden">';
												foreach ($childCategories as $key => $childCategory) : ?>
													<li class="list-group-item ">
														<a href="<?php echo site_url('companies?category_filter=').$childCategory['term_id'] ?>"><?php echo $childCategory['name'] ?></a>
														<span class="badge badge-list"><?php echo $childCategory['count'] ?></span>
													</li>
											<?php endforeach; 
											echo '</ul>';
											?>
										<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</div>
						<div id="details_categories" class="tab-pane fade">
							<?php 
								foreach (range('A', 'Z') as $char) {
									echo '<div class="col-md-4" id="'.$char.'"><h3>'.$char.'</h3><ul class="list-group by_cat ">';
									foreach ($categories as $key => $category):
										$cat_name = ucfirst((trim($category['name'])) );
										$firstLetter = substr($cat_name, 0,1);
										if($char == $firstLetter){
											echo '<li class="list-group-item">
													<a href="'.site_url('companies?category_filter=').$category['term_id'].'">'.$category['name'].'</a>
													<span class="badge badge-list">'.$category['count'].'</span>
												</li>';
										}
									endforeach;
									echo '</ul></div>';
								}
							?>
						</div>					
					</div>
				</div>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer"></div> 
        </div>
    </div>
</div>
<!-- END -->

<!-- Bootstrap modal to filter by location: Start -->
<div class="modal fade ihpc-modal in" id="choose-location" role="dialog">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title">Filter Companies by Location</h4>
	        </div>
	        <div class="modal-body row">
	        	<div class="col-md-12">
	        		<!-- Google auto complete address: Start -->
		            <input onFocus="geolocate()" id="autocomplete" name="location[address]" class="form-control search-input width-100" placeholder="Location" value="" type="text">
		            <input type="hidden" id="glat" name="location[lat]" value="" />
		            <input type="hidden" id="glong" name="location[lng]" value="" />
		            <!-- Google auto complete address: End -->	
		            <?php 
		            $locations = get_locations('companies'); 
		            if( !empty($locations) ){
		            	foreach ($locations as $key => $location) {
		            		if( !empty($location['location']) ){
		            			$loc = $location['location'];
		            			$url = site_url('companies?location[address]=').$loc['address'].'&location[lat]='.$loc['lat'].'&location[lng]='.$loc['lng'];
		            			echo "<a href='".$url."'>$loc[address]</a>";
		            		}		            		
		            	}
		            }		            
		            ?>			
				</div>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer"></div> 
        </div>
    </div>
</div>
<!-- END -->

<?php get_footer(); ?>
