<?php
/**
 * The template for displaying pages
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package elara
 */
get_header();

$elara_pages_featured_image_show = elara_get_option( 'elara_pages_featured_image_show' ); ?>

<div class="default-background-color">
	<main class="main" role="main">
		<div class="wrapper">
			<div class="row">
				<div class="<?php echo esc_attr( elara_set_main_class() ); ?>">
					<article id="post-<?php the_ID(); ?>" <?php post_class( 'entry-singular' ); ?>>
						<?php
							if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

								<div class="entry-header">
									<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
								</div><?php
								if ( $elara_pages_featured_image_show ) :
									elara_entry_thumbnail( 'elara-slider' );
								endif; ?>

								<div class="entry-content">
									<?php the_content(); ?>
									<?php wp_link_pages(); ?>
								</div><?php

								if ( comments_open() || get_comments_number() ) :
									comments_template();
								endif;

							endwhile; endif;
						?>
					</article><!-- #post-<?php the_ID(); ?> -->
				</div><!-- <?php echo esc_attr( elara_set_main_class() ); ?> -->

				<?php elara_show_sidebar(); ?>
			</div><!-- row -->
		</div><!-- wrapper -->
	</main>
</div><!-- default-background-color -->

<?php get_footer();