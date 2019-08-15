<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase">Select Purchase Request to be quote</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div id="">
<table id="prf_quotation_table" class="table table-hover">
<thead>
<tr>
    <!--     <th>Action</th> -->
        <th>PRF</th>
        <th>Date Requested</th>
        <th>Name</th>
        <th>Department</th>
        <th>Purpose</th>
        <th>Request Type</th>
        <th>Date Needed</th>
        <!-- <th>Status</th> -->
        
    </tr>
    </thead>
    <tbody>
    <?php foreach($prf_quotation as $prf_quotation){ ?>
        <tr>        
            <td><?php echo $prf_quotation['prf_id']; ?></td>
            <td><?php echo $prf_quotation['date_requested']; ?></td>
            <td><?php echo $prf_quotation['firstname'].$prf_quotation['lastname']; ?></td>
            <td><?php echo $prf_quotation['department_name']; ?></td>
            <td><?php echo $prf_quotation['purpose']; ?></td>
            <!-- <td><?php echo $prf_quotation['request_type']; ?></td> -->
            <td>
                <?php 
                if ($prf_quotation['request_type'] == 1) {
                   echo "<span class='font-green-jungle bold'>Regular</span>";
                }else{
                    echo "<span class='font-red-intense bold'>Rush</span>";
                }
                ?>
            </td>
            <td><?php echo $prf_quotation['date_needed']; ?></td>
            <!-- <td><?php echo $prf_quotation['date_needed']; ?></td> -->
            
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