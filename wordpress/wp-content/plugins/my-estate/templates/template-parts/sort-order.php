<?php
/**
 * Sort Order Template
 */
?>
<div class="col-md-12">
    <!-- ToDo Add Sort Order and DropDown 5/10/20 posts -->
	<div class="view-options bg-white py-3 px-3 d-md-flex align-items-center">
		<div class="mr-auto">
			<a href="" class="icon-view view-module active"><span class="icon-view_module"></span></a>
			<a href="" class="icon-view view-list"><span class="icon-view_list"></span></a>
		</div>
		<div class="ml-auto d-flex align-items-center">
			<div class="select-wrap">
				<span class="icon icon-arrow_drop_down"></span>
				<select class="form-control form-control-sm d-block">
					<option value=""><?php esc_html_e('Sort by','my-estate'); ?></option>
					<option value=""><?php esc_html_e('Price ASC','my-estate'); ?></option>
					<option value=""><?php esc_html_e('Price DESC','my-estate'); ?></option>
				</select>
			</div>
		</div>
	</div>
</div>
