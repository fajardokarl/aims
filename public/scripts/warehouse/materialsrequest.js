jQuery(document).ready( function($) {

	var mr_table = $("#mr_table").DataTable();

	$('#cancel_issuance').on('click', function(e) {
		issuance_id = $('#is_id').val();
		
		$.ajax({
				type: 'POST',
				url: baseurl + "Warehouse/materialsrequest/cancel_issuance",
				dataType: "json",
				data: { issuance_id: issuance_id },
				success: function(data) {
					console.log(data);
	                setTimeout(function() {
	                    window.location.href = "/abci/Warehouse/cancelled_reports";
	                }, 2000);
				},
				error: function(errorThrown) {
					console.log(errorThrown);
					toastr.error('Try again');
				}
			});
	});
	// var tbl_issuances = $("#tbl_issuances").DataTable();

	$("#mr_table").on('dblclick', 'tr', function () {
	    var row = $(this).closest('tr')[0];
	    var mr_id = mr_table.cell( row, 0 ).data();

	    window.open(baseurl+"Warehouse/materialsrequest/requestDetail?mr_id="+mr_id);
	 });

	$('#mr_form').on('submit', function(e) {
		e.preventDefault();
		if($('#material_item').val() != 0) {
			$.ajax({
				type: 'POST',
				url: baseurl + "Warehouse/materialsrequest/generate_mr",
				dataType: "json",
				data: { department_project: $('#department_project').val(), material_item: $('#material_item').val(), material_uom: $('#material_uom').val(), quantity: $('#quantity').val(), block: $('#block').val(), lot: $('#lot').val(), requested_by: $('#requested_by').val(), date_requested: $('#date_requested').val() },
				success: function(data) {
					// $('select#material_uom').html("");
					// $('select#material_uom').html("<option value='0'>None</option>");
					// $('select#material_uom').html("<option value='0'>None</option><option value='" + $(this).val() + "'>" + data[0].uom_code + "</option>");
					// $('select#material_uom').append("<option value='" + $(this).val() + "'>" + data[0].uom_code + "</option>");
					toastr.success('Successfully generated a materials requisition slip.');
	                setTimeout(function() {
	                    window.location.href = "/abci/Warehouse/materialsrequest";
	                }, 2000);
				},
				error: function(errorThrown) {
					console.log(errorThrown);
				}
			});
		} else {
			toastr.error('Please choose a material description.', 'Error');
		}
	});

	$('#material_item').on('change', function() {
		uom_id = $(this).val();
		if($(this).val() > 0) {
			$.ajax({
				type: 'POST',
				url: baseurl + "Warehouse/materialsrequest/get_item_uom",
				dataType: "json",
				data: { material_item_id: uom_id },
				success: function(data) {
					console.log(data);
					// $('select#material_uom').html("");
					// $('select#material_uom').html("<option value='0'>None</option>");
					// $('select#material_uom').html("<option value='0'>None</option><option value='" + $(this).val() + "'>" + data[0].uom_code + "</option>");
					// $('select#material_uom').append("<option value='" + $(this).val() + "'>" + data[0].uom_code + "</option>");
					$('#material_uom').val(data[0].uom_name);
				},
				error: function(errorThrown) {
					console.log(errorThrown);
				}
			});
		} else {
			$('#material_uom').val("None");
		}
	});

	$('#generate_materials_issuance_slip').on('click', function() {
		var mr_id = $('#mr_id').val();
		window.open(baseurl+"Warehouse/issuance/request_mis?mr_id="+mr_id);
	});

	$('.po_buttons').on('click', '#status_confirm', function(e) {
		console.log("po_buttons");
		var button_clicked = $(this).data('value');
		if($('#dr_no').val() <= 0) {
			e.preventDefault();
			toastr.error("Invalid delivery receipt number.");
		}
		if($('#invoice_no').val() <= 0) {
			e.preventDefault();
			toastr.error("Invalid invoice number.");
		}
		$('#status_clicked').val(button_clicked);
	});

	$('td > #received_qty').on('input', function() {
		var qty = $(this).parent().prev().children('#td_qty > .qty').val();
		var received_qty = $(this).val();
		if(received_qty < 0) {
			toastr.error('Please input a non-negative number.');
		}
	});

	$('#save_issuance').on( 'click', function(e) {
		e.preventDefault();
	});
});

