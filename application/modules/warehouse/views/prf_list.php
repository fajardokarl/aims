<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> Regular Purchase Request Details</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div id="">
<table id="prf_list_table" class="table table-hover">
<thead>
<tr>
    <!--     <th>Action</th> -->
        <th>PRF</th>
        <th>Date Requested</th>
        <th>Name</th>
        <th>Department</th>
        <th>Purpose</th>
        <th>Date Needed</th>
        <th>Status</th>
        
    </tr>
    </thead>
    <tbody>
    <?php foreach($prf_list as $prf_list){ ?>
        <tr>
         
            <td><?php echo $prf_list['prf_id']; ?></td>
            <td><?php echo $prf_list['date_requested']; ?></td>
            <td><?php echo $prf_list['firstname'].$prf_list['lastname']; ?></td>
            <td><?php echo $prf_list['department_name']; ?></td>
            <td><?php echo $prf_list['purpose']; ?></td>
            <td><?php echo $prf_list['date_needed']; ?></td>
            <td><?php echo $prf_list['date_needed']; ?></td>
            
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