<?php 
get_header();

$curauth    = (isset($_GET['author_name'])) ? get_user_by('slug', $author_name) : get_userdata(intval($author));
$authorId   = $curauth->data->ID;
$nickname   = $curauth->nickname;
$user_register = $curauth->user_registered;
/*echo "<pre>";
print_r($curauth);
echo "</pre>";*/
$pro_pic = get_field('user_profile_pic','user_'.$curauth->data->ID);

if( empty($pro_pic) )
    $pro_pic = get_stylesheet_directory_uri()."/assets/images/avatar_standart_light.png";
?>

<div class="container">
	<div class="author-info">

	
    <div id="profile-info" class="row">
        <div class="avatar col-sm-2">
            <img src="<?php echo $pro_pic ?>" class="img-responsive">
        </div>
        <div class="column col-sm-10">
			<div class="heading-group">         
			  <h2 class="text-center"><?php echo $nickname; ?></h2>
			</div>
            <dl>
                <dt>Joined</dt>
                <dd><?php echo $user_register; ?> </dd>
			</dl>
			 <dl>
                <dt>Last Seen</dt>
                <dd>June 5, 2017</dd>
			  </dl>	
			    <dl>
                <dt>Location</dt>
                <dd>Naples, Florida</dd>
            </dl>
			<div class="clearfix"></div>
			
			 <div class="btn-group tab-button">
				 <a href="?tab=reviews"><i class="fa fa-link" aria-hidden="true"></i> <?php echo $nickname ?>'s Review</a>
				<a href="?tab=comments"><i class="fa fa-link" aria-hidden="true"></i> <?php echo $nickname ?>'s Comments</a>
			</div> 			
        </div>
    </div>	
    </div>
 <?php if( ($_GET['tab'] == 'reviews') || !isset($_GET['tab']) ): ?>
        <!-- Row for Reviews -->
        <div class="row" id="review_page">
			<div class="col-sm-12 user-list-off-comment">
			
            <h1><?php echo $nickname ?>'s Review</h1>
			
            <?php 
                $args = array(  'posts_per_page' => -1,
                                'post_type' => 'review',
                                'orderby'   => 'date',
                                'order'     => 'DESC',
                                'author' => $authorId
                            );
                $array      = array();
                $the_query  = new WP_Query( $args );
                if ( $the_query->have_posts() ) :
                    while ( $the_query->have_posts() ) :
                        $the_query->the_post(); 
                        $pid = get_the_ID();
                        ?>
            
			            <div class="col-md-12 user-list-off-comment-item review-<?php echo $pid ?>">
						
						<header class="entry-header">
						  <h2 class="entry-title">  
						  	<a href="<?php echo get_permalink(); ?>"><?php echo get_the_title(); ?></a>
						  </h2>
					  <ul class="review-fields">            
                                <?php 
                                $company_id = get_post_meta( $pid, 'REVIEW_COMPANYID', true );
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
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php echo comments_number(0,1,'%') ?></span></li>
                                <li><i class="fa fa-user" aria-hidden="true"></i><span class="fs12">by </span><span class="fs12"><?php echo get_the_author() ?></span></li>          
                            </ul>
						</header>
						<div class="entry-content col-sm-10 row">
								<p>
								<?php echo get_the_excerpt(); ?>
								<a href="<?php echo get_the_permalink(); ?>" class="more-link unbold-text">Read More</a>
								</p>
							</div>

                        </div>                        
                    <?php 
                    endwhile;
                    wp_reset_postdata();
                else:
                    echo "<div class='col-md-12'>No reviews</div>";
                endif;
            ?>
        </div>
		</div>
        <!-- End -->
    <?php else: ?>
        <!-- Row for comments -->
        <div class="row" id="review_page">
		
            <h1><?php echo $nickname ?>'s Comments</h1>
            <?php 
            $args = array( 'author__in' => array($authorId),
                           'orderby' => 'date',
                           'order' => 'DESC');
            $comments   = get_comments($args);
            if( !empty($comments) ):
                foreach($comments as $comment) : ?>
                    <div class="col-md-12 user-list-off-comment-item">   
					
					<header class="entry-header">
						  <h2 class="entry-title">  
							<a href="<?php echo get_the_permalink( $comment->comment_post_ID ); ?>"><?php echo get_the_title($comment->comment_post_ID) ?></a>
						  </h2>
						  
						    <ul class="review-fields">            
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i><span class="fs12"><?php echo "Date: ".$comment->comment_date ?></span></li>
                                <li><i class="fa fa-map-marker" aria-hidden="true"></i><span class="fs12"><?php echo "Location: ".$comment->comment_author_IP ?></span></li>          
                            </ul>						  					  
						</header>					              
                        <div class="post-thumbnail col-sm-2"><img src="<?php echo $pro_pic ?>" class="img-responsive"></div>                   
                        <div class="entry-content col-sm-10"><?php echo $comment->comment_content ?></div>
                    </div>
                <?php 
                endforeach;            
            else:
                echo "<div class='col-md-12'>No comments</div>";
            endif;
            ?>
        </div>
        <!-- End -->
    <?php endif; ?>

</div>

<?php get_footer(); ?>