var issuance = function(){
	var _init = function(){
	// DATATABLES
		var tbl_item_request = $("#tbl_item_request").DataTable({searching: false, "columnDefs": [
                {
                    "targets": [ 0, 1 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        });
		var tbl_issuances = $("#tbl_issuances").DataTable({searching: false, "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        });
		var tbl_issuance_detail = $("#tbl_issuance_detail").DataTable({searching: false, "columnDefs": [
                {
                    "targets": [ 0 ],
                    "visible": false,
                    "searchable": false
                }
            ]
        });

		$('#opt_iss_item').change(function(){
			var item_id = $('#opt_iss_item option:selected').val();
			$.ajax({
				type: "POST",
	            url : baseurl + "warehouse_temp/get_item_uom",
	            dataType : "json",
	            data: {'item_id': item_id},
	            success : function(data){
	            	$('#issuance_unit').val(data[0].uom_name);
	            	$('#issuance_unit_id').val(data[0].uom_id);
	            	// $('#inv_available').val(data[0].quantity);
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
			$.ajax({
				type: "POST",
	            url : baseurl + "warehouse_temp/get_iteminventory",
	            dataType : "json",
	            data: {'item_id': item_id, 'warehouse_id': $('#opt_iss_warehouse option:selected').val()},
	            success : function(data){

		            $('#inv_available').val(data["quantity"]);
		            if (data["quantity"] == '0') {
						$('#issuance_qty').attr('readonly', true);
						$('#issuance_block').attr('readonly', true);
						$('#issuance_lot').attr('readonly', true);
						$('#add_request_item').attr('disabled', true);
						$('#issuance_qty').val('');
			        	$('#issuance_block').val('');
			        	$('#issuance_lot').val('');
		            }else{
		            	$('#issuance_qty').attr('readonly', false);
						$('#issuance_block').attr('readonly', false);
						$('#issuance_lot').attr('readonly', false);
						$('#add_request_item').attr('disabled', false);
		            }
 
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#opt_iss_warehouse').change(function(){
			var warehouse_id = $('#opt_iss_warehouse option:selected').val();
			$.ajax({
				type: "POST",
	            url : baseurl + "warehouse_temp/get_warehouseitem",
	            dataType : "json",
	            data: {'warehouse_id': warehouse_id},
	            success : function(data){
					$('#opt_iss_item').html("<option value='0' selected>None</option>");
	            	$.each(data, function(i, value){
						$('#opt_iss_item').append("<option value=" + data[i].item_id + ">" + data[i].description + "</option>");
	                });

	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

        $("#add_request_item").click(function(){
        	if ($('#opt_iss_item option:selected').val() != '0') {
        		if ($('#issuance_qty').val() != "" && $('#issuance_block').val() != "" && $('#issuance_lot').val() != "") {
		        	if (parseInt($('#issuance_qty').val()) <= parseInt($('#inv_available').val())) {
						tbl_item_request.row.add([
				        	$('#opt_iss_item option:selected').val(),
				        	$('#issuance_unit_id').val(),
				        	$('#opt_iss_item option:selected').text(),
				        	$('#issuance_unit').val(),
				        	$('#issuance_qty').val(),
				        	$('#issuance_block').val(),
				        	$('#issuance_lot').val(),
						]).draw(false);

						reset_all();
		        	}else{
						toastr.options.timeOut = 500;
		               	toastr.warning('Insufficient Inventory', 'Notice');
		        	}
        			
        		}else{
	        		toastr.options.timeOut = 500;
		            toastr.warning('Please complete the Form', 'Notice');	
        		}
        		
        	}else{
        		toastr.options.timeOut = 500;
	            toastr.warning('Select Item', 'Notice');
        	}
        });

        $('#save_issuance').click(function(){
			var issuance_items = [];
			var issuance_item_data = tbl_item_request.rows().data();
			// if ($('#issuance_qty').val() <= $('#inv_available').val()) {
			var request_abbr = $('#issuance_requestor').val();
			var requested_by = $('#opt_iss_project option:selected').val();
			var issuance_project = $('#opt_iss_project option:selected').val();
			var warehouse_id = $('#opt_iss_warehouse option:selected').val();
			var issuance_date = $('#issuance_date').val();
			if (request_abbr != "" && issuance_project != "" && warehouse_id != "" && issuance_date != "") {
				if (issuance_item_data.count() > 0) {

					issuance_item_data.each(function(value, index){
						var item_arr = {
							'item_id' :tbl_item_request.cell( index, 0 ).data(),
							'qty' :tbl_item_request.cell( index, 4 ).data(),
							'issuance_uom_id' :tbl_item_request.cell( index, 1 ).data(),
							'issuance_detail_project' :issuance_project,
							'block' :tbl_item_request.cell( index, 5 ).data(),
							'lot' :tbl_item_request.cell( index, 6 ).data(),
						};
					    issuance_items.push(item_arr);

					});

					var data = {
						'requested_by' : requested_by,
						'issuance_project' : issuance_project,
						'warehouse_id' : warehouse_id,
						'issuance_date' : issuance_date,
						'issuance_items' : issuance_items,
					}

					$.ajax({
						type: "POST",
			            url : baseurl + "Warehouse/materialsrequest/insert_issuance",
			            dataType : "json",
			            data: data,
			            success : function(data){
			            	tbl_issuances.clear().draw();
							reset_all();
							// repopulate_po();
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
				
			}else{
        		toastr.options.timeOut = 500;
	            toastr.warning('Please complete the Form', 'Notice');	
			}
			// }else{
			// 	toastr.options.timeOut = 1000;
   //             	toastr.error('Insufficient Inventory', 'Notice');
			// }
        });

        tbl_issuances.on('click', 'tbody tr', function(e){
        	e.preventDefault();

	        var row = $(this).closest('tr')[0];
	        var issuance_id = tbl_issuances.cell(row, 0 ).data();

				$("#tbl_issuances tr").each(function () {
		            if ( $(this).hasClass('highlight') ) {
		                $(this).removeClass('highlight');
		            }
		        });
		        $(this).addClass("highlight");
			        $.ajax({
						type: "POST",
			            url : baseurl + "warehouse_temp/get_issuance",
			            dataType : "json",
			            data: {'issuance_id': issuance_id},
			            success : function(data){
			            	tbl_issuance_detail.clear().draw();
			            	counter = 0;
			            	$.each(data, function(i, value){
			            		$("#is_id").val(data[i].issuance_id);
								tbl_issuance_detail.row.add([
									data[i].issuance_id,
									data[i].description + '<input type="hidden" name="' + data[i].issuance_detail_id + '-isd_id" value="' + data[i].issuance_detail_id + '"><input type="hidden" name="' + data[i].item_id + '-item_id" value="' + data[i].item_id + '">',
									data[i].uom_name,
									data[i].qty,
									'<input type="number" name="' + data[i].issuance_detail_id + '-isd_item_qty_received" value="' + data[i].qty + '">',
									data[i].block,
									data[i].lot,
								]).draw(false);
								counter++;
			                });
			                $("#inc").val(counter);
			            },  
			            error: function(errorThrown){
			                console.log(errorThrown);
			            }
					});


	        // alert(issuance_id);
        });


		function reset_all(){

			$('#issuance_unit_id').val(''),
			$('#issuance_unit').val('');
			$('#issuance_qty').val('');
			$('#issuance_block').val('');
			$('#issuance_lot').val('');
			$("#select2-opt_iss_item-container").text('None');
			$('#opt_iss_item').val('0');
    		$('#inv_available').val('');
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
	issuance.init();
});
