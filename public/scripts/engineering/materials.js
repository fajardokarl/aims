var materials = function(){
	var _init = function(){
// DATATABLES
		var tbl_bom_list = $("#tbl_bom_list").DataTable({searching: false, "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ]
            });
		var tbl_bom_item_list = $("#tbl_bom_item_list").DataTable({searching: false, paging: false});
		var tbl_material = $("#tbl_material").DataTable({searching: false, paging: false, "order": [[ 9 ]], "columnDefs": [
                    {
                        "targets": [ 8, 9, 10, 11 ],
                        "visible": false,
                        "searchable": false
                    }, 
                    {
                    	"targets": "_all",
				    	"orderable": false
                    }
                ]
            });

// ADD ITEMS
		$('#earth_additems').click(function(){
			if ($('#cons_desc').val() != 0 && $('#cons_act').val() != 0 && $('#unit_cost').val() != 0) {
				if ($('#cons_qty').val() != 0) {
					var items_data = tbl_material.rows().data();
					var cons_desc_id = $('#cons_desc option:selected').val();
					var cons_act_id = $('#cons_act option:selected').val();
					var flag = 0;

					items_data.each(function (value, index) {
						var desc_id = items_data.cell( index, 9 ).data();
						if (desc_id == cons_desc_id) {
							flag = 1;
							console.log(flag);
							// break;
						}
					});

					if (flag == 0) {
						tbl_material.row.add([
							$('#cons_desc option:selected').text(),
							'',
							'',
							'',
							'',
							'',
							'',
							'',
							0,
							$('#cons_desc option:selected').val(),
							'',
							''
						]).draw(false);
					}
					tbl_material.row.add([
						'',
						$('#cons_act option:selected').text(),
						$('#cons_item option:selected').text(),
						$('#cons_qty').val(),
						$('#uom_item').val(),
						$('#unit_cost').val(),
						(parseFloat($('#cons_qty').val()) * parseFloat($('#unit_cost').val())),
						'<button class="btn btn-xs red remove_item"><i class="fa fa-trash-o" aria-hidden="true"></i></button>', //<button class="btn btn-xs blue edit_item"><i class="fa fa-edit" aria-hidden="true"></i></button>
						$('#cons_act option:selected').val(),
						$('#cons_desc option:selected').val(),
						$('#cons_item').val(),
						$('#uom_id_item').val()
					]).draw(false);
				}else{
					toastr.options.timeOut = 500;
                	toastr.error('Fill up Required Field.', 'Notice');
				}
			}else{
				toastr.options.timeOut = 500;
               	toastr.error('Please Select Category and Type.', 'Notice');
			}
		});

// DISPLAY UOM
		$('#cons_item').change(function(){
			var item_id = $('#cons_item option:selected').val();
			$.ajax({
				type: "POST",
	            url : baseurl + "engineering/material/get_item_uom",
	            dataType : "json",
	            data: {'item_id': item_id},
	            success : function(data){
	            	$('#uom_item').val(data[0].uom_name);
	            	$('#uom_id_item').val(data[0].uom_id);
	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		var item_id;

// DELETE ROW
		tbl_material.on('click', '.remove_item', function (e) {
            e.preventDefault();
            
            var row = $(this).closest('tr')[0];
            item_id = tbl_material.cell( row, 0 ).data();
            tbl_material.row($(this).closest('tr')).remove().draw();
        });

// // EDIT LINE
// 		tbl_material.on('click', '.edit_item', function (e) {
//             e.preventDefault();
// 			$('#edit_item_data').modal('toggle');            
//             // var row = $(this).closest('tr')[0];
//             // item_id = tbl_material.cell( row, 0 ).data();
//             // tbl_material.row($(this).closest('tr')).remove().draw();
//         });

// CHANGE PROJ
		$('#item_project').change(function(){
			// item_lots
			var proj_id = $('#item_project option:selected').val();
			var opt_content = "<option value='0'>None</option>";
			$.ajax({
				type: "POST",
	            url : baseurl + "engineering/material/get_proj_lots",
	            dataType : "json",
	            data: {'project_id': proj_id},
	            success : function(data){
	            	$.each(data, function(i, value){
                    opt_content += "<option value='" + data[i].lot_id + "'>" + data[i].lot_description + "</option>"
                });
                $('#item_lots').html(opt_content);

	            },  
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});


// SAVING ITEMS TO DB
		$('#save_all_items').click(function(){
			var need_date = $('#date_needed').val();
			if (!Date.parse(need_date)) {
				toastr.options.timeOut = 500;
                toastr.error('Specify Date Needed.', 'Notice');
			}else{
				$('#confirmation_modal').modal('toggle');
			}
		});

		$('#confirm_save_items').click(function(){
			var bom_items = [];
			var bom_arr;
			var date_needed = $('#date_needed').val();
			var project_id = $('#item_project').val();
			var lot_id = $('#item_lots option:selected').val();
			var tbl_material_data = tbl_material.rows().data();

			tbl_material_data.each(function (value, index) {
				if (tbl_material_data.cell( index, 8 ).data() != '' || tbl_material_data.cell( index, 8 ).data() != 0) {
				    var bom_arr = {
						// 'bom_id' : tbl_material_data.cell( index, 0 ).data(),
						'item_id' : tbl_material_data.cell( index, 10 ).data(),
						'uom_id' : tbl_material_data.cell( index, 11 ).data(),
						'qty' : tbl_material_data.cell( index, 3 ).data(),
						'unit_cost' : tbl_material_data.cell( index, 5 ).data(),
						'construction_act_id' : tbl_material_data.cell( index, 8 ).data(),
						'construction_desc_id' : tbl_material_data.cell( index, 9 ).data(),
				    };
				    bom_items.push(bom_arr);
				}
			});

			var data = {
				'project_id' : project_id,
				'lot_id' : lot_id,
				'date_needed' : date_needed,
				'bom_items' : bom_items
			};

			if (bom_items.length > 0) {
				$.ajax({
					type: "POST",
		            url : baseurl + "engineering/material/insert_bom",
		            dataType : "json",
		            data: data,
		            success : function(data){
	    				reset_bom_tbl();

		            	$('#bom_type').val('0');
	    				$("#select2-bom_type-container").text('None');
		            	$('#item_cat').val('0');
	    				$("#select2-item_cat-container").text('None');
						$('#confirmation_modal').modal('toggle');
		            	
		            	tbl_material.clear().draw();
		            	toastr.options.timeOut = 500;
	                	toastr.success('Savad.', 'Success');
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

// VIEW ITEM LIST
		$('#tbl_bom_list').on('click', 'tbody tr', function () {
			var row = $(this).closest('tr')[0];
	        var bom_id = tbl_bom_list.cell( row, 0 ).data();

	        $.ajax({
					type: "POST",
		            url : baseurl + "engineering/material/get_bom",
		            dataType : "json",
		            data: {'bom_id' : bom_id },
		            success : function(data){
		            	tbl_bom_item_list.clear().draw();
		            	$('#lot_name').html("");
						$('#date_r').html("");
						$('#date_n').html("");
						// $('#bom_id').html("");
						$('#lot_name').html(tbl_bom_list.cell( row, 1 ).data());
						$('#date_r').html(tbl_bom_list.cell( row, 2 ).data());
						$('#date_n').html(tbl_bom_list.cell( row, 3 ).data());
						$('#bom_id').val(bom_id);

		            	$.each(data, function (index, value){
		            	 	tbl_bom_item_list.row.add([
					    		data[index].bom_detail_id,
					    		data[index].description_name,
					    		data[index].activity_name,
					    		data[index].description,
					    		data[index].qty,
					    		data[index].uom_code,
					    		data[index].unit_cost,
					    		(parseFloat(data[index].unit_cost) * parseFloat(data[index].qty)),
					    	]).draw(false);
                        });
		            	$('#bom_all_items').modal('toggle');
		            }, 
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
			});
	    });

		$('#btn_bom_pdf').click(function(){
            var bomID = $('#bom_id').val();
            window.open(baseurl+"engineering/material/pdf_bom?bomid=" + bomID);
        });


		function reset_bom_tbl(){
			$.ajax({
					type: "POST",
		            url : baseurl + "engineering/material/get_boms",
		            dataType : "json",
		            data: {},
		            success : function(data){       
                        tbl_bom_list.clear().draw();
		            	$.each(data, function (index, value){
		            	 	tbl_bom_list.row.add([
			            		data[index].bom_id,
			            		data[index].lot_description,
			            		data[index].date_request,
			            		data[index].date_needed
		            		]).draw( false );
                        });
		            }, 
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
			});
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
	materials.init();
});
