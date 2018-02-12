<?php 
class TrackMessage{
    public function __construct(){
        add_action( 'wp_enqueue_scripts', array( $this, 'myScripts' ));
        add_action('wp_head', array( $this, 'tmssgShowMessage'));

    }

    public function myScripts(){
        $url_plugin_js  =   plugins_url('track-message/js/');
        $url_plugin_css  =   plugins_url('track-message/css/');
    
        wp_register_script('tmssg_js', $url_plugin_js . 'track_message.js');   
        wp_register_style( 'tmssg_css', $url_plugin_css . 'track_message.css');
        wp_enqueue_style('tmssg_css');
        wp_enqueue_script('tmssg_js');
    
    }
    
    public static function tmssgShowMessage(){
        $message = get_option('message_field');
        $html= sprintf("<div id='TrackMessageCookieNotification_Id--3455' class='TrackMessageNotification TrackMessageNotification__content--opennotification'>");
        $html.= sprintf("<p>$message</p>");
        $html.= sprintf("<span id='TrackMessageCookieNotification_Id--close-5644' class='TrackMessageCookieNotification__inline--btn'>Aceptar</span>");
        $html.= sprintf("</div>");
        echo $html;
    }
}
