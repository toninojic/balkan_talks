<?php
get_header();

$inFocusQuery = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 3,
    'category_name' => 'in-focus',
    'ignore_sticky_posts' => true,
]);

$inFocusCategory = get_category_by_slug('in-focus');
$storiesCategory = get_category_by_slug('stories');
$blogCategory = get_category_by_slug('blog');
?>

<div id="primary" class="content-area front-page-news-layout">
    <main id="main" class="site-main">
        <div class="container front-page-ordered-categories">

            <section class="front-page-section front-page-section--in-focus" aria-label="In Focus highlights">
                <div class="category-preview-header">
                    <h2><?php esc_html_e('In Focus', 'balkantalks'); ?></h2>
                    <?php if ($inFocusQuery->have_posts() && $inFocusCategory instanceof WP_Term) : ?>
                        <a href="<?php echo esc_url(get_category_link($inFocusCategory->term_id)); ?>"><?php esc_html_e('View all', 'balkantalks'); ?></a>
                    <?php endif; ?>
                </div>

                <div class="in-focus-highlights">
                    <?php if ($inFocusQuery->have_posts()) : ?>
                        <?php $cardIndex = 0; ?>
                        <?php while ($inFocusQuery->have_posts()) : $inFocusQuery->the_post(); $cardIndex++; ?>
                            <article class="in-focus-card in-focus-card--<?php echo esc_attr($cardIndex === 1 ? 'main' : 'secondary'); ?>">
                                <a class="in-focus-card__image" href="<?php echo esc_url(get_permalink()); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                                <div class="in-focus-card__content">
                                    <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt() ?: get_the_content()), $cardIndex === 1 ? 26 : 14)); ?></p>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    <?php else : ?>
                        <p><?php esc_html_e('No In Focus posts found.', 'balkantalks'); ?></p>
                    <?php endif; ?>
                </div>
            </section>

            <?php if ($storiesCategory instanceof WP_Term) : ?>
                <section class="front-page-section front-page-section--stories" aria-label="Stories carousel">
                    <div class="category-preview-header">
                        <h2><?php echo esc_html($storiesCategory->name); ?></h2>
                        <a href="<?php echo esc_url(get_category_link($storiesCategory->term_id)); ?>"><?php esc_html_e('View all', 'balkantalks'); ?></a>
                    </div>

                    <div class="front-page-stories-carousel">
                        <?php echo do_shortcode("[custom_category_loop category='stories' posts_per_page='6']"); ?>
                    </div>
                </section>
            <?php endif; ?>

            <?php if ($blogCategory instanceof WP_Term) : ?>
                <section class="front-page-section front-page-section--blog" aria-label="Blog posts">
                    <div class="category-preview-header">
                        <h2><?php echo esc_html($blogCategory->name); ?></h2>
                        <a href="<?php echo esc_url(get_category_link($blogCategory->term_id)); ?>"><?php esc_html_e('View all', 'balkantalks'); ?></a>
                    </div>

                    <div class="front-page-blog-grid">
                        <?php echo do_shortcode("[custom_category_loop category='blog' posts_per_page='6']"); ?>
                    </div>
                </section>
            <?php endif; ?>

        </div>
    </main>
</div>

<?php
get_footer();
