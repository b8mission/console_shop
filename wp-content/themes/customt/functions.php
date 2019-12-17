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
	wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.js', array( 'jquery' ), 1.1, true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'add_theme_scripts' );

require 'classes/Sidebars.php';
new Sidebars();

require 'classes/custom-post-types/Device_Post_Type.php';
new DevicePostType();

require 'classes/Release_Year_Metabox.php';
new Release_Year_Metabox( 'release-year', 'Release Year' );

require 'classes/Generation_Metabox.php';
new Generation_Metabox( 'generation', 'GEN' );

require 'classes/Vendor_Taxonomy.php';
new VendorTaxonomy();