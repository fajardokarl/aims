
    <input type="hidden" name="" id="masking" placeholder="
    MASKING">
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
                    <!-- 	<div class="col-md-4">
	                    </div>
	                    <div class="col-md-4">
	                        <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        
                                    </div>
                                    <div class="col-md-4">
                                        <h4 class="control-label">Client Name<font color="red"> * </font></h4>
                                    </div>
                                   <div class="col-md-4">
                                        
                                    </div>
                                </div>
	                            <select class="form-control select2 select2-hidden-accessible" id="clientName" name ="clientName" required>
	                                <option value="0" class ="disabled selected">Select Here..</option>
	                                <?php foreach($customers2 as $customers){ ?>
	                                <option value="<?php echo $customers['client_id'];?>"><?php echo $customers['firstname'];?> <?php echo $customers['lastname'];?></option>
	                                <?php } ?> 
	                            </select>  
	                        </div>
	                    </div>
	                    <div class="col-md-3">
	                    </div> -->
                        <!-- <div id="scrollable" style="height: 400px; overflow: scroll;"> -->
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
                                        <!-- <th>% Paid</th> -->
                                        <th>Contract Status</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_contracts">
                          
                                </tbody>
                            </table>
                        <!-- </div> -->
	                </div>
	                <!-- <div class="row">
	                	<center>
	                        <button style="align: center; display: none;" type="button" class="btn btn-circle green" id="generate">Generate</button>
	                    </center>
	                </div> -->
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
                    <input type="hidden" name="dp_int_rate" id="dp_int_rate">
                    <input type="hidden" name="balance_int_rate" id="balance_int_rate">
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
            </div> 
        </div>
	</div>
