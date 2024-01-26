<?php
/*
Template Name: Author
*/

get_header();

$author = get_user_by('slug', get_query_var('author_name'));
?>

<div class="site-container">
    <main id="main-content" class="site-main">
        <div class="site-content">
            <div class="container author-container">
                <h1 class="author-title"> <?php echo esc_html($author->display_name) ?></h1>
                <div class="author-about">
                    <div style="background-image: url('<?php echo esc_url(get_user_meta($author->ID, 'user_profile_image', true) ?: get_template_directory_uri() . '/assets/public/src/img/default-user.jpg'); ?>');" class="author-image">
                    </div>
                    <p class="author-description"><?php echo $author->user_description; ?></p>
                </div>
            </div>
        </div><!-- .site-content -->
    </main><!-- #main -->

</div><!-- .site-container -->
<?php

get_footer();
