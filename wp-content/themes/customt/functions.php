<?php

//menus <===============================
function register_my_menus() {
    register_nav_menus(
            array(
                'header-menu' => __( 'Header Menu' ),
                'extra-menu' => __( 'Extra Menu' )
            )
)   ;
}
    add_action( 'init', 'register_my_menus' );




//bootstrap <==============================
function add_theme_scripts() {
    wp_enqueue_style( 'style', get_stylesheet_uri() );

    wp_enqueue_style( 'bootstrap-css', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.css', array(), '1.1', 'all');

    wp_enqueue_script( 'script', get_template_directory_uri() . '/assets/deps/bootstrap/bootstrap.js', array ( 'jquery' ), 1.1, true);

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
            'id'            => 'front-page-left',
            'name'          => __( 'Front Page Left Sidebar' )
        )
    );

    register_sidebar(
        array(
            'id'        => 'front-page-right',
            'name'      => __('Front Page Right Sidebar')
        )
    );
    /* Repeat register_sidebar() code for additional sidebars. */
}




//custom post type <============================================
//Register new post types: Movies, TV Series, Celebs, Awards
add_action( 'init', 'register_post_types' );
function register_post_types() {
    register_post_type('Device', array(
        'label'  => null,
        'labels' => array(
            'name'               => esc_html__('Device'), // основное название для типа записи
            'singular_name'      => esc_html__('Devices'), // название для одной записи этого типа
        ),
        'description'         => esc_html__('Devices for sale'),
        'public'              => true,
        'show_in_nav_menus'   => true, // зависит от public
        'show_in_menu'        => true, // показывать ли в меню адмнки
        'rest_base'           => null, // $post_type. C WP 4.7
        'menu_position'       => null,
        'menu_icon'           => 'dashicons-video-alt',
        'hierarchical'        => false,
        'supports'            => [ 'title', 'editor', 'author','thumbnail','custom-fields','comments','revisions','page-attributes' ],
        'taxonomies'          => [],
        'has_archive'         => true,
        'taxonomies' => array('category'),
        'rewrite'             => true,
        'query_var'           => true,
    ) );

}

require 'classes/Release_Year_Metabox.php';
require 'classes/Generation_Metabox.php';

$mtbx = new Release_Year_Metabox('release-year','Release Year');
new Generation_Metabox('generation', 'GEN');

/*
//Include scripts and styles to head section
add_action( 'wp_enqueue_scripts', 'moviesinfo_scripts' );

function moviesinfo_scripts() {
    wp_enqueue_style( 'style-bootstrap', get_template_directory_uri() . '/css/bootstrap.min.css' );

    wp_enqueue_script( 'jquery' );
    wp_enqueue_script( 'script-bootstrap', get_template_directory_uri() . '/js/bootstrap.min.js' );
}
