
<div>
    <form class="form-horizontal" role="form" action="" method="POST" id="reserve_form">
        <div class="row">
            <input type="hidden" name="last_date" id="last_date">
            <div class="col-md-12">
                <div class="portlet light bordered">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="icon-settings font-dark"></i>
                            <span class="caption-subject font-dark sbold uppercase"> RESERVATION AGREEMENT
                                <span class="hidden-xs">|<?=date("Y-m-d h:i:sa");?></span>
                            </span>
                        </div>
                        <div class="actions"></div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Lot Details </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-default btn-sm" id="lotdetails">
                                                <i class="fa fa-pencil"></i> Change Lot </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Project: </div>
                                                <div class="col-md-7 value"><?php echo $one_lot[0]['project_description']; ?> 
                                                <input type="hidden" id="project_id" value="<?php echo $one_lot[0]['project_id']; ?>" placeholder=""/> 
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Phase: </div>
                                                <div class="col-md-7 value"> <?php echo $one_lot[0]['phase_name']; ?>  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Block No: </div>
                                                <div class="col-md-7 value"><?php echo $one_lot[0]['block_no']; ?> 
                                                  
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Lot No: </div>
                                                <div class="col-md-9 value"> <?php echo $one_lot[0]['lot_no']; ?>  </div>
                                            </div>
                                             <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Lot Description: </div>
                                                <div class="col-md-9 value"> <?php echo $one_lot[0]['lot_description']; ?>  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Floor Area: </div>
                                                <div class="col-md-9 value" ><?php if (isset($one_lot[0]['floor_area'])) echo $one_lot[0]['floor_area']; else echo "Not specified";?></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> With House: </div>
                                                <div class="col-md-9 value" id="house_stat"><?php if ($one_lot[0]['with_house']==1 || $one_lot[0]['with_house']=='1') echo "Yes"; else echo "No";?></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Lot Area: </div>
                                                <div class="col-md-9 value"> <?php echo $one_lot[0]['lot_area']; ?>  </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Price/SqMtr: </div>
                                                <div class="col-md-9 value"><span>&#8369; </span><?php echo number_format($one_lot[0]['price_per_sqr_meter']); ?> </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Total Lot Price: </div>
                                                <div class="col-md-9 value"><span>&#8369; </span><?php echo number_format(($one_lot[0]['price_per_sqr_meter'] * $one_lot[0]['lot_area']) + $one_lot[0]['lot_vat']); ?> </div>
                                                <input type="hidden" id="originalTcp" value="<?php echo ($one_lot[0]['price_per_sqr_meter'] * $one_lot[0]['lot_area']) + $one_lot[0]['lot_vat'] + $one_lot[0]['house_price']; ?>" placeholder=""/> 
                                            </div>
                                            <div class="row static-info" style="display: none;">
                                                <div class="col-md-3 name" align="right"> Lot ID: </div>
                                                <div class="col-md-9 value"> <?php echo $one_lot[0]['lot_id']; ?> </div>
                                                <input type="text" id="amort_lot_id" value="<?php echo $one_lot[0]['lot_id']; ?>" placeholder=""/> 
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> House Price: </div>
                                                <div class="col-md-9 value"><span>&#8369; </span><?php echo number_format($one_lot[0]['house_price']); ?> </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Vat Price: </div>
                                                <div class="col-md-9 value"><span>&#8369; </span><?php echo number_format($one_lot[0]['lot_vat']); ?> </div>
                                                <input type="hidden" id="originalVat" value="<?php echo $one_lot[0]['lot_vat']; ?>" placeholder=""/> 
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> TCP: </div>
                                                <div class="col-md-9 value"><span>&#8369; </span><?php echo number_format(($one_lot[0]['price_per_sqr_meter'] * $one_lot[0]['lot_area']) + $one_lot[0]['lot_vat'] + $one_lot[0]['house_price']); ?> </div>
                                                <input type="hidden" id="totalTcp" value="<?php echo ($one_lot[0]['price_per_sqr_meter'] * $one_lot[0]['lot_area']) + $one_lot[0]['lot_vat'] + $one_lot[0]['house_price']; ?>" placeholder=""/> 
                                            </div>

                                            <hr/>
                                            
                                            <!-- <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> TCT: </div>
                                                <div class="col-md-9 value" ><?php if (isset($one_lot[0]['tct_no'])) echo $one_lot[0]['tct_no']; else echo "To be Process";?></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> Tax Declaration No: </div>
                                                <div class="col-md-9 value" ><?php if (isset($one_lot[0]['tax_declaration_no'])) echo $one_lot[0]['tax_declaration_no']; else echo "To be Process";?></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> COR No: </div>
                                                <div class="col-md-9 value" ><?php if (isset($one_lot[0]['cor_no'])) echo $one_lot[0]['cor_no']; else echo "To be Process";?></div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-3 name" align="right"> License To Sell: </div>
                                                <div class="col-md-9 value" ><?php if (isset($one_lot[0]['license_to_sell'])) echo $one_lot[0]['license_to_sell']; else echo "To be Process";?></div>
                                            </div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6 col-sm-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Customer Information </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-default btn-sm" id="toggle_cust">
                                                    <i class="fa fa-pencil"></i> Change Customer </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Customer Name: </div>
                                                <?php if ($client[0]['client_type_id'] == 1) { ?>
                                                    <div class="col-md-7 value" id="amortcustname"> <?php echo $client[0]['lastname']; ?>, <?php echo $client[0]['firstname']; ?> <?php echo $client[0]['middlename']; ?></div>
                                                <?php }else{ ?>
                                                    <div class="col-md-7 value" id="amortcustname"> <?php echo $client[0]['organization_name']; ?> ?></div>

                                                <?php } ?>
                                                <input type="hidden" id="amortcustid" value="<?php echo $client[0]['client_id']; ?>" placeholder=""/>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Agent/Broker Information </div> 
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                               <div class="col-md-5 name"> <font color="red">  </font>Realty: </div>
                                                <div class="col-md-7 value">
                                                    <input type="text" class="form-control input-sm" id="toggle_realty" readonly placeholder="click here..">
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> <font color="red"> * </font>Brokers: </div>
                                                <div class="col-md-7 value">
                                                    <input type="text" class="form-control input-sm" id="toggle_broker" readonly placeholder="click here..">
                                                </div>
                                            </div>
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> <font color="red"> * </font>Agent: </div>
                                                <div class="col-md-7 value">
                                                     <input type="text" class="form-control input-sm" id="toggle_addagent" readonly placeholder="click here..">   
                                                </div>
                                            </div> 
                                            <!-- <div class="row static-info">
                                                <div class="col-md-5 name"> <font color="red"> * </font>Incentive Rate: </div>
                                                <div class="col-md-7 value">
                                                     <input type="text" class="form-control input-sm" id="incentive_rate" required="true">   
                                                </div>
                                            </div>   -->
                                        </div>
                                    </div>
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Financing </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-default btn-sm" id="toggle_financing">
                                                <i class="fa fa-pencil"></i> Change </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Financing Name: </div>
                                                <div class="col-md-7 value" id="finance_desc"> Select financing Type..</div>
                                                <input type="hidden" id="id_financing" value="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="portlet grey-cascade box" id="bank_portlet" style="display: none;">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Bank </div>
                                            <div class="actions">
                                                <a href="javascript:;" class="btn btn-default btn-sm" id="toggle_bank">
                                                    <i class="fa fa-pencil"></i> Change </a>
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-5 name"> Bank Name: </div>
                                                <div class="col-md-7 value" id="bankdesc"> Select Bank..</div>
                                                <input type="hidden" id="id_bank" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                                <i class="fa fa-cogs"></i>Compute Amortization
                                            </div>
                                        </div>
                                        <div class="portlet-body">
                                            <!-- here -->
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="portlet blue-hoki box">
                                                        <div class="portlet-title">
                                                            <div class="caption">Amortization Computation Details</div> 
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-6">
                                                                    <div class="col-md-4">
                                                                        <label>Scheme Type</label>
                                                                        <div class="radio-list">
                                                                            <!-- <label><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""> Customized</label> -->
                                                                            <label><input type="radio" name="optionsRadios" id="optionsRadios2" value="option2"> Registered </label>
                                                                        </div>
                                                                        <div id="schemeList" style="display: none;">
                                                                            <label></label>
                                                                            <select class="form-control select2 select2-hidden-accessible" id="scheme" name ="scheme">
                                                                                    <option value="1" class ="disabled selected">Select Here..</option>
                                                                                    <?php foreach($payment_scheme as $payment_scheme){ ?>
                                                                                      <option value="<?php echo $payment_scheme['payment_scheme_id'];?>"><?php echo $payment_scheme['payment_scheme_name'];?></option>
                                                                                    <?php } ?> 
                                                                            </select>  
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <label><font color="red"> * </font>Reservation Fee</label>
                                                                        <input type="text" id="lotreserveFee" class="form-control input-sm"  placeholder="">
                                                                        <label><font color="red"> * </font>Club Share</label>
                                                                         <div>
                                                                            <select class="form-control" id="clubshare">
                                                                                <option>None</option>
                                                                                <option value="12">12 Months Free</option>
                                                                                <option value="6">6 Months Free</option>
                                                                                <option value="3">3 Months Free</option>
                                                                            </select>
                                                                         </div>
                                                                    </div>
                                                                    <div class="col-md-4">
                                                                        <div class="row">
                                                                            <label><font color="red"> * </font>Discount</label>
                                                                            <input type="text" id="fixed_discount" class="form-control input-sm" disabled="true" placeholder="">
                                                                            <input type="text" id="accountDicount" class="form-control input-sm" readonly="true" placeholder="" style="display: none;">
                                                                            <label></label>
                                                                            <div class="checkbox-list">
                                                                                <label><input type="checkbox" id="tax_defered"> Tax Deferred</label>
                                                                                <label><input type="checkbox" id="chkmiscfee"> Miscellaneous Fee </label>
                                                                            </div>
                                                                            <!-- <div class="checkbox-list">
                                                                                
                                                                            </div> -->
                                                                            <div id="misc_data" style="display: none; position: relative; z-index: 100;">
                                                                                <label></label>
                                                                                <label class="control-label"> % </label>
                                                                                <input class="form-control" type="text" id="misc_percent" name="misc_percent" value="5">
                                                                                
                                                                                <label class="control-label"> Terms</label>
                                                                                <input class="form-control" type="text" id="misc_term" name="misc_term">

                                                                                <label class="control-label">Payment date start</label>
                                                                                <input class="form-control" type="date" id="misc_date" name="misc_date" >
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row static-info" id="schemeDesc" style="display: none;">
                                                                        <div class="col-md-12"> 
                                                                            <label></label>
                                                                            <textarea class="form-control" id="schemeDescription" readonly="true" rows="3"></textarea>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="form-group">
                                                                        <label class="col-md-6 control-label"><font color="red"> * </font>Deposit Date</label>
                                                                        <div class="col-md-6">
                                                                            <input type="date" id="depoDate" class="form-control input-sm" value="<?php echo date('Y-m-d'); ?>"placeholder="Default Input" readonly> </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-6 control-label"><font color="red"> * </font>Amort Date</label>
                                                                        <div class="col-md-6">
                                                                            <input type="date" id="amortDate" class="form-control input-sm" placeholder="Default Input"> </div>
                                                                    </div>
                                                                    <!-- <div class="form-group">
                                                                        <label class="col-md-6 control-label">*Desired Amount</label>
                                                                        <div class="col-md-6">
                                                                            <input type="text" id="desiredAmount" readonly="yes" class="form-control input-sm" placeholder="Default Input"> </div>
                                                                    </div>
                                                                    <div class="form-group">
                                                                        <label class="col-md-6 control-label">*Deposit Amount</label>
                                                                        <div class="col-md-6">
                                                                            <input type="text" id="depAmount" class="form-control input-sm" placeholder="Default Input"> </div>
                                                                    </div> -->
                                                                     <div class="form-group">
                                                                        <label class="col-md-6 control-label"></label>
                                                                        <div class="col-md-6">
                                                                             <div class="checkbox-list" id="remain" style="display: none">
                                                                                     <label><input type="checkbox" id="chkSpread"> Spread Remaining<div id="amt">5000</div></label> 
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <!-- <div class="col-md-2">
                                                                    <div class="form-group">
                                                                       <a href="javascript:;" id="cumputeAmort" class="btn btn-sm default "> Compute Amort
                                                                            <i class="fa fa-user"></i>
                                                                        </a>
                                                                    </div> 
                                                                </div> -->
                                                            </div>
                                                            <!-- aw -->
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end -->
                                            <div class="row">
                                                <div id='downpayment_port' class="col-md-6 col-sm-12">
                                                    <div class="portlet grey-cascade box">
                                                        <div class="portlet-title">
                                                            <div class="caption">Equity Computation</div> 
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-12"> 
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" id="dcDescription" readonly="true" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-12">
                                                                    <table>
                                                                        <tr>
                                                                            <td>TCP %:</td>
                                                                            <td>Terms:</td>
                                                                            <td>Interest %:</td>
                                                                            <td>Discount %:</td>
                                                                            <td>Surcharge %:</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="text" id="dcTcp" class="form-control" placeholder="%" ></td>
                                                                            <td><input type="text" id="dcTerms" class="form-control" placeholder="" value="0"></td>
                                                                            <td><input type="text" id="dcInterest" class="form-control" placeholder="%" value="0"> </td>
                                                                            <td><input type="text" id="dcDiscount" class="form-control" placeholder="%" value="0"></td>
                                                                            <td><input type="text" id="dcSurcharge" class="form-control" placeholder="%" value="3" readonly="true"></td>
                                                                        </tr>
                                                                    </table>

                                                                   <!--  <div class="col-md-2">
                                                                        <label>TCP %:</label>
                                                                        <input type="text" id="dcTcp" class="form-control" placeholder="%" > 
                                                                    </div>
                                                                     <div class="col-md-2">
                                                                        <label>Terms:</label>
                                                                        <input type="text" id="dcTerms" class="form-control" placeholder="" value="0"> 
                                                                    </div>
                                                                     <div class="col-md-2">
                                                                        <label>Interest %:</label>
                                                                        <input type="text" id="dcInterest" class="form-control" placeholder="%" value="0"> 
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Discount %:</label>
                                                                        <input type="text" id="dcDiscount" class="form-control" placeholder="%" value="0"> 
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Surcharge %:</label>
                                                                        <input type="text" id="dcSurcharge" class="form-control" placeholder="%" value="3" readonly="true"> 
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                             <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="well">
                                                                        <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"><label class="dpPercentBal"></label>% of TCP: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="percentTcp">0.00</div>
                                                                        </div>
                                                                        <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"> Less: <label class="dpDiscount"></label>% Discount: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="perCentDiscount">0.00</div>
                                                                        </div>
                                                                        <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"> Less: Reservation Fee: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="FeesforReserve">0.00</div>
                                                                            <hr style=" border-top: 1px solid #ccc" />
                                                                        </div>
                                                                        <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"> <label class="dpPercentBal"></label>%, net of <label class="dpDiscount"></label>% Discount: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="totalFeesfordp">0.00</div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="balance_tcp" class="col-md-6 col-sm-12">
                                                    <div class="portlet grey-cascade box">
                                                        <div class="portlet-title">
                                                            <div class="caption">Balance TCP Computation</div> 
                                                        </div>
                                                        <div class="portlet-body">
                                                            <div class="row static-info">
                                                                <div class="col-md-12"> 
                                                                    <label>Description</label>
                                                                    <textarea class="form-control" id="balDescription" readonly="true" rows="3"></textarea>
                                                                </div>
                                                            </div>
                                                            <div class="row static-info">
                                                                <div class="col-md-12">
                                                                    <table>
                                                                        <tr>
                                                                            <td>TCP %:</td>
                                                                            <td>Terms:</td>
                                                                            <td>Interest %:</td>
                                                                            <td>Surcharge %:</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><input type="text" id="balTcp" class="form-control" readonly="true" placeholder="%" value="0"></td>
                                                                            <td><input type="text" id="balTerms" class="form-control" placeholder="" value="0"></td>
                                                                            <td><input type="text" id="balInterest" class="form-control" placeholder="%" value="0"> </td>
                                                                            <td><input type="text" id="balSurcharge" class="form-control" placeholder="%" value="3" readonly="true"></td>
                                                                            
                                                                        </tr>
                                                                    </table>
                                                                    <!-- <div class="col-md-2">
                                                                        <label>TCP %:</label>
                                                                        <input type="text" id="balTcp" class="form-control" readonly="true" placeholder="%" value="0"> 
                                                                    </div>
                                                                     <div class="col-md-2">
                                                                        <label>Terms:</label>
                                                                        <input type="text" id="balTerms" class="form-control" placeholder="" value="0"> 
                                                                    </div>
                                                                     <div class="col-md-2">
                                                                        <label>Interest %:</label>
                                                                        <input type="text" id="balInterest" class="form-control" placeholder="%" value="0"> 
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label>Surcharge %:</label>
                                                                        <input type="text" id="balSurcharge" class="form-control" placeholder="%" value="3" readonly="true"> 
                                                                    </div> -->
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-12">
                                                                    <div class="well">
                                                                        <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"><label class="balpercentBal"></label>% Balance: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="balPercentTcp">0.00</div>
                                                                        </div>
                                                                        <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"> Add: 5% Miscellaneous Fee: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="balMiscellaneous">0.00</div>
                                                                            <hr style=" border-top: 1px solid #ccc" />
                                                                        </div>
                                                                         <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"> <label class="balpercentBal"></label>%, Balance + Miscellaneous Fee: </div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="totalFees">0.00</div>
                                                                        </div>
                                                                       <!--  <div class="row static-info align-reverse">
                                                                            <div class="col-md-8 name"> <label></label>VAT:</div>
                                                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                                                            <div class="col-md-3 value" id="txt_vat_rate">0.00</div>
                                                                        </div> -->
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>    
                                            </div>
                                            <div class="row">
                                                <div class="modal-footer">
                                                    <div class="col-md-12">
                                                        <a href="javascript:;" id="cumputeAmort" class="btn blue"> Compute Amort
                                                            <i class="fa fa-calculator" aria-hidden="true"></i>
                                                        </a>
                                                    </div>
                                                </div> 
                                            </div>
                                        </div>
                                    </div>
                                </div>     
                            </div>
                            <!-- row end -->
                            <div class="row">
                                <div class="col-md-12 col-sm-12">
                                    <div class="tabbable-line tabbable-full-width">
                                        <ul class=" nav nav-tabs">
                                            <li class="active">
                                                <a href="#tab-amort" data-toggle="tab">Amortization</a>
                                            </li>
                                             <li class="">
                                                <a href="#tab-misc" data-toggle="tab" id="agent_tab">Miscellaneous</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div class="tab-pane active" id="tab-amort">
                                                <div class="portlet grey-cascade box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                        <i class="fa fa-cogs"></i>Amortization Schedule </div> 
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-striped" id="tblAmort">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th> Months </th>
                                                                        <th> Due Date </th>
                                                                        <th> Amort Amount </th>
                                                                        <th> Interest </th>
                                                                        <th> Principal </th>
                                                                        <th> Run Balance </th>
                                                                        <th></th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    
                                                                </tbody>
                                                                <!-- <tfoot id="foot_totals">
                                                                </tfoot> -->
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="tab-pane" id="tab-misc">
                                                <div class="portlet grey-cascade box">
                                                    <div class="portlet-title">
                                                        <div class="caption">
                                                        <i class="fa fa-cogs"></i>Miscellaneous Fees</div> 
                                                    </div>
                                                    <div class="portlet-body">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered table-striped" id="tbl_misc">
                                                                <thead>
                                                                    <tr>
                                                                        <th></th>
                                                                        <th> Months </th>
                                                                        <th> Due Date </th>
                                                                        <th> Amort Amount </th>
                                                                        <th> Interest </th>
                                                                        <!-- <th> Principal </th> -->
                                                                        <th> Run Balance </th>
                                                                    </tr>
                                                                </thead>
                                                                    <tbody>
                                                                    </tbody>
                                                                <tfoot>
                                                                    <tr> 
                                                                    </tr>
                                                                </tfoot>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" style="display: none">
                                <div class="col-md-6"> </div>
                                <div class="col-md-6">
                                    <div class="well">
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Total Amort: </div>
                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                            <div class="col-md-3 value" id="totalAmort">0.00</div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name">Miscellaneous Fee: </div>
                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                            <div class="col-md-3 value" id="totalMiscfee">0.00</div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Interest: </div>
                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                            <div class="col-md-3 value" id="totalInterest">0.00</div>
                                        </div>
                                        <div class="row static-info align-reverse">
                                            <div class="col-md-8 name"> Principal: </div>
                                            <div class="col-md-1 name"><span class="pull-right">&#8369;</span></div>
                                            <div class="col-md-3 value" id="totalPrincipal">0.00</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="form-actions">
                                <div class="row" align="right">
                                    <div class="col-md-12">
                                        <button type="button" class="btn green" id="submitagreement">Submit</button>
                                        <button type="button" class="btn default">Cancel</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>



