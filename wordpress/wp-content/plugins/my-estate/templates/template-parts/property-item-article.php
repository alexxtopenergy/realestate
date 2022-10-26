<?php
	require PLUGIN_DIR_PATH . 'templates/template-parts/property-fields.php';
?>

	<li class="property-entry h-100" id="estate-item-<?php echo esc_html( $id ); ?>">
		<a href="<?php echo esc_url( $permalink ); ?>">
			<img src="<?php echo esc_url( $image ); ?>" alt="<?php echo esc_attr( $image_alt ); ?>">

			<div class="property-info property-body p-4">
				<div class="price-row">
					<div class="property-price">$ <?php echo esc_html( $price ); ?></div>
					<h5 class="district"><?php the_taxonomies( array( 'template' => '% %l' ) ); ?></h5>
				</div>
				<h2 class="property-title"><?php echo esc_html( $title ); ?></h2>
				<ul class="property-wrap mb-3 mb-lg-0">
					<?php if ( $rooms ) : ?>
						<li><span><i class="fas fa-bed"></i><?php esc_html_e( 'Rooms: ', 'my_estate' ) . esc_html_e( $rooms ); ?></span></li>
					<?php endif; ?>
					<?php if ( $floor ) : ?>
						<li><span><i class="fas fa-sort-numeric-up-alt"></i><?php esc_html_e( 'Floor: ', 'my_estate' ) . esc_html_e( $floor ); ?></span></li>
					<?php endif; ?>
					<?php if ( $number_of_floors ) : ?>
						<li><span><i class="fas fa-building"></i><?php esc_html_e( 'Number of floors: ', 'my_estate' ) . esc_html_e( $number_of_floors ); ?></span></li>
					<?php endif; ?>
					<?php if ( $materials_used ) : ?>
						<li><span><i class="fas fa-igloo"></i><?php esc_html_e( 'Materials: ', 'my_estate' ) . esc_html_e( $materials_used ); ?></span></li>
					<?php endif; ?>
					<?php if ( $living_area ) : ?>
					<li><span><i class="fas fa-vector-square"></i><?php esc_html_e( 'Living area: ', 'my_estate' ) . esc_html_e( $living_area ); ?></span></li>
					<?php endif; ?>
				</ul>
			</div>
		</a>
	</li>

