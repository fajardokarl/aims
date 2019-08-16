<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<!-- <span class="bold uppercase">Select PRF no. to create P.O. </span>
 --></div>
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
<table  id="employee_table" class="table table-hover">
<thead>
<tr>
    <th>ID</th>
    <th>Name</th>
    <th>Department</th>
    <th>Position</th>
 
</tr>
</thead>
<tbody>
<?php foreach($emp_list as $emp_list){ ?>
    <tr>
      <td><?php echo $emp_list['person_id']; ?></td>           
      <td><?php echo $emp_list['lastname'] . ', ' . $emp_list['firstname'] . ' ' . $emp_list['middlename'] . ' ' . $emp_list['suffix'];?></td>
      <td><?php echo $emp_list['department_name']; ?></td>           
      <td><?php echo $emp_list['job_position'] ;?></td>  
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

