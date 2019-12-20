<?php

//menus <===============================
function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'extra-menu'  => __( 'Extra Menu' )
		)
	);
}

add_action( 'init', 'register_my_menus' );

//bootstrap <==============================
function add_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.css', array(), '1.1', 'all' );

	$tname = (string)basename( get_page_template());//registration js
	if ($tname == 'registration.php')
	{
		wp_enqueue_script( 'register-script', get_template_directory_uri() . '/register.js', array( 'jquery' ), 1.1, true  );
		wp_localize_script( 'register-script', 'url', 'http://wp-student.ru/wp-json/customt/registration' );
	}

	if ($tname = 'single-device.php')
	{
		wp_enqueue_script( 'register-script', get_template_directory_uri() . '/classes/favorite-devices-widget/FavoriteDevicesWidget.js', array( 'jquery' ), 1.1, true  );
		wp_localize_script( 'register-script', 'url', 'http://wp-student.ru/wp-json/customt/favorite_add_route' );
	}

	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.js', array( 'jquery' ), 1.1, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

require 'classes/Sidebars.php';
new Sidebars();

//require 'classes/custom-post-types/DevicePostType.php';
//new DevicePostType();


//require 'classes/custom-post-types/MyPostTypes.php';
//new MyPostTypes();

require 'classes/custom-post-types/CustomPostType.php';
CustomPostType::MakeAllPostTypes();

require 'classes/ReleaseYearMetabox.php';
new ReleaseYearMetabox( 'release-year', 'Release Year' );

require 'classes/GenerationMetabox.php';
new GenerationMetabox( 'generation', 'GEN' );

require 'classes/VendorTaxonomy.php';
new VendorTaxonomy();

require 'classes/DevicesShortcode.php';
new DeviceShortcode();

//tax-filter-widget
require 'classes/tax-filter-wp-widget/tax-filter-wp-widget.php';
new Filter_Widget();

require_once 'classes/tax-filter-wp-widget/tax-filter-ajax.php';
new TaxFilterAjax();

require 'classes/RestRoute.php';
new RestRoute();

require 'classes/favorite-devices-widget/FavoriteDevicesWidget.php';
new FavoriteDevicesWidget();


require 'classes/RestRoutes/FavoriteRoute.php';
new FavoriteAddRoute();

/*<- undone stuff =========================================
if (get_page_template() == 'registration') {
	wp_enqueue_script( 'register-script', get_template_directory_uri() . '/register.js' );
	wp_localize_script( 'register-script', 'url', 'http://wp-student.ru/wp-json/customt/registration' );
}


