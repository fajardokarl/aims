<div class="row">
    <div class="col-md-6">
        <div class="portlet grey-cascade box">
            <div class="portlet-title">
                <div class="caption">
                    <span class="bold">Issuance Masterlist</span>
                </div> 
            </div>
            <div class="portlet-body form">
                <div class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table id="tbl_issuances" class="table table-bordered">
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
                                        $previous_issuance_id = 0;
                                        $current_issuance_id = 0;
                                        foreach($MR_details as $detail) {
                                            $current_issuance_id = $detail['issuance_id'];
                                            if($current_issuance_id != $previous_issuance_id) { 
                                            ?>
                                            <tr>
                                                <td><?php echo $detail['issuance_id']; ?></td>
                                                <td><?php echo $detail['issuance_date']; ?></td>
                                                <td><?php echo $detail['lastname'] . ", " . $detail['firstname']; ?></td>
                                                <td><?php echo $detail['issuance_project']; ?></td>
                                                <td><?php echo $detail['warehouse_description']; ?></td>
                                            </tr>
                                            <?php }
                                            $previous_issuance_id = $detail['issuance_id'];
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
    <form class="col-md-6" action="<?=base_url()?>Warehouse/materialsrequest/confirm_issuance" method="post">
    <!-- <div class="col-md-6"> -->
        <div class="portlet grey-cascade box">
            <div class="portlet-title">
                <div class="caption">
                    <span class="bold">Issuance details</span>
                </div> 
                <div class="actions">
                    <button align="right" type="submit" class="btn btn-default" data-toggle="modal" id="confirm_issuance" >Confirm Issuance</button>
                    <button align="right" type="button" class="btn btn-default" data-toggle="modal" id="cancel_issuance" >Cancel Issuance</button>
                </div> 
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
                                            <th width="40%">Item</th>
                                            <th width="30%">Unit</th>
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <!-- </div> -->
    </form>
</div>
<!-- <div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">List of all Materials Requested </span>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-12"> -->
<!-- <div class="form-group">
<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<input id="po_url" type="hidden" value="http://localhost/abci/Message/Message/update_seen_receipt">
<table id="mr_table" class="table table-hover">
<thead>
<tr>
    <th>Id</th>  
    <th>Project</th>  
    <th>Material/s</th>
    <th>Unit</th>
    <th>Quantity</th>
    <th>Block & Lot</th>
    <th>Requested By</th>
    <th>Date Requested</th>
</tr>
</thead>
<tbody> -->
    <?php foreach($MR_details as $detail) { ?>
    <!-- <tr>
        <td><?php echo $detail['materials_requisition_id']; ?></td>
        <td><?php echo $detail['department_project']; ?></td>
        <td><?php echo $detail['description']; ?></td>
        <td><?php echo $detail['uom_name']; ?></td>
        <td><?php echo $detail['material_quantity']; ?></td>
        <td><?php echo "BLOCK: " . $detail['material_block'] . " LOT: " . $detail['material_lot']; ?></td>
        <td><?php echo $detail['lastname'] . ", " . $detail['firstname']; ?></td>
        <td><?php echo $detail['request_date']; ?></td>
    </tr> -->
    <?php } ?>
<!-- </tbody>
</table>
</div>
</div>
</div>
</div>


</div>
</div>
</form>

</div>
</div> -->
</div>

