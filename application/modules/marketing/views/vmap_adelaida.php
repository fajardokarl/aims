<div class="page-content"> 
    <div class="row">
    	<div class="" style="position: absolute; z-index: 1000">
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
	        	<div id="vmap" style="width: 960px; height: 640px; border-style: ridge; position: relative; top: 0; left: 0; z-index: 900; opacity: 0.5" ></div>
	        	<!-- <img src="<?=base_url()?>\public\images\APR_SalesMap_012618.jpg" style="width: 960px; height: 640px; border-style: ridge; position: relative; margin-top: -660px; left: 0;"> -->
        </div>
    </div>
</div>

<div class="modal fade bs-modal-xs" id="lot_detail" data-backdrop="static" data-keyboard="false" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-xs">
		<div class="modal-content">
			<div class="modal-header">
				<!-- <button type="button" class="close" data-dismiss="modal"></button> -->
				<h3 class="modal-title" id="">LOT DETAILS</h3>
			</div>
			<div class="modal-body">
				<h4><span id="lot_desc"></span></h4>
				<div class="row">
					<div class="col-md-12">
						<table class="table table-striped table-advance">
							<tr>
								<td class="highlight"><span class="font bold">TCP:</span></td>
								<td align="right"><span id="map_tcp"></span></td>
								<td></td>
							</tr>
							<tr>
								<td class="highlight"><span class="font bold">Lot Area:</span></td>
								<td align="right"><span id="map_lotarea" > </span></td>
								<td></td>
							</tr>
							<tr>
								<td class="highlight"><span class="font bold">Price/Sq m:</span></td>
								<td align="right"><span id="map_ppsqm"></span></td>
								<td></td>
							</tr>
							<tr>
								<td class="highlight"><span class="font bold">House Price:</span></td>
								<td align="right"><span id="map_hprice"></span></td>
								<td></td>
							</tr>
						</table>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="portlet box red" id="map_portlet_contract">
                            <div class="portlet-title">
                                <div class="caption"><i class="fa fa-gift"></i>Contract</div>
                                <div class="tools">
                                    <a href="javascript:;" class="expand" data-original-title="" title="" id="collapsible" > </a>
                                </div>
                            </div>
                            <div class="portlet-body portlet-collapsed" style="display: none;" id="col_body">
                                <table class="table table-striped table-advance">
									<tr>
										<td class="highlight"><span class="font bold">Contract No:</span></td>
										<td align="right"><span id="map_contno"></span></td>
										<td></td>
									</tr>
									<tr>
										<td class="highlight"><span class="font bold">Customer Name:</span></td>
										<td align="right"><span id="map_custname" > </span></td>
										<td></td>
									</tr> 
									<tr>
										<td class="highlight"><span class="font bold">Contract Date:</span></td>
										<td align="right"><span id="map_contadate"></span></td>
										<td></td>
									</tr>
									<tr>
										<td class="highlight"><span class="font bold">Plan Type:</span></td>
										<td align="right"><span id="map_plantype"></span></td>
										<td></td>
									</tr>
									<tr>
										<td class="highlight"><span class="font bold">Booked:</span></td>
										<td align="right"><span id="map_booked"></span></td>
										<td></td>
									</tr>
									<tr>
										<td class="highlight"><span class="font bold">Invoiced:</span></td>
										<td align="right"><span id="map_invoiced"></span></td>
										<td></td>
									</tr>
								</table>
                            </div>
                        </div>
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



<!-- <div class="portlet box red">
	<div class="portlet-title">
	    <div class="caption">
	        <i class="fa fa-gift"></i>Unordered Lists </div>
	    <div class="tools">
	        <a href="javascript:;" class="collapse" data-original-title="" title=""> </a>
	    </div>
	</div>
	<div class="portlet-body" style="display: block;">
	    <ul>
	        <li> Lorem ipsum dolor sit amet </li>
	        <li> Consectetur adipiscing elit </li>
	        <li> Integer molestie lorem at massa </li>
	        <li> Facilisis in pretium nisl aliquet </li>
	        <li> Nulla volutpat aliquam velit
	            <ul>
	                <li> Phasellus iaculis neque </li>
	                <li> Purus sodales ultricies </li>
	                <li> Vestibulum laoreet porttitor sem </li>
	                <li> Ac tristique libero volutpat at </li>
	            </ul>
	        </li>
	        <li> Faucibus porta lacus fringilla vel </li>
	        <li> Aenean sit amet erat nunc </li>
	        <li> Eget porttitor lorem </li>
	    </ul>
	</div>
</div> -->