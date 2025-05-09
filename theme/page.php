<?php
/**
 * The template for displaying all pages.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * Please see /external/bootsrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package    WordPress
 * @subpackage    Bootstrap 5.2.0
 * @autor        Babobski
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
    'parts/shared/html-header',
    'parts/shared/header'
]);
?>

<main class="content container">
    <?php the_content(); ?>
</main>

<?php
$BsWp->get_template_parts([
    'parts/shared/footer',
    'parts/shared/html-footer'
]);
?>
