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
    <?php $company = get_company_review( get_the_ID() ); ?>
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
        <?php $company_website = get_field( "company_website" );  ?>
        <a href="<?php echo esc_url($company_website); ?>"><p class="company_url"><?php echo $company_website; ?></p></a>
        <p><?php echo wp_trim_words( get_the_content(), 90, '...'); ?></p>       
    </div>
    <div class="col-sm-3 customer_feedback">
        <?php if( !empty($company['i_like']) ): ?>
        <h3 class="customer_list_title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/like.png"> Customers like </h3>
        <p class="pl-30">
            <?php
            $count = 0; 
            foreach ($company['i_like'] as $key => $like) {
                if($count<3)
                    echo "<div>".$key."<span> $like</span></div>";
                $count++;
            } 
            ?>                          
        </p>
    <?php endif; ?>
        <div class="separatore clearfix"></div>
        <?php if( !empty($company['i_didnot_like']) ): ?>
        <h3 class="customer_list_title"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/unlike.png"> Customers like </h3>
        <p class="pl-30">
            <?php
            $count = 0; 
            foreach ($company['i_didnot_like'] as $key => $notlike) {
                if($count<3)
                    echo "<div>".$key."<span> $notlike</span></div>";
                $count++;
            } 
            ?>
        </p>
        <?php endif; ?>
    </div>
    <div class="col-sm-2">
        <?php
        if( !empty($company['calculations']['star_ratting']) ): ?>
            <h3 class="text-center rating_title "><?php echo round($company['calculations']['star_ratting'],2) ?></h3>
            <div class="rating_bulb"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/rating_bulb.png"></div>
        <?php
        endif;
        ?>        
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
        <div class="col-sm-1 text-center c_l_f_losses"> $
            <?php 
                if( !empty($company['calculations']['total_loss_metric']) )
                    echo $company['calculations']['total_loss_metric'];
                else
                    echo 0;
            ?>
            claimed<br>
            losses </div>
        <div class="col-sm-1 text-center c_l_f_average"> $
            <?php 
                if( !empty($company['calculations']['average_loss_metric']) )
                    echo $company['calculations']['average_loss_metric'];
                else
                    echo 0;
            ?><br>
            average </div>
        <div class="col-sm-1 text-center c_l_f_view "> 0<br>
            views </div>        
    </div>
</div><!-- #post-## -->
