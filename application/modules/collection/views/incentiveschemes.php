<div class="row">
        <div class="col-md-12">
            <div class="portlet light " id="bankslists">
                <div class="portlet-title">
                    <div class="caption font-green-sharp">
                        <i class="fa fa-users font-green-sharp"></i>
                        <span class="caption-subject bold uppercase"> Incentive Schemes List</span>
                    </div>
                    <div class="actions">
                        <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddNewIncentive" id="addNewIncentive"><i class="fa fa-plus"> </i>New Incentive Scheme</button>
                    </div>
                </div>
                <div class="portlet-body">
                  
                    <table class="tblincentives table table-hover" id="tblincentives" >
                        <thead>
                            <tr>
                                <th style="display: none;">Incentive ID</th>
                                <th>Project</th>
                                <th>Payment Scheme</th>
                                <th>Incentives</th>
                                <th>Reservation Bonus</th>
                                <th>Scheme Bonus</th>
                            </tr>
                        </thead>
                        <tbody id="tbody_rp">
                        <?php foreach($incentives as $incentives){ ?>
                        <tr>
                            <td style="display: none;"><?php echo $incentives['incentive_id'];?></td>
                            <td><?php echo $incentives['project_name'];?></td>
                            <td><?php echo $incentives['payment_scheme_name'];?></td>
                            <td><?php echo '₱'; echo number_format($incentives['reservation_bonus']+$incentives['scheme_bonus'], 2, '.', '');?></td>
                            <td><?php echo '₱'.$incentives['reservation_bonus'];?></td>
                            <td><?php echo '₱'.$incentives['scheme_bonus'];?></td>
                        </tr>
                        <?php } ?>
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="AddNewIncentive" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="incentiveForm" name="incentiveForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <a href="#tab_incentive" data-toggle="tab"> New Incentive Scheme </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_incentive">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Project<font color="red"> *</font></label>
                                            <select class="form-control select2 select2-hidden-accessible" id="projects" name ="projects">
                                                <option value="0" class ="disabled selected">Select Here..</option>
                                                <?php foreach($projects as $projects){ ?>
                                                  <option value="<?php echo $projects['project_id'];?>"><?php echo $projects['project_name'];?></option>
                                                <?php } ?> 

                                          </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Payment Scheme</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="payment_scheme" name ="payment_scheme">
                                                <option value="0" class ="disabled selected">Select Here..</option>
                                                <?php foreach($payment_schemes as $payment_schemes){ ?>
                                                  <option value="<?php echo $payment_schemes['payment_scheme_id'];?>"><?php echo $payment_schemes['payment_scheme_name'];?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Reservation Bonus<font color="red"> *</font></label>
                                            <input type="number" id="reservationBonus" name="reservationBonus"  placeholder="Enter Amount" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Scheme Bonus<font color="red"> *</font></label>
                                            <input type="number" id="schemeBonus" name="schemeBonus"  placeholder="Enter Amount" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- done -->
                        </div>
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="incentiveSchemeSubmit" id="incentiveSchemeSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Payment Scheme</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="UpdateIncentiveScheme" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="updateIncentiveForm" name="updateIncentiveForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <a href="#tab_incentive" data-toggle="tab"> Update Incentive Scheme </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_incentive">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Project<font color="red"> *</font></label>
                                            <select class="form-control select2 select2-hidden-accessible" id="updateProjects" name ="updateProjects">
                                                <option value="0" class ="disabled selected">Select Here..</option>
                                                <?php foreach($projects2 as $projects){ ?>
                                                  <option value="<?php echo $projects['project_id'];?>"><?php echo $projects['project_name'];?></option>
                                                <?php } ?> 

                                          </select> 
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Payment Scheme</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="updatePaymentScheme" name ="updatePaymentScheme">
                                                <option value="0" class ="disabled selected">Select Here..</option>
                                                <?php foreach($payment_schemes2 as $payment_schemes){ ?>
                                                  <option value="<?php echo $payment_schemes['payment_scheme_id'];?>"><?php echo $payment_schemes['payment_scheme_name'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Reservation Bonus<font color="red"> *</font></label>
                                            <input type="number" id="updateReservationBonus" name="updateReservationBonus"  placeholder="Enter Amount" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Scheme Bonus<font color="red"> *</font></label>
                                            <input type="number" id="updateSchemeBonus" name="updateSchemeBonus"  placeholder="Enter Amount" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                                <!-- done -->
                        </div>
                    </div>
                        <!-- end -->
                </div>
                <div class="modal-footer">
                    <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                    <button type="submit" name="updateIncentiveSchemeSubmit" id="updateIncentiveSchemeSubmit" class="btn green"><i class="fa fa-plus"></i> Update Payment Scheme</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
