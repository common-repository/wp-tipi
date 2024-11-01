<?php

/**
 * Fired during plugin activation
 *
 * @link       https://www.patricelaurent.net
 * @since      1.0.0
 *
 * @package    Tipi
 * @subpackage Tipi/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Tipi
 * @subpackage Tipi/includes
 * @author     Patrice LAURENT <laurent.patrice@gmail.com>
 */
class Tipi_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {
		$default = array(
			'bootstrap_3'     => 'No',
			'input_mode_1'   => 'T'
		);
		update_option( 'tipi_gateway_settings_option_name', $default );
	}

}
