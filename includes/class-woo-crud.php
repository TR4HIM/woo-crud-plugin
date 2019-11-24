<?php

/**
 * Woo Crud core plugin class.
 * - Import all styles and Script
 * - Manage plugin logic and templates
 *
 * @since      1.0.0
 * @package    Woo Crud
 * @author     Soufiane <tr4him@gmail.com>
 */

if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

class WooCrudCore {

	/**
	 * The unique identifier of this plugin.
	 */
	public $plugin_name;

	/**
	 * The current version of the plugin.
	 */
	public $version;

	/**
	 * Define the core functionality of the plugin.
	 */

	public function __construct() {
		$this->version 		= WOOCRUD_VERSION;
		$this->plugin_name 	= 'wp-woo-crud';
	}

	/**
	 * Register all of the hooks.
	 */
    public function enqueue_styles() {
		//Import bootstrap
		wp_enqueue_style( $this->plugin_name.'-cdn-vue','https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css', array(), $this->version, 'all' );
		//Woo Crud styles
		wp_enqueue_style( $this->plugin_name.'-main-styles',plugins_url( '../assets/css/main.css', __FILE__ ), array(), $this->version, 'all' );
    }
    
    public function enqueue_scripts() {
    }
	
	/**
	 * Register front end hooks.
	 */
	private function define_front_hooks() {

        add_action( 'wp_enqueue_scripts',array( $this, 'enqueue_styles') );
        add_action( 'wp_enqueue_scripts',array( $this, 'enqueue_scripts') );
	}

	/**
	 * Register all admin hooks.
	 */
	private function define_admin_hooks() {
		add_action('admin_menu', array( $this, 'one_viewer_register_menu_settings'));
		
	}

	public function one_viewer_register_menu_settings(){
		add_options_page('Woo Crud', 'Woo Crud', 'manage_options','woo-crud-settings',array( $this, 'woo_crud_admin_template' ));
	}
	
	/**
	 * Page settings template and logic
	 */
	public function woo_crud_admin_template(){
		/**
		 * Check if user clicked save on the settings page.
		 */
		if ( !empty($_POST)){
			//Get selected categories.
			$categories = $_POST['wp-newiewer-select'];
			//Turn selected categories to string
			$categoriesToString = trim(implode(',',$categories));
			//Update setting field with new selected categories
			update_option( 'oneviewer_categories', $categoriesToString);
			//Create Message tempalte
			$HTMLNotice = '<div id="setting-error-settings_updated" class="updated settings-error notice is-dismissible">';
			$HTMLNotice .= '<p><strong>Settings saved.</strong></p>';
			$HTMLNotice .= '<button type="button" class="notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>';
			echo $HTMLNotice;
		}
		/**
		 * Page settings template HTML and Form
		 */
		$HTMLTemplate = "";
		$HTMLTemplate .= '<div class="woo-crud-container">';
		$HTMLTemplate .= '<h1>WooCrud Settings</h1>';
		$HTMLTemplate .= '<p>Please choose categories to show on viewer, You can select one or multiple categories</p>';
		$HTMLTemplate .= '<form action="'.$_SERVER['REQUEST_URI'].'" method="post">';
		$HTMLTemplate .= '<p>';
		$HTMLTemplate .= 'HERE WE GO AGAIN';
		$HTMLTemplate .= '</p>';
		$HTMLTemplate .= '<p><input name="Submit" type="submit" class="button-primary" value="Save Changes" /></p>';
		$HTMLTemplate .= '</form>';
		$HTMLTemplate .= '</div>';
		
		echo $HTMLTemplate;
	
	}

	/**
	 * Execute all hooks
	 */
	
	public function init() {
		$this->define_front_hooks();
		$this->define_admin_hooks();
	}
}