</div>
<div class="row hidden-print" id='amort' style="display: none;">
	<div class="col-md-12">
		<div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="col-md-6">
                    <div class="caption font-green-sharp hidden-print">
                        <i class="fa fa-money font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> Due Amounts</span>
                    </div>
                </div>
                <div class="col-md-6 hidden-print">
                        <div class="actions">
                            <div class="row">
                                <div class="col-md-2">
                                </div>
                                <div class="col-md-4" style="text-align: right;">
                                    <span class="caption-subject bold uppercase"> Surcharge Date</span>
                                </div>
                                <div class="col-md-4">
                                    <input  type="date" name="surchargeDate" placeholder="yyyy-mm-dd" class="form-control" id="surchargeDate" required />
                                </div>
                                <div class="col-md-2">
                                    <button style="align: center;" type="button" class="btn btn-circle green" id="generate2">Generate</button>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
            <div class="hidden-print tabbable-line tabbable-full-width">
                <ul class="nav nav-tabs">
                    <li class="active" id="tab1">
                        <li class="active" id="tab1">
                            <a href="#tab_amort" data-toggle="tab"> Amortization Due</a>
                        </li>
                        <li class="" id="tab2">
                            <a href="#tab_misc" data-toggle="tab"> Miscellaneous  </a>
                        </li>
                        <li class="" id="tab3">
                            <a href="#tab_amort2" data-toggle="tab"> Amortization Schedule  </a>
                        </li>
                        <li class="" id="tab4">
                            <a href="#tab_pdc" data-toggle="tab"> Postdated Checks  </a>
                        </li>
                    </li>
                </ul>
            </div>

            <div class="tab-content" id="tab" style="height: 100%;">
                <div class="tab-pane active" id="tab_amort" style="height: 100%;">
                    <div class="portlet light">   

                        <button id="try_btn">TRY!</button>
                        <div id="scrollable" style="height: 400px; overflow: scroll;">     
                            <table class="tblcommission table table-hover" id="tblamortization">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Amortization ID</th>
                                        <th>Due Date</th>
                                        <th>Days Due</th>
                                        <th align="right">Amount Due</th>
                                        <th align="right">Amortization Amount</th>
                                        <th align="right">Surcharge Amount</th>
                                        <th align="right">VAT</th>
                                        <th align="right">Interest</th>
                                        <th align="right">IP & S</th>
                                        <th align="right">IP & S Accrued</th>
                                        <th align="right">IP & S Interest</th>
                                        <th align="right">Principal</th>
                                        <th align="right">Payments</th>
                                        <th style="display: none;">Contract ID</th>
                                        <th style="display: none;">Interest Paid</th>
                                        <th style="display: none;">Vat Paid</th>
                                        <th style="display: none;">Surcharge Paid</th>
                                        <th style="display: none;">Principal Paid</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_rp">
                          
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="tab-pane" id="tab_misc" style="height: 100%;">
                    <div class="portlet light" style="">
                        <div id="scrollable" style="height: 400px; overflow: scroll;">  
                            <table class="tblmisc table table-hover" id="tblmisc">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Contract ID</th>
                                        <th style="display: none;">Misc ID</th>
                                        <th>Due Date</th>
                                        <th>Miscelaneous Amount</th>
                                        <th>Principal Amount</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_misc">

                                </tbody>
                            </table>
                        </div>
                    </div>                        
                </div>
                <div class="tab-pane" id="tab_amort2" style="height: 100%;">
                    <div class="portlet light">   
                        <div id="scrollable" style="height: 400px; overflow: scroll;">     
                            <table class="tblamortization2 table table-hover" id="tblamortization2">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Client ID</th>
                                        <th style="display: none;">Amortization ID</th>
                                        <th>Due Date</th>
                                        <th>Line Type</th>
                                        <th>Amortization Amount</th>
                                        <th>VAT</th>
                                        <th>IP & S</th>
                                        <th>Interest</th>
                                        <th>Principal</th>
                                        <th>Run Balance</th>
                                        <th>Vat Paid</th>
                                        <th>IP & S Paid</th>
                                        <th>Interest Paid</th>
                                        <th>Principal Paid</th>
                                        <th>Surcharge Paid</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_rp2">
                          
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>
                <div class="tab-pane" id="tab_pdc" style="height: 100%;">
                    <div class="portlet light">   
                        <div id="scrollable" style="height: 400px; overflow: scroll;">     
                            <table class="tblpdc table table-hover" id="tblpdc">
                                <thead>
                                    <tr>
                                        <th style="display: none;">Postdated Check ID</th>
                                        <th>Check Date</th>
                                        <th>Amount</th>
                                        <th>Check Number</th>
                                        <th>Source Bank</th>
                                        <th>Destination Bank</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_pdc">
                          
                                </tbody>
                            </table>
                        </div> 
                    </div>
                </div>

                <button style="align: center;" type="button" data-toggle="modal" data-target="#summaryPayments" class="btn btn-circle green" id="summary">Summary of Payments</button>
                <button style="align: right;" type="button" data-toggle="modal" data-target="#waiveSurcharge" class="btn btn-circle green" id="waive">Waive Surcharge</button>
                <button style="align: right;" type="button" data-toggle="modal" data-target="#recomputeSurcharge" class="btn btn-circle green" id="recompute">Recompute Surcharge Lines</button>
            </div>
        </div>
	</div>
</div>
<div class="row hidden-print" id='diminishing' style="display: none; height: 100%;">
    <div class="portlet-body">
        <table class="tbldiminishing table table-hover" id="tbldiminishing">
            <thead>
                <tr>
                    <th>Amortization ID</th>
                    <th>Due Date</th>
                    <th>Amortization Amount</th>
                    <th>VAT</th>
                    <th>IP & S</th>
                    <th>Interest</th>
                    <th>Principal</th>
                    <th>Remaining Balance</th>
                    <th>Vat Paid</th>
                    <th>IP & S Paid</th>
                    <th>Interest Paid</th>
                    <th>Principal Paid</th>
                </tr>
            </thead>
            <tbody id="tbody_diminishing">
      
            </tbody>
        </table>

        <table class="tbldiminishing2 table table-hover" id="tbldiminishing2">
            <thead>
                <tr>
                    <th>Amortization ID</th>
                    <th>Due Date</th>
                    <th>Amortization Amount</th>
                    <th>VAT</th>
                    <th>IP & S</th>
                    <th>Interest</th>
                    <th>Principal</th>
                    <th>Remaining Balance</th>
                    <th>Vat Paid</th>
                    <th>IP & S Paid</th>
                    <th>Interest Paid</th>
                    <th>Principal Paid</th>
                </tr>
            </thead>
            <tbody id="tbody_diminishing2">
      
            </tbody>
        </table>
    </div>
