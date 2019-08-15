<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Receiving Report </span>
            </div>
            <div class="actions"> 
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Get PDF</button>
            </div>
        </div>
        <?php $i = 0; ?>
        <div class="portlet-body">
            <form id="po_form" class="form-horizontal" action="<?=base_url()?>Warehouse/adminsaving/po_confirm" method="post">
                <div class="row">
                    <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Payable To:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $rrDetails[0]['department_name']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Received From:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $rrDetails[0]['prf_id'];
                                        $pod_ids = array(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Address:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="hidden" id="po_id" name="po_id" value="<?php echo $rrDetails[0]['po_id']; ?>">
                                    <input type="hidden" id="rr_id" name="rr_id" value="<?php echo $rrDetails[0]['rr_id']; ?>">
                                    <?php echo $rrDetails[0]['po_id']; ?>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> RR No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $rrDetails[0]['prf_id'];
                                        $pod_ids = array(); ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="date" name="po_date" value="<?php echo $rrDetails[0]['po_date']; ?>" <?php // echo ($rrDetails[0]['po_admin_status']) ? "readonly" : ""; ?> readonly>
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                        <div style="max-width:3000px; white-space: nowrap;">
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
                                    <?php foreach($rrDetails as $poDetail) { ?>
                                        <tr>
                                            <td><?php echo $poDetail['po_item_remark']; ?><input type="hidden" name="<?php echo $poDetail['pod_id']; ?>-pod_id" value="<?php echo $poDetail['pod_id']; ?>"></td>
                                            <td>
                                                <select name="<?php echo $poDetail['pod_id']; ?>-po_uom" disabled>
                                                    <option value="0" <?php echo $poDetail['uom_id'] == 0 ? 'selected' : ''; ?>>None</option>
                                                    <option value="<?php echo $poDetail['uom_id']; ?>" <?php echo $poDetail['uom_id'] == $poDetail['po_uom_id'] ? 'selected' : ''; ?>><?php echo $poDetail['uom_name']; ?></option>
                                                </select>
                                            </td>
                                            <td></td>
                                            <td><?php echo $poDetail['warehouse_description']; ?></td>
                                            <td><?php echo $poDetail['po_price']; ?></td>
                                            <td id="td_qty"><input type="hidden" class="qty" value="<?php echo $poDetail['po_qty']; ?>"><?php echo $poDetail['po_qty']; ?></td>
                                            <td id="td_qty"><input type="number" class="received" name="<?php echo $poDetail['pod_id']; ?>-pod_item_qty_received" value="<?php echo ($rrDetails[0]['po_admin_status']) ? $poDetail['po_received'] : $poDetail['po_qty'] ?>"
                                                <?php echo ($rrDetails[0]['po_admin_status']) ? 'value="'.$poDetail['po_received'].'" readonly' : 'value="'.$poDetail['po_qty'].'"' ?>>
                                            </td>
                                            <td><?php echo $poDetail['po_subtotal']; ?></td>
                                        </tr>
                                    <?php $i++; } ?>
                                </tbody>
                            </table>
                            <input type="hidden" name="inc" value="<?php echo $i; ?>">
                        </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Non-VAT Amount:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <!-- <input type="text"> -->
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Input TAX:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <!-- <input type="text"> -->
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Net Amount Due:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <!-- <input type="text"> -->
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> VATable Amount:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <!-- <input type="text"> -->
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Withholding Tax:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <!-- <input type="text"> -->
                                </p>
                            </div>
                        </div>
                    </div>
                    </div>
                    <hr>
                    <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Delivery Receipt No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="number" id="dr_no" name="dr_no" value="<?php echo ($rrDetails[0]['delivery_receipt_number']); ?>" <?php echo ($rrDetails[0]['po_admin_status']) ? 'readonly' : '' ?>>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Invoice No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="number" id="invoice_no" name="invoice_no" value="<?php echo ($rrDetails[0]['invoice_number']); ?>" <?php echo ($rrDetails[0]['po_admin_status']) ? 'readonly' : '' ?>>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PRF No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $rrDetails[0]['prf_id']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PO No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $rrDetails[0]['po_id']; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requisitioned by:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <!-- <input type="text"> -->
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">                        
                        <div class="form-group">
                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Received by/Date Received:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <input type="date" name="po_date_received" value="<?php echo $rrDetails[0]['po_date_received']; ?>" <?php echo ($rrDetails[0]['po_admin_status']) ? "readonly" : ""; ?> required>
                                </p>
                            </div>
                        </div>
                        <!-- <div class="form-group">
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <button type="submit" class="form-control btn btn-circle blue">Save</button>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <p class="form-control-static">
                                    <button type="submit" class="form-control btn btn-circle red">Discard</button>
                                </p>
                            </div>
                        </div> -->
                    </div>
                    </div>
                </div>
            <br>
            <?php if($rrDetails[0]['po_admin_status'] == 'COMPLETE' || $rrDetails[0]['po_admin_status'] == 'complete' ) { ?>
                <button class="btn btn btn-xs green status_action" disabled>SAVED</button>
            <?php } elseif($rrDetails[0]['po_admin_status'] == 'INCOMPLETE' || $rrDetails[0]['po_admin_status'] == 'incomplete') { ?>
                <button class="btn btn btn-xs red status_action" disabled>CANCELED</button>
            <?php } else { ?>
                <div class="po_buttons">
                    <button type="submit" id="status_confirm" class="form-control btn btn-circle green" style="margin-bottom: 10px;" data-value="complete">APPROVED</button>
                    <button type="submit" id="status_confirm"  class="form-control btn btn-circle red" data-value="incomplete">DENIED</button>
                </div>
                <input type="hidden" id="status_clicked" name="status_clicked" value="">
            <?php } ?>
            </form>
        </div>
    </div>
</div>