<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Personal Information </span>
            </div>
                        <div class="actions"> 
                <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="edit_info"><i class="fa fa-pencil-square-o"> </i>Edit info</button>
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="pdf_amort_sched"><i class="fa fa-plus"> </i>Get PDF</button>
            </div>
        </div>
        <div class="portlet-body">
            <form class="form-horizontal">
                <div class="row">
                    <div class="col-md-6">
                        <!-- <div class="form-group"> -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Name:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->prefix; echo " "; echo $emp->firstname; echo " "; echo $emp->middlename; echo " "; echo $emp->lastname; echo " "; echo $emp->suffix; ?>
                                    <input type="hidden" id="person_id" value="<?php echo $emp->person_id; ?>">
                                    <input type="hidden" id="employee_id" value="<?php echo $emp->employee_id; ?>">
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->department_name; ?>
                                </p>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Position:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->job_position; ?>
                                </p>
                            </div> 
                        </div>
                 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Sex:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->sex; ?>
                                </p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Birthdate:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->birthdate; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Birthplace:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static" id='total_amount'>
                                      <?php echo $emp->birthplace; ?>
                                </p>
                            </div> 
                        </div> 
                    </div>


                    <div class="col-md-6">
                        <!-- <div class="form-group"> -->
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Nationality:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->nationality; ?>
                                   
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Civil status:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->civil_status_name; ?>
                                </p>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Weight:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->weight; ?>
                                </p>
                            </div> 
                        </div>
                 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Height:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->height; ?>
                                </p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> TIN:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->tin; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> SSS no. :</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static" id='total_amount'>
                                      <?php echo $emp->sss; ?>
                                </p>
                            </div> 
                        </div> 
                    </div>
            <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> HDMF no. :</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $emp->hdmf; ?>
                                </p>
                            </div>
                        </div>
            </div>
            <div class="col-md-6">
                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PHIC no. :</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                 <?php echo $emp->phic; ?>
                                </p>
                            </div>
                        </div>
            </div>

 <div class="col-md-6">
    <!-- BEGIN Portlet PORTLET-->
     <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Applicant language spoken </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
          
          <table class="table table-hover" id="language_table">
            <thead>
            <tr>  
            <th>ID</th>
            <th>Language spoken</th>
            </tr>
            </thead>
            <tbody>
                <?php foreach($language as $language){ ?>
                <tr>
                    <td><?php echo $language['language_id']; ?></td>
                    <td><?php echo $language['language'] ;?></td>
                </tr>
                <?php } ?> 
            </tbody>
        </table>             
        </div>
    </div>
</div>   




<div class="col-md-6">
    <!-- BEGIN Portlet PORTLET-->
     <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Contact Information </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
          
                      <table class="table table-hover" id="emp_contacts_table">
                        <thead>
                        <tr>                     
                           
                            <th>ID</th>
                            <th>Contact type</th>
                            <th>Contact</th>
                          
                        </tr>
                        </thead>
                        <tbody>

                <?php foreach($contact as $contact){ ?>
                <tr>
                    <td><?php echo $contact['contact_id']; ?></td>
                    <td><?php echo $contact['contact_type_name'] ;?></td>           
                    <td><?php echo $contact['contact_value']; ?></td>
                 
                
                </tr>
                <?php } ?> 
                        </tbody>
                    </table>  
            
        </div>
    </div>
</div>


<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
     <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Address Information </div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
                  <table class="table table-hover" id="address_contacts_table">
                        <thead>
                        <tr>                     
                            <th>ID</th>
                            <th>Address type</th>
                            <th>Address</th>
                            <th>Postal code</th>
                        </tr>
                        </thead>
                        <tbody>

                <?php foreach($address as $address){ ?>
                <tr>
             <td><?php echo $address['address_id']; ?></td>
             <td><?php echo $address['address_type_name'] ;?></td>
             <td><?php echo $address['line_1'].', '.$address['line_2'].', '.$address['city_name'].', '.$address['province_name'].' '.$address['country_name'] ?></td>       
             <td><?php echo $address['postal_code']; ?></td>       
                
                </tr>
                <?php } ?> 
                        </tbody>
                    </table>
        

        </div>
    </div>
