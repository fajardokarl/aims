<div class="row" id='showtable'>
  <div class="col-md-12">
    <div class="portlet light " id="departmentmasterlist">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          <i class="fa fa-users font-green-sharp"></i>
          <span class="caption-subject bold uppercase"> Add Department</span>
          
        </div>
  
       <!-- <div class="actions">
          <button style="align:right;" type="button" class="btn btn-circle green" id="addnew"><i class="fa fa-plus"> </i>Add Department</button> 
        </div>-->
      </div>                  
       <div class="portlet-body">
                <form class="form-horizontal" role="form" method="post" id="form_edit_user" action="<?=base_url();?>department/update_department">
                  <input type="number" name="inputDepartmentId" id="inputDepartmentId" value="="<?php  ?>" hidden>
                   <!--  <div class="form-group">
                        <label class="col-md-2 control-label">Department Code</label>
                        <div class="col-md-5">
                            <div class="input-group">
                                <div class="input-icon">
                                    <input id="inputName" class="form-control" type="text" name="inputName" placeholder="Select Department" readonly data-toggle="modal" data-target="#modal_select_department"> </div>
                                <span class="input-group-btn">
                                    <button id="btnSelectDepartment" class="btn btn-success" type="button" data-toggle="modal" data-target="#modal_select_department">
                                        <i class="fa fa-search fa-fw"></i> Select</button>
                                </span>
                            </div>
                        </div>
                    </div> -->
                    <div class="form-group">
                        <label for="inputName" class="col-md-2 control-label">Department Code</label>
                        <div class="col-md-4">
                            <input type="text" style="text-transform:uppercase" class="form-control" name="inputName" id="inputName" placeholder="Department Code"  value="<?php  ?>" required> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputDepartment" class="col-md-2 control-label">Department Name</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="inputDepartment" id="inputDepartment" placeholder="Department Name"  value="<?php  ?>" required> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputActivityCode" class="col-md-2 control-label">Activity Code</label>
                        <div class="col-md-4">
                            <input type="text" class="form-control" name="inputActivityCode" id="inputActivityCode" placeholder="Activity Code" value="<?php  ?>" required> </div>
                    </div>
                    <div class="form-group">
                        <label for="inputRoute" class="col-md-2 control-label">Select Route</label>
                        <div class="col-md-4" value="<?php  ?>">
                            
                    <select required="required" class='form-control' id='inputRoute' name='inputRoute' >
                      <option value='' readonly>--- Route ---</option>
                      <option value='1' readonly>1</option>
                      <option value='2' readonly>2</option>
                      <option value='3' readonly>3</option>
                      <option value='4' readonly>4</option>
                      <option value='5' readonly>5</option>
                      <option value='6' readonly>6</option>
                      <option value='7' readonly>7</option>
                      <option value='8' readonly>8</option>
                      <option value='9' readonly>9</option>
                      <option value='10' readonly>10</option>
                      <option value='11' readonly>11</option>
                      <option value='12' readonly>13</option>
                      <option value='12' readonly>14</option>
                      <option value='12' readonly>15</option>
                      <option value='12' readonly>16</option>
                      <option value='12' readonly>17</option>
                      <option value='12' readonly>18</option>
                      <option value='12' readonly>19</option>
                      <option value='12' readonly>20</option>

                    </select></div>
                    </div>

                    <input type='hidden' name='created_by' id='created_by' value="<?= $this->session->userdata('user_id'); ?>" >

                    <div class="form-group">
                        <label class="col-md-2 control-label">Department Status</label>
                        <div class="col-md-4">
                            <select required="required" class="form-control col-md-4" name="inputDepartmentStatus" id="inputDepartmentStatus" value="<?php  ?>">
                                <option value="">--- Status ---</option>
                                <option value="1">Active</option>
                                <option value="2">Suspended</option>
                                <option value="3">Deactivated</option>
                            </select>
                        </div>
                    </div>
                    <div class='actions' align="right">
                <button onclick="history.go(-1);" type="button" class="btn btn-circle btn-default" id="bck2"><i class="fa fa-arrow-left"> </i>Back</button>
                <button type="submit" class="btn green" id="saveButton"><i class="fa fa-plus"></i>Save</button>
              </div>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
      
<script>
document.getElementById("form_edit_user").addEventListener("submit", myFunction);

function myFunction() {
    alert("succesfully added new department!");
}
</script>
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
                                        <th> Department Code </th>
                                        <th> Department Name </th>
                                        <th> Activity Code </th>
                                        <th> Route </th>
                                        <th> Status </th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
<!--                                     <tr>
                                        <td> 1 </td>
                                        <td> ENGG </td>
                                        <td> Engineering and Construction </td>
                                        <td> Engineering and Construction </td>
                                        <td> <span class="label label-sm label-success"> Active </span> </td>
                                    </tr> -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn dark btn-outline" id=""><i class="fa fa-times" aria-hidden="true"></i>Close</button>
                <button type="button" data-dismiss="modal" class="btn green-meadow" id="btn_choose_department"><i class="fa fa-floppy-o" aria-hidden="true"></i>Select</button>
            </div>
        </div>
    </div>
</div>       