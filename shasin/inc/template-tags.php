<?php
/**
 * Template tags
 *
 * @package Elara
 */
if ( ! function_exists( 'elara_fontawesome_icon' ) ) :
	/**
	 * Font Awesome Icon
	 * @param  string  $icon Name of icon
	 * @param  boolean $echo Echo or return
	 * @return string        Markup for Font Awesome icon
	 */
	function elara_fontawesome_icon( $icon = '', $echo = true ) {
		if ( $icon ) {
			if ( $echo ) {
				echo '<i class="fa fa-' . esc_attr( $icon ) . '"></i>';
			} else {
				return '<i class="fa fa-' . esc_attr( $icon ) . '"></i>';
			}
		}
	}
endif;

if ( ! function_exists( 'elara_entry_thumbnail' ) ) :
	/**
	 * Entry Thumbnail
	 * @param  string $size      Image size
	 * @param  bool $show_modal  Whether to display 'play' icon and trigger video modal
	 * @return string            Print featured image for current post
	 */
	function elara_entry_thumbnail( $size = 'thumbnail', $show_modal = false ) {
		$elara_example_content = elara_get_option( 'elara_example_content' ); ?>

		<?php if ( has_post_thumbnail() || $elara_example_content == 1 ) : ?>
			<div class="entry-thumb">

				<?php if ( 'video' === get_post_format() && elara_get_first_embed_media( get_the_ID() ) && $show_modal ) : ?>
					<a href="#" data-toggle="modal" data-target="#elara-video-modal-<?php the_ID(); ?>">
				<?php else : ?>
					<a href="<?php the_permalink(); ?>" rel="bookmark">
				<?php endif; ?>

				<?php if ( has_post_thumbnail() ) : ?>
					<?php the_post_thumbnail( $size, array( 'alt' => get_the_title(), 'class' => 'img-responsive' ) ); ?>
				<?php elseif ( $elara_example_content == 1 ) : ?>
					<img src="<?php echo esc_url( elara_get_sample( $size ) ); ?>" alt="<?php the_title_attribute(); ?>" class="img-responsive" />
				<?php endif; ?>

				<?php if ( 'video' === get_post_format() && elara_get_first_embed_media( get_the_ID() ) && $show_modal ) : ?>
						<span class="screen-reader-text"><?php esc_html_e( 'Launch video modal', 'elara' ); ?></span>
						<span class="entry-play-icon">
							<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/assets/images/play.png" alt="<?php esc_attr_e( 'Launch video modal', 'elara' ); ?>">
						</span>
					</a>
				<?php else : ?>
					</a>
				<?php endif; ?>

			</div><!-- entry-thumb --><?php
		endif;
	}
endif;

if ( ! function_exists( 'elara_entry_title' ) ) :
	/**
	 * Entry Title
	 * @return string Prints current post title, inside link for archives and without link for singles
	 */
	function elara_entry_title() {
		if ( is_single() ) {
			the_title( '<h1 class="entry-title">', '</h1>' );
		} else {
			the_title( '<h3 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h3>' );
		}
	}
endif;

if ( ! function_exists( 'elara_feed_entry_excerpt' ) ) :
	/**
	 * Entry Excerpt
	 * @return string Prints current post title, inside link for archives and without link for singles
	 */
	function elara_feed_entry_excerpt() {
		$elara_example_content = elara_get_option( 'elara_example_content' );
		// if ( ! is_category() ) :
			if ( ! $elara_example_content && ! has_post_thumbnail() ) : ?>
				<div class="entry-summary"><?php the_excerpt(); ?></div>
			<?php endif;
		// endif;
	}
endif;

if ( ! function_exists( 'elara_entry_categories' ) ) :
	/**
	 * Entry Categories
	 * @return string Prints categories for current post
	 */
	function elara_entry_categories() {
		$elara_blog_feed_category_show = elara_get_option( 'elara_blog_feed_category_show' );
		$elara_posts_category_show     = elara_get_option( 'elara_posts_category_show' );
		/**
		 * Check for category visibility
		 * @var bool
		 */
		$show = elara_toggle_entry_meta( $elara_blog_feed_category_show, $elara_posts_category_show );

		if ( $show ) : ?>
			<span class="entry-category"><?php the_category( ', ' ); ?></span><?php
		endif;
	}
