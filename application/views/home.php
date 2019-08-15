<!DOCTYPE html>
<html lang="en">
<div id="content">
	<p></p>
<head>
<style>
body{
	background-color: #eff7ff;
}

table {
    font-family: arial, sans-serif;
    border-collapse: collapse;
    width: 100%;
}

td, th {
	/*border: 1px solid black;*/
   /* border: 2px solid #4de5f9;*/
    text-align: left;
    background-color: #ffffff;
    padding: 8px;
    border-collapse: collapse;
}

tr:nth-child(even) {
    background-color: #4de5f9;
}
html,body,div,span,applet,object,iframe,h1,h2,h3,h4,h5,h6,p,blockquote,pre,a,abbr,acronym,address,big,cite,code,del,dfn,em,img,ins,kbd,q,s,samp,small,strike,strong,sub,sup,tt,var,b,u,i,dl,dt,dd,ol,nav ul,nav li,fieldset,form,label,legend,table,caption,tbody,tfoot,thead,tr,th,td,article,aside,canvas,details,embed,figure,figcaption,footer,header,hgroup,menu,nav,output,ruby,section,summary,time,mark,audio,video{margin:0;padding:0;border:0;font-size:100%;font:inherit;vertical-align:baseline;}
article, aside, details, figcaption, figure,footer, header, hgroup, menu, nav, section {display: block;}
ol,ul{list-style:none;margin:0;padding:0;}
blockquote,q{quotes:none;}
blockquote:before,blockquote:after,q:before,q:after{content:'';content:none;}
table{border-collapse:collapse;border-spacing:0;}
/* start editing from here */
a{text-decoration:none;}
.txt-rt{text-align:right;}/* text align right */
.txt-lt{text-align:left;}/* text align left */
.txt-center{text-align:center;}/* text align center */
.float-rt{float:right;}/* float right */
.float-lt{float:left;}/* float left */
.clear{clear:both;}/* clear float */
.pos-relative{position:relative;}/* Position Relative */
.pos-absolute{position:absolute;}/* Position Absolute */
.vertical-base{	vertical-align:baseline;}/* vertical align baseline */
.vertical-top{	vertical-align:top;}/* vertical align top */
.underline{	padding-bottom:5px;	border-bottom: 1px solid #eee; margin:0 0 20px 0;}/* Add 5px bottom padding and a underline */
nav.vertical ul li{	display:block;}/* vertical menu */
nav.horizontal ul li{	display: inline-block;}/* horizontal menu */
img{max-width:100%;}
/*end reset*/
body{
	font-family: 'Droid Sans', sans-serif;
	font-size:100%;
	background: url(../images/bg.jpg);
	background-repeat: no-repeat;
	background-attachment: fixed;
	background-position: center;
	background-size: cover;
}
.message.warning  {
	background: rgba(255, 255, 255, 0.33);
	-moz-box-shadow: 0 0 0 3px rgba(56, 41, 32, 0.25);
    -webkit-box-shadow: 0 0 0 3px rgba(56, 41, 32, 0.25);
    box-shadow: 0 0 0 3px rgba(56, 41, 32, 0.25);
     margin:9% auto 0;
	width: 26%;
}
.login-head {
	padding: 2em 0;
	background: #6D4A70;
	margin-right: 300px;
	margin-left: 300px;
	position:relative;
}
.login-head h1 {
	color: #fff;
	font-size: 1.5em;
	text-align: left;
	margin: 0 23px;
}
form {
	padding: 3em 2em;
	background: #F2F2F2;
	margin-right: 300px;
	margin-left: 300px;
	margin-bottom: 100px;
	
}
form li{
	border: 2px ridge rgba(187, 185, 189, 0.11);
	border-radius: 0.3em;
	-webkit-border-radius:0.3em;
	-moz-border-radius:0.3em;
	-o-border-radius:0.3em;
	list-style:none;
	margin-bottom:12px;
	background:#F0EEF0;

}
.icon{
	background:url(../images/icons.png)  no-repeat 0px 0px;
	height:30px;
	width:30px;
	display: block;
	float: right;
	margin: 12px 9px 9px 0px;
}
.user{
	background: url(../images/icons.png) no-repeat 7px 1px;
	
}
.lock{
	background: url(../images/icons.png) no-repeat -22px 1px;
}

input[type="text"], input[type="password"] {
	font-family: 'Droid Sans', sans-serif;
	width:70%;
	padding: 0.5em 2em 0.5em 1em;
	color: #B8B8B8;
	font-size:20px;
	outline: none;
	background: none;
	border:none;
}

select {
	font-family: 'Droid Sans', sans-serif;
	width:100%;
	padding: 0.5em 2em 0.5em 1em;
	color: #B8B8B8;
	font-size:20px;
	outline: none;
	background: none;
	border:none;
}
input[type="text"]:hover, input[type="password"]:hover,select:hover{
	color:#9E61A3;
	
}
.submit h4 a{
	float:left;
	font-size: 16px;
	color: #999;
	font-weight: 400;
	font-family: 'Droid Sans', sans-serif;
	margin-top: 15px;
	margin-left: 21px;
}
.submit h4 a:hover{
	color:#8D4294;
}
/*************************/
.submit{
	padding-top:3em;
}
input[type="submit"] {
	float: left;
	color: #fff;
	cursor: pointer;
	font-weight: 900;
	outline: none;
	font-family: 'Raleway', sans-serif;
	padding: 12px 0px;
	width: 35%;
	font-size: 18px;
	background:#6C496F;
	border:2px solid #6C496F;
	border-radius: 0px;
	-webkit-border-radius:0px;
	-moz-border-radius:0px;
	-o-border-radius:0px;
}
input[type="submit"]:hover {
	background: #fff;
	color:#6C496F;
	border:2px solid #6C496F;
}
/*----*/
/* footer */
.footer{
	position: absolute;
	bottom: 76px;
	left: 45%;
}
.footer p{
	position:relative;
	font-family: 'Droid Sans', sans-serif;
	color:#fff;
	display: block;
	font-size:1.2em;
	font-weight: 400;
	text-align:center;
	padding-top:2em;
}
.footer p a{
	color:#000;
	transition: all 0.5s ease-out;
	-webkit-transition: all 0.5s ease-out;
	-moz-transition: all 0.5s ease-out;
	-ms-transition: all 0.5s ease-out;
	-o-transition: all 0.5s ease-out;
}
.footer p a:hover{
	color:#fff
}
.message {
	box-shadow: 0 0 0 1px rgba(0,0,0,0.2) inset, 0 1px 0 rgba(255,255,255,0.1) inset, 0 1px 2px rgba(0,0,0,0.4);
	position: relative;
}
.warning {
	text-align: center;
	margin: 14% auto;
	width: 280px;
	background: rgba(82, 97, 97, 0.68);
	border-radius: 6px;
	-webkit-border-radius: 6px;
	-moz-border-radius: 6px;
	-o-border-radius: 6px;
}
.alert-close {
	background: url('../images/into.png') no-repeat 0px 3px;
	cursor: pointer;
	height: 30px;
	position: absolute;
	right: 12px;
	top: 34px;
	-webkit-transition: color 0.2s ease-in-out;
	-moz-transition: color 0.2s ease-in-out;
	-o-transition: color 0.2s ease-in-out;
	transition: color 0.2s ease-in-out;
	width: 30px;
}
/*-----start-responsive-design------*/
@media (max-width:1440px){
.message.warning {
		margin: 11% auto 0;
		width: 30%;
	}
	.footer {
	left: 44%;
	}
}
@media (max-width:1366px){
	.message.warning{
		margin: 7% auto 0;
		width: 35%;
	}
	.footer {
		left: 43%;
		bottom: 9%;
	}
}
@media (max-width:1280px){
	.message.warning {
		margin: 7% auto 0;
		width: 33%;
	}
	.footer {
		left: 43%;
	}
}
@media (max-width:1024px){
	.message.warning{
		margin: 12% auto 0;
		width: 47%;
	}
	.footer {
		left: 41%;
	}
}
@media (max-width:768px){
	.message.warning{
		margin: 13% auto 0;
		width: 65%;
	}
	.footer {
		left: 38%;
		bottom:87px;
	}
}
@media (max-width:640px){
	.message.warning{
		margin: 13% auto 0;
		width: 67%;
	}
	.footer {
		left: 35%;
		bottom:87px;
	}
}
@media (max-width:480px){
	.message.warning  {
		margin: 15% auto 0;
		width:90%;
	}
	.footer {
		left: 33%;
		bottom: 136px;
	}
}
@media (max-width:320px){
	.message.warning  {
		margin:8% auto 0;
		width:90%;
	}
	.login-head {
	padding: 1.45em 0;
	}
	.login-head h1 {
	font-size: 1.15em;
	}
	.icon {
		margin: -33px 9px 9px 0px;
	}
	input[type="text"], input[type="password"] {
		font-size: 16px;
	}
	.alert-close {
	right: 12px;
	top: 22px;
	}
	form {
	padding: 1.5em 1.5em;
	}
	.submit {
	padding-top: 0.4em;
	}
	input[type="submit"] {
		float:none;
	padding: 11px 0px;
	width: 52%;
	font-size: 15px;
	}
	.submit h4 {
		margin-top: 15px;
		margin-bottom: 20px;
	}
	.submit h4 a {
	float: none;
	font-size: 15px;
	}
	.footer {
	left: 22%;
	bottom: 59px;
	}
	
}
</style>

<link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/bootstrap-toastr/toastr.min.css" rel="stylesheet" type="text/css" />
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN THEME GLOBAL STYLES -->
        <link href="http://localhost/forgiven/assets/global/css/components-md.min.css" rel="stylesheet" id="style_components" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/css/plugins-md.min.css" rel="stylesheet" type="text/css" />
        <script src="http://localhost/forgiven/public/scripts/inbox/inboxMasterlist.js" type="text/javascript"></script>


        <!-- END THEME GLOBAL STYLES -->
        <!-- BEGIN THEME LAYOUT STYLES -->
        <link href="http://localhost/forgiven/assets/global/plugins/select2/css/select2.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/bootstrap-select/css/bootstrap-select.min.css" rel="stylesheet" type="text/css"/>
        <link href="http://localhost/forgiven/assets/global/plugins/select2/css/select2-bootstrap.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/layouts/layout3/css/layout.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/layouts/layout3/css/themes/default.min.css" rel="stylesheet" type="text/css" id="style_color" />
        <link href="http://localhost/forgiven/assets/layouts/layout3/css/custom.min.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/public/css/custom.css" rel="stylesheet" type="text/css" />
        <link href="http://localhost/forgiven/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css" rel="stylesheet" type="text/css" />
        

</head>

<body>
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
              
            <div class="inset">
	<div class="login-head">
		<h1>Message</h1>
		 <div class="alert-close"> </div> 			
	</div>
		<form>
			
                    <table class="table table-hover" id="tblbroker" style="width: 100%">
                        <thead>
                        <tr>
                            
                            <th>Messge ID</th>
                            <th>Date Send</th>
                            <th>Sender</th>
                            <th>Subject</th>
                            <!-- <th>Subject</th> -->
                                              
                        </tr>
                        </thead>
                      <tbody>
                      	
<?php

	include("connection.php");

	$r = mysqli_query($dbc, "SELECT * FROM message");

	if (!$r) {
    printf("Error: %s\n", mysqli_error($dbc));
    exit();
	}
	
	
	
	while($row = mysqli_fetch_array($r)){	
		
			// echo "<tr><td align='left'>".$row['message_id'].", ".$row['date_sent']."</td>
			// 		  <td align='left'>".$row['sender_id'].",".$row['subject']."</td></tr>";
			echo "<tr>
			<td>".$row['message_id']."</td>
			<td>".$row['date_sent']."</td>
			<td>".$row['sender_id']."</td>
			<td>".$row['subject']."</td>
			</tr>";
	}
	
mysqli_close($dbc);
?>
	

				
		</form>           
        </div>
        </div>
        </div>
    </body>


<!-- BEGIN CORE PLUGINS -->
         <script src="http://localhost/forgiven/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-hover-dropdown/bootstrap-hover-dropdown.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-slimscroll/jquery.slimscroll.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery.blockui.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-switch/js/bootstrap-switch.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/scripts/datatable.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/datatables/datatables.all.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/datatables/datatables.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/datatables/plugins/bootstrap/datatables.bootstrap.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.js" type="text/javascript" ></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript" ></script> 
         <script src="http://localhost/forgiven/assets/global/plugins/select2/js/select2.min.js" type="text/javascript" ></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-inputmask/jquery.inputmask.bundle.min.js" type="text/javascript" ></script>
         <script src="http://localhost/forgiven/assets/global/plugins/js.cookie.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <script>var baseurl = $('body').data('baseurl');</script>
         <script src="http://localhost/forgiven/assets/global/scripts/app.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/layouts/layout/scripts/layout.min.js" type="text/javascript"></script>    
        <!-- BEGIN PAGE LEVEL PLUGINS -->
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-validation/js/additional-methods.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/ckeditor/ckeditor.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-markdown/lib/markdown.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-markdown/js/bootstrap-markdown.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery.sparkline.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/pages/scripts/profile.min.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-idle-timeout/jquery.idletimeout.js" type="text/javascript" ></script>
         <script src="http://localhost/forgiven/assets/global/plugins/jquery-idle-timeout/jquery.idletimer.js" type="text/javascript" ></script>
         <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-sessiontimeout/bootstrap-session-timeout.min.js" type="text/javascript" ></script>
        <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-growl/jquery.bootstrap-growl.min.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/assets/global/plugins/bootstrap-toastr/toastr.min.js" type="text/javascript"></script>
        <!-- BEGIN THEME LAYOUT SCRIPTS -->
        <script src="http://localhost/forgiven/assets/global/plugins/select2/js/select2.full.min.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/assets/pages/scripts/components-select2.min.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/assets/layouts/layout3/scripts/layout.min.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/assets/layouts/layout3/scripts/demo.min.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/assets/layouts/global/scripts/quick-sidebar.min.js" type="text/javascript"></script>
        <script src="<?=base_url()?>public/scripts/common/users.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/assets/layouts/global/scripts/quick-nav.min.js" type="text/javascript"></script>
        <script src="http://localhost/forgiven/public/scripts/common/loading.js" type="text/javascript"></script>
         <script src="http://localhost/forgiven/public/scripts/marketing.js" type="text/javascript"></script>
        <!-- END THEME LAYOUT SCRIPTS -->
        <!-- PAGES SCRIPTS -->

</body>

	 <div id="sidebar">
		<?= $latest; ?>
		
</div> 	

</div>

</html>