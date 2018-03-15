<?php
/**
 * Frontpage - Featured Categories
 *
 * @package elara
 */
$elara_frontpage_featured_categories_show = elara_get_option( 'elara_frontpage_featured_categories_show' );

if ( ! $elara_frontpage_featured_categories_show ) {
	return;
}

$elara_example_content                  = elara_get_option( 'elara_example_content' );
$elara_featured_categories_columns      = elara_get_option( 'elara_frontpage_featured_categories_columns' );
$elara_featured_categories_posts_number = elara_get_option( 'elara_frontpage_featured_categories_posts_number' );
/**
 * Set column class based on number of columns
 * @var string
 */
$elara_column_class = elara_set_featured_categories_class( $elara_featured_categories_columns ); ?>

<div class="section-featured-categories widget-area widget-area-frontpage row columns-<?php echo esc_attr( $elara_featured_categories_columns ); ?>">

	<?php
		/**
		 * Loop through columns
		 */
		for ( $elara_i = 1; $elara_i <= $elara_featured_categories_columns; $elara_i++ ) :
			$elara_column_heading  = elara_get_option( 'elara_frontpage_featured_categories_col_' . $elara_i . '_heading' );
			$elara_column_category = elara_get_option( 'elara_frontpage_featured_categories_col_' . $elara_i . '_category' );

			$elara_args = array(
				'cat'            => $elara_column_category,
				'posts_per_page' => $elara_featured_categories_posts_number
			);

			$elara_query = new WP_Query( $elara_args );

			if ( $elara_query->have_posts() ) : ?>

				<div class="<?php echo esc_attr( $elara_column_class ); ?>">
					<h3 class="widget-title"><?php echo esc_html( $elara_column_heading ); ?></h3>

					<div class="featured-category-posts">
						<?php while ( $elara_query->have_posts() ) : $elara_query->the_post(); ?>
							<?php get_template_part( 'parts/entry', 'featured-category' ); ?>
						<?php endwhile; // $elara_query->have_posts() ?>
					</div><!-- featured-category-posts -->
				</div><!-- <?php echo esc_attr( $elara_column_class ); ?> -->

			<?php endif; // $elara_query->have_posts()
			wp_reset_query();

		endfor; // $elara_i = 1; $elara_i <= $elara_featured_categories_columns; $elara_i++
	?>

</div><!-- section-featured-categories row -->
