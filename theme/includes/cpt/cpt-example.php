<?php

// Register the post type
function create_eye_example()
{

    register_post_type('example', [
            'label' => 'Voorbeelden',
            'description' => 'Voorbeelden',
            'labels' => [
                'name' => __('Voorbeelden'),
                'singular_name' => __('Voorbeeld'),
                'menu_name' => __('Voorbeelden'),
                'parent_item_colon' => __('Hoofd voorbeeld'),
                'all_items' => __('Alle voorbeelden'),
                'view_item' => __('Bekijk voorbeeld'),
                'add_new_item' => __('Voeg nieuw voorbeeld toe'),
                'add_new' => __('Voeg toe'),
                'edit_item' => __('Wijzig voorbeeld'),
                'update_item' => __('Update voorbeeld'),
                'search_items' => __('Zoek voorbeeld'),
                'not_found' => __('Niet gevonden'),
                'not_found_in_trash' => __('Niet gevonden in prullenbak'),
            ],
            'supports' => [
                'title',
                'editor',
                'thumbnail'
            ],
            'show_in_rest' => true,
            'hierarchical' => false,
            'public' => true,
            'menu_icon' => 'dashicons-warning',
            'show_ui' => true,
            'show_in_menu' => true,
            'show_in_nav_menus' => true,
            'show_in_admin_bar' => true,
            'menu_position' => 21,
            'exclude_from_search' => true,
            'publicly_queryable' => true,
            'rewrite' => [
                'slug' => 'voorbeeld'
            ],
        ]
    );
}

add_action('init', 'create_eye_example');