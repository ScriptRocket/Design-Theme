<?php
/**
 * Widgets
 *
 * @package elara
 */
/**
 * Register sidebars and widgets
 *
 * This function is attached to
 * 'widgets_init' action hook.
 */
function elara_widgets_init() {

    /* Default Sidebar Widgets */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Default', 'elara' ),
		'id'            => 'sidebar-default',
		'description'   => esc_html__( 'Add widgets here to appear on all pages below all other page specific sidebar widget areas.', 'elara' ),
		'before_widget' => '<div id="%1$s" class="default-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/* Default Sidebar Widgets */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Default - With Background', 'elara' ),
		'id'            => 'sidebar-default-background',
		'description'   => esc_html__( 'Add widgets here to appear on all pages on the top of all sidebar widget areas.', 'elara' ),
		'before_widget' => '<div id="%1$s" class="default-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/* Front Page Widgets */
	register_sidebar( array(
		'name'          => esc_html__( 'Sidebar - Front Page', 'elara' ),
		'id'            => 'sidebar-frontpage',
		'description'   => esc_html__( 'Shows up only on the front page, between Default Sidebar - With Background and Default Sidebar.', 'elara' ),
		'before_widget' => '<div id="%1$s" class="frontpage-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/* Header Widgets */
	register_sidebar( array(
		'name'          => esc_html__( 'Header - Left', 'elara' ),
		'id'            => 'sidebar-top-left',
		'description'   => esc_html__( 'Add widgets here to appear in the top left area.', 'elara' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header - Center', 'elara' ),
		'id'            => 'sidebar-top-center',
		'description'   => esc_html__( 'Add widgets here to appear in the top center area.', 'elara' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Header - Right', 'elara' ),
		'id'            => 'sidebar-top-right',
		'description'   => esc_html__( 'Add widgets here to appear in the top right area.', 'elara' ),
		'before_widget' => '<div id="%1$s" class="header-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/* Front Page Full Width Widgets */
	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - Full 1', 'elara' ),
		'id'            => 'frontpage-full-1',
		'before_widget' => '<div id="%1$s" class="frontpage-full-1 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Front Page - Full 2', 'elara' ),
		'id'            => 'frontpage-full-2',
		'before_widget' => '<div id="%1$s" class="frontpage-full-2 widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	/* Footer Widgets */
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Columns - Col 1', 'elara' ),
		'id'            => 'footer-columns-col-1',
		'before_widget' => '<div id="%1$s" class="footer-columns-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Columns - Col 2', 'elara' ),
		'id'            => 'footer-columns-col-2',
		'before_widget' => '<div id="%1$s" class="footer-columns-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Columns - Col 3', 'elara' ),
		'id'            => 'footer-columns-col-3',
		'before_widget' => '<div id="%1$s" class="footer-columns-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Columns - Col 4', 'elara' ),
		'id'            => 'footer-columns-col-4',
		'before_widget' => '<div id="%1$s" class="footer-columns-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Columns - Col 5', 'elara' ),
		'id'            => 'footer-columns-col-5',
		'before_widget' => '<div id="%1$s" class="footer-columns-widget widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
}
add_action( 'widgets_init', 'elara_widgets_init' );
