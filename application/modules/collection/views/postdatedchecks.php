<div class="col-md-12">
    <div class="portlet light " id="bankslists">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="fa fa-money font-green-sharp"></i>
                <span class="caption-subject bold uppercase"> Post Dated Checks</span>
            </div>
            <div class="actions">
                <a class="btn circle blue hidden-print" data-toggle="modal" data-target="#singleModal" id="single">Add Single Check
                <i class="fa fa-plus"></i></a>
                <a class="btn circle blue hidden-print"  data-toggle="modal" data-target="#multipleModal" id="multiple">Add Multiple Check
                <i class="fa fa-plus"></i></a>
            </div>
        </div>
        <div class="portlet-body"> 
            <div class="row">
                <div class="col-md-1">
                    
                </div>         
                <div class="col-md-1">
                    <h5><b>From: </b></h5>
                </div>
                <div class="col-md-3">
                    <input  type="date" name="surchargeDate" placeholder="yyyy-mm-dd" class="form-control" id="fromDate" required />
                </div>
                <div class="col-md-1">
                    <h5><b>To: </b></h5>
                </div>
                <div class="col-md-3">
                    <input  type="date" name="surchargeDate" placeholder="yyyy-mm-dd" class="form-control" id="toDate" required />
                </div>
                <div class="3">
                    <button style="align: center;" type="button" class="btn btn-circle green" id="generate">Generate</button>
                </div>
            </div>
            <br>
        </div> 
    </div>
</div>

