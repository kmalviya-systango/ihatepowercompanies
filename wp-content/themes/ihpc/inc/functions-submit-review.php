<?php
/*****
* Functions for 'Write A Review' page
******/
//Function for step 1
add_action('wp_ajax_submit_reivew_form', 'submit_reivew_form');
add_action('wp_ajax_nopriv_submit_reivew_form', 'submit_reivew_form');
function submit_reivew_form(){	
	parse_str($_REQUEST['form_json'], $data);
	$insertArray 	= array();
	$insertArray['post_title'] 				= $data['review_title'];
	$insertArray['post_content'] 			= $data['review_text'];
	$insertArray['company'] 				= $data['company'];
    $insertArray['product_or_service'] 		= !empty($data['product_or_service']) ? $data['product_or_service']:'';
    $insertArray['readed_term_of_services'] = !empty($data['readed_term_of_services']) ? 1:0;    
    $insertArray['post_status'] 			= 'pending';
    $insertArray['post_type'] 				= 'review';
		
	$review_inserted_id = wp_insert_post($insertArray);
	if( !empty($review_inserted_id) ){		
		/****
		* Checking if company exists or not, 
		* if company exists then getting its company id 
		* else creating a new company.
		****/
		$cmp_args1 = array(	'posts_per_page' => -1,
							'post_type' 	 => 'companies',
							'title' 		 => $insertArray['company']
						);
		$companies = get_posts( $cmp_args1 );
		if( !empty($companies) ){
			$company 	= $companies[0];
			$company_id = $company->ID;
		}
		else{
			$company_arg2 = array();
			$company_arg2['post_title'] 	= $insertArray['company'];
			$company_arg2['post_status'] 	= 'pending';
		    $company_arg2['post_type'] 		= 'companies';
		    //$company_arg2['post_category'] 	= array( $data['company_category'] );
		    // An array of IDs of categories we want this post to have.
			$cat_ids = array( $data['company_category'] );
			$cat_ids = array_map( 'intval', $cat_ids );
			$cat_ids = array_unique( $cat_ids );		    
			$company_id = wp_insert_post($company_arg2);
			$term_taxonomy_ids = wp_set_object_terms( $company_id, $cat_ids, 'companiestax' );			
		}
		if(!empty($company_id)){
			update_post_meta( $review_inserted_id, 'REVIEW_COMPANYID', $company_id);
		}
		//END:
		$photos = $videos = '';
		//If files are uploaded and post have been created
		if( !empty($_FILES) && !empty($review_inserted_id) ){
			foreach ($_FILES as $key => $file) {
				$file_nonce = $key."_nonce";				
				$attach_id  = upload_media_to_review_post( $file_nonce, $key, $review_inserted_id );
				if( !empty($attach_id) ){
					if( substr($key, 0,9) == 'add_photo' ){
						$photos .= wp_get_attachment_url( $attach_id )."\n";
						set_post_thumbnail( $review_inserted_id, $attach_id );
					}
					if( substr($key, 0,9) == 'add_video' ){
						$videos .= wp_get_attachment_url( $attach_id )."\n";
					}	
				}
			}
		}
		//saving the form fields in post meta
		update_post_meta( $review_inserted_id, 'review_accepted_terms_conditions', $insertArray['readed_term_of_services'] );
		update_post_meta( $review_inserted_id, 'review_product_or_service', $insertArray['product_or_service'] );
		update_post_meta( $review_inserted_id, 'uploaded_photos', $photos );
		update_post_meta( $review_inserted_id, 'uploaded_videos', $videos );
		//echo $review_inserted_id;
		echo $url = site_url()."/submit-review?screen_no=2&reviewId=$review_inserted_id";
	}
	else{
		echo "Review is not created";
	}
	exit();
}
//Function for step 2
add_action('wp_ajax_review_additional_form', 'review_additional_form_callback');
add_action('wp_ajax_nopriv_review_additional_form', 'review_additional_form_callback');
function review_additional_form_callback(){
	parse_str($_REQUEST['form_json'],$data);
	$reviewId = $_REQUEST['reviewId'];	
	if( !empty($data['ComplaintForm']['full_name']) ){
		$full_name = $data['ComplaintForm']['full_name'];
		update_post_meta($reviewId,'_reviewer_full_name',$full_name);
	}
	if( !empty($data['ComplaintForm']['personal_email']) ){
		$personal_email = $data['ComplaintForm']['personal_email'];
		update_post_meta($reviewId,'_reviewer_email',$personal_email);
	}	
	if( !empty($data['ComplaintForm']['personal_phone']) ){
		$personal_phone = $data['ComplaintForm']['personal_phone'];
		update_post_meta($reviewId,'_reviewer_phone',$personal_phone);
	}
	if( !empty($data['ComplaintForm']['pissedReasonTemp']) ){
		$pissedReasonTemp = $data['ComplaintForm']['pissedReasonTemp'];
		update_post_meta($reviewId,'_unhappy_because',$pissedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['otherPissedReasonTemp']) ){
		$otherPissedReasonTemp = $data['ComplaintForm']['otherPissedReasonTemp'];
		update_post_meta($reviewId,'_unhappy_because_other_reason',$otherPissedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['pleasedReasonTemp']) ){
		$pleasedReasonTemp = $data['ComplaintForm']['pleasedReasonTemp'];
		update_post_meta($reviewId,'_happy_because',$pleasedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['otherPleasedReasonTemp']) ){
		$otherPleasedReasonTemp = $data['ComplaintForm']['otherPleasedReasonTemp'];
		update_post_meta($reviewId,'_happy_because_of_other_reason',$otherPleasedReasonTemp);
	}
	if( !empty($data['ComplaintForm']['monetary_value']) ){
		$monetary_value = $data['ComplaintForm']['monetary_value'];
		update_post_meta($reviewId,'_value_of_loss',$monetary_value);
	}
	if( !empty($data['ComplaintForm']['wanted_solution']) ){
		$wanted_solution = $data['ComplaintForm']['wanted_solution'];
		update_post_meta($reviewId,'_want',$wanted_solution);
	}
	if( !empty($data['ComplaintForm']['other_wanted_solution']) ){
		$other_wanted_solution 	= $data['ComplaintForm']['other_wanted_solution'];
		update_post_meta($reviewId,'_want_other_solution',$other_wanted_solution);
	}
	if( !empty($data['ComplaintForm']['online_business_location']) ){
		$online_business_location 	= $data['ComplaintForm']['online_business_location'];
		update_post_meta($reviewId,'_company_website',$online_business_location);
	}	
	echo $url = site_url()."/submit-review?screen_no=3&reviewId=$reviewId";
	exit();
}

