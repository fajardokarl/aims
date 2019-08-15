var docstatus = function(){
	var _init = function(){
		var financing_type_id, contract_id;
		var docs_contracts = $("#docs_contracts").DataTable({searching: false, "columnDefs" : [{
                "targets": [ 11, 12, 13, 14 ],
                "visible": false,
                "searchable": false,
                }
            ]
        });
		// $('#test').click(function(){
		// 	alert('GOOD!');
		// })

		$('#docs_project').change(function(e){
			var proj_id = $("#docs_project option:selected").val();
	    	docs_contracts.clear().draw();

			$.ajax({
				type: "POST",
			    url : baseurl + "marketing/get_contracts_docs",
			    dataType : "json",
			    data: {'proj_id' : proj_id},
			    success : function(data){

			    	$.each(data, function (index, value){
				    	var cust_name;
				    	var cts_signed_text;
				    	var cts_notarized_text;
				    	var doas_signed_text;
				    	var block_no =  data[index].block_no;
				    	var lot_no = data[index].lot_no;
				    	var status = data[index].contract_status_name;
				    	var cts_date = data[index].cts_date;
				    	var cts_signed = data[index].cts_signed;
				    	var cts_notarized = data[index].cts_notarized;
				    	var doas_date = data[index].doas_date;
				    	var doas_signed = data[index].doas_signed; //doas signed = doas recorded
				    	var doas_amount = data[index].doas_amount;
				    	var financing_name = data[index].financing_name;
				    	var is_transferred = data[index].is_transferred;
				    	var client_type_id = data[index].client_type_id;
				    	financing_type_id = data[index].financing_type_id;
				    	// contract_id = data[index].contract_id;

				    	if (cts_signed == 1) {
				    		cts_signed_text = '<span class="font-green-jungle"><i class="fa fa-check"></i></span>';
				    	}else{
				    		cts_signed_text = '<span class="font-red-mint"><i class="fa fa-close"></i></span>';
				    	}

				    	if (cts_notarized == 1) {
							cts_notarized_text = '<span class="font-green-jungle"><i class="fa fa-check"></i></span>';
				    	}else{
							cts_notarized_text = '<span class="font-red-mint"><i class="fa fa-close"></i></span>';
				    	}

				    	if (doas_signed == 1) {
							doas_signed_text = '<span class="font-green-jungle"><i class="fa fa-check"></i></span>';
				    	}else{
							doas_signed_text = '<span class="font-red-mint"><i class="fa fa-close"></i></span>';
				    	}

				    	if (client_type_id == 1) {
					    	cust_name = data[index].lastname + ", " + data[index].firstname + " " + data[index].middlename;
				    	}else{
				    		cust_name = data[index].organization_name;
				    	}

		            	docs_contracts.row.add([
		            		block_no,
							lot_no,
							cust_name,
							status,
							cts_date,
							cts_signed_text,
							cts_notarized_text,
							doas_date,
							doas_signed_text,
							financing_name,
							is_transferred,
							cts_signed,
							cts_notarized,
							doas_signed,
							data[index].contract_id
		            	]).draw(false);
		            });
		          	e.preventDefault();
			    	
			    },
			    error: function(errorThrown){
			        console.log(errorThrown);
			    }
			    
			});

			$('#docs_contracts').on('click', 'tbody tr', function(e) {
          		e.preventDefault();

				var row = $(this).closest('tr')[0];
				$('#docs_contract_info').modal('show');

				var cts_sined_val = docs_contracts.cell( row, 11 ).data();
				var cts_notarized_val = docs_contracts.cell( row, 12 ).data();
				var doas_signed_val = docs_contracts.cell( row, 13 ).data();

				contract_id = docs_contracts.cell( row, 14 ).data();

				$('#edit_cts_date').val(docs_contracts.cell( row, 4 ).data());
				$('#edit_doas_date').val(docs_contracts.cell( row, 7 ).data());
				
				if (cts_sined_val == 1) {
					$('#edit_cts_signed').prop('checked', true);
					$('#edit_cts_signed').prop('value', 1);
				}else{
					$('#edit_cts_signed').prop('checked', false);
					$('#edit_cts_signed').prop('value', 0);
				}

				if (cts_notarized_val == 1) {
					$('#edit_cts_notarized').prop('checked', true);
					$('#edit_cts_notarized').prop('value', 1);
				}else{
					$('#edit_cts_notarized').prop('checked', false);
					$('#edit_cts_notarized').prop('value', 0);
				}

				if (doas_signed_val == 1) {
					$('#edit_doas_signed').prop('checked', true);
					$('#edit_doas_signed').prop('value', 1);
				}else{
					$('#edit_doas_signed').prop('checked', false);
					$('#edit_doas_signed').prop('value', 0);
				}

			});

		});

		$('#edit_cts_signed').on('change', function(){
		   this.value = this.checked ? 1 : 0;
		   // alert(this.value); 
		}).change();

		$('#edit_cts_notarized').on('change', function(){
		   this.value = this.checked ? 1 : 0;
		   // alert(this.value); 
		}).change();

		$('#edit_doas_signed').on('change', function(){
		   this.value = this.checked ? 1 : 0;
		   // alert(this.value); 
		}).change();


		$('#save_new_docs').click(function(){
			

			var data = {
				'edit_cts_date' : $('#edit_cts_date').val(),
				'edit_cts_signed' : $('#edit_cts_signed').val(),
				'edit_cts_notarized' : $('#edit_cts_notarized').val(),
				'edit_doas_date' : $('#edit_doas_date').val(),
				'edit_doas_signed' : $('#edit_doas_signed').val(),
				'edit_doas_amount' : $('#edit_doas_amount').val(),
				'contract_id' : contract_id
			};

			$.ajax({
				type: "POST",
			    url : baseurl + "marketing/update_docs",
			    dataType : "json",
			    data: data,
			    success : function(data){
                    $('#docs_project').trigger("change");
					$('#docs_contract_info').modal('hide');
			    },  
			    error: function(errorThrown){
			        console.log(errorThrown);
			    }
			});

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
	docstatus.init();
});

