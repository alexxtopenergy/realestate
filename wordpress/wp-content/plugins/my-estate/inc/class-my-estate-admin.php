<?php
/**
 * Class My Estate Admin Panel Settings
 */

class MyEstateAdmin {


	public function __construct() {
		add_filter( 'manage_edit-real_estate_columns', array( $this, 'my_estate_custom_admin_columns_title' ) );
		add_action( 'manage_real_estate_posts_custom_column', array( $this, 'my_estate_custom_admin_columns' ) );
	}

	/**
	 *
	 * Custom Admin Columns Title
	 *
	 * @param $columns
	 *
	 * @return string[]
	 */
	public function my_estate_custom_admin_columns_title( $columns ): array {

		return array(
			'cb'            => '<input type="checkbox" />',
			'primary_image' => 'Image',
			'title'         => 'Title',
			'price'         => 'Price',
			'living_area'   => 'Living Area',
			'rooms'         => 'Rooms',
			'street'        => 'Street',
			'date'          => 'Date',
		);
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
				echo '<img src="' . esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full' ) ) . '" width="120px">';
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
}
$my_estate_admin = new MyEstateAdmin();

