<?php
$query = $args['query'];
$categorySlug =  $args['cat'];

?>
<div class="post-wrapper">
    <div class="post-container" id="post-container">

        <?php  while ($query->have_posts()) : $query->the_post();
            get_template_part('loop-templates/content','post-loop' );
        endwhile; ?>

    </div>

    <?php if ($query->found_posts > 6): ?>
        <button class="load-more-btn" id="load-more-button" data-offset="6" data-category="<?php echo $categorySlug; ?>">Load More</button>
    <?php endif; ?>
</div>
