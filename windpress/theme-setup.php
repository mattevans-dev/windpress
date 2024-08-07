<?php
/** Project configuration defaults */

// Theme support features & register menus.
function windpress_theme_setup()
{
    /* Add theme support */
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('responsive-embeds');
    add_theme_support('custom-logo');
    remove_theme_support('blocks');
    remove_theme_support('theme-editor');

    /* Register nav menus */
    register_nav_menus(
        array(
            'primary-menu' => __('Primary Menu')
        )
    );
}
add_action('after_setup_theme', 'windpress_theme_setup');

// Register Google fonts to be loaded on the frontend & backend. Return false to disable Google Fonts.
function windpress_get_google_fonts()
{
    $args = array(
        'family' => 'Inter:400,500,600,700'
    );
    return $args;
}
