<?php
/**
 * Customizer functionality
 *
 * @package elara
 */

/**
 * Register customizer
 *
 * This function is attached to 'customize_register' action hook.
 *
 * @param WP_Customize_Manager $wp_customize The Customizer object.
 */
function elara_customizer_panels_sections( $wp_customize ) {
	/**
	 * Failsafe is safe
	 */
	if ( ! isset( $wp_customize ) ) {
		return;
	}
	// elara_section_general_settings
	$wp_customize->add_section( 'elara_section_theme_info', array(
		'title'       => esc_html__( 'Upgrade to Pro', 'elara' ),
		'priority'    => 0
	) );

	// elara_section_general_settings
	$wp_customize->add_section( 'elara_section_general_settings', array(
		'title'       => esc_html__( 'General Settings', 'elara' ),
		'priority'    => 10
	) );

	// elara_panel_frontpage
	$wp_customize->add_panel( 'elara_panel_frontpage', array(
		'priority'    => 81,
		'title'       => esc_html__( 'Front Page', 'elara' ),
	) );
	$wp_customize->add_section( 'elara_section_frontpage_banner', array(
		'title'       => esc_html__( 'Banner / Slider', 'elara' ),
		'priority'    => 81,
		'panel'       => 'elara_panel_frontpage',
	) );
	$wp_customize->add_section( 'elara_section_frontpage_featured_categories', array(
		'title'       => esc_html__( 'Featured Categories', 'elara' ),
		'priority'    => 82,
		'panel'       => 'elara_panel_frontpage',
	) );
	$wp_customize->add_section( 'elara_section_frontpage_large_post', array(
		'title'       => esc_html__( 'Large / Highlight Post', 'elara' ),
		'priority'    => 83,
		'panel'       => 'elara_panel_frontpage',
	) );

	// elara_section_blog_feed
	$wp_customize->add_section( 'elara_section_blog_feed', array(
		'title'       => esc_html__( 'Blog Feed', 'elara' ),
		'priority'    => 90
	) );

	// elara_section_posts
	$wp_customize->add_section( 'elara_section_posts', array(
		'title'       => esc_html__( 'Posts', 'elara' ),
		'priority'    => 91,
	) );

	// elara_section_pages
	$wp_customize->add_section( 'elara_section_pages', array(
		'title'       => esc_html__( 'Pages', 'elara' ),
		'priority'    => 92,
	) );

	// Remove and modify core controls and sections
	$wp_customize->get_section( 'background_image' )->priority = 94;
	$wp_customize->get_section( 'colors' )->priority           = 95;
	/**
	 * Set Selective Refresh for blog name and description
	 */
	$wp_customize->get_setting( 'blogname' )->transport        = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	/**
	 * Selective refresh for customizer preview
	 */
	if ( isset( $wp_customize->selective_refresh ) ) {
		/**
		 * Site name
		 */
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'            => '.header-logo-text a',
			'container_inclusive' => false,
			'render_callback'     => 'elara_customize_partial_blogname',
		));
		/**
		 * Site description
		 */
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'            => '.tagline p',
			'container_inclusive' => false,
			'render_callback'     => 'elara_customize_partial_blogdescription',
		));
		/**
		 * Make sure we see the change between image and text in customizer preview
		 * on selective refresh
		 */
		$wp_customize->selective_refresh->add_partial( 'custom_logo', array(
			'selector'            => '.logo',
			'container_inclusive' => false,
			'render_callback'     => 'elara_selective_refresh_site_identity',
		) );
		/**
		 * Make sure we see the change between image and text in customizer preview
		 * on selective refresh
		 */
		$wp_customize->selective_refresh->add_partial( 'background_color', array(
			'selector'            => 'body',
			'container_inclusive' => false,
			'render_callback'     => false,
		) );
	}
}
add_action( 'customize_register', 'elara_customizer_panels_sections', 11 );
/**
 * Enqueue custom styles for Kirki customizer
 * This function is attached to 'customize_controls_enqueue_scripts' action hook
 */
function elara_custom_customize_enqueue() {
	wp_enqueue_style( 'elara-customizer', get_template_directory_uri() . '/customize/style.css' );
}
add_action( 'customize_controls_enqueue_scripts', 'elara_custom_customize_enqueue' );

