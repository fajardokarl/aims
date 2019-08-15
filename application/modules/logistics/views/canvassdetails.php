<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Canvass item </span>
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
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Canvass No:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $canvass->canvassed_by; ?>
                <input type="hidden" id="id_prf" value="<?php echo $canvass->canvass_id; ?>">
            </p>
        </div>
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $canvass->canvassed_date; ?>
            </p>
        </div> 
    </div>

    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $canvass->canvassed_by; ?>
            </p>
        </div>
    </div>

 


 <!--    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php 
                    if ($prf->is_booked == 0) {
                        echo " No"; 
                    }else{
                        echo " Yes"; 
                    }
                ?>
            </p>
        </div>
    </div> -->

<!--       <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Invoiced:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php 
                    if ($prf->is_invoiced == 0) {
                        echo " No"; 
                    }else{
                        echo " Yes"; 
                    }
                ?>
            </p>
        </div>
    </div> -->

    <!-- </div> -->
</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $canvass->remarks; ?>
            </p>
        </div>
    </div>

   <!--   <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Justification:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $canvass->justification; ?>
            </p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo "&#8369; " . number_format($canvass->total_amount, 2); ?>
            </p>
        </div> 
    </div>                  -->    
            
        </div>


<div class="portlet-body">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="tbluser">
    <thead>
    <tr>
        <th>Canvass ID</th>
        <th>Canvass Item ID</th>
        <th>Supplier name</th>
        <th>Contact person</th>
        <th>Contact no.</th>
        <th>Item Description</th>
        <th>Quantity</th>
        <th>UOM</th>
        <th>Unit Price</th>
        <th>Offer Price</th>
        <th>Terms of payment</th>

     
       <!--  <th>Action</th> -->
    </tr>
    </thead>
    <tbody>
    <?php foreach($canvass_details as $details){ ?>
        <tr>
            <td><?php echo $details['canvass_item_id']; ?></td>
            <td><?php echo $details['canvass_id']; ?></td>                   
            <td><?php echo $details['supplier_name'] ;?></td>
            <td><?php echo $details['contact_person'] ;?></td>
            <td><?php echo $details['contact_number']; ?></td>
            <td><?php echo $details['item_description']; ?></td>
            <td><?php echo $details['qty']; ?></td>                        
            <td><?php echo $details['unit']; ?></td>
            <td><?php echo $details['unit_price']; ?></td>                    
            <td><?php echo $details['offer_price']; ?></td>
            <td><?php echo $details['terms_of_payment']; ?></td>
 
           
        
        
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

