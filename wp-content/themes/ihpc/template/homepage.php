<?php
/*
Template Name: Home Page
*/
?>
<?php 
get_header();

?>

<div id="primary" class="content-area">
<div class="ipccf_footer">
    <div class="container">
      <h1 class="text-center">I Hate Power Companies Consumer Facts</h1>
      <div class="col-lg-4 text-center">
        <h2>500K</h2>
        <span>Reviews </span> </div>
      <div class="col-lg-4 text-center">
        <h2>53K</h2>
        <span>Companies </span> </div>
      <div class="col-lg-4 text-center">
        <h2> 127 </h2>
        <span>Industries </span> </div>
    </div>
  </div>

	<main id="main" class="site-main " role="main">
		<?php
		// Start the loop.
		while ( have_posts() ) : the_post();
			// Include the page content template.
			//get_template_part( 'template-parts/content', 'page' );
			// If comments are open or we have at least one comment, load up the comment template.
			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
			// End of the loop.
		endwhile;
		?>
	</main><!-- .site-main -->

	<?php get_sidebar(); ?>

</div><!-- .content-area -->


<?php get_footer(); ?>