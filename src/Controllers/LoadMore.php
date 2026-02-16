<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Models\PostQueryModel;
use BalkanTalks\Traits\SingletonTrait;
use BalkanTalks\Views\TemplateRenderer;

class LoadMore
{
    use SingletonTrait;

    private PostQueryModel $postQueryModel;

    private TemplateRenderer $templateRenderer;

    public function __construct() {
        $this->postQueryModel = new PostQueryModel();
        $this->templateRenderer = new TemplateRenderer();

        add_action('wp_ajax_load_more_posts', [$this, 'loadMorePosts']);
        add_action('wp_ajax_nopriv_load_more_posts', [$this, 'loadMorePosts']);
    }

    public function loadMorePosts() {
        $layout = $this->postQueryModel->sanitizeLayout((string) ($_POST['layout'] ?? 'default'));

        $filters = [
            'offset' => $_POST['offset'] ?? 0,
            'category' => $_POST['category'] ?? '',
            'tag' => $_POST['tag'] ?? '',
            'posts_per_page' => $_POST['posts_per_page'] ?? 6,
        ];

        $query = $this->postQueryModel->query($filters);

        $result = '';

        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $card = $this->templateRenderer->renderTemplatePart('loop-templates/content', 'post-loop');

                if ($layout === 'swiper') {
                    $result .= '<div class="swiper-slide">' . $card . '</div>';
                    continue;
                }

                $result .= $card;
            }
            wp_reset_postdata();
        }

        wp_send_json_success($result);
    }
}
