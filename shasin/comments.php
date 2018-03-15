<?php
/**
 * The template for displaying comments
 *
 * @package elara
 */
if ( post_password_required() ) { return; }

$elara_commenter = wp_get_current_commenter();
$elara_req = get_option( 'require_name_email' );

$elara_fields = array(
	'author' => '<div class="row"><div class="col-sm-4 col-xs-12"><div class="form-group form-group-author"><label class="form-label form-label-author">'. esc_html__( 'Name', 'elara' ) . ($elara_req ? '<span class="asterik">*</span>' : '') . '</label><input type="text" class="form-control" id="author" name="author" placeholder="" value="' . esc_attr( $elara_commenter['comment_author'] ) . '" /></div>',

	'email' => '<div class="form-group form-group-email"><label class="form-label form-label-email">'. esc_html__( 'Email Address', 'elara' ) .($elara_req ? '<span class="asterik">*</span>' : '') . '</label><input type="email" class="form-control" name="email" id="email" placeholder="" value="' . esc_attr(  $elara_commenter['comment_author_email'] ) . '" /></div>',

	'url' => '<div class="form-group form-group-url"><label class="form-label form-label-url">' . esc_html__( 'Website', 'elara' ) . '</label><input type="text" class="form-control" name="url" id="url" placeholder="" value="' . esc_attr( $elara_commenter['comment_author_url'] ) . '" /></div></div></div>'
);

$elara_comment_field = '<div class="row"><div class="form-group form-group-comment col-sm-8 col-xs-12"><label class="form-label form-label-comment">'. esc_html__( 'Comment', 'elara' ) .'</label><textarea rows="7" cols="" class="form-control" id="comment" name="comment" placeholder=""></textarea></div></div>';

$elara_class_submit = 'btn btn-default';

$elara_comment_form_args = array(
	'fields'        => apply_filters( 'comment_form_default_fields', $elara_fields ),
	'comment_field' => $elara_comment_field,
	'class_submit'  => $elara_class_submit,
	'title_reply'   => esc_html__( 'Share your thoughts', 'elara' ),
	'label_submit'  => esc_html__( 'Submit', 'elara' )
); ?>

<div id="comments" class="comments">

	<?php if ( have_comments() ) { ?>
		<h3 class="comment-title">
			<?php
				printf(
					/* translators: 1: number of comments */
					_nx(
						'%s comment',
						'%s comments',
						get_comments_number(),
						'comments title',
						'elara'
					),
					number_format_i18n( get_comments_number() )
				);
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ul class="comment-list">
			<?php
				wp_list_comments( array(
					'style'       => 'ul',
					'short_ping'  => true,
					'avatar_size' => 0,
					'callback'    => 'elara_html5_comment'
				) );
			?>
		</ul>

		<?php the_comments_navigation(); ?>

	<?php }

	if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) {
		esc_html_e( 'Comments are closed.', 'elara' );
	}

	if ( comments_open() ) {
		if ( get_option( 'comment_registration' ) && ! is_user_logged_in() ) {
			/* Translators: 1: Login URL */
			printf( __( 'You must be <a href="%s">logged in</a> to post a comment.', 'elara' ),
				esc_url( wp_login_url( get_permalink() ) )
			);
		} else {
			comment_form( $elara_comment_form_args );
		}
	} ?>

</div>