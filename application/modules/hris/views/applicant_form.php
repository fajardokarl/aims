<head>
</head>

<div class="row">
     
<div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Applicant Information</span>
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
           <input tabindex="2" type="text" id="lastname" name="lastname"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>


    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">First name<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="firstname" name="firstname"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Middle name<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="middlename" name="middlename"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>

    <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Prefix<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="prefix" name="prefix"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>
        <div class="col-md-1">

        <div class="form-group">
            <label class="control-label">Suffix<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="suffix" name="suffix"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-1">
        <div class="form-group">
            <label class="control-label">Sex<font color="red"> * </font></label>
           <input tabindex="2" type="text" id="sex" name="sex"  placeholder="" maxlength="160" class="form-control" > 
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
          <input tabindex="2" type="text" id="birthplace" name="birthplace"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>

    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Nationality<font color="red"> * </font></label>            
          <input tabindex="2" type="text" id="nationality" name="nationality"  placeholder="" maxlength="160" class="form-control" > 
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
</div>

<div class="row">
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">Religion<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="religion" name="religion"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Height (ft)<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="height" name="height"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Weight (kg)<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="weight" name="weight"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label">ACR No<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="acr" name="acr"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-3">

        <div class="form-group">
            <label class="control-label">TIN<font color="red"> * </font></label>            
           <input tabindex="2" type="text" id="tin" name="tin"  placeholder="" maxlength="160" class="form-control" > 
        </div>
    </div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">PHIC No<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="philhealth" name="philhealth"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">SSS No<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="sss" name="sss"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">HDMF No<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="hdmf" name="hdmf"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Where did you know about our company?<font color="red"> * </font></label>            
      <select class="form-control select2 select2-hidden-accessible" id="source_id" name ="source_id" >
    <option class ="disabled selected">Select</option>    
    <option value="1">Walk in</option>
    <option value="2">Social Media</option>
    <option value="3">Referral</option>
    </select>
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
    <input tabindex="2" type="text" id="app_language" name="app_language"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td>
    <a type="button" id="add_app_language" class ="btn btn-info">Add</a>
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
    <select class="form-control select2 select2-hidden-accessible" id="app_addtype" name ="app_addtype" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addtype as $addtype){ ?>
    <option value="<?php echo $addtype['address_type_id'];?>"><?php echo 
    $addtype['address_type_name'];?></option><?php } ?>
    </select>
</td>  
<td> 
    <input tabindex="2" type="text" id="app_line_1" name="app_line_1"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="app_line_2" name="app_line_2"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>        
    <select class="form-control select2 select2-hidden-accessible" id="app_allcity" name ="app_allcity" >
    <option class ="disabled selected">Select</option>

    <?php foreach($allcity as $allcity){ ?>
    <option value="<?php echo $allcity['address_city_id'];?>"><?php echo 
    $allcity['city_name'];?></option><?php } ?>
    </select>
</td>

<td>    
    <select class="form-control select2 select2-hidden-accessible" id="app_allprovince" name ="app_allprovince" >
    <option class ="disabled selected">Select</option>

    <?php foreach($allprovince as $allprovince){ ?>
    <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo 
    $allprovince['province_name'];?></option><?php } ?>
    </select>
</td>  
<td>    
    <select class="form-control select2 select2-hidden-accessible" id="app_addcountry" name ="app_addcountry" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addcountry as $addcountry){ ?>
    <option value="<?php echo $addcountry['id'];?>"><?php echo 
    $addcountry['country_name'];?></option><?php } ?>
    </select>
</td>
<td>
    <input tabindex="2" type="text" id="app_postal" name="app_postal"  placeholder="" maxlength="160" class="form-control" > 
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
    <label name="app_department_name" id="app_department_name"><font color="green"><h2>Assignment</h2></font></label>
    </div>
<div class="col-md-3">
  <label class="control-label">Department<font color="red"> * </font></label>       
    <select class="form-control select2 select2-hidden-accessible" id="app_department_id" name ="app_department_id">
        <option  class ="disabled selected">Select</option>
            <?php foreach($all_department as $all_department){ ?>
        <option value="<?php echo $all_department['department_id'];?>"><?php echo 
            $all_department['department_name'];?></option><?php } ?>
    </select>
