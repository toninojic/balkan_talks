<?php

namespace BalkanTalks\Controllers;

use BalkanTalks\Traits\SingletonTrait;

class ThemeSupportController
{
    use SingletonTrait;

    public function __construct() {
        add_action('after_setup_theme', [$this, 'registerThemeSupport'], 10);
        add_action('widgets_init', [$this, 'registeringSidebar']);
    }

    public function registerThemeSupport() {
        // Enable the <title> tag in the document head
        add_theme_support( 'title-tag' );

        // Enable admin bar
        //add_theme_support('admin-bar');

        if (is_user_logged_in()) {
            show_admin_bar(true);
        }

        // Add support for automatic feed links
        add_theme_support( 'automatic-feed-links' );

        // Enable default Gutenberg block styles
        add_theme_support('wp-block-styles');

        // Enable wide and full-align block alignments in Gutenberg
        add_theme_support('align-wide');

        // Enable editor styles
        add_theme_support('editor-styles');
        add_editor_style('style-editor.css');

        // Enable featured images (thumbnails)
        add_theme_support( 'post-thumbnails' );

        // Enable categories
        add_theme_support('category-thumbnails');

        // Enable post formats
        add_theme_support( 'post-formats', array(
            'aside',
            'image',
            'video',
            'quote',
            'link',
        ) );

        // Enable custom backgrounds
        add_theme_support( 'custom-background', apply_filters( 'bc_core_custom_background_args', array(
            'default-color' => 'ffffff',
            'default-image' => '',
        ) ) );

        // Enable custom logo
        add_theme_support( 'custom-logo' );

        // Enable widgets
        add_theme_support( 'widgets');

        // Enable HTML5 features
        add_theme_support( 'html5', array(
            'search-form',
            'comment-form',
            'comment-list',
            'gallery',
            'caption',
        ) );

        // Register primary navigation menu
        register_nav_menus( array(
            'primary_menu' => __( 'Primary Menu', 'balkan_talks' ),
        ) );
    }

    public function registeringSidebar() {
        register_sidebar( array(
            'name'          => __( 'Primary Sidebar', 'balkan_talks' ),
            'id'            => 'primary-sidebar',
            'description'   => __( 'Main sidebar that appears on the right.', 'balkan_talks' ),
            'before_widget' => '',
            'after_widget'  => '',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ) );
    }
}
