<?php
/*
Template Name: Stories Category Template
*/

get_header();

$categorySlug = $args['categorySlug'];

?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container">
            <?php
            $category_description = category_description();
            if (!empty($category_description)) {
                echo '<div class="category-description">' . wp_kses_post($category_description) . '</div>';
            }
            ?>

            <div class="about-category-posts">
                <?php if ($categorySlug !== 'about') : ?>
                    <?php echo do_shortcode("[custom_category_loop category='$categorySlug']"); ?>
                <?php else : ?>
                    <?php
                    $about_query = new WP_Query([
                        'post_type' => 'page',
                        'post_status' => 'publish',
                        'name' => 'about',
                    ]);

                    if ($about_query->have_posts()) :
                        while ($about_query->have_posts()) : $about_query->the_post();
                            ?>
                            <div class="about-page-content">
                                <h2><?php the_title(); ?></h2>
                                <?php the_content(); ?>
                            </div>
                        <?php
                        endwhile;
                        wp_reset_postdata();
                    endif;
                    ?>
                <?php endif; ?>

            </div>
        </div><!-- .container -->
    </main><!-- #main -->
</div><!-- #primary -->

<?php get_footer(); ?>
