<?php 
/****
* Getting all the categories of company
*****/
$categories = get_ihpc_categories('companiestax',0); ?>
<!-- Bootstrap modal to filter by category: Start -->
<div class="modal fade ihpc-modal in" id="choose-category" role="dialog">
	<div class="modal-dialog modal-lg">
        <div class="modal-content">
        	<div class="modal-header" style="border-bottom: 0;">
	              <button type="button" class="close" data-dismiss="modal">
	                     <span aria-hidden="true">×</span>
	                     <span class="sr-only">Close</span>
	              </button>
	              <h4 class="modal-title">Filter Companies by Category</h4>
	        </div>
	        <div class="modal-body row">
	        	<div class="col-md-12">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#brief_categories">Brief</a></li>
						<li><a data-toggle="tab" href="#details_categories">Details</a></li>
					</ul>
					<div class="tab-content">
						<div id="brief_categories" class="tab-pane fade in active">
							<?php 
							foreach ($categories as $key => $category) :?>			
								<li class="list-group-item col-sm-4">
									<a class="discript-text" href="<?php echo site_url('companies?category_filter=').$category['term_id'] ?>"><?php echo $category['name'] ?></a>						
									<?php 
										$childCategories = get_ihpc_categories('companiestax',0,$category['term_id']); 
										if( !empty($childCategories) ): 
											echo '<a class="badge-list show-toggle pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
												<span class="badge badge-list">'.$category['count'].'</span>
												<ul class="list-group-horizontal chield row hidden">';
												foreach ($childCategories as $key => $childCategory) : ?>
													<li class="list-group-item ">
														<a href="<?php echo site_url('companies?category_filter=').$childCategory['term_id'] ?>"><?php echo $childCategory['name'] ?></a>
														<span class="badge badge-list"><?php echo $childCategory['count'] ?></span>
													</li>
											<?php endforeach; 
											echo '</ul>';
											?>
										<?php endif; ?>
								</li>
							<?php endforeach; ?>
						</div>
						<div id="details_categories" class="tab-pane fade">
							<?php 
								foreach (range('A', 'Z') as $char) {
									echo '<div class="col-md-4" id="'.$char.'"><h3>'.$char.'</h3><ul class="list-group by_cat ">';
									foreach ($categories as $key => $category):
										$cat_name = ucfirst((trim($category['name'])) );
										$firstLetter = substr($cat_name, 0,1);
										if($char == $firstLetter){
											echo '<li class="list-group-item">
													<a href="'.site_url('companies?category_filter=').$category['term_id'].'">'.$category['name'].'</a>
													<span class="badge badge-list">'.$category['count'].'</span>
												</li>';
										}
									endforeach;
									echo '</ul></div>';
								}
							?>
						</div>					
					</div>
				</div>
            </div>            
            <!-- Modal Footer -->
            <div class="modal-footer"></div> 
        </div>
    </div>
</div>
<!-- END -->