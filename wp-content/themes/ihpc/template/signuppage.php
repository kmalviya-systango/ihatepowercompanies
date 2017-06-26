<?php
ob_start();
/**
 * Template Name: User: Sign Up Page
 */
get_header('fullwidth');

/*
* If user is logged in then redirect it to home page.
*/
if ( is_user_logged_in() ) {
    wp_redirect( home_url() );
}

//Generating an image for captcha
if (class_exists('ReallySimpleCaptcha')) { 
	$captcha 		= new ReallySimpleCaptcha();
	$captcha_word 	= $captcha -> generate_random_word();
	$captcha_prefix = mt_rand();
	$captcha_image 	= $captcha -> generate_image($captcha_prefix, $captcha_word);
	$captcha_file 	= rtrim(get_bloginfo('wpurl'), '/').'/wp-content/plugins/really-simple-captcha/tmp/'.$captcha_image;
	//Checking if captcha is valid or not.
	if (!empty($_POST)) {
		$err_msg = $succ_msg = '';
		if ($captcha -> check($_POST['captcha_prefix'], $_POST['captcha_code'])) {			
			//If password and confirm password are same.
			if( $_POST['user_password'] != $_POST['user_cpassword'] ){
				$err_msg = "Password and confirm password are not same";
				header("Location:$_SERVER[HTTP_REFERER]?err_msg=$err_msg");
			}
			else{
				$userdata = array();
				$userdata['user_login'] = $_POST['user_name'];
				$userdata['user_email'] = $_POST['user_email'];
				$userdata['user_pass'] 	= $_POST['user_password'];
				$userdata['role'] 		= 'subscriber';
				//Creating a new user
				$user_id = wp_insert_user( $userdata );
				if ( !is_wp_error( $user_id ) ) {
					$succ_msg = "You have successfully registered now you can login";
					header("Location:$_SERVER[HTTP_REFERER]?success_msg=$succ_msg");
				}
				else{
					$err_msg = "Either your username or email is already present";
					header("Location:$_SERVER[HTTP_REFERER]?err_msg=$err_msg");
				}
				$userdata['user_login'] = $_POST['user_cpassword'];
				$userdata['user_login'] = $_POST['user_phonenumber'];
				$userdata['user_login'] = $_POST['user_readed_tc'];
				$userdata['user_login'] = $_POST['captcha_code'];
				$userdata['user_login'] = $_POST['captcha_prefix'];
			}
		}
		else{
			$err_msg = "Invalid Captcha";
			header("Location:$_SERVER[HTTP_REFERER]?err_msg=$err_msg");
		}
	}    
}

if( !empty($_GET['err_msg']) ){
	echo "<div style='margin-bottom:0' class='alert alert-danger text-center'>$_GET[err_msg]</div>";
}
if( !empty($_GET['success_msg']) ){
	echo "<div style='margin-bottom:0' class='alert alert-info text-center'>$_GET[success_msg]</div>";
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
	<div class="col-md-offset-3 col-md-6">
		<div class="connect_with_social text-uppercase text-center">
			<span>Connect with</span>
		</div>
		 <?php //do_action( 'wordpress_social_login' ); ?> 
		<ul class="social_button">
			<li class="facebook"><a href="#x"><i class="fa fa-facebook" aria-hidden="true"></i>Facebook</a></li>
			<li class="twitter"><a href="#x"><i class="fa fa-twitter" aria-hidden="true"></i>Twitter</a></li>
			<li class="google_plus"><a href="#x"><i class="fa fa-google-plus" aria-hidden="true"></i>Google</a></li>
		</ul>
		<div class="connect_with_social text-uppercase text-center">
			<span>OR</span>
		</div>
		
		<form action="" method="post">
			<div class="register_in">
				<div class="form-group">
					<label>Username<span class="mandatory">*</span></label>
					<input required="required" type="text" name="user_name" class="form-control">
				</div>
				
				<div class="form-group mt-20">
					<label>Email<span class="mandatory">*</span></label>
					<input required="required" type="email" name="user_email" class="form-control">
				</div>
				
				<div class="form-group mt-20">
					<label>Password<span class="mandatory">*</span></label>
					<input required="required" type="password" name="user_password" class="form-control">
				</div>
				
				<div class="form-group mt-20">
					<label>Re-enter password<span class="mandatory">*</span></label>
					<input required="required" type="password" name="user_cpassword" class="form-control">
				</div>
				
				<div class="form-group mt-20">
					<label class="mb-0">Phone</label>
					<small class="grey mb-10">Please use international format for Phone entry.</small>
					<div class="input-group">
					  <div class="input-group-btn">
						<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">+1<span class="caret"></span></button>
						<ul class="dropdown-menu">
						  <li><a href="#">Action</a></li>
						  <li><a href="#">Another action</a></li>
						  <li><a href="#">Something else here</a></li>
						  <li role="separator" class="divider"></li>
						  <li><a href="#">Separated link</a></li>
						</ul>
					  </div><!-- /btn-group -->
					  <input type="text" class="form-control" name="user_phonenumber" aria-label="...">
					</div><!-- /input-group -->
				</div>
				
				<div class="check_mark mt-30">
					<input type="checkbox" required="required" name="user_readed_tc" id="option1" value="1">
					<label for="option1"><small>I have read and agree to the I Hate Power Companies <a href="#x" class="red_link font-14">Terms of Service</a></small></label>				
				</div>
				
				<div class="form-group clearfix mt-15 captcha">
					<label>
						Code<span class="mandatory">*</span>					
					</label>
					<div class="clearfix"></div>
					<input required="required" type="text" name="captcha_code" value="" class="form-control">
					<input type="hidden" name="captcha_prefix" value="<?php echo $captcha_prefix; ?>" />
					<img src="<?php echo $captcha_file ?>">
					<a href="<?php echo site_url('sign-up') ?>"><img src="<?php echo site_url('/wp-content/themes/ihpc/assets/images/reload.png') ?>"></a>
				</div>
				
				<div class="form-group mt-70">
					<input type="submit" class="text-uppercase site_btn" value="Sign UP">
					<a href="#x" class="btn btn-link text-uppercase">Cancel</a>
				</div>
			</div>
		</form>

	</div>
</div>

<div class="signup_block text-right">
	<div class="container">
		<div class="col-md-offset-3 col-md-6">
			Already have an account? <a href="login.html" class="text-uppercase site_btn">Login</a>
		</div>
	</div>
</div>
<!-- main-content -->
<?php get_footer('fullwidth');?>