<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Details </span>
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
<table  id="prf_approve_table" class="table table-hover">
<thead>
<tr>
    <th>PRF ID</th>
    <th>Date Request</th>
    <th>Requested by ID</th>
   
   
</tr>
</thead>
<tbody>
<?php foreach($details as $details){ ?>
    <tr>
       <td><?php echo $details['prf_id']; ?></td>           
      <td><?php echo $details['date_requested'] ;?></td>
      <td><?php echo $details['firstname'].$details['lastname']; ?></td>
        
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

