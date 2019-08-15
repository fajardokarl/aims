<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> List of all Rush Purchase Order</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div>
<table id="rush_punchase_order_table" class="table table-hover">
<thead>
<tr>
    <!--     <th>Action</th> -->
        <th>PRF</th>
        <th>Date Requested</th>
        <th>Name</th>
        <th>Department</th>
        <th>Purpose</th>
        <th>Date Needed</th>
        <th>Remark</th>
        
    </tr>
    </thead>
    <tbody>
  <?php foreach($purchase_list as $purchase_list){ ?>
        <tr>
         
            <td><?php echo $purchase_list['prf_id']; ?></td>
            <td><?php echo $purchase_list['date_requested']; ?></td>
            <td><?php echo $purchase_list['firstname'].$purchase_list['lastname']; ?></td>
            <td><?php echo $purchase_list['department_name']; ?></td>
            <td><?php echo $purchase_list['purpose']; ?></td>
            <td><?php echo $purchase_list['date_needed']; ?></td>
            <td><?php echo $purchase_list['remarks']; ?></td>
            
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
</div>
</div>