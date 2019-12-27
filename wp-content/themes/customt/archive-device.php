<?php get_header(); ?>
<?php

$rewrite_taxonomy = ( strtolower( get_query_var( 'taxonomy' ) ) ?? false );


?>

    <div class="container">
        <div class="row">
            <div class="col-2">
                <div class="row-fluid">
                    <div>
						<?php get_sidebar( 'archive-left' ); ?>
                    </div>
                    <br>
                    <div>
						<?php get_sidebar( 'front-page-left' ); ?>
                    </div>
                </div>
            </div>
            <div class="col-6">

                <h3>Devices Page</h3>
                <div id="devices">
					<?php if ( have_posts() ) :
						while ( have_posts() ) : the_post();

					        //rewrite taxonomy continues
							if ( $rewrite_taxonomy ?? false ) {
								if ( strtolower(get_the_terms( $post->ID, 'vendor' )[0]->name) !== $rewrite_taxonomy ) {
									continue;
								}
							}

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
                </div><!--id=devices-->
            </div>
        </div>
    </div>
<?php

get_footer();
