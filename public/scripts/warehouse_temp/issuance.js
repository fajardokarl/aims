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
		        	if ($('#issuance_qty').val() <= $('#inv_available').val()) {
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
						'request_abbr' : request_abbr,
						'issuance_project' : issuance_project,
						'warehouse_id' : warehouse_id,
						'issuance_date' : issuance_date,
						'issuance_items' : issuance_items,
					}

					$.ajax({
						type: "POST",
			            url : baseurl + "warehouse_temp/insert_issuance",
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

			            	$.each(data, function(i, value){
								tbl_issuance_detail.row.add([
									data[i].issuance_id,
									data[i].description,
									data[i].uom_name,
									data[i].qty,
									data[i].block,
									data[i].lot,
								]).draw(false);
			                });
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
