<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Details </span>
</div>
<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="report_prf_form"><i class="fa fa-plus"> </i>Get PDF</button>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-6">
<!-- <div class="form-group"> -->
    
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PRF No:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $report_head->prf_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $report_head->prf_id; ?>">
        </p>
    </div>
</div>


<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $report_head->firstname; echo $report_head->middlename; echo " "; echo $report_head->lastname; ?>
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Requested:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $report_head->date_requested; ?>
        </p>
    </div> 
</div>
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $report_head->date_needed; ?>
        </p>
    </div> 
</div>        


</div>
<div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
          <?php echo $report_head->purpose; ?>
        </p>
    </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Justification:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
           <?php echo $report_head->justification; ?> 
        </p>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Remarks:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
          <?php echo $report_head->remarks; ?>
        </p>
    </div> 
</div>        
    </div>


<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="report_table">
<thead>
<tr>
    <th>Canvass Detail ID</th>
    <th>Suplier Name</th>
    <th>Item Description</th>
    <th>Quantity</th>
    <th>Price Offer</th>
    <th>Total</th>
    <th>Contact Person</th>
    <th>Contact Number</th>
    <th>Terms of Payment</th>
    <th>Reason for approval</th>
</tr>
</thead>
<tbody>
<?php foreach($report_details as $report_details){ ?>
    <tr>
        <td><?php echo $report_details['canvass_detail_id']; ?></td>
        <td><?php echo $report_details['supplier_id'] ;?></td>
        <td><?php echo $report_details['description']; ?></td>                         
        <td><?php echo $report_details['qty_item']; ?></td>       
        <td><?php echo "&#8369; " . number_format ($report_details['price_offer']) ;?></td>
        <td><?php echo "&#8369; " . number_format ($report_details['total']); ?></td>
        <td><?php echo $report_details['contact_person']; ?></td>
        <td><?php echo $report_details['contact_number']; ?></td>
        <td><?php echo $report_details['terms_of_payment']; ?></td>
        <td><?php echo $report_details['approve_reason']; ?></td>
    
    
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
</div>
</div>

