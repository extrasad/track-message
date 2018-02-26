<?php
 /** 
  *@package Track Message
 */
/*
Plugin Name: Track Message
Description: Track Message allows you to inform users with a customizable and elegant message that your site uses cookies to track them.
Version: 1.0
Text Domain: track-message

*/
// Security check
if ( ! function_exists( 'add_action' ) ) {
    echo 'You don\'t have permission to access this file.';
    die;
  }

class TrackMessage{

    private $message;

    
    public function __construct(){

        $plugin = plugin_basename( __FILE__ );
        $options = (get_option('message_field'));
        $this->message = ( $options != "" ) ? sanitize_text_field($options) : __('We use cookies in our site to add custom functions. Continuing browsing accepts our cookies policy', 'track-message');

        add_action( 'wp_enqueue_scripts', array( $this, 'myScripts'));
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu'));
        add_action( 'admin_init', array( $this, 'settingsInit' ) );
        add_filter( "plugin_action_links_$plugin", array($this, 'customSettingsLink' ));



        if( !isset( $_COOKIE["UserFirstTime"])){
            add_action('wp_head', array( $this, 'tmssgShowMessage'));
        } 
  
    }

    public function customSettingsLink($links) {
        $link = esc_url(admin_url('/options-general.php?page=track_message')); 
        $settings_link = sprintf('<a href="%s">' . __( 'Settings', 'track-message' ) . '</a>', $link);
        array_push($links, $settings_link);
          return $links;
    }

    public function myScripts(){
        $url_plugin_js  =   plugins_url('track-message/js/');
        $url_plugin_css  =   plugins_url('track-message/css/');
      
        
        if (is_admin()){
            wp_register_script('tmssg_custom_js', $url_plugin_js . 'settings.js');
            wp_enqueue_style( 'wp-color-picker' );
            wp_enqueue_script( 'wp-color-picker' );
            wp_enqueue_script('tmssg_custom_js');    
        }    
        if ( !isset($_COOKIE['UserFirstTime']) && (!is_admin())){
            wp_register_script('tmssg_js', $url_plugin_js . 'track_message.js');
            wp_register_style( 'tmssg_css', $url_plugin_css . 'track_message.css');
            wp_enqueue_style('tmssg_css');
            wp_enqueue_script('tmssg_js');
        }
    }
  

