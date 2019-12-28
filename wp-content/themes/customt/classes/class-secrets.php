<?php

class Secrets {

	function __construct() {
		add_action( 'parse_request', function () {

			$meaning = 0;

			if ( ( $_SERVER['REQUEST_URI'] ) == '/secret.pdf' ) {
				$meaning = 1;
			}
			if ( ( $_SERVER['REQUEST_URI'] ) == '/secret' ) {
				$meaning = 2;
			}
			if ( ( $_SERVER['REQUEST_URI'] ) == '/secret.jpg' ) {
				$meaning = 3;
			}

			if ( $meaning == 0 ) {
				return;
			}

			if ( ! is_user_logged_in() ) {
				echo 'no access';
				exit();
			}

			if ( $meaning === 1 ) { //send the file
				$file = 'secrets/document.pdf';

				header( 'Content-Description: File Transfer' );
				header( 'Content-Type: application/octet-stream' );
				header( 'Content-Disposition: attachment; filename="' . basename( $file ) . '"' );
				header( 'Expires: 0' );
				header( 'Cache-Control: must-revalidate' );
				header( 'Pragma: public' );
				header( 'Content-Length: ' . filesize( $file ) );
				readfile( $file );
				exit;
			}


			if ( $meaning === 2 ) { //send the page
				echo 'access allowed<br>';
				require( 'secrets/secrets.html' );
				exit();
			}

			if ( $meaning === 3 ) //send the picture
			{
				echo 'access allowed <br>';
				$path = 'secrets/secret.jpg';
				$type = pathinfo( $path, PATHINFO_EXTENSION );
				$data = file_get_contents( $path );

				$base64 = 'data:image/' . $type . ';base64,' . base64_encode( $data );
				?>
                <img style="width: 500px; display: block;" src="<?= $base64 ?>">
				<?php
				exit();
			}

		} );
	}
}