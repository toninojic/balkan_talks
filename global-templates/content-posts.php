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
$showLoadMore = in_array($layout, ['default', 'stacked'], true) && $query->found_posts > $postsPerPage;
?>
<div class="<?php echo esc_attr($wrapperClasses); ?>">
    <div class="<?php echo esc_attr($postContainerClasses); ?>" id="post-container" data-layout="<?php echo esc_attr($layout); ?>">

        <?php if ($layout === 'swiper') : ?>
            <div class="swiper-wrapper">
                <?php while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="swiper-slide">
                        <?php get_template_part('loop-templates/content', 'post-loop'); ?>
                    </div>
                <?php endwhile; ?>
            </div>
            <div class="swiper-pagination"></div>
        <?php elseif ($layout === 'featured') : ?>
            <?php
            $cards = [];
            while ($query->have_posts()) :
                $query->the_post();
                ob_start();
                get_template_part('loop-templates/content', 'post-loop');
                $cards[] = ob_get_clean();
            endwhile;
            ?>

            <div class="featured-hero">
                <div class="featured-side featured-side--left"><?php echo isset($cards[1]) ? $cards[1] : ''; ?></div>
                <div class="featured-main"><?php echo isset($cards[0]) ? $cards[0] : ''; ?></div>
                <div class="featured-side featured-side--right"><?php echo isset($cards[2]) ? $cards[2] : ''; ?></div>
            </div>

            <?php if (count($cards) > 3) : ?>
                <div class="featured-more">
                    <?php for ($i = 3; $i < count($cards); $i++) : ?>
                        <?php echo $cards[$i]; ?>
                    <?php endfor; ?>
                </div>
            <?php endif; ?>
        <?php else : ?>
            <?php while ($query->have_posts()) : $query->the_post(); ?>
                <?php get_template_part('loop-templates/content', 'post-loop'); ?>
            <?php endwhile; ?>
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
