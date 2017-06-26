<div class="container">
	<div class="row">
		<div class="col-sm-offset-2 col-md-offset-2 col-sm-offset-2 col-lg-8 col-md-8 col-sm-8 col-xs-12">		
			<form action="" id="step1" method="post" enctype="multipart/form-data" class="custom-form">
				<div class="form-group">
					<label>Review Title<span class="req">*</span></label>
					<input type="text" class="form-control" name="review_title" required="required" placeholder="Your issue in several words." >
				</div>
				<div class="form-group">
					<label for="formGroupExampleInput2">Review Text<span class="req">*</span></label>
					<textarea minlength="100" class="form-control" name="review_text" required="required" placeholder="What exactly happened? Describe your experience in 100+ words..."></textarea>
				</div>
				<div class="form-group upload-flie-video">
					<a href="javascript:void(0);" id="_add-photo"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/add-photo.png"> Add photo </a>
					<input type="file" class="add-photo" name="add_photo[]" multiple />					
 					<a href="javascript:void(0);" id="_add-video"><img src="<?php echo get_stylesheet_directory_uri(); ?>/assets/images/add-video.png"> Add video </a>
					<input type="file" class="add-video" name="add_video[]" multiple accept="video/mp4,video/x-m4v,video/*"/>

				</div>
				<div class="form-group">
					<label>Company<span class="req">*</span></label>
					<input type="text" class="form-control" name="company" required="required" placeholder="Company name." >
				</div>
				<div class="form-group">
					<label>Product or Service</label>
					<input type="text" class="form-control" name="product_or_service"  placeholder="Particular model ID, e.g. Bosch SHX43P15.">
				</div>
				<div class="form-group">
					<label>Category<span class="req">*</span></label>
					<select name="company_category" class="form-control">
						<?php 
						$categories = get_ihpc_categories('companiestax',0);						
						if( !empty($categories) ){
							foreach ($categories as $key => $category) {
								echo '<option value="'.$category['term_taxonomy_id'].'">'.$category['name'].'</option>';
							}
						}						
						?>
					</select>
				</div>
				<div class="form-group">
					<input type="checkbox" required="required" name="readed_term_of_services" value="1"> I have read and agree to the I Hate Power Companies <a href="#">Terms of Services</a>
				</div>
				<div class="from-group">
				<p class="info-text"><small>After submission you will not be able to edit your review. However, we allow adding<br />
					on to it. Just create an account during the submission process.</small></p>
				</div>
				<div class="form-group">					
					<input type="submit" value="Proceed" class="btn form-btn">					
				</div>
			</form>
		</div>
	</div>
</div>
<script type="text/javascript">
jQuery( document ).ready(function() {
	jQuery( "#_add-photo" ).click(function() {
	  jQuery(".add-photo").click();
	});
	jQuery( "#_add-video" ).click(function() {
	  jQuery(".add-video").click();
	});
});

jQuery(document).on('submit', '#step1', function(e){
    e.preventDefault();
    jQuery("#ajax_loader").show();
    var fd 		= new FormData();
    var images 	= jQuery(document).find('input[name="add_photo[]"]');
    var videos 	= jQuery(document).find('input[name="add_video[]"]');
    var data 	= jQuery(this).serialize();
    //Adding photos in data
    for (var i = 0; i < images.length; i++) {
    	var add_image = "add_photo"+"-"+i;
    	fd.append(add_image,images[i].files[0]);
    };
    //Adding videos in data
    for (var i = 0; i < videos.length; i++) {
    	var add_video = "add_video"+"-"+i;
    	fd.append(add_video,videos[i].files[0]);
    };
    fd.append("form_json", data);  
    fd.append('action', 'submit_reivew_form');

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