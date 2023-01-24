<?php
defined( 'ABSPATH' ) or wp_die();
require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/helpers/timesheetify-helpers.php';

class swrj_ExtrasActions {

	/* Deactivate Entities*/
	public static function swrj_deactivate_entities() {
		check_ajax_referer( 'swrj_ajax_nonce', 'nounce' );

		if ( ! empty ( $_POST['table'] ) && ! empty ( $_POST['id'] ) ) {
			$table_name = sanitize_text_field( $_POST['table'] );
			$id    = sanitize_text_field( $_POST['id'] );
			$data  = array( 'is_active' => '#0' );
			$where = array(
				'id' => $id
			);
			$query = swrj_Helper::swrj_deactivate_intoDB($table_name, $data, $where);

			if ( $query == true ) {
				$message = esc_html__( 'Data Deactivated successfully.', 'timesheetify' );
				$status  = 'success';
			} else {
				$message = esc_html__( 'Data not Deactivated successfully.', 'timesheetify' );
				$status  = 'error';
				$url     = '';
			}
		} else {
			$message = esc_html__( 'Something went wrong!.', 'timesheetify' );
			$status  = 'error';
		}
		$return = array(
			'status'  => $status,
			'message' => $message,
		);
		wp_send_json( $return );
		wp_die();
	}
}