endif;

if ( ! function_exists( 'elara_entry_date' ) ) :
	/**
	 * Entry Date
	 * @return string Prints date for current post, returns null if page
	 */
	function elara_entry_date() {

		$elara_blog_feed_date_show = elara_get_option( 'elara_blog_feed_date_show' );
		$elara_posts_date_show     = elara_get_option( 'elara_posts_date_show' );
		/**
		 * Check for date visibility
		 * @var bool
		 */
		$show = elara_toggle_entry_meta( $elara_blog_feed_date_show, $elara_posts_date_show );

		if ( $show ) :
			echo '<span class="entry-date">' . esc_html( get_the_date( ) ) . '</span>';
		endif;
	}
endif;

if ( ! function_exists( 'elara_entry_author' ) ) :
	/**
	 * Entry Author
	 * @return string Prints author for current post
	 */
	function elara_entry_author() {

		$elara_blog_feed_author_show   = elara_get_option( 'elara_blog_feed_author_show' );
		$elara_posts_author_show       = elara_get_option( 'elara_posts_author_show' );
		/**
		 * Check for author visibility
		 * @var bool
		 */
		$show = elara_toggle_entry_meta( $elara_blog_feed_author_show, $elara_posts_author_show );

		if ( $show ) :
			echo '<span class="entry-author">';
			printf( __( 'by <a href="%1$s">%2$s</a>', 'elara' ),
				esc_url( get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) ) ),
				esc_html( get_the_author() )
			);
			echo '</span>';
		endif;
	}
endif;

if ( ! function_exists( 'elara_entry_comments_link' ) ) :
	/**
	 * Comments link
	 * @return string Prints comments number inside comments link for curent post
	 */
	function elara_entry_comments_link() {
		$elara_blog_feed_comments_show = elara_get_option( 'elara_blog_feed_comments_show' );
		$elara_posts_comments_show     = elara_get_option( 'elara_posts_comments_show' );

		if ( ! post_password_required() && comments_open() ) :
			/**
			 * Check for comments visibility
			 * @var bool
			 */
			$show = elara_toggle_entry_meta( $elara_blog_feed_comments_show, $elara_posts_comments_show );

			if ( $show ) :
				$label = sprintf( _nx( '%1$s Comment', '%1$s Comments', get_comments_number(), 'comments title', 'elara' ),
					number_format_i18n( get_comments_number() )
				);

				echo '<span class="entry-comment"><a href="' . esc_url( get_comments_link() ). '">' . esc_html($label) . '</a></span>';
			endif;
		endif;
	}
endif;

if ( ! function_exists( 'elara_entry_separator' ) ) :
	/**
	 * Entry Meta Separator
	 *
	 * @param string $check      Unique ID for condition to check
	 * @param string $separator  HTML character for separator. Default /.
	 * @return string            Prints separator dash between meta elements
	 */
	function elara_entry_separator( $check, $separator = '&#47;' ) {
		$elara_blog_feed_category_show = elara_get_option( 'elara_blog_feed_category_show' );
		$elara_posts_category_show     = elara_get_option( 'elara_posts_category_show' );
		$elara_blog_feed_date_show     = elara_get_option( 'elara_blog_feed_date_show' );
		$elara_posts_date_show         = elara_get_option( 'elara_posts_date_show' );
		$elara_blog_feed_author_show   = elara_get_option( 'elara_blog_feed_author_show' );
		$elara_posts_author_show       = elara_get_option( 'elara_posts_author_show' );
		$elara_blog_feed_comments_show = elara_get_option( 'elara_blog_feed_comments_show' );
		$elara_posts_comments_show     = elara_get_option( 'elara_posts_comments_show' );

		$separator = '<span class="entry-separator">&nbsp;' . esc_html( $separator ) . '&nbsp;</span>';

		/**
		 * Check for item visibility
		 * @var bool
		 */
		$show_category = elara_toggle_entry_meta( $elara_blog_feed_category_show, $elara_posts_category_show );
		$show_date = elara_toggle_entry_meta( $elara_blog_feed_date_show, $elara_posts_date_show );
		$show_author = elara_toggle_entry_meta( $elara_blog_feed_author_show, $elara_posts_author_show );
		$show_comments = elara_toggle_entry_meta( $elara_blog_feed_comments_show, $elara_posts_comments_show );
		if ( $check == 'categories-date' && $show_category && $show_date ) :
			echo $separator;
		elseif ( $check == 'author-comments' && $show_author && $show_comments ) :
			echo $separator;
		endif;
	}
