<?php

class RestRoute {
	public function __construct() {
		add_action( 'rest_api_init', [ $this, 'registration' ] );
	}


	public function registration (){
		register_rest_route( 'customt', '/registration', array(
			'methods'             => 'POST',            // метод запроса: GET, POST ...
			'callback'            => [$this,'my_rest_api_func'],  // функция обработки запроса. Должна вернуть ответ на запрос
			'permission_callback' => [$this, 'permission_callback' ],  // функция проверки доступа к маршруту. Должна вернуть true/false
			// описание передаваемых параметров
			'args'                => array(

				'login' => array(
					'default'           => null,
					// значение параметра по умолчанию
					'required'          => true,
					// является ли параметр обязательным. Может быть только true
					'validate_callback' => function ( $param, $request, $key ) {
						if (strlen($param) < 3) return false;
						return true;
					},
					// функция проверки значения параметра. Должна вернуть true/false
			//		'sanitize_callback' => 'sanitize_callback',
					// функция очистки значения параметра. Должна вернуть очищенное значение
				),



				'password' => array(
					'default'           => null,
					// значение параметра по умолчанию
					'required'          => true,
					// является ли параметр обязательным. Может быть только true
					'validate_callback' => function ( $param, $request, $key ) {
						if (strlen($param) < 5) return false;
						return true;
					},
					// функция проверки значения параметра. Должна вернуть true/false
					//		'sanitize_callback' => 'sanitize_callback',
					// функция очистки значения параметра. Должна вернуть очищенное значение
				),


			),
		) );

	}


	public function my_rest_api_func(WP_REST_Request $request)
	{
		$complited = false;

		return new WP_REST_Response( true, 200 );
	}

	public function sanitize_callback() {

	}

	public function permission_callback()
	{
		return true;
	}

}