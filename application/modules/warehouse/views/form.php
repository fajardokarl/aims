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
    
    <div class="col-md-12">           
                <table class="table table-hover" id="tbl_budgeted">
                    <thead>
                    <tr>                       
                        <th>Item Description</th>
                        <th>Item Quantity</th>                      
                        <th>Approved Amount</th>
                        <th>Total Amount</th>
                        <th>Approved By</th>
                        <th>Date Approved</th>
                        
                    </tr>
                    </thead>
                    <tbody>
                <?php foreach($all_budgeted as $all_budgeted){ ?>
                    <tr>
                         
                        <td><?php echo $all_budgeted['description']; ?></td>
                        <td><?php echo $all_budgeted['budget_quantity']; ?></td>        
                        <td><?php echo "&#8369; " . number_format ($all_budgeted['budget_amount']) ;?></td>
                         <td><?php echo "&#8369; " . number_format ($all_budgeted['budget_amount']*$all_budgeted['budget_quantity']) ;?></td>
                        <td><?php echo $all_budgeted['firstname']. ' ' . $all_budgeted['lastname']; ?></td>
                        <td><?php echo $all_budgeted['approve_date']; ?></td>
                        
                    </tr>
                <?php } ?>
                </tbody>

            </table>      
    </div>

    <div class="col-md-2">
    <label name="label_project" id="label_project" class="control-label">Project <font color="red"> * </font></label>
    <select class="form-control select2 select2-hidden-accessible" id="project_id" name ="project_id" >
  
    <option value="01" >Department Usage</option>
    

    <optgroup label="Estates">

    <?php foreach($all_project as $all_project){ ?>
    <option value="<?php echo $all_project['project_id'];?>"><?php echo 
    $all_project['project_name'];?></option><?php } ?>
    </optgroup>
    </select>    
    
    </div>


    </div>
    </div>
    </div>

<div class="col-md-12">
<div class="row">
<div class="cpl-md-20">
    <table id="prf_item_table" class="table table-hover">                    
       <thead>
            <tr>
                <th class="col-lg-2">Item</th>    
                <th>Budget ID</th> 
                <th>Approved amount</th>                 
                <th>Price</th>
                <th>Qty</th>
                <th>Unit</th>
                <th>Budget Type</th>  
                <th>Item Remarks</th>
                <!-- <th>Delivery</th>     -->           
                <th>Total</th>                           
                <th>Action</th>
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

    <td>
    <select class="form-control select2 select2-hidden-accessible" id="budget_id" name="budget_id" required>
    <option selected disabled></option>
    </select>
    </td>  


    <td>
    <select class="form-control select2 select2-hidden-accessible" id="approved_amount" name="approved_amount" required>
    <option selected disabled></option>
    </select>
    </td>      

    <td>
        <input type="isNumber" data-toggle="modal" name="cust_cont_value" id="cust_cont_value" class="form-control">
    </td>

    <td>
        <input type="isNumber" name="qty" id="qty" class="form-control">
    </td>

    <td>  

    <select class="form-control select2 select2-hidden-accessible" id="uom_opt" name="uom_opt" required>
    <option value="0" selected disabled></option>
    </select>

    </td> 

    <td>
    <select class="form-control select2 select2-hidden-accessible" id="budgeted" name="budgeted" required>
    <option value="1" selected disabled></option>
    </select>
    </td> 

    <td>
        <input type="text" name="item_remarks" id="item_remarks" class="form-control">
    </td>


    <!-- <td>     
    <div class="form-group">        
    <select name="delivery" id="delivery" class="form-control">
    <option class ="disabled selected">Select</option>
    <option value="0">Pick-up</option> 
    <?php foreach($all_warehouse as $all_warehouse){ ?>
    <option value="<?php echo $all_warehouse['warehouse_id'];?>"><?php echo 
    $all_warehouse['warehouse_description'];?></option><?php } ?>       
     </select>      
  </div> 
    </td> -->
     

     <td>
        <Label type="isNumber" name="sub_total" id="sub_total" class="form-control">Total</Label>   
    </td>    

    <td>
        <a href="#" id="add" class ="btn btn-info">Add</a>
    </td>
        </tr>
    </tbody>
                    </table>  
                </div>
            </div>
    </div> 
    </form> 





