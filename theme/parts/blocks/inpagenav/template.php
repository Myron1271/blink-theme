<?php

global $post;
$sections = getMenuSections($post->ID);

?>

<div class="eye-block onpagenav <?= getBlockClasses($block) ?>">
    <div class="container p-sm-0">
        <nav id="onpage-nav" class="navbar navbar-expand text-center" aria-label="Inhoudsopgave">
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="nav navbar-nav">
                    <?php foreach ($sections as $item): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="#<?= $item['url']?>-section"><?= $item['title']?></a>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
            <div class="dropdown" style="visibility: hidden;">
                <a class="dropdown-toggle btn btn-primary" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                </div>
            </div>
        </nav>
    </div>
</div>