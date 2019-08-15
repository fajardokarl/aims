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
                            <label class="control-label"></label>
                            <div class="">
                                    <input type="date" class="form-control" id="lot_inv_date">
                            </div>
                        </div>
					</div>
				</div>
				<div class="row" align="">
					<div class="col-md-3" align="right">
						<button class="btn blue" type="button" id="lot_inv_generate" > Generate </button>
					</div>
				</div>
			</div>	
		</div>
		<br />
		<div class="row">
			<div class="col-md-12" align="center"">
				<h3 class="caption-subject bold uppercase" id="mancom_title"></h3>
			</div>
		</div>

		<!-- TABLES -->
		<div class="row">
			<div class="col-md-3">
				<h4>&zwnj;</h4>
				<table class="table table-hover table-bordered col-md-3" id="lot_inv_projname">
					<thead>
						<tr>
							<th>Project Name</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			<div class="col-md-3">
				<h4 align="center" class="bold uppercase">Available</h4>
				<table class="table table-hover table-bordered col-md-3" id="lot_inv_available">
					<thead>
						<tr>
							<th>Units</th>
							<th>Area</th>
							<th>TCP</th>
							<th>TCP</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			<div class="col-md-3">
				<h4 align="center" class="bold uppercase">Sold</h4>
				<table class="table table-hover table-bordered col-md-3" id="lot_inv_sold">
					<thead>
						<tr>
							<th>Units</th>
							<th>Area</th>
							<th>TCP</th>
							<th>TCP</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			<div class="col-md-3">
				<h4 align="center" class="bold uppercase">Ending</h4>
				<table class="table table-hover table-bordered col-md-3" id="lot_inv_ending">
					<thead>
						<tr>
							<th>Units</th>
							<th>Area</th>
							<th>TCP</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
		</div>

	</div>
</div>