<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Contract </span>
            </div>
            <div class="actions"> 
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_resagreement"><i class="fa fa-plus"> </i>Reservation Agreement PDF</button>
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Amortization Schedule PDF</button>
            </div>
        </div>
        <div class="portlet-body">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="form-group"> -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Contract No:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $contract->contract_id; ?>
                                    <input type="hidden" id="id_contract" value="<?php echo $contract->contract_id; ?>">
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Customer:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $contract->lastname . ', ' . $contract->firstname . ' ' . $contract->middlename ; ?>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Contract Date:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $contract->contract_date; ?>
                                </p> 
                            </div> 
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Plan Type:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $contract->payment_scheme_name; ?>
                                </p>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Booked:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                        if ($contract->is_booked == 0) {
                                            echo " No"; 
                                        }else{
                                            echo " Yes"; 
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Invoiced:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                        if ($contract->is_invoiced == 0) {
                                            echo " No"; 
                                        }else{
                                            echo " Yes"; 
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <!-- </div> -->
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Lot:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $contract->lot_description; ?>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Lot Price:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo "&#8369; " . number_format($contract->price_per_sqr_meter + $contract->lot_area, 2); ?>
                                </p>
                            </div> 
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Added VAT:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo "&#8369; " . number_format($contract->lot_vat, 2); ?>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> TCP:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo "&#8369; " . number_format($contract->total_contract_price, 2); ?>
                                </p>
                            </div>
                        </div>
                        <input type="hidden" id="tcp" value="<?php echo $contract->total_contract_price; ?>">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Deferred:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php 
                                        if ($contract->is_tax_deferred == 0) {
                                            echo " No"; 
                                        }else{
                                            echo " Yes"; 
                                        }
                                    ?>
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Status:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static" id="cont_status">
                                    <?php 
                                        echo $contract->contract_status_name . "  ";
                                    ?>
                                </p>

                                <select id='cont_status_opt' class="form-control col-md-3" style="display:none;">
                                    <?php foreach ($cont_stat_val as $cont_stat_val) { ?>
                                        <option value="<?php echo $cont_stat_val['contract_status_id']; ?>"><?php echo $cont_stat_val['contract_status_name']; ?></option>
                                    <?php } ?>
                                </select>
                                <input type="hidden" id="cont_status_id" value="<?php echo $contract->contract_status_id; ?>">
                                <input type="hidden" id="cont_id" value="<?php echo $contract->contract_id; ?>">

                                <a type="button" align="right" id="edit_status" class="btn-xs btn blue-dark"> Change</a>
                                
                                <div style="display:none; align-content: right;" id="edit_buttons">
                                    <a type="button" align="right" id="save_status" class="btn-xs btn blue col-md-2"> Save</a>
                                    <a type="button" align="right" id="cancel_edit" class="btn-xs btn red  col-md-2"> Cancel</a>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>
<div class="row">
    <div class="col-md-12">
        <div class="tabbable-line tabbable-full-width">
            <ul class=" nav nav-tabs">
                <li class="active">
                    <a href="#tab-amort" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                Amortization
                            </span>
                        </div>
                    </a>
                </li>
                 <li class="">
                    <a href="#tab-misc" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                Miscellaneous
                            </span>
                        </div>
                    </a>
                </li>
                <li class="">
                    <a href="#tab-pays" data-toggle="tab">
                        <div class="caption">
                            <span class="caption-subject font-grey-mint bold uppercase">
                                Payments
                            </span>
                        </div>
                    </a>
                </li>
            </ul>
        </div>
        <div class="tab-content">
            <div class="tab-pane active" id="tab-amort">
                <div class="portlet light " id="customermasterlist">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="fa fa-users font-green-sharp"></i>
                            <span class="caption-subject bold uppercase">Amortization Details</span>
                        </div>
                        <div class="actions"> 
                            <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-bordered table-striped" id="tblAmortdetails">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> type </th>
                                    <th> Due Date </th>
                                    <th> Amort Amount </th>
                                    <th> Interest </th>
                                    <th> Principal </th>
                                    <th> Run Balance </th>
                                    <th> Payment Date </th>
                                    <th> Status </th>
                                    <!-- <th> Action </th> -->
                                </tr>
                            </thead>
                            <tbody> 
                            <?php $i = 1; 
                                foreach($amort as $amort){ ?>
                                <tr>
                                    <td><?php echo $amort['amortization_id'];?></td>
                                   <!--  <td><?php
                                        #if ($amort['line_type'] == 4) {
                                        #    echo $amort['line_type_name'] . " " . $i;
                                        #    $i++;
                                        #} else {
                                        #    echo $amort['line_type_name'];
                                        #}
                                    ?></td> -->
                                    <td><?php echo $amort['line_description'];?></td>
                                    <td><?php echo $amort['due_date'];?></td>
                                    <td align="right"><?php echo number_format($amort['amortization_amount'], 2);?></td>

                                    <td align="right"><?php echo number_format($amort['interest_amount'], 2);?></td>
                                    <td align="right"><?php echo number_format($amort['principal_amount'], 2);?></td>
                                    <td align="right"><?php echo number_format($amort['outstanding_balance'], 2);?></td>
                                    <td align="right"><?php echo $amort['pay_date'];?></td>
                                    <td><?php 
                                    if ($amort['line_type'] == 4 || $amort['line_type'] == 3 ||  $amort['line_type'] == 2) {
                                        if ($amort['paid_up'] == 1) { ?> 
                                            <span class="font-green-jungle"><i class="fa fa-check" aria-hidden="true"></i> PAID</span>
                                        <?php }else{ ?>
                                             <span class="font-red-intense"><i class="fa fa-close" aria-hidden="true"></i> PENDING</span>
                                        <?php } ?>                                            
                                    <?php } else { ?>
                                        <span class="font-blue"><i class="fa fa-arrow-down" aria-hidden="true"></i> LESS</span>
                                    <?php } ?>
                                    </td>
                                    <!-- <td><a href="" class="btn green btn-xs edit_amort_details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit</a></td> -->
                                </tr>
                            <?php } ?> 
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-misc">
                <div class="portlet light " id="customermasterlist">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="fa fa-users font-green-sharp"></i>
                            <span class="caption-subject bold uppercase">Miscellaneous Details</span>
                        </div>
                        <div class="actions"> 
                            <button type="button" data-target="#add_misc_modal" data-toggle="modal" id="add_misc_btn" class="btn blue"></i>Add Miscellaneous </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-bordered table-striped" id="tbl-misc-details">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Due Date </th>
                                    <th> Misc Fee</th>
                                    <th> Action </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($misc as $misc) { ?>
                                    <tr>
                                        <td><?php echo $misc['miscelaneous_id'];?></td>
                                        <td><?php
                                            $date = strtotime($misc['due_date']);
                                                echo date('M d, Y', $date);
                                            ?></td>
                                        <td><?php echo number_format($misc['miscelaneous_amount'], 2);?></td>
                                        <td><a class="btn green btn-xs edit_misc_details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit</a></td>
                                    </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="tab-pane" id="tab-pays">
                <div class="portlet light " id="customermasterlist">
                    <div class="portlet-title">
                        <div class="caption font-green-sharp">
                            <i class="fa fa-users font-green-sharp"></i>
                            <span class="caption-subject bold uppercase">Payments Details</span>
                        </div>
                        <div class="actions"> 
                            <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                        </div>
                    </div>
                    <div class="portlet-body">
                        <table class="table table-hover table-bordered table-striped" id="tbl-payments">
                            <thead>
                                <tr>
                                    <th> ID </th>
                                    <th> Paid Date </th>
                                    <th> Amount</th>
                                    <th> Principal</th>
                                    <th> Surcharge </th>
                                    <th> OR # </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach ($payment as $payment) { ?>
                                    <tr>
                                        <td><?php echo $payment['payment_id'];?></td>
                                        <td><?php echo $payment['pay_date'];?></td>
                                        <td align='right'><?php echo number_format($payment['amount'], 2);?></td>
                                        <td align='right'><?php echo number_format($payment['principal'], 2);?></td>
                                        <td align='right'><?php echo number_format($payment['surcharge'], 2);?></td>
                                        <td><?php echo $payment['pay_reference'];?></td>
                                        <!-- <td><a class="btn green btn-xs edit_misc_details"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> edit</a></td> -->
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
<div id="add_misc_modal" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Add Miscellaneous</h4> 
            </div>


            <div class="modal-body">
            <h4> Miscellaneous Amount : <span class="caption font-blue" id="misc_amount"> </span></h4>
                <div class="row">
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Terms : </label>
                            <input type="text" name="terms_misc" id="terms_misc" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="form-group">
                            <label>Date Start :</label>
                            <input type="date" name="date_misc" id="date_misc" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-2">
                        <div class="form-group">
                            <label class="font-white">. </label>
                            <button class="btn blue form-control" id="compute_misc">Compute</button>
                        </div>
                    </div>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        <table id="misc_table" class="table table-hover order-column">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Amount</th>
                                </tr>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div> 

            <div class="modal-footer">
                 <button type="button" id="save_misc" class="btn green">Save</button>
                 <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>



<!-- <div style="display: none;" id="detailed_edit" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            // <form method="POST" action="<?=base_url()?>marketing/trigger_update_amort">
                <div class="modal-header">
                    <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                    <h4 class="modal-title"><span class="caption-subject bold uppercase">Contract Edit<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-body">
                                <div class="form-group" style="display: none">
                                <label class="col-md-3 control-label">amort id</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_id" id="det_id" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                <label class="col-md-3 control-label">Due Date</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_duedate" id="det_duedate" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-3 control-label">Amort amount</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_amort_amt" id="det_amort_amt" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-3 control-label">Miscellaneous Fee</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_misc" id="det_misc" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-3 control-label">Interest</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_interest" id="det_interest" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                 <div class="form-group">
                                <label class="col-md-3 control-label">Principal</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_principal" id="det_principal" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                <div class="form-group">
                                <label class="col-md-3 control-label">Run Balance</label>
                                    <div class="col-md-9">
                                         <input type="text" class="form-control" name="det_balance" id="det_balance" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none">
                                <label class="col-md-3 control-label">contract id</label>
                                    <div class="col-md-9">
                                         // <input type="text" class="form-control" name="det_contid" value=<?=$this->input->get('contractid')?> id="det_contid" placeholder="Enter text">
                                         <span class="help-block">  </span>
                                    </div>
                                </div>
                            </div>
                        </div> 
                    </div>
                </div> 
                <div class="modal-footer">
                     <button type="button" id="close_all" class="btn dark btn-outline" data-dismiss="modal">Close</button>
                     <input type="submit" value="Save" class="btn green"/>
                </div>
            </form>
        </div>
    </div>
</div> -->