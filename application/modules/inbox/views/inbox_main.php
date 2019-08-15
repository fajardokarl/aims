<!DOCTYPE html>
<html lang="en">
 
    <head>
        <meta charset="utf-8" />
        <title>A Brown Company, Inc.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        
    <!-- END HEAD -->



<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Messages</span>

                </div>
                <div class="actions">
                    <a href="<?=base_url()?>inbox/message_form" align="right" class="btn btn-circle btn-default" id="btnAddNewUser"><span class="fa fa-plus"></span> Reload </a>
                </div>  
               

                </div>
                
                   <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tbluser">

                      <tbody>

                        <?php if (empty($unreads)) : ?>
                            <tr><td colspan="3" align="center" >No unread emails found.</td></tr>
                        <?php else: ?>
                          <?php foreach($unreads as $unread){ ?>
                              <tr>
                                  <!-- <td><a href="javascript:;"><button type="button" class="btn btn-primary btn-xs"> Read </button></a></td>-->
                                  <td style="width: 15%;" aria-valuetext=""><b><?php echo $unread['firstname'].' '.$unread['lastname']; ?></b></td>
                                  <td style="width: 20%;"><b><?php echo $unread['subject']; ?></b></td>
                                  <td style="width: 10%;"><?php echo $unread['forward_uri']; ?></td>
                                  <td style="width: 25%;"><?php echo $unread['body']; ?></td>
                                  <td style="width: 10%;"><b><?php echo $unread['date_sent']; ?></b></td>

                              </tr>
                          <?php } ?>
                        <?php endif; ?>

                        <?php foreach($mails as $mail){ ?>
                            <tr>
                                <!-- <td><a href="javascript:;"><button type="button" class="btn btn-primary btn-xs"> Read </button></a></td>-->
                                <td style="width: 15%;"><?php echo $mail['firstname'].' '.$mail['lastname']; ?></td>
                                <td style="width: 30%;"><?php echo $mail['subject']; ?></td>
                                <td style="width: 10%;"><?php echo $mail['forward_uri']; ?></td>
                                <td style="width: 25%l"><?php echo $mail['body']; ?></td>
                                <td style="width: 10%; text-align: right"><?php echo $mail['date_sent']; ?></td>

                            </tr>
                        <?php } ?>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
        <!-- END Portlet PORTLET-->
    </div>
</div>



