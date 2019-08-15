<!DOCTYPE html>
<html lang="en">
 
    <head>
        <meta charset="utf-8" />
        <title>A Brown Company, Inc.</title>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1" name="viewport" />
        <meta content="" name="description" />
        <meta content="" name="author" />

<form method="post" name = "message" id="message"> 
<input type="hidden" name="requested_by_id" id="requested_by_id" value="<?php echo $this->session->userdata('user_id'); ?>">
   
<div class="row" id="lots_table" name ="verify">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Verify Request</span>
                </div>            

                </div>               
            
            <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tbl_verify">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>PRF</th>
                            <th>Date Requested</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Purpose</th>
                            <th>Date Needed</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($verifies as $verify){ ?>
                            <tr>
                                <td><button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#viewBroker" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</button></td>
                                <td><?php echo $verify['prf_id']; ?></td>
                                <td><?php echo $verify['date_requested']; ?></td>
                                <td><?php echo $verify['requested_by_id']; ?></td>
                                <td><?php echo $verify['department_id']; ?></td>
                                <td><?php echo $verify['purpose']; ?></td>
                                <td><?php echo $verify['date_needed']; ?></td>
                                
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
</div>
        <!-- END Portlet PORTLET-->

<!-- End verify -->



 <!-- Recommend Form -->
<!-- <div class="row" id="recommend">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Recommend Request</span>
                </div>            

                </div>               
            
            <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tbl_recommend" name="recommend">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Date Requested</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Purpose</th>
                            <th>Date Needed</th>
                            
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($verifies as $verify){ ?>
                            <tr>
                                 <td><button type="button" id = "action" class="btn-xs btn red btnViewBroker" data-toggle="modal" data-target="#viewBroker" >Read</button></td>
                                <td><?php echo $verify['date_requested']; ?></td>
                                <td><?php echo $verify['requested_by_id']; ?></td>
                                <td><?php echo $verify['department_id']; ?></td>
                                <td><?php echo $verify['purpose']; ?></td>
                                <td><?php echo $verify['date_needed']; ?></td>
                                
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
</div>
   -->

<!-- End recommend -->

<!-- approve start -->
<!-- <div class="row" id="approve" name = "approve">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Approve Request</span>
                </div>
                </div>
                
            
            <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tbl_approve">
                        <thead>
                        <tr>
                            <th>Action</th>
                            <th>Date Requested</th>
                            <th>Name</th>
                            <th>Department</th>
                            <th>Purpose</th>
                            <th>Date Needed</th>
                           
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($verifies as $verify){ ?>
                            <tr>
                                <td><button type="button" id = "action" class="btn-xs btn red btnViewBroker" data-toggle="modal" data-target="#viewBroker" >Read</button></td>
                                <td><?php echo $verify['date_requested']; ?></td>
                                <td><?php echo $verify['requested_by_id']; ?></td>
                                <td><?php echo $verify['department_id']; ?></td>
                                <td><?php echo $verify['purpose']; ?></td>
                                <td><?php echo $verify['date_needed']; ?></td>
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                    </div>
                    </div>
                </div>
            </div>            
        </div>
  </form> -->


  <!-- sample -->
  <div id="viewBroker" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
<div class="modal-dialog modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
<h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View PRF<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
</div>
<form id="updateLot">
<div class="modal-body">
<div class="row">
    <div class="col-md-6">  
        <div class="form-body">
            <div class="form-group">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">PRF Details</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div class="row static-info">
                            <input type="hidden" id="prf_id" value="">
                            <div class="col-md-5 name"  align="right"></div>
                            <div class="col-md-7 value" id="txt_department_id"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> Requested by: </div>
                            <div class="col-md-7 value" id="txt_requested_by_id"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> Date Requested: </div>
                            <div class="col-md-7 value" id="txt_date_request"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> Total Amount.: </div>
                            <div class="col-md-7 value" id="txt_total_amount"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> Remark: </div>
                            <div class="col-md-7 value" id="txt_remarks"></div>
                        </div>
                          <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> Purpose: </div>
                            <div class="col-md-7 value" id="txt_purpose"></div>
                        </div>
                        <div class="row static-info">
                                <div class="col-md-5 name"  align="right"> Justification: </div>
                            <div class="col-md-7 value" id="text_justification"></div>
                        </div>
                      
                        <!-- <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> COR No.: </div>
                            <div class="col-md-7 value" id="cor_no"></div>
                        </div>
                        <div class="row static-info">
                            <div class="col-md-5 name"  align="right"> Status:</div>
                            <div class="col-md-7 value" id="lot_status"></div>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </div>

   <!-- sample end -->
  <div class="modal fade bs-modal-lg" id="viewBrokers" role="dialog">
    <div class="modal-dialog modal-full">
     <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" disabled="" ata-dismiss="modal"></button>
                <h4 class="modal-title">Message Details</h1>
            </div>

            <div class="modal-body">
                   <div class="row">
                    <div class="col-md-2" align="right">
                        <h3 id="broker">Sender:</h3>
                    </div>

                    <div class="col-md-4">
                        <h3><span class="font-blue-dark bold" id="sender_id"></span></h3>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-2" align="right">
                        <h3>Subject:</h3>                      
                    </div>

                    <div class="col-md-4" align="right">                   
                    <div class="col-md-12">
                        <h3><span class="font-blue-dark bold" id="subject"></span></h3>
                    </div>
                    </div>
                   
                    <div class="col-md-2">
                        <h4><span class="font-blue-dark bold" id="txt_company"></span></h4>
                    </div>
                </div>              
               
                    <div class="tab-content">
                        <div class="tab-pane active" id="tab-brokerInfoView">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="portlet grey-cascade box">
                                        <div class="portlet-title">
                                            <div class="caption">
                                               <span class="caption-subject"></i>Message</span>   </div>
                                                 </div>
                                        <div class="portlet-body">
                                            <div class="row static-info">
                                                <div class="col-md-1 name" align="right"> Body: </div>
                                                <!-- id:body -->
                                                <div class="col-md-7 value" id="body"> </div>
                                            </div>                         
                                        </div>
                                    
                                        </div>
                                    </div>
                                </div>
                                
                            <div class="row" >
                                <div class="col-md-12" align="right">                                
                                <div class="col-md-2" align="left">
                                <a align="right" class="btn green-meadow" id="btnAddNewUser"><span class="fa fa-plus"></span> Rate </a>
                                <div align="left" id="demo" class="collapse">
                            <form method="post">
                                <input type="checkbox" name="urgent" value="1">Urgent</input><br/>
                                <input type="checkbox" name="star" value="2">Star</input><br/>
                                <button type="submit" name="submit" class="btn green-meadow" value="Submit">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</h4>
</div>
</div>
</div>
</div>


</div>
</div>
</div>
</form>
</span>
</h4>
</div>
</div>
</div>
</div>
</form>
</head>
</html>

<!-- end approve -->