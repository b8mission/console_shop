<?php
get_header();

if (have_posts()) :
    while ( have_posts()) : the_post ();?>
    Title:
        <?php the_title();?>
    <hr>Content:
        <?php the_content();?>

    <?php
        next_post_link();// – a link to the post published chronologically after the current post
        previous_post_link();// – a link to the post published chronologically before the current post
        the_category();// – the category or categories associated with the post or page being viewed
        the_author();// – the author of the post or page
        //the_excerpt();// – the first 55 words of a post’s main content followed by an ellipsis (…) or read more link that goes to the full post. You may also use the “Excerpt” field of a post to customize the length of a particular excerpt.

        the_ID();// – the ID for the post or page
        the_meta();// – the custom fields associated with the post or page
        the_shortlink();// – a link to the page or post using the url of the site and the ID of the post or page
        the_tags();// – the tag or tags associated with the post
        the_time();// – the time or date for the post or page. This can be customized using standard php date function formatting.
    endwhile;
endif;

get_footer();