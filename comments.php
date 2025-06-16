<?php
if (post_password_required()) {
    return;
}
?>

<div id="comments" class="comments-area">

    <?php if (have_comments()) : ?>
        <h2 class="comments-title">
            <?php
            $count = get_comments_number();
            printf(_n('One comment', '%s comments', $count), number_format_i18n($count));
            ?>
        </h2>

        <ul class="comment-list">
            <?php
                wp_list_comments([
                    'style' => 'ul',
                    'avatar_size' => 40
                ]); 
            ?>
        </ul>
    <?php endif; ?>

    <?php
    comment_form();
    ?>

</div>