<!-- <form class="col-md-12" method="post" name = "capex_repairs" id="capex_repairs">
<div class="row">
<div class="col-md-18">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>CAPEX FORM [Replacement/Capitalizable Repairs] </div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
<a href="" class="fullscreen"> </a>
</div>
</div>

<div class="portlet-body">
<div class="col-md-18">
<div class="row">
<div class="cpl-md-18">

    <table id="prf_item_table_sample" style="width:100%" class="table table-hover">                    
       <thead>
            <tr>
                <th  >Item to be replace</th> 
                <th  >Item description</th>             
                <th  >Project/Item Classification</th>
                <th  >CAPEX Type</th>  
                <th  >Location</th>
                <th  >Date Acquired</th>
                <th  >Net book value</th>
                <th  >Reason for replacement</th>
                <th  >Item purpose</th>
                <th  >Advantage over new purchase,lease or trade</th>              
                <th  >Jusitification for unbudgeted item</th>
                <th  >Equipment/Material/supplies</th>                
                <th  >Labor Cost</th> 
                <th  >Freight and Handling</th>  
                <th  >Other incedent expense</th>
                <th  >Total Est. project cost</th>
                <th  >Less: Trade-in</th>                  
                <th  >Net Estimated Project Cost</th>            
                <th  >Action</th>
            </tr>

        </thead>
    
    <tbody>
    <tr>

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="repair_replacement" name ="repair_replacement" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($item_replacement as $item_replacement){ ?>
    <option value="<?php echo $item_replacement['item_id'];?>"><?php echo 
    $item_replacement['description'];?></option><?php } ?>
    </select>    
    </td>   

    <td>
    <div class="col-md-50">
    <div class="form-group">               
    <input type="text" class="form-control form-filter input-sm" id="repair_description" name="repair_description" placeholder="Description" /> </div>   
    </div>
    </div> 
    </td> 

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="repair_classification_name" name ="repair_classification_name" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($classification as $classification){ ?>
    <option value="<?php echo $classification['budget_classification_id'];?>"><?php echo 
    $classification['classification_name'];?></option><?php } ?>
    </select> 
    </td>

    <td>   
    <select name="repair_capex_type" id="repair_capex_type" class="form-control">
        <option class ="disabled selected">Select</option>        
        <option value="1">acquisition</option>
        <option value="2">replacement</option>       
    </select>    
    </td>   
       
    <td>
    <div class="margin-bottom-5">
    <input type="text" class="form-control form-filter input-sm" id="repair_location" name="repair_location" placeholder="Location" /> </div>   
    </td>

    <td>
    <div class="margin-bottom-5">
       <div data-date-format="mm/yyyy" >         
            <input  type="text" name="date_acquired" placeholder="yyyy-mm-dd" class="form-control" id="date_acquired" maxlength="10" required onkeypress="return isNumber()"/>             
        </div>
    </div>
    </td>

    <td>
    <div class="margin-bottom-5">
    <input type="text" class="form-control form-filter input-sm" id="repair_net_book_value" name="repair_net_book_value"  placeholder="Net book value" /> </div>
    </td>
    
    <td>
    <div class="margin-bottom-5">       
    <input type="text" class="form-control form-filter input-sm" name="repair_reason_for_replacement" id="repair_reason_for_replacement"  placeholder="Reason for replacement"  /> </div>
    </td>

   <td>
   <div class="margin-bottom-5">
   <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="repair_purpose" id="repair_purpose"  placeholder="Item purpose"  /> </div>              
       
   </div>
   </div>   
   </td> 

    <td>
    <div class="margin-bottom-5">       
    <div class="form-group">               
       <textarea tabindex="4" type="text" id="repair_advantage_over_new" name="repair_advantage_over_new"  placeholder="Advantage over new purchase,lease or trade" maxlength="30" class="form-control" > </textarea>
    </div>
    </div>
    </td>


    <td>
    <div class="margin-bottom-5">
        <select name="repair_capex_justification_id" id="repair_capex_justification_id" class="form-control">
        <option class ="disabled selected">Select</option>  
        <?php foreach($all_justification as $all_justification){ ?>
        <option value="<?php echo $all_justification['capex_justification_id'];?>"><?php echo 
        $all_justification['justification'];?></option><?php } ?>       
    </select>
    </div> 
    </td>

    <td>   
    <input type="text" class="form-control form-filter input-sm" name="repair_equipment_cost" id="repair_equipment_cost" placeholder="Equipment/Material/supplies"  />
    </td>    


    <td>
    <input type="text" class="form-control form-filter input-sm" name="repair_labor_cost" placeholder="Labor" id="repair_labor_cost"  /> 
    </td>


    <td>
    <input type="text" class="form-control form-filter input-sm" name="repair_freight_cost" placeholder="Freight Cost" id="repair_freight_cost" /> 
    </td>


    <td>      
    <input type="text" class="form-control form-filter input-sm" name="repair_incidental_expenses" placeholder="Incident expenses" id="repair_incidental_expenses"  />
    </td> 

    <td> 
    <Label type="isNumber" name="repair_estimated_cost" id="repair_estimated_cost" class="form-control">Total</Label>        
    </td>

    <td>
    <input type="text" class="form-control form-filter input-sm" name="repair_less_trade_in" placeholder="Less: Trade-in" id="repair_less_trade_in" />   
    </td> 
 
    <td>
    <Label type="isNumber" name="repair_net_estimated_cost" id="repair_net_estimated_cost" class="form-control">Total</Label>        
    </td>

    <td>
        <a href="#" id="add_repairs" class ="btn btn-info">Add</a>
    </td>

        </tr>
    </tbody>
      
                    </table> 
   

                </div>
            </div>
        </div>
        </div>
