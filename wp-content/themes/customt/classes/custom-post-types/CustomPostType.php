<?php

class CustomPostType {
	public function __construct( $title, $array ) {
		$this->title = $title;
		$this->array = $array;


		add_action( 'init', [ $this, 'register_post_types' ] );
	}

	private $title;
	private $array;

	public function register_post_types() {
		register_post_type( $this->title, $this->array );
	}


	public static function MakeAllPostTypes()
	{
		//require_once('CustomPostType.php');
		require_once('PostTypeConfig.php');

		foreach ($CUSTOM_POST_TYPES as $cpt)
		{
			$title = $cpt[0];
			$array = $cpt[1];

			if ((!is_array($array)) || (!is_string($title)) || (empty($title)))
				wp_die('CustomPostTypeConfig Error;');
			new CustomPostType($title,$array);
		}
	}
}