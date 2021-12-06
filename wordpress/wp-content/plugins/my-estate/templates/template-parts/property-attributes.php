<ul class="property-wrap mb-3 mb-lg-0">

	<?php if ( $street ) : ?>
		<li>
			<span><i class="fas fa-map-marker-alt"></i><?php esc_html_e( 'Street:', 'my-estate' ); ?></span>
			<strong><?php echo esc_html( $street ); ?></strong>
		</li>
	<?php endif; ?>

	<?php if ( $rooms ) : ?>
		<li>
			<span><i class="fas fa-bed"></i><?php esc_html_e( 'Rooms:', 'my-estate' ); ?></span>
			<strong><?php echo esc_html( $rooms ); ?></strong>
		</li>
	<?php endif; ?>


	<?php if ( $floor ) : ?>
		<li>
			<span><i class="fas fa-sort-numeric-up-alt"></i><?php esc_html_e( 'Floor:', 'my-estate' ); ?></span>
			<strong><?php echo esc_html( $floor ); ?></strong>
		</li>
	<?php endif; ?>

	<?php if ( $number_of_floors ) : ?>
		<li>
			<span><i class="fas fa-building"></i><?php esc_html_e( 'Number of Floor:', 'my-estate' ); ?></span>
            <strong><?php echo esc_html( $number_of_floors ); ?> m<sup>2</sup></strong>
		</li>
	<?php endif; ?>

	<?php if ( $living_area ) : ?>
		<li>
			<span><i class="fas fa-vector-square"></i><?php esc_html_e( 'Area:', 'my-estate' ); ?></span>
			<strong><?php echo esc_html( $living_area ); ?></strong>
		</li>
	<?php endif; ?>

	<?php if ( $materials_used ) : ?>
		<li>
			<span><i class="fas fa-igloo"></i><?php esc_html_e( 'Type:', 'my-estate' ); ?></span>
			<strong><?php echo esc_html( $materials_used ); ?></strong>
		</li>
	<?php endif; ?>

</ul>