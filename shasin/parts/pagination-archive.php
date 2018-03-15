<?php
/**
 * Archive pagination
 *
 * Template part for displaying numbered pagination on archives.
 *
 * @package elara
 */


$args['prev_text'] = esc_html__( 'Prev', 'elara' );
$args['next_text'] = esc_html__( 'Next', 'elara' );

the_posts_pagination( $args );