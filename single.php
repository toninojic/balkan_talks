<?php
/**
 * Template Name: Single Post Template
 */


$is_resources = has_category('resources');
$article_classes = ['post-article'];
if ($is_resources) {
    $article_classes[] = 'is-resources';
}

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
                        <article id="post-<?php the_ID(); ?>" <?php post_class($article_classes); ?>>
                            <header class="entry-header">
                                <h1 class="entry-title"><?php the_title(); ?></h1>
                            </header><!-- .entry-header -->

                            <?php if ($is_resources): ?>
                                <div class="in-content-search-wrapper">
                                    <label for="in-content-search">Search in content:</label>
                                    <input type="text" id="in-content-search" class="in-content-search" placeholder="Type to search...">
                                </div>
                            <?php endif; ?>

                            <div class="entry-content" <?php echo $is_resources ? ' id="searchable-content"' : ''; ?>>
                                <?php the_content(); ?>
                            </div><!-- .entry-content -->

                            <?php 
                            $post_tags = get_the_tags();
                            if ($post_tags) : ?>
                                <div class="post-tags">
                                    <h4>Tags:</h4>
                                    <ul>
                                        <?php foreach ($post_tags as $tag) : ?>
                                            <li>
                                                <a href="<?php echo get_tag_link($tag->term_id); ?>">
                                                    <?php echo esc_html($tag->name); ?>
                                                </a>
                                            </li>
                                        <?php endforeach; ?>
                                    </ul>
                                </div>
                            <?php endif; ?>

                            <?php 
                                if (comments_open() || get_comments_number()) :
                                    comments_template();
                                endif;
                            ?>

                        </article><!-- #post-<?php the_ID(); ?> -->

                        <?php if (!in_array(get_the_ID(), [52, 54]) && !$is_resources) : ?>
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
