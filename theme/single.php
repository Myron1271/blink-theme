<?php
/**
 * The Template for displaying all single posts
 *
 * Please see /external/bootstrap-utilities.php for info on BsWp::get_template_parts()
 *
 * @package 	WordPress
 * @subpackage 	Bootstrap 5.2.0
 * @autor 		Babobski
 */
$BsWp = new BsWp;

$BsWp->get_template_parts([
	'parts/shared/html-header', 
	'parts/shared/header'
]);
?>

<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

    <main class="content container">

        <h2><?php the_title(); ?></h2>

        <time datetime="<?php the_time( 'Y-m-d' ); ?>" pubdate>
            <?php the_date(); ?> <?php the_time(); ?>
        </time>

        <?php the_content(); ?>

    </main>

<?php endwhile; ?>

<?php 
$BsWp->get_template_parts([
	'parts/shared/footer',
	'parts/shared/html-footer'
]);
?>
