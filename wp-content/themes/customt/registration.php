<?php /* Template Name: RegistrationPage */ ?>


<?php

//----------------redirect
if ( is_user_logged_in() ) {
	wp_redirect( '/device' );
	exit;
}//-----------------------

get_header();

// Start the loop.
while ( have_posts() ) : the_post();

endwhile;
?>

<form id="regForm" method="post" action="http://wp-student.ru/wp-json/customt/registration" style="text-align:center;">
    <input name="login" placeholder="login > 3">
    <input type="password" name="password" placeholder="password > 5">
    <br>
    <label><input name="agreement" type="checkbox" value="yes">user agreement</label>
    <input type="submit">
</form>

<?php get_footer(); ?>


