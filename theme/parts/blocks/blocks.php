<?php

// Adds custom category to Gutenberg
add_filter('block_categories_all', function ($categories, $post) {
    return array_merge(
        [
            [
                'slug' => 'blink',
                'title' => get_bloginfo('name'),
            ],
        ],
        $categories
    );
}, 9999, 2);

// Loads all init files inside /parts/blocks/
add_action('init', function () {

    $blocksDir = get_template_directory() . '/parts/blocks';
    if (is_dir($blocksDir)) {

        foreach (glob($blocksDir . '/*', GLOB_ONLYDIR) as $dir) {

            register_block_type($dir .'/block.json');

            if (is_file($dir . '/init.php')) {
                require_once($dir . '/init.php');
            }

            $jsFiles = glob($dir . '/*.js');
            if(!empty($jsFiles))
            {
                foreach($jsFiles as $js_file_path)
                {
                    $block_name = basename($dir);
                    $file_name = basename($js_file_path);
                    wp_register_script($block_name.'-'.str_replace('.js','',$file_name), get_template_directory_uri().'/parts/blocks/'.$block_name.'/'.$file_name, [], wp_get_theme()->get('Version'), true);
                }
            }
        }
    }
}, 5);

// Loads gutenberg specific styles
function eye_enqueue_gutenberg_styles()
{
    wp_register_style('eye-editor-style', get_template_directory_uri() . '/parts/blocks/editor-style.css', [], wp_get_theme()->get('Version'), 'screen');
    wp_enqueue_style('eye-editor-style');
}

add_action('enqueue_block_editor_assets', 'eye_enqueue_gutenberg_styles');