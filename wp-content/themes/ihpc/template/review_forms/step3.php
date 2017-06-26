<?php
/*
* $reviewId is populating from submitreview.php
* $screen_no is populating from submitreview.php
*/
?>
<form id="step3" method="post" class="custom-form">
	<div class="container">
		<div class="row">
     		<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contact-box">		
               <h2 class="title-p-2">Where It Happened?</h2>
				<label for="offline-business"><input name="business-type" value="offline-bussiness-map" checked="checked" type="radio"> Offline business</label>
				<label for="offline-business" class="ml-10"><input name="business-type" value="online-bussiness-url" type="radio"> Online business</label>
				<div class="clearfix"></div>

				<div class="offline-bussiness-map custom-url-box">
					<p class="hint">Choose company's location from the list or click on a marker.</p>
				</div>
				<div class="online-bussiness-url custom-url-box">
				<div class="col-sm-6">
				    <div class="form-group row">
					  <label for="exampleInputUrl1">Site URL</label>
					  <input type="url" name="bussiness-type-url" class="form-control" id="exampleInputUrl1" placeholder="Please enter your site url">
					</div>
				</div>	
				</div>

			</div>
			<div class="col-md-12">
				<input type="submit" value="Proceed" class="btn form-btn">
				<a href="<?php echo site_url()."/submit-review?screen_no=4&reviewId=$reviewId" ?>" class="btn form-btn ml-10">Didn't find on the map</a>
            	<a href="<?php echo site_url()."/submit-review?screen_no=4&reviewId=$reviewId" ?>" class="btn form-btn ml-10">Skip</a>
			</div>
		</div>
	</div>
</form>


<script type="text/javascript">
jQuery(document).ready(function(){
jQuery('input').on('ifChecked', function(event){
	var inputValue = jQuery(this).attr("value");
	var targetBox = jQuery("." + inputValue);
	jQuery(".custom-url-box").not(targetBox).hide();
	jQuery(targetBox).show();
});
});	
jQuery(document).on('submit', '#step3', function(e){
    e.preventDefault();
    jQuery("#ajax_loader").show();
    var fd      = new FormData();    
    var data    = jQuery(this).serialize();    
    fd.append("form_json", data);
    fd.append("reviewId", <?php echo $reviewId ?>);  
    fd.append('action', 'review_location_form');
    jQuery.ajax({
        type: 'POST',
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
        	jQuery("#ajax_loader").hide();
            window.location.href = response;
            console.log(response);
        }
    });
});
</script>