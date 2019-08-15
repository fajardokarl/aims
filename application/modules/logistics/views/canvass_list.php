<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> List of all Canvass</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div>
<table id="canvass_list_table" class="table table-hover">
<thead>
<tr>
<!--     <th>Action</th> -->        

<th>PRF ID</th>
<th>Date Quote</th>
<th>Name</th>


</tr>
</thead>
<tbody>
<?php foreach($canvass_list as $canvass_list){ ?>
<tr> 

<td><?php echo $canvass_list['prf_id']; ?></td>   
<td><?php echo $canvass_list['date_requested']; ?></td>           
<td><?php echo $canvass_list['firstname'].$canvass_list['lastname']; ?></td>  
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

