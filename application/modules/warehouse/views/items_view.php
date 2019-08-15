<div class="row" id="frm_masterlist">
  <div class="col-md-12">
    <div class="portlet light ">
      <div class="portlet-title">
        <div class="caption font-green-sharp">
          <i class="fa fa-cubes"></i>
          <span class="caption-subject bold uppercase"> Add Item</span>
        </div>
      </div>

      <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="specs_form" action="<?=base_url();?>logistics/items/ajax_insert_item"> <br><br>
        <div class="form-group row">
         <label class="col-lg-2">ITEM</label>
          <select class="" name="item_id" id="item_id" data-url="<?=base_url();?>logistics/items/ajax_select_items_category">
            <option value="0" class ="disabled selected">--- Select ---</option>
            <?php foreach($all_items as $all_items){ ?>
              <option value="<?php echo $all_items['ItemId'];?>" class="form-control input-sm input-small input-inline"><?php echo $all_items['ItemDescription'];?></option><?php } ?>
          </select> <br><br><br>
          <label class="col-lg-2">CATEGORY</label>
         <select class="" name="category_id" id="category_id">
            <option value="0" class ="disabled selected">--- Select ---</option>
            <?php foreach($all_categories as $all_categories){ ?>
              <option value="<?php echo $all_categories['category_code'];?>" class="form-control input-sm input-small input-inline"><?php echo $all_categories['description'];?></option><?php } ?>
          </select>
          <br> <br> <br> 
          <label class="col-lg-2">BRAND</label>
          <input type="text" name="item_brand" id="item_brand" class="form-control input-sm input-small input-inline"placeholder="Enter Brand " >
          <br> <br> 
          <label class="col-lg-2">COLOR</label>
          <input type="text" name="item_color" id="item_color" class="form-control input-sm input-small input-inline"placeholder="Enter Color">
          <br> <br>
          <label class="col-lg-2">SIZE</label>
          <input type="text" name="item_size" id="item_size" class="form-control input-sm input-small input-inline" placeholder="Enter Size">
          <br>
          <!-- <label class="col-lg-2">QUANTITY</label>
          <input type="number" name="item_quantity" id="item_quantity" class="form-control input-sm input-small input-inline"> -->
          <br>

          <button id="add_item" name="add_item" class="btn btn- sm green" type="submit" data-toggle="modal" data-target="" >Add</button> <br><br>
        </div>
      </form>
      
      <div class="portlet-body">  
        <table class="table table-hover" id="tbl_masterlist">
          <thead>
            <tr>
              <th>Item ID</th>
              <th>Item Name</th>
              <th>Category</th>
              <th>Brand</th>
              <th>Color</th>
              <th>Size</th>
              <!-- <th>Quantity</th> -->
              <th>Action</th>
            </tr>
          </thead>
          <tbody>
            <?php
            for($i=0;$i<count($item_specs);$i++) { ?>
              <tr>
                <td><?php echo $item_specs[$i]['item_id'];?></td>
                <td><?php if( !(empty($specs_name)) ) {
                for($ii=0;$ii<count($specs_name);$ii++) {
                  if( $specs_name[$ii]['ItemId'] == $item_specs[$i]['item_id'] ) {
                    echo $specs_name[$ii]['ItemDescription'];
                    break;
                  } else {
                    if( $ii == (count($specs_name) - 1) ) echo "";
                    // return null;
                  }
                 }
               } else {
                echo "";
               }?></td>
                <td><?php if( !(empty($category_desc)) ) {
                for($ii=0;$ii<count($category_desc);$ii++) {
                  if( $category_desc[$ii]['category_code'] == $item_specs[$i]['category'] ) {
                    echo $category_desc[$ii]['description'];
                    break;
                  } else {
                    if( $ii == (count($category_desc) - 1) ) echo "";
                    // return null;
                  }
                 }
               } else {
                echo "";
               }?></td>
                <td><?php echo $item_specs[$i]['brand'];?></td>
                <td><?php echo $item_specs[$i]['color'];?></td>
                <td><?php echo $item_specs[$i]['size'];?></td>
                
                <td><button type="button" class="edit_spec btn green meadow btn-xs " data-toggle="modal" data-url="<?=base_url();?>logistics/items/get_item_specs" data-target="#edit_spec" data-spec="<?php echo $item_specs[$i]['specs_id'];?>" data-item="<?php echo $item_specs[$i]['item_id'];?>">EDIT</button><button type="button" class="delete_spec btn btn-xs red-mint" data-toggle="modal" data-target="#delete_spec" value="<?php echo $item_specs[$i]['specs_id'];?>">DELETE</button></td>
                <?php // print_r($manager); ?>
              </tr>
            <?php  } ?>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<div id="edit_spec" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h3 class="modal-title font-blue-dark bold"><span class="caption-subject bold uppercase"></i>Edit Item Specifications<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h3> 
            </div>
            <div class="modal-body">
                <div class="portlet-body">
                    <div class="table-scrollable">
                      <input type="integer" name="edit_item_spec_id" id="edit_item_spec_id" hidden>
                      <?php $abcd = " . 2 . "; ?>
                      <br><br>
                      <label class="col-lg-2">CATEGORY</label>
                      <select name="edit_item_category" id="edit_item_category">
                      <option value="0" class="edit_item_category" selected="selected">--- Select ---</option>
                      <?php foreach($edit_all_categories as $edit_all_categories){ ?>
                        <option class="edit_item_category" value="<?php echo $edit_all_categories['category_code'];?>" class="form-control input-sm input-small input-inline"><?php echo $edit_all_categories['description'];?></option><?php } ?>
                      </select>
                      <br><br><br>
                      <label class="col-lg-2">BRAND</label>
                      <input type="text" name="edit_item_brand" id="edit_item_brand" value="" class="form-control input-sm input-small input-inline">
                      <br><br>
                      <label class="col-lg-2">COLOR</label>
                      <input type="text" name="edit_item_color" id="edit_item_color" value="" class="form-control input-sm input-small input-inline">
                      <br><br>
                      <label class="col-lg-2">SIZE</label>
                      <input type="text" name="edit_item_size" id="edit_item_size" value="" class="form-control input-sm input-small input-inline">
                      <br><br>
                      <!-- <label class="col-lg-2">QUANTITY</label>
                      <input type="number" name="edit_item_quantity" id="edit_item_quantity" value="" class="form-control input-sm input-small input-inline"> -->
                    </div>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="post" id="form_edit_spec" action="<?=base_url();?>logistics/items/edit_item_specs">
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
                  <button type="submit" data-dismiss="modal" class="btn green-meadow" id="confirm_edit"><i class="fa fa-floppy-o" aria-hidden="true"></i>Submit</button>
              </div>
            </form>
        </div>
    </div>
</div>

<div id="delete_spec" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <div class="portlet grey-cascade box">
                    <div class="portlet-title">
                        <div class="caption">
                            <span class="caption-subject">Select Employee</span>
                        </div>
                    </div>
                    <div class="portlet-body">
                      Are you sure you want to delete this item specification?
                    </div>
                </div>
            </div>
            <form class="form-horizontal" role="form" method="post" enctype="multipart/form-data" id="form_delete_spec" action="<?=base_url();?>logistics/items/ajax_delete_spec">
              <input type="integer" name="spec_id" id="spec_id" value="" hidden>
              <div class="modal-footer">
                  <button type="button" data-dismiss="modal" class="btn dark btn-outline"><i class="fa fa-times" aria-hidden="true"></i>Cancel</button>
                  <button type="submit" data-dismiss="modal" class="btn green-meadow" id="confirm_delete"><i class="fa fa-floppy-o" aria-hidden="true"></i>Yes</button>
              </div>
            </form>
        </div>
    </div>
</div>