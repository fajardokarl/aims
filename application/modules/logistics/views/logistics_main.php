
<div class="row">
    <div class="col-md-12">
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Purchase Request | <span class="font-dark"><?php echo date('F'); ?></span></h4>
                    <div class="widget-thumb-wrap">
                         <i class="widget-thumb-icon bg-green icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎FORMS</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="monthly_prf"  data-value="<?php echo $prf_count; ?>"><?php echo $prf_count; ?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB --> 
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Pending PR | <span class="font-dark"><?php echo date('F'); ?></span></h4></h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎FORMS</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="monthly_ppr"  data-value="<?php echo $ppr_count; ?>"><?php echo $ppr_count; ?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Purchase Order | <span class="font-dark"><?php echo date('F'); ?></span></h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple ifa icon-docs"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎FORMS</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="monthly_po"  data-value="<?php echo $po_count; ?>"><?php echo $po_count; ?></span>                            
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
             <div class="row">
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Total of all Purchase Request</h4>
                   
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple ifa icon-docs"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎FORMS</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="monthly_po"  data-value="<?php echo $all_prf_count; ?>"><?php echo $all_prf_count; ?></span>                            
                        </div>
                    </div>              
                </div>
            </div>


                <!-- <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Miscelaneous Receivables</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value=""></span>
                        </div>
                        <a href="<?=base_url()?>logistics/view_item" class="btn btn-circle green btn-outline btn-sm ">
                            <i class="fa fa-pencil"></i> Add Item </a>
                    </div>
                </div> -->
                <!-- END WIDGET THUMB -->
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-green-steel bold uppercase">List of all Purchase Order</span>
                      
                    </div>
             <!--        <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Today</label>
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Week</label>
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Month</label>
                        </div>
                    </div> -->
                </div>
                <div class="portlet-body">
                   <!--  <div class="row number-stats margin-bottom-30">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="stat-left">
                                <div class="stat-chart"> -->
                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                    <!-- <div id="sparkline_bar"></div>
                                </div>
                                <div class="stat-number">
                                    <div class="title"> Total </div>
                                    <div class="number"> 2460 </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="stat-right">
                                <div class="stat-chart"> -->
                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                       <!--              <div id="sparkline_bar2"></div>
                                </div>
                                <div class="stat-number">
                                    <div class="title"> New </div>
                                    <div class="number"> 719 </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
                    <div class="table-scrollable table-scrollable-borderless">
                        <table  id="pdf_po_table" class="table table-hover">
<thead>
<tr>
    <th>PO no</th>
    <th>PRF no</th>
    <th>Supplier</th>
    <th>Requested by</th>
    <th>Date created</th>
</tr>
</thead>
<tbody>
<?php foreach($po_list as $po_list){ ?>
    <tr>
      <td><?php echo $po_list['po_id']; ?></td>           
      <td><?php echo $po_list['prf_id'] ;?></td>
      <td><?php echo $po_list['supplier_id']; ?></td>  
      <td><?php echo $po_list['firstname'].$po_list['lastname']; ?></td>               
      <td><?php echo date('M d, Y',strtotime($po_list['po_date'])) ;?></td>  
    </tr>
<?php } ?>
</tbody>
</table>
                        <!-- <table class="table table-hover table-light">
                            <thead>
                            <tr class="uppercase">
                                <th colspan="2"> BROKER </th>
                                <th> SOLD </th>
                                <th> CASES </th>
                                <th> CLOSED </th>
                                <th> RATE </th>
                            </tr>
                            </thead>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar4.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">CDO Brokers</a>
                                </td>
                                <td> ‎₱345,345 </td>
                                <td> 45 </td>
                                <td> 124 </td>
                                <td>
                                    <span class="bold theme-font">80%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar5.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">JCA Realty</a>
                                </td>
                                <td> ‎₱560,345 </td>
                                <td> 12 </td>
                                <td> 24 </td>
                                <td>
                                    <span class="bold theme-font">67%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar5.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">JCA Realty</a>
                                </td>
                                <td> ‎₱560,345 </td>
                                <td> 12 </td>
                                <td> 24 </td>
                                <td>
                                    <span class="bold theme-font">67%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar6.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">SPM10</a>
                                </td>
                                <td> ‎₱1,345,345 </td>
                                <td> 450 </td>
                                <td> 46 </td>
                                <td>
                                    <span class="bold theme-font">98%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar6.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">SPM10</a>
                                </td>
                                <td> ‎₱1,345,345 </td>
                                <td> 450 </td>
                                <td> 46 </td>
                                <td>
                                    <span class="bold theme-font">98%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar6.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">SPM10</a>
                                </td>
                                <td> ‎₱1,345,345 </td>
                                <td> 450 </td>
                                <td> 46 </td>
                                <td>
                                    <span class="bold theme-font">98%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar7.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">CDO Brokers</a>
                                </td>
                                <td> ‎₱645,345 </td>
                                <td> 50 </td>
                                <td> 89 </td>
                                <td>
                                    <span class="bold theme-font">58%</span>
                                </td>
                            </tr>
                            <tr>
                                <td class="fit">
                                    <img class="user-pic rounded" src="<?=base_url()?>assets/pages/media/users/avatar7.jpg"> </td>
                                <td>
                                    <a href="javascript:;" class="primary-link">CDO Brokers</a>
                                </td>
                                <td> ‎₱645,345 </td>
                                <td> 50 </td>
                                <td> 89 </td>
                                <td>
                                    <span class="bold theme-font">58%</span>
                                </td>
                            </tr>
                        </table> -->
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                          <span class="caption-subject font-green-steel bold uppercase">List of all Purchase request</span>                        
                    </div>

                    <div class="actions">
                        <a href="<?=base_url()?>logistics/prf_list_controller" class="btn btn-circle green btn-outline btn-sm ">
                            <i class="fa fa-pencil"></i>View All </a>
<!--                         <a href="#" class="btn btn-circle green btn-outline btn-sm">
                            <i class="fa fa-print"></i> Print </a> -->
                    </div>
                </div>

<div class="portlet-body">
    <div id="dashboard_amchart_3" class="CSSAnimationChart">
        <div class="portlet-body">

<div style="max-width:3000px; white-space: nowrap; ">
<table class="table table-hover" id="prePRFlist">
<thead>
<tr>
     <th>PRF</th>
        <th>Date Requested</th>
        <th>Name</th>
</tr>
</thead>
<tbody>
      <?php foreach($prf_list as $prf_list){ ?>
        <tr>
         
            <td><?php echo $prf_list['prf_id']; ?></td>
             <td><?php echo date('M d, Y',strtotime($po_list['po_date'])) ;?></td>  
            <td><?php echo $prf_list['firstname'].$prf_list['lastname']; ?></td>
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

    </div>
</div>