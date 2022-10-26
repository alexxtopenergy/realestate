<?php

class MyEstateLoadTemplate {

	public function __construct() {
		add_filter( 'single_template', array( $this, 'my_estate_single_property_template' ) );
		add_filter( 'archive_template', array( $this, 'my_estate_archive_property_template' ) );
	}

	public function my_estate_single_property_template( $template ) {

		if ( is_single() && get_post_type() == 'real_estate' ) {
			$template = PLUGIN_DIR_PATH . '/templates/single-property.php';
		}
		return $template;

	}

	public function my_estate_archive_property_template( $archive_template ) {

		if ( is_archive() && get_post_type() == 'real_estate' ) {
			$archive_template = PLUGIN_DIR_PATH . '/templates/archive-property.php';
		}
		return $archive_template;
	}
}

$my_estate_load_template = new MyEstateLoadTemplate();
