<div class="row">
	<div class="col-md-5">
		<div class="portlet grey-cascade box">
		    <div class="portlet-title">
				<div class="caption">
		            <span class="bold">ASSETS INPUT</span>
		        </div> 
		    </div>
		    <div class="portlet-body form">
	    		<div class="form-horizontal" >
			    	<div class="form-body">
			    		<div class="row">
			    			<div class="col-md-12">
			    				<div class="form-group">
			    					<div class="col-md-4">
				    					<label class="control-label"><font color="red"> * </font>Description</label>
			    					</div>
			    					<div class="col-md-8">
										<input type="text" name="asset_desc" id="asset_desc" class="form-control">
									</div>
			    				</div>
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="col-md-12">
			    				<div class="form-group">
			    					<div class="col-md-4">
				    					<label class="control-label">Serial Number</label>
			    					</div>
			    					<div class="col-md-8">
										<input type="text" name="asset_serial" id="asset_serial" class="form-control">
									</div>
			    				</div>
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="col-md-12">
			    				<div class="form-group">
			    					<div class="col-md-4">
				    					<label class="control-label"><font color="red"> * </font>Department</label>
			    					</div>
			    					<div class="col-md-8">
										<select id="asset_dept" name="asset_dept" class="select2">
											<option value="0">None</option>
											<?php foreach ($dept_code as $dept_code) { ?>
												<option value="<?php echo $dept_code['department_id']; ?>"><?php echo $dept_code['department_code']; ?></option>
											<?php } ?>
										</select>
									</div>
			    				</div>
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="col-md-12">
			    				<div class="form-group">
			    					<div class="col-md-4">
				    					<label class="control-label">Custodian</label>
			    					</div>
			    					<div class="col-md-8">
										<select id="asset_custodian" name="asset_custodian" class="select2">
											<option value="0">None</option>
											<?php foreach ($emp as $emp) { ?>
												<option value="<?php echo $emp['employee_id']; ?>"><?php echo $emp['lastname'] . ', ' . $emp['firstname'] . ' ' . $emp['middlename']; ?></option>
											<?php } ?>
										</select>
									</div>
			    				</div>
			    			</div>
			    		</div>
						<div class="row">
			    			<div class="col-md-12">
			    				<div class="form-group">
			    					<div class="col-md-4">
				    					<label class="control-label"><font color="red"> * </font>Location</label>
			    					</div>
			    					<div class="col-md-8">
			    						<select id="asset_location" name="asset_location" class="select2">
											<option value="0">None</option>
											<?php foreach ($location as $location) { ?>
												<option value="<?php echo $location['asset_location_id']; ?>"><?php echo $location['location_abbr']; ?></option>
											<?php } ?>
										</select>
										<!-- <select id="asset_location" name="asset_location" class="select2">
											<option value="0">None</option>
											<option value="CDO">CDO</option>
											<option value="MNL">MNL</option>
											<option value="MNL">MNL</option>
											<option value="BXU">BXU</option>
											<option value="VAL">VAL</option>
										</select> -->
									</div>
			    				</div>
			    			</div>
			    		</div>
			    		<div class="row">
			    			<div class="col-md-12">
				    			<button class="btn blue col-md-3 pull-right" id="save_asset" >Save</button>
				    			<button class="btn gray col-md-3 pull-right" id="reset_asset">Reset</button>
			    			</div>
			    		</div>
			    	</div>
			    </div>
		    </div>
		</div>
	</div>
	<div class="col-md-7">
		<div class="portlet grey-cascade box">
		    <div class="portlet-title">
				<div class="caption">
		            <span class="bold">ASSETS LIST</span>
		        </div> 
	            <div class="actions" align="right">
	            	<!-- <button id="print_code" class="btn btn-default btn-sm">Print</button> -->
	            </div>
		    </div>
		    <div class="portlet-body form">
	    		<div class="form-horizontal" >
			    	<div class="form-body">
			    		<div class="row">
			    			<table class="table table-hover table-condensed" id="tbl_assets">
								<thead>
									<tr>
										<th>ID</th>
										<th>ID</th>
										<th>Tag No.</th>
										<th>Asset No.</th>
										<th>Description</th>
										<th>Serial No.</th>
										<th>Custodian</th>
										<th>Location</th>
										<th>Date</th>
										<th>.</th>
										<!-- <td>ID</td>
										<td>ID</td> -->
									</tr>
								</thead>
								<tbody>
									 <?php foreach($assets as $assets){ ?>
	                                <tr>
	                                    <td><?php echo $assets['asset_barcode_id']; ?></td>
	                                    <td><?php echo $assets['asset_barcode_id']; ?></td>
	                                    <td><?php echo $assets['tag_number'];?></td>
	                                    <td><?php echo $assets['asset_number'];?></td>
	                                    <td><?php echo $assets['asset_description'];?></td>
	                                    <td><?php echo $assets['serial_number'];?></td>
	                                    <td><?php echo $assets['lastname'] . ', ' . $assets['firstname'];?></td><!-- . ' ' . $assets['middlename'] -->
	                                    <td><?php echo $assets['location_abbr'];?></td>
	                                    <td><?php echo $assets['date_counted'];?></td>
	                                    <td><?php echo $assets['department_code'];?></td>
	                                    <td><?php echo $assets['is_damaged'];?></td>
	                                </tr>
	                                <?php } ?>
								</tbody>
							</table>
			    		</div>
			    		<div class="row">
			    			<h6 align="right">
			    				<i class="fa fa-square" style="color: #ffcfcf;"></i> Damaged |
			    				<i class="fa fa-square" style="color: #d7ffcf;"></i> Working
			    			</h6>
			    		</div>
			    	</div>
			    </div>
			</div>
		</div>
	</div>
