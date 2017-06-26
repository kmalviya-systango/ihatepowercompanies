<?php
/**
 * Template part for displaying posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php
    if ( is_sticky() && is_home() ) :
        echo ihpc_get_svg( array( 'icon' => 'thumb-tack' ) );
    endif;
    ?>
    <header class="entry-header">
        <?php
        if ( is_single() ) {
            the_title( '<h1 class="entry-title">', '</h1>' );
        }
        else {
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }
        ?>
		<ul class="review-fields">
		  <!-- <li><span class="billet from-mobile">From mobile</span></li> -->
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
		  <li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php echo get_the_date() ?></span></li>
		  <li><i class="fa fa-user" aria-hidden="true"></i><span class="fs12">by </span><span class="fs12"><?php echo get_the_author() ?></span></li>
		  <li>#1044757</li>
          <li><?php ihpc_edit_link() ?></li>
		</ul>
    </header><!-- .entry-header -->

    <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
        <div class="post-thumbnail col-sm-2">
            <a href="<?php the_permalink(); ?>">
                <?php the_post_thumbnail( 'ihpc-featured-image' ); ?>
            </a>
        </div><!-- .post-thumbnail -->
    <?php endif; ?>

    <div class="entry-content col-sm-10">
        <?php
        /* translators: %s: Name of current post */
        the_content( sprintf(
            __( 'Read More... ', 'ihpc' ),
            get_the_title()
        ) );

        wp_link_pages( array(
            'before'      => '<div class="page-links">' . __( 'Pages:', 'ihpc' ),
            'after'       => '</div>',
            'link_before' => '<span class="page-number">',
            'link_after'  => '</span>',
        ) );
        ?>
		<a href="<?php echo esc_url( get_permalink() ); ?>" class="add-comment">Add comment</a>
		
		<div class="clearfix"></div>
		
    </div>
	<!-- <div class="was-this-review-needfull col-sm-12">
  	  <span>Was this review helpful?</span>		
	</div> -->

	<!-- .entry-content -->
    <?php if ( is_single() ) : ?>
        <?php ihpc_entry_footer(); ?>
    <?php endif; ?>
<div class="clearfix"></div>
</article><!-- #post-## -->
