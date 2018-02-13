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
    public function __construct(){
        add_action( 'wp_enqueue_scripts', array( $this, 'myScripts'));
        add_action('plugins_loaded', array($this,'multilanguage'));
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu'));
        add_action( 'admin_init', array( $this, 'mssgSections'));
        add_action( 'admin_init', array( $this, 'mssgFields'));
        add_action('admin_init', array($this, 'registerSettings'));

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
      
    }
  
    public function multilanguage() {  
		load_plugin_textdomain( 'track-message', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' );  
        }

    // Custom Message Section
    public function tmssgPluginMenu() {
        add_submenu_page(   'options-general.php', 
                        __('Track Message Settings', 'track-message'), 
                        __('Track Message', 'track-message'),
                            'manage_options', 
                            'track_message', 
                            array( $this, 'tmssgPluginContent'));
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
        </div> <?php
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
      
    public static function tmssgShowMessage(){
        $message = esc_html(get_option('message_field'));
        $accept = __('Accept', 'track-message');
        $html= sprintf('<div id="TrackMessageCookieNotification_Id--3455" class="TrackMessageNotification TrackMessageNotification__content--opennotification">');
        $html.= sprintf('<p>%s</p>', $message);
        $html.= sprintf('<span id="TrackMessageCookieNotification_Id--close-5644" class="TrackMessageCookieNotification__inline--btn">%s</span>', $accept );
        $html.= sprintf('</div>');
        echo $html;
    }
}
  
new TrackMessage();
  