</div>

<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>School last attended</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
                  
         <table class="table table-hover" id="last_school_table">
                    <thead>
                    <tr>                     
                        <th>ID</th>
                        <th>Level</th>
                        <th>School</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Year Graduated</th>      
                    </tr>
                    </thead>
                    <tbody>

                <?php foreach($school as $school){ ?>
                <tr>
                        <td><?php echo $school['school_attended_id']; ?></td>
                        <td><?php echo $school['school_description'] ;?></td>
                        <td><?php echo $school['school_name'] ;?></td>
                        <td><?php echo $school['fromdate'];?></td>       
                        <td><?php echo $school['todate']; ?></td>
                        <td><?php echo $school['year_graduate']; ?></td>
                
                </tr>
                <?php } ?> 
                        </tbody>
                    </table>

        </div>
    </div>
</div>



<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
   <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Examination taken</div>
            <div class="tools">
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="update_exam"><i class="fa fa-plus"> </i>Exam taken</button>
                
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
           <table class="table table-hover" id="examination_table">
                    <thead>
                    <tr>                     
                        <th>ID</th>
                        <th>Examination type</th>
                        <th>Name of exam</th>
                        <th>Rating</th>
                        <th>Date taken</th>
                        <th>Date expiration</th>      
                    </tr>
                    </thead>
                    <tbody>

                <?php foreach($exam as $exam){ ?>
                <tr>
                        <td><?php echo $exam['exam_taken_id']; ?></td>
                        <td><?php echo $exam['exam_type'] ;?></td>
                        <td><?php echo $exam['exam_name'] ;?></td>
                        <td><?php echo $exam['exam_rating'] ;?></td>
                        <td><?php echo $exam['exam_taken'];?></td>       
                        <td><?php echo $exam['date_expiration']; ?></td>
                </tr>
                <?php } ?> 
                        </tbody>
                    </table>             


        </div>
    </div>
</div>


<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
   <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Work experience</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
          <table class="table table-hover" id="work_experience_table">
                    <thead>
                    <tr>                     
                        <th>ID</th>
                        <th>Position</th>
                        <th>Employer</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Compensation</th>      
                    </tr>
                    </thead>
                    <tbody>

                <?php foreach($work as $work){ ?>
                <tr>
                        <td><?php echo $work['workexp_id']; ?></td>
                        <td><?php echo $work['previous_position'] ;?></td>
                        <td><?php echo $work['employer'] ;?></td>
                        <td><?php echo $work['exclusive_from'] ;?></td>
                        <td><?php echo $work['exclusive_to'];?></td>       
                        <td><?php echo $work['compensation']; ?></td>
                </tr>
                <?php } ?> 
                        </tbody>
                    </table>

        </div>
    </div>
</div>



<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Family background</div>
            <div class="tools">
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="update_member"><i class="fa fa-plus"> </i>Family member</button>
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
     <table class="table table-hover" id="family_table">
                    <thead>
                    <tr>                     
                        <th>ID</th>
                        <th>Relation</th>
                        <th>Name</th>
                        <th>Age</th>                        
                        <th>Address</th>     
                        <th>Contact no.</th> 
                    </tr>
                    </thead>
                    <tbody>

              <?php foreach($family as $family){ ?>
                <tr>
                        <td><?php echo $family['family_info_id']; ?></td>
                        <td><?php echo $family['family_description'] ;?></td>
                        <td><?php echo $family['fam_name'] ;?></td>                        
                        <td>
                        <?php 
                        if ($family['fam_age'] == 0) {
                            echo "<span class='font-red-intense bold'>Deceased</span>";
                        }else{
                            echo $family['fam_age'];
                        }?>
                        </td>
                        <td><?php echo $family['fam_address'] ;?></td> 
                        <td>
                        <?php 
                        if ($family['fam_contact'] == 0) {
                            echo "<span class='font-red-intense bold'>None</span>";
                        }else{
                            echo $family['fam_contact'];
                            }
                        ?>
                        </td>
                        

                        
                </tr>
                <?php } ?>
                        </tbody>
                    </table>

        </div>
    </div>
