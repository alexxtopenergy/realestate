<?php

	$min_price      = ( isset( $_POST['min_price'] ) ? sanitize_text_field( $_POST['min_price'] ) : '' );
	$max_price      = ( isset( $_POST['max_price'] ) ? sanitize_text_field( $_POST['max_price'] ) : '' );
	$min_area       = ( isset( $_POST['min_area'] ) ? sanitize_text_field( $_POST['min_area'] ) : '' );
	$max_area       = ( isset( $_POST['max_area'] ) ? sanitize_text_field( $_POST['max_area'] ) : '' );
	$materials_used = ( isset( $_POST['materials_used'] ) ? sanitize_text_field( $_POST['materials_used'] ) : '' );
	$rooms          = ( isset( $_POST['rooms'] ) ? sanitize_text_field( $_POST['rooms'] ) : '' );
	$floor          = ( isset( $_POST['floor'] ) ? sanitize_text_field( $_POST['floor'] ) : '' );
	$floors_number  = ( isset( $_POST['floors_number'] ) ? sanitize_text_field( $_POST['floors_number'] ) : '' );
	$district       = ( isset( $_POST['district'] ) ? sanitize_text_field( $_POST['district'] ) : '' );
	$items          = ( isset( $_POST['items'] ) ? sanitize_text_field( $_POST['items'] ) : '' );
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
	} else {
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

		if ( $min_area || $max_area ) {
			$args['meta_query'] = array( 'relation' => 'AND' );
		}

		if ( $min_area && $max_area ) {
			$args['meta_query'][] = array(
				'key'     => 'living_area',
				'value'   => array( $min_area, $max_area ),
				'type'    => 'numeric',
				'compare' => 'between',
			);
		} else {
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
	}

	if ( $district ) {
		$args['tax_query'] = array(
			array(
				'taxonomy' => 'district',
				'terms'    => $district,
			),
		);
	}
