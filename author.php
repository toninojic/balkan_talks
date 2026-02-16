<?php
/*
Template Name: Author
*/

get_header();

$author = get_user_by('slug', get_query_var('author_name'));

if (!$author && get_query_var('author')) {
    $author = get_user_by('id', (int) get_query_var('author'));
}
?>

<div class="site-container">
    <main id="main-content" class="site-main">
        <div class="site-content">
            <div class="container author-container">
                <?php if ($author) : ?>
                    <section class="author-hero">
                        <div
                            class="author-image"
                            style="background-image: url('<?php echo esc_url(get_user_meta($author->ID, 'user_profile_image', true) ?: get_template_directory_uri() . '/assets/public/src/img/default-user.jpg'); ?>');"
                            aria-label="<?php echo esc_attr($author->display_name); ?>"
                        ></div>

                        <div class="author-about">
                            <h1 class="author-title"><?php echo esc_html($author->display_name); ?></h1>

                            <?php if (!empty($author->user_description)) : ?>
                                <p class="author-description"><?php echo wp_kses_post($author->user_description); ?></p>
                            <?php endif; ?>

                            <div class="author-meta">
                                <span class="author-meta-item">Posts: <?php echo esc_html((string) count_user_posts($author->ID)); ?></span>
                                <?php if (!empty($author->user_url)) : ?>
                                    <a class="author-meta-item author-meta-item--link" href="<?php echo esc_url($author->user_url); ?>" target="_blank" rel="noopener noreferrer">Website</a>
                                <?php endif; ?>
                            </div>
                        </div>
                    </section>

                    <section class="author-recent-posts">
                        <h2>Latest from <?php echo esc_html($author->display_name); ?></h2>
                        <div class="author-posts-grid">
                            <?php
                            $author_posts_query = new WP_Query([
                                'post_type' => 'post',
                                'post_status' => 'publish',
                                'author' => $author->ID,
                                'posts_per_page' => 6,
                            ]);

                            if ($author_posts_query->have_posts()) :
                                while ($author_posts_query->have_posts()) :
                                    $author_posts_query->the_post();
                                    get_template_part('loop-templates/content', 'post-loop');
                                endwhile;
                                wp_reset_postdata();
                            else :
                                ?>
                                <p class="author-empty">No posts yet.</p>
                                <?php
                            endif;
                            ?>
                        </div>
                    </section>
                <?php else : ?>
                    <div class="author-not-found">
                        <h1>Author not found</h1>
                        <p>Please check the URL and try again.</p>
                    </div>
                <?php endif; ?>
            </div>
        </div><!-- .site-content -->
    </main><!-- #main -->
</div><!-- .site-container -->
<?php

get_footer();
