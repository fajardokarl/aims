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
  
    
<div class="row">
 <div class="form-group">
    <label><font color="green"><h2>Personal Information</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Last name<font color="red"> * </font></label>
           <input tabindex="2" type="text" id="lastname" name="lastname"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>


    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">First name<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="lastname" name="lastname"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Middle name<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="middlename" name="middlename"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>

    <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Prefix<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="prefix" name="prefix"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>
        <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Suffix<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="suffix" name="suffix"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
        <div class="form-group">
            <label class="control-label">Sex<font color="red"> * </font></label>
           <input tabindex="2" type="text" id="sex" name="sex"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>


  <div class="col-md-2">
            <div data-date-format="mm/yyyy" >
              <label class="control-label">Birthdate <font color="red"> * </font></label>
                <input  type="text" name="birthdate" placeholder="yyyy-mm-dd" class="form-control" id="birthdate" maxlength="10" required onkeypress="return isNumber()"/>                
            </div>
  </div> 
   
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Nationality<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="nationality" name="nationality"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">
    <div class="form-group">
    <label class="control-label">Civil Status<font color="red"> * </font></label>            
    <select class="form-control select2 select2-hidden-accessible" id="civil_status" name ="civil_status" >
    <option class ="disabled selected">Select</option>
    <?php foreach($all_status as $all_status){ ?>
    <option value="<?php echo $all_status['civil_status_id'];?>"><?php echo 
    $all_status['civil_status_name'];?></option><?php } ?>
    </select>
        </div>
    
    </div>      
    <div class="col-md-2">

        <div class="form-group">
            <label class="control-label">TIN<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="tin" name="tin"  placeholder="" maxlength="30" class="form-control" > 
        </div>
    </div>
</div>

<div class="row">
 <div class="form-group">
    <label><font color="green"><h2>Address Information</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="address_contacts_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Address Type</th>               
                                <th>Street</th>
                                <th>Barangay</th>        
                                <th>City</th>
                                <th>Province</th>
                                <th>Postal</th>  
                                <th>Country</th>                                                      
                                <th>Action</th>
                            </tr>
                        </thead>

<tbody>
<tr>
<td>
    <select class="form-control select2 select2-hidden-accessible" id="addtype" name ="addtype" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addtype as $addtype){ ?>
    <option value="<?php echo $addtype['address_type_id'];?>"><?php echo 
    $addtype['address_type_name'];?></option><?php } ?>
    </select>
</td>  
<td> 
    <input tabindex="2" type="text" id="line_1" name="line_1"  placeholder="" maxlength="30" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="line_2" name="line_2"  placeholder="" maxlength="30" class="form-control" > 
</td>

<td>        
    <select class="form-control select2 select2-hidden-accessible" id="allcity" name ="allcity" >
    <option class ="disabled selected">Select</option>

    <?php foreach($allcity as $allcity){ ?>
    <option value="<?php echo $allcity['address_city_id'];?>"><?php echo 
    $allcity['city_name'];?></option><?php } ?>
    </select>
</td>

<td>    
    <select class="form-control select2 select2-hidden-accessible" id="allprovince" name ="allprovince" >
    <option class ="disabled selected">Select</option>

    <?php foreach($allprovince as $allprovince){ ?>
    <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo 
    $allprovince['province_name'];?></option><?php } ?>
    </select>
</td>  

<td>
    <input tabindex="2" type="text" id="postal" name="postal"  placeholder="" maxlength="30" class="form-control" > 
</td>

<td>    
    <select class="form-control select2 select2-hidden-accessible" id="addcountry" name ="addcountry" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addcountry as $addcountry){ ?>
    <option value="<?php echo $addcountry['id'];?>"><?php echo 
    $addcountry['country_name'];?></option><?php } ?>
    </select>
</td>
<td>
    <a href="#" id="add_address" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
 </table>  
 </div>
</div>
    
<div class="row">
    <div class="portlet-body">
 <div class="form-group">
    <label name="department_name" id="department_name"><font color="green"><h2>Contact Information</h2></font></label>
    </div>


   <div class="col-md-12">  
                    <table id="emp_contacts_table" class="table table-hover">                    
                       <thead>
                            <tr>
                                <th>Contact Type</th>                      
                                <th>Contact</th>                               
                                <th>Action</th>                               
                            </tr>
                        </thead>
    <tbody>
        <tr>
            <td>    
                <select class="form-control select2 select2-hidden-accessible col-md-6" id="contact_type" name ="contact_type" >
                    <option class ="disabled selected">Select</option>
                    <?php foreach($contact_type as $contact_type){ ?>
                    <option value="<?php echo $contact_type['contact_type_id'];?>"><?php echo 
                    $contact_type['contact_type_name'];?></option><?php } ?>
                </select>        
            </td>
    <td>
        <div class="col-md-6">
            <input type="isNumber" name="contact" id="contact" class="form-control">
        </div>
    </td>
    <td>   
        <a href="#" id="add_contact" class ="btn btn-info">Add</a>
    </td>    
        </tr>
  
        </tbody>
                    </table>  
                </div>
            </div><!-- end row -->
    </div>

<div class="row">
 <div class="form-group">
    <label name="department_name" id="department_name"><font color="green"><h2>Deployment</h2></font></label>
    </div>
</div>

    <div class="col-md-3">
    <div class="form-group">
    <label class="control-label">Department<font color="red"> * </font></label>            
    <select class="form-control select2 select2-hidden-accessible" id="department" name ="department" >
    <option class ="disabled selected">Select</option>
    <?php foreach($all_department as $all_department){ ?>
    <option value="<?php echo $all_department['department_id'];?>"><?php echo 
    $all_department['department_name'];?></option><?php } ?>
    </select>
        </div>    
    </div>      
  
</div>
<button type="button" id="saveEmployee" name="saveEmployee" value="1" class="btn btn-primary ">Create</button>
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







                                                  
                                                                   
                                           
