<?php
$query = $args['query'];
$categorySlug =  $args['cat'];
$tagSlug = $args['tag'];
$postsPerPage = isset($args['posts_per_page']) ? intval($args['posts_per_page']) : 6;

?>
<div class="post-wrapper">
    <div class="post-container" id="post-container">

        <?php  while ($query->have_posts()) : $query->the_post();
            get_template_part('loop-templates/content','post-loop' );
        endwhile; ?>

    </div>

    <?php if ($query->found_posts > 6): ?>
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