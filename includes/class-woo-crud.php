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
	}

	/**
	 * Execute all hooks
	 */
	
	public function init() {
		$this->define_front_hooks();
		$this->define_admin_hooks();
	}
}
