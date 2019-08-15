<li class="dropdown dropdown-user dropdown-dark">
<a href="javascript:;" class="dropdown-toggle" data-toggle="dropdown" data-hover="dropdown" data-close-others="true">
<img alt="" class="img-circle" src="<?=base_url()?>assets/layouts/layout3/img/avatar9.jpg">
<span class="username username-hide-mobile"><?=$this->session->userdata('lastname');?>, <?=$this->session->userdata('firstname');?></span>
</a>
<ul class="dropdown-menu dropdown-menu-default">
<!--                                                <li>-->
<!--                                                    <a href="page_user_profile_1.html">-->
<!--                                                        <i class="icon-user"></i> My Profile </a>-->
<!--                                                </li>-->
<!--                                                <li>-->
<!--                                                    <a href="app_calendar.html">-->
<!--                                                        <i class="icon-calendar"></i> My Calendar </a>-->
<!--                                                </li>-->
<li>
<a href= "<?=base_url()?>message">
    <i class="icon-envelope-open"></i> My Inbox
    <span class="badge badge-danger">10</span>
</a>


</li>
<li>
<a href= "<?=base_url()?>message/request">
    <i class="icon-envelope-open"></i> See request
    
</a>


</li>
<li>
<a href= "<?=base_url()?>logistics/request">
    <i class="fa fa-shopping-cart"></i> Purchase Request Form   
</a>

</li>

<li>
<a href= "<?=base_url()?>message">
    <i class="fa fa-send-o"></i>Sent Purchase Request
  
</a>


</li>

<!--                                                <li>-->
<!--                                                    <a href="app_todo_2.html">-->
<!--                                                        <i class="icon-rocket"></i> My Tasks-->
<!--                                                        <span class="badge badge-success"> 7 </span>-->
<!--                                                    </a>-->
<!--                                                </li>-->
<li class="divider"> </li>
<!--                                                <li>-->
<!--                                                    <a href="page_user_lock_1.html">-->
<!--                                                        <i class="icon-lock"></i> Lock Screen </a>-->
<!--                                                </li>-->
<li>
<a href="<?=base_url()?>logout">
    <i class="icon-key"></i> Log Out </a>
</li>
</ul>
</li>