//Function for step 3
add_action('wp_ajax_review_location_form', 'review_location_form_callback');
add_action('wp_ajax_nopriv_review_location_form', 'review_location_form_callback');
function review_location_form_callback(){
	parse_str($_REQUEST['form_json'],$data);	
	$reviewId = $_REQUEST['reviewId'];	
	if( !empty($data['business-type']) ){
		$business_type 	= $data['business-type'];
		//update_field('_bussiness_type', $business_type, $reviewId);
		update_post_meta($reviewId,'_bussiness_type',$business_type);
	}
	if( !empty($data['bussiness-type-url']) ){
		$business_type_url 	= $data['bussiness-type-url'];
		update_post_meta($reviewId,'_company_website',$business_type_url);
		//update_field('_bussiness_type', 'online-bussiness', $reviewId);
	}
	if( !empty($data['location']) ){
		$value = $data['location'];
		$loc = serialize($value);
		//update_field('_bussiness_type', 'offline-bussiness', $reviewId);
		//update_field('_review_location', $value, $reviewId);
		//$location 	= json_encode($data['location']);
		update_post_meta($reviewId,'_review_location',$loc);
	}
	echo $url = site_url()."/submit-review?screen_no=4&reviewId=$reviewId";
	exit();
}

//Function for step 4
add_action('wp_ajax_review_ratting_form', 'review_ratting_form_callback');
add_action('wp_ajax_nopriv_review_ratting_form', 'review_ratting_form_callback');
function review_ratting_form_callback(){
	parse_str($_REQUEST['form_json'],$data);
	$reviewId = $_REQUEST['reviewId'];
	if( !empty($data['rating']['location']) ){
		$location = $data['rating']['location'];
		update_post_meta($reviewId,'_location',$location);
	}
	if( !empty($data['rating']['diversity_of_products']) ){
		$diversity_of_products = $data['rating']['diversity_of_products'];
		update_post_meta($reviewId,'_diversity_of_products_or_services',$diversity_of_products);
	}
	if( !empty($data['rating']['product_service']) ){
		$product_service = $data['rating']['product_service'];
		update_post_meta($reviewId,'_product_or_service_quality',$product_service);
	}
	if( !empty($data['rating']['advertised_vs_delivered']) ){
		$advertised_vs_delivered = $data['rating']['advertised_vs_delivered'];
		update_post_meta($reviewId,'_advertised_vs_delivered',$advertised_vs_delivered);
	}
	if( !empty($data['rating']['website']) ){
		$website = $data['rating']['website'];
		update_post_meta($reviewId,'_website',$website);
	}
	if( !empty($data['rating']['staff']) ){
		$staff = $data['rating']['staff'];
		update_post_meta($reviewId,'_staff',$staff);
	}
	if( !empty($data['rating']['price_affordability']) ){
		$price_affordability = $data['rating']['price_affordability'];
		update_post_meta($reviewId,'_price_affordability',$price_affordability);
	}
	if( !empty($data['rating']['value_of_money']) ){
		$value_of_money = $data['rating']['value_of_money'];
		update_post_meta($reviewId,'_value_for_money',$value_of_money);
	}
	if( !empty($data['rating']['customer_service']) ){
		$customer_service = $data['rating']['customer_service'];
		update_post_meta($reviewId,'_customer_service',$customer_service);
	}
	if( !empty($data['rating']['exchange_policy']) ){
		$exchange_policy = $data['rating']['exchange_policy'];
		update_post_meta($reviewId,'_exchange_refund_and_cancellation_policy',$exchange_policy);
	}
	if( !empty($data['experience']['likes']) ){
		$likes = $data['experience']['likes'];
		update_post_meta($reviewId,'_i_liked',$likes);
	}
	if( !empty($data['experience']['unlikes']) ){
		$unlikes = $data['experience']['unlikes'];
		update_post_meta($reviewId,'_i_did_not_liked',$unlikes);
	}
	if( !empty($data['tags']) ){
		$tags = esc_attr($data['tags']);
		//update_post_meta($reviewId,'_tags',$tags);
		wp_set_post_tags( $reviewId, $tags, true );
	}
	if( !empty($data['companies_consider']) ){
		$companies_consider = $data['companies_consider'];
		update_post_meta($reviewId,'_what_were_other_companies_you_considered',$companies_consider);
	}
	//If user is logged in then assigning this review to that user and redirect to thank you page.
	if( is_user_logged_in() ){
		$user_id = get_current_user_id();
		wp_update_post( array('ID' => $reviewId,'post_author' => $user_id) );
		echo $url = site_url('submit-review?success=true&msg=3'); 
	}
	else{
		echo $url = site_url("signup-and-login?success=true&msg=4&reviewId=$reviewId");
	}	
	exit();
}?>