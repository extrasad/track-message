<?php
 /**
 * @package Track Message
 */
/*
This file is used to uninstall Track Message plugin
and delete all the plugin's options in database
Version: 1.0

*/

// If uninstall is not called from WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' )) {

	status_header( 404, 'You don\'t have permission to access this page.' );
	die;
}

delete_option( 'color_options' );
delete_option( 'background_color_options' );
delete_option( 'message_field' );
delete_option( 'position_options' );
delete_option( 'cookie_time_settings' );
delete_option( 'message_time_settings' );
delete_option( 'btn_color_options' );
delete_option( 'background_btn_color_options' ); 