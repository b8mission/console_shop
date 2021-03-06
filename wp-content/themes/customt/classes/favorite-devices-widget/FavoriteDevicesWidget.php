<?php

class FavoriteDevicesWidget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'favorite-devices-widget',  // Base ID
			'Favorite Devices Widget'   // Name
		);

		add_action( 'widgets_init', function () {
			register_widget( 'FavoriteDevicesWidget' );
		} );
	}


	public function widget( $args, $instance ) {


		if ( ! is_user_logged_in() ) {
			return;
		} //exit if not logged in

		if ( ! ( $instance['enabled'] ?? false ) ) {
			return;
		} //exit if disabled


		$title = ( ( $instance['title'] ) ?? '' );
		echo $title, '<br>';


		$id  = get_the_ID();
		$usr = wp_get_current_user();

		$isFavorite = false;
		if ( in_array( $id, get_user_meta( $usr->ID, 'favorite-devices-widget', false ) ) ) {
			$isFavorite = true;
		}
		?>

        <div>
            <form name="favorite_devices_widget_form" method="post">
				<?php// wp_nonce_field(); ?>
                <label>
                    <input name='action' type='checkbox'
						<?php if ( $isFavorite ) { echo 'checked'; } ?> value='add' onchange="favorite_devices_ajaxQuery(this.form);">
                    <input type="hidden" name="device_id" value="<?= get_the_ID(); ?>">
                    My Favorite
                </label>
            </form>
        </div>
		<?php
	}


	public function form( $instance ) {
		//title
	    $title = '';
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}

		$name = $this->get_field_name( 'title' );
		echo "Title:<input id='{$name}' name='{$name}' type='text' value='{$title}'><br>";


		//enabled
		$checked = 'unchecked';
		if ( $instance['enabled'] ?? false ) {
			$checked = 'checked';
		}

		$name = $this->get_field_name( 'enabled' );
		echo "<label>
                <input type='checkbox' id='{$name}' name='{$name}' value='checked' {$checked}>
                Enabled  
              </label>";
	}


	public function update( $new_instance, $old_instance ) {

		$new_instance['enabled'] = ( isset( $new_instance['enabled'] ) );

		return $new_instance;
	}
}