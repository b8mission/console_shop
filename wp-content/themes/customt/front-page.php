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