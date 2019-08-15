<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Purchase Order </span>
            </div>
            <div class="actions"> 
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Get PDF</button>
            </div>
        </div>
        <?php $i = 0; ?>
        <div class="portlet-body">
            <form id="po_form" class="form-horizontal" action="<?=base_url()?>Accounting/Purchaseorder/po_confirm" method="post">
                <input type="hidden" id="itemAvailability" value="<?php echo $itemAvailability; ?>">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department Name:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['department_name']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PRF No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['prf_id'];
                                        $pod_ids = array(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PO No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="hidden" name="po_id" id="po_id" value="<?php echo $poDetails[0]['po_id']; ?>">
                                    <?php echo $poDetails[0]['po_id']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Received:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="date" name="po_date" value="<?php echo $poDetails[0]['po_date']; ?>" <?php echo ($poDetails[0]['po_accounting_status']) ? "readonly" : ""; ?>>
                                </p>
                            </div>
                        </div><br>
                        <div class="caption">
                <span class="bold uppercase">Supplier Details </span>
            </div> <br><br>
            <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Supplier ID:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['supplier_id']; ?>
                                </p>
                            </div>
                        </div>
                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Name:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['lastname'] . ', ' . $poDetails[0]['firstname']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Address:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['line_1']; ?>
                                </p>
                            </div> 
                        </div>  
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Contact No.:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php if($contactDetails[0]['contact_type_id'] == 1 || $contactDetails[0]['contact_type_id'] == 2 || $contactDetails[0]['contact_type_id'] == 5) {
                                        echo $contactDetails[0]['contact_value'];
                                    } ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> TIN #:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['tin']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Tax Type:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['tax_type_name']; ?>
                                </p>
                            </div> 
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Email Address:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php if($contactDetails[0]['contact_type_id'] == 3 || $contactDetails[0]['contact_type_id'] == 4) {
                                        echo $contactDetails[0]['contact_value'];
                                    } ?>
                                </p>
                            </div> 
                        </div> <br><br>
                        <div class="caption">
                <span class="bold uppercase">Delivery Details </span>
            </div>
            <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Mode of Delivery:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $poDetails[0]['TOP']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                <div style="max-width:3000px; white-space: nowrap;">
                    <table class="table table-hover" id="sent_prf_table">
                        <thead>
                            <tr>
                                <th>Item Name</th>
                                <th>Unit of Measurement</th>
                                <th>Quantity</th>
                                <th>Received</th>
                                <th>Description</th>                            
                                <th>Unit Price</th>
                                <th>Total Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach($poDetails as $poDetail) { ?>
                                <tr>
                                    <td>
                                        <?php echo $poDetail['po_item_remark']; ?><input type="hidden" name="<?php echo $poDetail['pod_id']; ?>-pod_id" value="<?php echo $poDetail['pod_id']; ?>">
                                        <input type="hidden" name="<?php echo $poDetail['item_id']; ?>-item_id" value="<?php echo $poDetail['item_id']; ?>">
                                    </td>
                                    <td>
                                        <select name="<?php echo $poDetail['pod_id']; ?>-po_uom" disabled>
                                            <option value="0" <?php echo $poDetail['uom_id'] == 0 ? 'selected' : ''; ?>>None</option>
                                            <option value="<?php echo $poDetail['uom_id']; ?>" <?php echo $poDetail['uom_id'] == $poDetail['po_uom_id'] ? 'selected' : ''; ?>><?php echo $poDetail['uom_name']; ?></option>
                                        </select>
                                    </td>
                                    <td id="td_qty"><input type="hidden" class="qty" value="<?php echo $poDetail['po_qty']; ?>"><?php echo $poDetail['po_qty']; ?></td>
                                    <td><input type="number" id="received_qty" name="<?php echo $poDetail['pod_id']; ?>-pod_item_qty_received" value="<?php echo $poDetail['po_received']; ?>" <?php echo ($poDetails[0]['po_accounting_status']) ? "readonly" : ""; ?>
                                     min="0" max="<?php echo $poDetail['po_qty']; ?>"></td>
                                    <td><?php echo $poDetail['description']; ?></td>
                                    <td><?php echo $poDetail['po_price']; ?></td>
                                    <td><?php echo $poDetail['po_subtotal']; ?></td>
                                </tr>
                            <?php $i++; } ?>
                        </tbody>
                    </table> <br><br>
                    <input type="hidden" name="inc" value="<?php echo $i; ?>">
                     <span class="bold uppercase">Remarks: </span> <br><br>
                     <div class="portlet-body">
                      <textarea rows="6" cols="100" name="po_accounting_status_remark" id="po_accounting_status_remark" <?php echo ($poDetails[0]['po_accounting_status']) ? "readonly" : ""; ?>><?php echo $poDetails[0]['po_accounting_remark']; ?></textarea>
                  </div>
            </div>
            </div>
            </div>
            <br>
            <?php if($poDetails[0]['po_accounting_status'] == 'COMPLETE' || $poDetails[0]['po_accounting_status'] == 'complete' ) { ?>
                <button class="btn btn btn-xs green status_action" disabled>COMPLETE</button>
            <?php } elseif($poDetails[0]['po_accounting_status'] == 'INCOMPLETE' || $poDetails[0]['po_accounting_status'] == 'incomplete') { ?>
                <button class="btn btn btn-xs red status_action" disabled>INCOMPLETE</button>
            <?php } else { ?>
                <div class="po_buttons">
                    <button type="submit" id="status_confirm" class="form-control btn btn-circle green" style="margin-bottom: 10px; display: none;" data-value="complete">COMPLETE</button>
                    <button type="submit" id="status_confirm"  class="form-control btn btn-circle red" data-value="incomplete">INCOMPLETE</button>
                </div>
                <input type="hidden" id="status_clicked" name="status_clicked" value="">
            <?php } ?>
            </form>
        </div>
    </div>
</div>