<?php
/*
 * Class MyEstate Helper
 */

class MyEstateHelper {

	public function __construct() {
		add_filter( 'acf/format_value/name=price', array( $this, 'format_number_as_currency' ), 10, 3 );
		add_action( 'pre_get_post', array( $this, 'my_pre_get_posts' ) );
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

		$taxonomy_terms = get_terms(
			$tax_name,
			array(
				'hide_empty' => false,
				'parent'     => 0,
			)
		);

		if ( ! empty( $taxonomy_terms ) ) {
			foreach ( $taxonomy_terms as $term ) {
				if ( $current_term === $term->term_id ) {
					echo '<option value="' . esc_html( $term->term_id ) . '" selected>' . esc_html ($term->name ) . '</option>';
				} else {
					echo '<option value="' . esc_html( $term->term_id ) . '">' . esc_html( $term->name ) . '</option>';
				}
			}
		}
	}
}

$my_estate_helper = new MyEstateHelper();

