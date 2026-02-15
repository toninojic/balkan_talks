<?php
get_header();

$orderedCategories = [
    'in-focus' => 'In Focus',
    'stories' => 'Stories',
    'blog' => 'Blog',
];
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <div class="container front-page-ordered-categories">
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
