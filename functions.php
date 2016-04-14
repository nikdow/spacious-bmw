<?php
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );
function theme_enqueue_styles() {
    wp_enqueue_style( 'parent-style', get_template_directory_uri() . '/style.css' );

}
function customarchives_where( $x ) {
	return $x . " OR (post_type = 'post' AND post_status = 'private')";
}

if ( is_user_logged_in() ) {
    add_filter( 'getarchives_where', 'customarchives_where' );
}