<div class="col-md-12" id="postdatedchecksdiv" style="display: none;">
    <div class="portlet light ">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="fa fa-money font-green-sharp"></i>
                <span class="caption-subject bold uppercase" id="text1"> Post Dated Checks</span>
            </div>
            <div class="actions">
                <a class="btn circle blue hidden-print"  id="excel1">Generate Report
                <i class="fa fa-file-excel-o"></i></a>
                <a class="btn circle blue hidden-print"  id="excel2">Generate Report
                <i class="fa fa-file-excel-o"></i></a>
                <a class="btn circle blue hidden-print"  id="print1">Print
                <i class="fa fa-print"></i></a>
                <a class="btn circle blue hidden-print"  id="print2">Print
                <i class="fa fa-print"></i></a>
            </div>
        </div>
        <div class="portlet-body"> 
            <div class="row">
                <div class="col-md-3">
                    <h4 class="control-label">Project<font color="red"> * </font></h4>
                    <select class="form-control select2 select2-hidden-accessible" id="project" name ="project" required>
                        <option value="0" class ="disabled selected">Select Here..</option>
                        <?php foreach ($projects as $p){?>
                        <option value="<?php echo $p['project_id'];?>"><?php echo $p['project_description'];?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-9">
                </div>
            </div>
            <br>
            <table class="tblpostdatedchecks table table-hover" id="tblpostdatedchecks">
                <thead>
                    <tr>
                        <th>Customer</th>
                        <th>Check Date</th>
                        <th>Source Bank</th>
                        <th>Check Number</th>
                        <th>Check Amount</th>
                        <th>Destination Bank</th>
                    </tr>
                </thead>
                <tbody id="tbody_rp">
                    
                </tbody>
            </table>
        </div> 
    </div>
    
</div>
<a href="<?php echo base_url(); ?>/reports/PostdatedChecks.xls" style="display: none;"><input type="button" id="excel1trigger" value="Test" class="btn btn-success"></a>
<a href="<?php echo base_url(); ?>/reports/PostdatedChecks.xls" style="display: none;"><input type="button" id="excel2trigger" value="Test" class="btn btn-success"></a>
<a href="<?php echo base_url(); ?>/reports/PostdatedChecks.pdf" style="display: none;"><input type="button" id="print1trigger" value="Test" class="btn btn-success"></a>
<a href="<?php echo base_url(); ?>/reports/PostdatedChecks.pdf" style="display: none;"><input type="button" id="print2trigger" value="Test" class="btn btn-success"></a>
<div style="" class="modal fade bs-modal-lg" id="singleModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-full" style="height: 200px; width: 1000px;">
        <div class="modal-content">
        <form action="" method="POST" id="bankForm" name="bankForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="hidden-print tabbable-line tabbable-full-width">
                                <ul class="nav nav-tabs">
                                    <li class="active" id="tab1">
                                        <li class="active" id="tab1">
                                            <a href="#tab_customer" data-toggle="tab"> Customers </a>
                                        </li>
                                        <li class="" id="tab2">
                                            <a href="#tab_org" data-toggle="tab"> Organizations </a>
                                        </li> 
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="tab" style="height: 100%;">
                                <div class="tab-pane active" id="tab_customer" style="height: 100%;">
                                    <div class="portlet light">
                                        <div class="row">
                                            <table class="tblcustomers table table-hover" id="tblcustomers" >
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Customer ID</th>
                                                        <th>Customer Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($customers as $customers){ ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $customers['custID'];?></td>
                                                        <td><?php echo $customers['firstname'].' '.$customers['middlename'].' '.$customers['lastname'];?></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                        
                                </div>
                                <div class="tab-pane" id="tab_org" style="height: 100%;">
                                    <div class="portlet light" style="">
                                        <div class="row"> 
                                            <table class="tblorg table table-hover" id="tblorg" >
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Organization ID</th>
                                                        <th>Organization</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($organizations as $org){ ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $org['custID'];?></td>
                                                        <td><?php echo $org['organization_name'];?></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="portlet grey-cascade box " id="bankslists">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-money"></i>
                                            <span class="caption"> Check Details</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">          
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Customer/Organization Name :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 id="custName"></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Check Amount :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" id="checkamount" name="checkamount"  placeholder="0" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Check Number :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="checknumber" name="checknumber"  placeholder="0" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Check Date :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input  type="date" name="checkdate" placeholder="yyyy-mm-dd" class="form-control" id="checkdate" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Destination Bank:</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control select2 select2-hidden-accessible" id="destbank1" name ="destbank1">
                                                    <option value="0" class ="disabled selected">Select Bank..</option>
                                                    <?php foreach($allbanks as $a){ ?>
                                                    <option value="<?php echo $a['bank_id'];?>"><?php echo $a['bank_name'];?></option>
                                                    <?php } ?> 
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Source Bank:</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control select2 select2-hidden-accessible" id="sourcebank1" name ="sourcebank1">
                                                    <option value="0" class ="disabled selected">Select Bank..</option>
                                                    <?php foreach($allbanks2 as $a){ ?>
                                                    <option value="<?php echo $a['bank_id'];?>"><?php echo $a['bank_name'];?></option>
                                                    <?php } ?> 
                                                </select> 
                                            </div>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
                <div class="row">
                    <div class="modal-footer">
                        <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                        <button type="button" id="saveSingle" class="btn green hidden-print">Save</button>
                    </div>
                </div>
            </div>   
        </form>        
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="multipleModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true" >
    <div class="modal-dialog modal-full" style="height: 200px; width: 1000px;">
        <div class="modal-content">
        <form action="" method="POST" id="bankForm" name="bankForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="hidden-print tabbable-line tabbable-full-width">
                                <ul class="nav nav-tabs">
                                    <li class="active" id="tab1">
                                        <li class="active" id="tab1">
                                            <a href="#tab_customer" data-toggle="tab"> Customers </a>
                                        </li>
                                        <li class="" id="tab2">
                                            <a href="#tab_org" data-toggle="tab"> Organizations </a>
                                        </li> 
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content" id="tab" style="height: 100%;">
                                <div class="tab-pane active" id="tab_customer" style="height: 100%;">
                                    <div class="portlet light">
                                        <div class="row">
                                            <table class="tblcustomers2 table table-hover" id="tblcustomers2" >
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Customer ID</th>
                                                        <th>Customer Name</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($customers2 as $customers){ ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $customers['custID'];?></td>
                                                        <td><?php echo $customers['firstname'].' '.$customers['middlename'].' '.$customers['lastname'];?></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                        
                                </div>
                                <div class="tab-pane" id="tab_org" style="height: 100%;">
                                    <div class="portlet light" style="">
                                        <div class="row"> 
                                            <table class="tblorg2 table table-hover" id="tblorg2" >
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Organization ID</th>
                                                        <th>Organization</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php foreach($organizations2 as $org){ ?>
                                                    <tr>
                                                        <td style="display: none;"><?php echo $org['custID'];?></td>
                                                        <td><?php echo $org['organization_name'];?></td>
                                                    </tr>
                                                    <?php }?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>                        
                                </div>
                            </div>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                                <div class="portlet grey-cascade box " id="checkdetails">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-money"></i>
                                            <span class="caption"> Check Details</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">          
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Customer/Organization Name :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 id="custName2"></h5>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Check Amount :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="number" id="checkamount2" name="checkamount2"  placeholder="0" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Check Number :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input type="text" id="checknumber2" name="checknumber2"  placeholder="0" maxlength="30" class="form-control" required/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Check Date :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <input  type="date" name="checkdate2" placeholder="yyyy-mm-dd" class="form-control" id="checkdate2" required />
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Destination Bank:</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control select2 select2-hidden-accessible" id="destbank2" name ="destbank2">
                                                    <option value="0" class ="disabled selected">Select Bank..</option>
                                                    <?php foreach($allbanks3 as $a){ ?>
                                                    <option value="<?php echo $a['bank_id'];?>"><?php echo $a['bank_name'];?></option>
                                                    <?php } ?> 
                                                </select> 
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Source Bank:</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <select class="form-control select2 select2-hidden-accessible" id="sourcebank2" name ="sourcebank2">
                                                    <option value="0" class ="disabled selected">Select Bank..</option>
                                                    <?php foreach($allbanks4 as $a){ ?>
                                                    <option value="<?php echo $a['bank_id'];?>"><?php echo $a['bank_name'];?></option>
                                                    <?php } ?> 
                                                </select> 
                                            </div>
                                        </div>
                                        <br>
                                        <div class="row">
                                            <button style="float: right;" type="button" class="btn btn-circle green" id="add"><i class="fa fa-plus"></i> Add Check</button>
                                        </div>
                                    </div> 
                                </div>
                            </div>
                            <div class="row">
                                <div class="portlet grey-cascade box " id="checkdetails2">
                                    <div class="portlet-title">
                                        <div class="caption">
                                            <i class="fa fa-money"></i>
                                            <span class="caption"> Postdated Checks</span>
                                        </div>
                                    </div>
                                    <div class="portlet-body">  
                                        <table class="tblchecks table table-hover" id="tblchecks">
                                            <thead>
                                                <tr>
                                                    <th>Check Amount</th>
                                                    <th>Check Number</th>
                                                    <th>Check Date</th>
                                                    <th>Destination Bank</th>
                                                    <th>Source Bank</th>
                                                    <th>&nbsp</th>
                                                </tr>
                                            </thead>
                                            <tbody id="tbody_tblchecks">
                                      
                                            </tbody>
                                        </table>        
                                        
                                    </div> 
                                </div>
                            </div>
                        </div>     
                    </div>
                </div>
                <div class="row">
                    <div class="modal-footer">
                        <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                        <button type="button" id="saveMultiple" class="btn green hidden-print">Save</button>
                    </div>
                </div>
            </div>   
        </form>        
        </div>
    </div>
</div>

