
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-red-sunglo">
            <!-- <i class="icon-settings font-red-sunglo"></i> -->
            <span class="caption-subject bold uppercase"> </span>
        </div>
	</div>
	<div class="portlet-body form">
		<div class="row">
			<div class="col-md-3">
				<div class="form-group">
					<label class="control-label">Projects</label>
			        <div class="">
			            <select class="form-control col-md-3" id="docs_project">
			                <option value="" class ="disabled selected">Select Here..</option>
	                        <?php foreach($all_projects as $all_projects){ ?>
	                          <option value="<?php echo $all_projects['project_id'];?>"><?php echo $all_projects['project_name'];?></option>
	                        <?php } ?> 
			            </select>
			        </div>
				</div>
			</div>
		</div>
		<br/>
		<div class="row">
			<div class="col-md-12">
				<table class="table table-hover table-striped" id="docs_contracts">
					<thead>
						<tr>
							<th>Block</th>
							<th>Lot</th>
							<th>Customer Name</th>
							<th>Status</th>
							<th>CTS Date</th>
							<th>CTS Signed</th>
							<th>CTS Notarized</th>
							<th>DOAS date</th>
							<th>DOAS Rec'd</th>
							<!-- <th>DOAS to Comp</th> -->
							<th>Payment</th>
							<th>Transferred</th>
							<th>cts_s</th>
							<th>cts_n</th>
							<th>doas_rec</th>
							<th>id</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>	
			</div>
		</div>
	</div>
</div>

<div id="docs_contract_info" class="modal fade" tabindex="-1" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" ></button> 
                <h4 class="modal-title"><span class="caption-subject bold uppercase">Contract Update</span></h4> 
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet grey-cascade box" id="edit_cts_portlet">
							<div class="portlet-title bold">
								<h3 class="bold"> CTS</h3>
							</div>
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<!-- <font color="red"> * </font> -->
													<label class="col-md-4 control-label">CTS Date</label>
													<div class="col-md-7">
														<input type="date" name="edit_cts_date" id="edit_cts_date" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<!-- <font color="red"> * </font> -->
													<label class="col-md-4 control-label">CTS Signed</label>
													<div class="col-md-7">
														<input type="checkbox" name="edit_cts_signed" id="edit_cts_signed" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<!-- <font color="red"> * </font> -->
													<label class="col-md-4 control-label">CTS Notarized</label>
													<div class="col-md-7">
														<input type="checkbox" name="edit_cts_notarized" id="edit_cts_notarized" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>  
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">  
                        <div class="portlet grey-cascade box" id="edit_doas_portlet">
							<div class="portlet-title">
								<h3 class="bold"> DOAS</h3>
							</div>
							<div class="portlet-body form">
								<div class="form-horizontal">
									<div class="form-body">
										<div class="row">
											<div class="col-md-12">
												<div class="form-group">
													<!-- <font color="red"> * </font> -->
													<label class="col-md-4 control-label">DOAS Date</label>
													<div class="col-md-7">
														<input type="date" name="edit_doas_date" id="edit_doas_date" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<!-- <font color="red"> * </font> -->
													<label class="col-md-4 control-label">DOAS Signed</label>
													<div class="col-md-7">
														<input type="checkbox" name="edit_doas_signed" id="edit_doas_signed" class="form-control">
													</div>
												</div>
												<div class="form-group">
													<!-- <font color="red"> * </font> -->
													<label class="col-md-4 control-label">DOAS Amount</label>
													<div class="col-md-7">
														<input type="text" name="edit_doas_amount" id="edit_doas_amount" class="form-control">
													</div>
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>  
                    </div>
                </div>
                <div class="row">
                	<div class="col-md-12" align="right">
	                	<button align="right" class="btn green" id="save_new_docs">Update</button>
                	</div>
                </div>
            </div> 
        </div>
    </div>
</div>


<div class="modal fade bs-modal-lg" id="legacy_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <!-- <button type="button" class="close" data-dismiss="modal"></button> -->
                <h3 class="modal-title" id="">Legacy Customers List</h3>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-8">
                        <table class="table table-hover" id="legacy_table">
                            <thead>
                                <th>ID</th>
                                <th>customer name</th>
                            </thead>
                            <tbody>
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <div align="right">
                    <button id="select_oldcust" class="btn blue">Select</button>
                    <button id="close_old" class="btn red" data-dismiss="modal">Cancel</button>
                    
                </div>
            </div>
        </div>
    </div>
</div>