<?php

$height = get_field('size') ?: 'small';
$custom = get_field('custom_size') ?: '16px';
$add = '';

$class = match ($height) {
    'small' => 'pt-md-3 pb-md-3 pt-2 pb-2',
    'medium' => 'pt-md-4 pb-md-4 pt-3 pb-3',
    'large' => 'pt-md-5 pb-md-5 pt-4 pb-4',
    'custom' => '',
};

if ($height === 'custom') {
    $add = 'style="height: ' . $custom . '"';
}

?>

<div class="eye-block empty-space empty-space--<?= $height ?> <?= $class ?>" <?= $add ?>></div>