<?php
$query = $args['query'];
$categorySlug =  $args['cat'];
$tagSlug = $args['tag'];
$postsPerPage = isset($args['posts_per_page']) ? intval($args['posts_per_page']) : 6;
$layout = isset($args['layout']) ? sanitize_key($args['layout']) : 'default';
$allowedLayouts = ['default', 'swiper', 'featured', 'stacked'];

if (!in_array($layout, $allowedLayouts, true)) {
    $layout = 'default';
}

$postContainerClasses = 'post-container post-container--' . $layout;
$wrapperClasses = 'post-wrapper post-wrapper--' . $layout;
$showLoadMore = $layout !== 'swiper' && $query->found_posts > $postsPerPage;
?>
<div class="<?php echo esc_attr($wrapperClasses); ?>">
    <div class="<?php echo esc_attr($postContainerClasses); ?>" id="post-container" data-layout="<?php echo esc_attr($layout); ?>">

        <?php if ($layout === 'swiper') : ?>
            <div class="swiper-wrapper">
        <?php endif; ?>

        <?php
        $postIndex = 0;
        while ($query->have_posts()) :
            $query->the_post();

            if ($layout === 'featured') {
                $cardClass = $postIndex === 0 ? ' is-featured' : ' is-secondary';
                echo '<div class="post-card-slot' . esc_attr($cardClass) . '">';
                get_template_part('loop-templates/content', 'post-loop');
                echo '</div>';
            } elseif ($layout === 'swiper') {
                echo '<div class="swiper-slide">';
                get_template_part('loop-templates/content', 'post-loop');
                echo '</div>';
            } else {
                get_template_part('loop-templates/content', 'post-loop');
            }

            $postIndex++;
        endwhile;
        ?>

        <?php if ($layout === 'swiper') : ?>
            </div>
            <div class="swiper-pagination"></div>
        <?php endif; ?>

    </div>

    <?php if ($showLoadMore): ?>
         <button
            class="load-more-btn"
            id="load-more-button"
            data-offset="<?php echo esc_attr($postsPerPage); ?>"
            data-posts-per-page="<?php echo esc_attr($postsPerPage); ?>"
            <?php if (!empty($categorySlug)) : ?>
                data-category="<?php echo esc_attr($categorySlug); ?>"
            <?php endif; ?>
            <?php if (!empty($tagSlug)) : ?>
                data-tag="<?php echo esc_attr($tagSlug); ?>"
            <?php endif; ?>
        >
            Load More
        </button>
    <?php endif; ?>
</div>
