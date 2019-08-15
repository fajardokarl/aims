<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">CAPEX </span>
</div>
<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Get PDF</button>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-6">
<!-- <div class="form-group"> -->

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PR No:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $capex->prf_id; ?>
            <input type="hidden" id="id_capex" value="<?php echo $capex->capex_id; ?>">
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> CAPEX No:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $capex->capex_id; ?>
            <input type="hidden" id="id_capex" value="<?php echo $capex->capex_id; ?>">
        </p>
    </div>
</div>



<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
    <div class="col-md-4">
        <p class="form-control-static">
            <?php echo $capex->firstname; echo $capex->middlename; echo " "; echo $capex->lastname; ?>
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $capex->department_name; ?>
        </p>
    </div> 
</div>
</div>

<div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $capex->capex_purpose; ?>
        </p>
    </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $capex->capex_date; ?>
        </p>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo "&#8369; " . number_format($capex->net_estimated_cost, 2); ?>
        </p>
    </div> 
</div> 

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase">Classification:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $capex->is_budgeted; ?>
        </p>
    </div> 
</div>         
    </div>

</div>


<div class="portlet-body">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="capex_details_list">
<thead>
<tr>
    <th>CAPEX ID</th>
    <th>Custodian</th>
    <th>Item description</th>
    <th>Location</th>
    <th>Date Acquired</th>
    <th>Net book value</th>
    <th>Reason for replacement</th>
    <th>Advantage over new</th>
   
   <!--  <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php foreach($capex_details as $capex_details){ ?>
    <tr>
        <td><?php echo $capex_details['capex_id']; ?></td>
        <td><?php echo $capex_details['firstname']." ".$capex_details['middlename']." ".$capex_details['lastname']; ?></td>
        <td><?php echo $capex_details['description'] ;?></td>
        <td><?php echo $capex_details['location']; ?></td>
        <td><?php echo $capex_details['date_acquired']; ?></td>
        <td><?php echo $capex_details['net_book_value'] ;?></td>
        <td><?php echo $capex_details['reason_for_replacement']; ?></td>
        <td><?php echo $capex_details['advantage_over_new']; ?></td>
        
    </tr>
<?php } ?>
</tbody>
</table>
</div>
</div>
</div>



</div>
</div>
</form>

</div>
</div>


