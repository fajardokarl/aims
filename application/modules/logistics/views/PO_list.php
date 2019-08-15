<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Select PRF no. to create P.O. </span>
</div>
<div class="actions"> 
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Create Purchase Order</button>
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
<table  id="pdf_po_table" class="table table-hover">
<thead>
<tr>
    <th>PO no</th>
    <th>PRF no</th>
    <th>Supplier</th>
    <th>Requested by</th>
    <th>Date created</th>
</tr>
</thead>
<tbody>
<?php foreach($po_list as $po_list){ ?>
    <tr>
      <td><?php echo $po_list['po_id']; ?></td>           
      <td><?php echo $po_list['prf_id'] ;?></td>  
         <td>
           <?php 
                if ($po_list['client_type_id'] == 1) {
                    echo $po_list['person_name'] ;
                }else{
                     echo $po_list['organization_name'] ;
                }
            ?>
       </td>
       <td><?php echo $po_list['name'] ;?></td>             
      <td><?php echo $po_list['po_date'] ;?></td>  
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

