<div class="row" id="frm_masterlist">
  <div class="col-md-12">
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          <i class="fa fa-cubes"></i>
          <span class="caption-subject bold uppercase"> DESIGNATE EMPLOYEE</span>
        </div>
      </div>

      <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="emp_dept_form" action="<?=base_url();?>employee/employee/ajax_insert_employee_department"> <br><br>
        <input type="integer" value="<?php echo $_SESSION['dept_id']; ?>" id="dept_id" name="" hidden>
        <div class="form-group row">
         <label class="col-lg-2">EMPLOYEE</label>
          <select class="" name="employee_id" id="employee_id" required>
            <option value="0" class="disabled selected">Select Employee</option>
            <?php foreach($all_employees as $all_employees){ ?>
              <option value="<?php echo $all_employees['employee_id'];?>" class="form-control input-sm input-small input-inline"><?php echo $all_employees['lastname'];?>, <?php echo $all_employees['firstname'];?></option><?php } ?>
          </select> <br><br><br>
          <label class="col-lg-2">DEPARTMENT</label>
         <select class="" name="department_id" id="department_id" disabled>
            <option value="0" class="disabled selected">Select Department</option>
            <?php foreach($all_department as $all_department){ ?>
              <option value="<?php echo $all_department['department_id'];?>" class="form-control input-sm input-small input-inline" <?php echo ($all_department['department_id'] == $_SESSION['dept_id']) ? "selected" : ""; ?>><?php echo $all_department['department_name'];?></option><?php } ?>
          </select>
          <br> <br> <br> 
          <label class="col-lg-2">CONTRACT START</label>
          <input type="date" name="contract_start" id="contract_start" class="form-control input-sm input-small input-inline" required>
          <br> <br> 
          <label class="col-lg-2">CONTRACT EXPIRY</label>
          <input type="date" name="contract_expiry" id="contract_expiry" class="form-control input-sm input-small input-inline">
          <br> <br>
          <!-- <label class="col-lg-2">QUANTITY</label>
          <input type="number" name="item_quantity" id="item_quantity" class="form-control input-sm input-small input-inline"> -->
          <br>

          <button id="add_employee_department" name="add_employee_department" class="btn btn-sm green" type="submit" data-toggle="modal" data-target="" >Add</button> <br><br>
           <button onclick="history.go(-1);" type="button" class="btn btn-sm btn-default" id="bck2"><i class="fa fa-arrow-left"> </i>Back</button>
        </div>
      </form>

      <p>
        <h3>DEPARTMENT NAME: <?php echo $department_name[0]['department_name']; ?></h3>
        <h3>DEPARTMENT HEAD: <?php echo (isset($department_head[0]['lastname']) && isset($department_head[0]['firstname'])) ? $department_head[0]['lastname'] . ", " . $department_head[0]['firstname'] : ""; ?></h3>
      </p>
      
      <div class="portlet-body">  
        <table class="table table-hover" id="tbl_employee_department" data-url="<?=base_url();?>employee/employee/getEmployeeDepartment">
          <thead>
            <tr>
              <th>DATETIME</th>
              <th>Employee Name</th>
              <th>Department</th>
              <th>Contract Start</th>
              <th>Contract Expiry</th>
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="edit_emp_dept" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Edit User Details<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
            </div>
            <div class="modal-body">
                <div class="portlet-body">
                    <div class="table-scrollable">
                      <input type="integer" name="edit_employee_department_id" id="edit_employee_department_id" hidden>
                      <?php $abcd = " . 2 . "; ?>
                      <br><br>
                      <label class="col-lg-2">EMPLOYEE</label>
                      <select class="" name="edit_employee_id" id="edit_employee_id" required>
                        <option value="0" class="disabled selected" selected="selected">Select Employee</option>
                        <?php foreach($all_employees_3 as $all_employees_3){ ?>
                          <option value="<?php echo $all_employees_3['employee_id'];?>" class="form-control input-sm input-small input-inline"><?php echo $all_employees_3['lastname'];?>, <?php echo $all_employees_3['firstname'];?></option><?php } ?>
                      </select><br><br><br>
                      <label class="col-lg-2">DEPARTMENT</label>
                      <select name="edit_department_id" id="edit_department_id"  required>
                      <option value="0" class="disabled selected" selected="selected">Select Department</option>
                        <?php foreach($all_department_3 as $all_department_3){ ?>
                          <option value="<?php echo $all_department_3['department_id'];?>" class="form-control input-sm input-small input-inline"><?php echo $all_department_3['department_name'];?></option><?php } ?>
                      </select>
                      <br><br>
                      <label class="col-lg-2">CONTRACT START</label>
                      <input type="date" name="edit_contract_start" id="edit_contract_start" value="" class="form-control input-sm input-small input-inline">
                      <br><br>
                      <label class="col-lg-2">CONTRACT EXPIRY</label>
                      <input type="date" name="edit_contract_expiry" id="edit_contract_expiry" value="" class="form-control input-sm input-small input-inline">
                      <br><br>
                      <!-- <label class="col-lg-2">QUANTITY</label>
                      <input type="number" name="edit_item_quantity" id="edit_item_quantity" value="" class="form-control input-sm input-small input-inline"> -->
                    </div>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="post" id="form_edit_emp_dept" action="<?=base_url();?>employee/employee/edit_employee_department">
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
                  <button type="submit" data-dismiss="modal" class="btn green-meadow" id="confirm_edit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Submit</button>
              </div>
            </form>
        </div>
    </div>
</div>

<div id="delete_emp_dept" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">Select Employee</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                      Are you sure you want to delete this employee details?
                    </div>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="form_delete_spec" action="<?=base_url();?>employee/employee/ajax_delete_employee_department_record">
              <input type="integer" name="employee_department_id" id="employee_department_id" value="" hidden>
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
                  <button type="submit" data-dismiss="modal" class="btn green-meadow" id="confirm_delete"><i class="fa fa-floppy-o" aria-hidden="true"></i>Yes</button>
              </div>
            </form>
        </div>
    </div>
</div>