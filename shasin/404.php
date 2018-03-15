<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package elara
 */
get_header(); ?>

<div class="default-background-color">
	<main class="main" role="main">
		<div class="wrapper">
			<div class="row">
				<div class="col-xs-12 sidebar-off">
					<div class="error-404">
						<h1 class="entry-title"><?php esc_html_e( '404', 'elara' ); ?></h1>
						<h3><?php esc_html_e( 'Page Not Found', 'elara' ); ?></h3>
					</div>
				</div><!-- col-xs-12 sidebar-off -->
			</div><!-- row -->
		</div><!-- wrapper -->
	</main>
</div><!-- default-background-color -->

<?php get_footer();