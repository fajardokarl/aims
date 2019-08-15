<!-- <div class="page-content"> 
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-12"> -->
	            <div class="portlet light bordered">
	                <div class="portlet-title">
						<div class="caption font-green-sharp">
	                        <span class="caption-subject bold uppercase"> Contract Details</span>
	                    </div>
	                </div>

	                <div class="portlet-body form"> 
	                    <div class="form-body">
	                    	<div id="">
								<table id="all_contracts" class="table table-hover">
								   <thead>
										<tr>
											<th>Contract ID</th>
											<th>No.</th>
											<th>Buyer</th>
											<th>Block</th>
											<th>Lot</th>
											<th>Lot Area</th>
											<th>Price/Sq. M.</th>
											<th>TCP</th>
											<th>Date of Purchase</th>
											<th>Registration</th>
											<th>Payment</th>
											<th>Type of Instrument</th>
											<th>Remarks</th>
									</thead>
									
									<tbody>
										<?php $i = 1; ?>
										<?php foreach ($all_contracts as $contract) { ?>
											<tr>
												<td><?php echo $contract['contract_id']; ?></td>
												<td><?php echo $i; ?></td>
												<td><?php echo $contract['lastname'] . ", " . $contract['firstname'] . " " . $contract['middlename']; ?></td>
												<td><?php echo $contract['block_no']; ?></td>
												<td><?php echo $contract['lot_id']; ?></td>
												<td><?php echo $contract['lot_area']; ?></td>
												<td><?php echo number_format($contract['price_per_sqr_meter'], 2); ?></td>
												<!-- <td><?php #if ($contract['organization_name'] != null) { echo $contract['organization_name']; }else{ echo "undefined"; }  ?></td> -->
												<td><?php echo number_format($contract['total_contract_price'], 2); ?></td>
												<td><?php echo date('M d, Y', strtotime($contract['contract_date'])); ?></td>
												<td> </td>
												<td> </td>
												<td><?php echo $contract['contract_status_name']; ?></td>
												<td> </td>
												<!-- <td><?php echo $contract['contract_id']; ?></td> -->
												<?php $i++; ?>
											</tr>
										<?php } ?>
									</tbody>
								</table>  
							</div>
						</div>
					</div>
				</div>
<!-- 			</div>
	    </div>
	</div>
</div> -->