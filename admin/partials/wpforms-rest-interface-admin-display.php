<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://brandynlordi.com
 * @since      1.0.0
 *
 * @package    Wpforms_Rest_Interface
 * @subpackage Wpforms_Rest_Interface/admin/partials
 */

/**
 * Handle the form submission and save settings
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && $_POST['endpoint']) {
	$this->update_wpforms_rest_post_settings(json_encode($_POST));
	ob_start(); ?>
	<div class="notice notice-success">
		<p><?php printf(esc_html__('Update Successful!', 'WpAdminStyle')); ?></p>
	</div>
<?= ob_get_clean();
}

/**
 * Get the previously saved settings
 */
// $wpforms_rest_interface_settings = json_decode(get_option('wpforms_rest_interface_settings'));

/**
 * Use wpforms functionality to get all the forms
 */
$wpforms_forms = wpforms()->form->get('', []);
?>

<div class="wrap" style='padding:15px;'>
	<h2><?php _e('WPForms Rest Interface', 'WpAdminStyle'); ?></h2>
	<p><a href="https://github.com/BrandynL/wpforms-rest-interface" target="_blank">Contribute on Github!</a></p>
	<hr>
	<form action="" method="POST">

		<label for="endpoint">POST Endpoint</label> <br />
		<input type="url" class='large-text' name="endpoint" id="" value="<?= Wpforms_Rest_Interface::get_wpforms_rest_interface_post_settings()->endpoint; ?>">

		<table class="form-table">
			<tr>
				<th><?php esc_attr_e('Forms Enabled', 'WpAdminStyle'); ?></th>
			</tr>
			<?php
			foreach ($wpforms_forms as $form) {
				$form_settings = json_decode($form->post_content);
			?>
				<tr valign="top">
					<td>
						<input type="checkbox" id="<?= $form->ID ?>" name="<?= $form->ID ?>" <?= isset(Wpforms_Rest_Interface::get_wpforms_rest_interface_post_settings()->{$form->ID}) ? "checked" : ''; ?>>
						<label for="<?= $form->ID ?>"><?= "{$form_settings->settings->form_title} (ID: {$form->ID})"; ?></label>
					</td>
				</tr>
			<?php } ?>
		</table>
		<button class=' button-primary' type="submit">Save Settings</button>
	</form>

</div>
</div>