</div>

<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Evaluation</div>
            <div class="tools">
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="update_evaluation"><i class="fa fa-plus"> </i> Evaluation</button>
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
     <table class="table table-hover" id="evaluation_table">
                    <thead>
                    <tr>                     
                        <th>ID</th>
                        <th>Evaluated by</th>
                        <th>Current position</th>
                        <th>From</th>                        
                        <th>To</th>     
                        <th>Result</th> 
                        <th>Remark</th> 
                    </tr>
                    </thead>
                    <tbody>
              <?php foreach($evaluation as $evaluation){ ?>
                <tr>
                        <td><?php echo $evaluation['emp_eval']; ?></td>
                        <td><?php echo $evaluation['firstname'] .' '. $evaluation['middlename'].' '. $evaluation['lastname'] ;?></td>
                        <td><?php echo $evaluation['current_position'] ;?></td>
                        <td><?php echo $evaluation['eval_from'] ;?></td>
                        <td><?php echo $evaluation['eval_to'];?></td>       
                        <td><?php echo $evaluation['eval_result']; ?></td>
                        <td><?php echo $evaluation['eval_remark']; ?></td>
                </tr>
                <?php } ?>
                        </tbody>
                    </table>

        </div>
    </div>
</div>

<div class="col-md-12">
    <!-- BEGIN Portlet PORTLET-->
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-gift"></i>Movement</div>
            <div class="tools">
                <button style="align:right;" type="button" class="btn btn-default btn-sm" id="update_movement"><i class="fa fa-plus"> </i>Movement</button>
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">
     <table class="table table-hover" id="movement_table">
                    <thead>
                    <tr>                     
                        <th>ID</th>
                        <th>From</th>
                        <th>To</th>
                        <th>Effective date</th>                        
                        <th>Approval date</th>     
                        <th>Remarks</th> 
                    </tr>
                    </thead>
                    <tbody>

              <?php foreach($movement as $movement){ ?>
                <tr>
                        <td><?php echo $movement['emp_move_id']; ?></td>
                        <td><?php echo $movement['movement_from']; ?></td>
                        <td><?php echo $movement['movement_to'] ;?></td>
                        <td><?php echo $movement['effective_date'] ;?></td>
                        <td><?php echo $movement['approval_date'] ;?></td>
                        <td><?php echo $movement['movement_remarks'];?></td>       
                        
                </tr>
                <?php } ?>
                        </tbody>
                    </table>

        </div>
    </div>
</div>




                        </div>
                    </div>
                </div>
            </form>
            
        </div>
    </div>
</div>





<div id="view-evaluation" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add Evaluation<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                <input type="hidden" id="person_id" value="<?php echo $emp->person_id; ?>">
                                    <input type="hidden" id="add_employee_id" value="<?php echo $emp->employee_id; ?>">

                                <div class="portlet-body"> 

                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Evaluated by</label>
                                        <select class="form-control select2 select2-hidden-accessible" id="add_evaluated_by" name ="add_evaluated_by">
                                        <option class ="disabled selected">Select</option>
                                        <?php foreach($all_employees as $all_employees){ ?>
                                        <option value="<?php echo $all_employees['person_id'];?>"><?php echo 
                                        $all_employees['firstname']. ' ' . $all_employees['lastname'];?></option><?php } ?>
                                        </select>
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Current position</label>
                                          <p class="control-label">
                                            <b id="add_job_position" name = "add_job_position"><?php echo $emp->job_position; ?></b>
                                          </p>   
                                    </div>
                                    </div>
                                    </div>




                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >From</label>
                                        <input  type="text" name="add_evaldate_from" placeholder="yyyy-mm-dd" class="form-control" id="add_evaldate_from" maxlength="10" required onkeypress="return isNumber()"/>   
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >To</label>
                                        <input  type="text" name="add_evaldate_to" placeholder="yyyy-mm-dd" class="form-control" id="add_evaldate_to" maxlength="10" required onkeypress="return isNumber()"/>   
                                    </div>
                                    </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Result</label>
                                        <textarea type="text" id="add_eval_result" name="add_eval_result" placeholder="" maxlength="500" class="form-control"></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Remarks</label>
                                        <textarea type="text" id="add_eval_remarks" name="add_eval_remarks" placeholder="" maxlength="500" class="form-control"></textarea>
                                    </div>

                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="submit_add_evaluation" ></span>Add Evaluation</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>

