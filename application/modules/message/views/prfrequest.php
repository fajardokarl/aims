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
                                    <?php echo $request->prf_id; ?>
                                    <input type="hidden" id="id_prf" value="<?php echo $request->prf_id; ?>">
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $request->requested_by_id; ?>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $request->date_needed; ?>
                                </p>
                            </div> 
                        </div>
                            <div class="form-group col-md-3">
                                        <label class="control-label">PRF Status</label>
                                        <select class="form-control select2 select2-hidden-accessible" id="is_cancel" required>
                                        <option value="0">Activate</option>
                                        <option value="1">Cancel</option>
                                        </select>

                            </div> 
                         
                           
                    
                     <!--    <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                        if ($request->is_booked == 0) {
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
                                        if ($request->is_invoiced == 0) {
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
                                    <?php echo $request->purpose; ?>
                                </p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Justification:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $request->justification; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static" id='total_amount'>
                                    <?php echo "&#8369; " . number_format($request->total_amount, 2); ?>
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
                           
                            <th>Item Detail ID</th>
                            <th>PRF ID</th>
                            <th>Item Description</th>
                            <th>Quantity</th>                            
                            <th>Amount</th>
                            <th>Total</th>
                           <!--  <th>Deliver</th> -->
                            <th>Remarks</th>
                            <!-- <th>Status</th> -->
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($details_request as $details_request){ ?>
                            <tr>
                                <td><?php echo $details_request['prf_detail_id']; ?></td>
                                <td><?php echo $details_request['prf_id']; ?></td>                         
                                <td><?php echo $details_request['description'] ;?></td>
                                <td><?php echo $details_request['qty'] ;?></td>                    
                                <td><?php echo $details_request['amount'] ;?></td>
                                <td><?php echo $details_request['sub_total']; ?></td>
                                <!-- <td><?php echo $details_request['qty']; ?></td> -->
                                <td><?php echo $details_request['remarks']; ?></td>
                              <!--   <td><?php echo $details_request['activate_cancel']; ?></td> -->
                                <td>
                                <?php 
                                    if ($details_request['activate_cancel'] == 0) {
                                        echo "<span class='font-green-jungle bold'>Active</span>";
                                    }else{
                                        echo "<span class='font-red-intense bold'>Cancelled</span>";
                                    }
                                ?>
                                </td>
                                <td><button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#view-lots" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></td>                            
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

<!-- 

<div class="modal fade bs-modal-xs" id="sticker_print" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xm">
<div class="modal-content">
<div class="modal-header">

<h3 class="modal-title" id="" style="font-weight: bold;">Option</h3>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="note note-default">

<div class="col-md-8" style="margin-top: 20px;">
<h1 class="bold" id="canvass_txt_status"></h1>
</div>
<input type="hidden" id="prf_detail_id">
<input type="hidden" id="amount">
<input type="hidden" id="prf_id">
<input type="hidden" id="description">
<input type="hidden" id="qty">
<input type="hidden" id="total_amount">
<div class="col-md-4" style="margin-top: 15px;">

<button style="display:none"class="btn btn-block btn-default" id="btn_todamaged">
<i style="display:none" id="icon" class="fa fa-unlink"></i>
<div style="display:none" id="canvass_btn_text" style="font-weight: bold;"> Edit?</div>
</button>


<button id="toggle" class="btn btn-block btn-success "><i style="display:none" id="toggle_icon" class="fa fa-unlink"></i>UPDATE</button>

</div>
<input style="display:none" type="text" class="form-control form-filter input-sm" id="approve_reason" name="approve_reason" placeholder="Edit quantity here!">
<font color="white" style="">.</font>
 
   
</div>
</div>

</div>

<div class="row">
<div class="col-md-12">
<div class="note note-default">
<div id="sticker_content" style="font-size: 10px;" class="col-md-12">
<table width="349"><tr>
<td align="center" style="font-weight: bold;font-size: 15px;"> PRF Detail</td>
</tr></table>
<table  width="350" style="table-layout: fixed;"> 
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">ITEM DESCRIPTION:</td>
<td width="175" colspan="2">Quantity</td>
<td bgcolor="#ffffff"></td>
</tr>
<tr height="20">
<td style="font-size: 15px;" id="stckr_description"></td>
<td style="font-size: 15px;"colspan="2" id="stckr_price_offer"></td>
<td></td>
</tr>
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">Price:</td>
<td width="175" colspan="2">Total Amount:</td>
<td></td>
</tr>
<tr height="15">
<td style="font-size: 15px;" id="stckr_supplier"></td>
<td style="font-size: 15px;"colspan="2" id="stckr_TOP"></td>
<td></td>
</tr>
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">Deliver:</td>
<td width="175" colspan="2">Remarks:</td>
<td></td>
</tr>
<tr height="20">
<td style="font-size: 15px;" id="stckr_person"></td>
<td style="font-size: 15px;" colspan="2" id="stckr_number"></td>
<td></td>
</tr>

</table>
</div>

<font color="white">.</font>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<div align="right">
</tr>

<button id="" class="btn red" data-dismiss="modal">close</button>

</div>
</div>
</div>
</div>
</div>
 -->




<div id="view-lots" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Request<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                <input type="hidden" id="prf_id" name="prf_id"  placeholder="" maxlength="30" class="form-control"/>
                                <input type="hidden" id="prf_detail_id" name="prf_detail_id"  placeholder="" maxlength="30" class="form-control"/>

                                <div class="portlet-body">
                                    <label class="control-label">Status</label>
                                    <div class="row"> 
                                                                     
                                 <!--    <div class="form-group col-md-6">
                                        <label class="control-label">PRF</label>
                                        <select class="form-control select2 select2-hidden-accessible" id="is_cancel" required>
                                        <option value="0">Activate</option>
                                        <option value="1">Cancel</option>
                                        </select>
                                    </div>  -->
                                      <div class="form-group col-md-6">
                                        <label class="control-label">ITEM</label>
                                        <select class="form-control select2 select2-hidden-accessible" id="activate_cancel" required>
                                        <option value="0">Activate</option>
                                        <option value="1">Cancel</option>
                                        </select>
                                    </div>  
                                    </div>               
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <input type="text" id="qty" name="qty"  placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Amount</label>
                                        <input type="text" id="amount" name="amount" style='text-align: right;' placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Remarks</label>
                                        <input type="text" id="remarks" name="remarks" placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                           <div class="row static-info">
                                            <div class="col-md-3 value"  align="left"> Sub Total: </div>
                                            <div class="col-md-9 value" >
                                                <input type="text" name="sub_total" readonly="true" style='text-align: right;' class="form-control" id="sub_total">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row static-info">
                                            <div class="col-md-3 value"  align="left"> Total: </div>
                                            <div class="col-md-9 value" >
                                                <input type="text" name="total_amount" readonly="true" style='text-align: right;' class="form-control" id="total_amount">
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="update_prf" ></span>Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>