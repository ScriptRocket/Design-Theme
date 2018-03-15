<?php
/**
* The template for displaying frontpage full width widgets
*
* @package elara
*/
if ( is_active_sidebar( 'frontpage-full-1' )
	|| is_active_sidebar( 'frontpage-full-2' ) ) : ?>

	<div class="widget-area widget-area-frontpage" role="complementary">
		<?php if ( is_active_sidebar( 'frontpage-full-1' ) ) : ?>
			<div class="default-background-color">
				<div class="widget-area-frontpage-1">
					<div class="wrapper">
						<?php dynamic_sidebar( 'frontpage-full-1' ); ?>
					</div>
				</div>
			</div><!-- default-background-color -->
		<?php endif; ?>
		<?php if ( is_active_sidebar( 'frontpage-full-2' ) ) : ?>
			<div class="widget-area-frontpage-2">
				<div class="wrapper">
					<?php dynamic_sidebar( 'frontpage-full-2' ); ?>
				</div>
			</div>
		<?php endif; ?>
	</div>

<?php endif;