<div id="view-movement" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add Movement<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                <input type="hidden" id="person_id" value="<?php echo $emp->person_id; ?>">
                                    <input type="hidden" id="movement_employee_id" value="<?php echo $emp->employee_id; ?>">

                                <div class="portlet-body"> 

                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >From</label>
                                        <input  type="text" name="add_movement_from" placeholder="yyyy-mm-dd" class="form-control" id="add_movement_from" maxlength="10" required onkeypress="return isNumber()"/>   
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >To</label>
                                        <input  type="text" name="add_movement_to" placeholder="yyyy-mm-dd" class="form-control" id="add_movement_to" maxlength="10" required onkeypress="return isNumber()"/>   
                                    </div>
                                    </div>
                                    </div>



                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Effective date</label>
                                        <input  type="text" name="add_effective_date" placeholder="yyyy-mm-dd" class="form-control" id="add_effective_date" maxlength="10" required onkeypress="return isNumber()"/>   
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Approvaldate</label>
                                        <input  type="text" name="add_approval_date" placeholder="yyyy-mm-dd" class="form-control" id="add_approval_date" maxlength="10" required onkeypress="return isNumber()"/>   
                                    </div>
                                    </div>
                                    </div>
                             
                                    <div class="form-group">
                                        <label class="control-label" >Remarks</label>
                                        <textarea type="text" id="add_movement_remarks" name="add_eval_remarks" placeholder="" maxlength="500" class="form-control"></textarea>
                                    </div>

                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="submit_add_movement" ></span>Add Evaluation</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>

<div id="view-family" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add family member<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                <input type="hidden" id="person_id" value="<?php echo $emp->person_id; ?>">
                                    <input type="hidden" id="family_employee_id" value="<?php echo $emp->employee_id; ?>">

                                <div class="portlet-body"> 

                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Relation</label> 
                                        <select class="form-control select2 select2-hidden-accessible" id="add_fam" name ="add_fam" >
                                        <option class ="disabled selected">Select</option>
                                        <?php foreach($add_family_type as $add_family_type){ ?>
                                        <option value="<?php echo $add_family_type['family_id'];?>"><?php echo 
                                        $add_family_type['family_description'];?></option><?php } ?>
                                        </select>                               
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Name</label>
                                        <input tabindex="2" type="text" id="add_fam_name" name="add_fam_name"  placeholder="" maxlength="160" class="form-control" > 
                                       
                                    </div>
                                    </div>
                                    </div>



                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Age</label>
                                    <input tabindex="2" type="text" id="add_fam_age" name="add_fam_age"  placeholder="" maxlength="160" class="form-control" > 
                                        
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Contact no</label>
                                        <input tabindex="2" type="text" id="add_fam_contact" name="add_fam_contact"  placeholder="" maxlength="160" class="form-control" >                                          
                                    </div>
                                    </div>
                                    </div>
                             
                                    <div class="form-group">
                                        <label class="control-label" >Address</label>
                                        <input tabindex="2" type="text" id="add_fam_add" name="add_fam_add"  placeholder="" maxlength="160" class="form-control" > 
                                      
                                    </div>

                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="submit_add_member" ></span>Add member</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>

