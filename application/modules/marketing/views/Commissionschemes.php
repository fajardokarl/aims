<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="bankslists">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Commission Schemes List</span>
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddNewCommission" id="addNewCommission"><i class="fa fa-plus"> </i>New Commission Scheme</button>
                </div>
            </div>
            <div class="portlet-body">
              
                <table class="tblcommission table table-hover" id="tblcommission" >
                    <thead>
                        <tr>
                            <th style="display: none;">Commission ID</th>
                            <th>Commission Name</th>
                            <th>Commission Type</th>
                            <th>Percent Commission</th>
                            <th>Percent TCP Paid</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_rp">
                    <?php foreach($commission as $commission){ ?>
                        <tr>
                            <td style="display: none;"><?php echo $commission['commission_id']?></td>
                            <td><?php echo $commission['commission_name'];?></td>
                            <td><?php echo $commission['commission_type_name'];?></td>
                            <td><?php echo $commission['percent_commission'].'%';?></td>
                            <td><?php echo $commission['percent_tcp_paid'].'%';?></td>
                        </tr>
                    <?php }?>
                    </tbody>
                </table>       
            </div>
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="AddNewCommission" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="commissionForm" name="commissionForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <a href="#tab_commission" data-toggle="tab"> New Commission Scheme </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_commission">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Commission Name<font color="red"> *</font></label>
                                            <input type="text" id="commissionName" name="commissionName"  placeholder="Enter Commission Name" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Commission Type</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="commissionType" name ="payment_scheme">
                                                <option value="0" class ="disabled selected">Select Here..</option>
                                                <?php foreach($commission_type as $commission_type){ ?>
                                                  <option value="<?php echo $commission_type['commission_type'];?>"><?php echo $commission_type['commission_type_name'];?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Percent Commission<font color="red"> *</font></label>
                                            <input type="number" id="percentCommission" name="percentCommission"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Percent TCP Paid<font color="red"> *</font></label>
                                            <input type="number" id="tcpCommission" name="tcpCommission"  placeholder="%" maxlength="30" class="form-control" required/>
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
                    <button type="submit" name="commissionSchemeSubmit" id="commissionSchemeSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Commission Scheme</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>
<div style="" class="modal fade bs-modal-lg" id="UpdateCommission" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
        <form action="" method="POST" id="updateCommissionForm" name="updateCommissionForm">
            <div class="modal-body">
                <div class="profile">
                    <div class="tabbable-line tabbable-full-width">
                        <ul class="nav nav-tabs">
                            <li class="active" id="tab1">
                                <a href="#tab_commission" data-toggle="tab"> New Commission Scheme </a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div class="tab-pane active" id="tab_commission">
                                <div class="row">
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Commission Name<font color="red"> *</font></label>
                                            <input type="text" id="updateCommissionName" name="updateCommissionName"  placeholder="Enter Commission Name" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Commission Type</label>
                                            <select class="form-control select2 select2-hidden-accessible" id="updateCommissionType" name ="updateCommissionType">
                                                <option value="0" class ="disabled selected">Select Here..</option>
                                                <?php foreach($commission_type2 as $commission_type2){ ?>
                                                  <option value="<?php echo $commission_type2['commission_type'];?>"><?php echo $commission_type2['commission_type_name'];?></option>
                                                <?php } ?> 
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Percent Commission<font color="red"> *</font></label>
                                            <input type="number" id="updatePercentCommission" name="updatePercentCommission"  placeholder="%" maxlength="30" class="form-control" required/>
                                        </div>
                                    </div>
                                    <div class="col-md-3">

                                        <div class="form-group">
                                            <label class="control-label">Percent TCP Paid<font color="red"> *</font></label>
                                            <input type="number" id="updateTcpCommission" name="updateTcpCommission"  placeholder="%" maxlength="30" class="form-control" required/>
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
                    <button type="submit" name="updateCommissionSchemeSubmit" id="updateCommissionSchemeSubmit" class="btn green"><i class="fa fa-plus"></i> Save New Commission Scheme</button>
                </div>
              </div>   
        </form>        
        </div>
    </div>
</div>