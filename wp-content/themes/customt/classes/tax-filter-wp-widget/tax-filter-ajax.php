<?php

class TaxFilterAjax {
	public function __construct() {
		add_action( 'wp_ajax_my_action', 'tax_ajax_responce' );
		add_action( 'wp_ajax_nopriv_my_action', 'tax_ajax_responce' );

		//add js
		wp_enqueue_script( 'tax-filter', get_template_directory_uri() . '/classes/tax-filter-wp-widget/tax-filter.js' );
		wp_localize_script( 'tax-filter', 'ajaxurl', admin_url( 'admin-ajax.php' ) );


		//ajax responce action
		function tax_ajax_responce() {

			$vendors = strval( $_POST['vendors'] );

			$posts = get_posts( array(
	/*			'tax_query' => array(
					array(
						'taxonomy' => 'people',
						'field'    => 'slug',
						'terms'    => 'bob'
					)
				)*/
				'numberposts'      => 0,
				//'category'    => 0,
				//'orderby'     => 'date',
				//'order'       => 'DESC',
				//'include'     => array(),
				//'exclude'     => array(),
				//'meta_key'    => '',
				//'meta_value'  =>'',
				'post_type'        => 'device',
				'suppress_filters' => true,
			) );


			//print the posts
			foreach ( $posts as $post1 ) {

				$tax = get_the_terms( $post1->ID, 'vendor' );

				if ( ! empty( $vendors ) ) {
					if ( strpos( $vendors, $tax[0]->name ) !== false ) {
						printDevicePost( $post1 );
					}
				} else {
					printDevicePost( $post1 );
				}
			}

			wp_die();
		}

		function printDevicePost( $post1 ) {
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
}
