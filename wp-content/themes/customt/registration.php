<?php /* Template Name: RegistrationPage */ ?>

<?php get_header(); ?>

		<?php
		wp_enqueue_script( 'register-script', get_template_directory_uri() . '/register.js' );
		wp_localize_script( 'register-script', 'url', 'http://wp-student.ru/wp-json/customt/registration' );


		// Start the loop.
		while ( have_posts() ) : the_post();

			// Include the page content template.
			get_template_part( 'template-parts/content', 'page' );

		endwhile;
		?>
<!DOCTYPE HTML>

<html>
<head>
	<meta charset="utf-8">
	<title>Registration</title>
</head>

<body>
<form id="regForm" method="post" action="http://wp-student.ru/wp-json/customt/registration">
	<input name="login" placeholder="login > 3">
	<input type="password" name="password" placeholder="password > 5">

	<input type="submit">
</form>
</body>
</html>

<?php get_footer(); ?>


