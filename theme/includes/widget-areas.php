<?php
function eye_widgets_init() {

//    register_sidebar( array(
//        'name'          => 'Footer - Voorbeeld',
//        'id'            => 'footer-example',
//        'before_widget' => '<div class="footer-example>',
//        'after_widget'  => '</div>',
//        'before_title'  => '<h2>',
//        'after_title'   => '</h2>',
//    ) );

}

add_action( 'widgets_init', 'eye_widgets_init' );