<?php

class AjaxHandler {

	/**
	 * Register the AJAX handler class with all the appropriate WordPress hooks.
	 */
	public static function register() {
		$handler = new self();
		add_action( 'wp_loaded', array( $handler, 'register_script' ) );
		add_action( 'wp_ajax_loadmorebutton', array( $handler, 'my_estate_load_more_posts' ) );
		add_action( 'wp_ajax_nopriv_loadmorebutton', array( $handler, 'my_estate_load_more_posts' ) );
		add_action( 'wp_ajax_property_filter', array( $handler, 'my_ajax_filter_search_callback' ) );
		add_action( 'wp_ajax_nopriv_property_filter', array( $handler, 'my_ajax_filter_search_callback' ) );
	}

	/**
	 * Register our AJAX JavaScript.
	 */
	public function register_script() {

		wp_register_script( 'ajax_filter', plugins_url( '../assets/front/js/script.js', __FILE__ ), array( 'jquery' ), '', true );
		wp_localize_script( 'ajax_filter', 'ajax_object', $this->get_ajax_data() );
		wp_enqueue_script( 'ajax_filter' );
	}

	/**
	 * Get the AJAX data that WordPress needs to output.
	 *
	 * @return array
	 */

	private function get_ajax_data(): array {
		global $wp_query;
		return array(
			'url'          => admin_url( 'admin-ajax.php' ),
			'nonce'        => wp_create_nonce( '_wpnonce' ),
			'posts'        => json_encode( $wp_query->query_vars ),
			'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
			'max_page'     => $wp_query->max_num_pages,
		);
	}
}

AjaxHandler::register();




