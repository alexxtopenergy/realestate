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

if ( ! class_exists( 'MyEstateCpt' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-cpt.php';
}

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

if ( ! class_exists( 'MyEstate' ) ) :

	/**
	 * Class RealEstate
	 */
	class MyEstate {

		/** @var string The plugin version number. */

		/**
		 * Register Scripts and Template
		 */
		public function register_scripts() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front' ) );
		}

		/**
		 * Register the stylesheets for the front-end side of the site.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_front() {
			wp_enqueue_style( 'my-estate-style', plugins_url( 'assets/front/css/styles.css', __FILE__ ) );
		}

		/**
		 * Plugin Activation.
		 */
		public static function activation() {
			flush_rewrite_rules();
		}

		/**
		 * Plugin Deactivation.
		 */
		public static function deactivation() {
			flush_rewrite_rules();
		}

	}

endif;

if ( class_exists( 'MyEstate' ) ) :
	$my_estate = new MyEstate();
	$my_estate->register_scripts();

endif;

register_activation_hook( __FILE__, array( '$my_estate', 'activation' ) );
register_deactivation_hook( __FILE__, array( '$my_estate', 'deactivation' ) );
register_uninstall_hook( __FILE__, array( '$my_estate', 'uninstall' ) );
