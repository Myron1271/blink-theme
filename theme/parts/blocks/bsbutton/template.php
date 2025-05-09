<?php

$link = get_field('link');
$type = get_field('type') ?: 'link';
$align = get_field('align') ?: 'text-start';
$inline = get_field('inline') ?: false;

$class = match ($type) {
    'primary' => 'btn-primary',
    default => 'btn-link',
};

?>

<div class="eye-block bsbutton <?= $align ?> <?= getBlockClasses($block) ?>" <?= ($inline ? 'style="display: inline-block;"' : '') ?>>
    <?php if (!empty($link)): ?>
        <a class="btn <?= $class ?>" href="<?= $link['url'] ?>" target="<?= $link['target'] ?>"><?= $link['title'] ?></a>
    <?php endif; ?>
</div>