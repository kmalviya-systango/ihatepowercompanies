<?php
/*
Plugin Name: Ihpc Comments
Version: 1.0
Plugin URI: ihatepowercompanies.com
Description: A plug-in to add additional fields in the comment form.
*/

/***
* Removing unneccassary field from wp default comment form
****/
add_filter('comment_form_default_fields','custom_fields');
function custom_fields($fields) {
	$commenter 	= wp_get_current_commenter();
	$req 		= get_option( 'require_name_email' );
	$aria_req 	= ( $req ? " aria-required='true'" : '' );
	$fields[ 'author' ] = '<div class="comment-form-author">'.
							'<div><label for="author">Name</label></div>'.
							( $req ? '<span class="required">*</span>' : '' ).
							'<div><input id="author" name="author" type="text" value="'. esc_attr( $commenter['comment_author'] ) . 
							'" size="30" tabindex="1"' . $aria_req . ' /></div>
							</div>';		
	unset( $fields['email'] );
	unset( $fields['phone'] );
	unset( $fields['url'] );
	return $fields;
}
/****
* Remove the logout link in comment form
****/
add_filter( 'comment_form_logged_in', '__return_empty_string' );

/****
* Moving comment textarea to the bottom of the form
****/
function wpb_move_comment_field_to_bottom( $fields ) {	
	$comment_field = $fields['comment'];
	unset( $fields['comment'] );
	$fields['comment'] = $comment_field;	
	return $fields;
}
add_filter( 'comment_form_fields', 'wpb_move_comment_field_to_bottom' );

/****
* Appending extra new fields after comment text area.
****/
add_filter( 'comment_form_defaults', 'wpse_120049_extend_textarea' );
function wpse_120049_extend_textarea( $args )
{	
	if( !is_user_logged_in() ){
		$commentFieldMessage = 'Comment as anonymous or <a href="'.site_url('login').'">Login</a>';
		$args['comment_field'] = '<div class="comment-form-comment">
								<div><label for="comment">'.$commentFieldMessage.'</label></div>
								<div>
									<textarea required="required" id="comment" name="comment" cols="45" rows="8" maxlength="65525" minlength="10" aria-required="true" ></textarea>
								</div>
							</div>';
	    $args['comment_field'] .= '<div class="comment-form-title">'.
									'<div><label for="autocomplete">Your Location</label></div>'.
									'<span>
										<input id="autocomplete" onfocus="geolocate()" name="commenter_location" type="text" size="30"  tabindex="5" />
										<input type="hidden" id="glat" name="location[lat]" value="">
										<input type="hidden" id="glong" name="location[lng]" value="">
									</span>
									<span><input type="checkbox" id="hide_location" /><label for="hide_location">Hide Location</label></span>
								</div>
		<div class="comment-form-rating">
			<div><input type="checkbox" name="read_tc" id="read_tc"><label for="read_tc">I have read and agree to the Pissed Consumer Terms of Service<span class="required">*</span></label></div>
		</div>';
	}
	else{
		$commentFieldMessage = 'Comment as anonymous <input onclick="showUserNameField(1)" type="radio" checked="checked" name="annonymous_comment_flag" id="annonymous_yes" value="yes" /><label>Yes</label>
													<input onclick="showUserNameField(0)" type="radio" name="annonymous_comment_flag" id="annonymous_no" value="no" /><label>No</label>';
		$args['comment_field'] = '<div id="comment-form-author" class="comment-form-author">
										<div>
											<label for="author">Name</label>
										</div>
										<div>
											<input id="author" name="author" value="" size="30" tabindex="1" type="text">
										</div>
									</div>
								<div class="comment-form-comment">
									<div><label for="comment">'.$commentFieldMessage.'</label></div>
								<div>
									<textarea required="required" id="comment" name="comment" cols="45" rows="8" maxlength="65525" minlength="10" aria-required="true" ></textarea>
								</div>
							</div>';
	    $args['comment_field'] .= '<div class="comment-form-title">'.
									'<div><label for="autocomplete">Your Location</label></div>'.
									'<span>
										<input id="autocomplete" onfocus="geolocate()" name="commenter_location" type="text" size="30"  tabindex="5" />
										<input type="hidden" id="glat" name="location[lat]" value="">
										<input type="hidden" id="glong" name="location[lng]" value="">
									</span>
									<span><input type="checkbox" id="hide_location" /><label for="hide_location">Hide Location</label></span>
								</div>
		<div class="comment-form-rating">
			<div><input type="checkbox" name="read_tc" id="read_tc"><label for="read_tc">I have read and agree to the Pissed Consumer Terms of Service<span class="required">*</span></label></div>
		</div>
		<script>
		function showUserNameField(flag){
			if(flag==1){
				document.getElementById("comment-form-author").style.display = "block";
			}
			else{
				document.getElementById("comment-form-author").style.display = "none";	
			}
		}
		</script>';													
	}	
    return $args;
}

