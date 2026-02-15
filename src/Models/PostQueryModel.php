<?php

namespace BalkanTalks\Models;

use WP_Query;

class PostQueryModel
{
    /**
     * @var string[]
     */
    private array $allowedLayouts = ['default', 'swiper', 'featured', 'stacked'];

    /**
     * @param array<string, mixed> $filters
     *
     * @return array<string, mixed>
     */
    public function buildArgs(array $filters): array
    {
        $args = [
            'post_type' => 'post',
            'post_status' => 'publish',
            'order' => 'DESC',
            'offset' => max(0, intval($filters['offset'] ?? 0)),
            'posts_per_page' => max(1, intval($filters['posts_per_page'] ?? 6)),
        ];

        $tag = sanitize_title((string) ($filters['tag'] ?? ''));
        $category = sanitize_title((string) ($filters['category'] ?? ''));

        if ($tag !== '' && $tag !== 'null') {
            $args['tag'] = $tag;
        } elseif ($category !== '' && $category !== 'uncategorized') {
            $args['category_name'] = $category;
        }

        return $args;
    }

    public function sanitizeLayout(string $layout): string
    {
        $layout = sanitize_key($layout);

        if (!in_array($layout, $this->allowedLayouts, true)) {
            return 'default';
        }

        return $layout;
    }

    /**
     * @param array<string, mixed> $filters
     */
    public function query(array $filters): WP_Query
    {
        return new WP_Query($this->buildArgs($filters));
    }
}
