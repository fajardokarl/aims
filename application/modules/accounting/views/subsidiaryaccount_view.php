<style type="text/css">
	.highlight{
		background-color: #29B4B6;
	}
</style>
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="tabbable-line tabbable-full-width">
				<ul class="nav nav-tabs" id="taberino">
					<li class="active">
						<a href="#tab_customer" data-toggle="tab">Customers</a>
					</li>
					<li class="">
						<a href="#tab_department" data-toggle="tab">Departments</a>
					</li>
					<li class="">
						<a href="#tab_employee" data-toggle="tab">Employees</a>
					</li>
					<li class="">
						<a href="#tab_supplier" data-toggle="tab">Suppliers</a>
					</li>
					<li class="">
						<a href="#tab_project" data-toggle="tab">Projects</a>
					</li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="tab_customer">
						<table class="table" id="tbl_customer">
							<thead>
								<tr>
									<th style="width: 15%;">Customer ID</th>
									<th style="width: 15%;">Subsidiary Code</th>
									<th style="width: 55%;">Customer Name</th>
									<th style="width: 15%;">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($rec_customers as $rec_customer) { ?>
									<tr>
										<td><?= $rec_customer['client_id']; ?></td>
										<td><?= $rec_customer['subsidiary_code']; ?></td>
										<td><?= $rec_customer['customer_name']; ?></td>
										<td><?= ucfirst($rec_customer['status_name']); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="tab_department">
						<table class="table" id="tbl_department">
							<thead>
								<tr>
									<th style="width: 15%;">Department ID</th>
									<th style="width: 15%;">Subsidiary Code</th>
									<th style="width: 55%;">Department</th>
									<th style="width: 10%;">Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($rec_departments as $rec_department) { ?>
									<tr>
										<td><?= $rec_department['department_id']; ?></td>
										<td><?= $rec_department['activity_code']; ?></td>
										<td><?= $rec_department['department_name']; ?></td>
										<td><?= ucfirst($rec_department['status_name']); ?></td>
									</tr>
							  <?php } ?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="tab_supplier">
						<table class="table" id="tbl_supplier">
							<thead>
								<tr>
									<th >Supplier ID</th>
									<th >Subsidiary Code</th>
									<th >Supplier Name</th>
									<th>Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($rec_suppliers as $rec_supplier) { ?>
									<tr>
										<td><?= $rec_supplier['supplier_id']; ?></td>
										<td><?= $rec_supplier['subsidiary_code']; ?></td>
										<td><?= $rec_supplier['supplier_name']; ?></td>
										<td><?= ucfirst($rec_supplier['status_name']); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="tab_employee">
						<table class="table" id="tbl_employee">
							<thead>
								<tr>
									<th >Employee ID</th>
									<th >Subsidiary Code</th>
									<th >Employee Name</th>
									<th >Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($rec_employees as $rec_employee) { ?>
									<tr>
										<td><?= $rec_employee['employee_id']; ?></td>
										<td><?= $rec_employee['subsidiary_code']; ?></td>
										<td><?= $rec_employee['employee_name']; ?></td>
										<td><?= ucfirst($rec_employee['status_name']); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="tab-pane" id="tab_project">
						<table class="table" id="tbl_project">
							<thead>
								<tr>
									<th >Project ID</th>
									<th >Subsidiary Code</th>
									<th >Project Name</th>
									<th >Status</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($rec_projects as $rec_project) { ?>
									<tr>
										<td><?= $rec_project['project_id']; ?></td>
										<td><?= $rec_project['subsidiary_code']; ?></td>
										<td><?= $rec_project['project_name']; ?></td>
										<td><?= ucfirst($rec_project['status_name']); ?></td>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<form method="post" enctype="multipart/form-data" id="frm_information" style="display: none;">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-green-sharp">
						<i class="fa fa-book font-green-sharp"></i>
						<span class="caption-subject bold uppercase">Update Subsidiary Code</span>
					</div>
					<div class="actions">  
						<button type="button" class="btn btn-circle btn-default" id="btn_back">
							<i class="fa fa-arrow-left"></i>Back
						</button>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">Subsidiary Information</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">ID</label>
														<div class="col-md-9">
															<input type="text" name="record_id" id="record_id" class="form-control" readonly="readonly" tabindex="-1">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Name</label>
														<div class="col-md-9">
															<input type="text" name="name" id="name" class="form-control" readonly="readonly" tabindex="-1">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Subsidiary Code</label>
														<div class="col-md-9">
															<input type="text" name="subsidiary_code" id="subsidiary_code" class="form-control" style="text-transform: uppercase;" autocomplete="off">
														</div>
														<span id="error_msg" style="color: red;"></span>
													</div>
												</div>
											</div>
											<button type="button" class="btn btn-circle green pull-right" id="btn_save" style="width: 100px;">Save</button>
											
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>