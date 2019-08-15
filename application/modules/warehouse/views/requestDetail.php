<div class="portlet grey-cascade box">
    <div class="portlet-title">
        <div class="caption">
                <i class="fa fa-pencil"></i>
                <span class="bold uppercase">Materials Requisition</span>
            </div>
    </div>
    <div class="portlet-body form">
    <form id="mr_form" action="<?=base_url()?>Warehouse/materialsrequest/generate_mr" method="post">
        <div class="form-horizontal">
            <div class="form-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Department / Project: </label>
                            <div class="col-md-6">
                                <input type="text" name="department_project" id="department_project" class="form-control" value="<?php echo $MR_details[0]['department_project']; ?>" disabled="true" required>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Materials Description: </label>
                            <div class="col-md-6">
                                <select name="material_item" id="material_item" disabled="true" required>
                                    <?php foreach ($item_details as $detail) { ?>
                                        <option value="<?php echo $detail['item_id']; ?>"><?php echo $detail['description']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Unit:</label>
                            <div class="col-md-4">
                                <input type="text" name="material_uom" id="material_uom" value="<?php echo $MR_details[0]['uom_name']; ?>" disabled="true">
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Quantity:</label>
                            <div class="col-md-4">
                                <input type="number" name="quantity" id="quantity" class="form-control" value="<?php echo $MR_details[0]['quantity']; ?>" disabled="true" required>
                            </div>
                        </div>
                                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Block:</label>
                            <div class="col-md-2">
                                <input type="text" name="block" id="block" class="form-control" value="<?php echo $MR_details[0]['material_block']; ?>" disabled="true" required>
                            </div>
                        </div>
                                       
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Lot:</label>
                            <div class="col-md-2">
                                <input type="text" name="lot" id="lot" class="form-control" value="<?php echo $MR_details[0]['material_lot']; ?>" disabled="true" required>
                            </div>
                        </div>
                                       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Requested By: </label>
                            <div class="col-md-6">
                                <select name="requested_by" id="requested_by" required>
                                    <?php foreach ($employee_details as $detail) { ?>
                                        <option value="<?php echo $detail['employee_id']; ?>"><?php echo $detail['lastname'] . ", " . $detail['firstname']; ?></option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>                   
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Date Requested: </label>
                            <div class="col-md-4">
                                <input type="date" name="date_requested" id="date_requested" class="form-control" value="<?php echo $MR_details[0]['request_date']; ?>" disabled="true" required>
                            </div>
                        </div>
                        <input type="hidden" name="mr_id" id="mr_id" value="<?php echo $MR_details[0]['materials_requisition_id']; ?>">
                        <div class="form-group">
                            <button style="margin-left: 25%" type="button" class="btn btn-default btn-sm green-meadow" id="generate_materials_issuance_slip"><i class="fa fa-plus"> </i>Generate Materials Issuance Slip</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>