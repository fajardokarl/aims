<head>
</head>

<div class="row">
     
<div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Employee Information</span>
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
    <label name="created" id="created"> <font color="teal"><b>User: <?php echo $this->session->userdata('firstname');?> <?php echo $this->session->userdata('lastname'); ?></b></font></label>
    </div>

    <div class="form-group">
    <label name="department_name" id="department_name"><font color="teal"><b> Department: <?php echo $this->session->userdata('department_name'); ?> </b></font></label>
    </div>

    <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('department_id'); ?>">

    <input type="hidden" name="created_by" id="created_by" value="<?php echo $this->session->userdata('user_id'); ?>">  
 
    </div>
    </div>
    </div>
  
<div> 
<div class="row">
 <div class="form-group">
    <label><font color="green"><h2>Travel Form</h2></font></label>
    </div>
</div>

<div class="row">    
<div class="col-md-3">
            <div data-date-format="mm/yyyy" >
              <label class="control-label"><b>From </b><font color="red"> * </font></label>
                <input  type="text" name="datefrom" placeholder="yyyy-mm-dd" class="form-control" id="datefrom" maxlength="10" required onkeypress="return isNumber()"/>                
            </div>
  </div> 


     <div class="col-md-3">
            <div data-date-format="mm/yyyy" >
              <label class="control-label"><b>To </b><font color="red"> * </font></label>
                <input  type="text" name="dateTo" placeholder="yyyy-mm-dd" class="form-control" id="dateTo" maxlength="10" required onkeypress="return isNumber()"/>                
            </div>
  </div> 

<div class='col-md-3'> 
    <div class="form-group">
      <label class="control-label"><b>Estimated time of departure</b><font color="red"> * </font></label>   
        <div class='input-group date' >
            <input type='time' class="form-control timepicker timepicker-default" id='etd'/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>
    </div>
</div>

<div class="col-md-3">        
            <div class="form-group">
             <label class="control-label"><b>Estimated time of arrival</b><font color="red"> * </font></label>   
               <div class='input-group date' >
            <input type='time' class="form-control" id='eta'/>
            <span class="input-group-addon">
                <span class="glyphicon glyphicon-time"></span>
            </span>
        </div>
        </div>
</div>
   

</div>





    <table id="transportation_table" class="table table-hover">                    
       <thead>
            <tr>
                <th>Item</th>    
                <th>Transportation</th> 
                <!-- <th>Approved amount</th>  -->
            </tr>
        </thead>
    <tbody>
        <tr>
    <td>
    <div class="col-md-12">        
    <select class="form-control select2 select2-hidden-accessible" id="destination" name ="destination" >
    <option value="0" class ="disabled selected">Select</option>

    <?php foreach($all_destination as $all_destination){ ?>
    <option value="<?php echo $all_destination['destination_type'];?>"><?php echo 
    $all_destination['destination'];?></option><?php } ?>
    </select> 
    </div> 
    </td> 

    <td>
    <div class="col-md-6">  
    <select class="form-control select2 select2-hidden-accessible" id="through" name="through" required>
    <option selected disabled></option>
    </select>

    </td>  

    <!-- <td>
    <select class="form-control select2 select2-hidden-accessible" id="approved_amount" name="approved_amount" required>
    <option selected disabled></option>
    </select>
    </td>   -->
        </tr>
    </tbody>
                    </table>  
                </div>           


<div class="row">

<div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><b>Purpose</b><font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="purpose" name="purpose"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>
</div>

</div>



<button type="button" id="submit_to" name="submit_to" value="1" class="btn btn-primary ">Request</button>
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







                                                  
                                                                   
                                           
