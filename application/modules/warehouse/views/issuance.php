<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">List of Receiving Reports</span>
<div class="form-horizontal">
</div>
<div class="actions"> 

</div>
</div>
<!-- <div class="form-group"> -->
  <div class="tab-content">
      <div class="tab-pane active" id="tab-realty">
          <div class="portlet light ">
             <div class="portlet-title">
                  <div class="caption font-green-sharp">
                      <!-- <i class="icon-speech font-green-sharp"></i> -->
                      <!-- <span class="caption-subject bold uppercase">Receiving Report</span> -->
                  </div>
              </div>
              <div class="portlet-body">
                  <div class="row">
                      <div class="col-md-4">
                          <table class="table table-hover" id="po_table" style="color: #525e64!important;">
                              <thead>
                                  <tr id="thead">
                                      <th>ISSUANCE ID</th>
                                      <th>REQUESTOR</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $previous_issuance_id = 0;
                                    $current_issuance_id = 0;
                                    foreach($MR_details as $detail){
                                      $current_issuance_id = $detail['issuance_id'];
                                      if($current_issuance_id != $previous_issuance_id) { ?>
                                      <tr id="tbody">
                                        <td><?php echo $detail['issuance_id']; ?></td>
                                        <td><?php echo $detail['lastname'] . ", " . $detail['firstname']; ?></td>
                                      </tr>
                                  <?php $previous_issuance_id = $detail['issuance_id'];
                                    }
                                  } ?>
                                  </tbody>
                          </table>  
                      </div>
                      <form class="col-md-8" action="<?=base_url()?>Warehouse/admin_issuance/process_issuance" method="post" style="color: #525e64!important;">
                        <input id="po_url" type="hidden" value="<?=base_url();?>Warehouse/adminsaving/verify">
                        <div class="portlet-body form">
                <div class="form-body">
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label class="control-label"><font color="red"> * </font>Project: </label>
                            <div class="">
                                <select class="form-control select2 select2-hidden-accessible" id="opt_iss_project" name="opt_iss_project" required>
                                    <option value="0">None</option>
                                    <?php foreach ($project as $project) { ?>
                                        <option value="<?php echo $project['project_id']; ?>" id="project_<?php echo $project['project_id']; ?>"><?php echo $project['project_name']; ?></option>
                                    <?php } ?>
                                </select>  
                            </div>
                        </div>
                        <div class="form-group col-md-3">
                            <label class="control-label"><font color="red"> * </font>Warehouse: </label>
                            <div class="">
                                <select class="form-control select2 select2-hidden-accessible" id="opt_iss_warehouse" name="opt_iss_warehouse" required>
                                    <option value="0">None</option>
                                    <?php foreach ($warehouse as $warehouse) { ?>
                                        <option value="<?php echo $warehouse['warehouse_id']; ?>" id="warehouse_<?php echo $warehouse['warehouse_id']; ?>"><?php echo $warehouse['warehouse_description']; ?></option>
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
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                </div>
                                <div class="portlet-body form">
                                    <div class="form-horizontal">
                                        <div class="form-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <table id="tbl_issuance_detail" class="table table-bordered">
                                                      <thead>
                                                          <tr>
                                                              <th>Issuance ID</th>
                                                              <th width="20%">Item</th>
                                                              <th width="10%">Unit</th>
                                                              <th width="10%">Qty</th>
                                                              <th width="10%">Issued</th>
                                                              <th width="10%">Blk</th>
                                                              <th width="10%">Lot</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                      </tbody>
                                                  </table>
                                                  <input type="hidden" name="inc" id="inc">
                                                  <input type="hidden" name="issuance_id" id="is_id">
                                                  <input type="hidden" name="issuance_button" id="issuance_button">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12" align="right" id="save_issuance_div" style="display: none;">
                            <div class="col-md-10"></div>
                            <button class="btn green col-md-2" id="approve_issuance" align="right">SAVE</button>
                            <button class="btn red col-md-2" id="cancel_issuance" align="right">CANCEL</button>
                        </div>
                        <div class="col-md-12" align="right" id="approved_issuance" style="display: none;">
                            <div class="col-md-10"></div>
                            <button type="button" class="btn green col-md-2" align="right" disabled>APPROVED</button>
                        </div>
                        <div class="col-md-12" align="right" id="cancelled_issuance" style="display: none;">
                            <div class="col-md-10"></div>
                            <button type="button" class="btn red col-md-2" align="right" disabled>CANCELLED</button>
                        </div>
                    </div>
                </div>
            </div>
                      </form>
                    </div>
                  </div>
              </div>
          </div>
        </form>
      </div>
  </div>
</div>
</div>
</div>
</div>