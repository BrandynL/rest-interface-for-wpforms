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
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/includes
 * @author     Brandyn Lordi <Brandyn.lordi@gmail.com>
 */
class Rest_Interface_For_Wpforms_i18n
{


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain()
	{

		load_plugin_textdomain(
			'rest-interface-for-wpforms',
			false,
			dirname(dirname(plugin_basename(__FILE__))) . '/languages/'
		);
	}
}
