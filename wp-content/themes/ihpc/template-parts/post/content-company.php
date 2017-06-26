<?php
/**
 * Template part for displaying Company posts
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */

?>

<div id="post-<?php the_ID(); ?>" class="company_list clearfix">
    <?php
    if ( is_sticky() && is_home() ) :
        echo ihpc_get_svg( array( 'icon' => 'thumb-tack' ) );
    endif;
    ?>
    <!--<header class="entry-header">
        <?php
        if ( 'companies' === get_post_type() ) :
            echo '<div class="entry-meta">';
            if ( is_single() ) :
                ihpc_posted_on();
            else :
                echo ihpc_time_link();
                ihpc_edit_link();
            endif;
            echo '</div>';
        endif;

        if ( is_single() ) {
            the_title( '<h1 class="entry-title">', '</h1>' );
        } else {
            the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
        }
        ?>
    </header>-->
    <div class="col-sm-2">
        <?php if ( '' !== get_the_post_thumbnail() && ! is_single() ) : ?>
            <div class="company_logo">
                <a href="<?php the_permalink(); ?>">
                    <?php the_post_thumbnail( 'ihpc-featured-image' ); ?>
                </a>
            </div><!-- .post-thumbnail -->
        <?php endif; ?>
    </div>
    <div class="col-sm-5">
       <a href="<?php echo esc_url(get_permalink()); ?>"><h3 class="company_list_title"><?php echo get_the_title(); ?> </h3></a>
        <?php  $company_website = get_field( "company_website" );  ?>
        <a href="<?php echo esc_url($company_website); ?>"><p class="company_url"><?php echo $company_website; ?></p></a>
        <p><?php
            if( is_single() ) 
                echo the_content();
            else
                echo wp_trim_words( get_the_content(), 95, '...');
            ?>
        </p>
    </div>

    <div class="col-sm-3 customer_feedback">
        <h3 class="customer_list_title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/like.png"> Customers like </h3>
        <p class="pl-30">Having tv when it does work 23<br>
            Picture quality 15<br>
            Nfl ticket 7</p>
        <div class="separatore clearfix"></div>
        <h3 class="customer_list_title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/unlike.png"> Customers like </h3>
        <p class="pl-30">Poor customer service 92<br>
            Customer service 75<br>
            Lack of service 38 </p>
    </div>

    <div class="col-sm-2">
        <?php if(function_exists('the_ratings')) { the_ratings(); } ?>
        <!-- <h3 class="text-center rating_title ">2.5</h3>
        <div class="rating_bulb"><img src="<?php //echo get_template_directory_uri(); ?>/assets/images/rating_bulb.png"></div> -->
        <?php 
            if( !is_user_logged_in() ){
                echo '<a data-toggle="modal" data-target="#choose-a-plan" class="respond_customer_btn">Respond to your customers</a>';
            }
            else{
                echo '<a href="'.get_permalink().'" class="respond_customer_btn">Respond to your customers</a>';   
            }
        ?>        
    </div>

    <div class="clearfix"></div>
    <div class="col-md-10 col-md-offset-2 customer_list_footer">
        <div class="col-sm-1 text-center c_l_f_resolved"> <strong>23</strong> Issues<br>
            Resolved </div>
        <div class="col-sm-1 text-center c_l_f_reviews"> <?php echo get_company_reviews( get_the_ID() ) ?>
            Reviews </div>
        <div class="col-sm-1 text-center c_l_f_losses"> $1.9M
            claimed<br>
            losses </div>
        <div class="col-sm-1 text-center c_l_f_average"> $207<br>
            average </div>
        <div class="col-sm-1 text-center c_l_f_view "> 330K<br>
            views </div>
        <?php
        //Get all post categories
        $category_detail = get_the_category();
        if($category_detail){ ?>
            <div class="col-sm-4 text-center telecommunications"> <img src="<?php echo get_template_directory_uri(); ?>/assets/images/telecommunications.png"> <?php foreach($category_detail as $cd){
                    echo $cd->cat_name .'';
                }?>
            </div>
        <?php  } ?>

    </div>

    <?php if ( is_single() ) : ?>
        <?php ihpc_entry_footer(); ?>
    <?php endif; ?>

</div><!-- #post-## -->
