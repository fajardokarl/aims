<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="customermasterlist">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Add new user</span>
                </div>
                <div class="actions">
                    <!-- <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddCustomer" id="addnewcust"><i class="fa fa-plus"> </i>View Logs</button>
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddCustomer" id="addnewcust"><i class="fa fa-plus"> </i>View Permissions</button>
                    <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                </div>
            </div>                  
            <div class="portlet-body">
                <form class="form-horizontal" role="form" method="post" id="form_edit_user" action="<?=base_url();?>users/add_submit">
                    <div class="form-group">
                        <label class="col-md-2 control-label">Employee</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-icon">
                                    <input id="inputName" class="form-control" type="text" name="name" placeholder="Select Employees" readonly data-toggle="modal" data-target="#modal_select_employee"> </div>
                                <span class="input-group-btn">
                                    <button id="btnSelectEmployee" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_select_employee">
                                        <i class="fa fa-search fa-fw"></i> Select</button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDepartment" class="col-md-2 control-label">Department</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="department_name" id="inputDepartment" placeholder="Department"  value="" readonly> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputUsername" class="col-md-2 control-label">Username</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="username" id="inputUsername" placeholder="Username" value=""> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputPassword" class="col-md-2 control-label">Password</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="password" id="inputPassword" placeholder="Password" value=""> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputEmail" class="col-md-2 control-label">E-mail</label>
                        <div class="col-md-4">
                            <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" value=""> </div>
                    </div>
                    <div class="form-group">
                        <label class="col-md-2 control-label">Status</label>
                        <div class="col-md-4">
                            <select class="form-control col-md-4" name="status_id">
                                <option value="0" >Unassigned</option>
                                <option value="1" >Active</option>
                                <option value="2" >Suspended</option>
                                <option value="3" >Deactivated</option>
                            </select>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-offset-2 col-md-10">
                            <input type="hidden" name="user_id" value="">
                            <input type="hidden" name="employee_id" id="employee_id" value="">
                            <button type="submit" class="btn blue">Save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>

<!-- Make agent a Broker -->
<div id="modal_select_employee" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Employee List<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
            </div>
            <div class="modal-body">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">Select Employee</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover" id="tbl_employee_modal">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Name </th>
                                        <th> Department </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td> Mark Otto </td>
                                        <td> Engineering </td>
                                        <td> <span class="label label-sm label-success"> Active </span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" id=""><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                <button type="button" data-dismiss="modal" class="btn green-meadow" id="btn_choose_employee"><i class="fa fa-floppy-o" aria-hidden="true"></i>Select</button>
            </div>
        </div>
    </div>
</div>