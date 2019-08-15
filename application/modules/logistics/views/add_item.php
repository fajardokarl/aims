<div class="tab-content">
    <div class="tab-pane active" id="tab_0">
        <div class="portlet box green">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-gift"></i>Item Form </div>
                <div class="tools">                 
                    <a href="javascript:;" class="reload"> </a>                  
                </div>
            </div>
            <div class="portlet-body form">
                <!-- BEGIN FORM-->              
                <form action="#" method="post" class="form-horizontal">
                    <input type="hidden" value="1" name="status_id" id="status_id">
                    <div class="form-body">
                        <div class="form-group">
                            <label class="col-md-4 control-label">Item Description</label>
                            <div class="col-md-4">
                                <input type="text" id="description" name="description" class="form-control input-circle" placeholder="Enter text">                          
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Category Code</label>
                            <div class="col-md-4">
                                <input type="text" id="category_code" name="category_code" class="form-control input-circle" placeholder="Enter text">
                                
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-4 control-label">Legacy Item ID</label>
                            <div class="col-md-4">
                                <input type="text" id="legacy_itemid" name="legacy_itemid" class="form-control input-circle" placeholder="Enter text">
                                
                            </div>
                        </div>
                    </div>
                <div class="form-actions">
                <div class="row">

                    <div class="actions">
                    <div class="col-md-offset-5 col-md-9">
                        <button type="submit" class="btn btn-circle green">Submit</button>
                        <button type="button" class="btn btn-circle grey-salsa btn-outline">Cancel</button>
              
                    <a href="<?=base_url()?>logistics/view_item" align="right" class="btn green-meadow" id="btnAddNewUser"><span class="fa fa-plus"></span>View Items</a>

                    <?php if ($this->session->flashdata('msg')) {?>
                    <div id="notifications"><?php echo $this->session->flashdata('msg');?></div>
                                <?php }?>
                    </div>

                </div>
                </div>       
                </div>      
                </form>
                <!-- END FORM-->
            </div>
        </div>
    </div>
</div>