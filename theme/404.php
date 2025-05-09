<?php
/**
 * The template for displaying 404 pages (Not Found)
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
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

    <div class="text-center">
        <h2 class="mb-5"><?php echo __('Page not found', 'wp_babobski'); ?></h2>

        <a href="<?= site_url() ?>" class="btn btn-primary">Terug naar homepagina</a>
    </div>

</main>

<?php
$BsWp->get_template_parts([
    'parts/shared/footer',
    'parts/shared/html-footer'
]);
?>
