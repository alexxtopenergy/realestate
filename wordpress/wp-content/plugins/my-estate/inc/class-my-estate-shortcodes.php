<?php
/**
 * Class My Estate Shortcodes
 */


class MyEstateShortcodes {

	public $my_estate_filter;
	/**
	 * @var MyEstate
	 */


	public function __construct() {
		add_action( 'init', array( $this, 'register_shortcode' ) );
	}
	public function register_shortcode() {
		add_shortcode( 'my_estate_list', array( $this, 'filter_shortcode' ) );
		add_action( 'wp_ajax_my_ajax_filter_search', array( $this, 'my_estate_ajax_filter_callback' ) );
		add_action( 'wp_ajax_nopriv_my_ajax_filter_search', array( $this, 'my_estate_ajax_filter_callback' ) );
		add_action( 'wp_ajax_send_message_form', array( $this, 'handle_message_form' ) );
		add_action( 'wp_ajax_nopriv_send_message_form', array( $this, 'handle_message_form' ) );
	}

	public function handle_message_form() {

		if ( ! isset( $_GET['my_estate_nonce'] ) || ! wp_verify_nonce( $_GET['my_estate_nonce'], 'form_on_submit' ) ) {

			wp_send_json_error(
				array(
					'message' => 'fail',
				)
			);

		}
		wp_send_json_success( $_GET );

	}

