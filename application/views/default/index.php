<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->

    <head>
        <?php 
         if(!isset($this->session->userdata['logged_in'])){
           redirect('login', 'refresh');
          }
         if (isset($head)) $this->load->view($head);
         else $this->load->view('default/head');
        ?>
        <script>var user_id = <?=$this->session->userdata['user_id']?></script>
    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-md" data-baseurl="<?=base_url()?>">
        <div class="page-wrapper">

            <!-- admin only -->
           <!--  <nav class="quick-nav">
                <a class="quick-nav-trigger" href="#0">
                    <span aria-hidden="true"></span>
                </a>
                <ul>
                    <li>
                        <a href="<?=base_url()?>Accounting" target="_blank" class="active">
                            <span>Accounting</span>
                            <i class="fa fa-bar-chart"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>marketing" target="_blank" class="active">
                            <span>Sales and Marketing</span>
                            <i class="fa fa-shopping-cart"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>collection" target="_blank">
                            <span>Credit and Collection</span>
                            <i class="fa fa-credit-card"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>logistics" target="_blank">
                            <span>Administration and Logistics</span>
                            <i class="fa fa-truck"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>engineering" target="_blank">
                            <span>Engineering and Construction</span>
                            <i class="fa fa-building"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>hris" target="_blank">
                            <span>Human Resources</span>
                            <i class="fa fa-users"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>its" target="_blank">
                            <span>IT Services</span>
                            <i class="fa fa-desktop"></i>
                        </a>
                    </li>
                    <li>
                        <a href="<?=base_url()?>asset" target="_blank">
                            <span>Asset</span>
                            <i class="fa fa-sticky-note-o"></i>
                        </a>
                    </li>
                </ul>
                <span aria-hidden="true" class="quick-nav-bg"></span>
            </nav> -->
            <div class="quick-nav-overlay"></div>

            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header">
                        <!-- BEGIN HEADER TOP -->
                        <div class="page-header-top">
                            <div class="container-fluid">
                                <!-- BEGIN LOGO -->
                                <div class="page-logo">
                                    <a href="<?=base_url()?>">
                                        <img src="<?=base_url()?>public/images/logo.png" alt="logo" class="logo-default">
                                    </a>
                                </div>
                                <!-- END LOGO -->
                                <!-- BEGIN RESPONSIVE MENU TOGGLER -->
                                <a href="javascript:;" class="menu-toggler"></a>
                                <!-- END RESPONSIVE MENU TOGGLER -->
                                <!-- BEGIN TOP NAVIGATION MENU -->
                                <div class="top-menu">
                                    <ul class="nav navbar-nav pull-right">
                                        <!-- BEGIN NOTIFICATION DROPDOWN -->
                                        <!-- DOC: Apply "dropdown-hoverable" class after "dropdown" and remove data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to enable hover dropdown mode -->
                                        <!-- DOC: Remove "dropdown-hoverable" and add data-toggle="dropdown" data-hover="dropdown" data-close-others="true" attributes to the below A element with dropdown-toggle class -->
                                       
                                        <!-- BEGIN INBOX DROPDOWN -->
                                        <?php if (isset($inbox)) $this->load->view($inbox);
                                            else $this->load->view('default/inbox');
                                        ?>
                                        <!-- END INBOX DROPDOWN -->

                                        <!-- BEGIN USER LOGIN DROPDOWN -->
                                        <?php if (isset($userprofile)) $this->load->view($userprofile);
                                            else $this->load->view('default/userprofile');
                                        ?>
                                        <!-- END USER LOGIN DROPDOWN -->

                                    </ul>
                                </div>
                                <!-- END TOP NAVIGATION MENU -->
                            </div>
                        </div>
                        <!-- END HEADER TOP -->
                        <?php if (isset($navigation)) $this->load->view($navigation);
                            else $this->load->view('default/navigation');
                        ?>
                    </div>
                    <!-- END HEADER -->
                </div>
            </div>
            <div class="page-wrapper-row full-height">
                <div class="page-wrapper-middle">
                    <!-- BEGIN CONTAINER -->
                    <div class="page-container">
                        <!-- BEGIN CONTENT -->
                        <div class="page-content-wrapper">
                            <!-- BEGIN CONTENT BODY -->
                            <!-- BEGIN PAGE HEAD-->
                            <div id="glob_head">
                                <div class="page-head" id="title_head">
                                    <div class="container-fluid" >
                                        <!-- BEGIN PAGE TITLE -->
                                        <div class="page-title">
                                            <h1><?=$page_title?> </h1>
                                        </div>
                                        <!-- END PAGE TITLE -->
                                        <!-- BEGIN PAGE TOOLBAR -->
                                        <div class="page-toolbar">
                                            
                                        </div>
                                        <!-- END PAGE TOOLBAR -->
                                    </div>
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container-fluid">
                                    
                                    <!-- BEGIN PAGE CONTENT INNER -->
                                    <?php if (isset($content)) $this->load->view($content);
                                        else $this->load->view('default/content');
                                    ?>
                                    <!-- END PAGE CONTENT INNER -->

                                </div>
                            </div>
                            <!-- END PAGE CONTENT BODY -->
                            <!-- END CONTENT BODY -->
                        </div>
                        <!-- END CONTENT -->
                        
                    </div>
                    <!-- END CONTAINER -->
                </div>
            </div>
            <?php $this->load->view('default/loading');?>
            <div class="page-wrapper-row">
                <div class="page-wrapper-bottom">
                    <!-- BEGIN FOOTER -->
                    <?php if (isset($footer)) $this->load->view($footer);
                        else $this->load->view('default/footer');
                    ?>
                    <!-- END FOOTER -->
                </div>
            </div>
        </div>
        <?php if (isset($scripts)) $this->load->view($scripts);
            else $this->load->view('default/scripts');
        ?>
        <?php if (isset($customjs)) $this->load->view($customjs);
            else $this->load->view('default/customjs');
        ?>
    </body>

</html>