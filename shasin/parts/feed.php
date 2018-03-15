<?php
/**
 * The loop / blog feed
 *
 * @package elara
 */
?>

<div id="blog-feed" class="section-feed row">
	<?php
		/**
		 * The loop
		 *
		 * For covering all customizer options from above, take a look at elara's feed.php
		 */
		if ( have_posts() ) : while ( have_posts() ) : the_post();

			get_template_part( 'content', get_post_format() );

		endwhile; endif;
	?>
</div><!-- section-feed row -->

<?php
	/**
	 * Posts pagination
	 */

	
	get_template_part( 'parts/pagination', 'archive' );
