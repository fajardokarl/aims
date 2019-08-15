<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Details</span>
</div>
<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Get PDF</button>
</div>
</div>
<div class="portlet-body">
<form class="form-horizontal">
<div class="row">
<div class="col-md-6">
    <!-- <div class="form-group"> -->
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation->date_requested; ?>
            </p>
        </div> 
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PR No:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation->prf_id; ?>
                <input type="hidden" id="prf_id" value="<?php echo $quotation->prf_id; ?>">
            </p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation->firstname; echo $quotation->middlename; echo " "; echo $quotation->lastname; ?>
                <input type="hidden" id="requested_by_id" value="<?php echo $quotation->requested_by_id; ?>">
                <input type="hidden" name="requested_by_id" id="requested_by_id" value="<?php echo $this->session->userdata('user_id'); ?>"> 
            </p>
        </div>
    </div>
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation->department_name; ?>
                <!-- <input type="hidden" id="quotation_id" value="<?php echo $quotation->quotation_id; ?>"> -->
            </p>
        </div>
    </div>
</div>



<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="list_of_quote">
    <thead>
    <tr>        
        <th>Quote Detail</th>  
        <th>Supplier Name</th>  
        <th>Item Description</th>
        <th>Quantity</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($details as $details){ ?>
        <tr>         
            <td><?php echo $details['quotation_detail_id']; ?></td>
            <td><?php echo $details['supplier_id']; ?></td>
            <td><?php echo $details['description']; ?></td>
            <td><?php echo $details['quote_qty']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div>



           
<div class="col-md-8">
<div class="form-group col-md-11">
<button type="button" id="save_canvass_item" name="save_canvass_item" value="1" class="btn btn-primary ">Request</button>
<button type="submit" onclick="clearFields()" value="Clear" class="btn btn-danger ">Cancel</button>
</div>
</div>
</div> 
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

