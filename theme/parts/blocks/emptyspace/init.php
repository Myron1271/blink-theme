<?php

// Add custom fields
if (function_exists('acf_add_local_field_group')) {

    acf_add_local_field_group([
        'key' => 'eye_emptyspace',
        'title' => 'Lege ruimte',
        'fields' => [
            [
                'key' => 'emptyspace_size',
                'label' => 'Hoogte',
                'name' => 'size',
                'type' => 'select',
                'instructions' => 'Kies een hoogte van de lege ruimte',
                'required' => 1,
                'choices' => [
                    'small' => 'Klein',
                    'medium' => 'Middel',
                    'large' => 'Groot',
                    'custom' => 'Handmatig',
                ],
                'return_format' => 'value',
            ],
            [
                'key' => 'emptyspace_custom_size',
                'label' => 'Handmatige grootte',
                'name' => 'custom_size',
                'type' => 'text',
                'instructions' => 'Geef handmatig een hoogte in (bv. 1rem of 25px)',
                'required' => 1,
                'conditional_logic' => [
                    [
                        [
                            'field' => 'emptyspace_size',
                            'operator' => '==',
                            'value' => 'custom',
                        ],
                    ],
                ],
                'placeholder' => '16px',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'eye/emptyspace',
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