	public function filter_shortcode( $atts = array() ) {
		extract(
			shortcode_atts(
				array(
					'materials' => '0',
					'rooms'     => '0',
				),
				$atts
			)
		);

		$my_estate = new MyEstate();

		ob_start(); ?>

		<div id="my-estate-ajax-filter">

			<form class="form-search d-flex justify-content-between" method="get" action="<?php get_post_type_archive_link( 'real_estate' ); ?>">
				<?php $my_estate_terms_fields = new MyEstate(); ?>

				<div class="location filter-field">
					<div class="select-wrap">
						<select name="estate_district" id="estate_district" class="form-control d-block">
							<option value=""><?php esc_html_e( 'Location', 'my-estate' ); ?></option>
							<?php $my_estate_terms_fields->get_terms_hierarchical( 'district', $estate_district ); ?>
						</select>
					</div>
				</div>

				<?php wp_nonce_field( 'form_on_submit', 'my_estate_nonce' ); ?>

				<div class="price-field filter-field">
					<input type="number"
						name="min_price"
						placeholder="<?php esc_html_e( 'Min Price:', 'my-estate' ); ?>"
						class="d-block filter-input form-control"
						id="min_price"
						value="
						<?php
						if ( isset( $min_price ) ) {
							echo esc_attr( $min_price );}
						?>
					">
					<input type="number"
						name="max_price"
						placeholder="<?php esc_html_e( 'Max Price:', 'my-estate' ); ?>"
						class="d-block filter-input form-control ml-15"
						id="max_area"
						value="
						<?php
						if ( isset( $max_price ) ) {
							echo esc_attr( $max_price ); }
						?>
						">
				</div>

				<div class="area-field filter-field">
					<input
						type="number"
						name="min_area"
						placeholder="<?php esc_html_e( 'Min Area:', 'my-estate' ); ?>"
						class="d-block filter-input form-control"
						id="min_area"
						value="
						<?php
						if ( isset( $min_area ) ) {
							echo esc_attr( $min_area ); }
						?>
					">

					<input type="number"
						name="max_area"
						placeholder="<?php esc_html_e( 'Max Area:', 'my-estate' ); ?>"
						class="d-block filter-input form-control ml-15"
						id="max_area"
						value="
						<?php
						if ( isset( $max_area ) ) {
							echo esc_attr( $max_area ); }
						?>
					">
				</div>

				<?php if ( $rooms == 1 ) : ?>
				<div class="rooms-field filter-field">
					<div class="select-wrap">
						<select name="rooms" id="rooms" class="form-control d-block">
							<option value="">
								<?php esc_html_e( 'Select Rooms', 'my-estate' ); ?>
							</option>
							<option value="1" 
							<?php
							if ( isset( $rooms ) and $rooms === 1 ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php echo esc_attr( '1' ); ?>
							</option>
							<option value="2" 
							<?php
							if ( isset( $rooms ) and $rooms === 2 ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php echo esc_attr( '2' ); ?></option>
							<option value="3" 
							<?php
							if ( isset( $rooms ) and $rooms === 3 ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php echo esc_html( '3' ); ?></option>
							<option value="4" 
							<?php
							if ( isset( $rooms ) and $rooms === 4 ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php echo esc_attr( '4' ); ?></option>
						</select>
					</div>
				</div>
				<?php endif; ?>

				<?php if ( $materials === 1 ) : ?>
				<div class="materials-field filter-field">
					<div class="select-wrap">
						<select type="select" name="materials" id="materials" class="form-control d-block">
							<option value=""><?php esc_html_e( 'Materials Used', 'my-estate' ); ?></option>
							<option value="Brick"
							<?php
							if ( isset( $materials ) and $materials === 'Brick' ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php esc_html_e( 'Brick', 'my-estate' ); ?>
							</option>
							<option value="Panel"
							<?php
							if ( isset( $materials ) and $materials === 'Panel' ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php esc_html_e( 'Panel', 'my-estate' ); ?>
							</option>
							<option value="Foam Block"
							<?php
							if ( isset( $materials ) and $materials === 'Foam Block' ) {
								echo esc_attr( 'selected' ); }
							?>
							>
								<?php esc_html_e( 'Foam Block', 'my-estate' ); ?>
							</option>
						</select>
					</div>
				</div>
				<?php endif; ?>

				<div class="button-filter">
					<input type="submit" name="submit" id="submit" class="btn btn-success text-white btn-block" value="<?php esc_attr_e( 'Search', 'my-estate' ); ?>">
				</div>
			<ul id="ajax_filter_search_results"></ul>
		</div>

		<?php
		return ob_get_clean();
	}

	/**
	 * Ajax Filter
	 */

	public function my_estate_ajax_filter_callback() {

		header( 'Content-Type: application/json' );

		$meta_query = array( 'relation' => 'AND' );

		if ( isset( $_GET['rooms'] ) ) {
			$rooms        = sanitize_text_field( $_GET['rooms'] );
			$meta_query[] = array(
				'key'     => 'rooms',
				'value'   => $rooms,
				'compare' => '=',
			);
		}

		if ( isset( $_GET['min_price'] ) ) {
			$min_price    = sanitize_text_field( $_GET['min_price'] );
			$meta_query[] = array(
				'key'     => 'price',
				'value'   => $min_price,
				'compare' => '>=',
			);
		}

		if ( isset( $_GET['max_price'] ) ) {
			$max_price    = sanitize_text_field( $_GET['max_price'] );
			$meta_query[] = array(
				'key'     => 'price',
				'value'   => $max_price,
				'compare' => '<=',
			);
		}

		if ( isset( $_GET['min_area'] ) ) {
			$min_area     = sanitize_text_field( $_GET['min_area'] );
			$meta_query[] = array(
				'key'     => 'living_area',
				'value'   => $min_area,
				'compare' => '>=',
			);
		}

		if ( isset( $_GET['max_area'] ) ) {
			$max_area     = sanitize_text_field( $_GET['max_area'] );
			$meta_query[] = array(
				'key'     => 'living_area',
				'value'   => $max_area,
				'compare' => '<=',
			);
		}
		if ( isset( $_GET['materials'] ) ) {
			$materials    = sanitize_text_field( $_GET['materials'] );
			$meta_query[] = array(
				'key'     => 'materials_used',
				'value'   => $materials,
				'compare' => '=',
			);
		}

		$tax_query = array();

		if ( isset( $_GET['estate_district'] ) ) {
			$estate_district = sanitize_text_field( $_GET['estate_district'] );
			$tax_query[]     = array(
				'taxonomy' => 'district',
				'field'    => 'slug',
				'terms'    => $estate_district,
			);
		}

		$args = array(
			'post_type'      => 'real_estate',
			'posts_per_page' => -1,
			'meta_query'     => $meta_query,
			'tax_query'      => $tax_query,
		);

		if ( isset( $_GET['submit'] ) ) {
			$submit       = sanitize_text_field( $_GET['submit'] );
			$search_query = new WP_Query(
				array(
					'post_type'      => 'real_estate',
					'posts_per_page' => -1,
					'meta_query'     => $meta_query,
					'tax_query'      => $tax_query,
					's'              => $submit,
				)
			);
		} else {
			$search_query = new WP_Query( $args );
		}

		if ( $search_query->have_posts() ) {

			$result = array();

			while ( $search_query->have_posts() ) {
				$search_query->the_post();

				//$cats = strip_tags( get_the_category_list( ', ' ) );

				$result[] = array(
					'id'               => get_the_ID(),
					'title'            => get_the_title(),
					'content'          => get_the_content(),
					'permalink'        => get_permalink(),
					'price'            => get_field( 'price' ),
					'living_area'      => get_field( 'living_area' ),
					'floors'           => get_field( 'floors' ),
					'number_of_floors' => get_field( 'number_of_floors' ),
					//'district'      => $cats,
					'primary_image'    => get_field( 'primary_image' ),
				);
			}
			wp_reset_query();

			echo json_encode( $result );

		} else {
			// no posts found
		}
		wp_die();
	}






}

$my_estate_filter = new MyEstateShortcodes();
