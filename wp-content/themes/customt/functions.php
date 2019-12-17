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


//sidebars <================
add_action( 'widgets_init', 'my_register_sidebars' );
function my_register_sidebars() {
	/* Register the 'primary' sidebar. */
	register_sidebar(
		array(
			'id'   => 'front-page-left',
			'name' => __( 'Front Page Left Sidebar' )
		)
	);

	register_sidebar(
		array(
			'id'   => 'front-page-right',
			'name' => __( 'Front Page Right Sidebar' )
		)
	);
	/* Repeat register_sidebar() code for additional sidebars. */
}


//custom post type <============================================
add_action( 'init', 'register_post_types' );
function register_post_types() {
	register_post_type( 'Device', array(
		'label'             => null,
		'labels'            => array(
			'name'          => esc_html__( 'Device' ),
			'singular_name' => esc_html__( 'Devices' ),
		),
		'description'       => esc_html__( 'Devices for sale' ),
		'public'            => true,
		'show_in_nav_menus' => true,
		'show_in_menu'      => true,
		'rest_base'         => null,
		'menu_position'     => null,
		'menu_icon'         => 'dashicons-video-alt',
		'hierarchical'      => false,
		'supports'          => [
			'title',
			'editor',
			'author',
			'thumbnail',
			'custom-fields',
			'comments',
			'revisions',
			'page-attributes'
		],
		'taxonomies'        => [],
		'has_archive'       => true,
		'taxonomies'        => array( 'category' ),
		'rewrite'           => true,
		'query_var'         => true,
	) );

}

require 'classes/Release_Year_Metabox.php';
require 'classes/Generation_Metabox.php';

new Release_Year_Metabox( 'release-year', 'Release Year' );
new Generation_Metabox( 'generation', 'GEN' );


//taxonomy<=========================================================
add_action( 'init', 'create_taxonomies' );

function create_taxonomies() {
	register_taxonomy( 'vendor', 'device', array(
		'hierarchical' => true,
		'labels'       => array(
			'name'                       => _x( 'Vendor', 'taxonomy general name' ),
			'singular_name'              => _x( 'Vendors', 'taxonomy singular name' ),
			'search_items'               => __( 'Search Vendors' ),
			'popular_items'              => __( 'Popular Vendors' ),
			'all_items'                  => __( 'All Vendors' ),
			'parent_item'                => null,
			'parent_item_colon'          => null,
			'edit_item'                  => __( 'Edit Vendor' ),
			'update_item'                => __( 'Update Vendor' ),
			'add_new_item'               => __( 'Add New Vendor' ),
			'new_item_name'              => __( 'New Vendor Name' ),
			'separate_items_with_commas' => __( 'Separate vendors with commas' ),
			'add_or_remove_items'        => __( 'Add or remove vendors' ),
			'choose_from_most_used'      => __( 'Choose from the most used vendors' ),
			'menu_name'                  => __( 'Vendors' ),
		),
		'show_ui'      => true,
		'query_var'    => true,
		//'rewrite'       => array( 'slug' => 'the_slug' ), // свой слаг в URL
	) );
}

