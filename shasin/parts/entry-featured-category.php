<?php
/**
 * Template for displaying a post in featured categories section
 *
 * @package elara
 */
$elara_featured_categories_columns = elara_get_option( 'elara_frontpage_featured_categories_columns' );
$elara_blog_feed_sidebar_show      = elara_get_option( 'elara_blog_feed_sidebar_show' ); ?>

<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-featured-category matcheight' ); ?>>

	<?php elara_entry_thumbnail( 'elara-thumbnail', true ); ?>

	<div class="entry-featured-category-content">

		<?php
			/**
			 * 1 column layout - full title
			 */
			if ( $elara_featured_categories_columns == 1 ) :
				elara_entry_title(); ?>
				<p><?php the_excerpt(); ?></p>
		<?php
			/**
			 * 2 columns layout
			 */
			elseif ( $elara_featured_categories_columns == 2 ) :
				$elara_more = sprintf( '<p class="entry-excerpt-more"><a class="read-more" href="%1$s">%2$s %3$s</a></p>',
					esc_url( get_permalink( get_the_ID() ) ),
					esc_html__( 'Read More', 'elara' ),
					elara_fontawesome_icon( 'long-arrow-right', false )
				);
				/**
				 * If sidebar is on, show just 4 words of title,
				 * otherwise show full
				 */
				if ( $elara_blog_feed_sidebar_show ) : ?>
					<h3 class="entry-title">
						<a href="<?php the_permalink(); ?>" rel="bookmark">
							<?php echo wp_trim_words( esc_html( get_the_title() ), 4 ); ?>
						</a>
					</h3>
					<p><?php echo wp_trim_words( esc_html( get_the_excerpt() ), 18, '&hellip;' ); ?></p>
					<?php
				else :
					elara_entry_title(); ?>
					<p><?php echo wp_trim_words( esc_html( get_the_excerpt() ), 24, '&hellip;' ); ?></p>
				<?php endif;
			/**
			 * 3 columns layout - 4 words of title
			 */
			elseif ( $elara_featured_categories_columns == 3 ) : ?>
				<h3 class="entry-title">
					<a href="<?php the_permalink(); ?>" rel="bookmark">
						<?php the_title(); ?>
					</a>
				</h3>
                <p><?php echo wp_trim_words( esc_html( get_the_excerpt() ), 9, '&hellip;' ); ?></p>
		<?php endif; // $elara_featured_categories_columns == 1 ?>
	</div><!-- entry-featured-category-content -->

	<?php
		/**
		 * Get video modal for video post format
		 */
		get_template_part( 'parts/entry', 'video-modal' );
	?>
</article><!-- #post-<?php the_ID(); ?> -->
