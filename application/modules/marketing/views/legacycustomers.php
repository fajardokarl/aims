<div class="row">
    <div class="col-md-12">
        <div class="portlet light " id="">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="fa fa-users font-green-sharp"></i>
                    <span class="caption-subject bold uppercase">Legacy Customer MasterList</span>
                </div>
                <!--<div class="actions">
                    <button style="align:right;" type="button" class="btn btn-circle green" data-toggle="modal" data-target="#AddCustomer" id="addnewcust"><i class="fa fa-plus"> </i>New Customer</button>
                </div> -->
            </div>                  
            <table class="tbl_legacy_table table table-hover" id="tbl_legacy_table" >
                <thead>
                    <tr>
                        <th>Legacy Customer ID</th>
                        <th>Customer Name</th>
                        <!-- <th>Client Type</th> -->
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($legacy_cust as $legacy_cust){ ?>
                    <tr>
                        <td><?php echo $legacy_cust['custid'];?></td>
                        <td><?php echo $legacy_cust['custname'];?></td>
                    </tr>
                    <?php } ?> 
                    
                </tbody>
            </table>        
        </div>

        
    </div>
</div>