<?php

class DeviceShortcode {
	function __construct() {
		add_shortcode( 'devices', [$this,'devices_shortcode' ]);
	}

	public function devices_shortcode( $atts ) {
		$a = shortcode_atts( array(
			'numberposts' => 10,
			'order'       => 'DESC',
		), $atts );

		$posts = get_posts( array(
			'numberposts' => $a['numberposts'],
			//'category'    => 0,
			'orderby'     => 'date',
			'order'       => $a['order'],
			'include'     => array(),
			'exclude'     => array(),
			'meta_key'    => '',
			'meta_value'  => '',
			'post_type'   => 'device',
		) );

		$out = '';
		foreach ( $posts as $post ) {
			$out .= $post->post_name . '<br>';
		}

		return $out;
	}
}