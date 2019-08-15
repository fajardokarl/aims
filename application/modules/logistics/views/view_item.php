
<div class="row">
    <div class="col-md-12">
        <div class="portlet light ">
            <div class="portlet-title">
                <div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Item Masterlist</span>

                </div>
                <div class="actions">
                    <a href="<?=base_url()?>logistics/add_item" align="right" class="btn btn-circle btn-default" id="btnAddNewUser"><span class="fa fa-plus"></span> Add item </a>
                </div>  
               

                </div>
                
            
            <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <table class="table table-hover" id="tbluser">
                        <thead>
                        <tr>
                            <th>Item Description</th>
                            <th>Category Code</th>
                            <th>Legacy Item ID</th>
                     
                           <!--  <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($items as $items){ ?>
                            <tr>
                                <td><?php echo $items['description']; ?></td>
                                <td><?php echo $items['category_code']; ?></td>
                                <td><?php echo $items['legacy_itemid']; ?></td>                              
                                <!-- <td><a href="javascript:;"><button type="button" class="btn btn-primary btn-xs"> details </button></a></td> -->
                            </tr>
                        <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
     </div>
 </div>