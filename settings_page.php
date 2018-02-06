<?php
class settings_page{    

    public function __construct(){
        // Add the options page and menu item
        add_action( 'admin_menu', array( $this, 'tmssg_plugin_menu' ));
        
        // Adds all of the options for the administrative settings
        //add_action( 'admin_init', array( $this, 'plugin_options_init' ));
    }

    public function tmssg_plugin_menu() {
        add_options_page(
            'Track Message Options',
            'Track Message',
            'administrator',
            basename(__FILE__),
            array( $this, 'tmssg_plugin_settings')
        );
    }

    public function tmssg_plugin_settings() {
        if ( !current_user_can( 'administrator' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }
        echo '<div class="wrap">';
        echo '<p>Here is where the form would go if I actually had options.</p>';
        echo '</div>';
    }
}   
?>