<div class="row hidden-print">
        <div class="col-md-4">
            <div class="hidden-print tabbable-line tabbable-full-width">
                <ul class="nav nav-tabs">
                    <li class="active" id="tab1">
                        <li class="active" id="tab1">
                            <a href="#tab_customer" data-toggle="tab"> Customers </a>
                        </li>
                        <li class="" id="tab1">
                            <a href="#tab_lots" data-toggle="tab"> Lots </a>
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
                                        <td style="display: none;"><?php echo $customers['client_id'];?></td>
                                        <td><?php echo $customers['firstname'].' '.$customers['middlename'].' '.$customers['lastname'];?></td>
                                    </tr>
                                    <?php }?>
                                </tbody>
                            </table>
                        </div>
                    </div>                        
                </div>
                <div class="tab-pane" id="tab_lots" style="height: 100%;">
                    <div class="portlet light" style="">
                        <div class="row"> 
                            <table class="tbllots table table-hover" id="tbllots" >
                                <thead>
                                    <tr>
                                        <th style="display: none;">Contract ID</th>
                                        <th>Lot Description</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach($lots as $lots){ ?>
                                    <tr>
                                        <td style="display: none;"><?php echo $lots['lot_id'];?></td>
                                        <td><?php echo $lots['lot_description'];?></td>
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
            <div class="portlet light " id="bankslists">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="fa fa-money font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> Contracts</span>
                    </div>
                </div>
                <div class="portlet-body hidden-print" style="height: 100%;">
                  
                    <div class="row">
                            <table class="tblcontracts table table-hover" id="tblcontracts">
                                <thead>
                                    <tr>
                                        <th>Contract No</th>
                                        <th>Description</th>
                                        <th>Date of Reservation</th>
                                        <th>TCP</th>
                                        <th>Lot Area</th>
                                        <th>Price Per Sqr Meter</th>
                                        <th>Total Paid</th>
                                        <th>Balance</th>
                                        <th>% Paid</th>
                                        <th>Contract Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_contracts">
                          
                                </tbody>
                            </table>
                        <!-- </div> -->
	                </div>
                </div> <!-- USE PORTLET BOX -->


            </div>
        </div>
</div>

<div class="row hidden-print" id='details' style="display: none;">
	<div class="col-md-6">
		<div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-user font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Client Details</span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                	<div class="col-md-4">
                		<h5><b>Name :</b></h5>
                	</div>
                	<div class="col-md-8">
                		<h5 id='customerName'><b></b></h5>
                	</div>
                </div>
                <!-- <br> -->
                <div class="row hidden-print">
                	<div class="col-md-4">
                		<h5><b>Spouse Name :</b></h5>
                	</div>
                	<div class="col-md-8">
                		<h5 id='spouseName'><b></b></h5>
                	</div>
                </div>
                <!-- <br> -->
                <div class="row">
                	<div class="col-md-4">
                		<h5><b>Address :</b></h5>
                	</div>
                	<div class="col-md-8">
                		<h5 id='customerAddress'><b></b></h5>
                	</div>
                </div>
                <div class="row" style="display: none;">
                    <div class="col-md-4">
                        <h5><b>TIN :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='customerTIN'><b></b></h5>
                    </div>
                </div>
            </div> 
        </div>
	</div>
	<div class="col-md-6">
		<div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-home font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Lot Details</span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                	<div class="col-md-3">
                		<h5><b>Description :</b></h5>
                	</div>
                	<div class="col-md-9">
                		<h5 id='lotDescription'><b></b></h5>
                	</div>
                </div>
                <!-- <br> -->
                <div class="row">
                	<div class="col-md-3">
                		<h5><b>Area (Sq. Mtr.) :</b></h5>
                	</div>
                	<div class="col-md-3">
                		<h5 id='areaSqMtr'><b></b></h5>
                	</div>
                	<div class="col-md-3">
                		<h5><b>Price/Sq. Mtr. :</b></h5>
                	</div>
                	<div class="col-md-3">
                		<h5 id='priceSqrMtr'><b></b></h5>
                	</div>
                </div>
                <!-- <br> -->
                <div class="row">
                	<div class="col-md-3">
                        <h5><b>TCP :</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 id='tcp'><b></b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><b>Discount :</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 id='discount'><b></b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5><b>House Price :</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 id='houseprice'><b></b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5><b>Lot Price :</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 id='lotprice'><b></b></h5>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <h5><b>Lot VAT :</b></h5>
                    </div>
                    <div class="col-md-3">
                        <h5 id='lotvat'><b></b></h5>
                    </div>
                </div>
            </div> 
        </div>
	</div>
</div>

<div class="row hidden-print" id='details2' style="display: none;">
    <div class="col-md-6">
        <div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Amortization Scheme</span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Downpayment :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='downpayment'><b></b></h5>
                    </div>
                </div>
                <!-- <br> -->
                <div class="row hidden-print">
                    <div class="col-md-4">
                        <h5><b>Balance TCP :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='balancetcp'><b></b></h5>
                    </div>
                </div>
                <!-- <br> -->
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Contract Date :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='contractdate'><b></b></h5>
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Payment</span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Principal Payment :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='principalpayment'><b></b></h5>
                    </div>
                </div>
                <!-- <br> -->
                <div class="row hidden-print">
                    <div class="col-md-4">
                        <h5><b>Principal Balance :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='principalbalance'><b></b></h5>
                    </div>
                </div>
                <!-- <br> -->
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Old Amortization :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='oldamortization'><b></b></h5>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>
<div class="row hidden-print" id='details3' style="display: none;">
    <div class="col-md-6">
        <div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Balance Computation</span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Description :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <h5 id='desc'></h5>
                    </div>
                </div>
                <br>
                <div class="row hidden-print">
                    <div class="col-md-4">
                        <h5><b>Term :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="new_term" id="new_term" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Interest Rate :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="new_interest" id="new_interest" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Surcharge Rate :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="new_surcharge" id="new_surcharge" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Restruction Date :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="date" placeholder="yyyy-mm-dd" autocomplete="off" value="<?php echo date('Y-m-d'); ?>" name="restruction_date" id="restruction_date" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>New Amortization Date :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="date" autocomplete="off" placeholder="yyyy-mm-dd" name="new_amort_date" id="new_amort_date" />
                    </div>
                </div>
            </div> 
        </div>
    </div>
    <div class="col-md-6">
        <div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Restruction Information</span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>20% Balance Payable :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <select class="form-control select2 select2-hidden-accessible" id="twenty" name ="twenty" required>
                            <option value="0" class ="disabled selected">Select Here..</option>
                            <option value="1" class ="disabled selected">Yes</option>
                            <option value="2" class ="disabled selected">No</option>
                        </select>
                    </div>
                </div>
                
                <div class="row" style="display: none;" id="twenty_row">
                    <div class="col-md-4">
                        <h5><b>20% Balance Payable Amount :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="twenty_percent_value" id="twenty_percent_value" readonly/>
                    </div>
                </div>
                <br>
                <div class="row hidden-print">
                    <div class="col-md-4">
                        <h5><b>Surcharge Balance Payable :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="surcharge_balance_payable" id="surcharge_balance_payable" />
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>Bal TCP Computation :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="balance_tcp_payable" id="balance_tcp_payable" readonly/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>IPS Amortization :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="ips_amortization" id="ips_amortization" readonly/>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-4">
                        <h5><b>New Monthly Amortization :</b></h5>
                    </div>
                    <div class="col-md-8">
                        <input class="form-control form-control-solid placeholder-no-fix" type="number" autocomplete="off" placeholder="" name="new_monthly_amortization" id="new_monthly_amortization" readonly/>
                    </div>
                </div>
                <br>
                <a class="btn circle blue hidden-print"  id="compute">Compute
                <i class="fa fa-calculator"></i></a>
                <a class="btn circle blue hidden-print"  id="save">Save
                <i class="fa fa-floppy-o"></i></a>
            </div> 
        </div>
    </div>
</div>

<div class="row hidden-print" id='restructure_table_row' style="display: none;">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-user font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> New Amortization Schedule</span>
                </div>
                <div class="actions">
                    <div class="row">
                        <a class="btn circle blue hidden-print"  id="print">Print
                        <i class="fa fa-print"></i></a>
                    </div>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <table class="tblrestructure table table-hover" id="tblrestructure">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Amortization</th>
                                <th>Interest</th>
                                <th>Principal</th>
                                <th>IP&S Amortization</th>
                                <th>IP&S Interest</th>
                                <th>IP&S Accrued</th>
                                <th>Running Balance</th>
                                <th style="display: none;">Outstanding Balance</th>
                                <th style="display: none;">IP&S Balance</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_restructure">
                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



