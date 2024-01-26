<?php
/*
Template Name: 404
*/

get_header();

?>

    <div class="site-container">
        <main id="main-content" class="site-main">
            <div class="site-content">
                <div class="container">
                    <h1>404</h1>
                    <p>Ups! Page not found</p>
                    <p><a href="<?php echo esc_url(home_url('/')); ?>">Back to Home</a></p>
                </div>
            </div><!-- .site-content -->
        </main><!-- #main -->

    </div><!-- .site-container -->
<?php

get_footer();
