<!-- Bootstrap modal to filter by location: Start -->
<div class="modal fade ihpc-modal in" id="choose-tag" role="dialog">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title">Filter Reviews by Tag</h4>
	        </div>
	        <div class="modal-body row">
	        	<div class="col-md-12">
	        		<div class="search-box ">
						<form action="" method="get" class="clearfix">
							<div class="search-for-car clearfix">
								<div class="inner-search">
									<div class="">
										<input type="text" class="form-control reviewTags" name="tag" placeholder="">
									</div>
								</div>
								<input value="" class="btn-style inner-search-button" type="submit">
							</div>							
						</form>
					</div>					
					<p class="hint mt-10 bootstrap-tagsinput-ex">
						<?php 
			            $terms = ihpc_get_post('review',-1);			            
			            if( !empty($terms) ){
			            	echo "<strong>E.g.</strong>:";
			            	foreach ($terms as $i => $term) {
			            		if( !empty($term['terms']) ){
			            			foreach ($term['terms'] as $j => $obj) {
				            			echo '<span class="tag label label-info">'.$obj->name.'<span data-role="remove"></span></span> ';
				            		}
			            		}			            		
			            	}
			            }
			            ?>	
					</p>
				</div>
			</div>
        </div>            
        <!-- Modal Footer -->
        <div class="modal-footer"></div> 
    </div>
</div>
<!-- END -->