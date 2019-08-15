<div class="row hidden-print">
    <div class="portlet light " id="monthlydues">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="fa fa-money font-green-sharp"></i>
                <span class="caption-subject bold uppercase"> Aging Reports</span>
            </div>
            <div class="actions">
                
            </div>
        </div>
        <div class="portlet-body"> 
            <div class="hidden-print tabbable-line tabbable-full-width">
                <ul class="nav nav-tabs">
                    <li class="active" id="tab1">
                        <li class="active" id="tab1">
                            <a href="#tab_detailed" data-toggle="tab"> <b>Detailed Report</b> </a>
                        </li>
                        <li class="" id="tab1">
                            <a href="#tab_summary" data-toggle="tab"> <b>Summary Report</b> </a>
                        </li> 
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="tab" style="height: 100%;">
                <div class="tab-pane active" id="tab_detailed" style="height: 100%;">
                    <div class="portlet light">
                        <div class="row">
                            <h4><b>Detailed</b></h4>
                            <br>
                            <a class="btn circle blue hidden-print" style="float: right;" id="excel_detailed">Generate Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <a class="btn circle blue hidden-print" style="float: right;" id="print_detailed">Print Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <!-- <a class="btn circle blue hidden-print" style="float: right;" id="print_detailed">Print
                            <i class="fa fa-print"></i></a> -->
                            <table class="tbldetailedaging table table-hover" id="tbldetailedaging">
                                <thead>
                                    <tr>
                                        <th>Customer Name</th>
                                        <th>0-30 Days</th>
                                        <th>31-60 Days</th>
                                        <th>61-90 Days</th>
                                        <th>91-120 Days</th>
                                        <th>120 Days and More</th>
                                        <th>Current Total</th>
                                        <th>Longterm Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_da">
                                    
                                    
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>0-30 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="030total"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>All Current Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="currenttotal"></h5></b>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>31-60 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="3160total"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>All Longterm Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="longtermtotal"></h5></b>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>61-90 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="6190daystotal"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>91-120 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="91120daystotal"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>120 Days And More Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="120daystotal"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                             
                        </div>
                    </div>                        
                </div>
                <div class="tab-pane" id="tab_summary" style="height: 100%;">
                    <div class="portlet light" style="">
                        <div class="row"> 
                            <h4><b>Summary</b></h4>
                            <br>
                            
                            <div class="form-group">
                                <div class="col-md-4">
                                    <h4 class="control-label">Type<font color="red"> * </font></h4>
                                    <select class="form-control select2 select2-hidden-accessible" id="type" name ="type" required>
                                        <option value="0" class ="disabled selected">Select Here..</option>
                                        <option value="1">Project</option>
                                        <option value="2">Tax Type</option>
                                        <option value="3">Both</option>
                                        <!-- <option value="3">Both</option> -->
                                    </select>
                                </div>
                                <!-- <div class="col-md-6" id="project_select" style="display: none;">
                                    <h4 class="control-label">Project<font color="red"> * </font></h4>
                                    <select class="form-control select2 select2-hidden-accessible" id="project_type" name ="project_type" required>
                                    </select>
                                </div>
                                <div class="col-md-6" id="installment_select" style="display: none;">
                                    <h4 class="control-label">Tax Type<font color="red"> * </font></h4>
                                    <select class="form-control select2 select2-hidden-accessible" id="installment_type" name ="installment_type" required>
                                        <option value="0" class ="disabled selected">Select Here..</option>
                                        <option value="1">Both</option>
                                        <option value="2">Installment</option>
                                        <option value="3">Deferred</option>
                                    </select>
                                </div> -->
                                <div class="col-md-2" id="installment_select" >
                                    <h4 class="control-label">&nbsp;</h4>
                                    <button type="button" class="btn btn-circle green" id="generate">Generate</button>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="row" style="display: none;" id="summaryrow">
                            <br>
                            <a class="btn circle blue hidden-print" style="float: right;" id="excel_summary1">Generate Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <a class="btn circle blue hidden-print" style="float: right;" id="print_detailed1">Print Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <a class="btn circle blue hidden-print" style="float: right;" id="excel_summary3">Generate Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <a class="btn circle blue hidden-print" style="float: right; display: none;" id="print_detailed3">Print Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <!-- <a class="btn circle blue hidden-print" style="float: right;" id="print_summary1">Print
                            <i class="fa fa-print"></i></a> -->
                            
                            <table class="tblsummaryaging table table-hover" id="tblsummaryaging">
                                <thead>
                                    <tr>
                                        <th>Project Name</th>
                                        <th>0-30 Days</th>
                                        <th>31-60 Days</th>
                                        <th>61-90 Days</th>
                                        <th>91-120 Days</th>
                                        <th>120 Days and More</th>
                                        <th>Current Total</th>
                                        <th>Longterm Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_sa">
                                    
                                    
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>0-30 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="030total2"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>All Current Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="currenttotal2"></h5></b>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>31-60 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="3160total2"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>All Longterm Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="longtermtotal2"></h5></b>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>61-90 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="6190daystotal2"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>91-120 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="91120daystotal2"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>120 Days And More Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="120daystotal2"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                             
                        </div>
                        <br>
                        <div class="row" style="display: none;" id="summaryrow2">
                            <br>
                            <a class="btn circle blue hidden-print" style="float: right;" id="excel_summary2">Generate Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <a class="btn circle blue hidden-print" style="float: right;" id="print_detailed2">Print Report
                            <i class="fa fa-file-excel-o"></i></a>
                            <!-- <a class="btn circle blue hidden-print" style="float: right; id="print_summary2">Print
                            <i class="fa fa-print"></i></a> -->
                            <table class="tblsummaryaging2 table table-hover" id="tblsummaryaging2">
                                <thead>
                                    <tr>
                                        <th>Installment Name</th>
                                        <th>0-30 Days</th>
                                        <th>31-60 Days</th>
                                        <th>61-90 Days</th>
                                        <th>91-120 Days</th>
                                        <th>120 Days and More</th>
                                        <th>Current Total</th>
                                        <th>Longterm Total</th>
                                    </tr>
                                </thead>
                                <tbody id="tbody_sa2">
                                    
                                    
                                </tbody>
                            </table>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>0-30 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="030total3"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>All Current Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="currenttotal3"></h5></b>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>31-60 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="3160total3"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>All Longterm Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="longtermtotal3"></h5></b>
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>61-90 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="6190daystotal3"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>91-120 Days Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="91120daystotal3"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-1">
                                    
                                </div>
                                <div class="col-md-2">
                                    <h5><b>120 Days And More Total: </b></h5>
                                </div>
                                <div class="col-md-2">
                                    <b><h5 id="120daystotal3"></h5></b>
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-2">
                                    
                                </div>
                                <div class="col-md-1">
                                    
                                </div>
                            </div>
                        </div>
                    </div>                        
                </div>
            </div>
        </div>
    </div>
</div>
<a href="<?php echo base_url(); ?>reports/AgingDetailed.xls" style="display: none;"><input type="button" id="exceldetailedtrigger" value="Test" class="btn btn-success"></a>
<a href="<?php echo base_url(); ?>reports/AgingSummaryProject.xls" style="display: none;"><input type="button" id="excelsummarytrigger" value="Test" class="btn btn-success"></a>
<a href="<?php echo base_url(); ?>reports/AgingSummaryTax.xls" style="display: none;"><input type="button" id="excelsummary2trigger" value="Test" class="btn btn-success"></a>
<a href="<?php echo base_url(); ?>reports/AgingSummaryBoth.xls" style="display: none;"><input type="button" id="excelsummary3trigger" value="Test" class="btn btn-success"></a>