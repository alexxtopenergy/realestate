<?php
/**
 * Pagination Template
 */
?>

<div class="row">
	<div class="col-md-12 text-center">
		<div class="property-pagination">
            <!-- ToDo need to test and include -->
			<?php
			if ( $my_estate_posts_query->max_num_pages > 1 ) :
				$paged = ( get_query_var( 'paged' ) ) ? get_query_var( 'paged' ) : 1;
				echo "<script>
                            let ajaxurl = '" . esc_url( site_url() ) . "/wp-admin/admin-ajax.php';
                            let my_estate_posts = '" . serialize( $cat_posts_query->query_vars ) . "';
                            let current_page = " . $paged . ";
                            let max_page = $estate_posts_query->max_num_pages
                        </script>";
				?>
				<button class="show-more"><?php esc_html_e( 'Load More', 'my-estate' ); ?></button>
			<?php endif; ?>
		</div>
	</div>
</div>

