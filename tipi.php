<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.patricelaurent.net
 * @since             1.0.0
 * @package           Tipi
 *
 * @wordpress-plugin
 * Plugin Name:       Tipi
 * Plugin URI:        https://www.patricelaurent.net/portfolio/e-commerce/tipi-pour-wordpress/
 * Description:       This plugin allow you tu use the TIPI Gateway allowing people to pay by credit card dierctly from your site.
 * Version:           1.1.7.1
 * Author:            Patrice LAURENT
 * Author URI:        https://www.patricelaurent.net
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-tipi
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}
/**
 * Get base name
 * @return string
 */
function get_wp_tipi_basename() {
	return plugin_basename(__FILE__);
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-tipi-activator.php
 */
function activate_tipi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tipi-activator.php';
	Tipi_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-tipi-deactivator.php
 */
function deactivate_tipi() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-tipi-deactivator.php';
	Tipi_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_tipi' );
register_deactivation_hook( __FILE__, 'deactivate_tipi' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-tipi.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_tipi() {

	$plugin = new Tipi();
	$plugin->run();

}
run_tipi();