</div>

<div class="col-md-3">
    <div class="form-group">
        <label class="control-label">Position<font color="red"> * </font></label>            
       <input tabindex="2" type="text" id="app_job_position" name="app_job_position"  placeholder="" maxlength="160" class="form-control" > 
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
    <select class="form-control select2 select2-hidden-accessible" id="app_level" name ="app_level" >
    <option class ="disabled selected">Select</option>

    <?php foreach($addschool as $addschool){ ?>
    <option value="<?php echo $addschool['school_id'];?>"><?php echo 
    $addschool['school_description'];?></option><?php } ?>
    </select>
</td>  
<td> 
    <input tabindex="2" type="text" id="app_schoolName" name="app_schoolName"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input  type="text" name="app_fromdate" placeholder="yyyy-mm-dd" class="form-control" id="app_fromdate" maxlength="10" required onkeypress="return isNumber()"/>     
</td>

<td>          
     <input  type="text" name="app_todate" placeholder="yyyy-mm-dd" class="form-control" id="app_todate" maxlength="10" required onkeypress="return isNumber()"/>    
</td>


<td>          
    <input tabindex="2" type="text" id="app_yearGraduate" name="app_yearGraduate"  placeholder="" maxlength="160" class="form-control" > 
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
    <input tabindex="2" type="text" id="app_examtype" name="app_examtype"  placeholder="" maxlength="160" class="form-control" > 
</td> 
<td> 
    <input tabindex="2" type="text" id="app_examName" name="app_examName"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="app_examRating" name="app_examRating"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input  type="text" name="app_examTaken" placeholder="yyyy-mm-dd" class="form-control" id="app_examTaken" maxlength="10" required onkeypress="return isNumber()"/>     
</td>
<td>          
    <input  type="text" name="app_dateExpiration" placeholder="yyyy-mm-dd" class="form-control" id="app_dateExpiration" maxlength="10" required onkeypress="return isNumber()"/>     
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
    <input tabindex="2" type="text" id="app_previous_position" name="app_previous_position"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td> 
    <input tabindex="2" type="text" id="app_employer" name="app_employer"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td>          
    <input  type="text" name="app_exclusive_from" placeholder="yyyy-mm-dd" class="form-control" id="app_exclusive_from" maxlength="10" required onkeypress="return isNumber()"/>     
</td>
<td>          
    <input  type="text" name="app_exclusive_to" placeholder="yyyy-mm-dd" class="form-control" id="app_exclusive_to" maxlength="10" required onkeypress="return isNumber()"/>     
</td>

</td>
<td>          
    <input tabindex="2" type="text" id="app_compensation" name="app_compensation"  placeholder="" maxlength="160" class="form-control" > 
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
    <label><font color="green"><h2>Character Referenes</h2></font><font color="red"><i>Not related to you</i></font></label>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
<table id="referral_table" class="table table-hover">                    
                       <thead>
                            <tr>    
                                <th>Name</th>               
                                <th>Position</th>
                                <th>Company</th>        
                                <th>Contact number</th>        
                                <th>Relationship</th>        
                                <th>Action</th>                             
                            </tr>
                        </thead>

<tbody>
<tr>
<td> 
    <input tabindex="2" type="text" id="app_ref_name" name="app_ref_name"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td> 
    <input tabindex="2" type="text" id="app_ref_position" name="app_ref_position"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td> 
    <input tabindex="2" type="text" id="app_ref_company" name="app_ref_company"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td> 
    <input tabindex="2" type="text" id="app_ref_contact" name="app_ref_contact"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="app_ref_relationship" name="app_ref_relationship"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>
    <a type="button" id="add_referral" class ="btn btn-info">Add</a>
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
    <select class="form-control select2 select2-hidden-accessible" id="app_fam_desc" name ="app_fam_desc" >
    <option class ="disabled selected">Select</option>

    <?php foreach($family_type as $family_type){ ?>
    <option value="<?php echo $family_type['family_id'];?>"><?php echo 
    $family_type['family_description'];?></option><?php } ?>
    </select>
