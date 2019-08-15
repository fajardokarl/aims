
$(document).ready(function(){
	$('#generateReport').click(function (event) {
		var data = new FormData();
		data.append('fromDate',$('#fromDate').val());
		data.append('toDate',$('#toDate').val());
		for (var pair of data.entries()) {
		    console.log(pair[0]+ ', ' + pair[1]); 
		}
		$.ajax({
            type: "POST",
            url:  baseurl + "marketing/generateReservationReport",
            data: data,
            cache: false,
            processData:false,
            contentType:false,
            success: function(data){
                
                //location.reload();
                //toastr.success('Successfully Saved!', 'Operation Done');
                // alert(data[0].broker_person_id);
                var data = jQuery.parseJSON(data);
                var content = '';
                for (var i = 0; i < data.length; i++) {
		            content += '<tr>';
		            content += '<td>' + data[i].contract_id + '</td>';
		            console.log('----------------');
		            console.log(data[i].contract_id);
		            content += '<td>' + data[i].contract_date + '</td>';
		            console.log(data[i].contract_date);
		            content += '<td>' + data[i].project_description + '</td>';
		            console.log(data[i].project_description);
		            content += '<td>' + data[i].lot_description + '</td>';
		            console.log(data[i].lot_description);
		            content += '<td>' + data[i].lot_area + '</td>';
		            console.log(data[i].lot_area);
		            content += '<td>' + data[i].price_per_sqr_meter + '</td>';
		            console.log(data[i].price_per_sqr_meter);
		            content += '<td>' + data[i].lot_price + '</td>';
		            console.log(data[i].lot_price);
		            content += '<td>' + data[i].lname + ", " + data[i].fname + " " + data[i].mname + '</td>';
		            console.log(data[i].customer_fullname);
		            content += '<td>' + data[i].realty_name + '</td>';
		            console.log(data[i].realty_name);
		            content += '<td>' + data[i].agent_lname + ", " + data[i].agent_fname + " " + data[i].agent_mname + '</td>';
		            content += '</tr>';
		        }
		        $('#tbody_rp').html(content);
		        $('#dateDiv').show();
		        $('#dateText').text($('#fromDate').val() + ' to ' + $('#toDate').val());
                
            },
            error: function (errorThrown){
                toastr.error('Error!', 'Operation Done');
                //console.log(errorThrown);
            }
        });
		event.preventDefault();
	});

	$('#print').click(function () {
		var css = '@page { size: landscape; }',
		    head = document.head || document.getElementsByTagName('head')[0],
		    style = document.createElement('style');

		style.type = 'text/css';
		style.media = 'print';

		if (style.styleSheet){
		  style.styleSheet.cssText = css;
		} else {
		  style.appendChild(document.createTextNode(css));
		}

		head.appendChild(style);
		window.print();
	});

	$('#xls').click(function(){
		// frromDate and ToDate from reservationreport.php
		var from_date = $('#fromDate').val();
		var to_date   = $('#toDate').val();
		console.log(from_date + " : " + to_date);

		var dates = {'from_date':from_date, 'to_date':to_date};

		$.ajax({
            type: 'POST',
            url: baseurl + "marketing/xls_reserevationreport",
            dataType: 'text',
            //contentType: "application/json; charset=utf-8",
            data: dates,
            // cache: false,
            // processData:false,
            // contentType:false,
            success: function(data) {
                $("#xls_trigger").trigger("click").attr("target", "_blank");
                //$("#receiptTrigger").trigger("click").attr("target", "_blank");     
            }
        });

	});
});