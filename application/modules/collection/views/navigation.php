                        <!-- BEGIN HEADER MENU -->
                        <div class="page-header-menu">
                            <div class="container-fluid">
                                
                                <!-- BEGIN MEGA MENU -->
                                <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
                                <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                                <div class="hor-menu  ">
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="<?=base_url()?>collection"> Dashboard
                                                <span class="arrow"></span>
                                            </a>
                                        </li>
                                    </ul>
                                    <ul class="nav navbar-nav">
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Payments
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/reservation" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Official Receipt
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/sundry" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Sundry
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/nonvat" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Non Vat
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/restructureamortization" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Restructure Amortization
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/recomputeamortization" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Recompute Amortization
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
                                                    <a href="<?=base_url()?>collection/customers" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Customer Masterlist
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/contracts" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Contracts Masterlist
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
                                                    <a href="<?=base_url()?>collection/lots" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Lot Listing
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
                                                    <a href="<?=base_url()?>collection/brokers" class="nav-link  ">
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
                                                    <a href="<?=base_url()?>collection/mancom" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Mancom Reports </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/postdatedchecks" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Post Dated Checks </a>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/monthlydues" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Monthly Receivables </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/agingreport" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Aging Report </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/salesprojection" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Sales Projection </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/collectionprojection" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Collection Projection </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/dailycollection" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Daily Collection </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/monthlycollection" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Monthly Collection </a>
                                                </li>
                                            </ul>
                                        </li>
                                        <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                                            <a href="javascript:;"> Settings
                                                <span class="arrow"></span>
                                            </a>
                                            <ul class="dropdown-menu pull-left">
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/commissionschemes" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Commision Schemes
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/incentiveschemes" class="nav-link  ">
                                                        <i class="icon-bar-chart"></i> Incentive Schemes
                                                        <span class="badge badge-success hidden">1</span>
                                                    </a>
                                                </li>
                                                <li aria-haspopup="true" class=" ">
                                                    <a href="<?=base_url()?>collection/banks" class="nav-link  ">
                                                        <i class="icon-bulb"></i> Bank Masterlist </a>
                                                </li>

                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <!-- END MEGA MENU -->
                            </div>
                        </div>
                        <!-- END HEADER MENU -->