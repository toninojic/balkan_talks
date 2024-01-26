<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Traits\SingletonTrait;

class Enqueue
{
    use SingletonTrait;

    public function __construct() {
        add_action('wp_enqueue_scripts', [$this, 'registerStylesAndScripts']);
    }

    public function registerStylesAndScripts() {
        wp_register_style('main-style', get_template_directory_uri() . '/assets/public/dist/css/style.css', [], '1.0', '');

        wp_enqueue_style('main-style');

        wp_register_script('main-script', get_template_directory_uri() . '/assets/public/dist/js/script.min.js', [], '1.0', '');
        wp_enqueue_script('main-script');
        wp_localize_script( 'main-script', 'data',
            [
                'ajax_url' => admin_url( 'admin-ajax.php' )
            ]
        );
    }
}
