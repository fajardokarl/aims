
<div class="row">
    <div class="col-md-12">
        <div class="portlet grey-cascade box ">
            <div class="portlet-title">
                 <div class="actions">
                        <a class="btn circle blue hidden-print"  id="print">Print
                        <i class="fa fa-print"></i></a>
                        <a class="btn circle blue hidden-print"  id="xls">Excel
                        <i class="fa fa-print"></i></a>
                    </div>
                <div class="caption">
                    <span class="caption-subject bold uppercase"> Item List</span>
                </div>
                <!-- <div class="actions">
                      <a href="<?=base_url()?>logistics/add_item" align="right" class="btn btn-circle btn-default" id="btnAddNewUser"><span class="fa fa-plus"></span> Add item </a>
                  </div> -->  
               

                </div>
            <div class="portlet-body">
                <div style="max-width:3000px; white-space: nowrap; ">
                    <select id="warehouse-filter">
                        
                        <option value="None">None</option>
                        <?php
                            foreach( $warehouse as $warehouse ) {
                                echo "<option value='" . $warehouse['warehouse_description'] . "'>" . $warehouse['warehouse_description'] . "</option>";
                            }
                        ?>
                    </select><br><br>
                    <table class="table table-hover" id="po_table" style="color: #525e64!important;">
                        <thead>
                        <tr>
                            <th style="display: none;">Item ID</th>
                            <th>Item Description</th>
                            <th style="display: none;">Warehouse</th>
                            <th>Item Code</th>
                            <th>Category Code</th>
                            <!-- <th>Quantity</th> -->
                     
                           <!--  <th>Action</th> -->
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($items as $items){ ?>
                            <tr>
                                <td width="10%" style="display: none;"><?php echo $items['item_id']; ?></td>
                                <td><?php echo $items['description']; ?></td>
                                <td width="40%" style="display: none;"><?php echo $items['warehouse_description']; ?></td>
                                <td><?php echo $items['item_code']; ?></td>
                                <td><?php echo $items['category_code']; ?></td>                              
                                <!--  -->                            
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