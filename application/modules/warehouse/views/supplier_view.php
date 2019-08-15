<div class="row" id="frm_masterlist">
  <div class="col-md-12">
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          <i class="fa fa-users font-green-sharp"></i>
          <span class="caption-subject bold uppercase"> Supplier Master List</span>
        </div>
  
        <div class="actions">
          <button style="align:right;" type="button" class="btn btn-circle green" id="btn_add"><span class="fa fa-plus"></span> Add Supplier </button>
        </div>
      </div>                  
      
      <div class="portlet-body">  
        <table class="table table-hover" id="tbl_masterlist">
          <thead>
            <tr>
              <th>Supplier ID</th>
              <th>Supplier Name</th>
              <th>Supplier Type</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
            <?php foreach($records as $record){ ?>
              <tr>
                <td><?php echo $record['supplier_id'];?></td>
                <td><?php echo $record['supplier_name'];?></td>
                <td><?php echo ucfirst($record['supplier_type']);?></td>
                <td><?= ucfirst($record['status_name']); ?></td>
              </tr>
            <?php } ?>                   
          </tbody>
        </table>       
      </div>
    </div>
  </div>
</div>

<form method="post" enctype="multipart/form-data" id="frm_information" style="display: none;">
  <div class="row">
    <div class="col-md-12">
      <div class="portlet light">
        <div class="portlet-title">
            <div class="caption font-green-sharp">
              <i class="fa fa-list-alt"></i>
              <span class="caption-subject bold uppercase"> Supplier Information </span>
            </div>    
            <div class="actions">
              <button type="button" class="btn btn-circle btn-default pull-right" id="btn_back"><i class="fa fa-arrow-left"></i>Back</button> 
            </div>
        </div> 

        <div class="portlet-body">
          <div class="row">
            <div class="col-md-6">
              <div class="portlet light bordered">

                <div class="portlet-title">
                  <div class="caption font-green-sharp">
                    <span id="title_add" class="caption-subject bold uppercase">New Supplier</span>
                    <span id="title_update" class="caption-subject bold uppercase">Update Supplier</span>
                  </div>   
                </div>
          
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                        <input type="hidden" name="supplier_id" id="supplier_id" class="form-control" tabindex="-1" />
                      <div class="form-group">
                        <label class="control-label"> Select Type </label>
                        <select class="form-control" id="client_type_id" name="client_type_id">
                          <option value="" disabled selected>---- Supplier Type ----</option>
                          <?php foreach ($rec_types as $rec_type) { ?>
                          <option value="<?= $rec_type['client_type_id']; ?>"><?= ucfirst($rec_type['client_type_name']); ?></option>
                          <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label> Select Name</label>
                        <select class="form-control" id="reference_id" name ="reference_id">
                          <option value ="" disabled selected>---- Supplier Name ----</option>      
                          <?php foreach ($rec_suppliers as $rec_supplier) { ?>
                          <option value="<?= $rec_supplier['reference_id']; ?>">
                            <?= $rec_supplier['supplier_name']; ?>
                          </option>
                         <?php } ?>
                        </select>
                      </div>
                      
                      <div class="form-group">
                        <label> Vatable</label><br />
                        <input type="radio" name="vatable" id="vatable" value="1"> Yes <br />
                        <input type="radio" name="vatable" id="vatable" value="0" checked> No <br />
                      </div>
                      <div class="form-group">
                        <label> Supplier Status</label>                                     
                        <select name="status_id" id="status_id" class="form-control">
                          <option value="" disabled selected>---- Status ----</option>
                          <option value="1">Active</option>
                          <option value="2">Processing</option>
                          <option value="3">Suspended</option>
                        </select>                                  
                      </div> 

                      <input type="hidden" name="created_by" id="created_by" value="<?php echo $this->session->userdata('user_id'); ?>">

                    </div>
                      
                  </div>
                </div>
              </div>
            </div>


            <div class="col-md-6" id="frm_company">
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-green-sharp">
                    <span class="caption-subject bold uppercase"> Company </span>
                  </div>
                </div>
                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" name="organization_id" id="organization_id" placeholder=""/>

                      <div class="form-group">
                        <label> Company Name</label>
                        <input type="text" name="organization_name" id="organization_name" class="form-control" />
                      </div>

                      <div class="form-group">
                        <label> Company Tin</label>
                        <input type="text" name="tin" id="tin" class="form-control"/>
                      </div>    

                      <div class="form-group">
                        <label> Special Instruction</label>
                        <input type="text" name="special_instruction" id="special_instruction" class="form-control"/>
                      </div>        
                    
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-6" id="frm_person">
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-green-sharp">
                    <span class="caption-subject bold uppercase"> Person </span>
                  </div>
                </div>

                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-4">
                      <div class="form-group">
                        <div class="fileinput fileinput-new" data-provides="fileinput">
                          <div id="imageselect">
                            <div class="profile-userpic">
                              <div class="thumbnail" style="width: 100%; height: 150px;">
                                <!-- src="<?=base_url()?>public/images/profiles/3934.jpg" -->
                                <img  id="profilepicture" class="img-responsive" alt="">
                              </div>
                              <button type="button" class="btn green" id="editpic">
                                New Picture
                              </button>
                            </div>
                          </div>
                          <div id="profilechange">
                            <div class="fileinput-preview thumbnail" data-trigger="fileinput" style="width: 100%; height: 150px;">
                              
                            </div>
                            <span class="btn green btn-outline btn-file">
                              <span class="fileinput-new">Select Image</span>
                              <span class="fileinput-exists">Change</span>
                              <input type="file" id="userfile" name="userfile">
                            </span>
                            <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove</a>
                          </div>
                         
                        </div>
                      </div>
                    </div>
                    <div class="col-md-8">
                      <input type="hidden" name="person_id" id="person_id" placeholder=""/>

                      <div class="row">
                        <div class="col-md-6">
                          <div class="form-group">
                            <label> Prefix</label>
                            <input type="text" name="prefix" id="prefix" class="form-control"/>
                          </div>
                        </div>
                        <div class="col-md-6">
                          <div class="form-group">
                            <label> Suffix</label>
                            <input type="text" name="suffix" id="suffix" class="form-control"/>
                          </div>
                        </div>
                      </div>
                      <div class="row">
                        <div class="col-md-12">
                          <div class="form-group">
                            <label> Lastname</label>
                            <input type="text" name="lastname" id="lastname" class="form-control" />
                          </div>

                          <div class="form-group">
                            <label> Firstname</label>
                            <input type="text" name="firstname" id="firstname" class="form-control" />
                          </div>
                                
                          <div class="form-group">
                            <label> Middlename</label>
                            <input type="text" name="middlename" id="middlename" class="form-control"/>
                          </div>
                        </div>
                      </div>

                      <input type="hidden" name="created_by" id="created_by" value="<?php echo $this->session->userdata('user_id'); ?>">

                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Gender</label>
                        <select class="form-control" name="sex" id="sex">
                          <option value=" " disabled selected> ---- Select Gender ----</option>
                          <option value="M">Male</option>
                          <option value="F">Female</option>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Civil Status</label>
                        <select class="form-control" name="civil_status_id" id="civil_status_id">
                          <option value="" disabled selected>---- Civil Status ----</option>
                          <?php foreach ($rec_civilstatus as $rec_civilstatus) { ?>
                            <option value="<?= $rec_civilstatus['civil_status_id']; ?>"><?= $rec_civilstatus['civil_status_name']; ?>
                            </option>
                         <?php } ?>
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nationality</label>
                        <input type="text" name="nationality" id="nationality" class="form-control">
                      </div>
                    </div>
                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Birthday</label>
                        <input type="text" name="birthdate" placeholder="yyyy-mm-dd" class="form-control" id="birthdate" maxlength="10">
                      </div>
                      <div class="form-group">
                        <label>Place of Birth</label>
                        <input type="text" name="birthplace" id="birthplace" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Tax Identification No.</label>
                        <input type="text" name="ptin" id="ptin" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>

          <div class="row">

            <div class="col-md-6" id="frm_contact">
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-green-sharp">
                    <span class="caption-subject bold uppercase"> Contact </span>
                  </div>
                </div>

                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                       <table class="table table-hover" id="tbl_contact" >
                        <thead>
                          <tr>
                            <th>Contact Type</th>
                            <th>Contact Value</th>
                            
                          </tr>
                        </thead>
                        <tbody>
                          <tr>
                            <td width="30%">
                              <input type="hidden" name="contact_id2" id="contact_id2">
                              <input type="text" id="contact_type_id2" class="form-control" readonly="readonly" value="Work Phone">
                            </td>
                            <td>
                              <input type="text" id="contact_value2" name="contact_value2" class="form-control">
                            </td>
                          </tr>    
                          <tr id="tr_homephone">
                            <td width="30%">
                              <input type="hidden" name="contact_id1" id="contact_id1">
                              <input type="text" id="contact_type_id1" class="form-control" readonly="readonly" value="Home Phone">
                            </td>
                            <td>
                              <input type="text" id="contact_value1" name="contact_value1" class="form-control">
                            </td>
                          </tr>   
                          <tr>
                            <td width="30%">
                              <input type="hidden" name="contact_id4" id="contact_id4">
                              <input type="text" id="contact_type_id4" class="form-control" readonly="readonly" value="Work Email">
                            </td>
                            <td>
                              <input type="text" id="contact_value4" name="contact_value4" class="form-control">
                            </td>
                          </tr>   
                          <tr id="tr_personalemail">
                            <td width="30%">
                              <input type="hidden" name="contact_id3" id="contact_id3">
                              <input type="text" id="contact_type_id3" class="form-control" readonly="readonly" value="Personal Email">
                            </td>
                            <td>
                              <input type="text" id="contact_value3" name="contact_value3" class="form-control">
                            </td>
                          </tr>           
                          <tr>
                            <td width="30%">
                              <input type="hidden" name="contact_id5" id="contact_id5">
                              <input type="text" id="contact_type_id5" class="form-control" readonly="readonly" value="Fax Number">
                            </td>
                            <td>
                              <input type="text" id="contact_value5" name="contact_value5" class="form-control">
                            </td>
                          </tr>  
                        </tbody>
                      </table>      
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <div class="col-md-6" id="frm_address">
              <div class="portlet light bordered">
                <div class="portlet-title">
                  <div class="caption font-green-sharp">
                    <span class="caption-subject bold uppercase"> Address </span>
                  </div>
                </div>

                <div class="portlet-body">
                  <div class="row">
                    <div class="col-md-12">
                      <input type="hidden" name="address_id" id="address_id" placeholder=""/>

                      <div class="form-group">  
                        <label class="control-label">Select Address Type</label> 
                        <select class="form-control" id="address_type_id" name ="address_type_id">
                          <option value ="" disabled selected>---- Address Type ----</option>
                          <?php foreach($addrtypes as $addrtype){ ?>
                          <option value="<?php echo $addrtype['address_type_id'];?>"><?php echo 
                                         $addrtype['address_type_name'];?></option><?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label>Street</label>
                        <input type="text" name="line_1" id="line_1" class="form-control"/>
                      </div>   

                      <div class="form-group">
                        <label>Barangay</label>
                        <input type="text" name="line_2" id="line_2" class="form-control"/>
                      </div>

                      <div class="form-group">
                        <label>House Number</label>
                        <input type="text" name="line_3" id="line_3" class="form-control"/>
                      </div>

                      <div class="form-group">  
                        <label class="control-label">Select City</label> 
                        <select class="form-control" id="city_id" name ="city_id" required>
                          <option value ="" disabled selected>---- City ----</option>
                          <?php foreach($cities as $city){ ?>
                          <option value="<?php echo $city['address_city_id'];?>"><?php echo 
                                         $city['city_name'];?></option><?php } ?>
                        </select>
                      </div>

                      <div class="form-group">  
                        <label class="control-label">Select Province</label> 
                        <select class="form-control" id="province_id" name ="province_id" required>
                          <option value ="" disabled selected>---- Province ----</option>
                          <?php foreach($provinces as $province){ ?>
                          <option value="<?php echo $province['address_province_id'];?>"><?php echo 
                                         $province['province_name'];?></option><?php } ?>
                        </select>
                      </div>

                      <div class="form-group">  
                        <label class="control-label">Select Country</label> 
                        <select class="form-control" id="country_id" name ="country_id" required>
                          <option value ="" disabled selected>---- Country ----</option>
                          <?php foreach($countries as $country){ ?>
                          <option value="<?php echo $country['id'];?>"><?php echo 
                                       $country['country_name'];?></option><?php } ?>
                        </select>
                      </div>

                      <div class="form-group">
                        <label> Postal Code</label>
                        <input type="text" name="postal_code" id="postal_code" class="form-control"/>
                      </div>

                      

                      <input type="hidden" name="created_by" id="created_by" value="<?php echo $this->session->userdata('user_id'); ?>">
                    </div>
                  </div>
                </div>
              </div>
            </div>

          </div>
          <div class="row">
            <div class="col-md-12 text-right">
              <button type="button" class="btn btn-circle btn-default" id="btn_back2"><i class="fa fa-arrow-left"></i>Back</button> 
              <button type="submit" class="btn green" id="btn_save"><i class="fa fa-plus"></i>Save</button>
            </div>
            
                    
          </div>
        <!-- end of body -->
        </div> 
      </div>    
    </div>
  </div>
</form>



