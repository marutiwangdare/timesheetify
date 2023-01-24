<?php
defined( 'ABSPATH' ) or wp_die();

/**
 *  Create Datatables for Clockify
 */
class swrj_InstallTables {
	
	public static function swrj_include_upgrade_file() {
		require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
	}

	public static function swrj_initiate_tables() {
		self::swrj_initiate_option_names();
        self::swrj_initiate_members_table();
		self::swrj_default_options();	
	}

	public static function swrj_initiate_option_names() {
		add_option( 'swrj_settings' );
		add_option( 'swrj_email_templates' );
		add_option( 'swrj_email_settings' );
	}
	public static function swrj_default_options() {
		$swrj_settings = array(
			'company_name'   => 'SWARAJYA',
			'company_logo'   => '',
			'date_format'    => '',
			'time_format'    => '',
			'items_per_page' => '3'
		);
		if ( empty ( $swrj_settings ) ) {
			update_option( 'swrj_settings', $swrj_settings );
		}
	}

    public static function swrj_table_exists( $table_name ) {
	   global $wpdb;
	   $table = $wpdb->get_var( "SHOW TABLES LIKE '$table_name'" );
	   return $table;
	}

	public static function swrj_table_column_exists( $table_name, $column_name ) {
	   global $wpdb;
	   $column = $wpdb->get_results( $wpdb->prepare(
	       "SELECT * FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_SCHEMA = %s AND TABLE_NAME = %s AND COLUMN_NAME = %s ",
	       DB_NAME, $table_name, $column_name
	   ) );
	   if ( ! empty( $column ) ) {
	       return true;
	   }
	   return false;
	}

	protected static function swrj_get_wp_charset_collate() {

		global $wpdb;
		$charset_collate = '';

		if ( ! empty ( $wpdb->charset ) )
			$charset_collate = "DEFAULT CHARACTER SET $wpdb->charset";

		if ( ! empty ( $wpdb->collate ) )
			$charset_collate .= " COLLATE $wpdb->collate";

		return $charset_collate;
	}

    public static function swrj_initiate_members_table() {
		global $wpdb;
		$charset_collate = self::swrj_get_wp_charset_collate();

		$table_name  = $wpdb->base_prefix . "swrj_members";
		$table_check = self::swrj_table_exists( $table_name );
		if ( empty ( $table_check ) ) {
			$wpdb->query(
				"CREATE TABLE IF NOT EXISTS `$table_name` (
				  `id` int(11) NOT NULL AUTO_INCREMENT,
				  `user_id` varchar(255) NOT NULL,
				  `name` varchar(255) NOT NULL,
				  `first_name` varchar(255) NOT NULL,
				  `last_name` varchar(255) NOT NULL,
				  `user_name` varchar(255) NOT NULL,
				  `notification` varchar(255) NOT NULL,
				  `email` varchar(255) NOT NULL,
				  `phone` varchar(255) NOT NULL,
				  `picture` varchar(255) NOT NULL,
				  `department` varchar(255) NOT NULL,
				  `job_title` varchar(255) NOT NULL,
				  `role` varchar(255) NOT NULL,
				  `facebook` varchar(255) NOT NULL,
				  `skype` varchar(255) NOT NULL,
				  `status` varchar(255) NOT NULL,
				  `address1` varchar(255) NOT NULL,
				  `address2` varchar(255) NOT NULL,
				  `city` varchar(255) NOT NULL,
				  `state` varchar(255) NOT NULL,
				  `country` varchar(255) NOT NULL,
				  `postcode` varchar(255) NOT NULL,
				 PRIMARY KEY (`id`)
				)$charset_collate;"
			);
		}
	}

}