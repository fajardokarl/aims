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
<?php switch ($TO->is_cancel) {
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
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> TO No:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo$TO->to_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $TO->to_id; ?>">
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date from:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $TO->date_from; ?>
            
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $TO->purpose; ?>
        </p>
    </div> 
</div>


</div>
<div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested by:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
             <?php echo $TO->firstname; echo $TO->middlename; echo " "; echo $TO->lastname; ?>
        </p>
    </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date to:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $TO->date_to; ?>
        </p>
    </div>
</div>   

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Action:</span></label>
    <div class="col-md-9">
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="edit"><i class="fa fa-plus"> </i>Edit</button>
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