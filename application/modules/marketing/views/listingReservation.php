
	    <div class="row">
	        <div class="col-md-12">
	            <div class="portlet light bordered">
	                <div class="portlet-title">
						<div class="caption font-green-sharp">
	                        <span class="caption-subject bold uppercase">Lot Reservations</span>
	                    </div>

	                    <div class="actions col-md-3">

	                        <select class="form-control select2 select2-hidden-accessible" id="all_project" name ="all_project">
	                                <!-- <option value="" disabled selected>Filter By Project..</option> -->
	                                <option value="0" class ="" selected>All</option>
	                                <?php foreach($all_project as $all_project){ ?>
	                                  <option value="<?php echo $all_project['project_id'];?>"><?php echo $all_project['project_name'];?></option>
	                                <?php } ?>
	                        </select>

	                    </div>
	                </div>
	                <input type="hidden" id="ses_client" value="<?php echo $this->session->userdata('client_id_ses'); ?>">
	                <div class="portlet-body">
	                	<div id="blockUis">
							<table id="listOfLots" class="table table-hover order-column">
							   <thead>
									<tr>
										<th>Lot ID</th>
										<th>Lot Description</th>
										<th>Lot Area</th>
										<th>Price/SqrMtr</th>
										<th>House Price</th>
										<th>VAT</th>
										<th>Lot Price</th>
										<th>Action</th>
								</thead>
								<tbody>
									  <?php foreach($lots_available as $lots){ ?>
										<tr>
											<td><?php echo $lots['lot_id'];?></td>
											<td><?php echo $lots['lot_description'];?></td>
											<td><?php echo $lots['lot_area'];?></td>
											<td align="right"><?php echo number_format($lots['price_per_sqr_meter']);?></td>
											<td align="right"><?php echo number_format($lots['house_price']);?></td>
											<td align="right"><?php echo number_format($lots['lot_vat']);?></td>
											<td align="right"><?php echo number_format($lots['lot_price']); ?></td>
											<td><button  class="btn green btn-xs reservelots"><i class="fa fa-check-square-o" aria-hidden="true"></i> Reserve</button>
											</td>
										</tr>
									 <?php } ?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
		</div>


		<div style="display: none;" id="showcustomer" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-lg">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
						<h4 class="modal-title"><span class="caption-subject bold uppercase">Customers<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">  
								<div class="portlet-body">   
									<form id="updateLot">
										<div class="form-body">
										<div class="form-group">
											<table class="customerlists table table-hover" id="customerlists" >
						                        <thead>
						                        <tr>
						                            <th>Client ID</th>
						                            <th>Client Name</th>
						                            <th>Client Type</th>
						                            <th>Action</th>
						                        </tr>
						                        </thead>
						                    <tbody>
						                    <?php foreach($customer as $customer){ ?>
						                     <tr data-custid="${data.custid}">
						                        <td><?php echo $customer['client_id'];?></td>
						                        <?php if ( $customer['client_type_id'] == 1 ) { ?>
							                        <td><?php echo $customer['lastname'] . ', ' . $customer['firstname'] . ' ' . $customer['middlename'] . ' ' . $customer['suffix'];?></td>
						                        <?php }else{ ?>
							                        <td><?php echo $customer['organization_name']; ?></td>
						                        <?php } ?>
						                        <td><?php echo $customer['client_type_name'];?></td>
						                        <td><a href="" class="btn green btn-xs custlist"><i class="fa fa-check-square-o" aria-hidden="true"></i> Select</a></td>
						                    </tr>
						                    <?php } ?> 
						                  
						                    </tbody>
						                    </table>      
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

        <div style="display: none;" id="viewSelectedLot" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false">
			<div class="modal-dialog modal-xs">
				<div class="modal-content">
					<div class="modal-header">
						<button type="button" class="close" id="closeLot" data-dismiss="modal" ></button> 
						<h4 class="modal-title"><span class="caption-subject bold uppercase">Lot :<span id="lidss"></span>  <span id="lotdescN"> </span> <span id="slid" style="display:none;"></span><span id="slids" style="display:none;"></span></h4> 
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-md-12">  
								<div class="portlet-body">   
									<form id="updateLot">
										<div class="form-body">
										<div class="form-group">
											<label class="col-md-4 control-label">Lot Area</label>
											<div class="col-md-12"> 
												<input type="text" readonly  id="lotareaN" class="form-control" value=""> 
												<input type="text" readonly style="display:none;" name="lotareaID" id="lotareaID" class="form-control" value=""> 
											</div>  
										</div>   
											<div class="form-group">
											<label class="col-md-4 control-label">Price/SqrMtr</label>
											<div class="col-md-12"> 
												<input type="text" name="areacostN" id="areacostN" class="form-control" value=""> 
											</div>  
										</div>   
										<div class="form-group" id="housepriceNP" style="display:none;">
											<label class="col-md-4 control-label">House Price</label>
											<div class="col-md-12"> 
												<input type="text" name="housepriceN" id="housepriceN" class="form-control" value=""> 
											</div>  
										</div> 
											<div class="form-group">
											<label class="col-md-4 control-label">Vat Price</label>
											<div class="col-md-12"> 
												<input type="text" readonly name="vatpriceN" id="vatpriceN" class="form-control" value=""> 
											</div>  
										</div>   
										<div class="form-group">
											<label class="col-md-4 control-label">Zonal Value</label>
											<div class="col-md-12"> 
												<input type="text" name="zonalvalueN" id="zonalvalueN" class="form-control" value=""> 
											</div>  
										</div> 
											<div class="form-group">
											<label class="col-md-4 control-label">Total Contract Price</label>
											<div class="col-md-12"> 
											 	<span id="tcpNi"></span>
											</div>  
										</div> 
										<div class="form-group">
												<div class="row">
												<label class="col-md-3 control-label"> </label>
													 <div class="col-md-4">
														<input type="submit" id ="saveUp" value="SAVE" class="btn green">  
														<button type="button" class="btn default">Clear</button>
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