<?php
ob_start();
/**
 * Template Name: Company: Sign Up Page
 */
get_header('fullwidth');

/*
* If user is logged in then redirect it to home page.
*/
if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
}

$contract_type = 'free_plan';
if( !empty($_GET['contract_type']) ){
	$contract_type = $_GET['contract_type'];
}

?>

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

<!-- main-content -->
<div class="container pt-40">
	<div class="row">
		<div class="col-md-12"><h1>Free Plan Application</h1></div>
    	<form method="post" action="<?php echo admin_url('admin-post.php') ?>" >
    		<div class="form-group col-sm-6">
				<label for="input5">Company Name <span class="required">*</span></label>
				<input class="form-control" name="reg_company_name" id="input5" required="required" placeholder="" type="text">
			</div>			
			<div class="form-group col-sm-6">
				<label for="input3">Your Full Name <span class="required">*</span></label>
				<input class="form-control" name="reg_company_fullname" id="input3" required="required" placeholder="" type="text">
			</div>
			<div class="form-group col-sm-6">
				<label for="input1">Email <span class="required">*</span></label>
				<input class="form-control" name="reg_company_email" required="required" id="input1" placeholder="" type="email">
			</div>
			<div class="form-group col-sm-6">
				<label for="input4">Job Title</label>
				<input class="form-control" name="reg_company_title" id="input4" placeholder="" type="text">
			</div>
			<div class="form-group col-sm-6">
				<label for="input2">Phone</label>
				<input class="form-control" name="reg_company_phone" id="input2" placeholder="" type="text">
			</div>			
			<div class="clearfix"></div> 	            
			<div class="form-group col-md-12">
				<?php wp_nonce_field('register_company','security-code'); ?>				
				<input type="hidden" name="action" value="register_company" />
				<input type="hidden" name="contract_type" value="<?php echo $contract_type ?>" />
				<button type="button" class="btn" data-dismiss="modal">CANCEL</button>
				<input type="submit" class="btn modal-footer-btn" value="SUBMIT">
			</div>
        </form>
	</div>
</div>
<!-- main-content -->
<?php get_footer('fullwidth');?>