<?php


$CUSTOM_POST_TYPES = array(

	//CPT array #1
	'Device Post Type' =>
		array(
			'Device',
			array(
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
				'menu_icon'         => 'dashicons-welcome-view-site',
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
			)
		),//device array

);//main array