<style type="text/css">
    .modleft {
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }
</style>

<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Details </span>
</div>

<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" 
<?php switch ($prf->is_cancel) {
    case 0:
        echo 'class="btn btn btn-xl green status_action">Active';
        break;                                      
    case 1:
        echo 'class="btn btn btn-xl red status_action">Cancel';
        break; 
}
 ?>
 >
</button>
</div>

<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Get PDF</button>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-6">
<!-- <div class="form-group"> -->
    
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PR No:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->prf_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $prf->prf_id; ?>">
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->firstname; echo $prf->middlename; echo " "; echo $prf->lastname; ?>
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->date_needed; ?>
        </p>
    </div> 
</div>


</div>
<div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->purpose; ?>
        </p>
    </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Justification:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->justification; ?>
        </p>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo "&#8369; " . number_format($prf->total_amount, 2); ?>
        </p>
    </div> 
</div>        
    </div>

<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="capex_table">
<thead>
<tr>
    <th>PRF ID</th>
    <th>Request type</th>
    <th>Item Description</th>
    <th>Quantity</th>

    <th>Amount</th>
    <th>Total</th>

    <th>Remarks</th>
   <!--  <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php foreach($details as $details){ ?>
    <tr>
        <td><?php echo $details['prf_detail_id']; ?></td>
        

<td>
           <?php 
                if ($details['budgeted'] == "budgeted") {
                    echo "<span class='font-red-intense bold'>Unbudgeted</span>";
                }else{
                    echo "<span class='font-green-jungle bold'>Budgeted</span>";
                }
            ?>
       </td>

        <td><?php echo $details['description'] ;?></td>
        <td><?php echo $details['qty'].' '.$details['uom_code']; ?></td>
<!--         <td><?php echo $details['uom_code']; ?></td> -->
        <td><?php echo "&#8369; " . number_format ($details['amount']) ;?></td>
        <td><?php echo "&#8369; " . number_format ($details['sub_total']); ?></td>
      
        <td><?php echo $details['remarks']; ?></td>
    
    </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>
</div>


</div>
</div>
</form>

</div>
</div>
</div>

<!-- <div style="" class="modal fade modal-sm modcenter" id="frm_status" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <div class="caption font-green-sharp">
                    <i class="fa fa-book font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Action</span>
                    <button type="button" class="close" id="btn_closestatus" tabindex="-1" data-dismiss="modal"></button>
                </div>
            </div>
            <div class="portlet light">
                <form action="<?=base_url()?>logistics/prf_list_controller/cancelStatus" method="post">
                    <div class="form-group">
                        <input type="hidden" name="mod_prf_id" id="mod_prf_id">
                        <input type="hidden" name="mod_statusid" id="mod_statusid">
                        <button type="submit" id="status_approve" class="form-control btn btn-circle green" style="margin-bottom: 10px;">Activate</button>
                        <button type="submit" id="status_deny" class="form-control btn btn-circle red">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div> -->


<div class="modal fade bs-modal-xs" id="frm_status" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xm">
<div class="modal-content">
<div class="modal-header">
<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
<h4 class="modal-title" id="" style="font-weight: bold;">Option</h4>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="note note-default">
<!-- <div class="portlet-body"> -->
<div class="col-md-12" style="margin-top: 20px;">
<h3 class="text" id="txt_status">Choose cancel to deactivate PRF</h3>
</div>
<input type="hidden" id="prf_id">
<div class="col-md-4" style="margin-top: 15px;">

</div>
<font color="white" style="">.</font>
<!-- </div> -->
</div>
</div>
</div>

          <button type="button" class="close" id="btn_closestatus" tabindex="-1" data-dismiss="modal"></button>
                </div>
            </div>
            <div class="portlet light">
                <form action="<?=base_url()?>logistics/prf_list_controller/cancelStatus" method="post">
                    <div class="form-group">
                        <input type="hidden" name="mod_prf_id" id="mod_prf_id">
                        <input type="hidden" name="mod_statusid" id="mod_statusid">
                        <button type="submit" id="status_approve" class="form-control btn btn-circle green" style="margin-bottom: 10px;">Activate</button>
                        <button type="submit" id="status_deny" class="form-control btn btn-circle red">Cancel</button>
                    </div>
                    <div align="right">
<!-- <button id="confirm_print" class="btn blue">Print Sticker</button> -->
<button id="" class="btn red" data-dismiss="modal">close</button>

</div>
                </form>
            </div>


</div>
<div class="modal-footer">

</div>
</div>
</div>
</div>