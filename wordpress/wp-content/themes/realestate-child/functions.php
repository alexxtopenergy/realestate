<?php

/**
 * Define Script Version
 */


/**
 * Include Custom CSS and Scripts
 */
function real_estate_enqueue_styles() {
	wp_enqueue_style( 'main-style', get_stylesheet_directory_uri() . '/assets/css/main.css', array(), gmdate( 'H:i:s' ) );
}
add_action( 'wp_enqueue_scripts', 'real_estate_enqueue_styles' );

/**
 * Register Main Menu
 */
register_nav_menus(
	array(
		'main_menu' => __( 'Main Menu', 'realestate' ),
	)
);

function register_my_widgets() {
	register_sidebar(
		array(
			'name'         => 'Right Sidebar',
			'id'           => 'right-sidebar',
			'description'  => 'Description...',
			'before_title' => '<h2>',
			'after_title'  => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'register_my_widgets' );

add_theme_support( 'post-thumbnails' );

remove_filter( 'render_block', 'wp_render_duotone_support' );
remove_filter( 'render_block', 'wp_restore_group_inner_container' );
remove_filter( 'render_block', 'wp_render_layout_support_flag' );
