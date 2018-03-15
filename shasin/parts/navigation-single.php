<?php
/**
 * Posts navigation
 *
 * Template part for displaying previous and next post link on single post.
 *
 * @package elara
 */
$args = array(
	'prev_text' => elara_fontawesome_icon( 'long-arrow-left', false ) . ' %title',
	'next_text' => '%title ' . elara_fontawesome_icon( 'long-arrow-right', false ),
);

the_post_navigation( $args );
