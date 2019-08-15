
<div class="row" id="master_plan_addproject" style="display: none;">
	<div class="col-md-12">
		<div class="portlet grey-cascade box">
            <div class="portlet-title">
				<div class="caption">
                    <span class="bold">Add Project</span>
                </div> 
            </div>
            <div class="portlet-body form">
				<form class="form-horizontal" action="#">
					<div class="form-body">
						<div class="row">
							<div class="col-md-10">
								<hr>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>Project name: </label>
									<div class="col-md-7">
										<input type="text" name="proj_name2" id="proj_name2" class="form-control">
									</div>
								</div>
								<div class="form-group">
									<label class="col-md-4 control-label"><font color="red"> * </font>Project Description: </label>
									<div class="col-md-7">
										<input type="text" name="proj_desc2" id="proj_desc2" class="form-control">
									</div> 
								</div>
								<input type="hidden" id="proj_id2">
							</div>
							<div class="col-md-2">
								<div class="portlet light bordered">
									<div class="portlet-title">
										<div class="caption center">
					                        <span class="bold"> ACTION</span>
					                    </div>
					                </div>
					                <div class="portlet-body form">
					                	<div class="row">
                                            <div id="proj_actions">
												<button type="button" class="btn blue btn-block" id="save_proj2" name="save_proj2">Save Project</button>
												<button type="button" class="btn blue btn-block" id="save_proj_changes2" name="save_proj2">Save Changes</button>
												<button type="button" class="btn btn-block gray" id="proj_cancel2" data-dismiss="modal">Close</button>
                                            </div>
					                	</div>
					                </div>
								</div>
							</div>
						</div>
					</div>
				</form>
            </div>
        </div>
	</div>
</div>

<div id="phase_adding">
	<div class="row" id="phase_info" >
		<div class="col-md-12">
			<div class="portlet grey-cascade box">
                <div class="portlet-title">
					<div class="caption">
                        <span class="bold">Phase Information</span>
                    </div> 
                </div>
                <div class="portlet-body form"> 
                   <form class="form-horizontal" action="#">
						<div class="form-body">
							<div class="row">
								<div class="col-md-5">
									<div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font> License Number: </label>
										<div class="col-md-7">
											<input type="text" name="new_proj_license" id="new_proj_license" class="form-control" required>
										</div>
									</div>
									<div id="old_project" class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font> Project: </label>
										<div class="col-md-7">
											<select class="form-control select2 select2-hidden-accessible" id="opt_project" name="opt_project" required>
	                                            <option value="0" selected>None</option>
	                                            <?php foreach ($projects as $projects) { ?>
	                                            	<option value="<?php echo $projects['project_id'] ?>"><?php echo $projects['project_name'] ?></option>
	                                            <?php } ?>
	                                        </select>  
										</div>
									</div> 
									<div id="new_project" style="display: none;">
										<div class="form-group" >
											<label class="col-md-4 control-label"><font color="red"> * </font> New Project Name: </label>
											<div class="col-md-7">
												<input type="text" name="new_proj_name" id="new_proj_name" class="form-control" required>
											</div>
										</div>
										<div class="form-group">
											<label class="col-md-4 control-label"><font color="red"> * </font> Project Description: </label>
											<div class="col-md-7">
												<input type="text" name="new_proj_desc" id="new_proj_desc" class="form-control" required>
											</div>
										</div>
										
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font>Phase: </label>
										<div class="col-md-7">
											<select class="form-control select2 select2-hidden-accessible" id="opt_phase" name="opt_phase" required>
	                                            <option value="0" selected>None</option>
	                                           <!--  <?php foreach ($phase as $phase) { ?>
	                                            	<option value="<?php echo $phase['phase_id'] ?>"><?php echo $phase['phase_name'] ?></option>
	                                            <?php } ?> -->
	                                        </select>
										</div> 
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font>Number of Blocks: </label>
										<div class="col-md-7">
											<input type="number" name="num_blocks" id="num_blocks" class="form-control" min="1">
										</div>
									</div>
								</div>

								<div class="col-md-5">
									<!-- <div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font>Lot Area: </label>
										<div class="col-md-7">
											<input type="number" name="phase_lot_area" id="phase_lot_area" class="form-control" placeholder="Sq m">
										</div> 
									</div>  -->
									<div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font>Residential Lot Area: </label>
										<div class="col-md-7">
											<input type="number" name="use_lot_area" id="use_lot_area" class="form-control" placeholder="Sq m">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font>Park/Playgrounds: </label>
										<div class="col-md-7">
											<input type="number" name="playground_area" id="playground_area" class="form-control" placeholder="Sq m">
										</div>
									</div>
									<div class="form-group">
										<label class="col-md-4 control-label"><font color="red"> * </font>Road Area: </label>
										<div class="col-md-7">
											<input type="number" name="road_area" id="road_area" class="form-control" placeholder="Sq m">
										</div>
									</div>
								</div>
								<div class="col-md-2">
									<div class="portlet light bordered">
										<div class="portlet-title">
											<div class="caption center">
						                        <span class="bold"> ACTION</span>
						                    </div>
						                </div>
						                <div class="portlet-body form">
						                	<div class="row">
						                		<div class="checkbox-list">
                                                    <label><input type="checkbox" id="check_add_all">Save on New Project</label>
                                                </div>
												<button type="button" class="btn blue btn-block" id="btn_add_phase" center> ADD</button>
												<button type="button" class="btn btn-block" center id="btn_clear"> CLEAR</button>
						                	</div>
						                </div>
									</div>
								</div>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>    
	</div>
