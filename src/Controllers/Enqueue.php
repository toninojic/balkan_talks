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
        wp_register_style('main-style', get_template_directory_uri() . '/assets/public/dist/css/style.css', [], '2.0', '');

        wp_enqueue_style('main-style');

        wp_register_script('main-script', get_template_directory_uri() . '/assets/public/dist/js/script.min.js', [], '1.1', '');
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
