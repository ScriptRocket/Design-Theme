<?php
/**
 * Elara functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Elara
 */

/**
 * Customizer
 *
 * This theme uses Kirki customizer
 * @link https://aristath.github.io/kirki/
 */
if ( ! class_exists( 'Kirki' ) ) {
	include_once( dirname( __FILE__ ) . '/inc/elara-kirki.php' ); // fallback
	include_once( dirname( __FILE__ ) . '/inc/elara-kirki-installer.php' ); // installer
}
require get_parent_theme_file_path( '/customize/theme-defaults.php' );
require get_parent_theme_file_path( '/customize/customizer.php' );

/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Tunction is attached to 'after_setup_theme' action hook.
 */
function elara_setup() {
	global $elara_defaults;

	// Make theme available for translation.
	load_theme_textdomain( 'elara' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	 * Let WordPress manage the document title.
	 * @link https://codex.wordpress.org/Title_Tag
	 */
	add_theme_support( 'title-tag' );

	/**
	 * Enable support for Post Thumbnails on posts and pages.
	 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
	 */
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 690, 900, true );
	add_image_size( 'elara-slider', 1470, 680, true );
	add_image_size( 'elara-archive', 690, 900, true ); // used for blog and category archive
	add_image_size( 'elara-thumbnail', 440, 360, true ); // used for featured categories columns

	/**
	 * Register menus
	 * @link https://developer.wordpress.org/themes/functionality/navigation-menus/
	 */
	register_nav_menus( array(
		'header' => esc_html__( 'Main Menu', 'elara' ),
	) );

	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'comment-list',
		'gallery',
		'caption',
	) );

	/**
	 * Enable support for Post Formats.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/post-formats/
	 */
	add_theme_support( 'post-formats', array( 'video' ) );

	/**
	 * Add theme support for Custom Logo.
	 * @link https://developer.wordpress.org/themes/functionality/custom-logo/
	 */
	add_theme_support( 'custom-logo', array(
		'width'       => 300,
		'height'      => 150,
		'flex-width'  => true,
		'flex-height' => true
	) );

	/**
	 * Add theme support for Custom Background.
	 * @link https://codex.wordpress.org/Custom_Backgrounds
	 */
	add_theme_support( 'custom-background' );

	/**
	 * Add theme support for Custom Header.
	 * @link https://developer.wordpress.org/themes/functionality/custom-headers/
	 */
	$args = array(
		'width'         => 1470,
		'height'        => 680,
		'flex-height'   => true,
		'flex-width'    => true,
		'header-text'   => false,
		'default-image' => $elara_defaults['elara_custom_header'],
	);
	add_theme_support( 'custom-header', $args );
	/**
	 * Add support for page excerpts
	 * @link https://developer.wordpress.org/reference/functions/add_post_type_support/
	 */
	add_post_type_support( 'page', 'excerpt' );

	// Set and filter the default content width
	$GLOBALS['content_width'] = apply_filters( 'elara_content_width', 1200 );
}
add_action( 'after_setup_theme', 'elara_setup' );

/**
 * Register Google fonts.
 *
 * @return string Returns url for Google fonts
 */
function elara_fonts_url() {
	$fonts_url = '';

	$font_families = array();

	$font_families[] = 'Poppins:300,400,500,600';
	$font_families[] = 'Playfair Display:400,400i,700,700i,900';

	$query_args = array(
		'family' => urlencode( implode( '|', $font_families ) ),
		'subset' => urlencode( 'latin,latin-ext' ),
	);

	$fonts_url = add_query_arg( $query_args, 'https://fonts.googleapis.com/css' );

	return esc_url_raw( $fonts_url );
}
/**
 * Add preconnect for Google Fonts.
 *
 * @param array  $urls           URLs to print for resource hints.
 * @param string $relation_type  The relation type the URLs are printed.
 * @return array $urls           URLs to print for resource hints.
 */
function elara_resource_hints( $urls, $relation_type ) {
	/**
	 * Preconnect Google fonts
	 */
	if ( 'preconnect' === $relation_type ) {
		$urls[] = array(
			'href' => 'https://fonts.gstatic.com',
			'crossorigin',
		);
	}

	return $urls;
}
add_filter( 'wp_resource_hints', 'elara_resource_hints', 10, 2 );
/**
 * Enqueue scripts and styles.
 *
 * This function is attached to 'wp_enqueue_scripts'
 * action hook. Avoid loading files which
 * are already in WordPress core.
 * @see wp-includes/script-loader.php
 */
