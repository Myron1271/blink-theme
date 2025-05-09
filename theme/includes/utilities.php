<?php

function getSiteSlug()
{
    return sanitize_title(get_bloginfo('name'), 'unknown', 'save');
}

function getMenuSectionSlug($title)
{
    return sanitize_title(sanitize_title($title, '', 'save'), '', 'query');
}

function getBlockClasses($block)
{
    // Create class attribute allowing for custom "className" and "align" values.
    $classes = '';

    if (!empty($block['className'])) {
        $classes .= sprintf(' %s', $block['className']);
    }

    if (!empty($block['align'])) {
        $classes .= sprintf(' align%s', $block['align']);
    }

    return $classes;
}

function recursiveGetMenuSections($blocks, $menu_sections = [])
{
    foreach ($blocks as $block) {
        if ($block['blockName'] == 'eye/inpagesection') {
            $menu_sections[] = ['title' => $block['attrs']['data']['name'], 'url' => getMenuSectionSlug($block['attrs']['data']['name'])];
        } else if (!empty($block['innerBlocks'])) {
            $menu_sections = recursiveGetMenuSections($block['innerBlocks'], $menu_sections);
        }
    }

    return $menu_sections;
}

function getMenuSections($post_id, $content = null)
{
    $content = $content ?: get_the_content(null, false, $post_id);

    $block_data = parse_blocks($content);

    return recursiveGetMenuSections($block_data);
}

function getSubPages($menu_item_id)
{
    $main_menu_items = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['primary'], 'nav_menu'));
    $child_menu_items = [];

    foreach ($main_menu_items as $main_menu_item) {
        if ($main_menu_item->menu_item_parent == $menu_item_id) {
            $child_menu_items[] = ['title' => $main_menu_item->title, 'url' => $main_menu_item->url];
        }
    }

    return $child_menu_items;
}

function getNavItems()
{
    // Haal alle menuitems op
    $main_menu_items = wp_get_nav_menu_items(get_term(get_nav_menu_locations()['primary'], 'nav_menu'));
    $menu_items = [];

    foreach ($main_menu_items as $main_menu_item) {
        // Alleen hoofditems uit het menu, negeer subitems
        if (!$main_menu_item->menu_item_parent) {

            $child_items = [];
            $child_items['subpages'] = getSubPages($main_menu_item->ID);

            $menu_items[] = ['url' => $main_menu_item->url, 'id' => $main_menu_item->object_id, 'title' => $main_menu_item->title, 'child_items' => $child_items];
        }
    }

    return $menu_items;
}

function debug($data)
{
    echo '<pre>';
    print_r($data ?? 'NULL');
    echo '</pre>';
}