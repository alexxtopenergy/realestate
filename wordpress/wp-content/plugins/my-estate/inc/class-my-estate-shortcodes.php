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
		add_shortcode( 'my_ajax_filter_search', array( $this, 'my_ajax_filter_search_shortcode' ) );

		add_action( 'wp_ajax_my_ajax_filter_search', array( $this, 'my_ajax_filter_search_callback' ) );
		add_action( 'wp_ajax_nopriv_my_ajax_filter_search', array( $this, 'my_ajax_filter_search_callback' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'my_ajax_filter_search' ), 99 );
	}

	public function my_ajax_filter_search() {
		wp_enqueue_script( 'my_ajax_filter_search', plugins_url( '../assets/js/filter.js', __FILE__ ) );
		wp_localize_script(
			'my_ajax_filter_search',
			'ajax',
			array(
				'url'   => admin_url( 'admin-ajax.php' ),
				'nonce' => wp_create_nonce( '_wpnonce' ),
				//'title' => esc_html__( 'Ajax Filter', 'my-estate' ),
			)
		);
	}

	// Shortcode: [my_ajax_filter_search]
	public function my_ajax_filter_search_shortcode() {
		ob_start();
		?>

		<div id="my-ajax-filter-search">
			<form action="" id="ajax-filter-form" class="form-search d-flex justify-content-between" method="get">
				<?php $my_estate_terms_fields = new MyEstate(); ?>

				<input type="text" name="search" id="search" value="" placeholder="<?php esc_html_e( 'Search', 'my-estate' ); ?>">

				<div class="location filter-field">
					<div class="select-wrap">
						<select name="district" id="district" class="form-control d-block">
							<option value=""><?php esc_html_e( 'Location', 'my-estate' ); ?></option>
							<?php $my_estate_terms_fields->get_terms_hierarchical( 'district', $district ); ?>
						</select>
					</div>
				</div>

				<div class="price-field filter-field">
					<input type="number" name="min_price" id="min_price" placeholder="<?php esc_html_e( 'Min Price:', 'my-estate' ); ?>"
						   class="d-block filter-input form-control" value="">
					<input type="number" name="max_price" id="max_price" placeholder="<?php esc_html_e( 'Max Price:', 'my-estate' ); ?>"
						   class="d-block filter-input form-control ml-15"  value="">
				</div>

				<div class="area-field filter-field">
					<input type="number" name="min_area" id="min_area" placeholder="<?php esc_html_e( 'Min Area:', 'my-estate' ); ?>"
						   class="d-block filter-input form-control" value="">
					<input type="number" name="max_area" id="max_area" placeholder="<?php esc_html_e( 'Max Area:', 'my-estate' ); ?>"
						   class="d-block filter-input form-control ml-15"  value="">
				</div>

				<div class="rooms-field filter-field">
					<div class="select-wrap">
						<select name="rooms" id="rooms" class="form-control d-block">
							<option value=""><?php esc_html_e( 'Select Rooms', 'my-estate' ); ?></option>
							<option value="1">1</option>
							<option value="2">2</option>
							<option value="3">3</option>
							<option value="4">4</option>
						</select>
					</div>
				</div>


				<div class="materials-field filter-field">
					<div class="select-wrap">
						<select type="select" name="materials" id="materials" class="form-control d-block">
							<option value=""><?php esc_html_e( 'Materials', 'my-estate' ); ?></option>
							<option value="Brick"><?php esc_html_e( 'Brick', 'my-estate' ); ?>Brick</option>
							<option value="Panel"><?php esc_html_e( 'Panel', 'my-estate' ); ?>Panel</option>
							<option value="Foam Block"><?php esc_html_e( 'Foam Block', 'my-estate' ); ?>Foam Block</option>
						</select>
					</div>
				</div>

				<div class="button-filter">
					<input type="submit" class="btn btn-success text-white btn-block" id="submit" name="submit" value="<?php esc_html_e( 'Search', 'my-estate' ); ?>">
				</div>

			</form>
			<ul id="ajax_filter_search_results" class="property-wrap mb-3 mb-lg-0"></ul>
		</div>

		<?php
		return ob_get_clean();
	}

	public function my_ajax_filter_search_callback() {

		header( 'Content-Type: application/json' );

		$meta_query = array( 'relation' => 'AND' );

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
				'compare' => '>=',
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

		if ( isset( $_GET['rooms'] ) ) {
			$rooms        = sanitize_text_field( $_GET['rooms'] );
			$meta_query[] = array(
				'key'     => 'rooms',
				'value'   => $rooms,
				'compare' => '=',
			);
		}
		/*
		if ( isset( $_GET['floor'] ) ) {
			$floor        = sanitize_text_field( $_GET['floor'] );
			$meta_query[] = array(
				'key'     => 'floor',
				'value'   => $floor,
				'compare' => '=',
			);
		}
		*/
		if ( isset( $_GET['materials'] ) ) {
			$materials    = sanitize_text_field( $_GET['materials'] );
			$meta_query[] = array(
				'key'     => 'materials_used',
				'value'   => $materials,
				'compare' => '=',
			);
		}

		$tax_query = array();

		if ( isset( $_GET['district'] ) ) {
			$district    = sanitize_text_field( $_GET['district'] );
			$tax_query[] = array(
				'taxonomy' => 'district',
				'field'    => 'slug',
				'terms'    => $district,
			);
		}

		$args = array(
			'post_type'      => 'real_estate',
			'posts_per_page' => -1,
			'meta_query'     => $meta_query,
			'tax_query'      => $tax_query,
		);

		if ( isset( $_GET['search'] ) ) {
			$search       = sanitize_text_field( $_GET['search'] );
			$search_query = new WP_Query(
				array(
					'post_type'      => 'real_estate',
					'posts_per_page' => -1,
					'meta_query'     => $meta_query,
					'tax_query'      => $tax_query,
					's'              => $search,
				)
			);
		} else {
			$search_query = new WP_Query( $args );
		}

		if ( $search_query->have_posts() ) {

			$result = array();

			while ( $search_query->have_posts() ) {
				$search_query->the_post();

				$cats     = strip_tags( get_the_category_list( ', ' ) );
				$result[] = array(
					'id'        => get_the_ID(),
					'title'     => get_the_title(),
					'content'   => get_the_content(),
					'permalink' => get_permalink(),
                    'min_price',
					'max_price' => get_field( 'price' ),
					'materials' => get_field( 'materials_used' ),
					'rooms'     => get_field( 'rooms' ),
					'min_area',
					'max_area'  => get_field( 'living_area' ),
					'district'  => $cats,
					'poster'    => wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full' ),
				);
			}
			wp_reset_query();

			echo json_encode( $result );

		} else {
			esc_html_e( 'no posts found...', 'my-estate' );
		}
		wp_die();
	}

}

$my_estate_filter = new MyEstateShortcodes();

