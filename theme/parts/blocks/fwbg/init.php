<?php

// Register metafields
if (function_exists('acf_add_local_field_group')) {

    acf_add_local_field_group([
        'key' => 'eye_fwbg',
        'title' => 'Volledige breedte achtergrond',
        'fields' => [
            [
                'key' => 'fwbg_color',
                'label' => 'Achtergrondkleur',
                'name' => 'color',
                'type' => 'select',
                'instructions' => '',
                'required' => 1,
                'choices' => [
//                    'lightblue' => 'Lichtblauw',
//                    'blue' => 'Blauw',
//                    'darkblue' => 'Donkerblauw',
//                    'red' => 'Rood',
                    'custom' => 'Handmatig',
                ],
                'return_format' => 'value',
            ],
            [
                'key' => 'fwbg_custom_color',
                'label' => 'Eigen kleur',
                'name' => 'custom_color',
                'type' => 'color_picker',
                'required' => 1,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'fwbg_color',
                            'operator' => '==',
                            'value' => 'custom',
                        ],
                    ],
                ],
                'enable_opacity' => 1,
                'return_format' => 'string',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'eye/fwbg',
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