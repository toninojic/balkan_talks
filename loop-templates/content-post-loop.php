<div class="post-card">
    <div class="post-card-img">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="post-card-img-link">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
        </a>
    </div>

    <div class="post-card-description">
        <a href="<?php echo esc_url(get_permalink()); ?>">
            <h3><?php the_title(); ?></h3>
        </a>
        <p class="post-card-date"><?php echo get_the_time('d. M. Y.'); ?></p>
        <p class="post-card-content"><?php echo wp_strip_all_tags(strip_shortcodes(get_the_content())); ?></p>
    </div>
</div>

