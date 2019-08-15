						<!-- BEGIN HEADER MENU -->
            <div class="page-header-menu">
            	<div class="container-fluid">
                                
            		<!-- BEGIN MEGA MENU -->
            		<!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
            		<!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
                <div class="hor-menu  ">
                  <ul class="nav navbar-nav">
                    <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                      <a href="<?=base_url()?>Department"> Dashboard
                        <span class="arrow"></span>
                      </a>
                    </li>
                  </ul>

                  <ul class="nav navbar-nav">
                     <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Employee
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <!-- <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>employee" class="nav-link  ">
                                <i class="icon-bar-chart"></i> Edit Employee
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li> -->
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>Department/assign_employee_controller" class="nav-link  ">
                                <i class="icon-bulb"></i> Assign Employee </a>
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