<?php
/* MailPoet integration for Layered Popups */
if (!defined('UAP_CORE') && !defined('ABSPATH')) exit;
class ulp_mailpoet_class {
	var $default_popup_options = array(
		'mailpoet_enable' => "off",
		'mailpoet_listid' => "",
		'mailpoet_email' => '{subscription-email}',
		'mailpoet_first_name' => '{subscription-name}',
		'mailpoet_last_name' => '',
		'mailpoet_fields' => array()
	);
	function __construct() {
		if (is_admin()) {
			add_action('ulp_popup_options_integration_show', array(&$this, 'popup_options_show'));
			add_filter('ulp_popup_options_check', array(&$this, 'popup_options_check'), 10, 1);
			add_filter('ulp_popup_options_populate', array(&$this, 'popup_options_populate'), 10, 1);
			add_filter('ulp_popup_options_tabs', array(&$this, 'popup_options_tabs'), 10, 1);
		}
		add_action('ulp_subscribe', array(&$this, 'subscribe'), 10, 2);
	}
	function popup_options_tabs($_tabs) {
		if (!array_key_exists("integration", $_tabs)) $_tabs["integration"] = __('Integration', 'ulp');
		return $_tabs;
	}
	function popup_options_show($_popup_options) {
		$popup_options = array_merge($this->default_popup_options, $_popup_options);
		echo '
				<h3>'.__('MailPoet Parameters', 'ulp').'</h3>
				<table class="ulp_useroptions">';
		if (class_exists('MailPoet\API\JSON\v1\Segments')) {
			$data = array(
				'offset' => 0,
				'limit' => 200,
				'group' => 'all',
				'search' => '',
				'sort_by' => 'name',
				'sort_order' => 'asc'
			);
			$endpoint = new MailPoet\API\JSON\v1\Segments;
			$response = $endpoint->listing($data);
			$mailpoet_lists = array();
			if ($response->status == 200 && is_array($response->data)) {
				foreach ($response->data as $list) {
					if ($list['type'] != 'wp_users') $mailpoet_lists[$list['id']] = $list['name'];
				}
			}
			if (sizeof($mailpoet_lists) == 0) {
				echo '
					<tr>
						<th>'.__('Enable MailPoet', 'ulp').':</th>
						<td>'.__('Please <a href="admin.php?page=mailpoet-segments">create</a> at least one list.', 'ulp').'</td>
					</tr>';
			} else {
				echo '
					<tr>
						<th>'.__('Enable MailPoet', 'ulp').':</th>
						<td>
							<input type="checkbox" id="ulp_mailpoet_enable" name="ulp_mailpoet_enable" '.($popup_options['mailpoet_enable'] == "on" ? 'checked="checked"' : '').'"> '.__('Submit contact details to MailPoet', 'ulp').'
							<br /><em>'.__('Please tick checkbox if you want to submit contact details to MailPoet.', 'ulp').'</em>
						</td>
					</tr>
					<tr>
						<th>'.__('List ID', 'ulp').':</th>
						<td>
							<select name="ulp_mailpoet_listid" class="ic_input_m">';
				foreach ($mailpoet_lists as $id => $name) {
					echo '
								<option value="'.$id.'"'.($id == $popup_options['mailpoet_listid'] ? ' selected="selected"' : '').'>'.esc_html($name).'</option>';
				}
				echo '
							</select>
							<br /><em>'.__('Select your List ID.', 'ulp').'</em>
						</td>
					</tr>';
				$endpoint = new MailPoet\API\JSON\v1\CustomFields;
				$response = $endpoint->getAll();
				echo '	
					<tr>
						<th>'.__('Fields', 'ulp').':</th>
						<td style="vertical-align: middle;">
							<div class="ulp-mailpoet-fields-html">
								'.__('Please adjust the fields below. You can use the same shortcodes (<code>{subscription-email}</code>, <code>{subscription-name}</code>, etc.) to associate MailPoet custom fields with the popup fields.', 'ulp').'
								<table style="min-width: 280px; width: 50%;">
									<tr>
										<td style="width: 120px;"><strong>'.__('E-mail', 'ulp').':</strong></td>
										<td>
											<input type="text" id="ulp_mailpoet_email" name="ulp_mailpoet_email" value="{subscription-email}" class="widefat" readonly="readonly" />
											<br /><em>'.__('E-mail address of the contact.', 'ulp').'</em>
										</td>
									</tr>
									<tr>
										<td style="width: 120px;"><strong>'.__('First Name', 'ulp').':</strong></td>
										<td>
											<input type="text" id="ulp_mailpoet_first_name" name="ulp_mailpoet_first_name" value="'.esc_html($popup_options['mailpoet_first_name']).'" class="widefat" />
											<br /><em>'.__('First Name of the contact.', 'ulp').'</em>
										</td>
									</tr>
									<tr>
										<td style="width: 120px;"><strong>'.__('Last Name', 'ulp').':</strong></td>
										<td>
											<input type="text" id="ulp_mailpoet_last_name" name="ulp_mailpoet_last_name" value="'.esc_html($popup_options['mailpoet_last_name']).'" class="widefat" />
											<br /><em>'.__('Last Name of the contact.', 'ulp').'</em>
										</td>
									</tr>';
						if ($response->status == 200 && is_array($response->data)) {		
							foreach ($response->data as $custom_field) {
								echo '
									<tr>
										<td style="width: 120px;"><strong>'.esc_html($custom_field['name']).':</strong></td>
										<td>
											<input type="text" id="ulp_mailpoet_field_'.esc_html($custom_field['id']).'" name="ulp_mailpoet_field_'.esc_html($custom_field['id']).'" value="'.(array_key_exists($custom_field['id'], $popup_options['mailpoet_fields']) ? esc_html($popup_options['mailpoet_fields'][$custom_field['id']]) : '').'" class="widefat" />
											<br /><em>'.esc_html($custom_field['name']).'</em>
										</td>
									</tr>';
							}
						}
						echo '
								</table>
							</div>
						</td>
					</tr>';
			}
		} else if (class_exists('WYSIJA')) {
			$model_list = WYSIJA::get('list', 'model');
			$mailpoet_lists = $model_list->get(array('name', 'list_id'), array('is_enabled'=>1));
			if (sizeof($mailpoet_lists) == 0) {
				echo '
					<tr>
						<th>'.__('Enable MailPoet', 'ulp').':</th>
						<td>'.__('Please <a href="admin.php?page=wysija_subscribers&action=lists">create</a> at least one list.', 'ulp').'</td>
					</tr>';
			} else {
				echo '
					<tr>
						<th>'.__('Enable MailPoet', 'ulp').':</th>
						<td>
							<input type="checkbox" id="ulp_mailpoet_enable" name="ulp_mailpoet_enable" '.($popup_options['mailpoet_enable'] == "on" ? 'checked="checked"' : '').'"> '.__('Submit contact details to MailPoet', 'ulp').'
							<br /><em>'.__('Please tick checkbox if you want to submit contact details to MailPoet.', 'ulp').'</em>
						</td>
					</tr>
					<tr>
						<th>'.__('List ID', 'ulp').':</th>
						<td>
							<select name="ulp_mailpoet_listid" class="ic_input_m">';
				foreach ($mailpoet_lists as $list) {
					echo '
								<option value="'.$list['list_id'].'"'.($list['list_id'] == $popup_options['mailpoet_listid'] ? ' selected="selected"' : '').'>'.esc_html($list['name']).'</option>';
				}
				echo '
							</select>
							<br /><em>'.__('Select your List ID.', 'ulp').'</em>
						</td>
					</tr>';
			}
		} else {
			echo '
					<tr>
						<th>'.__('Enable MailPoet', 'ulp').':</th>
						<td>'.__('Please install and activate <a target="_blank" href="http://wordpress.org/plugins/wysija-newsletters/">MailPoet Newsletters</a> plugin.', 'ulp').'</td>
					</tr>';
		
		}
		echo '
				</table>';
	}
	function popup_options_check($_errors) {
		global $ulp;
		$errors = array();
		$popup_options = array();
		foreach ($this->default_popup_options as $key => $value) {
			if (isset($ulp->postdata['ulp_'.$key])) {
				$popup_options[$key] = stripslashes(trim($ulp->postdata['ulp_'.$key]));
			}
		}
		if (isset($ulp->postdata["ulp_mailpoet_enable"])) $popup_options['mailpoet_enable'] = "on";
		else $popup_options['mailpoet_enable'] = "off";
		if ($popup_options['mailpoet_enable'] == 'on') {
			if (empty($popup_options['mailpoet_listid'])) $errors[] = __('Invalid MailPoet List ID.', 'ulp');
		}
		return array_merge($_errors, $errors);
	}
	function popup_options_populate($_popup_options) {
		global $ulp;
		$popup_options = array();
		foreach ($this->default_popup_options as $key => $value) {
			if (isset($ulp->postdata['ulp_'.$key])) {
				$popup_options[$key] = stripslashes(trim($ulp->postdata['ulp_'.$key]));
			}
		}
		if (isset($ulp->postdata["ulp_mailpoet_enable"])) $popup_options['mailpoet_enable'] = "on";
		else $popup_options['mailpoet_enable'] = "off";
		if (class_exists('MailPoet\API\JSON\v1\CustomFields')) {
			$endpoint = new MailPoet\API\JSON\v1\CustomFields;
			$response = $endpoint->getAll();
			$fields = array();
			if ($response->status == 200 && is_array($response->data)) {
				foreach($response->data as $custom_field) {
					if (isset($ulp->postdata['ulp_mailpoet_field_'.$custom_field['id']])) {
						$fields[$custom_field['id']] = stripslashes(trim($ulp->postdata['ulp_mailpoet_field_'.$custom_field['id']]));
					}
				}
			}
			$popup_options['mailpoet_fields'] = $fields;
		}
		
		return array_merge($_popup_options, $popup_options);
	}
	function subscribe($_popup_options, $_subscriber) {
		if (empty($_subscriber['{subscription-email}'])) return;
		$popup_options = array_merge($this->default_popup_options, $_popup_options);
		if (class_exists('MailPoet\Models\Subscriber')) {
			if ($popup_options['mailpoet_enable'] == 'on') {
				try {
					$user_data = array(
						'email' => $_subscriber['{subscription-email}'],
						'first_name' => strtr($popup_options['mailpoet_first_name'], $_subscriber),
						'last_name' => strtr($popup_options['mailpoet_last_name'], $_subscriber)
					);
					$endpoint = new MailPoet\API\JSON\v1\CustomFields;
					$response = $endpoint->getAll();
					if ($response->status == 200 && is_array($response->data)) {
						foreach($response->data as $custom_field) {
							if (array_key_exists($custom_field['id'], $popup_options['mailpoet_fields'])) $user_data['cf_'.$custom_field['id']] = strtr($popup_options['mailpoet_fields'][$custom_field['id']], $_subscriber);
						}
					}
					MailPoet\Models\Subscriber::subscribe($user_data, array($popup_options['mailpoet_listid']));
				} catch (Exception $e) {
				}
			}
		} else if (class_exists('WYSIJA')) {
			if ($popup_options['mailpoet_enable'] == 'on') {
				try {
					$user_data = array(
						'email' => $_subscriber['{subscription-email}'],
						'firstname' => $_subscriber['{subscription-name}'],
						'lastname' => '');
					$data_subscriber = array(
					  'user' => $user_data,
					  'user_list' => array('list_ids' => array($popup_options['mailpoet_listid']))
					);
					$helper_user = WYSIJA::get('user','helper');
					$helper_user->addSubscriber($data_subscriber);
				} catch (Exception $e) {
				}
			}
		}
	}
}
$ulp_mailpoet = new ulp_mailpoet_class();
?>