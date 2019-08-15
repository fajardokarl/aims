<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="customermasterlist">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Customer Masterlist</span>
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddCustomer" id="addnewcust"><i class="fa fa-plus"> </i>New Customer</button>
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#add_custorg_modal" id="addneworg"><i class="fa fa-plus"> </i>New Organization</button>
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
</div>



<!-- NEW FORM (ORGANIZATION)---------------------------------------------------------------------------------- -->



    <div style="" class="modal fade bs-modal-lg" id="add_custorg_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">x</button>
                    <h3 class="font-green-meadow sbold uppercase" id="">Organization Customer Information</h3>
                </div>
                <form  action="" method="POST" enctype="multipart/form-data" id="cust_org_allsubmit">
                    <div class="modal-body">
                        <div class="tabbable-line tabbable-full-width" id="cust_tabs">
                            <ul class="nav nav-tabs">
                                <li class="active" id="tab1b">
                                    <a href="#tab_org_info" data-toggle="tab" id="tab_a"> Customer </a>
                                </li>
                                <li class="" id="tab2b">
                                    <a href="#tab_org_cont" data-toggle="tab"> Contacts </a>
                                </li>
                                <li class="" id="tab3b">
                                    <a href="#tab_org_addr" data-toggle="tab"> Address </a>
                                </li>
                                <!-- <li class="" id="tab4">
                                    <a href="#tab_instructions" data-toggle="tab"> Instructions </a>
                                </li>
                                <li class="" id="tab5">
                                    <a href="#tab_accounts" data-toggle="tab"> Accounts </a>
                                </li>                        
                                <li class="" id="tab6">
                                    <a href="#tab_old_acc" data-toggle="tab"> Old Account/s </a>
                                </li> -->
                            </ul>
                        

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_org_info">
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="control-label"><font color="red"> * </font>Company Name: </label>
                                                        <div>
                                                            <input type="text" name="cust_org_name" id="cust_org_name" class="form-control">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6"></div>
                                            </div>
                                            <!--<div class="row">
                                                <h3>Contact Person</h3>
                                            </div> -->
                                            <!-- <div class="row">
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
                                            </div> -->
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="portlet light portlet-fit" id="contact_portlet">
                                                        <!-- <a type="button" href="#tab_addr" data-toggle="tab" id="cont_next" class="btn btn-circle blue nexttab" style="float: right; margin-right: 20px;"> NEXT <i class="fa fa-chevron-right" aria-hidden="true"></i></a> -->
                                                        <!-- <a type="button" href="#tab_customer" data-toggle="tab" id="cont_back" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a> -->
                                                        <div class="portlet-title">
                                                            <div class="caption">
                                                                <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                                <span class="caption-subject font-blue sbold uppercase">Contact Person<font color="red"> * </font></span>
                                                                
                                                            </div> 
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Last Name<font color="red"> * </font></label>
                                                                        <input type="text" id="cust_org_lname" name="cust_org_lname" placeholder="" maxlength="50" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">First Name<font color="red"> * </font></label>
                                                                        <input type="text" id="cust_org_fname" name="cust_org_fname"  placeholder="" maxlength="30" class="form-control"/>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group">
                                                                        <label class="control-label">Middle Name<font color="red"> * </font></label>
                                                                        <input type="text" id="cust_org_mname" name="cust_org_mname" placeholder="" maxlength="50" class="form-control"/>
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
                                                                        <select class="form-control" name="cust_org_gender" id="cust_org_gender" required>
                                                                            <option value="" disabled selected>---- Select Gender ----</option>
                                                                            <option value="M">Male</option>
                                                                            <option value="F">Female</option>
                                                                        </select> 
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Civil Status <font color="red"> * </font></label>
                                                                        <select class="form-control" name="cust_org_civil" id="cust_org_civil" required>
                                                                            <option value="" disabled selected>---- Select Civil Status ----</option>
                                                                            <option value="1">Single</option>
                                                                            <option value="2">Married</option>
                                                                            <option value="3">Divorced</option>
                                                                            <option value="4">Separated</option>
                                                                            <option value="5">Widowed</option>
                                                                        </select> 
                                                                    </div>
                                                                    <div class="form-group">
                                                                          <label class="control-label">Birthday <font color="red"> * </font></label>
                                                                          <input  type="date" name="cust_org_birthday" id="cust_org_birthday" placeholder="yyyy-mm-dd" class="form-control" required/>
                                                                    </div>
                                                                    <!-- <div class="form-group">
                                                                        <label class="control-label">Fax Number</label>
                                                                        <input type="text" id="custFaxNumber" name="custFaxNumber" placeholder="" class="form-control" maxlength="25"/>
                                                                    </div> -->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <!-- <div class="form-group">
                                                                        <label class="control-label">E-mail</label>
                                                                        <input type="text" id="custEmail" name="custEmail" placeholder="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="example: abrown@gmail.com" maxlength="50" class="form-control"/>
                                                                    </div> -->
                                                                    <div class="form-group">
                                                                        <label class="control-label">Nationality <font color="red"> * </font></label>
                                                                        <input type="text" id="cust_org_nationality" name="cust_org_nationality" placeholder="" class="form-control" required maxlength="25"/> 
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="control-label">Place of Birth </label>
                                                                        <input type="text" id="cust_org_birthplace" name="cust_org_birthplace" placeholder="" class="form-control" maxlength="50"/> 
                                                                    </div>
                                                                    <!-- <div class="form-group">
                                                                        <label class="control-label">Business Phone</label>
                                                                        <input type="text" id="custBusinessPhone" name="custBusinessPhone" placeholder="" class="form-control" maxlength="25" />
                                                                    </div> -->
                                                                    <div class="form-group">
                                                                        <label class="control-label">Tax Indentification No. <font color="red"> * </font></label>
                                                                        <input type="text" id="cust_org_tin" name="cust_org_tin" placeholder="" class="form-control" maxlength="15" required /> 
                                                                        <span class="help-block"><i>Note: process Immediately</i></span>
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
                                <div class="tab-pane" id="tab_org_cont">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit" id="contact_portlet">
                                                <!-- <a type="button" href="#tab_addr" data-toggle="tab" id="cont_next" class="btn btn-circle blue nexttab" style="float: right; margin-right: 20px;"> NEXT <i class="fa fa-chevron-right" aria-hidden="true"></i></a> -->
                                                <!-- <a type="button" href="#tab_customer" data-toggle="tab" id="cont_back" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a> -->
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                        <span class="caption-subject font-blue sbold uppercase">Contact Information<font color="red"> * </font></span>
                                                        
                                                    </div> 
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <table id="cust_org_contacts" class="table table-hover">
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
                                                                            <select class="form-control select2 select2-hidden-accessible" id="cust_org_cont_type" name="cust_org_cont_type">
                                                                                <option value="1">Home Phone</option>
                                                                                <option value="2">Work Phone</option>
                                                                                <option value="3">Personal Email</option>
                                                                                <option value="4">Work Email</option>
                                                                            </select> 
                                                                        </td>
                                                                        <td><input type="text" name="cust_org_cont_value" id="cust_org_cont_value" class="form-control"></td>
                                                                        <td><a href="#" id="add_custorg_contact" class ="btn btn-info">Add</a></td>
                                                                    </tr>
                                                                </tbody>
                                                            </table>  
                                                        </div>
                                                    </div><!-- end row -->
                                                    <th>
                                                    <div id="cust_org_contlist">
                                                        <h4><b>Customer Contacts</b></h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <table class="table table-striped table-hover table-bordered dataTable no-footer" id="cust_org_contlist_table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> Contact type </th>
                                                                            <th> Value </th>
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
                                    </div>
                                </div>
                                <div class="tab-pane" id="tab_org_addr">

                                    <div id="fornew">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">Address type<font color="red"> * </font></label>
                                                    <select class="form-control select2 select2-hidden-accessible" id="cust_org_addtype" name ="cust_org_addtype">
                                                      <option class ="disabled selected">Select Here..</option>
                                                      <?php foreach($addtype as $addtype2){ ?>
                                                      <option value="<?php echo $addtype2['address_type_id'];?>"><?php echo $addtype2['address_type_name'];?></option>
                                                      <?php } ?> 
                                                  </select>  
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Street<font color="red"> * </font></label>
                                                    <input type="text" id="cust_org_street" name="cust_org_street" maxlength="35" placeholder="" class="form-control"/>   
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Barangay<font color="red"> * </font></label>
                                                    <input type="text" id="cust_org_barangay" name="cust_org_barangay" maxlength="35" placeholder="" class="form-control"/>   
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">House Number<font color="red"> * </font></label>
                                                    <input type="text" id="cust_org_houseno" name="cust_org_houseno" maxlength="35" placeholder="" class="form-control"/>   
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label class="control-label">City <font color="red"> * </font></label>
                                                    <select class="form-control select2 select2-hidden-accessible" id="cust_org_city" name ="cust_org_city">
                                                        <option value="1" class ="disabled selected">Select Here..</option>
                                                        <?php foreach($allcity as $allcity2){ ?>
                                                        <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                        <?php } ?> 
                                                    </select>   
                                                </div>     
                                                <div class="form-group">
                                                    <label class="control-label">Provice<font color="red"> * </font></label>
                                                    <select class="form-control select2 select2-hidden-accessible" id="cust_org_province" name ="cust_org_province">
                                                      <option value="1" class ="disabled selected">Select Here..</option>
                                                      <?php foreach($allprovince as $allprovince2){ ?>
                                                      <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                      <?php } ?> 
                                                    </select>   
                                                </div>
                                                <div class="form-group">
                                                    <label class="control-label">Country<font color="red"> * </font></label>
                                                    <select class="form-control select2 select2-hidden-accessible" id="cust_org_country" name ="cust_org_country">
                                                        <option value="1" class ="disabled selected">Select Here..</option>
                                                        <?php foreach($addcountry as $addcountry2){ ?>
                                                        <option value="<?php echo $addcountry2['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry2['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry2['country_name'];$addcountry2['letter_code_2'];?></option>
                                                        <?php } ?> 
                                                    </select> 
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <!-- <button type="button" id="btn_test">OK</button> -->
                            <div class="col-md-12 ">
                                <button type="submit" class="btn green-meadow pull-right" id="btn_save_orgclient" >Save Customer</button>
                                <button type="submit" class="btn green-meadow pull-right" id="btn_reserve_orgclient" >Proceed to reservation</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

