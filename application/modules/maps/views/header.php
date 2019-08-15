
<!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT --><!-- MAIN CONTENT -->

<!DOCTYPE html>
<!--[if IE 8]> <html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]> <html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
    <!--<![endif]-->
    <!-- BEGIN HEAD -->
    <head>
        <meta charset="utf-8" />
        <title>ABCI | Maps</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->
        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="<?=base_url()?>assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="<?=base_url()?>assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />

        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="<?=base_url()?>assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
        <link href="<?=base_url()?>assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="<?=base_url()?>assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="<?=base_url()?>assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />            
        <!-- <link href="<?=base_url()?>public/css/custom.css" rel="stylesheet" type="text/css" /> -->
        <link href="<?=base_url()?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />


        <!-- END THEME LAYOUT STYLES -->

        <?php if (isset($customcss)) $this->load->view($customcss);
            else $this->load->view('default/customcss');
        ?>
        <link rel="shortcut icon" href="<?=base_url()?>public/images/favicon.png" />

    </head>
    <!-- END HEAD -->

    <body class="page-container-bg-solid page-md" data-baseurl="<?=base_url()?>">
        <div class="page-wrapper">

            <!-- admin only -->
            <div class="quick-nav-overlay"></div>

            <div class="page-wrapper-row">
                <div class="page-wrapper-top">
                    <!-- BEGIN HEADER -->
                    <div class="page-header" id="page_head">
                        <!-- BEGIN HEADER TOP -->
                        <div class="page-header-top">
                            <div class="container-fluid">
                                <!-- BEGIN LOGO -->
                                <div class="page-logo">
                                    <a href="<?=base_url()?>">
                                        <img id='logo' src="<?=base_url()?>public/images/logo2.png" alt="logo" class="logo-default">
                                    </a>
                                </div>
                            </div>
                        </div>
                        <!-- END HEADER TOP -->
                        <!-- NAVBAR START -->
                    </div>
                       	

					<nav class="navbar navbar-default" id="nav">
					  	<div class="container-fluid">
					    	<div class="navbar-header">
					      		<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
					        		<span class="icon-bar"></span>
					        		<span class="icon-bar"></span>
					        		<span class="icon-bar"></span>                        
					      		</button>
					      		<a class="navbar-brand" href="#"></a>
					    	</div>
						    <div class="collapse navbar-collapse" id="myNavbar" style="z-index: 100">
						      	<ul class="nav navbar-nav">
						        	<!-- <li class="active"><a href="#">Home</a></li> -->
						        		<li class="dropdown">
						          			<a class="dropdown-toggle" data-toggle="dropdown" href="">Maps <span class="caret"></span></a>
						          			<ul class="dropdown-menu">
									            <li><a href="<?=base_url()?>maps/terraces">The Terraces</a></li>
									            <li><a href="<?=base_url()?>maps/ignatius">Ignatius Enclave</a></li>
                                                <li><a href="<?=base_url()?>maps/ventura2">Ventura II</a></li>
                                                <li><a href="<?=base_url()?>maps/Valencia">Valencia Estates</a></li>
									            <li><a href="<?=base_url()?>maps/teakwood">Teakwood Hills</a></li>
						          			</ul>
						        		</li>
<!-- 							        <li><a href="#">Page 2</a></li>
							        <li><a href="#">Page 3</a></li> -->
						      	</ul>
						      	<ul class="nav navbar-nav navbar-right">
							        <li><a href="#"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
							        <li><a href="#"><span class="glyphicon glyphicon-log-in"></span> Login</a></li>
						      	</ul>
						    </div>
					  	</div>
					</nav>
                        <!-- NAVBAR END -->
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
                            <div class="page-head">
                                <div class="container-fluid">
                                    <!-- BEGIN PAGE TITLE -->
                                    <div class="page-title">
                                        <h1><?=$page_title?> </h1>
                                    </div>
                                    <!-- END PAGE TITLE -->
                                    <!-- BEGIN PAGE TOOLBAR -->
                                    <!-- <div class="page-toolbar"> -->
                                        
                                    <!-- </div> -->
                                    <!-- END PAGE TOOLBAR -->
                                </div>
                            </div>
                            <!-- END PAGE HEAD-->
                            <!-- BEGIN PAGE CONTENT BODY -->
                            <div class="page-content">
                                <div class="container">
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
             <?php #$this->load->view('default/loading');?>
            <div class="page-wrapper-row">
                <div class="page-wrapper-bottom">
                    <!-- BEGIN FOOTER -->
                    <?php #if (isset($footer)) $this->load->view($footer);
                        #else $this->load->view('default/footer');
                    ?>
                    <!-- END FOOTER -->
                </div>
            </div>
        </div>
       	<script src="<?=base_url()?>assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/scripts/datatable.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/datatables/datatables.all.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript" ></script> 
        <script src="<?=base_url()?>assets/global/plugins/select2/js/select2.min.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <script>var baseurl = $('body').data('baseurl');</script>
        <script src="<?=base_url()?>assets/global/scripts/app.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>    
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/pages/scripts/profile.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-sessiontimeout/bootstrap-session-timeout.min.js" type="text/javascript" ></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="<?=base_url()?>assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <!-- <script src="<?=base_url()?>public/scripts/common/loading.js" type="text/javascript"></script> -->
        <script src="<?=base_url()?>assets/global/plugins/jqvmap/jqvmap/jquery.vmap.js" type="text/javascript"></script>
        
        <?php if (isset($customjs)) $this->load->view($customjs);
            // else $this->load->view('default/customjs');
        ?>
    </body>

	<!-- FOOT -->
	<div class="page-footer">
        <div class="container-fluid"> 2017 &copy; Information Resource Management System By
            <a target="_blank" href="http://irm.abrown.ph">A Brown IRM Team</a> 
        </div>
    </div>
    <div class="scroll-to-top">
        <i class="icon-arrow-up"></i>
    </div>
    
</html>


