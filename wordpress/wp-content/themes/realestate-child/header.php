<?php
/**
 * Real Estate Header
 *
 * @package realestate
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<?php wp_body_open(); ?>
	<div id="page" class="site">

		<header class="site-header">
			<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
				<div class="container">
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarDropdown" aria-controls="navbarDropdown" aria-expanded="false" aria-label="Toggle navigation">
						<span class="navbar-toggler-icon"></span>
					</button>
					<a class="navbar-brand col-md-4" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
					<div class="collapse navbar-collapse col-md-8" id="navbarDropdown">
						<?php
						wp_nav_menu(
							array(
								'theme_location'  => 'main_menu',
								'menu_id'         => 'primary-menu',
								'container_class' => 'header_nav',
								'menu_class'      => 'header_nav_list',
								'add_li_class'    => 'nav_item',
							)
						);
						?>

					</div>
				</div>
			</nav>
		</header>
