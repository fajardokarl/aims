<!--  	<script type="text/javascript">
     		(function() { 
       		window.onload = function() {
       			$('#blockUis').show();
       	}
     	}());
     </script> -->
<div class="page-content"> 
	<!-- <div class="container"> -->
	    <div class="row">
	        <div class="col-md-12">
	            <div class="portlet light bordered">
	                <div class="portlet-title">
						<div class="caption font-green-sharp">
	                        <span class="caption-subject bold uppercase"> Lot Details</span>
	                    </div>
	                    <div class="actions col-md-3">   
                            <select class="form-control select2 select2-hidden-accessible select" id="all_project" name ="all_project">
                            		<option value="a" class ="" selected disabled>Filter By Project..</option>
                                    <option value="0" class ="">All</option>
                                    <?php foreach($all_project as $all_project){ 
                                    	if ($all_project['project_id'] == 1) { ?>
                                    		<option value="<?php echo $all_project['project_id'];?>" selected><?php echo $all_project['project_name'];?></option>
                                    	<?php } else {?>
                                      		<option value="<?php echo $all_project['project_id'];?>"><?php echo $all_project['project_name'];?></option>
                                    <?php } ?>
                                    <?php } ?>
                            </select>
	                    </div>
	                </div>

	                <div class="portlet-body form"> 
	                    <div class="form-body">
	                    	<div id="">
								<table id="all_lots" class="table table-hover">
								   <thead>
										<tr>
											<th>Lot ID</th>
											<th>Lot Description</th>
											<th>Lot Area</th>
											<th>Price/SqrMtr</th>
											<th>House Price</th>
											<th>VAT Price</th>
											<th>Total Price</th>
											<th>Availability</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										<?php foreach ($lots as $lots) {?>
											<tr>
												<td><?php echo $lots['lot_id']; ?></td>
												<td><?php echo $lots['lot_description']; ?></td>
												<td><?php echo $lots['lot_area']; ?> Sq m</td>
												<td align="right">&#8369; <?php echo number_format($lots['price_per_sqr_meter']);?></td>
												<td align="right">&#8369;<?php echo number_format($lots['house_price']);?></td>
												<td align="right">&#8369;<?php echo number_format($lots['lot_vat']);?></td>
												<td align="right">&#8369;<?php echo number_format(($lots['lot_area'] * $lots['price_per_sqr_meter']) + $lots['house_price'] + $lots['lot_vat']) ;?></td>
												<td>
													<?php 
														if ($lots['availability'] == 1) {
															echo "<span class='font-green-jungle bold'>YES</span>";
														}else{
															echo "<span class='font-red-intense bold'>NO</span>";
														}
													?>
												</td>
												<td><button type="button" class="btn blue-dark btn-lot-edit btn-xs" data-toggle="modal" data-target="#view-lots" ><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit</button></td>
											</tr>
										<?php } ?>
										</>
									</tbody>
								</table>  
							</div>
						</div>
					</div>
				</div>
			</div>
	    </div>
	<!-- </div> -->
</div>
   
<div id="view-lots" class="modal fade" role="dialog" tabindex="-1" data-backdrop="static" data-keyboard="false">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
				<h4 class="modal-title"><span class="caption-subject bold uppercase"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Edit Lot<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
			</div>
			<form id="updateLot">
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">  
							<div class="form-body">
								<div class="form-group">
									<div class="portlet grey-cascade box">
										<div class="portlet-title">
											<div class="caption">
												<span class="caption-subject"><i class="fa fa-info-circle" aria-hidden="true"></i> Lot Details</span>
                            				</div>
                            			</div>
            							<div class="portlet-body">
            							    <div class="row static-info">
            							    	<input type="hidden" id="lot_id" value="">
            							        <div class="col-md-5 name"  align="right">Project Name:</div>
            							        <div class="col-md-7 value" id="txt_project_name"></div>
            							    </div>
            							    <div class="row static-info">
            							        <div class="col-md-5 name"  align="right"> Phase Name: </div>
            							        <div class="col-md-7 value" id="txt_phase_name"></div>
            							    </div>
            							    <div class="row static-info">
            							        <div class="col-md-5 name"  align="right"> Block No.: </div>
            							        <div class="col-md-7 value" id="txt_block_no"></div>
            							    </div>
            							    <div class="row static-info">
            							        <div class="col-md-5 name"  align="right"> Lot Price: </div>
            							        <div class="col-md-7 value" id="txt_lot_price"></div>
           							     	</div>
           							     	<div class="row static-info">
           							     		<div class="col-md-5 name"  align="right"> TCT: </div>
            							        <div class="col-md-7 value" id="tct"></div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name"  align="right"> Tax Decleration No.: </div>
            							        <div class="col-md-7 value" id="tax_dec_no"></div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name"  align="right"> COR No.: </div>
            							        <div class="col-md-7 value" id="cor_no"></div>
											</div>
											<div class="row static-info">
												<div class="col-md-5 name"  align="right"> Status:</div>
            							        <div class="col-md-7 value" id="lot_status"></div>
											</div>
            							</div>
									</div>
								</div>
							</div>
						</div>
						<div class="col-md-6">
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