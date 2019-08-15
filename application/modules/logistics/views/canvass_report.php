<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> List of all Approved Request</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div>
<table id="canvass_report_table" class="table table-hover">
<thead>
<tr>
<!--     <th>Action</th> -->        
<th>PRF ID</th>
<th>Date Request</th>
<th>Name</th>
<th>Purpose</th>

</tr>
</thead>
<tbody>
<?php foreach($canvass_report as $canvass_report){ ?>
<tr> 
<td><?php echo $canvass_report['prf_id']; ?></td>   
<td><?php echo $canvass_report['date_requested']; ?></td>           
<td><?php echo $canvass_report['firstname'].$canvass_report['lastname']; ?></td>
<td><?php echo $canvass_report['purpose']; ?></td> 


</tr>
<?php } ?>
</tbody>
</table> 
</div>

<!-- <div class="row">
<h6 align="right">
<i class="fa fa-square" style="color: #ffcfcf;"></i> Not Approve |
<i class="fa fa-square" style="color: #d7ffcf;"></i> Approved
</h6>
</div> -->
</div>
</div>
</div>
</div>
</div>
</div>
</div>

