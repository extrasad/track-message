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

class TrackMessage{
    private $options;
    
    public function __construct(){
        add_action( 'wp_enqueue_scripts', array( $this, 'myScripts'));
        add_action('plugins_loaded', array($this,'multilanguage'));
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu'));
        add_action( 'admin_init', array( $this, 'mssgSections'));
        add_action( 'admin_init', array( $this, 'mssgFields'));
        add_action('admin_init', array($this, 'registerSettings'));
        add_action( 'admin_init', array( $this, 'settingsInit' ) );


        if( !isset( $_COOKIE["UserFirstTime"])){
            add_action('wp_head', array( $this, 'tmssgShowMessage'));
        } 
  
    }
  
    public function myScripts(){
        $url_plugin_js  =   plugins_url('track-message/js/');
        $url_plugin_css  =   plugins_url('track-message/css/');
      
        wp_register_script('tmssg_js', $url_plugin_js . 'track_message.js');   
        wp_register_style( 'tmssg_css', $url_plugin_css . 'track_message.css');
        wp_enqueue_style('tmssg_css');
        wp_enqueue_script('tmssg_js');
        
        wp_enqueue_style( 'wp-color-picker' );
        wp_enqueue_script( 'wp-color-picker' );
        
        //Load our custom Javascript file
        wp_enqueue_script( 'track_message', plugin_dir_url(__FILE__) . 'js/settings.js' );
      
    }
  
    public function multilanguage() {  
		load_plugin_textdomain( 'track-message', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );  
        }

    // Custom Message Section
    public function tmssgPluginMenu() {
        $settings = add_submenu_page(   'options-general.php', 
                        __('Track Message Settings', 'track-message'), 
                        __('Track Message', 'track-message'),
                            'manage_options', 
                            'track_message', 
                            array( $this, 'tmssgPluginContent'));
        add_action( 'load-' . $settings, array($this, 'myScripts' ));

    }
    
    public function tmssgPluginContent() {
            ?>
        <div class="wrap">
        <h2><?php _e('Track Message', 'track-message'); ?></h2>
        <form method="post" action="options.php">
            <?php
                settings_fields('track_message');
                do_settings_sections('track_message');
                submit_button();
            ?>
        </form>
        </div>
        <?php
        }
    

    public function settingsInit(){
        register_setting(
            'track_message',
            'color_options',
            array( $this, 'validateOptions' )
        );
          
        add_settings_section(
            'wp-color-picker-section',
            __( 'Choose Your Color' ),
            array( $this, 'optionsSettingsText' ),
            'track_message'
        );
          
        add_settings_field(
            'color',
            __( 'Color' ),
            array( $this, 'colorInput' ),
            'track_message',
            'wp-color-picker-section'
        );

        register_setting(
            'track_message',
            'background_color_options',
            array( $this, 'validateBackgroundOptions' )
        );
          
        add_settings_section(
            'wp-color-picker-section',
            __( 'Choose Your Color' ),
            array( $this, 'optionsSettingsText' ),
            'track_message'
        );
          
        add_settings_field(
            'background_color',
            __( 'Background Color' ),
            array( $this, 'backgroundColorInput' ),
            'track_message',
            'wp-color-picker-section'
        );

        
    }
    
    public function mssgSections() {
        add_settings_section( 'message_section', __('¡Agregue un mensaje para avisar a sus visitantes!','track-message'), false, 'track_message' );
    }
    
    public function mssgFields() {
        add_settings_field( 'message_field', __('Escriba el mensaje', 'track-message'), array( $this, 'mssgFieldCallback' ), 'track_message', 'message_section' );
    }
    
    public function mssgFieldCallback() {
        $message = esc_html(get_option('message_field'));
        $html = sprintf('<textarea name="message_field" id="message_filed" placeholder="%s"', $message);
        $html.= ('type="text"></textarea>');
        echo $html;
    }
    public function registerSettings(){
        register_setting( 'track_message', 'message_field' );
        register_setting('track_message', 'show_mssg_field');
    }
    
    public function optionsSettingsText(){
        echo '<p>' . __( 'Use the color picker below to choose your color.' ) . '</p>';
      }
      
      /**
       * Display our color field as a text input field.
       */
    public function colorInput(){
        $options = get_option( 'color_options' );
        $color = ( $options['color'] != "" ) ? sanitize_text_field( $options['color'] ) : '#3D9B0C';
        
        
        $html = sprintf('<input class="color" name="color_options[color]" type="text" value="'. $color .'" />');
        echo $html;
    }

    public function validateOptions( $input ){
        $valid = array();
        $valid['color'] = sanitize_text_field( $input['color'] );
        
        return $valid;
    }

    public function backgroundColorInput(){
        $options = get_option( 'background_color_options' );
        $color = ( $options['background_color'] != "" ) ? sanitize_text_field( $options['background_color'] ) : '#3D9B0C';
        
        
        $html = sprintf('<input class="color" name="background_color_options[background_color]" type="text" value="'. $color .'" />');
        echo $html;
    }

    public function validateBackgroundOptions( $input ){
        $valid = array();
        $valid['background_color'] = sanitize_text_field( $input['background_color'] );
        
        return $valid;
    }


    public static function tmssgShowMessage(){
        $color = get_option('color_options');
        $color_applied = $color['color'];
        $background_color = get_option('background_color_options');
        $background_color_applied = $background_color['background_color'];
        $message = esc_html(get_option('message_field'));
        $accept = __('Accept', 'track-message');
        $html= sprintf('<div style="color : %s; background-color: %s;" id="TrackMessageCookieNotification_Id--3455" class="TrackMessageNotification TrackMessageNotification__content--opennotification">', $color_applied, $background_color_applied);
        $html.= sprintf('<p>%s</p>', $message);
        $html.= sprintf('<span id="TrackMessageCookieNotification_Id--close-5644" class="TrackMessageCookieNotification__inline--btn">%s</span>', $accept );
        $html.= sprintf('</div>');
        echo $html;
    }
}
  
new TrackMessage();
  