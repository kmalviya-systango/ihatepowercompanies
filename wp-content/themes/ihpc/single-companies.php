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
		<main id="main" class="site-main single-review-page comp_details" role="main">
			<?php
				/* Start the Loop */
				while ( have_posts() ) : the_post(); ?>
					<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
						<?php 
							$companyId = get_the_ID();
							$company = get_company_review( $companyId );
							/*echo "<pre>";
							print_r($company);
							echo "</pre>";*/
						?>
						<!-- Thumbnail and title section: start -->
						<div class="row com_heading">
							<div class="col-md-2">
								<?php if ( '' !== get_the_post_thumbnail() ) : ?>
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'post-thumbnail' ); ?>
										</a>
									</div><!-- .post-thumbnail -->
								<?php endif; ?>															
						    </div>
						    <div class="col-md-10">
								<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								<span class="company_rating"><?php echo show_stars($company['calculations']['star_ratting']) ?></span>
								<a href="#" class="link">Add to comparison</a>
							</div>
						</div>
						<!-- End; -->
						
						<div class="row com_info">
							<div class="row com_list">
									<?php							
									if( !empty($company['calculations']) ){
										echo "<div class='col-md-2'><span>9</span> ISSUES<br/> RESOLVED</div>
											<div class='col-md-2'><span>30</span> COMPANY<br/> RESPONSES</div>
											<div class='col-md-2'><span>".count($company['reviews'])."</span> TOTAL<br/> REVIEWS</div>
											<div class='col-md-2'><span>".$company['calculations']['total_loss_metric']."</span> CLAIMED<br/> LOSSES</div>
											<div class='col-md-2'><span>".$company['calculations']['average_loss_metric']."</span> AVG<br/> LOSS</div>
											<div class='col-md-2'><span>120K</span> PAGE<br/> VIEWS</div>";
									}
									?>
							</div>
														
							<div class="com_info_detail">
								<div class="col-md-8">
									<div class="row">
										<div class="col-md-7">
											<a href="<?php echo site_url('submit-review').'?firm_id='.$companyId ?>">
												<textarea rows="8" placeholder="What happened? what was your experience with <?php echo get_the_title() ?>?" disabled="disabled"></textarea>
												<input type="button" value="submit review">
											</a>
										</div>
										<div class="col-md-5 cust_like_unlike">
											<?php
												if( !empty($company['i_didnot_like']) ){
													echo "<div class=''>
														<h3 class='customer_list_title'><img src='".get_template_directory_uri()."/assets/images/unlike.png' > Customers don't like </h3>
														<ul>";
														$dislikes = $company['i_didnot_like'];
														foreach ($dislikes as $like => $like_count) {
															echo "<li>$like <span>$like_count</span></li>";
														}
													echo "</ul></div>";
												}
												
												if( !empty($company['i_like']) ){
													echo "<div class=''>
														<h3 class='customer_list_title'><img src='".get_template_directory_uri()."/assets/images/like.png' > Customers like </h3>
														<ul>";
														$likes = $company['i_like'];
														foreach ($likes as $like => $like_count) {
															echo "<li>$like <span>$like_count</span></li>";
														}
													echo "</ul></div>";
												}
											?>
										</div>
									</div>
								</div>
								<?php
								echo "<div class='col-md-4 all_rattings'>";
									echo "<ul>";
									echo "<li>Rating Details</li>";
									echo "<li><div>Location</div> <div>".show_stars($company['calculations']['average_location_ratting'])."</div></li>";
									echo "<li><div>Diversity of Products or Services</div> <div>".show_stars($company['calculations']['average_diversity_product_ratting'])."</div></li>";
									echo "<li><div>Product or Service Quality </div></li>";
									echo "<li><div>Advertised vs Delivered</div> <div>".show_stars($company['calculations']['average_advertised_ratting'])."</div></li>";
									echo "<li><div>Website</div> <div>".show_stars($company['calculations']['average_website_ratting'])."</div></li>";
									echo "<li><div>Staff</div> <div>".show_stars($company['calculations']['average_staff_ratting'])."</div></li>";
									echo "<li><div>Price Affordability</div> <div>".show_stars($company['calculations']['average_price_affordability_ratting'])."</div></li>";
									echo "<li><div>Value for money</div> <div>".show_stars($company['calculations']['average_value_for_money_ratting'])."</div></li>";
									echo "<li><div>Customer service</div> </li>";
									echo "<li><div>Exchange, Refund and Cancellation Policy</div> <div>".show_stars($company['calculations']['average_exchange_refund_ratting'])."</div></li>";
									echo "</ul>";
								echo "</div>";
														
								?>
							<!-- <div class="col-md-12">
								<?php 
								/*echo "<pre>";
								print_r($company);
								echo "</pre>";*/
								?>
							</div> -->
						</div>
					</article><!-- #post-## -->
					
					
					<div class="row">
					<!-- Tabs panel start -->
						<ul class="nav nav-tabs">
							<li class="active"><a data-toggle="tab" href="#reviews">Reviews</a></li>
							<li><a data-toggle="tab" href="#qa">Q&amp;A</a></li>
							<li><a data-toggle="tab" href="#contacts">Contacts</a></li>
							<li><a data-toggle="tab" href="#about">About</a></li>
							<li><a data-toggle="tab" href="#stats">Stats</a></li>
							<li><a data-toggle="tab" href="#competitors">Competitors</a></li>
							<li><a data-toggle="tab" href="#locations">Locations</a></li>
							<li><a data-toggle="tab" href="#products">Products</a></li>
						</ul>
						<div class="tab-content">
							<div id="reviews" class="tab-pane fade in active">
								<h3>Reviews for <?php echo get_the_title() ?></h3>
								<?php
								if( !empty($company['reviews']) ){
									$reviews = $company['reviews'];
									foreach ($reviews as $review_id => $review) : ?>
										<div id="review_<?php echo $review_id?>" class="our_reviews">
											<div class="brdr_bttm">
												<div class='col-md-8'>
													<h2>
														<a href='<?php echo $review['review_permalink'] ?>'><?php echo $review['review_title'] ?></a>
														<small><?php echo get_the_date('',$review_id) ?></small>
													</h2>
													<div class="min_hgt_168"><?php echo wp_trim_words( get_the_content($review_id), 90, '...') ?></div>
												</div>
												<div class='col-md-offset-1 col-md-3'>
													<div class="min_hgt_196">
													<?php
													if( !empty($review['i_liked']) ){
														$ilikes = $review['i_liked'];
														echo "<ul>";
														echo "<li><img src='".get_template_directory_uri()."/assets/images/like.png' >I LIKED</li>";
														foreach ($ilikes as $i => $like) {
																echo "<li>$like</li>";
														}
														echo "</ul>";
													}
													if( !empty($review['i_did_not_liked']) ){
														$inotlikes = $review['i_did_not_liked'];
														echo "<ul>";
														echo "<li><img src='".get_template_directory_uri()."/assets/images/unlike.png' >I DIDN'T LIKE</li>";
														foreach ($inotlikes as $j => $like) {
																echo "<li>$like</li>";
														}
														echo "</ul>";
													}											
													?>
													</div>
												</div>
											</div>
											
											<div class="col-md-8 pad-top-15">
												<a href='<?php echo $review['review_permalink'] ?>/#commentform'>Comment</a>
											</div>
												
											<div class="col-md-offset-1 col-md-3 pad-top-15">
												<span><?php echo '#'.$review_id; ?> </span>
											</div>
										</div>
									<?php 
									endforeach;
								}
								?>
							</div>
							<div id="qa" class="tab-pane fade">
								<h3>QA for <?php echo get_the_title() ?></h3>
								<p>No Content yet</p>
							</div>
							<div id="contacts" class="tab-pane fade">
								<h3>Contact <?php echo get_the_title() ?></h3>
								<?php 
									$website 			= get_post_meta($companyId,'company_website',true); 
									$company_location 	= get_post_meta($companyId,'company_location',true); 
									if( !empty($website) ){
										echo "<div>Website: <span>$website</span></div>";
									}
									if( !empty($company_location['address']) ){
										echo "<div>Headquarters Address: <span>$company_location[address]</span></div>";
									}								
								?>
							</div>
							<div id="about" class="tab-pane fade">
								<h3>About <?php echo get_the_title() ?></h3>
								<?php the_content(); ?>
							</div>
							<div id="stats" class="tab-pane fade">
								<h3><?php echo get_the_title() ?> Stats</h3>
								<p>No content yet</p>
							</div>
							<div id="competitors" class="tab-pane fade">
								<h3>Compare <?php echo get_the_title() ?> to</h3>
								<?php
									if( !empty($company['company_terms']) ){
										$terms 		= $company['company_terms'];
										$termsIds 	= array();									
										foreach ($terms as $i => $obj) {
											$termsIds 	= $obj->term_id;										
										}
										$competitors = get_post_by_taxonomy('companies','companiestax',$termsIds);
										if( !empty($competitors) ){
											foreach ($competitors as $i => $competitor) {
												echo "<div class='col-xs-12 col-sm-6 col-md-4'>													
														<a href='".$competitor['permalink']."'>
															<div class='thumbnail'>
																<div class='thumbnail-image'>
																	<img src='".$competitor['img']."' class='alignnone size-full wp-image-144' />
																</div>
																<div class='caption dis-cap'>
																	<div>".$competitor['title']."</div>
																</div>
																<div class='button-bottom'>
																	<a href='#' class='btn read_more' role='button'>Compare</a>
																</div>
															</div>
														</a>
													</div>";
											}
										}
										else{
											echo "<div class='col-md-3'>No competitor companies</div>";
										}									
									}
								?>
							</div>
							<div id="locations" class="tab-pane fade">
								<h3>Where reviews came from</h3>
								<div>
									<?php 
									$reviews = get_company_reviews($companyId);
									$com_locations = array();
									$j = 0;
									foreach ($reviews as $i => $review) {
										if( !empty($review['location']) ){
											if( is_array($review['location']) ){
												echo "<div><a href='#'>".$review['location']['address']."</a></div>";
												//Generating json for map: Start
												$com_locations[$j][] = $review['location']['address'];
												$com_locations[$j][] = (float)$review['location']['lat'];
												$com_locations[$j][] = (float)$review['location']['lng'];
												$com_locations[$j][] = $i;
												$j++;
											}										
											//END;			
										}
									}
									$map_locations = json_encode($com_locations);
									?>
								</div>							
								<div style="height:480px" id="map"></div>
							</div>
							<div id="products" class="tab-pane fade">
								<h3>Products</h3>
								<p>No content yet</p>
							</div>
						</div>
					<!-- Tabs panel end -->
					</div>

					<?php
				endwhile; // End of the loop.
			?>
		</main><!-- #main -->
	</div><!-- #primary -->	
</div><!-- .wrap -->

<script type="text/javascript">
jQuery(document).ready(function(){
	initMap( <?php echo $map_locations; ?> );
});

function initMap( locations ) {	
	var map = new google.maps.Map(document.getElementById('map'), {
		zoom: 8,
		center: new google.maps.LatLng(locations[0][1], locations[0][2]),
		mapTypeId: google.maps.MapTypeId.ROADMAP
	});
	var infowindow = new google.maps.InfoWindow({});
	var marker, i;
	for (i = 0; i < locations.length; i++) {
		marker = new google.maps.Marker({
			position: new google.maps.LatLng(locations[i][1], locations[i][2]),
			map: map
		});

		google.maps.event.addListener(marker, 'click', (function (marker, i) {
			return function () {
				infowindow.setContent(locations[i][0]);
				infowindow.open(map, marker);
			}
		})(marker, i));
	}
}
</script>
<?php get_footer(); ?>
