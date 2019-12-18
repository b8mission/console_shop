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

        if (!($instance['enabled'] ?? false)) return; //exit if disabled

		$cats = $terms = get_terms( [
			'taxonomy'   => 'vendor',
			'hide_empty' => false,
		] );

		$title = (($instance['title']) ?? 'Vendor');
		echo $title, '<br>';

		foreach ( $cats as $cat ) {
			echo "<div>
					<label>
						<input class='vendorBox' type='checkbox' onchange='handleChange(this);' value='{$cat->name}'>{$cat->name}
					</label>
				</div>";
		}
		$this->my_js();
	}






	private function my_js() { ?>
		<script type="text/javascript">

            function handleChange(checkbox) {
                var boxes = document.getElementsByClassName('vendorBox');

                var str = '';
                var count = 0;
                var vendors = [];
                for (var i = 0; i < boxes.length; i++) {
                    if (boxes[i].checked == true) {
                        str += boxes[i].value;
                        count++;
                        vendors.push(boxes[i].value);
                    }
                }
                //alert (str);
                vendors = vendors.join(';');
                //  alert('sending: ' + count+ ', '+vendors);
                callAjax(count,vendors);
            }

            function callAjax(count, vendors) {
				<?= 'var ajaxurl = "' . admin_url( 'admin-ajax.php' ) . '"'; ?>

                var data = {
                    'action': 'my_action',
                    'whatever': count,
                    'vendors': vendors,
                };

                jQuery.post(ajaxurl, data, function (response) {
                    //   alert('Got this from the server: ' + response);

                    if (response.length < 3)
                        response = "<hr><hr>Sorry. Can't find anything";

                    document.getElementById('devices').innerHTML = response;
                });
            }

		</script><?php
	}







	public function form( $instance ) {
// outputs the options form in the admin

        //title area
        $title = '';
        if (isset($instance['title']))
            $title = $instance['title'];

		$name =  $this->get_field_name( 'title' );
		echo "Title:<input id='{$name}' name='{$name}' type='text' value='{$title}'><br>";

		//enabled are
		$checked = 'unchecked';
		if ($instance['enabled'] ?? false) $checked = 'checked';

		$name =  $this->get_field_name( 'enabled' );
		echo "<label>
                <input type='checkbox' id='{$name}' name='{$name}' value='checked' {$checked}>
                Enabled  
              </label>";
	}




	public function update( $new_instance, $old_instance ) {

	    $new_instance['enabled'] = (isset($new_instance['enabled'] ));

	    return $new_instance;
	}
}