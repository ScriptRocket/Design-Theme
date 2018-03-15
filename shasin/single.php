<?php
/**
 * The template for displaying pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package elara
 */
get_header();
$elara_posts_sidebar_position   = elara_get_option( 'elara_posts_sidebar_position' );
$elara_posts_meta_show           = elara_get_option( 'elara_posts_meta_show' );
$elara_posts_featured_image_show = elara_get_option( 'elara_posts_featured_image_show' );
$elara_posts_sidebar             = elara_get_option( 'elara_posts_sidebar' );
$elara_posts_tags_show           = elara_get_option( 'elara_posts_tags_show' );

if ( $elara_posts_sidebar ) {
	$elara_row_class = 'post-sidebar-on';
} else {
	$elara_row_class = 'post-sidebar-off';
}
?>

<div class="default-background-color">
	<main class="main" role="main">
		<div class="wrapper">
				<?php
					if ( $elara_posts_sidebar_position == 'bottom' || ! $elara_posts_sidebar ) :
						/**
						 * Featured image
						 */
						if ( $elara_posts_featured_image_show ) :
							elara_entry_thumbnail( 'elara-slider' );
						endif;
					endif;
				?>
				<div class="row <?php echo esc_attr( $elara_row_class ); ?>">
					<div class="col-md-9 col-xs-12 entry-singular-wrapper">
						<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-singular' ); ?>>
							<?php
								if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

									<footer class="entry-meta">
										<div>
											<?php elara_entry_categories(); ?>
											<?php elara_entry_separator( 'categories-date' ); ?>
											<?php elara_entry_date(); ?>
										</div>
									</footer>

									<header class="entry-header">
										<?php elara_entry_title(); ?>
										<?php elara_entry_author(); ?>
									</header>

                                    <?php
										if ( $elara_posts_sidebar_position == 'top' && $elara_posts_sidebar ) :
											if ( $elara_posts_featured_image_show ) :
												elara_entry_thumbnail( 'elara-slider' );
											endif;
										endif;
									?>

									<div class="entry-content">
										<?php the_content(); ?>
										<?php wp_link_pages(); ?>
									</div>

									<footer class="entry-meta">
										<?php
											if ( $elara_posts_meta_show && $elara_posts_tags_show && has_tag() ) :
												the_tags( '<h3 class="section-title">' . esc_html__( 'Tags', 'elara' ) . '</h3><ul><li class="list-item-separators">', '</li><li class="list-item-separators">', '</li></ul>' );
											endif;
										?>
									</footer>

								<?php
									/**
									 * Post navigation
									 */
									get_template_part( 'parts/navigation', 'single' );

									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;
								endwhile; endif;
							?>
						</article><!-- #post-<?php the_ID(); ?> -->
					</div><!-- col-md-9 col-xs-12 entry-singular-wrapper -->

					<?php elara_show_sidebar(); ?>
				</div><!-- row -->
		</div><!-- wrapper -->
	</main>
</div><!-- default-background-color -->

<?php get_footer();