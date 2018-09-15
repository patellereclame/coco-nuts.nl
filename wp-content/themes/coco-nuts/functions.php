<?php

function theme_styles() {

	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );
}

add_action( 'wp_enqueue_scripts', 'theme_styles');

function wpbootstrap_scripts_with_jquery()
{
	// Register the script like this for a theme:
	wp_register_script( 'custom-script', get_template_directory_uri() . '/js/bootstrap.min.js', array( 'jquery' ) );
	// For either a plugin or a theme, you can then enqueue the script:
	wp_enqueue_script( 'custom-script' );
}
add_action( 'wp_enqueue_scripts', 'wpbootstrap_scripts_with_jquery' );

function register_my_menu() {
  register_nav_menu('new-menu',__( 'Sub_Menu' ));
}
add_action( 'init', 'register_my_menu' );


function register_my_menus() {
  register_nav_menus(
    array(
      'new-menu' => __( 'sub_menu' ),
      'another-menu' => __( 'Extra-menu' ),
      'an-extra-menu' => __( 'Srsly-another-menu' ),
			'back-menu' => __( 'menu-back-photo' )
    )
  );
}
add_action( 'init', 'register_my_menus' );


?>
