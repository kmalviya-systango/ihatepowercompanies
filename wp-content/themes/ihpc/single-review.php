<?php
/**
 * The template for displaying all Single Review posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage IHPC
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div class="wrap">
	<div id="primary" class="content-area">
		<main id="main" class="site-main" role="main">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<ul class="review-fields">
							<?php 
							$company_id = get_post_meta( get_the_ID(), 'REVIEW_COMPANYID', true );
							if( !empty($company_id) ){
							    $company_name   = get_the_title( $company_id );
							    $company_url    = get_the_permalink( $company_id );
							    echo '<li class="normal-size">
							            <i class="fa fa-building-o" aria-hidden="true"></i>
							            <a href="'.$company_url.'"><span itemprop="name">'.$company_name.'</span></a>
							        </li>';
							}
							?>
							<li><i class="fa fa-user" aria-hidden="true"></i><span class="fs12">by </span><span class="fs12"><?php echo get_the_author() ?></span></li>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php echo get_the_date() ?></span></li>
							<li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php comments_number( '0 Comment', '1 Comment', '% Comments' ); ?></span></li>							
						</ul>
						<header class="entry-header">
							<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
						</header>
						<?php if ( '' !== get_the_post_thumbnail() ) : ?>
							<div class="post-thumbnail">
								<a href="<?php the_permalink(); ?>">
									<?php the_post_thumbnail( 'ihpc-featured-image' ); ?>
								</a>
							</div><!-- .post-thumbnail -->
						<?php endif; ?>
						<div class="entry-content">
							<div class="clearfix">
								<div style="width:60%;float:left" class="content">
									<?php
										/* translators: %s: Name of current post */
										the_content( sprintf(
											__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', 'ihpc' ),
											get_the_title()
										) );			
									?>
								</div>
								<div style="width:40%;float:right" class="rattings">
									<?php 
									$rattings = get_review_meta( get_the_ID() );
									if( !empty($rattings['rattings']) ){
										$rates = $rattings['rattings'];
										foreach ($rates as $meta_key => $meta_value) {
											echo "<div><span>$meta_key </span>$meta_value stars</div>";
										}
									}
									if( !empty($rattings['losses']) ){
										$losses = $rattings['losses'];
										foreach ($losses as $meta_key => $meta_value) {
											echo "<div><i>$meta_key </i><br/>$meta_value</div>";
										}
									}									
									?>
								</div>
							</div>
						</div><!-- .entry-content -->
						<div>
							<a href="<?php echo site_url('for-business') ?>">Contact author</a>
						</div>
					</article><!-- #post-## -->
					<?php
					if (function_exists ('adinserter')){
						echo adinserter (3);
					}
					?>
					<h2>
						Had an Experience with <?php echo get_the_title() ?>? <a href="<?php echo site_url('submit-review') ?>">Write a review</a>
					</h2>
					<?php
					// If comments are open or we have at least one comment, load up the comment template.
					if ( comments_open() || get_comments_number() ) :
						comments_template();
					endif;					
				endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->	
</div><!-- .wrap -->

<?php get_footer();
