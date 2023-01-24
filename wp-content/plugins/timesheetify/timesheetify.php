<?php
/*
Plugin Name: Timesheet
Plugin URI:  https://Timesheet.com/plugins/
Description: Timesheet
Author: swarajya
Author URI: https://swarajya.com/
Version: 1.0.1
Text Domain: swarajya
Domain Path: /lang/
 */

defined( 'ABSPATH' ) or wp_die();

if ( ! defined( 'SWRJ_PLUGIN_URL' ) ) {
	define( 'SWRJ_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'SWRJ_PLUGIN_DIR_PATH' ) ) {
	define( 'SWRJ_PLUGIN_DIR_PATH', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'SWRJ_PLUGIN_BASENAME' ) ) {
	define( 'SWRJ_PLUGIN_BASENAME', plugin_basename( __FILE__ ) );
}

if ( ! defined( 'SWRJ_TMSHT_PLUGIN_FILE' ) ) {
	define( 'SWRJ_TMSHT_PLUGIN_FILE', __FILE__ );
}

final class swrj_Timesheetify_pro {
	private static $instance = null;

	private function __construct() {
		$this->initialize_hooks();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	private function initialize_hooks() {
		if ( is_admin() ) {
			require_once( 'admin/admin.php' );
		}
	}
}
swrj_Timesheetify_pro::get_instance();