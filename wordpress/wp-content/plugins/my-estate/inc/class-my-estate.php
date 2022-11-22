<?php

/**
 * Class RealEstate
 */
class MyEstate {



	/**
	 * The current version of the plugin.
	 *
	 * @var String $version
	 */
	public string $version = '1.0.0';

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
		wp_enqueue_style( 'my-estate-style', plugins_url( '../assets/front/css/styles.css', __FILE__ ) );
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

$my_estate = new MyEstate();
$my_estate->register_scripts();

register_activation_hook( __FILE__, array( '$my_estate', 'activation' ) );
register_deactivation_hook( __FILE__, array( '$my_estate', 'deactivation' ) );
register_uninstall_hook( __FILE__, array( '$my_estate', 'uninstall' ) );


