<?php
// Register and load the widget
function wpb_load_widget() {
	register_widget( 'ihpc_most_active_users' );
}
add_action( 'widgets_init', 'wpb_load_widget' );


/****
* Adding new column of most active user in users table :Start
****/
function new_modify_user_table( $column ) {
    $column['activity_rank'] = 'Active Rank';
    return $column;
}
add_filter( 'manage_users_columns', 'new_modify_user_table' );

function new_modify_user_table_row( $val, $column_name, $user_id ) {
    switch ($column_name) {
        case 'activity_rank' :
            return get_the_author_meta( 'activity_rank', $user_id );
            break;
        default:
    }
    return $val;
}
add_filter( 'manage_users_custom_column', 'new_modify_user_table_row', 10, 3 );
/****
* END;
****/

// Creating the widget 
class ihpc_most_active_users extends WP_Widget {

	function __construct() {
		parent::__construct(
			// Base ID of your widget
			'ihpc_most_active_users',
			// Widget name will appear in UI
			__('Most Active Users', 'wpb_widget_domain'), 
			// Widget description
			array( 'description' => __( 'This widget shows the most active user of your wordpress', 'wpb_widget_domain' ), ) 
		);
	}

	// Creating widget front-end
	public function widget( $args, $instance ) {
		$title = apply_filters( 'widget_title', $instance['title'] );
		// before and after widget arguments are defined by themes
		echo $args['before_widget'];
		if ( ! empty( $title ) )
		echo $args['before_title'] . $title . $args['after_title'];		
		$users_str = '';
		$users_str = "<ul class='w-active-users'>";
		if( $instance['sort_by'] == 'activity_rank' ){
			$args1 = array(	'meta_key' => 'activity_rank',
							'orderby'  => 'meta_value_num',
							'order'    => 'ASC');
		}
		else{
			$args1 = array(	'orderby' => 'post_count',
							'order'   => 'DESC');	
		}
		$users = get_users( $args1 );
		$i = 0;
		foreach ($users as $key => $user) {
			if( $i < $instance['no_users'] ){
				$pro_pic = get_field('user_profile_pic','user_'.$user->data->ID);			
				if( !empty($pro_pic) ){
					$users_str .= "<li>
									<a href='".get_author_posts_url($user->data->ID)."'>
									<img src='$pro_pic' class='user-image' />
									 <span>".$user->data->display_name."</span>
									</a>
								</li>";
				}
				else{
					$users_str .= "<li>
									<a href='".get_author_posts_url($user->data->ID)."'>
									<img src='".get_stylesheet_directory_uri()."/assets/images/avatar_standart_light.png' class='user-image' />
									<span>".$user->data->display_name."</span></a>
								</li>";
				}
			}
			$i++;
		}
		$users_str .= "</ul><div><a href='".site_url('companiestax/all_users/')."' class='more-link'>More</a></div>";
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
			$title = __( 'Most Active Users', 'wpb_widget_domain' );
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
			<label for="<?php echo $this->get_field_id( 'no_users' ); ?>"><?php _e( 'Number of users:' ); ?></label> 
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
