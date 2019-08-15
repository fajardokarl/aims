<div class="page-content"> 
	<div class="container-fluid">
	    <div class="row">
	        <div class="col-md-12">
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
											<th>Customer</th>
											<th>Lot Description</th>
											<th>TCP</th>
											<th>Realty</th>
									</thead>
									
									<tbody>
										<?php foreach ($all_contracts as $contract) { ?>
											<tr>
												<td><?php echo $contract['contract_id']; ?></td>
												<td><?php echo $contract['lastname'] . ", " . $contract['firstname'] . " " . $contract['middlename']; ?></td>
												<td><?php echo $contract['lot_description']; ?></td>
												<td><?php echo number_format($contract['lot_price'], 2); ?></td>
												<td><?php if ($contract['organization_name'] != null) { echo $contract['organization_name']; }else{ echo "undefined"; }  ?></td>
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