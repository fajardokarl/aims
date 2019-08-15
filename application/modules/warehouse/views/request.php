<div class="row">
    <div class="col-md-12">
        <div class="portlet grey-cascade box">
            <div class="portlet-title">
                <div class="caption">
                    <span class="bold">Issuance Form</span>
                </div> 
            </div>
            <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label"><font color="red"> * </font>Requestor: </label>
                            <div class="">
                                <select class="form-control select2 select2-hidden-accessible" id="opt_iss_project" name="opt_iss_project" required>
                                    <option value="0" selected>None</option>
                                    <?php foreach ($employee_details as $employee_detail) { ?>
                                        <option value="<?php echo $employee_detail['employee_id']; ?>"><?php echo $employee_detail['lastname'] . ', ' . $employee_detail['firstname']; ?></option>
                                    <?php } ?>
                                </select> 
                                <!-- <input type="text" name="issuance_requestor" id="issuance_requestor" class="form-control" placeholder="temporary abbr"> -->
                                <!-- <input type="text" name="inv_available" id="inv_available" class="form-control" placeholder="temporary abbr"> -->
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label"><font color="red"> * </font>Project: </label>
                            <div class="">
                                <select class="form-control select2 select2-hidden-accessible" id="opt_iss_project" name="opt_iss_project" required>
                                    <option value="0" selected>None</option>
                                    <?php foreach ($project as $project) { ?>
                                        <option value="<?php echo $project['project_id'] ?>"><?php echo $project['project_name'] ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label"><font color="red"> * </font>Warehouse: </label>
                            <div class="">
                                <select class="form-control select2 select2-hidden-accessible" id="opt_iss_warehouse" name="opt_iss_warehouse" required>
                                    <option value="0" selected>None</option>
                                    <?php foreach ($warehouse as $warehouse) { ?>
                                        <option value="<?php echo $warehouse['warehouse_id'] ?>"><?php echo $warehouse['warehouse_description'] ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label"><font color="red"> * </font>Date: </label>
                            <div class="">
                                <input type="date" name="issuance_date" id="issuance_date" class="form-control">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><font color="red"> * </font>Item: </label>
                                                        <div class="col-md-7">
                                                            <select class="form-control select2 select2-hidden-accessible" id="opt_iss_item" name="opt_iss_item" required>
                                                                <option value="0" selected>Select</option>
                                    <?php foreach ($item_details as $detail) { ?>
                                        <option value="<?php echo $detail['item_id']; ?>"><?php echo $detail['description']; ?></option>
                                    <?php } ?>
                                                            </select>  
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label">Unit: </label>
                                                        <div class="col-md-7">
                                                            <input type="text" name="issuance_unit" id="issuance_unit" class="form-control" readonly="true">
                                                            <input type="hidden" name="issuance_unit_id" id="issuance_unit_id" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="control-label col-md-4"><font color="red"> * </font>Available: </label>
                                                        <div class="col-md-7">
                                                            <input type="text" name="inv_available" id="inv_available" class="form-control" placeholder="Available # of item" readonly>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><font color="red"> * </font>Quantity: </label>
                                                        <div class="col-md-7">
                                                            <input type="number" name="issuance_qty" id="issuance_qty" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><font color="red"> * </font>Block: </label>
                                                        <div class="col-md-7">
                                                            <input type="text" name="issuance_block" id="issuance_block" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="col-md-4 control-label"><font color="red"> * </font>Lot: </label>
                                                        <div class="col-md-3">
                                                            <input type="text" name="issuance_lot" id="issuance_lot" class="form-control">
                                                        </div>
                                                        <div class="col-md-4">
                                                            <button class="btn blue col-md-12" id="add_request_item">ADD ITEM</button>
                                                        </div>
                                                    </div>
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
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="tbl_item_request" class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th>item id</th>
                                                                <th>unit id</th>
                                                                <th width="40%">Item</th>
                                                                <th width="30%">Unit</th>
                                                                <th width="10%">Qty</th>
                                                                <th width="10%">Blk</th>
                                                                <th width="10%">Lot</th>
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
                    <div class="row">
                        <div class="col-md-12" align="right">
                            <div class="col-md-10"></div>
                            <button class="btn green col-md-2" id="save_issuance" align="right">SAVE</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>