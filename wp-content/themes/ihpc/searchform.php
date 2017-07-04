<?php
/**
 * Template for displaying search forms in Twenty Seventeen
 *
 * @package WordPress
 * @subpackage Twenty_Seventeen
 * @since 1.0
 * @version 1.0
 */
?>

<?php $unique_id = esc_attr( uniqid( 'search-form-' ) ); ?>



<form role="search" method="get" class="search-form mb-10" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	 <div class="input-group col-sm-4 col-sm-offset-4">
		<input type="search" id="<?php echo $unique_id; ?>" class="form-control search-field" placeholder="<?php echo esc_attr_x( 'Search &hellip;', 'placeholder', 'ihpc' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />			  
              <span class="input-group-btn">
                  <button type="submit" class="search-submit btn btn-search">Search</button>
              </span>
          </div>
</form>
