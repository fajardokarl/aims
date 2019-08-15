<div class="row">
    <div class="col-md-12">
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Daily Sales</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="daily_sales" data-value=""></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB --> 
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Monthly Sales</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="monthly_sales" data-value=""></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Amortization Receivables</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value=""></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Miscelaneous Receivables</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value=""></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
        </div>

        <div class="col-md-6 col-sm-6">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption caption-md">
                        <i class="icon-bar-chart font-dark hide"></i>
                        <span class="caption-subject font-green-steel bold uppercase">Broker Activity</span>
                        <span class="caption-helper">weekly stats...</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Today</label>
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Week</label>
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm">
                                <input type="radio" name="options" class="toggle" id="option2">Month</label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row number-stats margin-bottom-30">
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="stat-left">
                                <div class="stat-chart">
                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                    <div id="sparkline_bar"></div>
                                </div>
                                <div class="stat-number">
                                    <div class="title"> Total </div>
                                    <div class="number"> 2460 </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-xs-6">
                            <div class="stat-right">
                                <div class="stat-chart">
                                    <!-- do not line break "sparkline_bar" div. sparkline chart has an issue when the container div has line break -->
                                    <div id="sparkline_bar2"></div>
                                </div>
                                <div class="stat-number">
                                    <div class="title"> New </div>
                                    <div class="number"> 719 </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
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
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title">
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Paid Receivables</span>
                        <span class="caption-helper">distance stats...</span>
                    </div>
                    <div class="actions">
                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                            <i class="fa fa-pencil"></i> Export </a>
                        <a href="#" class="btn btn-circle green btn-outline btn-sm">
                            <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
                </div>
            </div>
        </div>

    </div>
</div>