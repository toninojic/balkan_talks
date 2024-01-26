<?php
/**
 * Template Name: About Page Template
 */
get_header();

$args = array(
    'post_type' => 'post',
    'posts_per_page' => -1,
    'category_name' => 'about',
    'order' => 'ASC'
);

$query = new WP_Query($args);


get_footer();