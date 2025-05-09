<?php

// Register metafields
if (function_exists('acf_add_local_field_group')) {

    acf_add_local_field_group([
        'key' => 'eye_bsbtn',
        'title' => 'Bootstrap Button',
        'fields' => [
            [
                'key' => 'bsbtn_style',
                'label' => 'Knopstijl',
                'name' => 'type',
                'type' => 'select',
                'instructions' => 'Kies een knop-stijl',
                'required' => true,
                'choices' => [
                    'orange-pill' => 'Blauw',
                    'text-with-arrow-before' => 'Tekstlink met pijltje ervoor',
                ],
            ],
            [
                'key' => 'bsbtn_link',
                'label' => 'Link',
                'name' => 'link',
                'type' => 'link',
                'instructions' => 'Kies waar de knop naartoe navigeert',
                'required' => true,
                'return_format' => 'array',
            ],
            [
                'key' => 'bsbtn_align',
                'label' => 'Uitlijning',
                'name' => 'align',
                'type' => 'select',
                'instructions' => 'Kies een uitlijning',
                'required' => true,
                'choices' => [
                    'text-start' => 'Links',
                    'text-center' => 'Midden',
                    'text-end' => 'Rechts',
                ],
            ],
            [
                'key' => 'bsbtn_inline',
                'label' => 'Inline',
                'name' => 'inline',
                'type' => 'true_false',
                'instructions' => 'Gebruik deze knop \'inline\'',
                'required' => 1,
                'default_value' => 0,
                'ui' => 1,
                'ui_on_text' => 'inline',
                'ui_off_text' => 'block',
            ],
        ],
        'location' => [
            [
                [
                    'param' => 'block',
                    'operator' => '==',
                    'value' => 'eye/bsbutton',
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