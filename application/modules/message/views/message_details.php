<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Contract </span>
            </div>
            <div class="actions"> 
                <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Get PDF</button>
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
                                    <?php echo "&#8369; " . number_format($contract->lot_price, 2); ?>
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
