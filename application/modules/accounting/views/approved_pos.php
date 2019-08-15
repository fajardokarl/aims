<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">List of all Receiving Reports </span>
</div>
<div class="actions"> 
<!-- <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Generate</button> -->
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-12">
<!-- <div class="form-group"> -->
    


<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<input id="po_url" type="hidden" value="<?=base_url();?>Accounting/Purchaseorder/purchaseorder">
<table id="po_table" class="table table-hover">
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
    <th>RPC #</th>
    <th>Status</th>
    <th>Admin Status</th>
    <th>Accounting Status</th>
</tr>
</thead>
<tbody>
<?php $previous_po_id = 0;
  $current_po_id = 0;
  foreach($PO_details as $PO_detail){
    $current_po_id = $PO_detail['po_id'];
    if($PO_detail['po_admin_status'] && $current_po_id != $previous_po_id) { ?>
    <tr>
      <td><?php echo $PO_detail['po_id']; ?></td>           
      <td><?php echo $PO_detail['supplier_id'] ;?></td>
      <td><?php echo $PO_detail['TOP']; ?></td>
      <td><?php echo $PO_detail['po_date']; ?></td>               
      <td><?php echo $PO_detail['department_name'] ;?></td>  
      <td><?php echo $PO_detail['POprf_id']; ?></td>    
      <td><?php echo $PO_detail['date_requested'] ;?></td>
      <td><?php echo $PO_detail['date_needed'] ;?></td>
      <td>Null</td>
      <td>Null</td>
      <td><?php echo strtoupper($PO_detail['po_status']) ;?></td>
      <td><?php echo strtoupper($PO_detail['po_admin_status']) ;?></td>
      <td><?php echo strtoupper($PO_detail['po_accounting_status']) ;?></td>
    </tr>
<?php $previous_po_id = $PO_detail['po_id'];
  }
} ?>
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

