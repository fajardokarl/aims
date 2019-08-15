<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> Items ready for Canvass</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div>
<table id="canvass_table" class="table table-hover">
<thead>
<tr>
        
        <th>PRF NO</th> 
   <!--      <th>Quotation NO</th> -->
        <th>Date Requested</th>
        <th>Name</th>   
        
    </tr>
    </thead>
    <tbody>
    <?php foreach($quotation as $quotation){ ?>
        <tr>
      
          
            <td><?php echo $quotation['prf_id']; ?></td>
          <!--   <td><?php echo $quotation['quotation_id']; ?></td>   --> 
            <td><?php echo $quotation['date_requested']; ?></td>
            <td><?php echo $quotation['firstname'].$quotation['lastname']; ?></td>           
            
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