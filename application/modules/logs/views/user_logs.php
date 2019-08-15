<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="portletuserlogs">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Latest Logs</span>
                </div>
                <div class="actions">
                    <!-- <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddCustomer" id="addnewcust"><i class="fa fa-plus"> </i>New User</button>
                     <a href="javascript:;"><i class="fa fa-file-pdf-o btn red"> PDF</i> </a> -->
                </div>
            </div>                  
            <table class="tbluserlogs table table-hover" id="tbluserlogs" >
                <thead>
                    <tr>
                        <th>Log ID</th>
                        <th>Date</th>
                        <th>Location</th>
                        <th>Object</th>
                        <th>Event Type</th>
                        <th>Description</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach($logs as $log){ ?>
                    <tr>
                        <td><?php echo $log['user_log_id'];?></td>
                        <td><?php echo $log['log_date'];?></td>
                        <td><?php echo $log['location'];?></td>
                        <td><?php echo $log['object'];?></td>
                        <td><?php echo $log['event_type'];?></td>
                        <td><?php echo $log['description'];?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>        
        </div>
        
    </div>
</div>
</div>
