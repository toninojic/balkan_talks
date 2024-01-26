<?php
/**
 * Template Name: Page Template
 */

get_header(); ?>

<div class="site-container">
    <main id="main-content" class="site-main">
        <div class="site-content">
            <div class="container">
                <?php
                while (have_posts()) :
                    the_post();
                    ?>
                    <article id="post-<?php the_ID(); ?>" <?php post_class('page-article'); ?>>
                        <header class="entry-header">
                            <h1 class="entry-title"><?php the_title(); ?></h1>
                        </header><!-- .entry-header -->

                        <div class="entry-content">
                            <?php the_content(); ?>
                        </div><!-- .entry-content -->

                    </article><!-- #post-<?php the_ID(); ?> -->

                <?php endwhile;?>
            </div>
        </div><!-- .site-content -->
    </main><!-- #main -->

</div><!-- .site-container -->

<?php get_footer(); ?>
