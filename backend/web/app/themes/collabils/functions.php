<?php
add_theme_support('post-thumbnails');
add_theme_support('menus');

function collabils_register_menu()
{
    register_nav_menus([
        "menu_light" => "Menu Light"
    ]);
}
add_action('init', 'collabils_register_menu');

function collabils_enqueue_scripts()
{
    wp_enqueue_style('collabils', get_template_directory_uri() . '/assets/css/index.css');
}
add_action('wp_enqueue_scripts', 'collabils_enqueue_scripts');
?>
