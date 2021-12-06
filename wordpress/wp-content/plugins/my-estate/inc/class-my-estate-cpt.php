<?php
/**
 * Class My Estate Custom Post Type
 */

if ( ! class_exists( 'MyEstateCpt' ) ) :

	class MyEstateCpt {

		/**
		 * RealEstate constructor.
		 */
		public function __construct() {
			add_action( 'init', array( $this, 'register_cpt_real_estate' ) );
			add_action( 'init', array( $this, 'register_taxonomy_district' ) );
		}

		/**
		 * Register Post Type: Real Estates.
		 */
		public function register_cpt_real_estate() {

			$labels = array(
				'name'                  => esc_html_x( 'Real Estates', 'real_estate' ),
				'singular_name'         => esc_html_x( 'Real Estate', 'real_estate' ),
				'menu_name'             => esc_html__( 'Real Estate', 'real_estate' ),
				'all_items'             => esc_html__( 'All', 'real_estate' ),
				'add_new'               => esc_html__( 'Add New', 'real_estate' ),
				'add_new_item'          => esc_html__( 'Add New', 'real_estate' ),
				'edit_item'             => esc_html__( 'Edit', 'real_estate' ),
				'new_item'              => esc_html__( 'New', 'real_estate' ),
				'view_item'             => esc_html__( 'View', 'real_estate' ),
				'view_items'            => esc_html__( 'View items', 'real_estate' ),
				'search_items'          => esc_html__( 'Search', 'real_estate' ),
				'not_found_in_trash'    => esc_html__( 'Not found in Trash', 'real_estate' ),
				'featured_image'        => esc_html__( 'Featured Image', 'real_estate' ),
				'set_featured_image'    => esc_html__( 'Set Featured Image', 'real_estate' ),
				'remove_featured_image' => esc_html__( 'Remove Featured Image', 'real_estate' ),
				'use_featured_image'    => esc_html__( 'Use Featured Image', 'real_estate' ),
				'item_published'        => esc_html__( 'Item Published', 'real_estate' ),
				'item_updated'          => esc_html__( 'Item Updated', 'real_estate' ),
			);

			$args = array(
				'label'              => esc_html__( 'Real Estate', 'my-estate' ),
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
				'taxonomies'         => array( 'district' ),

			);

			register_post_type( 'real_estate', $args );
		}


		/**
		 * Register District Taxonomy
		 */
		public function register_taxonomy_district() {

			$labels = array(
				'name'          => esc_html_x( 'District', 'my-estate' ),
				'singular_name' => esc_html_x( 'District', 'my-estate' ),
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
					'slug'       => 'properties/district',
					'with_front' => true,
				),
			);

			register_taxonomy( 'district', array( 'real_estate' ), $args );
		}
	}
endif;

if ( class_exists( 'MyEstateCpt' ) ) :
	$my_estate_cpt = new MyEstateCpt();
endif;
