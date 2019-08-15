<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Details </span>
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
            <?php echo $prf->prf_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $prf->prf_id; ?>">
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->firstname; echo $prf->middlename; echo " "; echo $prf->lastname; ?>
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->date_needed; ?>
        </p>
    </div> 
</div>


</div>
<div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->purpose; ?>
        </p>
    </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Justification:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $prf->justification; ?>
        </p>
    </div>
</div>
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo "&#8369; " . number_format($prf->total_amount, 2); ?>
        </p>
    </div> 
</div>        
    </div>

<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="capex_table">
<thead>
<tr>
    <th>PRF ID</th>
    <th>Request type</th>
    <th>Item Description</th>
    <th>Quantity</th>

    <th>Amount</th>
    <th>Total</th>

    <th>Remarks</th>
   <!--  <th>Action</th> -->
</tr>
</thead>
<tbody>
<?php foreach($details as $details){ ?>
    <tr>
        <td><?php echo $details['prf_detail_id']; ?></td>
        

<td>
           <?php 
                if ($details['budgeted'] == 0) {
                    echo "<span class='font-red-intense bold'>Unbudgeted</span>";
                }else{
                    echo "<span class='font-green-jungle bold'>Budgeted</span>";
                }
            ?>
       </td>

        <td><?php echo $details['description'] ;?></td>
        <td><?php echo $details['qty'].' '.$details['uom_code']; ?></td>
<!--         <td><?php echo $details['uom_code']; ?></td> -->
        <td><?php echo "&#8369; " . number_format ($details['amount']) ;?></td>
        <td><?php echo "&#8369; " . number_format ($details['sub_total']); ?></td>
      
        <td><?php echo $details['remarks']; ?></td>
    
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

