<?php
/**
 * Class My Estate Custom Post Type
 */

class MyEstateCPT {

	const POST_TYPE     = 'real_estate';
	const POST_TAXONOMY = 'district';
	const TEXT_DOMAIN   = 'my-estate';

	private string $post_type;
	private string $post_taxonomy;


	/**
	 * RealEstate constructor.
	 */
	public function __construct() {
		$this->post_type     = self::POST_TYPE;
		$this->post_taxonomy = self::POST_TAXONOMY;
		add_action( 'init', array( $this, 'register_cpt_real_estate' ) );
		add_action( 'init', array( $this, 'register_taxonomy_district' ) );
	}

	/**
	 * Register Post Type: Real Estates.
	 */
	public function register_cpt_real_estate() {

		$labels = array(
			'name'                  => _x( 'Real Estates', self::TEXT_DOMAIN ),
			'singular_name'         => _x( 'Real Estate', self::TEXT_DOMAIN ),
			'menu_name'             => __( 'Real Estate', self::TEXT_DOMAIN ),
			'all_items'             => __( 'All', self::TEXT_DOMAIN ),
			'add_new'               => __( 'Add New', self::TEXT_DOMAIN ),
			'add_new_item'          => __( 'Add New', self::TEXT_DOMAIN ),
			'edit_item'             => __( 'Edit', self::TEXT_DOMAIN ),
			'new_item'              => __( 'New', self::TEXT_DOMAIN ),
			'view_item'             => __( 'View', self::TEXT_DOMAIN ),
			'view_items'            => __( 'View items', self::TEXT_DOMAIN ),
			'search_items'          => __( 'Search', self::TEXT_DOMAIN ),
			'not_found_in_trash'    => __( 'Not found in Trash', self::TEXT_DOMAIN ),
			'featured_image'        => __( 'Featured Image', self::TEXT_DOMAIN ),
			'set_featured_image'    => __( 'Set Featured Image', self::TEXT_DOMAIN ),
			'remove_featured_image' => __( 'Remove Featured Image', self::TEXT_DOMAIN ),
			'use_featured_image'    => __( 'Use Featured Image', self::TEXT_DOMAIN ),
			'item_published'        => __( 'Item Published', self::TEXT_DOMAIN ),
			'item_updated'          => __( 'Item Updated', self::TEXT_DOMAIN ),
		);

		$args = array(
			'label'              => __( 'Real Estate', self::TEXT_DOMAIN ),
			'labels'             => $labels,
			'description'        => '',
			'public'             => true,
			'publicly_queryable' => true,
			'show_ui'            => true,
			'has_archive'        => true,
			'show_in_menu'       => true,
			'show_in_nav_menus'  => true,
			'capability_type'    => 'post',
			'hierarchical'       => true,
			'rewrite'            => array(
				'slug'       => 'properties',
				'with_front' => true,
			),
			'query_var'          => true,
			'menu_icon'          => 'dashicons-admin-home',
			'supports'           => array( 'title', 'editor', 'thumbnail', 'custom-fields' ),
			'show_in_graphql'    => false,
			'taxonomies'         => array( self::POST_TAXONOMY ),

		);
		register_post_type( self::POST_TYPE, $args );

	}


	/**
	 * Register District Taxonomy
	 */
	public function register_taxonomy_district() {

		$labels = array(
			'name'          => _x( 'District', self::TEXT_DOMAIN ),
			'singular_name' => _x( 'District', self::TEXT_DOMAIN ),
		);

		$args = array(
			'label'             => '',
			'labels'            => $labels,
			'public'            => true,
			'hierarchical'      => true,
			'show_ui'           => true,
			'show_in_menu'      => true,
			'show_admin_column' => true,
			'show_in_nav_menus' => true,
			'query_var'         => true,
			'rewrite'           => array(
				'slug'       => self::POST_TAXONOMY,
				'with_front' => true,
			),
		);

		register_taxonomy( self::POST_TAXONOMY, array( self::POST_TYPE ), $args );
	}
}
new MyEstateCPT();

