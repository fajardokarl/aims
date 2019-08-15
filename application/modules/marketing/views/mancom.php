
<div class="portlet light">
	<div class="portlet-title">
		<div class="caption font-red-sunglo">
            <!-- <i class="icon-settings font-red-sunglo"></i> -->
            <span class="caption-subject bold uppercase"> </span>
        </div>
	</div>
	<div class="portlet-body form">
		<div class="form">
			<div class="form-body" align="center">
				<div class="row">
					<div class="col-md-12">
						<div class="form-group col-md-3">
					        <!-- <label class="control-label">Projects</label>
					        <div class="">
					            <select class="form-control col-md-3">
					                <option value="" class ="disabled selected">Select Here..</option>
			                        <?php foreach($all_projects as $all_projects){ ?>
			                          <option value="<?php echo $all_projects['project_id'];?>"><?php echo $all_projects['project_name'];?></option>
			                        <?php } ?> 
					            </select>
					        </div> -->
					        <label class="control-label">Report Type</label>
					        <div class="">
					            <select class="form-control col-md-3" id="mancom_reptype">
					                <option value="" class ="disabled selected">Select Here..</option>
					                <option value="1">Year-to-Date</option>
					                <!-- <option value="2" class ="disabled selected">Year-to-Date</option> -->
					                <option value="2">Monthly</option>
					                <!-- <option value="4" class ="disabled selected">Monthly</option> -->
					            </select>
					        </div>
					    </div>
			<!-- 		</div>
					<div class="row"> -->
                        <div class="form-group col-md-3">
                            <label class="control-label">Month & Year</label>
                            <div class="">
                                <!-- <div class="input-group input-medium date date-picker" data-date-format="mm/yyyy" data-date-viewmode="years" data-date-minviewmode="months"> -->
                                    <input type="date" class="form-control" id="mancom_date">
                                    <!-- <span class="input-group-btn">
                                        <button class="btn default" type="button">
                                            <i class="fa fa-calendar"></i>
                                        </button>
                                    </span> -->
                                <!-- </div> -->
                                <span class="help-block"><i> Pick any day for preferred Month & Year </i></span>
                            </div>
                        </div>
					</div>
				</div>
				<div class="row" align="center">
					<div class="col-md-6" align="center">
						<button class="btn blue" type="button" id="mancom_generate" > Generate </button>
					</div>
				</div>
			</div>	
		</div>
		<br />
		<div class="row">
			<div class="col-md-12" align="center">
				<h3 class="caption-subject bold uppercase" id="mancom_title"></h3>
				<h4 class="caption-subject bold uppercase font font-blue" id="mancom_as_of"></h4>

			</div>
		</div>
		<div class="row">
			<div class="col-md-6">
			    <div class="portlet grey-cascade box">
			        <div class="portlet-title">
			            <div class="caption">
			                <span class="bold uppercase">IN UNITS </span>
			            </div>
			        </div>
			        <div class="portlet-body">
						<table class="table table-hover table-striped" id="mancom_table_units">
							<thead>
								<tr>
									<th>Project Name</th>
									<th>Actual</th>
									<th>Budget</th>
									<th>Variance</th>
									<th>%</th>
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
			                <span class="bold uppercase">IN PESO </span>
			            </div>
			        </div>
			        <div class="portlet-body">
						<table class="table table-hover table-striped" id="mancom_table_peso">
							<thead>
								<tr>
									<th>.</th>
									<th>Project name</th>
									<th align="right">Actual</th>
									<th>Budget</th>
									<th>Variance</th>
									<th>%</th>
								</tr>
							</thead>
							<tbody>
							</tbody>
						</table>
			        </div>
			    </div>
			</div>
		</div>
	</div>
</div>


<div class="modal fade bs-modal-xs" id="mancom_budget_input_peso" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h2 class="modal-title" id="">Input Budget (in Peso)</h2>

			</div>
			<div class="modal-body">
				<div class="portlet grey-cascade box">
					<div class="portlet-title">
					</div>
					<div class="portlet-body form">
						<div class="form-horizontal">
							<div class="form-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="col-md-3 control-label"><font color="red"> * </font> Budget: </label>
											<div class="col-md-7">
												<input type="text" name="mancom_budget_peso" id="mancom_budget_peso" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div align="right">
					<button id="mancom_confirm_budget_peso" class="btn blue">Confirm</button>
					<button id="" class="btn red" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
		</div>
	</div>
</div>

<div class="modal fade bs-modal-xs" id="mancom_budget_input_unit" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h2 class="modal-title" id="">Input Budget (in Units)</h2>

			</div>
			<div class="modal-body">
				<div class="portlet grey-cascade box">
					<div class="portlet-title">
					</div>
					<div class="portlet-body form">
						<div class="form-horizontal">
							<div class="form-body">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label class="col-md-3 control-label"><font color="red"> * </font> Budget: </label>
											<div class="col-md-7">
												<input type="text" name="mancom_budget_unit" id="mancom_budget_unit" class="form-control">
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div align="right">
					<button id="mancom_confirm_budget_unit" class="btn blue">Confirm</button>
					<button id="" class="btn red" data-dismiss="modal">Cancel</button>
					
				</div>
			</div>
		</div>
	</div>
</div>