<?php

const BOOTSTRAP_VERSION = '5.3.0';

/* ========================================================================================================================

01. Add language support to theme

======================================================================================================================== */

add_action('after_setup_theme', 'my_theme_setup');

function my_theme_setup()
{
    load_theme_textdomain('wp_babobski', get_template_directory() . '/language');
}

/* ========================================================================================================================

02. Required external files

======================================================================================================================== */

require_once('external/bootstrap-utilities.php');
require_once('external/bs5navwalker.php');

/* ========================================================================================================================

03. Add html 5 support to wordpress elements

======================================================================================================================== */

add_theme_support('html5', [
    'comment-list',
    'search-form',
    'comment-form',
    'gallery',
    'caption',
]);

/* ========================================================================================================================

04. Theme specific settings

======================================================================================================================== */

add_theme_support('post-thumbnails');

//add_image_size( 'name', width, height, crop true|false );

/* ========================================================================================================================

05. Actions and Filters

======================================================================================================================== */

add_action('wp_enqueue_scripts', 'bootstrap_script_init');

$BsWp = new BsWp;
add_filter('body_class', [$BsWp, 'add_slug_to_body_class']);


/* ========================================================================================================================

06. Scripts

======================================================================================================================== */

/**
 * Add scripts via wp_head()
 *
 * @return void
 * @author Keir Whitaker
 */
if (!function_exists('bootstrap_script_init')) {
    function bootstrap_script_init()
    {

        // Get theme version number (located in style.css)
        $theme = wp_get_theme();

        wp_enqueue_script('bootstrap', get_template_directory_uri() . '/js/bootstrap.bundle.min.js', ['jquery'], BOOTSTRAP_VERSION, true);
        wp_enqueue_script('site', get_template_directory_uri() . '/js/site.js', ['jquery', 'bootstrap'], $theme->get('Version'), true);

        wp_enqueue_style('site', get_template_directory_uri() . '/css/site.css', [], $theme->get('Version'), 'all');
    }
}

/* ========================================================================================================================

07. Security & cleanup wp admin

======================================================================================================================== */

//remove wp version
function theme_remove_version()
{
    return '';
}

add_filter('the_generator', 'theme_remove_version');

//remove default footer text
function remove_footer_admin()
{
    echo "";
}

add_filter('admin_footer_text', 'remove_footer_admin');

//remove wordpress logo from adminbar
function wp_logo_admin_bar_remove()
{
    global $wp_admin_bar;

    /* Remove their stuff */
    $wp_admin_bar->remove_menu('wp-logo');
}

add_action('wp_before_admin_bar_render', 'wp_logo_admin_bar_remove', 0);

// Remove default Dashboard widgets
if (!function_exists('disable_default_dashboard_widgets')) {
    function disable_default_dashboard_widgets()
    {

        //remove_meta_box('dashboard_right_now', 'dashboard', 'core');
        remove_meta_box('dashboard_activity', 'dashboard', 'core');
        remove_meta_box('dashboard_recent_comments', 'dashboard', 'core');
        remove_meta_box('dashboard_incoming_links', 'dashboard', 'core');
        remove_meta_box('dashboard_plugins', 'dashboard', 'core');

        remove_meta_box('dashboard_quick_press', 'dashboard', 'core');
        remove_meta_box('dashboard_recent_drafts', 'dashboard', 'core');
        remove_meta_box('dashboard_primary', 'dashboard', 'core');
        remove_meta_box('dashboard_secondary', 'dashboard', 'core');
    }
}
add_action('admin_menu', 'disable_default_dashboard_widgets');

remove_action('welcome_panel', 'wp_welcome_panel');

// Disable the emoji's
if (!function_exists('disable_emojis')) {
    function disable_emojis()
    {
        remove_action('wp_head', 'print_emoji_detection_script', 7);
        remove_action('admin_print_scripts', 'print_emoji_detection_script');
        remove_action('wp_print_styles', 'print_emoji_styles');
        remove_action('admin_print_styles', 'print_emoji_styles');
        remove_filter('the_content_feed', 'wp_staticize_emoji');
        remove_filter('comment_text_rss', 'wp_staticize_emoji');
        remove_filter('wp_mail', 'wp_staticize_emoji_for_email');

        // Remove from TinyMCE
        add_filter('tiny_mce_plugins', 'disable_emojis_tinymce');
    }
}
add_action('init', 'disable_emojis');

// Filter out the tinymce emoji plugin.
function disable_emojis_tinymce($plugins)
{
    if (is_array($plugins)) {
        return array_diff($plugins, ['wpemoji']);
    } else {
        return [];
    }
}

/* ========================================================================================================================

08. Comments

======================================================================================================================== */

/**
 * Custom callback for outputting comments
 *
 * @return void
 * @author Keir Whitaker
 */
if (!function_exists('bootstrap_comment')) {
    function bootstrap_comment($comment, $args, $depth)
    {
        $GLOBALS['comment'] = $comment;
        ?>
        <?php if ($comment->comment_approved == '1'): ?>
        <li class="row">
        <div class="col-4 col-md-2">
            <?php echo get_avatar($comment); ?>
        </div>
        <div class="col-8 col-md-10">
            <h4><?php comment_author_link() ?></h4>
            <time>
                <a href="#comment-<?php comment_ID() ?>" pubdate><?php comment_date() ?> at <?php comment_time() ?></a>
            </time>
            <?php comment_text() ?>
        </div>
    <?php endif;
    }
}

/* ========================================================================================================================

9. Eyetractive

======================================================================================================================== */

add_theme_support('align-wide');

//    include(get_stylesheet_directory().'/includes/cpt/cpt-example.php');

include(get_stylesheet_directory() . '/includes/widget-areas.php');
include(get_stylesheet_directory() . '/includes/utilities.php');

include(get_stylesheet_directory() . '/parts/blocks/blocks.php');