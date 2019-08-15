<div class="row" id='showtable'>
  <div class="col-md-12">
    <div class="portlet light " id="departmentmasterlist">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          <i class="fa fa-users font-green-sharp"></i>
          <span class="caption-subject bold uppercase"> Department Master List</span>
          
        </div>
  
        <div class="actions">
          <button style="align:right;" type="button" class="btn btn-circle green" id="addnew" onclick="location.href='<?=base_url()?>department/new/'"><i class="fa fa-plus"> </i>Add Department</button>
        </div>
      </div>                  
      <div class="portlet-body">  
        <table class="tblmasterlist table table-hover" id="tblmasterlist" >
          <thead>
            <tr>
              <th>Department ID</th>
              <th>Department Name</th>
              <th>Department Head</th>
              <th>Action</th>
            </tr>
          </thead>
      <!-- <script type="text/javascript">
      $('#example').dataTable( {
        'columns': [
          null,
          null,
          null,
            {
              'data': 'first_name', // can be null or undefined
              'defaultContent': '<i>Not set</i>'
            }
                  ]
        } );
      </script> -->
          <tbody>
          <?php
          for($i=0;$i<count($records);$i++){ ?>
            <tr>
              <td><?php echo $records[$i]['department_id'];?></td>
              <td><?php echo $records[$i]['department_name'];?></td>
              <td><?php if( !(empty($manager)) ) {
              for($ii=0;$ii<count($manager);$ii++) {
                if( $manager[$ii]['department_id'] == $i+1 ) {
                  echo $manager[$ii]['lastname'] . ", " . $manager[$ii]['firstname'];
                  break;
                } else {
                  if( $ii == (count($manager) - 1) ) echo "";
                  // return null;
                }
               }
             } else {
              echo "";
             }
             ?></td>
              <?php // print_r($manager); ?>
              <td><button id="btnSelectEmployee" name="btnSelectEmployee" class="btn btn-circle green-jungle" type="button" data-toggle="modal" data-target="#modal_select_employee" value="<?php echo $records[$i]['department_id']; ?>">Edit</button></td>
            </tr>
          <?php  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>  
</div>

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
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="post" id="form_edit_user_manager" action="<?=base_url();?>department/update_department_manager">
              <input type="integer" name="manager_employee_id" id="manager_employee_id" hidden>
              <input type="text" name="employee_name" id="employee_name" hidden>
              <input type="integer" name="department_id" id="department_id" hidden>
              <input type="integer" name="department_employee_id" id="department_employee_id" hidden>
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline" id=""><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                  <button type="submit" data-dismiss="modal" class="btn green-meadow" id="saveButton"><i class="fa fa-floppy-o" aria-hidden="true"></i>Select</button>
              </div>
            </form>
        </div>
    </div>
</div>