</div>
</div>
</div>
</form>




<form class="col-md-12" method="post" name = "capex_acquisition" id="capex_acquisition">
<div class="row">
<div class="col-md-18">


<div class="portlet box red">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>CAPEX FORM [New Project/Acquisition] </div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
<a href="" class="fullscreen"> </a>
</div>
</div>

<div class="portlet-body">
<div class="col-md-18">
<div class="row">
<div class="cpl-md-18">


    <table id="repairs" style="width:100%" class="table table-hover">                    
       <thead>
            <tr>
                <th  >Item to be replace</th> 
                <th  >Item description</th>             
                <th  >Project/Item Classification</th>
                <th  >CAPEX Type</th>    
                <th  >Location</th>       
                <th  >Est. useful life</th>
                <th  >Capacity of unit</th>
                <th  >Limitation of unit</th>
                <th  >Advantage over repair,lease or trade</th> 
                <th  >Item Purpose</th>      
                <th  >Item Remarks</th>       
                <th  >Jusitification for unbudgeted item</th>
                <th  >Equipment/Material/supplies</th>              
                <th  >Labor Cost</th> 
                <th  >Freight and Handling</th>  
                <th  >Other incedent expense</th>
                <th  >Total Est. project cost</th>
                <th  >Less: Trade-in</th>                  
                <th  >Net Estimated Project Cost</th>            
                <th >Action</th>
            </tr>

        </thead>
    <tbody>
    <tr>

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="new_replacement" name ="new_replacement" >
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($item_replacement as $item_replacement){ ?>
    <option value="<?php echo $item_replacement['item_id'];?>"><?php echo 
    $item_replacement['description'];?></option><?php } ?>
    </select>    
    </td>   

    <td>
    <div class="col-md-50">
    <div class="form-group">               
       <textarea tabindex="4" type="text" id="new_description" name="new_description"  placeholder="Description" maxlength="30" class="form-control" > </textarea>
    </div>
    </div> 
    </td> 

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="new_classification_name" name ="new_classification_name" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($classification as $classification){ ?>
    <option value="<?php echo $classification['budget_classification_id'];?>"><?php echo 
    $classification['classification_name'];?></option><?php } ?>
    </select> 
    </td>

    <td>   
     <select name="new_capex_type" id="new_capex_type" class="form-control">
        <option class ="disabled selected">Select</option>        
        <option value="1">acquisition</option>
        <option value="2">replacement</option>       
     </select>    
     </td>
        
    <td>            
    <div class="margin-bottom-5">
    <input type="text" class="form-control form-filter input-sm" id="new_location" name="new_location" placeholder="Location" /> 
    </div>   
    </td>



        <td>
        <div class="margin-bottom-5">
        <input type="text" class="form-control form-filter input-sm" id="new_estimate_useful_life" name="new_estimate_useful_life"  placeholder="Estemated useful life" /> </div>
        </td>

        <td>
        <div class="margin-bottom-5">
        <input type="text" class="form-control form-filter input-sm" id="new_capacity_of_unit" name="new_capacity_of_unit"  placeholder="Capacity of unit" /> </div>
        </td>

        <td>
        <div class="margin-bottom-5">
        <input type="text" class="form-control form-filter input-sm" id="new_limitations_of_unit" name="new_limitations_of_unit" placeholder="Limitition of unit" /> </div>
        </td>

        
        <td>
        <div class="margin-bottom-5">       
        <input type="text" class="form-control form-filter input-sm" name="new_advantage_over_repair" id="new_advantage_over_repair"  placeholder="Advantages repair, lease or trade"  /> </div>
        </td>

        <td>
       <div class="col-md-50">
        <div class="form-group">
                   
           <textarea tabindex="4" type="text" id="new_purpose" name="new_purpose"  placeholder="Purpose" maxlength="30" class="form-control" > </textarea>
        </div>
        </div>  
   
        </td>


        <td>
       <div class="col-md-50">
        <div class="form-group">
                   
           <textarea tabindex="4" type="text" id="new_remarks" name="new_remarks"  placeholder="Purpose" maxlength="30" class="form-control" > </textarea>
        </div>
        </div>  
   
        </td>
      

        <td>
        <div class="margin-bottom-5">
            <select name="new_capex_justification_id" id="new_capex_justification_id" class="form-control">
            <option class ="disabled selected">Select</option>  
            <?php foreach($all_justification_repair as $all_justification_repair){ ?>
            <option value="<?php echo $all_justification_repair['capex_justification_id'];?>"><?php echo 
            $all_justification_repair['justification'];?></option><?php } ?>       
        </select>
        </div> 
        </td>

        <td>   
        <input type="text" class="form-control form-filter input-sm" name="new_equipment_cost" id="new_equipment_cost" placeholder="Equipment/Material/supplies"  />
        </td>    

    
        <td>
        <input type="text" class="form-control form-filter input-sm" name="new_labor_cost" placeholder="Labor" id="new_labor_cost"  /> 
        </td>


        <td>
        <input type="text" class="form-control form-filter input-sm" name="new_freight_cost" placeholder="Freight Cost" id="new_freight_cost" /> 
        </td>


        <td>      
        <input type="text" class="form-control form-filter input-sm" name="new_incidental_expenses" placeholder="Incident expenses" id="new_incidental_expenses"  />
        </td> 

        <td> 
        <Label type="isNumber" name="new_estimated_cost" id="new_estimated_cost" class="form-control">Total</Label>        
        </td>

        <td>
        <input type="text" class="form-control form-filter input-sm" name="new_less_trade_in" placeholder="Less: Trade-in" id="new_less_trade_in" />   
        </td> 
     
        <td>
        <Label type="isNumber" name="new_net_estimated_cost" id="new_net_estimated_cost" class="form-control">Total</Label>        
        </td>

  

    <td>
        <a href="#" id="add_acquisition" class ="btn btn-info">Add</a>
    </td>
        </tr>
    </tbody>
      
                    </table> 

                </div>
            </div>
        </div>
        </div>
