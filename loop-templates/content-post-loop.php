<div class="post-card">
    <div class="post-card-img">
        <a href="<?php echo esc_url(get_permalink()); ?>" class="post-card-img-link">
            <img src="<?php echo esc_url(get_the_post_thumbnail_url() ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/assets/public/src/img/thumbnail-default.jpg'); ?>" alt="<?php echo esc_attr(get_the_title()); ?>">
        </a>
    </div>

    <div class="post-card-description">
        <span class="post-card-meta"><?php echo esc_html(get_the_date('d M Y')); ?></span>
        <a href="<?php echo esc_url(get_permalink()); ?>" class="post-card-title-link">
            <h3><?php the_title(); ?></h3>
        </a>
        <p class="post-card-content"><?php echo wp_strip_all_tags(strip_shortcodes(get_the_content())); ?></p>
        <span class="post-card-author"><?php echo esc_html(get_the_author()); ?></span>
    </div>
</div>
