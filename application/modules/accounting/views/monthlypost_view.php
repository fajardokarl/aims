<style type="text/css">
	.spacerino{
		height: 100px;
	}
	.spacerino-sm{
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
					<span class="caption-subject bold uppercase">Monthly Posting</span>
				</div>
				<!-- <div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Fiscal Month
					</button>
				</div> -->
			</div>
			<div class="portlet-body">
				<div class="row">
					<div class="col-md-10">
						<table class="table table-bordered " id="tbl_masterlist">
							<thead>
								<tr>
									<th>ID</th>
									<th>Fiscal Name</th>
									<th>Date Begin</th>
									<th>Date End</th>
									<th>Status</th>
									<th>Locked</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($records as $record) { ?>
									<tr>
										<th><?= $record['fiscal_year_id']; ?></th>
										<th><?= $record['fiscal_name']; ?></th>
										<th><?= $record['begin']; ?></th>
										<th><?= $record['end']; ?></th>
										<th><?= ucfirst($record['status']); ?></th>
										<th><?= ucfirst($record['is_locked']); ?></th>
									</tr>
								<?php } ?>
							</tbody>
						</table>
					</div>
					<div class="col-md-2">
						<form method="post" enctype="multipart/form-data" id="frm_actions">
							<div class="spacerino">
								<input type="hidden" name="begin_date" id="begin_date">
								<input type="hidden" name="end_date" id="end_date">
								<input type="hidden" name="fiscal_id" id="fiscal_id">
								<input type="hidden" name="is_locked" id="is_locked">
							</div>
								<button type="submit" class="btn btn-circle green form-control" id="btn_post">POST</button>
							<div class="spacerino-sm"></div>
								<button type="submit" class="btn btn-circle green form-control" id="btn_lock">Lock</button>
						</form>					
					</div>
				</div>
			</div>
		</div>
	</div>
</div>

<div style="" class="modal fade bs-modal-lg" id="mdl_alert" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-full">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Posting Message</span>
					<button type="button" class="close" id="btn_closemodal" tabindex="-1" data-dismiss="modal"></button>
				</div>
			</div>
			<div class="portlet light">
				<div class="row">
					<div class="col-md-12">
						<table class="table table-hover" id="tbl_alert">
							<thead>
								<tr>
									<th>Transaction ID</th>
									<th>Post Status</th>
									<th>Locked</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>