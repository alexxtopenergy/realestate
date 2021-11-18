<?php

/**
 * Include Custom CSS and Scripts
 */
function real_estate_enqueue_styles() {
	wp_enqueue_style( 'main-style', get_template_directory_uri() . 'inc/css/main.css', array(), _S_VERSION );
	wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'jquery' ), _S_VERSION, true );
}

add_action( 'wp_enqueue_scripts', 'real_estate_enqueue_styles' );

