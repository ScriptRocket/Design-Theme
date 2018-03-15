<?php
/**
* The template for displaying the header widgets
*
* @package elara
*/
$elara_example_content  = elara_get_option( 'elara_example_content' );
if ( $elara_example_content == 0 &&
	! is_active_sidebar( 'sidebar-top-left' ) &&
	! is_active_sidebar( 'sidebar-top-center' ) &&
	! is_active_sidebar( 'sidebar-top-right' ) ) {
	return;
}
?>
<div class="widget-area widget-area-header">
	<div class="container-wrap">
		<div class="wrapper">
			<div class="row">
				<div class="sidebar-top sidebar-top-left col-md-4 col-xs-12">
					<?php if ( is_active_sidebar( 'sidebar-top-left' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-top-left' ); ?>
					<?php elseif ($elara_example_content == 1) : ?>
						<?php elara_example_sidebar_header('left'); ?>
					<?php endif; ?>
				</div>
				<div class="sidebar-top sidebar-top-center col-md-4 col-xs-12">
					<?php if ( is_active_sidebar( 'sidebar-top-center' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-top-center' ); ?>
					<?php endif; ?>
				</div>
				<div class="sidebar-top sidebar-top-right col-md-4 col-xs-12">
					<?php if ( is_active_sidebar( 'sidebar-top-right' ) ) : ?>
						<?php dynamic_sidebar( 'sidebar-top-right' ); ?>
					<?php elseif ($elara_example_content == 1) : ?>
						<?php elara_example_sidebar_header('right'); ?>
					<?php endif; ?>
				</div>
			</div><!-- row -->
		</div><!-- wrapper -->
	</div><!-- container-wrap -->
</div><!-- widget-area widget-area-header -->
<div class="header-toggle"><i class="fa fa-angle-down"></i></div>
