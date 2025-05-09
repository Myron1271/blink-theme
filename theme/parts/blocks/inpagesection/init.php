<?php

// Add metafields
if (function_exists('acf_add_local_field_group')) {
    acf_add_local_field_group([
        'key' => 'eye_inpagenav',
        'title' => 'In-page navigatie',
        'fields' => [
            [
                'key' => 'inpagenav_name',
                'label' => 'Titel',
                'name' => 'name',
                'type' => 'text',
                'instructions' => '',
                'required' => 1,
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'eye/inpagesection',
                ],
            ],
        ],
        'menu_order' => 0,
        'position' => 'normal',
        'style' => 'default',
        'label_placement' => 'top',
        'instruction_placement' => 'label',
        'hide_on_screen' => '',
        'active' => true,
        'description' => '',
    ]);
}