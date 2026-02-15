<?php
namespace BalkanTalks\Shortcodes;

use WP_Query;

class PostsLoop
{
    public function __construct() {
        add_shortcode('custom_category_loop', [$this, 'displayCategoryLoop']);
    }

    public function displayCategoryLoop($atts) {
        $atts = shortcode_atts([
            'category' => '',
            'tag' => '',
            'posts_per_page' => 6,
        ], $atts, 'custom_category_loop');

        $postsPerPage = intval($atts['posts_per_page']);

        $args = [
            'post_type' => 'post',
            'order' => 'DESC',
            'offset' => 0,
            'posts_per_page' => $postsPerPage,
        ];

        if (!empty($atts['tag'])) {
            $args['tag'] = sanitize_title($atts['tag']);
        } elseif (!empty($atts['category']) && $atts['category'] !== 'uncategorized') {
            $args['category_name'] = sanitize_title($atts['category']);
        }

        $postsLoopContent = '';

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            ob_start();
            get_template_part('global-templates/content', 'posts', [
                'query' => $query,
                'cat' => $atts['category'],
                'tag' => $atts['tag'],
                'posts_per_page' => $postsPerPage,
            ]);
            wp_reset_postdata();
            $postsLoopContent = ob_get_clean();
        }

        return $postsLoopContent;
    }

}