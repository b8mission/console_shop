<hr>
<h5 style="text-align: center">
	<?php echo date( "Y" ) . ' © ';
	bloginfo( 'name' ); ?>
</h5>

<?php
wp_nav_menu( array( 'theme_location' => 'extra-menu' ) );

wp_footer(); ?>
</body>
</html>