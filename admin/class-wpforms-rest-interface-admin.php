<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://brandynlordi.com
 * @since      1.0.0
 *
 * @package    Wpforms_Rest_Interface
 * @subpackage Wpforms_Rest_Interface/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wpforms_Rest_Interface
 * @subpackage Wpforms_Rest_Interface/admin
 * @author     Brandyn Lordi <Brandyn.lordi@gmail.com>
 */
class Wpforms_Rest_Interface_Admin
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
		wp_enqueue_style($this->plugin_name, plugin_dir_url(__FILE__) . 'css/wpforms-rest-interface-admin.css', array(), $this->version, 'all');
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts()
	{
		wp_enqueue_script($this->plugin_name, plugin_dir_url(__FILE__) . 'js/wpforms-rest-interface-admin.js', array('jquery'), $this->version, false);
	}

	/**
	 * Register a custom menu page.
	 */
	public function wpforms_rest_interface_custom_menu_page()
	{
		add_submenu_page(
			'wpforms-overview',
			'WPForms Rest Interface',
			'REST Interface',
			'manage_options',
			$this->plugin_name,
			function () {
				require(plugin_dir_path(__FILE__) . 'partials/wpforms-rest-interface-admin-display.php');
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
	public function update_wpforms_rest_post_settings($data)
	{
		if (defined('WPFORMS_INTERFACE_OPTION_SLUG')) {
			return update_option(WPFORMS_INTERFACE_OPTION_SLUG, $data);
		}
		return false;
	}
}
