<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="customermasterlist">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Edit User Detail</span>
                </div>
                <div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" onclick="location.href='<?=base_url()?>users'"><i class="fa fa-plus"> </i>View Users</button>
                    <button style="align:right;" type="button" class="btn btn-circle green" onclick="location.href='<?=base_url()?>logs/user/<?=$user['user_id']?>'"><i class="fa fa-plus"> </i>View Logs</button>
                    <button style="align:right;" type="button" class="btn btn-circle green" onclick="location.href='<?=base_url()?>permissions/user/<?=$user['user_id']?>'"><i class="fa fa-plus"> </i>View Permissions</button>
                    <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                </div>
            </div>                  
            <div class="portlet-body">
                <form class="form-horizontal" role="form" method="post" id="form_edit_user" action="<?=base_url();?>users/edit_submit">
                    <div class="form-group">
                        <label for="inputName" class="col-md-2 control-label">Name</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="name" id="inputName" placeholder="Name" readonly value="<?=$user['lastname']?>, <?=$user['firstname'];?>"></div>
                    </div>
                    <div class="form-group">
                        <label for="inputDepartment" class="col-md-2 control-label">Department</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="department_name" id="inputDepartment" placeholder="" readonly value="<?=$user['department_name']?>"> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername" class="col-md-2 control-label">Username</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Username" value="<?=$user['username']?>"> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-md-2 control-label">Password</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="password" id="inputPassword" placeholder="Password" value="<?=$user['password']?>"> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-md-2 control-label">E-mail</label>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value="<?=$user['email']?>"> </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-4">
                            <label class="mt-checkbox">
                                <input type="checkbox" id="inputVerifiedCheckbox" <?=($user['verified']==0?:"checked");?>> Verified
                                <span></span>
                            </label>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-4">
                            <select class="form-control col-md-4" name="status_id">
                                <option value="0" <?=($user['status_id']!=0?:"selected");?>>Unassigned</option>
                                <option value="1" <?=($user['status_id']!=1?:"selected");?>>Active</option>
                                <option value="2" <?=($user['status_id']!=2?:"selected");?>>Suspended</option>
                                <option value="3" <?=($user['status_id']!=3?:"selected");?>>Deactivated</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <input type="hidden" name="user_id" value="<?=$user['user_id']?>">
                            <input type="hidden" id="inputVerified" name="verified" value="<?=$user['verified']?>">
                            <button type="submit" class="btn blue">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
