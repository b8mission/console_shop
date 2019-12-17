<?php get_header(); ?>
    <div class="container">
        <div class="row">
            <div class="col-2">
				<?php get_sidebar( 'front-page-left' ); ?>
            </div>
            <div class="col-6">

                <h3>Devices Page</h3>

				<?php if ( have_posts() ) :
					while ( have_posts() ) : the_post();
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
						echo 'Vendor: ' . get_the_terms( $post->ID, 'vendor' )[0]->name . '<br>';
						the_category();
					endwhile;
				endif;
				?>
            </div>
        </div>
    </div>
<?php

get_footer();
