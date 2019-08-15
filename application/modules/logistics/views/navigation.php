						<!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
            	<div class="container-fluid">
                                
            		<!-- BEGIN MEGA MENU -->
            		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            		<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                <div class="hor-menu  ">
                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Logistics"> Dashboard
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul>

                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="javascript:;"> Supplier
                        <span class="arrow"></span>
                      </a>
                    	<ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/Supplier" class="nav-link  ">
                          	<i class="icon-bar-chart"></i> List of Suppliers
                          	<span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>

                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="javascript:;"> Quotation
                        <span class="arrow"></span>
                      </a>
                      <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/prf_quotation_controller" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Create Quotation
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                              <a href="<?=base_url()?>Logistics/prf_quotation_controller/quotation_list" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Print Quotation
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>  

                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="javascript:;"> Canvass
                        <span class="arrow"></span>
                      </a>
                      <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/canvass" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Create Canvass
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                              <a href="<?=base_url()?>Logistics/canvass/canvass_list" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Approve Canvass
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                              <a href="<?=base_url()?>Logistics/canvass/prf_status" class="nav-link  ">
                            <i class="icon-bar-chart"></i>PRF Status
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                              <a href="<?=base_url()?>Logistics/canvass/canvass_report" class="nav-link  ">
                            <i class="icon-bar-chart"></i>Canvass Report
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>   




                   <!--  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Logistics/canvass"> Create Canvass
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul> -->


                <!--       <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Logistics/prf_list_controller"> List of PRF
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul>
 -->

                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="javascript:;"> List of PRF
                        <span class="arrow"></span>
                      </a>
                      <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/prf_list_controller" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Regular PRF
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/prf_list_controller/rush_prf" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Rush PRF
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>





                    <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Logistics/capex_list_controller"> CAPEX List
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul>

                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="javascript:;"> Purchase Order
                        <span class="arrow"></span>
                      </a>
                      <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/canvass/purchaseOrder" class="nav-link  ">
                            <i class="icon-bar-chart"></i> For regular request
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/canvass/RushPurchaseOrder" class="nav-link  ">
                            <i class="icon-bar-chart"></i> For special request
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/canvass/ShowAllPO" class="nav-link  ">
                            <i class="icon-bar-chart"></i> List of PO
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>

                   <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="javascript:;"> Reports
                        <span class="arrow"></span>
                      </a>
                      <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/report_controller" class="nav-link  ">
                            <i class="icon-bar-chart"></i> Summary of PO
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                          <a href="<?=base_url()?>Logistics/report_controller/poDetailsReport" class="nav-link  ">
                            <i class="icon-bar-chart"></i> PO details
                            <span class="badge badge-success hidden">1</span>
                          </a>
                        </li>
                      </ul>
                    </li>
                  </ul>
                  <!--  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Logistics/Items"> Items
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul> -->


                 <!--  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Logistics/canvass/purchaseOrder"> Purchase Order List
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul> -->


                </div>
                <!-- END MEGA MENU -->
              </div>
            </div>
            <!-- END HEADER MENU -->