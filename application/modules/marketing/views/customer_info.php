<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="customermasterlist">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Customer Masterlist</span>
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#add_newcustomer_modal" id="add_new_customer"><i class="fa fa-plus"> </i>New Customer</button>
                    <!-- <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#add_neworg_modal" id="add_new_org"><i class="fa fa-plus"> </i>New Organization</button> -->
                    <!-- <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddCustomer2" id="addnewcust2"><i class="fa fa-plus"> </i>New Customer TEST</button> -->
                    <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                </div>
            </div>                  
            <table class="tblcustomerlists table table-hover" id="tblcustomerlists" >
                <thead>
                    <tr>
                        <th>Client ID</th>
                        <th>Client Name</th>
                        <th>Client Type</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($customer as $customer){ ?>
                    <tr>
                        <td><?php echo $customer['client_id'];?></td>
                        <?php if ( $customer['client_type_id'] == 1 ) { ?>
                            <td><?php echo $customer['lastname'] . ', ' . $customer['firstname'] . ' ' . $customer['middlename'] . ' ' . $customer['suffix'];?></td>
                        <?php }else{ ?>
                            <td><?php echo $customer['organization_name'];?></td>

                        <?php } ?>
                        <td><?php echo $customer['client_type_name'];?></td>
                        
                    </tr>
                    <?php } ?> 
                </tbody>
            </table>        
        </div>
    </div>
</div>


