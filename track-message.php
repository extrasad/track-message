<?php
 /** 
  *@package Track Message
 */
/*
Plugin Name: Track Message
Description: Track Message allows you to inform users with a customizable and elegant message that your site uses cookies to track them.
Author: CmantikWeb - Dev. Carlos Rivas,  Dev Abdiangel Urdaneta
Author URI: https://cmantikweb.com/
Version: 1.0.0
License: GPLv2 or later
License URI: https://opensource.org/licenses/GPL-2.0
Text Domain: track-message

*/

// Security check
if ( ! function_exists( 'add_action' ) ) {
    echo 'You don\'t have permission to access this file.';
    die;
  }

class TrackMessage{

private $message;
private $cookie_settings;
private $message_settings;
private $cookie_options;
private $message_options;
private $position_options;
private $position_settings;
private $open_view_options;
private $open_view_settings;
private $close_view_options;
private $close_view_settings;


    // Construct Function
    public function __construct(){

        $plugin = plugin_basename( __FILE__ );
        $options = get_option('message_field');
        $this->message = ( $options != "" ) ? sanitize_text_field($options) : __('We use cookies in our site to add custom functions. Continuing browsing accepts our cookies policy', 'track-message');
        $this->message_options = get_option('message_time_settings');
        $this->cookie_options = get_option('cookie_time_settings');
        $this->cookie_settings=array(
                        1   =>      __('1 Month','track-message'),
                        2   =>      __('2 Months','track-message'),
                        3   =>      __('3 Months','track-message'),
                        4   =>      __('4 Months','track-message'),
                        5   =>      __('5 Months','track-message'),
                        6   =>      __('6 Months','track-message'),
                        7   =>      __('7 Months','track-message'),
                        8   =>      __('8 Months','track-message'),
                        9   =>      __('9 Months','track-message'),
                        10   =>     __('10 Months','track-message'),
                        11   =>     __('11 Months','track-message'),
                        12   =>     __('12 Months','track-message'),
                        13   =>     __('13 Months','track-message'),
                        14   =>     __('14 Months','track-message'),
                        15   =>     __('15 Months','track-message'),
                        16   =>     __('16 Months','track-message'),
                        17   =>     __('17 Months','track-message'),
                        18   =>     __('18 Months','track-message'),
                        19   =>     __('19 Months','track-message'),
                        20   =>     __('20 Months','track-message'),
                        21   =>     __('21 Months','track-message'),
                        23   =>     __('22 Months','track-message'),
                        22   =>     __('23 Months','track-message'),
                        24   =>     __('24 Months','track-message'),                                
        );
        $this->message_settings=array(
                        12   =>      __('12 Seconds','track-message'),
                        15   =>      __('15 Seconds','track-message'),
                        20   =>      __('20 Seconds','track-message'),
                        25   =>      __('25 Seconds','track-message'),
                        30   =>      __('30 Seconds','track-message'),
                        35   =>      __('35 Seconds','track-message'),
                        40   =>      __('40 Seconds','track-message'),
                        45   =>      __('45 Seconds','track-message'),
                        50   =>      __('50 Seconds','track-message'),
                        55   =>      __('55 Seconds','track-message'),
                        60   =>      __('60 Seconds','track-message'),
                        65   =>      __('65 Seconds','track-message'),
                        70   =>      __('70 Seconds','track-message'),                               
        );

        $this->position_options = get_option('position_options');

        $this->position_settings = array(
        'position_top'                      => __('Top', 'track-message'),
        'position_block_top_right'          => __('Block Top Right', 'track-message'),
        'position_block_top_left'           => __('Block Top Left', 'track-message'),
        'position_bottom'                   => __('Bottom','track-message'),
        'position_block_bottom_right'       => __('Block Bottom Right', 'track-message'),
        'position_block_bottom_left'        => __('Block Bottom Left', 'track-message')
        );

        

        $this->open_view_options = get_option('open_view_options');

        $this->open_view_settings = array(
			'none'	 			=> __( 'None', 'track-message' ),
			'fade'	 			=> __( 'Fade', 'track-message' ),
            'slide'	 			=> __( 'Slide', 'track-message' ),
            'fade-slide'	 	=> __( 'Fade & Slide', 'track-message' )
        );
        
        $this->close_view_options = get_option('close_view_options');

        $this->close_view_settings = array(
			'none'	 			=> __( 'None', 'track-message' ),
			'fade'	 			=> __( 'Fade', 'track-message' ),
            'slide'	 			=> __( 'Slide', 'track-message' ),
            'fade-slide'	 	=> __( 'Fade & Slide', 'track-message' )
		);

        add_action( 'wp_enqueue_scripts', array( $this, 'myScripts'));
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu'));
        add_action( 'admin_init', array( $this, 'settingsInit' ) );
        add_filter( "plugin_action_links_$plugin", array($this, 'customSettingsLink' ));

        if( !isset( $_COOKIE["UserFirstTime"])){
            add_action('wp_head', array( $this, 'tmssgShowMessage'));
        } 
  
    }

