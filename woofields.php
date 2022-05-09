<?php
/*
Plugin name: WooFields
*/
function abelo_scripts_include() {
    if ( ! did_action( 'wp_enqueue_media' ) ) {
        wp_enqueue_media();
    }
    wp_enqueue_script( 'abelouploadscript', plugin_dir_url(__FILE__) . '/js/upload_img.js', array('jquery'), null, false );
    wp_enqueue_script('media-upload');  
    wp_enqueue_script('thickbox');  
}
add_action( 'admin_enqueue_scripts', 'abelo_scripts_include' );

require_once('img_field.php');
require_once('request_ajax.php');
require_once('custom_fields.php');


?>