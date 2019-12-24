<?php

class Sidebars {

	function __construct() {
		add_action( 'widgets_init', 'my_register_sidebars' );

		function my_register_sidebars() {
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

			register_sidebar(
				array(
					'id'   => 'archive-left',
					'name' => __( 'Archive left sidebar' )
				)
			);

			register_sidebar(
				array(
					'id'   => 'single-device-inner',
					'name' => __( 'Single Device Inner' )
				)
			);

		}

	}
}