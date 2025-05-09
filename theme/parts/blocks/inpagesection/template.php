<?php

$title = get_field('name') ?: '';
$section_slug = getMenuSectionSlug($title);

?>

<div id="<?= $section_slug ?>-section" class="eye-block menu-section" title="<?= $section_slug ?>" data-section-name="<?= $title ?>"></div>
