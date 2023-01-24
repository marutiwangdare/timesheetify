<?php
defined('ABSPATH') or wp_die();
require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/helpers/timesheetify-helpers.php';

class swrj_MembersActions
{

	/* Save members */
	public static function swrj_save_members()
	{
		if (!wp_verify_nonce($_REQUEST['swrj_save_members_nounce'], 'swrj_save_members')) {
			die();
		}


		$firstname      = isset($_POST['firstname']) ? sanitize_text_field($_POST['firstname']) : '';
		$username       = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
		$phone          = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
		$email          = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
		$role           = isset($_POST['role']) ? sanitize_text_field($_POST['role']) : '';
		$is_active      = isset($_POST['is_active']) ? sanitize_text_field($_POST['is_active']) : 0;
		$password       = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';

		/* validations */
		$message = '';
		if (empty($firstname)) {
			$message = esc_html__('Please enter name', 'timesheetify');
		}
		if (empty($phone)) {
			$message = esc_html__('Please enter phone number', 'timesheetify');
		}
		if (empty($email)) {
			$message = esc_html__('Please enter user email', 'timesheetify');
		}
		if (empty($role)) {
			$message = esc_html__('Please enter user role', 'timesheetify');
		}
		if (empty($password)) {
			$message = esc_html__('Please enter user password', 'timesheetify');
		}

		/* End validations */

		if (empty($message)) {

			$user_exist = username_exists($username);

			if (!$user_exist && false == email_exists($email)) {
				$userdata        = array(
					'first_name'   => $firstname,
					'user_pass'    => $password,
					'user_login'   => $username,
					'user_email'   => $email,
					'display_name' => $firstname,
				);
				$user_id         = wp_insert_user($userdata);

				// On success.
				if (!is_wp_error($user_id)) {
					$message     = esc_html__('User created successfully. ', 'timesheetify');
					$status      = 'success';
				}
			} else {
				$message = esc_html__('User already exists. Please enter different email or username.', 'timesheetify');
				$status  = 'error';
			}

			if (isset($status) && !empty($status) && $status == 'success') {
				$data = array(
					'user_id'      => $user_id,
					'name'   => $firstname,
					'user_name'    => $username,
					'name'         => $firstname,
					'phone'        => $phone,
					'email'        => $email,
					'role'         => $role,
					'is_active'       => $is_active,
				);
				$table_name = 'swrj_members';
				$query      = swrj_Helper::swrj_insert_intoDB($table_name, $data);
				if ($query == true) {
					wp_send_json_success(array('message' => esc_html__('Member created successfully', 'timesheetify')));
				} else {
					wp_send_json_error(array('message' => esc_html__('Member not created successfully', 'timesheetify')));
				}
			} else {
				wp_send_json_error(array('message' => $message));
			}
		}
		wp_send_json_error(array('message' => $message));
	}

	/* Edit members */
	public static function swrj_edit_members()
	{
		if (!wp_verify_nonce($_REQUEST['swrj_edit_members_nounce'], 'swrj_edit_members')) {
			die();
		}

		$user_id        = isset($_POST['user_id']) ? sanitize_text_field($_POST['user_id']) : '';
		$firstname      = isset($_POST['firstname']) ? sanitize_text_field($_POST['firstname']) : '';
		$username       = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
		$phone          = isset($_POST['phone']) ? sanitize_text_field($_POST['phone']) : '';
		$email          = isset($_POST['email']) ? sanitize_text_field($_POST['email']) : '';
		$role           = isset($_POST['role']) ? sanitize_text_field($_POST['role']) : '';
		$is_active      = isset($_POST['is_active']) ? sanitize_text_field($_POST['is_active']) : 'inactive';
		$password       = isset($_POST['password']) ? sanitize_text_field($_POST['password']) : '';
		$id             = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

		/* validations */
		$message = '';
		if (empty($user_id)) {
			$message = esc_html__('Select User first', 'timesheetify');
		}
		if (empty($firstname)) {
			$message = esc_html__('Please enter name', 'timesheetify');
		}
		if (empty($phone)) {
			$message = esc_html__('Please enter phone number', 'timesheetify');
		}
		if (empty($email)) {
			$message = esc_html__('Please enter user email', 'timesheetify');
		}
		if (empty($role)) {
			$message = esc_html__('Please enter user role', 'timesheetify');
		}

		/* End validations */

		if (empty($message)) {

			$user_exist = get_userdata( $user_id );

			if ($user_exist) {
				$userdata = array(
					'ID' => $user_id,
					'first_name'   => $firstname,
					'user_login'   => $username,
					'user_email'   => $email,
					'display_name' => $firstname,
				);
				$update_user = wp_update_user($userdata);

				// On success.
				if (!is_wp_error($update_user)) {
					$message     = esc_html__('User edited successfully. ', 'timesheetify');
					$status      = 'success';
				}
			} else {
				$message = esc_html__('invalid user id.', 'timesheetify');
				$status  = 'error';
			}

			if (isset($status) && !empty($status) && $status == 'success') {
				$data = array(
					'name'   	   => $firstname,
					'user_name'    => $username,
					'name'         => $firstname,
					'phone'        => $phone,
					'email'        => $email,
					'role'         => $role,
					'is_active'    => $is_active,
				);
				$where = array(
					'id' => $id
				);
				$table_name = 'swrj_members';
				$query      = swrj_Helper::swrj_update_intoDB($table_name, $data, $where);

				if ($query == true) {
					wp_send_json_success(array('message' => esc_html__('Member edited successfully', 'projectify')));
				} else {
					wp_send_json_error(array('message' => esc_html__('Member not edited successfully', 'projectify')));
				}
			} else {
				wp_send_json_error(array('message' => $message));
			}
		}
		wp_send_json_error(array('message' => $message));
	}

}
