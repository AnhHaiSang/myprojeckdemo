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

 

<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>" id="form_search">
	<label for="<?php echo $unique_id; ?>">
		<span class="screen-reader-text">
			<?php echo _x( 'Search for:', 'label', 'twentyseventeen' ); ?>
		</span>
	</label>
	<input type="search" id="<?php echo $unique_id; ?>" class="search-field" placeholder="<?php echo esc_attr_x( 'Search Blog', 'placeholder', 'twentyseventeen' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" class="search-submit">
		<span class="screen-reader-text">
			<?php echo _x( '<i class="icons-c-u icon-s-c-u001-search-1"></i>', 'submit button', 'twentyseventeen' ); ?>
		</span>
	</button>
</form>
