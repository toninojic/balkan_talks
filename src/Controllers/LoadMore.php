<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Traits\SingletonTrait;
use WP_Query;

class LoadMore
{
    use SingletonTrait;

    public function __construct() {
        add_action('wp_ajax_load_more_posts', [$this, 'loadMorePosts']);
        add_action('wp_ajax_nopriv_load_more_posts',  [$this, 'loadMorePosts']);
    }

    public function loadMorePosts() {
        //check_ajax_referer('load_more_posts_nonce', 'security');

        $offset = $_POST['offset'];
        $category = $_POST['category'];

        $args = array(
            'offset' => $offset,
            'order'   => 'DESC',
            'posts_per_page' => 6,
        );

        if (!empty($category) && $category !== 'uncategorized') {
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
