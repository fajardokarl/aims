var TableDatatablesEditable = function () {

	var commissionlist = $('#tblcommission').DataTable();
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
	$('#commissionForm').submit(function (event){
		var data = new FormData();
		data.append("commission_name",$('#commissionName').val());
		data.append("commission_type",$('#commissionType').val());
		data.append("percent_commission",$('#percentCommission').val());
		data.append("percent_tcp_paid",$('#tcpCommission').val());
		for (var pair of data.entries()) {
		    console.log(pair[0]+ ', ' + pair[1]); 
		}
		$.ajax({
            type: "POST",
            url:  baseurl + "marketing/saveCommission",
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
	$('#tblcommission tbody').on('click', 'tr', function () {
		var commissionid = $(this).children(":first").text();
        console.log(commissionid);
        $.ajax({
            type: "POST",
            url: "marketing/retrieveOnCommissionScheme",
            //dataType: 'json',
            data: {'commissionid':commissionid},
            success: function(result)
            {
                var data = jQuery.parseJSON(result);
                
                $('#updateCommissionName').val(data[0].commission_name);
                $('#updateCommissionType').val(data[0].commission_type).change();
                $('#updatePercentCommission').val(data[0].percent_commission);
                $('#updateTcpCommission').val(data[0].percent_tcp_paid);
                $('#UpdateCommission').modal('show');
                
                $("#updateCommissionForm").submit(function(event){
					var modify = new FormData();
					modify.append("commission_id", commissionid);
					modify.append("commission_name",$('#updateCommissionName').val());
                    modify.append("commission_type",$('#updateCommissionType').val());
					modify.append("percent_commission",$('#updatePercentCommission').val());
					modify.append("percent_tcp_paid",$('#updateTcpCommission').val());
					for (var pair of modify.entries()) {
					    console.log(pair[0]+ ', ' + pair[1]); 
					}
					$.ajax({
			            type: "POST",
			            url:  baseurl + "marketing/modifyCommission",
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