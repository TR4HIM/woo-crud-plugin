<?php
/*
    Plugin Name: WooCrud API 
    Plugin URI: https://github.com/TR4HIM/woo-crud-plugin
    Description: Is a plugin to manage API and Setting for ReactJs Application WooCrud
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
require plugin_dir_path( __FILE__ ) . 'includes/class-tgm-plugin-activation.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-endpoints.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-woo-crud.php';

/**
 * Register the required plugins for this theme.
 *
 * In this example, we register five plugins:
 * - one included with the TGMPA library
 * - two from an external source, one from an arbitrary source, one from a GitHub repository
 * - two from the .org repo, where one demonstrates the use of the `is_callable` argument
 *
 * The variables passed to the `tgmpa()` function should be:
 * - an array of plugin arrays;
 * - optionally a configuration array.
 * If you are not changing anything in the configuration array, you can remove the array and remove the
 * variable from the function call: `tgmpa( $plugins );`.
 * In that case, the TGMPA default settings will be used.
 *
 * This function is hooked into `tgmpa_register`, which is fired on the WP `init` action on priority 10.
 */
function woo_crud_register_required_plugins() {
	/*
	 * Array of plugin arrays. Required keys are name and slug.
	 * If the source is NOT from the .org repo, then source is also required.
	 */
	$plugins = array(
		// This is an example of how to include a plugin from the WordPress Plugin Repository.
		array(
			'name'      => 'JWT Authentication for WP-API',
			'slug'      => 'jwt-authentication-for-wp-rest-api',
			'required'  => true,
        ),
        
		array(
			'name'      => 'WooCommerce',
			'slug'      => 'woocommerce',
			'required'  => true,
		),

	);

	/*
	 * Array of configuration settings. Amend each line as needed.
	 *
	 * TGMPA will start providing localized text strings soon. If you already have translations of our standard
	 * strings available, please help us make TGMPA even better by giving us access to these translations or by
	 * sending in a pull-request with .po file(s) with the translations.
	 *
	 * Only uncomment the strings in the config array if you want to customize the strings.
	 */
	$config = array(
		'id'           => 'woo-crud',               // Unique ID for hashing notices for multiple instances of TGMPA.
		'default_path' => '',                       // Default absolute path to bundled plugins.
		'menu'         => 'tgmpa-install-plugins',  // Menu slug.
		'parent_slug'  => 'plugins.php',            // Parent menu slug.
		'capability'   => 'manage_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
		'has_notices'  => true,                     // Show admin notices or not.
		'dismissable'  => true,                     // If false, a user cannot dismiss the nag message.
		'dismiss_msg'  => '',                       // If 'dismissable' is false, this message will be output at top of nag.
		'is_automatic' => false,                    // Automatically activate plugins after installation or not.
		'message'      => '',                       // Message to output right before the plugins table.
	);
	tgmpa( $plugins, $config );
}
 
/* 
    Woo Crud Run
*/
function wp_woo_crud_run () {
    
    $urlsInit = new WooCrudEndPoint();
    $urlsInit->Register_Endpoint();

	$plugin = new WooCrudCore();
    $plugin->init();

    add_action( 'tgmpa_register', 'woo_crud_register_required_plugins' );

}
wp_woo_crud_run ();