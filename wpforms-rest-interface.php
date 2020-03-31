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
 * @since             1.0.0
 * @package           Wpforms_Rest_Interface
 *
 * @wordpress-plugin
 * Plugin Name:       WPforms REST interface
 * Plugin URI:        https://brandynlordi.com/shop/wordpress-plugins/wpforms-rest-interface/
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Brandyn Lordi
 * Author URI:        https://brandynlordi.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wpforms-rest-interface
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if (!defined('WPINC')) {
	die;
}

/**
 * Check if wpforms is installed, otherwise deactivate
 */
add_action('admin_init', 'wpforms_rest_interface_check_dependant_plugins');
function wpforms_rest_interface_check_dependant_plugins()
{
	// ? if we ever require more than one plugin, we can loop through them and display them in the notice?
	// ? we could display this information on the plugins page as well ?
	if (!is_plugin_active('wpforms-lite/wpforms.php') && !is_plugin_active('wpforms/wpforms.php')) {
		deactivate_plugins(plugin_basename(__FILE__), true);

		function wpforms_rest_interface_admin_notice__error()
		{
			$class = 'notice notice-error';
			$message = __('WPForms REST Interface has been deactivated because required plugins were not found.', 'sample-text-domain');

			printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr($class), esc_html($message));
		}
		add_action('admin_notices', 'wpforms_rest_interface_admin_notice__error');
	}
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define('WPFORMS_REST_INTERFACE_VERSION', '1.0.0');

/**
 * Define our wp_options table string identifier for updating
 */
define('WPFORMS_INTERFACE_OPTION_SLUG', 'wpforms_rest_interface_settings');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wpforms-rest-interface-activator.php
 */
function activate_wpforms_rest_interface()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-wpforms-rest-interface-activator.php';
	Wpforms_Rest_Interface_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wpforms-rest-interface-deactivator.php
 */
function deactivate_wpforms_rest_interface()
{
	require_once plugin_dir_path(__FILE__) . 'includes/class-wpforms-rest-interface-deactivator.php';
	Wpforms_Rest_Interface_Deactivator::deactivate();
}

register_activation_hook(__FILE__, 'activate_wpforms_rest_interface');
register_deactivation_hook(__FILE__, 'deactivate_wpforms_rest_interface');

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path(__FILE__) . 'includes/class-wpforms-rest-interface.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wpforms_rest_interface()
{

	$plugin = new Wpforms_Rest_Interface();
	$plugin->run();
}
run_wpforms_rest_interface();
