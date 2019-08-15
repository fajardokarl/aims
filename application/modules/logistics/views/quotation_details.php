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
                <?php echo $quotation_head->date_requested; ?>
            </p>
        </div> 
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PR No:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation_head->prf_id; ?>
                <input type="hidden" id="prf_id" value="<?php echo $quotation_head->prf_id; ?>">
            </p>
        </div>
    </div>
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation_head->firstname; echo $quotation_head->middlename; echo " "; echo $quotation_head->lastname; ?>
                <input type="hidden" id="requested_by_id" value="<?php echo $quotation_head->requested_by_id; ?>">
                <input type="hidden" name="canvassed_by" id="canvassed_by" value="<?php echo $this->session->userdata('user_id'); ?>"> 
            </p>
        </div>
    </div>


</div>
<div class="col-md-6">
    <div class="form-group">
        <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department:</span></label>
        <div class="col-md-9">
            <p class="form-control-static">
                <?php echo $quotation_head->department_name; ?>
                <input type="hidden" id="quotation_id" value="<?php echo $quotation_head->quotation_id; ?>">
            </p>
        </div>
    </div>
</div>



<div class="portlet-body">
<!-- <div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="canvass_detail_table">
    <thead>
    <tr>
        <th>Item Description</th>
        <th>Supplier Name</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach($quotation_details as $quotation_details){ ?>
        <tr>
            <td><?php echo $quotation_details['description']; ?></td>
            <td><?php echo $quotation_details['supplier_id']; ?></td>
        </tr>
    <?php } ?>
    </tbody>
</table>
</div>
</div> -->

<div class="portlet-body">
<div>
<div class="col-md-12">
    <table id="quotation_item_table" class="table table-hover">  
       <thead>
            <tr>
                <th>Supplier Description</th>
                <th>Item Description</th>
                <th >Budget ID</th>
                <th >QTY</th>
                <th >Unit</th>   
                <th >Remark</th>                 
                <th>Price Offer</th>
                <th>Total</th>
                <th>Terms of payment</th>
                <th>Contact Person</th>
                <th>Contact Number</th> 
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
    <tr>
    <td>        
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="quote_supplier_name">
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($all_suppliers as $all_suppliers){ ?>
    <option value="<?php echo $all_suppliers['supplier_id'];?>"><?php echo 
    $all_suppliers['organization_name'];?></option><?php } ?>
    </select>    
    </td>

    <td>
     <select class="form-control select2 select2-hidden-accessible" id="item_description" required>
    <option value="0" class = "selected disabled">Select</option>
    </select>    
    </td>

    <td >
    <select class="form-control select2 select2-hidden-accessible" id="budget_id" required>
    <option value="0" class = "selected disabled"></option>
    </select>    
    </td>  

    <td >
    <select class="form-control select2 select2-hidden-accessible" id="qty_item" required>
    <option value="0" class = "selected disabled"></option>
    </select>    
    </td>
    <td >
    <select class="form-control select2 select2-hidden-accessible" id="quote_unit" required>
    <option value="0" class = "selected disabled"></option>
    </select>    
    </td>
    <td >
    <select class="form-control select2 select2-hidden-accessible" id="quote_remark" required>
    <option value="0" class = "selected disabled"></option>
    </select>    
    </td>

    <td>
         <input type="text" id="price_offer" class="form-control">
    </td>

    <td>
        <Label type="isNumber"  id="sub_total" class="form-control">Total</Label>   
    </td> 
    <td>
         <input type="text" id="terms_of_payment" class="form-control">
    </td>

    <td>
         <input type="text" id="contact_person" class="form-control">
    </td>
    <td>
         <input type="text" id="contact_number" class="form-control">
    </td>
    <td>
        <a href="#" id="add_quotation" class ="btn btn-info">Add</a>
    </td>
    </tr>
    </tbody>
                    </table> 
                </div>
            </div><!-- end row -->

<div class="row">
<div class="portlet-body">
<div class="col-md-8">
<h3><b><font color="teal">Total Amount: <span id = "canvass_total" name = "canvass_total"></span></font></b></h3>
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

