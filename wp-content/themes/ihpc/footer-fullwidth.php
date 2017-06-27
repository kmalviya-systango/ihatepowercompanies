<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

		<div class="clearfix"></div>
	<footer id="colophon" class="site-footer" role="contentinfo">		
		<div class="ipccf_footer">
			<div class="container">
				<h1 class="text-center">I Hate Power Companies Consumer Facts</h1>
				<div class="col-lg-4 text-center">				
					<h2><?php echo count(get_reviews(-1)); ?></h2>
					<span>Reviews</span> 
				</div>
				<div class="col-lg-4 text-center">
					<h2><?php echo count(get_companies(-1)); ?></h2>
					<span>Companies </span> 
				</div>
				<div class="col-lg-4 text-center">
					<?php
						//Sum of rattings of all companies
						$companies = get_companies_by_ratings(-1,'ASC');
						$hates_count = array(0);
						foreach ($companies as $key => $company) {						
							if( $company['ihpc_ratings'] < 4){
								$hates_count[] = $company['ihpc_ratings'];
							}
						}
						$total_hates = array_sum($hates_count);					
					?>
					<h2><?php echo $total_hates; ?></h2>
					<span>Hates</span> 
				</div>
			</div>
		</div>
	  
	  
<div class="footer-sitemap" id="footer-sitemap">
    <div class="container">
	<?php if ( is_active_sidebar( 'sidebar-2' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-2' ); ?>
	<?php endif; ?>
	<?php if ( is_active_sidebar( 'sidebar-3' ) ) : ?>
		<?php dynamic_sidebar( 'sidebar-3' ); ?>
	<?php endif; ?>
      
    </div>
  </div>
  
  	<?php if ( is_active_sidebar( 'footer-policy' ) ) : ?>
		<?php dynamic_sidebar( 'footer-policy' ); ?>
	<?php endif; ?>  
  	<!-- .wrap -->
		</footer><!-- #colophon -->
		<div style="display:none" id="ajax_loader">
			<img src="<?php echo get_stylesheet_directory_uri() ?>/assets/images/loader.gif">
		</div>
<?php wp_footer(); ?>

<?php if(is_home()): ?>
<script type="text/javascript">
jQuery(window).scroll(function(){
  if (jQuery(window).scrollTop() >= 50) {
    jQuery('.sticky-header').addClass('fixed');
   }
   else {
    jQuery('.sticky-header').removeClass('fixed');
   }
});
</script>
<?php endif; ?>

</body>
</html>