    // Main menu link
    public function customSettingsLink($links) {
        $link = (admin_url('/options-general.php?page=track_message')); 
        $settings_link = sprintf('<a href="%s">' .(esc_html__( 'Settings', 'track-message' )) . '</a>', esc_url($link));
        array_push($links, $settings_link);
          return $links;
    }

    // Register scripts.
    public function myScripts(){
        $plugin_dir = plugin_dir_url(__FILE__);
        $url_plugin_js  =   ($plugin_dir.'js/');
        $url_plugin_css  =   ($plugin_dir.'css/');
        $js_settings = array(
            'cookie' => $this->cookie_options['cookie_time'],
            'message' => $this->message_options['message_time']
        );
        $opening_view_settings = array(
            'openView' => $this->open_view_options['open_view']
        );
        $closing_view_settings = array(
            'closeView' => $this->close_view_options['close_view']
        );
        $positioning_settings =array(
            'mssgPosition' => $this->position_options['positions']
        );
        
        

        
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
        wp_localize_script('tmssg_js', 'phpValues', $js_settings);
        wp_localize_script('tmssg_js', 'openViewSettings', $opening_view_settings);
        wp_localize_script('tmssg_js', 'closeViewSettings', $closing_view_settings);
        wp_localize_script('tmssg_js', 'positionSettings', $positioning_settings);
    }
  

    // Custom Message Section
    public function tmssgPluginMenu() {
        $settings = add_submenu_page('options-general.php', 
                        (esc_html__('Options', 'track-message')), 
                        (esc_html__('Track Message', 'track-message')),
                            'manage_options', 
                            'track_message', 
                            array( $this, 'tmssgPluginContent'));
        add_action( 'load-' . $settings, array($this, 'myScripts' ));

    }
    
