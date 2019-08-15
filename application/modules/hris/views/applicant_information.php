<div class="row">
    <div class="portlet grey-cascade box">
        <div class="portlet-title">
            <div class="caption">
                <i class="fa fa-users"></i>
                <span class="bold uppercase">Personal Information </span>
            </div>
                        <div class="actions"> 
                <!-- <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
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
                                    <?php echo $app->prefix; echo " "; echo $app->firstname; echo " "; echo $app->middlename; echo " "; echo $app->lastname; echo " "; echo $app->suffix; ?>
                                    <input type="hidden" id="person_id" value="<?php echo $app->person_id; ?>">
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Department:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->department_name; ?>
                                </p>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Position:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->app_job_position; ?>
                                </p>
                            </div> 
                        </div>
                 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Sex:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->sex; ?>
                                </p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Birthdate:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->birthdate; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Birthplace:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static" id='total_amount'>
                                      <?php echo $app->birthplace; ?>
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
                                    <?php echo $app->nationality; ?>
                                   
                                </p>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Civil status:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->civil_status_name; ?>
                                </p>
                            </div>
                        </div>
                        

                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Weight:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->weight; ?>
                                </p>
                            </div> 
                        </div>
                 
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> Height:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->height; ?>
                                </p>
                            </div>
                        </div>

                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> TIN:</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->tin; ?>
                                </p>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> SSS no. :</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static" id='total_amount'>
                                      <?php echo $app->sss; ?>
                                </p>
                            </div> 
                        </div> 
                    </div>
            <div class="col-md-6">
                        <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> HDMF no. :</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->height; ?>
                                </p>
                            </div>
                        </div>
            </div>
            <div class="col-md-6">
                         <div class="form-group">
                            <label class="col-md-3 control-label"><span class="caption-subject font-grey-mint bold uppercase"> PHIC no. :</span></label>
                            <div class="col-md-9">
                                <p class="form-control-static">
                                    <?php echo $app->tin; ?>
                                </p>
                            </div>
                        </div>
            </div>



