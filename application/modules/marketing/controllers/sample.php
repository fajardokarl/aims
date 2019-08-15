<div class="portlet-body">
                  
                    <table class="tblcustomerlists table table-hover" id="tblcustomerlists" >
                        <thead>
                        <tr>
                            <th>Client ID</th>
                            <th>Client Name</th>
                            <th>Client Type</th>
                        </tr>
                        </thead>
                    <tbody>
                    <?php foreach($customer as $customer){ ?>
                     <tr>
                        <td><?php echo $customer['client_id'];?></td>
                        <td><?php echo $customer['lastname'] . ', ' . $customer['firstname'] . ' ' . $customer['middlename'] . ' ' . $customer['suffix'];?></td>
                        <td><?php echo $customer['client_type_name'];?></td>
                        
                    </tr>
                    <?php } ?> 
                  
                    </tbody>
                    </table>       
                </div>
            </div>
        </div>
</div>