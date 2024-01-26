<?php
$user = $args['user'];

?>

<div class="user-profile">
    <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>" class="user-link">
        <div style="background-image: url('<?php echo esc_url(get_user_meta($user->ID, 'user_profile_image', true) ?: get_template_directory_uri() . '/assets/public/src/img/default-user.jpg'); ?>');" class="user-image">
        </div>
    </a>
    <div class="user-details">
        <a href="<?php echo esc_url(get_author_posts_url($user->ID)); ?>" class="user-link">
            <h3 class="user-name"><?php echo $user->display_name; ?></h3>
        </a>
        <p class="user-description"><?php echo $user->user_description; ?></p>
    </div>
</div>