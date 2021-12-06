<?php

get_header();

?>

<div class="single-property-section site-section-sm pb-0">

	<div class="hero">
        <div class="row mb-5">
            <?php

            if ( have_posts() ) :
                while ( have_posts() ) :
                    the_post();
                    require PLUGIN_DIR_PATH . 'templates/template-parts/property-item-single.php';
                endwhile;
                wp_reset_postdata();
            endif;
            ?>
        </div>

	</div>

<?php
get_footer();



