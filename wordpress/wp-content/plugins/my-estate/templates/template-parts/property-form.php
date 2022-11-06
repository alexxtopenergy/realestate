<form action="#" method="post" class="form-search d-flex flex-column"  id="ajax-filter-form">

	<div class="location filter-field">
		<div class="select-wrap">
			<?php
			$terms = get_terms(
				array(
					'taxonomy' => 'district',
					'orderby'  => 'name',
				)
			);
			if ( $terms ) : ?>
				<select name="district" id="district" class="form-control d-block">
					<option value=""><?php esc_html_e( 'Choose District ...', 'my-estate' ); ?></option>;
				<?php
				foreach ( $terms as $term ) :
					echo '<option value="' . esc_html( $term->term_id ) . '">' . esc_html( $term->name ) . '</option>';
				endforeach;
				echo '</select>';
			endif;
			?>
		</div>
	</div>

	<div class="price-field filter-field">
		<input type="text" name="min_price" id="min_price" placeholder="<?php esc_html_e( 'Min Price:', 'my-estate' ); ?>"
				class="d-block filter-input form-control">
		<input type="text" name="max_price" id="max_price" placeholder="<?php esc_html_e( 'Max Price:', 'my-estate' ); ?>"
				class="d-block filter-input form-control ml-15">
	</div>

	<div class="area-field filter-field">
		<input type="number" name="min_area" id="min_area" placeholder="<?php esc_html_e( 'Min Area:', 'my-estate' ); ?>"
				class="d-block filter-input form-control" value="">
		<input type="number" name="max_area" id="max_area" placeholder="<?php esc_html_e( 'Max Area:', 'my-estate' ); ?>"
				class="d-block filter-input form-control ml-15"  value="">
	</div>

	<?php if ( $floor == '1' ) : ?>
	<div class="filter-field">
		<input type="text" name="floor" placeholder="<?php esc_html_e( 'Floor:', 'my-estate' ); ?>"
				class="d-block filter-input form-control">
	</div>
	<?php endif; ?>

	<?php if ( $floors_number == '1' ) : ?>
	<div class="filter-field">
		<input type="text" name="floors_number" placeholder="<?php esc_html_e( 'Number of floors (1-20):', 'my-estate' ); ?>"
			   class="d-block filter-input form-control">
	</div>
	<?php endif; ?>

	<div class="rooms-field filter-field">
		<div class="select-wrap">
			<select name="rooms" id="rooms" class="form-control d-block">
				<option value=""><?php esc_html_e( 'Select Rooms', 'my-estate' ); ?></option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="4">5</option>
			</select>
		</div>
	</div>

	<div class="materials-field filter-field">
		<div class="select-wrap">
			<select type="select" name="materials_used" id="materials_used" class="form-control d-block">
				<option value=""><?php esc_html_e( 'Materials', 'my-estate' ); ?></option>
				<option value="Brick"><?php esc_html_e( 'Brick', 'my-estate' ); ?></option>
				<option value="Panel"><?php esc_html_e( 'Panel', 'my-estate' ); ?></option>
				<option value="Foam Block"><?php esc_html_e( 'Foam Block', 'my-estate' ); ?></option>
			</select>
		</div>
	</div>

	<div class="property-qty filter-field">
		<label for="items"><?php esc_html_e( 'Posts per page:', 'my-estate' ); ?></label>
		<select name="items" id="items">
			<option>2</option>
			<option>5</option>
			<option>10</option>
			<option>20</option>
			<option value="-1">All</option>
		</select>
	</div>

	<?php wp_nonce_field( 'property_filter', '_nonce' ); ?>

	<input type="hidden" name="action" value="property_filter">

	<div class="button-filter">
		<button class="btn btn-success text-white btn-block"><?php esc_html_e( 'Search', 'my-estate' ); ?></button>
	</div>

</form>
