<?php
/**
 * The template for displaying the footer
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package elara
 */
$elara_active_sidebar = elara_count_footer_sidebars();
if ( $elara_active_sidebar > 1 ) {
	$elara_footer_class = 'columns';
} else {
	$elara_footer_class = 'center';
}
?>
	<div class="footer footer-<?php echo esc_attr( $elara_footer_class ); ?>" role="contentinfo">
		<div class="default-background-color">
			<div class="wrapper">
			<?php
				/**
				 * Footer widget area
				 */
				get_sidebar( 'footer' ); ?>

				<div class="footer-copyrights">
					<ul>
						<li class="credits">
                            <a href="https://www.lyrathemes.com/elara/" target="_blank"><?php esc_html_e('Elara', 'elara'); ?></a> <?php esc_html_e('by LyraThemes', 'elara'); ?>
                        </li>

						<li>
							<?php $elara_footer_copyright = elara_get_option( 'elara_footer_copyright' );

							if ( $elara_footer_copyright ) : ?>
								<?php echo wp_kses_post( $elara_footer_copyright ); ?>
							<?php endif; // $elara_footer_copyright ?>
						</li>
					</ul>
				</div><!-- footer-copyrights -->

			</div><!-- wrapper -->
		</div><!-- default-background-color -->
	</div><!-- footer -->

<?php wp_footer(); ?>
</body>
</html>