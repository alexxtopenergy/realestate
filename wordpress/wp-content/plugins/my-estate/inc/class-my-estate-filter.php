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
		wp_register_script( 'ajax_filter', plugins_url( '../assets/front/js/script.js', __FILE__ ), array( 'jquery' ), time(), true );
		wp_localize_script(
			'ajax_filter',
			'ajax_object',
			array(
				'url'          => admin_url( 'admin-ajax.php' ),
				'nonce'        => wp_create_nonce( '_wpnonce' ),
				'posts'        => json_encode( $wp_query->query_vars ),
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
					<button id="my_estate_loadmore" class="load_more_posts"><?php esc_html_e( 'Load More', 'my_estate' ); ?></button>
				</div>
			</div>
		</div>

		<?php
		return ob_get_clean();
	}

	public function my_ajax_filter_search_callback() {

		require PLUGIN_DIR_PATH . 'templates/template-parts/property_atts.php';

		if ( ! empty( $nonce ) && wp_verify_nonce( $nonce, 'property_filter' ) ) {

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
				$posts_html = esc_html_e( 'Nothing found for your criteria.', 'MyEstate' );
			}

			echo json_encode(
				array(
					'posts'       => json_encode( $wp_query->query_vars ),
					'max_page'    => $wp_query->max_num_pages,
					'found_posts' => $wp_query->found_posts,
					'content'     => $posts_html,
				)
			);
			wp_die();
		} else {
			die( 'Nonce is invalid' );
		}
	}

	public function my_estate_load_more_posts() {
		global $wp_query;

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

$my_estate_filter = new MyEstateFilter();

