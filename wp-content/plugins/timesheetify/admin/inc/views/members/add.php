<?php
defined('ABSPATH') or wp_die();
?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1>Add Member</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo esc_url(admin_url('admin.php?page=timesheetify-pro-panel')); ?>">Dashboard</a></li>
						<li class="breadcrumb-item"><a href="<?php echo esc_url(admin_url('admin.php?page=timesheetify-pro-members')); ?>">members</a></li>
						<li class="breadcrumb-item active">Add Member</li>
					</ol>
				</div>
			</div>
		</div><!-- /.container-fluid -->
	</section>

	<!-- Main content -->
	<section class="content">
		<div class="row">
			<div class="col-md-12">
				<form id="AddMembersForm" method="post" action="<?php echo esc_url(admin_url('admin-ajax.php')); ?>">
					<?php $nonce = wp_create_nonce('swrj_save_members'); ?>
					<input type="hidden" name="swrj_save_members_nounce" value="<?php echo esc_attr($nonce); ?>">
					<input type="hidden" name="action" value="swrj_save_members_action">

					<div class="card card-primary">
						<div class="card-body">
							<p class="italic"><small>The field labels marked with * are required input fields.</small></p>
							<div class="row">
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputName">Name*</label>
										<input value="" name="firstname" type="text" class="form-control" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputName">User Name*</label>
										<input value="" name="username" type="text" class="form-control" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputName">Phone*</label>
										<input value="" name="phone" type="text" class="form-control" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputName">Email*</label>
										<input value="" name="email" type="text" class="form-control" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>Role*</label>
										<select class="form-control form-control-solid" name="role">
											<option value="user"><?php esc_html_e('user', 'timesheetify'); ?></option>
											<option value="manager"><?php esc_html_e('Manager', 'timesheetify'); ?></option>
											<option value="administrator"><?php esc_html_e('Adminstrator', 'timesheetify'); ?></option>
										</select>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label for="inputName">Password*</label>
										<input value="" name="password" type="text" class="form-control form-control-solid" autocomplete="off" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control form-control-solid" name="is_active">
                                            <option value="#0" ><?php esc_html_e('Inactive', 'timesheetify'); ?></option>
                                            <option value="#1" ><?php esc_html_e('Active', 'timesheetify'); ?></option>
                                        </select>
                                    </div>
								</div>
							</div>
						</div><!-- /.card-body -->
						<div class="card-footer">
							<div class="float-right">
								<!-- <button type="button" class="btn btn-default"><i class="fas fa-pencil-alt"></i> Draft</button>-->
								<button type="reset" class="btn btn-default"><a href="<?php echo esc_url(admin_url('admin.php?page=timesheetify-pro-members')); ?>"><i class="fas fa-times"></i> Back</a></button>
							</div>
							<button type="submit" class="btn btn-primary"><i class="fas fa-plus"></i> Save</button>
						</div>
						<!-- /.card -->
				</form>
			</div>
		</div>

	</section>
	<!-- /.content -->

</div>
<!-- /.content-wrapper -->