<?php

class Plugin_One_Shortcode {
	private const CACHE_TITLE_PREFIX = 'plugin_one_record_id_';

	function __construct() {
		add_shortcode( 'plugin_one', [ $this, 'plugin_one_shortcode' ] );
	}

	public function plugin_one_shortcode( $atts ) {
		$a = shortcode_atts( array( 'id' => 0 ), $atts );

		return ( $this->get_top_ten( $atts['id'] ) );
	}

	public function get_top_ten( $id ) {
		$id = (int) $id;

		if ( $id === 0 ) {
			return '';
		}

		//delete_transient( self::CACHE_TITLE_PREFIX . $id );

		$data = get_transient( self::CACHE_TITLE_PREFIX . $id );
		if ( $data === false ) {
			$data = $this->get_data_from_api( $id, $this->get_user_key() );

			if ( $data !== false && is_array( $data ) ) {
				set_transient( self::CACHE_TITLE_PREFIX . $id, $data, 7 * 60 * 60 * 24 );
			}
		}

		return $this->print_data( $data );
	}

	private function get_user_key() {
		$option = get_option( 'plugin_one_options', false );
		$option = ( $option['api_key'] ?? '' );

		if ( empty( $option ) || strlen( $option ) < 5 ) {
			$option = false;
		}

		return $option;
	}

	private function get_data_from_api( $id, $apikey ) {
		if ( $apikey === false ) {
			return false;
		}
		$id = (int) $id;

		$url  = 'https://api-v3.igdb.com/games';
		$args = array(
			'headers' => array(
				'user-key' => $apikey,
				'Accept: application/json'
			),
			'body'    => 'fields url, name, rating; where platforms = {' . $id . '} & rating > 0; limit 10; sort rating desc;',
			'timeout' => '2',
		);

		$response = wp_remote_post( $url, $args );

		if ( is_wp_error( $response ) ) {
			return false;
		}

		if ( ( $response['response']['code'] ?? 400 ) != 200 ) {
			return false;
		}

		return json_decode( $response['body'], true );
	}


	private function print_data( $data ) {
		if ( ( $data === false ) || ( ! is_array( $data ) ) ) {
			return '';
		}

		ob_start( null, 0, PHP_OUTPUT_HANDLER_REMOVABLE );

		include( 'output-title-template.php' );//get the title

		foreach ( $data as $elem ) {
			$rating = round( $elem['rating'] ?? 0 );
			$name   = ( $elem['name'] ?? 'name' );
			$url    = ( $elem['url'] ?? 'google.com' );

			include( 'output-line-template.php' );
		}

		return (string) ob_get_clean();
	}

}