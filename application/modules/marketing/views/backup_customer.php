

<div style="" class="modal fade bs-modal-lg" id="AddCustomer" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
            <!-- <div class="actions">
                               
                                <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a>
                            </div> -->
                        </div>
                        <form action="" method="POST" enctype="multipart/form-data" id="allsubmit" name="CustomerInformationForm" onsubmit="return ValidateForm()">
                            <div class="modal-body">
                                <div class="profile">
                                    <div class="tabbable-line tabbable-full-width">
                                        <ul class="nav nav-tabs">
                                            <li class="active" id="tab1">
                                                <a href="#tab_customer" data-toggle="tab"> Customer </a>
                                            </li>
                                            <li class="" id="tab2">
                                                <a href="#tab_instructions" data-toggle="tab"> Instructions </a>
                                            </li>
                                            <li class="" id="tab3">
                                                <a href="#tab_accounts" data-toggle="tab"> Accounts </a>
                                            </li>                        </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="tab_customer">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                           <div class="form-group ">
                                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                             <div id="imageselect">
                                                                <div class="profile-userpic">
                                                                    <div class="thumbnail" style="width: 200px; height: 150px;">
                                                                        <img src="<?=base_url()?>public/pages/images/profiles/3934.jpg" id="profilepicture" class="img-responsive" alt="">
                                                                    </div>
                                                                    <button type="button" class="btn green" id="editpic">New Picture</button>
                                                                </div>
                                                            </div>
                                                            <div id="profilechange">
                                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;">
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
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <div class="form-group" id="custidforedit">
                                                                <!-- <label class="control-label">Personal ID</label> -->
                                                                <input type="hidden" name="CustomerID" id="CustomerID" placeholder="" class="form-control"/>
                                                                <input type="hidden" name="id_client" id="id_client" placeholder="" class="form-control"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row"  style="display: none;">
                                                        <div class="col-md-12">
                                                           <div class="form-group">
                                                            <label class="control-label">Subsidiary Account Code</label>
                                                            <input type="text" name="inputsubsidiary" id="inputsubsidiary" placeholder="" class="form-control" readonly />
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group" style="display: none;">
                                                    <div class="radio-list" data-error-container="#form_2_membership_error">
                                                        <label><input type="radio" name="custActive" value="1" /> Active </label>
                                                        <label><input type="radio" name="custActive" value="0" /> Not Active </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-10">
                                                <div class="row">
                                                    <div class="col-md-12 profile-info">
                                                        <h1 class="font-green sbold uppercase" id="customer_page_tittle"></h1>
                                                        <hr>
                                                        <div class="col-md-6">  
                                                            <div class="row">
                                                                <div class="col-md-4">

                                                                    <div class="form-group">
                                                                        <label class="control-label">First Name<font color="red"> * </font></label>
                                                                        <input type="text" id="custFname" name="custFname"  placeholder="" maxlength="30" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Middle Name<font color="red"> * </font></label>
                                                                        <input type="text" id="custMname" name="custMname" placeholder="" maxlength="50" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Last Name<font color="red"> * </font></label>
                                                                        <input type="text" id="custLname" name="custLname" placeholder="" maxlength="50" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                <!-- <div class="form-group">
                                                                    <label class="control-label">Contact Number</label>
                                                                    <input type="text" id="custContactNum" name="custContactNum"  placeholder="" maxlength="30" class="form-control"/>
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <label class="control-label">Gender <font color="red"> * </font></label>
                                                                    <select class="form-control" name="custGender" id="custGender" required>
                                                                        <option value="" disabled selected>---- Select Gender ----</option>
                                                                        <option value="M">Male</option>
                                                                        <option value="F">Female</option>
                                                                    </select> 
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Civil Status <font color="red"> * </font></label>
                                                                    <select class="form-control" name="custCivilStatus" id="custCivilStatus" required>
                                                                        <option value="" disabled selected>---- Select Civil Status ----</option>
                                                                        <option value="1">Single</option>
                                                                        <option value="2">Married</option>
                                                                        <option value="3">Divorced</option>
                                                                        <option value="4">Separated</option>
                                                                        <option value="5">Widowed</option>
                                                                    </select> 
                                                                </div>
                                                                <!-- <div class="form-group">
                                                                    <label class="control-label">Fax Number</label>
                                                                    <input type="text" id="custFaxNumber" name="custFaxNumber" placeholder="" class="form-control" maxlength="25"/>
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <label class="control-label">Nationality <font color="red"> * </font></label>
                                                                    <input type="text" id="custNationality" name="custNationality" placeholder="" class="form-control" required maxlength="25"/> 
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <!-- <div class="form-group">
                                                                    <label class="control-label">E-mail</label>
                                                                    <input type="text" id="custEmail" name="custEmail" placeholder="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="example: abrown@gmail.com" maxlength="50" class="form-control"/>
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <div data-date-format="mm/yyyy" >
                                                                      <label class="control-label">Birthday <font color="red"> * </font></label>
                                                                      <input  type="text" name="birthdate" placeholder="yyyy-mm-dd" class="form-control" id="birthdate" maxlength="10" required onkeypress="return isNumber()"/>
                                                                  </div>
                                                              </div>
                                                              <div class="form-group">
                                                                <label class="control-label">Place of Birth <font color="red"> * </font></label>
                                                                <input type="text" id="custPlaceOfBirth" name="custPlaceOfBirth" placeholder="" class="form-control" required maxlength="50"/> 
                                                            </div>
                                                                <!-- <div class="form-group">
                                                                    <label class="control-label">Business Phone</label>
                                                                    <input type="text" id="custBusinessPhone" name="custBusinessPhone" placeholder="" class="form-control" maxlength="25" />
                                                                </div> -->
                                                                <div class="form-group">
                                                                    <label class="control-label">Tax Indentification No.</label>
                                                                    <input type="text" id="custTIN" name="custTIN" placeholder="" class="form-control" maxlength="15" /> 
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- table for address -->
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                             
                                                            </div>                 
                                                        </div> 
                                                    </div>
                                                    <!-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tax Indentification No.</label>
                                                            <input type="text" id="custTIN" name="custTIN" placeholder="" class="form-control" maxlength="15" /> 
                                                        </div>
                                                           
                    
                                                        <div class="form-group">
                                                            <label class="control-label">Occupation</label>
                                                            <input type="text" id="custOccupation" name="custOccupation" placeholder="" class="form-control" maxlength="35" /> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Source of Funds</label>
                                                            <input type="text" id="custSourceOfFunds" name="custSourceOfFunds" placeholder="" class="form-control" maxlength="40"/> 
                                                        </div>

                                                       
                                                        <div class="form-group">
                                                            <label class="control-label">Employer and Address</label>
                                                            <textarea id="custEmployerAndAddress" name="custEmployerAndAddress" class="form-control" rows="3" placeholder="" maxlength="150"></textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Job Title/Profession</label>
                                                            <input type="text" id="custJobTitleProfession" name="custJobTitleProfession" maxlength="35" placeholder="" class="form-control"/> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Monthly Gross Income</label>
                                                            <input type="text" id="custMonthlyGrossIncome" name="custMonthlyGrossIncome" placeholder="" class="form-control" maxlength="35"/>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Nationality <font color="red"> * </font></label>
                                                            <input type="text" id="custNationality" name="custNationality" placeholder="" class="form-control" required maxlength="25"/> 
                                                        </div>      
                                                        <div class="form-group">
                                                            <label class="control-label">Dependents and Age</label>
                                                            <textarea id="custDependentAndAge" name="custDependentAndAge" class="form-control" rows="3" placeholder="" maxlength="50"></textarea>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="portlet light portlet-fit" id="contact_portlet">
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                                <span class="caption-subject font-blue sbold uppercase">Contact Information<font color="red"> * </font></span>
                                                            </div> 
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row">
                                                                <div class="col-md-6">
                                                                    <table id="cust_contacts_table" class="table table-hover">
                                                                     <thead>
                                                                        <tr>
                                                                            <th>Contact Type</th>
                                                                            <th>Contact Value</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td>
                                                                                <select class="form-control select2 select2-hidden-accessible" id="cust_cont_type" name="cust_cont_type">
                                                                                 <option value="1">Home Phone</option>
                                                                                 <option value="2">Work Phone</option>
                                                                                 <option value="3">Personal Email</option>
                                                                                 <option value="4">Work Email</option>
                                                                             </select> 
                                                                         </td>
                                                                         <td><input type="text" name="cust_cont_value" id="cust_cont_value" class="form-control"></td>
                                                                         <td><a href="#" id="add_cust_contact" class ="btn btn-info">Add</a></td>
                                                                     </tr>
                                                                 </tbody>
                                                             </table>  
                                                         </div>
                                                     </div><!-- end row -->
                                                 </div>
                                             </div>
                                         </div>

                                         <div class="col-md-12">
                                            <div class="portlet light portlet-fit" id="work_portlet">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                        <span class="caption-subject font-blue sbold uppercase">Work</span>
                                                    </div> 
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Company Name <!-- <font color="red"> * </font> --></label>
                                                                <input type="text" id="comp_name" name="comp_name" placeholder="" class="form-control" maxlength="25"/>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Occupation<!-- <font color="red"> * </font> --></label>
                                                                <input type="text" id="cust_occupation" name="cust_occupation" placeholder="" class="form-control" maxlength="25"/>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Job Title<!-- <font color="red"> * </font> --></label>
                                                                <input type="text" id="job_title" name="job_title" placeholder="" class="form-control" maxlength="25"/>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Monthly Gross Income<!-- <font color="red"> * </font> --></label>
                                                                <input type="text" id="cust_income" name="cust_income" placeholder="" class="form-control" maxlength="25"/>
                                                            </div> 
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label"> Source of Funds<!-- <font color="red"> * </font> --></label>
                                                                <input type="text" id="cust_funds" name="cust_funds" placeholder="" class="form-control" maxlength="25"/>
                                                            </div> 
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit ">
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <i class="fa fa-home" aria-hidden="true"></i>
                                                        <span class="caption-subject font-blue sbold uppercase">Address</span>
                                                    </div> 
                                                </div>
                                                <div class="portlet-body">
                                                    <div id="fornew">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Address type<font color="red"> * </font></label>
                                                                <select class="form-control select2 select2-hidden-accessible" id="addtype" name ="addtype">
                                                                  <option value="1" class ="disabled selected">Select Here..</option>
                                                                  <?php foreach($addtype as $addtype2){ ?>
                                                                  <option value="<?php echo $addtype2['address_type_id'];?>"><?php echo $addtype2['address_type_name'];?></option>
                                                                  <?php } ?> 
                                                              </select>  
                                                          </div>
                                                          <div class="form-group">
                                                            <label class="control-label">Street<font color="red"> * </font></label>
                                                            <input type="text" id="street_line2" name="street_line2" maxlength="35" placeholder="" class="form-control"/>   
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Barangay<font color="red"> * </font></label>
                                                            <input type="text" id="barangay" name="barangay" maxlength="35" placeholder="" class="form-control"/>   
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">House Number<font color="red"> * </font></label>
                                                            <input type="text" id="house_num_line3" name="house_num_line3" maxlength="35" placeholder="" class="form-control"/>   
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">City <font color="red"> * </font></label>
                                                            <select class="form-control select2 select2-hidden-accessible" id="city" name ="city">
                                                                <option value="1" class ="disabled selected">Select Here..</option>
                                                                <?php foreach($allcity as $allcity2){ ?>
                                                                <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                                <?php } ?> 
                                                            </select>   
                                                        </div>     
                                                        <div class="form-group">
                                                            <label class="control-label">Provice<font color="red"> * </font></label>
                                                            <select class="form-control select2 select2-hidden-accessible" id="province" name ="province">
                                                              <option value="1" class ="disabled selected">Select Here..</option>
                                                              <?php foreach($allprovince as $allprovince2){ ?>
                                                              <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                              <?php } ?> 
                                                          </select>   
                                                      </div>
                                                      <div class="form-group">
                                                         <label class="control-label">Country<font color="red"> * </font></label>
                                                         <select class="form-control select2 select2-hidden-accessible" id="country" name ="country">
                                                          <option value="1" class ="disabled selected">Select Here..</option>
                                                          <?php foreach($addcountry as $addcountry2){ ?>
                                                          <option value="<?php echo $addcountry2['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry2['country_name'];$addcountry2['letter_code_2'];?></option>
                                                          <?php } ?> 

                                                      </select> 
                                                  </div>
                                              </div>
                                          </div>
                                          <div id="forexisting">
                                            <table class="table table-striped table-hover table-bordered dataTable no-footer" id="address_add" role="grid" aria-describedby="sample_editable_1_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th>id</th>
                                                        <th> Address type </th>
                                                        <th> House Number </th>
                                                        <th> Street </th>
                                                        <th> Barangay </th>
                                                        <th> City </th>
                                                        <th> Provice </th>
                                                        <th> Country </th>
                                                        <th> Action </th>
                                                    </tr>
                                                </thead>
                                                <tbody>               
                                                   <tr>
                                                       <td></td>
                                                       <td>
                                                        <select class="form-control select2 select2-hidden-accessible" id="addtype2">
                                                          <option value="1" class ="selected">Select Here..</option>
                                                          <?php foreach($addtype as $addtype){ ?>
                                                          <option value="<?php echo $addtype['address_type_id'];?>"><?php echo $addtype['address_type_name'];?></option>
                                                          <?php } ?> 
                                                      </select>  
                                                  </td>
                                                  <td><input type="text" class="form-control" id="house_num2"/></td>
                                                  <td><input type="text" class="form-control" id="street2"/></td>
                                                  <td><input type="text" class="form-control" id="barangay2"/></td>
                                                  <td>
                                                    <select class="form-control select2 select2-hidden-accessible" id="city2">
                                                      <option value="1" class ="selected">Select Here..</option>
                                                      <?php foreach($allcity as $allcity){ ?>
                                                      <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?></option>
                                                      <?php } ?> 
                                                  </select>                                                 </td>
                                                  <td>
                                                    <select class="form-control select2 select2-hidden-accessible" id="province2">
                                                      <option value="1" class ="selected">Select Here..</option>
                                                      <?php foreach($allprovince as $allprovince){ ?>
                                                      <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?></option>
                                                      <?php } ?> 
                                                  </select>  
                                              </td>
                                              <td>
                                               <select class="form-control select2 select2-hidden-accessible" id="country2">
                                                  <option value="1" class ="selected">Select Here..</option>
                                                  <?php foreach($addcountry as $addcountry){ ?>
                                                  <option value="<?php echo $addcountry['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry['country_name'];$addcountry['letter_code_2'];?></option>
                                                  <?php } ?> 

                                              </select> 
                                          </td>
                                          <td><a href = "#" id="addressnew" class ="btn btn-info">Add</a></td>
                                      </tr>
                                  </tbody>
                              </table>
                          </div>
                      </div>
                  </div>
                  <div class="portlet light portlet-fit" id="partner_panel">
                    <div class="portlet-title">
                        <div class="caption">
                          <span class="caption-subject font-blue sbold uppercase">Partner Details</span>
                      </div> 
                      <div class="tools"> 
                         <button type ="button" name="show_partner_view" id="show_partner_view" class="btn green"><i class="fa fa-plus"></i> Add partner</button>
                     </div>
                 </div>
                 <div class="portlet-body">
                    <table class="table table-striped table-hover table-bordered dataTable no-footer"  id="partner_details" role="grid" aria-describedby="sample_editable_1_info">
                        <thead>
                            <tr role="row">
                                <th> Parner id</th>
                                <th> Name</th>
                                <th> Contact Number </th>
                                <th> Email </th>
                                <th> Address</th>
                                <!-- <th> Actions</th> -->
                            </tr>
                        </thead>
                        <tbody>
                        </tbody> 
                    </table>
                </div>
            </div>
        </div>
        <!-- Customer details -->
    </div>
    <!--end row-->
