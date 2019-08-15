<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> List of all PRF</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div>
<table id="prf_status_table" class="table table-hover">
<thead>
<tr>
<!--     <th>Action</th> -->        
<th>PRF ID</th>
<th>Date Request</th>
<th>Requested by</th>
<th>Department</th>
<th>Purpose</th>
<th>Date Needed</th>
<th>Remark</th>
<th>status</th>

</tr>
</thead>
<tbody>
<?php foreach($prf_status as $prf_status){ ?>
<tr> 
<td><?php echo $prf_status['prf_id']; ?></td>   
<td><?php echo $prf_status['date_requested']; ?></td>           
<td><?php echo $prf_status['firstname'].$prf_status['lastname']; ?></td>
<td><?php echo $prf_status['department_name']; ?></td>  
<td><?php echo $prf_status['purpose']; ?></td>
<td><?php echo $prf_status['date_needed']; ?></td>  
<td><?php echo $prf_status['remarks']; ?></td>    
<td><?php echo $prf_status['prf_status_id']; ?></td>  
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
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<div class="modal fade bs-modal-xs" id="prf_status_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
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
<h1 class="bold" id="txt_status"></h1>
</div>
<input type="hidden" id="prf_id">
<div class="col-md-4" style="margin-top: 15px;">
<button class="btn btn-block btn-default" id="btn_todone">
<i class="fa fa-unlink"></i>
<div id="btn_text" style="font-weight: bold;"> DONE</div>
</button>
</div>
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
<td align="center" style="font-weight: bold;font-size: 15px;"> PRF Detail</td>
</tr></table>
<table  width="350" style="table-layout: fixed;"> 
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">Requested by:</td>
<td width="175" colspan="2">Date Requested</td>
<td bgcolor="#ffffff"></td>
</tr>
<tr height="20">
<td style="font-size: 15px;" id="stckr_description"></td>
<td style="font-size: 15px;"colspan="2" id="stckr_price_offer"></td>
<td></td>
</tr>
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width="175">Department:</td>
<td width="175" colspan="2">Purpose:</td>
<td></td>
</tr>
<tr height="15">
<td style="font-size: 15px;" id="stckr_supplier"></td>
<td style="font-size: 15px;"colspan="2" id="stckr_TOP"></td>
<td></td>
</tr>
<tr bgcolor="#d2d2d2" height="10" style="font-size: 15px;">
<td height="" width=175">Date Needed:</td>
<td width="175" colspan="2">Remark.:</td>
<td></td>
</tr>
<tr height="20">
<td style="font-size: 15px;" id="stckr_person"></td>
<td style="font-size: 15px;" colspan="2" id="stckr_number"></td>
<td></td>
</tr>
<tr>

</table>
</div>

<font color="white">.</font>
</div>
</div>
</div>
</div>
<div class="modal-footer">
<div align="right">
<!-- <button id="confirm_print" class="btn blue">Print Sticker</button> -->
<button id="" class="btn red" data-dismiss="modal">close</button>

</div>
</div>
</div>
</div>
</div>

