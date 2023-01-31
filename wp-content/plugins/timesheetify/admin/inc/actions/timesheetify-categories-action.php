<?php
defined('ABSPATH') or wp_die();
require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/helpers/timesheetify-helpers.php';

class swrj_CategoriesActions
{

	/* Save categories */
	public static function swrj_save_categories()
	{
		if (!wp_verify_nonce($_REQUEST['swrj_save_categories_nounce'], 'swrj_save_categories')) {
			die();
		}


		$title      = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
		$is_active      = isset($_POST['is_active']) ? sanitize_text_field($_POST['is_active']) : '#0';

		/* validations */
		$message = '';
		if (empty($title)) {
			$message = esc_html__('Please enter title', 'timesheetify');
		}

		/* End validations */

		if (empty($message)) {

				$data = array(
					'title'         => $title,
					'is_active'       => $is_active,
				);
				$table_name = 'swrj_categories';
				$query      = swrj_Helper::swrj_insert_intoDB($table_name, $data);
				if ($query == true) {
					wp_send_json_success(array('message' => esc_html__('Category created successfully', 'timesheetify')));
				} else {
					wp_send_json_error(array('message' => esc_html__('Category not created successfully', 'timesheetify')));
				}
			
		}
		wp_send_json_error(array('message' => $message));
	}

	/* Edit categories */
	public static function swrj_edit_categories()
	{
		if (!wp_verify_nonce($_REQUEST['swrj_edit_categories_nounce'], 'swrj_edit_categories')) {
			die();
		}

		
		$title           = isset($_POST['title']) ? sanitize_text_field($_POST['title']) : '';
		$is_active      = isset($_POST['is_active']) ? sanitize_text_field($_POST['is_active']) : '#0';
		$id             = isset($_POST['id']) ? sanitize_text_field($_POST['id']) : '';

		/* validations */
		$message = '';
		if (empty($id)) {
			$message = esc_html__('Select User first', 'timesheetify');
		}

		/* End validations */

		if (empty($message)) {

				$data = array(
					'title'         => $title,
					'is_active'    => $is_active,
				);
				$where = array(
					'id' => $id
				);
				$table_name = 'swrj_categories';
				$query      = swrj_Helper::swrj_update_intoDB($table_name, $data, $where);

				if ($query == true) {
					wp_send_json_success(array('message' => esc_html__('Category edited successfully', 'timesheetify')));
				} else {
					wp_send_json_error(array('message' => esc_html__('Category not edited successfully', 'timesheetify')));
				}
			
		}
		wp_send_json_error(array('message' => $message));
	}

}
