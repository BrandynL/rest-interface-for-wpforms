<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandynlordi.com
 * @since      1.0.0
 *
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/admin
 * @author     Brandyn Lordi <Brandyn.lordi@gmail.com>
 */
class Rest_Interface_For_Wpforms_Admin
{

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

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles()
	{
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/rest-interface-for-wpforms-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/rest-interface-for-wpforms-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Register a custom menu page.
	 */
	public function rest_interface_for_wpforms_custom_menu_page()
	{
		add_submenu_page(
			'wpforms-overview',
			'REST Interface for WPForms',
			'REST Interface',
			'manage_options',
			$this->plugin_name,
			function () {
				require(plugin_dir_path(__FILE__) . 'partials/rest-interface-for-wpforms-admin-display.php');
			},
			null
		);
	}

	/**
	 * Update the options table with the supplied values.
	 *
	 * @since     1.0.0
	 * @return    bool    result of the attempted option update
	 */
	public function update_rest_interface_for_wpforms_post_settings($data)
	{
		if (defined('REST_INTERFACE_FOR_WPFORMS_OPTION_SLUG')) {
			// trim all the strings before we save them to the database
			$data = array_map(function ($value) {
				return trim($value);
			}, $data);
			return update_option(REST_INTERFACE_FOR_WPFORMS_OPTION_SLUG, json_encode($data));
		}
		return false;
	}
}
