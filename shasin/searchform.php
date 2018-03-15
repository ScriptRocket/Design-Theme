<?php
/**
 * The template for displaying the search form
 *
 * @package elara
 */
?>
<form role="search" method="get" class="search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<input type="search" class="search-field" value="<?php echo esc_attr( get_search_query() ); ?>" name="s" placeholder="<?php esc_attr_e( 'Search', 'elara' ); ?>" />
	<button type="submit" class="search-submit">
		<?php elara_fontawesome_icon( 'search' ); ?>
		<span><?php esc_html_e( 'Search', 'elara' ); ?></span>
	</button>
</form>