<!-- display info --> 
<div class="modal fade bs-modal-lg" id="modalAddNewUser" role="dialog">
    <form action="<?=base_url()?>login/users/update_user" method="post">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h2 class="modal-title" ><i class="fa fa-users" aria-hidden="true"></i> Add New User</h2>
                </div>
                <div class="modal-body">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-brokerInfo" id="li-userinfo" data-toggle="tab">Personal Information</a>
                            </li>
                            <li class="">
                                <a href="#tab-brokerCont" id="li-brokerCont" data-toggle="tab">Contact Information</a>
                            </li>
                            <li class="">
                                <a href="#tab-brokerAddress" id="li-brokerAddress" data-toggle="tab">Address Information</a>
                            </li>
                        </ul>
                        <!-- tab begin -->
                        <div class="tab-content">
                            <!-- broker Information -->
                            <div class="tab-pane active" id="tab-brokerInfo">
                                <!-- here -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="from-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
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
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="broker_person_id" name="broker_person_id" value="">
                                            <input type="hidden" class="    form-control" id="broker_id" name="broker_id" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <h4 class="font-blue-dark bold">Person Name</h4>
                                        <div class="col-md-6" id="realty_opt">
                                            <label class="control-label">Realty</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="broker_realty" name="broker_realty" required>
                                                <!-- <option value="" disabled selected>Select Here..</option> -->
                                                <?php foreach($realty as $realty){ ?>
                                                    <option value="<?php echo $realty['realty_id'];?>"><?php echo $realty['organization_name'];?>
                                                    </option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group profile-info">
                                                        <div class="col-md-3">
                                                            <label class="control-label">Lastname</label>
                                                            <input type="text" id="brokerLname" name="brokerLname"  placeholder="required" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Firstname</label>
                                                            <input type="text" id="brokerFname" name="brokerFname"  placeholder="required" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Middlename</label>
                                                            <input type="text" id="brokerMname" name="brokerMname"  placeholder="required" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Name Extension</label>
                                                            <input type="text" id="brokerExt" name="brokerExt"  placeholder="" maxlength="30" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group profile-info">
                                                        <!-- <div class="col-md-6">
                                                            <label class="control-label">Company Name</label>
                                                            <input type="text" id="brokerCompany" name="brokerCompany"  placeholder="" maxlength="60" class="form-control"/>
                                                        </div> -->
                                                        <!--  <div class="col-md-3">
                                                             <label class="control-label">Occupation</label>
                                                             <input type="text" id="brokerOcc" name="brokerOcc"  placeholder="" maxlength="60" class="form-control"/>
                                                         </div> -->
                                                        <div class="col-md-3">
                                                            <div data-date-format="mm/dd/yyyy" >
                                                                <label class="control-label">Birth Date</label>
                                                                <input  type="date" name="birthdate" class="form-control" id="birthdate" maxlength="10" required/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Place of Birth</label>
                                                            <input type="text" id="brokerPlaceBirth" name="brokerPlaceBirth"  placeholder="" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">TIN</label>
                                                            <input type="text" id="brokerTIN" name="brokerTIN"  placeholder="" maxlength="30" class="form-control"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Tax Type</label>
                                                            <select class="form-control" id="brokerVatType" name="brokerVatType">
                                                                <option value="" disabled selected>Select Here..</option>
                                                                <option value="1">VAT</option>
                                                                <option value="2">Non-VAT</option>
                                                                <option value="3">VAT Exempt</option>
                                                                <option value="4">Zero Rated</option>
                                                                <option value="5">eVAT</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end row -->

                                        <div class="row">
                                            <div class="col-md-12">

                                                <div class="col-md-3">
                                                    <label class="control-label">Gender</label>
                                                    <select class="form-control" name="brokerGender" id="brokerGender" required>
                                                        <option value="" disabled selected>Select Gender</option>
                                                        <option value="M">Male</option>
                                                        <option value="F">Female</option>
                                                    </select>
                                                </div>
                                                <div class="col-md-3">
                                                    <label class="control-label">Civil Status</label>
                                                    <select class="form-control" name="brokerCivilStatus" id="brokerCivilStatus" required>
                                                        <option value="" disabled selected>Select Civil Status</option>
                                                        <option value="1">Single</option>
                                                        <option value="2">Married</option>
                                                        <option value="3">Separated</option>
                                                        <option value="4">Divorced</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <label class="control-label">Nationality</label>
                                                        <input type="text" id="brokerNationality" name="brokerNationality"  placeholder="" maxlength="30" class="form-control" required/>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end row -->
                                    </div>
                                </div>
                            </div><!-- end tab -->


                            <!-- broker Contacts -->
                            <div class="tab-pane" id="tab-brokerCont">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-blue-dark bold">Broker's Contact Information</h4>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label">Home Phone</label>
                                                    <input type="text" class="form-control" name="brokerHomePhone" id="brokerHomePhone" ></input>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Work Phone</label>
                                                    <input type="text" class="form-control" name="brokerWorkPhone" id="brokerWorkPhone" ></input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label">Personal Email</label>
                                                    <input type="email" class="form-control" name="brokerPersonalEmail" id="brokerPersonalEmail" ></input>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Work Email</label>
                                                    <input type="email" class="form-control" name="brokerWorkEmail" id  ="brokerWorkEmail" ></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end row -->
                            </div>

<!-- Modal for view messages -->

<div class="modal fade bs-modal-lg" id="viewBroker" role="dialog">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"></button>
                <h1 class="modal-title">Broker Details</h1>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class="col-md-1" align="right">
                        <h3 id="broker">Name :</h3>
                    </div>
                    <div class="col-md-4">
                        <h3><span class="font-blue-dark bold" id="broker_head"></span></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-1" align="right">
                        <h4>Realty :</h4>
                    </div>
                    <div class="col-md-4">
                        <h4><span class="font-blue-dark bold" id="txt_company"></span></h4>
                    </div>
                </div>
                <!-- <h3 id="broker">Name : <span class="font-blue-dark bold" id="broker_head"></span></h3>
                <h4 class="col-md-7 value">Realty : <span class="font-blue-dark bold" id="txt_company"></span></h4>  -->
                <div class="tabbable-line tabbable-full-width">
                    <ul class=" nav nav-tabs">
                        <li class="active">
                            <a href="#tab-brokerInfoView" data-toggle="tab">Read Message</a>
                        </li>
                         <!-- <li class="">
                            <a href="#tab-agents" data-toggle="tab" id="agent_tab">Agents</a>
                        </li>
                         <li class="">
                            <a href="#tab-accounts" data-toggle="tab" id="account_tab">Accounts</a> -->
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-brokerInfoView">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject"></i>Personal Information</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name" align="right"> Date Created: </div>
                                                <div class="col-md-7 value" id="txtDateCreated"> </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"  align="right"> Broker ID </div>
                                                <div class="col-md-7 value" id="txtBrokerID"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"  align="right"> Full Name: </div>
                                                <div class="col-md-7 value" id="txtLastname"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"  align="right"> Nationality: </div>
                                                <div class="col-md-7 value" id="txtNationality"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"  align="right"> Birthdate: </div>
                                                <div class="col-md-7 value" id="txtBday"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"  align="right"> Birthplace: </div>
                                                <div class="col-md-7 value" id="txtBplace"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name" align="right" id="txtDateCreated"> Civil Status: </div>
                                                <div class="col-md-7 value" id="txtCivilStatus"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name" align="right"> TIN: </div>
                                                <div class="col-md-7 value" id="txtTIN"></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name" align="right"> Tax Type: </div>
                                                <div class="col-md-7 value" id="txtTaxType"></div> 
                                            </div>
                                            <!-- <div class="row static-info">
                                                <div class="col-md-5 name" align="right"> Company Name: </div>
                                                <div class="col-md-7 value" id="txtCompany"></div> 
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject"></i>Address</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right" id="txt_add_type">Home: </div>
                                                <div class="col-md-9 value" id="txt_address"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject"></i>Contacts</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right" id="txt_cont_type">Contacts</div>
                                                <div class="col-md-9 value" id="txt_contacts"></div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" >
                                <div class="col-md-12" align="right">
                                    <button type="button" class="btn green" id="editBroker"  data-toggle="modal" data-target="#enrollBroker" ><span class="fa fa-pencil-square-o"></span> Edit</button>
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline"ss id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button> 
                                </div>
                            </div>
                        </div>

                      
                <div class="modal-footer">
    <!--                 <button type="button" class="btn green" id="editBroker"  data-toggle="modal" data-target="#enrollBroker" ><span class="fa fa-pencil-square-o"></span> Edit</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button> -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- End of Modal for view messages -->



                            <!-- broker Address -->
                            <div class="tab-pane" id="tab-brokerAddress">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h4 class="font-blue-dark bold">Broker's Address</h4>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <table class="table table-striped table-hover table-bordered dataTable no-footer" id="brokerAddresst" name="brokerAddresst" role="grid" aria-describedby="sample_editable_1_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th >.</th>
                                                            <th> Address type </th>
                                                            <th> Street </th>
                                                            <th> Barangay </th>
                                                            <th> Postal Code </th>
                                                            <th> City </th>
                                                            <th> Provice </th>
                                                            <th> Country </th>
                                                            <th> Action </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="addressRow">
                                                        <tr>
                                                            <td>.<input type="hidden" id="id_address" value="" ></td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="BrokerAddType" name="BrokerAddType">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($addtype as $addtype){ ?>
                                                                        <option value="<?php echo $addtype['address_type_id'];?>"><?php echo $addtype['address_type_name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="brokerStreet" name="brokerStreet"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="brokerBarangay" name="brokerBarangay"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="brokerPostal" name="brokerPostal"/>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="brokerCity" name="brokerCity">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($allcity as $allcity){ ?>
                                                                        <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="brokerProvince" name="brokerProvince">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($allprovince as $allprovince){ ?>
                                                                        <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="brokerCountry" name="brokerCountry">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($addcountry as $addcountry){ ?>
                                                                        <option value="<?php echo $addcountry['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry['country_name'];$addcountry['letter_code_2'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td><a href = "#" id="newAddress" class ="btn btn-info hidden">Add</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table><!-- end address table -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                           </div>
                           </div>
                           </div>
                           </div>
                           </div>

                <div class="modal-footer">
                    <button type="submit" class="btn green " id="saveBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save</button>
                    <button type="button" class="btn green " id="updateBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Changes</button>
                    <button type="button" class="btn green " id="saveAgent"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Agent</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                </div>
            </div>
        </div>
    </form>
</div>



<!-- ENROLL BROKER MODAL -->

<div class="modal fade" id="enrollBroker" role="dialog" data-backdrop="static" data-keyboard="false">
    <form action="<?=base_url()?>marketing/brokers/saveBroker" method="post">
        <div class="modal-dialog modal-full">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h1 class="modal-title" id="enrollHeader"><i class="fa fa-users" aria-hidden="true"></i> Enroll</h1>
                </div>
                <div class="modal-body">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active">
                                <a href="#tab-brokerInfo" id="li-brokerInfo" data-toggle="tab">Personal Information</a>
                            </li>
                            <li class="">
                                <a href="#tab-brokerCont" id="li-brokerCont" data-toggle="tab">Contact Information</a>
                            </li>
                            <li class="">
                                <a href="#tab-brokerAddress" id="li-brokerAddress" data-toggle="tab">Address Information</a>
                            </li>
                        </ul>
                        <!-- tab begin -->
                        <div class="tab-content">
                            <!-- broker Information -->
                            <div class="tab-pane active" id="tab-brokerInfo">
                                <!-- here -->
                                <div class="row">
                                    <div class="col-md-2">
                                        <div class="from-group">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 200px; height: 150px;"> </div>
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
                                        <div class="form-group">
                                            <input type="hidden" class="form-control" id="broker_person_id" name="broker_person_id" value="">
                                            <input type="hidden" class="form-control" id="broker_id" name="broker_id" value="">
                                        </div>
                                    </div>
                                    <div class="col-md-10">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group profile-info">
                                                        <h4 class="font-blue-dark bold">Broker's Info</h4>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Lastname</label>
                                                            <input type="text" id="brokerLname" name="brokerLname"  placeholder="required" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Firstname</label>
                                                            <input type="text" id="brokerFname" name="brokerFname"  placeholder="required" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Middlename</label>
                                                            <input type="text" id="brokerMname" name="brokerMname"  placeholder="required" maxlength="30" class="form-control" required/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Name Extension</label>
                                                            <input type="text" id="brokerExt" name="brokerExt"  placeholder="" maxlength="30" class="form-control" />
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group profile-info">
                                                        <div class="col-md-6">
                                                            <label class="control-label">Company Name</label>
                                                            <input type="text" id="brokerCompany" name="brokerCompany"  placeholder="" maxlength="60" class="form-control"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">Occupation</label>
                                                            <input type="text" id="brokerOcc" name="brokerOcc"  placeholder="" maxlength="60" class="form-control"/>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <label class="control-label">TIN</label>
                                                            <input type="text" id="brokerTIN" name="brokerTIN"  placeholder="" maxlength="30" class="form-control"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end row -->

                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <div data-date-format="mm/dd/yyyy" >
                                                            <label class="control-label">Birth Date</label>
                                                            <input  type="date" name="birthdate" class="form-control" id="birthdate" maxlength="10" required/>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label">Place of Birth</label>
                                                        <input type="text" id="brokerPlaceBirth" name="brokerPlaceBirth"  placeholder="" maxlength="30" class="form-control" required/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label">Gender</label>
                                                        <select class="form-control" name="brokerGender" id="brokerGender" required>
                                                            <option value="" disabled selected>Select Gender</option>
                                                            <option value="M">Male</option>
                                                            <option value="F">Female</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label">Civil Status</label>
                                                        <select class="form-control" name="brokerCivilStatus" id="brokerCivilStatus" required>
                                                            <option value="" disabled selected>Select Civil Status</option>
                                                            <option value="1">Single</option>
                                                            <option value="2">Married</option>
                                                            <option value="3">Separated</option>
                                                            <option value="4">Divorced</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div><!-- end row -->


                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="col-md-3">
                                                        <label class="control-label">Nationality</label>
                                                        <input type="text" id="brokerNationality" name="brokerNationality"  placeholder="" maxlength="30" class="form-control" required/>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="control-label">Tax Type</label>
                                                        <select class="form-control" id="brokerVatType" name="brokerVatType" reqiured>
                                                            <option  disabled selected>Select Here..</option>
                                                            <option value="1">VAT</option>
                                                            <option value="2">Non-VAT</option>
                                                            <option value="3">VAT Exempt</option>
                                                            <option value="4">Zero Rated</option>
                                                            <option value="5">eVAT</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> <!-- end row -->
                                    </div>

                                </div>
                            </div><!-- end tab -->


                            <!-- broker Contacts -->
                            <div class="tab-pane" id="tab-brokerCont">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="font-blue-dark bold">Broker's Contact Information</h4>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label">Home Phone</label>
                                                    <input type="text" class="form-control" name="brokerHomePhone" id="brokerHomePhone" ></input>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Work Phone</label>
                                                    <input type="text" class="form-control" name="brokerWorkPhone" id="brokerWorkPhone" ></input>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="form-group">
                                                <div class="col-md-4">
                                                    <label class="control-label">Personal Email</label>
                                                    <input type="email" class="form-control" name="brokerPersonalEmail" id="brokerPersonalEmail" ></input>
                                                </div>
                                                <div class="col-md-4">
                                                    <label class="control-label">Work Email</label>
                                                    <input type="email" class="form-control" name="brokerWorkEmail" id  ="brokerWorkEmail" ></input>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- end row -->
                            </div>



                            <!-- broker Address -->
                            <div class="tab-pane" id="tab-brokerAddress">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h4 class="font-blue-dark bold">Broker's Address</h4>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <table class="table table-striped table-hover table-bordered dataTable no-footer" id="brokerAddresst" name="brokerAddresst" role="grid" aria-describedby="sample_editable_1_info">
                                                        <thead>
                                                        <tr role="row">
                                                            <th >.</th>
                                                            <th> Address type </th>
                                                            <th> Street </th>
                                                            <th> Barangay </th>
                                                            <th> Postal Code </th>
                                                            <th> City </th>
                                                            <th> Provice </th>
                                                            <th> Country </th>
                                                            <th> Action </th>
                                                        </tr>
                                                        </thead>
                                                        <tbody id="addressRow">
                                                        <tr>
                                                            <td>.<input type="hidden" id="id_address" value="" ></td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="BrokerAddType" name="BrokerAddType">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($addtype as $addtype){ ?>
                                                                        <option value="<?php echo $addtype['address_type_id'];?>"><?php echo $addtype['address_type_name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="brokerStreet" name="brokerStreet"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="brokerBarangay" name="brokerBarangay"/>
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="brokerPostal" name="brokerPostal"/>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="brokerCity" name="brokerCity">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($allcity as $allcity){ ?>
                                                                        <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="brokerProvince" name="brokerProvince">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($allprovince as $allprovince){ ?>
                                                                        <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-control select2 select2-hidden-accessible" id="brokerCountry" name="brokerCountry">
                                                                    <!-- <option value="0" class ="">Select Here..</option> -->
                                                                    <?php foreach($addcountry as $addcountry){ ?>
                                                                        <option value="<?php echo $addcountry['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry['country_name'];$addcountry['letter_code_2'];?></option>
                                                                    <?php } ?>
                                                                </select>
                                                            </td>
                                                            <td><a href = "#" id="newAddress" class ="btn btn-info hidden">Add</a></td>
                                                        </tr>
                                                        </tbody>
                                                    </table><!-- end address table -->
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                            </div>
                        </div>  <!-- all tab -->
                    </div>
                </div> <!-- end modal body -->
                <div class="modal-footer">
                    <button type="submit" class="btn green " id="saveBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save</button>
                    <button type="button" class="btn green " id="updateBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Changes</button>
                    <button type="button" class="btn green " id="saveAgent"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Agent</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- end modal -->
<!-- <div class="modal fade" id="enroll_realty" role="dialog" data-backdrop="static" data-keyboard="false">
    <form action="<?=base_url()?>marketing/brokers/save_realty" method="post">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-title">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                    <h4 class="modal-title" id="enrollHeader"><i class="fa fa-users" aria-hidden="true"></i> Enroll Realty</h4>
                </div>
                <div class="modal-body">
                   <div class="row">
                       <div class="portlet">
                           <div class="portlet-title">

                           </div>
                       </div>
                   </div>
                </div>
            </div>
        </div>
    </form>
</div>
 -->
<div id="enroll_realty" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button>
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Lot<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4>
            </div>
            <form id="updateLot">
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="update_lot" ></span>Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                </div>
            </form>
        </div>
    </div>
</div>