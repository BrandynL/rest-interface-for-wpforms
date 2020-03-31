<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://brandynlordi.com
 * @since      1.0.0
 *
 * @package    Wpforms_Rest_Interface
 * @subpackage Wpforms_Rest_Interface/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Wpforms_Rest_Interface
 * @subpackage Wpforms_Rest_Interface/includes
 * @author     Brandyn Lordi <Brandyn.lordi@gmail.com>
 */
class Wpforms_Rest_Interface_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'wpforms-rest-interface',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
