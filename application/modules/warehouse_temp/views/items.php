<div class="row">
	<div class="col-md-5">
		<div class="portlet grey-cascade box">
			<div class="portlet-title">
				<div class="caption">
                    <span class="bold">Add Items</span>
                </div> 
			</div>
			<div class="portlet-body form">
				<div class="form-horizontal">
					<div class="form-body">
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red">  </font>Item Brand: </label>
									<div class="col-md-7">
										<input type="text" name="item_brand" id="item_brand" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>Item Name: </label>
									<div class="col-md-7">
										<input type="text" name="item_desc" id="item_desc" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red">  </font>Dimensions: </label>
									<div class="col-md-7">
										<input type="text" name="item_dimen" id="item_dimen" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>Stock qty: </label>
									<div class="col-md-7">
										<input type="text" name="item_qty_left" id="item_qty_left" class="form-control" required>
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>UOM: </label>
									<div class="col-md-7">
										<select class="form-control select2 select2-hidden-accessible" id="opt_item_uom" name="opt_item_uom" required>
	                                        <option value="0" selected>None</option>
	                                        <?php foreach ($uom as $uom) { ?>
	                                        	<option value="<?php echo $uom['uom_id'] ?>"><?php echo $uom['uom_name'] ?></option>
	                                        <?php } ?>
	                                    </select>  
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>Category: </label>
									<div class="col-md-7">
										<select class="form-control select2 select2-hidden-accessible" id="opt_item_cat" name="opt_item_cat" required>
	                                        <option value="0" selected>None</option>
	                                        <?php foreach ($cat as $cat) { ?>
	                                        	<option value="<?php echo $cat['string_code'] ?>"><?php echo $cat['description'] ?></option>
	                                        <?php } ?>
	                                    </select>  
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>Warehouse: </label>
									<div class="col-md-7">
										<select class="form-control select2 select2-hidden-accessible" id="opt_item_warehouse" name="opt_item_warehouse" required>
		                                    <option value="0" selected>None</option>
		                                    <?php foreach ($warehouse as $warehouse) { ?>
		                                    	<option value="<?php echo $warehouse['warehouse_id'] ?>"><?php echo $warehouse['warehouse_description'] ?></option>
		                                    <?php } ?>
		                                </select>  
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4"></label>
									<div class="col-md-7" align="right">
										<button id="item_save" class="btn blue col-md-12">SAVE</button>
										<button id="item_reset" class="btn grey col-md-12">RESET</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="portlet grey-cascade box">
			<div class="portlet-title">
				<div class="caption">
                    <span class="bold">Items Masterlist</span>
                </div> 
			</div>
			<div class="portlet-body form">
				<div class="form-horizontal">
					<div class="form-body">
						<div class="row" align="right">
							<div class="col-md-10">
								<div class="form-group">
									<div class=" col-md-6">
										<input type="text" name="item_search" id="item_search" class="form-control" required placeholder="Search Item">
									</div>
									<div class="">
										<!-- <button class="btn blue col-md-2">Okay</button> -->
									</div>
								</div>
							</div>
						</div>
						<!-- <div class="form-group">
							<label class="col-md-4 control-label"><font color="red"> * </font>Category: </label>
							<div class="col-md-7">
								<select class="form-control select2 select2-hidden-accessible" id="opt_item_cat" name="opt_item_cat" required>
                                    <option value="0" selected>None</option>
                                    <?php foreach ($cat_sort as $cat_sort) { ?>
                                    	<option value="<?php echo $cat_sort['category_code'] ?>"><?php echo $cat_sort['description'] ?></option>
                                    <?php } ?>
                                </select>  
							</div>
						</div> -->
						<table id="tbl_items_list" class="table table-bordered">
							<thead>
								<tr>
									<th>Item ID</th>
									<th>Item Code</th>
									<th>Item Description</th>
									<th>Unit</th>
									<!-- <th>Category</th> -->
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