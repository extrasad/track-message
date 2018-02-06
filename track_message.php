<?php
 /**
 * @package Track Message
 */
/*
Plugin Name: Track Message
Description: WP plugin for a customizable track message.
Version: 1.0

*/

// Security control to check that wordpress is running the script

if ( ! function_exists( 'add_action' ) ) {
	echo 'You don\'t have permission to access this file.';
	die;
}
add_action( 'wp_enqueue_scripts', 'my_scripts' );

function my_scripts(){
    $url_plugin_js  =   plugins_url('track-message/js/');
    $url_plugin_css  =   plugins_url('track-message/css/');

    wp_register_script('tm_js', $url_plugin_js . 'track_message.js');   
    wp_register_style( 'tm_css', $url_plugin_css . 'track_message.css');
    wp_enqueue_style('tm_css');
    wp_enqueue_script('tm_js');

}


class TrackMessage{

    public static function show_message(){
        $message = 'Estás siendo rastreado si estás de acuerdo con esto prosigue';
        echo "<div id='modal' class='track-message text-center backdrop ModalOpen'>
        <div class='container'>
        <span onclick='closeModal;' class='close'>&times;</span>
          <h2 class='text-danger'>WARNING!</h2>
          <img src='http://res.cloudinary.com/abdiangel/image/upload/c_scale,w_305/v1517783515/12414868-stop-sign-illustration_ypc4rm.jpg' class='img-fluid'>
          <p class='lead'>$message</p>
        </div>
      </div>";
    }
}

add_action('wp_head', array('TrackMessage', 'show_message'));


