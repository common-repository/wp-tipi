<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://www.patricelaurent.net
 * @since      1.0.0
 *
 * @package    Tipi
 * @subpackage Tipi/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Tipi
 * @subpackage Tipi/public
 * @author     Patrice LAURENT <laurent.patrice@gmail.com>
 */
class Tipi_Public {

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

	private $tipi_gateway_settings_options;

	private $tipi_plugin_url;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version, $tipi_gateway_settings_options, $tipi_plugin_url ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->tipi_gateway_settings_options = $tipi_gateway_settings_options;
		$this->tipi_plugin_url = $tipi_plugin_url;
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		if($this->is_tipi_page()) {
			// Include CSS if no choice have been made (eg. first install) or if the user have not disable it from the admin
			if ( ! array_key_exists( 'bootstrap_3',
					$this->tipi_gateway_settings_options ) || 'Yes' !== $this->tipi_gateway_settings_options['bootstrap_3']
			) {
				wp_enqueue_style( $this->plugin_name,
					plugin_dir_url( __FILE__ ) . 'css/tipi-public.css',
					array(),
					$this->version,
					'all' );
				wp_enqueue_style( $this->plugin_name . '_bs3',
					plugin_dir_url( __FILE__ ) . 'css/bootstrap.min.css',
					array(),
					$this->version,
					'all' );
			}
		}

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		if($this->is_tipi_page()) {
			wp_enqueue_script( $this->plugin_name . '-bsjs',
				plugin_dir_url( __FILE__ ) . 'js/bootstrap.min.js',
				array( 'jquery' ),
				$this->version,
				true );
			wp_enqueue_script( $this->plugin_name . '-validator',
				plugin_dir_url( __FILE__ ) . 'js/validator.js',
				array( 'jquery', $this->plugin_name . '-bsjs' ),
				$this->version,
				true );
			wp_enqueue_script( $this->plugin_name,
				plugin_dir_url( __FILE__ ) . 'js/tipi-public.js',
				array( 'jquery', $this->plugin_name . '-validator' ),
				$this->version,
				true );
		}
	}

	public function is_tipi_page(){
		if (is_array($this->tipi_gateway_settings_options) && array_key_exists('where_to_display_it_2',$this->tipi_gateway_settings_options) && is_page($this->tipi_gateway_settings_options['where_to_display_it_2']) ) return true;
		else return false;
	}

	public function insert_tipi_content( $content ) {
		if ( $this->is_tipi_page() && $this->tipi_gateway_settings_options['where_to_display_it_2'] == get_the_ID() ) {
			//$content is accessible in your own template too
			$templateFile = apply_filters('tipi_gateway_public_template','partials/tipi-public-display.php');
			ob_start();
			include $templateFile;
			$new_content = ob_get_clean();
			return $new_content;
		}
		
		return $content;
	}

	/**
	 * Check if content is empty
	 * @param $str
	 *
	 * @return bool
	 */
	public function empty_content($str) {
		return trim(str_replace('&nbsp;','',strip_tags($str))) == '';
	}

}