<!-- NEW FORM END (ORGANIZATION) ---------------------------------------------------------------------------------- -->



<div style="" class="modal fade bs-modal-lg" id="AddCustomer" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">x</button>
                <h1 class="font-green sbold uppercase" id="">Customer Information</h1>
                <!-- <div class="actions">           
                <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a>
                </div> -->
            </div>
            <form action="" method="POST" enctype="multipart/form-data" id="allsubmit" name="CustomerInformationForm">
                 <!-- onsubmit="return ValidateForm()" -->
                <div class="modal-body">
                    <div class="" id="customer_survey" style="float: center;">
                        <h3 class="bold uppercase font-blue">Survey</h3>
                        <div class="row">
                            <div class="col-md-10">
                                <label class="bold uppercase">What Are Your Reasons for Buying?</label>
                                <table class="table">
                                    <tr>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="reason_price" value="0"> Price
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="reason_location" value="0"> Location
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="reason_design" value="0"> Structure/Design
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="reason_developer" value="0"> Developer
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="">
                                                <span></span>
                                                Others(Pls. Specify)
                                            </label>
                                                <input class="control-label" type="text" id="reason_others"> 
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>
                            <br />
                            <div class="col-md-10">
                                <label class="bold uppercase">how did you get to know about the Lot?</label>
                                <table class="table">
                                    <tr>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="source_flyers" value="0"> Flyers
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="source_refer" value="0"> Referral by a Friend/Broker
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="source_invitation" value="0"> Invitation
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="source_billboard" value="0"> Billboard/Road Signs
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                             <label class="mt-checkbox">
                                                <input type="checkbox" id="source_magazine" value="0"> Magazine/Newspapers
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="source_activity" value="0"> Weekend Activity
                                                <span></span>
                                            </label>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <label class="mt-checkbox">
                                                <input type="checkbox" id="source_online" value="0"> Online
                                                <span></span>
                                            </label>
                                        </td>
                                        <td>
                                            <label class="">
                                                <span></span>
                                                Others(Pls. Specify)
                                            </label>
                                                <input class="control-label" type="text" id="source_others"> 
                                        </td>
                                        <td></td>
                                    </tr>
                                </table>
                                
                                <button type="button" style="float: right;" class="btn green col-md-3" id="done_survey">Done</button>
                                <button type="button" style="float: right;" class="btn col-md-3" data-dismiss="modal">Cancel</button>

                            </div>
                        </div>
                    </div>
                    
                    <div class="profile" id="main_customer_info">
                        <div class="tabbable-line tabbable-full-width" id="tabs">
                            <ul class="nav nav-tabs">
                                <li class="active" id="tab1">
                                    <a href="#tab_customer" data-toggle="tab" id="tab_a"> Customer </a>
                                </li>
                                <li class="" id="tab2">
                                    <a href="#tab_cont" data-toggle="tab"> Contacts </a>
                                </li>
                                <li class="" id="tab3">
                                    <a href="#tab_addr" data-toggle="tab"> Address </a>
                                </li>
                                <li class="" id="tab4">
                                    <a href="#tab_instructions" data-toggle="tab"> Instructions </a>
                                </li>
                                <li class="" id="tab5">
                                    <a href="#tab_accounts" data-toggle="tab"> Accounts </a>
                                </li>                        
                                <li class="" id="tab6">
                                    <a href="#tab_old_acc" data-toggle="tab"> Old Account/s </a>
                                </li>
                            </ul>
                        

                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_customer">
                                    <div class="row">
                                        <div class="col-md-3">
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
                                            
                                            <div class="form-group" id="custidforedit">
                                                <!-- <label class="control-label">Personal ID</label> -->
                                                <input type="hidden" name="CustomerID" id="CustomerID" placeholder="" class="form-control"/>
                                                <input type="hidden" name="id_client" id="id_client" placeholder="" class="form-control"/>
                                            </div>
                                            <div class="form-group" style="display: none;">
                                                <div class="radio-list" data-error-container="#form_2_membership_error">
                                                    <label><input type="radio" name="custActive" value="1" /> Active </label>
                                                    <label><input type="radio" name="custActive" value="0" /> Not Active </label>
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
                                        </div>
                                        <div class="col-md-9">
                                            <div class="row">
                                                <a type="button" href="#tab_cont" data-toggle="tab" id="next1" class="btn btn-circle blue nexttab" style="float: right; margin-right: 20px;"> NEXT <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                <!-- <div class="radio-list">
                                                    <label><input type="radio" name="cust_client_type" id="cust_person" value="option1" checked=""> Person</label>
                                                    <label><input type="radio" name="cust_client_type" id="cust_org " value="option2"> Organization </label>
                                                </div> -->
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12 profile-info">
                                                    <!-- <h1 class="font-green sbold uppercase" id="customer_page_tittle"></h1> -->
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group">
                                                                <label class="control-label">Last Name<font color="red"> * </font></label>
                                                                <input type="text" id="custLname" name="custLname" placeholder="" maxlength="50" class="form-control"/>
                                                            </div>
                                                        </div>
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
                                                    </div>
                                                    <div class="form-group">
                                                        <input type="hidden" id="reason_price1" name="reason_price1">
                                                        <input type="hidden" id="reason_location1" name="reason_location1">
                                                        <input type="hidden" id="reason_design1" name="reason_design1">
                                                        <input type="hidden" id="reason_developer1" name="reason_developer1">
                                                        <input type="hidden" id="reason_others1" name="reason_others1">
                                                        <input type="hidden" id="source_flyers1" name="source_flyers1">
                                                        <input type="hidden" id="source_refer1" name="source_refer1">
                                                        <input type="hidden" id="source_invitation1" name="source_invitation1">
                                                        <input type="hidden" id="source_billboard1" name="source_billboard1">
                                                        <input type="hidden" id="source_magazine1" name="source_magazine1">
                                                        <input type="hidden" id="source_activity1" name="source_activity1">
                                                        <input type="hidden" id="source_online1" name="source_online1">
                                                        <input type="hidden" id="source_others1" name="source_others1">
                                                    </div>
                                                    <div class="row" id="old_div" style="display: none;">
                                                        <div class="col-md-8">
                                                            <input class="form-control" type="text" name="old_cust_text" id="old_cust_text" readonly="true" placeholder="'click' to select from old account.">
                                                            <!-- <input type="hidden" name="old_cust_id" id="old_cust_id" readonly=""> -->
                                                            <div style="display: none;" id="old_cust_div" style="z-index: 1000;">
                                                                <!--  <table id="old_cust_tbl">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody></tbody>
                                                                </table> -->
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <hr>

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
                                                            <div class="form-group">
                                                                  <label class="control-label">Birthday <font color="red"> * </font></label>
                                                                  <input  type="date" name="birthdate" placeholder="yyyy-mm-dd" class="form-control" id="birthdate" required/>
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label class="control-label">Fax Number</label>
                                                                <input type="text" id="custFaxNumber" name="custFaxNumber" placeholder="" class="form-control" maxlength="25"/>
                                                            </div> -->
                                                        </div>
                                                        <div class="col-md-6">
                                                            <!-- <div class="form-group">
                                                                <label class="control-label">E-mail</label>
                                                                <input type="text" id="custEmail" name="custEmail" placeholder="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="example: abrown@gmail.com" maxlength="50" class="form-control"/>
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label class="control-label">Nationality <font color="red"> * </font></label>
                                                                <input type="text" id="custNationality" name="custNationality" placeholder="" class="form-control" required maxlength="25"/> 
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">Place of Birth </label>
                                                                <input type="text" id="custPlaceOfBirth" name="custPlaceOfBirth" placeholder="" class="form-control" maxlength="50"/> 
                                                            </div>
                                                            <!-- <div class="form-group">
                                                                <label class="control-label">Business Phone</label>
                                                                <input type="text" id="custBusinessPhone" name="custBusinessPhone" placeholder="" class="form-control" maxlength="25" />
                                                            </div> -->
                                                            <div class="form-group">
                                                                <label class="control-label">Tax Indentification No. <font color="red"> * </font></label>
                                                                <input type="text" id="custTIN" name="custTIN" placeholder="" class="form-control" maxlength="15" required /> 
                                                                <span class="help-block"><i>Note: process Immediately</i></span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
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
                                                                <label class="control-label"> Job Role<!-- <font color="red"> * </font> --></label>
                                                                <input type="text" id="job_title" name="job_title" placeholder="" class="form-control" maxlength="25"/>
                                                                <!--  <select class="form-control select2 select2-hidden-accessible" id="job_role" name="job_role">
                                                                    <option value="1">Rank and File</option>
                                                                    <option value="2">Supervisor</option>
                                                                    <option value="3">Managerial</option>
                                                                    <option value="4">Executive</option>
                                                                    <option value="4">Self-employed</option>
                                                                </select>  -->
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
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2"></div>
                                        <div class="col-md-10">
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
                                                                <th> Partner id</th>
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
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_cont">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit" id="contact_portlet">
                                                <a type="button" href="#tab_addr" data-toggle="tab" id="cont_next" class="btn btn-circle blue nexttab" style="float: right; margin-right: 20px;"> NEXT <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                <a type="button" href="#tab_customer" data-toggle="tab" id="cont_back" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a>
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
                                                    <th>
                                                    <div id="cont_existing">
                                                        <h4><b>Customer Contacts</b></h4>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <table class="table table-striped table-hover table-bordered dataTable no-footer" id="cust_contact">
                                                                    <thead>
                                                                        <tr>
                                                                            <th> Contact type </th>
                                                                            <th> Value </th>
                                                                            <!-- <th> Street </th> -->
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
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab_addr">
                                    <div class="portlet light portlet-fit" id="contact_portlet">
                                        <a type="button" href="#tab_instructions" data-toggle="tab" id="addr_next" class="btn btn-circle blue nexttab" style="float: right; margin-right: 20px;"> NEXT <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                        <a type="button" href="#tab_cont" data-toggle="tab" id="addr_back" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a>
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                <span class="caption-subject font-blue sbold uppercase">Address<font color="red"> * </font></span>
                                            </div> 
                                        </div>
                                        <div class="portlet-body">
                                            <div id="fornew">
                                                <div class="row">
                                                    
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label">Address type<font color="red"> * </font></label>
                                                            <select class="form-control select2 select2-hidden-accessible" id="addtype" name ="addtype">
                                                              <option class ="disabled selected">Select Here..</option>
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
                                            </div>


                                            <div id="forexisting">
                                                <div class="row">
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
                                                                    </select>                                                
                                                                </td>
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
                                                <th>
                                                <h4><b>Customer Address</b></h4>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <table class="table table-striped table-hover table-bordered dataTable no-footer" id="cust_address">
                                                            <thead>
                                                                <tr>
                                                                    <th> Address type </th>
                                                                    <th> House Number </th>
                                                                    <th> Street </th>
                                                                    <th> Barangay </th>
                                                                    <th> City </th>
                                                                    <th> Provice </th>
                                                                    <th> Country </th>
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


                                <div class="tab-pane" id="tab_instructions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="portlet light portlet-fit" id="contact_portlet">
                                                <a type="button" href="#tab_accounts" data-toggle="tab" id="instruct_next1" class="btn btn-circle blue nexttab" style="float: right; margin-right: 20px;"> NEXT <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
                                                <a type="button" href="#tab_addr" data-toggle="tab" id="next1" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a>
                                                
                                                <div class="portlet-title">
                                                    <div class="caption">
                                                        <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                        <div><span class="caption-subject font-blue sbold uppercase">Instructions </span><i class=""><small>(If any..)</small></i></div>
                                                    </div> 
                                                </div>
                                                <div class="portlet-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="control-label">Note</label>
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
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane" id="tab_accounts">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="portlet light portlet-fit" id="contact_portlet">
                                                <a type="button" href="#tab_instructions" data-toggle="tab" id="next1" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a>
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                            <span class="caption-subject font-blue sbold uppercase">All Accounts</span>
                                                        </div> 
                                                    </div>
                                                    <div class="portlet-body">
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
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane" id="tab_old_acc">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="portlet light portlet-fit" id="contact_portlet">
                                                <a type="button" href="#tab_old_acc" data-toggle="tab" id="next1" class="btn btn-circle grey nexttab" style="float: right; margin-right: 20px;"><i class="fa fa-chevron-left" aria-hidden="true"></i> BACK </a>
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                            <!-- <i class="fa fa-home" aria-hidden="true"></i> -->
                                                            <span class="caption-subject font-blue sbold uppercase">All Accounts</span>
                                                        </div> 
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <table class="table table-hover" id="oldacc_table">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>ID</th>    
                                                                            <th>Name</th>    
                                                                            <th>Lot</th>    
                                                                            <th>TCP Amount</th>    
                                                                        </tr>
                                                                    </thead>
                                                                </table>
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
            <div class="modal-footer">
                <input type="hidden" name="cust_org_id" id="cust_org_id">
                <input type="hidden" name="cust_work_id" id="cust_work_id">
                
                <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                
                <button type="submit" name="cust_toreserve" id="cust_toreserve" class="btn green"><i class="fa fa-plus"></i>Proceed to Reservation</button>
                <button type="submit" name="custSubmit" id="custSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Customer</button>
                <button type="submit" name="custSubmitUpdate" id="custSubmitUpdate" class="btn green"><i class="fa fa-plus"></i>Save Changes</button>
                <button type="submit" name="custPartnerSave" id="custPartnerSave" class="btn green"><i class="fa fa-plus"></i>Save Partner</button>
                <button style="align:right;" type="button" class="btn btn-round green" id="pdf_report"><i class="fa fa-plus"> </i>Get PDF</button>
            </div>
            </form>
        </div>

    </div>
