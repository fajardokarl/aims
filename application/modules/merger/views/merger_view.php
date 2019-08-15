<style type="text/css">
	.table-fixed thead{
		display: block;
		/*width: 100%;*/
	}
	.table-fixed tbody{
			height: 700px;
			overflow-y: auto;
	
			display: block;
	}
	.mergercustom {
		width: 80%;
	}
</style>
<div class="row" id="frm_main">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="row">
				<label></label>
			</div>
		</div>
	</div>
</div>

<div class="row" id="frm_person" style="display: none;">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-12">
						<div class="row">
							<div class="col-md-3">
								<div class="portlet light">
									<div class="portlet-title">
										<span class="caption font-green-sharp bold uppercase">Main Account</span>	
									</div>
									<div class="portlet-body">
										<div class="form-group">
											<label>Search</label>
											<input type="text" id="txt_search" class="form-control">
										</div>
										<table class="table table-hover table-fixed" id="tbl_masterlist">
											<thead>
												<tr>
													<th>ID</th>
													<th>Name</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($records as $record) { ?>
													<tr>
														<td><?= $record['person_id']; ?></td>
														<td><?= $record['name']; ?></td>
													</tr>
												<?php } ?>
											</tbody>
										</table>	
									</div>	
								</div>
							</div>

							<div class="col-md-6">
								<div class="row">
									<div class="portlet light">
										<button type="button"  class="btn btn-circle green center-block mergercustom" id="btn_merge">Merge</button>
									</div>
								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="portlet light">
											<div class="portlet-title">
												<div class="caption font-green-sharp">
													<span class="caption-subject bold uppercase">Main Account Info</span>
												</div>
											</div>
											<div class="portlet-body">
												<div class="row">
														<div class="form-group">
															<label>Person ID</label>
															<input type="text" id="txt_main" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Last Name</label>
															<input type="text" id="txt_last" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>First Name</label>
															<input type="text" id="txt_first" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Middle Name</label>
															<input type="text" id="txt_middle" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Suffix</label>
															<input type="text" id="txt_suffix" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Gender</label>
															<input type="text" id="txt_gender" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Birthday</label>
															<input type="text" id="txt_birthdate" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Place of Birth</label>
															<input type="text" id="txt_birthplace" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Nationality</label>
															<input type="text" id="txt_nationality" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>Civil Status</label>
															<input type="text" id="txt_civilstatus" class="form-control"  readonly="readonly">
														</div>
														<div class="form-group">
															<label>TIN</label>
															<input type="text" id="txt_tin" class="form-control"  readonly="readonly">
														</div>
												</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="portlet light">
											<div class="portlet-title">
												<div class="caption font-green-sharp">
													<span class="caption-subject bold uppercase">Merge Account Info</span>
												</div>
											</div>
											<div class="form-group">
												<label>Person ID</label>
												<input type="text" id="txt_merge" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Last Name</label>
												<input type="text" id="txt2_last" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>First Name</label>
												<input type="text" id="txt2_first" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Middle Name</label>
												<input type="text" id="txt2_middle" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Suffix</label>
												<input type="text" id="txt2_suffix" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Gender</label>
												<input type="text" id="txt2_gender" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Birthday</label>
												<input type="text" id="txt2_birthdate" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Place of Birth</label>
												<input type="text" id="txt2_birthplace" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Nationality</label>
												<input type="text" id="txt2_nationality" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>Civil Status</label>
												<input type="text" id="txt2_civilstatus" class="form-control"  readonly="readonly">
											</div>
											<div class="form-group">
												<label>TIN</label>
												<input type="text" id="txt2_tin" class="form-control" readonly="readonly">
											</div>
										</div>
									</div>
								</div>
							</div>
						
							<div class="col-md-3">
								<div class="portlet light">
									<div class="portlet-title">
										<span class="caption font-green-sharp bold uppercase">Merge Account</span>
									</div>
									<div class="portlet-body">
										<div class="form-group">
											<label>Search</label>
											<input type="text" id="txt2_search" class="form-control">
										</div>
										<table class="table table-hover table-fixed" id="tbl_migrate">
											<thead>
												<tr>
													<th>ID</th>
													<th>merged</th>
													<th>name</th>
												</tr>
											</thead>
											<tbody>
												<?php foreach ($record2s as $record2) { ?>
													<tr>
														<td><?= $record2['person_id']; ?></td>
														<td><?= $record2['mergeto']; ?></td>
														<td><?= $record2['name']; ?></td>
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
	</div>
</div>

