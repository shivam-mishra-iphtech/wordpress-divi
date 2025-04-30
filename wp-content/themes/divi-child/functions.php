<?php
// Enqueue parent and Bootstrap styles/scripts
function divi_child_enqueue_scripts() {
    // Parent theme CSS
    wp_enqueue_style('parent-style', get_template_directory_uri() . '/style.css');

    // Bootstrap 5 CSS
    wp_enqueue_style('bootstrap-5-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css');

    // Bootstrap 5 JS
    wp_enqueue_script('bootstrap-5-js', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js', array(), null, true);
}
add_action('wp_enqueue_scripts', 'divi_child_enqueue_scripts');
