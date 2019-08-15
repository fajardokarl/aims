var mancom = function(){
	var _init = function(){
		var actual_sales_peso, actual_sales_unit ,unit_index, peso_index; 

        var mancom_table_units = $("#mancom_table_units").DataTable({searching: false, "ordering": false, paging: false});
        var mancom_table_peso = $("#mancom_table_peso").DataTable({searching: false, "ordering": false, paging: false, "lengthMenu": [[5, 10, 25, 50, -1], [5, 10, 25, 50, "All"]], "columnDefs": [
                    {
                        "targets": [ 0 ],
                        "visible": false,
                        "searchable": false
                    }
                ]
              });



        $('#mancom_generate').click(function(){
        	// alert($('#mancom_reptype option:selected').text() + ' of ' + $('#mancom_date').val());
        	var repType = $('#mancom_reptype option:selected').val();


        	if (repType == 1 && $('#mancom_date').val() != '') {
        		$('#mancom_title').html('Year-to-Date Sales Reservation Performance');
        		$('#mancom_as_of').html('January to ' + moment($('#mancom_date').val()).format("MMMM Y"));

	        	$.ajax({
					type: "POST",
				    url : baseurl + "marketing/get_mancom_year",
				    dataType : "json",
				    data: {'mancom_date': $('#mancom_date').val()},
				    success : function(data){
	                    mancom_table_units.clear().draw();
	                    mancom_table_peso.clear().draw();

				    	$.each(data, function (index, value){
			            	mancom_table_units.row.add([
			            	data[index].project_name,
			            	data[index].units,
			            	'0',
			            	'0',
			            	'%'
			            	]).draw(false);
			            });

			            $.each(data, function (index, value){
			            	mancom_table_peso.row.add([
		            		data[index].totals,
			            	data[index].project_name,
			            	'<span class="pull-right">' + jFormatNumber(data[index].totals) + '<span>',
			            	'0',
			            	'0',
			            	'%'
			            	]).draw(false);
			            });
				    },  
				    error: function(errorThrown){
				        console.log(errorThrown);
				    }
				});
        		
        	}else if(repType == 2  && $('#mancom_date').val() != ''){
        		$('#mancom_title').html('Monthly Sales Reservation Performance');
        		$('#mancom_as_of').html(moment('Whole ' + $('#mancom_date').val()).format("MMMM Y"));

        		$.ajax({
					type: "POST",
				    url : baseurl + "marketing/get_mancom_monthly",
				    dataType : "json",
				    data: {'mancom_date': $('#mancom_date').val()},
				    success : function(data){
	                    mancom_table_units.clear().draw();
	                    mancom_table_peso.clear().draw();

				    	$.each(data, function (index, value){
			            	mancom_table_units.row.add([
			            	data[index].project_name,
			            	data[index].units,
			            	'0',
			            	'0',
			            	'%'
			            	]).draw(false);
			            });

			            $.each(data, function (index, value){
			            	mancom_table_peso.row.add([
		            		data[index].totals,
			            	data[index].project_name,
			            	'<span class="pull-right">' + jFormatNumber(data[index].totals) + '<span>',
			            	'0',
			            	'0',
			            	'%',
			            	]).draw(false);
			            });
				    },  
				    error: function(errorThrown){
				        console.log(errorThrown);
				    }
				});

        	}else{
        		toastr.options.timeOut = 500;
            	toastr.warning('Please Select Type', 'Notice');
        		
        		if ($('#mancom_date').val() == '') {
        			toastr.options.timeOut = 500;
            		toastr.warning('Please Fill up Date', 'Notice');
        		}
        	}

        });

    // PESO
        $('#mancom_table_peso').on('click', 'tbody tr', function () {
	        var row = $(this).closest('tr')[0];
            actual_sales_peso = mancom_table_peso.cell( row, 0 ).data();
            peso_index = mancom_table_peso.row(this).index();

            $('#mancom_budget_input_peso').modal('toggle');
        	
        });

        $('#mancom_confirm_budget_peso').click(function(){
        	// alert(actual_sales_peso);
	        var row = $(this).closest('tr')[0];

        	var budget = $('#mancom_budget_peso').val();
        	var variance_peso;
        	var variance_percent;

        	if ($('#mancom_budget_peso').val() != '') {
        		variance_peso = actual_sales_peso - budget;
				variance_percent = (actual_sales_peso / budget) * 100;

	        	mancom_table_peso.cell( peso_index, 3 ).data(budget);
	        	mancom_table_peso.cell( peso_index, 4 ).data(variance_peso.toFixed(2));

				if (variance_peso >= 0) {
		        	mancom_table_peso.cell( peso_index, 5 ).data(variance_percent.toFixed(2) + '%');
				}else if (variance_peso < 0) {
					variance_percent = variance_percent - 100; 
		        	mancom_table_peso.cell( peso_index, 5 ).data(variance_percent.toFixed(2) + '%');
				}
				
        	}else{
        		toastr.options.timeOut = 500;
            	toastr.warning('Please Supply Budget', 'Notice!');
        	}
            $('#mancom_budget_input_peso').modal('toggle');
        	$('#mancom_budget_peso').val('');
        });
    

    // UNIT
    	$('#mancom_table_units').on('click', 'tbody tr', function () {
	        var row = $(this).closest('tr')[0];
            actual_sales_unit = mancom_table_units.cell( row, 1 ).data();
            unit_index = mancom_table_units.row(this).index();

            $('#mancom_budget_input_unit').modal('toggle');
        	
        });

        $('#mancom_confirm_budget_unit').click(function(){
        	// alert(actual_sales_unit);
	        var row = $(this).closest('tr')[0];

        	var budget = $('#mancom_budget_unit').val();
        	var variance_unit;
        	var variance_percent;

        	if ($('#mancom_budget_unit').val() != '') {
        		variance_unit = actual_sales_unit - budget;
				variance_percent = (actual_sales_unit / budget) * 100;

	        	mancom_table_units.cell( unit_index, 2 ).data(budget);
	        	mancom_table_units.cell( unit_index, 3 ).data(variance_unit);

				if (variance_unit >= 0) {
		        	mancom_table_units.cell( unit_index, 4 ).data(variance_percent.toFixed() + '%');
				}else if (variance_unit < 0) {
					variance_percent = (variance_percent - 100); 
		        	mancom_table_units.cell( unit_index, 4 ).data(variance_percent.toFixed() + '%');
				}
				
        	}else{
        		toastr.options.timeOut = 500;
            	toastr.warning('Please Supply Budget', 'Notice!');
        	}
            $('#mancom_budget_input_unit').modal('toggle');
        	$('#mancom_budget_unit').val('');
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
	mancom.init();
});

