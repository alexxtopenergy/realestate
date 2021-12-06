<?php

/**
 * Template loader to use templates in the Theme
 */
class MyEstateTemplateLoader extends Gamajo_Template_Loader {

	/**
	 * Filter prefix
	 *
	 * @var string
	 */
	protected $filter_prefix = 'my-estate';


	/**
	 * Theme Template Directory

	 * @var string
	 */
	protected $theme_template_directory = 'realestate';


	/**
	 * Plugin Directory
	 *
	 * @var string
	 */
	protected $plugin_directory = PLUGIN_DIR_PATH;


	/**
	 * Plugin Template Directory
	 *
	 * @var string
	 */
	protected $plugin_template_directory = 'templates';

	public function __construct() {
		add_filter( 'template_include', array( $this, 'my_estate_templates' ) );
	}

	/**
	 * Templates Priority
	 *
	 * @param $template
	 *
	 * @return string
	 */
	public function my_estate_templates( $template ): string {
		if ( is_post_type_archive( 'real_estate' ) ) {
			$theme_files = array( 'archive-property.php', 'realestate-child/archive-property.php' );
			$exist       = locate_template( $theme_files, false );

			return $exist !== '' ? $exist : PLUGIN_DIR_PATH . 'templates/archive-property.php';

		} elseif ( is_singular( 'real_estate' ) ) {
			$theme_files = array( 'single-property.php', 'realestate-child/single-property.php' );
			$exist       = locate_template( $theme_files, false );

			return $exist !== '' ? $exist : PLUGIN_DIR_PATH . 'templates/single-property.php';
		}

		return $template;
	}
}

$my_estate_template = new MyEstateTemplateLoader();


