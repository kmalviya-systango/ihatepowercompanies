<?php
ob_start();
/**
 * Template Name: Bussiness Page
 */
get_header();
?>
<div class="container pt-40 text-center business_sol">
	<h2 class="bold">Business Solutions</h2>
	<span>Turn I Hate Power Companies into brand advocates.</span>
	<div class="row">
		<div class="col-md-4 col-sm-4">
			<div class="business_plans mt-40">
				<h2 class="bold">Free Plan</h2>
				<h5>For starters</h5>				
				<div class="price_plan">
					<sup>$</sup>0<span>/mo</span>
				</div>				
				<ul>
					<li>Verification badge</li>
					<li>Communication via comments</li>
					<li>Weekly review digest</li>
					<li>Posters' replies notifications</li>
					<li>Private messaging</li>
				</ul>
				<a href="<?php echo site_url('company-signup?contract_type=starter_plan') ?>" class="text-uppercase site_btn">GET free</a>
			</div>
		</div>
		<div class="col-md-4 col-sm-4">
			<div class="business_plans mt-40">
				<h2 class="bold">Plus Plan</h2>
				<h5>For customer service</h5>
				
				<div class="price_plan">
					<sup>$</sup>250<span>/mo</span>
				</div>
				
				<ul>
					<li>Verification badge</li>
					<li>Profile customization</li>
					<li>Communication via comments</li>
					<li>Posters' replies notifications</li>
					<li>Realtime new review notifications</li>
					<li>Comments tracking</li>
					<li>Additional information about posters</li>
					<li>Multiple brand coverage</li>
					<li>Private messaging</li>
				</ul>
				<a href="<?php echo site_url('company-signup?contract_type=plus_plan') ?>" class="text-uppercase site_btn">Apply for free 14-day trial</a>
			</div>
		</div>
		<div class="col-md-4 col-sm-4">
			<div class="business_plans mt-40">
				<h2 class="bold">Enterprise Plan</h2>
				<h5>For customer service <br>and marketing</h5>
				
				<div class="get_a_quote">
					Get a quote
				</div>
				
				<ul>
					<li>Verification badge</li>
					<li>Profile customization</li>
					<li>Contact posters before review is posted</li>
					<li>Realtime new review notifications</li>
					<li>Solution for comments</li>
					<li>Dedicated account manager</li>
					<li>Real customers badges</li>
					<li>Solution for anonymous posters</li>
					<li>Multiple brand coverage</li>
					<li>Tabs and widgets management</li>
					<li>IP spam filter</li>
					<li>Duplicate content monitoring</li>
					<li>Custom development</li>
					<li>Private messaging</li>
				</ul>
				<a href="<?php echo site_url('company-signup?contract_type=enterprise_plan') ?>" class="text-uppercase site_btn">Apply for custom solution</a>
			</div>
		</div>
	</div>
</div>
<div class="testimonial_slider text-center">
	<div class="container">
		<h2 class="bold">What Our Customers Are Saying</h2>
		<hr>
		<div id="myCarousel" class="carousel slide" data-ride="carousel">			
		  <!-- Wrapper for slides -->
		  <div class="carousel-inner">
			<div class="item">
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an <br>unknown printer took a galley of type and scrambled it to make a type specimen book. <br>It has survived not only five centuries, but also the leap into electronic typesetting, <br>remaining essentially unchanged.</p>
				<p class="client"><small>Kaite F Plus Plan Client  March 30, 2017</small></p>
			</div>
		
			<div class="item">
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an <br>unknown printer took a galley of type and scrambled it to make a type specimen book. <br>It has survived not only five centuries, but also the leap into electronic typesetting, <br>remaining essentially unchanged.</p>
				<p class="client"><small>Kaite F Plus Plan Client  March 30, 2017</small></p>
			</div>
		
			<div class="item active">
				<p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. <br>Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an <br>unknown printer took a galley of type and scrambled it to make a type specimen book. <br>It has survived not only five centuries, but also the leap into electronic typesetting, <br>remaining essentially unchanged.</p>
				<p class="client"><small>Kaite F Plus Plan Client  March 30, 2017</small></p>
			</div>
		  </div>
		
		  <!-- Left and right controls -->
		  <a class="left carousel-control" href="#myCarousel" data-slide="prev"><img src="http://192.168.1.68/ihpc/wp-content/themes/ihpc/assets/images/arrow_left.png"><span class="sr-only">Previous</span>
		  </a>
		  <a class="right carousel-control" href="#myCarousel" data-slide="next"><img src="http://192.168.1.68/ihpc/wp-content/themes/ihpc/assets/images/arrow_right.png"><span class="sr-only">Next</span>
		  </a>
		</div>
	</div>
</div>
<div class="container">
	<div class="col-sm-6 col-md-6">
		<div class="business_product text-center">
			<div class="img_hght">
				<img src="http://192.168.1.68/ihpc/wp-content/themes/ihpc/assets/images/social_monitor.png">
			</div>
			<h2 class="bold">Social Monitor API</h2>
			<p>Get XML feed with new reviews and comments <br>about your company</p>
			<a href="#x" class="site_btn text-uppercase" data-toggle="modal" data-target="#company">Apply</a>
		</div>
	</div>
	<div class="col-sm-6 col-md-6">
		<div class="business_product text-center">
			<div class="img_hght">
				<img src="http://192.168.1.68/ihpc/wp-content/themes/ihpc/assets/images/business_list.png">
			</div>				
			<h2 class="bold">List Your Business</h2>
			<p>Create company profile on our site.</p>
			<a href="#x" class="site_btn text-uppercase">Get started</a>
		</div>
	</div>
	<div class="clearfix"></div>
	<p class="text-center terms">Please be advised that I Hate Power Companies service offerings do not contemplate the removal of consumer <br>complaints which conform to our <a href="#x" class="red_link">Terms of Service</a>. We encourage you to contact us for more details about our <br>premium business services and our policies.</p>
</div>
<?php get_footer(); ?>
