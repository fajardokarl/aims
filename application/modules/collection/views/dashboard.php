<div class="row">
    <div class="col-md-12">
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Daily Collection</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="daily_sales" data-value="<?php echo number_format($daily_sales->dailySales,2); ?>"><?php echo number_format($daily_sales->dailySales,2); ?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB --> 
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Monthly Collection</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" id="monthly_sales" data-value="<?php echo number_format($monthly_sales->monthlySales,2); ?>"><?php echo number_format($monthly_sales->monthlySales,2); ?></span>
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
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($amort_receivable->monthlyReceivableAmort, 2);?>"><?php echo number_format($amort_receivable->monthlyReceivableAmort, 2);?></span>
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
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($misc_receivable->monthlyReceivableMisc, 2);?>"><?php echo number_format($misc_receivable->monthlyReceivableMisc, 2);?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
        </div>

        <div class="col-md-12 col-sm-6">
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
        <!-- <div class="col-lg-6 col-xs-12 col-sm-12">
            
        </div> -->

    </div>
</div>