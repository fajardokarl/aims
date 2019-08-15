<style type="text/css">
	input::-webkit-outer-spin-button, input::-webkit-inner-spin-button{
		-webkit-appearance:none;
		margin:0;
	}
	.spacerino {
		height: 10px;
	}
	.highlight{
		background-color: #29B4B6;
	}

</style>
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase"></span>Check Voucher
				</div>
				<div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Check Voucher
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<div class="form-group">
					<div class="form-inline">
						Date Start:
						<input type="text" class="form-control" id="startdate">
						Date End:
						<input type="text" class="form-control" id="enddate">
						<button type="button" id="btn_searchrange" class="btn btn-default green">Search Range</button>
					</div>
				</div>
				<table class="table table-hover table-bordered" id="tbl_masterlist">
					<thead>
						<tr>
							<th>CV ID</th>
							<th>RIC ID</th>
							<th>Bank</th>
							<th>Reference Number</th>
							<th>Payee</th>
							<th>Check Amount</th>
							<th>Payment Type</th>
							<th>Prepared By</th>
							<th>CV Date</th>
							<th>Check Date</th>
						</tr>
					</thead>
					<tbody>
						<!-- <?php foreach ($records as $record) { ?>
							<tr>
								<td><?= $record['check_voucher_id']; ?></td>
								<td><?= $record['ric_id']; ?></td>
								<td><?= $record['bank_name']; ?></td>
								<td><?= $record['reference_number']; ?></td>
								<td><?= $record['payee']; ?></td>
								<td><?= $record['check_amount']; ?></td>
								<td><?= ucfirst($record['payment_type']); ?></td>
								<td><?= $record['prepared']; ?></td>
								<td><?= $record['check_voucher_date']; ?></td>
								<td><?= $record['check_date']; ?></td>
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
						<span class="caption-subject bold uppercase">Check Voucher Form</span>
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
									<div class="caption">Header</div>
								</div>		
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">

											<input type="hidden" name="user_employee_id" id="user_employee_id" value="<?= $this->session->userdata('employee_id'); ?>">

											<h3 id="h3_actionstatus" class="center" style="color: red; text-align: center; font-weight: bold;"></h3>
											
											<div class="form-inline">
												<div class="col-md-6">
													<div class="form-inline">
														<label style="width: 30%;">Check Voucher ID</label>
														<input type="text" name="check_voucher_id" id="check_voucher_id" class="form-control" tabindex="-1" disabled>
													</div>
													<div class="form-inline">
														<label style="width: 30%;">RIC ID</label>
														<input type="text" name="ric_id" id="ric_id" class="form-control" autocomplete="off">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-inline">
														<label style="width: 30%;">Date</label>
														<input type="text" name="check_voucher_date" id="check_voucher_date" class="form-control" tabindex="-1" disabled>
													</div>
													<div class="form-inline">
														<label style="width: 30%;">Date of Check</label>
														<input type="text" name="check_date" id="check_date" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="spacerino"></div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-inline">
												<div class="col-md-6">
													<div class="form-inline">
														<label style="width: 30%;">Bank</label>
														<select name="bank_id" id="bank_id" class="form-control" style="width: 300px;">
															<option value="0" selected>Select Bank</option>
															<?php foreach ($rec_banks as $rec_bank) { ?>
																<option value="<?= $rec_bank['bank_id']; ?>"><?= $rec_bank['bank_name'].': '.$rec_bank['account_number']; ?></option>
															<?php } ?>
														</select>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-inline">
														<label style="width: 30%;">Check Book #</label>
														<input type="text" name="reference_number" id="reference_number" class="form-control" style="width: 300px;">
													</div>
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Payee</label>
													<input type="hidden" name="payee_table" id="payee_table">
													<input type="hidden" name="payee_id" id="payee_id">
													<input type="text" name="payee" id="payee" class="form-control" style="width: 300px;">
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Amount In Words</label>
													<input type="text" name="check_amount_words" id="check_amount_words" class="form-control" style="width: 80%;">
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Amount</label>
													<input type="number" name="check_amount" id="check_amount" class="form-control" style="width: 300px;">
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Received From</label>
													<input type="text" name="received_from" id="received_from" class="form-control" style="width: 300px;">
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Payment Type</label>
													<select name="payment_type" id="payment_type" class="form-control" style="width: 300px;">
														<option value="full">Full</option>
														<option value="partial">Partial</option>
													</select>
												</div>
											</div>
										</div>
									</div>
								</div>						
							</div>
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">Detail</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-bordered" id="tbl_cvdetail">
												<thead>
													<tr>
														<th style="width: 10%;">Detail ID</th>
														<th>Particular</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled></td>
														<td><input type="text" name="particular[]" class="form-control particular" disabled></td>
														<td><input type="text" name="amount[]" class="form-control amount" disabled></td>
													</tr>
												</tbody>
											</table>
										</div>
									</div>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-11">
											<span>Focus on Amount Field and Press Enter to Add New Line</span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-1"></div>
										<div class="col-md-11">
											<span>Focus on Amount Field and Press Delete to Remove Line</span>
										</div>
									</div>
								</div>
							</div>
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">Verification</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<div class="col-md-6">
												<div class="form-inline">
													<label style="width: 20%;">Prepared By</label>
													<select name="prepared_by" id="prepared_by" class="form-control" style="width: 250px;">
														<?php foreach ($rec_employees as $rec_employee) { ?>
															<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee']; ?></option>
														<?php } ?>
													</select>
												</div>												
											</div>
											<div class="col-md-6">
												<div class="form-inline">
													<label style="width: 20%;">Approved By</label>
													<select name="approved_by" id="approved_by" class="form-control" style="width: 250px;">
														<option value="0" selected></option>
														<?php foreach ($rec_employees as $rec_employee) { ?>
															<option value="<?= $rec_employee['employee_id']; ?>"><?= $rec_employee['employee'];?></option>
														<?php } ?>
													</select>
												</div>
											</div>
											<div class="form-inline">
												<button type="button" class="btn btn-circle red pull-right" id="btn_disapprove" style="width: 110px;">Disapprove</button>
												<button type="button" class="btn btn-circle green pull-right" id="btn_approve" style="width: 100px;">Approve</button>
												<button type="button" class="btn btn-circle green pull-right" id="btn_save" style="width: 100px">Submit</button>
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
	</div>
</form>

<div style="" class="modal fade bs-modal-lg" id="mdl_ricid" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
						<span class="caption-subject bold uppercase">RIC Register</span>
						<button type="button" class="close" id="btn_closeric" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div>
				<div class="portlet light">
					<div class="row">
						<div class="col-md-12">
							<table class="table table-bordered" id="tbl_ric">
								<thead>
									<tr>
										<th>RIC ID</th>
										<th>Employee</th>
										<th>Department</th>
										<th>Date</th>
									</tr>
								</thead>
								<tbody>
									<?php foreach ($rec_ric as $rec_ric) { ?>
										<tr>
											<td><?= $rec_ric['ric_id']; ?></td>
											<td><?= $rec_ric['employee']; ?></td>
											<td><?= $rec_ric['department_name']; ?></td>
											<th><?= $rec_ric['ric_date']; ?></th>
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