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
        ], $atts, 'custom_category_loop');

        $args = array(
            'order' => 'DESC',
            'offset' => 0,
            'posts_per_page' => 6
        );

        if (!empty($atts['category']) && $atts['category'] !== 'uncategorized') {
            $args['category_name'] = $atts['category'];
        }

        $postsLoopContent = '';

        $query = new WP_Query($args);

        if ($query->have_posts()) {
            ob_start();
            get_template_part('global-templates/content', 'posts', ['query' => $query, 'cat' => $atts['category']]);
            wp_reset_postdata();
            $postsLoopContent = ob_get_clean();
        }

        return $postsLoopContent;
    }
}
