<head>
</head>

<div class="row">
     
<div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Request Information</span>
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
<form method="post">    

    <form class = "form-group" action="<?php echo base_url() ?>login/users" method="post">

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


   <input type="text" name="budget_amount" id="budget_amount" value="<?php echo $this->session->userdata('budget_amount'); ?>">


    <div class="form-group">
    <label name="budget_amount" id="budget_amount" class="form-group control-label"><font color="teal"><b> Annual Budget: <?php echo $this->session->userdata('budget_amount'); ?> </b></font></label>
    </div>
    </div>
    </div>
    </div>
    <div class="col-md-20">
            <div class="row">
                <div class="cpl-md-20">
                    <table id="cust_contacts_table" class="table table-hover">                    
                       <thead>
                            <tr>
                                <th>Item</th>                      
                                <th>Price</th>
                                <th>Qty</th>
                                <th>Unit</th>
                                <th>Request Type</th>  
                                <th>Item Remarks</th>
                                <th>Total</th>                           
                                <th>Action</th>
                            </tr>
                        </thead>
    <tbody>
        <tr>
    <td>
    <select class="form-control select2 select2-hidden-accessible" id="item" name ="item" >
    <option class ="disabled selected">---- Item ----</option>

    <?php foreach($all_items as $all_items){ ?>
    <option value="<?php echo $all_items['item_id'];?>"><?php echo 
    $all_items['description'];?></option><?php } ?>
    </select>    
    </td>    

    <td>
        <input type="isNumber" name="cust_cont_value" id="cust_cont_value" class="form-control">
    </td>

    <td>
        <input type="isNumber" name="qty" id="qty" class="form-control">
    </td>

    <td>
    <select class="form-control select2 select2-hidden-accessible" id="uom" name ="uom" >
    <option class ="disabled selected">---- Select ----</option>

    <?php foreach($all_uom as $all_uom){ ?>
    <option value="<?php echo $all_uom['uom_id'];?>"><?php echo 
    $all_uom['uom_name'];?></option><?php } ?>
    </select>    
    </td> 

    <td>
    <div class="form-group">        
     <select name="budgeted" id="budgeted" class="form-control">
        <option class ="disabled selected">---- Type ----</option>        
        <option value="1">Budgeted</option>
        <option value="2">Unbudgeted</option>        
     </select>      
  </div>
  </td>   
   
    <td>
        <input type="text" name="item_remarks" id="item_remarks" class="form-control">
    </td>

     <td>
        <Label type="isNumber" name="sub_total" id="sub_total" class="form-control">Total</Label>   
    </td>    

    <td>
        <a href="#" id="add_cust_contact" class ="btn btn-info">Add</a>
    </td>
        </tr>
    </tbody>
                    </table>  
                </div>
            </div><!-- end row -->
    </div>
    


<div class="row">
<div class="col-md-4">
            <div data-date-format="mm/yyyy" >
              <label class="control-label">Date needed <font color="red"> * </font></label>
                <input  type="text" name="birthdate" placeholder="yyyy-mm-dd" class="form-control" id="birthdate" maxlength="10" required onkeypress="return isNumber()"/>                
            </div>
</div>
<!-- <div class="col-md-2">
     <label class="control-label">Date needed <font color="red"> * </font></label>
<div class="input-group date" id="date_needed" name="date_needed"  data-provide="datepicker">
   
    <input type="text" class="form-control">
    <div class="input-group-addon">
        <span class="glyphicon glyphicon-th"></span>
    </div>
</div>
</div> -->


    <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Purpose<font color="red"> * </font></label>
           <textarea tabindex="4" type="text" id="purpose" name="purpose"  placeholder="" maxlength="30" class="form-control" > </textarea>
        </div>
    </div>


    <div class="col-md-4">

        <div class="form-group">
            <label class="control-label">Justification<font color="red"> * </font></label>            
           <textarea tabindex="4" type="text" id="justification" name="justification"  placeholder="" maxlength="30" class="form-control" > </textarea>
        </div>
    </div>

    <div class="col-md-4">

        <div class="form-group">
            <label class="control-label">Remarks<font color="red"> * </font></label>            
           <textarea tabindex="4" type="text" id="remarks" name="remarks"  placeholder="" maxlength="30" class="form-control" > </textarea>
        </div>
    </div>

  
  
 
</div>
<div class="form-group">
<label name = "total_amount" id="total_amount" class="control-label"> <font color="green"><h4><b>Total:</b></h4> </font></label>
</div>

<button type="button" id="saveItems" name="saveItems" value="1" class="btn btn-primary ">Request</button>
<button type="submit" onclick="clearFields()" value="Clear" class="btn btn-danger ">Cancel</button>



</form>
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







                                                  
                                                                   
                                           
