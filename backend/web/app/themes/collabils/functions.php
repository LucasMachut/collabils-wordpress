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
    wp_enqueue_script( 'search', get_template_directory_uri() . '/js/search.js', array( 'jquery', 'vue', 'axios' ), '1.0.0', true );

}
add_action('wp_enqueue_scripts', 'collabils_enqueue_scripts');

function enable_comments_for_signe_template($open, $post_id) {
    $post = get_post($post_id);
    $template = get_page_template_slug($post_id);
    
    if ($template == 'single-signe.php') { // Remarque: le nom du fichier doit être correct
        $open = true;
    }

    return $open;
}
add_filter('comments_open', 'enable_comments_for_signe_template', 10, 2);


//LOGIN FUNCTIONS

function redirect_login_page() {
    $login_url  = home_url('/login');
    $url = basename($_SERVER['REQUEST_URI']);

    if ($url == "wp-login.php" && $_SERVER['REQUEST_METHOD'] == 'GET') {
        wp_redirect($login_url);
        exit;
    }
}
add_action('init', 'redirect_login_page');

function login_failed() {
    $login_url = home_url('/login');
    wp_redirect($login_url . '?login=failed');
    exit;
}
add_action('wp_login_failed', 'login_failed');
