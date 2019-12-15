<!DOCTYPE HTML>
<html>
    <head>
        <meta charset="utf-8">
        <title><?php bloginfo( 'name' );?> </title>
    </head>
    <body>
    <?php wp_head();
    wp_nav_menu( array( 'theme_location' => 'header-menu' ) );

    ?>

        <div style="text-align: center">
            <h2>
                <?php bloginfo( 'name' );?><!--Console Shop-->
            </h2>
        </div>

    <hr>