</div>
</div>
</div>
</div>
</form> -->

















<form class="col-md-12" method="post" name = "capex" id="capex">
<div class="row">
<div class="col-md-18">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>CAPEX FORM</div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
<a href="" class="fullscreen"> </a>
</div>
</div>

<div class="portlet-body">
<div class="col-md-18">
<div class="row">
<div class="cpl-md-18">

    <table id="capex_table" style="width:100%" class="table table-hover">                    
       <thead>
            <tr>
                <!-- <th  >Item description</th>              -->
                <th  >Project/Item Classification</th>
                <th  >CAPEX Type</th> 
                <th  >Item Purpose</th>
                <th  >Item Remarks</th>
                <th  >Jusitification for unbudgeted item</th>
                <th  >Equipment/Material/supplies</th>                
                <th  >Labor Cost</th> 
                <th  >Freight and Handling</th>  
                <th  >Other incedent expense</th>
                <th  >Total Est. project cost</th>
                <th  >Less: Trade-in</th>                  
                <th  >Net Estimated Project Cost</th>            
                <th  >Action</th>
            </tr>

        </thead>
    
    <tbody>
    <tr> 

<!--     <td>
    <div class="col-md-50">
    <div class="form-group">               
    <input type="text" class="form-control form-filter input-sm" id="capex_description" name="repair_description" placeholder="Description" /> </div>   
    </div>
    </div> 
    </td>  -->

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="classification_name" name ="classification_name" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($classifications as $classifications){ ?>
    <option value="<?php echo $classifications['budget_classification_id'];?>"><?php echo 
    $classifications['classification_name'];?></option><?php } ?>
    </select> 
    </td>

    <td>   
    <select name="capex_type" id="capex_type" class="form-control">
        <option class ="disabled selected">Select</option>        
        <option value="1">acquisition</option>
        <option value="2">replacement</option>       
    </select>    
    </td>   
  

   <td>
   <div class="margin-bottom-5">
   <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="purpose" id="purpose"  placeholder="Item purpose"  /> </div>              
       
   </div>
   </div>   
   </td> 

   <td>
   <div class="margin-bottom-5">
   <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="remarks" id="remarks"  placeholder="Item remarks"  /> </div>              
       
   </div>
   </div>   
   </td> 

    <td>
    <div class="margin-bottom-5">
        <select name="capex_justification_id" id="capex_justification_id" class="form-control">
        <option class ="disabled selected">Select</option>  
        <?php foreach($all_justifications as $all_justifications){ ?>
        <option value="<?php echo $all_justifications['capex_justification_id'];?>"><?php echo 
        $all_justifications['justification'];?></option><?php } ?>       
    </select>
    </div> 
    </td>

    <td>   
    <input type="text" class="form-control form-filter input-sm" name="equipment_cost" id="equipment_cost" placeholder="Equipment/Material/supplies"  />
    </td>    


    <td>
    <input type="text" class="form-control form-filter input-sm" name="labor_cost" placeholder="Labor" id="labor_cost"  /> 
    </td>


    <td>
    <input type="text" class="form-control form-filter input-sm" name="freight_cost" placeholder="Freight Cost" id="freight_cost" /> 
    </td>


    <td>      
    <input type="text" class="form-control form-filter input-sm" name="incidental_expenses" placeholder="Incident expenses" id="incidental_expenses"  />
    </td> 

    <td> 
    <Label type="isNumber" name="estimated_cost" id="estimated_cost" class="form-control">Total</Label>        
    </td>

    <td>
    <input type="text" class="form-control form-filter input-sm" name="less_trade_in" placeholder="Less: Trade-in" id="less_trade_in" />   
    </td> 
 
    <td>
    <Label type="isNumber" name="net_estimated_cost" id="net_estimated_cost" class="form-control">Total</Label>        
    </td>

    <td>
        <a href="#" id="add_capex" class ="btn btn-info">Add</a>
    </td>

        </tr>
    </tbody>
    
     
      
                    </table> 
                </div>
            </div>
        </div>
        </div>
