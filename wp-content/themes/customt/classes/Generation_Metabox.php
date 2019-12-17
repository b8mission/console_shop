<?php

require_once 'Base_Metabox.php';

class Generation_Metabox extends Base_Metabox {
	function render( $post ) {
		$value = get_post_meta( $post->ID, 'generation', true );
		?>
        <label for="wporg_field">Gen # </label>
        <input name="generation" type="text" value="<?= $value ?>">
		<?php
	}

	function save( $post_id ) {

		if ( array_key_exists( 'generation', $_POST ) ) {
			update_post_meta(
				$post_id,
				'generation',
				$_POST['generation']
			);
		}
	}

}