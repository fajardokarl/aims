<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line tabbable-full-width ">
            <ul class=" nav nav-tabs">
                <li class="active">
                    <a href="#tab-po_inputs" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                Receiving
                            </span>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="#tab-po_list" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                Issuance
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="actions">
            <a class="btn circle blue hidden-print"  id="print">Print
            <i class="fa fa-print"></i></a>
            <a class="btn circle blue hidden-print"  id="xls">Excel
            <i class="fa fa-print"></i></a>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-po_inputs">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet grey-cascade box">
                            <div class="portlet-body">
                                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="po_table" style="color: #525e64!important;">
                        <thead>
                        <tr>
                            <th>PO no</th>  
                            <th>Supplier</th>
                            <th>Terms of Payment</th>
                            <th>PO Date</th>
                            <th>Loc/Proj/Dept</th>
                            <th>PRF no</th>
                            <th>PRF date</th>
                            <th>Date Nedeed</th>
                            <th>Date Recieved</th>
                            <th>Warehouse Status</th>
                            <th>Admin Status</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $previous_po_id = 0;
                          $current_po_id = 0;
                          foreach($PO_details as $PO_details){
                            $current_po_id = $PO_details['po_id'];
                            if($current_po_id != $previous_po_id && (strtoupper($PO_details['po_admin_status']) == "INCOMPLETE" || $PO_details['po_status'] == "cancelled")) { ?>
                            <tr>
                              <td><?php echo $PO_details['po_id']; ?></td>           
                              <td><?php echo $PO_details['supplier_id'] ;?></td>
                              <td><?php echo $PO_details['TOP']; ?></td>
                              <td><?php echo $PO_details['po_date']; ?></td>               
                              <td><?php echo $PO_details['department_name'] ;?></td>  
                              <td><?php echo $PO_details['POprf_id']; ?></td>    
                              <td><?php echo $PO_details['date_requested'] ;?></td>
                              <td><?php echo $PO_details['date_needed'] ;?></td>
                              <td><?php echo $PO_details['po_date_received'] ;?></td>
                              <td><?php echo strtoupper($PO_details['po_status']) ;?></td>
                              <td><?php echo strtoupper($PO_details['po_admin_status']) ;?></td>
                            </tr>
                          <?php $previous_po_id = $PO_details['po_id'];
                            } ?>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="tab-pane" id="tab-po_list">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet grey-cascade box">
                            <div class="portlet-body">
                                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tbl_issuances" style="color: #525e64!important;">
                        <thead>
                                        <tr>
                                            <th>Issuance ID</th>
                                            <th>Date</th>
                                            <th>Requestor</th>
                                            <th>Project</th>
                                            <th>Warehouse</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        // $previous_issuance_id = 0;
                                        // $current_issuance_id = 0;
                                        foreach($MR_details as $detail) {
                                            // $current_issuance_id = $detail['issuance_id'];
                                            // if($current_issuance_id != $previous_issuance_id && $detail['issuance_status'] == "CANCELLED") { 
                                            ?>
                                            <tr>
                                                <td><?php echo $detail['issuance_id']; ?></td>
                                                <td><?php echo $detail['issuance_date']; ?></td>
                                                <td><?php echo $detail['lastname'] . ", " . $detail['firstname']; ?></td>
                                                <td><?php echo $detail['issuance_project']; ?></td>
                                                <td><?php echo $detail['warehouse_description']; ?></td>
                                            </tr>
                                            <?php // }
                                            // $previous_issuance_id = $detail['issuance_id'];
                                        } ?>
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
</div>

<div class="modal fade bs-modal-md" id="modal_rcv_item" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <div class="caption">
                    <span class="bold">Item Receiving</span>
                </div> 
            </div>
            <div class="modal-body form">
                <div class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="bold">Unserved qty : <span id="unserved_qty"></span></h4>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><font color="red"> * </font>Qty Received: </label>
                                    <div class="col-md-8">
                                        <input type="text" name="item_qty_rcv" id="item_qty_rcv" class="form-control">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-3 control-label"><font color="red"> * </font>Remarks: </label>
                                    <div class="col-md-8">
                                        <textarea  rows="3" name="item_remark_rcv" id="item_remark_rcv" class="form-control"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn gray" id="btn_cancel" data-dismiss="modal">Close</button>
                <button type="button" class="btn green" id="btn_rcv_item" name="btn_rcv_item">Receive Item</button>
            </div>
        </div>
    </div>
</div>