<?php
/**
 * Frontpage Banner, Slider
 *
 * @package elara
 */
$elara_frontpage_banner = elara_get_option( 'elara_frontpage_banner' );
$elara_example_content  = elara_get_option( 'elara_example_content' );

if ( $elara_frontpage_banner == 'Hide' ) :
	return;

elseif ( $elara_frontpage_banner == 'Posts' ) :

	$elara_frontpage_posts_slider_category = elara_get_option( 'elara_frontpage_posts_slider_category' );
	$elara_frontpage_posts_slider_number   = elara_get_option( 'elara_frontpage_posts_slider_number' );
	$elara_args = array(
		'posts_per_page' => $elara_frontpage_posts_slider_number,
		'category__in'   => $elara_frontpage_posts_slider_category
	);
	$elara_query = new WP_Query( $elara_args );

	if ( $elara_query->have_posts() && ( $elara_query->found_posts > 1 ) ) : ?>

		<div class="frontpage-slider frontpage-slider-posts">

				<div class="slick-carousel">
					<?php
						/**
						 * Start loop
						 */
						while ( $elara_query->have_posts() ) : $elara_query->the_post();

							$elara_src = wp_get_attachment_image_src( get_post_thumbnail_id( get_the_ID() ), 'elara-slider' ) ;
							$elara_featured_image = '';

							if ( $elara_src ) :
								$elara_featured_image = $elara_src[0];
							elseif ( $elara_example_content == 1 ) :
								$elara_featured_image = elara_get_sample( 'elara-slider' );
							endif;

						if ( $elara_featured_image ) :
							// Get image size so that we can calculate aspect ratio
							$elara_image_info = getimagesize( $elara_featured_image );

							if ( is_array( $elara_image_info ) ) :
								// Translators: height / width
								$elara_aspect_ratio = $elara_image_info[1] / $elara_image_info[0];
								$elara_padding = $elara_aspect_ratio * 100;
							else :
								// Keep 16:9 ratio
								$elara_padding = 56.25;
							endif;
							?>

							<div class="slick-slide">
								<div class="slide-image" style="background-image:url(<?php echo esc_url( $elara_featured_image ); ?>); padding-top: <?php echo esc_attr( $elara_padding ); ?>%"></div>
								<div class="box-caption">
									
									<h2><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
									
									<!--<div class="box-caption--excerpt">
										<?php
											/*
											 * Remove excerpt_more filter that adds "Read more" link
											 * and add just "...".
											 
											remove_filter( 'excerpt_more', 'elara_excerpt_more' );
											add_filter( 'excerpt_more', 'elara_slider_excerpt_more' );
											the_excerpt();
											
											 * Remove excerpt_more filter that adds "..." and put back
											 * the one with "Read more" link - used in archives loops.
											 */
											remove_filter( 'excerpt_more', 'elara_slider_excerpt_more' );
											add_filter( 'excerpt_more', 'elara_excerpt_more' );
										?>
									</div>-->
									<p class="box-caption--readmore"><a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>" class="btn btn-primary"><?php esc_html_e( 'See more', 'elara' ); ?></a></p>
								</div>
							</div>

						<?php endif; // $elara_featured_image
					endwhile; // $elara_query->have_posts() ?>
				</div><!-- slick-carousel -->

		</div><!-- frontpage-slider -->

	<?php endif; // $elara_query->have_posts()

elseif ( $elara_frontpage_banner == 'Banner' ) :
	$elara_header_image       = get_header_image();
	$elara_banner_heading     = elara_get_option( 'elara_banner_heading' );
	$elara_banner_description = elara_get_option( 'elara_banner_description' );
	$elara_banner_url         = elara_get_option( 'elara_banner_url' );
	$elara_banner_label       = elara_get_option( 'elara_banner_label' );

	if ( $elara_header_image ) : ?>
		<div class="frontpage-banner">

				<div class="banner" style="background-image:url(<?php echo esc_url( $elara_header_image ); ?>)">
					<div class="box-caption">
						<?php if ( $elara_banner_url && $elara_banner_heading ) : ?>
							<h2><a href="<?php echo esc_url( $elara_banner_url ); ?>"><?php echo esc_html( $elara_banner_heading ); ?></a></h2>
						<?php elseif ( ! $elara_banner_url && $elara_banner_heading ) : ?>
							<h2><?php echo esc_html( $elara_banner_heading ); ?></h2>
						<?php endif; // $elara_banner_url && $elara_banner_heading ?>

						<?php if ( $elara_banner_description ) : ?>
							<div class="box-caption--excerpt">
								<p><?php echo esc_html( $elara_banner_description ); ?></p>
							</div>
						<?php endif; // $elara_banner_description ?>

						<?php if ( $elara_banner_url && $elara_banner_label ) : ?>
							<p class="box-caption--readmore">
								<a href="<?php echo esc_url( $elara_banner_url ); ?>" title="<?php echo esc_attr( $elara_banner_heading ); ?>" class="btn btn-primary"><?php echo esc_html( $elara_banner_label ); ?></a>
							</p>
						<?php endif; ?>
					</div><!-- box-caption -->
				</div><!-- banner -->

		</div><!-- frontpage-banner -->
	<?php endif; // $elara_header_image != ''

endif; // $elara_frontpage_banner
wp_reset_query();