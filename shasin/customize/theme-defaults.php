<?php
/**
 * Elara theme defaults
 *
 * @package elara
 */
/**
 * General settings
 */
$elara_defaults['elara_footer_copyright']       = sprintf( __( 'Made by <a href="%s">LyraThemes.com</a>', 'elara' ), esc_url( __( 'https://www.lyrathemes.com/elara/', 'elara' ) ) );
$elara_defaults['elara_example_content']        = 1;
/**
 * Site Identity
 */
$elara_defaults['elara_image_logo_show'] = 0;
$elara_defaults['elara_text_logo']       = esc_html( get_bloginfo( 'name' ) );
$elara_defaults['elara_tagline_show']    = 1;
/**
 * Header Image
 */
$elara_defaults['elara_custom_header'] = esc_url( get_theme_file_uri( '/sample/images/header.jpg' ) );
/**
 * Banner setting
 */
$elara_defaults['elara_banner_heading']     = esc_html( get_bloginfo( 'name' ) );
$elara_defaults['elara_banner_description'] = esc_html( get_bloginfo( 'description' ) );
$elara_defaults['elara_banner_label']       = esc_html__( 'Button Label', 'elara' );
$elara_defaults['elara_banner_url']         = '#';
/**
 * Frontpage > Banner
 */
$elara_defaults['elara_frontpage_banner']                = 'Posts';
$elara_defaults['elara_frontpage_posts_slider_category'] = '1'; // Uncategorized
$elara_defaults['elara_frontpage_posts_slider_number']   = '3';
/**
 * Frontpage > Featured Categories
 */
$elara_defaults['elara_frontpage_featured_categories_show']           = 1;
$elara_defaults['elara_frontpage_featured_categories_columns']        = '2';
$elara_defaults['elara_frontpage_featured_categories_posts_number']   = '3';
$elara_defaults['elara_frontpage_featured_categories_col_1_heading']  = esc_html__( 'Featured Category', 'elara' );
$elara_defaults['elara_frontpage_featured_categories_col_1_category'] = '1'; // Uncategorized
$elara_defaults['elara_frontpage_featured_categories_col_2_heading']  = esc_html__( 'Featured Category', 'elara' );
$elara_defaults['elara_frontpage_featured_categories_col_2_category'] = '1'; // Uncategorized
$elara_defaults['elara_frontpage_featured_categories_col_3_heading']  = esc_html__( 'Featured Category', 'elara' );
$elara_defaults['elara_frontpage_featured_categories_col_3_category'] = '1'; // Uncategorized
/**
 * Frontpage > Highlight Post
 */
$elara_defaults['elara_frontpage_large_post_show'] = 1;
$elara_defaults['elara_frontpage_large_post']      = 1;
/**
 * Blog feed
 */
$elara_defaults['elara_blog_feed_meta_show']        = 1;
$elara_defaults['elara_blog_feed_date_show']        = 1;
$elara_defaults['elara_blog_feed_category_show']    = 1;
$elara_defaults['elara_blog_feed_author_show']      = 1;
$elara_defaults['elara_blog_feed_comments_show']    = 1;
$elara_defaults['elara_blog_feed_sidebar_show']     = 1;
$elara_defaults['elara_blog_feed_sidebar_position'] = 'bottom';
$elara_defaults['elara_category_feed_sidebar_show'] = 1;

/**
 * Posts
 */
$elara_defaults['elara_posts_meta_show']           = 1;
$elara_defaults['elara_posts_date_show']           = 1;
$elara_defaults['elara_posts_category_show']       = 1;
$elara_defaults['elara_posts_author_show']         = 1;
$elara_defaults['elara_posts_tags_show']           = 1;
$elara_defaults['elara_posts_comments_show']       = 1;
$elara_defaults['elara_posts_sidebar']             = 1;
$elara_defaults['elara_posts_sidebar_position']    = 'bottom';
$elara_defaults['elara_posts_featured_image_show'] = 1;
/**
 * Pages
 */
$elara_defaults['elara_pages_sidebar']             = 1;
$elara_defaults['elara_pages_featured_image_show'] = 1;

/**
 * Sample images
 */
/* Thumbnail - 440 x 360 */
$elara_defaults['elara_thumb_sample'][] = esc_url( get_theme_file_uri( '/sample/images/440x360/440x360-1.jpg' ) );
$elara_defaults['elara_thumb_sample'][] = esc_url( get_theme_file_uri( '/sample/images/440x360/440x360-2.jpg' ) );
$elara_defaults['elara_thumb_sample'][] = esc_url( get_theme_file_uri( '/sample/images/440x360/440x360-3.jpg' ) );
$elara_defaults['elara_thumb_sample'][] = esc_url( get_theme_file_uri( '/sample/images/440x360/440x360-4.jpg' ) );

/* Grid - 690 x 900 */
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-1.jpg' ) );
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-2.jpg' ) );
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-3.jpg' ) );
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-4.jpg' ) );
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-5.jpg' ) );
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-6.jpg' ) );
$elara_defaults['elara_grid_sample'][] = esc_url( get_theme_file_uri( '/sample/images/690x900/690x900-7.jpg' ) );

/* Slider - 1470 x 680 */
$elara_defaults['elara_slide_sample'][] = esc_url( get_theme_file_uri( '/sample/images/1470x680/1470x680-1.jpg' ) );
$elara_defaults['elara_slide_sample'][] = esc_url( get_theme_file_uri( '/sample/images/1470x680/1470x680-2.jpg' ) );
$elara_defaults['elara_slide_sample'][] = esc_url( get_theme_file_uri( '/sample/images/1470x680/1470x680-3.jpg' ) );
