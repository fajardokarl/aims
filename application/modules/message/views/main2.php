<style type="text/css">
    .modcenter {
      left: 50%;
      top: 50%;
      transform: translate(-50%, -50%);
    }
</style>
<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> Inboxes </span>
</div>
</div>
<?php $this->session->set_userdata(array('unseen_num' => 0)); ?>
<div class="portlet-body form"> 
<div class="form-body">
<div id="">
    <table id="all_contracts" class="table table-hover">
       <thead>
            <tr>                
                        <!--     <th>Action</th> -->
                            <th style="display: none;">PRF ID</th>
                            <th>Document Type</th>
                            <th>Requested by</th>
                            <th>Date Sent</th>
                            <th>Subject</th>
                            <th>Department</th>
                            <th>Status</th>
                            <th>Remarks</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($verifies as $verify){ ?>
                            <tr>
                              <!--   <td><button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#viewBroker" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</button></td> -->
                                <td style="display: none;"><?php echo $verify['prf_id']; ?></td>
                                <td><?php echo $verify['document_name']; ?></td>
                                <td><?php echo $verify['lastname'] . ', ' . $verify['firstname']; ?></td>
                                <td><?php echo $verify['date_requested']; ?></td>
                                <td><?php echo $verify['purpose']; ?></td>
                                <td><?php echo $verify['department_name']; ?></td>
                                <td><button <?php switch ($verify['prf_status_id']) {
                                    case 1:
                                        echo 'class="btn btn-circle btn-xs yellow">Pending';
                                        break;                                      
                                    case 3:
                                        echo 'class="btn btn-circle btn-xs red">Denied';
                                        break;                                     
                                    case 4:
                                        echo 'class="btn btn-circle btn-xs blue">Approved';
                                        break;
                                }
                                 ?></button></td>
                                <td><button class="btn btn-circle btn-xs green" type="button" id="remark_button" data-toggle="modal" data-target="#message_document_remark" data-id="<?php echo $verify['prf_id']; ?>" data-action="<?=base_url();?>Message/Message/update_seen_receipt">View</button></td>
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
</div>
</div>

<div style="" class="modal fade modal-sm modcenter" id="message_document_remark" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-full">
        <div class="modal-content">
            <div class="modal-header">
                <div class="caption font-green-sharp">
                    <i class="fa fa-book font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">REMARKS</span>
                    <button type="button" class="close" id="btn_close_remark" tabindex="-1" data-dismiss="modal"></button>
                </div>
            </div>
            <div class="modal-body">
                <div class="portlet-body">
                    <span id="document_remark"></span>
                </div>
            </div>
        </div>
    </div>
</div>