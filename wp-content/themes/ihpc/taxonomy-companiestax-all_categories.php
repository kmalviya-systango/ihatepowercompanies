<?php get_header(); 

$categories = get_ihpc_categories('companiestax',0);

?>

<div class="row">
	<div class="col-sm-8"><h1>All Categories</h1></div>
	<div class="col-sm-4">
		<a href="?tab=by_alphabate"  class="btn btn-bycat pull-right">By Alphabate</a>
		<a href="?tab=by_category" class="btn btn-bycat active mr-15 pull-right">By Category</a>
	</div>
			
	<?php 
		if( ($_GET['tab'] == 'by_alphabate') || !isset($_GET['tab']) ): ?>
		<div class="col-md-12 alfa-list">
		<?php 
			foreach (range('A', 'Z') as $char) {
			    echo "<a href='#".$char."'>".$char."</a>";
			}
		endif;
		?>
		
	</div>
	<div class="clearfix"></div>
	<ul class="list-group-horizontal mt-20">
	<?php			 
		if( ($_GET['tab'] == 'by_category') || !isset($_GET['tab']) ): 
			foreach ($categories as $key => $category) :?>
			
			
				<li class="list-group-item col-sm-4">
						<a class="discript-text" href="<?php echo $category['permalink'] ?>"><?php echo $category['name'] ?></a>
						
						<?php 
							$childCategories = get_ihpc_categories('companiestax',0,$category['term_id']); 
							if( !empty($childCategories) ): 
								echo '<a class="badge-list show-toggle pull-right"><i class="fa fa-caret-down" aria-hidden="true"></i></a>
						<span class="badge badge-list">'.$category['count'].'</span>
<ul class="list-group-horizontal chield row hidden">';
								foreach ($childCategories as $key => $childCategory) : ?>
									<li class="list-group-item ">
										<a href="<?php echo $childCategory['permalink'] ?>"><?php echo $childCategory['name'] ?></a>
										<span class="badge badge-list"><?php echo $childCategory['count'] ?></span>
									</li>
								<?php endforeach; 
								echo '</ul>';
								?>
							<?php endif; ?>

				</li>
		<?php endforeach; ?>
		</ul>
		<?php
		else:			
			foreach (range('A', 'Z') as $char) {
				echo '<div class="col-md-4" id="'.$char.'"><h3>'.$char.'</h3><ul class="list-group by_cat ">';
				foreach ($categories as $key => $category):
					$cat_name = ucfirst((trim($category['name'])) );
					$firstLetter = substr($cat_name, 0,1);
					if($char == $firstLetter){
						echo '<li class="list-group-item">
								<a href="'.$category['permalink'].'">'.$category['name'].'</a>
								<span class="badge badge-list">'.$category['count'].'</span>
							</li>';
					}
				endforeach;
				echo '</ul></div>';
			}
		endif; ?>
</div>

<?php get_footer(); ?>
<script>
$( document ).ready(function() {
$('.by_cat:empty').each(function(){
    if($.trim($(this).html()).length == 0){
		$(this).parent().remove();
    }
});


/*
var alfaList = $('.alfa-list a').each(function () { 
	$(this).attr('href');
});
alert(alfaList);
var horizontalList =  $('.list-group-horizontal div').each(function () { 
       $(this).attr('id');
});
alert(horizontalList );
*/


var maxHeight = Math.max.apply(null, $(".by_cat").map(function ()
{
    return $(this).height();
}).get());

  var highestBox = 0;
$('.by_cat').each(function(){  
	if($(this).height() > highestBox){  
	highestBox = $(this).height();  
}
});    
$('.by_cat').height(highestBox);	


$(".show-toggle").click(function(){
    $(this).next().next().toggleClass('hidden');
});

});
</script>