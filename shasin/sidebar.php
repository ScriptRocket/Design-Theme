<?php
/**
 * Sidebar - default
 *
 * @package elara
 */
$elara_example_content = elara_get_option( 'elara_example_content' ); ?>

<div class="widget-area widget-area-sidebar col-md-3 col-xs-12" role="complementary">
	<?php
		/**
		 * Default Sidebar With Background
		 */
		if ( is_active_sidebar( 'sidebar-default-background' ) ) : ?>
			<div class="sidebar-default-background">
				<?php dynamic_sidebar( 'sidebar-default-background' ); ?>
			</div><?php
		endif; // is_active_sidebar( 'sidebar-default-background' )
		/**
		 * Page specific sidebars
		 */
		if ( is_front_page() && is_active_sidebar( 'sidebar-frontpage' ) ) : ?>
			<div class="sidebar-default sidebar-frontpage">
				<?php dynamic_sidebar( 'sidebar-frontpage' ); ?>
			</div><?php
		endif;
		/**
		 * Default sidebar
		 */
		if ( is_active_sidebar( 'sidebar-default' ) ) : ?>
			<div class="sidebar-default">
				<?php dynamic_sidebar( 'sidebar-default' ); ?>
			</div><?php
		elseif ( $elara_example_content == 1 ) :
			elara_example_sidebar();
		endif;
	?>
</div><!-- widget-area widget-area-sidebar col-md-3 col-xs-12 -->