</td>  
<td> 
    <input tabindex="2" type="text" id="app_fam_name" name="app_fam_name"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="app_fam_age" name="app_fam_age"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>          
    <input tabindex="2" type="text" id="app_fam_address" name="app_fam_address"  placeholder="" maxlength="160" class="form-control" > 
</td>
<td>          
    <input tabindex="2" type="text" id="app_fam_contact" name="app_fam_contact"  placeholder="" maxlength="160" class="form-control" > 
</td>

<td>
    <a type="button" id="add_family" class ="btn btn-info">Add</a>
</td>   

</tr>
</tbody>
</table>  
</div>
</div>

<div class="row">
   <div class="form-group">
    <label><font color="green"><h2>Please answer the following questions</h2></font></label>
    </div> 
</div>

<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Do you have physical or mental impairment?</h4></label>
        </div>
    </div>

<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="impairment" name ="impairment" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="impairment_yes" name="impairment_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>


<div class="row">

    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Have you ever been to the doctor lately?</h4></label>
        </div>
    </div>
<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="doctor" name ="doctor" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="doctor_yes" name="doctor_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>



<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Have you ever met an accident lately?</h4></label>
        </div>
    </div>
<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="accident" name ="accident" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="accident_yes" name="accident_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Have you undergone any surgery in the past?</h4></label>
        </div>
    </div>
<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="surgery" name ="surgery" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="surgery_yes" name="surgery_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Have you ever been convicted, arrested or imprisoned for any violation of law?</h4></label>
        </div>
    </div>
<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="law" name ="law" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="law_yes" name="law_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Have you ever discharge or forced to resign from work?</h4></label>
        </div>
    </div>
<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="discharge" name ="discharge" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="discharge_yes" name="discharge_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Have you any relative in any of the affiliates of brown Group of Companies?</h4></label>
        </div>
    </div>
<div class="col-md-1">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="affiliates" name ="affiliates" >
    <option class ="disabled selected">Select</option>    
    <option value="Yes">Yes</option>
    <option value="No">No</option>    
    </select>
    </div>
</div>

<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="affiliates_yes" name="affiliates_yes"  placeholder="If yes" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>When was the last time you were hospitalized?</h4></label>
        </div>
    </div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="hospitalized" name="hospitalized"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Why do you want to work with A Brown Company?</h4></label>
        </div>
    </div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="work_with" name="work_with"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Give some of your short term & long term goals</h4></label>
        </div>
    </div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="goals" name="goals"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>What are your strong points as a person?</h4></label>
        </div>
    </div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="strong_points" name="strong_points"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>What are your weak points as an individual?</h4></label>
        </div>
    </div>
<div class="col-md-3">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="weak_points" name="weak_points"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>
<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>How soon can you start if your services are required in this company?</h4></label>
        </div>
    </div>
<div class="col-md-2">
    <div class="form-group">
     <select class="form-control select2 select2-hidden-accessible" id="start" name ="start" >
    <option class ="disabled selected">Select</option>    
    <option value="Immediately">Immediately</option>
    <option value="30Days">30 days</option> 
    <option value="45Days">45 days</option>
    <option value="NextWeek">Next week</option>       
    </select>
    </div>
</div>

</div>

<div class="row">
    <div class="col-md-3">
        <div class="form-group">
            <label class="control-label"><h4>Approximate Salary you have in mind</h4></label>
        </div>
    </div>
<div class="col-md-2">
    <div class="form-group">
              
       <input tabindex="2" type="text" id="salary" name="salary"  placeholder="" maxlength="160" class="form-control" > 
    </div>
</div>
</div>
<div class="form-group">
<div class="row">
<div class="form-group">
</div>
</div>
<button type="button" id="saveApplicant" name="saveApplicant" class="btn btn-primary ">Save</button>
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







                                                  
                                                                   
                                           
