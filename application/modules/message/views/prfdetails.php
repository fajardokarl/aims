<style type="text/css">
    .modcenter {
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }
    textarea {
        margin-top: 5px;
        margin-left: 5px;
    }
</style> <br>
<button 
<?php switch ($prf->prf_status_id) {
    case 1:
        echo 'class="btn btn btn-xs green status_action">Pending';
        break;                                      
    case 3:
        echo 'class="btn btn btn-xs red status_action" disabled>Denied';
        break;                                      
    case 4:
        echo 'class="btn btn btn-xs blue status_action">Approved';
        break;
}
 ?>

 >

</button>


 <br><br>

<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Item </span>
            </div>
            <div class="actions"> 
                <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Get PDF</button>
            </div>
        </div>
        <div class="portlet-body">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="form-group"> -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PRF No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $prf->prf_id; ?>
                                    <input type="hidden" id="id_prf" value="<?php echo $prf->prf_id; ?>">
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $prf->lastname . ', ' . $prf->firstname; ?>
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

                    
                     <!--    <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                        if ($prf->is_booked == 0) {
                                            echo " No"; 
                                        }else{
                                            echo " Yes"; 
                                        }
                                    ?>
                                </p>
                            </div>
                        </div> -->

                  <!--       <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Invoiced:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                        if ($prf->is_invoiced == 0) {
                                            echo " No"; 
                                        }else{
                                            echo " Yes"; 
                                        }
                                    ?>
                                </p>
                            </div>
                        </div> -->

                        <!-- </div> -->
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
                    <table class="table table-hover" id="sent_prf_table">
                        <thead>
                        <tr>
                            <th>PRF ID</th>
                            <th>Item Detail ID</th>
                            <th>Item Description</th>
                            <th>Quantity</th>                            
                            <th>Amount</th>
                            <th>Total</th>
                            <th>Deliver</th>
                            <th>Remarks</th>
                           <!--  <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($prf_details as $details){ ?>
                            <tr>
                                <div>
                                    <td><?php echo $details['prf_id']; ?></td>
                                    <td><?php echo $details['prf_detail_id']; ?></td>                         
                                    <td><?php echo $details['description'] ;?></td>
                                    <td><?php echo $details['qty'] . ' ' . $details['uom_name'];
                                        echo ($details['qty'] > 1) ? "s" : ""; ?></td>
                                    <td><?php echo "&#8369; " . number_format ($details['amount']) ;?></td>
                                    <td><?php echo "&#8369; " . number_format ($details['sub_total']); ?></td>
                                    <td><?php echo $details['warehouse_description']; ?></td>
                                    <td><?php echo $details['remarks']; ?></td><br>
                                </div>
                            
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table> <br><br>
                    <button class="btn btn-circle btn-xs blue"type="button" data-toggle="modal" data-target="#form_document_remark">Add Remarks</button>
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

<div style="" class="modal fade modal-md modcenter" id="form_document_remark" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <div class="caption font-green-sharp">
                    <i class="fa fa-book font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">REMARKS</span>
                    <button type="button" class="close" id="btn_close_remark" tabindex="-1" data-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body">
            
                <div class="portlet-body">
                    <textarea rows="6" cols="100" name="document_remark" id="document_remark" value="<?php echo $prf->document_remark; ?>"><?php echo $prf->document_remark; ?></textarea>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="post" id="form_update_document_remark" action="<?=base_url();?>Message/Message/update_remark">
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
                  <button type="submit" data-dismiss="modal" class="btn green-meadow" id="confirm_edit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Submit</button>
              </div>
            </form>
        </div>
    </div>
</div>

<div style="" class="modal fade modal-sm modcenter" id="frm_status" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
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
                <form action="<?=base_url()?>Message/Message/changeStatus" method="post">
                    <div class="form-group">
                        <input type="hidden" name="mod_prf_id" id="mod_prf_id">
                        <input type="hidden" name="mod_statusid" id="mod_statusid">
                        <button type="submit" id="status_approve" class="form-control btn btn-circle green" style="margin-bottom: 10px;">APPROVE</button>
                        <button type="submit" id="status_deny" class="form-control btn btn-circle red">DENY</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>