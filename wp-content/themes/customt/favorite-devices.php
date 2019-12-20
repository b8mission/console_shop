<?php /* Template Name: Favorite_Devices */ ?>


<?php

get_header();

while ( have_posts() ) : the_post();

endwhile;

$usr = wp_get_current_user();
$metaArray = get_user_meta( $usr->ID, 'favorite-devices-widget', false );

foreach ( $metaArray as $meta ) {
	echo '<hr>';
	echo 'id ' . $meta . '<br>';
	echo get_post( $meta )->post_title;
}

get_footer(); ?>