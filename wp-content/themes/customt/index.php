<?php
get_header();

if ( have_posts() ) :
	while ( have_posts() ) : the_post(); ?>
        Title:
		<?php the_title(); ?>
        <hr>Content:
		<?php the_content(); ?>

		<?php
		next_post_link();
		previous_post_link();
		the_category();
		the_author();
		the_ID();
		the_meta();
		the_shortlink();
		the_tags();
		the_time();
	endwhile;
endif;

get_footer();