endif;

if ( ! function_exists( 'elara_site_identity_title' ) ) :
	/**
	 * Site title
	 *
	 * Site title markup - heading or div depending on whether
	 * it is home or any other page.
	 *
	 * @param string  $elara_text_logo Site title or custom text
	 * @return string Display site title markup
	 */
	function elara_site_identity_title( $elara_text_logo = '' ) {
		if ( is_front_page() ) : ?>
			<h1 class="header-logo-text">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $elara_text_logo ); ?></a>
			</h1>
		<?php else : ?>
			<div class="header-logo-text">
				<a href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php echo esc_html( $elara_text_logo ); ?></a>
			</div>
		<?php endif;
	}
endif;

if ( ! function_exists( 'elara_site_tagline' ) ) :
	/**
	 * Site tagline
	 *
	 * @return string Site tagline markup
	 */
	function elara_site_tagline() {
		if ( get_bloginfo( 'description' ) ) : ?>
			<div class="tagline">
				<p><?php echo esc_html( get_bloginfo( 'description' ) ); ?></p>
			</div>
		<?php endif;
	}
endif;

if ( ! function_exists( 'elara_site_identity' ) ) :
	/**
	 * Site identity, custom or default title and tagline
	 *
	 * @return string Display site identity markup
	 */
	function elara_site_identity() {
		$elara_text_logo = elara_get_option( 'elara_text_logo' );

		// If custom site title text is not empty.
		if ( $elara_text_logo ) :

			elara_site_identity_title( $elara_text_logo );

			// If 'Show tagline' is checked.
			if ( elara_get_option( 'elara_tagline_show' ) ) :
				elara_site_tagline();
			endif; // elara_get_option( 'elara_tagline_show' )

		// If custom site title is empty.
		else :

			// If 'Display Site Title and Tagline' is checked
			if ( display_header_text() ) :
				elara_site_identity_title( esc_html( get_bloginfo( 'name' ) ) );
				elara_site_tagline();
			endif; // display_header_text()

		endif; // $elara_text_logo
	}
endif;

if ( ! function_exists( 'elara_get_entry_first_category' ) ) :
	/**
	 * Get first category for the entry
	 *
	 * @param  int $post_id   Post id
	 * @return string         Returns first category markup
	 */
	function elara_get_entry_first_category( $post_id = null ) {
		if ( $post_id ) {
			$id = $post_id;
		} else {
			$id = get_the_ID();
		}

		$elara_blog_feed_category_show = elara_get_option( 'elara_blog_feed_category_show' );
		$elara_posts_category_show     = elara_get_option( 'elara_posts_category_show' );
		/**
		 * Check for category visibility
		 * @var bool
		 */
		$show = elara_toggle_entry_meta( $elara_blog_feed_category_show, $elara_posts_category_show );

		$categories = get_the_category( $id );

		if ( ! empty( $categories ) ) {
			if ( $show ) :
				echo '<a href="' . esc_url( get_category_link( $categories[0]->term_id ) ) . '">' . esc_html( $categories[0]->name ) . '</a>';
			endif;
		}
	}
endif;
