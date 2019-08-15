<div class="page-content-inner">
	<div class="row">
    
    <div class="col-md-12">

        <!-- BEGIN SAMPLE TABLE PORTLET-->
        <div class="portlet light" id="customermasterlist">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-users"></i>Employee Listing 
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" id="addnewcust" onclick="location.href='<?=base_url()?>hris/employee/new/'"><i class="fa fa-plus"> </i>New Employee</button>
                </div>
            </div>
            <div class="portlet-body">
                <!-- <div class="table-scrollable"> -->
                    <table class="table table-striped table-bordered table-condensed table-hover" id="tblemployeelists">
                        <thead>
                            <tr>
                                <th> Index </th>
                                <th> ID </th>
                                <th> Name </th>
                                <th> Department </th>
                                <th> Status </th>
                                <th> Actions </th>
                            </tr>
                        </thead>
                        <?php
                        $status_list = array(
                            null => array("default","unassigned"),
                            0 => array("default","unassigned"),
                            1 => array("success","active"),
                            2 => array("warning","suspended"),
                            3 => array("danger","deactivated"),
                        ); 
                        ?>
                        <tbody>
                            <?php foreach($employees as $employee){ ?>
                            <tr>
                                <td class="employeeid"> <?php echo $employee['employee_id']?></td>
                                <td><?=($employee['id_card_number'])?:"Unassigned"?></td>
                                <td><?php echo $employee['lastname'].', '.$employee['firstname'];?></td>
                                <td><?=($employee['department_name'])?:"Unassigned"?> </td>
                                <?php $temp=$employee['status_id'];?>
                                <td> <span class="badge badge-<?php echo $status_list[$temp][0];?>"><?php echo $status_list[$temp][1];?></span> </td>
                                <td> 
                                    <button class="btn default btn-xs" onclick="location.href='<?=base_url()?>hris/employee/edit/<?=$employee['employee_id']?>'">edit</button> 
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                <!-- </div> -->
            </div>
        </div>
        <!-- END SAMPLE TABLE PORTLET-->


	</div>
</div>
</div>