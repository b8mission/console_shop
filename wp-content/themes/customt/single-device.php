<?php get_header(); ?>

<?php

wp_enqueue_script( 'favorite-devices', get_template_directory_uri() . '/classes/favorite-devices-widget/FavoriteDevicesWidget.js', array( 'jquery' ), 1.1, true );
wp_localize_script( 'favorite-devices', 'url', 'http://wp-student.ru/wp-json/customt/favorite_add_route' );
wp_localize_script( 'favorite-devices', 'wpApiSettings', array(
	'root'  => esc_url_raw( rest_url() ),
	'nonce' => wp_create_nonce( 'wp_rest' ),
) );

?>

    <div class="container">
    <div class="row" style="text-align: center">
    <div class="col-10" style="text-align: left">

<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>

        <h4>// DEVICE :
			<?php the_title(); ?>;
        </h4>
        <hr>

		<?php
		the_content();

		echo '<hr>';
		the_tags();

		echo 'Vendor: ' . get_the_terms( $post->ID, 'vendor' )[0]->name . '<br>';
		echo 'Release Year : ' . get_post_meta( $post->ID, 'release_year', true ) . '<br>';
		echo 'Generation : ' . get_post_meta( $post->ID, 'generation', true ) . '<br>';
		the_category();
		?>
        <hr>
        </div>
        <div class="col-2">
			<?php get_sidebar( 'front-page-left' ); ?>
        </div>
        </div>
        </div>


	<?php

	endwhile;
endif;

get_footer();