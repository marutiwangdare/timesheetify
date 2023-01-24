<?php
defined('ABSPATH') or wp_die();
require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/helpers/timesheetify-helpers.php';

/**
 *  Menu class to add menu panels
 */
class swrj_AdminMenu {
	
	function __construct() {

		/* Action for creating menu pages */
		add_action( 'admin_menu', array( 'swrj_AdminMenu', 'swrj_create_menu' ) );
		add_action( 'admin_menu', array( 'swrj_AdminMenu', 'swrj_team_member_menu' ) );
	}

	public static function swrj_create_menu() {

		$dashboard = add_menu_page( esc_html__( 'Timesheetify Lite', 'timesheetify' ), esc_html__( 'Timesheetify Lite', 'timesheetify' ), 'manage_options', 'timesheetify-pro-panel', array(
			'swrj_AdminMenu',
			'swrj_dashboard'
		), 'dashicons-portfolio', 25 );
		add_action( 'admin_print_styles-' . $dashboard, array( 'swrj_AdminMenu', 'swrj_dashboard_assets' ) );

		$dashboard1 = add_submenu_page( 'timesheetify-pro-panel', esc_html__( 'Timesheetify Lite', 'timesheetify' ), esc_html__( 'Dashboard', 'timesheetify' ), 'manage_options', 'timesheetify-pro-panel', array(
			'swrj_AdminMenu',
			'swrj_dashboard'
		) );
		add_action( 'admin_print_styles-' . $dashboard1, array( 'swrj_AdminMenu', 'swrj_dashboard_assets' ) );

		$members = add_submenu_page( 'timesheetify-pro-panel', esc_html__( 'Members', 'timesheetify' ), esc_html__( 'Members', 'timesheetify' ), 'manage_options', 'timesheetify-pro-members', array(
			'swrj_AdminMenu',
			'swrj_members'
		) );
		add_action( 'admin_print_styles-' . $members, array( 'swrj_AdminMenu', 'swrj_dashboard_assets' ) );

    }
	public static function swrj_team_member_menu() {
    	/*$user_id = get_current_user_id();
		$members = btpjy_Helper::btpjy_member_info( $user_id );
		if ( ! empty( $members ) ) {
			$dashboard1 = add_submenu_page( 'projectify-pro-panel', esc_html__( 'Dashboarda', 'projectify' ), esc_html__( 'Dashboard', 'projectify' ), 'subscriber', 'projectify-pro-panel-member-dashboard', array(
				'btpjy_AdminMenu',
				'btpjy_teammember_dashboard'
			) );
			add_action( 'admin_print_styles-' . $dashboard1, array( 'btpjy_AdminMenu', 'btpjy_dashboard_assets' ) );
		}*/
    }

    public static function swrj_dashboard() {
        require_once( 'timesheetify-dashboard-panel.php' );
    }
    public static function swrj_teams() {
		require_once( 'timesheetify-teams-panel.php' );
    }
	public static function swrj_members() {
		require_once( 'timesheetify-members-panel.php' );
    }

    public static function swrj_dashboard_assets() {
        self::swrj_enqueue_libraries();
		self::swrj_enqueue_custom_assets();
    }

    public static function swrj_enqueue_libraries() {

        /* Enqueue styles */
		//wp_enqueue_style( 'adminlte', SWRJ_PLUGIN_URL . 'assets/dist/css/adminlte.min.css');
       
		
        /* Enqueue Scripts */
		//wp_enqueue_script( 'jquery' );
		//wp_enqueue_media();
		wp_enqueue_script( 'jquery-form' );
		//wp_enqueue_script( 'moment-2.24.0', BTPJL_PLUGIN_URL . 'assets/js/moment.min.js', array( 'jquery' ), true, true );
		//wp_enqueue_script( 'adminlte', SWRJ_PLUGIN_URL . 'assets/dist/js/adminlte.min.js', array( 'jquery' ), true, true );

    }

    public static function swrj_enqueue_custom_assets() {
        wp_enqueue_style( 'swrj-custom-style', SWRJ_PLUGIN_URL . 'admin/css/admin-style.css' );
		wp_enqueue_script( 'swrj-custom-script', SWRJ_PLUGIN_URL . 'admin/js/admin-script.js' );
		wp_localize_script( 'swrj-custom-script', 'ajax_admin', array(
            'ajax_url'    => admin_url( 'admin-ajax.php' ),
            'swrj_nonce' => wp_create_nonce( 'swrj_ajax_nonce' ),
        ));
    }
}

new swrj_AdminMenu();