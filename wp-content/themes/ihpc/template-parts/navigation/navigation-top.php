<?php
/**
 * Displays top navigation
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<div class="collapse navbar-collapse" id="ihpc-nav">
	<?php wp_nav_menu( array(
		'theme_location' => 'top',
		'items_wrap' => my_nav_wrap(),		
		'menu_id' => 'top-menu',
		'menu_class' => 'nav navbar-nav pull-right',		
	) ); ?>	
	</div>
<!-- #site-navigation -->
