<?php

/**
 * The plugin bootstrap file
 *
 * This is a user list plugin. Which use third party user list api for user listing
 * And clicking on any user record it will show the details of the record.
 *
 * @link              www.technocratic.biz
 * @since             1.0.0
 * @package           Userlist_api
 *
 * @wordpress-plugin
 * Plugin Name:       User list API
 * Plugin URI:        www.technocratic.biz
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Ravi Patel
 * Author URI:        www.technocratic.biz
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       userlist_api
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'USERLIST_API_VERSION', '1.0.0' );

/* API endpoint */
if ( ! defined( 'USERLIST_ENDPOINT' ) ) {
	define('USERLIST_ENDPOINT','https://jsonplaceholder.typicode.com/');
}
/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-userlist_api-activator.php
 */
function activate_userlist_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-userlist_api-activator.php';
	Userlist_api_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-userlist_api-deactivator.php
 */
function deactivate_userlist_api() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-userlist_api-deactivator.php';
	Userlist_api_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_userlist_api' );
register_deactivation_hook( __FILE__, 'deactivate_userlist_api' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-userlist_api.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_userlist_api() {

	$plugin = new Userlist_api();
	$plugin->run();

}
run_userlist_api();
