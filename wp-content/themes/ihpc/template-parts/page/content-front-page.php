<?php
/**
 * Displays content for front page
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class( 'ihpc-panel ' ); ?> >

	<?php if ( has_post_thumbnail() ) :
		$thumbnail = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'ihpc-featured-image' );

		$post_thumbnail_id = get_post_thumbnail_id( $post->ID );

		$thumbnail_attributes = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'ihpc-featured-image' );

		// Calculate aspect ratio: h / w * 100%.
		$ratio = $thumbnail_attributes[2] / $thumbnail_attributes[1] * 100;
		?>

		<div class="panel-image" style="background-image: url(<?php echo esc_url( $thumbnail[0] ); ?>);">
			<div class="panel-image-prop" style="padding-top: <?php echo esc_attr( $ratio ); ?>%"></div>
		</div><!-- .panel-image -->

	<?php endif; ?>

	<div class="panel-content">
		<div class="wrap">
			<header class="entry-header">
				<h1>Featured Reviews</h1>
			</header><!-- .entry-header -->

			<div class="entry-content">
				<div class="row mt-46">
				<?php
				//Get 3 latest review post
				//Author: DharmendraSingh
				// WP_Query arguments

				$args = array(
					'post_type'              => array( 'review' ),
					'post_status'            => array( 'publish' ),
					'posts_per_page'         => '3',
					'order'                  => 'DESC',
					'orderby'                => 'date',
				);

				// The Query
				$query = new WP_Query( $args );

				// The Loop
				if ( $query->have_posts() ) {
					while ( $query->have_posts() ) {
						$query->the_post();
						$postid_r = $post->ID;
						$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
						//If featured image not added then show placeholder image
						if(empty($feat_image)){
							$feat_image = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=263%C3%97164&w=263&h=164';
						}
						?>
						<div class="col-xs-12 col-sm-6 col-md-4">
							<div class="thumbnail"> 
								<div class="thumb-image">
									<img src="<?php echo esc_url($feat_image);?>" alt="" class="alignnone size-full wp-image-144" />
								</div>	
								<div class="caption dis-cap">
									<p><?php  esc_html(the_excerpt());?></p>
								 </div>
								<div class="button-bottom">
									<a href="<?php esc_url(the_permalink());?>" class="btn read_more" role="button">READ MORE</a>
								</div>
								</div>
							</div>
						<?php
					}
				} else {
					// no posts found
				}
				// Restore original Post Data
				wp_reset_postdata();
				?>
					<!-- <a href="<?php //echo esc_url(get_post_type_archive_link('review'));?>">More Featured Review -></a> -->
				</div>
			</div><!-- .entry-content -->

		</div><!-- .wrap -->
		<!-- <h1>Power Companies in the News</h1> -->
		<?php
		/*$argsc = array(
			'post_type'              => array( 'companies' ),
			'post_status'            => array( 'publish' ),
			'posts_per_page'         => '8',
			'order'                  => 'DESC',
			'orderby'                => 'date',
		);

		// The Query
		$query_c = new WP_Query( $argsc );
		// The Loop
		if ( $query_c->have_posts() ) {
			while ( $query_c->have_posts() ) {
				$query_c->the_post();
				$postid_r = $post->ID;
				$feat_image = wp_get_attachment_url( get_post_thumbnail_id($post->ID));
				//If featured image not added then show placeholder image
				if(empty($feat_image)){
					$feat_image = 'https://placeholdit.imgix.net/~text?txtsize=33&txt=263%C3%97164&w=263&h=164';
				}
				?>
				<div class="col-xs-12 col-sm-6 col-md-4">
					<div class="thumbnail"> <img src="<?php echo esc_url($feat_image);?>" alt="" width="263" height="164" class="alignnone size-full wp-image-144" />
						<div class="caption">
							<p><?php  esc_html(the_excerpt());?></p>
							<a href="<?php esc_url(the_permalink());?>" class="btn read_more" role="button">READ MORE</a> </div>
					</div>
				</div>
				<?php
			}
		} else {
			// no posts found
		}
		// Restore original Post Data
		wp_reset_postdata();*/
		?>

	</div><!-- .panel-content -->

</article><!-- #post-## -->
