<?php
defined('ABSPATH') or wp_die();

/**
 *  Helper class
 */
class swrj_Helper
{

	public static function swrj_sanitize_array($input)
	{
		// Initialize the new array that will hold the sanitize values		
		$new_input = array();

		// Loop through the input and sanitize each of the values		
		foreach ($input as $key => $val) {
			$new_input[$val['name']] = sanitize_text_field($val['value']);
		}
		return $new_input;
	}

	public static function swrj_value_check($value)
	{
		if (!empty($value)) {
			return $value;
		}
	}

	public static function swrj_insert_intoDB($table_name, $data)
	{
		global $wpdb;
		$table        = $wpdb->base_prefix . '' . $table_name;
		$result_check = $wpdb->insert($table, $data);
		if ($result_check) {
			return true;
		} else {
			return false;
		}
	}

	public static function swrj_update_intoDB($table_name, $data, $where)
	{
		global $wpdb;
		$table        = $wpdb->base_prefix . '' . $table_name;
		$result_check = $wpdb->update($table, $data, $where);

		if ($result_check) {
			return true;
		} else {
			return false;
		}
	}

	public static function swrj_deactivate_intoDB($table_name, $data, $where)
	{
		global $wpdb;
		$table        = $wpdb->base_prefix . '' . $table_name;
		$result_check = $wpdb->update($table, $data, $where);

		if ($result_check) {
			return true;
		} else {
			return false;
		}
	}

	public static function swrj_delete_intoDB($table_name, $data)
	{
		return true;
		global $wpdb;
		$table        = $wpdb->base_prefix . '' . $table_name;
		$result_check = $wpdb->delete($table, $data);
		if ($result_check) {
			return true;
		} else {
			return false;
		}
	}

	public static function swrj_get_members($items_per_page, $page, $search)
	{
		global $wpdb;
		$members_table = $wpdb->base_prefix . "swrj_members";
		$offset = ($page * $items_per_page) - $items_per_page;

		if ($search != '') 
		{
			$where = "WHERE  name LIKE '%$search%' or user_name  LIKE '%$search%' or email LIKE '%$search%' or phone LIKE '%$search%' or role  LIKE '%$search%' or is_active  LIKE '%$search%'";
			$total = $wpdb->get_var("SELECT COUNT(id) FROM $members_table $where");
			$members_data = $wpdb->get_results("SELECT * FROM $members_table $where ORDER BY ID DESC LIMIT $offset, $items_per_page");
			
		} else 
		{
			$total = $wpdb->get_var("SELECT COUNT(id) FROM $members_table ");
			$members_data = $wpdb->get_results("SELECT * FROM $members_table ORDER BY ID DESC LIMIT $offset, $items_per_page");
		}
        
		$data = array("total" => $total, 'members_list' => $members_data, 'search' => $search);

		return $data;
	}

	public static function swrj_member_info($id)
	{
		global $wpdb;
		$table  = $wpdb->base_prefix . "swrj_members";
		$data   = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %s", $id));
		return $data;
	}

	public static function swrj_get_categories($items_per_page, $page, $search)
	{
		global $wpdb;
		$categories_table = $wpdb->base_prefix . "swrj_categories";
		$offset = ($page * $items_per_page) - $items_per_page;

		if ($search != '') 
		{
			$where = "WHERE  title LIKE '%$search%' or is_active  LIKE '%$search%'";
			$total = $wpdb->get_var("SELECT COUNT(id) FROM $categories_table $where");
			$categories_data = $wpdb->get_results("SELECT * FROM $categories_table $where ORDER BY ID DESC LIMIT $offset, $items_per_page");
			
		} else 
		{
			$total = $wpdb->get_var("SELECT COUNT(id) FROM $categories_table ");
			$categories_data = $wpdb->get_results("SELECT * FROM $categories_table ORDER BY ID DESC LIMIT $offset, $items_per_page");
		}
        
		$data = array("total" => $total, 'categories_list' => $categories_data, 'search' => $search);

		return $data;
	}

	public static function swrj_category_info($id)
	{
		global $wpdb;
		$table  = $wpdb->base_prefix . "swrj_categories";
		$data   = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %s", $id));
		return $data;
	}

	public static function swrj_get_departments($items_per_page, $page, $search)
	{
		global $wpdb;
		$departments_table = $wpdb->base_prefix . "swrj_departments";
		$offset = ($page * $items_per_page) - $items_per_page;

		if ($search != '') 
		{
			$where = "WHERE  title LIKE '%$search%' or is_active  LIKE '%$search%'";
			$total = $wpdb->get_var("SELECT COUNT(id) FROM $departments_table $where");
			$departments_data = $wpdb->get_results("SELECT * FROM $departments_table $where ORDER BY ID DESC LIMIT $offset, $items_per_page");
			
		} else 
		{
			$total = $wpdb->get_var("SELECT COUNT(id) FROM $departments_table ");
			$departments_data = $wpdb->get_results("SELECT * FROM $departments_table ORDER BY ID DESC LIMIT $offset, $items_per_page");
		}
        
		$data = array("total" => $total, 'departments_list' => $departments_data, 'search' => $search);

		return $data;
	}

	public static function swrj_department_info($id)
	{
		global $wpdb;
		$table  = $wpdb->base_prefix . "swrj_departments";
		$data   = $wpdb->get_row($wpdb->prepare("SELECT * FROM $table WHERE id = %s", $id));
		return $data;
	}

	public static function swrj_get_pagination($total, $items_per_page, $page)
	{

		$lists = paginate_links(array(
			'base' => add_query_arg('cpage', '%#%'),
			'format' => '',
			'type'         => 'array',
			'prev_text' => __('&laquo;'),
			'next_text' => __('&raquo;'),
			'total' => ceil($total / $items_per_page),
			'current' => $page
		));
		$html='';
		if (is_array($lists)) {

			$html = '<nav><ul class="pagination justify-content-center">';

			foreach ($lists as $list) {
				$html .= '<li class="page-item' . (strpos($list, 'current') !== false ? ' active' : '') . '"> ' . str_replace('page-numbers', 'page-link text-dark', $list) . '</li>';
			}

			$html .= '</ul></nav>';
		}
		echo $html;
	}

	public static function swrj_get_date_format()
	{
		$savesetting = get_option('btpjy_settings');

		if (!empty($savesetting)) {
			$date_format  = $savesetting['date_format'];

			if (!empty($date_format)) {
				return $date_format;
			} else {
				return 'F j Y';
			}
		} else {
			return 'F j Y';
		}
	}

	public static function swrj_get_formated_date($date)
	{
		return date(self::swrj_get_date_format(), strtotime($date));
	}

	public static function swrj_get_time_format()
	{
		$savesetting = get_option('swrj_settings');

		if (!empty($savesetting)) {

			$time_format  = $savesetting['time_format'];
			if (!empty($time_format)) {
				return $time_format;
			} else {
				return 'g:i A';
			}
		} else {
			return 'g:i A';
		}
	}

	public static function swrj_get_formated_time($time)
	{
		return date(self::swrj_get_time_format(), strtotime($time));
	}
}
