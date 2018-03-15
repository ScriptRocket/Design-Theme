<?php
/**
 * Helper functions for Elara theme
 *
 * @package Elara
 */

if ( ! function_exists( 'elara_get_option' ) ) :
	/**
	 * Theme mod value helper
	 *
	 * @param  string $key Theme mod key id
	 * @return string      Returns value for provided theme mod
	 */
	function elara_get_option( $key ) {
		global $elara_defaults;

		if ( array_key_exists( $key, $elara_defaults ) ) {
			$value = get_theme_mod( $key, $elara_defaults[$key] );
		} else {
			$value = get_theme_mod( $key );
		}

		return $value;
	}
endif; // function_exists( 'elara_get_option' )

if ( ! function_exists( 'elara_get_bootstrap_class' ) ) :
	/**
	 * Bootstrap class for footer widgets
	 *
	 * @param  int $columns   Number of active sidebars
	 * @return string         Returns classes for footer widgets container
	 */
	function elara_get_bootstrap_class( $columns ) {
		switch ( $columns ) {
			case 1: return 'col-md-12'; break;
			case 2: return 'col-lg-6 col-md-6 col-sm-6 col-xs-6'; break;
			case 3: return 'col-lg-4 col-md-4 col-sm-4 col-xs-12'; break;
			case 4: return 'col-lg-3 col-md-3 col-sm-6 col-xs-12'; break;
			case 5: return 'col-lg-20 col-md-20 col-sm-6'; break;
			case 6: return 'col-lg-2 col-md-2 col-sm-2 col-xs-6'; break;
		}
	}
endif; // function_exists( 'elara_get_bootstrap_class' )

if ( ! function_exists( 'elara_set_featured_categories_class' ) ) :
	/**
	 * Bootstrap class for columns of featured categories
	 *
	 * @param  int $columns   Number of columns
	 * @return string         Returns classes for featured category column
	 */
	function elara_set_featured_categories_class( $columns ) {
		switch ( $columns ) {
			case 1: return 'col-md-12'; break;
			case 2: return 'col-lg-6 col-md-12 col-sm-12 col-xs-12'; break;
			case 3: return 'col-lg-4 col-md-12 col-sm-12 col-xs-12'; break;
		}
	}
endif; // function_exists( 'elara_set_featured_categories_class' )

if ( ! function_exists( 'elara_get_sample' ) ) :
	/**
	 * Get random sample image based on image size
	 *
	 * @param  string $what Registered image size
	 * @return string       Returns url for the image
	 */
	function elara_get_sample( $what ) {
		global $elara_defaults;

		switch ( $what ) {
			case 'elara-slider':
				$images = $elara_defaults['elara_slide_sample'];
				$rand_key = array_rand( $images, 1 );
				return ( $images[$rand_key] ); // images already escaped in theme-defaults.php
				break;
			case 'elara-archive':
				$images = $elara_defaults['elara_grid_sample'];
				$rand_key = array_rand( $images, 1 );
				return ( $images[$rand_key] ); // images already escaped in theme-defaults.php
				break;
			case 'elara-thumbnail':
				$images = $elara_defaults['elara_thumb_sample'];
				$rand_key = array_rand( $images, 1 );
				return ( $images[$rand_key] ); // images already escaped in theme-defaults.php
				break;
		}
	}
endif; // function_exists( 'elara_get_sample' )

if ( ! function_exists( 'elara_set_main_class' ) ) :
	/**
	 * Set class for main content depending on
	 * customizer settings for showing the sidebar
	 * @return string Returns class
	 */
	function elara_set_main_class() {
		/**
		 * Get settings
		 */
		$elara_blog_feed_sidebar_show     = elara_get_option( 'elara_blog_feed_sidebar_show' );
		$elara_category_feed_sidebar_show = elara_get_option( 'elara_category_feed_sidebar_show' );
		$elara_posts_sidebar              = elara_get_option( 'elara_posts_sidebar' );
		$elara_pages_sidebar              = elara_get_option( 'elara_pages_sidebar' );
		/**
		 * Set classes and make full width default
		 * @var string
		 */
		$class_sidebar = 'col-md-9 col-xs-12 sidebar-on';
		$class = ' col-xs-12 sidebar-off';
		/* Fonrpage */
		if ( is_front_page() && $elara_blog_feed_sidebar_show ) :
			$class = $class_sidebar;
		/* Category */
		elseif ( is_category() && $elara_category_feed_sidebar_show ) :
			$class = $class_sidebar;
		/* Archives */
		elseif ( ( is_archive() || is_search() || is_home() ) && !is_category() && $elara_blog_feed_sidebar_show ) :
			$class = $class_sidebar;
		/* Post */
		elseif ( is_single() && $elara_posts_sidebar ) :
			$class = $class_sidebar;
		/* Page */
		elseif ( ( is_page() && ! is_front_page() ) && $elara_pages_sidebar ) :
			$class = $class_sidebar;
		endif;

		return $class;
	}
endif; // function_exists( 'elara_set_main_class' )

