<?php

$color = get_field('color');
$custom_color = get_field('custom_color');

switch ($color) {

    case 'blue':
    default:
        $class = 'bg--blue';
        break;

    case 'lightblue':
        $class = 'bg--lightblue';
        break;

    case 'darkblue':
        $class = 'bg--darkblue';
        break;

    case 'red':
        $class = 'bg--red';
        break;

    case 'custom':
        $class = '';
        break;
}

?>




<div class="eye-block fullwidth-row alignfull <?= getBlockClasses($block) ?> <?= $class ?>" <?= ($color == 'custom' ? 'style="background-color: '. $custom_color . '"' : '')?>>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <InnerBlocks />
            </div>
        </div>
    </div>

</div>
