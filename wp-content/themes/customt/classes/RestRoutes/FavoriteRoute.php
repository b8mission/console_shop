<?php

class FavoriteAddRoute {
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'registration' ] );
	}


	public function registration() {
		register_rest_route( 'customt', '/favorite_add_route', array(
			'methods'             => 'POST',
			'callback'            => [ $this, 'my_rest_api_func' ],
			'permission_callback' => [ $this, 'permission_callback' ],
			'args'                => array(

				'device_id' => array(
					'default'           => null,
					'required'          => true,
					'validate_callback' => [ $this, 'validate_id' ],
				),


				'action' => array(
					'default'           => 'rm',
					'required'          => null,
					'validate_callback' => null
				),



			),
		) );

	}


	public function validate_id( $param, $request, $key ) {
		$param = (int) $param;

		if ( ! is_int( $param ) ) {
			return false;
		}

		if ( $param < 1 ) {
			return false;
		}

		return true;
	}

	public function my_rest_api_func( WP_REST_Request $request ) {


		if ( $request['action'] === 'add' ) {
			$this->addFavBook( $request );
		} else {
			$this->rmFavBook( $request );
		}


		return new WP_REST_Response( true, 200 );

		//return new WP_Error( '500', 'Server Error - Favorite Devices Route' );
	}


	private function addFavBook( $request ) {

		$userId = wp_get_current_user()->ID;

		$metaArray = get_user_meta( $userId, 'favorite-devices-widget', false );

		//escape duplicates
		foreach ( $metaArray as $meta ) {
			if ( $meta === $request['device_id'] ) {
				return;
			}
		}

		add_user_meta( $userId, 'favorite-devices-widget', $request['device_id'], false );
	}

	private function rmFavBook( $request ) {
		$userId = wp_get_current_user()->ID;
		delete_user_meta( $userId, 'favorite-devices-widget', $request['device_id'] );
	}


	public function sanitize_callback() {

	}

	public function permission_callback() {

		if ( is_user_logged_in() ) {
			return true;
		}

		return false;
	}

}