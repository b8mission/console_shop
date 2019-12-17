<?php

class DevicePostType {
	function __construct() {
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
	}
}