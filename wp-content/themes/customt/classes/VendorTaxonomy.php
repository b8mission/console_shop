<?php

class VendorTaxonomy {
	function __construct() {
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
	}
}