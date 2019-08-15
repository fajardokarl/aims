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
<div class="form-group">
    <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Total Amount:</span></label>
    <div class="col-md-9">
        <p class="form-control-static">
            <?php echo "&#8369; " . number_format($POhead->total_amount, 2); ?>
        </p>
    </div> 
</div> 
    </div>
    <div class="actions col-md-3">   
    <!-- <label name="label_project" id="label_project" class="control-label">Supplier <font color="red"> * </font></label> -->
    <select class="form-control select2 select2-hidden-accessible" id="supplier_selected" name ="supplier_selected" >
  
    <option value="0" >Select Supplier</option>
    <?php foreach($supplier_selected as $supplier_selected){ ?>
    <option value="<?php echo $supplier_selected['supplier_id'];?>"><?php echo 
    $supplier_selected['supplier_id'];?></option><?php } ?>
    </select>    
    
    </div>    

<div class="portlet-body">
<div class="col-md-12">
<div style="max-width:3000px; white-space: nowrap; ">
<table  id="create_po_table" class="table table-hover">
<thead>
<tr>
    <th>Canvass detail </th>
    <th>Supplier Name </th>
    <th>Item Description</th>
    <th>Quantity</th>
    <th>Unit</th>
    <th>Remarks</th>
    <th>Price Offer</th>
    <th>Total</th>
    <th>Status</th>   
    <th>item_id</th>  
    <th>Budget ID</th>
    <th>TOP</th>
</tr>
</thead>
<tbody>
<!-- <?php foreach($PO_details as $PO_details){ ?>
    <tr>
       <td><?php echo $PO_details['canvass_detail_id']; ?></td>
       <td><?php echo $PO_details['supplier_id']; ?></td>
       <td><?php echo $PO_details['description']; ?></td>
       <td><?php echo $PO_details['qty_item']; ?></td>                         
       <td><?php echo "&#8369; " . number_format ($PO_details['price_offer']) ;?></td>
       <td><?php echo "&#8369; " . number_format ($PO_details['total']); ?></td>
       <td><?php echo $PO_details['description']; ?></td>
       <td>
           <?php 
                if ($PO_details['is_approved'] == 1) {
                    echo "<span class='font-green-jungle bold'>Approved</span>";
                }else{
                    echo "<span class='font-red-intense bold'>NO</span>";
                }
            ?>
       </td>
    
    </tr>
<?php } ?> -->
</tbody>
</table>
</div>
</div>






</form>

<div class="form-group col-md-11">
<button type="button" id="po_request" class="btn btn-primary ">Request</button>

<button type="submit" onclick="clearFields()" value="Clear" class="btn btn-danger ">Cancel</button>


</div>
</div>
</div>


</div>
</div>
</div>
</div>
</div>