</div>
<div class="row hidden-print" id='cid' style="display: none; height: 100%;">
    <div class="col-md-5">
        <div class="portlet light " id="cidPortlet1">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Collection Information Details</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Pay to Principal: </b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="checkbox" id="payToPrincipal" name="payToPrincipal" class="form-control" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Book: </b></h5>
                    </div>
                    <div class="col-md-6">
                        <input type="checkbox" id="isbooked" name="isbooked" class="form-control" required/>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Payment Type :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <select id="paymentType" class="form-control select2 select2-hidden-accessible">
                            <?php foreach($paymentType as $p) {?>
                            <option value="<?php echo $p['payment_mode_id'];?>"><?php echo $p['payment_name'];?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Payment Date :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <input  type="date" name="paymentDate" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="paymentDate" maxlength="10" required />
                    </div>
                </div>
                <div id="amountDiv">
                    <div class="row" id="amountRow">
                        <div class="col-md-6">
                            <h5><b>Amount in Cash:</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" id="payment1" name="payment1"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                </div>
                <div id="checkOnlyDiv" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Bank :</b></h5>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control select2 select2-hidden-accessible" id="bank" name ="bank">
                                <option value="0" class ="disabled selected">Select Bank..</option>
                                <?php foreach($allbanks as $allbanks2){ ?>
                                <option value="<?php echo $allbanks2['bank_id'];?>"><?php echo $allbanks2['bank_name'];?></option>
                                <?php } ?> 
                            </select> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Amount in Check:</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" id="payment2" name="payment2"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Check Number :</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="checkNumber1" name="checkNumber1"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Check Date :</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input  type="date" name="checkDate" placeholder="yyyy-mm-dd" class="form-control" id="checkDate" maxlength="10" required />
                        </div>
                    </div>
                </div>    
                <div id="bankPayment" style="display: none;">
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Amount :</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input type="number" id="payment3" name="payment3"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Bank :</b></h5>
                        </div>
                        <div class="col-md-6">
                            <select class="form-control select2 select2-hidden-accessible" id="bank2" name ="bank2">
                                <option value="0" class ="disabled selected">Select Bank..</option>
                                <?php foreach($banks as $a){ ?>
                                <option value="<?php echo $a['bank_id'];?>"><?php echo $a['bank_name'];?></option>
                                <?php } ?> 
                            </select> 
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Account Number:</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input type="text" id="accNumber" name="accNumber"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <h5><b>Deposit Date:</b></h5>
                        </div>
                        <div class="col-md-6">
                            <input  type="date" name="depositDate" placeholder="yyyy-mm-dd" class="form-control" id="depositDate" maxlength="10" required />
                        </div>
                    </div>
                </div>     
            </div> 
        </div>
        <!-- <div class="portlet light " id="cidPortlet2" style="height: 100%;">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Payment Type</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6">
                        <input type="checkbox" id="cash" name="cash" value="1"> <b>Cash</b><br>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <input type="checkbox" id="check" name="check" value="2"> <b>Check</b><br>
                    </div>
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <input type="checkbox" id="cashAndCheck" name="cashAndCheck" value="3"> <b>Both (Cash & Check)</b><br>
                    </div>
                </div> 
            </div> 
        </div> -->
    </div>
    <div class="col-md-5">
        <div class="portlet light " id="cidPortlet3">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Payments Breakdown</span>
                </div>
            </div>
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Surcharges :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <b><h5 id="surcharges_text"></h5></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>I P & S :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <b><h5 id="ips_text"></h5></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Interest :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <b><h5 id="interest_text"></h5></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Vat :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <b><h5 id="vat_text"></h5></b>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>Principal TCP :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <b><h5 id="tcp2_text"></h5></b>
                    </div>
                </div> 
                <br>
                <div class="row">
                    <div class="col-md-6">
                        <h5><b>TOTAL :</b></h5>
                    </div>
                    <div class="col-md-6">
                        <b><h5 id="total_text"></h5></b>
                    </div>
                </div>     
            </div> 
        </div>
    </div>
    <div class="col-md-2">
        <div class="portlet light " id="cidPortlet3">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-money font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Actions</span>
                </div>
            </div>
            <div class="portlet-body">
                <!-- <div class="row">
                    <button style="height: 5em; width: 100%;">Recompute Surcharge Lines</button>
                </div> -->
                <div class="row">
                    <button id="saveButton" style="height: 5em; width: 100%;">Save</button>
                </div>
                <br>
                <div class="row">
                    <button style="height: 5em; width: 100%;" id="print">Print</button>
                </div>
                <div class="row" style="display: none;">
                    <button style="height: 5em; width: 100%;" id="trigger">Sample trigger</button>
                </div>
            </div>
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="summaryPayments" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="bankForm" name="bankForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs hidden-print">
                            <li class="active hidden-print" id="tab1">
                                <li class="active" id="tab1">
                                    <a href="#summary1" data-toggle="tab"> Summary of Payments </a>
                                </li>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab_summary">
                            <div class="tab-pane active" id="summary1">
                                <div class="row">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5><b>Name :</b></h5>
                                            </div>
                                            <div class="col-md-9">
                                                <h5 id='customerName2'>Sample</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <h5><b>Lot Description :</b></h5>
                                            </div>
                                            <div class="col-md-8">
                                                <h5 id='lotDescription2'>East Cove- Phase 1- Block 1 -Lot 15</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-1">
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5><b>Address :</b></h5>
                                            </div>
                                            <div class="col-md-9">
                                                <h5 id='customerAddress2'>werwer, Boliney, Agusan del Sur, Albania</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <h5><b>Area (Sq. Mtr.) :</b></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5 id='areaSqMtr2'>120.00</h5>
                                            </div>
                                            <div class="col-md-3">
                                                <h5><b>Price/Sq. Mtr. :</b></h5>
                                            </div>
                                            <div class="col-md-2">
                                                <h5 id='priceSqrMtr2'>7589.29</h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                    </div>
                                </div>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div id="scrollable" style="height: 400px; overflow: scroll;">
                                            <table class="tblsummary table table-hover" id="tblsummary">
                                                <thead>
                                                    <tr>
                                                        <th style="display: none;">Payment ID</th>
                                                        <th>Payment Date</th>
                                                        <th>Payment Type</th>
                                                        <th>Amount Paid</th>
                                                        <th>Principal Paid</th>
                                                        <th>Surcharge Paid</th>
                                                        <th>Interest Paid</th>
                                                        <th>Sundry Paid</th>
                                                        <th>IP & S Paid</th>
                                                        <th>Balance</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbody_summary">
                                          
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                    <button type="button" id="printSummarys" class="btn green hidden-print">Print</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="waiveSurcharge" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 200px; width: 300px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <input type="number" id="waiveSurchargeAmount" name="waiveSurchargeAmount" placeholder="0" maxlength="30" class="form-control" required/>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" name="waiveSubmit" id="waiveSubmit" class="btn green hidden-print" data-dismiss="modal">Waive Surcharge</button>
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                </div>
              </div>        
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="recomputeSurcharge" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 200px; width: 300px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <input type="number" id="recomputeSurchargeAmount" name="recomputeSurchargeAmount" placeholder="0" maxlength="30" class="form-control" required/>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" name="recomputeSubmits" id="recomputeSubmits" class="btn green hidden-print" data-dismiss="modal">Recompute</button>
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                </div>
              </div>        
        </div>
    </div>
</div>
<a href="<?php echo base_url(); ?>reports/Receipt.pdf" style="display: none;"><input type="button" id="receiptTrigger" value="Test" class="btn btn-success"></a>

<!-- Add bank destination (A Brown Bank) -->