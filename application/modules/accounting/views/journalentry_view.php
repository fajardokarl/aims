<style type="text/css">
	.table-fixed thead{ width: 100%; }
	.table-fixed tbody{
		height: 300px;
		overflow-y: auto;
		width: 100%;
	}
	.table-fixed thead, .table-fixed tbody, .table-fixed tr, .table-fixed td, .table-fixed th{
		display: block;
	}
	.table-fixed tbody td, .table-fixed thead > tr > th{
		float: left;
		border-bottom-width: 0;
	}
	.highlight{
		background-color: #29B4B6;
	}
	.debit, .credit{
		text-align: right;
	}
	input::-webkit-outer-spin-button, input::-webkit-inner-spin-button{
		-webkit-appearance:none;
		margin:0;
	}
</style>
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Journal Entries</span>
				</div>
				<div class="actions">
					<button style="align:right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Journal Entry
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-group">
					<div class="form-inline">
						Date Start:
						<input class="form-control" type="text" id="datepicker">
						Date End:
						<input class="form-control" type="text" id="datepicker2">
						<button type="button" id="btn_searchrange" class="btn btn-default green">Search Range</button>
					</div>
				</div>
				<table class="table table-hover table-bordered" id="tbl_masterlist">
					<thead>
						<tr>
							<th>ID</th>
							<th>Book Prefix</th>
							<th>Reference</th>
							<th>Subsidiary</th>
							<th>Remarks</th>
							<th>Date Created</th>
							<th>Post Status</th>
							<th>Post Date</th>
							<th>Locked</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach ($records as $record) { ?>
							<tr>
								<td><?= $record['transaction_id']; ?></td>
								<td><?= $record['book_prefix']; ?></td>
								<td><?= $record['reference']; ?></td>
								<td><?= $record['subsidiary_name']; ?></td>
								<td><?= $record['remarks']; ?></td>
								<td><?= ($record['encode_date'] == '0000-00-00 00:00:00')? 'Not Yet': $record['encode_date']; ?></td>
								<td><?= ucfirst($record['post_status']); ?></td>
								<td><?= ($record['post_date'] == '0000-00-00 00:00:00')? 'Not Yet': $record['post_date'] ; ?></td>
								<td><?= ucfirst($record['is_locked']); ?></td>
							</tr>
						<?php } ?> -->
					</tbody>
				</table>
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
						<i class="fa fa-book font-green-sharp" ></i>
						<span class="caption-subject bold uppercase">Accounting Entry Form</span>
					</div>
					<div class="actions">
						<button type="button" class="btn btn-circle btn-default" id="btn_back">
							<i class="fa fa-arrow-left"></i>Back
						</button>
					</div>
				</div>
				<div class="portlet-body"> 
						<div class="row">
							<div class="panel panel-success">
								<div class="panel-heading">Document References</div>
								<div class="panel-body">
									<div class="row">


										<input id="user_id" name="user_id" type="hidden" value="<?= $this->session->userdata('user_id'); ?>">
										<input id="userdepartment_id" name="userdepartment_id" type="hidden" value="<?= $this->session->userdata('department_id'); ?>">
										<input id="transaction_id" name="transaction_id" type="hidden">
										<input id="post_status" name="post_status" type="hidden">
										<input id="book_id" name="book_id" type="hidden">
										<input id="subsidiary_table" name="subsidiary_table" type="hidden">
										<input id="sub_code" name="sub_code" type="hidden">
										<input id="date_now" name="date_now" type="hidden">
										<input id="is_locked" name="is_locked" type="hidden">

										<div class="col-md-3">
											<label>Book Register</label>
											<div class="form-inline">
												<input id="book_code" name="book_code" class="form-control input-sm" type="text" style="width: 25%; text-transform: uppercase" autocomplete="off">
												<input id="book_description" type="text" class="form-control input-sm" style="width: 70%;" readonly="readonly">
											</div>
											<span id="bookcode_error" style="color: red;"></span>
										</div>
										<div class="col-md-6">
											<div class="form-group">
													<label>Reference #:</label>
												<div class="form-inline">
													<input id='reference_code' name="reference_code" type="text" class="form-control input-sm " style="width: 15%;">
													<input id='reference_number' name='reference_number' type="text" class="form-control input-sm" style="width: 50%;">
													<label style="width: 12%; text-align: right;">Post Date:</label>
													<input id="post_date" name="post_date" tabindex='-1' type="text" class="form-control input-sm" style="width:20%;">
												</div>
											</div>
											<div class="form-group">
												<div class="form-inline">
													<label style="width: 15%;">Subsidiary:</label>
													<input id="department" name="department" type="text" class="form-control input-sm" name="" style="width: 80%;" autocomplete="off">
												</div>
												<span id="department_error" style="color: red;"></span>
											</div>
										</div>
										<div class="col-md-3">
											<label>Remarks</label>
											<textarea id="remarks" name="remarks" rows="3" class="form-control input-sm"></textarea>
										</div>
									</div>
								</div>
							</div>
						</div>	
						<div class="row">
							<div class="panel panel-success">
								<div class="panel-heading">Account Details</div>
								<div class="panel-body">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-hover table-bordered table-striped" id="tbl_transactiondetail">
												<thead>
													<tr>
														<th style="visibility: hidden;"></th>
														<th style="width: 7%;">Account Code</th>
														<th style="width: 15%;">Account Description</th>
														<th style="width: 7%;">Subsidiary</th>
														<th style="width: 15%;">Subsidiary Description</th>
														<th style="width: 10%;">Debit</th>
														<th style="width: 10%;">Credit</th>
														<th style="width: 30%;">Remarks</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td style="visibility: hidden;"><input type="hidden" class="transaction_detail_id" id="transaction_detail_id" name="transaction_detail_id[]"></td>
														<td ><input type="text" class="form-control input-sm account-code" id="account_code" name="account_code[]"></td>
														<td ><input type="text" class="form-control input-sm" id="account_description" readonly="readonly" tabindex="-1"></td>
														<td ><input type="text" class="form-control input-sm subsidiary-code" id="subsidiary_code" name="subsidiary_code[]"></td>
														<td ><input type="text" class="form-control input-sm" id="subsidiary_description" readonly="readonly" tabindex="-1"></td>
														<td ><input type="number" class="form-control input-sm debit" id="debit" name="debit[]"></td>
														<td ><input type="number" class="form-control input-sm credit" id="credit" name="credit[]"></td>
														<td rowspan="1"><textarea rows="1" class="form-control detail-remarks" id="detail_remarks" name="detail_remarks[]"></textarea></td>
													</tr>
												</tbody>
											</table>	
										</div>
									</div>
									<div class="row">
										<div class="col-md-4">
												<label>Total Debits / Credits:</label>
										</div>
										<div class="col-md-5">
											<div class="form-inline">
												<input id="txt_debit" type="text" class="form-control" style="width: 150px; text-align: right;" placeholder="0.00" readonly="readonly" tabindex="-1">
												<input id="txt_credit" type="text" class="form-control" style="width: 150px; text-align: right;" placeholder="0.00" readonly="readonly" tabindex="-1">
											</div>
										</div>
										<div class="col-md-3">
												<input id="txt_total" type="text" class="form-control" style="width: 150px; text-align: right;" placeholder="0.00" readonly="readonly" tabindex="-1">
										</div>
									</div>
								</div>
								<div class="panel-footer">
									<div class="row">
										<div class="col-md-4">
											<button id="btn_post" type="button" class="btn btn-circle green" style="width: 120px">Post</button>
											<button id="btn_save" type="button" class="btn btn-circle" style="width: 120px">Save</button>
										</div>
										<div class="col-md-8">
											<div class="row">
												<label>Focus on Account Detail Remark Field and Press Enter to Add New Line Account Detail</label>
											</div>
											<div class="row"> 
												<label>Focus on Account Detail Remark Field and Press Delete to Erase Selected Line Account Detail</label>
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

