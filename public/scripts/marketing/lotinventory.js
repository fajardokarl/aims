var lotinventory = function(){
	var _init = function(){
        var lot_inv_projname = $("#lot_inv_projname").DataTable({searching: false, paging: false, bInfo:false, "ordering": false});
        var lot_inv_available = $("#lot_inv_available").DataTable({searching: false, paging: false, bInfo:false, "ordering": false, "columnDefs": [
                    {
                        "targets": [ 3 ],
                        "visible": false,
                        "searchable": false
                    }]
                });
        var lot_inv_sold = $("#lot_inv_sold").DataTable({searching: false, paging: false, bInfo:false, "ordering": false, "columnDefs": [
                    {
                        "targets": [ 3 ],
                        "visible": false,
                        "searchable": false
                    }]
                });
        var lot_inv_ending = $("#lot_inv_ending").DataTable({searching: false, paging: false, bInfo:false, "ordering": false});
		
		
        $('#lot_inv_generate').click(function(){
        	// alert($('#mancom_reptype option:selected').text() + ' of ' + $('#mancom_date').val());
        	// var repType = $('#mancom_reptype option:selected').val();


        	if ($('#lot_inv_date').val() != '') {
        		// $('#mancom_title').html('Year-to-Date Sales Reservation Performance');
	            lot_inv_projname.clear().draw();
	            lot_inv_available.clear().draw();
	            lot_inv_sold.clear().draw();
	            lot_inv_ending.clear().draw();
	            var proj_count = 0;
	        	$.ajax({
					type: "POST",
				    url : baseurl + "marketing/get_all_lotinv",
				    dataType : "json",
				    data: {'inventory_date': $('#lot_inv_date').val()},
				    async: false,
				    success : function(data){
			            $.each(data, function (index, value){
				    	proj_count++;
			                var i = index;
			            	lot_inv_available.row.add([
		            			data[index].units,
			            		data[index].lot_area,
			            		'<span class="pull-right">' + jFormatNumber(data[index].totals) + '<span>',
			            		data[index].totals
			            	]).draw(false);

			            	lot_inv_projname.row.add([
			            		data[index].project_name,
			            	]).draw(false);

			            	$.ajax({
								type: "POST",
							    url : baseurl + "marketing/get_unit_count",
							    dataType : "json",
							    data: {'proj_id': data[index].project_id},
							    async: false,
							    success : function(data){
							    	$.each(data, function (index, value){
						            	lot_inv_sold.row.add([
					            			data[index].units,
						            		data[index].lot_area,
						            		'<span class="pull-right">' + jFormatNumber(data[index].totals) + '<span>',
						            		data[index].totals
						            	]).draw(false);
						            });
							    },  
							    error: function(errorThrown){
							        console.log(errorThrown);
							    }
							});
			            });

			            for (var i = 0; i < proj_count; i++) {
			            	lot_inv_ending.row.add([
					    		(parseFloat(lot_inv_available.cell( i, 0 ).data()) - parseFloat(lot_inv_sold.cell( i, 0 ).data())),
					    		(parseFloat(lot_inv_available.cell( i, 1 ).data()) - parseFloat(lot_inv_sold.cell( i, 1 ).data())),
					    		'<span class="pull-right">' + jFormatNumber(lot_inv_available.cell( i, 3 ).data() - lot_inv_sold.cell( i, 3 ).data()) + '<span>'
					    	]).draw(false);
			            }


				    },  
				    error: function(errorThrown){
				        console.log(errorThrown);
				    }
				});

        	} else {

        		toastr.options.timeOut = 500;
        		toastr.warning('Please Fill up Date', 'Notice');
        	}


        });
		

        // FUNCTIONS
        function jFormatNumber(a) {
		    try {
		        return parseFloat(a).toFixed(2).replace(/(\d)(?=(\d{3})+\.)/g, "$1,")
		    } catch (a) {
		        return "Error FORMAT"
		    }
		}
		function jFormatNumberRet(a) {
		    try {
		        return parseFloat(a.replace(/,/g, ""))
		    } catch (a) {
		        return "Error FORMAT"
		    }
		}
	}
	return {
		init: function(){
			_init();
		}
	};
}();
jQuery(document).ready(function(){
	// $("<style type='text/css'> .selected{ background:#acbad4;} </style>").appendTo("head");
	lotinventory.init();
});

