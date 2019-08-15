<div class="page-content"> 
    <div class="row">
    	<div class="" style="position: absolute; z-index: 50">
    		<div class="portlet box dark" id="">
                <div class="portlet-title">
                	<div class="caption">
	                	LEGEND
                		
                	</div>
                </div>
                <div class="portlet-body">
                    	<table class="tbl">
                    		<tr>
                    			<td><span class="font-red"><i class="fa fa-square"></i></i></span></td>
                    			<td> </td>
                    			<td><span class="font-red uppercase bold"> Sold </span></td>
                    		</tr>
                    		<tr>
                     			<td><span class="font-green-jungle"><i class="fa fa-square"></i></i></span></td>
                    			<td> </td>
                    			<td><span class="font-green-jungle uppercase bold"> Vacant </span></td>
                    		</tr>
                    		<tr>
                     			<td><span class="font-yellow-saffron"><i class="fa fa-square"></i></i></span></td>
                    			<td> </td>
                    			<td><span class="font-yellow-saffron uppercase bold"> Selected </span></td>
                    		</tr>
                    	</table>
				</div>
            </div>
    	</div>
        <div class="col-md-12" align="center">
	        	<img src="<?=base_url()?>\public\images\IGNATIUS-ENCLAVE-Model.jpg" style="width: 1224px; height: 792px; left: 0;z-index: 10;">
	        	<div id="vmap" style="width: 1224px; height: 792px; z-index: 11; opacity: .8; margin-top: -792px;" ></div>
        </div>
    </div>
</div>

<div class="modal fade bs-modal-xs" id="lot_detail" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h3 class="modal-title" id="">LOT DETAILS</h3>
				<h4><span id="house_lot"></span></h4>
			</div>
			<div class="modal-body">
				<h4><span id="lot_desc"></span></h4>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-advance">
							<!-- <tr>
								<td class="highlight"><span class="font bold">TCP:</span></td>
								<td align="right"><span id="map_tcp"></span></td>
								<td></td>
							</tr> -->
							<tr id="pic_cont">
								<td align="center">
									<div class="" align="center" >
										<img class="img-thumbnail" id="house_pic" src="" height="300px" width="400px">
									</div>
								</td>
								<td></td>
								<td></td>
							</tr>
							<tr>
								<td class="highlight"><span class="font bold">Lot Area:</span></td>
								<td align="right"><span id="map_lotarea" > </span></td>
								<td></td>
							</tr>
							<tr>
								<td class="highlight"><span class="font bold">Floor Area:</span></td>
								<td align="right"><span id="map_floorarea" > </span></td>
								<td></td>
							</tr>
					
						</table>
					</div>
				</div>
			</div>
			<div class="modal-footer">
				<div align="right">
					<!-- <button id="confirm_save_items" class="btn blue">Confirm</button> -->
					<button id="" class="btn red" data-dismiss="modal" id="close_mapdet">Close</button>
					
				</div>
			</div>
		</div>
	</div>
</div>
