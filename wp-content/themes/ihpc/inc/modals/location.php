<!-- Bootstrap modal to filter by location: Start -->
<div class="modal fade ihpc-modal in" id="choose-location" role="dialog">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title">Filter Companies by Location</h4>
	        </div>
	        <div class="modal-body row">
	        	<div class="col-md-12">
	        		<!-- Google auto complete address: Start -->
		            <input onFocus="geolocate()" id="autocomplete" name="location[address]" class="form-control search-input width-100" placeholder="Location" value="" type="text">
		            <input type="hidden" id="glat" name="location[lat]" value="" />
		            <input type="hidden" id="glong" name="location[lng]" value="" />
		            <!-- Google auto complete address: End -->	
		            <?php 
		            $locations = get_locations('companies'); 
		            if( !empty($locations) ){
		            	foreach ($locations as $key => $location) {
		            		if( !empty($location['location']) ){
		            			$loc = $location['location'];
		            			$url = get_current_url().'?location[address]='.$loc['address'].'&location[lat]='.$loc['lat'].'&location[lng]='.$loc['lng'];
		            			echo "<a href='".$url."'>$loc[address]</a>";
		            		}		            		
		            	}
		            }		            
		            ?>			
				</div>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer"></div> 
        </div>
    </div>
</div>
<!-- END -->