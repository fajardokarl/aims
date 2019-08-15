<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Attachment Type Setting</span>
				</div>
				<div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Type
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-bordered table-striped" id="tbl_masterlist">
					<thead>
						<tr>
							<th>ID</th>
							<th>Type</th>
							<th>Description</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($records as $record) { ?>
							<tr>
								<td><?= $record['attachment_type_id']; ?></td>
								<td><?= $record['attachment_type']; ?></td>
								<td><?= $record['description']; ?></td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<form method="post" enctype="multipart/form-data" id="frm_information" style="display:none;">
	<div class="row">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption font-green-sharp">
						<i class="fa fa-book font-green-sharp"></i>
						<span class="caption-subject bold uppercase">Attachment Type Form</span>
					</div>
					<div class="actions">
						<button type="button" class="btn btn-circle btn-default" id="btn_back">
							<i class="fa fa-arrow-left"></i>Back
						</button>
					</div>
				</div>
				<div class="portlet-body">
					<div class="row">
						<div class="col-md-3"></div>
						
						<div class="col-md-6">
							<div class="portlet box green">
								<div class="portlet-title">
									<div class="caption" id="caption">
										Information
									</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label>ID</label>
												<input type="text" name="attachment_type_id" id="attachment_type_id" readonly tabindex="-1" class="form-control">
											</div>
											<div class="form-group">
												<label>Type</label>
												<input type="text" name="attachment_type" id="attachment_type" autocomplete="off" class="form-control">
												<span id="error1" style="color:red;"></span>
											</div>
											<div class="form-group">
												<label>Description</label>
												<input type="text" name="description" id="description" autocomplete="off" class="form-control">
												<span id="error2" style="color:red;"></span>
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
						
						<div class="col-md-3"></div>
					</div>
				</div>
			</div>
		</div>
	</div>
</form>