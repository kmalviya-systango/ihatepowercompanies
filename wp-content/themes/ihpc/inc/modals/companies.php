<!-- Bootstrap modal to filter by category: Start -->
<div class="modal fade ihpc-modal in" id="choose-company" role="dialog">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title"><span class="icon icon-review-company"></span> Companies</h4>
	        </div>
	        <div class="modal-body">	        	
	        		<?php echo get_company_search_box() ?>
					<?php
					$allcompanies = get_companies(-1);
					if(!empty($allcompanies)){
						foreach ($allcompanies as $key => $company) {
							echo "<a class='tags_modal' href='".$company['url']."'>$company[title] 115 </a>";
						}
					}
					else{
						echo "<div class='col-md-12'>No Companies</div>";
					}
					?>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer"></div> 
        </div>
    </div>
</div>