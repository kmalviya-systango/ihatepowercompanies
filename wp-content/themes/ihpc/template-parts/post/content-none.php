<?php
/**
 * Template part for displaying a message that posts cannot be found
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<section class="no-results not-found text-center">
	<header class="page-header">
			<img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/not_found.png">
		<h2 class="page-title"><?php _e( 'Nothing Found', 'ihpc' ); ?></h2>
	</header>
	<div class="page-content">
		<?php
		if ( is_home() && current_user_can( 'publish_posts' ) ) : ?>
			<p><?php printf( __( 'Ready to publish your first post? <a href="%1$s">Get started here</a>.', 'ihpc' ), esc_url( admin_url( 'post-new.php' ) ) ); ?></p>
			<?php else : ?>
			<p><?php _e( 'It seems we can&rsquo;t find what you&rsquo;re looking for. Perhaps searching can help.', 'ihpc' ); ?></p>
		
			<?php
				get_search_form();
		endif; ?>
	</div><!-- .page-content -->
</section><!-- .no-results -->