<!-- new person customer modal : START -->
<div  style="font-size: 15px;">
    
    <div style="" class="modal fade bs-modal-lg" id="add_newcustomer_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h3 class="font-green-meadow sbold uppercase" id="">Add New Customer</h3>
                </div>
                <div class="modal-body">
                    <form id="personal_info_form" method="post" enctype="multipart/form-data">
                        <div id="name_info">
                            <div id="form_inputs">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group ">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                               <!--  <div id="imageselect">
                                                    <div class="profile-userpic">
                                                        <div class="thumbnail" style="width: 200px; height: 150px;">
                                                            <img src="<?=base_url()?>public/pages/images/profiles/3934.jpg" id="profilepicture" class="img-responsive" alt="">
                                                        </div>
                                                        <button type="button" class="btn green" id="">New Picture</button>
                                                    </div>
                                                </div> -->
                                                <div id="profilechange">
                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                    </div>
                                                    <div>
                                                        <span class="btn green btn-outline btn-file">
                                                            <span class="fileinput-new"> Select image </span>
                                                            <span class="fileinput-exists"> Change </span>
                                                            <input type="file" id="userfile" name="userfile" />
                                                        </span>
                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-9">
                                        <br />
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Last Name<font color="red"> * </font></label>
                                                    <input type="text" id="cust_lname" name="cust_lname" placeholder="" maxlength="50" class="form-control input-sm" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">First Name<font color="red"> * </font></label>
                                                    <input type="text" id="cust_fname" name="cust_fname"  placeholder="" maxlength="30" class="form-control input-sm" required />
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <label class="control-label">Middle Name<font color="red"> * </font></label>
                                                    <input type="text" id="cust_mname" name="cust_mname" placeholder="" maxlength="50" class="form-control input-sm" required />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="present_address">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                    <span class="caption-subject bold uppercase">Present Address</span>
                                                </div> 
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <input type="text" id="present_line_1" name="present_line_1" placeholder="No./Street" maxlength="50" class="form-control input-sm" required />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="present_line_2" name="present_line_2" placeholder="Subdivision" maxlength="50" class="form-control input-sm" required />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="present_line_3" name="present_line_3" placeholder="Barangay/District" maxlength="50" class="form-control input-sm" required />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" placeholder="Municipality/City" id="present_city" name ="present_city" required>
                                                                <option value="0" class ="" selected disabled>Municipality/City</option>
                                                                <?php foreach($allcity as $allcity2){ ?>
                                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="present_province" name ="present_province" required>
                                                                <option value="0" class ="" selected disabled>Province</option>
                                                                <?php foreach($allprovince as $allprovince2){ ?>
                                                                <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="present_country" name ="present_country" required>
                                                                <option value="0" class ="" selected disabled>Country</option>
                                                                <?php foreach($addcountry as $addcountry2){ ?>
                                                                <option value="<?php echo $addcountry2['id'];?>"><span><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'] . '.png';?>" alt="Mountain View" style="" /> </span><?php echo $addcountry2['country_name'];?></option>
                                                                <?php } ?> 
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="present_postalcode" name="present_postalcode" placeholder="Postal Code" maxlength="5" class="form-control input-sm" required />
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="present_lengthofstay" name="present_lengthofstay" placeholder="Length of Stay" maxlength="50" class="form-control input-sm" />
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="address_check">
                                    <div class="col-md-9">
                                        <div class="form-group">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="same_address" name="same_address"> <strong>Present Address</strong> is my <strong> Permanent Address</strong>
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row"  id="permanent_address">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                    <span class="caption-subject bold uppercase">Permanent Address</span>
                                                </div> 


                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <input type="text" id="permanent_line_1" name="permanent_line_1" placeholder="No./Street" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="permanent_line_2" name="permanent_line_2" placeholder="Subdivision" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="permanent_line_3" name="permanent_line_3" placeholder="Barangay/District" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" placeholder="Municipality/City" id="permanent_city" name ="permanent_city">
                                                                <option value="0" class ="" disabled selected>Municipality/City</option>
                                                                <?php foreach($allcity as $allcity2){ ?>
                                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="permanent_province" name ="permanent_province">
                                                                <option value="0" class ="" disabled selected>Province</option>
                                                                <?php foreach($allprovince as $allprovince2){ ?>
                                                                <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="permanent_country" name ="permanent_country">
                                                                <option value="0" class ="" disabled selected>Country</option>
                                                                <?php foreach($addcountry as $addcountry2){ ?>
                                                                <option value="<?php echo $addcountry2['id'];?>"><span><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'] . '.png';?>" alt="Mountain View" style="" /> </span><?php echo $addcountry2['country_name'];?></option>
                                                                <?php } ?> 
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="permanent_postalcode" name="permanent_postalcode" placeholder="Postal Code" maxlength="5" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="permanent_lengthofstay" name="permanent_lengthofstay" placeholder="Length of Stay" maxlength="50" class="form-control input-sm"/>
                                                            
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="personal_info">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                    <span class="caption-subject bold uppercase">Personal Information</span>
                                                </div> 
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">TIN<font color="red"> * </font></label>
                                                        <input type="text" id="cust_tin" name="cust_tin" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Residential Phone<font color="red"> * </font></label>
                                                        <input type="text" id="cust_residential" name="cust_residential" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Business Phone<font color="red"> * </font></label>
                                                        <input type="text" id="cust_bphone" name="cust_bphone" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Mobile Phone<font color="red"> * </font></label>
                                                        <input type="text" id="cust_mphone" name="cust_mphone" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Fax No.<font color="red"> * </font></label>
                                                        <input type="text" id="cust_fax" name="cust_fax" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Email Address<font color="red"> * </font></label>
                                                        <input type="text" id="cust_email" name="cust_email" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Professsion<font color="red"> * </font></label>
                                                        <input type="text" id="cust_profession" name="cust_profession" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-8">
                                                        <label class="control-label">Source of Fund<font color="red"> * </font></label>
                                                        <table style="margin-top: -7px " class="table table-condensed" style="font-size: 8px;">
                                                            <tbody>
                                                                <tr>
                                                                    <td width="25%" style="font-size: 11px;"><input type="checkbox" name="customer_source[]" id="salary" value="1"> Salary/Honoraria</td>
                                                                    <td width="25%" style="font-size: 11px;"><input type="checkbox" name="customer_source[]" id="business" value="3"> Business</td>
                                                                    <td width="25%" style="font-size: 11px;"><input type="checkbox" name="customer_source[]" id="ofw" value="5"> OFW Remittance</td>
                                                                    <!-- <td width="25%" style="font-size: 11px;"><input type="checkbox" id="inlineCheckbox21" value="7"> Other</td> -->
                                                                    <!-- <td><span style="font-size: 11px;">Other</span></td> -->
                                                                    <!-- <td><input type="text" id="other_fund" placeholder="Others: Pls Specify"></td> -->
                                                                </tr>
                                                                <tr>
                                                                    <td width="25%" style="font-size: 11px;"><input type="checkbox" name="customer_source[]" id="interest" value="2"> Interest/Commission</td>
                                                                    <td width="25%" style="font-size: 11px;"><input type="checkbox" name="customer_source[]" id="pension" value="4"> Pension</td>
                                                                    <td width="25%" style="font-size: 11px;"><input type="checkbox" name="customer_source[]" id="remittance" value="6"> Other Remittance</td>
                                                                    <td></td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <!-- <div class="row">
                                                        <button id="test_button" type="button">TEST BUTTON</button>
                                                    </div> -->
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Birthdate<font color="red"> * </font></label>
                                                        <input type="date" id="cust_birthdate" name="cust_birthdate" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                        <span id="is_legal_age"></span>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Birthplace<font color="red"> * </font></label>
                                                        <input type="text" id="cust_birthplace" name="cust_birthplace" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Nationality<font color="red"> * </font></label>
                                                        <input type="text" id="cust_nationality" name="cust_nationality" placeholder="" maxlength="50" class="form-control input-sm" />
                                                        <span id="is_filipino"></span>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Gender<font color="red"> * </font></label>
                                                        <select class="form-control" id="cust_gender" name="cust_gender" required>
                                                            <option class="disabled selected" value="0">Select.. </option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Civil Status<font color="red"> * </font></label>
                                                        <select class="form-control" id="cust_civil" name="cust_civil" required>
                                                            <option class="disabled selected" value="0">Select.. </option>
                                                            <option value="1">Single</option>
                                                            <option value="2">Married</option>
                                                            <option value="3">Divorced</option>
                                                            <option value="4">Separated</option>
                                                            <option value="5">Widowed</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="work_info">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit" >
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                    <span class="caption-subject bold uppercase">Work information</span>
                                                </div> 
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Employer Name<font color="red"> * </font></label>
                                                        <input type="text" id="cust_employer" name="cust_employer" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Job Title(Position)<font color="red"> * </font></label>
                                                        <input type="text" id="cust_job" name="cust_job" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <!-- <div class="form-group col-md-4">
                                                        <label class="control-label">Nationality<font color="red"> * </font></label>
                                                        <input type="text" id="cust_email" name="cust_contacts" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div> -->
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3" style="padding-bottom: 5px;">
                                                           Employer Address<font color="red"> * </font>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <input type="text" id="employer_line_1" name="employer_line_1" placeholder="No./Street" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="employer_line_2" name="employer_line_2" placeholder="Subdivision" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="employer_line_3" name="employer_line_3" placeholder="Barangay/District" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" placeholder="Municipality/City" id="employer_city" name ="employer_city">
                                                                <option value="0" class ="disabled selected">Municipality/City</option>
                                                                <?php foreach($allcity as $allcity2){ ?>
                                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="employer_province" name ="employer_province">
                                                                <option value="1" class ="disabled selected">Province</option>
                                                                <?php foreach($allprovince as $allprovince2){ ?>
                                                                <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="employer_country" name ="employer_country">
                                                                <option value="1" class ="disabled selected">Country</option>
                                                                <?php foreach($addcountry as $addcountry2){ ?>
                                                                <option value="<?php echo $addcountry2['id'];?>"><span><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'] . '.png';?>" alt="Mountain View" style="" /> </span><?php echo $addcountry2['country_name'];?></option>
                                                                <?php } ?> 
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="employer_postalcode" name="employer_postalcode" placeholder="Postal Code" maxlength="5" class="form-control input-sm"/>
                                                        </div>
                                                        <!-- <div class="col-md-3">
                                                            <input type="text" id="employer_lengthofstay" name="employer_lengthofstay" placeholder="Length of Stay" maxlength="50" class="form-control input-sm"/>
                                                            
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Occupation<font color="red"> * </font></label>
                                                        <select class="form-control" id="cust_occupation" name="cust_occupation">
                                                            <option class="disabled selected" value="0">Select.. </option>
                                                            <option value="1">Employed</option>
                                                            <option value="2">Self-Employed</option>
                                                            <option value="3">OFW</option>
                                                            <option value="4">Retired</option>
                                                            <option value="5">Retire</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Monthly Gross Income<font color="red"> * </font></label>
                                                        <input type="text" id="cust_gross" name="cust_gross" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="spouse_check">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="mt-checkbox mt-checkbox-outline">
                                                <input type="checkbox" id="has_spouse" name="has_spouse"> <strong> Do You have Spouse?</strong>
                                                <input type="hidden" id="has_spouse_val" name="has_spouse_val" value="0">
                                                <span></span>
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="spouse" style="display: none;">
                                    <div class="col-md-12">
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                    <span class="caption-subject bold uppercase">Spouse</span>
                                                </div> 
                                            </div>
                                            <div class="portlet-body">
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group ">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                               <!--  <div id="imageselect">
                                                                    <div class="profile-userpic">
                                                                        <div class="thumbnail" style="width: 200px; height: 150px;">
                                                                            <img src="<?=base_url()?>public/pages/images/profiles/3934.jpg" id="profilepicture" class="img-responsive" alt="">
                                                                        </div>
                                                                        <button type="button" class="btn green" id="">New Picture</button>
                                                                    </div>
                                                                </div> -->
                                                                <div id="profilechange">
                                                                    <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
                                                                    </div>
                                                                    <div>
                                                                        <span class="btn green btn-outline btn-file">
                                                                            <span class="fileinput-new"> Select image </span>
                                                                            <span class="fileinput-exists"> Change </span>
                                                                            <input type="file" id="spouse_userfile" name="spouse_userfile" />
                                                                        </span>
                                                                        <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name<font color="red"> * </font></label>
                                                                <input type="text" id="spouse_lname" name="spouse_lname" placeholder="" maxlength="50" class="form-control input-sm" />
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">First Name<font color="red"> * </font></label>
                                                                <input type="text" id="spouse_fname" name="spouse_fname"  placeholder="" maxlength="30" class="form-control input-sm"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Middle Name<font color="red"> * </font></label>
                                                                <input type="text" id="spouse_mname" name="spouse_mname" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                            </div>
                                                        </div>
                                                    </div> 
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Birthdate<font color="red"> * </font></label>
                                                        <input type="date" id="spouse_birthdate" name="spouse_birthdate" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Birthplace<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_birthplace" name="spouse_birthplace" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Nationality<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_nationality" name="spouse_nationality" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">TIN<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_tin" name="spouse_tin" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Residential Phone<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_residential" name="spouse_residential" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Business Phone<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_bphone" name="spouse_bphone" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Mobile Phone<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_mphone" name="spouse_mphone" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Fax No.<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_fax" name="spouse_fax" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Email Address<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_email" name="spouse_email" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Employer Name<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_employer" name="spouse_employer" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Job Title(Position)<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_job" name="spouse_job" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                    <!-- <div class="form-group col-md-4">
                                                        <label class="control-label">Nationality<font color="red"> * </font></label>
                                                        <input type="text" id="cust_email" name="cust_contacts" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div> -->
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3" style="padding-bottom: 5px;">
                                                           Employer Address<font color="red"> * </font>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <input type="text" id="spouse_line_1" name="spouse_line_1" placeholder="No./Street" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="spouse_line_2" name="spouse_line_2" placeholder="Subdivision" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="spouse_line_3" name="spouse_line_3" placeholder="Barangay/District" maxlength="50" class="form-control input-sm"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" placeholder="Municipality/City" id="spouse_city" name ="spouse_city">
                                                                <option value="0" class ="disabled selected">Municipality/City</option>
                                                                <?php foreach($allcity as $allcity2){ ?>
                                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="form-group">
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="spouse_province" name ="spouse_province">
                                                                <option value="1" class ="disabled selected">Province</option>
                                                                <?php foreach($allprovince as $allprovince2){ ?>
                                                                <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>
                                                        <div class="col-md-3">
                                                            <select class="form-control select2 select2-hidden-accessible" id="spouse_country" name ="spouse_country">
                                                                <option value="1" class ="disabled selected">Country</option>
                                                                <?php foreach($addcountry as $addcountry2){ ?>
                                                                <option value="<?php echo $addcountry2['id'];?>"><span><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'] . '.png';?>" alt="Mountain View" style="" /> </span><?php echo $addcountry2['country_name'];?></option>
                                                                <?php } ?> 
                                                            </select> 
                                                        </div>
                                                        <div class="col-md-3">
                                                            <input type="text" id="spouse_postalcode" name="spouse_postalcode" placeholder="Postal Code" maxlength="5" class="form-control input-sm"/>
                                                        </div>
                                                        <!-- <div class="col-md-3">
                                                            <input type="text" id="employer_lengthofstay" name="employer_lengthofstay" placeholder="Length of Stay" maxlength="50" class="form-control input-sm"/>
                                                            
                                                        </div> -->
                                                    </div>
                                                </div>
                                                <br />
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Occupation<font color="red"> * </font></label>
                                                        <select class="form-control" id="spouse_occupation" name="spouse_occupation">
                                                            <option class="disabled selected" value="0">Select.. </option>
                                                            <option value="1">Employed</option>
                                                            <option value="2">Self-Employed</option>
                                                            <option value="3">OFW</option>
                                                            <option value="4">Retired</option>
                                                            <option value="5">Retire</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label class="control-label">Monthly Gross Income<font color="red"> * </font></label>
                                                        <input type="text" id="spouse_gross" name="spouse_gross" placeholder="" maxlength="50" class="form-control input-sm"/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="bold">
                                            Personal References
                                        </h5>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" id="reference_id" name="reference_id[]" placeholder="Fullname" maxlength="50" class="form-control input-sm" required/>
                                        <input type="text" id="reference_fullname" name="reference_fullname[]" placeholder="Fullname" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_address" name="reference_address[]" placeholder="Address" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="reference_relation" name="reference_relation[]" placeholder="Relation" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="reference_tel" name="reference_tel[]" placeholder="Tel. no." maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                </div>
                                <div class="row"></div>
                                <br />
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" id="reference_id1" name="reference_id[]" placeholder="Fullname" maxlength="50" class="form-control input-sm" required/>
                                        <input type="text" id="reference_fullname1" name="reference_fullname[]" placeholder="Fullname" maxlength="50" class="form-control input-sm" required/>
                                    </div> 
                                    <div class="col-md-5">
                                        <input type="text" id="reference_address1" name="reference_address[]" placeholder="Address" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="reference_relation1" name="reference_relation[]" placeholder="Relation" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="reference_tel1" name="reference_tel[]" placeholder="Tel. no." maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                </div>
                                <div class="row"></div>
                                <br />
                                <div class="row">
                                    <div class="col-md-3">
                                        <input type="hidden" id="reference_id2" name="reference_id[]" placeholder="Fullname" maxlength="50" class="form-control input-sm" required/>
                                        <input type="text" id="reference_fullname2" name="reference_fullname[]" placeholder="Fullname" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-5">
                                        <input type="text" id="reference_address2" name="reference_address[]" placeholder="Address" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="reference_relation2" name="reference_relation[]" placeholder="Relation" maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                    <div class="col-md-2">
                                        <input type="text" id="reference_tel2" name="reference_tel[]" placeholder="Tel. no." maxlength="50" class="form-control input-sm" required/>
                                    </div>
                                </div>
                            </div>
                            <div id="form_requirements" style="display: none;">
                                <div class="row">

                                    <div class="col-md-12">
                                        <!-- WORK HERE NEXT! -->
                                        <div class="portlet light portlet-fit">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                    <span class="caption-subject bold uppercase">Required Attachments</span>
                                                </div> 
                                            </div>
                                            <div class="portlet-body">
                                                <input type="hidden" name="client_id" id="client_id">
                                                <table class="table">
                                                    <tr id="is_ids_tr">
                                                        <td>Two Valid ID</td>
                                                        <td><input type="file" name="is_ids" id="is_ids"></td>
                                                        <input type="hidden" name="is_ids_id" id="is_ids_id">
                                                    </tr>
                                                    <tr id="is_filipino_tr">
                                                        <td>Foreign Requirement</td>
                                                        <td><input type="file" name="is_filipino2" id="is_filipino2"></td>
                                                        <input type="hidden" name="is_filipino_id" id="is_filipino_id">
                                                    </tr>
                                                    <tr id="is_legal_tr">
                                                        <td>Parental Consent</td>
                                                        <td><input type="file" name="is_legal" id="is_legal"></td>
                                                        <input type="hidden" name="is_legal_id" id="is_legal_id">
                                                    </tr>
                                                    <!-- <tr id="is_consent_tr">
                                                        <td>Spousal Consent</td>
                                                        <td><input type="file" name="is_consent" id="is_consent"></td>
                                                        <input type="hidden" name="is_consent_id" id="is_consent_id">
                                                    </tr> -->
                                                    <tr id="is_selfemployed_tr">
                                                        <td>DTI</td>
                                                        <td><input type="file" name="is_selfemployed" id="is_selfemployed"></td>
                                                        <input type="hidden" name="is_selfemployed_id" id="is_selfemployed_id">
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row"></div>
                            <br />
                            <div class="row" align="right">
                                <div class="col-md-12">
                                    <input class="btn btn-success" type="submit" name="submit_new_customer" id="submit_new_customer" value="Submit" >
                                    <input class="btn btn-success" type="button" name="btn_done" id="btn_done" value="Done" style="display: none;">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- new person customer modal : END -->


<!-- new org customer modal : START -->
    <div style="" class="modal fade bs-modal-lg" id="add_neworg_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h3 class="font-green-meadow sbold uppercase" id="">Add Organization Customer</h3>
                </div>
                <div class="modal-body">

                </div>
            </div>
        </div>
    </div>
<!-- new org customer modal : END -->