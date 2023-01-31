<?php
defined( 'ABSPATH' ) or wp_die();

require_once( 'inc/controllers/timesheetify-menu-panel.php' );
require_once( 'inc/controllers/timesheetify-install-tables.php' );
require_once( 'inc/actions/timesheetify-extras-action.php' );
require_once( 'inc/actions/timesheetify-members-action.php' );
require_once( 'inc/actions/timesheetify-categories-action.php' );
require_once( 'inc/actions/timesheetify-departments-action.php' );


/* Action for creating data tables */
add_action( 'init', array( 'swrj_InstallTables', 'swrj_initiate_tables' ) );

/**-------------------------------------------------------------Members-------------------------------------------------------------**/
/* Add Members */
add_action( 'wp_ajax_swrj_save_members_action', array( 'swrj_MembersActions', 'swrj_save_members' ) );

/* Edit Members */
add_action( 'wp_ajax_swrj_edit_members_action', array( 'swrj_MembersActions', 'swrj_edit_members' ) );

/**-------------------------------------------------------------Categories-------------------------------------------------------------**/
/* Add Categories */
add_action( 'wp_ajax_swrj_save_categories_action', array( 'swrj_CategoriesActions', 'swrj_save_categories' ) );

/* Edit Categories */
add_action( 'wp_ajax_swrj_edit_categories_action', array( 'swrj_CategoriesActions', 'swrj_edit_categories' ) );

/**-------------------------------------------------------------Departments-------------------------------------------------------------**/
/* Add Departments */
add_action( 'wp_ajax_swrj_save_departments_action', array( 'swrj_DepartmentsActions', 'swrj_save_departments' ) );

/* Edit Departments */
add_action( 'wp_ajax_swrj_edit_departments_action', array( 'swrj_DepartmentsActions', 'swrj_edit_departments' ) );

/**-------------------------------------------------------------Extra-------------------------------------------------------------**/
/* Deactivate Entities */
add_action( 'wp_ajax_swrj_deactivate_entities_action', array( 'swrj_ExtrasActions', 'swrj_deactivate_entities' ) );