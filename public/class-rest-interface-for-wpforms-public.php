<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://brandynlordi.com
 * @since      1.0.0
 *
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/public
 * @author     Brandyn Lordi <Brandyn.lordi@gmail.com>
 */
class Rest_Interface_For_Wpforms_Public
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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct($plugin_name, $version)
	{

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}


	/**
	 * Hook into the wpforms submit function and run our posts with cURL
	 *
	 * @since    1.0.0
	 */
	public function rest_interface_for_wpforms_submit_hook($fields,  $entry,  $form_id,  $form_data)
	{
		if (
			isset(Rest_Interface_For_Wpforms::get_rest_interface_for_wpforms_post_settings()->{$form_id}) // current form is enabled
			&& !empty(trim(Rest_Interface_For_Wpforms::get_rest_interface_for_wpforms_post_settings()->endpoint)) // endpoint is set 
		) {
			try {
				$ch = curl_init(Rest_Interface_For_Wpforms::get_rest_interface_for_wpforms_post_settings()->endpoint);
				curl_setopt($ch, CURLOPT_POST, 1);
				curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($entry));
				curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
				curl_setopt($ch, CURLOPT_HEADER, 0);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

				$resp = curl_exec($ch);
				curl_close($ch);
			} catch (\Exception $e) {
				error_log($e->getMessage());
			}
		}
	}
}