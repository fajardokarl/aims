<style type="text/css">
.highlight{
		background-color: #29B4B6;
	}

.modcenter {
  left: 50%;
  top: 50%;
  transform: translate(-50%, -50%);
}
</style>
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Chart of Accounts</span>
				</div>
				<div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Account
					</button>
					<!-- <button style="align: right;" type="button" class="btn btn-circle red" id="btn_delete" disabled="disabled">
						Delete Account
					</button> -->
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered " id="tbl_masterlist">
					<thead>
						<tr>
							<th>Account ID</th>
							<th>Account Code</th>
							<th>Account Name</th>
							<th style="width: 10%;">Status</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($records as $record) { ?>
							<tr>
								<td><?= $record['account_id']; ?></td>
								<td><?= $record['account_code']; ?></td>
								<td><?= $record['account_name']; ?></td>
								<td><button <?php switch ($record['status_id']) {
									case '1':
										echo " class='btn btn-circle btn-xs green status_action'>active";
										break;
									case '3':
										echo " class='btn btn-circle btn-xs red status_action'>suspended";
										break;
								} ?>
								</button></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<div style="" class="modal fade modal-sm modcenter" id="frm_status" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Action</span>
					<button type="button" class="close" id="btn_closestatus" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div class="portlet light">
				<form action="<?=base_url()?>Accounting/Account/changeStatus" method="post">
					<div class="form-group">
						<input type="hidden" name="mod_accountid" id="mod_accountid">
						<input type="hidden" name="mod_statusid" id="mod_statusid">
						<button type="submit" id="btn_changestatus" class="form-control"></button>
					</div>
					<div class="form-group">
						<button type="button" class="btn btn-circle grey form-control" data-dismiss="modal">Close</button>
					</div>
				</form>
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
						<span class="caption-subject bold uppercase">Chart of Accounts Form</span>
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
										Main Account
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-4">
											<input type="hidden" name="account_id" id="account_id">
											<div class="form-group">
												<label>Account Code</label>
												<input type="text" name="account_code" id="account_code" class="form-control" autocomplete="off" required>
												<span id="code_error" style="color: red;"></span>
											</div>
										</div>
										<div class="col-md-8">
											<div class="form-group">
												<label>Account Name</label>
												<input type="text" name="account_name" id="account_name" class="form-control" required>
												<span id="name_error" style="color: red;"></span>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										Sub Account
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<table class="table table-hover table-bordered table-striped" id="tbl_subaccount">
												<thead>
													<tr>
														<th style="width: 20%;">Subsidiary ID</th>
														<th style="width: 20%;">Subsidiary Code</th>
														<th style="width: 45%;">Subsidiary Description</th>
														<th style="width: 15%;">Status</th>
													</tr>
												</thead>
												<tbody>
													
												</tbody>
											</table>
											<span id="code_error2"></span>
										</div>
									</div>
									<div class="row">
										<div class="col-md-2"></div>
										<div class="col-md-6">
											<div class="row">
												<label>Set Focus to Subsidiary Description Field and Press Enter to Add New Line</label>
											</div>
										</div>
										<div class="col-md-4">
											<button id="btn_save" type="button" class="btn btn-circle green pull-right" style="width: 120px;">Save</button>
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