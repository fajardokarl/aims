<!-- BEGIN HEADER MENU -->
<div class="page-header-menu">
    <div class="container-fluid">

        <!-- BEGIN MEGA MENU -->
        <!-- DOC: Apply "hor-menu-light" class after the "hor-menu" class below to have a horizontal menu with white background -->
        <!-- DOC: Remove data-hover="dropdown" and data-close-others="true" attributes below to disable the dropdown opening on mouse hover -->
        <div class="hor-menu  ">         
            <ul class="nav navbar-nav">
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Employees
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>hris/employees_list" class="nav-link  ">
                                <i class="icon-bar-chart"></i> List of all employee
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>hris/employees" class="nav-link  ">
                                <i class="icon-bulb"></i> Add new employee </a>
                        </li>
                    </ul>
                </li>
            </ul>
            <ul class="nav navbar-nav">
                <li aria-haspopup="true" class="menu-dropdown classic-menu-dropdown ">
                    <a href="javascript:;"> Applicants
                        <span class="arrow"></span>
                    </a>
                    <ul class="dropdown-menu pull-left">
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>hris/applicant/applicant_list" class="nav-link  ">
                                <i class="icon-bar-chart"></i> List of all applicants
                                <span class="badge badge-success hidden">1</span>
                            </a>
                        </li>
                        <li aria-haspopup="true" class=" ">
                            <a href="<?=base_url()?>hris/applicant/applicant_form" class="nav-link  ">
                                <i class="icon-bulb"></i> Applicant form </a>
                        </li>
                    </ul>
                </li>
            </ul> 

        </div>
        <!-- END MEGA MENU -->
    </div>
</div>
<!-- END HEADER MENU -->