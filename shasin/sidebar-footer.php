<?php
/**
* The template for displaying the footer widgets
*
* @package elara
*/
$elara_example_content  = elara_get_option( 'elara_example_content' );
if ( is_active_sidebar( 'footer-columns-col-1' )
	|| is_active_sidebar( 'footer-columns-col-2' )
	|| is_active_sidebar( 'footer-columns-col-3' )
	|| is_active_sidebar( 'footer-columns-col-4' )
	|| is_active_sidebar( 'footer-columns-col-5' ) ) : ?>

	<div class="widget-area widget-area-footer widget-area-footer-columns" role="complementary">

	<?php
		$elara_active_sidebar = elara_count_footer_sidebars();
		/**
		 * Get sidebar class based on number of active sidebars
		 * @var string
		 */
		$elara_class = elara_get_bootstrap_class( $elara_active_sidebar );

		if ( $elara_active_sidebar > 0 ) : ?>

		<div class="row footer-columns footer-columns-<?php echo esc_attr( $elara_active_sidebar ); ?>">

			<?php
				for ( $elara_i = 1; $elara_i < 6; $elara_i++ ) {
					if ( is_active_sidebar( 'footer-columns-col-' . $elara_i ) ) : ?>
						<div class="<?php echo esc_attr( $elara_class ); ?> footer-columns-col-<?php echo $elara_i; ?>"><?php dynamic_sidebar( 'footer-columns-col-' . $elara_i ); ?></div>
					<?php endif; // is_active_sidebar( 'footer-columns-col-' . $elara_i )
				}
			?>

		</div><!-- row footer-columns" -->

	<?php endif; // $elara_active_sidebar > 0 ?>

	</div><!-- widget-area widget-area-footer -->

<?php elseif ($elara_example_content == 1) : ?>


    <div class="widget-area widget-area-footer widget-area-footer-columns" role="complementary">

        <?php
            $elara_active_sidebar = 5;
            $elara_class = elara_get_bootstrap_class( $elara_active_sidebar );
        ?>

        <div class="row footer-columns footer-columns-<?php echo esc_attr( $elara_active_sidebar ); ?>">

            <?php
                for ( $elara_i = 1; $elara_i < 6; $elara_i++ ) { ?>
                    <div class="<?php echo esc_attr( $elara_class ); ?> footer-columns-col-<?php echo $elara_i; ?>">
                        <?php elara_example_sidebar_footer( $elara_i ); ?>
                    </div>
            <?php } ?>

        </div><!-- row footer-columns" -->

	</div><!-- widget-area widget-area-footer -->
    
    
<?php endif; // any of footer sidebars is active