if ( ! function_exists( 'elara_set_feed_post_class' ) ) :
	/**
	 * Set class for main content depending on
	 * customizer settings for showing the sidebar
	 * @return string Returns class
	 */
	function elara_set_feed_post_class() {
		/**
		 * Get settings
		 */
		$elara_blog_feed_sidebar_show     = elara_get_option( 'elara_blog_feed_sidebar_show' );
		$elara_category_feed_sidebar_show = elara_get_option( 'elara_category_feed_sidebar_show' );
		/**
		 * Set classes and make full width default
		 * @var string
		 */
		$class = '';

		/* Category */
		if ( is_category() ) :
			$class = elara_get_bootstrap_class(5);

			if ( $elara_category_feed_sidebar_show ) :
				$class = elara_get_bootstrap_class(4);
			endif;
		/* Any other archive */
		elseif ( is_front_page() || is_home() || is_archive() || is_search() || is_single() ) :

			$class = elara_get_bootstrap_class(4);

			if ( $elara_blog_feed_sidebar_show ) :
				$class = elara_get_bootstrap_class(3);
			endif;
		endif;

		return $class;
	}
endif; // function_exists( 'elara_set_feed_post_class' )

if ( ! function_exists( 'elara_show_sidebar' ) ) :
	/**
	 * Show sidebar depending on customizer settings
	 * @return mix Display sidebar if enabled
	 */
	function elara_show_sidebar() {
		/**
		 * Get settings
		 */
		$elara_blog_feed_sidebar_show     = elara_get_option( 'elara_blog_feed_sidebar_show' );
		$elara_category_feed_sidebar_show = elara_get_option( 'elara_category_feed_sidebar_show' );
		$elara_posts_sidebar              = elara_get_option( 'elara_posts_sidebar' );
		$elara_pages_sidebar              = elara_get_option( 'elara_pages_sidebar' );
		/**
		 * Hide by default
		 * @var boolean
		 */
		$show = false;
		/* Fonrpage */
		if ( is_front_page() && $elara_blog_feed_sidebar_show ) :
			$show = true;
		/* Category */
		elseif ( is_category() && $elara_category_feed_sidebar_show ) :
			$show = true;
		/* Archives */
		elseif ( ( is_archive() || is_search() || is_home() ) && !is_category() && $elara_blog_feed_sidebar_show ) :
			$show = true;
		/* Post */
		elseif ( is_single() && $elara_posts_sidebar ) :
			$show = true;
		/* Page */
		elseif ( ( is_page() && ! is_front_page() ) && $elara_pages_sidebar ) :
			$show = true;
		endif;

		if ( $show ) :
			get_sidebar();
		endif;
	}
endif; // function_exists( 'elara_show_sidebar' )

if ( ! function_exists( 'elara_toggle_entry_meta' ) ) :
	/**
	 * Toggle entry meta
	 *
	 * Helper function to determine whether specific meta is set to be visible
	 * or hidden. Markup is mainly the same for single and archive view so we are
	 * covering here both.
	 *
	 * @param  string $feed_field     Blog feed option for specific meta
	 * @param  string $single_field   Single post option for specific meta
	 * @return bool                   Returns true/false for specified meta
	 */
	function elara_toggle_entry_meta( $feed_field, $single_field ) {
		$show = false;
		$elara_blog_feed_meta_show = elara_get_option( 'elara_blog_feed_meta_show' );
		$elara_posts_meta_show     = elara_get_option( 'elara_posts_meta_show' );
		/**
		 * Blog feed - front page or blog archive
		 */
		if ( is_front_page() || is_home() || is_archive() || is_search() ) :
			if ( $elara_blog_feed_meta_show && $feed_field ) :
				$show = true;
			endif;
		/**
		 * Single post
		 */
		elseif ( is_single() ) :
			if ( $elara_posts_meta_show && $single_field ) :
				$show = true;
			endif;
		endif;

		return $show;
	}
endif; // function_exists( 'elara_toggle_entry_meta' )

if ( ! function_exists( 'elara_count_footer_sidebars' ) ) :
	/**
	 * Count active footer sidebars
	 *
	 * @return int Returns number of active footer sidebars
	 */
	function elara_count_footer_sidebars() {
        $elara_example_content  = elara_get_option( 'elara_example_content' );
        if($elara_example_content == 1) return 5;
        
		$active_sidebar = 0;
		/**
		 * We need number of active sidebars for proper layout class
		 * and we know there can be no more than 5 sidebars
		 * @var integer
		 */
		for ( $i = 1; $i < 6; $i++ ) {
			if ( is_active_sidebar( 'footer-columns-col-' . $i ) ) { $active_sidebar++; }
		}
		return $active_sidebar;
	}
endif; // function_exists( 'elara_count_footer_sidebars' )

