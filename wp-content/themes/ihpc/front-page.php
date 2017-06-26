<?php
/**
 * The front page template file
 *
 * If the user has selected a static page for their homepage, this is what will
 * appear.
 * Learn more: https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

get_header(); ?>

<div id="top-section">
	<div id="primary" class="col-lg-9">
		<?php // Show the selected frontpage content.
		if ( have_posts() ) :
			while ( have_posts() ) : the_post();
				get_template_part( 'template-parts/page/content', 'front-page' );
			endwhile;
		else : // I'm not sure it's possible to have no posts when this page is shown, but WTH.
			get_template_part( 'template-parts/post/content', 'none' );
		endif; 
		?>
		<div class="more_post_link text-right"><a href="<?php echo site_url('review') ?>" class="more-link">More featured reviews <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/aero.png"> </a></div>
		<?php
		// Get each of our panels and show the post data.
		if ( 0 !== ihpc_panel_count() || is_customize_preview() ) : // If we have pages to show.
			/**
			 * Filter number of front page sections in Twenty Seventeen.
			 *
			 * @since Twenty Seventeen 1.0
			 *
			 * @param $num_sections integer
			 */
			$num_sections = apply_filters( 'ihpc_front_page_sections', 4 );
			global $ihpccounter;
			// Create a setting and control for each of the sections available in the theme.
			for ( $i = 1; $i < ( 1 + $num_sections ); $i++ ) {
				$ihpccounter = $i;
				ihpc_front_page_section( null, $i );
			}
		endif; // The if ( 0 !== ihpc_panel_count() ) ends here.
		?>

		<!-- Most recent review section: Start -->
		<div class="row">
			<div class="col-md-12 text-center">
			<div class="testimonials clearfix">
				<p><?php
					$review1 = get_reviews(1);
					echo $review1[0]['excerpt'];
					echo "<a href='".$review1[0]['permalink']."' class='read-full-review'>Read full review</a>";
					?></p>
				</div>	
			</div>
		</div>		
		<!-- End -->

		<!-- Most hated power companies section: start -->
		<!-- Company will not be displayed if there is no rattings -->
		<div class="row">
			<div class="col-md-12">
				<div class="mhpc-home">
					<h1>Most hated power companies</h1>
				</div>			
				<div class="row">
					<?php
					//Getting posts of this week: Start
					$currentWeek = get_companies_by_date(3,1);					
					if( !empty($currentWeek) ): ?>
						<div class='col-md-4 user-list'>
							<h4>Now</h4>
							<ul>
								<?php 
								foreach ($currentWeek as $key => $value) {
									echo '<li>
											<a href="'.$value['url'].'">'.$value['title'].'</a> 
											<span class="user-number">'.$value['nu_user_ratted'].'</span>
										</li>';
								} 
								?>
							</ul>
						</div>
					<?php endif; ?>

					<?php
					//Getting posts of last week: Start
					$lastWeek = get_companies_by_date(3,2);					
					if( !empty($lastWeek) ): ?>
						<div class='col-md-4 user-list'>
							<h4>LAST WEEK</h4>
							<ul>
								<?php 
								foreach ($lastWeek as $key => $value) {
									echo '<li>
											<a href="'.$value['url'].'">'.$value['title'].'</a> 
											<span class="user-number">'.$value['nu_user_ratted'].'</span>
										</li>';
								} 
								?>
							</ul>
						</div>
					<?php endif; ?>

					<?php
					//Getting posts of last month: Start
					$lastmonth = get_companies_by_date(3,3);					
					if( !empty($lastmonth) ): ?>
						<div class='col-md-4 user-list'>
							<h4>LAST MONTH</h4>
							<ul>
								<?php 
								foreach ($lastmonth as $key => $value) {
									echo '<li>
											<a href="'.$value['url'].'">'.$value['title'].'</a> 
											<span class="user-number">'.$value['nu_user_ratted'].'</span>
										</li>';
								} 
								?>
							</ul>
						</div>
					<?php endif; ?>

				</div>
				<div class="col-sm-12 clearfix text-right"><a href="<?php echo site_url('companies') ?>" class="more-link">More Trends <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/aero.png"> </a></div>
			</div>
		</div>		
		<!-- End -->

		<!-- <div class="most_hated_power_companies">
			<h1>Top locations</h1>
			<?php //echo top_locations(); ?>
			<div class="more_post_link text-right"><a href="#">Show more locations</a></div>
		</div> -->

		<!-- Top rated power companies section: Start -->
		<div class="row">
			<div class="col-md-12">
			<div class="trpc-home user-list">
				<h1>Top Rated Power Companies</h1>
				<ul>
				<?php 
					$companies = get_companies_by_ratings(-1,'DESC');
					foreach ($companies as $key => $company) {						
						if( $company['ihpc_ratings'] > 4){
							echo '<li>
								<a href="'.$company['url'].'">'.$company['title'].'</a> 
								<span class="user-number">'.$company['ihpc_ratings'].' stars</span>
								</li>';
						}
					}
				?>
				</ul>
				<div class="clearfix text-right"><a href="<?php echo site_url('companies') ?>" class="more-link">Show More Companies <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/aero.png"> </a></div>
			</div>
			</div>
		</div>		
		<!-- End -->
