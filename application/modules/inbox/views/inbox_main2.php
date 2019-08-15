<!DOCTYPE html>
<html lang="en">
 
    <head>
        <meta charset="utf-8" />
        <title>A Brown Company, Inc.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Messages</span>

                </div>
                <div class="actions">
                    <a href="<?=base_url()?>inbox/message_form" align="right" class="btn green-meadow" id="btnAddNewUser"><span class="fa fa-plus"></span> Create Message </a>


                 <!-- <div class="actions">
                   <button align="right" type="button" class="btn green-meadow" data-toggle="modal" data-target="#enrollBroker" id="enrollButton"><span class="fa fa-plus"></span>Enroll Broker</button> -->
                    <?php if ($this->session->flashdata('msg')) {?>
                    <div id="notifications"><?php echo $this->session->flashdata('msg');?></div>
                                <?php }?>
                                </div>
                </div>               
                </div>
                <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tblbroker">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Messge ID</th>
                            <th>Date Send</th>
                            <th>Sender</th>
                            <!-- <th>Subject</th> -->
                                              
                        </tr>
                        </thead>
                      <tbody>
                        <?php foreach($users as $inbox){ ?>
                            <tr>
                                <!-- <td><a href="javascript:;"><button type="button" class="btn btn-primary btn-xs"> Read </button></a></td>
 -->
                                <td><button type="button" id = "action" class="btn-xs btn red btnViewBroker" data-toggle="modal" data-target="#viewBroker" >Read</button></td>
                                <td><?php echo $inbox['message_id']; ?></td>
                                <td><?php echo $inbox['date_sent']; ?></td>
                                <td><?php echo $inbox['sender_id']; ?></td>
                                <!-- <td><?php echo $inbox['subject']; ?></td>
                                 -->
                                
                                                             
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
        </div>
        </div>
        </div>

                    


<!-- display info -->
<div class="modal fade bs-modal-lg" id="viewBroker" role="dialog">
    <div class="modal-dialog modal-full">
     <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" disabled="" ata-dismiss="modal"></button>
                <h4 class="modal-title">Message Details</h1>
            </div>

            <div class="modal-body">
                   <div class="row">
                    <div class="col-md-2" align="right">
                        <h3 id="broker">Sender:</h3>
                        <!-- <div  class="col-md-10" align="center" id="sender_id"></div>          -->  </div>

                    <div class="col-md-4">
                        <h3><span class="font-blue-dark bold" id="sender_id"></span></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" align="right">
                        <h3>Subject:</h3>
                       <!--  <p  class="col-md-10" align="center" id="subjects"></p> -->
                    </div>

                    <div class="col-md-4" align="right">                   
                    <div class="col-md-12">
                        <h3><span class="font-blue-dark bold" id="subject"></span></h3>
                    </div>
                    </div>
                   
                    <div class="col-md-2">
                        <h4><span class="font-blue-dark bold" id="txt_company"></span></h4>
                    </div>
                </div>
                <!-- <h3 id="broker">Name : <span class="font-blue-dark bold" id="broker_head"></span></h3>
                <h4 class="col-md-7 value">Realty : <span class="font-blue-dark bold" id="txt_company"></span></h4>  -->
               
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-brokerInfoView">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                               <span class="caption-subject"></i>Message</span>   </div>
                                                 </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-1 name" align="right"> Body: </div>
                                                <!-- id:body -->
                                                <div class="col-md-7 value" id="body"> </div>
                                            </div>
                                            
                                            <!-- <div class="row static-info">
                                                <div class="col-md-5 name" align="right"> Company Name: </div>
                                                <div class="col-md-7 value" id="txtCompany"></div> 
                                            </div> -->
                                        </div>
                                  
                             
                                        </div>
                                    </div>
                                </div>

                               
                            
                                
                            <div class="row" >
                                <div class="col-md-12" align="right">                                
                                <div class="col-md-2" align="left">
                                <a href="<?=base_url()?>inbox/update" align="right" class="btn green-meadow" id="btnAddNewUser"><span class="fa fa-plus"></span> Rate </a>

                             <!--    <button type="button" class="btn btn-info" data-toggle="collapse" data-target="#demo">Rate</button></br> -->
                                <div align="left" id="demo" class="collapse">
                            <form method="post">
                                <input type="checkbox" name="urgent" value="1">Urgent</input><br/>
                                <input type="checkbox" name="star" value="2">Star</input><br/>
                                <button type="submit" name="submit" class="btn green-meadow" value="Submit">Save</button>
                            </form>

                            <?php
                            if (isset($_POST['urgent'])){
                            echo $_POST['urgent']; // Displays value of checked checkbox.
                            }
                            ?>
                              <?php
                            if (isset($_POST['star'])){
                            echo $_POST['star']; // Displays value of checked checkbox.
                            }
                            ?>
                                </div> 
                                </div>                             
                                   <!--  <button type="button" class="btn green" id="editBroker"  data-toggle="modal" data-target="#viewBroker" ><span class="fa fa-pencil-square-o"></span> Edit</button> -->
                                   <a href="<?=base_url()?>inbox/message_form" align="right" class="btn green-meadow" value = "1" id="btnAddNewUser"><span class="fa fa-plus"></span> Edit </a>
                                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button> 
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane" id="tab-agents">
                            <div class="row">
                                <div class="col-md-6">
                                <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject"><i class="fa fa-users" aria-hidden="true"></i> Agent Lists</span>
                                            </div>
                                            <div class="actions">
                                                <button align="right" type="button" class="btn btn-default" data-toggle="   modal" data-target="#enrollBroker" id="addAgent"><span class="fa fa-plus"></span> Add Agent</button>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="scroller" style="position: relative; overflow: hidden; width: auto; height: 350px;">
                                                <div class="form-group">
                                                  <!--   <div class="actions" align="right">
                                                        <button align="right" type="button" class="btn green-meadow" data-toggle="modal" data-target="#enrollBroker" id="addAgent"><span class="fa fa-plus"></span>Add Agent</button>
                                                    </div> -->
                                                    <div class="portlet-body ">
                                                        <table class="table table-hover" id="tblagents">
                                                            <thead>
                                                                <tr>
                                                                    <th>Agent ID</th>
                                                                    <th>Agent Name</th>
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
                                <div class="col-md-6">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject"><i class="fa fa-info-circle" aria-hidden="true"></i>Details</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="scroller" style="position: relative; overflow: hidden; width: auto; height: 350px;">
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Fullname: </span>
                                                    <span class="col-md-9" id="txt_agent_fullname"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Sex: </span>
                                                    <span class="col-md-9" id="txt_agent_sex"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Address: </span>
                                                    <span class="col-md-9" id="txt_agent_address"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Birthday: </span>
                                                    <span class="col-md-9" id="txt_agent_birthday"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Birthplace: </span>
                                                    <span class="col-md-9" id="txt_agent_birthplace"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Nationality: </span>
                                                    <span class="col-md-9" id="txt_agent_nationality"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> Civil Status: </span>
                                                    <span class="col-md-9" id="txt_agent_civil"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3"> TIN: </span>
                                                    <span class="col-md-9" id="txt_agent_tin"></span>
                                                </div>
                                                <div class="row static-info">
                                                    <span class="font bold col-md-3" id="txt_agent_cont_type">Contacts</span>
                                                    <span class="col-md-9" id="txt_agent_cont_value"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div class="tab-pane" id=tab-accounts>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <span class="caption-subject"><i class="fa fa-home" aria-hidden="true"></i></i>Accounts</span>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div align="right" class="col-md-11">
                                                <div class="row">
                                                    <span class="font-blue-dark bold"><i class="fa fa-money" aria-hidden="true"></i> Total Earnings : </span> 
                                                    <span align="" id="txt_total_earn"></span>
                                                </div>
                                            </div>

                                            <table id="tblcommission" class="table table-hover">
                                                <thead>
                                                    <tr>
                                                        <th>Projects</th>
                                                        <th>Client</th>
                                                        <th>Sold Date</th>
                                                        <th>TCP</th>
                                                        <th>Commission</th>
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
                <div class="modal-footer">
    <!--                 <button type="button" class="btn green" id="editBroker"  data-toggle="modal" data-target="#enrollBroker" ><span class="fa fa-pencil-square-o"></span> Edit</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button> -->
                </div>
            </div>
        </div>
    </div>
</div>



<!-- ENROLL BROKER MODAL -->

<div class="modal fade" id="enrollBroker" role="dialog" data-backdrop="static" data-keyboard="false">
    <form action="<?=base_url()?>marketing/brokers/saveBroker" method="post" enctype="multipart/form-data">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
                <h1 class="modal-title" id="enrollHeader"><i class="fa fa-users" aria-hidden="true"></i> Enroll</h1>
            </div>
        <div class="modal-body">
            <div class="tabbable-line tabbable-full-width">
                <ul class="nav nav-tabs" id="enroll-tabs">
                    <li class="active">
                        <a href="#tab-brokerInfo" id="li-brokerinfo" data-toggle="tab">Personal Information</a>
                    </li>
                     <li class="">
                        <a href="#tab-brokerCont" id="li-brokercont" data-toggle="tab">Contact Information</a>
                    </li>
                     <li class="">
                        <a href="#tab-brokerAddress" id="li-brokeraddress" data-toggle="tab">Address Information</a>
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
                            <h4 class="font-blue-dark bold">Broker's Info</h4>
                                <div class="col-md-6" id="realty_opt">
                                    <label class="control-label">Realty</label>
                                     <select class="form-control select2 select2-hidden-accessible" id="broker_realty" name="broker_realty" required>
                                        <!-- <option value="" disabled selected>Select Here..</option> -->
                                        <?php foreach($realty as $realty){ ?>
                                        <option value="<?php echo $realty['realty_id'];?>"><?php echo $realty['organization_name'];?></option>
                                        <?php } ?> 
                                    </select>  
                                </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group profile-info">
                                            <div class="col-md-3">
                                                <label class="control-label">Lastname</label>
                                                <input type="text" id="brokerLname" name="brokerLname"  placeholder="required" maxlength="30" class="form-control" required />
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
                                            <input type="text" id="brokerTIN" name="brokerTIN"  placeholder="" maxlength="30" class="form-control" />
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
                                        <select class="form-control" name="brokerCivilStatus" id="brokerCivilStatus" >
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
                                            <input type="text" id="brokerNationality" name="brokerNationality"  placeholder="" maxlength="30" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end row -->
                        </div>
                        </div>
                    </div>

                    <!-- broker Contacts -->
                    <div class="tab-pane" id="tab-brokerCont">
                        <div class="row">
                            <div class="col-md-6">
                                <table id="contacts_table" class="table table-hover">
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
                                                <select class="form-control select2 select2-hidden-accessible" id="cont_type" name="cont_type">
                                                    <!-- <option value="0" class ="selected" selected disabled>Select Here..</option> -->
                                                        <?php foreach($contact_type1 as $contact_type1){ ?>
                                                    <option value="<?php echo $contact_type1['contact_type_id'];?>"><?php echo $contact_type1['contact_type_name'];?></option>
                                                        <?php } ?> 
                                                </select> 
                                            </td>
                                            <td><input type="text" name="cont_value" id="cont_value" class="form-control"></td>
                                            <td><a href="#" id="add_contact" class ="btn btn-info">Add</a></td>
                                        </tr>
                                    </tbody>
                                </table>  
                            </div>
                        </div><!-- end row -->
                        <div class="row">
                            <div class="form-group">
                                
                            </div>
                        </div>
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
                                                                <!-- <option value="0" class ="disabled selected">Select Here..</option> -->
                                                                    <?php foreach($addtype as $addtype){ ?>
                                                                <option value="<?php echo $addtype['address_type_id'];?>"><?php echo $addtype['address_type_name'];?></option>
                                                                    <?php } ?> 
                                                            </select>  
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="brokerStreet" name="brokerStreet" />
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="brokerBarangay" name="brokerBarangay"/>
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="brokerPostal" name="brokerPostal" required/>
                                                        </td>
                                                        <td>
                                                            <select class="form-control select2 select2-hidden-accessible" id="brokerCity" name="brokerCity" required>
                                                                    <option value="998" class ="selected">Cagayan de Oro</option>
                                                                    <?php foreach($allcity as $allcity){ ?>
                                                                <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?></option>
                                                                    <?php } ?> 
                                                            </select>                              
                                                        </td>
                                                        <td>
                                                            <select class="form-control select2 select2-hidden-accessible" id="brokerProvince" name="brokerProvince" required>
                                                                    <option value="49" class ="">Misamis Oriental</option>
                                                                    <?php foreach($allprovince as $allprovince){ ?>
                                                                <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?></option>
                                                                    <?php } ?> 
                                                            </select>  
                                                        </td>


                                                        <td>
                                                            <select class="form-control select2 select2-hidden-accessible" id="brokerCountry" name="brokerCountry" required>
                                                                    <option value="175" class ="">Philippines</option>
                                                                    <?php foreach($addcountry as $addcountry){ ?>
                                                                <option value="<?php echo $addcountry['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry['country_name'];$addcountry['letter_code_2'];?></option>
                                                                    <?php } ?> 
                                                            </select> 
                                                        </td>
                                                        <td><a href = "#" id="newAddress" class ="btn btn-info">Add</a></td>
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

<div id="enroll_realty" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Enroll Realty<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
            </div>
            <form action="<?=base_url()?>marketing/brokers/save_realty" method="post">
                <div class="modal-body">
                    <div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <label class="control-label">Realty Name</label>
                                    <input type="text" id="realty_name" name="realty_name"  placeholder="required" maxlength="30" class="form-control" required/>
                                </div>
                            </div>
                        </div>
                        <hr><h4 class="font-blue-dark bold">Realty Address</h4>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                     <label class="control-label">Street</label>
                                    <input type="text" class="form-control" id="realty_street" name="realty_street"/>
                                </div>
                                <div class="col-md-3">
                                     <label class="control-label">Barangay</label>
                                    <input type="text" class="form-control" id="realty_brgy" name="realty_brgy"/>
                                </div>
                                <div class="col-md-3">
                                     <label class="control-label">Postal Code</label>
                                    <input type="text" class="form-control" id="realty_postalcode" name="realty_postalcode"/>
                                </div>                                
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group">
                                <div class="col-md-3">
                                    <label class="control-label">City</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="realty_city" name="realty_city">
                                        <option value="998" class ="selected">Cagayan de Oro</option>
                                        <?php foreach($allcity1 as $allcity){ ?>
                                            <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?>
                                            </option>
                                        <?php } ?> 
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Province</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="realty_province" name="realty_province">
                                        <option value="49" class ="">Misamis Oriental</option>
                                        <?php foreach($allprovince1 as $allprovince){ ?>
                                            <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?>
                                            </option>
                                        <?php } ?> 
                                    </select>  
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Country</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="realty_country" name="realty_country">
                                        <option value="175" class ="">Philippines</option>
                                        <?php foreach($addcountry1 as $addcountry){ ?>
                                                <option value="<?php echo $addcountry['id'];?>"><img src="<?=base_url()?>public/flags/16x16/<?php echo $addcountry['letter_code_2'];?>.png" alt="Mountain View" style=""/> <?php echo $addcountry['country_name'];$addcountry['letter_code_2'];?>
                                                </option>
                                        <?php } ?> 
                                    </select> 
                                </div>
                            </div>
                        </div>
                        <hr><h4 class="font-blue-dark bold">Realty Contact Information</h4>
                        <div class="row">
                            <div class="from-group">
                                <div class="col-md-3">
                                    <label class="control-label">Type</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="realty_contacttype" name="realty_contacttype">
                                        <!-- <option value="0" class="hide">Select Here..</option> -->
                                        <?php foreach($contact_type as $contact_type){ ?>
                                            <option value="<?php echo $contact_type['contact_type_id'];?>"><?php echo $contact_type['contact_type_name'];?>
                                            </option>
                                        <?php } ?> 
                                    </select>  
                                </div>
                                <div class="col-md-4">
                                    <label class="control-label">Contact</label>
                                    <input type="text" class="form-control" id="realty_contact" name="realty_contact"/>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn green" id="save_realty" >Save</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id=""><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                </div>
             </form>
        </div>
    </div>
</div>