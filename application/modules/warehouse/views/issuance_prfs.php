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
<div class="portlet-body form"> 
<div class="form-body">
<div>
    <table id="all_contracts" class="table table-hover" data-action="<?=base_url();?>Warehouse/issuance/issuance_prf">
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
        </tr>
        </thead>
        <tbody>
        <?php foreach($verifies as $verify){ 
            if($verify['document_code'] == 'PRF' && ($verify['po_accounting_status'] == 'complete')) {?>
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
            } ?></button></td>
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