<div id="view-exam_info" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Add Exam taken<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                <input type="hidden" id="person_id" value="<?php echo $emp->person_id; ?>">
                                    <input type="hidden" id="exam_employee_id" value="<?php echo $emp->employee_id; ?>">

                                <div class="portlet-body"> 

                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Exam type</label> 
                                        <input tabindex="2" type="text" id="add_exam_type" name="add_fam_name"  placeholder="" maxlength="160" class="form-control" >                  
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Exam name</label>
                                        <input tabindex="2" type="text" id="add_exam_name" name="add_fam_name"  placeholder="" maxlength="160" class="form-control" > 
                                       
                                    </div>
                                    </div>
                                    </div>



                                    <div class="row">
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Rating</label>
                                    <input tabindex="2" type="text" id="add_exam_rating" name="add_exam_rating"  placeholder="" maxlength="160" class="form-control" > 
                                        
                                    </div>
                                    </div>
                                    <div class="col-md-6">
                                    <div class="form-group">
                                        <label class="control-label" >Date taken</label>
                                         <input  type="text" name="add_date_taken" placeholder="yyyy-mm-dd" class="form-control" id="add_date_taken" maxlength="10" required onkeypress="return isNumber()"/>                                             
                                    </div>
                                    </div>
                                    </div>
                               
                                    <div class="form-group">
                                        <label class="control-label" >Date expiration</label>
                                          <input  type="text" name="add_date_exp" placeholder="yyyy-mm-dd" class="form-control" id="add_date_exp" maxlength="10" required onkeypress="return isNumber()"/>   
                                      
                                   
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="submit_add_exam" ></span>Add member</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>



