<?php
/**
 * Template for displaying video modal for video post formats
 *
 * @package elara
 */
if ( 'video' === get_post_format() && elara_get_first_embed_media( get_the_ID() ) ) : ?>
	<div class="modal fade elara-modal-video" id="elara-video-modal-<?php the_ID(); ?>" tabindex="-1" role="dialog">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
					<?php the_title( '<h4 class="entry-title">', '</h4>' ); ?>
				</div>

				<div class="modal-body">
					<?php echo elara_get_first_embed_media( get_the_ID() ); ?>
				</div>
				<div class="modal-footer">
					<a href="<?php the_permalink(); ?>" rel="bookmark"><?php esc_html_e( 'Read more', 'elara' ); ?></a>
				</div>
			</div>
		</div>
	</div>
<?php endif;
