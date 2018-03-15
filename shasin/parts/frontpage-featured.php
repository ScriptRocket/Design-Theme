<?php
/**
 * Frontpage - Featured Post
 *
 * @package elara
 */
$elara_frontpage_large_post_show = elara_get_option( 'elara_frontpage_large_post_show' );

if ( ! $elara_frontpage_large_post_show ) {
	return;
}

$elara_example_content  = elara_get_option( 'elara_example_content' );
$elara_featured_post_id = elara_get_option( 'elara_frontpage_large_post' );

	$elara_src = wp_get_attachment_image_src( get_post_thumbnail_id( $elara_featured_post_id ), 'elara-slider' ) ;
	$elara_featured_image = '';

	if ( $elara_src ) :
		$elara_featured_image = $elara_src[0];
	elseif ( $elara_example_content == 1 ) :
		$elara_featured_image = elara_get_sample( 'elara-slider' );
	endif;

	$elara_frontpage_featured_categories_show = elara_get_option( 'elara_frontpage_featured_categories_show' );

	if ( ! $elara_frontpage_featured_categories_show ) :
		$elara_class = 'no-section-above';
	else :
		$elara_class = '';
	endif;

if ( $elara_featured_image ) : ?>

	<div class="frontpage-featured <?php echo esc_attr( $elara_class ); ?>">

		<div class="banner" style="background-image:url(<?php echo esc_url( $elara_featured_image ); ?>)">
			<div class="box-caption">
				<p class="box-caption--category"><?php elara_get_entry_first_category(); ?></p>
				<h2><a href="<?php the_permalink( $elara_featured_post_id ); ?>" title="<?php the_title_attribute( array( 'post' => $elara_featured_post_id ) ); ?>"><?php echo esc_html( get_the_title( $elara_featured_post_id ) ); ?></a></h2>
				<p class="box-caption--readmore"><a href="<?php the_permalink( $elara_featured_post_id ); ?>" title="<?php the_title_attribute( array( 'post' => $elara_featured_post_id ) ); ?>" class="btn btn-primary"><?php esc_html_e( 'Read more', 'elara' ); ?></a></p>
			</div>
		</div><!-- banner -->
	</div><!-- frontpage-banner -->

<?php endif;
