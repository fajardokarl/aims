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
<form method="post" id="employee_form" name="employee_form">    

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

<!--     <div class="form-group">
    <label name="department_name" id="department_name"><font color="teal"><b> Department: <?php echo $this->session->userdata('department_name'); ?> </b></font></label>
    </div>

    <input type="hidden" name="department" id="department" value="<?php echo $this->session->userdata('department_id'); ?>"> -->

    <input type="hidden" name="created_by" id="created_by" value="<?php echo $this->session->userdata('user_id'); ?>">  
 
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
           <input tabindex="2" type="text" id="lastname" name="lastname"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>


    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">First name<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="firstname" name="firstname"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Middle name<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="middlename" name="middlename"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

    <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Prefix<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="prefix" name="prefix"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>
        <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Suffix<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="suffix" name="suffix"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
        <div class="form-group">
            <label class="control-label">Sex<font color="red"> * </font></label>
           <input tabindex="2" type="text" id="sex" name="sex"  placeholder="" maxlength="200" class="form-control" > 
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
            <label class="control-label">Place of birth<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="birthplace" name="birthplace"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Nationality<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="nationality" name="nationality"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>
        <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Height<i> feet</i><font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="height" name="height"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>
        <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Weight<i> kg</i><font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="weight" name="weight"  placeholder="" maxlength="200" class="form-control" > 
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
            <div data-date-format="mm/yyyy" >
              <label class="control-label">Date hired <font color="red"> * </font></label>
                <input  type="text" name="date_hired" placeholder="yyyy-mm-dd" class="form-control" id="date_hired" maxlength="10" required onkeypress="return isNumber()"/>                
            </div>
  </div> 
      <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Initial<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="initial" name="initial"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">TIN<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="tin" name="tin"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">PHIC No<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="philhealth" name="philhealth"  placeholder="" maxlength="200" class="form-control" > 
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">SSS No<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="sss" name="sss"  placeholder="" maxlength="200" class="form-control" > 
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">HDMF No<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="hdmf" name="hdmf"  placeholder="" maxlength="200" class="form-control" > 
    </div>
</div>
</div>

<div class="row">

<!-- <label class="control-label">Language spoken<font color="red"> * </font></label>               
<div class="clearfix">
    <div class="btn-group" data-toggle="buttons">
      
        <label>
            <input type="checkbox" class="toggle"> English </label>
      
        
        <label>
            <input type="checkbox" class="toggle"> Tagalog </label>
      
        <label>
            <input type="checkbox" class="toggle"> Local dialect </label>
       
    </div>
</div> -->



 <div class="form-group">
    <label><font color="green"><h2>Employee language spoken</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
<table id="language_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Language</th>               
                                <th>Action</th>
                            </tr>
                        </thead>

<tbody>
<tr>
 <td> 
    <input tabindex="2" type="text" id="language" name="language"  placeholder="" maxlength="200" class="form-control" > 
</td>
<td>
    <a type="button" id="add_language" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
 </table>  
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
                                <th>Country</th>
                                <th>Postal</th>                                                            
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
    <input tabindex="2" type="text" id="line_1" name="line_1"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="line_2" name="line_2"  placeholder="" maxlength="200" class="form-control" > 
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
    <select class="form-control select2 select2-hidden-accessible" id="addcountry" name ="addcountry" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addcountry as $addcountry){ ?>
    <option value="<?php echo $addcountry['id'];?>"><?php echo 
    $addcountry['country_name'];?></option><?php } ?>
    </select>
</td>
<td>
    <input tabindex="2" type="text" id="postal" name="postal"  placeholder="" maxlength="200" class="form-control" > 
</td>


<td>
    <a type="button" id="add_address" class ="btn btn-info">Add</a>
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
                <select class="form-control select2 select2-hidden-accessible col-md-6" id="contact_type_id" name ="contact_type_id" >
                    <option class ="disabled selected">Select</option>
                    <?php foreach($contact_type as $contact_type){ ?>
                    <option value="<?php echo $contact_type['contact_type_id'];?>"><?php echo 
                    $contact_type['contact_type_name'];?></option><?php } ?>
                </select>        
            </td>
    <td>
        <div class="col-md-6">
            <input type="isNumber" name="contact_value" id="contact_value" class="form-control">
        </div>
    </td>
    <td>   
        <a type="button" id="add_contact" class ="btn btn-info">Add</a>
    </td>    
        </tr>
  
        </tbody>
                    </table>  
                </div>
            </div><!-- end row -->
    </div>

<div class="row">
    <div class="portlet-body">
 <div class="form-group">
    <label name="department_name" id="department_name"><font color="green"><h2>Assignment</h2></font></label>
    </div>
