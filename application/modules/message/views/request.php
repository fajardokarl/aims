<div class="page-content"> 
<div class="container-fluid">
<div class="row">
<div class="col-md-12">
<div class="portlet light bordered">
<div class="portlet-title">
<div class="caption font-green-sharp">
<span class="caption-subject bold uppercase"> PRF Details</span>
</div>
</div>

<div class="portlet-body form"> 
<div class="form-body">
<div id="">
	<table id="all_request" class="table table-hover">
	   <thead>
			<tr>
                        <!--     <th>Action</th> -->
                            <th>PRF</th>
                           
                            <th>Name</th>
                            <!-- <th>Item</th> -->
                            <th>Department</th>
                            <th>Date Requested</th>
                            <th>Date Needed</th>
                            <th>Purpose</th> 
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($retrieve as $retrieve){ ?>
                            <tr>
                              <!--   <td><button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#viewBroker" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>View</button></td> -->
                                <td><?php echo $retrieve['prf_id']; ?></td>                               
                                <td><?php echo $retrieve['firstname']; ?></td>
                             <!--    <td><?php echo $retrieve['item_id']; ?></td>                 -->               
                                <td><?php echo $retrieve['department_name']; ?></td>
                                <td><?php echo $retrieve['date_requested']; ?></td>
                                <td><?php echo $retrieve['date_needed']; ?></td>
                                <td><?php echo $retrieve['purpose']; ?></td> 
                                                              
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


<div id="view-lots" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
    <div class="modal-dialog modal-xs">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Request<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
            </div>
            <form id="updateLot">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">  
                            <div class="form-body">
                                <div class="form-group">                               
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="portlet grey-cascade box">
                                <div class="portlet-title">
                                    <div class="caption">
                                            <span class="caption-subject"><i class="fa fa-list-alt" aria-hidden="true"></i></span>
                                    </div>
                                </div>
                                <div class="portlet-body">
                                    <div class="form-group">
                                        <label class="control-label">Lot Area</label>
                                        <input type="text" id="lot_area" name="lot_area"  placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label" >Price/Square Meter</label>
                                        <input type="text" id="price_p_sqm" name="price_p_sqm" style='text-align: right;' placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <label class="control-label">House Price</label>
                                        <input type="text" id="house_price" name="house_price" style='text-align: right;' align="right" placeholder="" maxlength="30" class="form-control"/>
                                    </div>
                                    <div class="form-group">
                                        <div class="row static-info">
                                            <div class="col-md-3 value"  align="left"> Total: </div>
                                            <div class="col-md-9 value" >
                                                <input type="text" name="total_price" readonly="true" style='text-align: right;' class="form-control" id="total_price">
                                            </div>
                                        </div>
                                    </div>
                                    <hr />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn green" id="update_lot" ></span>Save Changes</button>
                    <button type="button" data-dismiss="modal" class="btn dark btn-outline" id="btncloseClear"><i class="fa fa-times" aria-hidden="true"></i>Close</button>                 
                </div>
            </form> 
        </div>
    </div>
</div>