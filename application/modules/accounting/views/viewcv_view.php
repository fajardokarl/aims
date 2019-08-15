<style type="text/css">
	.spacerino {
		height: 10px;
	}
</style>

<form method="post" enctype="multipart/form-data" id="frm_information">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-green-sharp">
						<i class="fa fa-book font-green-sharp"></i>
						<span class="caption-subject bold uppercase">Check Voucher Form</span>
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
														<input type="text" name="check_voucher_id" id="check_voucher_id" class="form-control" tabindex="-1" disabled value="<?= $rec_cv['0']['check_voucher_id']; ?>" />
													</div>
													<div class="form-inline">
														<label style="width: 30%;">RIC ID</label>
														<input type="text" name="ric_id" id="ric_id" class="form-control" autocomplete="off" disabled value="<?= $rec_cv['0']['ric_id']; ?>" />
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-inline">
														<label style="width: 30%;">Date</label>
														<input type="text" name="check_voucher_date" id="check_voucher_date" class="form-control" tabindex="-1" disabled value="<?= substr($rec_cv['0']['check_voucher_date'], 0, 10); ?>">
													</div>
													<div class="form-inline">
														<label style="width: 30%;">Date of Check</label>
														<input type="text" name="check_date" id="check_date" class="form-control" disabled value="<?= substr($rec_cv['0']['check_date'],0,10); ?>" />
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
														<input type="text" name="bank_name" id="bank_name" class="form-control" disabled value="<?= $rec_cv['0']['bank_name'].': '.$rec_cv['0']['account_number']; ?>">
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-inline">
														<label style="width: 30%;">Reference #</label>
														<input type="text" name="reference_number" id="reference_number" class="form-control" style="width: 30%;" disabled value="<?= $rec_cv['0']['reference_number']; ?>" />
													</div>
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Payee</label>
													<input type="text" name="payee" id="payee" class="form-control" style="width: 300px;" disabled value="<?= $rec_cv['0']['payee']; ?>">
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Amount In Words</label>
													<input type="text" name="check_amount_words" id="check_amount_words" class="form-control" style="width: 80%;" disabled value="<?= $rec_cv['0']['check_amount_words']; ?>" />
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Amount</label>
													<input type="text" name="check_amount" id="check_amount" class="form-control" style="width: 300px;" disabled value="<?= $rec_cv['0']['check_amount']; ?>" />
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Received From</label>
													<input type="text" name="received_from" id="received_from" class="form-control" style="width: 300px;" disabled value="<?= $rec_cv['0']['received_from']; ?>" />
												</div>
											</div>
											<div class="form-inline">
												<div class="col-md-12">
													<label style="width: 14.6%;">Payment Type</label>
													<input type="text" name="payment_type" id="payment_type" class="form-control" style="width: 300px;" disabled value="<?= ucfirst($rec_cv['0']['payment_type']); ?>" />
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
														<?php foreach ($rec_cvdetails as $rec_cvdetail) { ?>
															<tr>
																<td><input type="text" name="cv_detail_id[]" class="form-control cv_detail_id" disabled value="<?= $rec_cvdetail['check_voucher_detail_id']; ?>" /></td>
																<td><input type="text" name="particular[]" class="form-control particular" disabled value="<?= $rec_cvdetail['particular']; ?>" /></td>
																<td><input type="text" name="amount[]" class="form-control amount" disabled value="<?= $rec_cvdetail['amount']; ?>" /></td>
															</tr>
														<?php } ?>
													</tr>
												</tbody>
											</table>
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
													<input type="text" name="prepared_by" id="prepared_by" class="form-control" style="width: 250px;" disabled value="<?= $rec_cv['0']['prepared']; ?>" />
												</div>
											</div>
											<div class="col-md-6">
												<?php if ($rec_actions) {
													switch ($rec_actions['0']['action_id']) {
														case '6': ?>
															<div class="form-inline">
																<label style="width: 20%;">Approved By</label>
																<input type="text" name="approved_by" id="approved_by" class="form-control" style="width: 250px;" disabled value="<?= $rec_actions['0']['employee_name']; ?>" />
															</div>
															<?php break;				
															default: ?>
															<div class="form-inline">
																<label style="width: 20%;">Approved By</label>
																<input type="text" name="approved_by" id="approved_by" class="form-control" style="width: 250px;" disabled />
															</div>
															<?php break;										
													}
												} else { ?>
													<div class="form-inline">
														<label style="width: 20%;">Approved By</label>
														<input type="text" name="approved_by" id="approved_by" class="form-control" style="width: 250px;" disabled />
													</div>
												<?php } ?>
											</div>
											<div class="form-inline">
												<button type="button" class="btn btn-circle red pull-right" id="btn_disapprove" style="width: 100px;">Disapprove</button>
												<button type="button" class="btn btn-circle green pull-right" id="btn_approve" style="width: 100px;">Approve</button>
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