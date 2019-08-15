<div class="row">
	<div class="col-md-6">
		<div class="portlet grey-cascade box">
			<div class="portlet-title">
				<div class="caption">
		            <span class="bold">RR Masterlist</span>
		        </div> 
			</div>
			<div class="portlet-body form">
				<div class="form-horizontal">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<table id="tbl_rr_lists" class="table table-bordered table-hover">
									<thead>
										<tr>
											<td>.</td>
											<th>RR ID</th>
											<th>RR date</th>
											<th>DR</th>
											<th>Invoice</th>
											<th>Amount</th>
											<!-- <th>Amount</th> -->
										</tr>
									</thead>
									<tbody>
										<?php foreach ($rr as $rr) { ?>
											<tr>
												<td>.</td>
												<td width="10%"><?php echo $rr['rr_id']; ?></td>
												<td width="10%"><?php echo $rr['rr_date']; ?></td>
												<td width="20%"><?php echo $rr['delivery_receipt_number']; ?></td>
												<td width="40%"><?php echo $rr['invoice_number']; ?></td>
												<td width="20%"><?php echo $rr['non_vat_amount']; ?></td>
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
	<div class="col-md-6">
		<div class="portlet grey-cascade box">
			<div class="portlet-title">
				<div class="caption">
		            <span class="bold"></span>
		        </div> 
			</div>
			<div class="portlet-body form">
				<div class="form-horizontal">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<table id="tbl_rritem_lists" class="table table-bordered table-hover">
									<thead>
										<tr>
											<th width="10%">ID</th>
											<th width="70%">Item</th>
											<th width="20%">QTY</th>
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
	</div>
</div>


