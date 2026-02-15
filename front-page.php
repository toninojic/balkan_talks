<?php
get_header();

$orderedCategories = [
    'in-focus' => 'In Focus',
    'stories' => 'Stories',
    'blog' => 'Blog',
];

$inFocusHeroQuery = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'category_name' => 'in-focus',
    'ignore_sticky_posts' => true,
]);
?>

<div id="primary" class="content-area front-page-news-layout">
    <main id="main" class="site-main">
        <div class="container front-page-ordered-categories">
            <section class="front-page-topbar" aria-label="Top stories intro">
                <p class="front-page-topbar__label"><?php esc_html_e('Balkan Talks Newsroom', 'balkantalks'); ?></p>
                <h1><?php esc_html_e('Latest insights from In Focus, Stories and Blog', 'balkantalks'); ?></h1>
            </section>

            <?php if ($inFocusHeroQuery->have_posts()) : ?>
                <?php while ($inFocusHeroQuery->have_posts()) : $inFocusHeroQuery->the_post(); ?>
                    <article class="front-page-hero" aria-label="In Focus featured story">
                        <a class="front-page-hero__image" href="<?php echo esc_url(get_permalink()); ?>">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </a>
                        <div class="front-page-hero__content">
                            <span class="front-page-hero__tag"><?php esc_html_e('In Focus', 'balkantalks'); ?></span>
                            <h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h2>
                            <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt() ?: get_the_content()), 30)); ?></p>
                        </div>
                    </article>
                <?php endwhile; wp_reset_postdata(); ?>
            <?php endif; ?>

            <?php foreach ($orderedCategories as $slug => $fallbackTitle) : ?>
                <?php
                $category = get_category_by_slug($slug);

                if (!$category instanceof WP_Term) {
                    continue;
                }
                ?>

                <section class="front-page-category-block front-page-category-block--<?php echo esc_attr(sanitize_html_class($slug)); ?>">
                    <div class="category-preview-header">
                        <h2><?php echo esc_html($category->name ?: $fallbackTitle); ?></h2>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>"><?php esc_html_e('View all', 'balkantalks'); ?></a>
                    </div>

                    <?php echo do_shortcode("[custom_category_loop category='{$slug}']"); ?>
                </section>
            <?php endforeach; ?>
        </div>
    </main>
</div>

<?php
get_footer();
