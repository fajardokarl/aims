

<div class="page-content"> 
	<!-- <div class="container"> -->
	    <div class="row">
	        <div class="col-md-12">
	            <div class="portlet light bordered">
	                <div class="portlet-title">
						<div class="caption font-green-sharp">
	                        <span class="caption-subject bold uppercase"> </span>
	                    </div>
	                </div>

	                <div class="portlet-body form"> 
	                    <div class="form-body">
	                    	<div id="">
								<table class="table table-hover" id="legacy_contract_tbl">
									<thead>
										<tr>
											<th>Contract ID</th>
											<th>Contract Date</th>
											<th>Customer</th>
											<th>DP %</th>
											<th>Balance %</th>
											<!-- <th>Lot</th>
											<th>Lot Area</th>
											<th>Area Cost</th>
											<th>TCP</th>
											<th>Project</th>
											<th>Agent</th> -->
										</tr>
									</thead>
									<tbody>
										<?php foreach ($contracts as $contracts) { ?>
											<tr>
												<td><?php echo $contracts['ContractId']; ?></td>
												<td><?php echo date_format(date_create($contracts['ContractDate']), 'M. d, Y'); ?></td>
												<td><?php echo $contracts['CustName']; ?></td>
												<td><?php echo $contracts['Scheme1'] . '%'; ?></td>
												<td><?php echo $contracts['Scheme2'] . '%'; ?></td>
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
	<!-- </div> -->
</div>
