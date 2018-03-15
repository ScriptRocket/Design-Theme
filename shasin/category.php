<?php
/**
 * Category template file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package elara
 */
get_header(); ?>

<div class="default-background-color">
	<main class="main" role="main">
		<div class="wrapper">

				<div class="row">
					<div class="<?php echo esc_attr( elara_set_main_class() ); ?>">
						<div class="archive-header">
							<h2><?php single_cat_title(); ?></h2>
							<?php the_archive_description(); ?>
						</div>
						<?php get_template_part( 'parts/feed' ); ?>
					</div><!-- <?php echo esc_attr( elara_set_main_class() ); ?> -->

					<?php elara_show_sidebar(); ?>
				</div><!-- row -->

		</div><!-- wrapper -->
	</main>
</div><!-- default-background-color -->

<?php get_footer();