<div id="view-peson_info" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Travel Order<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>

                                 <input type="hidden" id="info_person_id" value="<?php echo $emp->person_id; ?>">
                                    <input type="hidden" id="employee_id" value="<?php echo $emp->employee_id; ?>">
                                <div class="portlet-body">
                                    <div class="row">                                        
                                    <div class="col-md-12"> 
                                    <div class="col-md-3">
                                        <label class="control-label"><b>First name</b></label>
                                        <input tabindex="2" type="text" id="edit_firstname" name="edit_firstname"  placeholder="" maxlength="30" value="<?php echo $emp->firstname
                                        ; ?>" class="form-control" >
                                    </div>  
                                         <div class="col-md-3">
                                        <label class="control-label"><b>Middle name</b></label>
                                        <input tabindex="2" type="text" id="edit_middlename" name="edit_middlename"  placeholder="" maxlength="30"  value="<?php echo $emp->middlename
                                        ; ?>"class="form-control" >
                                    </div> 
                                         <div class="col-md-3">
                                        <label class="control-label"><b>Last name</b></label>
                                        <input tabindex="2" type="text" id="edit_lastname" name="edit_lastname"  placeholder="" value="<?php echo $emp->lastname
                                        ; ?>" maxlength="30" class="form-control" >
                                    </div> 
                                        <div class="col-md-2">
                                        <label class="control-label"><b>Prefix</b></label>
                                        <input tabindex="2" type="text" id="edit_prefix" name="edit_prefix"  placeholder="" maxlength="30" value="<?php echo $emp->prefix
                                        ; ?>" class="form-control" >
                                        </div> 
                                       <div class="col-md-1">
                                        <label class="control-label"><b>Suffix</b></label>
                                        <input tabindex="2" type="text" id="edit_suffix" name="edit_suffix"  placeholder="" maxlength="30" value="<?php echo $emp->suffix
                                        ; ?>" class="form-control" >
                                        </div> 
                                    </div>                                
                                    </div>

                                    <div class="row">                                        
                                    <div class="col-md-12">                                      
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Sex</b></label>
                                        <input tabindex="2" type="text" id="edit_sex" name="edit_sex"  placeholder="" maxlength="30" value="<?php echo $emp->sex
                                        ; ?>" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Birthdate</b></label>
                                        <input tabindex="2" type="text" id="edit_birthdate" name="edit_birthdate" value="<?php echo $emp->birthdate
                                        ; ?>" placeholder="" maxlength="30" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Birthplace</b></label>
                                        <input tabindex="2" type="text" id="edit_birthplace" name="edit_birthplace"  placeholder="" maxlength="30"  value="<?php echo $emp->birthplace
                                        ; ?>"class="form-control" >
                                    </div> 
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Civil status</b></label>
                                        <select  value="<?php echo $emp->civil_status_id
                                        ; ?>" class="form-control select2 select2-hidden-accessible" id="edit_civil_status" name ="edit_civil_status" >
                                            <option class ="disabled selected">Select</option>

                                            <?php foreach($civil_status as $civil_status){ ?>
                                            <?php if($civil_status['civil_status_id'] == $emp->civil_status_id){ ?>
                                            <option selected value="<?php echo $civil_status['civil_status_id'];?>"><?php echo $civil_status['civil_status_name'];?></option>
                                            <?php 
                                            continue;
                                            } ?>
                                            <option value="<?php echo $civil_status['civil_status_id'];?>"><?php echo $civil_status['civil_status_name'];?></option>

                                            <?php } ?>

                                                <!-- <?php foreach($civil_status as $civil_status){ ?>
                                            <option value="<?php echo $civil_status['civil_status_id'];?>"> <?php echo $civil_status['civil_status_name'];?></option><?php } ?> -->
                                        </select>
                                    </div> 
                                    </div>                                
                                    </div>

                                    <div class="row">                                        
                                    <div class="col-md-12">                                      
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Nationality</b></label>
                                        <input tabindex="2" type="text" id="edit_nationality" name="edit_nationality"  placeholder="" maxlength="30" value="<?php echo $emp->nationality
                                        ; ?>" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Height</b></label>
                                        <input tabindex="2" type="text" id="edit_height" name="edit_height"  placeholder="" maxlength="30" value="<?php echo $emp->height
                                        ; ?>" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Weight</b></label>
                                        <input tabindex="2" type="text" id="edit_weight" name="edit_weight"  placeholder="" maxlength="30"  value="<?php echo $emp->weight
                                        ; ?>"class="form-control" >
                                    </div> 
                                    <div class="col-md-3">
                                        <label class="control-label"><b>HDMF</b></label>
                                        <input tabindex="2" type="text" id="edit_hdmf" name="edit_hdmf"  placeholder="" maxlength="30"  value="<?php echo $emp->hdmf
                                        ; ?>"class="form-control" >
                                    </div>
                                    </div>                                
                                    </div>
                                                <div class="row">                                        
                                    <div class="col-md-12">                                      
                                    <div class="col-md-3">
                                        <label class="control-label"><b>SSS</b></label>
                                        <input tabindex="2" type="text" id="edit_sss" name="edit_sss"  placeholder="" maxlength="30" value="<?php echo $emp->sss
                                        ; ?>" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>TIN</b></label>
                                        <input tabindex="2" type="text" id="edit_tin" name="edit_tin"  placeholder="" maxlength="30" value="<?php echo $emp->tin
                                        ; ?>" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>PHIC</b></label>
                                        <input tabindex="2" type="text" id="edit_phic" name="edit_phic"  placeholder="" maxlength="30"  value="<?php echo $emp->phic
                                        ; ?>"class="form-control" >
                                    </div> 
                                    </div>                                
                                    </div>
                                    <div class="row">                                        
                                    <div class="col-md-12">                                      
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Department</b></label>
                                        <input tabindex="2" type="text" id="edit_department" name="edit_department"  placeholder="" maxlength="30" value="<?php echo $emp->department_name
                                        ; ?>" class="form-control" >
                                    </div>  
                                    <div class="col-md-3">
                                        <label class="control-label"><b>Position</b></label>
                                        <input tabindex="2" type="text" id="edit_position" name="edit_position"  placeholder="" maxlength="30" value="<?php echo $emp->job_position
                                        ; ?>" class="form-control" >
                                    </div>  
                                    </div>                                
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="update_person_info" ></span>Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>