<div style="display: none;" id="BrokerList" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Brokers<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="tblbroker table table-hover" id="tblbroker" >
                                            <thead>
                                                <tr>
                                                    <th>Broker ID</th>
                                                    <th>Broker Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                
                                                <?php foreach($brokers as $brokers){ ?>
                                                    <?php if ($brokers['realty_id'] == 0): ?>
                                                        <tr>
                                                            <td style=""><?php echo $brokers['broker_id'];?></td>
                                                            <td><?php echo $brokers['lastname'] . ", " . $brokers['firstname'] . " " . $brokers['middlename'] ;?></td>
                                                            <td><a href="" class="btn green btn-xs brokerlist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
                                                        </tr>
                                                        
                                                    <?php endif ?>
                                                <?php } ?> 
                                            </tbody>
                                        </table>      
                                    </div>   
                                </div> 
                            </form>   
                        </div>    
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="display: none;" id="lot_list" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <div class="portlet light bordered">
                                            <div class="portlet-title">
                                                <div class="caption font-green-sharp">
                                                    <span class="caption-subject bold uppercase"> Lot Details</span>
                                                </div>
                                            </div>
                                            <div class="portlet-body form"> 
                                                <div class="form-body">
                                                    <div id="blockUis">
                                                        <table id="amortlistOfLots" class="table table-striped table-bordered table-hover table-checkable order-column">
                                                            <thead>
                                                                <tr>
                                                                    <th style="display:none;">Lot ID</th>
                                                                    <th>Lot Description</th>
                                                                    <th>Lot Area</th>
                                                                    <th align="right">Price/SqrMtr</th>
                                                                    <th align="right">House Price</th>
                                                                    <th align="right">Vat Price</th>
                                                                    <th align="right">TCP</th>
                                                                    <th>Action</th>
                                                                    <th style="display:none;">WH</th>
                                                                    <th style="display:none;">WS</th>
                                                                    <th style="display:none;">active</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                  <?php foreach($lots_available as $lots){ ?>
                                                                    <tr>
                                                                        <td style="display:none;"><?php echo $lots['lot_id'];?></td>
                                                                        <td><?php echo $lots['lot_description'];?></td>
                                                                        <td><?php echo $lots['lot_area'];?></td>
                                                                        <td align="right"><?php echo number_format($lots['price_per_sqr_meter']);?></td>
                                                                        <td align="right"><?php echo number_format($lots['house_price']);?></td>
                                                                        <td align="right"><?php echo $lots['lot_vat'];?></td>
                                                                        <td align="right"><?php echo number_format($lots['lot_price']); ?></td>
                                                                        <td><button  class="btn green btn-xs Lot_edit"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</button><!-- <button  class="btn green btn-xs morelostdetails"><i class="fa fa-info-circle" aria-hidden="true"></i> More</button> --></td>
                                                                        <td style="display:none;"><?php echo $lots['with_house'];?></td>
                                                                        <td style="display:none;"></td>
                                                                        <td style="display:none;"><?php echo $lots['status_id'];?></td>
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
                            </form>   
                        </div>    
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="display: none;" id="bankFinancing" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Bank Financing<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="customerlists table table-hover" id="amortbanklist" >
                                            <thead>
                                                <tr>
                                                    <th>Bank ID</th>
                                                    <th>Bank Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($banklist as $banklist){ ?>
                                                 <tr data-custid="${data.custid}">
                                                    <td><?php echo $banklist['bank_id'];?></td>
                                                    <td><?php echo $banklist['bank_name'];?></td>
                                                    <td><a href="" class="btn green btn-xs banklist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>      
                                    </div>   
                                </div> 
                            </form>   
                        </div>    
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="display: none;" id="financing_types" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Bank Financing<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="customerlists table table-hover" id="financing_list" >
                                            <thead>
                                                <tr>
                                                    <th>Bank ID</th>
                                                    <th>Bank Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach($finance_types as $finance_types){ ?>
                                                 <tr data-custid="${data.custid}">
                                                    <td><?php echo $finance_types['financing_type_id'];?></td>
                                                    <td><?php echo $finance_types['financing_name'];?></td>
                                                    <td><a href="" class="btn green btn-xs financelist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>      
                                    </div>   
                                </div> 
                            </form>   
                        </div>    
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="display: none;" id="AgentList" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Agent<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="portlet grey-cascade box">
                            <div class="portlet-title">
                                <div class="actions">
                                    <a href="javascript:;" class="btn btn-default btn-sm" id="toggle_add">
                                    <i class="fa fa-pencil"></i> ADD </a>
                                </div> 
                            </div>
                            <div class="portlet-body"> 
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="tblAgent table table-hover" id="tblAgent" >
                                            <thead>
                                                <tr>
                                                    <th>Salesperson ID</th>
                                                    <th>Salesperson Name</th>
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

<div style="display: none;" id="realtyList" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Realty<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="tblrealty table table-hover" id="tblrealty" >
                                            <thead>
                                                <tr>
                                                    <th>Agent ID</th>
                                                    <th>Client Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                 <?php foreach($realty as $realty){ ?>
                                                 <tr data-custid="${data.custid}">
                                                    <td><?php echo $realty['realty_id'];?></td>
                                                    <td><?php echo $realty['realty_name'];?></td>
                                                    <td><a href="" class="btn green btn-xs realtylist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>      
                                    </div>   
                                </div> 
                            </form>   
                        </div>    
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="display: none;" id="addAgent" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Agent Add<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12"> 
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="tblrealty table table-hover" id="tbladdagent" >
                                            <thead>
                                                <tr>
                                                    <th>Person ID</th>
                                                    <th>Client Name</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody> 
                                                 <?php foreach($person as $person){ ?>
                                                 <tr data-custid="${data.custid}">
                                                    <td><?php echo $person['person_id'];?></td>
                                                    <td><?php echo $person['lastname']." ".$person['firstname'].",".$person['middlename'];?></td>
                                                    <td><a href="" class="btn green btn-xs addAgent"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
                                                </tr>
                                                <?php } ?> 
                                            </tbody>
                                        </table>   
                                    </div>   
                                </div> 
                            </form>   
                        </div>    
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" id="addnewagent">Add new</button>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="display: none;" id="ReserveAgreementCustList" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Customers<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet-body">   
                            <form id="updateLot">
                                <div class="form-body">
                                    <div class="form-group">
                                        <table class="customerlists table table-hover" id="amortcustomerlists" >
                                            <thead>
                                                <tr>
                                                    <th>Client ID</th>
                                                    <th>Client Name</th>
                                                    <th>Client Type</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach($customer as $customer){ ?>
                                             <tr data-custid="${data.custid}">
                                                <td><?php echo $customer['client_id'];?></td>
                                                <td><?php echo $customer['customer_fullname'];?></td>
                                                <td><?php echo $customer['client_type_name'];?></td>
                                                <td><a href="" class="btn green btn-xs custlist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
                                            </tr>
                                            <?php } ?> 
                                          
                                            </tbody>
                                        </table>      
                                    </div>   
                                </div>
                            </form>   
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="AddnewAgent" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <form action="<?=base_url()?>marketing/save_new_agent" method="POST" enctype="multipart/form-data" name="CustomerInformationForm" onsubmit="return ValidateForm()">
                <div class="modal-body">
                    <div class="profile">
                        <div class="tabbable-line tabbable-full-width">
                            <ul class="nav nav-tabs">
                                <li class="active" id="tab1">
                                    <a href="#tab_customer" data-toggle="tab">New Agent </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div class="tab-pane active" id="tab_customer">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <div class="form-group ">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
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
                                            <div class="row" style="display: none">
                                                <div class="col-md-12">
                                                    <div class="form-group" id="custidforedit">
                                                        <label class="control-label">Personal ID</label>
                                                        <input type="text" name="CustomerID" id="CustomerID" placeholder="" class="form-control" readonly />
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
                                                                    <label class="control-label">First Name</label>
                                                                    <input type="text" id="custFname" name="custFname"  placeholder="" maxlength="30" class="form-control"/>
                                                                    <input type="text" style="display: none;" id="clientpass" value="<?php echo $client[0]['client_id']; ?>" name="clientpass"  placeholder="" maxlength="30" class="form-control"/>
                                                                    <input type="text" style="display: none;" id="lotidpass" value="<?php echo $one_lot[0]['lot_id']; ?>" name="lotidpass"  placeholder="" maxlength="30" class="form-control"/>
                                                                    <input type="text" style="display: none;" id="realtypass" name="realtypass"  placeholder="" maxlength="30" class="form-control"/>
                                                                    <input type="text" style="display: none;" id="brokerpass" name="brokerpass"  placeholder="" maxlength="30" class="form-control"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Middle Name</label>
                                                                    <input type="text" id="custMname" name="custMname" placeholder="" maxlength="50" class="form-control"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <label class="control-label">Last Name</label>
                                                                    <input type="text" id="custLname" name="custLname" placeholder="" maxlength="50" class="form-control"/>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Contact Number</label>
                                                                    <input type="text" id="custContactNum" name="custContactNum"  placeholder="" maxlength="30" class="form-control"/>
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Gender <font color="red"> * </font></label>
                                                                    <select class="form-control" name="custGender" id="custGender" required>
                                                                        <option value="" disabled selected>---- Select Gender ----</option>
                                                                        <option value="Male">Male</option>
                                                                        <option value="Female">Female</option>
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
                                                                    <label class="control-label">Fax Number</label>
                                                                    <input type="text" id="custFaxNumber" name="custFaxNumber" placeholder="" class="form-control" maxlength="25"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">E-mail</label>
                                                                    <input type="text" id="custEmail" name="custEmail" placeholder="" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,3}$" title="example: abrown@gmail.com" maxlength="50" class="form-control"/>
                                                                </div>
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
                                                                <div class="form-group">
                                                                    <label class="control-label">Business Phone</label>
                                                                    <input type="text" id="custBusinessPhone" name="custBusinessPhone" placeholder="" class="form-control" maxlength="25" />
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                               
                                                            </div>                 
                                                        </div> 
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="control-label">Tax Indentification No.</label>
                                                            <!-- <input type="text" id="custTIN" name="custTIN" placeholder="" class="form-control" maxlength="15" /> </div> -->
                                                           
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" placeholder="XXX"> </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" placeholder="XX"> </div>
                                                                <div class="col-md-4">
                                                                    <input type="text" class="form-control" placeholder="XXXX"> </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Occupation</label>
                                                            <input type="text" id="custOccupation" name="custOccupation" placeholder="" class="form-control" maxlength="35" /> 
                                                        </div>
                                                        <div class="form-group">
                                                            <label class="control-label">Source of Funds</label>
                                                            <input type="text" id="custSourceOfFunds" name="custSourceOfFunds" placeholder="" class="form-control" maxlength="40"/> </div>

                                                       
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
                                                            <input type="text" id="custNationality" name="custNationality" placeholder="" class="form-control" required maxlength="25"/> </div>      
                                                        <div class="form-group">
                                                            <label class="control-label">Dependents and Age</label>
                                                            <textarea id="custDependentAndAge" name="custDependentAndAge" class="form-control" rows="3" placeholder="" maxlength="50"></textarea>
                                                        </div>
                                                   </div>
                                                </div>
                                            </div> <!-- TEMP CLOSING DIV -->

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
                                                                    <label class="control-label">Address type</label>
                                                                    <select class="form-control select2 select2-hidden-accessible" id="addtype" name ="addtype">
                                                                        <option value="1" class ="disabled selected">Select Here..</option>
                                                                        <?php foreach($addtype as $addtype2){ ?>
                                                                        <option value="<?php echo $addtype2['address_type_id'];?>"><?php echo $addtype2['address_type_name'];?></option>
                                                                        <?php } ?> 
                                                                    </select>  
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Barangay</label>
                                                                     <input type="text" id="barangay" name="barangay" maxlength="35" placeholder="" class="form-control"/>   
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">City <font color="red"> * </font></label>
                                                                    <select class="form-control select2 select2-hidden-accessible" id="city" name ="city">
                                                                        <option value="1" class ="disabled selected">Select Here..</option>
                                                                        <?php foreach($allcity as $allcity2){ ?>
                                                                        <option value="<?php echo $allcity2['address_city_id'];?>"><?php echo $allcity2['city_name'];?></option>
                                                                        <?php } ?> 
                                                                    </select>   
                                                                </div>     
                                                            </div>
                                                            <div class="col-md-6">
                                                                <div class="form-group">
                                                                    <label class="control-label">Provice</label>
                                                                    <select class="form-control select2 select2-hidden-accessible" id="province" name ="province">
                                                                        <option value="1" class ="disabled selected">Select Here..</option>
                                                                        <?php foreach($allprovince as $allprovince2){ ?>
                                                                        <option value="<?php echo $allprovince2['address_province_id'];?>"><?php echo $allprovince2['province_name'];?></option>
                                                                        <?php } ?> 
                                                                    </select>   
                                                                </div>
                                                                <div class="form-group">
                                                                    <label class="control-label">Country</label>
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
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="custSubmit" id="agentSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Agent</button>
                </div>  
            </form>        
        </div>
    </div>
</div>

<div style="display: none;" id="balloon_modify" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-md">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Modify Amortization</h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="form-group">
                            <div class="row static-info">
                                <div class="col-md-5"  align="left"> Amortization Amount</div>
                                <div class="col-md-7 value" >
                                    <input type="text" name="balloon_amort" style='text-align: right;' class="form-control" id="balloon_amort">
                                </div>
                                <input type="hidden" id='prev_run_bal'>
                                <input type="hidden" id='amort_line_type'>
                                <input type="hidden" id='line_num'>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="row static-info">
                                <div class="col-md-5"  align="left"> Check for leser Terms</div>
                                <div class="col-md-7">
                                    <input type="checkbox" id="if_less_terms" name="if_less_terms">
                                </div>
                            </div>
                        </div>
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="submit_new_amort" class="btn blue"><i class="fa fa-check" aria-hidden="true"></i>OK</button>
            </div> 
        </div>
    </div>
</div>

