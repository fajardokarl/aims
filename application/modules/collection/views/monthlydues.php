<div class="col-md-12">
    <div class="portlet light " id="monthlydues">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="fa fa-money font-green-sharp"></i>
                <span class="caption-subject bold uppercase"> Monthly Dues</span>
            </div>
            <div class="actions">
                <a class="btn circle blue hidden-print"  id="excel1">Generate Report
                <i class="fa fa-file-excel-o"></i></a>
                <a class="btn circle blue hidden-print"  id="print1">Print
                <i class="fa fa-print"></i></a>
            </div>
        </div>
        <div class="portlet-body"> 
            <!-- <div class="row">
                <div class="col-md-1">
                    
                </div>         
                <div class="col-md-1">
                    <h5><b>From: </b></h5>
                </div>
                <div class="col-md-3">
                    <input  type="date" name="surchargeDate" placeholder="yyyy-mm-dd" class="form-control" id="fromDate" required />
                </div>
                <div class="col-md-1">
                    <h5><b>To: </b></h5>
                </div>
                <div class="col-md-3">
                    <input  type="date" name="surchargeDate" placeholder="yyyy-mm-dd" class="form-control" id="toDate" required />
                </div>
                <div class="3">
                    <button style="align: center;" type="button" class="btn btn-circle green" id="generate">Generate</button>
                </div>
            </div>
            <br>
            <div class="row">
                
            </div> -->
            <table class="tblmonthlydues table table-hover" id="tblmonthlydues">
                <thead>
                    <tr>
                        <th style="display: none;">Amortization ID</th>
                        <th>Due Date</th>
                        <th>Customer Name</th>
                        <th>Lot Description</th>
                        <th>Days Due</th>
                        <th>Amount Due</th>
                        <th>Amortization Amount</th>
                        <th>Surcharge Amount</th>
                        <th>VAT</th>
                        <th>IP & S</th>
                        <th>Interest</th>
                        <th>Principal</th>
                        <th>Payments</th>
                    </tr>
                </thead>
                <tbody id="tbody_rp">
                    
                </tbody>
            </table>
        </div> 
    </div>
</div>
<a href="<?php echo base_url(); ?>reports/MonthlyDues.xls" style="display: none;"><input type="button" id="excel1trigger" value="Test" class="btn btn-success"></a>