<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="customermasterlist">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Users Master List</span>
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" id="addnewcust" onclick="location.href='<?=base_url()?>users/news/'"><i class="fa fa-plus"> </i>New User</button>
                    <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                </div>
            </div>                  
            <table class="tbluserlists table table-hover" id="tbluserlists" data-nouser="<?php echo $nouser;?>">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Username</th>
                        <th>Department</th>
                        <th>Status</th>
                        <th>Verified</th>
                        <th>Last Login</th>
                        <th>Actions</th>
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
                    <?php foreach($users as $user){ ?>
                    <tr>
                        <td><?php echo $user['lastname'].', '.$user['firstname'];?></td>
                        <td><?php echo $user['username'];?></td>
                        <td><?php echo $user['department_name'];?></td>
                        <?php $temp=$user['status_id'];?>
                        <td><span class="badge badge-<?php echo $status_list[$temp][0];?>"><?php echo $status_list[$temp][1];?></span></td>
                        <td><?php echo ($user['verified']==1 ? 'yes':'no');?></td>
                        <td><?php echo $user['last_logged'];?></td>
                        <td>
                            <button class="btn default btn-xs" onclick="location.href='<?=base_url()?>users/edit/<?=$user['user_id']?>'">edit</button> 
                            <button class="btn default btn-xs" onclick="location.href='<?=base_url()?>logs/user/<?=$user['user_id']?>'">logs</button> 
                            <button class="btn default btn-xs" onclick="location.href='<?=base_url()?>permissions/user/<?=$user['user_id']?>'">permissions</button>
                        </td>
                       
                    </tr>
                    <?php } ?> 
                </tbody>
            </table>        
        </div>
        
    </div>
</div>
</div>