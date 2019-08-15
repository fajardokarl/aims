var masterlist = function(){
	var _init = function(){
		var tbl_data = [];
		var d = new Date();
		var month = ((d.getMonth()+1)<10? '0'+(d.getMonth()+1):(d.getMonth()+1));
		$('#date_start').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
		}).datepicker('setDate', '2000-01-01');
		$('#date_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
		}).datepicker('setDate', '2014-12-31');

		$('#btn_xls').on('click', function(){
			switch($('#input_control').val()){
				case 'vendorledger':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsVendorLedger",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'transactionreport':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsTransactionReport",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'salesjournal':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsSalesJournal",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'salesinvoice':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsSalesInvoice",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'receiptlist':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsReceiptList",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'purchasejournal':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsPurchaseJournal",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'invoiceregister':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsInvoiceRegister",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'glmanilaoffice':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsGLManilaOffice",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'generalledger':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsGeneralLedger",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'fixedassets':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsFixedAssets",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'ewt':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsEWT",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'cibubp':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsCIBUBP",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'checkregister':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsCheckRegister",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'cashreceiptsjournal':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsCashReceiptsJournals",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'cashdisbursementjournal':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsCashDisbursementJournal",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'retitlinglot':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsRetitlingLots",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'customer':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsCustomers",
            data: {},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'vendor':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsVendors",
            data: {},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
				case 'generaljournal':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Peachtree/xlsGeneralJournals",
            data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()},
            success: function(data){
              console.log('done');
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        	});
				break;
			}
		});

		$(window).load(function(){
			switch($('#input_control').val()){
				case 'vendorledger':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_vendorledger').show();
				break;
				case 'transactionreport':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_transactionreport').show();
				break;
				case 'salesjournal':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_salesjournal').show();
				break;
				case 'salesinvoice':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_salesinvoice').show();
				break;
				case 'receiptlist':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_receiptlist').show();
				break;
				case 'purchasejournal':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_purchasejournal').show();
				break;
				case 'invoiceregister':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_invoiceregister').show();
				break;
				case 'glmanilaoffice':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_glmanilaoffice').show();
				break;
				case 'generalledger':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_generalledger').show();
				break;
				case 'fixedassets':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_fixedassets').show();
				break;
				case 'ewt':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_ewt').show();
				break;
				case 'cibubp':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_cibubp').show();
				break;
				case 'checkregister':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_checkregister').show();
				break;
				case 'cashreceiptsjournal':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_cashreceiptsjournal').show();
				break;
				case 'cashdisbursementjournal':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_cashdisbursementjournal').show();
				break;
				case 'retitlinglot':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_retitlinglot').show();
				break;
				case 'customer':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_customer').show();

					$('#tbl_customer').DataTable({
						'processing': true,
						'paging': false,
						'bInfo': false,
						'bSort': false,
						'order': [],
						'ajax': {
							url: baseurl+'its/Peachtree/getCustomers',
							type: 'POST',
							data: {}
						},
					});
				break;
				case 'vendor':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_vendors').show();

					$('#tbl_vendors').DataTable({
						'processing': true,
						'paging': false,
						'bInfo': false,
						'bSort': false,
						'order': [],
						'ajax': {
							url: baseurl+'its/Peachtree/getVendors',
							type: 'POST',
							data: {}
						},
					});

					$('#tbl_vendors_filter input').focus();
				break;
				case 'generaljournal':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_generaljournal').show();
				break;
			}
		});

		$('#tbl_vendors_filter input').on('keydown', function(e){
			switch(e.which){
				case 37:
					e.preventDefault();
					tbl_vendors.page('previous').draw('page');
				break;
				case 39:
					e.preventDefault();
					tbl_vendors.page('next').draw('page');
				break;
			}
		});

		function searchVL(){
			$('#tbl_vendorledger').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getVendorLedger',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchTR(){
			$('#tbl_transactionreport').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getTransactionReport',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchSJ(){
			$('#tbl_salesjournal').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getSalesJournal',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchSI(){
			$('#tbl_salesinvoice').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getSalesInvoice',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchRCL(){
			$('#tbl_receiptlist').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getReceiptList',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchPJ(){
			$('#tbl_purchasejournal').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getPurchaseJournal',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchIR(){
			$('#tbl_invoiceregister').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getInvoiceRegister',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchGLMO(){
			$('#tbl_glmanilaoffice').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getGLManilaOffice',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchGL(){
			$('#tbl_generalledger').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getGeneralLedger',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchFA(){
			$('#tbl_fixedassets').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getFixedAssets',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchEWT(){
			$('#tbl_ewt').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getEWT',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchCIB(){
			$('#tbl_cibubp').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getCIBUBP',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchCR(){
			$('#tbl_checkregister').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getCheckRegisters',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val() }
				}
			});
		}

		function searchCRJ(){
			var date_start = $('#date_start').val();
			var date_end = $('#date_end').val();
			$('#tbl_cashreceiptsjournal').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getCashReceiptsJournals',
					type: 'POST',
					data: {'date_start': date_start, 'date_end': date_end }
				}
			});
		}

		function searchCDJ(){
			$('#tbl_cashdisbursementjournal').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'bPaginate': true,
				'bLengthChange': true,
				'aLengthMenu': [[10,50,100,-1],[10,50,10,'All']],
				'iDisplayLength': 10,
				fixedHeader: {
					header: false,
				},
				'ajax': {
					url: baseurl+'its/Peachtree/getCashDisbursementJournals',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()} 
				}
			});
		}

		function searchRL(){
			$('#tbl_retitlinglot').DataTable({
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getRetitlingLots',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function searchGJ(){
			var tbl_generaljournal = $('#tbl_generaljournal').DataTable({			
				'processing': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Peachtree/getGeneralJournals', 
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});		
		}
		
		$('#btn_searchrange').on('click', function(){
			if ($('#date_start').val().length > 0 && $('#date_end').val().length > 0){
				switch($('#input_control').val()){
					case 'vendorledger':
						$('#tbl_vendorledger').DataTable().destroy();
						searchVL();
					break;
					case 'transactionreport':
						$('#tbl_transactionreport').DataTable().destroy();
						searchTR();
					break;
					case 'salesjournal':
						$('#tbl_salesjournal').DataTable().destroy();
						searchSJ();
					break;
					case 'salesinvoice':
						$('#tbl_salesinvoice').DataTable().destroy();
						searchSI();
					break;
					case 'receiptlist':
						$('#tbl_receiptlist').DataTable().destroy();
						searchRCL();
					break;
					case 'purchasejournal':
						$('#tbl_purchasejournal').DataTable().destroy();
						searchPJ();
					break;
					case 'invoiceregister':
						$('#tbl_invoiceregister').DataTable().destroy();
						searchIR();
					break;
					case 'glmanilaoffice':
						$('#tbl_glmanilaoffice').DataTable().destroy();
						searchGLMO();
					break;
					case 'generalledger':
						$('#tbl_generalledger').DataTable().destroy();
						searchGL();
					break;
					case 'fixedassets':
						$('#tbl_fixedassets').DataTable().destroy();
						searchFA();
					break;
					case 'ewt':
						$('#tbl_ewt').DataTable().destroy();
						searchEWT();
					break;
					case 'cibubp':
						$('#tbl_cibubp').DataTable().destroy();
						searchCIB();
					break;
					case 'checkregister':
						$('#tbl_checkregister').DataTable().destroy();
						searchCR();
					break;
					case 'cashreceiptsjournal':
						$('#tbl_cashreceiptsjournal').DataTable().destroy();
						searchCRJ();
					break;
					case 'cashdisbursementjournal':
						$('#tbl_cashdisbursementjournal').DataTable().destroy();
						searchCDJ();
					break;
					case 'retitlinglot':
						$('#tbl_retitlinglot').DataTable().destroy();				
						searchRL();
					break;
					case 'generaljournal':
						$('#tbl_generaljournal').DataTable().destroy();
						searchGJ();
					break;
				}
			}
		});

		function hideAllTable(){
			$('#tbl_vendors').hide();
			$('#tbl_vendorledger').hide();
			$('#tbl_transactionreport').hide();
			$('#tbl_salesjournal').hide();
			$('#tbl_salesinvoice').hide();
			$('#tbl_receiptlist').hide();
			$('#tbl_purchasejournal').hide();
			$('#tbl_invoiceregister').hide();
			$('#tbl_glmanilaoffice').hide();
			$('#tbl_generalledger').hide();
			$('#tbl_fixedassets').hide();
			$('#tbl_ewt').hide();
			$('#tbl_cibubp').hide();
			$('#tbl_checkregister').hide();
			$('#tbl_cashreceiptsjournal').hide();
			$('#tbl_cashdisbursementjournal').hide();
			$('#tbl_customer').hide();
			$('#tbl_generaljournal').hide();
			$('#tbl_retitlinglot').hide();
		}

	}
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	masterlist.init();
});