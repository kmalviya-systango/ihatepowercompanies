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
						<?php 
							$companyId = get_the_ID();
							$company = get_company_review( $companyId );
						?>
						<!-- Thumbnail and title section: start -->
						<div class="row">
							<div class="col-md-3">
					            <?php if ( '' !== get_the_post_thumbnail() ) : ?>
									<div class="post-thumbnail">
										<a href="<?php the_permalink(); ?>">
											<?php the_post_thumbnail( 'post-thumbnail' ); ?>
										</a>
									</div><!-- .post-thumbnail -->
								<?php endif; ?>							
						    </div>
						    <div class="col-md-9">
								<?php the_title( '<h2 class="entry-title">', '</h2>' ); ?>
								<span><?php echo $company['calculations']['star_ratting'] ?></span>
								<a href="#">Add to comparison</a>
							</div>
						</div>
						<!-- End; -->
						<div class="row">							
							<?php							
							if( !empty($company['calculations']) ){
								echo "<div class='col-md-2'>9 ISSUES RESOLVED</div>
									<div class='col-md-2'>30 COMPANY RESPONSES</div>
									<div class='col-md-2'>".count($company['reviews'])." TOTAL REVIEWS</div>
									<div class='col-md-2'>".$company['calculations']['total_loss_metric']." CLAIMED LOSSES</div>
									<div class='col-md-2'>".$company['calculations']['average_loss_metric']." AVG LOSS</div>
									<div class='col-md-2'>120K PAGE VIEWS</div>";
							}
							?>
						</div>
						<div class="row">
							<a href="<?php echo site_url('submit-review').'?firm_id='.$companyId ?>">
								<div class="col-md-3">
									<textarea rows="8" placeholder="What happened? what was your experience with <?php echo get_the_title() ?>?" disabled="disabled"></textarea>
									<input type="button" value="submit review">
								</div>
							</a>
							<?php							
							echo "<div class='col-md-3'>";
								echo "<ul>";
								echo "<li><b>Rating Details</b></li>";
								echo "<li>Location ".$company['calculations']['average_location_ratting']."</li>";
								echo "<li>Diversity of Products or Services ".$company['calculations']['average_diversity_product_ratting']."</li>";
								echo "<li>Product or Service Quality </li>";
								echo "<li>Advertised vs Delivered ".$company['calculations']['average_advertised_ratting']."</li>";
								echo "<li>Website ".$company['calculations']['average_website_ratting']."</li>";
								echo "<li>Staff ".$company['calculations']['average_staff_ratting']."</li>";
								echo "<li>Price Affordability ".$company['calculations']['average_price_affordability_ratting']."</li>";
								echo "<li>Value for money ".$company['calculations']['average_value_for_money_ratting']."</li>";
								echo "<li>Customer service </li>";
								echo "<li>Exchange, Refund and Cancellation Policy ".$company['calculations']['average_exchange_refund_ratting']."</li>";
								echo "</ul>";
							echo "</div>";
							if( !empty($company['i_didnot_like']) ){
								echo "<div class='col-md-3'><ul>
									<li><b>Customers don't like</b></li>";
									$dislikes = $company['i_didnot_like'];
									foreach ($dislikes as $like => $like_count) {
										echo "<li>$like <span>$like_count</span></li>";
									}
								echo "</ul></div>";
							}
							if( !empty($company['i_like']) ){
								echo "<div class='col-md-3'><ul>
									<li><b>Customers like</b></li>";
									$likes = $company['i_like'];
									foreach ($likes as $like => $like_count) {
										echo "<li>$like <span>$like_count</span></li>";
									}
								echo "</ul></div>";
							}							
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
							<h3>Reviews</h3>
							<?php
							if( !empty($company['reviews']) ){
								$reviews = $company['reviews'];
								foreach ($reviews as $review_id => $review) : ?>
									<div id="review_<?php echo $review_id?>">
										<div class='col-md-9'>
											<h2>
												<a href='<?php echo $review['review_permalink'] ?>'><?php echo $review['review_title'] ?></a>
												<small><?php echo get_the_date('',$review_id) ?></small>
											</h2>
											<div><?php echo wp_trim_words( get_the_content($review_id), 90, '...') ?></div>
											<hr/>
											<a href='<?php echo $review['review_permalink'] ?>/#commentform'>Comment</a>
										</div>
										<div class='col-md-3'>
											<?php
											if( !empty($review['i_liked']) ){
												$ilikes = $review['i_liked'];
												echo "<ul>";
												echo "<li>I LIKED</li>";
												foreach ($ilikes as $i => $like) {
													echo "<li>$like</li>";
												}
												echo "</ul>";
											}
											if( !empty($review['i_did_not_liked']) ){
												$inotlikes = $review['i_did_not_liked'];
												echo "<ul>";
												echo "<li>I DIDN'T LIKE</li>";
												foreach ($inotlikes as $i => $like) {
													echo "<li>$like</li>";
												}
												echo "</ul>";
											}											
											?>
											<hr/>
											<span><?php echo '#'.$review_id; ?> </span>
										</div>
									</div>
								<?php 
								endforeach;
							}
							?>
						</div>
						<div id="qa" class="tab-pane fade">
							<h3>Menu 1</h3>
							<p>Some content in menu 1.</p>
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
							<h3>Menu 4</h3>
							<p>Some content in menu 2.</p>
						</div>
						<div id="competitors" class="tab-pane fade">
							<h3>Menu 5</h3>
							<p>Some content in menu 2.</p>
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
										echo "<div><a href='#'>".$review['location']['address']."</a></div>";
										//Generating json for map: Start
										$com_locations[$j][] = $review['location']['address'];
										$com_locations[$j][] = (float)$review['location']['lat'];
										$com_locations[$j][] = (float)$review['location']['lng'];
										$com_locations[$j][] = $i;
										$j++;
										//END;			
									}
								}
								$map_locations = json_encode($com_locations);
								?>
							</div>							
							<div style="height:480px" id="map"></div>
						</div>
						<div id="products" class="tab-pane fade">
							<h3>Menu 7</h3>
							<p>Some content in menu 2.</p>
						</div>
					</div>
					<!-- Tabs panel end -->

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
