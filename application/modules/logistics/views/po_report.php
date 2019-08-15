<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">List of all PO </span>
</div>
<div class="actions"> 
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Generate</button>
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
<table  id="po_table" class="table table-hover">
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
    <th>Justification</th>
    <th>Item Category</th>
    <th>Particulars</th>
    <th>QTY</th>
    <th>Quoted Amount</th>
    <th>Nego. Amount</th>
    <th>Savings</th>
    <th>Remaining to Savings</th>
    <th>Plate No.</th>
    <th>Light/Heavy Equipment</th>
    <th>R&M no.</th>
    <th>CAPEX no.</th>
    <th>Budgeted (Regular)</th>
    <th>Unbudgeted(Regular)</th>
    <th>Budgeted (Rush)</th>
    <th>Unbudgeted(Rush)</th>
    <th>Budgeted (Total amount)</th>
    <th>Unbudgeted(Total amount)</th>
</tr>
</thead>
<tbody>
<?php foreach($PO_details as $PO_details){ ?>
    <tr>
      <td><?php echo $PO_details['po_id']; ?></td>           
      <td><?php echo $PO_details['supplier_id'] ;?></td>
      <td><?php echo $PO_details['TOP']; ?></td>
      <td><?php echo $PO_details['po_date']; ?></td>               
      <td><?php echo $PO_details['department_name'] ;?></td>  
      <td><?php echo $PO_details['POprf_id']; ?></td>    
      <td><?php echo $PO_details['date_requested'] ;?></td>
      <td><?php echo $PO_details['date_needed'] ;?></td>
      <td>Null</td>
      <td>Null</td>
      <td><?php echo $PO_details['justification'] ;?></td>
      <td><?php echo $PO_details['description'] ;?></td>
      <td>Null</td>
      <td><?php echo $PO_details['po_qty'] ;?></td>
      <td><?php echo "&#8369; " . number_format ($PO_details['po_price']) ;?></td>
      <td>Null</td>
      <td>Null</td>
      <td>Null</td>
      <td>Null</td>
      <td>Null</td>
      <td>Null</td>
      <td><?php echo $PO_details['capex_id']; ?></td>    
      <td>
           <?php 
                if ($PO_details['pbudget_id'] != 0) {
                    echo "&#8369; " . number_format ($PO_details['po_price']) ;
                }
            ?>
       </td>    
      <td>
           <?php 
                if ($PO_details['pbudget_id'] == 0) {
                    echo "&#8369; " . number_format ($PO_details['po_price']) ;
                }
            ?>
       </td>
      <td>Null</td>
      <td>Null</td>
      <td>Null</td>
      <td>Null</td>

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

