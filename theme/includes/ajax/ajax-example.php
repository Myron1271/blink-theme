<?php

function eye_example() {

    $post_variable = $_POST['variable'];

    ob_start();

    ?>

    <!--Do something-->

    <?php

    $html = ob_get_contents();
    ob_end_clean();

    echo json_encode([
        'success' => true,
        'content' => $html
    ]);

    wp_die();
}

add_action('wp_ajax_example', 'eye_example' );
add_action('wp_ajax_nopriv_example', 'eye_example' );