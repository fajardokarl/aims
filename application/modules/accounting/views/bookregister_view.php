<style type="text/css">
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
					<span class="caption-subject bold uppercase">Book Registers</span>
				</div>
				<div class="actions">
					<button style="align:right;" type="button" class="btn btn-circle green" id="btn_add">
						<span class="fa fa-plus"></span>Add Book Register
					</button>
				</div>
			</div>
			<div class="portlet-body">
				<table class="table table-hover table-bordered" id="tbl_masterlist">
					<thead>
						<tr>
							<th style="display: none;">ID</th>
							<th>Book Code</th>
							<th>Book Reference</th>
							<th>Book Description</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($records as $record) { ?>
							<tr>
								<td style="display: none;"><?= $record['book_register_id']; ?></td>
								<td><?= $record['book_code']; ?></td>
								<td><?= $record['book_reference']; ?></td>
								<td><?= $record['book_description']; ?></td>
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
						<span class="caption-subject bold uppercase">Book Register Form</span>
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
									<div class="caption">Book Information</div>
								</div>
								<div class="portlet-body">
									<div class="row">
										<div class="col-md-12">
											
											<input type="hidden" name="book_register_id" id="book_register_id">
											
											<div class="form-horizontal">
												<div class="form-body">
													<div class="form-group">
														<label class="col-md-3 control-label">Book Code</label>
														<div class="col-md-9">
															<input type="text" name="book_code" id="book_code" class="form-control" autocomplete="off" style="text-transform: uppercase;" maxlength="2">
														</div>
														<span id="code_error" style="color: red;"></span>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Book Reference</label>
														<div class="col-md-9">
															<input type="text" name="book_reference" id="book_reference" class="form-control" autocomplete="off">
														</div>
														<span id="code_error2" style="color: red;"></span>
													</div>
													<div class="form-group">
														<label class="col-md-3 control-label">Book Description</label>
														<div class="col-md-9">
															<input type="text" name="book_description" id="book_description" class="form-control" autocomplete="off">
														</div>
														<span id="code_error3" style="color: red;"></span>
													</div>
													
													<button id="btn_save" type="button" class="btn btn-circle green pull-right" style="width: 100px;">Save</button>
													
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
	</div>
</form>