<div class="col-md-3">
  <label class="control-label">Department<font color="red"> * </font></label>       
    <select class="form-control select2 select2-hidden-accessible" id="department_id" name ="department_id">
        <option  class ="disabled selected">Select</option>
            <?php foreach($all_department as $all_department){ ?>
        <option value="<?php echo $all_department['department_id'];?>"><?php echo 
            $all_department['department_name'];?></option><?php } ?>
    </select>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Position<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="job_position" name="job_position"  placeholder="" maxlength="200" class="form-control" > 
    </div>
</div>
            </div><!-- end row -->
    </div>



<div class="row">
 <div class="form-group">
    <label><font color="green"><h2>School last attended</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="last_school_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Level</th>               
                                <th>Name of School </th>
                                <th>From</th>        
                                <th>To</th>
                                <th>Year graduated</th>           
                                <th>Action</th>
                            </tr>
                        </thead>

<tbody>
<tr>
<td>
    <select class="form-control select2 select2-hidden-accessible" id="level" name ="level" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addschool as $addschool){ ?>
    <option value="<?php echo $addschool['school_id'];?>"><?php echo 
    $addschool['school_description'];?></option><?php } ?>
    </select>
</td>  
<td> 
    <input tabindex="2" type="text" id="schoolName" name="schoolName"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>          
    <input  type="text" name="fromdate" placeholder="yyyy-mm-dd" class="form-control" id="fromdate" maxlength="10" required onkeypress="return isNumber()"/>     
</td>

<td>          
     <input  type="text" name="todate" placeholder="yyyy-mm-dd" class="form-control" id="todate" maxlength="10" required onkeypress="return isNumber()"/>    
</td>


<td>          
    <input tabindex="2" type="text" id="yearGraduate" name="yearGraduate"  placeholder="" maxlength="200" class="form-control" > 
</td>
  
<td>
    <a type="button" id="add_school" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
 </table>  
 </div>
</div>

<div class="row">
 <div class="form-group">
    <label><font color="green"><h2>Examinations taken</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="examination_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Examination type</th>               
                                <th>Name of examination </th>
                                <th>Rating</th>        
                                <th>Date taken</th> 
                                <th>Date Expiration</th>              
                                <th>Action</th>
                            </tr>
                        </thead>

<tbody>
<tr>
<td> 
    <input tabindex="2" type="text" id="examtype" name="examtype"  placeholder="" maxlength="200" class="form-control" > 
</td> 
<td> 
    <input tabindex="2" type="text" id="examName" name="examName"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="examRating" name="examRating"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>          
    <input  type="text" name="examTaken" placeholder="yyyy-mm-dd" class="form-control" id="examTaken" maxlength="10" required onkeypress="return isNumber()"/>     
</td>
<td>          
    <input  type="text" name="dateExpiration" placeholder="yyyy-mm-dd" class="form-control" id="dateExpiration" maxlength="10" required onkeypress="return isNumber()"/>     
</td>
<td>
    <a type="button"  id="add_exam" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
 </table>  
 </div>
</div>


<div class="row">
<div class="form-group">
    <label><font color="green"><h2>Work Experience</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="work_experience_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Position</th>               
                                <th>Employer</th>
                                <th>Exclusive dates from</th>        
                                <th>Exclusive dates to</th>        
                                <th>Compensation</th> 
                                <th>Action</th>                             

                            </tr>
                        </thead>

<tbody>
<tr>
<td> 
    <input tabindex="2" type="text" id="previous_position" name="previous_position"  placeholder="" maxlength="200" class="form-control" > 
</td>
<td> 
    <input tabindex="2" type="text" id="employer" name="employer"  placeholder="" maxlength="200" class="form-control" > 
</td>
<td>          
    <input  type="text" name="exclusive_from" placeholder="yyyy-mm-dd" class="form-control" id="exclusive_from" maxlength="10" required onkeypress="return isNumber()"/>     
</td>
<td>          
    <input  type="text" name="exclusive_to" placeholder="yyyy-mm-dd" class="form-control" id="exclusive_to" maxlength="10" required onkeypress="return isNumber()"/>     
</td>

</td>
<td>          
    <input tabindex="2" type="text" id="compensation" name="compensation"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>
    <a type="button" id="add_work" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
</table>  
</div>
</div>


<div class="row">
<div class="form-group">
    <label><font color="green"><h2>Family Background</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="family_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Family description</th>               
                                <th>Name</th>
                                <th>Age</th>        
                                <th>Address</th>                             
                                <th>Contact no.</th>
                                <th>Action</th> 
                            </tr>
                        </thead>

<tbody>
<tr>
<td>
    <select class="form-control select2 select2-hidden-accessible" id="fam_desc" name ="fam_desc" >
    <option class ="disabled selected">Select</option>

    <?php foreach($family_type as $family_type){ ?>
    <option value="<?php echo $family_type['family_id'];?>"><?php echo 
    $family_type['family_description'];?></option><?php } ?>
    </select>