    //Plugin content
    public function tmssgPluginContent( $active_tab = '') {
        ?>
        <div class="wrap">
        <h2><?php (esc_html_e('Track Message', 'track-message')); ?></h2>
        <?php
            if((isset( $_GET[ 'tab' ] ))){
                $active_tab = $_GET[ 'tab'];
            }else {
                switch($active_tab){
                    case($active_tab == 'general_options'):
                        $active_tab = 'general_options';
                        break;
                    case($active_tab == 'content_options'):
                        $active_tab = 'content_options';
                        break;
                    case($active_tab == 'styles_options'):
                        $active_tab = 'styles_options';
                        break;
                    case($active_tab == 'policy_options'):
                        $active_tab = 'policy_options';
                        break;
                        }
                    }
        ?>

        <h2 class="nav-tab-wrapper">
            <a href="?page=track_message&tab=general_options" class="nav-tab <?php echo $active_tab == 'general_options' ? 'nav-tab-active' : ''; ?>">General Options</a>
            <a href="?page=track_message&tab=content_options" class="nav-tab <?php echo $active_tab == 'content_options' ? 'nav-tab-active' : ''; ?>">Content Options</a>
            <a href="?page=track_message&tab=styles_options" class="nav-tab <?php echo $active_tab == 'styles_options' ? 'nav-tab-active' : ''; ?>">Styles Options</a>
            <a href="?page=track_message&tab=policy_options" class="nav-tab <?php echo $active_tab == 'policy_options' ? 'nav-tab-active' : ''; ?>">Policy Options</a>
        </h2>
        <form method="post" action="options.php">
            <?php
                switch($active_tab){
                    case($active_tab == 'general_options'):
                        settings_fields( 'track_message_general' );
                        do_settings_sections( 'track_message_general' );
                        break;
                    case($active_tab == 'content_options'):
                        settings_fields( 'track_message_content' );
                        do_settings_sections( 'track_message_content' );
                        break;
                    case($active_tab == 'styles_options'):
                        settings_fields( 'track_message_styles' );
                        do_settings_sections( 'track_message_styles' );
                        break;
                    case($active_tab == 'policy_options'):
                        settings_fields( 'track_message_policy' );
                        do_settings_sections( 'track_message_policy' );
                        break;
                    } 
        submit_button();
            ?>
        </form>
        </div>
        <?php
    }
    // Init settings..    
    public function settingsInit(){
        //Text message
        register_setting( 
            'track_message_content', 
            'message_field'
        );
        
        add_settings_field( 
            'message_field',
            __('Write the message', 'track-message'), 
            array( $this, 'mssgFieldCallback' ), 
            'track_message_content', 'message_section' 
        );

        add_settings_section( 
            'message_section', 
            __('Content Settings',
            'track-message'), 
            false, 
            'track_message_content' 
        );

        //Message Time
        register_setting( 
            'track_message_general', 
            'message_time_settings'
        );
        
        add_settings_field( 
            'message_time',
            __('Set message duration on front-page ', 
            'track-message'), 
            array( $this, 'mssgTimeCallback' ), 
            'track_message_general', 
            'message_time' 
        );

        add_settings_section( 
            'message_time', 
            __('General settings','track-message'), 
            false, 
            'track_message_general' 
        );
        //Cookie Time
        register_setting( 
            'track_message_general', 
            'cookie_time_settings'
        );
        
        add_settings_field(
            'cookie_time', 
            __('Set cookie duration to expire',
            'track-message'), 
            array( $this, 'cookieTimeCallback' ), 
            'track_message_general', 
            'cookie_time' 
        );

        add_settings_section(
            'cookie_time', 
            __('',
            'track-message'), 
            false, 
            'track_message_general' 
        );

        //Position - Design
        register_setting(
            'track_message_styles', 
            'position_options');

        add_settings_field(
            'positions', 
            __('Where do you want your message to show up?', 
            'track-message'), 
            array( $this,'positionOptionsCallback'), 
            'track_message_styles', 
            'position_section'
        );

        add_settings_section(
            'position_section', 
            __('Styles Settings','track-message'), 
            false, 
            'track_message_styles'
        );

        //View - Design

        // Open View
        register_setting(
            'track_message_styles', 
            'open_view_options');

        add_settings_field(
            'open_view', 
            __('How do you want the message to show up?', 
            'track-message'), 
            array( $this,'openView'), 
            'track_message_styles', 
            'view_section'
        );

        add_settings_section(
            'view_section', 
            __('View Settings','track-message'), 
            false, 
            'track_message_styles'
        );

        // Close View
        register_setting(
            'track_message_styles', 
            'close_view_options');

        add_settings_field(
            'close_view', 
            __('How do you want the message to be closed?', 
            'track-message'), 
            array( $this,'closeView'), 
            'track_message_styles', 
            'view_section'
        );
     

        //Color Picker - Design
        register_setting(
            'track_message_styles',
            'color_options',
            array( $this, 'validateOptions' )
        );
          
        add_settings_section(
            'wp-color-picker-section',
            __( 'Choose Your Color', 'track-message' ),
            array( $this, 'optionsSettingsText' ),
            'track_message_styles'
        );
          
        add_settings_field(
            'color',
            __( 'Text color', 'track-message'  ),
            array( $this, 'colorInput' ),
            'track_message_styles',
            'wp-color-picker-section'
        );

        register_setting(
            'track_message_styles',
            'background_color_options',
            array( $this, 'validateBackgroundOptions' )
        );
          
        add_settings_field(
            'background_color',
            __( 'Background Color', 'track-message'  ),
            array( $this, 'backgroundColorInput' ),
            'track_message_styles',
            'wp-color-picker-section'
        );
        //Button color settings

        register_setting(
            'track_message_styles',
            'btn_color_options',
            array( $this, 'validateBtnColorOptions' )
        );
          
        add_settings_field(
            'btn_color',
            __( 'Button Color', 'track-message'  ),
            array( $this, 'btnColorInput' ),
            'track_message_styles',
            'wp-color-picker-section'
        );

        register_setting(
            'track_message_styles',
            'background_btn_color_options',
            array( $this, 'validateBtnBackgroundOptions' )
        );
          
        add_settings_field(
            'background_btn_color',
            __( 'Button Background Color', 'track-message'  ),
            array( $this, 'btnBackgroundColorInput' ),
            'track_message_styles',
            'wp-color-picker-section'
        );
    }
       