if ( ! function_exists( 'elara_default_widgets_args' ) ) :
	/**
	 * Default widgets args
	 *
	 * Set widget args for example content default widgets.
	 *
	 * @param  string $class Class, specific to certain default widgets
	 * @return string        Returns string of widget args
	 */
	function elara_default_widgets_args( $class = '' ) {
		$args = array(
			'before_widget' => '<div class="default-widget widget ' . $class . '">',
			'after_widget'  => '</div>',
			'before_title'  => '<h3 class="widget-title">',
			'after_title'   => '</h3>'
		);

		$widget_args = '';

		foreach ( $args as $key => $value ) {
			$widget_args .= '&' . $key . '=' . $value;
		}

		return $widget_args;
	}
endif; // function_exists( 'elara_default_widgets_args' )


if ( ! function_exists( 'elara_header_widgets_args' ) ) :
	/**
	 * Header widgets args
	 *
	 * Set widget args for example content header widgets.
	 *
	 * @param  string $class Class, specific to certain header widgets
	 * @return string        Returns string of widget args
	 */
	function elara_header_widgets_args( $class = '' ) {
		$args = array( 
			'before_widget' => '<div class="header-widget widget ' . $class . '">',
			'after_widget'  => '</div>',
			'before_title'  => '',
			'after_title'   => ''
		);

		$widget_args = '';

		foreach ( $args as $key => $value ) {
			$widget_args .= '&' . $key . '=' . $value;
		}

		return $widget_args;
	}
endif; // function_exists( 'elara_header_widgets_args' )



if ( ! function_exists( 'elara_example_sidebar' ) ) :
	/**
	 * Example sidebar widgets if example content is on in customizer
	 * @return Returns sidebar widgets
	 */
	function elara_example_sidebar() {
		echo '<div class="sidebar-default">';
		the_widget( 'WP_Widget_Search',
			'title=' . esc_html__( 'Search', 'elara' ),
			elara_default_widgets_args( 'widget_search' )
		);
		the_widget( 'WP_Widget_Recent_Posts',
			'title=' . esc_html__( 'Recent Posts', 'elara' ) ,
			elara_default_widgets_args( 'widget_recent_entries' )
		);
        the_widget( 'WP_Widget_Recent_Comments',
			'title=' . esc_html__( 'Recent Comments', 'elara' ) ,
			elara_default_widgets_args( 'widget_recent_comments' )
		);
        the_widget( 'WP_Widget_Archives',
			'title=' . esc_html__( 'Archives', 'elara' ),
			elara_default_widgets_args( 'widget_archive' )
		);
		the_widget( 'WP_Widget_Categories',
			'title=' . esc_html__( 'Categories', 'elara' ),
			elara_default_widgets_args( 'widget_categories' )
		);
		the_widget( 'WP_Widget_Tag_Cloud',
			'title=' . esc_html__( 'Search by Tags', 'elara' ),
			elara_default_widgets_args( 'widget_tag_cloud' )
		);
		echo '</div>';
	}
endif; // function_exists( 'elara_example_sidebar' )




if ( ! function_exists( 'elara_example_sidebar_header' ) ) :
	/**
	 * Example sidebar widgets if example content is on in customizer
	 * @return Returns sidebar widgets
	 */
	function elara_example_sidebar_header($location) {
        if($location == 'right')
            the_widget( 'WP_Widget_Search',
                'title=',
                elara_header_widgets_args( 'widget_search example-header-sidebar' )
            );
        if($location == 'left')
		the_widget( 'WP_Widget_Pages',
			'title= ',
			elara_header_widgets_args( 'widget_nav_menu menu example-header-sidebar' )
		);
	}
endif; // function_exists( 'elara_example_sidebar_header' )



if ( ! function_exists( 'elara_example_sidebar_footer' ) ) :
	/**
	 * Example sidebar widgets if example content is on in customizer
	 * @return Returns sidebar widgets
	 */
	function elara_example_sidebar_footer($column) {
        switch($column){
            case 1:     
                the_widget( 'WP_Widget_Recent_Comments',
                    'title=' . esc_html__( 'Recent Comments', 'elara' ) ,
                    elara_default_widgets_args( 'widget_recent_comments example-footer-sidebar' )
                );
                break;
            case 2:     
                the_widget( 'WP_Widget_Pages', 
                    'title='. esc_html__( 'Pages', 'elara' ), 
                    elara_default_widgets_args( 'widget_nav_menu menu example-footer-sidebar' ) 
                ); 
                break;
            case 3:     
                the_widget( 'WP_Widget_Categories', 
                    'title=' . esc_html__( 'Categories', 'elara' ), 
                    elara_default_widgets_args('widget_categories example-footer-sidebar' ) 
                ); 
                break;
            case 4:
                the_widget( 'WP_Widget_Recent_Posts',
                    'title=' . esc_html__( 'Recent Posts', 'elara' ) ,
                    elara_default_widgets_args( 'widget_recent_entries example-footer-sidebar' ) 
                ); 
                break;
            case 5:
                the_widget( 'WP_Widget_Archives',
                    'title=' . esc_html__( 'Archives', 'elara' ),
                    elara_default_widgets_args( 'widget_archive example-footer-sidebar' ) 
                ); 
                break;
        }
        
        
		
	}
endif; // function_exists( 'elara_example_sidebar_footer' )