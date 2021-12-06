<?php
/**
 * Filter Template
 */


$min_price       = ( isset( $_GET['$min_price'] ) ? $_GET['$min_price'] : '' );
$max_price       = ( isset( $_GET['max_price'] ) ? $_GET['max_price'] : '' );
$min_area        = ( isset( $_GET['min_area'] ) ? $_GET['min_area'] : '' );
$max_area        = ( isset( $_GET['max_area'] ) ? $_GET['max_area'] : '' );
$materials       = ( isset( $_GET['materials'] ) ? $_GET['materials'] : '' );
$rooms           = ( isset( $_GET['rooms'] ) ? $_GET['rooms'] : '' );
$estate_district = ( isset( $_GET['estate_district'] ) ? $_GET['estate_district'] : '' );
$submit          = ( isset( $_GET['submit'] ) ? $_GET['submit'] : '' );

?>

<form class="form-search d-flex justify-content-between" method="get" action="<?php get_post_type_archive_link( 'real_estate' ); ?>">
	<?php $my_estate_terms_fields = new MyEstate(); ?>

	<div class="location filter-field">
		<div class="select-wrap">
			<select name="estate_district" id="estate_district" class="form-control d-block">
				<option value=""><?php esc_html_e( 'Location', 'my-estate' ); ?></option>
				<?php $my_estate_terms_fields->get_terms_hierarchical( 'district', $estate_district ); ?>
			</select>
		</div>
	</div>

	<?php wp_nonce_field( 'form_on_filter', 'my_estate_filter_nonce' ); ?>

	<div class="price-field filter-field">
		<input type="number" name="min_price" placeholder="<?php esc_html_e( 'Min Price:', 'my-estate' ); ?>"  class="d-block filter-input form-control" value="
			<?php
			if ( isset( $min_price ) ) {
				echo esc_attr( $min_price ); }
			?>
			 ">
		<input type="number" name="max_price" placeholder="<?php esc_html_e( 'Max Price:', 'my-estate' ); ?>" class="d-block filter-input form-control ml-15"  value="
			<?php
			if ( isset( $max_price ) ) {
				echo esc_attr( $max_price ); }
			?>
			 ">
	</div>

	<div class="area-field filter-field">
		<input type="number" name="min_area" placeholder="<?php esc_html_e( 'Min Area:', 'my-estate' ); ?>" class="d-block filter-input form-control" id="min_area" value="
			<?php
			if ( isset( $min_area ) ) {
				echo esc_attr( $min_area ); }
			?>
		 ">

		<input type="number" name="max_area" placeholder="<?php esc_html_e( 'Max Area:', 'my-estate' ); ?>" class="d-block filter-input form-control ml-15" id="max_area" value="
			<?php
			if ( isset( $max_area ) ) {
				echo esc_attr( $max_area ); }
			?>
		 ">
	</div>

	<div class="rooms-field filter-field">

		<div class="select-wrap">
			<select name="rooms" id="rooms" class="form-control d-block">
				<option value=""><?php esc_html_e( 'Select Rooms', 'my-estate' ); ?></option>


				<option value="1"
					<?php
					if ( isset( $rooms ) and $rooms === 1 ) {
						echo esc_attr( 'selected' ); }
					?>
				><?php echo esc_attr( '1' ); ?></option>
				<option value="2"
					<?php
					if ( isset( $rooms ) and $rooms === 2 ) {
						echo esc_attr( 'selected' ); }
					?>
				><?php echo esc_attr( '2' ); ?></option>
				<option value="3"
					<?php
					if ( isset( $rooms ) and $rooms === 3 ) {
						echo esc_attr( 'selected' ); }
					?>
				><?php echo esc_html( '3' ); ?></option>
				<option value="4"
					<?php
					if ( isset( $rooms ) and $rooms === 4 ) {
						echo esc_attr( 'selected' ); }
					?>
				><?php echo esc_attr( '4' ); ?></option>
			</select>
		</div>
	</div>

	<div class="materials-field filter-field">
		<div class="select-wrap">
			<select type="select" name="materials" id="materials" class="form-control d-block">
				<option value=""><?php esc_html_e( 'Materials Used', 'my-estate' ); ?></option>

				<option value="Brick" 
				<?php
				if ( isset( $materials ) and $materials === 'Brick' ) {
					echo esc_attr( 'selected' ); }
				?>
				>
					<?php esc_html_e( 'Brick', 'my-estate' ); ?>
				</option>

				<option value="Panel" 
				<?php
				if ( isset( $materials ) and $materials === 'Panel' ) {
					echo esc_attr( 'selected' ); }
				?>
				>
					<?php esc_html_e( 'Panel', 'my-estate' ); ?>
				</option>

				<option value="Foam Block" 
				<?php
				if ( isset( $materials ) and $materials === 'Foam Block' ) {
					echo esc_attr( 'selected' ); }
				?>
				>
				<?php esc_html_e( 'Foam Block', 'my-estate' ); ?>
				</option>

			</select>
		</div>
	</div>

	<div class="button-filter">
		<input type="submit" name="submit" class="btn btn-success text-white btn-block" value="<?php esc_attr_e( 'Search', 'my-estate' ); ?>">
	</div>


</form>
