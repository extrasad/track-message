<?php
 /**
 * @package Track Message
 */
/*
Plugin Name: Track Message
Description: WP plugin for a customizable track message.
Version: 1.0

*/
// Security check
if ( ! function_exists( 'add_action' ) ) {
    echo 'You don\'t have permission to access this file.';
    die;
  }
  
// Requiring files 
require 'settings_page.php';
require 'show_message.php'; 

// Checking if is adming
if(is_admin()){
    new SettingsPage;
}
// Checking if is user first time
if( !isset( $_COOKIE["UserFirstTime"])){
        new TrackMessage();
    }
        