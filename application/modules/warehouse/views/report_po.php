<div class="tab-pane" id="tab-po_list">
    <div class="row">
        <form id="po_form" class="form-horizontal" action="<?=base_url()?>Warehouse/report_controller/po_confirm" method="post">
            <div class="col-md-6">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="bold">PO Lists</span>
                        </div> 
                    </div>
                    <?php $i = 0; ?>
                    <input type="hidden" id="itemAvailability" value="<?php echo $itemAvailability; ?>">
                    <div class="portlet-body form">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PAYABLE TO:</span></label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">
                                                    <?php if($poDetails[0]['client_type_id'] == 1) {
                                                        echo $poDetails[0]['lastname'] + ", " + $poDetails[0]['firstname'];
                                                    } else if($poDetails[0]['client_type_id'] == 2){
                                                        echo $poDetails[0]['organization_name'];
                                                    }?>
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
                                                    <input type="hidden" id="po_id" name="po_id" value="<?php echo $poDetails[0]['po_id']; ?>">
                                                    <?php echo $poDetails[0]['po_id']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">
                                                    <?php echo $poDetails[0]['date_needed']; ?>
                                                </p>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                           <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Received:</span></label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">
                                                    <?php echo ($poDetails[0]['po_date_received']) ? $poDetails[0]['po_date_received'] : ''; ?>
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
                                        </div>
                                        <div class="caption">
                                            <span class="bold uppercase">Delivery Details </span>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Mode of Delivery:</span></label>
                                            <div class="col-md-9">
                                                <p class="form-control-static">
                                                    <input type="radio" name="po_mod" value="pick_up"> Pick Up
                                                    <br>
                                                    <input type="radio" name="po_mod" value="delivery"> Delivery
                                                </p>
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
                        <div class="caption">
                            <span class="bold">PO details</span>
                        </div>
                        <div class="actions">
                            <button align="right" type="button" class="btn btn-default" data-toggle="modal" id="generate_receiving_report" >Confirm Receiving</button>
                            <button align="right" type="button" class="btn btn-default" data-toggle="modal" id="cancel_po" >Cancel Receiving</button>
                        </div> 
                    </div>
                    <div class="portlet-body form">
                        <div class="form-horizontal">
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-10">
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"><font color="red"> * </font>Delivery Receipt: </label>
                                            <div class="col-md-8">
                                                <input type="number" id="dr_no" name="dr_no" value=0>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-4 control-label"><font color="red"> * </font>Invoice: </label>
                                            <div class="col-md-8">
                                                <input type="number" id="invoice_no" name="invoice_no" value=0>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
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
                                                                <select name="<?php echo $poDetail['pod_id']; ?>-po_uom" <?php echo ($poDetails[0]['po_status']) ? 'disabled' : '' ?>>
                                                                    <option value="0" <?php echo $poDetail['uom_id'] == 0 ? 'selected' : ''; ?>>None</option>
                                                                    <option value="<?php echo $poDetail['uom_id']; ?>" <?php echo $poDetail['uom_id'] == $poDetail['po_uom_id'] ? 'selected' : ''; ?>><?php echo $poDetail['uom_name']; ?></option>
                                                                </select>
                                                            </td>
                                                            <td><input type="hidden" name="<?php echo $poDetail['pod_id']; ?>-item_qty" value="<?php echo $poDetail['po_qty']; ?>"><?php echo $poDetail['po_qty']; ?></td>
                                                            <td><input type="number" name="<?php echo $poDetail['pod_id']; ?>-pod_item_qty_received" value="<?php echo $poDetail['po_qty']; ?>">
                                                            </td>
                                                            <td><?php echo $poDetail['description']; ?></td>
                                                            <td><?php echo $poDetail['po_price']; ?></td>
                                                            <td><?php echo $poDetail['po_subtotal']; ?></td>
                                                        </tr>
                                                    <?php $i++; } ?>
                                                </tbody>
                                            </table>
                                        <input type="hidden" name="inc" value="<?php echo $i; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>