</div>
</div>
</div>
</form>


<form class="col-md-12" method="post" name = "acquisition" id="acquisition">
<div class="row">
<div class="col-md-18">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>[New Project/Acquisition]</div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
<a href="" class="fullscreen"> </a>
</div>
</div>

<div class="portlet-body">
<div class="col-md-18">
<div class="row">
<div class="cpl-md-18">

   <table id="acquisition_table" style="width:100%" class="table table-hover">                    
       <thead>
            <tr>
                <th  >Item to be purchase</th>                            
                <th  >location</th> 
                <th  >Estimate useful life</th>
                <th  >Capacity of unit</th>
                <th  >Limitations of unit</th>                
                <th  >Advantage over repair, lease or trade-in</th>          

                <th  >Action</th>
            </tr>

        </thead>
    
    <tbody>
    <tr> 

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="new_replacement" name ="new_replacement" >
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($item_replacements as $item_replacements){ ?>
    <option value="<?php echo $item_replacements['item_id'];?>"><?php echo 
    $item_replacements['description'];?></option><?php } ?>
    </select> 
    </td> 

   

    <td>   
    <div class="margin-bottom-5">
    <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="new_location" id="new_location"  placeholder="Location"  /> 
    </div>
    </div>
    </div>    
    </td>         
   

   <td>
   <div class="margin-bottom-5">
   <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="new_estimate_useful_life" id="new_estimate_useful_life"  placeholder="Estimate useful life"  /> </div>              
       
   </div>
   </div>   
   </td> 



    <td>
    <div class="margin-bottom-5">
    <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="new_capacity_of_unit" id="new_capacity_of_unit"  placeholder="Capacity of unit"  /> 
    </div>
    </div>
    </div> 
    </td>

    <td>   
    <input type="text" class="form-control form-filter input-sm" name="new_limitations_of_unit" id="new_limitations_of_unit" placeholder="Limitations of unit"  />
    </td>    


    <td>
    <input type="text" class="form-control form-filter input-sm" name="new_advantage_over_repair" placeholder="Advantage over new, lease or trade-in" id="new_advantage_over_repair"  /> 
    </td>
    
    <td>
        <a href="#" id="add_acquisition" class ="btn btn-info">Add</a>
    </td>

        </tr>
    </tbody>      
                    </table>   

                </div>
            </div>
        </div>
        </div>
