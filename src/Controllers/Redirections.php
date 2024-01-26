<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Traits\SingletonTrait;

class Redirections
{
    use SingletonTrait;

    public function __construct() {
        add_action('template_redirect', [$this, 'customAboutPageRedirect']);
    }

    public function customAboutPageRedirect() {
        if (is_page('about') && !is_category('about')) {
            $category = get_category_by_slug('about');
            if ($category) {
                $category_link = get_category_link($category->term_id);
                wp_redirect($category_link, 301);
                exit;
            }
        }
    }
}
