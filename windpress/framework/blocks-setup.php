<?php
// Dynamically register ACF blocks from the 'blocks' folder if they include block.json
function windpress_register_acf_blocks_from_folder()
{
    foreach (glob(get_template_directory() . '/blocks/*/') as $path) {
        register_block_type($path . 'block.json');
    }
}
add_action('init', 'windpress_register_acf_blocks_from_folder');

// Attempt to load ACF json blocks from their associated /blocks folder. Fallsback to /acf-json folder.
function windpress_blocks_acf_json_load_paths($paths)
{
    foreach (glob(get_template_directory() . '/blocks/*/', GLOB_ONLYDIR) as $block_path) {
        $paths[] = $block_path;
    }
    return $paths;
}
add_filter( 'acf/settings/load_json', 'windpress_blocks_acf_json_load_paths' );

// Attempt to save ACF json blocks in their associated /blocks folder. Fallsback to /acf-json folder.
function windpress_blocks_acf_json_save_paths($paths, $post)
{
    // Look for the field groups location value, this should match the name specified in the blocks block.json file.
    $_name = isset($post['location'][0][0]['value']) ? $post['location'][0][0]['value'] : null;
    if (empty($_name)) return $paths;

    // Strip the acf namespace from the name. This should match the file name in the blocks/*/ folder.
    $name = str_replace('acf/', '', $_name);
    $block_path = get_template_directory() . "/blocks/$name";

    if (is_dir($block_path)) {
        $paths = array($block_path);
    }
    return $paths;
}
add_filter('acf/json/save_paths', 'windpress_blocks_acf_json_save_paths', 50, 2);

/* Add custom classes to core blocks */
//add_filter('render_block', 'windpress_add_container_class_to_core_blocks', 10, 2);
// function windpress_add_container_class_to_core_blocks($block_content, $block)
// {
//     $block_name = $block['blockName'];
//     if ( $block_name === 'core/paragraph') {
//         $block_content = new WP_HTML_Tag_Processor($block_content);
//         $block_content->next_tag();
//         $block_content->add_class('mb-5');
//         $block_content->get_updated_html();
//     }
//     if ( $block_name === 'core/quote') {
//         $block_content = new WP_HTML_Tag_Processor($block_content);
//         $block_content->next_tag();
//         $block_content->add_class('border-l-4 border-gray-200 pl-5 mb-5');
//         $block_content->get_updated_html();
//     }

//     return $block_content;
// }

/* --- Block Padding --- */

/**
 * Get the padding top class name for tablet devices and up.
 *
 * @return string The CSS class name for the top padding.
 */
function windpress_get_block_padding_top()
{
    $pt = get_field('padding_top');
    $map = [
        'none' => 'md:pt-0',
        'xs' => 'md:pt-block-xs',
        'sm' => 'md:pt-block-sm',
        'md' => 'md:pt-block-md',
        'lg' => 'md:pt-block-lg',
        'xl' => 'md:pt-block-xl'
    ];
    // Return 'md:pt-block-md' if the padding top value is not set or invalid.
    if (empty($pt) || !isset($map[$pt])) return 'md:pt-block-md';
    return $map[$pt];
}

/**
 * Get the padding bottom class name for tablet devices and up.
 *
 * @return string The CSS class name for the bottom padding.
 */
function windpress_get_block_padding_bottom()
{
    $pb = get_field('padding_bottom');
    $map = [
        'none' => 'md:pb-0',
        'xs' => 'md:pb-block-xs',
        'sm' => 'md:pb-block-sm',
        'md' => 'md:pb-block-md',
        'lg' => 'md:pb-block-lg',
        'xl' => 'md:pb-block-xl'
    ];
    // Return 'md:pb-block-md' if the padding bottom value is not set or invalid.
    if (empty($pb) || !isset($map[$pb])) return 'md:pb-block-md';
    return $map[$pb];
}

/**
 * Retrieves the padding top and bottom class names from the ACF Block settings.
 *
 * @return string The concatenated CSS class names for both top and bottom padding.
 */
function windpress_get_block_padding()
{
    $pt = windpress_get_block_padding_top();
    $pb = windpress_get_block_padding_bottom();
    return $pt . ' ' . $pb;
}

/* --- Block Margin --- */

/**
 * Get the margin top class name for tablet devices and up.
 *
 * @return string The CSS class name for the top margin.
 */
function windpress_get_block_margin_top()
{
    $mt = get_field('margin_top');
    $map = [
        'none' => 'md:mt-0',
        'xs' => 'md:mt-block-xs',
        'sm' => 'md:mt-block-sm',
        'md' => 'md:mt-block-md',
        'lg' => 'md:mt-block-lg',
        'xl' => 'md:mt-block-xl'
    ];
    if (empty($mt) || !$map[$mt]) return "md:mt-0";
    return $map[$mt];
}

/**
 * Get the margin bottom class name for tablet devices and up.
 *
 * @return string The CSS class name for the bottom margin.
 */
function windpress_get_block_margin_bottom()
{
    $mt = get_field('margin_bottom');
    $map = [
        'none' => 'md:mb-0',
        'xs' => 'md:mb-block-xs',
        'sm' => 'md:mb-block-sm',
        'md' => 'md:mb-block-md',
        'lg' => 'md:mb-block-lg',
        'xl' => 'md:mb-block-xl'
    ];
    if (empty($mt) || !$map[$mt]) return "md:mb-0";
    return $map[$mt];
}

/**
 * Retrieves the margin top and bottom class names from the ACF Block settings.
 *
 * @return string The concatenated CSS class names for both top and bottom margin.
 */
function windpress_get_block_margin()
{
    $mt = windpress_get_block_margin_top();
    $mb = windpress_get_block_margin_bottom();
    return $mt . ' ' . $mb;
}

function windpress_get_block_bg_style()
{
    $bg_style = "";

    // Background color
    $bg_color = get_field('bg_color');
    if (!empty($bg_color)) {
        $bg_style = "background-color: $bg_color;";
    }

    // Background image
    $bg_image_raw = get_field('bg_image');
    $bg_image_id = !empty($bg_image_raw['ID']) ? $bg_image_raw['ID'] : null;
    $bg_image_url = $bg_image_id ? esc_url(wp_get_attachment_image_url($bg_image_id, 'large')) : null;
    if (empty($bg_image_url)) {
        return $bg_style;
    }

    // Overlay color
    $overlay_color = get_field('bg_overlay_color');
    if (!empty($overlay_color)) {
        $bg_style .= "background-image: linear-gradient(0deg, $overlay_color, $overlay_color), url('$bg_image_url'); background-blend-mode: multiply;";
    } else {
        $bg_style .= "background-image: url('$bg_image_url');";
    }

    return $bg_style;
}

// Get the tailwind alignment class, defaults to center if null
function windpress_get_intro_alignment($alignment)
{
    $map = [
        'left' => 'text-left mr-auto',
        'center' => 'text-center mx-auto',
        'right' => 'text-right ml-auto'
    ];
    return empty($alignment) || !$map[$alignment] ? "text-center mx-auto" : $map[$alignment];
}

// Only load block assets if they're being used on the page
add_filter( 'should_load_separate_core_block_assets', '__return_true' );