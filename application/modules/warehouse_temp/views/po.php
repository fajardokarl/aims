<div class="row">
	<div class="col-md-12">
        <div class="tabbable-line tabbable-full-width ">
            <ul class=" nav nav-tabs">
                <li class="active">
                    <a href="#tab-po_inputs" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                PO Entry
                            </span>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="#tab-po_list" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                PO masterlist/Receiving
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
		<div class="tab-content">
            <div class="tab-pane active" id="tab-po_inputs">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet grey-cascade box">
							<div class="portlet-title">
								<div class="caption">
				                    <span class="bold">PO Details</span>
				                </div> 
							</div> 
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>PRF #: </label>
													<div class="col-md-7">
														<input type="text" name="prf_number" id="prf_number" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>PO #: </label>
													<div class="col-md-7">
														<input type="text" name="po_number" id="po_number" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>PO date: </label>
													<div class="col-md-7">
														<input type="date" name="po_date" id="po_date" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>PO date Rcv'd: </label>
													<div class="col-md-7">
														<input type="date" name="po_date_rcvd" id="po_date_rcvd" class="form-control">
													</div>
												</div>
												<!-- <div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Amount: </label>
													<div class="col-md-7">
														<input type="number" name="po_amount" id="po_amount" class="form-control">
													</div>
												</div> -->
												<!-- <div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Invoice: </label>
													<div class="col-md-7">
														<input type="text" name="po_invoice" id="po_invoice" class="form-control">
													</div>
												</div> -->
											</div>
											<div class="col-md-6">
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Project: </label>
													<div class="col-md-7">
														<select class="form-control select2 select2-hidden-accessible" id="opt_po_project" name="opt_po_project" required>
					                                        <option value="0" selected>None</option>
					                                        <?php foreach ($project as $project) { ?>
					                                        	<option value="<?php echo $project['project_id'] ?>"><?php echo $project['proje_description'] ?></option>
					                                        <?php } ?>
					                                    </select>  
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Warehouse: </label>
													<div class="col-md-7">
														<select class="form-control select2 select2-hidden-accessible" id="opt_po_warehouse" name="opt_po_warehouse" required>
					                                        <option value="0" selected>None</option>
					                                        <?php foreach ($warehouse as $warehouse) { ?>
					                                        	<option value="<?php echo $warehouse['warehouse_id'] ?>"><?php echo $warehouse['warehouse_description'] ?></option>
					                                        <?php } ?>
					                                    </select>  
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Supplier: </label>
													<div class="col-md-7">
														<select class="form-control select2 select2-hidden-accessible" id="opt_po_supplier" name="opt_po_supplier" required>
					                                        <option value="0" selected>None</option>
					                                        <?php foreach ($suppliers as $suppliers) { ?>
					                                        	<?php if($suppliers['client_type_id'] == 1){ ?>
					                                        		<option value="<?php echo $suppliers['supplier_id'] ?>"><?php echo $suppliers['supp_name'] ?></option>
					                                        	<?php }else if($suppliers['client_type_id'] == 2){ ?>
					                                        		<option value="<?php echo $suppliers['supplier_id'] ?>"><?php echo $suppliers['organization_name'] ?></option>
						                                        <?php } ?>
					                                        <?php } ?>
					                                    </select>  
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Remarks: </label>
													<div class="col-md-7">
														<textarea  rows="3" name="po_remarks" id="po_remarks" class="form-control"></textarea>
													</div>
												</div>
												<!-- <div class="form-group">
													<div class=""></div>
												</div> -->
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-10">
						<div class="portlet grey-cascade box">
							<div class="portlet-title">
								<div class="caption">
				                    <span class="bold">PO Items</span>
				                </div> 
							</div>
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="col-md-5">
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Item: </label>
													<div class="col-md-7">
														<select class="form-control select2 select2-hidden-accessible" id="opt_po_item" name="opt_po_item" required>
					                                        <option value="0" selected>None</option>
					                                        <?php foreach ($items as $items) { ?>
					                                        	<option value="<?php echo $items['item_id'] ?>"><?php echo $items['description'] ?></option>
					                                        <?php } ?>
					                                    </select>  
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label">Unit: </label>
													<div class="col-md-7">
														<input type="text" name="item_unit" id="item_unit" class="form-control" readonly="true">
														<input type="hidden" name="item_unit_id" id="item_unit_id" class="form-control">
													</div>
												</div>
