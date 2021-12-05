<?php

/**
 * Define Script Version
 */
$version_date = date( 'YmdHi' );
define( 'SCRIPT_VERSION', $version_date );


/**
 * Include Custom CSS and Scripts
 */
function real_estate_enqueue_styles() {
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), SCRIPT_VERSION );
	wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'jquery' ), SCRIPT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'real_estate_enqueue_styles' );
