<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Download applicant data</span>
</div>
<div class="actions"> 
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
<table  id="applicant_table" class="table table-hover">
<thead>
<tr>
    <th>ID</th>
    <th>Applicant name</th>
    <th>Desired department</th>
    <th>Desired position</th>
    <th>Date applied</th>
 
</tr>
</thead>
<tbody>
<?php foreach($app_list as $app_list){ ?>
    <tr>
      <td><?php echo $app_list['person_id']; ?></td>           
      <td><?php echo $app_list['lastname'] . ', ' . $app_list['firstname'] . ' ' . $app_list['middlename'] . ' ' . $app_list['suffix'];?></td>
      <td><?php echo $app_list['department_name']; ?></td>           
      <td><?php echo $app_list['app_job_position'] ;?></td>  
      <td><?php echo $app_list['date_applied'] ;?></td> 
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


