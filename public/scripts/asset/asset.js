var asset = function(){
	var _init = function(){

		var tbl_assets = $("#tbl_assets").DataTable({"order": [[ 1, "desc" ]],"columnDefs": [
                    {
                        "targets": [ 0, 1, 10, 9 ],
                        "visible": false,
                        "searchable": true
                    }, 
                    {
                    	"targets": "_all",
				    	"orderable": false
                    }
                ], 
                "createdRow": function( row, data, dataIndex ) {
				    if ( data[10] == 1 ) {
				      $(row).css('background-color', '#ffcfcf');
				    }else{
				      $(row).css('background-color', '#d7ffcf');

				    }
				}
               
            });
		$('#save_asset').click(function(){
			var desc      = $('#asset_desc').val();
			var seriel    = $('#asset_serial').val();
			var asset_dept= $('#asset_dept option:selected').val();
			var dept_code = $('#asset_dept option:selected').text();
			var custodian = $('#asset_custodian option:selected').val();
			var location  = $('#asset_location option:selected').val();
			if (desc != '' && location != 0 && asset_dept != 0) {
				var	data = {
					'serial_number' : seriel,
					'asset_description' : desc,
					'employee_id' :	custodian,
					'department_id' : asset_dept,
					'location' : location,
					'dep_code' : dept_code
				};
				$.ajax({
					type: "POST",
		            url : baseurl + "asset/asset/insert_assetbarcode",
		            dataType : "json",
		            data: data,
		            success : function(data){
		            	$('#asset_desc').val('');
						$('#asset_serial').val('');
		           		toastr.options.timeOut = 500;
	              		toastr.success('Savad.', 'Success');
	              		asset_table();
		            }, 
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }
				});
			}else{
				toastr.options.timeOut = 500;
				toastr.error('Uncomplete Form', 'Error');		
			}
		});

		$('#reset_asset').click(function(){
			reset_inputs();
		});

		$('#confirm_print').click(function(){
			printData();
			$('#sticker_print').modal('toggle');
		});	

		$('#btn_todamaged').click(function(){
			var id = $('#asset_id').val();
			var stat_val;
			if ($('#txt_status').hasClass("okay")) {
				$('#txt_status').removeClass("okay");
				$('#txt_status').addClass("damaged");
				$('#btn_text').text("MARK OKAY");

				$('#txt_status').removeClass("font-green-jungle");
				$('#txt_status').addClass("font-red-haze");
				$('#txt_status').removeClass("okay");
				$('#txt_status').addClass("damaged");
				$('#txt_status').html("DAMAGED");
				$('#btn_text').text("MARK OKAY");
				
				stat_val = 1;
			}else{
				$('#txt_status').removeClass("damaged");
				$('#txt_status').addClass("okay");
				$('#btn_text').text("MARK DAMAGED");

				$('#txt_status').removeClass("font-red-haze");
				$('#txt_status').addClass("font-green-jungle");
				$('#txt_status').removeClass("damaged");
				$('#txt_status').addClass("okay");
				$('#txt_status').html('OKAY');
				$('#btn_text').text("MARK DAMAGED");
				
				stat_val = 0;
			}
			var data = {
				'id' : id,
				'stat_val' : stat_val
			};
			$.ajax({
				type: "POST",
	            url : baseurl + "asset/asset/change_status",
	            dataType : "json",
	            data: data,
	            success : function(data){
	             	console.log(data);
	             	asset_table();
	            }, 
	            error: function(errorThrown){
	                console.log(errorThrown);
	            }
			});
		});

		$('#tbl_assets').on('click', 'tbody tr', function(){
			$('#sticker_print').modal('toggle');
			var row = $(this).closest('tr')[0];
			$('#asset_id').val(tbl_assets.cell(row, 0 ).data());
	        $('#stckr_desc').text(tbl_assets.cell(row, 4 ).data());
			$('#stckr_serno').text(tbl_assets.cell(row, 5 ).data());
			$('#stckr_cust').text(tbl_assets.cell(row, 6 ).data());
			$('#stckr_asst').text(tbl_assets.cell(row, 3 ).data());
			$('#stckr_dept_loc').text(tbl_assets.cell(row, 9 ).data() + '/' + tbl_assets.cell(row, 7 ).data());
			$('#stckr_date').text(tbl_assets.cell(row, 8 ).data());
			$('#stckr_tagno').text(tbl_assets.cell(row, 2 ).data());

			// code below to change/add a cell's CSS properties
				// var sample = tbl_assets.cell(row, 6 ).node();
				// $(sample).css('background-color', '#ffcfcf');
				// console.log(sample);

			if (tbl_assets.cell(row, 10 ).data() == 1) {
				$('#txt_status').removeClass("font-green-jungle");
				$('#txt_status').addClass("font-red-haze");
				$('#txt_status').removeClass("okay");
				$('#txt_status').addClass("damaged");
				$('#txt_status').html("DAMAGED");
				$('#btn_text').text("MARK OKAY");
			}else{
				$('#txt_status').removeClass("font-red-haze");
				$('#txt_status').addClass("font-green-jungle");
				$('#txt_status').removeClass("damaged");
				$('#txt_status').addClass("okay");
				$('#txt_status').html('OKAY');
				$('#btn_text').text("MARK DAMAGED");
			}


		});
		
 // FUNCTIONS---------------------------------------------------------------------------------------------------------
		
		function asset_table(){
			$.ajax({
					type: "POST",
		            url : baseurl + "asset/asset/get_assets",
		            dataType : "json",
		            data: {},
		            success : function(data){                                    
                        tbl_assets.clear().draw();
		            	$.each(data, function (index, value){
		            	 	tbl_assets.row.add([
			            		data[index].asset_barcode_id,
			            		data[index].asset_barcode_id,
			            		data[index].tag_number,
			            		data[index].asset_number,
			            		data[index].asset_description,
			            		data[index].serial_number,
			            		 ata[index].lastname + ', ' + data[index].firstname, // + ' ' + data[index].middlename
			            		data[index].location_abbr,
			            		data[index].date_counted,
			            		data[index].department_code,
			            		data[index].is_damaged
		            		]).draw( false );
                        });
		            }, 
		            error: function(errorThrown){
		                console.log(errorThrown);
		            }

			});
		}

		function printData(){
			var divToPrint=document.getElementById("sticker_content");
			newWin= window.open("");
			newWin.document.write('<body style="font-family:verdana; font-size: 1px;" >');
			newWin.document.write(divToPrint.outerHTML);
			newWin.document.write("</body>");
			newWin.print();
			newWin.close();
		}

		function reset_inputs(){
			$('#asset_desc').val('');
			$('#asset_serial').val('');
			$('#asset_dept').val(0);
			$('#asset_custodian').val(0);
			$('#asset_location').val(0);
			$('#select2-asset_dept-container').text('None');
			$('#select2-asset_custodian-container').text('None');
			$('#select2-asset_location-container').text('None');
		}

	}
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	$("<style type='text/css'> .selected{ background:#acbad4;} </style>").appendTo("head");
	asset.init();
});

