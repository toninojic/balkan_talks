<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Traits\SingletonTrait;
use WP_Query;

class LoadMore
{
    use SingletonTrait;

    public function __construct() {
        add_action('wp_ajax_load_more_posts', [$this, 'loadMorePosts']);
        add_action('wp_ajax_nopriv_load_more_posts', [$this, 'loadMorePosts']);
    }

    public function loadMorePosts() {
        // check_ajax_referer('load_more_posts_nonce', 'security');

        $offset = isset($_POST['offset']) ? intval($_POST['offset']) : 0;
        $category = isset($_POST['category']) ? sanitize_text_field($_POST['category']) : '';
        $tag = isset($_POST['tag']) ? sanitize_text_field($_POST['tag']) : '';

        $args = [
            'offset' => $offset,
            'order' => 'DESC',
            'posts_per_page' => 6,
            'post_status' => 'publish',
            'post_type' => 'post',
        ];

        if ($tag !== 'null') {
            $args['tag'] = $tag;
        } elseif (!empty($category) && $category !== 'uncategorized') {
            $args['category_name'] = $category;
        }

        $query = new WP_Query($args);

        ob_start();

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                get_template_part('loop-templates/content', 'post-loop');
            }
            wp_reset_postdata();
        }

        $result = ob_get_clean();

        wp_send_json_success($result);
    }
}
