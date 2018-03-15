<?php
/**
 * The main template file
 *
 * This is the most generic template file in a WordPress theme
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
					<?php get_template_part( 'parts/feed' ); ?>
				</div><!-- <?php echo esc_attr( elara_set_main_class() ); ?> -->

				<?php elara_show_sidebar(); ?>
			</div><!-- row -->
		</div><!-- wrapper -->
	</main>
</div><!-- default-background-color -->

<?php get_footer();