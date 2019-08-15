var TableDatatablesEditable = function () {

	var incentiveslist = $('#tblincentives').DataTable();
    var handleTable = function () {

    }
    return {
        //main function to initiate the module
        init: function () {
            handleTable();
        }
    };
}();
$(document).ready(function(){
	$('#incentiveForm').submit(function (event){
		var data = new FormData();
		data.append("project_id",$('#projects').val());
		data.append("payment_scheme_id",$('#payment_scheme').val());
		data.append("reservation_bonus",$('#reservationBonus').val());
		data.append("scheme_bonus",$('#schemeBonus').val());
		for (var pair of data.entries()) {
		    console.log(pair[0]+ ', ' + pair[1]); 
		}
		$.ajax({
            type: "POST",
            url:  baseurl + "collection/saveIncentive",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
                
                location.reload();
                console.log(data);
                toastr.success('Successfully Saved!', 'Operation Done');
                // alert(data[0].broker_person_id);
                
            },
            error: function (errorThrown){
                //toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        });
		event.preventDefault();
	});
	$('#tblincentives tbody').on('click', 'tr', function () {
		var incentiveid = $(this).children(":first").text();
        console.log(incentiveid);
        $.ajax({
            type: "POST",
            url: "collection/retrieveOnIncentiveScheme",
            //dataType: 'json',
            data: {'incentiveid':incentiveid},
            success: function(result)
            {
                var data = jQuery.parseJSON(result);
                
                $('#updateProjects').val(data[0].project_id).change();
                $('#updatePaymentScheme').val(data[0].payment_scheme_id).change();
                $('#updateReservationBonus').val(data[0].reservation_bonus);
                $('#updateSchemeBonus').val(data[0].scheme_bonus);
                $('#UpdateIncentiveScheme').modal('show');
                
                $("#updateIncentiveForm").submit(function(event){
					var modify = new FormData();
					modify.append("incentive_id", incentiveid);
					modify.append("project_id",$('#updateProjects').val());
                    modify.append("payment_scheme_id",$('#updatePaymentScheme').val());
					modify.append("reservation_bonus",$('#updateReservationBonus').val());
					modify.append("scheme_bonus",$('#updateSchemeBonus').val());
					for (var pair of modify.entries()) {
					    console.log(pair[0]+ ', ' + pair[1]); 
					}
					$.ajax({
			            type: "POST",
			            url:  baseurl + "collection/modifyIncentive",
			            data: modify,
			            cache: false,
			            processData:false,
			            contentType:false,
			            success: function(data){
			                
			                location.reload();
			                toastr.success('Successfully Saved!', 'Operation Done');
			                // alert(data[0].broker_person_id);
			                
			            },
			            error: function (errorThrown){
			                toastr.error('Error!', 'Operation Done');
			                //console.log(errorThrown);
			            }
			        });
					event.preventDefault();
				});
            }
        });
	});
});