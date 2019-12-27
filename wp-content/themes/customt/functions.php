<?php

function register_my_menus() {
	register_nav_menus(
		array(
			'header-menu' => __( 'Header Menu' ),
			'extra-menu'  => __( 'Extra Menu' )
		)
	);
}
add_action( 'init', 'register_my_menus' );

function add_theme_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.css', array(), '1.1', 'all' );

	$tname = (string)basename( get_page_template());//registration js
	if ($tname == 'registration.php')
	{
		wp_enqueue_script( 'register-script', get_template_directory_uri() . '/register.js', array( 'jquery' ), 1.1, true  );
		wp_localize_script( 'register-script', 'url', 'http://wp-student.ru/wp-json/customt/registration' );
	}

	if ($tname == 'favorite-devices.php')
	{
		wp_enqueue_script( 'register-script', get_template_directory_uri() . '/classes/favorite-devices-widget/FavoriteDevicesWidget.js', array( 'jquery' ), 1.1, true  );
		wp_localize_script( 'register-script', 'url', 'http://wp-student.ru/wp-json/customt/favorite_add_route' );
		wp_localize_script( 'register-script', 'wpApiSettings', array(
			'root' => esc_url_raw( rest_url() ),
			'nonce' => wp_create_nonce( 'wp_rest' ),
		) );
	}

	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.js', array( 'jquery' ), 1.1, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

require 'classes/Sidebars.php';
new Sidebars();

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





add_filter( 'query_vars', function( $vars ){
	$vars[] = 'taxonomy';
	return $vars;
} );

add_action('init', function() {

	add_rewrite_rule(
		'^device/vendor/([^/]+)/?$',
		//'^device/([^/]+)/?$',
		'index.php?post_type=device&taxonomy=$matches[1]',
		'top'
	);

});



add_action('parse_request', function() {

	$a = '';

	if (($_SERVER['REQUEST_URI']) !== '/secret') return;

	if (!is_user_logged_in())
	{
		echo 'no access';
		return;
	}
	include('secrets/secrets.html');

	//echo 'access allowed <br>';
	//echo 'my bank pincode is 5578';

});