// Save the comment meta data along with comment
add_action( 'comment_post', 'save_comment_meta_data' );
function save_comment_meta_data( $comment_id ) {
	/***
	* If annonymous comment is yes then update the comment author to annonymous
	****/
	if( isset( $_POST['annonymous_comment_flag'] )  ){
		$comment_flag = wp_filter_nohtml_kses($_POST['annonymous_comment_flag']);
		if($comment_flag == 'yes'){
			$commentarr = array();
			$commentarr['comment_ID'] 	  = $comment_id;
			$commentarr['user_id'] 	  	  = 0;
			$commentarr['comment_author'] = wp_filter_nohtml_kses($_POST['author']);
			$commentarr['comment_approved'] = 0;
			$res = wp_update_comment( $commentarr );	
		}
	}
	/****
	* Updating the comments location in comment meta
	****/
	if ( ( isset( $_POST['commenter_location'] ) ) && ( $_POST['commenter_location'] != '') ){
		$commenter_location = wp_filter_nohtml_kses($_POST['commenter_location']);
		add_comment_meta( $comment_id, 'commenter_location', $commenter_location );
	}	

	if ( ( isset( $_POST['read_tc'] ) ) && ( $_POST['read_tc'] != '') ){
		$read_tc = wp_filter_nohtml_kses($_POST['read_tc']);
		add_comment_meta( $comment_id, 'read_tc', $title );
	}	
	
}


// Add the filter to check if the comment meta data has been filled or not
/*add_filter( 'preprocess_comment', 'verify_comment_meta_data' );
function verify_comment_meta_data( $commentdata ) {
	if ( ! isset( $_POST['rating'] ) )
	wp_die( __( 'Error: You did not add your rating. Hit the BACK button of your Web browser and resubmit your comment with rating.' ) );
	return $commentdata;
}*/

//Add an edit option in comment edit screen  

add_action( 'add_meta_boxes_comment', 'extend_comment_add_meta_box' );
function extend_comment_add_meta_box() {
    add_meta_box( 'title', __( 'Comment Location' ), 'extend_comment_meta_box', 'comment', 'normal', 'high' );
}
 
function extend_comment_meta_box ( $comment ) {
    $commenter_location = get_comment_meta( $comment->comment_ID, 'commenter_location', true );
    $read_tc = get_comment_meta( $comment->comment_ID, 'read_tc', true );
    //$rating = get_comment_meta( $comment->comment_ID, 'rating', true );
    wp_nonce_field( 'extend_comment_update', 'extend_comment_update', false );
    ?>
    <p>
        <label for="phone"><?php _e( 'Location' ); ?></label>
        <input type="text" name="commenter_location" value="<?php echo esc_attr( $commenter_location ); ?>" class="widefat" />
    </p>
    <!-- <p>
        <label for="read_tc"><?php //_e( 'Readed Terms and conditions' ); ?></label>
        <input type="text" name="read_tc" value="<?php //echo esc_attr( $read_tc ); ?>" class="widefat" disabled="disabled" />
    </p> -->    
    <?php
}

// Update comment meta data from comment edit screen 

add_action( 'edit_comment', 'extend_comment_edit_metafields' );
function extend_comment_edit_metafields( $comment_id ) {
    if( ! isset( $_POST['extend_comment_update'] ) || ! wp_verify_nonce( $_POST['extend_comment_update'], 'extend_comment_update' ) ) return;

	if ( ( isset( $_POST['commenter_location'] ) ) && ( $_POST['commenter_location'] != '') ) : 
	$commenter_location = wp_filter_nohtml_kses($_POST['commenter_location']);
	update_comment_meta( $comment_id, 'commenter_location', $commenter_location );
	else :
	delete_comment_meta( $comment_id, 'commenter_location');
	endif;
		
	if ( ( isset( $_POST['read_tc'] ) ) && ( $_POST['read_tc'] != '') ):
	$read_tc = wp_filter_nohtml_kses($_POST['read_tc']);
	update_comment_meta( $comment_id, 'read_tc', $read_tc );
	else :
	delete_comment_meta( $comment_id, 'read_tc');
	endif;		
}

// Add the comment meta (saved earlier) to the comment text 
// You can also output the comment meta values directly in comments template  

add_filter( 'comment_text', 'modify_comment');
function modify_comment( $text ){
	$plugin_url_path = WP_PLUGIN_URL;
	if( $commenttitle = get_comment_meta( get_comment_ID(), 'commenter_location', true ) ) {
		$commenttitle = '<strong>' . esc_attr( $commenttitle ) . '</strong><br/>';
		$text = $commenttitle . $text;
	} 
	if( $commentrating = get_comment_meta( get_comment_ID(), 'read_tc', true ) ) {
		$commentrating = '<p class="comment-rating">'.$commentrating.'</strong></p>';
		$text = $text . $commentrating;
		return $text;		
	} else {
		return $text;		
	}	 
}