<div style="" class="modal fade bs-modal-lg" id="frm_bookregister" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Book Register</span>
					<button type="button" class="close" id="btn_closebook" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div>
				<div class="portlet light">
					<div class="form-inline">
						<label>Search:</label>
						<input type="text" id="txt_searchbook" class="form-control" style="width: 50%" name="">
					</div>
					<table class="table table-fixed" id="tbl_bookregister">
						<thead>
							<tr>
								<th class="col-xs-4">Book ID</th>
								<th class="col-xs-6">Book Name</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rec_books as $rec_book) { ?>
								<tr>
									<td class="col-xs-4"><?= $rec_book['book_code']; ?></td>
									<td class="col-xs-6"><?= $rec_book['book_description']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="" class="modal fade bs-modal-lg" id="frm_activitycenter" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
					<button type="button" class="close" id="btn_closeactivity" tabindex="-1" data-dismiss="modal"></button>
			</div>
			<div>
				<div class="portlet light">
					<div class="tabbable-line tabbable-full-width">
						<ul class="nav nav-tabs" id="taberino">
							<li class="active" id="tab1">
								<a href="#tab_customer" data-toggle="tab" >Customers</a>
							</li>
							<li class="" id="tab2">
								<a href="#tab_department" data-toggle="tab" >Department</a>
							</li>
							<li class="" id="tab3">
								<a href="#tab_employee" data-toggle="tab" >Employees</a>
							</li>
							<li class="" id="tab4">
								<a href="#tab_supplier" data-toggle="tab" >Suppliers</a>
							</li>
							<li class="" id="tab5">
								<a href="#tab_project" data-toggle="tab" >Projects</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tab_customer">
								<table class="table" id="tbl_customer">
									<thead>
										<tr>
											<th>Sub Code</th>
											<th>Customer Name</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rec_customers as $rec_customer) { ?>
											<tr>
												<td><?= $rec_customer['subsidiary_code']; ?></td>
												<td><?= $rec_customer['customer_name']; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="tab_department">
								<table class="table" id="tbl_department">
									<thead>
										<tr>
											<th>Sub Code</th>
											<th>Department</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rec_departments as $rec_department) { ?>
											<tr>
												<td><?= $rec_department['activity_code']; ?></td>
												<td><?= $rec_department['department_name']; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="tab_supplier">
								<table class="table" id="tbl_supplier">
									<thead>
										<tr>
											<th class="col-xs-4">Sub Code</th>
											<th class="col-xs-6">Supplier Name</th>
										</tr>
									</thead>
									<tbody>
										 <?php foreach ($rec_suppliers as $rec_supplier) { ?>
											<tr>
												<td class="col-xs-4"><?= $rec_supplier['subsidiary_code']; ?></td>
												<td class="col-xs-6"><?= $rec_supplier['supplier_name']; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="tab_employee">
								<table class="table" id="tbl_employee">
									<thead>
										<tr>
											<th class="col-xs-4">Sub Code</th>
											<th class="col-xs-6">Employee Name</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rec_employees as $rec_employee) { ?>
											<tr>
												<td class="col-xs-4"><?= $rec_employee['subsidiary_code']; ?></td>
												<td class="col-xs-6"><?= $rec_employee['employee_name']; ?></td>
											</tr>
										<?php } ?>
									</tbody>
								</table>
							</div>
							<div class="tab-pane" id="tab_project">
								<table class="table" id="tbl_project">
									<thead>
										<tr>
											<th class="col-xs-4">Sub Code</th>
											<th class="col-xs-6">Project Name</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rec_projects as $rec_project) { ?>
											<tr>
												<td class="col-xs-4"><?= $rec_project['subsidiary_code']; ?></td>
												<td class="col-xs-6"><?= $rec_project['project_name']; ?></td>
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
	</div>
</div>

<div style="" class="modal fade bs-modal-lg" id="frm_account" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp" ></i>
					<span class="caption-subject bold uppercase">Account Code</span>
					<button type="button" class="close" id="btn_closeaccount" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div>
				<div class="portlet light">
					<div class="form-inline">
						<label>Search:</label>
						<input type="text" id="txt_searchaccount" class="form-control" style="width: 50%">
					</div>
					<table class="table table-fixed" id="tbl_accountcode">
						<thead>
							<tr>
								<th class="col-xs-6">Account Code</th>
								<th class="col-xs-6">Account Name</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rec_accounts as $rec_account) { ?>
								<tr>
									<td class="col-xs-6"><?= $rec_account['account_code']; ?></td>
									<td class="col-xs-6"><?= $rec_account['account_name']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="" class="modal fade bs-modal-lg" id="frm_subsidiary" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Subsidiary Code</span>
					<button type="button" class="close" id="btn_closesub" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div class="portlet light">
				<div class="form-inline">
					<label>Search:</label>
					<input type="text" id="txt_searchsub" class="form-control" style="width:50%" name="">
				</div>
				<table class="table table-fixed" id="tbl_subsidiary">
					<thead>
						<tr>
							<th class="col-xs-6">Subsidiary Code</th>
							<th class="col-xs-6">Subsidiary Name</th>
						</tr>
					</thead>
					<tbody>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>