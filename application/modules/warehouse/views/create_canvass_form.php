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
    <label name="created_by" id="created_by"> <font color="teal"><b>From: <?php echo $this->session->userdata('firstname');?> <?php echo $this->session->userdata('lastname'); ?></b></font></label>
    </div>

    <div class="form-group">
    <label name="department_name" id="department_name"><font color="teal"><b> Department: <?php echo $this->session->userdata('department_name'); ?> </b></font></label>
    </div>

    <input type="hidden" name="department_id" id="department_id" value="<?php echo $this->session->userdata('department_id'); ?>">

    <input type="hidden" name="requested_by_id" id="requested_by_id" value="<?php echo $this->session->userdata('user_id'); ?>">

    
    </div>
    </div>
    </div>

<div class="col-md-20">
<div class="row">
<div class="cpl-md-20">
        <table id="supplier_table" class="table table-hover">                       
       <thead>
            <tr>
                <th>Supplier Name</th>
            </tr>
        </thead>        
    <tbody>
        <tr>
    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="supplier_name" name ="supplier_name" >
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($all_suppliers as $all_suppliers){ ?>
    <option value="<?php echo $all_suppliers['supplier_id'];?>"><?php echo 
    $all_suppliers['supplier_name'];?></option><?php } ?>
    </select>    
    </td>   
        </tr>
    </tbody>
    </table>  
    <table id="quotation_item_table" class="table table-hover">                    
       <thead>
            <tr>
                <th class="col-md-20">Item Description</th>
                <!-- <th class="col-md-15">Price Offer</th>  -->
                <th class="col-md-20"></th>
            </tr>
        </thead>
    <tbody>
        <tr>
    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="item" name ="item" >
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($all_items as $all_items){ ?>
    <option value="<?php echo $all_items['item_id'];?>"><?php echo 
    $all_items['description'];?></option><?php } ?>
    </select>    
    </td>

    <!-- <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible">
         <option value="0" id="underline_opt" name ="underline_opt">__________________</option>  
    </select>    
    </td> -->
  
    <td>
        <a href="#" id="add_canvass" class ="btn btn-info">Add</a>
    </td>
        </tr>
    </tbody>
                    </table>  
                </div>
            </div><!-- end row -->
    </div>  

<div class="row">
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
    </div>
  

<!-- <div class="form-group">
<h3><b><font color="teal">Total Amount: <span id = "total_amount" name = "total_amount"></span></font></b></h3>

</div> -->


<div class="form-group col-md-11">
<button type="button" id="request_quotation" name="request_quotation" value="1" class="btn btn-primary ">Request</button>


<button  type="hidden" onclick="myFunction()" name ="print" id="print" class="btn btn-danger" >Print</button>

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

                                        











                                                  
                                                                   
                                           
