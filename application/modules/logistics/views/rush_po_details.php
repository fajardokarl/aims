<div class="row">
<div class="portlet grey-cascade box">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-users"></i>
<span class="bold uppercase">Create P.O form </span>
</div>
<div class="actions"> 
<!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
<!-- <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_canvass_form"><i class="fa fa-plus"> </i>Get PDF</button> -->
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
            <?php echo $POhead->prf_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $POhead->prf_id; ?>">
            <input type="hidden" name="rush_po_by" id="rush_po_by" value="<?php echo $this->session->userdata('user_id'); ?>"> 
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Requested By:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $POhead->firstname; echo $POhead->middlename; echo " "; echo $POhead->lastname; ?>          
        </p>
    </div>
</div>

<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Date Needed:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $POhead->date_needed; ?>
        </p>
    </div> 
</div>


</div>
<div class="col-md-6">
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Purpose:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $POhead->purpose; ?>
        </p>
    </div>
</div>

 <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Justification:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $POhead->justification; ?>
        </p>
    </div>
</div>
<!-- <div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo "&#8369; " . number_format($POhead->total_amount, 2); ?>
        </p>
    </div> 
</div>  -->
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Item description:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo $POhead->description; ?>
             <input type="hidden" id="spo_item" value="<?php echo $POhead->item_id; ?>">
             <input type="hidden" id="spo_qty" value="<?php echo $POhead->qty; ?>">

        </p>
    </div> 
</div> 
    </div>
    
  

<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table id="rush_po_table" class="table table-hover">                    
       <thead>
            <tr>
                <th class="col-md-20">Item Description</th>           
                <th class="col-md-20">Item Qty</th>
                <th class="col-md-20">Item Unit</th>
                <th class="col-md-20">Item Remark</th>                
                <th>Supplier name</th>                          
                <th>Price Offer</th> 
                <th>Contact Person</th>
                <th>Contact Number</th>                         
                <th>TOP</th>
                <th>Action</th>
            </tr>
        </thead>
    <tbody>
        <tr>

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="item_description" name ="item_description" >
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($all_items2 as $all_items2){ ?>
    <option value="<?php echo $all_items2['item_id'];?>"><?php echo 
    $all_items2['description'];?></option><?php } ?>
    </select>    
    </td>

    <td >
    <select class="form-control select2 select2-hidden-accessible" id="quote_qty" name="quote_qty" required>
    <option value="0" selected disabled></option>
    </select>
    </td>

    <td >
    <select class="form-control select2 select2-hidden-accessible" id="quote_unit" name="quote_unit" required>
    <option value="0" selected disabled></option>
    </select>
    </td>

    <td>
    <select class="form-control select2 select2-hidden-accessible" id="quote_remark" name="quote_remark" required>
    <option value="0" selected disabled></option>
    </select>
    </td>

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="rush_sup_name" name ="rush_sup_name" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($suppliers as $suppliers){ ?>
    <option value="<?php echo $suppliers['supplier_id'];?>"><?php echo 
    $suppliers['supplier_name'];?></option><?php } ?>
    </select>   
    </td>   


    <td>
        <input type="isNumber" name="rush_price_offer" id="rush_price_offer" class="form-control">
    </td>

    <td>
        <input type="text" name="rush_person" id="rush_person" class="form-control">
    </td>
      <td>
        <input type="isNumber" name="rush_number" id="rush_number" class="form-control">
    </td>

    <td>
        <input type="isNumber" name="rush_top" id="rush_top" class="form-control">
    </td>
      <td>
        <a href="#" id="add_rush_po" class ="btn btn-info">Add</a>
    </td>
<tbody>

</tbody>
</table>
</div>
</div>

</form>

<div class="form-group col-md-11">
<button type="button" id="rush_po_request" class="btn btn-primary ">Create</button>

<button type="submit" onclick="clearFields()" value="Clear" class="btn btn-danger ">Cancel</button>


</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div>

