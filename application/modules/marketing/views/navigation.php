                        <!-- BEGIN HEADER MENU -->
                        <div class="page-header-menu">
                            <div class="container-fluid">
                                
                                <!-- BEGIN MEGA MENU -->
                                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                                <div class="hor-menu  ">
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="<?=base_url()?>marketing"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Reservation
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/listingreservation" class="nav-link" id="list_reserve">
                                                        <i class="fa fa-list"></i> Listing Reservation
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Customers
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/customerslist" class="nav-link  ">
                                                        <i class="fa fa-users"></i> Customer Masterlist
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/legacycustomer" class="nav-link  ">
                                                        <i class="fa fa-user"></i>Legacy Customer Masterlist
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/contracts" class="nav-link  ">
                                                        <i class="fa fa-sticky-note"></i> Contracts Masterlist
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Lots
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/lots" class="nav-link  ">
                                                        <i class="fa fa-stop"></i> Lot Listing
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Realty
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/brokers" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Brokers Masterlist
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>

                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Reports
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/mancom" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> ManCom Report
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/reservationreport" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Reservation Report
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/salesreport" class="nav-link  ">
                                                        <i class="icon-bulb"></i> Sales Report 
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/lotinventory" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Lot Inventory Report
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/documentstatus" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Customer's Documents Status
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/legacyreport" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Legacy Reports
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Maps
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/maps/ventura2" class="nav-link  ">
                                                        <i class="fa fa-map-o"></i> Ventura II
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/maps/terraces" class="nav-link  ">
                                                        <i class="fa fa-map-o"></i> The Terraces
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/maps/ignatius" class="nav-link  ">
                                                        <i class="fa fa-map-o"></i> Ignatius Enclave
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/maps/valencia" class="nav-link  ">
                                                        <i class="fa fa-map-o"></i> Valencia Estates
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/maps/teakwood" class="nav-link  ">
                                                        <i class="fa fa-map-o"></i> Teakwood Hills
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <!-- <ul class="nav navbar-nav">
                                            <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                                <a href="<?=base_url()?>marketing/maps/ventura2"> Maps
                                                    <span class="arrow"></span>
                                                </a>
                                            </li>
                                        </ul> -->
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Settings
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/paymentschemes" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Payment Schemes
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/commissionschemes" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Commision Schemes
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/incentiveschemes" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Incentive Schemes
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>marketing/banks" class="nav-link  ">
                                                        <i class="icon-bulb"></i> Bank Masterlist </a>
                                                </li>
<!--                                                <li aria-haspopup="true" class=" ">-->
<!--                                                    <a href="--><?//=base_url()?><!--marketing/users" class="nav-link  ">-->
<!--                                                        <i class="icon-bulb"></i> User Management </a>-->
<!--                                                </li>-->
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END MEGA MENU -->
                            </div>
                        </div>
                        <!-- END HEADER MENU -->