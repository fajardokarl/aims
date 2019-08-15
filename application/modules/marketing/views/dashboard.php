<div class="row">
    <div class="col-md-12">
        <div class="row widget-row">
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Reservations | <span class="font-dark"><?php echo date('F'); ?></span></h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-green icon-bulb"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">units</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $reserve_count; ?>"><?php echo $reserve_count; ?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading"> Reservations | <span class="font-dark"><?php echo date('F'); ?></span></h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-red icon-layers"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎₱</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo number_format($reserve_amount->total_reserve, 2); ?>"><?php echo number_format($reserve_amount->total_reserve, 2); ?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Number of Customers</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-purple icon-screen-desktop"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">‎count</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $customer_count; ?>"><?php echo $customer_count; ?></span>
                        </div>
                    </div>
                </div>
                <!-- END WIDGET THUMB -->
            </div>
            <div class="col-md-3">
                <!-- BEGIN WIDGET THUMB -->
                <div class="widget-thumb widget-bg-color-white text-uppercase margin-bottom-20 ">
                    <h4 class="widget-thumb-heading">Number of Active Agents</h4>
                    <div class="widget-thumb-wrap">
                        <i class="widget-thumb-icon bg-blue icon-bar-chart"></i>
                        <div class="widget-thumb-body">
                            <span class="widget-thumb-subtitle">Count</span>
                            <span class="widget-thumb-body-stat" data-counter="counterup" data-value="<?php echo $agent_count; ?>"><?php echo $agent_count; ?></span>
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
                        <span class="caption-subject font-green-steel bold uppercase">Agents Activity</span>
                        <span class="caption-helper">Monthly stats...</span>
                    </div>
                    <div class="actions">
                        <div class="btn-group btn-group-devided" data-toggle="buttons">
                            <label class="btn btn-transparent blue-oleo btn-no-border btn-outline btn-circle btn-sm active">
                                <input type="radio" name="options" class="toggle" id="option1">Month
                            </label>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="table-scrollable table-scrollable-borderless">
                        <table class="table table-hover table-light">
                            <thead>
                            <tr class="uppercase">
                                <th></th>
                                <th colspan="2"> AGENT </th>
                                <th> SOLD </th>
                                <th> CASES </th>
                                <!-- <th> CLOSED </th>
                                <th> RATE </th> -->
                                <!-- '../public/images/profiles/' -->
                            </tr>
                            </thead>

                            <?php $i=1; foreach ($top_agents as $top_agents){ ?>
                                <tr>  
                                    <?php             
                                        if ($top_agents['picture_url'] == '') {
                                            $pic_url = base_url() . 'public/images/profiles/default.png';
                                        }else{
                                            $pic_url = base_url() . 'public/images/profiles/' . $top_agents['picture_url'];
                                        }
                                    ?>
                                    <td><?php echo $i; ?></td>
                                    <td class="fit">
                                        <img class="user-pic rounded" src="<?php echo $pic_url; ?>" > </td>
                                    <td>
                                        <a class="primary-link"><?php echo $top_agents['lastname'] . ', ' . $top_agents['firstname'] . ' ' . $top_agents['middlename']; ?></a>
                                    </td>
                                    <td><?php echo '₱ ' . number_format($top_agents['total'], 2); ?></td>
                                    <td><?php echo $top_agents['count']; ?></td>
                                    <td>  </td>
                                    <td>
                                        <span class="bold theme-font"></span>
                                    </td>
                                </tr>
                                
                            <?php $i++; } ?>
                        </table>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-lg-6 col-xs-12 col-sm-12">
            <div class="portlet light ">
                <div class="portlet-title"> 
                    <div class="caption ">
                        <span class="caption-subject font-dark bold uppercase">Sales Activity</span>
                        <span class="caption-helper">Monthly stats...</span>
                    </div>
                </div>
                <div class="portlet-body">
                    <ul class="nav nav-tabs">
                        <li class="active"> 
                            <a href="#reserve-tab" data-toggle="tab"><span class="caption-subject font-green-sharp bold uppercase">Reservation Activity</span></a>
                        </li>
                        <li class="">
                            <a href="#tcp-tab" data-toggle="tab"><span class="caption-subject font-green-sharp bold uppercase">TCP Activity</span></a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane fade active in" id="reserve-tab">
                            <div id="dashboard_amchart_3" class="CSSAnimationChart"></div>
                        </div>
                        <div class="tab-pane fade in" id="tcp-tab">
                            <div id="dashboard_amchart_tcp" class="CSSAnimationChart"></div>
                        </div>
                    </div>
                </div>
                            <!-- <div id="dashboard_amchart_4" class="CSSAnimationChart"></div> -->
                
            </div>
        </div>
    </div>
</div>








