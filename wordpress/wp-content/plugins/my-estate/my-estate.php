<?php
/**
Plugin Name: My Estate
Plugin URI: https://sigma.software
Description: Plugin for Real Estate.
Version: 1.0.0
Author: Oleksandr Popov
Author URI: https://sigma.software
License: GPLv2 or later
Text Domain: my-estate
 */

define( 'PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
define( 'PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) );

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! class_exists( 'ACF' ) ) {
	echo esc_html( 'ACF plugin must be installed' );
}

if ( ! class_exists( 'MyEstate' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate.php';
}

if ( ! class_exists( 'MyEstateCpt' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-cpt.php';
}

//if ( ! class_exists( 'AjaxHandler' ) ) {
//	require PLUGIN_DIR_PATH . 'inc/class-my-estate-ajax-handler.php';
//}

if ( ! class_exists( 'MyEstateFilter' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-filter.php';
}

if ( ! class_exists( 'MyEstateAdmin' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-admin.php';
}

if ( ! class_exists( 'MyEstateLoadTemplate' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-load-template.php';
}

if ( ! class_exists( 'MyEstateHelper' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-helper.php';
}