</div>
<!-- done -->
</div>
<div class="modal-footer">
   <a  class="btn green" href="#tab_instructions" id="tab1_next" data-toggle="tab"><i class="fa fa-forward" aria-hidden="true"></i> Next</a>
</div>
</div>
<!--tab_1_2-->
<div class="tab-pane " id="tab_instructions">
    <div class="row">
        <div class="col-md-12">
            <div class="row"> 
                <div class="col-md-12 profile-info">
                    <h1 class="font-green sbold uppercase">Special Instructions</h1>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Postal Address</label>
                        <textarea name="postalAddress" id="postalAddress" class="form-control" rows="4" placeholder="" maxlength="75"></textarea>
                        <span class="help-block"> For written communications, please send to:</span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label class="control-label">Personal References</label>
                        <textarea name="personalReference" id="personalReference" class="form-control" rows="4" placeholder="" maxlength="150"></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer">
       <a  class="btn green" href="#tab_customer" id="tab2_back" data-toggle="tab"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
       <a  class="btn green" href="#tab_accounts" id="tab2_next" data-toggle="tab"><i class="fa fa-backward" aria-hidden="true"></i> Next</a>
   </div>
</div>
<!--tab_1_3-->
<div class="tab-pane " id="tab_accounts">
    <div class="row">
        <div class="col-md-12">
            <div class="row">
                <div class="col-md-12 profile-info">
                    <h1 class="font-green sbold uppercase">Customer Accounts</h1>
                    <hr>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet light " id="customermasterlist">
                        <div class="portlet-title">
                            <div class="caption font-green-sharp">
                                                                    <!-- <i class="fa fa-users font-green-sharp"></i>
                                                                        <span class="caption-subject bold uppercase"> Customer Amortization Contract</span> -->
                                                                    </div>
                                                                    <div class="actions"> </div>
                                                                </div>
                                                                <div class="portlet-body">
                                                                    <table class="tblcustamort table table-hover" id="tblcustamort" >
                                                                        <thead>
                                                                            <tr>
                                                                                <th>Contract ID</th>
                                                                                <th>Lot Description</th>
                                                                                <th>Contract Date</th>
                                                                                <th>Total Contract Price</th>
                                                                                <th>Action</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                        </tbody>
                                                                    </table>       
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                               <a  class="btn green" href="#tab_instructions" id="tab3_back" data-toggle="tab"><i class="fa fa-backward" aria-hidden="true"></i> Back</a>
                                           </div>
                                       </div>
                                       <!-- done -->
                                   </div>
                               </div>
                               <!-- end -->
                           </div>
                           <div class="modal-footer">
                            <input type="hidden" name="cust_org_id" id="cust_org_id">
                            <input type="hidden" name="cust_work_id" id="cust_work_id">
                            
                            <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                            <button type="submit" name="custSubmit" id="custSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Customer</button>
                            <button type="submit" name="custSubmitUpdate" id="custSubmitUpdate" class="btn green"><i class="fa fa-plus"></i>Save Changes</button>
                            <button type="submit" name="custPartnerSave" id="custPartnerSave" class="btn green"><i class="fa fa-plus"></i>Save Partner</button>
                            <button style="align:right;" type="button" class="btn btn-round green" id="pdf_report"><i class="fa fa-plus"> </i>Get PDF</button>
                        </div>
                    </form>        
                </div>
            </div>
        </div>
        
