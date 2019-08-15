<style type="text/css">
	input::-webkit-outer-spin-button, input::-webkit-inner-spin-button{
		-webkit-appearance:none;
		margin:0;
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
					<span class="caption-subject bold uppercase">Cost of Lot</span>
				</div>
				<div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Lot Cost
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-bordered" id="tbl_masterlist">
					<thead>
						<tr>
							<th>ID</th>
							<th>Project</th>
							<th>Phase</th>
							<th>Year</th>
							<th>Month</th>
							<th>Cost of Lot</th>
							<th>Cost of Development</th>
							<th>XU Share</th>
							<th>Cost of House</th>
							<th>Tucked in Share</th>
							<th>Transfer Fee</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($records as $record) { ?>
							<tr>
								<td><?= $record['lot_cost_id']; ?></td>
								<td><?= $record['project']; ?></td>
								<td><?= $record['phase']; ?></td>
								<td><?= $record['cost_year']; ?></td>
								<td><?= $record['month']; ?></td>
								<td><?= $record['lot_cost']; ?></td>
								<td><?= $record['devt_cost']; ?></td>
								<td><?= $record['xu_share']; ?></td>
								<td><?= $record['house_cost']; ?></td>
								<td><?= $record['tucked_in_share']; ?></td>
								<td><?= $record['transfer_fee']; ?></td>
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
						<span class="caption-subject bold uppercase">Cost of Lot Form</span>
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
										Project Details
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">

													<input type="hidden" name="lot_cost_id" id="lot_cost_id">

													<div class="form-group">
														<label class="col-md-3 control-label">Project</label>
														<div class="col-md-9">
															<select class="form-control" id="project_id" name="project_id">
																<option value="" disabled selected> Select Project </option>
																<?php foreach ($rec_projects as $rec_project) { ?>
																	<option value="<?= $rec_project['project_id']; ?>"><?= $rec_project['project_name']; ?></option>
																<?php } ?>
															</select>
															<span id="error1" style="color: red;"></span>
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label"> Select Phase</label>
														<div class="col-md-9">
															<select class="form-control" name="phase_id" id="phase_id">
															<option value="" disabled selected> Phase </option>
																<?php foreach ($rec_phases as $rec_phase) { ?>
																	<option value="<?= $rec_phase['phase_id']; ?>"><?= $rec_phase['phase_name']; ?></option>
																<?php } ?>
															</select>
															<span id="error2" style="color: red;"></span>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">Year</label>
														<div class="col-md-9">
															<input type="number" name="cost_year" id="cost_year" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Month</label>
														<div class="col-md-9">
															<select class="form-control" name="cost_month" id="cost_month">
																<option value="" disabled selected> Select Month </option>
																<option value="01">January</option>
																<option value="02">February</option>
																<option value="03">March</option>
																<option value="04">April</option>
																<option value="05">May</option>
																<option value="06">June</option>
																<option value="07">July</option>
																<option value="08">August</option>
																<option value="09">September</option>
																<option value="10">October</option>
																<option value="11">November</option>
																<option value="12">December</option>
															</select>
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
										Project Costs
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">Cost of Lot</label>
														<div class="col-md-9">
															<input type="number" name="lot_cost" id="lot_cost" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Cost of Development</label>
														<div class="col-md-9">
															<input type="number" name="devt_cost" id="devt_cost" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">XU Share</label>
														<div class="col-md-9">
															<input type="number" name="xu_share" id="xu_share" class="form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">Cost of House</label>
														<div class="col-md-9">
															<input type="number" name="house_cost" id="house_cost" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Tucked In Share</label>
														<div class="col-md-9">
															<input type="number" name="tucked_in_share" id="tucked_in_share" class="form-control">
														</div>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Transfer Fee</label>
														<div class="col-md-9">
															<input type="number" name="transfer_fee" id="transfer_fee" class="form-control">
														</div>
													</div>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
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