<!-- 	<div class="row" id="save_reset_action" style="display: none;">
		<div class="col-md-12">
			<div class="action" align="right">
				<button type="button" class="btn green col-md-2" id="save_all_lots" name="save_proj">Save</button>
				<button type="button" class="btn gray col-md-2" id="reset_lot">Reset</button>
			</div>
		</div>
	</div> -->
	<div class="row" style="display: none;" id="save_reset_action">
		<div class="col-md-12">
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<span>PROJECT | <span id="proj_title"></span></span>
					</div>
					<div class="actions">
						<button type="button" class="btn green" id="save_all_lots" name="save_proj">Save</button>
						<!-- <button type="button" class="btn gray" id="cancel_lot" data-dismiss="modal">Close</button> -->
						<button type="button" class="btn gray" id="reset_lot">Reset</button>
					</div>
				</div>
			</div>
		</div>
	</div>


<!-- <button type="button" class="btn red" id="try"> TRY</button> -->

	<div class="row">

		<div class="col-md-6">
			<div class="portlet grey-cascade box">
                <div class="portlet-title">
					<div class="caption">
                        <span class="bold">Phase</span>
                    </div>
                </div>

                <div class="portlet-body "> 
					<!-- <span>Avalailable Area:</span> -->
                    <table class="table table-hover" id="tbl_phase">
						<thead>
							<tr>
								<th>ID</th>
								<th>ID</th>
								<th>Phase</th>
								<th>Blocks</th>
								<th>Area</th>
								<!-- <th>Action</th> -->
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="portlet grey-cascade box">
                <div class="portlet-title">
					<div class="caption">
                        <span class="bold">Block | Area : <span id="avalailabl_lot"></span></span>
                    </div> 
                </div>

                <div class="portlet-body "> 
                	<table class="table table-hover" id="tbl_block">
						<thead>
							<tr>
								<th>ID</th>
								<th>ID</th>
								<th>Block</th>
								<th>Area</th>
								<th>Action</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<div class="portlet grey-cascade box">
                <div class="portlet-title">
					<div class="caption">
                        <span class="bold">Lots</span>
                    </div> 
                </div>

                <div class="portlet-body "> 
                    <table class="table table-hover" id="tbl_lot">
						<thead>
							<tr>
								<th>Block ID</th>
								<th>Lot ID</th>
								<th>Block No</th>
								<th>Lot Description</th>
								<th>Lot Area</th>
								<th>Action</th>
								<th>with house</th>
							</tr>
						</thead>
						<tbody>
							
						</tbody>
					</table>
				</div>
				<!-- <div class="portlet-footer"></div> -->
			</div>
		</div>    
	</div>
</div>		

<div class="modal fade bs-modal-lg" id="add_lot_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<h2 class="modal-title" id="master_plan_title">Set Lots | Block <span id="block_num_head"></span></h2>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<h4>Available Area: <span id="available_lot_temp"></span></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-2 control-label">Area </label>
							<div class="col-md-4">
								<input type="number" name="area_per_lot" id="area_per_lot" class="form-control" min="1" placeholder="Sq m">
							</div>
							<div class="checkbox-list col-md-2">
                                <label><input type="checkbox" id="check_with_house">With House</label>
                            </div>
							<button class="btn blue col-md-2" id="btn_add_area">ADD</button>
							<button class="btn gray col-md-2" id="btn_reset_templot">RESET</button>
						</div>
					</div>
				</div>
				<hr>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-bordered table-hover" id="tbl_lot_temp">
							<thead>
								<tr>
									<th>Lot No</th>
									<th>Block No</th>
									<th>Lot Description</th>
									<th>Lot Area</th>
									<th>With House</th>
									<!-- <th>Action</th> -->
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn green" id="btn_add_lots" name="btn_add_lots">Save Lots</button>
				<button type="button" class="btn gray" id="btn_cancel_lottemp" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bs-modal-lg" id="edit_lot_modal" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal"></button>
				<!-- <h2 class="modal-title" id="master_plan_title">Set Lots | Block <span id="block_num_head"></span></h2> -->
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<h4>Available Area: <span id="available_lot_temp_edit"></span></h4>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<label class="col-md-2 control-label">Area </label>
							<div class="col-md-4">
								<input type="number" name="area_per_lot_edit" id="area_per_lot_edit" class="form-control" min="1" placeholder="Sq m">
							</div>
							<div class="checkbox-list col-md-2">
                                <label><input type="checkbox" id="check_with_house_edit">With House</label>
                            </div>
						</div>
					</div>
				</div>
				<hr>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn green" id="btn_saveedit_lot" name="btn_saveedit_lot">Save Changes</button>
				<button type="button" class="btn gray" id="btn_cancel_lottemp2" data-dismiss="modal">Close</button>
			</div>
		</div>
	</div>
</div>