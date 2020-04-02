<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://brandynlordi.com
 * @since             1.0.1
 * @package           Rest_Interface_For_Wpforms
 *
 * @wordpress-plugin
 * Plugin Name:       REST Interface for WPForms
 * Plugin URI:        https://brandynlordi.com/shop/wordpress-plugins/rest-interface-for-wpforms/
 * Description:       A GUI to Post WPforms form entry data to an endpoint of your choice on a per-form basis without writing any code.
 * Version:           1.0.2
 * Author:            Brandyn Lordi
 * Author URI:        https://brandynlordi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       rest-interface-for-wpforms
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Check if wpforms is installed, otherwise deactivate
 */
add_action('admin_init', 'rest_interface_for_wpforms_check_dependant_plugins');
function rest_interface_for_wpforms_check_dependant_plugins()
{
	// ? if we ever require more than one plugin, we can loop through them and display them in the notice?
	// ? we could display this information on the plugins page as well ?
	if (!is_plugin_active('wpforms-lite/wpforms.php') && !is_plugin_active('wpforms/wpforms.php')) {
		deactivate_plugins(plugin_basename(__FILE__), true);

		function rest_interface_for_wpforms_admin_notice__error()
		{
			$class = 'notice notice-error';
			$message = __('REST Interface for WPForms has been deactivated because required plugins were not found.', 'sample-text-domain');

			printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
		}
		add_action('admin_notices', 'rest_interface_for_wpforms_admin_notice__error');
	}
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('REST_INTERFACE_FOR_WPFORMS_VERSION', '1.0.2');

/**
 * Define our wp_options table string identifier for updating
 */
define('REST_INTERFACE_FOR_WPFORMS_OPTION_SLUG', 'rest_interface_for_wpforms_settings');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-rest-interface-for-wpforms-activator.php
 */
function activate_rest_interface_for_wpforms()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-rest-interface-for-wpforms-activator.php';
	Rest_Interface_For_Wpforms_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-rest-interface-for-wpforms-deactivator.php
 */
function deactivate_rest_interface_for_wpforms()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-rest-interface-for-wpforms-deactivator.php';
	Rest_Interface_For_Wpforms_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_rest_interface_for_wpforms');
register_deactivation_hook(__FILE__, 'deactivate_rest_interface_for_wpforms');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-rest-interface-for-wpforms.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_rest_interface_for_wpforms()
{

	$plugin = new Rest_Interface_For_Wpforms();
	$plugin->run();
}
run_rest_interface_for_wpforms();
