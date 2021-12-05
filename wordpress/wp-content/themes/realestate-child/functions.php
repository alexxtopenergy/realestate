<?php

/**
 * Define Script Version
 */
$version_date = gmdate( 'YmdHi' );
define( 'SCRIPT_VERSION', $version_date );


/**
 * Include Custom CSS and Scripts
 */
function real_estate_enqueue_styles() {
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), SCRIPT_VERSION );
	wp_enqueue_script( 'main-script', get_stylesheet_directory_uri() . '/assets/js/script.js', array( 'jquery' ), SCRIPT_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'real_estate_enqueue_styles' );

/**
 * Register Sidebar
 */
function register_my_widgets() {
	register_sidebar(
		array(
			'name'         => 'Main Sidebar',
			'id'           => 'main-sidebar',
			'description'  => 'Description...',
			'before_title' => '<h2>',
			'after_title'  => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'register_my_widgets' );

/**
 * Register Main Menu
 */
register_nav_menus(
	array(
		'main_menu' => __( 'Main Menu', 'realestate' ),
	)
);