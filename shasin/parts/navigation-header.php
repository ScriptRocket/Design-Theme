<?php
/**
 * Navigation Header
 *
 * Template part for rendering header navigation.
 *
 * @package elara
 */
?>
<div class="default-background-color">
	<div class="wrapper wrapper-nav">
		<nav class="main-navbar navbar navbar-default" id="main-navbar">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".wrapper-nav .navbar-collapse" aria-expanded="false">
					<span class="sr-only"><?php esc_html_e( 'Toggle Navigation', 'elara' ); ?></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
			</div>
		<?php
			if ( has_nav_menu( 'header' ) ) :
				$elara_args = array(
					'theme_location'    => 'header',
					'depth'             => 2,
					'container'         => 'div',
					'container_id'      => 'main-menu',
					'container_class'   => 'navbar-collapse collapse menu-container',
					'menu_class'        => 'nav navbar-nav menu',
					'fallback_cb'       => '',
					'walker'            => new wp_bootstrap_navwalker()
				);

				wp_nav_menu( $elara_args );

			else :

				elara_default_nav();

			endif; // has_nav_menu( 'header' )
		?>
	</div><!-- wrapper -->
</div><!-- default-background-color -->