<div class="clearfix"></div>
		<!-- Latest review, recently discussed and top rated section: Start -->
		<div class="row">
		<div class="mhpc-home user-list">
			<div class="col-md-4">
				<h4>Latest Reviews</h4>
				<?php 
				$reviews = get_reviews(3);
				foreach ($reviews as $key => $review) {
					echo '<div class="panel">
								<a href="'.$review['permalink'].'">'.$review['title'].'</a>
								<br/>
								<span>'.$review['date'].'</span>
							</div>';
				}				
				?>
			</div>
			<div class="col-md-4">
				<h4>Recently Discussed</h4>
				<?php
				//Getting reviews order by comment count
				$comments = get_reviews(3,'comment_count');
				//Getting the latest comments
				//$comments = get_ihpc_comments(3,'review');
				foreach ($comments as $key => $comment) {
					echo '<div class="panel">
							<a href="'.$comment['permalink'].'">'.$comment['title'].'</a>
							<br/>
							<span>'.$review['date'].'</span>							
						</div>';
				}
				?>			
			</div>
			<div class="col-md-4">
				<h4>Most Hated</h4>
				<?php 
					$companies = get_companies_by_ratings(3,'ASC');
					foreach ($companies as $key => $company) {						
						echo '<div class="panel">
								<a href="'.$company['url'].'">'.$company['title'].'</a>
								<br/>
								<span>'.$company['date'].'</span>
							</div>';
					}
				?>
			</div>			
		</div>
		</div>
		<!-- End -->
	</div><!-- #primary -->
	<aside class="col-lg-3 right-sidebar" role="complementary">
		<?php
		if (function_exists ('adinserter')){
			echo adinserter (1);
		}
		if ( is_active_sidebar( 'frontpage-sidebar-1' ) ) { 
			dynamic_sidebar( 'frontpage-sidebar-1' );
		}
		if (function_exists ('adinserter')){
			echo adinserter (2);
		}
		?>	
	</aside><!-- .widget-area -->
</div>

<div id="slider-section" class="text-center">
	<!-- Add section for block 3 : Start -->
	<?php
	if (function_exists ('adinserter')){
		echo adinserter (3);
	}
	?>
	<!-- Add section for block 3 : End -->
</div>
</div>
</div>
</div>

<div class="clearfix"></div>
<div class="slider-home">	
	<div class="container">
		<div class="col-sm-12">
			<h1>Power Companies in the News</h1>
			
			<div id="myCarousel" class="carousel slide ">
			  <div class="carousel-inner">
			    <?php
			    	$sliderRows = array(0,4,8);
			    	$countItems = 0;
			    	foreach ($sliderRows as $key => $sliderRowOffset) {
			    		if($sliderRowOffset == 0)
			    			$activeClass = 'active';
			    		else
			    			$activeClass = '';
			    		$sliderRow = get_post_by_category('post',$sliderRowOffset,4,'power-companies-in-the-news');
						if( !empty($sliderRow) ){
							//Generating slider row					
							echo '<div class="item '.$activeClass.'">
					      		<div class="row">';
							foreach ($sliderRow as $key => $post) {
								$countItems++;
								//Generating 4 items for slider
								echo '<div class="col-sm-3">
										<div class="card hover15">
											<a href="'.$post['permalink'].'"><figure><img src="'.$post['img'].'" alt="Image" class="img-responsive card-img-top"></figure></a>
											<div class="card-block">						  
												<p class="card-text">'.$post['excerpt'].'</p>
											</div>
										</div>
									</div>';
							}
							echo '</div></div>';
						}
			    	}					
				?>			    
			  </div>
				<?php if($countItems > 4): ?>
				<a class="left carousel-control" href="#myCarousel" data-slide="prev"><i class="fa fa-chevron-left" aria-hidden="true"></i></a>
				<a class="right carousel-control" href="#myCarousel" data-slide="next"><i class="fa fa-chevron-right" aria-hidden="true"></i></a> 
				<?php endif; ?>
			</div>
			<!--/myCarousel-->
		</div>		
	</div>
</div>

<div class="site-content-contain">
<div class="site-content">
<div id="bottom-section">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 hc-home">
				<h1>Hate Categories</h1>
				<div class="row">
				<?php 
				$categories = get_ihpc_categories('companiestax');
				foreach ($categories as $key => $category) {
					if( $category['slug'] != 'all_categories' && $category['slug'] != 'all_users' ){
						echo "<div class='col-sm-2 text-center cat-icons'>
								<a href='".$category['permalink']."'>
									<img class='img-responsive' src='".$category['img_url']."' />
									<span>".$category['name']."</span>
								</a>
							</div>";
					}					
				}
				?>
				<div class="clearfix"></div>
				<div class="col-sm-12 text-right"><a href="<?php echo site_url('/companiestax/all_categories') ?>" class="more-link">Browse all reviews <img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/aero.png"> </a></div>
				</div>
			</div>
			<div class="col-lg-3">
				<?php
				if ( is_active_sidebar( 'frontpage-sidebar-2' ) ) { 
					dynamic_sidebar( 'frontpage-sidebar-2' );
				}
				?>
			</div>
		</div>
	</div>
</div>
<?php get_footer(); 
