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
				<label for="offline-business"><input name="business-type" data-target="offlineBussiness" value="offline-bussiness" checked="checked" class="displayToggle" type="radio"> Offline business</label>
				<label for="offline-business" class="ml-10"><input name="business-type" data-target="onlineBussiness" value="online-bussiness" class="displayToggle" type="radio"> Online business</label>
				<div class="clearfix"></div>				
				<div id="onlineBussiness" style="display:none" class="hideTmp online-bussiness-url-url-box">
    				<div class="col-sm-6">
    				    <div class="form-group row">
    					  <label for="exampleInputUrl1">Site URL</label>
    					  <input type="url" name="bussiness-type-url" class="form-control" id="exampleInputUrl1" placeholder="Please enter your site url">
    					</div>
    				</div>	
				</div>
                <div id="offlineBussiness" class="hideTmp offline-bussiness-map custom-url-box">
                    <p class="hint">Choose company's location from the list or click on a marker.</p>                   
                    <div class="row">
                        <div class="col-sm-12">
                           <input id="place_search" type="text" name="location[address]" class="form-control gllpSearchField" placeholder="Enter a location">
                        </div>
                    </div>
                   <br/>
                   <div id="map" class="col-sm-12" style="min-height:600px;"></div>                 
                </div>
			</div>
			<div class="col-md-12">
                <input type="hidden" id="glat" name="location[lat]" value="" />
                <input type="hidden" id="glong" name="location[lng]" value="" />
				<input type="submit" value="Proceed" class="btn form-btn">                
				<a href="<?php echo site_url()."/submit-review?screen_no=4&reviewId=$reviewId" ?>" class="btn form-btn ml-10">Didn't find on the map</a>
            	<a href="<?php echo site_url()."/submit-review?screen_no=4&reviewId=$reviewId" ?>" class="btn form-btn ml-10">Skip</a>
			</div>
		</div>
	</div>
</form>
<script type="text/javascript">
jQuery(document).ready(function(){
    jQuery('.displayToggle').on('click', function(event){
        var targetBox = jQuery(this).attr("data-target");
        jQuery(".hideTmp").hide();
        jQuery("#"+targetBox).toggle();
    });
	gmapM();
});

function gmapM() {
    var latlng = new google.maps.LatLng(51.4975941, -0.0803232);
    var map = new google.maps.Map(document.getElementById('map'), {
        center: latlng,
        zoom: 11,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var marker = new google.maps.Marker({
        position: latlng,
        map: map,
        title: 'Set lat/lon values for this property',
        draggable: true
    });
    var input = document.getElementById('place_search');
    var autocomplete = new google.maps.places.Autocomplete(input);
    // Bind the map's bounds (viewport) property to the autocomplete object,
    // so that the autocomplete requests use the current map bounds for the
    // bounds option in the request.
    autocomplete.bindTo('bounds', map);
    // var marker = new google.maps.Marker({
    //           map: map,
    //           anchorPoint: new google.maps.Point(0, -29)
    //         });
    autocomplete.addListener('place_changed', function() {
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert("No details available for input: '" + place.name + "'");
            return;
        }
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17); // Why 17? Because it looks good.
        }
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        set_modal_lat_long(place.geometry.location.lat()
            .toFixed(6), place.geometry.location.lng().toFixed(6))
        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
            ].join(' ');
        }
    });
    google.maps.event.addListener(marker, 'dragend', function(a) {
        set_modal_lat_long(a.latLng.lat().toFixed(6), a.latLng.lng().toFixed(6))

        // console.log(a);
        // var div = document.createElement('div');
        // div.innerHTML = a.latLng.lat().toFixed(4) + ', ' + a.latLng.lng().toFixed(4);
        // document.getElementsByTagName('body')[0].appendChild(div);
    });
    google.maps.event.addListener(marker, 'drag', function(a) {
        set_modal_lat_long(a.latLng.lat().toFixed(6), a.latLng.lng().toFixed(6))
    });
};

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
        }
    });
});
</script>