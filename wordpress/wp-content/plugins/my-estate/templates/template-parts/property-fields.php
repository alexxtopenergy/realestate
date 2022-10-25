<?php
/**
 * Property Item Template
 */

	global $post;
	$id               = get_the_ID();
	$title            = get_the_title();
	$content          = get_the_content();
	$permalink        = get_permalink();
	$image            = wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full' );
	$image_alt        = get_post_meta( $image, '_wp_attachment_image_alt', true );
	$floor            = get_field( 'floor' );
	$rooms            = get_field( 'rooms' );
	$number_of_floors = get_field( 'number_of_floors' );
	$living_area      = get_field( 'living_area' );
	$materials_used   = get_field( 'materials_used' );
	$price            = get_field( 'price' );
	$street           = get_field( 'street' );
	$primary_image    = get_field( 'primary_image' );
