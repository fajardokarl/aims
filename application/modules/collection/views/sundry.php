<div class="row hidden-print">
    <div class="col-md-6">
        <div class="hidden-print tabbable-line tabbable-full-width">
            <ul class="nav nav-tabs">
                <li class="active" id="tab1">
                    <li class="active" id="tab1">
                        <a href="#tab_customer" data-toggle="tab"> Customers </a>
                    </li>
                    <li class="" id="tab2">
                        <a href="#tab_org" data-toggle="tab"> Organizations </a>
                    </li> 
                    <li class="" id="tab3">
                        <a href="#tab_supplier" data-toggle="tab"> Suppliers </a>
                    </li> 
                    <li class="" id="tab4">
                        <a href="#tab_employee" data-toggle="tab"> Employees </a>
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
                                    <td style="display: none;"><?php echo $org['organization_id'];?></td>
                                    <td><?php echo $org['organization_name'];?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>                        
            </div>
            <div class="tab-pane" id="tab_supplier" style="height: 100%;">
                <div class="portlet light" style="">
                    <div class="row"> 
                        <table class="tblsupp table table-hover" id="tblsupp" >
                            <thead>
                                <tr>
                                    <th style="display: none;">Supplier ID</th>
                                    <th>Supplier</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($suppliers as $supp){ ?>
                                <tr>
                                    <td style="display: none;"><?php echo $supp['supplier_id'];?></td>
                                    <td><?php echo $supp['organization_name'];?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>                        
            </div>
            <div class="tab-pane" id="tab_employee" style="height: 100%;">
                <div class="portlet light" style="">
                    <div class="row"> 
                        <table class="tblemp table table-hover" id="tblemp" >
                            <thead>
                                <tr>
                                    <th style="display: none;">Employee ID</th>
                                    <th>Employee</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($employees as $emp){ ?>
                                <tr>
                                    <td style="display: none;"><?php echo $emp['employee_id'];?></td>
                                    <td><?php echo $emp['lastname'].', '.$emp['firstname'].' '.$emp['middlename'];?></td>
                                </tr>
                                <?php }?>
                            </tbody>
                        </table>
                    </div>
                </div>                        
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="row">
            <div class="portlet grey-cascade box " id="bankslists">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-money"></i>
                        <span class="caption"> Sundry Details</span>
                    </div>
                </div>
                <div class="portlet-body">          
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Subsidiary Name :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5 id="subsidiary_name"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Subsidiary Type :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5 id="subsidiary_type"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Subsidiary Code :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5 id="subsidiary_code"></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Book Code :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="bookcode1" name="bookcode1" data-toggle="modal" data-target="#bookCodeModal1"  placeholder="Select Book Code..." maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Book Code Desc:</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5 id='bookcode_desc'><b></b></h5>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Book Code Prefix:</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5 id='bookcode_prefix'><b></b></h5>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
        <div class="row">
            <div class="portlet grey-cascade box " id="bankslists">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-plus"></i>
                        <span class="caption"> Add Sundry Payment </span>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Debit Amount :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <input type="number" id="debit" name="debit"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Credit Amount :</b></h5>
                        </div>
                        <div class="col-md-8">
                            <input type="number" id="credit" name="credit"  placeholder="0" maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Account Code:</b></h5>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="accountcode" name="accountcode" data-toggle="modal" data-target="#accountCodeModal"  placeholder="Select Account Code..." maxlength="30" class="form-control" required/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <h5><b>Account Code Desc:</b></h5>
                        </div>
                        <div class="col-md-8">
                            <h5 id='accountcode_desc'><b></b></h5>
                        </div>
                    </div>
                    <!-- <div class="row">
                        <div class="col-md-4">
                            <h5><b>Book Code:</b></h5>
                        </div>
                        <div class="col-md-8">
                            <input type="text" id="bookcode2" name="bookcode2" data-toggle="modal" data-target="#bookCodeModal2"  placeholder="Select Book Code..." maxlength="30" class="form-control" required/>
                        </div>
                    </div> -->
                    <div class="row">
                        <div class="col-md-12">
                            <button style="float: right;" type="button" class="btn btn-circle green" id="add"><i class="fa fa-plus"></i> Add Sundry Payment</button>
                        </div>
                    </div>       
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="row hidden-print" id='payment'>
    <div class="col-md-12">
        <div class="portlet grey-cascade box " id="bankslists">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-money"></i>
                    <span class="caption"> Payments </span>
                </div>
            </div>
            <div class="portlet-body">          
                <div class="row">
                    <div class="col-md-12">
                        <table class="tblsundrypayments table table-hover" id="tblsundrypayments">
                            <thead>
                                <tr>
                                    <th>Account Code</th>
                                    <th>Account Code Description</th>
                                    <th>Book Code</th>
                                    <th>Book Code Prefix</th>
                                    <th>Debit Amount</th>
                                    <th>Credit Amount</th>
                                    <th>&nbsp</th>
                                </tr>
                            </thead>
                            <tbody id="tbody_sundrypayments">
                      
                            </tbody>
                        </table>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-md-12">
                        <button style="float: right;" type="button" class="btn btn-circle green" id="post" data-toggle="modal" data-target="#postSundryPayments"><i class="fa fa-floppy-o"></i> Post Sundry Payments</button>
                    </div>
                </div>
            </div> 
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="postSundryPayments" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 1000px; width: 700px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs hidden-print">
                            <li class="active hidden-print" id="tab1">
                                <li class="active" id="tab1">
                                    <a href="#summary1" data-toggle="tab"> Save Sundry Payments </a>
                                </li>
                            </li>
                        </ul>
                        <div class="tab-content" id="tab_summary">
                            <div class="tab-pane active" id="summary1">
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><b>Payment Type :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <select id="paymenttype" class="form-control select2 select2-hidden-accessible">
                                            <?php foreach($paymentType as $p) {?>
                                            <option value="<?php echo $p['payment_mode_id'];?>"><?php echo $p['payment_name'];?></option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><b>Payment Date :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input  type="date" name="paymentdate" value="<?php echo date('Y-m-d'); ?>" class="form-control" id="paymentdate" maxlength="10" required />
                                    </div>
                                </div>
                                <div class="row cash" id='cashpayment'>
                                    <div class="col-md-4">
                                        <h5><b>Cash Amount :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" id="cash" name="cash"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row check" id='checkpayment4' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Bank :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control select2 select2-hidden-accessible" id="bank2" name ="bank">
                                            <option value="0" class ="disabled selected">Select Bank..</option>
                                            <?php foreach($allbanks2 as $a){ ?>
                                            <option value="<?php echo $a['bank_id'];?>"><?php echo $a['bank_name'];?></option>
                                            <?php } ?> 
                                        </select> 
                                    </div>
                                </div>
                                <div class="row check" id='checkpayment1' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Check Amount :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" id="checkamount" name="checkamount"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row check" id='checkpayment2' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Check Number :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="checknumber" name="checknumber"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row check" id='checkpayment3' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Check Date :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" id="checkdate" name="checkdate"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row interbranch" id='interbranchpayment1' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Deposit Amount :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" id="depositamount" name="depositamount"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row interbranch" id='interbranchpayment2' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Account Number :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="text" id="accountnumber" name="accountnumber"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row interbranch" id='interbranchpayment3' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Bank :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <select class="form-control select2 select2-hidden-accessible" id="bank" name ="bank">
                                            <option value="0" class ="disabled selected">Select Bank..</option>
                                            <?php foreach($allbanks as $allbanks2){ ?>
                                            <option value="<?php echo $allbanks2['bank_id'];?>"><?php echo $allbanks2['bank_name'];?></option>
                                            <?php } ?> 
                                        </select> 
                                    </div>
                                </div>
                                <div class="row interbranch" id='interbranchpayment4' style="display: none;">
                                    <div class="col-md-4">
                                        <h5><b>Deposit Date :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="date" id="depositdate" name="depositdate"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><b>Vatable Amount :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" id="vatableamount" name="vatableamount"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h5><b>Vat :</b></h5>
                                    </div>
                                    <div class="col-md-8">
                                        <input type="number" id="vatamount" name="vatamount"  placeholder="0" maxlength="30" class="form-control" required/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                    <button type="button" id="save" class="btn green hidden-print">Save</button>
                </div>
              </div>        
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="accountCodeModal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 1000px; width: 700px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <table class="tblacccodes table table-hover" id="tblacccodes">
                        <thead>
                            <tr>
                                <th>Account Code</th>
                                <th>Account Code Description</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_acccodes">
                            <?php foreach($accounts as $account) {?>
                            <tr>
                                <td><?php echo $account['account_code'];?></td>
                                <td><?php echo $account['account_name'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                </div>
              </div>        
        </div>
    </div>
</div>

<div style="" class="modal fade bs-modal-lg" id="bookCodeModal1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 1000px; width: 700px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <table class="tblbookcodes1 table table-hover" id="tblbookcodes1">
                        <thead>
                            <tr>
                                <th>Book Code</th>
                                <th>Book Code Description</th>
                                <th>Book Code Prefix</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_acccodes1">
                            <?php foreach($books1 as $book) {?>
                            <tr>
                                <td><?php echo $book['book_code'];?></td>
                                <td><?php echo $book['book_description'];?></td>
                                <td><?php echo $book['book_reference'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                </div>
              </div>        
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="bookCodeModal2" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full" style="height: 1000px; width: 700px;">
        <div class="modal-content">
            <div class="modal-body">
                <div class="profile">
                    <table class="tblbookcodes2 table table-hover" id="tblbookcodes2">
                        <thead>
                            <tr>
                                <th>Book Code</th>
                                <th>Book Code Description</th>
                                <th>Book Code Prefix</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_acccodes2">
                            <?php foreach($books2 as $book) {?>
                            <tr>
                                <td><?php echo $book['book_code'];?></td>
                                <td><?php echo $book['book_description'];?></td>
                                <td><?php echo $book['book_reference'];?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline hidden-print" data-dismiss="modal">Close</button>
                </div>
              </div>        
        </div>
    </div>
</div>

