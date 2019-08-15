<div class="page-content">
    <form class="form-horizontal" role="form" action="<@ofbizUrl>#</@ofbizUrl>" method="POST">
        <div class="row">
            <div class="col-md-12">
                <div class="tabbable-line tabbable-full-width ">
                    <ul class=" nav nav-tabs">
                        <li class="active">
                            <a href="#tab-realty" data-toggle="tab">
                                <div class="caption">
                                    <span class="caption-subject font-grey-mint bold uppercase">
                                        Realty
                                    </span>
                                </div>
                            </a>
                        </li>
                        <li class="">
                            <a href="#tab-brokers" data-toggle="tab">
                                <div class="caption">
                                    <span class="caption-subject font-grey-mint bold uppercase">
                                        Brokers
                                    </span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="tab-content">
                    <div class="tab-pane active" id="tab-realty">
                        <div class="portlet light ">
                           <div class="portlet-title">
                                <div class="caption font-green-sharp">
                                    <i class="icon-speech font-green-sharp"></i>
                                    <span class="caption-subject bold uppercase">Realty Masterlist</span>
                                </div>
                                <div class="actions">
                                    <!-- <button  type="button" class="btn green-meadow" data-toggle="modal" data-target="#enroll_realty" id="enroll_realty_btn"><span class="fa fa-plus"></span>Enroll Realty</button> -->
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="row">
                                    <div class="col-md-5">
                                        <table class="table table-hover" id="tblrealty">
                                            <thead>
                                                <tr>
                                                    <th>Realty ID</th>
                                                    <th>Realty Name</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                             <?php foreach($realty as $real){ ?>
                                            <tr>
                                                <td><?php echo $real['realty_id']; ?></td>
                                                <td><?php echo $real['organization_name'];?></td>
                                            </tr>
                                            <?php } ?>
                                            </tbody>
                                        </table>  
                                    </div>
                                    <div class="col-md-7">
                                        <div class="portlet grey-cascade box">
                                            <div class="portlet-title">
                                                <div class="caption">
                                                    <span class="caption-subject" id="realty_name"></span>
                                                </div>
                                                <div class="actions" align="right">
                                                    <!-- <button align="right" type="button" class="btn btn-default" data-toggle="modal" data-target="#enrollBroker" id="add_agent"><span class="fa fa-plus"></span> Add Agent</button>
                                                    <button align="right" type="button" class="btn btn-default" data-toggle="modal" data-target="#broker_to_agent" id="add_broker"><span class="fa fa-plus"></span> Add Broker</button> -->
                                                </div>
                                                <!-- <div class="actions" align="right">
                                                </div> -->
                                            </div>
                                            <div class="portlet-body">
                                                <div class="tabbable-line tabbable-full-width ">
                                                    <ul class="nav nav-tabs">
                                                        <li class="active">
                                                            <a href="#realty_brokers" data-toggle="tab">
                                                                <div class="caption">
                                                                    <span class="caption-subject font-grey-mint bold uppercase">
                                                                        Brokers
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                        <li class="">
                                                            <a href="#realy_agent" data-toggle="tab">
                                                                <div class="caption">
                                                                    <span class="caption-subject font-grey-mint bold uppercase">
                                                                        Agents
                                                                    </span>
                                                                </div>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content">
                                                        <div class="tab-pane" id="realy_agent">
                                                            <table class="table table-hover" id="tblrealty_agents">
                                                                <thead>
                                                                    <td>Agent ID</td>
                                                                    <td>Agent Name</td>
                                                                    <!-- <td>Action</td> -->
                                                                </thead>
                                                                <tbody>

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <div class="tab-pane active" id="realty_brokers">
                                                            <table class="table table-hover" id="tblrealty_brokers">
                                                                <thead>
                                                                    <tr>
                                                                        <td>Broker ID</td>
                                                                        <td>Broker Name</td>
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
                    <div class="tab-pane" id="tab-brokers">
                        <div class="portlet light ">
                            <div class="portlet-title">
                                <div class="caption font-green-sharp">
                                    <i class="icon-speech font-green-sharp"></i>
                                    <span class="caption-subject bold uppercase">BROKERS MASTERLIST </span>
                                </div>

                                <div class="actions">
                                    <!-- <button align="right" type="button" class="btn green-meadow" data-toggle="modal" data-target="#enrollBroker" id="enrollButton"><span class="fa fa-plus"></span>Enroll Broker</button> -->
                                <?php if ($this->session->flashdata('msg')) {?>
                                     <div id="notifications"><?php echo $this->session->flashdata('msg');?></div>
                                <?php }?>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div style="max-width:3000px; white-space: nowrap; ">
                                    <table class="table table-hover" id="tblbroker">
                                        <thead>
                                            <tr>
                                                <th>Broker ID</th>
                                                <th>Name</th>
                                                <th>Realty</th>
                                                <th>Date Enrolled</th>
                                                <th>Tax Type</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                         <?php foreach($brokers as $brok){ ?>
                                        <tr>
                                            <td><?php echo $brok['broker_id']; ?></td>
                                            <td><?php echo $brok['lastname'] . ', ' . $brok['firstname'] . ' ' . $brok['middlename'] . ' ' . $brok['suffix'];?></td>
                                            <td><?php echo $brok['organization_name']; ?></td>
                                            <td><?php echo $brok['date_created']; ?></td>
                                            <td><?php echo $brok['tax_type_name']; ?></td>
                                            <td><button type="button" class="btn-xs btn blue-dark btnViewBroker" data-toggle="modal" data-target="#viewBroker" >View Details</button></td>
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
    </form>
</div>


<!-- display info -->
<div class="modal fade bs-modal-lg" id="viewBroker" role="dialog">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"></button>
                <h1 class="modal-title">Broker Details</h1>
            </div>

            <div class="modal-body">
                <div class="row">
                    <div class='col-md-2'>
                        <img src="" id="broker_profilepic" class="img-responsive" alt="" width="200" height="200">
                    </div>
                    <div class="col-md-6">
                        <table> 
                            <tr>
                                <td><h3>Name </h3></td>
                                <td><h3> : </h3></td>
                                <td><h3><span class="font-blue-dark bold" id="broker_head"></span></h3></td>
                            </tr>
                            <tr>
                                <td><h4>Realty </h4></td>
                                <td><h4> : </h4></td>
                                <td><h4><span class="font-blue-dark bold" id="txt_company"></span></h4></td>
                            </tr>
                        </table>
                    </div>
                </div>
               <!--  <div class="row">
                    <div class="col-md-1" >
                        <h4>Realty :</h4>
                    </div>
                    <div class="col-md-4">
                        <h4><span class="font-blue-dark bold" id="txt_company"></span></h4>
                    </div>
                </div> -->
                <!-- <h3 id="broker">Name : <span class="font-blue-dark bold" id="broker_head"></span></h3>
                <h4 class="col-md-7 value">Realty : <span class="font-blue-dark bold" id="txt_company"></span></h4>  -->
                <div class="tabbable-line tabbable-full-width">
                    <ul class=" nav nav-tabs">
                        <li class="active">
                            <a href="#tab-brokerInfoView" data-toggle="tab">Broker Information</a>
                        </li>
                         <li class="">
                            <a href="#tab-agents" data-toggle="tab" id="agent_tab">Agents</a>
                        </li>
                         <li class="">
                            <a href="#tab-accounts" data-toggle="tab" id="account_tab">Accounts</a>
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
                                                <div class="col-md-7 value" id="text_tin"></div>
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
                                            
                                        </div><!-- <div class="actions">
                                                <a href="javascript:;" class="btn btn-default btn-sm" id="toggle_add_address" data-toggle="modal" data-target="#broker_address_modal">
                                                    <i class="fa fa-pencil"></i>Add Address</a>
                                            </div> -->
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-2 name" align="right" id="txt_add_type">Home: </div>
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
                                    <!-- <button type="button" class="btn green" id="editBroker"  data-toggle="modal" data-target="#enrollBroker" ><span class="fa fa-pencil-square-o"></span> Edit</button> -->
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
                                                <button align="right" type="button" class="btn btn-default" data-toggle="modal" data-target="#enrollBroker" id="addAgent"><span class="fa fa-plus"></span> Add Agent</button>
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
    <form action="" method="post" enctype="multipart/form-data" id="forminfo_submit">
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
                            <div class="row">
                                <div class="col-md-6" id="realty_opt">
                                    <div class="form-group">
                                        <label class="control-label">Realty<font color="red"> * </font></label>
                                         <select class="form-control select2 select2-hidden-accessible" id="broker_realty" name="broker_realty" required>
                                            <option value="0" selected>None</option>
                                            <?php foreach($realty as $realty){ ?>
                                            <option value="<?php echo $realty['realty_id'];?>"><?php echo $realty['organization_name'];?></option>
                                            <?php } ?> 
                                        </select>  
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6" id="broker_opt">
                                    <div class="form-group">
                                        <label class="control-label">Broker<font color="red"> * </font></label>
                                        <select class="form-control select2 select2-hidden-accessible" id="agents_broker" name="agents_broker" required>
                                            
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <div class="form-group profile-info">
                                            <div class="col-md-3">
                                                <label class="control-label">Lastname<font color="red"> * </font></label>
                                                <input type="text" id="brokerLname" name="brokerLname"  placeholder="required" maxlength="30" class="form-control" required />
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Firstname<font color="red"> * </font></label>
                                                <input type="text" id="brokerFname" name="brokerFname"  placeholder="required" maxlength="30" class="form-control" required/>
                                            </div>
                                            <div class="col-md-3">
                                                <label class="control-label">Middlename<font color="red"> * </font></label>
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
                                                <label class="control-label">Birth Date<font color="red"> * </font></label>
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
                                            <label class="control-label">Tax Type<font color="red"> * </font></label>
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
                                        <label class="control-label">Gender<font color="red"> * </font></label>
                                        <select class="form-control" name="brokerGender" id="brokerGender" required>
                                            <option value="" disabled selected>Select Gender</option>
                                            <option value="M">Male</option>
                                            <option value="F">Female</option>
                                        </select> 
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Civil Status<font color="red"> * </font></label>
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
                        <div class="row" id="broker_contact_info">
                            <div class="form-group">
                                <div class="col-md-6">
                                    <h4 class="font-blue-dark bold">Broker's Contacts</h4>
                                    <table id="contacts_table_edit" class="table table-hover">
                                       <thead>
                                            <tr>
                                                <th>Contact Type</th>
                                                <th>Contact Value</th>
                                                <!-- <th>Action</th> -->
                                            </tr>
                                        </thead>
                                        <tbody>
                                        </tbody>
                                    </table>  
                                </div>
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
                                                <!-- <button type="button" id='try1' >TRY</button> -->

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
                                                        <input type="text" class="form-control" id="brokerPostal" name="brokerPostal"/>
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2 select2-hidden-accessible" id="brokerCity" name="brokerCity" required>
                                                                <!-- <option value="998" selected>Cagayan de Oro</option> -->
                                                                <?php foreach($allcity as $allcity){ ?>
                                                            <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?></option>
                                                                <?php } ?> 
                                                        </select>                              
                                                    </td>
                                                    <td>
                                                        <select class="form-control select2 select2-hidden-accessible" id="brokerProvince" name="brokerProvince" required>
                                                                <!-- <option value="49" selected>Misamis Oriental</option> -->
                                                                <?php foreach($allprovince as $allprovince){ ?>
                                                            <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?></option>
                                                                <?php } ?> 
                                                        </select>  
                                                    </td>


                                                    <td>
                                                        <select class="form-control select2 select2-hidden-accessible" id="brokerCountry" name="brokerCountry" required>
                                                                <!-- <option value="175" selected>Philippines</option> -->
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
                                <div class="form-group" id="broker_address_info">
                                    <h4 class="font-blue-dark bold">Broker's Address</h4>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <table class="table table-striped table-hover table-bordered dataTable no-footer" id="brokerAddresst_edit" name="brokerAddresst_edit" role="grid" aria-describedby="sample_editable_1_info">
                                                <thead>
                                                    <tr role="row">
                                                        <th> Address type </th>
                                                        <th> Street </th>
                                                        <th> Barangay </th>
                                                        <th> Postal Code </th>
                                                        <th> City </th>
                                                        <th> Provice </th>
                                                        <th> Country </th>
                                                        <!-- <th> Action </th> -->
                                                    </tr>
                                                </thead>
                                                <tbody id="addressRow">
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
            <button type="button" class="btn green " id="saveBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save</button>
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
                                        <option value="998" selected="true">Cagayan de Oro</option>
                                        <?php foreach($allcity1 as $allcity){ ?>
                                            <option value="<?php echo $allcity['address_city_id'];?>"><?php echo $allcity['city_name'];?>
                                            </option>
                                        <?php } ?> 
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Province</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="realty_province" name="realty_province">
                                        <option value="49" selected="true"> Misamis Oriental</option>
                                        <?php foreach($allprovince1 as $allprovince){ ?>
                                            <option value="<?php echo $allprovince['address_province_id'];?>"><?php echo $allprovince['province_name'];?>
                                            </option>
                                        <?php } ?> 
                                    </select>  
                                </div>
                                <div class="col-md-3">
                                    <label class="control-label">Country</label>
                                    <select class="form-control select2 select2-hidden-accessible" id="realty_country" name="realty_country">
                                        <option value="175" selected="true">Philippines</option>
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



<div id="realty_agent_modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Agents Information<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
            </div>
            <div class="modal-body">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject"><i class="fa fa-info-circle" aria-hidden="true"></i>Details</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="scroller" style="position: relative; overflow: hidden; width: auto; height: 350px;">
                            <div class="row">
                                <div class="col-md-2">
                                    <img src="" id="agent_profilepic" class="img-responsive" alt="" width="200" height="200">
                                    <span class="caption font-green-sharp" id="is_broker"></span>
                                </div>
                                <div class="col-md-10">
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> Fullname: </span>
                                        <span class="col-md-9" id="txt_agent_fullname2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> Sex: </span>
                                        <span class="col-md-9" id="txt_agent_sex2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <div class="font bold col-md-3" id="txt_add_type2"></div>
                                        <div class="col-md-9" id="txt_address2"></div> 
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> Birthday: </span>
                                        <span class="col-md-9" id="txt_agent_birthday2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> Birthplace: </span>
                                        <span class="col-md-9" id="txt_agent_birthplace2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> Nationality: </span>
                                        <span class="col-md-9" id="txt_agent_nationality2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> Civil Status: </span>
                                        <span class="col-md-9" id="txt_agent_civil2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3"> TIN: </span>
                                        <span class="col-md-9" id="txt_agent_tin2"></span>
                                    </div>
                                    <div class="row static-info">
                                        <span class="font bold col-md-3" id="txt_agent_cont_type2">Contacts</span>
                                        <span class="col-md-9" id="txt_agent_cont_value2"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <!-- <button type="button" class="btn green" id="Ed" >Edit</button> -->
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" id=""><i class="fa fa-times" aria-hidden="true"></i>Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Make agent a Broker -->
<div id="broker_to_agent" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Add Broker<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
            </div>
            <div class="modal-body">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject"></span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-6" id="realty_opt">
                                <div class="form-group">
                                    <label class="control-label">Realty<font color="red"> * </font></label>
                                     <select class="form-control select2 select2-hidden-accessible" id="enroll_agentbroker" name="enroll_agentbroker" required>
                                        <option value="0" selected disabled>None</option>
                                        <?php foreach($realty2 as $realty2){ ?>
                                        <option value="<?php echo $realty2['realty_id'];?>"><?php echo $realty2['organization_name'];?></option>
                                        <?php } ?> 
                                    </select>  
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="agent_person_id" id="agent_person_id">
                        <div class="row">
                            <div class="col-md-6" id="">
                                <div class="form-group">
                                    <label class="control-label">Agent<font color="red"> * </font></label>
                                    <select class="form-control select2 select2-hidden-accessible" id="agent_to_broker" name="agent_to_broker" required>
                                        <option value="0" selected disabled>None</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <label class="control-label">Tax Type<font color="red"> * </font></label>
                                <select class="form-control" id="new_broker_taxtype" name="new_broker_taxtype">
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
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" id=""><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                <button type="button" data-dismiss="modal" class="btn green-meadow" id="save_agent_to_broker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Broker</button>
            </div>
        </div>
    </div>
</div>

