<div class="caption font-green-sharp">
                    <i class="icon-speech font-green-sharp"></i>
                    <span class="caption-subject bold uppercase"> Canvass Ifnormation</span>
                </div>

    <div class="form-group">
        <div class="form-control ">
           
            
            <div class="portlet-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="form-group profile-info">
                                <div class="col-md-12">
                                                                    
                                      <div class="actions"> 
                                            </div> 
                                              </select> 

<form  method="post" name = "canvass_form" id="canvass_form">  

  
    <div class="portlet-body">
    <div class="row">
    <div class="form-group"> 
    
    <div class= "form-group">
    <label name="canvass_date" id="canvass_date"> <font color="teal"><b> Date: <?php echo date("m/d/Y") . "<br>"; ?></b></font></label>
    </div> 

    <div class="form-group">
    <label> <font color="teal"><b>Canvass by: <?php echo $this->session->userdata('firstname');?> <?php echo $this->session->userdata('lastname'); ?></b></font></label>
    </div>

    <input type="hidden" name="canvassed_by" id="canvassed_by" value="<?php echo $this->session->userdata('user_id'); ?>">

    </div>
    </div>
    </div>
<div class="tab-pane" id="tab-brokerAddress">
<div class="row">
<div class="col-md-12">
<div class="form-group">
   <!--  <h4 class="font-blue-dark bold">Broker's Address</h4> -->
    <div class="col-md-12">
        <div class="form-group">
            <table class="table table-striped table-hover table-bordered dataTable no-footer" id="brokerAddresst" name="brokerAddresst" role="grid" aria-describedby="sample_editable_1_info">
               
                <thead>
            <tr role="row">
                <th class="col-md-2">Supplier</th>                      
                <th>Contact Person</th>
                <th class="col-md-1">Contact No.</th>
                <th>Terms of Payment</th>
                <th class="col-md-2">Item Desciption</th>  
                <th>QTY</th>
                <th>Unit</th>               
                <th>Unit Price</th>                           
                <th>Offer</th>
                <th>Action</th>
            </tr>
        </thead>
   <tbody id="addressRow"> 
        <tr>
    <td>
     <input type="text" name="supplier_name" id="supplier_name" class="form-control">
    </td>    

    <td>
        <input type="text" data-toggle="modal" name="contact_person" id="contact_person" class="form-control">
    </td>

    <td>
        <input type="text" name="contact_no" id="contact_no" class="form-control">
    </td>

    <td>
        <input type="text" name="terms_of_payment" id="terms_of_payment" class="form-control">
    </td>    

    <td>
    <select class="col-md-8 form-control select2 select2-hidden-accessible" id="item_description" name ="item_description" >
    <option value="0" class ="disabled selected">Select</option>
    <?php foreach($all_items as $all_items){ ?>
    <option value="<?php echo $all_items['item_id'];?>"><?php echo 
    $all_items['description'];?></option><?php } ?>
    </select>    
    </td>    


    <td>
        <input type="text" name="qty" id="qty" class="form-control">
    </td>


    <td>     
        <select class="form-control select2 select2-hidden-accessible" id="uom_opt" name="uom_opt" required>
    <option value="0" selected disabled>Select</option>
    </select>
  </div> 
    </td>
     

    <td>
        <input type="text" name="unit_price" id="unit_price" class="form-control">
    </td>

    <td>
        <input type="text" name="offer_price" id="offer_price" class="form-control">
    </td>

     <td><a href = "#" id="newAddress" class ="btn btn-info">Add</a></td>
        </tr>
    </tbody>
            </table><!-- end address table -->  
               </div>      
    </div>
</div>
<div class="modal-footer">
<!-- <button type="button" class="btn green " id="saveBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save</button>
<button type="button" class="btn green " id="updateBroker"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Changes</button> -->
<button type="button" class="btn green " id="saveAgent"><i class="fa fa-floppy-o" aria-hidden="true"></i>Save Agent</button>
<button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>
</div>
</div>
</div>
</div>
</form>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