    // Callbacks Functions.  
    public function cookieTimeCallback() {
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class = ('description');
        $html = sprintf('<select name="%s">', esc_attr('cookie_time_settings[cookie_time]'));
        foreach($this->cookie_settings as $key => $value)
        {
            if(!isset($this->cookie_options['cookie_time']) && $key == 12){
                $html .= sprintf('<option value="%d" %s>%s</option>', esc_attr($key), esc_attr('selected'), esc_html($value));  
            }else{
            $html .= sprintf('<option value="%d"'.selected(esc_attr($this->cookie_options['cookie_time']), esc_attr($key), false).'>%s</option>', esc_attr($key), esc_html($value));
            }
        }   
        $html .= ('</select>');
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class), esc_html($text));
        echo $html;  
    }

    public function mssgFieldCallback() {
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class = ('description');
        $style = ('width: 70%;');       
        $html = sprintf('<textarea name="%s" id="%s" style="%s"',esc_attr('message_field'), esc_attr('message_field'), esc_attr($style));
        $html.= sprintf('type="text">%s</textarea>', esc_html__($this->message, 'track-message'));
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class), esc_html($text));

        echo $html;
    }    

    public function mssgTimeCallback() {
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class = ('description');
        $html = sprintf('<select name="%s">', esc_attr('message_time_settings[message_time]'));
        foreach($this->message_settings as $key => $value)
        {
            if(!isset($this->message_options['message_time']) && $key == 30){
                $html .= sprintf('<option value="%d" %s>%s</option>', esc_attr($key), esc_attr('selected'), esc_html($value));  
            }else{
            $html .= sprintf('<option value="%d"'.selected(esc_attr($this->message_options['message_time']), esc_attr($key), false).'>%s</option>', esc_attr($key), esc_html($value));
            }
        }
        $html .= ('</select>');
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class), esc_html($text));
        echo $html;    
    }


    public function positionOptionsCallback(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class = ('description');
        $html = sprintf('<select name="%s">', esc_attr('position_options[positions]'));
        foreach($this->position_settings as $key => $value)
        {
            if(!isset($this->position_options['positions']) && $key == 'position_bottom'){
                $html .= sprintf('<option value="%s" %s>%s</option>', esc_attr($key), esc_attr('selected'), esc_html($value));  
            }else{
            $html .= sprintf('<option value="%s"'.selected(esc_attr($this->position_options['positions']), esc_attr($key), false).'>%s</option>', esc_attr($key), esc_html($value));
            }
        }
        $html .= ('</select>');
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class), esc_html($text));
        echo $html;   
    }

    public function openView(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class = ('description');
        $html = sprintf('<select name="%s">', esc_attr('open_view_options[open_view]'));
        foreach($this->open_view_settings as $key => $value)
        {
            if(!isset($this->open_view_options['open_view']) && $key == 'none'){
                $html .= sprintf('<option value="%s" %s>%s</option>', esc_attr($key), esc_attr('selected'), esc_html($value));  
            }else{
            $html .= sprintf('<option value="%s"'.selected(esc_attr($this->open_view_options['open_view']), esc_attr($key), false).'>%s</option>', esc_attr($key), esc_html($value));
            }
        }
        $html .= ('</select>');
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class), esc_html($text));
        echo $html;    
    }

    public function closeView(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class = ('description');
        $html = sprintf('<select name="%s">', esc_attr('close_view_options[close_view]'));
        foreach($this->close_view_settings as $key => $value)
        {
            if(!isset($this->close_view_options['close_view']) && $key == 'none'){
                $html .= sprintf('<option value="%s" %s>%s</option>', esc_attr($key), esc_attr('selected'), esc_html($value));  
            }else{
            $html .= sprintf('<option value="%s"'.selected(esc_attr($this->close_view_options['close_view']), esc_attr($key), false).'>%s</option>', esc_attr($key), esc_html($value));
            }
        }
        $html .= ('</select>');
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class), esc_html($text));
        echo $html;     
    }

    
    public function optionsSettingsText(){
        echo '<p>' . esc_html_e( 'Use the color picker below to choose the color of your message', 'track-message'  ) . '</p>';
      }
      
      /*
       * Display our color field as a text input field.
       */
    public function colorInput(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class_paragraph = ('description');
        $options = get_option( 'color_options' );
        $color = ( $options['color'] != "" ) ? sanitize_text_field( $options['color'] ) : '#000000';
        $class = ('TrackMessageNotification__content--edit-color');
        
        $html = sprintf('<input class="%s" name="%s" type="%s" value="'. esc_html($color) .'" />', esc_attr($class), esc_attr('color_options[color]'), esc_attr('text'));
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class_paragraph), esc_html($text));
        echo $html;
    }

    public function validateOptions( $input ){
        $valid = array();
        $valid['color'] = sanitize_text_field( $input['color'] );
        
        return $valid;
    }

    public function backgroundColorInput(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class_paragraph = ('description');
        $options = get_option( 'background_color_options' );
        $color = ( $options['background_color'] != "" ) ? sanitize_text_field( $options['background_color'] ) : '#ffffff';
        $class = ('TrackMessageNotification__content--edit-color');
        $name = ('background_color_options[background_color]');
        $type = ('text');
        
        $html = sprintf('<input class="%s" name="%s" type="%s" value="'. esc_attr($color) .'" />', esc_attr($class), esc_attr($name), esc_attr($type));
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class_paragraph), esc_html($text));
        echo $html;
    }

    public function validateBackgroundOptions( $input ){
        $valid = array();
        $valid['background_color'] = sanitize_text_field( $input['background_color'] );
        
        return $valid;
    }
     // Button Color settings
    public function btnColorInput(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class_paragraph = ('description');
        $options = get_option( 'btn_color_options' );
        $color = ( $options['btn_color'] != "" ) ? sanitize_text_field( $options['btn_color'] ) : '#000000';
        $class = ('TrackMessageNotification__content--edit-color');
        $name = ('btn_color_options[btn_color]');
        $type = ('text');
        $html = sprintf('<input class="%s" name="%s" type="%s" value="'. esc_attr($color) .'" />', esc_attr($class), esc_attr($name), esc_attr($type));
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class_paragraph), esc_html($text));
        echo $html;
    }

    public function validateBtnColorOptions( $input ){
        $valid = array();
        $valid['btn_color'] = sanitize_text_field( $input['btn_color'] );
        
        return $valid;
    }

    public function btnBackgroundColorInput(){
        $text = __('Lorem ipsum the fuck out of you', 'track-message');
        $class_paragraph = ('description');
        $options = get_option( 'background_btn_color_options' );
        $color = ( $options['background_btn_color'] != "" ) ? sanitize_text_field( $options['background_btn_color'] ) : '#ffffff';
        $class = ('TrackMessageNotification__content--edit-color');
        $name = ('background_btn_color_options[background_btn_color]');
        $type = ('text');
        
        $html = sprintf('<input class="%s" name="%s" type="%s" value="'. esc_attr($color) .'" />', esc_attr($class), esc_attr($name), esc_attr($type));
        $html .= sprintf('<p class="%s">%s<p>', esc_attr($class_paragraph), esc_html($text));
        echo $html;
    }

    public function validateBtnBackgroundOptions( $input ){
        $valid = array();
        $valid['background_btn_color'] = sanitize_text_field( $input['background_btn_color'] );
        
        return $valid;
    }

    // Show the message.
    public function tmssgShowMessage(){
        $color = get_option('color_options');
        $background_color = get_option('background_color_options');
        $btn_color = get_option('btn_color_options');
        $btn_background_color = get_option('background_btn_color_options');
        $btn_color_applied = ('color :'.$btn_color['btn_color'].';');
        $btn_background_color_applied = ('background-color :'.$btn_background_color['background_btn_color'].';');
        $background_color_applied = ('background-color :'.$background_color['background_color'].';');
        $color_applied = ('color :'.$color['color'].';');
        $id_button = ('TrackMessageCookieNotification_Id--close-5644');
        $class_button = ('TrackMessageCookieNotification__inline--btn');
        $id = ('TrackMessageCookieNotification_Id--3455');
        $class = ('TrackMessageNotification');
        
        $accept = esc_html__('Accept', 'track-message');
        $html = sprintf('<div style="%s %s" id="%s" class="%s">', esc_attr($color_applied), esc_attr($background_color_applied), esc_attr($id), esc_attr($class));
        $html.= sprintf('<p>%s</p>', esc_html__($this->message,'track-message'));
        $html.= sprintf('<span style="%s %s" id="%s" class="%s">%s</span>', esc_attr($btn_color_applied), esc_attr($btn_background_color_applied), esc_attr($id_button), esc_attr($class_button), esc_html($accept));
        $html.= sprintf('</div>');
        echo $html;
    }
}
  
new TrackMessage();
  
