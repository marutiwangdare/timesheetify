<?php
defined('ABSPATH') or wp_die();
$page = isset($_GET['cpage']) ? abs((int) $_GET['cpage']) : 1;
$items_per_page =  get_option('swrj_settings')['items_per_page'];
$search = isset($_GET['search']) ? trim($_GET['search']): '';
$data = swrj_Helper::swrj_get_categories($items_per_page, $page, $search);
$categories_list = $data['categories_list'];
$total = $data['total'];

?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper" style="margin-left: 0px;margin-left: -20px;">
	<!-- Content Header (Page header) -->
	<div class="content-header">
		<div class="container-fluid">
			<div class="row mb-2">
				<div class="col-sm-6">
					<h1 class="m-0">Categories</h1>
				</div><!-- /.col -->
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item"><a href="<?php echo esc_url(admin_url('admin.php?page=timesheetify-pro-panel')); ?>">Dashboard</a></li>
						<li class="breadcrumb-item active">Categories</li>
					</ol>
				</div><!-- /.col -->
			</div><!-- /.row -->
		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content-header -->

	<!-- Main content -->
	<div class="content">
		<div class="container-fluid">
			<div class="row">
				<div class="col-12">
					<div class="card">
						<div class="card-header">
							<h3 class="card-title"></h3>

							<a href="<?php echo esc_url(add_query_arg('action', 'add', admin_url('admin.php?page=timesheetify-pro-categories'))); ?>">
								<button type="button" class="btn btn-primary float-left"><i class="fas fa-plus"></i> Add New</button>
							</a>

							<div class="card-tools">
								<form role="search" autocomplete="off" action="" method="get">
									<input type='hidden' name='page' value='timesheetify-pro-categories'>
									<div class="input-group input-group-sm" style="width: 150px;">
										<input type="text" name="search" class="form-control float-right" placeholder="Search" value="<?php echo $search ?>">

										<div class="input-group-append">
											<button type="submit" class="btn btn-default">
												<i class="fas fa-search"></i>
											</button>
										</div>
									</div>
								</form><!-- form -->

							</div>
						</div>
						<!-- /.card-header -->
						<div class="card-body">


							<table id="datatable" class="table table-bordered table-striped">
								<thead>
									<tr>
										<th>S No. #</th>
										<th>Title</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									foreach ($categories_list as $mkey => $category) {
									?>

										<tr>
											<td><?php echo esc_attr($category->id); ?></td>
											<td><?php echo esc_attr($category->title); ?></td>
											<td>
												<?php if ($category->is_active=='#1') { ?>
													<div class="badge badge-success">Active</div>
												<?php } else { ?>
													<div class="badge badge-danger">Inactive</div>
												<?php } ?>
											</td>
											<td>
												<div class="btn-group">
													<button type="button" class="btn btn-default">Action</button>
													<button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
														<span class="sr-only">Toggle Dropdown</span>
													</button>
													<div class="dropdown-menu" role="menu">
														<a class="dropdown-item" href="<?php echo esc_url(
																							add_query_arg(
																								array(
																									'action'  => 'edit',
																									'category_id' => $category->id,
																								),
																								admin_url('admin.php?page=timesheetify-pro-categories')
																							)
																						); ?>">
															<i class="fas fa-pencil-alt"></i>&nbsp Edit
														</a>
														<a class="dropdown-item deactivate-entities" data-table="swrj_categories" data-id="<?php echo esc_attr( $category->id ); ?>" href="#">
															<i class="fas fa-trash" type="submit"></i>&nbsp Deactivate
														</a>
													</div>
												</div>
											</td>
										</tr>

									<?php } ?>

								</tbody>
								<tfoot>
									<tr>
										<th>S No. #</th>
										<th>Title</th>
										<th>Status</th>
										<th>Action</th>
									</tr>
								</tfoot>
							</table>
						</div>
						<!-- /.card-body -->
						<div class="card-footer">
							<?php 
								echo "Total $total entries"
							?>
							<div class="float-right">
								<?php
								 //Get the paginated links
								 swrj_Helper::swrj_get_pagination($total,$items_per_page,$page);
								?>
							</div>
						</div>
					</div>
					<!-- /.card -->
				</div>
				<!-- /.col -->
			</div>
			<!-- /.row -->

		</div><!-- /.container-fluid -->
	</div>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->