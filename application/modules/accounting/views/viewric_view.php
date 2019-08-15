<style type="text/css">
	.spacerino {
		height: 10px;
	}
</style>
<form method="post" enctype="multipart/form-data" id="frm_action">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-12">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">Information</div>
								</div>
								<div class="portlet-body">
									<h3 id="h3_cancelled" class="center" style="color: red; text-align: center; font-weight: bold;"></h3>
									<input type="hidden" name="is_cancelled" id="is_cancelled" value="<?= $rec_ric['0']['is_cancelled'];?>">
									<input type="hidden" name="action_status" id="action_status" value="<?= $rec_ric['0']['action_status'];?>">
									<input type="hidden" name="department_id" id="department_id" value="<?= $rec_ric['0']['department_id'];?>">
									<div class="row">
										<div class="col-md-4">
											<div class="form-inline">
												<label>ID</label>
												<input type="text" readonly value="<?= $rec_ric['0']['ric_id'];?>" class="form-control" id="ric_id" name="ric_id">
											</div>
										</div>
										<div class="col-md-4"></div>
										<div class="col-md-4">
											<div class="form-inline">
												<label>Date</label>
												<input type="text" readonly value="<?= substr($rec_ric['0']['ric_date'],0,10);?>" class="form-control" maxlength="10">
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											<div class="form-inline">
												<label style="width: 20%;">Employee</label>
												<input type="text" readonly class="form-control" value="<?= $rec_ric['0']['employee'];?>" style="width: 300px;">
											</div>
											<div class="form-inline">
												<label style="width: 20%;">Department</label>
												<input type="text" readonly class="form-control" value="<?= $rec_ric['0']['department'];?>">
											</div>
										</div>
										<div class="col-md-6">
											<label>Purpose</label>
											<input type="text" readonly class="form-control" value="<?= $rec_ric['0']['purpose'];?>">
										</div>
									</div>
								</div>
							</div>

							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">Details</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<table class="table">
												<thead>
													<tr>
														<th style="width: 10%;">Detail ID</th>
														<th>Particular</th>
														<th>Amount</th>
													</tr>
												</thead>
												<tbody>
													<?php if ($rec_details != false) { foreach ($rec_details as $rec_detail) { ?>
														<tr>
															<td><input type="text" class="form-control" disabled value="<?= $rec_detail['ric_detail_id']; ?>"></td>
															<td><input type="text" class="form-control" disabled value="<?= $rec_detail['particular']; ?>"></td>
															<td><input type="text" class="form-control" disabled value="<?= $rec_detail['amount']; ?>"></td>
														</tr>
													<?php }	} ?>
												</tbody>
											</table>
										</div>
									</div>
								</div>
							</div>

							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">Attachments</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<table class="table" id="tbl_attachment">
												<thead>
													<tr>
														<th style="width: 20%;">Attachment ID</th>
														<th>Filename</th>
														<th style="width: 10%;">View</th>
														<th style="width: 10%;"></th>
													</tr>
												</thead>
												<tbody>
													<?php foreach ($rec_attachments as $rec_attachment) { ?>
														<tr>
															<td><input type="text" class="form-control" value="<?= $rec_attachment['attachment_id']; ?>" readonly></td>
															<td><input type="text" class="form-control" value="<?= $rec_attachment['filename']; ?>" readonly></td>
															<td><button type="button" name="btn_view" id="btn_view" class="btn btn-circle green btn_view">View</button></td>
															<td></td>
														</tr>
													<?php } ?>
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
										<div class="col-md-6">
											<div class="form-inline">
												<label style="width: 20%;">Requested By</label>
												<input type="text" class="form-control" value="<?= $rec_ric['0']['requested']; ?>" style="width: 300px;" readonly>
											</div>
											<div class="form-inline">
												<label style="width: 20%;">Prepared By</label>
												<input type="text" class="form-control" value="<?= $rec_ric['0']['prepared']; ?>" style="width: 300px;" readonly>
											</div>
										</div>
										<div class="col-md-6">
											<?php if ($rec_actions) {
												switch ($rec_actions['0']['action_id']) {
													case '6': ?>
														<div class="form-inline">
															<label style="width: 20%;">Verified By</label>
															<input type="text" class="form-control" value="<?= $rec_actions['1']['employee_name']; ?>" style="width: 300px;" readonly>
														</div>
														<div class="form-inline">
															<label style="width: 20%;">Approved By</label>
															<input type="text" class="form-control" value="<?= $rec_actions['0']['employee_name']; ?>" style="width: 300px;" readonly>
														</div>
														<?php	break;
													
													case '1': ?>
														<div class="form-inline">
															<label style="width: 20%;">Verified By</label>
															<input type="text" class="form-control" value="<?= $rec_actions['0']['employee_name']; ?>" style="width: 300px;" readonly>
														</div>
														<div class="form-inline">
															<label style="width: 20%;">Approved By</label>
															<input type="text" class="form-control" value="" style="width: 300px;" readonly>
														</div>
														<?php break;
													default: ?>
														<div class="form-inline">
															<label style="width: 20%;">Verified By</label>
															<input type="text" class="form-control" value="" style="width: 300px;" readonly>
														</div>
														<div class="form-inline">
															<label style="width: 20%;">Approved By</label>
															<input type="text" class="form-control" value="" style="width: 300px;" readonly>
														</div>
														<?php break;
												}
											} else { ?>
												<div class="form-inline">
													<label style="width: 20%;">Verified By</label>
													<input type="text" class="form-control" value="" style="width: 300px;" readonly>
												</div>
												<div class="form-inline">
													<label style="width: 20%;">Approved By</label>
													<input type="text" class="form-control" value="" style="width: 300px;" readonly>
												</div>
											<?php } ?>
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
