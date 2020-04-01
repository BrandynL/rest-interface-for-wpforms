<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://brandynlordi.com
 * @since      1.0.0
 *
 * @package    Rest_Interface_For_Wpforms
 * @subpackage Rest_Interface_For_Wpforms/admin/partials
 */

/**
 * Handle the form submission and save settings
 */
if ($_SERVER['REQUEST_METHOD'] === 'POST' && !empty($_POST)) {
	if ($this->update_rest_interface_for_wpforms_post_settings($_POST)) { ?>
		<div class="notice notice-success">
			<p><?php printf(esc_html__('Update Successful!', 'WpAdminStyle')); ?></p>
		</div>
	<?php } else { ?>
		<div class="notice notice-danger">
			<p><?php printf(esc_html__('Unable to save settings!', 'WpAdminStyle')); ?></p>
		</div>
<?php }
}

/**
 * Use wpforms functionality to get all the forms
 */
$wpforms_forms = wpforms()->form->get('', []);
?>

<div class="wrap" style='padding:15px;'>
	<h2><?php _e('REST Interface for WPForms', 'WpAdminStyle'); ?></h2>
	<p><a href="https://github.com/BrandynL/rest-interface-for-wpforms" target="_blank">Contribute on Github!</a></p>
	<hr>
	<form action="" method="POST">

		<label for="endpoint">POST Endpoint</label> <br />
		<input type="url" class='large-text' name="endpoint" id="" value="<?= Rest_Interface_For_Wpforms::get_rest_interface_for_wpforms_post_settings()->endpoint ?? ''; ?>">

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
						<input type="checkbox" id="<?= $form->ID ?>" name="<?= $form->ID ?>" <?= isset(Rest_Interface_For_Wpforms::get_rest_interface_for_wpforms_post_settings()->{$form->ID}) ? "checked" : ''; ?>>
						<label for="<?= $form->ID ?>"><?= "{$form_settings->settings->form_title} (ID: {$form->ID})"; ?></label>
					</td>
				</tr>
			<?php } ?>
		</table>
		<button class=' button-primary' type="submit">Save Settings</button>
	</form>

</div>
</div>