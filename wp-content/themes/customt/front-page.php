<?php

get_header();

if (have_posts()) :
    while ( have_posts()) : the_post ();?>

        <div class="d-flex" id="wrapper">

        <!-- Sidebar -->
        <div class="bg-light border-right" id="sidebar-wrapper">
            <div class="sidebar-heading">LSide </div>
            <div class="list-group list-group-flush">
                <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Shortcuts</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Overview</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Events</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Profile</a>
                <a href="#" class="list-group-item list-group-item-action bg-light">Status</a>
            </div>
        </div>
        <!-- /#sidebar-wrapper -->



        <div id="page-content-wrapper">
            <?php the_title();?>
            <?php the_content();?>
        </div>
        <!--<img src="https://scx1.b-cdn.net/csz/news/800/2019/nasamoonrock.jpg"> -->

            <!-- Sidebar -->
            <div class="bg-light border-right" id="sidebar-wrapper">
                <br><div class="sidebar-heading">RSide </div>
                blah blah blah blah <br>
                blah blah blah blah <br>
                blah blah blah blah <br>
                blah blah blah blah <br>
                blah blah blah blah <br>
            </div>
            <!-- /#sidebar-wrapper -->

        </div>
        <?php
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
    endwhile;
endif;

get_footer();
