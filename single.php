<?php
/**
 * Template Name: Single Post Template
 */

get_header(); ?>

<div class="site-container">
    <main id="main-content" class="site-main">
        <div class="site-content">
            <div class="container">
                <div class="content-area">
                    <?php
                    while (have_posts()) :
                        the_post();
                        ?>
                        <article id="post-<?php the_ID(); ?>" <?php post_class('post-article'); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </header><!-- .entry-header -->

                            <div class="entry-content">
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->

                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php if (!in_array(get_the_ID(), [52, 54])) : ?>
                            <aside class="sidebar">
                                    <?php if (is_active_sidebar('primary-sidebar')) : ?>
                                        <?php dynamic_sidebar('primary-sidebar'); ?>
                                    <?php endif; ?>
                            </aside><!-- .sidebar -->
                        <?php endif; ?>

                    <?php endwhile;?>
                </div><!-- .content-area -->
            </div><!-- .post-container -->
        </div><!-- .site-content -->
    </main><!-- #main -->

</div><!-- .site-container -->

<?php get_footer(); ?>
