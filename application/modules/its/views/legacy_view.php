<input type="hidden" name="input_control" id="input_control" value="<?= $input_control;?>">
<div class="row" id="frm_masterlist">
	<div class="col-md-12">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption font-green-sharp">
					<i class="fa fa-book font-green-sharp"></i>
					<span class="caption-subject bold uppercase">Masterlist</span>
				</div>
				<div class="actions">
					<button style="align: right;" type="button" class="btn btn-circle green hidden-print" id="btn_xls"><span class="fa fa-print"></span> EXCEL</button>
				</div>
			</div>
			<div class="portlet-body">
				<!-- <div class="row" id="frm_field">
					<div class="col-md-12">
						<div class="form-group">
							<div class="form-inline">
								<label id="lbl_field"></label>
								<input type="text" name="inp_field" id="inp_field" class="form-control">
							</div>
						</div>
					</div>
				</div> -->
				<div class="row" id="frm_searchrange">
					<div class="col-md-12">
						<div class="form-group">
							<div class="form-inline">
								Date Start:
								<input type="text" name="date_start" id="date_start" class="form-control">
								Date End:
								<input type="text" name="date_end" id="date_end" class="form-control">
								<button type="button" id="btn_searchrange" class="btn btn-default green">Search Range</button>
							</div>
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">

						<table class="table table-hover table-bordered table-striped" id="tbl_uomitem" style="display: none;">
							<thead>
								<tr>
									<th>Item ID</th>
									<th>Item Number</th>
									<th>Category Code</th>
									<th>Item Description</th>
									<th>Measure ID</th>
									<th>UOM ID</th>
									<th>UOM Description</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_agingreceivables" style="display: none;">
							<thead>
								<tr>
									<th>Contract ID</th>
									<th>Customer Name</th>
									<th>Lot ID</th>
									<th>Category Title</th>
									<th>Phase Title</th>
									<th>Line Desc</th>
									<th>Amortization Date</th>
									<th>Pay Date</th>
									<th>Amortization Amount</th>
									<th>Principal</th>
									<th>Outstanding Balance</th>
									<th>Principal Pay</th>
									<th>Unpaid Amortization</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_poserved" style="display: none;">
							<thead>
								<tr>
									<th>PO Date</th>
									<th>PO Number</th>
									<th>Supplier ID</th>
									<th>Fullname</th>
									<th>PO Amount</th>
									<th>RR Amount</th>
									<th>Balance to be Received</th>
									<th>Status</th>
									<th>Project</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_prosdb" style="display: none;">
							<thead>
								<tr>
									<th>Cust ID</th>
									<th>Customer Name</th>
									<th>TCP Amount</th>
									<th>Contract Date</th>
									<th>Rest Date</th>
									<th>Sold Date</th>
									<th>CP Name</th>
									<th>CP Position</th>
									<th>Contact Number</th>
									<th>Email Add</th>
									<th>Province</th>
									<th>City</th>
									<th>Brgy</th>
									<th>Street</th>
									<th>hpictfilenm</th>
									<th>spictfilenm</th>
									<th>Active</th>
									<th>RC</th>
									<th>RM</th>
									<th>RCU</th>
									<th>RMU</th>
									<th>Branch</th>
									<th>TIN</th>
									<th>Street2</th>
									<th>Brgy2</th>
									<th>City2</th>
									<th>Province2</th>
									<th>Business</th>
									<th>Fax Number</th>
									<th>Fund Source</th>
									<th>Birthday</th>
									<th>Place of Birth</th>
									<th>Nationality</th>
									<th>Gender</th>
									<th>Civil Status</th>
									<th>Dependents</th>
									<th>Employer</th>
									<th>Job Title</th>
									<th>Occupation</th>
									<th>Gross Income</th>
									<th>Birthday2</th>
									<th>TIN2</th>
									<th>Business Phone2</th>
									<th>Contact2</th>
									<th>Email Add2</th>
									<th>Employer2</th>
									<th>Job Title2</th>
									<th>Personal2</th>
									<th>Send To</th>
									<th>Old Acct</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_customerpaymentledger" style="display: none;">
							<thead>
								<tr>
									<th>Payment ID</th>
									<th>Cust ID</th>
									<th>Lot ID</th>
									<th>Lot Description</th>
									<th>Lot Area</th>
									<th>Area Cost</th>
									<th>TCP</th>
									<th>With House</th>
									<th>Customer Name</th>
									<th>Pay Date</th>
									<th>Reference</th>
									<th>Amount</th>
									<th>Interest</th>
									<th>Principal</th>
									<th>Surcharge</th>
									<th>Vat Amount</th>
									<th>New Balance</th>
									<th>Sundry</th>
									<th>IPS</th>
									<th>Accrued IPS</th>
									<th>IPS New Balance</th>
									<th>Shares</th>
									<th>Contract ID</th>
									<th>Principal Pay</th>
									<th>Vat on Principal</th>
									<th>Int Pay</th>
									<th>Vat on Int</th>
									<th>Sur Pay</th>
									<th>Vat on Sur</th>
									<th>Sundry Pay</th>
									<th>Vat on Sundry</th>
									<th>IPS Pay</th>
									<th>Vat on IPS</th>
									<th>Accrued IPS Pay</th>
									<th>Vat on Accrued IPS Pay</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_breakdowncollectedsales" style="display: none;">
							<thead>
								<tr>
									<th>Reference</th>
									<th>OR Number</th>
									<th>Gl Year</th>
									<th>Transaction Date</th>
									<th>Gl Account No</th>
									<th>Gl Account Description</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Remarks</th>
									<th>Branch</th>
									<th>Deferred?</th>
									<th>Contract ID</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_porange" style="display: none;">
							<thead>
								<tr>
									<th>Record Number</th>
									<th>PO Number</th>
									<th>PO Date</th>
									<th>Entry Date</th>
									<th>Status</th>
									<th>Supplier ID</th>
									<th>Supplier</th>
									<th>Branch</th>
									<th>Encoder</th>
									<th>DR Date</th>
									<th>Terms</th>
									<th>Deliver Address</th>
									<th>PRF Number</th>
									<th>Canvasser</th>
								</tr>
							</thead>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_costfactor" style="display: none;">
							<thead>
								<tr>
									<th>Category Title</th>
									<th>Phase Title</th>
									<th>Cost Year</th>
									<th>Cost Lot</th>
									<th>Cost Dev</th>
									<th>Cost ID</th>
									<th>Project ID</th>
									<th>Phase ID</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_inventorymovement" style="display: none;">
							<thead>
								<tr>
									<th>Sales Doc Number</th>
									<th>Transaction Date</th>
									<th>Entry Date</th>
									<th>Item ID</th>
									<th>Item Description</th>
									<th>Remarks</th>
									<th>Customer Name</th>
									<th>Transaction Type</th>
									<th>Acitivity Code</th>
									<th>Project</th>
									<th>Activity Description</th>
									<th>Branch</th>
									<th>Warehouse</th>
									<th>Sales ID</th>
									<th>In Qty</th>
									<th>Out Qty</th>
									<th>Price</th>
									<th>Cost</th>
									<th>Batch Number</th>
									<th>Project Code</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_inventorysummaryperproject" style="display: none;">
							<thead>
								<tr>
									<th>Item ID</th>
									<th>Item Description</th>
									<th>Balance</th>
									<th>Price</th>
									<th>Total Cost</th>
									<th>Branch</th>
									<th>Warehouse</th>
									<th>Batch Number</th>
									<th>Activity Description</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_inventorysummaryperwarehouse" style="display: none;">
							<thead>
								<tr>
									<th>Item ID</th>
									<th>Item Description</th>
									<th>Balance</th>
									<th>Price</th>
									<th>Total Cost</th>
									<th>Branch</th>
									<th>Warehouse</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_inventoryperproject" style="display: none;">
							<thead>
								<tr>
									<th>Sales Doc Number</th>
									<th>Transaction Date</th>
									<th>Entry Date</th>
									<th>Item ID</th>
									<th>Item Description</th>
									<th>Remarks</th>
									<th>Customer Name</th>
									<th>Transaction Type</th>
									<th>Activity Code</th>
									<th>Project</th>
									<th>Activity Description</th>
									<th>Sales ID</th>
									<th>In Qty</th>
									<th>Out Qty</th>
									<th>Price</th>
									<th>Cost</th>
									<th>Batch Number</th>
									<th>Batch ID</th>
									<th>Branch</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_dcrwithsundry" style="display: none;">
							<thead>
								<tr>
									<th>Book Prefix</th>
									<th>OR Number</th>
									<th>Transaction Date</th>
									<th>Book Subsidiary</th>
									<th>Debit</th>
									<th>Cash Amount</th>
									<th>Check Amount</th>
									<th>Bank Deposit</th>
									<th>Credit Card Amount</th>
									<th>Bank Description</th>
									<th>Check Number</th>
									<th>Remarks</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_dcrnosundry" style="display: none;">
							<thead>
								<tr>
									<th>Cust ID</th>
									<th>Customer</th>
									<th>OR Number</th>
									<th>OR Date</th>
									<th>OR Amount</th>
									<th>Cash Amount</th>
									<th>Check Amount</th>
									<th>Bank Deposit Amount</th>
									<th>Credit Card Amount</th>
									<th>Bank ID</th>
									<th>Check Number</th>
									<th>Check Date</th>
									<th>Bank Description</th>
									<th>Collection ID</th>
									<th>Contract ID</th>
									<th>Lot ID</th>
									<th>Lot Description</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_inputtax" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Activity Code</th>
									<th>Activity Description</th>
									<th>Account Description</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Book Prefix</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Record Number</th>
									<th>Remarks</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_outputtax" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Activity Code</th>
									<th>Activity Description</th>
									<th>Account Description</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Book Prefix</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Record Number</th>
									<th>Remarks</th>
									<th>Contract ID</th>
									<th>Lot ID</th>
									<th>Lot Description</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_accumulateddepreciation" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Activity Code</th>
									<th>Activity Description</th>
									<th>Account Description</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Book Prefix</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Record Number</th>
									<th>Remarks</th>
									<th>Book Subsidiary</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_ewt" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Activity Code</th>
									<th>Activity Description</th>
									<th>Account Description</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Record Number</th>
									<th>Remarks</th>
									<th>Book Subsidiary</th>
								</tr>
							</thead>	
							<tbody>
								
							</tbody>
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_lapsing" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Gl Account Description</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Activity Code</th>
									<th>Activity Type</th>
									<th>Activity Description</th>
									<th>Gl Subcode</th>
									<th>Sub Fullname</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Remarks</th>
									<th>Book Subsidiary</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_inventory17081" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Activity Code</th>
									<th>Activity Type</th>
									<th>Activity Description</th>
									<th>Gl Subcode</th>
									<th>Sub Fullname</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Remarks</th>
									<th>Book Subsidiary</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_checkvoucher" style="display: none;">
							<thead>
								<tr>
									<th>Transaction Date</th>
									<th>Reference</th>
									<th>Check Number</th>
									<th>Amount</th>
									<th>Payee</th>
									<th>Remarks</th>
									<th>Gl Account No</th>
									<th>Sub Fullname</th>
									<th>Check Date</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_rr152010" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Gl Activity Code</th>
									<th>Gl Subcode</th>
									<th>Transaction Date</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Reference</th>
									<th>Remarks</th>
									<th>Sub Fullname</th>
									<th>Book Subsidiary</th>
									<th>Activity Description</th>
									<th>Activity Type</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_bankrecon" style="display: none;">
							<thead>
								<tr>
									<th>Transaction Date</th>
									<th>Reference</th>
									<th>Check Number</th>
									<th>Payee</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Remarks</th>
									<th>Gl Account No</th>
									<th>Sub Fullname</th>
									<th>Check Date</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>						
						</table>
	
						<table class="table table-hover table-bordered table-striped" id="tbl_reservationlisting" style="display: none;">
							<thead>
								<tr>
									<th>Contract ID</th>
									<th>Contract Date</th>
									<th>Description</th>
									<th>Lot Description</th>
									<th>Lot Area</th>
									<th>Area Cost</th>
									<th>TCP</th>
									<th>Customer Name</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_mrisissuance" style="display: none;">
							<thead>
								<tr>
									<th>Sales Doc Number</th>
									<th>Transaction Date</th>
									<th>Entry Date</th>
									<th>Item ID</th>
									<th>Item Description</th>
									<th>Remarks</th>
									<th>Customer Name</th>
									<th>Transaction Type</th>
									<th>Activity Code</th>
									<th>Project</th>
									<th>Activity Description</th>
									<th>Batch Number</th>
									<th>Batch ID</th>
									<th>Branch</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_dmcmentry" style="display: none;">
							<thead>
								<tr>
									<th>Gl Book ID</th>
									<th>Gl Book Prefix</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Gl Account No</th>
									<th>Gl Account Description</th>
									<th>Gl Subcode</th>
									<th>Gl Debit</th>
									<th>Gl Credit</th>
									<th>Remarks</th>
									<th>Branch</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_collectionentry" style="display: none;">
							<thead>
								<tr>
									<th>Gl Book Prefix</th>
									<th>Gl Reference</th>
									<th>Transaction Date</th>
									<th>Gl Activity Code</th>
									<th>Gl Account No</th>
									<th>Gl Account Description</th>
									<th>Gl Subcode</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Remarks</th>
									<th>Entry By</th>
								</tr>
							</thead>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_departmentexpenses" style="display: none;">
							<thead>
								<tr>
									<th>Activity Description</th>
									<th>Gl Activity Code</th>
									<th>Gl Account No</th>
									<th>Gl Account Description</th>
									<th>Gl Reference</th>
									<th>Transaction Date</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Remarks</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-bordered table-hover table-striped" id="tbl_cip" style="display: none;">
							<thead>
								<tr>
									<th>Gl Account No</th>
									<th>Reference</th>
									<th>Transaction Date</th>
									<th>Activity Code</th>
									<th>Activity Type</th>
									<th>Activity Description</th>
									<th>Gl Subcode</th>
									<th>Full Name</th>
									<th>Gl Debit</th>
									<th>Gl Credit</th>
									<th>Remarks</th>
									<th>Book Subsidiary</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_unbalancedentries" style="display: none;">
							<thead>
								<tr>
									<th>Book Prefix</th>
									<th>Reference</th>
									<th>Debit</th>
									<th>Credit</th>
									<th>Difference</th>
									<th>Book Subsidiary</th>
									<th>Transaction Date</th>
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