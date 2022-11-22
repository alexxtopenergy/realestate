<?php
/**
 * Class My Estate Shortcodes
 */

class MyEstateFilter {

	public function __construct() {
		add_action( 'init', array( $this, 'register_scripts' ) );
		add_action( 'init', array( $this, 'register_shortcode' ) );
	}

	public function register_scripts() {
		add_action( 'wp_enqueue_scripts', array( $this, 'ajax_enqueue_scripts' ), 99 );

		add_action( 'wp_ajax_loadmorebutton', array( $this, 'my_estate_load_more_posts' ) );
		add_action( 'wp_ajax_nopriv_loadmorebutton', array( $this, 'my_estate_load_more_posts' ) );

		add_action( 'wp_ajax_property_filter', array( $this, 'my_ajax_filter_search_callback' ) );
		add_action( 'wp_ajax_nopriv_property_filter', array( $this, 'my_ajax_filter_search_callback' ) );

	}

	public function ajax_enqueue_scripts() {
		global $wp_query;
		$my_estate_ver = new MyEstate();

		wp_register_script( 'ajax_filter', plugins_url( '../assets/front/js/script.js', __FILE__ ), array( 'jquery' ), $my_estate_ver->version, true );
		wp_localize_script(
			'ajax_filter',
			'ajax_object',
			array(
				'url'          => admin_url( 'admin-ajax.php' ),
				'nonce'        => wp_create_nonce( '_wpnonce' ),
				'posts'        => wp_json_encode( $wp_query->query_vars ),
				'current_page' => $wp_query->query_vars['paged'] ? $wp_query->query_vars['paged'] : 1,
				'max_page'     => $wp_query->max_num_pages,
			),
		);
		wp_enqueue_script( 'ajax_filter' );
	}

	public function register_shortcode() {
		// Shortcode: [my_estate_list]
		add_shortcode( 'my_estate_list', array( $this, 'my_estate_filter_shortcode' ) );
	}

	public function my_estate_filter_shortcode( $atts = array() ) {
		extract(
			shortcode_atts(
				array(
					'floor'         => '1',
					'floors_number' => '1',
				),
				$atts
			)
		);

		ob_start();
		?>

		<div id="my-ajax-filter-search">
			<div class="col-md-12 d-flex">
				<div class="col-md-3 flex-direction-column pl-15 pr-15">
					<?php require PLUGIN_DIR_PATH . 'templates/template-parts/property-form.php'; ?>
				</div>
				<div class="col-md-9">
					<ul id="ajax_filter_search_results" class="property-wrap mb-3 mb-lg-0"></ul>
					<button id="my_estate_loadmore" class="load_more_posts"><?php esc_html_e( 'Load More', 'my-estate' ); ?></button>
				</div>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}

	public function my_ajax_filter_search_callback() {

		$min_price      = $_POST['min_price'] ?? '';
		$max_price      = $_POST['max_price'] ?? '';
		$min_area       = $_POST['min_area'] ?? '';
		$max_area       = $_POST['max_area'] ?? '';
		$materials_used = $_POST['materials_used'] ?? '';
		$rooms          = $_POST['rooms'] ?? '';
		$floor          = $_POST['floor'] ?? '';
		$floors_number  = $_POST['floors_number'] ?? '';
		$district       = $_POST['district'] ?? '';
		$items          = $_POST['items'] ?? '';
		$nonce          = $_POST['_nonce'];

		$args = array(
			'orderby'        => 'date',
			'post_type'      => 'real_estate',
			'taxonomy'       => 'district',
			'posts_per_page' => $items,
			'no_found_rows'  => true,
		);

		if ( $min_price || $max_price ) {
			$args['meta_query'] = array( 'relation' => 'AND' );
		}

		if ( $min_price && $max_price ) {
			$args['meta_query'][] = array(
				'key'     => 'price',
				'value'   => array( $min_price, $max_price ),
				'type'    => 'numeric',
				'compare' => 'between',
			);
		}

		if ( $min_price ) {
			$args['meta_query'][] = array(
				'key'     => 'price',
				'value'   => $min_price,
				'type'    => 'numeric',
				'compare' => '>=',
			);
		}

		if ( $max_price ) {
			$args['meta_query'][] = array(
				'key'     => 'price',
				'value'   => $max_price,
				'type'    => 'numeric',
				'compare' => '<=',
			);
		}

		if ( $min_area && $max_area ) {
			$args['meta_query'][] = array(
				'key'     => 'living_area',
				'value'   => array( $min_area, $max_area ),
				'type'    => 'numeric',
				'compare' => 'between',
			);
		}

		if ( $min_area ) {
			$args['meta_query'][] = array(
				'key'     => 'living_area',
				'value'   => $min_area,
				'type'    => 'numeric',
				'compare' => '>=',
			);
		}

		if ( $max_area ) {
			$args['meta_query'][] = array(
				'key'     => 'living_area',
				'value'   => $max_area,
				'type'    => 'numeric',
				'compare' => '<=',
			);
		}

		if ( $rooms ) {
			$args['meta_query'][] = array(
				'key'     => 'rooms',
				'value'   => $rooms,
				'compare' => '=',
			);
		}

		if ( $floor ) {
			$args['meta_query'][] = array(
				'key'     => 'floor',
				'value'   => $floor,
				'compare' => '=',
			);
		}

		if ( $floors_number ) {
			$args['meta_query'][] = array(
				'key'     => 'floors_number',
				'value'   => $floors_number,
				'compare' => '=',
			);
		}

		if ( $materials_used ) {
			$args['meta_query'][] = array(
				'key'     => 'materials_used',
				'value'   => $materials_used,
				'compare' => '=',
			);
		}

		if ( $district ) {
			$args['tax_query'] = array(
				array(
					'taxonomy' => 'district',
					'terms'    => $district,
				),
			);
		}

		if ( empty( $nonce ) && ! wp_verify_nonce( $nonce, 'property_filter' ) ) {
			wp_send_json_error( __( 'Invalid security token sent. Please refresh the page and try again', 'my-estate' ) );
			wp_die();
		}

		query_posts( $args );
		global $wp_query;

		if ( have_posts() ) {
			ob_start();
			while ( have_posts() ) {
				the_post();
				require PLUGIN_DIR_PATH . 'templates/template-parts/property-item-article.php';
			}
			$posts_html = ob_get_contents();
			ob_end_clean();

		} else {
			$posts_html = esc_html__( 'Nothing found for your criteria.', 'my-estate' );
		}

		echo wp_json_encode(
			array(
				'posts'       => wp_json_encode( $wp_query->query_vars ),
				'max_page'    => $wp_query->max_num_pages,
				'found_posts' => $wp_query->found_posts,
				'content'     => $posts_html,
			)
		);
		wp_reset_postdata();
        wp_die();
	}

	public function my_estate_load_more_posts(  ) {

        $nonce = '_nonce';
		if ( empty( $nonce ) && ! wp_verify_nonce( $nonce, 'loadmorebutton' ) ) {
			wp_send_json_error( __( 'Invalid security token sent. Please refresh the page and try again', 'my-estate' ) );
			wp_die();
		}

		$args                = json_decode( stripslashes( $_POST['query'] ), true );
		$args['paged']       = $_POST['page'] + 1;
		$args['post_status'] = 'publish';

		query_posts( $args );

		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				require PLUGIN_DIR_PATH . 'templates/template-parts/property-item-article.php';
			endwhile;
		endif;

		wp_die();

	}

}

new MyEstateFilter();

