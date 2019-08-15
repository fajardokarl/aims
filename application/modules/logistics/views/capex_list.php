<div class="portlet-body">
<div class="row">

<div class="col-md-12">
<div class="portlet grey-cascade box">
<div class="portlet-title">

<div class="caption">
<i class="fa fa-gift"></i>CAPEX FORM [New Project/Acquisition] </div>
<!-- <div class="actions" align="right">
</div> -->
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
 </a>
<a href="javascript:;" class="reload"> </a>
<a href="" class="fullscreen"> </a>

</div>
</div>

<div class="portlet-body">
<div class="tabbable-line tabbable-full-width ">
<ul class="nav nav-tabs">
<li class="active">
<a href="#realty_brokers" data-toggle="tab">
<div class="caption">
<span class="caption-subject font-grey-mint bold uppercase">
New Project/Acquisition
</span>
</div>
</a>
</li>
<li class="">
<a href="#realy_agent" data-toggle="tab">
<div class="caption">
<span class="caption-subject font-grey-mint bold uppercase">
Replacement/Capitalizable Repairs
</span>
</div>
</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane" id="realy_agent">
<table class="table table-hover" id="capex_repair">
<thead>
<tr>
<th>CAPEX ID</th>
<th>CAPEX Date</th>
<th>CAPEX Type</th>
<th>Name</th>
<th>Department</th>
<th>Description of Project/Item to be purchased</th>        
<th>Net Estimated Cost</th>
</tr>
</thead>
<tbody>
<?php foreach($capex_list as $capex_list){ ?>
<tr>
<td><?php echo $capex_list['capex_id']; ?></td>
<td><?php echo $capex_list['capex_date']; ?></td>
<td><?php echo $capex_list['capex_type']; ?></td>
<td><?php echo $capex_list['firstname']." ".$capex_list['middlename']." ".$capex_list['lastname']; ?></td>
<td><?php echo $capex_list['department_name']; ?></td>         
<td><?php echo $capex_list['description']; ?></td>
<td><?php echo $capex_list['net_estimated_cost']; ?></td>
<?php } ?>
</tbody>
</tr>
</table>
</div>

<div class="tab-pane active" id="realty_brokers">
<table class="table table-hover" id="capex_acquisition">
<thead>
<tr>
<th>CAPEX ID</th>
<th>CAPEX Date</th>
<th>CAPEX Type</th>
<th>Name</th>
<th>Department</th>
<th>Description of Project/Item to be purchased</th>        
<th>Net Estimated Cost</th>
</tr>
</thead>
<tbody>
<?php foreach($capex_aquisition_list as $capex_aquisition_list){ ?>
<tr>
<td><?php echo $capex_aquisition_list['capex_id']; ?></td>
<td><?php echo $capex_aquisition_list['capex_date']; ?></td>
<td><?php echo $capex_aquisition_list['capex_type']; ?></td>
<td><?php echo $capex_aquisition_list['firstname']." ".$capex_aquisition_list['middlename']." ".$capex_aquisition_list['lastname']; ?></td>
<td><?php echo $capex_aquisition_list['department_name']; ?></td>         
<td><?php echo $capex_aquisition_list['description']; ?></td>
<td><?php echo $capex_aquisition_list['net_estimated_cost']; ?></td>
<?php } ?>
</tbody>
</tr>
</table>
</div>
</div>
</div>
</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div>
</div>