</div>




<div class="modal fade bs-modal-xs" id="sticker_print" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h3 class="modal-title" id="" style="font-weight: bold;">Option</h3>
			</div>
			<div class="modal-body">
				<div class="row">
					<div class="col-md-12">
						<div class="note note-default">
							<!-- <div class="portlet-body"> -->
								<div class="col-md-8" style="margin-top: 20px;">
									<h1 class="bold" id="txt_status"></h1>
								</div>
								<input type="hidden" id="asset_id">
								<div class="col-md-4" style="margin-top: 15px;">
									<button class="btn btn-block btn-default" id="btn_todamaged">
					                    <i class="fa fa-unlink"></i>
					                    <div id="btn_text" style="font-weight: bold;"> MARK DAMAGED</div>
					                </button>
								</div>
								<font color="white" style="">.</font>
							<!-- </div> -->
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="note note-default">
							<div id="sticker_content" style="font-size: 10px;" class="col-md-12">
								<table width="349"><tr>
									<td align="center" style="font-weight: bold;font-size: 12px;"> PROPERTY OF ABCI</td>
								</tr></table>
								<table  width="350" style="table-layout: fixed;"> 
									<tr bgcolor="#d2d2d2" height="10" style="font-size: 8px;">
										<td height="" width="175">DESCRIPTION:</td>
										<td width="175" colspan="2">SERIAL NO:</td>
										<td bgcolor="#ffffff"></td>
									</tr>
									<tr height="20">
										<td style="font-size: 10px;" id="stckr_desc"></td>
										<td style="font-size: 12px;"colspan="2" id="stckr_serno"></td>
										<td></td>
									</tr>
									<tr bgcolor="#d2d2d2" height="10" style="font-size: 8px;">
										<td height="" width="175">CUSTODIAN:</td>
										<td width="175" colspan="2">ASSET NO:</td>
										<td></td>
									</tr>
									<tr height="15">
										<td style="font-size: 10px;" id="stckr_cust"></td>
										<td style="font-size: 12px;"colspan="2" id="stckr_asst"></td>
										<td></td>
									</tr>
									<tr bgcolor="#d2d2d2" height="10" style="font-size: 8px;">
										<td height="" width=175">DEPARTMENT/LOCATION:</td>
										<td width="175" colspan="2">DATE COUNTED:</td>
										<td></td>
									</tr>
									<tr height="20">
										<td style="font-size: 10px;" id="stckr_dept_loc"></td>
										<td style="font-size: 12px;" colspan="2" id="stckr_date"></td>
										<td></td>
									</tr>
									<tr>
										<!-- <td width="200" style="font-size: 12px; font-weight: bold;">Please do not remove this sticker.</td> -->
										<td width="50" style="font-size: 14px; font-weight: bold;" align="right">Tag No:</td>
										<td width="100" style="font-size: 14px; font-weight: bold" id="stckr_tagno"></td>
									</tr>
									<tr>
										<td colspan="3" style="font-size: 14px; font-weight: bold;" align="center">PLEASE DO NOT REMOVE THIS STICKER.</td>
									</tr>
								</table>
							</div>

							<font color="white">.</font>
						</div>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div align="right">
					<button id="confirm_print" class="btn blue">Print Sticker</button>
					<button id="" class="btn red" data-dismiss="modal">close</button>
					
				</div>
			</div>
		</div>
	</div>
</div>