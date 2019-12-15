<?php get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-2">
                <?php get_sidebar('front-page-left'); ?>
            </div>
            <div class="col-6">

                <h3>Devices Page</h3>

                <?php if (have_posts()) :
                    while (have_posts()) : the_post();
                        ?>

                        <hr>
                        <hr>
                        <a href="<?= get_permalink(); ?>">
                            <?php the_title(); ?>
                        </a>
                        <?php
                        //the_content();
                        the_excerpt();
                        the_tags();
                        the_category();
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
                ?>
            </div>
        </div>
    </div>
<?php

get_footer();
