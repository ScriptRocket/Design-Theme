<?php
/**
 * Site Identity
 *
 * Template part for rendering site name, tagline and logo
 *
 * @package elara
 */
?>
<div class="default-background-color">
	<div class="logo">
		<?php
			/**
			 * Make sure we see the change between image and text in customizer preview
			 * on selective refresh
			 */
			if ( function_exists( 'get_theme_mod' ) || is_customize_preview() ) :
				/**
				 * Check if we want to show the logo
				 */
				if ( elara_get_option( 'elara_image_logo_show' ) ) :
					/**
					 * If we do, in fact, have an image
					 * show it
					 */
					if ( has_custom_logo() ) :
						if ( function_exists( 'the_custom_logo' ) ) :
							the_custom_logo();
						endif;
					/**
					 * If no image is selected and options
					 * are set to show logo, show text logo instead
					 */
					else :
						elara_site_identity();

					endif;
				else :
					elara_site_identity();

				endif; // elara_get_option( 'elara_image_logo_show' )

			endif; //  function_exists( 'get_theme_mod' ) || is_customize_preview()
		?>
	</div><!-- .logo -->
</div><!-- default-background-color -->