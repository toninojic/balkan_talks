<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Traits\SingletonTrait;

class Enqueue
{
    use SingletonTrait;

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'registerStylesAndScripts']);

        add_action('wp_enqueue_scripts', [$this, 'enqueueCommentReplyScript']);
    }

    public function registerStylesAndScripts() {
        wp_register_style('swiper-style', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css', [], '11.2.2', 'all');
        wp_enqueue_style('swiper-style');

        wp_register_style('main-style', get_template_directory_uri() . '/assets/public/dist/css/style.css', ['swiper-style'], '2.1', '');
        wp_enqueue_style('main-style');

        wp_register_script('swiper-script', 'https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js', [], '11.2.2', true);
        wp_enqueue_script('swiper-script');

        wp_register_script('main-script', get_template_directory_uri() . '/assets/public/dist/js/script.min.js', ['swiper-script'], '1.2', '');
        wp_enqueue_script('main-script');
        wp_localize_script( 'main-script', 'data',
            [
                'ajax_url' => admin_url( 'admin-ajax.php' )
            ]
        );
    }

    public function enqueueCommentReplyScript() {
        if (is_singular() && comments_open() && get_option('thread_comments')) {
            wp_enqueue_script('comment-reply');
        }
    }
}