    // Custom Message Section
    public function tmssgPluginMenu() {
        $settings = add_submenu_page(   'options-general.php', 
                        __('Options', 'track-message'), 
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
        //Text message
        register_setting( 'track_message', 'message_field');
        
        add_settings_field( 'message_field', __('Write the message', 'track-message'), array( $this, 'mssgFieldCallback' ), 'track_message', 'message_section' );

        add_settings_section( 'message_section', __('¡Add a message to notify your visitors!','track-message'), false, 'track_message' );

        //Message Time
        register_setting( 'track_message', 'message_time');
        
        add_settings_field( 'message_time', __('Set message duration on front-page', 'track-message'), array( $this, 'mssgTimeCallback' ), 'track_message', 'message_time' );

        add_settings_section( 'message_time', __('','track-message'), false, 'track_message' );
        //Cookie Time
        register_setting( 'track_message', 'cookie_time');
        
        add_settings_field( 'cookie_time', __('Set cookie time', 'track-message'), array( $this, 'cookieTimeCallback' ), 'track_message', 'cookie_time' );

        add_settings_section( 'cookie_time', __('Cookie settings','track-message'), false, 'track_message' );

        //Position - Design
        register_setting('track_message', 'position_options');

        add_settings_field('positions', __('Where do you want your message to show up?', 'track-message'), array( $this,'positionOptionsCallback'), 'track_message', 'position_section');

        add_settings_section('position_section', __('Message Position','track-message'), false, 'track_message');
        
        //Color Picker - Design
        register_setting(
            'track_message',
            'color_options',
            array( $this, 'validateOptions' )
        );
          
        add_settings_section(
            'wp-color-picker-section',
            __( 'Choose Your Color', 'track-message' ),
            array( $this, 'optionsSettingsText' ),
            'track_message'
        );
          
        add_settings_field(
            'color',
            __( 'Text color', 'track-message'  ),
            array( $this, 'colorInput' ),
            'track_message',
            'wp-color-picker-section'
        );

        register_setting(
            'track_message',
            'background_color_options',
            array( $this, 'validateBackgroundOptions' )
        );
          
        add_settings_field(
            'background_color',
            __( 'Background Color', 'track-message'  ),
            array( $this, 'backgroundColorInput' ),
            'track_message',
            'wp-color-picker-section'
        );

        
    }
    
    public function cookieTimeCallback() {
        $html = ('<select name="select">');
        $html.= ('<option value="value1">Value 1</option>');
        $html.= ('<option value="value2" selected>Value 2</option>');
        $html.= ('<option value="value3">Value 3</option>');
        $html.= ('<option value="value3">Value 3</option>');
        $html.= ('</select>');

        echo $html;
    }

    public function mssgFieldCallback() {
        $html = ('<textarea name="message_field" id="message_field" style="width: 70%;"');
        $html.= sprintf('type="text">%s</textarea>', $this->message);


        echo $html;
    }    

    public function mssgTimeCallback() {
        $html = ('<select name="select2">');
        $html.= ('<option value="value1">Value 1</option>');
        $html.= ('<option value="value2" selected>Value 2</option>');
        $html.= ('<option value="value3">Value 3</option>');
        $html.= ('<option value="value3">Value 3</option>');
        $html.= ('</select>');

        echo $html;
    }    


    public function positionOptionsCallback(){
        $options = get_option( 'position_options' );
        $position_top = 'top: 0;';
        $position_bottom = 'bottom: 0;';
        $checked_top = ($options['positions'] == $position_top ?  'checked="checked"' : '' );
        $checked_bottom = ($options['positions'] == $position_bottom ?  'checked="checked"' : '' );

        $html = sprintf('<input type="radio" id="position_top"
        name="position_options[positions]" value="%s" %s style="margin: 3px 5px 3px 5px;">',$position_top, $checked_top);
        $html .= sprintf('<label for="position_top">Top</label>');
        $html .= sprintf('<input type="radio" id="position_bottom"
        name="position_options[positions]" value="%s" %s style="margin: 3px 5px 3px 5px;">',$position_bottom, $checked_bottom);
        $html .= sprintf('<label for="position_bottom">Bottom</label>');
        echo $html;

    }

    
    public function optionsSettingsText(){
        echo '<p>' . _e( 'Use the color picker below to choose the color of your message', 'track-message'  ) . '</p>';
      }
      
      /*
       * Display our color field as a text input field.
       */
    public function colorInput(){
        $options = get_option( 'color_options' );
        $color = ( $options['color'] != "" ) ? sanitize_text_field( $options['color'] ) : '#000000';
        
        
        $html = sprintf('<input class="TrackMessageNotification__content--edit-color" name="color_options[color]" type="text" value="'. $color .'" />');
        echo $html;
    }

    public function validateOptions( $input ){
        $valid = array();
        $valid['color'] = sanitize_text_field( $input['color'] );
        
        return $valid;
    }

    public function backgroundColorInput(){
        $options = get_option( 'background_color_options' );
        $color = ( $options['background_color'] != "" ) ? sanitize_text_field( $options['background_color'] ) : '#ffffff';
        
        
        $html = sprintf('<input class="TrackMessageNotification__content--edit-color" name="background_color_options[background_color]" type="text" value="'. $color .'" />');
        echo $html;
    }

    public function validateBackgroundOptions( $input ){
        $valid = array();
        $valid['background_color'] = sanitize_text_field( $input['background_color'] );
        
        return $valid;
    }


    public function tmssgShowMessage(){
        $color = get_option('color_options');
        $position = get_option('position_options');
        $background_color = get_option('background_color_options');
        $background_color_applied = $background_color['background_color'];
        $color_applied = $color['color'];
        $position_applied = $position['positions'];

        $accept = __('Accept', 'track-message');
        
        if ($position_applied == 'top: 0;'){
            $html = sprintf('<div style="color : %s; background-color: %s; %s" id="TrackMessageCookieNotification_Id--3455" class="TrackMessageNotification TrackMessageNotification__content--opennotification-top">', $color_applied, $background_color_applied, $position_applied);
        } else {
            $html = sprintf('<div style="color : %s; background-color: %s; %s" id="TrackMessageCookieNotification_Id--3455" class="TrackMessageNotification TrackMessageNotification__content--opennotification-bottom">', $color_applied, $background_color_applied, $position_applied);
        }
        $html.= sprintf('<p>%s</p>', $this->message);
        $html.= sprintf('<span id="TrackMessageCookieNotification_Id--close-5644" class="TrackMessageCookieNotification__inline--btn">%s</span>', $accept );
        $html.= sprintf('</div>');
        echo $html;
    }
}
  
new TrackMessage();
  
