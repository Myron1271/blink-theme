= 2.1.1 *(28-11-2023)* =

* Blocks.php now registers all block-related js scripts, so they can be enqueued using 'viewScript' in the block.json file. (/emptyspace/script.js becomes emptyspace-script handle)

= 2.1.0 *(28-6-2023)* =

* Bootstrap update to 5.3.0

= 2.0.1 =

* Changed parameter $deps from wp_enqueue_style() to 'site' instead of screen

= 2.0.0 =

* Updated Bootstrap on Wordpress
* Updated Bootstrap to 5.2
* Added bg and color utility classes
* Added IntersectionObserver for easy in-view detection using css classes

= 1.4.0 =

* added Password Protected eyetractive styling

= 1.3.1 =

* only add scrollspy tags on body if inpagenav is present on page

= 1.3.0 =

* added debug() utility function
* fixed Sass 'Slash as Division' deprecation warning

= 1.2.3 =

* Updated Bootstrap to 5.1.3

= 1.2.2 =

* changed .alignfull class, doesn't use JS anymore which improves pagespeed results
* added wp_get_theme version to enqueue_style of default blocks

= 1.2.1 =

* fixed use of $block[\'className\']

= 1.2.0 =

* added utility function getNavItems. (Usefull for building slinky menu's)

= 1.1.1 =

* added alignment option to bsbutton
* fixed unknown variable error in emptyspace block

= 1.1.0 =

* added bootstrap scrollspy to body for inpage navigation
* added \<main\> to page, single and 404
* added return to home button to 404 page

= 1.0.0 =

* initial release