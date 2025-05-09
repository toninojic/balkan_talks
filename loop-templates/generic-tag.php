<?php
/*
Template Name: Stories Category Template
*/

get_header();

$tagSlug = $args['tagSlug'];
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php
            $tag_description = tag_description();
            if (!empty($tag_description)) {
                echo '<div class="tag-description">' . wp_kses_post($tag_description) . '</div>';
            }            
            ?>

            <div class="about-category-posts">
                <?php echo do_shortcode("[custom_category_loop tag='$tagSlug']"); ?>
            </div>
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