/**
 * Extend Kirki fields
 *
 * This function is attached to 'kirki/fields' filter hook.
 *
 * @param WP_Customize_Manager $fields The Customizer object.
 */
function elara_customizer_fields( $fields ) {

	global $elara_defaults;

	#elara_section_theme_info
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_theme_info',
		'label'       => esc_html__( 'Elara', 'elara' ),
		'description' =>
                     '<h2>' . esc_html__('DEMO AND DOCUMENTION', 'elara')  . '</h2>' . 
                     '<p>' . esc_html__( 'Please view our demo to see the full capabilities of this powerful theme.', 'elara') . '</p>' .
                     '<p><a href="http://www.lyrathemes.com/preview/?theme=elara" target="_blank" class="button">ELARA DEMO</a>'. '</p>' .
                     '<p>' . esc_html__( 'Elara is backed by a world class support team and comprehensive documentation.', 'elara').'</p>' .
                     '<p><a href="https://help.lyrathemes.com/#collection-category-64" target="_blank" class="button">DOCUMENTATION</a>' . '</p>' .
                     '<h2>' . esc_html__('UPGRADE OPTIONS', 'elara')  . '</h2>' . 
                     '<p>' . esc_html__( 'Upgrade for a ton of features that help grow your website or blog to the next level. Built-in MailChimp newsletter integration, promo boxes, and an affiliate and recommentation system are just some of the highlights of what Elara Pro has to offer.', 'elara') . '</p>' .
                     '<p><a href="https://www.lyrathemes.com/elara-pro/" target="_blank" class="button">UPGRADE TO ELARA PRO</a>' . '</p>' .
                     '<p>' . esc_html__( 'Here is a side by side comparison of the free vs. pro version:', 'elara') . '</p>' .
                     '<p><a href="https://www.lyrathemes.com/elara/#comparison" target="_blank" class="button">COMPARE</a></p>' .
                     '<p><a href="https://www.lyrathemes.com/elara-pro/" target="_blank"><img src="' . esc_url( get_parent_theme_file_uri( 'customize/images/elara-1.png' ) ) . '" /></a><br />
                     <a href="https://www.lyrathemes.com/elara-pro/" target="_blank"><img src="' . esc_url( get_parent_theme_file_uri( 'customize/images/elara-2.png' ) ) . '" /></a></p>'
                     ,
                      
		'section'     => 'elara_section_theme_info',
		'priority'    => 1,

		);

	#elara_section_general_settings
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'textarea',
		'settings'    => 'elara_footer_copyright',
		'label'       => esc_html__( 'Copyright Text', 'elara' ),
		'description' => esc_html__( 'Accepts HTML.', 'elara' ),
		'section'     => 'elara_section_general_settings',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_footer_copyright'],
		'sanitize_callback' => 'force_balance_tags',
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_example_content',
		'label'       => esc_html__( 'Show Example Content?', 'elara' ),
		'description' => esc_html__( 'Turning this off will disable all default/sample images for posts. It will also hide all default widgets in the Default Sidebar.', 'elara' ),
		'section'     => 'elara_section_general_settings',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_example_content']
	);

	#title_tagline
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_image_logo_show',
		'label'       => esc_html__( 'Show Image Logo?', 'elara' ),
		'description' => esc_html__( 'Choose whether to display the image logo.', 'elara' ),
		'section'     => 'title_tagline',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_image_logo_show'],
		'choices'     => array( 'on'  => esc_attr__( 'SHOW', 'elara' ), 'off' => esc_attr__( 'HIDE', 'elara' ) ),
	);
	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_text_logo',
		'label'       => esc_html__( 'Text Logo', 'elara' ),
		'description' => esc_html__( 'Displayed when `Show Image Logo?` is set to `Show` or if there is no logo image uploaded.', 'elara' ),
		'section'     => 'title_tagline',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_text_logo'],
		'sanitize_callback'=> 'sanitize_text_field'
	);

	$fields[] = array(
		'type'        => 'checkbox',
		'settings'    => 'elara_tagline_show',
		'label'       => esc_html__( 'Show Tagline?', 'elara' ),
		'description' => esc_html__( 'Choose whether to display site tagline.', 'elara' ),
		'section'     => 'title_tagline',
		'priority'    => 3,
		'default'     => $elara_defaults['elara_tagline_show'],
	);

	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_text_logo_sep1',
		'label'       => wp_kses_post( '<hr />' ),
		'section'     => 'title_tagline',
		'priority'    => 4
	);

	#header_image
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_banner_heading',
		'label'       => esc_html__( 'Caption Heading', 'elara' ),
		'section'     => 'header_image',
		'priority'    => 10,
		'default'     => $elara_defaults['elara_banner_heading'],
		'sanitize_callback' => 'sanitize_text_field',
	);
	$fields[] = array(
		'type'        => 'textarea',
		'settings'    => 'elara_banner_description',
		'label'       => esc_html__( 'Caption Description', 'elara' ),
		'section'     => 'header_image',
		'priority'    => 11,
		'default'     => $elara_defaults['elara_banner_description'],
		'sanitize_callback' => 'force_balance_tags'
	);
	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_banner_label',
		'label'       => esc_html__( 'Button Label', 'elara' ),
		'section'     => 'header_image',
		'priority'    => 12,
		'default'     => $elara_defaults['elara_banner_label'],
		'sanitize_callback' => 'sanitize_text_field',
	);
	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_banner_url',
		'label'       => esc_html__( 'Button Link', 'elara' ),
		'section'     => 'header_image',
		'priority'    => 13,
		'default'     => $elara_defaults['elara_banner_url'],
		'sanitize_callback' => 'sanitize_text_field',
	);

	#elara_section_frontpage_banner
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'radio',
		'settings'    => 'elara_frontpage_banner',
		'label'       => esc_html__( 'Frontpage Banner / Slider', 'elara' ),
		'section'     => 'elara_section_frontpage_banner',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_frontpage_banner'],
		'choices'     => array(
			'Banner'   => array(
				esc_attr__( 'Banner', 'elara' ),
				esc_attr__( 'Shows a banner with an optional caption. Set up the banner and the caption under `Header Image`.', 'elara' ),
			),
			'Posts' => array(
				esc_attr__( 'Posts Slider', 'elara' ),
				esc_attr__( 'Select a category to show posts from in the slider. When you select this a new section will appear here with more options.', 'elara' ),
			),
			'Hide' => array(
				esc_attr__( 'Hide Banner', 'elara' ),
			),
		),
	);

	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_frontpage_posts_slider_desc',
		'label'       => wp_kses_post( __( '<hr />Posts Slider', 'elara' ) ),
		'description' => esc_html__( 'Select a category to show posts from in the slider. Also enter the number of posts to show from that category.', 'elara' ),
		'section'     => 'elara_section_frontpage_banner',
		'priority'    => 2,
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_banner',
			'operator' => '==',
			'value'    => 'Posts'
		) )
	);
	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_posts_slider_category',
		'label'       => esc_html__( 'Posts Slider - Category', 'elara' ),
		'section'     => 'elara_section_frontpage_banner',
		'priority'    => 3,
		'default'     => $elara_defaults['elara_frontpage_posts_slider_category'],
		'choices'     => Kirki_Helper::get_terms( array( 'taxonomy' => 'category', 'hide_empty' => true ) ),
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_banner',
			'operator' => '==',
			'value'    => 'Posts'
		) )
	);
	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_posts_slider_number',
		'label'       => esc_html__( 'Posts Slider - Number of Slides/Posts', 'elara' ),
		'description' => esc_html__( 'There should be at least three posts in the chosen category for the slider to show up.', 'elara' ),
		'section'     => 'elara_section_frontpage_banner',
		'priority'    => 4,
		'default'     => $elara_defaults['elara_frontpage_posts_slider_number'],
		'choices'     => array('3'=>'3','4'=>'4','5'=>'5','6'=>'6','7'=>'7','8'=>'8','9'=>'9','10'=>'10'),
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_banner',
			'operator' => '==',
			'value'    => 'Posts'
		) )
	);

	#elara_section_frontpage_featured_categories
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_frontpage_featured_categories_show',
		'label'       => esc_html__( 'Show Featured Categories', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_show'],
		'choices'     => array(
			'on'  => esc_attr__( 'SHOW', 'elara' ),
			'off' => esc_attr__( 'HIDE', 'elara' )
		),
	);
	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_featured_categories_columns',
		'label'       => esc_html__( 'Show Featured Categories', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_columns'],
		'choices'     => array( '1'=>'1', '2'=>'2', '3'=>'3' ),
	);
	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_featured_categories_posts_number',
		'label'       => esc_html__( 'Number of posts in each column', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 3,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_posts_number'],
		'choices'     => array( '1'=>'1', '2'=>'2', '3'=>'3', '4'=>'4', '5'=>'5' ),
	);
	/* column 1 */
	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_frontpage_featured_categories_col_1_heading',
		'label'       => esc_html__( 'Column 1: Heading', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 4,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_col_1_heading'],
	);

	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_featured_categories_col_1_category',
		'label'       => esc_html__( 'Column 1: Select Category', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 5,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_col_1_category'],
		'choices'     => Kirki_Helper::get_terms( 'category' ),
	);
	/* column 2 */
	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_frontpage_featured_categories_col_2_heading',
		'label'       => esc_html__( 'Column 2: Heading', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 6,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_col_2_heading'],
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_featured_categories_columns',
			'operator' => '>',
			'value'    => '1'
		) )
	);

	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_featured_categories_col_2_category',
		'label'       => esc_html__( 'Column 2: Select Category', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 7,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_col_2_category'],
		'choices'     => Kirki_Helper::get_terms( 'category' ),
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_featured_categories_columns',
			'operator' => '>',
			'value'    => '1'
		) )
	);
	/* column 3 */
	$fields[] = array(
		'type'        => 'text',
		'settings'    => 'elara_frontpage_featured_categories_col_3_heading',
		'label'       => esc_html__( 'Column 3: Heading', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 8,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_col_3_heading'],
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_featured_categories_columns',
			'operator' => '>',
			'value'    => '2'
		) )
	);

	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_featured_categories_col_3_category',
		'label'       => esc_html__( 'Column 3: Select Category', 'elara' ),
		'section'     => 'elara_section_frontpage_featured_categories',
		'priority'    => 9,
		'default'     => $elara_defaults['elara_frontpage_featured_categories_col_3_category'],
		'choices'     => Kirki_Helper::get_terms( 'category' ),
		'active_callback'  => array( array(
			'setting'  => 'elara_frontpage_featured_categories_columns',
			'operator' => '>',
			'value'    => '2'
		) )
	);

	/* elara_section_frontpage_large_post */
	#-----------------------------------------
	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_frontpage_large_post_show',
		'label'       => esc_html__( 'Show Large / Highlight Post', 'elara' ),
		'section'     => 'elara_section_frontpage_large_post',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_frontpage_large_post_show'],
		'choices'     => array(
			'on'  => esc_attr__( 'SHOW', 'elara' ),
			'off' => esc_attr__( 'HIDE', 'elara' )
		),
	);
	$fields[] = array(
		'type'        => 'select',
		'settings'    => 'elara_frontpage_large_post',
		'label'       => esc_html__( 'Select Large / Highlight Post', 'elara' ),
		'section'     => 'elara_section_frontpage_large_post',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_frontpage_large_post'],
		'choices'     => Kirki_Helper::get_posts( array( 'numberposts' => -1 ) ),
	);

	/* elara_section_blog_feed */
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_blog_feed_meta_show',
		'label'       => esc_html__( 'Show Meta?', 'elara' ),
		'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts in the blog feed. This applies to all blog feeds on all pages, including the front page.', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_blog_feed_meta_show'],
		'choices' => array( 'on'  => esc_attr__( 'SHOW', 'elara' ), 'off' => esc_attr__( 'HIDE', 'elara' ), )
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_blog_feed_date_show',
		'label'       => esc_html__( 'Show Date?', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_blog_feed_date_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_blog_feed_meta_show',
			'operator' => '==',
			'value'    => 1
		))
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_blog_feed_category_show',
		'label'       => esc_html__( 'Show Category?', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 3,
		'default'     => $elara_defaults['elara_blog_feed_category_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_blog_feed_meta_show',
			'operator' => '==',
			'value'    => 1
		))
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_blog_feed_author_show',
		'label'       => esc_html__( 'Show Author?', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 4,
		'default'     => $elara_defaults['elara_blog_feed_author_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_blog_feed_meta_show',
			'operator' => '==',
			'value'    => 1
		))
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_blog_feed_comments_show',
		'label'       => esc_html__( 'Show Comments?', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 5,
		'default'     => $elara_defaults['elara_blog_feed_comments_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_blog_feed_meta_show',
			'operator' => '==',
			'value'    => 1
		))
	);
	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_blog_feed_sep1',
		'label'       => wp_kses_post( '<hr />' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 6
	);

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_blog_feed_sidebar_show',
		'label'       => esc_html__( 'Show Sidebar on Blog Feed?', 'elara' ),
		'description' => esc_html__( 'Choose whether to display sidebars on blog feed, including the front page.', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 7,
		'default'     => $elara_defaults['elara_blog_feed_sidebar_show'],
		'choices' => array( 'on'  => esc_attr__( 'SHOW', 'elara' ), 'off' => esc_attr__( 'HIDE', 'elara' ), )
	);
	$fields[] = array(
		'type'             => 'radio',
		'settings'         => 'elara_blog_feed_sidebar_position',
		'label'            => esc_html__( 'Frontpage Sidebar Position', 'elara' ),
		'section'          => 'elara_section_blog_feed',
		'priority'         => 8,
		'default'          => $elara_defaults['elara_blog_feed_sidebar_position'],
		'active_callback'  => array( array( 'setting'  => 'elara_blog_feed_sidebar_show', 'operator' => '==', 'value'    => 1 ) ),
		'choices'          => array(
							'top'   => array(
								esc_attr__( 'Top', 'elara' ),
								esc_attr__( 'On the front page - Show sidebar from the very top, next to the banner.', 'elara' ),
							),
							'bottom' => array(
								esc_attr__( 'Bottom', 'elara' ),
								esc_attr__( 'On the front page - Show sidebar after banner.', 'elara' ),
							),
						),
	);
	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_blog_feed_sep2',
		'label'       => wp_kses_post( '<hr />' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 9
	);
	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_category_feed_sidebar_show',
		'label'       => esc_html__( 'Show Sidebar on Category Archives?', 'elara' ),
		'description' => esc_html__( 'Choose whether to display sidebar on category archives.', 'elara' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 10,
		'default'     => $elara_defaults['elara_category_feed_sidebar_show'],
		'choices' => array( 'on'  => esc_attr__( 'SHOW', 'elara' ), 'off' => esc_attr__( 'HIDE', 'elara' ), )
	);
	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_blog_feed_sep3',
		'label'       => wp_kses_post( '<hr />' ),
		'section'     => 'elara_section_blog_feed',
		'priority'    => 11
	);

	/* elara_section_posts */
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'switch',
		'settings'    => 'elara_posts_meta_show',
		'label'       => esc_html__( 'Show Meta?', 'elara' ),
		'description' => esc_html__( 'Choose whether to display date, category, author, tags for posts on the post page.', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 1,
		'default'     => $elara_defaults['elara_posts_meta_show'],
		'choices' => array( 'on'  => esc_attr__( 'SHOW', 'elara' ), 'off' => esc_attr__( 'HIDE', 'elara' ), )
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_posts_date_show',
		'label'       => esc_html__( 'Show Date?', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_posts_date_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_posts_meta_show',
			'operator' => '==',
			'value'    => 1
		) )
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_posts_category_show',
		'label'       => esc_html__( 'Show Category?', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 3,
		'default'     => $elara_defaults['elara_posts_category_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_posts_meta_show',
			'operator' => '==',
			'value'    => 1
		) )
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_posts_author_show',
		'label'       => esc_html__( 'Show Author?', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 4,
		'default'     => $elara_defaults['elara_posts_author_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_posts_meta_show',
			'operator' => '==',
			'value'    => 1
		) )
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_posts_comments_show',
		'label'       => esc_html__( 'Show Comments?', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 5,
		'default'     => $elara_defaults['elara_posts_comments_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_posts_meta_show',
			'operator' => '==',
			'value'    => 1
		) )
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_posts_tags_show',
		'label'       => esc_html__( 'Show Tags?', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 6,
		'default'     => $elara_defaults['elara_posts_tags_show'],
		'active_callback'  => array( array(
			'setting'  => 'elara_posts_meta_show',
			'operator' => '==',
			'value'    => 1
		) )
	);
	$fields[] = array(
		'type'        => 'custom',
		'settings'    => 'elara_posts_sep1',
		'label'       => wp_kses_post( '<hr />' ),
		'section'     => 'elara_section_posts',
		'priority'    => 7
	);
	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'elara_posts_sidebar',
		'label'       => esc_html__( 'Layout', 'elara' ),
		'description' => esc_html__( 'Choose whether to display the sidebar.', 'elara' ),
		'section'     => 'elara_section_posts',
		'default'     => $elara_defaults['elara_posts_sidebar'],
		'priority'    => 8,
		'choices'     => array(
			0 => esc_url( get_parent_theme_file_uri( 'customize/images/full.png' ) ),
			1 => esc_url( get_parent_theme_file_uri( 'customize/images/sidebar.png' ) ),
		)
	);
    $fields[] = array(
		'type'             => 'radio',
		'settings'         => 'elara_posts_sidebar_position',
		'label'            => esc_html__( 'Post Sidebar Position', 'elara' ),
		'section'          => 'elara_section_posts',
		'priority'         => 9,
		'default'          => $elara_defaults['elara_posts_sidebar_position'],
		'active_callback'  => array( array( 'setting' => 'elara_posts_sidebar', 'operator' => '==', 'value' => 1 ) ),
		'choices'          => array(
			'bottom' => array(
				esc_attr__( 'Below featured image', 'elara' ),
				esc_attr__( 'Show sidebar after featured image.', 'elara' ),
			),
			'top'   => array(
				esc_attr__( 'Next to Featured image', 'elara' ),
				esc_attr__( 'Show sidebar from the very top, next to featured image.', 'elara' ),
			),
		),
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_posts_featured_image_show',
		'label'       => esc_html__( 'Show Featured Image?', 'elara' ),
		'description' => esc_html__( 'Whether to show featured image at the beginning of the post.', 'elara' ),
		'section'     => 'elara_section_posts',
		'priority'    => 10,
		'default'     => $elara_defaults['elara_posts_featured_image_show']
	);

	/* elara_section_pages */
	#-----------------------------------------

	$fields[] = array(
		'type'        => 'radio-image',
		'settings'    => 'elara_pages_sidebar',
		'label'       => esc_html__( 'Layout', 'elara' ),
		'description' => esc_html__( 'Choose whether to display the sidebar.', 'elara' ),
		'section'     => 'elara_section_pages',
		'default'     => $elara_defaults['elara_pages_sidebar'],
		'priority'    => 1,
		'choices'     => array(
			0 => esc_url( get_parent_theme_file_uri( 'customize/images/full.png' ) ),
			1 => esc_url( get_parent_theme_file_uri( 'customize/images/sidebar.png' ) ),
		)
	);
	$fields[] = array(
		'type'        => 'toggle',
		'settings'    => 'elara_pages_featured_image_show',
		'label'       => esc_html__( 'Show Featured Image ?', 'elara' ),
		'description' => esc_html__( 'Whether to show featured image at the beginning of the page.', 'elara' ),
		'section'     => 'elara_section_pages',
		'priority'    => 2,
		'default'     => $elara_defaults['elara_pages_featured_image_show']
	);

	return $fields;
}

add_filter( 'kirki/fields', 'elara_customizer_fields' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @see elara_customizer_panels_sections()
 *
 * @return void
 */
function elara_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @see elara_customizer_panels_sections()
 *
 * @return void
 */
function elara_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Selective refresh for custom image/text logo
 *
 * If we have custom logo selected display the image
 * otherwise display custom text logo.
 *
 * @see elara_customizer_panels_sections()
 *
 * @return string Returns image or heading markup
 */
function elara_selective_refresh_site_identity() {
	if ( elara_get_option( 'elara_image_logo_show' ) ) :
		if ( has_custom_logo() ) :
			the_custom_logo();
		else :
			elara_site_identity();
		endif;
	else :
		elara_site_identity();
	endif;
}

/**
 * Customize preview init
 *
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 * This function is attached to 'customize_preview_init' action hook.
 */
function elara_customize_preview_js() {
	wp_enqueue_script( 'elara-customizer', get_template_directory_uri() . '/customize/customizer.js', array( 'jquery','customize-preview' ), '1.0.0', true );
}
add_action( 'customize_preview_init', 'elara_customize_preview_js' );
