<?php get_header(); ?>

<div class="row">
 <h1>Users</h1>	
 <div class="holder clearfix items-holder">
	<?php
	$subscribers = ihpc_get_users('Subscriber');	
	if ( ! empty( $subscribers ) ) {
		foreach ( $subscribers as $subscriber ) : ?>
			<!-- Author panel in loop -->
			<div class="item">
				<div class="img-holder"><img src="<?php echo $subscriber['pro_pic'] ?>" class="img-responsive"></div>
				<div class="info-block">
					<div class="name-holder">
					<a href="<?php echo $subscriber['author_url']; ?>" class="name">
						<?php echo $subscriber['user_full_name']; ?>
					</a>
					</div>
			<div class="location">
				  <a href="#"><i class="fa fa-map-marker" aria-hidden="true"></i> Columbia, South Carolina</a>
			</div>
				<ul class="user-social-groups">
					<li><a href="#"><?php echo $subscriber['user_review_count']; ?> reviews</a> </li>
					<li><a href="#"><?php echo $subscriber['ser_comment_count']; ?> comments</a></li>
				</ul>
			</div>
			<!-- End -->
			</div>
			<?php
		endforeach;
	} 
	else {
		echo 'No users found.';
	}
	?>
</div>
</div>

<div class="row">
	<h1>Companies</h1>	
	<div class="holder clearfix items-holder">
		<?php 
		$contributors = ihpc_get_users(array('starter_plan','plus_plan','enterprise_plan'));	
		if ( ! empty( $contributors ) ) {
			foreach ( $contributors as $contributor ) : ?>
				<!-- Author panel in loop -->
				<div class="item">					
					<div class="img-holder"><img src="<?php echo $contributor['pro_pic'] ?>" class="img-responsive"></div>
					<div class="info-block">
						<div class="name-holder">
						<a href="<?php echo $contributor['author_url']; ?>" class="name">
							<?php echo $contributor['user_full_name']; ?>
						</a>
						</div>
				<div class="location"><?php echo (!empty($contributor['associated_companies']) ? 'from '.$contributor['associated_companies'] : ''); ?></div>
					<ul class="user-social-groups">
						<li><a href="#"><?php echo $contributor['user_comment_count']; ?> comments</a></li>
					</ul>
				</div>
				<!-- End -->
				</div>
				<?php
			endforeach;
		} 
		else {
			echo 'No users found.';
		}
		?>
	</div>
</div>

<?php get_footer(); ?>
