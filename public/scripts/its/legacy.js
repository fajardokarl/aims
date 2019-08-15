var masterlist = function(){
	var _init = function(){
		var d = new Date();
		var month = ((d.getMonth()+1)<10? '0'+(d.getMonth()+1):(d.getMonth()+1));
		$('#date_start').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
		}).datepicker('setDate', d);
		$('#date_end').datepicker({
			format: 'yyyy-mm-dd',
			autoclose: true,
		}).datepicker('setDate', d);

		$('#btn_xls').on('click', function(){
			switch($('#input_control').val()){
				case 'uomitem':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsUomitem",
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
				case 'agingreceivables':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsAgingReceivables",
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
				case 'poserved':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsPOServed",
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
				case 'prosdb':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsProsdb",
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
				case 'customerpaymentledger':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsCustomerPaymentLedger",
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
				case 'breakdowncollectedsales':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsBreakdownCollectedSales",
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
				case 'porange':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsPORange",
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
				case 'costfactor':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsCostFactor",
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
				case 'inventorymovement':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsInventoryMovement",
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
				case 'inventorysummaryperproject':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsInventorySummaryPerProject",
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
				case 'inventorysummaryperwarehouse':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsInventorySummaryPerWarehouse",
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
				case 'inventoryperproject':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsInventoryPerProject",
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
				case 'dcrwithsundry':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsDCRWithSundry",
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
				case 'dcrnosundry':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsDCRNoSundry",
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
				case 'inputtax':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsInputTax",
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
				case 'outputtax':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsOutputTax",
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
				case 'accumulateddepreciation':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsAccumulatedDepreciation",
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
				case 'ewt':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsEWT",
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
				case 'lapsing':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsLapsing",
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
				case 'inventory17081':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsInventory17081",
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
				case 'checkvoucher':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsCheckVoucher",
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
				case 'rr152010':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsRR152010",
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
				case 'bankrecon':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsBankRecon",
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
				case 'reservationlisting':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsReservationListing",
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
				case 'mrisissuance':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsMRISIssuance",
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
				case 'dmcmentry':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsDMCMEntry",
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
				case 'collectionentry':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsCollectionEntry",
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
				case 'departmentexpenses':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsDepartmentExpenses",
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
				case 'cip':
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsCIP",
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
				case 'unbalancedentries':
          console.log($('#date_start').val());
					$.ajax({
            type: "POST",
            url:  baseurl + "its/Legacy/xlsUnbalancedEntries",
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
				case 'uomitem':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_uomitem').show();
					$('#tbl_uomitem').DataTable().destroy();
					getUomitem();
				break;
				case 'agingreceivables':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_agingreceivables').show();
					$('#tbl_agingreceivables').DataTable().destroy();
					getAgingReceivables();
				break;
				case 'poserved':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_poserved').show();
				break;
				case 'prosdb':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_prosdb').show();
					$('#tbl_prosdb').DataTable().destroy();
					getProsdb();
				break;
				case 'customerpaymentledger':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_customerpaymentledger').show();
					$('#tbl_customerpaymentledger').DataTable().destroy();
					getCustomerPaymentLedger();
				break;
				case 'breakdowncollectedsales':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_breakdowncollectedsales').show();
					$('#tbl_breakdowncollectedsales').DataTable().destroy();
					getBreakdownCollectedSales();
				break;
				case 'porange':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_porange').show();
				break;
				case 'costfactor':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_costfactor').show();
					$('#tbl_costfactor').DataTable().destroy();
					getCostFactor();
				break;
				case 'inventorymovement':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_inventorymovement').show();
				break;
				case 'inventorysummaryperproject':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_inventorysummaryperproject').show();
				break;
				case 'inventorysummaryperwarehouse':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_inventorysummaryperwarehouse').show();
					$('#tbl_inventorysummaryperwarehouse').DataTable().destroy();
					getInventorySummaryPerWarehouse();
				break;
				case 'inventoryperproject':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_inventoryperproject').show();
					$('#tbl_inventoryperproject').DataTable().destroy();
					getInventoryPerProject();
				break;
				case 'dcrwithsundry':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_dcrwithsundry').show();
				break;
				case 'dcrnosundry':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_dcrnosundry').show();
				break;
				case 'inputtax':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_inputtax').show();
				break;
				case 'outputtax':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_outputtax').show();
				break;
				case 'accumulateddepreciation':
					$('#frm_searchrange').hide();
					hideAllTable();
					$('#tbl_accumulateddepreciation').show();
					$('#tbl_accumulateddepreciation').DataTable.destroy();
					getAccumulatedDepreciation();
				break;
				case 'ewt':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_ewt').show();
				break;
				case 'lapsing':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_lapsing').show();
				break;
				case 'inventory17081':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_inventory17081').show();
				break;
				case 'checkvoucher':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_checkvoucher').show();
				break;
				case 'rr152010':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_rr152010').show();
				break;
				case 'bankrecon':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_bankrecon').show();
				break;
				case 'reservationlisting':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_reservationlisting').show();
				break;
				case 'mrisissuance':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_mrisissuance').show();
				break;
				case 'dmcmentry':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_dmcmentry').show();
				break;
				case 'collectionentry':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_collectionentry').show();
				break;
				case 'departmentexpenses':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_departmentexpenses').show();
				break;
				case 'cip':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_cip').show();
				break;
				case 'unbalancedentries':
					$('#frm_searchrange').show();
					hideAllTable();
					$('#tbl_unbalancedentries').show();
				break;
			}
		});

		$('#btn_searchrange').on('click', function(){
			if ($('#date_start').val().length > 0 && $('#date_end').val().length > 0) {
				switch($('#input_control').val()){
					case 'poserved':
						$('#tbl_poserved').DataTable().destroy();
						getPoserved();
					break;
					case 'porange':
						$('#tbl_porange').DataTable().destroy();
						getPORange();
					break;
					case 'inventorymovement':
						$('#tbl_inventorymovement').DataTable().destroy();
						getInventoryMovement();
					break;
					case 'inventorysummaryperproject':
						$('#tbl_inventorysummaryperproject').DataTable().destroy();
						getInventorySummaryPerProject();
					break;
					case 'dcrwithsundry':
						$('#tbl_dcrwithsundry').DataTable().destroy();
						getDCRWithSundry();
					break;
					case 'dcrnosundry':
						$('#tbl_dcrnosundry').DataTable().destroy();
						getDCRNoSundry();
					break;
					case 'inputtax':
						$('#tbl_inputtax').DataTable().destroy();
						getInputTax();
					break;
					case 'outputtax':
						$('#tbl_outputtax').DataTable().destroy();
						getOutputTax();
					break;
					case 'ewt':
						$('#tbl_ewt').DataTable().destroy();
						getEWT();
					break;
					case 'lapsing':
						$('#tbl_lapsing').DataTable().destroy();
						getLapsing();
					break;
					case 'inventory17081':
						$('#tbl_inventory17081').DataTable().destroy();
						getInventory17081();
					break;
					case 'checkvoucher':
						$('#tbl_checkvoucher').DataTable().destroy();
						getCheckVoucher();
					break;
					case 'rr152010':
						$('#tbl_rr152010').DataTable().destroy();
						getRR152010();
					break;
					case 'bankrecon':
						$('#tbl_bankrecon').DataTable().destroy();
						getBankRecon();
					break;
					case 'reservationlisting':
						$('#tbl_reservationlisting').DataTable().destroy();
						getReservationListing();
					break;
					case 'mrisissuance':
						$('#tbl_mrisissuance').DataTable().destroy();
						getMRISIssuance();
					break;
					case 'dmcmentry':
						$('#tbl_dmcmentry').DataTable().destroy();
						getDMCMEntry();
					break;
					case 'collectionentry':
						$('#tbl_collectionentry').DataTable().destroy();
						getCollectionEntry();
					break;
					case 'departmentexpenses':
						$('#tbl_departmentexpenses').DataTable().destroy();
						getDepartmentExpenses();
					break;
					case 'cip':
						$('#tbl_cip').DataTable().destroy();
						getCIP();
					break;
					case 'unbalancedentries':
						$('#tbl_unbalancedentries').DataTable().destroy();
						getUnbalancedEntries();
					break;
				}
			}
		});

		function getUomitem(){
			$('#tbl_uomitem').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getUomitem',
					type: 'POST'
				},
			});
		}

		function getAgingReceivables(){
			$('#tbl_agingreceivables').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getAgingReceivables',
					type: 'POST'
				},
			});
		}

		function getPoserved(){
			$('#tbl_poserved').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getPoserved',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getProsdb(){
			$('#tbl_prosdb').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getProsdb',
					type: 'POST'
				},
			});
		}

		function getCustomerPaymentLedger(){
			$('#tbl_customerpaymentledger').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getCustomerPaymentLedger',
					type: 'POST'
				},
			});
		}

		function getBreakdownCollectedSales(){
			$('#tbl_breakdowncollectedsales').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getBreakdownCollectedSales',
					type: 'POST'
				},
			});
		}

		function getPORange(){
			$('#tbl_porange').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getPORange',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getCostFactor(){
			$('#tbl_costfactor').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getCostFactor',
					type: 'POST'
				},
			});
		}

		function getInventoryMovement(){
			$('#tbl_inventorymovement').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getInventoryMovement',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getInventorySummaryPerProject(){
			$('#tbl_inventorysummaryperproject').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getInventorySummaryPerProject',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getInventorySummaryPerWarehouse(){
			$('#tbl_inventorysummaryperwarehouse').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getInventorySummaryPerWarehouse',
					type: 'POST'
				},
			});
		}

		function getInventoryPerProject(){
			$('#tbl_inventoryperproject').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getInventoryPerProject',
					type: 'POST'
				},
			});
		}

		function getDCRWithSundry(){
			$('#tbl_dcrwithsundry').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getDCRWithSundry',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getDCRNoSundry(){
			$('#tbl_dcrnosundry').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getDCRNoSundry',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getInputTax(){
			$('#tbl_inputtax').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getInputTax',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getOutputTax(){
			$('#tbl_outputtax').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getOutputTax',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getAccumulatedDepreciation(){
			$('#tbl_ewt').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getEWT',
					type: 'POST'
				},
			});
		}

		function getEWT(){
			$('#tbl_ewt').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getEWT',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getLapsing(){
			$('#tbl_lapsing').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getLapsing',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getInventory17081(){
			$('#tbl_inventory17081').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getInventory17081',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getCheckVoucher(){
			$('#tbl_checkvoucher').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getCheckVoucher',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getRR152010(){
			$('#tbl_rr152010').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getRR152010',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getBankRecon(){
			$('#tbl_bankrecon').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getBankRecon',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getReservationListing(){
			$('#tbl_reservationlisting').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getReservationListing',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getMRISIssuance(){
			$('#tbl_mrisissuance').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getMRISIssuance',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getDMCMEntry(){
			$('#tbl_dmcmentry').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getDMCMEntry',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getCollectionEntry(){
			$('#tbl_collectionentry').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getCollectionEntry',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});	
		}

		function getDepartmentExpenses(){
			$('#tbl_departmentexpenses').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getDepartmentExpenses',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getCIP(){
			$('#tbl_cip').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getCIP',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function getUnbalancedEntries(){
			$('#tbl_unbalancedentries').DataTable({
				'processing': true,
				'serverSide': true,
				//'destroy': true,
				'paging': false,
				'bInfo': false,
				'bSort': false,
				'order': [],
				'ajax': {
					url: baseurl+'its/Legacy/getUnbalancedEntries',
					type: 'POST',
					data: {'date_start': $('#date_start').val(), 'date_end': $('#date_end').val()}
				},
			});
		}

		function hideAllTable(){
			$('#tbl_agingreceivables').hide();
			$('#tbl_poserved').hide();
			$('#tbl_prosdb').hide();
			$('#tbl_customerpaymentledger').hide();
			$('#tbl_breakdowncollectedsales').hide();
			$('#tbl_porange').hide();
			$('#tbl_costfactor').hide();
			$('#tbl_inventorymovement').hide();
			$('#tbl_inventorysummaryperproject').hide();
			$('#tbl_inventorysummaryperwarehouse').hide();
			$('#tbl_inventoryperproject').hide();
			$('#tbl_dcrwithsundry').hide();
			$('#tbl_dcrnosundry').hide();
			$('#tbl_inputtax').hide();
			$('#tbl_outputtax').hide();
			$('#tbl_accumulateddepreciation').hide();
			$('#tbl_ewt').hide();
			$('#tbl_lapsing').hide();
			$('#tbl_inventory17081').hide();
			$('#tbl_checkvoucher').hide();
			$('#tbl_rr152010').hide();
			$('#tbl_bankrecon').hide();
			$('#tbl_reservationlisting').hide();
			$('#tbl_mrisissuance').hide();
			$('#tbl_dmcmentry').hide();
			$('#tbl_departmentexpenses').hide();
			$('#tbl_cip').hide();
			$('#tbl_unbalancedentries').hide();
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