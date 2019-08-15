<div class="row" id='showtable'>
  <div class="col-md-12">
    <div class="portlet light " id="departmentmasterlist">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          <i class="fa fa-users font-green-sharp"></i>
          <span class="caption-subject bold uppercase"> Department Master List</span>
          
        </div>
  
        <div class="actions">
          <button style="align:right;" type="button" class="btn btn-circle green" id="addnew"><i class="fa fa-plus"> </i>Add Department</button>
        </div>
      </div>                  
      <div class="portlet-body">  
        <table class="tblmasterlist table table-hover" id="tblmasterlist" >
          <thead>
            <tr>
              <th>Department ID</th>
              <th>Department Name</th>
              <th>Department Code</th>
            </tr>
          </thead>
          <tbody>
          <?php foreach($records as $record){ ?>
            <tr>
              <td><?php echo $record['department_id'];?></td>
              <td><?php echo $record['department_name'];?></td>
              <td><?php echo $record['department_code'];?></td>
            </tr>
          <?php } ?>                   
          </tbody>
        </table>       
      </div>
    </div>
  </div>  
</div>



<div class='row' id='showform' style="display:none;">
  <div class='col-md-6'>
    <div class='portlet light'>
      <div class='portlet-title'>
        <div class="caption font-green-sharp">
            <i class="fa fa-users font-green-sharp"></i>
            <span id="title_add"  class="caption-subject bold uppercase"> New Department</span>
            <span id="title_update" class="caption-subject bold uppercase"> Update Department</span>
        </div>
        <div class="actions">
          <button style="align:right;" type="button" class="btn btn-circle btn-default" id="bck"><i class="fa fa-plus"> </i>Back</button>
        </div>
      </div>

      <div class='portlet-body'>
        <form method="POST" enctype="multipart/form-data" id='infoform' name='infoform'>
          <div class='profile'>
            <div class='row'>
              <div class='col-md-12'>
                <div class='form-group'>

                    <input type='hidden' name='department_id' id='department_id' placeholder=''/>

                  <div class='form-group'>
                    <label>Department Code</label>
                     <div class="input-group">
                                <div class="input-icon">
                                    <input id="inputName" class="form-control" type="text" name="name" placeholder="Select Department" readonly data-toggle="modal" data-target="#modal_select_department"> </div>
                                <span class="input-group-btn">
                                    <button id="btnSelectEmployee" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_select_department">
                                        <i class="fa fa-search fa-fw"></i> Select</button>
                                </span>
                            </div>
                  </div>

                  <div class='form-group'>
                    <label>Activity Code</label>
                    <input type='text' name='activity_code' id='activity_code' class='form-control'/> 
                    <span class='text-danger'><?= form_error('activity_code'); ?></span>
                  </div>

                  <div class='form-group'>
                    <label>Department Name</label>
                    <input type='text' name='department_name' id='department_name' class='form-control'/>
                    <span class='text-danger'><?= form_error('department_name'); ?></span>
                  </div>

                  <div class='form-group'>
                    <label class='control-label'>Select Route</label>
                    <select class='form-control' id='route_id' name='route_id'>
                      <option value='' disabled selected>---- Routes ----</option>
                      <?php foreach ($all_routes as $all_route) { ?>
                      <option value="<?= $all_route['route_id']; ?>"><?= $all_route['route_description']; ?></option>
                      <?php } ?>
                    </select>
                  </div>


                  <input type='hidden' name='created_by' id='created_by' value="<?= $this->session->userdata('user_id'); ?>">

                  <div class='form-group'>
                    <label> Department Status</label>

                    <select name='status_id' id='status_id' class='form-control'>
                      <option value='' disabled selected>---- Status ----</option>
                      <option value='1'>Active</option>
                      <option value='2'>Processing</option>
                      <option value='3'>Suspended</option>
                    </select>
                  </div>
                </div>
              </div>
              
              <div class='actions' align="right">
                <button  type="button" class="btn btn-circle btn-default" id="bck2"><i class="fa fa-plus"> </i>Back</button>
                <button type="submit" class="btn green" id="saveButton"><i class="fa fa-plus"></i>Save</button>
              </div>
            </div>
          </div>
        </form>

      </div>
    </div>
  </div>
</div>


 <!-- Make agent a Broker -->
<div id="modal_select_department" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Department List<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
            </div>
            <div class="modal-body">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">Select Department</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="table-scrollable">
                            <table class="table table-condensed table-hover" id="tbl_department_modal">
                                <thead>
                                    <tr>
                                        <th> ID </th>
                                        <th> Name </th>
                                        <th> Department Code </th>
                                        <th> Department Name </th>
                                        <th> Status </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td> 1 </td>
                                        <td> Mark Otto </td>
                                        <td> ENGG </td>
                                        <td> Engineering and Construction </td>
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