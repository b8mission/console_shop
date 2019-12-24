<?php

class Filter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'tax-filter-wp-widget',  // Base ID
			'Taxonomy Filter WP Widget'   // Name
		);

		add_action( 'widgets_init', function () {
			register_widget( 'Filter_Widget' );
		} );
	}


	public function widget( $args, $instance ) {

		if ( ! ( $instance['enabled'] ?? false ) ) {
			return;
		} //exit if disabled

		$cats = $terms = get_terms( [
			'taxonomy'   => 'vendor',
			'hide_empty' => false,
		] );

		$title = ( ( $instance['title'] ) ?? 'Vendor' );
		echo $title, '<br>';

		foreach ( $cats as $cat ) {
			echo "<div class='unselectable'>
					<label>
						<input name='vendorBox' class='vendorBox' type='checkbox' onchange='handleChange(this);' value='{$cat->name}'>{$cat->name}
					</label>
				</div>";
		}

	}


	public function form( $instance ) {
// outputs the options form in the admin

		//title area
		$title = '';
		if ( isset( $instance['title'] ) ) {
			$title = $instance['title'];
		}

		$name = $this->get_field_name( 'title' );
		echo "Title:<input id='{$name}' name='{$name}' type='text' value='{$title}'><br>";

		//enabled are
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