<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> List of all quotation</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div>
<table id="list_table" class="table table-hover">
<thead>
<tr>
    <!--     <th>Action</th> -->               
        

        <th>PRF ID</th>
        <th>Name</th>  
        <th>Department</th>
        <th>Purpose</th>
        <th>Date Quote</th>
      
       <!--  <th>Name</th>  -->
        
    </tr>
    </thead>
    <tbody>
   <?php foreach($quotation_list as $quotation_list){ ?>
        <tr> 
      

            <td><?php echo $quotation_list['prf_id']; ?></td>
            <td><?php echo $quotation_list['firstname'].$quotation_list['lastname']; ?></td>    
            <td><?php echo $quotation_list['department_name']; ?></td>
            <td><?php echo $quotation_list['purpose']; ?></td>   
            <td><?php echo $quotation_list['date_request']; ?></td>           
        
<!--             <td><?php echo $quotation_list['prf_detail_id']; ?></td>    -->  
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