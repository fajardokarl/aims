<style type="text/css">
	.spacerino {
		height: 10px;
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
					<i class="fa fa-users font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Bank Masterlist</span>
				</div>
				<div class="actions">
					<button style="align:right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Bank
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered" id="tbl_masterlist">
							<thead>
								<tr>
									<th>Bank ID</th>
									<th>Bank Name</th>
									<th>Account Number</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($records as $record) { ?>
									<tr>
										<td><?= $record['bank_id']; ?></td>
										<td><?= $record['bank_name']; ?></td>
										<td><?= $record['account_number']; ?></td>
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
						<span class="caption-subject bold uppercase">Bank Information Form</span>
					</div>
					<div class="actions">
						<button type="button" class="btn btn-circle btn-default" id="btn_back" style="width: 100px;">
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
										Bank Details
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">Bank ID</label>
														<div class="col-md-9">
															<input type="text" name="bank_id" id="bank_id" class="form-control" tabindex="-1" disabled>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Bank Name</label>
														<div class="col-md-9">
															<input type="text" name="bank_name" id="bank_name" class="form-control" autocomplete="off">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Account Number</label>
														<div class="col-md-9">
															<input type="text" name="account_number" id="account_number" class="form-control" autocomplete="off">
														</div>
													</div>
													<!-- <div class="form-group">
														<label class="col-md-3 control-label">Legacy Subcode</label>
														<div class="col-md-9">
															<input type="text" name="legacy_subcode" id="legacy_subcode" class="form-control" autocomplete="off">
														</div>
													</div> -->
													<div class="form-group">
														<input type="hidden" name="contact_id" id="contact_id">
														<label class="col-md-3 control-label">Contact Number</label>
														<div class="col-md-9">
															<input type="text" name="contact_number" id="contact_number" class="form-control" autocomplete="off">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption">
										Bank Address
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">

															<input type="hidden" name="address_id" id="address_id">

													<div class="form-group">
														<label class="col-md-3 control-label">Line 1</label>
														<div class="col-md-9">
															<input type="text" name="line_1" id="line_1" class="form-control" autocomplete="off">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Line 2</label>
														<div class="col-md-9">
															<input type="text" name="line_2" id="line_2" class="form-control" autocomplete="off">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Line 3</label>
														<div class="col-md-9">
															<input type="text" name="line_3" id="line_3" class="form-control" autocomplete="off">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">City</label>
														<div class="col-md-9">
															<select name="city_id" id="city_id" class="form-control">
																<option value="0" selected>Select City</option>
																<?php foreach ($rec_cities as $rec_city) { ?>
																	<option value="<?= $rec_city['address_city_id']; ?>"><?= $rec_city['city_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Province</label>
														<div class="col-md-9">
															<select name="province_id" id="province_id" class="form-control">
																<option value="0" selected>Select Province</option>
																<?php foreach ($rec_provinces as $rec_province) { ?>
																	<option value="<?= $rec_province['address_province_id']; ?>"><?= $rec_province['province_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Country</label>
														<div class="col-md-9">
															<select name="country_id" id="country_id" class="form-control">
																<option value="0" selected>Select Country</option>
																<?php foreach ($rec_countries as $rec_country) { ?>
																	<option value="<?= $rec_country['id']; ?>"><?= $rec_country['country_name']; ?></option>
																<?php } ?>
															</select>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Postal Code</label>
														<div class="col-md-9">
															<input type="text" name="postal_code" id="postal_code" class="form-control" autocomplete="off">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
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