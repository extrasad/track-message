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

class TrackMessage{

    function activate(){

    }
    function deactivate(){

    }
    function uninstall(){

    }
}

if (class_exists('TrackMessage') ){
    $trackMessage = new TrackMessage();
}

// Activation
register_activation_hook( __FILE__, array( $trackMessage, 'activate' ) );

// Deactivate 
register_deactivation_hook( __FILE__, array( $trackMessage, 'deactivate' ) );

// Uninstall
