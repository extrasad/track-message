<?php
class SettingsPage{

    function myScripts(){
        $url_plugin_js  =   plugins_url('track-message/js/');
        wp_register_script('tmssg_color_js', $url_plugin_js . 'jquery.custom.js'. array( 'jquery', 'wp-color-picker' ), '', true  );   
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script('tmssg_color_js');
    
    }

    // Construct
    public function __construct(){
        // Add the options page and menu item
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu' ));
        add_action( 'admin_init', array( $this, 'mssgSections' ) );
        add_action( 'admin_init', array( $this, 'mssgFields' ) );
        add_action('admin_init', array($this, 'registerSettings' ));
        add_action( 'wp_enqueue_scripts', 'myScripts' );
        // Add the options page and menu item
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu' ));
        
        // Adds all of the options for the administrative settings
        add_action( 'admin_init', array( $this, 'tmssgOptionsInit' ));
        
        // Get registered option
        $this->options = get_option( 'tmssg_settings_options' );

    }

    // Custom Message Section
    public function tmssgPluginMenu() {
        add_submenu_page(   'options-general.php', 
                            'Track Message Settings', 
                            'Track Message', 
                            'manage_options', 
                            'track_message', 
                            array( $this, 'tmssgPluginContent'));
    }

    public function tmssgPluginContent() {
            ?>
        <div class="wrap">
        <h2>Track Message</h2>
        <form method="post" action="options.php">
            <?php
                settings_fields('track_message');
                do_settings_sections('track_message');
                submit_button();
            ?>
        </form>
        </div> <?php
        }

    public function mssgSections() {
        add_settings_section( 'message_section', '¡Agregue un mensaje para avisar a sus visitantes!', false, 'track_message' );
    }

    public function mssgFields() {
        add_settings_field( 'message_field', 'Escriba el mensaje', array( $this, 'mssgFieldCallback' ), 'track_message', 'message_section' );
        add_settings_field( 'show_mssg_field', 'Mensaje actual', array( $this, 'showMssgFieldCallback' ), 'track_message', 'message_section' );
    }

    public function mssgFieldCallback($args) {
        $html = sprintf('<input name="message_field" id="message_filed)');
        $html.= sprintf('type="text"/>');
        echo $html;
    }
    public function showMssgFieldCallback($args){
        $html = sprintf('<div style ="width:500px;height:100px;border:1px solid #000;">');
        $html.= sprintf('<p>' . get_option( 'message_field' ) . '</p>');
        $html.= sprintf('</div>');
        echo $html;
    }
    public function registerSettings(){
        register_setting( 'track_message', 'message_field' );
        register_setting('track_message', 'show_mssg_field');
    }

    // Color Picker Section
    private static $instance = null;
    
    public $options;
    
    public static function getIntance() {
  
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
  
        return self::$instance;
  
    }    

    public function tmssgPlugin() {
        add_options_page(
            'Track Message Options',
            'Track Message',
            'administrator',
            basename(__FILE__),
            array( $this, 'tmssgPluginSettings')
        );
    }

    public function tmssgPluginSettings() {
        if ( !current_user_can( 'administrator' ) )  {
            wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
        }?>
        <div class="wrap">
     
        <h2>Track Message</h2>
        <form method="post" action="options.php">     
        <?php 
            settings_fields(__FILE__);      
            do_settings_sections(__FILE__);
            submit_button();
        ?>
        </form>
    </div> <!-- /wrap -->
    <?php  
    }
    public function tmssgOptionsInit() { 
     
        // Add Section for option fields
        add_settings_section( 'tmssg_section', 'Track Message Options', array( $this, 'displaySection' ), __FILE__ ); // id, title, display cb, page
         
        // Add Title Field
        add_settings_field( 'tmssg_title_field', 'Track Message Title', array( $this, 'titleSettingsField' ), __FILE__, 'tmssg_section' ); // id, title, display cb, page, section
         
        // Add Background Color Field
        add_settings_field( 'tmssg_bg_field', 'Background Color', array( $this, 'bgSettingsField' ), __FILE__, 'tmssg_section' ); // id, title, display cb, page, section
         
        // Register Settings
        register_setting( __FILE__, 'tmssg_settings_options', array( $this, 'validateOptions' ) ); // option group, option name, sanitize cb 
    }

    // Functions that display fields in settings page
    public function titleSettingsField() { 
     
        $val = ( isset( $this->options['title'] ) ) ? $this->options['title'] : '';
        echo '<input type="text" name="tmssg_settings_options[title]" value="' . $val . '" />';
    }   
     
    public function bgSettingsField() { 
         
        $val = ( isset( $this->options['title'] ) ) ? $this->options['background'] : '';
        echo '<input type="text" name="tmssg_settings_options[background]" value="' . $val . '" class="tmssg-color-picker" >';
         
    }

    
    // Function that will validate all fields.

    public function validateOptions( $fields ) { 
     
    $valid_fields = array();
     
    // Validate Title Field
    $title = trim( $fields['title'] );
    $valid_fields['title'] = strip_tags( stripslashes( $title ) );
     
    // Validate Background Color
    $background = trim( $fields['background'] );
    $background = strip_tags( stripslashes( $background ) );
     
    // Check if is a valid hex color
    if( FALSE === $this->checkColor( $background ) ) {
     
        // Set the error message
        add_settings_error( 'tmssg_settings_options', 'tmssg_bg_error', 'Insert a valid color for Background', 'error' ); // $setting, $code, $message, $type
         
        // Get the previous valid value
        $valid_fields['background'] = $this->options['background'];
     
    } else {
     
        $valid_fields['background'] = $background;  
     
    }
     
    return apply_filters( 'validateOptions', $valid_fields, $fields);
}
 

    // Function that will check if value is a valid HEX color.
    public function checkColor( $value ) { 
     
    if ( preg_match( '/^#[a-f0-9]{6}$/i', $value ) ) { // If the user insert a HEX color with #     
        return true;
    }
     
    return false;
    }

    public function displaySection() { /* Leave blank */ } 
     

}   
