var TableDatatablesEditable = function () {

	var paymentschemelist = $('#tblpaymentschemeslists').DataTable();
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
    $("#project_scheme").select2({
        placeholder: "Select Project/s",
        width : null
    });

	$("#paymentSchemeForm").submit(function(event){
		var data = new FormData();
        var proj_scheme = $('#project_scheme').val();
        $.each(proj_scheme, function (index, value){
            data.append("project_scheme[]", value);
        });
		data.append("payment_scheme_name",$('#paymentSchemeName').val());
        data.append("reservation_fee",$('#psReservationFee').val());
		data.append("deposit_rate",$('#psDepositRate').val());
		data.append("discount_rate",$('#psDiscountRate').val());
		data.append("interest_rate",$('#psInterestRate').val());
        data.append("surcharge_rate",$('#psSurchargeRate').val());
		data.append("terms",$('#psTerms').val());
		data.append("amortization_rate",$('#psAmortizationRate').val());
        data.append("amortization_discount_rate",$('#psAmortizationDiscountRate').val());
        data.append("amortization_interest_rate",$('#psAmortizationInterestRate').val());
        data.append("amortization_surcharge_rate",$('#psAmortizationSurchargeRate').val());
        data.append("amortization_terms", $('#psAmortizationTerms').val());
		// for (var pair of data.entries()) {
		//     console.log(pair[0]+ ', ' + pa ir[1]); 
		// }
		$.ajax({
            type: "POST",
            url:  baseurl + "marketing/savePaymentScheme",
            data: data,
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

    $('#test').click(function(){
        var data = $('#project_scheme').val();
        console.log($('#project_scheme').val());
        $.each(data, function (index, value){
            alert(value);
        });
    });


	$('#tblpaymentschemeslists tbody').on('click', 'tr', function () {
        var paymentschemeid = $(this).children(":first").text();
        console.log(paymentschemeid);
        $.ajax({
            type: "POST",
            url: "marketing/retrieveOnPaymentScheme",
            //dataType: 'json',
            data: {'paymentschemeid':paymentschemeid},
            success: function(result)
            {
                var data = jQuery.parseJSON(result);
                //console.log(data[0].payment_scheme_id);
                //populate textboxes
                //$("#paymentSchemeUpdateSubmit").attr("action","marketing/modifyPaymentScheme");
                $('#updatePaymentSchemeName').val(data[0].payment_scheme_name);
                $('#updatePsReservationFee').val(data[0].reservation_fee);
                $('#updatePsDepositRate').val(data[0].deposit_rate);
                $('#updatePsDiscountRate').val(data[0].discount_rate);
                $('#updatePsInterestRate').val(data[0].interest_rate);
                $('#updatePsSurchargeRate').val(data[0].surcharge_rate);
                $('#updatePsTerms').val(data[0].terms);
                $('#updatePsAmortizationRate').val(data[0].amortization_rate);
                $('#updatePsAmortizationDiscountRate').val(data[0].amortization_discount_rate);
                $('#updatePsAmortizationInterestRate').val(data[0].amortization_interest_rate);
                $('#updatePsAmortizationSurchargeRate').val(data[0].amortization_surcharge_rate);
                $('#updatePsAmortizationTerms').val(data[0].amortization_rate);
                $('#UpdatePaymentScheme').modal('show');

                var paymentschemeid = data[0].payment_scheme_id;
                
                $("#paymentSchemeUpdateForm").submit(function(event){
					var modify = new FormData();
					modify.append("payment_scheme_id",paymentschemeid);
					modify.append("payment_scheme_name",$('#updatePaymentSchemeName').val());
                    modify.append("reservation_fee",$('#updatePsReservationFee').val());
					modify.append("deposit_rate",$('#updatePsDepositRate').val());
					modify.append("discount_rate",$('#updatePsDiscountRate').val());
					modify.append("interest_rate",$('#updatePsInterestRate').val());
                    modify.append("surcharge_rate",$('#updatePsSurchargeRate').val());
					modify.append("terms",$('#updatePsTerms').val());
					modify.append("amortization_rate",$('#updatePsAmortizationRate').val());
                    modify.append("amortization_discount_rate",$('#updatePsAmortizationDiscountRate').val());
                    modify.append("amortization_interest_rate",$('#updatePsAmortizationInterestRate').val());
                    modify.append("amortization_surcharge_rate",$('#updatePsAmortizationSurchargeRate').val());
                    modify.append("amortization_terms",$('#updatePsAmortizationTerms').val());
					for (var pair of modify.entries()) {
					    console.log(pair[0]+ ', ' + pair[1]); 
					}
					$.ajax({
			            type: "POST",
			            url:  baseurl + "marketing/modifyPaymentScheme",
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