</div>
</div>
</div>
</form>






<form class="col-md-12" method="post" name = "replacement" id="replacement">
<div class="row">
<div class="col-md-18">

<div class="portlet box green">
<div class="portlet-title">
<div class="caption">
<i class="fa fa-gift"></i>[Replacement/Capitalizable Repairs]</div>
<div class="tools">
<a href="javascript:;" class="collapse"> </a>
<a href="javascript:;" class="reload"> </a>
<a href="" class="fullscreen"> </a>
</div>
</div>

<div class="portlet-body">
<div class="col-md-18">
<div class="row">
<div class="cpl-md-18">

   <table id="replacement_table" style="width:100%" class="table table-hover">                    
       <thead>
            <tr>
                <th  >Item to be purchase</th>          
                <th  >location</th> 
                <th  >Date Acquired</th>
                <th  >Net book value</th>
                <th  >Reason for replacement</th>                
                <th  >Advantage over new purchase, lease or trade-in</th>
                <th  >Action</th>
            </tr>
        </thead>
    <tbody>
    <tr> 

<td>
<select class="col-md-8 form-control select2 select2-hidden-accessible" id="repair_replacement" name ="repair_replacement" >
<option value="0" class ="disabled selected">Select</option>

<?php foreach($item as $item){ ?>
<option value="<?php echo $item['item_id'];?>"><?php echo 
$item['description'];?></option><?php } ?>
</select> 
</td> 

    <td>   
    <div class="margin-bottom-5">
    <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="repair_location" id="repair_location"  placeholder="Location"  /> 
    </div>
    </div>
    </div>    
    </td>   
  

 <td>
    <div class="margin-bottom-5">
       <div data-date-format="mm/yyyy" >         
            <input  type="text" name="date_acquired" placeholder="yyyy-mm-dd" class="form-control" id="date_acquired" maxlength="10" required onkeypress="return isNumber()"/>             
        </div>
    </div>
    </td> 



    <td>
    <div class="margin-bottom-5">
    <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="repair_net_book_value" id="repair_net_book_value"  placeholder="Net book value"  /> 
    </div>
    </div>
    </div> 
    </td>



    <td>
    <div class="margin-bottom-5">
    <div class="form-group">
    <input type="text" class="form-control form-filter input-sm" name="repair_reason_for_replacement" id="repair_reason_for_replacement" placeholder="Reason for replacement"   /> 
    </div>
    </div>
    </td>

    <td>  
    <div class="margin-bottom-5">
    <div class="form-group"> 
    <input type="text" class="form-control form-filter input-sm" name="repair_advantage_over_new" id="repair_advantage_over_new" placeholder="Advantage over new purchase, lease or trade-in"  />
    </div>
    </div>
    </td>    

   
    <td>
        <a href="#" id="add_repairs" class ="btn btn-info">Add</a>
    </td>

        </tr>
    </tbody>
      
                    </table>
   

                </div>
            </div>
        </div>
        </div>
