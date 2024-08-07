<?php
// Enqueue generated css
function windpress_enqueue_styles()
{
    $google_fonts = windpress_get_google_fonts();
    if ($google_fonts) {
        wp_enqueue_style('gfonts', add_query_arg($google_fonts, '//fonts.googleapis.com/css'), array(), null);
    }

    wp_enqueue_style('stylesheet', get_template_directory_uri() . '/dist/index.css', array(), '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'windpress_enqueue_styles');

// enqueue the stylesheet for gutenberg 
function windpress_editor_enqueue_styles()
{
    $google_fonts = windpress_get_google_fonts();
    if ($google_fonts) {
        wp_enqueue_style('gfonts-editor', add_query_arg($google_fonts, '//fonts.googleapis.com/css'), array(), null);
    }
    wp_enqueue_style('stylesheet-editor', get_template_directory_uri() . '/dist/index.css', array(), '1.0', 'all');
}
add_action('enqueue_block_editor_assets', 'windpress_editor_enqueue_styles');

// Enqueue generated js
function windpress_enqueue_scripts()
{
    wp_enqueue_script('indexjs', get_template_directory_uri() . '/dist/index.js', array('jquery'));
}
add_action('wp_enqueue_scripts', 'windpress_enqueue_scripts');
