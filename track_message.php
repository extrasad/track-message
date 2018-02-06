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

require 'settings_page.php';

if (is_admin()) {
    new settings_page();
  }

//CSS & JS
add_action( 'wp_enqueue_scripts', 'my_scripts' );


function my_scripts(){
    $url_plugin_js  =   plugins_url('track-message/js/');
    $url_plugin_css  =   plugins_url('track-message/css/');

    wp_register_script('tmssg_js', $url_plugin_js . 'track_message.js');   
    wp_register_style( 'tmssg_css', $url_plugin_css . 'track_message.css');
    wp_register_style('prefix_bootstrap','//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css');
    wp_enqueue_style('tmssg_css');
    wp_enqueue_script('tmssg_js');
    wp_enqueue_style('prefix_bootstrap');
}


class TrackMessage{
    public static function tmssg_show_message(){
        $message = 'Estás siendo rastreado si estás de acuerdo con esto prosigue';
        echo "<div class='track-message text-center backdrop ModalOpen' id='modal'>
        <div class='container'>
          <h2 class='text-danger'>WARNING!</h2>
          <img src='http://res.cloudinary.com/abdiangel/image/upload/c_scale,w_305/v1517783515/12414868-stop-sign-illustration_ypc4rm.jpg' class='img-fluid'>
          <p class='lead'>$message</p>
          <button type='button' class='button' id='close'> Estoy de acuerdo con esto</button>
        </div>
      </div>>";
    }

}

add_action('wp_head', array('TrackMessage', 'tmssg_show_message'));

