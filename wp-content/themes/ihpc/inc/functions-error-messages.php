<?php
/****
* This function doesnot return anything and just display the message.
****/
function ihpc_errors_display(){
	if( !empty($_GET['success']) && ($_GET['success'] == 'true') ){
		$smsg = $_GET['msg'];
		switch ($smsg) {
			case 1:
				$smsg = "You have successfully registered now, please login to continue"; 
			break;
			case 2:
				$smsg = "We have sent a link to your registered email id, please set your password through it"; 
			break;
			case 3:
				$smsg = "Thanks, for submitting your review we will check and publish it shortly"; 
			break;
			case 4:
				$smsg = "Thanks, for submitting your review please sign up or log in to keep track of your submitted review"; 
			break;
			case 5:
				$smsg = "You have successfully registered now, #$_GET[reviewId] This is your review number. Please refer to it when communicating with the company."; 
			break;
		}  
		echo "<div style='margin-bottom:0' class='alert alert-info text-center'>$smsg</div>";
	}
	elseif( !empty($_GET['success']) && ($_GET['success'] == 'false')){
		$smsg = $_GET['msg'];
		switch ($smsg) {
			case 1:
				$smsg = "Either your username or email is already present"; 
			break;
			case 2:
				$smsg = "Invalid Captcha"; 
			break;
			case 3:
				$smsg = "Password and confirm password are not same"; 
			break;
			case 4:
				$smsg = "Password is incorrect"; 
			break;
			case 'str':
				$smsg = $_GET['str']; 
			break;
			case 'existing_user_login':
				$smsg = "Sorry, that company name or email already exists!"; 
			break;
		} 
		echo "<div style='margin-bottom:0' class='alert alert-danger text-center'>$smsg</div>";
	}
}