function elara_scripts() {
	/**
	 * Styles
	 */
	// Add custom fonts, used in the main stylesheet.
	wp_enqueue_style( 'elara-fonts', elara_fonts_url(), array(), null );

	// Third party styles
	wp_register_style( 'bootstrap', get_parent_theme_file_uri( '/assets/css/bootstrap.min.css' ) );
	wp_register_style( 'font-awesome', get_parent_theme_file_uri( '/assets/css/font-awesome.min.css' ) );
	wp_register_style( 'smartmenus-bootstrap', get_parent_theme_file_uri( '/assets/css/jquery.smartmenus.bootstrap.css' ) );
	wp_register_style( 'slick', get_parent_theme_file_uri( '/assets/css/slick.min.css' ) );
	wp_register_style( 'slick-theme', get_parent_theme_file_uri( '/assets/css/slick-theme.min.css' ) );

	// Default stylesheet
	$deps = array( 'bootstrap', 'smartmenus-bootstrap', 'font-awesome', 'slick', 'slick-theme' );
	wp_enqueue_style( 'elara-style', get_stylesheet_uri(), $deps );
	wp_style_add_data( 'elara-style', 'rtl', 'replace' );

	/**
	 * Scripts
	 */
	// Third party scripts
	wp_enqueue_script( 'html5', get_parent_theme_file_uri( '/assets/js/html5shiv.min.js' ), array(), '3.7.0' );
	wp_script_add_data( 'html5', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'respondjs', get_parent_theme_file_uri( '/assets/js/respond.min.js' ), array(), '1.3.0' );
	wp_script_add_data( 'respondjs', 'conditional', 'lt IE 9' );
	wp_enqueue_script( 'bootstrap', get_parent_theme_file_uri( '/assets/js/bootstrap.min.js' ), array( 'jquery' ), '', true );
	wp_enqueue_script( 'smartmenus', get_parent_theme_file_uri( '/assets/js/jquery.smartmenus.js' ), array( 'bootstrap' ), '', true );
	wp_enqueue_script( 'smartmenus-bootstrap', get_parent_theme_file_uri( '/assets/js/jquery.smartmenus.bootstrap.js' ), array( 'smartmenus' ), '', true );
	wp_enqueue_script( 'slick', get_parent_theme_file_uri( '/assets/js/slick.min.js' ), array(), '', true );
	wp_enqueue_script( 'jquery-match-height', get_parent_theme_file_uri( '/assets/js/jquery.matchHeight-min.js' ), array(), '', true );


	// Custom theme's script
	wp_enqueue_script( 'elara-js', get_parent_theme_file_uri( '/assets/js/elara.min.js' ), array( 'jquery' ), '', true );

	// Comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'elara_scripts' );

/**
 * Recommend plugins for best experience with this theme
 */
require_once get_parent_theme_file_path( '/inc/class-tgm-plugin-activation.php' );
/**
 * Define recommended plugins
 *
 * This function is attached to 'tgmpa_register' action hook.
 *
 * For overriding in child themes remove the action hook:
 * remove_action( 'tgmpa_register', 'elara_register_required_plugins' );
 */
function elara_register_required_plugins() {
	$plugins = array(
		array(
			'name'      => 'Kirki',
			'slug'      => 'kirki',
			'required'  => false,
		),
	);
	$config = array(
		'id'           => 'elara',                 // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                      // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins', // Menu slug.
		'has_notices'  => true,                    // Show admin notices or not.
		'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                   // Automatically activate plugins after installation or not.
		'message'      => '',                      // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}
add_action( 'tgmpa_register', 'elara_register_required_plugins' );


/**
 * Bootstrap Navigation Walker
 */
require_once get_parent_theme_file_path( '/inc/wp-bootstrap-navwalker.php' );
/**
 * Helper functions
 */
require_once get_parent_theme_file_path( '/inc/helper-functions.php' );
/**
 * Additional features for Elara theme
 */
require get_parent_theme_file_path( '/inc/template-functions.php' );
/**
 * Register sidebars and widgets
 */
require_once get_parent_theme_file_path( '/widgets/widgets.php' );
/**
 * Custom template tags for this theme.
 */
require get_parent_theme_file_path( '/inc/template-tags.php' );
