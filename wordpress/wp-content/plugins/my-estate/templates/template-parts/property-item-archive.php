<?php
    require PLUGIN_DIR_PATH . 'templates/template-parts/property-fields.php';
?>

<div class="col-md-6 col-lg-4 mb-4">
	<div class="property-entry h-100">
		<a href="<?php the_permalink(); ?>" class="property-thumbnail">
			<?php if ( isset( $primary_image ) ) : ?>
				<img src="<?php echo esc_url( wp_get_attachment_url( get_post_thumbnail_id( $post->ID ), 'full' ) ); ?>" class="img-fluid">
			<?php endif; ?>
		</a>

		<div class="p-4 property-body">
			<div class="price-row">
				<?php if ( $price ) : ?>
					<div class="property-price">$ <?php echo esc_html( $price ); ?> </div>
				<?php endif; ?>

				<?php
				$districts = get_the_terms( get_the_ID(), 'district' );
				foreach ( $districts as $district ) :
					if ( $district ) :
						?>
						<h5 class="district"><?php echo esc_html( $district->name ); ?></h5>
						<?php
					endif;
				endforeach;
				?>
			</div>

			<h2 class="property-title">
				<a href="<?php the_permalink(); ?>"><?php echo esc_html( the_title() ); ?></a>
			</h2>
			<?php
				require PLUGIN_DIR_PATH . 'templates/template-parts/property-attributes.php';
			?>
		</div>
	</div>
</div>
