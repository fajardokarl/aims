<div class="row">
        <div class="col-md-12">
            <div class="portlet light " id="bankslists">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="fa fa-users font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> Banks List</span>
                    </div>
                    <div class="actions">
                        <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddNewBank" id="addNewBank"><i class="fa fa-plus"> </i>New Bank</button>
                    </div>
                </div>
                <div class="portlet-body">
                  
                    <table class="tblbankslists table table-hover" id="tblbankslists" >
                        <thead>
                        <tr>
                            <th style="display: none;">Bank ID</th>
                            <th style="display: none;">Person ID</th>
                            <th style="display: none;">Address ID</th>
                            <th>Bank Name</th>
                            <th>Bank Address</th>
                            <th>Contact Person</th>
                            <th>Contact Person Contact Information</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php foreach($banks as $banks){ ?>
                     <tr>
                        <td style="display: none;"><?php echo $banks['bank_id'];?></td>
                        <td style="display: none;"><?php echo $banks['person_id'];?></td>
                        <td style="display: none;"><?php echo $banks['address_id'];?></td>
                        <td><?php echo $banks['bank_name'];?></td>
                        <td><?php 
                            if ($banks['line_1']){ echo $banks['line_1'].', ';}
                            if ($banks['line_2']){ echo $banks['line_2'].', ';}
                            if ($banks['line_3']){ echo $banks['line_3'].', ';}
                            echo $banks['city_name'].', '.$banks['province_name'].', '.$banks['country_name'];?></td>
                        <td><?php echo $banks['firstname'].' '.$banks['lastname'];?></td>
                        <td><?php echo $banks['contact_value'];?></td>
                    </tr>
                    <?php } ?>
                  
                    </tbody>
                    </table>       
                </div>
            </div>
        </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="AddNewBank" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="bankForm" name="bankForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <li class="active" id="tab1">
                                    <a href="#tab_bank" data-toggle="tab"> New Bank </a>
                                </li>
                                <li class="" id="tab1">
                                    <a href="#tab_person" data-toggle="tab"> New Contact Person </a>
                                </li>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab">
                            <div class="tab-pane active" id="tab_bank">
                                <div class="caption">
                                      <h1 class="caption-subject font-blue sbold uppercase">Bank Details</h1>
                                </div>
                                <hr>
                                <div class="row">
                                    
                                    <div class="col-md-5">

                                        <div class="form-group">
                                            <label class="control-label">Bank Name<font color="red"> *</font></label>
                                            <input type="text" id="bankName" name="bankName"  placeholder="Bank Name" maxlength="30" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Bank Account<font color="red"> *</font></label>
                                            <input type="text" id="accountNum" name="accountNum" placeholder="Account Number" maxlength="20" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span class="caption-subject font-blue sbold uppercase">Address</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Address Type<font color="red"> * </font></label>
                                            <select class="form-control select2 select2-hidden-accessible" id="bankAddressType" name ="bankAddressType">
                                                <option value="" disabled selected>-- Select Address Type --</option>
                                                <option value="1">Home</option>
                                                <option value="2">Work</option>
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Unit Number/House Number</label>
                                             <input type="text" id="bankAddressLine1" name="bankAddressLine1" maxlength="35" placeholder="" class="form-control"/>   
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Floor/Building</label>
                                             <input type="text" id="bankAddressLine2" name="bankAddressLine2" maxlength="35" placeholder="" class="form-control"/>   
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Street/Barangay</label>
                                             <input type="text" id="bankAddressLine3" name="bankAddressLine3" maxlength="35" placeholder="" class="form-control"/>   
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">City<font color="red"> * </font></label>
                                            <select class="form-control select2 select2-hidden-accessible" id="bankAddressCity" name ="bankAddressCity">
                                            
                                                <option value="1" class ="disabled selected">Select Here..</option>
                                                <?php foreach($allcity as $allcity2){ ?>
                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                <?php } ?> 
                                            </select>   
                                        </div>     
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label class="control-label">Provice<font color="red"> * </font></label>
                                           <select class="form-control select2 select2-hidden-accessible" id="bankAddressProvince" name ="bankAddressProvince">
                                                  <option value="1" class ="disabled selected">Select Here..</option>
                                                 <?php foreach($allprovince as $allprovince2){ ?>
                                                  <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                  <?php } ?> 
                                          </select>   
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label class="control-label">Country<font color="red"> * </font></label>
                                           <select class="form-control select2 select2-hidden-accessible" id="bankAddressCountry" name ="bankAddressCountry">
                                                  <option value="1" class ="disabled selected">Select Here..</option>
                                                 <?php foreach($addcountry as $addcountry2){ ?>
                                                  <option value="<?php echo $addcountry2['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry2['country_name'];$addcountry2['letter_code_2'];?></option>
                                                  <?php } ?> 

                                          </select> 
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                         <a  class="btn green" href="#tab_person" id="tab_next" data-toggle="tab"><i class="fa fa-forward" aria-hidden="true"></i> Next</a>
                                </div>
                            </div>
                            <!-- done -->
                            <!-- end of first tab -->
                            <!-- start of second tab -->
                            <div class="tab-pane " id="tab_person">
                                <div class="caption">
                                          <h1 class="caption-subject font-blue sbold uppercase">Contact Person Details</h1>
                                </div>
                                <hr>
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div id="profilechange">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> 
                                                </div>
                                            </div>
                                            <div>
                                                <span class="btn green btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" id="userfile" name="userfile"/> 
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">First Name<font color="red"> *</font></label>
                                                <input type="text" id="personFirstName" name="personFirstName"  placeholder="First Name" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Middle Name<font color="red"> *</font></label>
                                                <input type="text" id="personMiddleName" name="personMiddleName"  placeholder="Middle Name" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Last Name<font color="red"> *</font></label>
                                                <input type="text" id="personLastName" name="personLastName"  placeholder="Last Name" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="control-label">Suffix</label>
                                                <input type="text" id="personSuffix" name="personSuffix"  placeholder="Suffix" maxlength="30" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Sex<font color="red"> *</font></label>
                                                <select class="form-control" name="personSex" id="personSex" required>
                                                    <option value="" disabled selected>-- Select Sex --</option>
                                                    <option value="M">M</option>
                                                    <option value="F">F</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div data-date-format="mm/yyyy" >
                                                    <label class="control-label">Birthday<font color="red"> * </font></label>
                                                    <input  type="date" name="personBirthday" placeholder="yyyy-mm-dd" class="form-control" id="personBirthday" maxlength="10" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Birthplace<font color="red"> * </font></label>
                                                <input type="text" id="personBirthplace" name="personBirthplace"  placeholder="Birth Place" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Nationality<font color="red"> * </font></label>
                                                <input type="text" id="personNationality" name="personNationality"  placeholder="Nationality" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Civil Status <font color="red"> * </font></label>
                                                <select class="form-control" name="personCivilStatus" id="personCivilStatus" required>
                                                    <option value="" disabled selected>-- Select Civil Status --</option>
                                                    <option value="1">Single</option>
                                                    <option value="2">Married</option>
                                                    <option value="3">Divorced</option>
                                                    <option value="4">Separated</option>
                                                    <option value="5">Widowed</option>
                                                </select> 
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Contact Number/Email<font color="red"> * </font></label>
                                                <input type="text" id="personContact" name="personContact"  placeholder="Contact Information" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Contact Type<font color="red"> * </font></label>
                                                <select class="form-control" name="personContactType" id="personContactType" required>
                                                    <option value="" disabled selected>-- Select Contact Type --</option>
                                                    <option value="1">Home Phone</option>
                                                    <option value="2">Work Phone</option>
                                                    <option value="3">Personal Email</option>
                                                    <option value="4">Work Email</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <i class="fa fa-home" aria-hidden="true"></i>
                                                <span class="caption-subject font-blue sbold uppercase">Address</span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Address Type<font color="red"> * </font></label>
                                                <select class="form-control select2 select2-hidden-accessible" id="personAddressType" name ="personAddressType" required>
                                                              <option value="1" class ="disabled selected">Select Here..</option>
                                                              <?php foreach($addtype as $addtype2){ ?>
                                                               <option value="<?php echo $addtype2['address_type_id'];?>"><?php echo $addtype2['address_type_name'];?></option>
                                                              <?php } ?> 
                                                </select>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Unit Number/House Number</label>
                                                 <input type="text" id="personAddressLine1" name="personAddressLine1" maxlength="35" placeholder="" class="form-control"/>   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Floor/Building</label>
                                                 <input type="text" id="personAddressLine2" name="personAddressLine2" maxlength="35" placeholder="" class="form-control"/>   
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Street/Barangay</label>
                                                 <input type="text" id="personAddressLine3" name="personAddressLine3" maxlength="35" placeholder="" class="form-control"/>   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">City<font color="red"> * </font></label>
                                                <select class="form-control select2 select2-hidden-accessible" id="personAddressCity" name ="personAddressCity" required>
                                                
                                                    <option value="1" class ="disabled selected">Select Here..</option>
                                                    <?php foreach($allcity as $allcity2){ ?>
                                                    <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                    <?php } ?> 
                                                </select>   
                                            </div>     
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="control-label">Provice<font color="red"> * </font></label>
                                               <select class="form-control select2 select2-hidden-accessible" id="personAddressProvince" name ="personAddressProvince" required>
                                                    <option value="1" class ="disabled selected">Select Here..</option>
                                                    <?php foreach($allprovince as $allprovince2){ ?>
                                                    <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                    <?php } ?> 
                                              </select>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="control-label">Country<font color="red"> * </font></label>
                                               <select class="form-control select2 select2-hidden-accessible" id="personAddressCountry" name ="personAddressCountry" required>
                                                    <option value="1" class ="disabled selected">Select Here..</option>
                                                    <?php foreach($addcountry as $addcountry2){ ?>
                                                      <option value="<?php echo $addcountry2['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry2['country_name'];$addcountry2['letter_code_2'];?></option>
                                                    <?php } ?> 

                                              </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a  class="btn green" href="#tab_bank" id="tab_back" data-toggle="tab"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>
                            <!-- end of second tab -->
                        </div>
                        
                        
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="bankSubmit" id="bankSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Bank Information</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
<!-- BANK UPDATE MODAL -->
<div style="" class="modal fade bs-modal-lg" id="UpdateBank" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="updateBankForm" name="updateBankForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab2">
                                <li class="active" id="tab2">
                                    <a href="#tab_bank2" data-toggle="tab"> Update Bank </a>
                                </li>
                                <li class="" id="tab1">
                                    <a href="#tab_person2" data-toggle="tab"> Update Contact Person </a>
                                </li>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab2">
                            <div class="tab-pane active" id="tab_bank2">
                                <div class="caption">
                                      <h1 class="caption-subject font-blue sbold uppercase">Bank Details</h1>
                                </div>
                                <hr>
                                <div class="row">
                                    
                                    <div class="col-md-5">

                                        <div class="form-group">
                                            <label class="control-label">Bank Name<font color="red"> *</font></label>
                                            <input type="text" id="updateBankName" name="updateBankName"  placeholder="Bank Name" maxlength="30" class="form-control" required/>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">Account Number<font color="red"> *</font></label>
                                            <input type="text" id="updateAccountNum" name="updateAccountNum" placeholder="Account Number" maxlength="20" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <i class="fa fa-home" aria-hidden="true"></i>
                                            <span class="caption-subject font-blue sbold uppercase">Address</span>
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Address Type<font color="red"> * </font></label>
                                            <select class="form-control select2 select2-hidden-accessible" id="updateBankAddressType" name ="bankAddressType">
                                                <option value="" disabled>-- Select Address Type --</option>
                                                <option value="1">Home</option>
                                                <option value="2">Work</option>
                                            </select>  
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Unit Number/House Number</label>
                                             <input type="text" id="updateBankAddressLine1" name="updateBankAddressLine1" maxlength="35" placeholder="" class="form-control"/>   
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Floor/Building</label>
                                             <input type="text" id="updateBankAddressLine2" name="updateBankAddressLine2" maxlength="35" placeholder="" class="form-control"/>   
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Street/Barangay</label>
                                             <input type="text" id="updateBankAddressLine3" name="updateBankAddressLine3" maxlength="35" placeholder="" class="form-control"/>   
                                        </div>
                                    </div>
                                    
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="control-label">City<font color="red"> * </font></label>
                                            <select class="form-control select2 select2-hidden-accessible" id="updateBankAddressCity" name ="updateBankAddressCity">
                                            
                                                <option value="1" class ="disabled">Select Here..</option>
                                                <?php foreach($allcity as $allcity2){ ?>
                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                <?php } ?> 
                                            </select>   
                                        </div>     
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                        <label class="control-label">Provice<font color="red"> * </font></label>
                                           <select class="form-control select2 select2-hidden-accessible" id="updateBankAddressProvince" name ="updateBankAddressProvince">
                                                  <option value="1" class ="disabled">Select Here..</option>
                                                 <?php foreach($allprovince as $allprovince2){ ?>
                                                  <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                  <?php } ?> 
                                          </select>   
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                           <label class="control-label">Country<font color="red"> * </font></label>
                                           <select class="form-control select2 select2-hidden-accessible" id="updateBankAddressCountry" name ="updateBankAddressCountry">
                                                  <option value="1" class ="disabled">Select Here..</option>
                                                 <?php foreach($addcountry as $addcountry2){ ?>
                                                  <option value="<?php echo $addcountry2['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry2['country_name'];$addcountry2['letter_code_2'];?></option>
                                                  <?php } ?> 

                                          </select> 
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                         <a  class="btn green" href="#tab_person2" id="tab_next2" data-toggle="tab"><i class="fa fa-forward" aria-hidden="true"></i> Next</a>
                                </div>
                            </div>
                            <!-- done -->
                            <!-- end of first tab -->
                            <!-- start of second tab -->
                            <div class="tab-pane " id="tab_person2">
                                <div class="caption">
                                          <h1 class="caption-subject font-blue sbold uppercase">Contact Person Details</h1>
                                </div>
                                <hr>
                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <div class="fileinput fileinput-new" data-provides="fileinput">
                                            <div id="profilechange">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> 
                                                </div>
                                            </div>
                                            <div>
                                                <span class="btn green btn-outline btn-file">
                                                    <span class="fileinput-new"> Select image </span>
                                                    <span class="fileinput-exists"> Change </span>
                                                    <input type="file" id="userfile2" name="userfile2"/> 
                                                </span>
                                                <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput"> Remove </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-9">
                                    <div class="row">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">First Name<font color="red"> *</font></label>
                                                <input type="text" id="updatePersonFirstName" name="updatePersonFirstName"  placeholder="First Name" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Middle Name<font color="red"> *</font></label>
                                                <input type="text" id="updatePersonMiddleName" name="updatePersonMiddleName"  placeholder="Middle Name" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Last Name<font color="red"> *</font></label>
                                                <input type="text" id="updatePersonLastName" name="updatePersonLastName"  placeholder="Last Name" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-1">
                                            <div class="form-group">
                                                <label class="control-label">Suffix</label>
                                                <input type="text" id="updatePersonSuffix" name="updatePersonSuffix"  placeholder="Suffix" maxlength="30" class="form-control"/>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <label class="control-label">Sex<font color="red"> *</font></label>
                                                <select class="form-control" name="updatePersonSex" id="updatePersonSex" required>
                                                    <option value="" disabled>-- Select Sex --</option>
                                                    <option value="M">M</option>
                                                    <option value="F">F</option>
                                                </select>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div data-date-format="mm/yyyy" >
                                                    <label class="control-label">Birthday<font color="red"> * </font></label>
                                                    <input  type="date" name="updatePersonBirthday" placeholder="yyyy-mm-dd" class="form-control" id="updatePersonBirthday" maxlength="10" required />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Birthplace<font color="red"> * </font></label>
                                                <input type="text" id="updatePersonBirthplace" name="updatePersonBirthplace"  placeholder="Birth Place" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Nationality<font color="red"> * </font></label>
                                                <input type="text" id="updatePersonNationality" name="updatePersonNationality"  placeholder="Nationality" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Civil Status <font color="red"> * </font></label>
                                                <select class="form-control" name="updatePersonCivilStatus" id="updatePersonCivilStatus" required>
                                                    <option value="" disabled>-- Select Civil Status --</option>
                                                    <option value="1">Single</option>
                                                    <option value="2">Married</option>
                                                    <option value="3">Divorced</option>
                                                    <option value="4">Separated</option>
                                                    <option value="5">Widowed</option>
                                                </select> 
                                            </div>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Contact Number/Email<font color="red"> * </font></label>
                                                <input type="text" id="updatePersonContact" name="updatePersonContact"  placeholder="Contact Information" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="control-label">Contact Type<font color="red"> * </font></label>
                                                <select class="form-control" name="updatePersonContactType" id="updatePersonContactType" required>
                                                    <option value="" disabled>-- Select Contact Type --</option>
                                                    <option value="1">Home Phone</option>
                                                    <option value="2">Work Phone</option>
                                                    <option value="3">Personal Email</option>
                                                    <option value="4">Work Email</option>
                                                </select> 
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <i class="fa fa-home" aria-hidden="true"></i>
                                                <span class="caption-subject font-blue sbold uppercase">Address</span>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Address Type<font color="red"> * </font></label>
                                                <select class="form-control select2 select2-hidden-accessible" id="updatePersonAddressType" name ="updatePersonAddressType" required>
                                                              <option value="1" class ="disabled">Select Here..</option>
                                                              <?php foreach($addtype as $addtype2){ ?>
                                                               <option value="<?php echo $addtype2['address_type_id'];?>"><?php echo $addtype2['address_type_name'];?></option>
                                                              <?php } ?> 
                                                </select>  
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Unit Number/House Number</label>
                                                 <input type="text" id="updatePersonAddressLine1" name="updatePersonAddressLine1" maxlength="35" placeholder="" class="form-control"/>   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Floor/Building</label>
                                                 <input type="text" id="updatePersonAddressLine2" name="updatePersonAddressLine2" maxlength="35" placeholder="" class="form-control"/>   
                                            </div>
                                        </div>
                                        
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">Street/Barangay</label>
                                                 <input type="text" id="updatePersonAddressLine3" name="updatePersonAddressLine3" maxlength="35" placeholder="" class="form-control"/>   
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="control-label">City<font color="red"> * </font></label>
                                                <select class="form-control select2 select2-hidden-accessible" id="updatePersonAddressCity" name ="updatePersonAddressCity" required>
                                                
                                                    <option value="1" class ="disabled">Select Here..</option>
                                                    <?php foreach($allcity as $allcity2){ ?>
                                                    <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                    <?php } ?> 
                                                </select>   
                                            </div>     
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label class="control-label">Provice<font color="red"> * </font></label>
                                               <select class="form-control select2 select2-hidden-accessible" id="updatePersonAddressProvince" name ="updatePersonAddressProvince" required>
                                                    <option value="1" class ="disabled">Select Here..</option>
                                                    <?php foreach($allprovince as $allprovince2){ ?>
                                                    <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                    <?php } ?> 
                                              </select>   
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4">
                                            <div class="form-group">
                                               <label class="control-label">Country<font color="red"> * </font></label>
                                               <select class="form-control select2 select2-hidden-accessible" id="updatePersonAddressCountry" name ="updatePersonAddressCountry" required>
                                                    <option value="1" class ="disabled">Select Here..</option>
                                                    <?php foreach($addcountry as $addcountry2){ ?>
                                                      <option value="<?php echo $addcountry2['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry2['country_name'];$addcountry2['letter_code_2'];?></option>
                                                    <?php } ?> 

                                              </select> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <a  class="btn green" href="#tab_bank2" id="tab_back2" data-toggle="tab"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                                </div>
                            </div>
                            <!-- end of second tab -->
                        </div>
                        
                        
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="bankSubmitUpdate" id="bankSubmitUpdate" class="btn green"><i class="fa fa-plus"></i> Save New Bank Information</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
