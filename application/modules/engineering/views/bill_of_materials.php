

		<div class="tabbable-line tabbable-full-width ">
            <ul class=" nav nav-tabs">
                <li class="active">
                    <a href="#tab-add_bom" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                Add New BOM
                            </span>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="#tab-show_bom" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                BOM lists
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>


        <div class="tab-content">
            <!-- ADD BILL OF MATERIAL -->
            <div class="tab-pane active" id="tab-add_bom">
            	<div class="row">
					<div class="col-md-12">
						<div class="portlet grey-cascade box">
						    <div class="portlet-title">
								<div class="caption">
						            <span class="bold">SETTINGS</span>
						        </div> 
						    </div>
						    <div class="portlet-body form">
						    	<div class="form-body">
						    		<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red"> * </font>Project: </label>
												<div class="col-md-3">
													<select id="item_project" name="item_project" class="select2">
														<!-- <option value="0">None</option> -->
														<?php foreach ($project as $project) { ?>
															<option value="<?php echo $project['project_id']; ?>"><?php echo $project['project_description']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red"> * </font>Lot: </label>
												<div class="col-md-3">
													<select id="item_lots" name="item_lots" class="select2">
													</select>
												</div>
											</div>
										</div>
									</div>
						    		<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red"> * </font>Date Needed: </label>
												<div class="col-md-3">
													<input type="date" name="date_needed" id="date_needed" class="form-control">
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<hr>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red"> * </font>Description: </label>
												<div class="col-md-6">
													<select id="cons_desc" name="cons_desc" class="select2">
														<!-- <option value="0">None</option> -->
														<?php foreach ($desc as $desc) { ?>
															<option value="<?php echo $desc['construction_desc_id']; ?>"><?php echo $desc['description_name']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red">  * </font>Activity: </label>
												<div class="col-md-6">
													<select id="cons_act" name="cons_act" class="select2">
														<!-- <option value="0">None</option> -->
														<?php foreach ($activity as $activity) { ?>
															<option value="<?php echo $activity['construction_act_id']; ?>"><?php echo $activity['activity_name']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red">  * </font>Item: </label>
												<div class="col-md-6">
													<select id="cons_item" name="cons_item" class="select2">
														<!-- <option value="0">None</option> -->
														<?php foreach ($items as $items) { ?>
															<option value="<?php echo $items['item_id']; ?>"><?php echo $items['description']; ?></option>
														<?php } ?>
													</select>
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red"> * </font>Quantity: </label>
												<input type="hidden" name="uom_id_item" id="uom_id_item" class="form-control" readonly="readonly">
												<div class="col-md-3">
													<input type="number" name="cons_qty" id="cons_qty" class="form-control" min="1">
												</div>
												<div class="col-md-3">
													<input type="text" name="uom_item" id="uom_item" class="form-control" readonly="" style="border: 0; background-color: white;" value="bag">
													<input type="hidden" name="uom_id_item" id="uom_id_item" class="form-control" readonly="readonly" value="1">
													<!-- <input type="hidden" name="uom_item_bal"> -->
												</div>
											</div>
										</div>
									</div>
									<div class="row">
										<div class="col-md-12">
											<div class="form-group">
												<label class="col-md-3 control-label"><font color="red"> * </font>Unit Cost: </label>
												<div class="col-md-3">
													<input type="number" name="unit_cost" id="unit_cost" class="form-control">
												</div>
												
												<div class="" align="right">
													<button id="earth_additems" class="btn blue col-md-2">
														<i class="fa fa-plus-circle" aria-hidden="true"> </i>Add Item
														<!-- <div class="font-white"> </div> -->
													</button>
<!-- 													<button id="save_edit_item" class="btn blue col-md-2" style="display:none;">
														<i class="fa fa-plus-circle" aria-hidden="true"> </i>Keep changes
													</button> -->
													<button id="save_all_items" class="btn green col-md-2">Save Items</button>

												</div>
											</div>
										</div>
									</div>
						    	</div>
						    </div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet grey-cascade box">
						    <div class="portlet-title">
								<div class="caption">
						            <span class="bold">Materials</span>
						        </div> 
						    </div>
						    <div class="portlet-body form">
							    <div class="form-body">
									<input type="hidden" id="description_h"></input>
									<input type="hidden" id="activity_id" name="activity_id">
									<div id="desc_text"></div>
									<table id="tbl_material" class="table table-striped table-hover">
										<thead>
											<tr>
												<th>Description</th>
												<th>Activity</th>
												<th>Item Decription</th>
												<th>Qty</th>
												<th>Unit</th>
												<th>Unit Cost</th>
												<th>Total</th>
												<th>Action</th>
												<th>A ID</th>
												<th>D ID</th>
												<th>Item ID</th>
												<th>uom ID</th>
											</tr>
										</thead>
										<tbody></tbody>
									</table>
							    </div>
						    </div>
						</div>
					</div>
				</div>
            </div>

            <!-- SHOW BILL OF MATERIAL LIST -->
            <div class="tab-pane " id="tab-show_bom">
            	<div class="row">
            		<div class="col-md-12">
            			<div class="portlet grey-cascade box">
						    <div class="portlet-title">
								<div class="caption">
						            <span class="bold">BOMs</span>
						        </div> 
						    </div>
						    <div class="portlet-body">
						    	<table class="table table-bordered table-hover" id="tbl_bom_list">
		            				<thead>
		            					<tr>
		            						<th>BOM ID</th>
		            						<th>Description</th>
		            						<th>Date Requested</th>
		            						<th>Date Needed</th>
		            					</tr>
		            				</thead>
		            				<tbody>
		            					<?php foreach ($bom as $bom) { ?>
		            						<tr>
		            							<td><?php echo $bom['bom_id']; ?></td>
		            							<td><?php echo $bom['lot_description']; ?></td>
		            							<td><?php echo date_format(date_create($bom['date_request']), "M d, Y"); ?></td>
		            							<td><?php echo date_format(date_create($bom['date_needed']), "M d, Y"); ?></td>
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









<div class="modal fade bs-modal-xs" id="confirmation_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h3 class="modal-title" id="">Confirmation</h3>
			</div>
			<!-- <div class="modal-body">
				<p>Confirm Action</p>
			</div> -->
			<div class="modal-footer">
				<div align="right">
					<button id="confirm_save_items" class="btn blue">Confirm</button>
					<button id="" class="btn red" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
		</div>
	</div>
</div>




<div class="modal fade bs-modal-lg" id="bom_all_items" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h2 class="modal-title" id="">BOM Details</h2>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet grey-cascade box">
						    <div class="portlet-title">
								<div class="caption">
						            <span class="bold">Materials</span>
						        </div> 
					            <div class="actions">
					            	<button id="btn_bom_pdf" class="btn btn-default btn-sm">Print PDF</button>
					            </div>
						    </div>
						    <div class="portlet-body form">
							    <div class="form-body">
									<input type="hidden" id="description_h"></input>
									<input type="hidden" id="bom_id" name="bom_id">
									<div id="desc_text"></div>
									<div class="col-md-12">
										<table class="table" border="0">
											<tr>
												<td width="20%">Lot Name</td>
												<td width="5%">:</td>
												<td id="lot_name"></td>
											</tr>
											<tr>
												<td width="20%">Date Requested</td>
												<td width="5%">:</td>
												<td id="date_r"></td>
											</tr>
											<tr>
												<td width="20%">Date Needed</td>
												<td width="5%">:</td>
												<td id="date_n"></td>
											</tr>
										</table>
									</div>
									<table id="tbl_bom_item_list" class="table table-striped table-bordered">
										<thead>
											<tr>
												<th>ID</th>
												<th>Description</th>
												<th>Activity</th>
												<th>Item</th>
												<th>Qty</th>
												<th>Unit</th>
												<th>Unit Cost</th>
												<th>Total</th>
												<!--<th>.</th>
												<th>A ID</th>
												<th>D ID</th>
												<th>Item ID</th>
												<th>uom ID</th> -->
											</tr>
										</thead>
										<tbody></tbody>
									</table>
							    </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div align="right">
					<!-- <button id="confirm_save_items" class="btn blue">Confirm</button> -->
					<button id="" class="btn red" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
		</div>
	</div>
</div>



<div class="modal fade bs-modal-xs" id="edit_item_data" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h2 class="modal-title" id="">EDIT</h2>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="portlet grey-cascade box">
						    <div class="portlet-title">
								<div class="caption">
						            <span class="bold">Materials</span>
						        </div> 
						    </div>
						    <div class="portlet-body form">
							    <div class="row">
							    	<div class="col-md-3">
										<input type="number" name="cons_qty" id="cons_qty" class="form-control" min="1">
									</div>
									<div class="col-md-3">
										<input type="number" name="unit_cost" id="unit_cost" class="form-control">
									</div>
							    </div>
						    </div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div align="right">
					<!-- <button id="confirm_save_items" class="btn blue">Confirm</button> -->
					<button id="" class="btn red" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
		</div>
	</div>
</div>