</div>
</div>
</div>
</form>


<div class="row">
<div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Delivery<font color="red"> * </font></label>            
    <select name="deliverTo" id="deliverTo" class="form-control">
    <option class ="disabled selected">Select</option>
    <?php foreach($all_warehouse1 as $all_warehouse1){ ?>
    <option value="<?php echo $all_warehouse1['warehouse_id'];?>"><?php echo 
    $all_warehouse1['warehouse_description'];?></option><?php } ?>       
    </select>      
    </div>
</div>  

<div class="col-md-4">
    <div class="form-group">
    <label class="control-label">Type of request<font color="red"> * </font></label>            
    <select name="request_type" id="request_type" class="form-control">   
    <option value="1">Regular</option>
    <option value="2">Rush</option>    
    </select>      
    </div>
</div>  
</div>
</div>


<div class="row">

      <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Purpose<font color="red"> * </font></label>
           <textarea tabindex="4" type="text" id="purpose_prf" name="purpose_prf"  placeholder="" maxlength="30" class="form-control" > </textarea>
        </div>
    </div>

<div class="col-md-4">
            <div data-date-format="mm/yyyy" >
              <label class="control-label">Date needed <font color="red"> * </font></label>
                <input  type="text" name="birthdate" placeholder="yyyy-mm-dd" class="form-control" id="birthdate" maxlength="10" required onkeypress="return isNumber()"/>             
            </div>
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
           <textarea tabindex="4" type="text" id="prf_remarks" name="prf_remarks"  placeholder="" maxlength="30" class="form-control" > </textarea>
        </div>
    </div>  
     <div class="col-md-4">
        <div class="form-group">
            <label class="control-label">Remarks<font color="red"> * </font></label>           
           
        </div>
    </div>  

   

<div class="form-group">
<h3><b><font color="teal">Total Amount: <span id = "total_amount" name = "total_amount"></span></font></b></h3>

</div>


<div class="form-group col-md-11">
<button type="button" id="prf_status_id" name="prf_status_id" value="0" class="btn btn-primary ">Request</button>

<button type="submit" onclick="clearFields()" value="Clear" class="btn btn-danger ">Cancel</button>
</div>
</form>

<div class="container">
  <!-- Trigger the modal with a button -->
  
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">CAPEX Type</h4>
        </div>
        <div class="modal-body">         

<input type="button" name ="replacemet" id="replacementcapex" data-dismiss="modal" class="btn red-mint btn-outline btn-block sbold uppercase" value="[Replacement/Capitalizable Repairs]">
<input type="submit" name="project" id="project" data-dismiss="modal" class="btn green-sharp btn-outline  btn-block sbold uppercase" value="[New Project/Acquisition]">
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
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
</div>
</div>
</div>
</div>
</div>



<!-- display info -->

                                        











                                                  
                                                                   
                                           
