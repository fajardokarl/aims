<div class="row">
    <div class="col-md-12">
        <div class="portlet grey-cascade box">
            <div class="portlet-title">
                 <div class="actions">
                        <a class="btn circle blue hidden-print"  id="print">Print
                        <i class="fa fa-print"></i></a>
                        <a class="btn circle blue hidden-print"  id="xls">Excel
                        <i class="fa fa-print"></i></a>
                    </div>
                <div class="caption">
                    <span class="bold">Items</span>
                </div> 
            </div>
            <div class="portlet-body form">
                <div class="form-horizontal">
                    <div class="form-body">
                        <div class="row">
                            <select id="warehouse-filter">
                                <option value="None">None</option>
                                <?php
                                    foreach( $warehouse as $warehouse ) {
                                        echo "<option value='" . $warehouse['warehouse_description'] . "'>" . $warehouse['warehouse_description'] . "</option>";
                                    }
                                ?>
                            </select><br><br>
                            
                                <table id="po_table" class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                            <th style="display: none;">Item ID</th>
                                            <th>Item Description</th>
                                            <th style="display: none;">Warehouse</th>
                                            <th>Category Code</th>
                                            <th>Quantity Left</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                <?php foreach ($items as $items) { ?>
                                        <tr>
                                            <td width="10%" style="display: none;"><?php echo $items['item_id']; ?></td>
                                            <td width="40%"><?php echo $items['description']; ?></td>
                                            <td width="40%" style="display: none;"><?php echo $items['warehouse_description']; ?></td>
                                            <td width="10%"><?php echo $items['category_code']; ?></td>
                                            <td width="20%"><?php echo $items['quantity']; ?></td>
                                                
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

