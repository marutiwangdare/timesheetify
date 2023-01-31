<?php
defined('ABSPATH') or wp_die();
require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/helpers/timesheetify-helpers.php';
$action = '';
if (isset($_GET['action'])) {
    $action = sanitize_text_field($_GET['action']);
}
?>
  <?php
    require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/views/partials/header.php';

    if ($action == 'add') {
        require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/views/categories/add.php';
    } elseif ($action == 'edit') {
        require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/views/categories/edit.php';
    } else {
        require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/views/categories/view.php';
    }

    require_once SWRJ_PLUGIN_DIR_PATH . '/admin/inc/views/partials/footer.php';
    ?>

