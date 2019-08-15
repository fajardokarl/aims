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
                                <input type="text" name="department_project" id="department_project" class="form-control" required>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Materials Description: </label>
                            <div class="col-md-6">
                                <select name="material_item" id="material_item" required>
                                </select>
                            </div>
                        </div>
                                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Unit:</label>
                            <div class="col-md-4">
                                <select name="material_uom" id="material_uom" required>
                                    <option value="0">None</option>
                                </select>
                            </div>
                        </div>
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Quantity:</label>
                            <div class="col-md-4">
                                <input type="number" name="quantity" id="quantity" class="form-control" required>
                            </div>
                        </div>
                                        
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Block:</label>
                            <div class="col-md-2">
                                <input type="text" name="block" id="block" class="form-control" required>
                            </div>
                        </div>
                                       
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Lot:</label>
                            <div class="col-md-2">
                                <input type="text" name="lot" id="lot" class="form-control" required>
                            </div>
                        </div>
                                       
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                             <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Requested By: </label>
                            <div class="col-md-6">
                                <select name="requested_by" id="requested_by" required>
                                </select>
                            </div>
                        </div>                   
                    
                        <div class="form-group">
                            <label class="col-md-4 control-label"><font color="red"> * </font>Date Requested: </label>
                            <div class="col-md-4">
                                <input type="date" name="date_requested" id="date_requested" class="form-control" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <button style="margin-left: 25%" type="submit" class="btn btn-default btn-sm green-meadow"><i class="fa fa-plus"> </i>Save</button>
                            <button type="button" class="btn btn-default btn-sm btn-primary" id="generate_receiving_report"><i class="fa fa-minus"> </i>Clear</button>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
</div>