<?php /* Template Name: Favorite_Devices */ ?>

<?php
get_header();
?>
    <h3 style="text-align: center">Your favorite devices</h3><hr>
<?php

//auth break
if ( ! is_user_logged_in() ) {
	wp_die( 'Only members allowed' );
}

//the loop
while ( have_posts() ) : the_post();

endwhile;


$usr       = wp_get_current_user();
$metaArray = get_user_meta( $usr->ID, 'favorite-devices-widget', false );
$favPosts  = array();


foreach ( $metaArray as $meta ) {

	$fpost      = get_post( $meta );
	$favPosts[] = $fpost;
	printDevicePost( $fpost );
}


function printDevicePost( $post1 ) {
	global $post;
	$post = $post1;
	?>

    <div id="post<?=$post1->ID?>">
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
		rmButton( $post1->ID ); ?>
    </div>

	<?php wp_reset_postdata();
}

function rmButton( $id ) {
	?>
    <div>
        <form name="favorite_devices_widget_form">
            <input type="hidden" name="device_id" value="<?= $id; ?>">
            <input type="submit"  value="Remove">
        </form>
    </div>
	<?php
}

get_footer(); ?>