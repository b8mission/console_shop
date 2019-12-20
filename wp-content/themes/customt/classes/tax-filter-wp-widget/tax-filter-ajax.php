<?php

class TaxFilterAjax {
	public function __construct() {
		add_action( 'wp_ajax_my_action', [ $this, 'tax_ajax_responce' ] );
		add_action( 'wp_ajax_nopriv_my_action', [ $this, 'tax_ajax_responce' ] );

		//add js
		wp_enqueue_script( 'tax-filter', get_template_directory_uri() . '/classes/tax-filter-wp-widget/tax-filter.js' );
		wp_localize_script( 'tax-filter', 'ajaxurl', admin_url( 'admin-ajax.php' ) );

	}

	private function makeVendorFilter() {

		$vendors = strval( $_POST['vendors'] );

		if ( empty( $vendors ) ) {
			return '';
		}

		$vendorsArray = explode( ';', $vendors );

		$taxFilter = array(
			'taxonomy' => 'vendor',
			'field'    => 'slug',
			'terms'    => $vendorsArray
		);

		return $taxFilter;
	}


	//ajax responce action
	public function tax_ajax_responce() {

		$taxFilter = $this->makeVendorFilter();

		$args = array(
			'numberposts'      => 0,
			'post_type'        => 'device',
			'suppress_filters' => true,
		);

		if ( is_array( $taxFilter ) ) {
			$args['tax_query'][] = $taxFilter;
		}

		$posts = get_posts( $args );

		//print the posts
		foreach ( $posts as $post1 ) {
			$this->printDevicePost( $post1 );
		}

		wp_die();
	}

	private function printDevicePost( $post1 ) {
		global $post;
		$post = $post1;
		?>

        <hr>
        <hr>
        <a href="<?= get_permalink(); ?>">
			<?php the_title(); ?>
        </a>
		<?php
		//the_content();
		the_excerpt();
		the_tags();
		echo 'Vendor: ' . get_the_terms( $post1->ID, 'vendor' )[0]->name . '<br>';
		the_category();
		wp_reset_postdata();
	}
}
