<?php
/*
Template Name: Archives
*/
get_header();

$currentCategory = get_queried_object();
$parentCategory = get_category($currentCategory->parent);

function isCategoryOrParent($category, $slug) {
    return ($category->slug === $slug) || (in_array($slug, get_ancestors($category->term_id, 'category')));
}

if (is_a($currentCategory, 'WP_Term')) {
    $categorySlug = $currentCategory->slug;
    if (isCategoryOrParent($currentCategory, 'about') || (is_a($parentCategory, 'WP_Term') && isCategoryOrParent($parentCategory, 'about'))) {

        get_template_part('loop-templates/generic', 'category', ['categorySlug' => $categorySlug]);

    } elseif (isCategoryOrParent($currentCategory, 'stories') || (is_a($parentCategory, 'WP_Term') && isCategoryOrParent($parentCategory, 'stories'))) {

        get_template_part('loop-templates/generic', 'category', ['categorySlug' => $categorySlug]);

    } elseif (isCategoryOrParent($currentCategory, 'programs') || (is_a($parentCategory, 'WP_Term') && isCategoryOrParent($parentCategory, 'programs'))) {

        get_template_part('loop-templates/generic', 'category', ['categorySlug' => $categorySlug]);

    } else {
        get_template_part('loop-templates/generic', 'category', ['categorySlug' => $categorySlug]);
    }
} else {
    get_template_part('loop-templates/generic', 'category');
}

get_footer();
