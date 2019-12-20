<?php

class RestRoute {
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'registration' ] );
	}


	public function registration() {
		register_rest_route( 'customt', '/registration', array(
			'methods'             => 'POST',
			'callback'            => [ $this, 'my_rest_api_func' ],
			'permission_callback' => [ $this, 'permission_callback' ],
			'args'                => array(

				'login' => array(
					'default'           => null,
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						if ( ! is_string( $param ) ) {
							return false;
						}

						if ( strlen( $param ) < 3 ) {
							return false;
						}

						return true;
					},
				),


				'password' => array(
					'default'           => null,
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						if ( ! is_string( $param ) ) {
							return false;
						}

						if ( strlen( $param ) < 5 ) {
							return false;
						}

						return true;
					},
				),


			),
		) );

	}


	public function my_rest_api_func( WP_REST_Request $request ) {
		$success = false;

		$login = $request['login'];
		$password = $request['password'];

		$data = array(
			'user_pass'     => $password,
			'user_login'    => $login,
			'user_nickname' => $login
		);

		$result = wp_insert_user( $data );

		if ( is_int( $result ) ) {
			wp_signon( array( 'user_login' => $login, 'user_password' => $password, 'remember' => true) );

			return new WP_REST_Response( true, 200 );
		}

		return new WP_Error( '500', 'Registration server Error' );
	}

	public function sanitize_callback() {

	}

	public function permission_callback() {
		if (is_user_logged_in()) return false;
		return true;
	}

}