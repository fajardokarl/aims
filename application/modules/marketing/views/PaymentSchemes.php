<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="paymentSchemesList">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Payment Schemes List</span>
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddPaymentScheme" id="addNewPaymentScheme"><i class="fa fa-plus"> </i>New Payment Scheme</button>
                </div>
            </div>
            <div class="portlet-body">
              
                <table class="tblpaymentschemeslists table table-hover" id="tblpaymentschemeslists" >
                    <thead>
                    <tr>
                        <th style="display: none;">Payment Scheme ID</th>
                        <th>Payment Scheme</th>
                        <th>Reservation Fee</th>
                        <th>Deposit Rate</th>
                        <th>Discount Rate</th>
                        <th>Interest Rate</th>
                        <th>Surcharge Rate</th>
                        <th>Terms</th>
                        <th>Amortization Rate</th>
                        <th>Amortization Discount Rate</th>
                        <th>Amortization Interest Rate</th>
                        <th>Amortization Surcharge Rate</th>
                        <th>Amortization Terms</th>
                    </tr>
                    </thead>
                <tbody>
                <?php foreach($payment_scheme as $payment_scheme){ ?>
                    <tr>
                        <td style="display: none;"><?php echo $payment_scheme['payment_scheme_id'];?></td>
                        <td><?php echo $payment_scheme['payment_scheme_name'];?></td>
                        <td><?php echo $payment_scheme['reservation_fee'];?></td>
                        <td><?php echo $payment_scheme['deposit_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['discount_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['interest_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['surcharge_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['terms'].' months';?></td>
                        <td><?php echo $payment_scheme['amortization_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['amortization_discount_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['amortization_interest_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['amortization_surcharge_rate'].'%';?></td>
                        <td><?php echo $payment_scheme['amortization_terms'].' months';?></td>
                    </tr>
                <?php } ?> 
                </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="AddPaymentScheme" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="paymentSchemeForm" name="paymentSchemeForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <a href="#tab_paymentScheme" data-toggle="tab"> New Payment Scheme </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_paymentScheme">
                                <div class="row" style="position: relative;">
                                    <div class="col-md-6">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <div class="form-group">
                                                        <!-- <button type="button" id="test">TEST</button> -->
                                                        <label for="multiple" class="control-label">Project</label>
                                                        <select id="project_scheme" name="project_scheme" class="form-control select2-multiple select2-hidden-accessible" multiple="" placeholder="Project">
                                                            <?php foreach ($project as $project): ?>
                                                                <option value="<?php echo $project['project_id']; ?>"><?php echo $project['project_description']; ?></option>
                                                            <?php endforeach ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Reservation Fee</label>
                                            <input type="number" id="psReservationFee" name="psReservationFee"  placeholder="" maxlength="30" class="form-control" />
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="control-label">Payment Scheme Name<font color="red"> *</font></label>
                                            <input type="text" id="paymentSchemeName" name="paymentSchemeName"  placeholder="Payment Scheme Name" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Deposit Rate<font color="red"> *</font></label>
                                            <input type="number" id="psDepositRate" name="psDepositRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Discount Rate<font color="red"> *</font></label>
                                            <input type="number" id="psDiscountRate" name="psDiscountRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Interest Rate<font color="red"> *</font></label>
                                            <input type="number" id="psInterestRate" name="psInterestRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Surcharge Rate<font color="red"> *</font></label>
                                            <input type="number" id="psSurchargeRate" name="psSurchargeRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Terms<font color="red"> *</font></label>
                                            <input type="number" id="psTerms" name="psTerms"  placeholder="Number of Months" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Rate<font color="red"> *</font></label>
                                            <input type="number" id="psAmortizationRate" name="psAmortizationRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Discount Rate<font color="red"> *</font></label>
                                            <input type="number" id="psAmortizationDiscountRate" name="psAmortizationDiscountRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Interest Rate<font color="red"> *</font></label>
                                            <input type="number" id="psAmortizationInterestRate" name="psAmortizationInterestRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Surcharge Rate<font color="red"> *</font></label>
                                            <input type="number" id="psAmortizationSurchargeRate" name="psAmortizationSurchargeRate"  placeholder="Number of Months" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Terms<font color="red"> *</font></label>
                                            <input type="number" id="psAmortizationTerms" name="psAmortizationTerms"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <!-- done -->
                                </div>
                            </div>
                                <!-- done -->
                        </div>
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="paymentSchemeSubmit" id="paymentSchemeSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Payment Scheme</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
<!-- PAYMENT SCHEME UPDATE MODAL -->
<div style="" class="modal fade bs-modal-lg" id="UpdatePaymentScheme" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="paymentSchemeUpdateForm" name="paymentSchemeUpdateForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <a href="#tab_customer" data-toggle="tab"> Update Payment Scheme </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_customer">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Payment Scheme Name<font color="red"> *</font></label>
                                            <input type="text" id="updatePaymentSchemeName" name="paymentSchemeName"  placeholder="Payment Scheme Name" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Reservation Fee</label>
                                            <input type="number" id="updatePsReservationFee" name="updatePsReservationFee"  placeholder="" maxlength="30" class="form-control" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Deposit Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsDepositRate" name="psDepositRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Discount Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsDiscountRate" name="psDiscountRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Interest Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsInterestRate" name="psInterestRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Surcharge Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsSurchargeRate" name="updatePsSurchargeRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Terms<font color="red"> *</font></label>
                                            <input type="number" id="updatePsTerms" name="psTerms"  placeholder="Number of Months" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsAmortizationRate" name="psAmortizationRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Discount Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsAmortizationDiscountRate" name="psAmortizationDiscountRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Interest Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsAmortizationInterestRate" name="psAmortizationInterestRate"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Surcharge Rate<font color="red"> *</font></label>
                                            <input type="number" id="updatePsAmortizationSurchargeRate" name="psAmortizationSurchargeRate"  placeholder="Number of Months" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">

                                        <div class="form-group">
                                            <label class="control-label">Amortization Terms<font color="red"> *</font></label>
                                            <input type="number" id="updatePsAmortizationTerms" name="psAmortizationTerms"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <!-- done -->
                                </div>
                            </div>
                                <!-- done -->
                        </div>
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="paymentSchemeUpdateSubmit" id="paymentSchemeUpdateSubmit" class="btn green"><i class="fa fa-plus"></i> Update Payment Scheme</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
