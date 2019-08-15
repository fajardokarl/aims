var items = function(){
	var _init = function(){
		var tbl_items_list = $("#tbl_items_list").DataTable({searching: false, "columnDefs": [
                {
                    "targets": [0],
                    "visible": false,
                    "searchable": false
                }
            ]
        });


        $('#item_save').click(function(){
        	var item_brand = $('#item_brand').val();
        	var item_desc = $('#item_desc').val();
        	var item_dimen = $('#item_dimen').val();
        	var opt_item_cat = $('#opt_item_cat option:selected').val();
        	var opt_item_uom = $('#opt_item_uom option:selected').val();
        	var item_qty_left = $('#item_qty_left').val();
			var opt_item_warehouse = $('#opt_item_warehouse option:selected').val();

        	if (item_desc != "" && opt_item_cat != 0 && opt_item_warehouse != 0 && opt_item_uom != 0 && opt_item_cat != 0) {
        		var data = {
        			'item_brand' : item_brand,
					'item_desc' : item_desc,
					'item_dimen' : item_dimen,
					'opt_item_cat' : opt_item_cat,
					'opt_item_uom' : opt_item_uom,
					'item_qty_left' : item_qty_left,
					'opt_item_warehouse' : opt_item_warehouse,
        		}

        		$.ajax({
					type: "POST",
		            url : baseurl + "warehouse_temp/insert_item",
		            dataType : "json",
		            data: data,
		            success : function(data){
						reset();
		            	$('#item_brand').focus();
		            	toastr.options.timeOut = 500;
	                	toastr.success('Saved.', 'Success');
		            },  
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
				});
				item_brand = '';
				item_desc = '';
				item_dimen = '';
				opt_item_cat = '';
				opt_item_uom = '';
				item_qty_left = '';
				opt_item_warehouse = '';
        	}else{
	            	toastr.options.timeOut = 500;
                	toastr.warning('Complete the Form', 'Warning');
        	}	
        });

		// $('#item_search').keypress(function (e) {
		// 	if (e.which == 13 && $(this).val() != '') {
		// 		$.ajax({
		// 			type: "POST",
		//             url : baseurl + "warehouse_temp/item_search",
		//             dataType : "json",
		//             data: {'item_name' : $(this).val()},
		//             success : function(data){
		//             	$(this).focus();
		//             	tbl_items_list.clear().draw();
		// 	            	$.each(data, function (index, value){
		// 	            	 	tbl_items_list.row.add([
		// 		            		data[index].item_id,
		// 		            		data[index].description,
		// 		            		data[index].uom_name,
		// 	            		]).draw( false );
	 //                        });
		//             },  
		//             error: function(errorThrown){
		//                 console.log(errorThrown);
		//             }
		// 		});
		//   	}
		// });
		$('#item_search').keyup(function () {
			// if (e.which == 13 && $(this).val() != '') {\
				// if ($(this).val().length >= 3 ) {
					$.ajax({
						type: "POST",
			            url : baseurl + "warehouse_temp/item_search",
			            dataType : "json",
			            data: {'item_name' : $(this).val()},
			            success : function(data){
			            	$(this).focus();
			            	tbl_items_list.clear().draw();
				            	$.each(data, function (index, value){
				            	 	tbl_items_list.row.add([
					            		data[index].item_id,
					            		data[index].item_code + '' + data[index].item_id,
					            		data[index].description,
					            		data[index].uom_name,
				            		]).draw( false );
		                        });
			            },  
			            error: function(errorThrown){
			                console.log(errorThrown);
			            }
					});
				// }
		  	// }
		});
			

		$('#item_reset').click(function(){

			reset();
		    $('#item_brand').focus();
		});

		function reset(){
        	$('#item_brand').focus();
			$('#item_brand').val('');
			$('#item_desc').val('');
			$('#item_dimen').val('');
			$("#select2-opt_item_cat-container").text('None');
			$('#opt_item_cat').val('0');
		}
	}	
	return {
		init: function(){
			_init();
		}
	};
}();

jQuery(document).ready(function(){
	// $("<style type='text/css'> .borderless td, .borderless th { border: none;} </style>").appendTo("head");
	items.init();
});
