<?php

get_header();

?>

<div class="property-section site-section-sm pb-0 pt-5">
	<div class="filter-block">
		<div class="container">
			<div class="row">
				<?php require PLUGIN_DIR_PATH . 'templates/template-parts/filter.php'; ?>
			</div>
		</div>
	</div>

	<div class="property-item">
		<div class="container">
			<div class="row mb-5 mt-5 property-item">

				<?php

				if ( ! empty( $submit ) ) {

					$args = array(
						'post_type'      => 'real_estate',
						'posts_per_page' => -1,
						'taxonomy'       => 'district',

						'meta_query'     => array(
							'relation' => 'AND',

							array(
								'key'     => 'rooms',
								'value'   => $rooms,
								'type'    => 'NUMERIC',
								'compare' => '=',
							),

							array(
								'key'     => 'price',
								'value'   => array( $min_price, $max_price ),
								'type'    => 'NUMERIC',
								'compare' => 'BETWEEN',
							),

							array(
								'key'     => 'living_area',
								'value'   => array( $min_area, $max_area ),
								'type'    => 'NUMERIC',
								'compare' => 'BETWEEN',
							),

							array(
								'key'     => 'materials_used',
								'value'   => esc_attr( $materials ),
								'type'    => 'CHAR',
								'compare' => '=',
							),
						),
					);

					$estate_posts_query = new WP_Query( $args );

					if ( $estate_posts_query->have_posts() ) :
						while ( $estate_posts_query->have_posts() ) :
							$estate_posts_query->the_post();
							require PLUGIN_DIR_PATH . 'templates/template-parts/property-item-archive.php';
						endwhile;

						wp_reset_postdata();
					else :
						echo '<p>' . esc_html__( 'Not found... ', 'my-estate' ) . '</p>';
					endif;

				} else {

                    $properties = array(
						 'post_type'      => 'real_estate',
						 'posts_per_page' => -1,
						 'taxonomy'       => 'district',
					 );

					 $properties_posts_query = new WP_Query( $properties );

					 if ( $properties_posts_query->have_posts() ) :
						 while ( $properties_posts_query->have_posts() ) :
							 $properties_posts_query->the_post();
							 require PLUGIN_DIR_PATH . 'templates/template-parts/property-item-archive.php';
						 endwhile;
						 posts_nav_link();
						 wp_reset_postdata();
					else :
						echo '<p>' . esc_html__( 'Not found... ', 'my-estate' ) . '</p>';
					endif;
				}


				?>

			</div>
		</div>
	</div>
</div>
<?php
get_footer();



