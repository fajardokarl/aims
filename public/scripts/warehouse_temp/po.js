var po = function(){
	var _init = function(){
	// DATATABLES
		var tbl_po_item = $("#tbl_po_item").DataTable({searching: false, "columnDefs": [
	                    {
	                        "targets": [ 5,6 ],
	                        "visible": false,
	                        "searchable": false
	                    }
	                ]
	            });
		var tbl_po_lists = $("#tbl_po_lists").DataTable({sorting: false, "columnDefs": [
	                    {
	                        "targets": [ 6 ],
	                        "visible": false,
	                        "searchable": false
	                    }
	                ]
	            });
		var tbl_po_details = $("#tbl_po_details").DataTable({paging: false, searching: false, "columnDefs": [
	                    {
	                        "targets": [0, 1],
	                        "visible": false,
	                        "searchable": false
	                    }
	                ]
	            });
		
		$('#opt_po_item').change(function(){
			var item_id = $('#opt_po_item option:selected').val();
			$.ajax({
				type: "POST",
	            url : baseurl + "warehouse_temp/get_item_uom",
	            dataType : "json",
	            data: {'item_id': item_id},
	            success : function(data){
	            	$('#item_unit').val(data[0].uom_name);
	            	$('#item_unit_id').val(data[0].uom_id);
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#add_po_item').click(function(){
			tbl_po_item.row.add([
				$('#opt_po_item option:selected').text(),
				$('#item_unit').val(),
				$('#po_item_qty').val(),
				// $('#po_item_qtyrcvd').val(),
				$('#po_item_price').val(),
				parseFloat($('#po_item_qty').val() * $('#po_item_price').val()),
				// $('#item_remarks').val(),
				$('#opt_po_item').val(),
				$('#item_unit_id').val(),
			]).draw(false);

			$('#item_unit').text('');
			$('#po_item_qty').text('');
			$('#po_item_qtyrcvd').text('');
			$('#po_item_price').text('');
			$('#item_remarks').text('');
			$('#opt_po_item').val('');
			$("#select2-opt_po_item-container").text('None');
			$('#item_unit_id').val('0');
		});

		$('#btn_submit_po').click(function(){
			var po_items = [];
			var po_item_data = tbl_po_item.rows().data();


			if (po_item_data.count() > 0) {

				var	prf_id = $('#prf_number').val();
				var	po_num = $('#po_number').val();
				var	po_date = $('#po_date').val();
				var	po_date_received = $('#po_date_rcvd').val();
				var	warehouse_id = $('#opt_po_warehouse').val();
				var	supplier_id = $('#opt_po_supplier').val();
				var	po_remark = $('#po_remarks').val();
				var	project_id = $('#opt_po_project').val();
				// var	po_invoice = $('#po_invoice').val();
				// var po_amount = $('#po_amount').val();

				po_item_data.each(function(calue, index){
					var item_arr = {
						'item_id' :tbl_po_item.cell( index, 5 ).data(),
						'po_uom_id': tbl_po_item.cell( index, 6 ).data(),
						// 'po_item_remark': tbl_po_item.cell( index, 5 ).data(),
						'po_qty': tbl_po_item.cell( index, 2 ).data(),
						// 'po_received': tbl_po_item.cell( index, 3 ).data(),
						'po_price': tbl_po_item.cell( index, 3 ).data(),
						'po_subtotal': tbl_po_item.cell( index, 4 ).data(),
						// 'TOP': tbl_po_item.cell( index, 10 ).data(),
					};
				    po_items.push(item_arr);

				});

				var data = {
					'prf_id' : prf_id,
					'po_num' : po_num,
					'po_date' : po_date,
					'po_date_received' : po_date_received,
					'warehouse_id' : warehouse_id,
					'supplier_id' : supplier_id,
					'po_remark' : po_remark,
					'project_id' : project_id,
					// 'invoice_number' : po_invoice, for
			 		// 'non_vat_amount': po_amount,
					'po_items' : po_items
				};

				$.ajax({
					type: "POST",
		            url : baseurl + "warehouse_temp/insert_po",
		            dataType : "json",
		            data: data,
		            success : function(data){
		            	tbl_po_item.clear().draw();
						reset_all();
						repopulate_po();
		            	toastr.options.timeOut = 500;
	                	toastr.success('Saved.', 'Success');
		            },  
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
				});
				
			}else{
				toastr.options.timeOut = 1000;
               	toastr.error('Empty Item/s.', 'Notice');
			}
		});

		$('#btn_reset_po_list').click(function(){
			reset_all();
		})
		
		function repopulate_po(){
			$.ajax({
					type: "POST",
		            url : baseurl + "warehouse_temp/get_allpo",
		            dataType : "json",
		            data: { 'a' : 0 },
		            success : function(data){
		            	tbl_po_lists.clear().draw();
		            	$.each(data, function (index, value){
		            	 	tbl_po_lists.row.add([
			            		data[index].po_id,
			            		data[index].po_num,
			            		data[index].po_date,
			            		data[index].po_date_received,
			            		data[index].po_total,
			            		data[index].po_status,
			            		data[index].warehouse_id
		            		]).draw( false );
                        });
		            },  
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
				});
		}

		var wh_id;
		var po_id;
		tbl_po_lists.on('click', 'tbody tr', function(e){
        	e.preventDefault();

	        var row = $(this).closest('tr')[0];
	        po_id = tbl_po_lists.cell(row, 0 ).data();
	        wh_id = tbl_po_lists.cell(row, 6 ).data();

				$("#tbl_po_lists tr").each(function () {
		            if ( $(this).hasClass('highlight') ) {
		                $(this).removeClass('highlight');
		            }
		        });
		        $(this).addClass("highlight");
			        $.ajax({
						type: "POST",
			            url : baseurl + "warehouse_temp/get_onepo",
			            dataType : "json",
			            data: {'po_id': po_id},
			            success : function(data){
			            	tbl_po_details.clear().draw();

			            	$.each(data, function(i, value){


								tbl_po_details.row.add([
									data[i].pod_id,
									data[i].item_id,
									data[i].description,
									data[i].uom_name,
									data[i].po_qty,
									data[i].po_received,
									0,
									data[i].po_item_remark,
									// (data[i].po_qty === data[i].po_received) ? '<span class="font font-green-meadow bold">SERVED</span>' :'<span class="font font-red bold">PARTIAL</span>',
									(data[i].po_received == 0) ? '<span class="bold">ORDER</span>' : ((data[i].po_qty == data[i].po_received) ? '<span class="font font-green-meadow bold">SERVED</span>' :'<span class="font font-red bold">PARTIAL</span>'),
								]).draw(false);
			                });
			            },  
			            error: function(errorThrown){
			                console.log(errorThrown);
			            }
					});
	        // alert(issuance_id);
        });

		var pod_id;
		var po_qty, po_rcv, pod_status;
		var row;
		var qty_diff;
		var item_name;
		tbl_po_details.on('click', 'tbody tr', function(e){
			row = $(this).closest('tr')[0];
	        pod_id = tbl_po_details.cell(row, 0 ).data();
	        item_name = tbl_po_details.cell(row, 2 ).data();
			po_qty = tbl_po_details.cell(row, 4 ).data();
			po_rcv = tbl_po_details.cell(row, 5 ).data(); 
	        // var item_id = tbl_po_details.cell(row, 1 ).data();
			$('#item_qty_rcv').focus();
			if (po_qty != po_rcv) {
				qty_diff = po_qty - po_rcv;
				$('#unserved_qty').html(qty_diff);
				$('#item_name').html(item_name);

				console.log(qty_diff);
		        $('#modal_rcv_item').modal('toggle');
			}else{
				toastr.options.timeOut = 500;
				toastr.warning('Item Served', 'Warning');
			}
        });

        $('#btn_rcv_item').click(function(){
        	// if (po_qty != $('#item_qty_rcv').val()) {
        	// 	pod_status = "Partial";
        	// }else{
        	// 	pod_status = "Served";
        	// }

        	var data = {
	        	'pod_id' : pod_id,
	        	'po_received' : $('#item_qty_rcv').val(),
	        	'po_item_remark' : $('#item_remark_rcv').val()

	        };
	        if ($('#item_qty_rcv').val() <= qty_diff) {
				if (po_qty != po_rcv) {
					tbl_po_details.cell(row, 6 ).data(parseFloat($('#item_qty_rcv').val()));
					tbl_po_details.cell(row, 7 ).data($('#item_remark_rcv').val());

					$('#item_qty_rcv').val('');
					$('#item_remark_rcv').val('');
			        $('#modal_rcv_item').modal('toggle');
				}else{
					toastr.options.timeOut = 500;
					toastr.warning('Item Served', 'Warning');
				}
	        }else{
	        	toastr.options.timeOut = 500;
				toastr.warning('Item received exceeded', 'Warning');
	        }

        });

        $('#save_receiving').click(function(){
    		var arr_data=[];
    		var postatus_flag = 0;
    		var delivery_receipt_number = $('#rcv_delivery_receipt').val();
    		var rcv_amount = $('#rcv_amount').val();
    		var rcv_invoice = $('#rcv_invoice').val();

    		if ($('#rcv_delivery_receipt').val() != '' && $('#rcv_amount').val() != '' && $('#rcv_invoice').val() != '' ) {
	        	$.each(tbl_po_details.rows().data(), function(i, value){
	        		if (tbl_po_details.cell(i, 5 ).data() == tbl_po_details.cell(i, 6 ).data()) {
	        			postatus_flag = postatus_flag + 1;
	        		}else{
	        			postatus_flag = 0;
	        		}
					var item_data = {
						'po_id' : po_id,
						'pod_id' : tbl_po_details.cell(i, 0 ).data(),
						'po_received' : parseFloat(tbl_po_details.cell(i, 5 ).data()),
						'pow_new_rcv' : parseFloat(tbl_po_details.cell(i, 6 ).data()),
						'po_item_remark' : tbl_po_details.cell(i, 7 ).data(),
						'item_id' : tbl_po_details.cell(i, 1 ).data()
					};
			        arr_data.push(item_data);
	            });

	        	var data = {
					'po_id' : po_id,
	        		'arr_data' : arr_data,
	        		'postatus_flag' : postatus_flag,
	        		'delivery_receipt_number' : delivery_receipt_number,
	        		'non_vat_amount' : rcv_amount,
	        		'invoice_number' : rcv_invoice,
	        		'warehouse_id' : wh_id,
	        	};

		        $.ajax({
					type: "POST",
		            url : baseurl + "warehouse_temp/update_receiving",
		            dataType : "json",
		            data: data,
		            success : function(data){	
		            	toastr.options.timeOut = 500;
	                	toastr.success('Saved.', 'Success');
	                	$('#rcv_delivery_receipt').val('');
						$('#rcv_amount').val('');
						$('#rcv_invoice').val('');

						$.ajax({
							type: "POST",
				            url : baseurl + "warehouse_temp/get_onepo",
				            dataType : "json",
				            data: {'po_id': po_id},
				            success : function(data){
				            	tbl_po_details.clear().draw();

				            	$.each(data, function(i, value){
									tbl_po_details.row.add([
										data[i].pod_id,
										data[i].item_id,
										data[i].description,
										data[i].uom_name,
										data[i].po_qty,
										data[i].po_received,
										0,
										data[i].po_item_remark,
										(data[i].po_qty === data[i].po_received) ? '<span class="font font-green-meadow bold">SERVED</span>' :'<span class="font font-red bold">PARTIAL</span>',
									]).draw(false);
				                });
				            },  
				            error: function(errorThrown){
				                console.log(errorThrown);
				            }
						});
		            },   
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
				});
    		}else{
    			toastr.options.timeOut = 500;
				toastr.warning('Fill up required field/s', 'Notice');
    		}



        });

		function reset_all(){
			$('#prf_number').val('');
			$('#po_number').val('');
			$('#po_date').val('');
			$('#po_date_rcvd').val('');
			$('#opt_po_warehouse').val('0');
			$("#select2-opt_po_warehouse-container").text('None');
			$('#opt_po_supplier').val('0');
			$("#select2-opt_po_supplier-container").text('None');
			$('#po_remarks').val('');

			// PO Details
			$('#item_unit').val('');
			$('#po_item_qty').val('');
			$('#po_item_qtyrcvd').val('');
			$('#po_item_price').val('');
			// $('#item_remarks').val('');
			$('#opt_po_item').val('');
			$("#select2-opt_po_item-container").text('None');
			$('#item_unit_id').val('0');
		}

	}
	return {
		init: function(){
			_init();
		}
	};
}();

jQuery(document).ready(function(){
    $("<style type='text/css'> .highlight{ background:#99b3ff;} </style>").appendTo("head");
	// $("<style type='text/css'> .borderless td, .borderless th { border: none;} </style>").appendTo("head");
	po.init();
});
