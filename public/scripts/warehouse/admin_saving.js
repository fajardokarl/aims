jQuery(document).ready( function($) {

	var po_table = $("#po_table").DataTable();
	var sent_prf_table = $('#sent_prf_table').DataTable({'columnDefs': [
		{
			'targets': [ 5, 6 ],
			'createdCell':  function (td, cellData, rowData, row, col) {
				$(td).attr('id', 'td_qty'); 
			}
		}
	]},{searching: false});

	po_table.on('click', 'tr', function (e) {
		$('#loadings').show();
		e.preventDefault();

		if($(this).attr('id') == 'tbody') {

			$("<style type='text/css'> .highlight{ background:#33F0FF;} </style>").appendTo("head");
		    $("#po_table tr").each(function () {
		        if ( $(this).hasClass('highlight') ) {
		            $(this).removeClass('highlight');
		        }
		    });
		    $(this).addClass("highlight");

			var row = $(this).closest('tr')[0];
			var rr_id = po_table.cell( row, 0 ).data();
			var po_id = po_table.cell( row, 1 ).data();
			var admin_status = "";
			var button_toggle = "";

			var ajaxCall = function() {
				$.ajax({
					type: "POST",
					url: baseurl + "Warehouse/adminsaving/get_po_admin_status",
					dataType: "json",
					data: { po_id: po_id },
					success: function(data) {
						console.log(data);
						admin_status = data;
					}, error: function(errorThrown) {
						console.log(errorThrown);
					}
				});

				$.ajax({
					type: "POST",
					url: baseurl + "Warehouse/adminsaving/get_item_availability",
					dataType: "json",
					data: { po_id: po_id },
					success: function(data) {
						console.log(data);
						$('#itemAvailability').val(data);
						if(data == "unavailable") {
					        toastr.error('Item Quantity is Low.', 'Alert');
					        toastr.error('Confirm buttons are disabled.', 'Error');
					        button_toggle = data;
					        $('.po_buttons').hide();
					    } else if(admin_status == ""){
					        $('.po_buttons').show();
					    }
					}, error: function(errorThrown) {
						console.log(errorThrown);
						toastr.error('Please try again.', 'Error');
					}
				});

				$.ajax({
					type: "POST",
					url: baseurl + "Warehouse/adminsaving/verify",
					dataType: "json",
					data: { rr_id: rr_id, po_id: po_id },
					success: function(data) {
						console.log(data);
						console.log("hello world");
						var ii = 0;
						if(data[0].client_type_id == 1) {
							$('#payable_to').text(data[0].lastname + ", " + data[0].firstname);
						} else if(data[0].client_type_id == 2){
							$('#payable_to').text(data[0].organization_name);
						}
						if(data[0].po_mod == "pick_up") {
							$('#mod').text("Pick Up");
						} else {
							$('#mod').text("Delivery");
						}
						$('#received_from').text(data[0].prf_id);
						$('#po_id').val(data[0].po_id);
						$('#rr_id').val(data[0].rr_id);
						$('#rr_no').text(data[0].prf_id);
						$('#po_date').val(data[0].po_date);
						sent_prf_table.clear().draw();
						$.each(data, function(i, value) {
							opt1 = "";
							opt2 = "";
							rcv = "";
							if(data[i].uom_id == 0) {
								opt1 = " selected";
							} else {
								opt2 = "selected";
							}
							if(data[0].po_admin_status) {
								rcv = data[i].po_received + "' readonly>";
							} else {
								rcv = data[i].po_qty + "'>";
							}
			                sent_prf_table.row.add([
			                    data[i].po_item_remark + "<input type='hidden' name='" + data[i].pod_id + "-pod_id' value='" + data[i].pod_id + "'><input type='hidden' name='" + data[i].item_id + "-item_id' value='" + data[i].item_id + "'>",
			                    "<select name='" + data[i].pod_id + "-po_uom'>" + "<option value='0'" + opt1 + ">None</option>" +
			                    "<option value='" + data[i].uom_id + "'" + opt2 + ">" + data[i].uom_name + "</option></select>",
			                    "",
			                    data[i].warehouse_description,
			                    data[i].po_price,
			                    "<input type='hidden' class='qty' value='" + data[i].po_qty + "'>" + data[i].po_qty,
			                    "<input type='number' class='received' name='" + data[i].pod_id + "-pod_item_qty_received' value='" + data[i].po_received + "'>",
			                    data[i].po_subtotal
			                ]).draw(false);
			                ii++;
			            });
			            $('#inc').val(ii);
						$('#non-vat_amount').text();
						$('#input_tax').text();
						$('#net_amount_due').text();
						$('#vatable_amount').text();
						$('#withholding_tax').text();
						$('#dr_no').val(data[0].delivery_receipt_number);
						$('#invoice_no').val(data[0].invoice_number);
						$('#prf_no').text(data[0].prf_id);
						$('#po_no').text(data[0].po_id);
						$('#po_date_received').val(data[0].po_date_received);
						switch(data[0].po_admin_status) {
							case 'complete':
								console.log('complete');
								$('.saved').show();
								$('.canceled').hide();
								$('.po_buttons').hide();
								break;
							case 'incomplete':
								console.log('incomplete');
								$('.saved').hide();
								$('.canceled').show();
								$('.po_buttons').hide();
								break;
							default:
								console.log('po_buttons');
								$('.saved').hide();
								$('.canceled').hide();
								if(button_toggle != "unavailable") {
									$('.po_buttons').show();
									button_toggle == "";
								}
						}
					},  
					error: function(errorThrown){
						console.log(errorThrown);
						toastr.error('Please try again.', 'Error');
					}
				});
			}

			ajaxCall();
		}
		$('#loadings').hide();

	// window.open(baseurl+"Warehouse/adminsaving/verify?rr_id="+rr_id);
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

	$('#pdf_amort_sched').on('click', function() {
		var po_id = $('#po_id').val();
		window.open(baseurl+"Warehouse/adminsaving/pdfPO?po_id="+po_id);
	});
});