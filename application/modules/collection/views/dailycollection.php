<div class="row hidden-print">
    <div class="portlet light " id="monthlydues">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="fa fa-money font-green-sharp"></i>
                <span class="caption-subject bold uppercase"> Daily Collection</span>
            </div>
            <div class="actions">
                <a class="btn circle blue hidden-print"  id="excel">Generate Report
                <i class="fa fa-file-excel-o"></i></a>
                <a class="btn circle blue hidden-print"  id="print">Print
                <i class="fa fa-print"></i></a>
            </div>
        </div>
        <div class="portlet-body"> 
            <div class="row">
                <div class="col-md-4">
                    <h4 class="control-label">Sort by<font color="red"> * </font></h4>
                    <select class="form-control select2 select2-hidden-accessible" id="sortby" name ="sortby" required>
                        <option value="0" class ="disabled selected">Select Here..</option>
                        <option value="1" class ="disabled selected">Project</option>
                        <option value="2" class ="disabled selected">Vat Type</option>
                    </select>
                </div>
                <div class="col-md-4" id="projectdiv" style="display: none;">
                    <h4 class="control-label">Project<font color="red"> * </font></h4>
                    <select class="form-control select2 select2-hidden-accessible" id="project" name ="project" required>
                        <option value="0" class ="disabled selected">Select Here..</option>
                        <?php foreach ($projects as $p){?>
                        <option value="<?php echo $p['project_id'];?>"><?php echo $p['project_description'];?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-4" id="vatdiv" style="display: none;">
                    <h4 class="control-label">Vat<font color="red"> * </font></h4>
                    <select class="form-control select2 select2-hidden-accessible" id="vat" name ="vat" required>
                        <option value="3" class ="disabled selected">Select Here..</option>
                        <option value="0" class ="disabled selected">Non Vat</option>
                        <option value="1" class ="disabled selected">Vat</option>
                    </select>
                </div>
                <div class="col-md-2" id="generatediv" style="display: none;">
                    <h4 class="control-label">&nbsp;</h4>
                    <button type="button" class="btn btn-circle green" id="generate">Generate</button>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <h4 class="control-label" style="text-align: center;" id="title1"></h4>
                    <h4 class="control-label" style="text-align: center;" id="title2">Daily Collection</h4>
                    <h4 class="control-label" style="text-align: center;" id="year_text"><?php echo date("M d, Y");?></h4>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <div style="width: 100%; overflow-x: auto; white-space: nowrap;">
                <table class="tbldailycollection table table-hover" id="tbldailycollection">
                    <thead>
                        <tr>
                            <th>Customer</th>
                            <th>Payment Type</th>
                            <th>Amount Paid</th>
                            <th>Principal Paid</th>
                            <th>Interest Paid</th>
                            <th>Surcharge Paid</th>
                            <th>IP & S Paid</th>
                            <th>Sundry Paid</th>
                        </tr>
                    </thead>
                    <tbody id="tbody_rp">
              
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<a href="<?php echo base_url(); ?>reports/DailyCollection.xls" style="display: none;"><input type="button" id="exceltrigger" value="Test" class="btn btn-success"></a>
