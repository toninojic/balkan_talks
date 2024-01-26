<?php
get_header();
?>
    <div class="container">
        <?php
        if (have_posts()) {
            while (have_posts()) {
                the_post();
                the_title('<h2>', '</h2>');
                the_content();
            }
        } else {
            echo 'No content to show.';
        }
        ?>
    </div>

<?php
get_footer();
