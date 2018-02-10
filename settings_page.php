<?php
class settings_page{
    
    private static $instance = null;
    
    public $options;
    
    public static function get_instance() {
  
        if ( null == self::$instance ) {
            self::$instance = new self;
        }
  
        return self::$instance;
  
    }    

    public function __construct(){
        // Add the options page and menu item
        add_action( 'admin_menu', array( $this, 'tmssg_plugin_menu' ));
        
        // Adds all of the options for the administrative settings
        add_action( 'admin_init', array( $this, 'tmssg_options_init' ));

        // Color Picker
        wp_enqueue_style( 'wp-color-picker' );

        // Register javascript
        add_action('admin_enqueue_scripts', array( $this, 'enqueue_admin_js' ) );

        // Get registered option
        $this->options = get_option( 'tmssg_settings_options' );
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
    public function tmssg_options_init() { 
     
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
     
    //Function that will add javascript file for Color Piker.
    public function enqueue_admin_js() { 
     
    // Add the wp-color-picker dependecy to js file
    wp_enqueue_script( 'tmssg_custom_js', plugins_url( 'jquery.custom.js', __FILE__ ), array( 'jquery', 'wp-color-picker' ), '', true  );
    }
}   