</td>  
<td> 
    <input tabindex="2" type="text" id="fam_name" name="fam_name"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="fam_age" name="fam_age"  placeholder="leave empty if deceased " maxlength="200" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="fam_address" name="fam_address"  placeholder="leave empty if deceased"  maxlength="200" class="form-control" > 
</td>
<td>          
    <input tabindex="2" type="text" id="fam_contact" name="fam_contact" placeholder="" maxlength="200" class="form-control" > 
</td>

<td>
    <a type="button" id="add_family" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
</table>  
</div>
</div>

<!-- <formm method="post">
<div class="row">
<div class="form-group">
    <label><font color="green"><h2>Evaluation</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="evaluation_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Position</th>               
                                <th>Evaluated by</th>
                                <th>From</th>        
                                <th>to</th>        
                                <th>Results</th>                             
                                <th>Remarks</th>                             
                                <th>Action</th>                             
                            </tr>
                        </thead>

<tbody>
<tr>
<td> 
    <input tabindex="2" type="text" id="current_position" name="current_position"  placeholder="" maxlength="200" class="form-control" > 
</td>
<td> 

<select class="form-control select2 select2-hidden-accessible" id="evaluated_by" name ="evaluated_by">
<option class ="disabled selected">Select</option>
<?php foreach($all_employees as $all_employees){ ?>
<option value="<?php echo $all_employees['person_id'];?>"><?php echo 
$all_employees['firstname']. ' ' . $all_employees['lastname'];?></option><?php } ?>
</select>

</td>

<td>
    <input  type="text" name="eval_from" placeholder="yyyy-mm-dd" class="form-control" id="eval_from" maxlength="10" required onkeypress="return isNumber()"/>   
</td>
<td>   
    <input  type="text" name="eval_to" placeholder="yyyy-mm-dd" class="form-control" id="eval_to" maxlength="10" required onkeypress="return isNumber()"/>           
</td>

<td>          
    <input tabindex="2" type="text" id="eval_result" name="eval_result"  placeholder="" maxlength="200" class="form-control" > 
</td>
<td>          
    <input tabindex="2" type="text" id="eval_remark" name="eval_remark"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>
    <a type="button" id="add_evaluation" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
</table>  
</div>
</div>
</form>
<div class="row">
<div class="form-group">
    <label><font color="green"><h2>Movement</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="movement_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>From</th>               
                                <th>To</th>
                                <th>Effective date</th>        
                                <th>Approval Date</th>                             
                                <th>Remarks</th>                             
                                <th>Action</th>                             
                            </tr>
                        </thead>

<tbody>
<tr>
<td>
    <input  type="text" name="movement_from" placeholder="yyyy-mm-dd" class="form-control" id="movement_from" maxlength="10" required onkeypress="return isNumber()"/>   

</td>
<td>
    <input  type="text" name="movement_to" placeholder="yyyy-mm-dd" class="form-control" id="movement_to" maxlength="10" required onkeypress="return isNumber()"/>   
</td>

<td>
    <input  type="text" name="effective_date" placeholder="yyyy-mm-dd" class="form-control" id="effective_date" maxlength="10" required onkeypress="return isNumber()"/>   
</td>

<td>          
   <input  type="text" name="approval_date" placeholder="yyyy-mm-dd" class="form-control" id="approval_date" maxlength="10" required onkeypress="return isNumber()"/>   
</td>

<td>          
    <input tabindex="2" type="text" id="movement_remarks" name="movement_remarks"  placeholder="" maxlength="200" class="form-control" > 
</td>

<td>
    <a id="add_movement" type="button" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
</table>  
</div>
</div> -->

<div class="row">
 <div class="form-group">
    <label><font color="green"><h2>Account information</h2></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">Username<font color="red"> * </font></label>
           <input tabindex="2" type="text" id="username" name="username"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>


    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Password<font color="red"> * </font></label>            
           <input tabindex="2" type="password" id="password" name="password"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Email address<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="email" name="email"  placeholder="" maxlength="200" class="form-control" > 
        </div>
    </div>

<div class="col-md-3">

<div class="actions">  
<label class="control-label">Select Permission</label> 
    <select class="form-control select2 select2-hidden-accessible" id="all_permission" name ="all_permission">
    <option  class ="disabled selected">Select</option>

    <?php foreach($all_permission as $all_permission){ ?>
    <option value="<?php echo $all_permission['permission_id'];?>"<?php echo $all_permission['permission_description'];?>
        ><?php echo $all_permission['permission_description'];?></option><?php } ?>
    </select>
</div>
</div>
</div>
<div class="form-group">
<div class="row">
<div class="form-group">
</div>
</div>
<button type="button" onclick="clearFields()" id="saveEmployee" name="saveEmployee" value="1" class="btn btn-primary ">Create</button>
<button type="button" id="cancel" name="cancel" class="btn btn-danger ">Cancel</button>
</div>

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







                                                  
                                                                   
                                           
