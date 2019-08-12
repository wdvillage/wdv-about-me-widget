<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       http://wdvillage.com
 * @since      1.0.0
 *
 * @package    Wdv_About_Me_Widget
 * @subpackage Wdv_About_Me_Widget/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wdv_About_Me_Widget
 * @subpackage Wdv_About_Me_Widget/admin
 * @author     wdvillage <wdvillage100@gmail.com>
 */
class Wdv_About_Me_Widget_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wdv_About_Me_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wdv_About_Me_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		
               wp_enqueue_style( 'fontawesomeadmin', plugin_dir_url( __FILE__ ) . '../includes/fonts/css/all.min.css', array(), '5.9.0', 'all' );
               wp_enqueue_style( 'fontawesomeadmin', plugin_dir_url( __FILE__ ) . '../includes/fonts/css/v4-shims.min.css', array(), '5.9.0', 'all' );               
               wp_enqueue_style( 'admincss', plugin_dir_url( __FILE__ ) . 'css/wdv-about-me-widget-admin.css', array(), $this->version, 'all' ); 
               
               wp_enqueue_style( 'wp-color-picker' );          

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Wdv_About_Me_Widget_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wdv_About_Me_Widget_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
                if ( ! did_action( 'wp_enqueue_media' ) ) {
                        wp_enqueue_media();
                }
                wp_enqueue_script( 'wp-color-picker' );
                wp_enqueue_script('underscore');
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wdv-about-me-widget-admin.js', array( 'jquery' ), $this->version, false );

	}


    /*
    *Register widgets
    */

	public function register_widgets() {
		 register_widget( 'Wdv_About_Me_Widget_Wdv_Widget' );
	}        
        
    
        
    /**
     * Register the administration menu for this plugin into the WordPress Dashboard menu.
     */

    public function add_plugin_admin_menu() {

     /*
      * Add a settings page for this plugin to the Settings menu.
     */
        add_options_page( 'WDV About Me Widget and Base Options Functions Setup', 'WDV About Me Widget', 'manage_options', $this->plugin_name, array($this, 'display_plugin_setup_page')
        );
    }

     /**
     * Add settings action link to the plugins page.
     */

    public function add_action_links( $links ) {
        
       $settings_link = array(
        '<a href="' . admin_url( 'options-general.php?page=' . $this->plugin_name ) . '">' . __('Settings', $this->plugin_name) . '</a>',
       );
       return array_merge(  $settings_link, $links );

    }

    /**
     * Render the settings page for this plugin.
     */

    public function display_plugin_setup_page() {
        
        include_once( 'partials/wdv-about-me-widget-admin-display.php' );
        
    }  
    
/**
   * Validate options
   */
   public function validate($input) {
     $valid = array();
     $valid['footer_text'] = (isset($input['footer_text']) && !empty($input['footer_text'])) ? $input['footer_text'] : '';
     return $valid;
   }
   
     /**
     * Update all options
     */
    public function options_update() {
        register_setting($this->plugin_name, $this->plugin_name, array($this, 'validate'));
    }  
}
