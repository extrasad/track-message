<?php
class SettingsPage{

    // Construct
    public function __construct(){
        // Add the options page and menu item
        add_action( 'admin_menu', array( $this, 'tmssgPluginMenu' ));
        add_action( 'admin_init', array( $this, 'mssgSections' ) );
        add_action( 'admin_init', array( $this, 'mssgFields' ) );
        add_action('admin_init', array($this, 'registerSettings' ));

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
}
  
