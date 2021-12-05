<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package realestate
 */

?>

	<footer class="site-footer">
		<div class="container">
			<div class="text-center">Copyright &copy; - <?php esc_attr_e( date( 'Y' ) ); ?></div>
		</div>

	</footer>

</div><!-- #page -->

<?php wp_footer(); ?>
<!-- Bootstrap -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<!-- FontAwesome Kit -->
<script src="https://kit.fontawesome.com/59a5687498.js" crossorigin="anonymous"></script>

</body>

</html>
