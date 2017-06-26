<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
global $redux_ihpc;
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js no-svg">
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link href="http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
<?php wp_head(); ?>
  <script type="text/javascript">
    <?php if(isset($redux_ihpc['google-analytics-script'])){
        echo $redux_ihpc['google-analytics-script'];
    }
    ?>
  </script>
</head>
<body <?php body_class( is_front_page() ? "home" : "inner-page ihpc" ); ?>>
<?php
if(isset($redux_ihpc['intro_h1_text'])){
  $introh1text = $redux_ihpc['intro_h1_text'];
}
else{
  $introh1text = "Consumer Complaints and Reviews <br> of Power Companies";
}
if(isset($redux_ihpc['intro_h3_text'])){
  $introh3text = $redux_ihpc['intro_h3_text'];
}
else{
  $introh3text = "Find your power company and share your story of why you hate them. Simple. <br> Together, we can change the way these companies do business.";
}
?>
<?php 
/*if(is_front_page()){
	$navclass= "";
} else{
	$navclass ="fixed";
} */
?>
<div class="top_header navbar-fixed-top sticky-header <?php //echo $navclass; ?> fixed">
  <nav class="navbar">
    <div class="container-fluid">
      <div class="col-lg-3">
        <div class="navbar-header"> <a class="navbar-brand" href="<?php echo site_url(); ?>"><img src="<?php bloginfo('template_url'); ?>/assets/images/logo.png"></a> </div>
      </div>
      <div class="col-lg-9">
		<?php if ( has_nav_menu( 'top' ) ) : ?>
			<?php get_template_part( 'template-parts/navigation/navigation', 'top' ); ?>
		<?php endif; ?>
      </div>
    </div>
  </nav>
</div>
<?php if (is_front_page()) : ?>
<!-- Banner -->
<div class="banner">
  <div class="container">
    <h1 class="text-center"><?php echo $introh1text; ?></h1>
    <div class="search-box row">

    <form action="<?php echo site_url('companies') ?>" method="post" class="clearfix">
      <div class="search-for-car clearfix">
        <div class="inner-search">
          <div class="col-lg-4 col-md-4 separator col-sm-4 col-xs-12">
            <input name="company_name" id="company_name" class="form-control search-input width-100" placeholder="Company Name" value="" type="text">
          </div>
          <div class="col-lg-4 col-md-4 separator model-select col-sm-4 col-xs-12">
            <input name="location" id="location" class="form-control search-input width-100" placeholder="Location" value="" type="text">
          </div>
          <div class="col-lg-4 col-md-4  col-sm-4 col-xs-12">
            <select name="model" id="model" class="form-control">
              <?php
              $args   = array('hide_empty' => FALSE,'taxonomy' => 'companiestax');
              $terms  = get_terms($args);
              foreach($terms as $termsval){
                echo '<option value="'. $termsval->term_id .'">'.$termsval->name .'</option>';
              }
              ?>
            </select>
          </div>
        </div>
        <input value="" class="btn-style inner-search-button " type="submit">
      </div>
    </form>

    </div>
    <h3 class="text-center"><?php echo $introh3text; ?></h3>
    <div class="home_button_sectation">
      <div class="col-lg-4"> <a href="#" class="btn theme_btn"><img src="<?php bloginfo('template_url'); ?>/assets/images/icon_submit_review.png"> submit review</a> </div>
      <div class="col-lg-4"> <a href="<?php echo site_url('review') ?>" class="btn theme_btn"><img src="<?php bloginfo('template_url'); ?>/assets/images/icon_explore_l_reviews.png"> Explore latest reviews</a> </div>
      <div class="col-lg-4"> <a href="<?php echo site_url('for-business') ?>" class="btn theme_btn"><img src="<?php bloginfo('template_url'); ?>/assets/images/icon_f_business.png"> For Business</a> </div>
    </div>
  </div>
</div>
<!-- Banner -->
<?php endif; ?>