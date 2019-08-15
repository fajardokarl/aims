<div class="row hidden-print">
    <div class="portlet light " id="monthlydues">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
                <i class="fa fa-money font-green-sharp"></i>
                <span class="caption-subject bold uppercase"> Sales Projection</span>
            </div>
            <div class="actions">
                <a class="btn circle blue hidden-print"  id="excel1">Generate Report
                <i class="fa fa-file-excel-o"></i></a>
                <a class="btn circle blue hidden-print"  id="print1">Print
                <i class="fa fa-print"></i></a>
            </div>
        </div>
        <div class="portlet-body"> 
            <div class="row">
                <div class="col-md-4">
                    <h4 class="control-label">Project<font color="red"> * </font></h4>
                    <select class="form-control select2 select2-hidden-accessible" id="project" name ="project" required>
                        <option value="0" class ="disabled selected">Select Here..</option>
                        <?php foreach ($projects as $p){?>
                        <option value="<?php echo $p['project_id'];?>"><?php echo $p['project_description'];?></option>
                        <?php }?>
                    </select>
                </div>
                <div class="col-md-4">
                    <h4 class="control-label">Year<font color="red"> * </font></h4>
                    <select class="form-control select2 select2-hidden-accessible" id="year" name ="year" required>
                        <option value="0" class ="disabled selected">Select Here..</option>
                        <option value="2010" class ="disabled selected">2010</option>
                        <option value="2011" class ="disabled selected">2011</option>
                        <option value="2012" class ="disabled selected">2012</option>
                        <option value="2013" class ="disabled selected">2013</option>
                        <option value="2014" class ="disabled selected">2014</option>
                        <option value="2015" class ="disabled selected">2015</option>
                        <option value="2016" class ="disabled selected">2016</option>
                        <option value="2017" class ="disabled selected">2017</option>
                        <option value="2018" class ="disabled selected">2018</option>
                        <option value="2019" class ="disabled selected">2019</option>
                        <option value="2020" class ="disabled selected">2020</option>
                    </select>
                </div>
                <div class="col-md-2" id="installment_select" >
                    <h4 class="control-label">&nbsp;</h4>
                    <button type="button" class="btn btn-circle green" id="generate">Generate</button>
                </div>
            </div>
            <br><br>
            <div class="row">
                <div class="col-md-4">
                </div>
                <div class="col-md-4">
                    <h4 class="control-label" style="text-align: center;" id="title"></h4>
                    <h4 class="control-label" style="text-align: center;" id="title2">Sales Projection</h4>
                    <h4 class="control-label" style="text-align: center;" id="year_text">2017</h4>
                </div>
                <div class="col-md-4">
                </div>
            </div>
            <!-- <div style="width: 100%; overflow-x: auto; white-space: nowrap;"> -->
            <table class="tblsalesprojection table table-hover" id="tblsalesprojection">
                <thead>
                    <tr>
                        <th>Lot ID</th>
                        <th>Lot Description</th>
                        <th>TCP</th>
                        <th>Customer</th>
                        <th>Invoiced</th>
                        <th>Booked</th>
                        <th>Deferred</th>
                        <th>Vatable</th>
                        <th>% Paid</th>
                        <th>January</th>
                        <th>February</th>
                        <th>March</th>
                        <th>April</th>
                        <th>May</th>
                        <th>June</th>
                        <th>July</th>
                        <th>August</th>
                        <th>September</th>
                        <th>October</th>
                        <th>November</th>
                        <th>December</th>
                    </tr>
                </thead>
                <tbody id="tbody_rp">
          
                </tbody>
            </table>
            <!-- </div> -->
        </div>
    </div>
</div>
<a href="<?php echo base_url(); ?>reports/SalesProjection.xls" style="display: none;"><input type="button" id="excel1trigger" value="Test" class="btn btn-success"></a>

