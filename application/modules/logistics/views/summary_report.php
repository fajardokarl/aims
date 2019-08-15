<div class="row">
        <div class="col-md-12">
            <div class="portlet light " id="bankslists">
                <div class="portlet-title">
                    <div class="actions">
                        <a class="btn circle blue hidden-print"  id="print">Print
                        <i class="fa fa-print"></i></a>
                        <a class="btn circle blue hidden-print"  id="sales_xls">Excel
                        <i class="fa fa-print"></i></a>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <center><img src="<?php echo base_url('public/images/logo.png')?>" align="center"></center>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <center>
                                <i class="fa font-green-sharp"></i>
                                <h3 class="caption-subject bold uppercase"> Summary of purchases</h3>
                            </center>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="row" style="display: none;" id="dateDiv">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <center>
                                <h4 class="caption-subject bold uppercase" id="dateText"></h4>
                            </center>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <div class="row hidden-print">
                        <div class="col-md-3">
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                From
                                <input type="date" id="fromDate" name="fromDate"  placeholder="" maxlength="30" align="center" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                To
                                <input type="date" id="toDate" name="toDate"  placeholder="" maxlength="30" align="center" class="form-control" required/>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                    <div class="row hidden-print">
                        <div class="col-md-4">
                        </div>
                        <div class="col-md-4">
                            <center>
                                <!-- <div class="caption font-green-sharp" align="center">Select dates to generate report.</div> -->
                                <button type="button" class="btn btn-circle green hidden-print" id="generateReport">Generate Report</button>
                            </center>
                        </div>
                        <div class="col-md-4">
                        </div>
                    </div>
                    <br>
                </div>
                <div class="portlet-body">
                  
                    <table class="tblreservationreport table table-hover" id="tblreservationreport" >
                        <thead>
                            <tr>
                                <th>PO#</th>
                                <th>Suppliers name</th>
                                <th>PO date</th>
                                <th>LOC./PROJ./DEPT</th>
                                <th>PRF/RPC #</th>
                                <th>Budgeted</th>
                                <th>Unbudgeted</th>                         
                            </tr>
                        </thead>
                        <tbody id="tbody_rp">
                            
                        </tbody>
                    </table>       
                </div>
            </div>
        </div>
        <a href="<?php echo base_url(); ?>reports/salesreport.xls" style="display: none;"><input type="button" id="xls_sales_trigger" value="Test" class="btn btn-success"></a>
</div>

