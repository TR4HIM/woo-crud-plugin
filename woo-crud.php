<?php
/*
    Plugin Name: Woo Crud 
    Plugin URI: https://github.com/TR4HIM
    Description: Wordpress API for reactJs
    Author: Soufiane Trahim
    Version: 1.0.0
    Author URI: https://github.com/TR4HIM
    Requires at least: 4.9
*/

if(!defined('ABSPATH')) {die('You are not allowed to call this page directly.');}

/* Plugin Constans */

define( 'WOOCRUD_VERSION', '1.0.0' );
define( 'WOOCRUD_REQUIRED_WP_VERSION', '4.9' );
define( 'WOOCRUD_PLUGIN', dirname( __FILE__ ) );

 

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-viewer-per-category-activator.php
 */
function activate_woo_crud() {

     
 
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-viewer-per-category-deactivator.php
 */
function deactivate_woo_crud() {

}

register_activation_hook( __FILE__, 'activate_woo_crud' );
register_deactivation_hook( __FILE__, 'deactivate_woo_crud' );


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-endpoints.php';

require plugin_dir_path( __FILE__ ) . 'includes/class-woo-crud.php';


 
/* 
    One Viewer Run
*/
function wp_woo_crud_run () {

    
    $urlsInit = new WooCrudEndPoint();
    $urlsInit->Register_Endpoint();

	$plugin = new WooCrudCore();
    $plugin->init();

}
wp_woo_crud_run ();





 