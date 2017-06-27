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

/*
* Start: Creating a query argument based on request parameters
*/
$search_args = array('post_type' => 'companies');
if( !empty($_REQUEST['model']) ){
	$search_args['tax_query'] = array(array('taxonomy'=>'companiestax','field'=>'id','terms'=> $_REQUEST['model'],'operator'=>'IN'));
}
if( !empty($_REQUEST['location']) ){
	$search_args['meta_key'] 	= 'company_location';
	$search_args['meta_value'] = $_REQUEST['location'];	
}
if( !empty($_REQUEST['company_name']) ){
	global $wpdb;
	$mypostids = $wpdb->get_col("select ID from $wpdb->posts where post_title LIKE '%".$_REQUEST['company_name']."%' ");
	//$search_args['title'] = $_REQUEST['company_name'];
	$search_args['post__in'] = $mypostids;
}
if( !empty($_REQUEST['model']) || !empty($_REQUEST['location']) || !empty($_REQUEST['company_name']) ){
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
				<div class="col-sm-3 col-md-2"><span>A-Z</span></div>
				<div class="col-sm-3 col-md-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/locate_point.png">Location</div>
				<div class="col-sm-3 col-md-2"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/categories.png"> Category</div>
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
				while ( have_posts() ) : the_post(); ?>
					<div id="post-<?php the_ID(); ?>" class="company_list clearfix">
						<?php $company = get_company( get_the_ID() ); ?>
					    <div class="col-sm-2">
					        <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
					            <div class="company_logo">
					                <a href="<?php the_permalink(); ?>">
					                    <?php the_post_thumbnail( 'ihpc-featured-image' ); ?>
					                </a>
					            </div><!-- .post-thumbnail -->
					        <?php endif; ?>
					    </div>
					    <div class="col-sm-5">
					       <a href="<?php echo esc_url(get_permalink()); ?>"><h3 class="company_list_title"><?php echo get_the_title(); ?> </h3></a>
					        <?php $company_website = get_field( "company_website" );  ?>
					        <a href="<?php echo esc_url($company_website); ?>"><p class="company_url"><?php echo $company_website; ?></p></a>
					        <p><?php echo wp_trim_words( get_the_content(), 95, '...'); ?>
					        </p>
					    </div>
					    <div class="col-sm-3 customer_feedback">
					    	<?php if( !empty($company['i_like']) ): ?>
					        <h3 class="customer_list_title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/like.png"> Customers like </h3>
					        <p class="pl-30">
					        	<?php
					        	$count = 0; 
					        	foreach ($company['i_like'] as $key => $like) {
					        		if($count<3)
					        			echo "<div>".$key."<span> $like</span></div>";
					        		$count++;
					        	} 
					        	?>				        	
					        </p>
					    <?php endif; ?>
					        <div class="separatore clearfix"></div>
					        <?php if( !empty($company['i_didnot_like']) ): ?>
					        <h3 class="customer_list_title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/unlike.png"> Customers like </h3>
					        <p class="pl-30">
					        	<?php
					        	$count = 0; 
					        	foreach ($company['i_didnot_like'] as $key => $notlike) {
					        		if($count<3)
					        			echo "<div>".$key."<span> $notlike</span></div>";
					        		$count++;
					        	} 
					        	?>
					        </p>
					        <?php endif; ?>
					    </div>
					    <div class="col-sm-2">
					        <?php
					        if( !empty($company['calculations']['star_ratting']) ): ?>
					            <h3 class="text-center rating_title "><?php echo round($company['calculations']['star_ratting'],2) ?></h3>
					            <div class="rating_bulb"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/rating_bulb.png"></div>
					        <?php
					        endif;
					        ?>        
					        <?php 
					            if( !is_user_logged_in() ){
					                echo '<a data-toggle="modal" data-target="#choose-a-plan" class="respond_customer_btn">Respond to your customers</a>';
					            }
					            else{
					                echo '<a href="'.get_permalink().'" class="respond_customer_btn">Respond to your customers</a>';   
					            }
					        ?>        
					    </div>
					    <div class="clearfix"></div>
					    <div class="col-md-10 col-md-offset-2 customer_list_footer">
					        <div class="col-sm-1 text-center c_l_f_resolved"> <strong>23</strong> Issues<br>
					            Resolved </div>
					        <div class="col-sm-1 text-center c_l_f_reviews"> <?php echo get_company_reviews( get_the_ID() ) ?>
					            Reviews </div>
					        <div class="col-sm-1 text-center c_l_f_losses"> $
					        	<?php 
					        		if( !empty($company['calculations']['total_loss_metric']) )
					        			echo $company['calculations']['total_loss_metric'];
					        		else
					        			echo 0;
					        	?>
					            claimed<br>
					            losses </div>
					        <div class="col-sm-1 text-center c_l_f_average"> $
					        	<?php 
					        		if( !empty($company['calculations']['average_loss_metric']) )
					        			echo $company['calculations']['average_loss_metric'];
					        		else
					        			echo 0;
					        	?><br>
					            average </div>
					        <div class="col-sm-1 text-center c_l_f_view "> 0<br>
					            views </div>        
					    </div>
					</div><!-- #post-## -->
				<?php 
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
$args = array('hide_empty' => FALSE,'taxonomy' => 'companiestax');

$terms = get_terms($args);
//echo '<pre>';
//print_r($terms);

?>

<?php get_footer(); 