</div>



<!-- MODAL FOR -->


<div class="modal fade bs-modal-lg" id="" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                <h3 class="modal-title" id="">Legacy Customers List</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet light bordered">
                            <div class="portlet-title">
                                <div class="caption font-green-sharp">
                                    <span class="caption-subject bold uppercase">Lot Reservations</span>
                                </div>

                                <!-- <div class="actions col-md-3">
                                    <select class="form-control select2 select2-hidden-accessible" id="all_project" name ="all_project">
                                            <option value="0" class ="" selected>All</option>
                                            <?php foreach($all_project as $all_project){ ?>
                                              <option value="<?php echo $all_project['project_id'];?>"><?php echo $all_project['project_name'];?></option>
                                            <?php } ?>
                                    </select>
                                </div> -->
                            </div>
                            <input type="hidden" name="reserve_client_id" id="reserve_client_id">
                            <div class="portlet-body">
                                <div id="blockUis">
                                    <table id="listOfLots" class="table table-hover order-column">
                                       <thead>
                                            <tr>
                                                <th>Lot ID</th>
                                                <th>Lot Description</th>
                                                <th>Lot Area</th>
                                                <th>Price/SqrMtr</th>
                                                <th>House Price</th>
                                                <th>VAT</th>
                                                <th>Lot Price</th>
                                                <th>Action</th>
                                        </thead>
                                        <tbody>
                                              <?php foreach($lots_available as $lots){ ?>
                                                <tr>
                                                    <td><?php echo $lots['lot_id'];?></td>
                                                    <td><?php echo $lots['lot_description'];?></td>
                                                    <td><?php echo $lots['lot_area'];?></td>
                                                    <td align="right"><?php echo number_format($lots['price_per_sqr_meter']);?></td>
                                                    <td align="right"><?php echo number_format($lots['house_price']);?></td>
                                                    <td align="right"><?php echo number_format($lots['lot_vat']);?></td>
                                                    <td align="right"><?php echo number_format($lots['lot_price']); ?></td>
                                                    <td><button  class="btn green btn-xs reservelots"><i class="fa fa-check-square-o" aria-hidden="true"></i> Reserve</button>
                                                    </td>
                                                </tr>
                                             <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div align="right">
                    <button id="select_oldcust" class="btn blue">Select</button>
                    <button id="close_old" class="btn red" data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>

<!-- MODAL FOR LINK TO LEGACY DATABASE -->
<div class="modal fade bs-modal-lg" id="legacy_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                <h3 class="modal-title" id="">Legacy Customers List</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-hover" id="legacy_table">
                            <thead>
                                <th>ID</th>
                                <th>customer name</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div align="right">
                    <button id="select_oldcust" class="btn blue">Select</button>
                    <button id="close_old" class="btn red" data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>