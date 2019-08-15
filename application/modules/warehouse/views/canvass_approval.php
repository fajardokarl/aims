<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Details </span>
</div>
<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Get PDF</button>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal" id="canvasss_approval" name="canvasss_approval">
<div class="row">
<div class="col-md-6">
<!-- <div class="form-group"> -->
    
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PRF No:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $canvass->prf_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $canvass->prf_id; ?>">
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $canvass->firstname; echo $canvass->middlename; echo " "; echo $canvass->lastname; ?>
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $canvass->date_request; ?>
        </p>
    </div> 
</div>
<!-- <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo "&#8369; " . number_format($canvass->canvass_total, 2); ?>
        </p>
    </div> 
</div>    -->     
    </div>

<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="canvasss_approval_table">
<thead>
<tr>
    <th>Canvass detail ID</th>
    <th>Item Description</th>
    <th>Quantity</th>
    <th>Price Unit</th>
    <th>Total price</th>
    <th>Supplier</th>
    <th>Contact person</th>
    <th>Contact no.</th>
    <th>Terms of payment</th>
    <th>Status</th>
    <th>Remaining amount</th>
    <th>ID</th>
    <th>qty</th>

 
</tr>
</thead>
<tbody>
<?php foreach($approval_details as $approval_details){ ?>
    <tr>
        <td><?php echo $approval_details['canvass_detail_id']; ?></td>
        <td><?php echo $approval_details['description']; ?></td>                         
        <td><?php echo $approval_details['qty_item'] ;?></td>
        <td><?php echo "&#8369; " . number_format ($approval_details['price_offer']) ;?></td>       
        <td><?php echo "&#8369; " . number_format ($approval_details['total']); ?></td>
        <td><?php echo $approval_details['supplier_id']; ?></td>
        <td><?php echo $approval_details['contact_person']; ?></td>
        <td><?php echo $approval_details['contact_number']; ?></td>
        <td><?php echo $approval_details['terms_of_payment']; ?></td>
        <td><?php echo $approval_details['is_approved'];?></td> 
        <td><?php echo $approval_details['budget_amount'] - $approval_details['price_offer']; ?></td> 
        <td><?php echo $approval_details['budget_id'];?></td>      
        <td><?php echo $approval_details['budget_quantity'] - $approval_details['qty_item']; ?></td> 
        
    </tr>
<?php } ?>
</tbody>
</table>
</div>

<div class="row">
<h6 align="right">
<i class="fa fa-square" style="color: #ffcfcf;"></i> Not Approve |
<i class="fa fa-square" style="color: #d7ffcf;"></i> Approved
</h6>
</div
</div>
</div>
</div>



</div>
</div>
</form>

</div>
</div>
</div>

<div class="modal fade bs-modal-xs" id="sticker_print" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-xm">
<div class="modal-content">
<div class="modal-header">
<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
<h3 class="modal-title" id="" style="font-weight: bold;">Option</h3>
</div>
<div class="modal-body">
<div class="row">
<div class="col-md-12">
<div class="note note-default">
<!-- <div class="portlet-body"> -->
<div class="col-md-8" style="margin-top: 20px;">
<h1 class="bold" id="canvass_txt_status"></h1>
</div>
<input type="hidden" id="canvass_detail_id">
<input type="hidden" id="budget_amount">
<input type="hidden" id="budget_id">
<input type="hidden" id="budget_quantity">
<div class="col-md-4" style="margin-top: 15px;">
<button style="display:none"class="btn btn-block btn-default" id="btn_todamaged">
<i style="display:none" id="icon" class="fa fa-unlink"></i>
<div style="display:none" id="canvass_btn_text" style="font-weight: bold;"> APPROVE?</div>
</button>
<button id="toggle" class="btn btn-block btn-success "><i style="display:none" id="toggle_icon" class="fa fa-unlink"></i>UPDATE</button>

</div>
<input style="display:none" type="text" class="form-control form-filter input-sm" id="approve_reason" name="approve_reason" placeholder="Type your reason here">
<font color="white" style="">.</font>
<!-- </div> -->   
   
</div>
</div>

</div>

<div class="row">
<div class="col-md-12">
<div class="note note-default">
<div id="sticker_content" style="font-size: 10px;" class="col-md-12">
<table width="349"><tr>
<td align="center" style="font-weight: bold;font-size: 15px;"> Canvass Detail</td>
</tr></table>
<table  width="350" style="table-layout: fixed;"> 
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">ITEM DESCRIPTION:</td>
<td width="175" colspan="2">PRICE OFFER</td>
<td bgcolor="#ffffff"></td>
</tr>
<tr height="20">
<td style="font-size: 15px;" id="stckr_description"></td>
<td style="font-size: 15px;"colspan="2" id="stckr_price_offer"></td>
<td></td>
</tr>
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">SUPPLIER:</td>
<td width="175" colspan="2">T.O.P:</td>
<td></td>
</tr>
<tr height="15">
<td style="font-size: 15px;" id="stckr_supplier"></td>
<td style="font-size: 15px;"colspan="2" id="stckr_TOP"></td>
<td></td>
</tr>
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width=175">CONTACT PERSON:</td>
<td width="175" colspan="2">CONTACT NO.:</td>
<td></td>
</tr>
<tr height="20">
<td style="font-size: 15px;" id="stckr_person"></td>
<td style="font-size: 15px;" colspan="2" id="stckr_number"></td>
<td></td>
</tr>
<tr height="25">
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width=175">Remaining:</td> 
</tr>
<tr height="30">
<td type="hidden" style="font-size: 15px;" id="stckr_total"></td>
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

<!-- <button id="confirm_print" class="btn blue">Print Sticker</button> -->
<button id="" class="btn red" data-dismiss="modal">close</button>

</div>
</div>
</div>
</div>
</div>

