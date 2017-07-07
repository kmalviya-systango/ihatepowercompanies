<?php
/****
* This function will return all the information related to the company
****/
function get_company_review($company_id){
	$args = array(	'posts_per_page' => -1,
					'post_type'	=> 'review',
					'meta_key'     => 'REVIEW_COMPANYID',
					'meta_value'   => $company_id,
					'meta_compare' => '='
				);
	$i = 0;
	$returnArray 	= array( 'i_like' => array(), 'i_didnot_like' => array() );
	$ratingLocation = $ratingDP = $ratingA = $ratingW = $ratingS = $ratingPA = $ratingVM = $ratingER = $loss = array();
	$the_query 		= new WP_Query( $args );
	if ( $the_query->have_posts() ) {		
		while ( $the_query->have_posts() ) {
			$the_query->the_post();
			$review_id 	= get_the_ID();
			//An array of liked elements
			$iLiked 	= get_post_meta($review_id,'_i_liked',true);
			if( !empty($iLiked) ){
				$iLiked = explode(",", $iLiked);
				foreach ($iLiked as $key => $like) {
					if( !array_key_exists($like, $returnArray['i_like']) ){
						$returnArray['i_like'][$like] = 1;
					}
					else{
						$returnArray['i_like'][$like] = $returnArray['i_like'][$like] + 1;	
					}
				}
			}
			//An array of unliked elements
			$iUnLiked 	= get_post_meta($review_id,'_i_did_not_liked',true);
			if( !empty($iUnLiked) ){
				$iUnLiked = explode(",", $iUnLiked);
				foreach ($iUnLiked as $key => $unLike) {
					if( !array_key_exists($unLike, $returnArray['i_didnot_like']) ){
						$returnArray['i_didnot_like'][$unLike] = 1;
					}
					else{
						$returnArray['i_didnot_like'][$unLike] = $returnArray['i_didnot_like'][$unLike] + 1;	
					}
				}
			}				

			$returnArray['reviews'][$review_id]['review_title'] = get_the_title($review_id);
			$returnArray['reviews'][$review_id]['review_permalink'] = get_the_permalink($review_id);
			$returnArray['reviews'][$review_id]['rating_location'] = $ratingLocation[] = get_post_meta($review_id,'_location',true);
			$returnArray['reviews'][$review_id]['rating_diversity_product'] = $ratingDP[] = get_post_meta($review_id,'_diversity_of_products_or_services',true);
			$returnArray['reviews'][$review_id]['rating_advertised'] = $ratingA[] 	= get_post_meta($review_id,'_advertised_vs_delivered',true);
			$returnArray['reviews'][$review_id]['rating_website'] = $ratingW[] = get_post_meta($review_id,'_website',true);
			$returnArray['reviews'][$review_id]['rating_staff'] = $ratingS[] = get_post_meta($review_id,'_staff',true);
			$returnArray['reviews'][$review_id]['rating_price_affordability'] = $ratingPA[] = get_post_meta($review_id,'_price_affordability',true);
			$returnArray['reviews'][$review_id]['rating_value_for_money'] = $ratingVM[] = get_post_meta($review_id,'_value_for_money',true);
			$returnArray['reviews'][$review_id]['rating_exchange_refund'] = $ratingER[] = get_post_meta($review_id,'_exchange_refund_and_cancellation_policy',true);
			$returnArray['reviews'][$review_id]['i_liked'] = $iLiked;
			$returnArray['reviews'][$review_id]['i_did_not_liked'] = $iUnLiked;
			$returnArray['reviews'][$review_id]['tags'] = get_post_meta($review_id,'_tags',true);
			$returnArray['reviews'][$review_id]['other_companies'] = get_post_meta($review_id,'_what_were_other_companies_you_considered',true);
			$returnArray['reviews'][$review_id]['_value_of_loss'] = $loss[] = get_post_meta($review_id,'_value_of_loss',true);
			$returnArray['reviews'][$review_id]['ihpc_post_views'] = get_post_meta($review_id,'ihpc_post_views',true);
			$i++;	
		}
		//Calculations
		$returnArray['calculations']['average_location_ratting'] 	= array_sum($ratingLocation)/count($ratingLocation);
		$returnArray['calculations']['average_diversity_product_ratting'] = array_sum($ratingDP)/count($ratingDP);
		$returnArray['calculations']['average_advertised_ratting'] 	= array_sum($ratingA)/count($ratingA);
		$returnArray['calculations']['average_website_ratting'] 	= array_sum($ratingW)/count($ratingW);
		$returnArray['calculations']['average_staff_ratting'] 		= array_sum($ratingS)/count($ratingS);
		$returnArray['calculations']['average_price_affordability_ratting'] = array_sum($ratingPA)/count($ratingPA);
		$returnArray['calculations']['average_value_for_money_ratting'] = array_sum($ratingVM)/count($ratingVM);
		$returnArray['calculations']['average_exchange_refund_ratting'] = array_sum($ratingER)/count($ratingER);
		$sumOfAllRattings = array_merge($ratingLocation,$ratingDP,$ratingA,$ratingW,$ratingS,$ratingPA,$ratingVM,$ratingER);
		$returnArray['calculations']['star_ratting'] = array_sum($sumOfAllRattings)/count($sumOfAllRattings);
		$total_loss 	= array_sum($loss);
		$average_loss 	= array_sum($loss)/count($loss);
		$returnArray['calculations']['total_loss'] 	 = empty($total_loss) ? 0 : $total_loss;
		$returnArray['calculations']['average_loss'] = empty($average_loss) ? 0 : $average_loss;
		$returnArray['calculations']['total_loss_metric'] 	 = ihpc_human_number($total_loss,0,'metric');
		$returnArray['calculations']['average_loss_metric']  = ihpc_human_number($average_loss,0,'metric');
		wp_reset_postdata();
	}
	return $returnArray;
}