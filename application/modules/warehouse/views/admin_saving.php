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
                                      <th>RR No</th>  
                                      <th>PO No</th>
                                      <th>PRF No</th>
                                      <th>Date</th>
                                  </tr>
                                  </thead>
                                  <tbody>
                                  <?php $previous_rr_id = 0;
                                    $current_rr_id = 0;
                                    foreach($RR_details as $RR_detail){
                                      $current_rr_id = $RR_detail['rr_id'];
                                      if($RR_detail['po_status'] && $current_rr_id != $previous_rr_id) { ?>
                                      <tr id="tbody">
                                        <td><?php echo $RR_detail['rr_id']; ?></td>           
                                        <td><?php echo $RR_detail['po_id'] ;?></td>
                                        <td><?php echo $RR_detail['POprf_id']; ?></td>
                                        <td><?php echo $RR_detail['po_date']; ?></td>
                                      </tr>
                                  <?php $previous_rr_id = $RR_detail['rr_id'];
                                    }
                                  } ?>
                                  </tbody>
                          </table>  
                      </div>
                      <form class="col-md-8" action="<?=base_url()?>Warehouse/adminsaving/po_confirm" method="post" style="color: #525e64!important;">
                        <input id="po_url" type="hidden" value="<?=base_url();?>Warehouse/adminsaving/verify">
                        <input type="hidden" id="inc" name="inc">
                        <input type="hidden" id="po_id" name="po_id">
                        <input type="hidden" id="rr_id" name="rr_id">
                        <input type="hidden" id="itemAvailability" name="itemAvailability">
                        <div class="portlet grey-cascade box">
                            <div class="portlet-title">
                            </div>
                            <div class="portlet-body">
                              <div class="tabbable-line tabbable-full-width row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                    <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Payable To:</span></label>
                                    <div>
                                        <p class="form-control-static" id="payable_to">
                                        </p>
                                    </div>
                                  </div>
                                  <div class="form-group">
                                    <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Mode of Delivery:</span></label>
                                    <div>
                                        <p class="form-control-static" id="mod">
                                        </p>
                                    </div>
                                  </div>
                                <!--   <div class="form-group">
                                      <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Received From:</span></label>
                                      <div>
                                          <p class="form-control-static" id="received_from">
                                          </p>
                                      </div>
                                  </div> -->
                                  <!-- <div class="form-group">
                                    <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Address:</span></label>
                                      <div>
                                          <p class="form-control-static" id="po_id">
                                          </p>
                                    </div>
                                  </div> -->
                                </div>
                                <div class="col-md-6">                        
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> RR No:</span></label>
                                      <div>
                                          <p class="form-control-static" id="rr_no">
                                          </p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date:</span></label>
                                      <div>
                                          <p class="form-control-static">
                                              <input type="date" id="po_date" name="po_date">
                                          </p>
                                      </div>
                                  </div>
                                </div>
                              </div>
                              <div class="tab-content">
                                <table class="table table-hover" id="sent_prf_table">
                                  <thead>
                                    <tr>
                                      <th>Item Description</th>
                                      <th>Packaging</th>
                                      <th>VAT</th>
                                      <th>WH Type</th>
                                      <th>Unit Cost</th>                            
                                      <th>PO Qty.</th>
                                      <th>RCD Qty.</th>
                                      <th>Total Amount</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </div>
                              <div class="tabbable-line tabbable-full-width row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Non-VAT Amount:</span></label>
                                      <div>
                                          <p class="form-control-static" id="non-vat_amount">
                                          </p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Input TAX:</span></label>
                                      <div>
                                          <p class="form-control-static" id="input_tax">
                                          </p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Net Amount Due:</span></label>
                                      <div>
                                          <p class="form-control-static" id="net_amount_due">
                                          </p>
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> VATable Amound:</span></label>
                                      <div>
                                          <p class="form-control-static" id="vatable_amount">
                                          </p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Withholding Tax:</span></label>
                                      <div>
                                          <p class="form-control-static" id="withholding_tax">
                                          </p>
                                      </div>
                                  </div>
                                </div>
                              </div><hr>
                              <div class="tabbable-line tabbable-full-width row">
                                <div class="col-md-6">
                                  <div class="form-group">
                                      <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Delivery Receipt No:</span></label>
                                      <div>
                                          <input type="number" id="dr_no" name="dr_no">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                      <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Invoice No:</span></label>
                                      <div>
                                          <input type="number" id="invoice_no" name="invoice_no">
                                      </div>
                                  </div>
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> PRF No:</span></label>
                                      <div>
                                          <p class="form-control-static" id="prf_no">
                                          </p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> PO No:</span></label>
                                      <div>
                                          <p class="form-control-static" id="po_no">
                                          </p>
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-6">
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requisitioned By:</span></label>
                                      <div>
                                          <p class="form-control-static" id="requisitioned_by">
                                            Hello
                                          </p>
                                      </div>
                                  </div>
                                  <div class="form-group">
                                     <label class="control-label"><span class="caption-subject font-grey-mint bold uppercase"> Received By/Date Received:</span></label>
                                      <div>
                                          <input type="date" id="po_date_received" name="po_date_received">
                                      </div>
                                  </div>
                                </div>
                            </div>
                            <button class="btn btn btn-xs green status_action saved" style="display: none;" disabled>SAVED</button>
                            <button class="btn btn btn-xs red status_action canceled" style="display: none;" disabled>CANCELLED</button>
                            <div class="po_buttons" style="display: none;">
                              <button type="submit" id="status_confirm" class="form-control btn btn-circle green" style="margin-bottom: 10px;" data-value="complete">RECEIVE</button>
                              <button type="submit" id="status_confirm"  class="form-control btn btn-circle red" data-value="incomplete">DENY</button>
                              <input type="hidden" id="status_clicked" name="status_clicked">
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