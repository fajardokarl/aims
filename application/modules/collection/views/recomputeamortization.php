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
                                        <td><?php echo $customers['lastname'].', '.$customers['firstname'].' '.$customers['middlename'];?></td>
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
    <div class="col-md-12">
        <div class="portlet light " id="">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Amortization Schedule</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <table class="tblrecompute table table-hover" id="tblrecompute">
                        <thead>
                            <tr>
                                <th style="display: none;">Amortization ID</th>
                                <th style="display: none;">Payment ID</th>
                                <th style="display: none;">Payment Type ID</th>
                                <th>Payment Date</th>
                                <th>Payment Type</th>
                                <th>Amount</th>
                                <th>Principal</th>
                                <th>Interest</th>
                                <th>Surcharge</th>
                                <th>Sundry</th>
                                <th>IP&S Interest</th>
                                <th>IP&S Accrued</th>
                                <th>Running Balance</th>
                                <th>&nbsp</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_recompute">
                  
                        </tbody>
                    </table>
                </div>
            </div> 
        </div>
    </div>
</div>

<div class="row hidden-print" id='recompute_table_row' style="display: none;">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-user font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Payments</span>
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
                    <table class="tblrecompute table table-hover" id="tblrecompute">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th>Due Date</th>
                                <th>Amount</th>
                                <th>Principal</th>
                                <th>Interest</th>
                                <th>Surcharge</th>
                                <th>Sundry</th>
                                <th>IP&S Amortization</th>
                                <th>IP&S Interest</th>
                                <th>IP&S Accrued</th>
                                <th>Running Balance</th>
                                <th style="display: none;">Outstanding Balance</th>
                                <th style="display: none;">IP&S Balance</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_recompute">
                  
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="selectionModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 1000px; width: 700px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <button type="button" id="addline" class="btn blue btn-outline hidden-print" data-dismiss="modal">Add Line</button>
                    <button type="button" id="deleteline" class="btn blue btn-outline hidden-print" data-dismiss="modal">Delete Line</button>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                </div>
              </div>        
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="confirmation" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 200px; width: 300px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile" style="text-align: center;">
                    <h2 class="caption-subject bold font-green-sharp"> Cancel Payment?</h2>
                    <br><br>
                    <button type="button" name="yes" id="yes" class="btn green hidden-print" align="center">Yes</button>
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal" align="center">No</button>
                </div>
              </div>        
        </div>
    </div>
</div>



