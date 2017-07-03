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

get_header(); ?>
<div class="col-lg-9">
	<div class="wrap" id="review_page">
		<?php if ( have_posts() ) : ?>
			<header class="page-header">
				<h1>Browse Complaints and Reviews</h1>
			</header><!-- .page-header -->
		<?php endif; ?>
		<div class="search-box ">
			<form action="" method="post" class="clearfix">
				<div class="search-for-car clearfix">
					<div class="inner-search">
						<div class="col-lg-12 col-md-12  col-sm-12 col-xs-12">
							<input required="required" name="company_name" id="company_name" class="form-control search-input width-100" placeholder="Company Name" type="text">
						</div>
					</div>
					<input value="" class="btn-style inner-search-button " type="submit">
				</div>
				<div class="parameters">
                    <ul class="list-inline" style="display: block;">
						<li><span class="icon icon-company">Company</span></li>
						<li><span class="icon icon-location">Location</span></li>
						<li><span class="icon icon-category">Category</span></li>
						<li><span class="icon icon-tag">Tag</span></li>
						<li><span class="icon icon-comments">Recently<br> discussed</li>
						<li><span class="icon icon-image">With media</span></li>
					</ul>
                </div>
			</form>
		</div>
		<?php //echo $count = $GLOBALS['wp_query']->post_count; ?>
		<div id="primary" class="content-area">
			<main id="main" class="site-main" role="main">
			<?php
			if ( have_posts() ) : ?>
				<?php
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

<?php get_footer(); ?>
