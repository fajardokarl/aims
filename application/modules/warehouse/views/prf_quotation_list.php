<head>
    
</head>

<div class="row">

<div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Create quotation form</span>
                </div>

    <div class="form-group">
        <div class="form-control "> 
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group profile-info">
                                <div class="col-md-12">
                                                                    
                                      <div class="actions"> 
                                            </div> 
                                              </select> 

<form method="post" name = "prf" id="prf">  

  
    <div class="portlet-body">
    <div class="row">
    <div class="form-group"> 
    
    <div class= "form-group">
    <label name="date_requested" id="date_requested"> <font color="teal"><b> Date: <?php echo date("m/d/Y") . "<br>"; ?></b></font></label>
    </div> 

    <div class="form-group">
    <label><span class="caption-subject font-grey-mint bold uppercase"> PR No:</span></label>
    <div">
        <p class="form-control-static">
            <?php echo $prf->prf_id; ?>
            <input type="hidden" id="prf_id" value="<?php echo $prf->prf_id; ?>">
        </p>
    </div>
<input type="hidden" name="requested_by_id" id="requested_by_id" value="<?php echo $this->session->userdata('user_id'); ?>">

</div>

    </div>
    </div>
    </div>

<div class="col-md-12">
<div class="row">
<div class="cpl-md-12">
    


<!-- <table id="quotation_item_table" class="table table-hover">
<thead>
<tr>
   
    <th>Item Description</th>
    <th>QTY</th>        
    <th>Supplier</th>
  
        
    </tr>
    </thead>
    <tbody>
    <?php foreach($sample_qoutation as $sample_qoutation){ ?>
    <tr>        
    <td><?php echo $sample_qoutation['description']; ?></td>
    <td><?php echo $sample_qoutation['qty']; ?></td>
    <td>

    <div class="col-md-5">   
    <select id="supplier_name" name="supplier_name" class="form-control select2-multiple" multiple>

    <?php foreach($all_suppliers as $all_suppliers){ ?>
    <option value="<?php echo $all_suppliers['supplier_id'];?>"><?php echo 
    $all_suppliers['supplier_name'];?></option><?php } ?>

    </select>    
    </td>   
    </tr>
<?php } ?>
</tbody>
</table>  --> 



    <table id="quotation_item_table" class="table table-hover">    
       <thead>
            <tr>
                <th class="col-md-20">Item Description</th>
                <th  class="col-md-20">Budget ID </th>
                <th  class="col-md-20">Item Qty</th>
                <th  class="col-md-20">Item Unit</th>
                <th class="col-md-20">Item Remark</th>                
                <th class="col-md-15">Supplier Description</th> 
                <th class="col-md-20">Action</th>
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
    <select class="form-control select2 select2-hidden-accessible" id="budget_id" name="budget_id" required>
    <option value="0" selected disabled></option>
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
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="supplier_name" name ="supplier_name" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($suppliers as $suppliers){ ?>
    <option value="<?php echo $suppliers['supplier_id'];?>"><?php echo 
    $suppliers['supplier_name'];?></option><?php } ?>
    </select>

   
    </td>   


  
    <td>
        <a href="#" id="add_quotation" class ="btn btn-info">Add</a>
    </td>
    </tr>
    </tbody>
                    </table> 






                </div>
            </div>
    </div> 

 

<!-- <div class="row">
 <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Contact Person<font color="red"> * </font></label>
           <label id="contact_person" name="contact_person"  class ="disabled selected">________________________</label>
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Contact Number<font color="red"> * </font></label>
           <label id="contact_number" name="contact_number"  class ="disabled selected">________________________</label>
        </div>
    </div>


    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Terms of Payment<font color="red"> * </font></label>            
           <label id="terms_of_payment" name="terms_of_payment"  class ="disabled selected">________________________</label>
        </div>
    </div> -->
  

<!-- <div class="form-group">
<h3><b><font color="teal">Total Amount: <span id = "total_amount" name = "total_amount"></span></font></b></h3>

</div> -->


<div class="form-group col-md-11">
<button type="button" id="request_quotation" name="request_quotation" value="1" class="btn btn-primary ">Create</button>

<!-- <div class="form-group col-md-11">
<button type="button" id="trybtn" name="trybtn" value="1" class="btn btn-primary ">Try</button> -->


<script>
function myFunction() {
    window.print();
}
</script>  
</div>
</div>
</form>
</div>
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





<!-- display info -->

                                        











                                                  
                                                                   
                                           
