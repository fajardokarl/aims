var all_contracts = $("#all_contracts").DataTable();

$('#all_contracts').on('dblclick', 'tr', function () {
	var row = $(this).closest('tr')[0];
	var prf_id = all_contracts.cell( row, 0 ).data();

	$.ajax({
		type: "POST",
		url : $("#all_contracts").data("action"),
		dataType : "json",
		data: { prf_id: prf_id }/*,
		success : function(data){
		console.log(data);
		},  
		error: function(errorThrown){
		console.log(errorThrown);
		toastr.success('Updated Document Remark', 'Success');
		}*/
	});

	window.open(baseurl+"Warehouse/issuance/issuance_prf?prf_id="+prf_id);
});

$('#po_link').on('click', function(e) {
	e.preventDefault();
	window.open($('#po_link').data('url'));
});

