<style type="text/css">
	input::-webkit-outer-spin-button, input::-webkit-inner-spin-button{
		-webkit-appearance:none;
		margin:0;
	}
	.amount{
		text-align: right;
	}
	.error-msg{
		color:red;
	}
	.spacerino {
		height: 10px;
	}
	.spacerino-hor {
		width: 10px;
	}
	.borderless td, .borderless th {
		border: 0px !important;
	}
	.highlight {
		background-color: #29B4B6;
	}
</style>
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Request of Issuance of Check</span>
				</div>
				<div class="actions">
					<button style="align:right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Request
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-group">
					<div class="form-inline">
						Date Start:
						<input type="text" id="startdate" class="form-control">
						Date End:
						<input type="text" id="enddate" class="form-control">
						<button type="button" id="btn_searchrange" class="btn btn-default green">Search Range</button>
					</div>
				</div>
				<table class="table table-hover table-bordered" id="tbl_masterlist">
					<thead>
						<tr>
							<th>ID</th>
							<th>Employee</th>
							<th>Date</th>
							<th>Department</th>
							<th>Purpose</th>
							<th>Prepared By</th>
							<th>Requested By</th>
							<th>Status Update</th>
							<th>Cancelled</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach ($records as $record) { ?>
							<tr>
								<td><?= $record['ric_id']; ?></td>
								<td><?= $record['employee']; ?></td>
								<td><?= substr($record['ric_date'], 0,10); ?></td>
								<td><?= $record['department']; ?></td>
								<td><?= $record['purpose']; ?></td>
								<td><?= $record['prepared']; ?></td>
								<td><?= $record['requested']; ?></td>
								<td><?= $record['verified']; ?></td>
								<td><?= $record['approved']; ?></td>
								<td><?= $record['action_status']; ?></td>
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
						<i class="fa fa-book font-green-sharp"></i>
						<span class="caption-subject bold uppercase">Request of Issuance of Check Form</span>
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
							<input type="hidden" name="user_id" id="user_id" value="<?= $this->session->userdata('user_id'); ?>">
							<input type="hidden" name="user_employee_id" id="user_employee_id" value="<?= $this->session->userdata('employee_id'); ?>">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<!-- <i class="fa fa-gift"></i> -->
										Header
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<h3 id="is_cancelled" class="center" style="color: red; text-align: center; font-weight: bold;"></h3>
											<div class="form-inline">
												<div class="col-md-4">
													<div class="form-inline">
															<label>ID</label>
															<input type="text" name="ric_id" id="ric_id" class="form-control" tabindex="-1">	
													</div>
												</div>
												<div class="col-md-4"></div>
												<div class="col-md-4">
													<div class="form-inline">
														<label>Date</label>
														<input type="text" name="ric_date" id="ric_date" class="form-control" tabindex="-1">
													</div>
												</div>
											</div>
										</div>
									</div>	
									<div class="row">
										<div class="col-md-6">
											<div class="form-inline">
												<label style="width: 20%">Employee</label>		
												<select name="employee_id" id="employee_id" class="form-control" style="width: 300px">
													<option value="0" selected>Select Employee</option>
													<?php foreach ($rec_employees as $rec_employee) { ?>
														<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee'];?></option>
													<?php } ?>
												</select> 
											</div>
											<div class="form-inline">
												<label style="width: 20%">Department</label>
												<select name="department_id" id="department_id" class="form-control" style="width: 300px" >
													<option value="0" selected>Department</option>
													<?php foreach ($rec_departments as $rec_department) { ?>
														<option value="<?= $rec_department['department_id']; ?>"><?= $rec_department['department_name'];?></option>
													<?php } ?>
												</select> 
											</div>
										</div>
										<div class="col-md-6">
												<label>Purpose</label>
												<input type="text" name="purpose" id="purpose" class="form-control" autocomplete="off">
										</div>
									</div>
								</div>
							</div>

							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<!-- <i class="fa fa-gift"></i> -->
										Details
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<table class="table" id="tbl_ricdetail">
												<thead>
													<tr>
														<th style="width: 10%;">Detail ID</th>
														<th>Particular</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input type="text" name="ric_detail_id[]" class="form-control ric_detail_id" disabled></td>
														<td><input type="text" name="particular[]" class="form-control particular" autocomplete="off"></td>
														<td><input type="number" name="amount[]" class="form-control amount" autocomplete="off"></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="row">
											<div class="col-md-1"></div>
											<span class="col-md-11">Focus on Amount Field and Press Enter to Add New Line</span>
										</div>
										<div class="row">
											<div class="col-md-1"></div>
											<span class="col-md-11">Focus on Amount Field and Press Delete to Remove Line</span>
										</div>
									</div>
								</div>
							</div>

							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<!-- <i class="fa fa-gift"></i> -->
										Attachments
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-inline">
													<label>File</label>
													<input type="file" name="attachment_file" id="attachment_file" class="form-control" form="upload_form">
													<button type="submit" class="btn btn-circle green" name="btn_upload" id="btn_upload" form="upload_form">Upload</button>
											</div>
											<span style="color: red;" id="attachment_error"></span><br/>
											<span style="color:orange;">PDF Files Only</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<table id="tbl_attachment" class="table">
												<thead>
													<tr>
														<th style="width: 20%;">Attachment ID</th>
														<th>Filename</th>
														<th style="width: 10%;">View</th>
														<th style="width: 10%;">Action</th>
													</tr>
												</thead>
												<tbody>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										<!-- <i class="fa fa-gift"></i> -->
										Verification
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-inline">
												<label style="width: 20%;">Requested By</label>
												<select name="requested_by" id="requested_by" class="form-control" style="width: 300px">
													<option value="0" selected>Select Employee</option>
													<?php foreach ($rec_employees as $rec_employee) { ?>
														<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee'];?></option>
													<?php } ?>
												</select> 
											</div>
											<div class="form-inline">
												<label style="width: 20%;">Prepared By</label>
												<select name="prepared_by" id="prepared_by" class="form-control" style="width: 300px">
													<option value="0" selected>Select Employee</option>
													<?php foreach ($rec_employees as $rec_employee) { ?>
														<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee'];?></option>
													<?php } ?>
												</select> 
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-inline">
												<label style="width: 20%;">Verified By</label>
												<select name="verified_by" id="verified_by" class="form-control" style="width: 300px">
													<option value="0" selected> </option>
													<?php foreach ($rec_employees as $rec_employee) { ?>
														<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee'];?></option>
													<?php } ?>
												</select> 
											</div>
											<div class="form-inline">
												<label style="width: 20%;">Approved By</label>
												<select name="approved_by" id="approved_by" class="form-control" style="width: 300px">
													<option value="0" selected> </option>
													<?php foreach ($rec_employees as $rec_employee) { ?>
														<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee'];?></option>
													<?php } ?>
												</select> 
											</div>
										</div>
											
									</div>
									<div class="spacerino"></div>
									<div class="row">
										<div class="col-md-12">
											<button type="button" class="btn btn-circle red pull-right" id="btn_cancel" style="width: 150px;">Cancel Request</button>
											<button type="button" class="btn btn-circle red pull-right" id="btn_disapprove" style="width: 110px;">Disapprove</button>
											<button type="button" class="btn btn-circle green pull-right" id="btn_approve">Approve</button>
											<button type="button" class="btn btn-circle red pull-right" id="btn_deny" style="width: 100px;">Deny</button>
											<button type="button" class="btn btn-circle green pull-right" id="btn_verify" style="width: 100px;">Verify</button>
											<button type="button" class="btn btn-circle green pull-right" id="btn_save" style="width: 100px;">Submit</button>
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

<form method="post" id="upload_form" enctype="multipart/form-data"></form>

<div style="" class="modal fade bs-modal-lg" id="mdl_attachmentview" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Attachment</span>
					<button type="button" class="close" id="btn_closeattachment" data-dismiss="modal"></button>
				</div>
			</div>
			<div>
				<div class="portlet light">
					<div>
						<!-- <iframe id="ifr_attachment" style="height: 200px;"></iframe> -->
						<object type="application/pdf" id="ifr_attachment" style="height: 470px; width: 100%;"></object>  
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

