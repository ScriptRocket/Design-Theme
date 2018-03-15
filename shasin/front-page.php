<?php
/**
 * The front page template file
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package elara
 */
get_header();

$elara_blog_feed_sidebar_position = elara_get_option( 'elara_blog_feed_sidebar_position' ); ?>

<div class="default-background-color">
	<main class="main" role="main">
		<div class="wrapper">
		<h1>Test</h1>
				<?php
					if ( $elara_blog_feed_sidebar_position == 'bottom' ) :
						/**
						 * Banner / Slider section
						 */
						if ( is_front_page() && ! is_paged() ) :
							get_template_part( 'parts/frontpage', 'banner' );
						endif;
					endif;
				?>

				<div class="row">
					<div class="<?php echo esc_attr( elara_set_main_class() ); ?>">
						<?php
							if ( $elara_blog_feed_sidebar_position == 'top' ) :
								/**
								 * Banner / Slider section
								 */
								if ( is_front_page() && ! is_paged() ) :
									get_template_part( 'parts/frontpage', 'banner' );
								endif;
							endif;
                            /**
							 * Frontpage set to Static page
							 */
							if ( get_option( 'show_on_front' ) == 'page' ) :
								/**
								 * Get page content and frontpage sidebar
								 */
								?>
								<div class="entry-singular">
									<div class="entry-content">
										<?php the_content(); ?>
									</div>
								</div><?php
							/**
							 * Frontpage set to Latest posts
							 */
							elseif ( get_option( 'show_on_front' ) == 'posts' ) :
								/**
								 * Blog feed
								 */
								get_template_part( 'parts/feed' );
							endif; //get_option( 'show_on_front' )
							/**
							 * Featured categories
							 */
							if ( is_front_page() && ! is_paged() ) :
								get_template_part( 'parts/frontpage', 'featured-categories' );
							endif;
						?>
					</div><!-- <?php echo esc_attr( elara_set_main_class() ); ?> -->

					<?php elara_show_sidebar(); ?>
				</div><!-- row -->

				
		</div><!-- wrapper -->
	</main>
</div><!-- default-background-color -->

<?php
	/**
	 * Frontpage full width widget area
	 */
	get_sidebar( 'frontpage' );

get_footer();
