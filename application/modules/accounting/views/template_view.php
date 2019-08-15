<style type="text/css">
	.highlight {
		background-color: #29B4B6;
	}
	.spacerino {
		height: 30px;
	}
</style>
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Transaction Settings</span>
				</div>
				<div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Template
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered" id="tbl_masterlist">
					<thead>
						<tr>
							<th style="display: none;">Template ID</th>
							<th>Transaction Type</th>
							<!-- <th>Debit/Credit</th>
							<th>Account Code</th>
							<th>Remarks</th> -->
						</tr>
					</thead>
					<tbody>
						<?php foreach($records as $record) { ?>
							<tr>
								<td style="display: none;"><?= $record['transaction_template_id']; ?></td>
								<td><?= $record['transaction_type']; ?></td>
								<!-- <td><?= ($record['drcr'] == 'Dr')? 'Debit':'Credit'; ?></td>
								<td><?= $record['account_code']; ?></td>
								<td><?= $record['remarks']; ?></td> -->
							</tr>
						<?php } ?>
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
						<span class="caption-subject bold uppercase">Transaction Template Form</span>
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
									<div class="caption">
										Template Details
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">Transaction Type</label>
														<div class="col-md-9">
															<input type="text" name="transaction_type" id="transaction_type" autocomplete="off" class="form-control">
															<span id="err_transactiontype" style="color: red;"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="spacerino"></div>
										<div class="col-md-12">
											<table class="table" id="tbl_template">
												<thead>
													<tr>
														<th style="width: 15%;">ID</th>
														<th style="width: 20%;">Debit/Credit</th>
														<th style="width: 30%;">Account Code</th>
														<th style="width: 45%;">Remarks</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<td><input type="text" name="id[]" class="form-control id" disabled="disabled"></td>
														<td>
															<select name="drcr[]" class="form-control drcr">
																<option value="Dr">Debit</option>
																<option value="Cr">Credit</option>
															</select>
														</td>
														<td><input type="text" name="account_code[]" class="form-control account_code"></td>
														<td><input type="text" name="remarks[]" class="form-control remarks"></td>
													</tr>
												</tbody>
											</table>
										</div>
										<div class="col-md-12">
											<div class="col-md-1"></div>
											<div class="col-md-7">
												<div>
													<span>Focus on Remarks Field and Press Enter to Add New Line</span>
												</div>
												<div>
													<span>Focus on Remarks Field and Press Delete to Delete Line</span>
												</div>
											</div>
											<div class="col-md-4">
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
	</div>
</form>

<div style="" class="modal fade bs-modal-lg" id="frm_account" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Account Code</span>
					<button type="button" class="close" id="btn_closeaccount" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div>
				<div class="portlet light">
					<table class="table" id="tbl_accountcode">
						<thead>
							<tr>
								<th>Account Code</th>
								<th>Account Name</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($rec_accounts as $rec_account) { ?>
								<tr>
									<td><?= $rec_account['account_code']; ?></td>
									<td><?= $rec_account['account_name']; ?></td>
								</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
</div>