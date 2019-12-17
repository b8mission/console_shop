<?php get_header(); ?>
    <div class="container">
    <div class="row">
    <div class="col-2" style="height: 400px"><!--left cell-->
        <div class="row-fluid">
            <div>
				<?php get_sidebar( 'front-page-left' ); ?>
            </div>
            <br>
            <div>
                Block B
            </div>
        </div>
    </div><!--/left cell-->

    <div class="col-6"><!--content cell-->
<?php if ( have_posts() ) :
	while ( have_posts() ) : the_post();
		echo '<h3>';
		the_title();
		echo '</h3>';
		the_content();
		the_tags();
		?>
        </div><!--/content cell-->

        <div class="col-3"><!--right cell-->
            <div class="row-fluid">
                <div>
					<?php get_sidebar( 'front-page-right' ); ?>
                </div>
                <br>
                <div>
                    Block D
                </div>
            </div>
        </div><!--/right cell-->
        </div><!--row-->
        </div><!--container-->

	<?php

	endwhile;
endif;

get_footer();

// extra funcs
//  next_post_link();// – a link to the post published chronologically after the current post
//  previous_post_link();// – a link to the post published chronologically before the current post
//  the_category();// – the category or categories associated with the post or page being viewed
//   the_author();// – the author of the post or page
//the_excerpt();// – the first 55 words of a post’s main content followed by an ellipsis (…) or read more link that goes to the full post. You may also use the “Excerpt” field of a post to customize the length of a particular excerpt.

//  the_ID();// – the ID for the post or page
//  the_meta();// – the custom fields associated with the post or page
//  the_shortlink();// – a link to the page or post using the url of the site and the ID of the post or page
//  the_tags();// – the tag or tags associated with the post
//    the_time();// – the time or date for the post or page. This can be customized using standard php date function formatting.