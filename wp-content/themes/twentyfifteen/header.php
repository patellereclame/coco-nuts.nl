<?php
/**
 * The template for displaying the header
 *
 * Displays all of the head element and everything up until the "site-content" div.
 *
 * @package WordPress
 * @subpackage Twenty_Fifteen
 * @since Twenty Fifteen 1.0
 */
?><!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<link rel="stylesheet" href="<?php echo esc_url( get_template_directory_uri() ); ?>/css/bootstrap.css">
	<!--[if lt IE 9]>
	<script src="<?php echo esc_url( get_template_directory_uri() ); ?>/js/html5.js"></script>
	<![endif]-->
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<nav class="navbar navbar-expand-md navbar-light bg-light" role="navigation">


		<!-- Brand and toggle get grouped for better mobile display -->
		<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-controls="bs-example-navbar-collapse-1" aria-expanded="false" aria-label="Toggle navigation">
			<span class="navbar-toggler-icon"></span>
		</button>

			<?php
			wp_nav_menu( array(
				'theme_location'    => 'primary',
				'depth'             => 2,
				'ul class'					=> 'justify-content-end',
				'container'         => 'div',
				'container_class'   => 'collapse navbar-collapse',
				'container_id'      => 'bs-example-navbar-collapse-1',
				'menu_class'        => 'nav navbar-nav',
				'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
				'walker'            => new WP_Bootstrap_Navwalker(),
			) );
			?>

	</nav>

	<div class="overlay-palm">
		<img src="<?php echo get_stylesheet_directory_uri();?>/imgs/overlay2.png"/>
	</div>

	<div class="overlay-palm-right">
		<img src="<?php echo get_stylesheet_directory_uri();?>/imgs/overlay1.png"/>
	</div>



		<header id="masthead" class="site-header" role="banner">
			<div class="row">
			<div class="site-branding">

			</div>
		</div><!-- .site-branding -->
		</header><!-- .site-header -->

<div class="logo-left">
		<div class="container no-yellow">
			<div class="row">
			<div class="content">
				<a class="navbar-brand col-md-12" href="#"><img class="logo" src="wp-content/uploads/2018/08/cropped-Logo-CoCo-NuTs.png" width="150px" height="auto"/></a>
			</div>
		</div>
	</div>
</div>
