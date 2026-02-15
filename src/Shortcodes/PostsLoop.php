<?php

namespace BalkanTalks\Shortcodes;

use BalkanTalks\Models\PostQueryModel;
use BalkanTalks\Views\TemplateRenderer;

class PostsLoop
{
    private PostQueryModel $postQueryModel;

    private TemplateRenderer $templateRenderer;

    public function __construct() {
        $this->postQueryModel = new PostQueryModel();
        $this->templateRenderer = new TemplateRenderer();

        add_shortcode('custom_category_loop', [$this, 'displayCategoryLoop']);
    }

    /**
     * @param array<string, mixed> $atts
     */
    public function displayCategoryLoop($atts): string {
        $atts = shortcode_atts([
            'category' => '',
            'tag' => '',
            'posts_per_page' => 6,
            'layout' => 'default',
        ], $atts, 'custom_category_loop');

        $postsPerPage = max(1, intval($atts['posts_per_page']));
        $layout = $this->postQueryModel->sanitizeLayout((string) $atts['layout']);

        $query = $this->postQueryModel->query([
            'category' => $atts['category'],
            'tag' => $atts['tag'],
            'posts_per_page' => $postsPerPage,
            'offset' => 0,
        ]);

        if (!$query->have_posts()) {
            return '';
        }

        $content = $this->templateRenderer->renderTemplatePart('global-templates/content', 'posts', [
            'query' => $query,
            'cat' => $atts['category'],
            'tag' => $atts['tag'],
            'posts_per_page' => $postsPerPage,
            'layout' => $layout,
        ]);

        wp_reset_postdata();

        return $content;
    }
}
