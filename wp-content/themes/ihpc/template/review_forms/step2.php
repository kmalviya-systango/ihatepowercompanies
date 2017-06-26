<?php
/*
* $reviewId is populating from submitreview.php
* $screen_no is populating from submitreview.php
*/
?>

<form id="step2" action="" method="post" class="custom-form">
  <div class="container">
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contact-box">
        <h2 class="title-p-2"><?php echo $companyName ?> needs additional information in order to contact you.</h2>
        <p class="offset-bottom-primary hint">This information will be available only to the company and will not be publicly shared.</p>
        <div class="form-group">
          <label for="ComplaintForm_full_name">Full Name</label>
          <input class="form-control" name="ComplaintForm[full_name]" id="ComplaintForm_full_name" type="text" maxlength="255">
        </div>
        <div class="form-group">
          <label for="ComplaintForm_personal_email">Your Email</label>
          <input class="form-control" data-rule-required="true" data-rule-email="true" data-msg-required="Please enter your email address" data-msg-email="Please enter a valid email address" name="ComplaintForm[personal_email]" id="ComplaintForm_personal_email" type="email" maxlength="100">
        </div>
        <div class="form-group mb0px">
          <label for="ComplaintForm_personal_phone">Personal Phone</label>
          <input class="form-control" name="ComplaintForm[personal_phone]" id="ComplaintForm_personal_phone" type="tel">
        </div>
      </div>
    </div>
    <div class="row">
      <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 contact-box">
        <div class="col-md-6">
          <div class="mood-reasons-list _unhappy">
            <div class="icon lnr-sad"> <i class="fa fa-frown-o" aria-hidden="true"></i> </div>
            <label><strong>I am unhappy because of</strong></label>
            <ul id="ComplaintForm_pissedReasonTemp">
              <li class="radio-item">
                <input class="radio-btns vertical unhappy _unhappy"  id="ComplaintForm_pissedReasonTemp_0" value="Poor customer service" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_0">Poor customer service</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_1" value="Bad quality" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_1">Bad quality</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_2" value="Problem with delivery" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_2">Problem with delivery</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_3" value="Order processing issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_3">Order processing issue</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_4" value="Pricing issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_4">Pricing issue</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_5" value="Warranty issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_5">Warranty issue</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_6" value="Damaged or defective" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_6">Damaged or defective</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_7" value="Problems with payment" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_7">Problems with payment</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_8" value="Not as described" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_8">Not as described</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_9" value="Return, Exchange or Cancellation Policy" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_9">Return, Exchange or Cancellation Policy</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical unhappy"  id="ComplaintForm_pissedReasonTemp_10" value="Other issue" type="radio" name="ComplaintForm[pissedReasonTemp]">
                <label for="ComplaintForm_pissedReasonTemp_10">Other issue</label>
                <input type="text" class="form-control _other-issue mt-10" value="" id="other-issue-first" />
              </li>
            </ul>
          </div>
        </div>
        <div class="col-md-6">
          <div class="mood-reasons-list _happy">
            <div class="icon lnr-smile"> <i class="fa fa-smile-o" aria-hidden="true"></i> </div>
            <label><strong>I am happy because of</strong></label>
            <ul id="ComplaintForm_pleasedReasonTemp">
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_0" value="Good customer service" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">Good customer service</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_1" value="Good quality" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">Good quality</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_2" value="On time delivery" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">On time delivery</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_3" value="Fast order processing" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">Fast order processing</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_4" value="Fair pricing" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">Fair pricing</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_5" value="Reliable warranty" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">Reliable warranty</label>
              </li>
              <li class="radio-item">
                <input class="radio-btns vertical happy" data-mood="3" id="ComplaintForm_pleasedReasonTemp_6" value="Happy for another reason" type="radio" name="ComplaintForm[pleasedReasonTemp]">
                <label for="">Happy for another reason</label>
              </li>
            </ul>
          </div>
        </div>
        <div class="clearfix"></div>
        <div class="col-sm-6" id="outher-issue-list-box">
          <div class="form-group">
            <label for="ValueOfYourLoss">Value of your loss, $</label>
            <input name="ComplaintForm[monetary_value]" id="ComplaintForm_monetary_value" type="text" maxlength="6" class="form-control" >
            <span class="hint">Only numbers, e.g. 11 or 5000.</span> </div>
			
		<h2>So I want</h2>
          <ul>
            <li class="radio-item">
              <input class="radio-btns" value="Full Refund" type="radio" name="ComplaintForm[wanted_solution]">
              <label>Full Refund</label>
            </li>
            <li class="radio-item">
              <input class="radio-btns" value="Price reduction" type="radio" name="ComplaintForm[wanted_solution]">
              <label>Price reduction</label>
            </li>
            <li class="radio-item">
              <input class="radio-btns" value="Delivery product or service ordered" type="radio" name="ComplaintForm[wanted_solution]">
              <label>Delivery product or service ordered</label>
            </li>
            <li class="radio-item">
              <input class="radio-btns" value="Let the company propose a solution" type="radio" name="ComplaintForm[wanted_solution]">
              <label>Let the company propose a solution</label>
            </li>
            <li class="radio-item">
              <input class="radio-btns" value="Other solution" type="radio" name="ComplaintForm[wanted_solution]">
              <label>Other solution</label>
            </li>
            <li class="radio-item">
              <input name="ComplaintForm[other_wanted_solution]" type="text" maxlength="255">
            </li>
          </ul>
        </div>
      </div>
    </div>
    <div class="row">
      <input type="submit" value="Proceed" class="btn form-btn">
      <a href="<?php echo site_url()."/submit-review?screen_no=3&reviewId=$reviewId" ?>" class="btn form-btn ml-10">Skip</a> </div>
  </div>
</form>
<script type="text/javascript">
jQuery(document).ready(function(){
	jQuery('#ComplaintForm_pissedReasonTemp_10').on('ifChanged', function(event){
		//Check if checkbox is checked or not
		var checkboxChecked = jQuery(this).is(':checked');
	
		if(checkboxChecked) {
			jQuery("#other-issue-first").show();
			jQuery("#outher-issue-list-box").show();			
			
		}else{
			jQuery("#other-issue-first").hide();
			jQuery("#outher-issue-list-box").hide();						
		}
	});
});	
jQuery(document).on('submit', '#step2', function(e){
    e.preventDefault();
    jQuery("#ajax_loader").show();
    var fd      = new FormData();    
    var data    = jQuery(this).serialize();    
    fd.append("form_json", data);
    fd.append("reviewId", <?php echo $reviewId ?>);  
    fd.append('action', 'review_additional_form');
    jQuery.ajax({
        type: 'POST',
        url: "<?php echo admin_url('admin-ajax.php'); ?>",
        data: fd,
        contentType: false,
        processData: false,
        success: function(response){
          jQuery("#ajax_loader").hide();
          window.location.href = response;
          //console.log(response);
        }
    });
});
</script>
