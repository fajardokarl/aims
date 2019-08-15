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
					<button style="align: right;" type="button" class="btn btn-circle green hidden-print" id="btn_xls"><span class="fa fa-print"></span>EXCEL</button>
				</div>
			</div>
			<div class="portlet-body">
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
						<table class="table table-hover table-bordered table-striped" id="tbl_vendors" style="display: none;">
							<thead>
								<tr>
									<th>Vendor ID</th>
									<th>Vendor Name</th>
									<th>Line 1</th>
									<th>Line 2</th>
									<th>City Zip</th>
									<th>Contact</th>
									<th>Telephone 1</th>
									<th>Telephone 2</th>
									<th>Fax Number</th>
									<th>1099 Type</th>
									<th>TIN</th>
									<th>Terms</th>
									<th>Vend Since</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_vendorledger" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Vendor ID</th>
									<th style="width: 10%;">Vendor Name</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Trans No</th>
									<th style="width: 10%;">Type</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_transactionreport" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Type</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">ID</th>
									<th style="width: 10%;">Name</th>
									<th style="width: 10%;">Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_salesjournal" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Invoice No</th>
									<th style="width: 10%;">Line Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_salesinvoice" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Customer ID</th>
									<th style="width: 10%;">Invoice No</th>
									<th style="width: 10%;">Period</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Status</th>
									<th style="width: 10%;">Invoice Total</th>
									<th style="width: 10%;">Net Due</th>
									<th style="width: 10%;">Customer Name</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_receiptlist" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Vendor ID</th>
									<th style="width: 10%;">Vendor Name</th>
									<th style="width: 10%;">Receipt No</th>
									<th style="width: 10%;">Period</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Receipt Amount</th>
									<th style="width: 10%;">Deposit Ticket ID</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_purchasejournal" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Account Description</th>
									<th style="width: 10%;">Invoice No</th>
									<th style="width: 10%;">Line Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_invoiceregister" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Invoice No</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Quote No</th>
									<th style="width: 10%;">Name</th>
									<th style="width: 10%;">Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_glmanilaoffice" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Account Description</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Trans Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_generalledger" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Account Description</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Trans Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
								</tr>
							</thead>	
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_fixedassets" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Account Description</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Journal</th>
									<th style="width: 10%;">Trans Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
								</tr>
							</thead>	
							<tbody>
								
							</tbody>
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_ewt" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Account Description</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Journal</th>
									<th style="width: 10%;">Trans Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
									<th style="width: 10%;">Job ID</th>
								</tr>
							</thead>	
							<tbody>
								
							</tbody>
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_cibubp" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Journal</th>
									<th style="width: 20%;">Trans Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
									<th style="width: 10%;">Job ID</th>
								</tr>
							</thead>	
							<tbody>
								
							</tbody>
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_checkregister" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Check No</th>
									<th style="width: 10%;">Date</th>
									<th style="width: 20%;">Payee</th>
									<th style="width: 10%;">Cash Account</th>
									<th style="width: 10%;">Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						<table class="table table-hover table-bordered table-striped" id="tbl_cashreceiptsjournal" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Account ID</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 30%;">Line Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_cashdisbursementjournal" style="display: none;"> 
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Check No</th>
									<th style="width: 30%;">Line Description</th>
									<th style="width: 10%;">Account Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_retitlinglot" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Reference</th>
									<th style="width: 10%;">Journal</th>
									<th style="width: 30%;">Trans Description</th>
									<th style="width: 10%;">Debit Amount</th>
									<th style="width: 10%;">Credit Amount</th>
									<th style="width: 10%;">Balance</th>
								</tr>
							</thead>
							<tbody>
								
							</tbody>
						</table>
						
						<table class="table table-hover table-bordered table-striped" id="tbl_generaljournal" style="display: none;">
							<thead>
								<tr>
									<th style="width: 10%;">Date</th>
									<th style="width: 10%;">Peachtree Account ID</th>
									<th style="width: 15%;">Reference</th>
									<th style="width: 30%">Trans Description</th>
									<th style="width: 10%">Debit Amount</th>
									<th style="width: 10%">Credit Amount</th>
								</tr>
							</thead>
							<tbody>

							</tbody>
						</table>

						<table class="table table-hover table-bordered table-striped" id="tbl_customer" style="display: none;">
							<thead>
								<tr>
									<td>Customer ID</td>
									<td>Customer</td>
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
</div>
