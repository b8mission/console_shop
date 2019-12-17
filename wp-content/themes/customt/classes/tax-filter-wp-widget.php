<?php

class Filter_Widget extends WP_Widget {

	public function __construct() {
		parent::__construct(
			'tax-filter-wp-widget',  // Base ID
			'Taxonomy Filter WP Widget'   // Name
		);

		add_action( 'widgets_init', function() {
			register_widget( 'Filter_Widget' );
		});
	}

	public function widget( $args, $instance ) {
// outputs the content of the widget

		$cats = $terms = get_terms( [
			'taxonomy' => 'vendor',
			'hide_empty' => false,
		] );

		echo "Vendor:<br>";
		foreach ($cats as $cat)
		{
			echo "<div>
				<input type='checkbox' value='{$cat->term_taxonomy_id}'>{$cat->name}
				</div>";
			//print_r($cat);
		}
	}

	public function form( $instance ) {
// outputs the options form in the admin
		echo '<input type="checkbox">';
	}

	public function update( $new_instance, $old_instance ) {
// processes widget options to be saved
	}
}