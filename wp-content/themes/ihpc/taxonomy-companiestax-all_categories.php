<?php get_header(); 

$categories = get_ihpc_categories('companiestax',0);

?>

<div class="row">
	<div class="col-md-12"><h1>All Categories</h1></div>
	<div class="col-md-12">
		<a href="?tab=by_category">By Category</a>
		<a href="?tab=by_alphabate" >By Alphabate</a>
	</div>
	<div class="col-md-12">
		<?php 
			foreach (range('A', 'Z') as $char) {
			    echo "<span>".$char."</span>";
			}
		?>
	</div>
	<?php			 
		if( ($_GET['tab'] == 'by_category') || !isset($_GET['tab']) ): 
			foreach ($categories as $key => $category) :?>
				<div class="col-md-4">
					<h3>
						<a href="<?php echo $category['permalink'] ?>"><?php echo $category['name'] ?></a>
						<span><?php echo $category['count'] ?></span>
						<?php 
							$childCategories = get_ihpc_categories('companiestax',0,$category['term_id']); 
							if( !empty($childCategories) ): 
								echo '<ul>';
								foreach ($childCategories as $key => $childCategory) : ?>
									<li>
										<a href="<?php echo $childCategory['permalink'] ?>"><?php echo $childCategory['name'] ?></a>
										<span><?php echo $childCategory['count'] ?></span>
									</li>
								<?php endforeach; 
								echo '</ul>';
								?>
							<?php endif; ?>
					</h3>
				</div>
		<?php endforeach; ?>
		<?php
		else:			
			foreach (range('A', 'Z') as $char) {
				echo '<div class="col-md-4"><h1>'.$char.'</h1><ul>';
				foreach ($categories as $key => $category):
					$cat_name 		= ucfirst((trim($category['name'])) );
					$firstLetter 	= substr($cat_name, 0,1);
					if($char == $firstLetter){
						echo '<li>
								<a href="'.$category['permalink'].'">'.$category['name'].'</a>
								<span>'.$category['count'].'</span>
							</li>';
					}
				endforeach;
				echo '</ul></div>';
			}
		endif; ?>
</div>

<?php get_footer(); ?>
