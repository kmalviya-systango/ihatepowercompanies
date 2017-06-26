<?php
// Register and load the widget
function wpb_load_companies_widget() {
	register_widget( 'ihpc_most_active_companies' );
}
add_action( 'widgets_init', 'wpb_load_companies_widget' );

/****
* Adding new column of most active user in users table :Start
****/
function new_modify_companies_table( $columns ) {
    $columns['activity_rank'] = 'Active Rank';
    return $columns;
}
add_filter( 'manage_companies_posts_columns', 'new_modify_companies_table',10);
//add_filter('manage_edit-companies_columns', 'new_modify_companies_table');


function new_modify_companies_table_row($column,$post_ID) {	
    switch ($column) {
        case 'activity_rank' :
            echo get_post_meta( $post_ID, 'activity_rank', true );
        break;
    }
}
add_action( 'manage_companies_posts_custom_column', 'new_modify_companies_table_row',10,2 );
/****
* END;
****/

// Creating the widget 
class ihpc_most_active_companies extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'ihpc_most_active_companies',
			// Widget name will appear in UI
			__('Most Active Companies', 'wpb_widget_domain'), 
			// Widget description
			array( 'description' => __( 'This widget shows the most active companies of your wordpress', 'wpb_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];

		if( $instance['sort_by'] == 'activity_rank' ){
			$args = array(	'posts_per_page' => $instance['no_users'],
							'post_type'		 => 'companies',
							'meta_key' 		 => 'activity_rank',
							'orderby'  		 => 'meta_value_num',
							'order'    		 => 'ASC'
						);
		}
		else{
			$args = array(	'posts_per_page' => $instance['no_users'],
							'post_type'		 => 'companies',
							'orderby'  		 => 'date',
							'order' 		 => 'DESC'
						);
		}		
		$users_str = '<ul class="w-active-users">';
		$the_query = new WP_Query( $args );
		if ( $the_query->have_posts() ) {		
			while ( $the_query->have_posts() ) {
				$the_query->the_post();
				$ratting 	= get_post_meta(get_the_ID(), 'ratings_average', true);
				$thumb_url 	= get_the_post_thumbnail_url(get_the_ID());
				if( empty($thumb_url) )
					$thumb_url = get_stylesheet_directory_uri().'/assets/images/avatar_standart_light.png';
				$users_str .= '<li>
								<a class="" href="'.get_permalink().'">
									<img src="'.$thumb_url.'"> '.get_the_title().'
								</a>
							</li>';
			}
		}
		$users_str .= '</ul><div><a href="'.site_url('companiestax/all_users').'" class="more-link">More</a></div>';
		echo __( $users_str , 'wpb_widget_domain' );
		echo $args['after_widget'];		
	}
		
	// Widget Backend 
	public function form( $instance ) {
		if ( isset( $instance[ 'title' ] ) ) {
			$title = $instance[ 'title' ];
			$sort  = $instance['sort_by'];
			$no_users  = $instance['no_users'];
		}
		else {
			$title = __( 'Most Active Companies', 'wpb_widget_domain' );
			$sort = 'recent_post';
			$no_users  = 5;
		}
		// Widget admin form
		?>
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo esc_attr( $title ); ?>" />
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'sort_by' ); ?>"><?php _e( 'Sort By:' ); ?></label> 
			<select class="widefat" id="<?php echo $this->get_field_id( 'sort_by' ); ?>" name="<?php echo $this->get_field_name( 'sort_by' ); ?>">
				<option <?php if($sort=='recent_post') echo 'selected' ?> value="recent_post">By Recent Post</option>
				<option <?php if($sort=='activity_rank') echo 'selected' ?> value="activity_rank">By Admin</option>				
			</select>
		</p>
		<p>
			<label for="<?php echo $this->get_field_id( 'no_users' ); ?>"><?php _e( 'Number of companies:' ); ?></label> 
			<input class="widefat" id="<?php echo $this->get_field_id( 'no_users' ); ?>" name="<?php echo $this->get_field_name( 'no_users' ); ?>" type="text" value="<?php echo esc_attr( $no_users ); ?>" />
		</p>
		<?php 
	}
	
	// Updating widget replacing old instances with new
	public function update( $new_instance, $old_instance ) {
		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? strip_tags( $new_instance['title'] ) : '';
		$instance['sort_by'] = ( ! empty( $new_instance['sort_by'] ) ) ? strip_tags( $new_instance['sort_by'] ) : 'recent_post';
		$instance['no_users'] = ( ! empty( $new_instance['no_users'] ) ) ? strip_tags( $new_instance['no_users'] ) : 5;
		return $instance;
	}
} // Class wpb_widget ends here
