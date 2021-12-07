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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );

if ( ! class_exists( 'MyEstateCpt' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-cpt.php';
}

if ( ! class_exists( 'Gamajo_Template_Loader' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-gamajo-template-loader.php';
}

if ( ! class_exists( 'MyEstateTemplateLoader' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-template-loader.php';
}

if ( ! class_exists( 'MyEstateShortcodes' ) ) {
	require PLUGIN_DIR_PATH . 'inc/class-my-estate-shortcodes.php';
}

$GLOBALS['my_query_filters'] = array(
	'rooms'            => 'rooms',
	'floor'            => 'floor',
	'number_of_floors' => 'number_of_floors',
	'living_area'      => 'living_area',
	'price'            => 'price',
	'materials_used'   => 'materials_used',
);


if ( ! class_exists( 'MyEstate' ) ) :

	/**
	 * Class RealEstate
	 */
	class MyEstate {

		/**
		 * Register Scripts and Template
		 */
		public function register() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_front' ) );
			add_filter( 'manage_edit-real_estate_columns', array( $this, 'my_estate_custom_admin_columns_title' ) );
			add_action( 'manage_real_estate_posts_custom_column', array( $this, 'my_estate_custom_admin_columns' ) );
			add_filter( 'acf/format_value/name=price', array( $this, 'format_number_as_currency' ), 10, 3 );
			add_action( 'pre_get_post', array( $this, 'my_pre_get_posts' ) );
			add_action( 'wp_enqueue_scripts', array( $this, 'my_estate_ajax_data' ), 99 );
		}

		/**
		 * Enqueue admin CSS and JS scripts.
		 */
		public function enqueue_front() {
			wp_enqueue_style( 'my_estate_style', plugins_url( '/assets/css/styles.css', __FILE__ ) );
			wp_enqueue_script( 'my_estate_script', plugins_url( '/assets/js/script.js', __FILE__ ), array( 'jquery' ), 1.0, true );
		}

		public function my_estate_ajax_data(){
			wp_localize_script( 'my-estate-ajax-filter', 'ajax_url',
				array(
					'url' => admin_url('admin-ajax.php'),
					'nonce' => wp_create_nonce( '_wpnonce'),
					'title' => esc_html('Ajax Filter', 'my-estate'),
				)
			);
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


		/**
		 * Add better view for Price field
		 *
		 * @param $price_value
		 * @param $post_id
		 * @param $field
		 *
		 * @return mixed|string
		 */
		public function format_number_as_currency( $price_value, $post_id, $field ) {
			if ( $price_value > 0 ) :
				$price_value = number_format( ( $price_value ), 0, '.', ',' );
			endif;

			return $price_value;
		}


		/**
		 * Filter by Taxonomy
		 *
		 * @param $tax_name
		 * @param $current_term
		 */
		public function get_terms_hierarchical( $tax_name, $current_term ) {

			//$html = '';

			$taxanomy_terms = get_terms(
				$tax_name,
				array(
					'hide_empty' => false,
					'parent'     => 0,
				)
			);

			if ( ! empty( $taxanomy_terms ) ) {
				foreach ( $taxanomy_terms as $term ) {
					if ( $current_term == $term->term_id ) {
						echo '<option value="' . $term->term_id . '" selected>' . $term->name . '</option>';
						//html.= '<option value="' . $term->term_id . '" selected>' . $term->name . '</option>';
					} else {
						echo '<option value="' . $term->term_id . '">' . $term->name . '</option>';
						//html.= '<option value="' . $term->term_id . '">' . $term->name . '</option>';
					}
				}
			}
			//return $html;
		}

		/**
		 *
		 * Custom Admin Columns Title
		 *
		 * @param $columns
		 *
		 * @return string[]
		 */
		public function my_estate_custom_admin_columns_title( $columns ) {

			$columns = array(
				'cb'            => '<input type="checkbox" />',
				'primary_image' => 'Image',
				'title'         => 'Title',
				'price'         => 'Price',
				'living_area'   => 'Living Area',
				'rooms'         => 'Rooms',
				'street'        => 'Street',
				'date'          => 'Date',
			);

			return $columns;
		}

		/**
		 * Customise Admin Columns
		 *
		 * @param $column
		 */
		public function my_estate_custom_admin_columns( $column ) {

			global $post;

			switch ( $column ) {
				case 'primary_image':
					echo '<img src="' . esc_html( get_field( 'primary_image', $post->ID )['url'] ) . '" width="120px">';
					break;

				case 'price':
					echo sanitize_text_field( get_field( 'price', $post->ID ) );
					break;

				case 'living_area':
					echo esc_html( get_field( 'living_area', $post->ID ) );
					break;

				case 'rooms':
					echo esc_html( get_field( 'rooms', $post->ID ) );
					break;

				case 'street':
					echo esc_html( get_field( 'street', $post->ID ) );
					break;
			}

		}

	} //End Real Estate Class

endif;

if ( class_exists( 'MyEstate' ) ) :
	$my_estate = new MyEstate();
	$my_estate->register();
endif;

register_activation_hook( __FILE__, array( '$my_estate', 'activation' ) );
register_deactivation_hook( __FILE__, array( '$my_estate', 'deactivation' ) );
register_uninstall_hook( __FILE__, array( '$my_estate', 'uninstall' ) );
