<?php
/**
 * Uninstall Plugin. Remove Posts
 */

/**
 * Get All Property Posts
 */
$properties = get_post(
	array(
		'post_type'   => TEXT_DOMAIN,
		'numberposts' => -1,
	)
);

/**
 * Remove Property Posts
 */
foreach ( $properties as $property ) {
	wp_delete_post( $property->ID, true );
}