<div class="col-md-12">
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
                            <th>action</th>
                        </tr>
                        </thead>
                        <tbody>

                <?php foreach($contact as $contact){ ?>
                <tr>
                    <td><?php echo $contact['contact_id']; ?></td>
                    <td><?php echo $contact['contact_type_name'] ;?></td>           
                    <td><?php echo $contact['contact_value']; ?></td>
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
             <td><?php echo $address['address_type_id'] ;?></td>
             <td><?php echo $address['line_1'].', '.$address['line_2'].', '.$address['city_name'].', '.$address['province_name'].', '.$address['country_name'] ?></td>       
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

                <?php foreach($app_school as $app_school){ ?>
                <tr>
                        <td><?php echo $app_school['app_school_id']; ?></td>
                        <td><?php echo $app_school['school_description'] ;?></td>
                        <td><?php echo $app_school['app_schoolName'] ;?></td>
                        <td><?php echo $app_school['app_fromdate'];?></td>       
                        <td><?php echo $app_school['app_todate']; ?></td>
                        <td><?php echo $app_school['app_yearGraduate']; ?></td>
                
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

                <?php foreach($app_exam as $app_exam){ ?>
                <tr>
                        <td><?php echo $app_exam['app_exam_id']; ?></td>
                        <td><?php echo $app_exam['app_examType'] ;?></td>
                        <td><?php echo $app_exam['app_examName'] ;?></td>
                        <td><?php echo $app_exam['app_examRating'] ;?></td>
                        <td><?php echo $app_exam['app_examTaken'];?></td>       
                        <td><?php echo $app_exam['app_dateExpiration']; ?></td>
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

           <?php foreach($app_work as $app_work){ ?>
                <tr>
                        <td><?php echo $app_work['app_work_experience_id']; ?></td>
                        <td><?php echo $app_work['app_previous_position'] ;?></td>
                        <td><?php echo $app_work['app_employer'] ;?></td>
                        <td><?php echo $app_work['app_exclusive_from'] ;?></td>
                        <td><?php echo $app_work['app_exclusive_to'];?></td>       
                        <td><?php echo $app_work['app_compensation']; ?></td>
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

              <?php foreach($app_family as $app_family){ ?>
                <tr>
                        <td><?php echo $app_family['app_family_id']; ?></td>
                        <td><?php echo $app_family['app_fam_desc'] ;?></td>
                        <td><?php echo $app_family['app_fam_name'] ;?></td>
                        <td><?php echo $app_family['app_fam_age'] ;?></td>
                        <td><?php echo $app_family['app_fam_address'];?></td>       
                        <td><?php echo $app_family['app_fam_contact']; ?></td>
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
                <i class="fa fa-gift"></i>Applicant pre-exam result</div>
            <div class="tools">
                <a href="javascript:;" class="collapse"> </a>
                <a href="#portlet-config" data-toggle="modal" class="config"> </a>
                <a href="javascript:;" class="reload"> </a>
                <a href="" class="fullscreen"> </a>
                <a href="javascript:;" class="remove"> </a>
            </div>
        </div>
        <div class="portlet-body">


                       <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                             <label class="control-label"><h4>Do you have physical or mental impairment?</h4></label>
                               <p class="control-label">
                               <div class="col-md-1">
                                    <b><?php echo $answer->impairment; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->impairment_yes; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                             <label class="control-label"><h4>Have you ever been to the doctor lately?</h4></label>                             
                                <p class="control-label">
                               <div class="col-md-1">
                                    <b><?php echo $answer->doctor; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->doctor_yes; ?></b>
                                </div>
                               </p>   
                            </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><h4>Have you ever met an accident lately?</h4></label>                             
                               <p class="control-label">
                               <div class="col-md-1">
                                    <b><?php echo $answer->accident; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->accident_yes; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"><h4>Have you undergone any surgery in the past?</h4></label>                               
                                <p class="control-label">
                               <div class="col-md-1">
                                    <b><?php echo $answer->surgery; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->surgery_yes; ?></b>
                                </div>
                               </p>   
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><h4>Have you ever been convicted, arrested or imprisoned for any violation of law?</h4></label>                             
                               <p class="control-label">
                               <div class="col-md-1">
                                    <b><?php echo $answer->law; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->law_yes; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"><h4>Have you ever discharge or forced to resign from work?</h4></label>                               
                                <p class="control-label">
                               <div class="col-md-1">
                                    <b><?php echo $answer->discharge; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->discharge_yes; ?></b>
                                </div>
                               </p>   
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><h4>Have you any relative in any of the affiliates of brown Group of Companies?</h4></label>                             
                               <p class="control-label">
                               <div class="col-md-3">
                                    <b><?php echo $answer->affiliates; ?></b>
                                </div>
                               <div class="col-md-2">
                                    <b><?php echo $answer->affiliates_yes; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"><h4>When was the last time you were hospitalized?</h4></label>                               
                                <p class="control-label">
                               <div class="col-md-3">
                                    <b><?php echo $answer->hospitalized; ?></b>
                                </div>                             
                               </p>   
                            </div>
                            </div>
                        </div>


                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><h4>Why do you want to work with A Brown Company?</h4></label>                             
                               <p class="control-label">
                               <div class="col-md-6">
                                    <b><?php echo $answer->work_with; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"><h4>Give some of your short term & long term goals</h4></label>                               
                                <p class="control-label">
                               <div class="col-md-6">
                                    <b><?php echo $answer->goals; ?></b>
                                </div>                             
                               </p>   
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><h4>What are your strong points as a person?</h4></label>                             
                               <p class="control-label">
                               <div class="col-md-6">
                                    <b><?php echo $answer->strong_points; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"><h4>What are your weak points as an individual?</h4></label>                               
                                <p class="control-label">
                               <div class="col-md-6">
                                    <b><?php echo $answer->weak_points; ?></b>
                                </div>                             
                               </p>   
                            </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                              <label class="control-label"><h4>How soon can you start if your services are required in this company?</h4></label>                             
                               <p class="control-label">
                               <div class="col-md-3">
                                    <b><?php echo $answer->start; ?></b>
                                </div>
                               </p>     
                            </div>
                            </div>
                            <div class="col-md-6">
                            <div class="form-group">
                            <label class="control-label"><h4>Approximate Salary you have in mind</h4></label>                               
                                <p class="control-label">
                               <div class="col-md-3">
                                    <b><?php echo $answer->salary; ?></b>
                                </div>                             
                               </p>   
                            </div>
                            </div>
                        </div>
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





<div id="view-lots" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Request<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
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

                                <input type="hidden" id="prf_id" name="prf_id"  placeholder="" maxlength="30" class="form-control"/>
                                <input type="hidden" id="prf_detail_id" name="prf_detail_id"  placeholder="" maxlength="30" class="form-control"/>

                                <div class="portlet-body">
                                    <label class="control-label">Status</label>
                                    <div class="row">               
                        
                                      <div class="form-group col-md-6">
                                        <label class="control-label">ITEM</label>
                                        <select class="form-control select2 select2-hidden-accessible" id="activate_cancel" required>
                                        <option value="0">Activate</option>
                                        <option value="1">Cancel</option>
                                        </select>
                                    </div>  
                                    </div>               
                                    <div class="form-group">
                                        <label class="control-label">Quantity</label>
                                        <input type="text" id="qty" name="qty"  placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Amount</label>
                                        <input type="text" id="amount" name="amount" style='text-align: right;' placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Remarks</label>
                                        <input type="text" id="remarks" name="remarks" placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                           <div class="row static-info">
                                            <div class="col-md-3 value"  align="left"> Sub Total: </div>
                                            <div class="col-md-9 value" >
                                                <input type="text" name="sub_total" readonly="true" style='text-align: right;' class="form-control" id="sub_total">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="row static-info">
                                            <div class="col-md-3 value"  align="left"> Total: </div>
                                            <div class="col-md-9 value" >
                                                <input type="text" name="total_amount" readonly="true" style='text-align: right;' class="form-control" id="total_amount">
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
                    <button type="button" class="btn green" id="update_prf" ></span>Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>