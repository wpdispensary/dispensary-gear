<?php

/**
 * The plugin bootstrap file
 *
 * @link              https://www.wpdispensary.com
 * @since             1.0.0
 * @package           WPD_Gear
 *
 * @wordpress-plugin
 * Plugin Name:       WP Dispensary's Gear
 * Plugin URI:        https://www.wpdispensary.com/dispensary-gear-add-on
 * Description:       This plugin adds a GEAR menu type to the WP Dispensary menu plugin. Brought to you by <a href="https://www.deviodigital.com/">Devio Digital</a> &amp; <a href="https://www.wpdispensary.com">WP Dispensary</a>.
 * Version:           1.7
 * Author:            WP Dispensary
 * Author URI:        https://www.wpdispensary.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpd-gear
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Current plugin version.
 */
define( 'WPD_GEAR_VERSION', '1.7' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpd-gear-activator.php
 */
function activate_wpd_gear() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpd-gear-activator.php';
	WPD_Gear_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpd-gear-deactivator.php
 */
function deactivate_wpd_gear() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wpd-gear-deactivator.php';
	WPD_Gear_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wpd_gear' );
register_deactivation_hook( __FILE__, 'deactivate_wpd_gear' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wpd-gear.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpd_gear() {

	$plugin = new WPD_Gear();
	$plugin->run();

}
run_wpd_gear();