<!-- 												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Remarks: </label>
													<div class="col-md-7">
														<textarea rows="2" name="item_remarks" id="item_remarks" class="form-control"></textarea>
													</div>
												</div> -->
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Price: </label>
													<div class="col-md-7">
														<input type="number" name="po_item_price" id="po_item_price" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>QTY: </label>
													<div class="col-md-3">
														<input type="number" name="po_item_qty" id="po_item_qty" class="form-control">
													</div>
													<div class="col-md-5">
														<button class="btn blue" id="add_po_item">ADD ITEM</button>
													</div>
												</div>
												<!-- <div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>QTY rcv'd: </label>
													<div class="col-md-3">
														<input type="number" name="po_item_qtyrcvd" id="po_item_qtyrcvd" class="form-control">
													</div>
												</div> -->
											</div>
											<div class="col-md-7">
												<table id="tbl_po_item" name="tbl_po_item" class="table table-bordered">
													<thead>
														<tr>
															<th width="40%">Item</th>
															<th width="10%">Unit</th>
															<th width="10%">QTY</th>
															<!-- <th width="10%">Rcv'd</th> -->
															<th width="10%">Price</th>
															<th width="20%">Amount</th>
															<!-- <th width="30%">Remarks</th> -->
															<th width="10%">item_id</th>
															<th width="10%">uom_id</th>
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
					<div class="col-md-2">
						<div class="portlet grey-cascade box">
							<div class="portlet-title">
								<div class="caption">
				                    <span class="bold">ACTIONS</span>
				                </div> 
							</div>
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="col-md-12">
														<button class="btn green-meadow col-md-12" id="btn_submit_po">Submit PO</button>
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="form-horizontal">
												<div class="form-body">
													<div class="col-md-12">
														<button class="btn GREY col-md-12" id="btn_reset_po_list">RESET</button>
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
            <div class="tab-pane" id="tab-po_list">
				<div class="row">
					<div class="col-md-6">
						<div class="portlet grey-cascade box">
							<div class="portlet-title">
								<div class="caption">
				                    <span class="bold">PO Lists</span>
				                </div> 
							</div>
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<table id="tbl_po_lists" class="table table-bordered table-hover">
													<thead>
														<tr>
															<th>PO ID</th>
															<th>PO Number</th>
															<th>PO Date</th>
															<th>Supplier</th>
															<th>Amount</th>
															<th>Status</th>
															<th>wh id</th>
														</tr>
													</thead>
													<tbody>
														<?php foreach ($pos as $pos) { ?>
															<tr>
																<td width="10%"><?php echo $pos['po_id']; ?></td>
																<td width="10%"><?php echo $pos['po_num']; ?></td>
																<td width="20%"><?php echo $pos['po_date']; ?></td>
																<td width="40%"><?php echo $pos['organization_name']; ?></td>
																<td width="20%"><?php echo $pos['po_total']; ?></td>
																<td width="20%"><?php echo $pos['po_status']; ?></td>
																<td width="20%"><?php echo $pos['warehouse_id']; ?></td>
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
				                    <span class="bold">PO details</span>
				                </div>
				                <div class="actions">
                                    <button align="right" type="button" class="btn btn-default" data-toggle="modal" id="save_receiving">Confirm Receiving</button>
                                </div> 
							</div>
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="col-md-10">
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Delivery Receipt: </label>
													<div class="col-md-8">
														<input type="text" name="rcv_delivery_receipt" id="rcv_delivery_receipt" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Amount: </label>
													<div class="col-md-8">
														<input type="text" name="rcv_amount" id="rcv_amount" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<label class="col-md-4 control-label"><font color="red"> * </font>Invoice: </label>
													<div class="col-md-8">
														<input type="text" name="rcv_invoice" id="rcv_invoice" class="form-control">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-12">
												<table id="tbl_po_details" class="table table-bordered table-hover">
													<thead>
														<tr>
															<th width="10%">pod id</th>
															<th width="10%">item id</th>
															<th width="40%">Item</th>
															<th width="20%">Unit</th>
															<th width="10%">PO qty</th>
															<th width="10%">rcv'd</th>
															<th width="10%">new rcv'd</th>
															<th width="10%">Remark</th>
															<th width="10%">Status</th>
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
            </div>
        </div>
	</div>
</div>

<div class="modal fade bs-modal-md" id="modal_rcv_item" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<div class="modal-header">
				<div class="caption">
                    <span class="bold ">Item Receiving</span>
                </div> 
			</div>
			<div class="modal-body form">
				<div class="form-horizontal">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12" style="margin-top: -15px;">
								<h3 class="bold font-green-meadow"><span id="item_name"></span></h4>
								<h4 class="bold">Unserved qty : <span id="unserved_qty"></span></h4>
							</div>
						</div>
						<!-- <div class="row">
							<div class="col-md-12">
							</div>
						</div> -->
						<br />
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-3 control-label"><font color="red"> * </font>Qty Received: </label>
									<div class="col-md-8">
										<input type="text" name="item_qty_rcv" id="item_qty_rcv" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-3 control-label"><font color="red"> * </font>Remarks: </label>
									<div class="col-md-8">
										<textarea  rows="3" name="item_remark_rcv" id="item_remark_rcv" class="form-control"></textarea>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn gray" id="btn_cancel" data-dismiss="modal">Close</button>
				<button type="button" class="btn green" id="btn_rcv_item" name="btn_rcv_item">Receive Item</button>
			</div>
		</div>
	</div>
</div>