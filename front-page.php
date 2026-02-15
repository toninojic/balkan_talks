<?php
get_header();

$featuredQuery = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 1,
    'ignore_sticky_posts' => true,
]);

$latestQuery = new WP_Query([
    'post_type' => 'post',
    'post_status' => 'publish',
    'posts_per_page' => 4,
    'offset' => 1,
    'ignore_sticky_posts' => true,
]);

$categories = get_categories([
    'taxonomy' => 'category',
    'hide_empty' => true,
    'parent' => 0,
    'exclude' => [get_cat_ID('Uncategorized')],
    'number' => 4,
]);
?>

<div class="front-page-news">
    <div class="container">
        <section class="news-hero" aria-label="Top stories">
            <?php if ($featuredQuery->have_posts()) : ?>
                <?php while ($featuredQuery->have_posts()) : $featuredQuery->the_post(); ?>
                    <article class="news-hero__featured">
                        <a class="news-hero__image" href="<?php echo esc_url(get_permalink()); ?>">
                            <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'large') ?: get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                        </a>
                        <div class="news-hero__content">
                            <span class="news-hero__eyebrow"><?php echo esc_html(get_the_category()[0]->name ?? 'Latest'); ?></span>
                            <h1><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h1>
                            <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt() ?: get_the_content()), 28)); ?></p>
                        </div>
                    </article>
                <?php endwhile; ?>
            <?php endif; ?>

            <?php if ($latestQuery->have_posts()) : ?>
                <div class="news-hero__latest">
                    <?php while ($latestQuery->have_posts()) : $latestQuery->the_post(); ?>
                        <article class="news-hero__latest-item">
                            <a href="<?php echo esc_url(get_permalink()); ?>" class="thumb">
                                <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium') ?: get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                            </a>
                            <div>
                                <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                                <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt() ?: get_the_content()), 13)); ?></p>
                            </div>
                        </article>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </section>

        <section class="news-categories" aria-label="Category previews">
            <?php
            $layoutVariants = ['split', 'stack', 'minimal', 'magazine'];
            foreach ($categories as $index => $category) :
                $categoryPosts = new WP_Query([
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'category_name' => $category->slug,
                ]);

                if (!$categoryPosts->have_posts()) {
                    continue;
                }

                $layout = $layoutVariants[$index % count($layoutVariants)];
                ?>
                <div class="category-preview category-preview--<?php echo esc_attr($layout); ?>">
                    <div class="category-preview__header">
                        <h2><?php echo esc_html($category->name); ?></h2>
                        <a href="<?php echo esc_url(get_category_link($category->term_id)); ?>">View all</a>
                    </div>
                    <div class="category-preview__posts">
                        <?php while ($categoryPosts->have_posts()) : $categoryPosts->the_post(); ?>
                            <article class="category-preview__post">
                                <a class="category-preview__post-thumb" href="<?php echo esc_url(get_permalink()); ?>">
                                    <img src="<?php echo esc_url(get_the_post_thumbnail_url(get_the_ID(), 'medium_large') ?: get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
                                </a>
                                <div class="category-preview__post-content">
                                    <h3><a href="<?php echo esc_url(get_permalink()); ?>"><?php the_title(); ?></a></h3>
                                    <p><?php echo esc_html(wp_trim_words(wp_strip_all_tags(get_the_excerpt() ?: get_the_content()), 18)); ?></p>
                                </div>
                            </article>
                        <?php endwhile; wp_reset_postdata(); ?>
                    </div>
                </div>
            <?php endforeach; ?>
        </section>
    </div>
</div>

<?php
wp_reset_postdata();
get_footer();
